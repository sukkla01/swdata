<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TmpThaicvriskSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tmp-thaicvrisk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'vstdate') ?>

    <?= $form->field($model, 'hn') ?>

    <?= $form->field($model, 'vn') ?>

    <?= $form->field($model, 'tname') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'bp') ?>

    <?php // echo $form->field($model, 'tc') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'is_dm') ?>

    <?php // echo $form->field($model, 'smoker') ?>

    <?php // echo $form->field($model, 'waist') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'tcolor') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
