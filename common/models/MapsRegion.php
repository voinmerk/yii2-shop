<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%maps_region}}".
 *
 * @property int $id
 * @property int $country_id
 * @property string $name
 * @property int $status
 *
 * @property MapsCity[] $mapsCities
 * @property MapsCountry $country
 */
class MapsRegion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%maps_region}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => MapsCountry::className(), 'targetAttribute' => ['country_id' => 'id']],
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
            'name' => 'Name',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMapsCities()
    {
        return $this->hasMany(MapsCity::className(), ['region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(MapsCountry::className(), ['id' => 'country_id']);
    }
}
