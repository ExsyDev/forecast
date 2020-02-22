<?php

/* @var $this yii\web\View */

$this->title = 'Statistics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Search
    </div>
    <form>
        <div class="panel-body row">
            <div class="col-xs-2">
                <div class="form-group">
                    <label class="control-label" for="date_start">Start</label>
                    <div class="input-group dtp">
                        <input class="form-control" readonly="readonly" name="date[start]" id="date_start" type="text" value="<?= $dateStart; ?>">
                        <span class="input-group-addon">
                            <span class="glyphicon-calendar glyphicon"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <label class="control-label" for="date_end">End</label>
                    <div class="input-group dtp">
                        <input class="form-control" readonly="readonly" name="date[end]" id="date_end" type="text" value="<?= $dateEnd; ?>">
                        <span class="input-group-addon">
                            <span class="glyphicon-calendar glyphicon"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <button type="submit" class="btn btn-success mt-25 filter-statistic">
                        <span class="glyphicon glyphicon-search"></span> Search
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="base-container">
            <div class="table-responsive">
                <?= \nullref\datatable\DataTable::widget([
                    'tableOptions' => [
                        'class' => 'table table-bordered statistic-forecast',
                    ],
                    'serverSide' => true,
                    'searching' => false,
                    'ordering' =>  false,
                    'ajax' => [
                        'url' => '/forecast/site/datatables-statistics',
                        'type'=> 'POST',
                        'data' => new \yii\web\JsExpression('function(data) { ' .
                            'data.date_start =  $("#date_start").val();
                             data.date_end =  $("#date_end").val();' .
                            '}')
                    ],
                    'columns' => [
                        [
                            'data' => 'country',
                            'title' => 'Country',
                        ],
                        [
                            'data' => 'city',
                            'title' => 'City',
                        ],
                        [
                            'data' => 'max_temperature',
                            'title' => 'Max temperature',
                        ],
                        [
                            'data' => 'min_temperature',
                            'title' => 'Min temperature',
                        ],
                        [
                            'data' => 'avg_temperature',
                            'title' => 'Avg temperature',
                        ],
                        [
                            'data' => 'actions',
                            'title' => 'Actions',
                        ]
                    ],

                ]); ?>
            </div>
        </div>
    </div>
</div>