<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
?>




<?php
$form = ActiveForm::begin(['enableClientValidation' => true,
            'options' => [
                'id' => 'dynamic-form',
                'data-pjax' => true
        ]]);
?>


<div class="row" >
    <div class="col-md-12">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">กำหนดการสั่งอาหาร</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool"  id="taf" data-dismiss="modal"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-4">
                        <h4>  AN : <?= $an ?> </h4>
                    </div>
                    <div class="col-lg-7">
                        <h4>  ชื่อ-สกุล : <?= $tname ?> </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">
                        <h4>  HN : <?= $hn ?> </h4>
                    </div>
                    <div class="col-lg-2">
                        <h4>  เตียง : <?= $bed ?> </h4>
                    </div>
                    <div class="col-lg-7">
                        <h4>  สิทธิการรักษา : <?= $ptname ?> </h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?= $form->field($model, 'an')->hiddenInput(['maxlength' => true, 'value' => $an])->label(FALSE); ?>
<?= $form->field($model, 'hn')->hiddenInput(['maxlength' => true, 'value' => $hn])->label(FALSE); ?>
<?= $form->field($model, 'meal')->hiddenInput(['maxlength' => true, 'value' => 1])->label(FALSE); ?>
<?= $form->field($model, 'ward')->hiddenInput(['maxlength' => true, 'value' => $ward])->label(FALSE); ?>
<?= $form->field($model, 'fooddate_rec')->hiddenInput(['maxlength' => true, 'value' => date('dmY')])->label(FALSE); ?>
<?= $form->field($model, 'staff')->hiddenInput(['maxlength' => true, 'value' => Yii::$app->user->identity->username])->label(FALSE); ?>
<div class="raw">
    <div class="col-lg-4">

        <?=
        $form->field($model, 'fooddate')->widget(
                DatePicker::className(), [
            'language' => 'th',
            'inline' => FALSE,
            // 'value' => date('Y-m-d'),
            //'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control'],
            'clientOptions' => [
                //'value' => '2015-01-01',
                //'defaultDate' => date('Y-m-d'),
                'todayHighlight' => true,
                'autoclose' => true,
                'dateFormat' => 'yyyy-mm-dd'
        ]]);
        ?>
    </div>
    <div class="col-lg-2">
        <?=
        $form->field($model, 'foodtime')->widget(
                \kartik\time\TimePicker::className(), [
            'pluginOptions' => [
                'showSeconds' => true,
                'showMeridian' => false,
                'minuteStep' => 1,
                'secondStep' => 5,
            ]
        ]);
        ?>
    </div>
    <div class="col-lg-6">
        <?=
        $form->field($model, 'icode')->widget(Select2::className(), ['data' =>
            ArrayHelper::map(app\models\NutritionItems::find()->all(), 'icode', 'name'),
            'options' => [
                'placeholder' => '<--คลิก/พิมพ์เลือก-->'],
            'pluginOptions' =>
                [
                'allowClear' => true
            ],
        ]);
        ?> 
    </div>
</div>
<div class="raw">
    <div class="col-lg-4">
        <?=
        $form->field($model, 'Congenital_disease')->widget(Select2::className(), ['data' =>
            ArrayHelper::map(app\models\NurCongenitalDisease::find()->all(), 'name', 'name'),
            'options' => [
                'placeholder' => '<--คลิก/พิมพ์เลือก-->'],
            'pluginOptions' =>
                [
                'allowClear' => true
            ],
        ]);
        ?> 
    </div>
    <div class="col-lg-8">
        <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
    </div>
</div>

<div class="raw">
    <div class="col-lg-6">
        <?=
        $form->field($model, 'bd')->widget(Select2::className(), ['data' =>
            ArrayHelper::map(app\models\NurBd::find()->all(), 'name', 'name'),
            'options' => [
                'placeholder' => '<--คลิก/พิมพ์เลือก-->'],
            'pluginOptions' =>
                [
                'allowClear' => true
            ],
        ]);
        ?> 
    </div>


    <div class="col-lg-6">
        <?=
        $form->field($model, 'cal')->widget(Select2::className(), ['data' =>
            ArrayHelper::map(app\models\NurCal::find()->all(), 'name', 'name'),
            'options' => [
                'placeholder' => '<--คลิก/พิมพ์เลือก-->'],
            'pluginOptions' =>
                [
                'allowClear' => true
            ],
        ]);
        ?> 
    </div>

</div>
<br>

<div class="row">
    <div class="col-lg-6">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= Html::submitButton($model->isNewRecord ? 'เพิ่ม' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>


<div class="modal-footer">

    <button type="button" class="btn btn-danger" id="clan" data-dismiss="modal">Close</button>
</div>



<?php
$script = <<< JS
$('#taf').click(function() {
                    
                           window.location='./index.php?r=food&ward=' + $ward;
                });
   $('#clan').click(function() {
                    
                           window.location='./index.php?r=food&ward=' + $ward;
                });
JS;
$this->registerJs($script);
?>


