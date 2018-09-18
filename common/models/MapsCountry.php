<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%maps_country}}".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 *
 * @property MapsCity[] $mapsCities
 * @property MapsRegion[] $mapsRegions
 */
class MapsCountry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%maps_country}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMapsCities()
    {
        return $this->hasMany(MapsCity::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMapsRegions()
    {
        return $this->hasMany(MapsRegion::className(), ['country_id' => 'id']);
    }
}
