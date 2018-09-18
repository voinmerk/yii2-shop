<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%banners}}".
 *
 * @property int $id
 * @property string $widget
 * @property string $title
 * @property string $description
 * @property int $published
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BannerImage[] $bannersImages
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%banners}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['published', 'created_at', 'updated_at'], 'integer'],
            [['widget', 'title'], 'string', 'max' => 255],
            [['widget'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'widget' => 'Widget',
            'title' => 'Title',
            'description' => 'Description',
            'published' => 'Published',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /*
     * Get banners content
     */
    public static function getBanner($widget)
    {
        $banner = self::find()->where(['widget' => $widget])->asArray()->one();

        $banners_image = BannerImage::getImages($banner['id']);

        $data = [
            'widget' => $banner['widget'],
        ];

        foreach($banners_image as $image) {
            $data['images'][] = [
                'title' => $image['image_title'],
                'alt' => $image['image_alt'],
                'src' => $image['image_src'],
                'caption' => $image['slide_caption'],
                'url' => $image['slide_url'],
            ];
        }
        
        return $data;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBannersImages()
    {
        return $this->hasMany(BannerImage::className(), ['banner_id' => 'id']);
    }
}
