<?php

namespace backend\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

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
 * @property int $created_by
 * @property int $modified_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Users $createdBy
 * @property Users $modifiedBy
 */
class Category extends \yii\db\ActiveRecord
{
    const PUBLISHED = 1;
    const UNPUBLISHED = 0;

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
            [['parent_id', 'sort_order', 'created_by', 'modified_by', 'created_at', 'updated_at', 'published'], 'integer'],
            [['title', 'meta_title', 'slug'], 'required'],
            [['description', 'meta_keywords', 'meta_description'], 'string'],
            [['title', 'image', 'meta_title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['modified_by'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\User::className(), 'targetAttribute' => ['modified_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'parent_id' => 'Выбор категории',
            'title' => 'Название категории',
            'description' => 'Описание',
            'image' => 'Изображение',
            'meta_title' => 'Заголовок страницы',
            'meta_keywords' => 'SEO-Метки',
            'meta_description' => 'SEO-Описание',
            'slug' => 'SEO-Ссылка',
            'sort_order' => 'Порядок сортировки',
            'published' => 'Публикация',
            'created_by' => 'Автор',
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
        $categories = self::find()->select(['id', 'parent_id', 'title'])->indexBy('id')->orderBy(['sort_order' => SORT_ASC])->asArray()->all();

        $categories_tree = self::buildTree($categories);

        $data = [];

        foreach($categories_tree as $category) {
            $data[] = [
                'id' => $category['id'],
                'title' => !isset($category['items']) ?
                $category['title'] :
                $category['title'] . self::getCategoryTreePartials($category['items']),
            ];
        }

        /*var_dump($categories_tree);
        var_dump($data);
        exit;*/

        return $data;
    }

    public static function getCategoryTreePartials($categories)
    {
        foreach($categories as $category) {
            if(isset($category['items'])) {
                $title .= ' -> ' . $category['title'] . self::getCategoryTreePartials($category['items']);
            } else {
                $title .= ' -> ' . $category['title'];
            }
        }

        return $title;
    }

    public static function getCategories()
    {
        return self::find()->orderBy(['updated_at' => SORT_DESC]);
    }

    public static function getCategoryList($id)
    {
        return self::find()->where(['published' => self::PUBLISHED])->all();
    }

    /**
     * {@inheritdoc}
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren()
    {
        return $this->hasMany(self::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModifiedBy()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'modified_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
