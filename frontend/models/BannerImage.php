<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "banners_image".
 *
 * @property int $id
 * @property int $banner_id
 * @property string $image_title Заголовок изображения
 * @property string $image_alt Описание изображения
 * @property string $image_src Путь до изображения
 * @property string $slide_caption Описание на баннере
 * @property string $slide_url Ссылка на страницу
 * @property int $published Статус публикации
 * @property int $sort_order Порядок сортировки
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Banner $banner
 */
class BannerImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%banners_image}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['banner_id', 'image_title', 'image_alt', 'image_src', 'slide_caption', 'slide_url'], 'required'],
            [['banner_id', 'published', 'sort_order', 'created_at', 'updated_at'], 'integer'],
            [['slide_caption'], 'string'],
            [['image_title', 'image_alt', 'image_src', 'slide_url'], 'string', 'max' => 255],
            [['banner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Banner::className(), 'targetAttribute' => ['banner_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'banner_id' => 'Banner ID',
            'image_title' => 'Image Title',
            'image_alt' => 'Image Alt',
            'image_src' => 'Image Src',
            'slide_caption' => 'Slide Caption',
            'slide_url' => 'Slide Url',
            'published' => 'Published',
            'sort_order' => 'Sort Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getImages($id)
    {
        return self::find()->where(['banner_id' => $id, 'published' => 1])->asArray()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanner()
    {
        return $this->hasOne(Banner::className(), ['id' => 'banner_id']);
    }
}
