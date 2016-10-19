<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ict001CtpaySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ict001-ctpay-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'hos_guid') ?>

    <?= $form->field($model, 'vstdate') ?>

    <?= $form->field($model, 'rxdate') ?>

    <?= $form->field($model, 'vn') ?>

    <?= $form->field($model, 'hn') ?>

    <?php // echo $form->field($model, 'an') ?>

    <?php // echo $form->field($model, 'fullname') ?>

    <?php // echo $form->field($model, 'ward') ?>

    <?php // echo $form->field($model, 'wardname') ?>

    <?php // echo $form->field($model, 'dep_code') ?>

    <?php // echo $form->field($model, 'department') ?>

    <?php // echo $form->field($model, 'icode') ?>

    <?php // echo $form->field($model, 'drugname') ?>

    <?php // echo $form->field($model, 'billcode') ?>

    <?php // echo $form->field($model, 'qty') ?>

    <?php // echo $form->field($model, 'unitprice') ?>

    <?php // echo $form->field($model, 'pttype') ?>

    <?php // echo $form->field($model, 'pttypename') ?>

    <?php // echo $form->field($model, 'income') ?>

    <?php // echo $form->field($model, 'paidst') ?>

    <?php // echo $form->field($model, 'sum_price') ?>

    <?php // echo $form->field($model, 'reason') ?>

    <?php // echo $form->field($model, 'necessary') ?>

    <?php // echo $form->field($model, 'payprice') ?>

    <?php // echo $form->field($model, 'command_doctor') ?>

    <?php // echo $form->field($model, 'age_y') ?>

    <?php // echo $form->field($model, 'CTstatus') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
