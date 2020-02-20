<?php

namespace console\controllers;

use common\models\Cities;
use common\models\Forecast;

class ForecastController extends \yii\console\Controller
{
    protected $forecastURL = 'http://quiz.dev.travelinsides.com/forecast/api/getForecast?start=%s&end=%s&city=%s';

    public $start;
    public $end;

    public function options($actionID)
    {
        return ['start', 'end'];
    }

    public function optionAliases()
    {
        return [
            'start' => 'date:d.m.Y',
            'end' => 'date:d.m.Y'
        ];
    }

    public function actionIndex()
    {
        $client = new \GuzzleHttp\Client();

        $fXML = (string) $client->get(sprintf($this->forecastURL,
            $this->start,
            $this->end,
            'Moscow'
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

                if($duplicateCheck)
                    continue;

                $fcast = new Forecast();
                $fcast->city_id = 1;
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