<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%carts}}".
 *
 * @property int $id
 * @property int $user_id Зарегестрированный пользователь
 * @property string $session_id Для не авторизированных пользователей
 * @property int $product_id
 * @property string $option
 * @property int $quantity
 * @property int $created_at
 * @property int $updated_at
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%carts}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'session_id', 'product_id', 'option', 'quantity'], 'required'],
            [['user_id', 'product_id', 'quantity', 'created_at', 'updated_at'], 'integer'],
            [['option'], 'string'],
            [['session_id'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('public', 'ID'),
            'user_id' => Yii::t('public', 'User ID'),
            'session_id' => Yii::t('public', 'Session ID'),
            'product_id' => Yii::t('public', 'Product ID'),
            'option' => Yii::t('public', 'Option'),
            'quantity' => Yii::t('public', 'Quantity'),
            'created_at' => Yii::t('public', 'Created At'),
            'updated_at' => Yii::t('public', 'Updated At'),
        ];
    }

    /**
     * Получение всех товаров добавленные в корзину пользователем с параметром $user
     *
     * @param $user
     *
     * @return array|null
     */
    public function getProducts($user)
    {
        $data = null;

        if(!empty($user)) {
            $products = null;

            if(!is_numeric($user)) {
                $products = self::find()->where(['session_id' => $user]);
            } else {
                $products = self::find()->where(['session_id' => $user]);
            }

            if($products) {
                foreach ($products as $product) {
                    $data[] = [
                        'id' => $product->id,
                        'option' => $product->option,
                        // ...
                    ];
                }
            } else {
                $data = [
                    'error' => true,
                    'message' => 'Нет товаров в корзине!',
                ];
            }
        }

        return $data;
    }
}
