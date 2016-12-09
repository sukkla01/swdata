<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FingerDownloadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="finger-download-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'month') ?>

    <?= $form->field($model, 'file1') ?>

    <?= $form->field($model, 'file2') ?>

    <?= $form->field($model, 'file3') ?>

    <?php // echo $form->field($model, 'file4') ?>

    <?php // echo $form->field($model, 'note1') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
