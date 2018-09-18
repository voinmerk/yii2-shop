<?php

namespace frontend\models;

use Yii;
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
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'slug' => 'Slug',
            'sort_order' => 'Sort Order',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Получение списка всех производителей
     */
    public static function getListAll()
    {
        return self::find()->indexBy('id')->orderBy(['sort_order' => SORT_ASC, 'id' => SORT_DESC, 'updated_at' => SORT_DESC])->asArray()->all();
    }

    /**
     * Получение записи определённого производителя
     */
    public static function getOne($id)
    {
        return self::findOne(['slug' => $id]);
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
