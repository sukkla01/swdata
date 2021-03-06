<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\widgets\Select2;
use app\modules\oapp\models\OappPttype;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\oapp\models\OappEvent */
/* @var $form yii\widgets\ActiveForm */
$tdate = $model->created_date;
$cdate = date('Y-m-d');
$holidays = $holiday;
$hols = $hol;
$text1 = "";
$text2 = "";
$text3 = "";

//$pttype=$pttype-1;


$sql = "SELECT  DATEDIFF('$tdate',curdate()) ";
$command = Yii::$app->db5->createCommand($sql);
$datediff = $command->queryScalar();

if ($tlimit > 4) {
    $text1 = "!!มีการนัดจำนวนเต็มแล้ว";
}
if ($hol <> '') {
    $text2 = " !!เป็นวันหยุด " . $hol;
}
if ($datediff < 2) {
    $text3 = " !!ควรนัดก่อน 2 วัน";
}

$text_total = $text1 . $text2 . $text3;
?>
<?php if ($tlimit > 4 OR $hol <> '' OR $datediff < 2) { ?>


    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon  fa fa-ban"></i> Alert!</h4>
    <?= $text_total ?>
    </div>
<?php } ?>



<div class="row" >
    <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">




<?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-3">
<?= $form->field($model, 'hn')->textInput(['maxlength' => true, 'value' => $hn]) ?> 
                    </div>
                    <div class="col-md-4">
<?= $form->field($model, 'cid')->textInput(['maxlength' => true, 'value' => $cid]) ?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
<?= $form->field($model, 'tname')->textInput(['value' => $tname]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?=
                        $form->field($model, 'pttype')->widget(Select2::className(), [
                            'data' =>
                            ArrayHelper::map(OappPttype::find()->all(), 'id', 'name'),
                            'options' => [
                                'placeholder' => '<--คลิก/พิมพ์เลือก-->',
                                'value' => $pttype,
                            //'onchange' => 'alert (this.value)',
                            ],
                            'pluginOptions' =>
                                [
                                'allowClear' => true
                            ],
                        ]);
                        ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
<?= $form->field($model, 'tel')->textInput(['maxlength' => true, 'value' => $tel]) ?>
                    </div>
                    <div class="col-md-9">
                        <br>
                        <br><code>* ติดต่องาน หู คอ จมูก ได้ที่เบอร์โทร  055-682030-42 ต่อ 142 </code>
                    </div>
                </div>


                <?=
                $form->field($model, 'created_date')->widget(
                        DatePicker::className(), [
                    'language' => 'th',
                    'inline' => FALSE,
                    //'dateFormat' => 'yyyy-MM-dd',
                    'options' => ['class' => 'form-control', 'value' => $create_date],
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
<?= $form->field($model, 'pttype_name')->hiddenInput(['maxlength' => true, 'value' => NULL])->label(FALSE); ?>


                <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'addt', 'name' => 'btnadd']) ?>
                    <button type="button"  id="ett" class="btn bg-purple margin"  ><i class="fa fa-edit">&nbsp;แก้ไข</i></button> 
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
        var dayname = '$hols';
        var tt = '$tdate';
        var datediff ='$datediff';
        
        var type = '$type';
        var id=$id;
        
     $(document).ready(function() {
        
         if($update1==1){
            //alert($update1);
            document.getElementById("ett").disabled = false;
            document.getElementById("addt").disabled = true;
        }else{
             document.getElementById("ett").disabled = true;
            document.getElementById("addt").disabled = false;
        }
      });   
        
    $('#ett').click(function() {
            var hn = document.getElementById("oappevent-hn").value;
            var cid = document.getElementById("oappevent-cid").value ;
            var tname = document.getElementById("oappevent-tname").value ;
            var pttype = document.getElementById("oappevent-pttype").value;
            var tel = document.getElementById("oappevent-tel").value;
            var cdate = document.getElementById("oappevent-created_date").value;
            
            if(cdate==''){
                cdate ='2017-01-01';
            }
        
           
        
            $.ajax({
                   type: 'GET', url: './index.php?r=oapp/oappevent/updateoapp&id='+id+'&hn='+hn+'&cid='+cid+'&tname='+tname+'&pttype='+pttype+'&tel='+tel+'&cdate='+cdate, dataType: 'json',
                       data: {


                       }, success: function(se) {
                           if(se>0){
                              alert('แก้ไขเรียบร้อยแล้ว');
                              window.location='./index.php?r=oapp/oappevent/oedit&cid=' + cid +'&id='+id;
                        }             
                      }
               }); 

    });   
        
    $('#oappevent-created_date').change(function() {  
        var createdate = document.getElementById("oappevent-created_date").value;
         if(createdate<=cdate){
            $("#oappevent-created_date").val('');
            alert('นัดย้อนหลังไม่ได้');
        }
         
       
     });
        
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
        $.ajax({
                   type: 'POST', url: './index.php?r=oapp/oappevent/holiday&tdate='+tdate, dataType: 'json',
                       data: {


                       }, success: function(se) {
                           if(se>0){
                              alert('$hol');
                              $("#oappevent-hn").val('');
                        }             
                      }
               }); 
    });
        
   if(type=='0'){     
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
        if(datediff < 2 ){
            alert('ควรนัดก่อน 2 วัน');
            $("#oappevent-hn").val('');
           
        }
        
        
        
        
    });  
        }
        
    /*$('#oappevent-cid').change(function() {
        var cid = document.getElementById("oappevent-cid").value;
        if(cid>=0 ){
            alert('5555');
        }
    });*/
        
        
  
   

   
JS;
$this->registerJs($script);
?>
                