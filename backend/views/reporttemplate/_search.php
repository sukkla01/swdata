<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReporttemplateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reporttemplate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'reportname') ?>

    <?= $form->field($model, 'module') ?>

    <?= $form->field($model, 'modulename') ?>

    <?= $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'staff') ?>

    <?php // echo $form->field($model, 'tsql') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
