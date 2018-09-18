<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%maps_city}}".
 *
 * @property int $id
 * @property int $country_id
 * @property int $region_id
 * @property string $name
 * @property int $status
 *
 * @property MapsCountry $country
 * @property MapsRegion $region
 */
class MapsCity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%maps_city}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'region_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => MapsCountry::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => MapsRegion::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'region_id' => 'Region ID',
            'name' => 'Name',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(MapsCountry::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(MapsRegion::className(), ['id' => 'region_id']);
    }
}
