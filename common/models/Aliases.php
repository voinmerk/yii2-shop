<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%aliases}}".
 *
 * @property int $id
 * @property string $alias читаем url (seo url)
 * @property string $controller
 * @property string $action
 * @property int $model_id
 */
class Aliases extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%aliases}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'controller', 'action'], 'required'],
            [['model_id'], 'integer'],
            [['alias'], 'string', 'max' => 255],
            [['controller', 'action'], 'string', 'max' => 64],
            [['alias'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Alias',
            'controller' => 'Controller',
            'action' => 'Action',
            'model_id' => 'Model ID',
        ];
    }
}
