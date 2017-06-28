<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\bmd\models\Bonemass */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="row" >
    <div class="col-md-12">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">ลงผล BMD ค่า T-score HN: <?= $hn ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool"  id="taf" data-dismiss="modal"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                <?php $form = ActiveForm::begin(); ?>


                <?= $form->field($model, 'hn')->hiddenInput(['maxlength' => true, 'value' => $hn])->label(FALSE); ?>
                <?= $form->field($model, 'vn')->hiddenInput(['maxlength' => true, 'value' => $vn])->label(FALSE); ?>
                <?= $form->field($model, 'vstdate')->hiddenInput(['maxlength' => true, 'value' => $vstdate])->label(FALSE); ?>

                <div class="row">
                    <div class="col-lg-4">
                        <?= $form->field($model, 'l1l4')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <?= $form->field($model, 'neck_lt')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-4">
                        <?= $form->field($model, 'neck_rt')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <?= $form->field($model, 'troch_lt')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-4">
                        <?= $form->field($model, 'troch_rt')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>






                <?= $form->field($model, 'create_date')->hiddenInput(['maxlength' => true, 'value' => Null])->label(FALSE); ?>


                <div class="row">
                    <div class="col-lg-4">
                        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;<button type="button"  id="del" class="btn btn-danger"  >ลบ</button> 
                    </div>
                    
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">

    <button type="button" class="btn btn-danger" id="clan" data-dismiss="modal">ปิด</button>
</div>

<?php
$script = <<< JS
        var id = $id;
$(document).ready(function() {
    if(id==0){
        document.getElementById("del").disabled = true; 
    }
});
        
    //----------- ปุ่มปิด -------------------------       
$('#taf').click(function() {
                    
                           window.location='./index.php?r=bmd&date1=' + '$date1' +'&date2='+ '$date2';
                });
        
 //----------- ปุ่มปิด -------------------------   
$('#clan').click(function() {
                    
                           window.location='./index.php?r=bmd&date1=' + '$date1'+'&date2='+ '$date2';
                });
        
      $('#del').click(function() {
       
        $.ajax({
                type: 'POST', url: './index.php?r=bmd/default/delbmd&id='+id, dataType: 'json',
                    data: {


                    }, success: function(se) {
                        if(se>0){

                          alert('ลบเรียบร้อยแล้ว'); 
                          
                    }             
                     }
            });
        
        
      });
                 
            
            
   
JS;
$this->registerJs($script);
?>

