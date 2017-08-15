<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rreport\models\ReportRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'detail') ?>

    <?= $form->field($model, 'user') ?>

    <?= $form->field($model, 'header') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'date_line') ?>

    <?php // echo $form->field($model, 'staff') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
