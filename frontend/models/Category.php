<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "{{%categories}}".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $slug
 * @property int $sort_order
 * @property int $published
 * @property int $created_by
 * @property int $modified_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Users $createdBy
 * @property Users $modifiedBy
 * @property CategoriesTree[] $categoriesTrees
 */
class Category extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%categories}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort_order', 'published', 'created_by', 'modified_by', 'created_at', 'updated_at'], 'integer'],
            [['title', 'meta_title', 'slug'], 'required'],
            [['description', 'meta_keywords', 'meta_description'], 'string'],
            [['title', 'image', 'meta_title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            ['published', 'default', 'value' => self::STATUS_ACTIVE],
            ['published', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
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
            'parent_id' => 'Parent ID',
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'slug' => 'Slug',
            'sort_order' => 'Sort Order',
            'published' => 'Published',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function buildTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = self::buildTree($elements, $element['id']);
                if ($children) {
                    $element['items'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    public static function getCategoryTree()
    {
        $data = self::find()
                    ->select(['id', 'parent_id', 'title', 'slug', 'sort_order', 'meta_title'])
                    ->where(['published' => self::STATUS_ACTIVE])
                    ->indexBy('id')
                    ->orderBy(['sort_order' => SORT_ASC])
                    ->asArray()
                    ->all();

        $list = self::buildTree($data);

        return $list;
    }

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
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('products_to_categories', ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getCategoriesTrees()
    {
        return $this->hasMany(CategoriesTree::className(), ['category_id' => 'id']);
    }*/
}
