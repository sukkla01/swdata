<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FingerDownload */

$this->title = 'Update Finger Download: ' . $model->year;
$this->params['breadcrumbs'][] = ['label' => 'Finger Downloads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->year, 'url' => ['view', 'year' => $model->year, 'month' => $model->month]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="finger-download-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
