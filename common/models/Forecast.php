<?php

namespace common\models;

use yii\db\ActiveRecord;

class Forecast extends ActiveRecord {

    public function getCities()
    {
        return $this->hasMany(Cities::class, ['id' => 'city_id']);
    }

}