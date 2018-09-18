<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%banners}}".
 *
 * @property int $id
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
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'published' => 'Публикация',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * Get banner
     */
    public static function getBannerList()
    {
        return self::find()->orderBy(['updated_at' => SORT_DESC])->all();
        // return self::find()->select(['banners.*', 'COUNT(banners_image.id) AS imageCount'])->leftJoin('banners_image', 'banners_image.banner_id = banners.id')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBannersImages()
    {
        return $this->hasMany(BannerImage::className(), ['banner_id' => 'id']);
    }
}
