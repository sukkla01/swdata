<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ict001Ctpay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ict001-ctpay-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hos_guid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vstdate')->textInput() ?>

    <?= $form->field($model, 'rxdate')->textInput() ?>

    <?= $form->field($model, 'vn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'an')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ward')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wardname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dep_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'drugname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= $form->field($model, 'unitprice')->textInput() ?>

    <?= $form->field($model, 'pttype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pttypename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'income')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paidst')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sum_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'necessary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payprice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'command_doctor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age_y')->textInput() ?>

    <?= $form->field($model, 'CTstatus')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
