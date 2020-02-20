<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200218_181136_forecast
 */
class m200218_181136_forecast extends Migration
{
    public function up()
    {
        $this->createTable('forecast', [
            'id' => Schema::TYPE_PK,
            'city_id' => Schema::TYPE_BIGINT,
            'temperature' => Schema::TYPE_DECIMAL . '(3,1)',
            'created_at' => Schema::TYPE_DATETIME
        ]);

        $this->addForeignKey(
            'f-foreign-city',
            'forecast',
            'city_id',
            'cities',
            'id',
            'CASCADE');
    }

    public function down()
    {
        $this->dropTable('forecast');
    }
}
