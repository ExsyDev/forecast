<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200218_181136_forecast
 */
class m200218_180113_countries extends Migration
{
    public function up()
    {
        $this->createTable('countries', [
            'id' => Schema::TYPE_BIGPK,
            'name' => Schema::TYPE_STRING,
        ]);
    }

    public function down()
    {
        $this->dropTable('countries');
    }
}