<?php

namespace backend\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

use common\models\User;

/**
 * This is the model class for table "{{%manufacturers}}".
 *
 * @property int $id
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
class Manufacturer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%manufacturers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'image', 'meta_title', 'meta_keywords', 'meta_description', 'slug'], 'required'],
            [['description', 'meta_keywords', 'meta_description'], 'string'],
            [['sort_order', 'created_by', 'modified_by', 'created_at', 'updated_at'], 'integer'],
            [['title', 'image', 'meta_title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
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
            'meta_keywords' => 'Мета ключи',
            'meta_description' => 'Мета описание',
            'slug' => 'SEO ссылка',
            'sort_order' => 'Сортировка',
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
}
