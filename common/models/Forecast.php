<?php

namespace common\models;

use yii\db\ActiveRecord;

class Forecast extends ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'temperature'], 'required'],
            [['city_id'], 'default', 'value' => null],
            [['city_id'], 'integer'],
            [['temperature'], 'number'],
            [['created_at'], 'string'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::class, ['id' => 'city_id']);
    }

    public static function getForecastByCityId($cityId) {
        return self::find()
            ->where(['city_id' => $cityId])
            ->asArray()
            ->all();
    }

    public static function getCountForecastByInterval($dateStart, $dateEnd) {
        return self::find()
            ->select('city_id, COUNT(DISTINCT city_id) as cities')
            ->where([
                'between',
                'created_at',
                $dateStart,
                $dateEnd,
            ])
            ->groupBy('city_id')
            ->sum('c.cities');
    }

    public static function getForecastByInterval($dateStart, $dateEnd, $start, $limit) {
        return self::find()
            ->with(['city', 'city.country'])
            ->select('city_id, min(temperature) as min, max(temperature) as max, avg(temperature) as avg')
            ->where([
                'between',
                'created_at',
                $dateStart,
                $dateEnd
            ])
            ->groupBy('city_id')
            ->limit($start)
            ->offset($limit)
            ->asArray()
            ->all();
    }
}