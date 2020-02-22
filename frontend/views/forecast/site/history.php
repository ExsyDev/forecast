<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use common\components\Helper;

$this->title = 'History of ' . Html::encode($city['city']) . ' (' . Html::encode($city['country']['name']) . ')';
$this->params['breadcrumbs'][] = $this->title;
$symbol = Html::decode('&#8451;');

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?= $this->title ?>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php if (!empty($forecasts)) { ?>
                <?php foreach ($forecasts as $day => $forecast) { ?>
                    <div class="col-xs-3">
                        <p>
                            <strong><?= Html::encode($day) ?></strong>
                        </p>
                        <?php foreach ($forecast as $item) {?>
                            <p>
                                <?= Yii::$app->formatter->asDate($item['created_at'], 'php:H:i:s') ?> <?= $this->context->convertFahrenheitToCelsius($item['temperature']) ?> <?= $symbol ?>
                            </p>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } elseif (!empty($error)) { ?>
                <div class="col-xs-12 text-center">
                    <?= Html::encode($error)?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>