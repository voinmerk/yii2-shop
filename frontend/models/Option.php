<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%options}}".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property int $sord_order
 *
 * @property OptionsValue[] $optionsValues
 * @property ProductsOption[] $productsOptions
 */
class Option extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%options}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'sord_order'], 'required'],
            [['sord_order'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['type'], 'string', 'max' => 32],
            [['type'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'sord_order' => 'Sord Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptionsValues()
    {
        return $this->hasMany(OptionsValue::className(), ['option_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsOptions()
    {
        return $this->hasMany(ProductsOption::className(), ['option_id' => 'id']);
    }
}
