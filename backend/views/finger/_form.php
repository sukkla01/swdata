<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\FingerDownload */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="finger-download-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'month')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'file1')->widget(FileInput::classname(), [
    //'options' => ['accept' => 'image/*'],
    'pluginOptions' => [
        'initialPreview'=>[],
        'allowedFileExtensions'=>['pdf'],
        'showPreview' => true,
        'showRemove' => true,
        'showUpload' => true
     ]
]); ?>
    
    <?= $form->field($model, 'file2')->widget(FileInput::classname(), [
    //'options' => ['accept' => 'image/*'],
    'pluginOptions' => [
        'initialPreview'=>[],
        'allowedFileExtensions'=>['pdf'],
        'showPreview' => false,
        'showPreview' => true,
        'showUpload' => false
     ]
]); ?>
    
    <?= $form->field($model, 'file3')->widget(FileInput::classname(), [
    //'options' => ['accept' => 'image/*'],
    'pluginOptions' => [
        'initialPreview'=>[],
        'allowedFileExtensions'=>['pdf'],
        'showPreview' => true,
        'showRemove' => true,
        'showUpload' => false
     ]
]); ?>
    
    <?= $form->field($model, 'file4')->widget(FileInput::classname(), [
    //'options' => ['accept' => 'image/*'],
    'pluginOptions' => [
        'initialPreview'=>[],
        'allowedFileExtensions'=>['pdf'],
        'showPreview' => true,
        'showRemove' => true,
        'showUpload' => false
     ]
]); ?>

   

    <?= $form->field($model, 'note1')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
