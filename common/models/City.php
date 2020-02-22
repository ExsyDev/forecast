<?php

namespace common\models;

use yii\db\ActiveRecord;

class City extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'name'], 'required'],
            [['country_id'], 'default', 'value' => null],
            [['country_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['dateStart','dateEnd'], 'date', 'on' => 'job', 'format' => 'php:d.m.Y'],
            ['dateEnd', 'compare', 'compareAttribute' => 'dateStart', 'operator' => '>'],
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
            'city' => 'City',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::class, ['id' => 'country_id']);
    }

    public static function getCityByName($city) {
        return self::find()
            ->with(['country'])
            ->where(['city' => $city])
            ->asArray()
            ->one();
    }
}