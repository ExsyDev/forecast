<?php

namespace console\controllers;

use common\models\Cities;
use common\models\City;
use common\models\Forecast;

class ForecastController extends \yii\console\Controller
{
    protected $forecastURL = 'http://quiz.dev.travelinsides.com/forecast/api/getForecast?start=%s&end=%s&city=%s';

    public $start;
    public $end;
    public $city;

    public function options($actionID)
    {
        return ['city', 'start', 'end'];
    }

    public function optionAliases()
    {
        return [
            'city' => 'city',
            'start' => 'date:d.m.Y',
            'end' => 'date:d.m.Y'
        ];
    }

    public function actionIndex()
    {
        $client = new \GuzzleHttp\Client();

        $currentCity = City::find()->where(['city' => $this->city])->one();

        if (!$currentCity && empty($currentCity)) {
            exit('Sorry, but select city doesn\'t fount!');
        }

        $fXML = (string) $client->get(sprintf($this->forecastURL,
            $this->start,
            $this->end,
            $currentCity->city
        ))->getBody();

        $forecasts = new \SimpleXMLElement($fXML);
        $count = 0;

        foreach ($forecasts as $forecast) {
            try {

                $ts = date('Y-m-d H:i:s', (int)$forecast->ts);

                $duplicateCheck = Forecast::find()
                    ->joinWith('cities')
                    ->where(['cities.city' => $forecast->city])
                    ->where(['created_at' => $ts])
                    ->exists();

//                var_dump($duplicateCheck); exit;

                if($duplicateCheck)
                    continue;

                $fcast = new Forecast();
                $fcast->city_id = $currentCity->id;
                $fcast->temperature = (float)$forecast->temperature;
                $fcast->created_at = $ts;
                $fcast->save();

                $count++;
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }

        echo "Saved records: " . $count . "\n";
    }
}