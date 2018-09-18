<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "users_group".
 *
 * @property int $id
 * @property int $role_id
 * @property string $name
 *
 * @property User[] $users
 */
class UserGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['user_group_id' => 'id']);
    }
}
