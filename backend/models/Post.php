<?php

namespace backend\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

use common\models\User;

/**
 * This is the model class for table "{{%posts}}".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $widget
 * @property string $slug
 * @property int $created_by
 * @property int $modified_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Users $createdBy
 * @property Users $modifiedBy
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%posts}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'meta_title', 'slug'], 'required'],
            [['text', 'meta_keywords', 'meta_description'], 'string'],
            [['created_by', 'modified_by', 'created_at', 'updated_at'], 'integer'],
            [['title', 'meta_title', 'slug'], 'string', 'max' => 255],
            [['widget'], 'string', 'max' => 64],
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
            'title' => 'Title',
            'text' => 'Text',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'widget' => 'Widget',
            'slug' => 'Slug',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
