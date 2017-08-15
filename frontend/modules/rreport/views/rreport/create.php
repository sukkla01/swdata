<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\rreport\models\ReportRequest */

$this->title = 'Create Report Request';
$this->params['breadcrumbs'][] = ['label' => 'Report Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
