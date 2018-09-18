<?php

namespace common\models;

use Yii;
use yii\db\Expression;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use frontend\models\Banner;
use frontend\models\UserGroup;
use frontend\models\UserAddress;
use frontend\models\UserCard;
use frontend\models\UserPhone;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $first_name
 * @property string $last_name
 * @property double $cash
 * @property string $password_reset_token
 * @property int $status
 * @property int $user_group_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Banner[] $banners
// * @property Categories[] $categories
//* @property Categories[] $categories0
//* @property Order[] $orders
//* @property Page[] $pages
//* @property Page[] $pages0
//* @property Product[] $products
//* @property Product[] $products0
//* @property ProductComment[] $productsComments
//* @property ProductComment[] $productsComments0
//* @property Sale[] $sales
 * @property UserGroup $userGroup
 * @property UserAddress[] $usersAddresses
 * @property UserCard[] $usersCards
 * @property UserPhone[] $usersPhones
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * Constants for checking user status
     */
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * Scenarios
     */
    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'auth_key', 'user_group_id'], 'required'],
            [['cash'], 'number'],
            [['user_group_id'], 'integer'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['status'], 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 32],
            [['email', 'password_hash', 'auth_key', 'first_name', 'last_name', 'password_reset_token'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['user_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserGroup::className(), 'targetAttribute' => ['user_group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя пользователя',
            'email' => 'Почта',
            'password_hash' => 'Пароль',
            'auth_key' => 'Ключ авторизации',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'cash' => 'Деньги',
            'password_reset_token' => 'Токен сброса пароля',
            'status' => 'Статус',
            'user_group_id' => 'Группа пользователя',
            'created_at' => 'Дата регистрации',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'class' => TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT,

            self::SCENARIO_LOGIN => [
                'username', 'password_hash'
            ],

            self::SCENARIO_REGISTER => [
                'first_name',
                'last_name',
                'username',
                'email',
                'password_hash',
                'auth_key',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::find()->where('(username=:username OR email=:email) AND status=:status', ['username' => $username, 'email' => $username, 'status' => self::STATUS_ACTIVE])->one();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     *
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    //----------------- СВЯЗИ -------------------------------------------------------

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banner::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(\backend\models\Category::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories0()
    {
        return $this->hasMany(\backend\models\Category::className(), ['modified_by' => 'id']);
    }

    public function likes()
    {
        return $this->viaTable('likes', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['user_id' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getPages()
    {
        return $this->hasMany(Pages::className(), ['created_by' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getPages0()
    {
        return $this->hasMany(Pages::className(), ['modified_by' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getProducts()
    {
        return $this->hasMany(Products::className(), ['created_by' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getProducts0()
    {
        return $this->hasMany(Products::className(), ['modified_by' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getProductsComments()
    {
        return $this->hasMany(ProductsComment::className(), ['created_by' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getProductsComments0()
    {
        return $this->hasMany(ProductsComment::className(), ['modified_by' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getSales()
    {
        return $this->hasMany(Sales::className(), ['user_id' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGroup()
    {
        return $this->hasOne(\frontend\models\UserGroup::className(), ['id' => 'user_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersAddresses()
    {
        return $this->hasMany(\frontend\models\UserAddress::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersCards()
    {
        return $this->hasMany(\frontend\models\UserCard::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersPhones()
    {
        return $this->hasMany(\frontend\models\UserPhone::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsCreatedBy()
    {
        return $this->hasMany(\backend\models\Product::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsModifiedBy()
    {
        return $this->hasMany(\backend\models\Product::className(), ['modified_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturersCreatedBy()
    {
        return $this->hasMany(\backend\models\Manufacturer::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturersModifiedBy()
    {
        return $this->hasMany(\backend\models\Manufacturer::className(), ['modified_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostsCreatedBy()
    {
        return $this->hasMany(\backend\models\Post::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostsModifiedBy()
    {
        return $this->hasMany(\backend\models\Post::className(), ['modified_by' => 'id']);
    }
}
