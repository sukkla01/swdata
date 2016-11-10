<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reporttemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reporttemplate-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-12">

        <?= $form->field($model, 'reportname')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'module')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'modulename')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'staff')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-12">
         <?= $form->field($model, 'tsql')->textarea(['rows' => 6]) ?>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
