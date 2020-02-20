<?php
namespace frontend\controllers\forecast;

use yii\web\Controller;

/**
 * forecast controller
 */
class SiteController extends Controller
{
    /**
     * Displays stats.
     *
     * @return mixed
     */
    public function actionStats()
    {
        return $this->render('stats');
    }
}
