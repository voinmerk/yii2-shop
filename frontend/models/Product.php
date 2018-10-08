<?php

namespace frontend\models;

use Yii;
use yii\helpers\Url;

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
 * @property int $product_status_id
 * @property int $created_by
 * @property int $modified_by
 * @property int $marker
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Carts[] $carts
 * @property OrdersProduct[] $ordersProducts
 * @property ProductsStatus $productStatus
 * @property User $createdBy
 * @property User $modifiedBy
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
            [['status', 'count', 'points', 'published', 'views', 'votes', 'sort_order', 'product_status_id', 'created_by', 'modified_by', 'marker'], 'integer'],
            [['price', 'weight'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'image', 'meta_title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['product_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductStatus::className(), 'targetAttribute' => ['product_status_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => \frontend\models\User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['modified_by'], 'exist', 'skipOnError' => true, 'targetClass' => \frontend\models\User::className(), 'targetAttribute' => ['modified_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'meta_title' => 'Meta Title',
            'status' => 'Status',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'slug' => 'Slug',
            'count' => 'Count',
            'points' => 'Points',
            'price' => 'Price',
            'weight' => 'Weight',
            'published' => 'Published',
            'views' => 'Views',
            'votes' => 'Votes',
            'sort_order' => 'Sort Order',
            'product_status_id' => 'Product Status ID',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getProductsAll()
    {
        $query = self::find()->select(['id', 'title', 'description', 'slug', 'image', 'price', 'marker'])->where(['published' => 1])->orderBy(['sort_order' => SORT_ASC, 'created_at' => SORT_DESC]);
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        if(count($products)) {
            foreach($products as $product) {
                $marker_class = null;
                $maker_text = null;

                if($product->marker == 1) {
                    $marker_class = 'catalog-new';
                    $maker_text = 'NEW';
                } else if($product->marker == 2) {
                    $marker_class = 'catalog-sale';
                    $maker_text = 'SALE';
                } else if($product->marker == 3) {
                    $marker_class = 'catalog-hit';
                    $maker_text = 'ХИТ';
                }

                $data[] = [
                    'id' => $product->id,
                    'title' => $product->title,
                    'mini_description' => \yii\helpers\StringHelper::truncate($product->description, 150, '...'),
                    'url' => Url::to(['product/view', 'product' => $product->slug]),
                    'cart_url' => Url::to(['product/cart', 'id' => $product->slug]),
                    'image' => $product->image,
                    'price' => round($product->price, 2),
                    'marker' => $product->marker,
                    'marker_class' => $marker_class,
                    'marker_text' => $maker_text,
                ];
            }

            return $data;
        }

        return false;
    }

    public static function getProductById($product)
    {
        $model = self::findOne(['slug' => $product]);

        $data = [
            'title' => $model->title,
            'meta_title' => $model->meta_title,
            'description' => $model->description,
        ];

        return $data;
    }

    public static function getProductsByCategory($category)
    {
        return self::find()->where(['published' => 1])->orderBy([])->asArray()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getCarts()
    {
        return $this->hasMany(Carts::className(), ['product_id' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getOrdersProducts()
    {
        return $this->hasMany(OrdersProduct::className(), ['product_id' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsStatus()
    {
        return $this->hasOne(ProductStatus::className(), ['id' => 'product_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(\frontend\models\User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModifiedBy()
    {
        return $this->hasOne(\frontend\models\User::className(), ['id' => 'modified_by']);
    }

    public function likes()
    {
        return $this->viaTable('likes', ['model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('products_to_categories', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getProductsComments()
    {
        return $this->hasMany(ProductsComment::className(), ['product_id' => 'id'])->viaTable('products_categories', ['product_id' => 'id']);
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
        return $this->hasMany(ProductOption::className(), ['product_id' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getSalesProducts()
    {
        return $this->hasMany(SalesProduct::className(), ['product_id' => 'id']);
    }*/
}
