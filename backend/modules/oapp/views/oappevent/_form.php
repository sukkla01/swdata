<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\oapp\models\OappEvent */
/* @var $form yii\widgets\ActiveForm */
$tdate = $model->created_date;
$cdate = date('Y-m-d');
$holidays = $holiday;
?>
<?php if ($tlimit > 4) { ?>


    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon  fa fa-ban"></i> Alert!</h4>
        มีการนัดจำนวนเต็มแล้ว
    </div>
<?php } ?>




<div class="row" >
    <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body">




                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'hn')->textInput(['maxlength' => true]) ?> 
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'cid')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>




                <?= $form->field($model, 'tname')->textInput() ?>

                <?= $form->field($model, 'pttype')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

                <?=
                $form->field($model, 'created_date')->widget(
                        DatePicker::className(), [
                    'language' => 'th',
                    'inline' => FALSE,
                    //'dateFormat' => 'yyyy-MM-dd',
                    'options' => ['class' => 'form-control'],
                    'clientOptions' => [
                        //'value' => '2015-01-01',
                        'todayHighlight' => true,
                        'autoclose' => true,
                        'dateFormat' => 'yy-mm-dd'
                    ],
                ]);
                ?>

                <?= $form->field($model, 'note1')->hiddenInput(['maxlength' => true, 'value' => NULL])->label(FALSE); ?>
                <?= $form->field($model, 'note2')->hiddenInput(['maxlength' => true, 'value' => NULL])->label(FALSE); ?>
                <?= $form->field($model, 'note3')->hiddenInput(['maxlength' => true, 'value' => NULL])->label(FALSE); ?>
                <?= $form->field($model, 'spclty')->hiddenInput(['maxlength' => true, 'value' => '07'])->label(FALSE); ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name' => 'btnadd']) ?>
                </div>

                <?php ActiveForm::end(); ?>



            </div>
        </div>
    </div>
</div>



<?php
$script = <<< JS
        
        var tdate ='$tdate';
        var cdate ='$cdate';
        var holiday = '$holidays';
    $('#oappevent-hn').change(function() {
        $.ajax({
                   type: 'POST', url: './index.php?r=oapp/oappevent/limit&tdate='+tdate, dataType: 'json',
                       data: {


                       }, success: function(se) {
                           if(se>5){
                              alert('วันนี้นัดคนไข้เต็มแล้ว');
                              $("#oappevent-hn").val('');
                        }             
                      }
               }); 
    });
        
        
   $('#oappevent-hn').change(function() {
        if(tdate<=cdate){
            $("#oappevent-hn").val('');
            alert('นัดย้อนหลังไม่ได้');
        }
        if (holiday=='sat'){
            $("#oappevent-hn").val('');
            alert('นัดวันหยุด เสาร์-อาทิตย์ ไม่ได้');
        }
        if (holiday=='sun'){
            $("#oappevent-hn").val('');
            alert('นัดวันหยุด เสาร์-อาทิตย์ ไม่ได้');
        }
    });  
        
    /*$('#oappevent-cid').change(function() {
        var cid = document.getElementById("oappevent-cid").value;
        if(cid>=0 ){
            alert('5555');
        }
    });*/
        
        
  
   

   
JS;
$this->registerJs($script);
?>
                