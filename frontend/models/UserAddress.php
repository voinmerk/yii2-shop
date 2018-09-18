<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "users_address".
 *
 * @property int $id
 * @property int $user_id
 * @property string $country
 * @property string $region
 * @property string $city
 * @property string $street
 * @property string $house
 *
 * @property User $user
 */
class UserAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'country', 'region', 'city', 'street', 'house'], 'required'],
            [['user_id'], 'integer'],
            [['country', 'region', 'city', 'street', 'house'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'country' => 'Country',
            'region' => 'Region',
            'city' => 'City',
            'street' => 'Street',
            'house' => 'House',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
