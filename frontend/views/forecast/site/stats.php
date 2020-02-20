<?php

$this->title = 'forecast - Statistics';
$this->params['breadcrumbs'][] = 'Statistics';

?>

<div class="panel panel-default">
    <div class="panel-heading">
        Search
    </div>
    <form id="form-StatsForm" action="/forecast/site/stats" method="GET"> <div class="panel-body row">
            <div class="col-xs-2">
                <div class="form-group">
                    <label class="control-label" for="StatsForm_start">Start</label> <div class="input-group dtp">
                        <input class="form-control" readonly="readonly" name="StatsForm[start]" id="StatsForm_start" type="text" value="19.02.2020"> <span class="input-group-addon">
<span class="glyphicon-calendar glyphicon"></span>
</span>
                    </div>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <label class="control-label" for="StatsForm_end">End</label> <div class="input-group dtp">
                        <input class="form-control" readonly="readonly" name="StatsForm[end]" id="StatsForm_end" type="text" value="20.02.2020"> <span class="input-group-addon">
<span class="glyphicon-calendar glyphicon"></span>
</span>
                    </div>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <button type="submit" class="btn btn-success" style="margin-top: 25px"><span class="glyphicon glyphicon-search"></span> Search</button> </div>
            </div>
        </div></form>
</div>
