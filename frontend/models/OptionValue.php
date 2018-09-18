<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%options_value}}".
 *
 * @property int $id
 * @property int $option_id
 * @property string $name
 * @property int $sort_order
 *
 * @property Options $option
 */
class OptionValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%options_value}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['option_id', 'name', 'sort_order'], 'required'],
            [['option_id', 'sort_order'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['option_id'], 'exist', 'skipOnError' => true, 'targetClass' => Options::className(), 'targetAttribute' => ['option_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'option_id' => 'Option ID',
            'name' => 'Name',
            'sort_order' => 'Sort Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(Options::className(), ['id' => 'option_id']);
    }
}
