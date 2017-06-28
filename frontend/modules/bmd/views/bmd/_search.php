<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\bmd\models\BonemassSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bonemass-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'hn') ?>

    <?= $form->field($model, 'vstdate') ?>

    <?= $form->field($model, 'vn') ?>

    <?= $form->field($model, 'l1l4') ?>

    <?php // echo $form->field($model, 'neck_lt') ?>

    <?php // echo $form->field($model, 'neck_rt') ?>

    <?php // echo $form->field($model, 'troch_lt') ?>

    <?php // echo $form->field($model, 'troch_rt') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
