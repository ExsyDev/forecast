<?php
namespace frontend\controllers\forecast;

use yii\web\Controller;
use Yii;
use common\models\Forecast;
use common\models\City;
use yii\helpers\Html;

/**
 * forecast controller
 */
class SiteController extends Controller
{
    /**
     * Display stats
     *
     * @return mixed
     */
    public function actionStats()
    {
        return $this->render('stats', [
            'dateStart' => Yii::$app->formatter->asDate('-1 day', 'php:d.m.Y'),
            'dateEnd' => Yii::$app->formatter->asDate('now', 'php:d.m.Y')
        ]);
    }

    public function actionHistory($city = null)
    {
        $currentCity = [];

        if (!empty($city)) {
            $currentCity = City::getCityByName($city);
        } else {
            return $this->redirect('/404');
        }

        if (empty($data['error']) && empty($currentCity)) {
            $data['error'] = 'Sorry, but history for select city doesn\'t exists!';
        }

        $data['city'] = $currentCity;

        if($city) {
            $forecasts = Forecast::getForecastByCityId($currentCity['id']);

            foreach ($forecasts as $forecast) {
                $date = Yii::$app->formatter->asDate($forecast['created_at'], 'php:M d, Y');
                $data['forecasts'][$date][] = $forecast;
            }
        }

        return $this->render('history', $data);
    }

    public function actionDatatablesStatistics()
    {
        $request = Yii::$app->request;

        $forecasts = [];
        $dateStart = Yii::$app->formatter->asDate($request->post('date_start'), 'YYYY-MM-dd');
        $dateEnd = Yii::$app->formatter->asDate($request->post('date_end'), 'YYYY-MM-dd');
        $totalForecasts = Forecast::getCountForecastByInterval($dateStart, $dateEnd);

        if (!empty($totalForecasts)) {

            $forecasts = Forecast::getForecastByInterval($dateStart, $dateEnd, $request->post('length'), $request->post('start'));
        }

        $output = [
            "draw" => $request->post('draw'),
            "recordsTotal" => $totalForecasts,
            "recordsFiltered" => count($forecasts),
            "data" => []
        ];

        $symbol = '&#8451;';

        if (!empty($forecasts)) {
            foreach ($forecasts as $forecast) {
                $output['data'][] = [
                    'country' => $forecast['city']['country']['name'],
                    'city' => $forecast['city']['city'],
                    'max_temperature' => self::convertFahrenheitToCelsius($forecast['max']) . Html::decode($symbol),
                    'min_temperature' => self::convertFahrenheitToCelsius($forecast['min']) . Html::decode($symbol),
                    'avg_temperature' => self::convertFahrenheitToCelsius($forecast['avg']) . Html::decode($symbol),
                    'actions' => '',
                ];
            }
        }

        return $this->asJson($output);
    }

    public static function convertFahrenheitToCelsius($value)
    {
        return (($value - 32) * 5) / 9;
    }
}
