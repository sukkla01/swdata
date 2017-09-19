<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Research */
/* @var $form yii\widgets\ActiveForm */
$cdate = date('Y-m-d');
?>

<div class="research-form">

    <?php $form = ActiveForm::begin(); ?>

    
     <?= $form->field($model, 'id')->hiddenInput(['maxlength' => true, 'value' => NULL])->label(FALSE); ?>

    <?= $form->field($model, 'projectname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'research_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_no')->textInput() ?>

    <?= $form->field($model, 'dept')->textInput(['maxlength' => true]) ?>

    
     <?=$form->field($model, 'date_comfirm')->widget(
                        DatePicker::className(), [
                    'language' => 'th',
                    'inline' => FALSE,
                    //'dateFormat' => 'yyyy-MM-dd',
                    'options' => ['class' => 'form-control', 'value' => $cdate],
                    'clientOptions' => [
                        //'value' => '2015-01-01',
                        'todayHighlight' => true,
                        'autoclose' => true,
                        'dateFormat' => 'yy-mm-dd'
                    ],
                ]);
                ?>

    <?= $form->field($model, 'note1')->textInput(['maxlength' => true]) ?>

   
     <?= $form->field($model, 'note2')->hiddenInput(['maxlength' => true, 'value' => NULL])->label(FALSE); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
