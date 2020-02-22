<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200218_181136_forecast
 */
class m200218_180134_cities extends Migration
{
    public function up()
    {
        $this->createTable('cities', [
            'id' => Schema::TYPE_BIGPK,
            'country_id' => Schema::TYPE_BIGINT,
            'city' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('cities');
    }
}
