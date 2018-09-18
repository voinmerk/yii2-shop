<?php

namespace backend\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

use common\models\User;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $meta_title
 * @property int $status
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $slug
 * @property int $count
 * @property int $points
 * @property string $price
 * @property string $weight
 * @property int $published
 * @property int $views
 * @property int $votes
 * @property int $sort_order
 * @property int $marker
 * @property int $product_status_id
 * @property int $created_by
 * @property int $modified_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Carts[] $carts
 * @property OrdersProduct[] $ordersProducts
 * @property ProductsStatus $productStatus
 * @property Users $createdBy
 * @property Users $modifiedBy
 * @property ProductsCategories[] $productsCategories
 * @property ProductsComment[] $productsComments
 * @property ProductsImage[] $productsImages
 * @property ProductsOption[] $productsOptions
 * @property SalesProduct[] $salesProducts
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'image', 'meta_title', 'status', 'slug', 'count', 'points', 'price', 'weight'], 'required'],
            [['description', 'meta_keywords', 'meta_description'], 'string'],
            [['status', 'count', 'points', 'published', 'views', 'votes', 'sort_order', 'marker', 'product_status_id', 'created_by', 'modified_by', 'created_at', 'updated_at'], 'integer'],
            [['price', 'weight'], 'number'],
            [['title', 'image', 'meta_title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            //[['product_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductsStatus::className(), 'targetAttribute' => ['product_status_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['modified_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['modified_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование',
            'description' => 'Описание',
            'image' => 'Изображение',
            'meta_title' => 'Мета заголовок',
            'status' => 'Status',
            'meta_keywords' => 'Мета ключи',
            'meta_description' => 'Мета описание',
            'slug' => 'SEO ссылка',
            'count' => 'Количество на складе',
            'points' => 'Points',
            'price' => 'Цена',
            'weight' => 'Weight',
            'published' => 'Публикация',
            'views' => 'Просмотры',
            'votes' => 'Голоса',
            'sort_order' => 'Сортировка',
            'marker' => 'Маркер',
            'product_status_id' => 'Статус товара',
            'created_by' => 'Создатель',
            'modified_by' => 'Модератор',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                // 'slugAttribute' => 'slug',
                'ensureUnique' => true,
            ],
            'blame' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'modified_by',
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['product_id' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getOrdersProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['product_id' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getProductStatus()
    {
        return $this->hasOne(ProductStatus::className(), ['id' => 'product_status_id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModifiedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'modified_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['category_id' => 'id'])->viaTable('products_categories', ['id' => 'product_id'])->asArray();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getProductsComments()
    {
        return $this->hasMany(ProductComment::className(), ['product_id' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getProductsImages()
    {
        return $this->hasMany(ProductsImage::className(), ['product_id' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getProductsOptions()
    {
        return $this->hasMany(ProductsOption::className(), ['product_id' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getSalesProducts()
    {
        return $this->hasMany(SalesProduct::className(), ['product_id' => 'id']);
    }*/
}
