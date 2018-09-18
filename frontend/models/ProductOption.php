<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%products_option}}".
 *
 * @property int $id
 * @property int $product_id
 * @property int $option_id
 * @property string $value
 * @property int $required
 *
 * @property Options $option
 * @property Products $product
 * @property ProductsOptionValue[] $productsOptionValues
 */
class ProductOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products_option}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'option_id', 'value', 'required'], 'required'],
            [['product_id', 'option_id', 'required'], 'integer'],
            [['value'], 'string'],
            [['option_id'], 'exist', 'skipOnError' => true, 'targetClass' => Options::className(), 'targetAttribute' => ['option_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'option_id' => 'Option ID',
            'value' => 'Value',
            'required' => 'Required',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(Options::className(), ['id' => 'option_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsOptionValues()
    {
        return $this->hasMany(ProductsOptionValue::className(), ['product_option_id' => 'id']);
    }
}
