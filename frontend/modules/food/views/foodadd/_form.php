<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\Url;
use lavrentiev\widgets\toastr\Notification;
/* @var $this yii\web\View */
/* @var $model app\models\FoodDetail01 */
/* @var $form yii\widgets\ActiveForm */
//$ward = '64';
date_default_timezone_set('Asia/Bangkok');
$timet = date('H.i')*1;
echo $timet;
?>
<div class="row" >
    <div class="col-md-12">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">ข้อมูลทั้วไป</h3>

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

<div class="row" >
    <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">กำหนดการสั่งอาหาร</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <?php $form = ActiveForm::begin(['id' => 'foodF']); ?>

                <?= $form->field($model, 'foodid')->hiddenInput(['maxlength' => true, 'value' => NULL])->label(FALSE); ?>
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
                            'dateFormat' => 'yyyy-MM-dd',
                            'options' => ['class' => 'form-control', 'value' => date('Y-m-d'),],
                            'clientOptions' => [
                                //'value' => '2015-01-01',
                                //'defaultDate' => '2016-01-01',
                                'todayHighlight' => true,
                                'autoclose' => true,
                                'dateFormat' => 'yy-mm-dd'
                            ],
                            'value' => date('Y-m-d'),]);
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
                        $form->field($model, 'icode')->widget(Select2::className(), [
                            //'initValueText' => 'ssss',
                            //'value' => '5000025',
                            'data' =>
                            ArrayHelper::map(app\models\NutritionItems::find()->all(), 'icode', 'name'),
                            'options' => [
                                'placeholder' => '<--คลิก/พิมพ์เลือก-->',
                            //'value' => '5000025',
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
                <div class="raw">
                    <div class="col-lg-4">
                        <?=
                        $form->field($model, 'Congenital_disease')->widget(Select2::className(), ['data' =>
                            ArrayHelper::map(app\models\NurCongenitalDisease::find()->all(), 'name', 'name'),
                            'options' => [
                                'placeholder' => '<--คลิก/พิมพ์เลือก-->'],
                            'value' => 'sssss',
                            'pluginOptions' =>
                                [
                                'allowClear' => true
                            ],
                        ]);
                        ?> 
                    </div>
                    <div class="col-lg-4">
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
                    <div class="col-lg-4">
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

                <div class="raw">

                    <div class="col-lg-12">
                        <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                    </div>



                </div>
                <br>

                <div class="row">
                    <div class="col-lg-6">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= Html::submitButton($model->isNewRecord ? 'เพิ่ม' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'addt']) ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;<button type="button"  id="editf" class="btn btn-warning" onclick="link1()" disabled>แก้ไข</button> 
                        &nbsp;&nbsp;&nbsp;&nbsp;<button type="button"  id="dis" class="btn btn-danger"  >จำหน่าย</button> 
                    </div>
                </div>
                <?php ActiveForm::end(); ?>


            </div>
        </div>
    </div>
</div>

<div class="row" >
    <div class="col-md-12">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">ประวัติการสั่งอาหาร</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">

                <?php
                $gridColumns = [
                        ['class' => 'kartik\grid\SerialColumn'],
                        [
                        'attribute' => 'fooddate',
                        'label' => 'วันที่สั่งอาหาร'
                    ],
                        [
                        'attribute' => 'foodtime',
                        'label' => 'เวลาสั่งอาอาร'
                    ], /* [
                      'attribute' => 'wname',
                      'header' => 'ward'
                      ], */
                        [
                        'attribute' => 'nname',
                        'label' => 'รายการอาหาร'
                    ],
                        [
                        'attribute' => 'staff',
                        'label' => 'ผู้บันทึก'
                    ],
                        [
                        'attribute' => 'Congenital_disease',
                        'label' => 'โรคประจำตัว'
                    ],
                        [
                        'attribute' => 'comment',
                        'label' => 'หมายเหตุ'
                    ],
                        [
                        'attribute' => 'bd',
                        'label' => 'สูตร'
                    ],
                        [
                        'attribute' => 'cal',
                        'label' => 'ความเข้มข้น'
                    ],
                        [
                        'attribute' => 'foodid',
                        'label' => 'แก้ไข',
                        'value' => function($model, $key) {
                            $foodid = $model['foodid'];
                            $an = $model['an'];
                            $bed = $model['bedno'];
                            $fooddate = $model['fooddate'];
                            $foodtime = $model['foodtime'];
                            $hn = $model['hn'];
                            $icode = $model['icode'];
                            $ward = $model['ward'];
                            return Html::a("<i class='fa fa-pencil-square-o'></i>", ['/food', 'id' => $foodid], [
                                        //'data-confirm' => Yii::t('yii', 'คุณต้องการลบ ' . $an . ' วันที่ ' . $fooddate . ' เวลา ' . $foodtime . ' นี้หรือไม่'),
                                        'class' => ['edit', 'id' => 1],
                                        'title' => 'สั่งอาหาร',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#modalvote11',
                                        'data-whatever' => $foodid,
                            ]);
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    ],
                        [
                        'attribute' => 'foodid',
                        'label' => 'ลบ',
                        'value' => function($model, $key) {
                            $foodid = $model['foodid'];
                            $an = $model['an'];
                            $bed = $model['bedno'];
                            $fooddate = $model['fooddate'];
                            $foodtime = $model['foodtime'];
                            $hn = $model['hn'];
                            $icode = $model['icode'];
                            $ward = $model['ward'];
                            return Html::a("<i class='fa fa-window-close'></i>", ['/food', 'foodid' => $foodid, 'tstatus' => 'd',
                                        'an' => $an, 'icode' => $icode, 'hn' => $hn, 'ward' => $ward, 'modal' => 1], [
                                        'data-confirm' => Yii::t('yii', 'คุณต้องการลบ ' . $an . ' วันที่ ' . $fooddate . ' เวลา ' . $foodtime . ' นี้หรือไม่'),
                                        'class' => 'delete'
                            ]);
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    ],
                ];

                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'rowOptions' => function($model) {
                        $url = Url::to(['controller/action', 'id' => $model['foodid']]);
                        $id = $model['foodid'];
                        $an = $model['an'];
                        $fooddate = $model['fooddate'];
                        $foodtime = $model['foodtime'];
                        $icode = $model['icode'];
                        $Congenital_disease = $model['Congenital_disease'];
                        $bd = $model['bd'];
                        $cal = $model['cal'];
                        $comment = $model['comment'];
                        return [
                            'onclick' => "edit($id,$an,'$fooddate','$foodtime','$icode','$Congenital_disease','$bd','$cal','$comment')"
                        ];
                    },
                    'autoXlFormat' => true,
                    'columns' => $gridColumns,
                    'resizableColumns' => true,
                    'pjaxSettings' => [
                        'neverTimeout' => true,
                    ],
                ]);
                ?>


            </div>
        </div>
    </div>
</div>
<div class="modal-footer">

    <button type="button" class="btn btn-danger" id="clan" data-dismiss="modal">ปิด</button>


    

    <?php
    $script = <<< JS
        
//------------ บุ่มเพิ่ม --------------------
 var an = $an;
 document.getElementById("addt").disabled = false;    
 //document.getElementById("fooddetail01-cal").disabled = true; 
 $(document).ready(function() {
     
        
        
   //-------- เช็คว่าวันนี้มีการสั่งอาหารแล้วหรือยัง -------------------     
   $.ajax({
            type: 'POST', url: './index.php?r=food/foodadd/btnadd&an='+an, dataType: 'json',
                data: {
                    
                    
                }, success: function(se) {
                    if(se>0){
                       document.getElementById("addt").disabled = true; 
                      alert('วันนี้มีการสั่งอาหารแล้ว');      
        }             
                 }
        }); 
        
    //-------- เช็คว่าสั่งจำหน่ายแล้วหรือยัง -------------------      
    $.ajax({
            type: 'POST', url: './index.php?r=food/foodadd/btndis2&an='+an, dataType: 'json',
                data: {
                    
                    
                }, success: function(se) {
                    if(se>0){
                        //document.getElementById('dis').style.visibility = 'hidden';
                       //document.getElementById("dis").disabled = true; 
                       document.getElementById("dis").firstChild.data  = "ยกเลิกจำหน่าย"; 
        }             
                 }
        }); 
        
   
});
 //----------- ปุ่มปิด -------------------------       
$('#taf').click(function() {
                    
                           window.location='./index.php?r=food&ward=' + $ward +'&modal=1';
                });
        
 //----------- ปุ่มปิด -------------------------   
$('#clan').click(function() {
                    
                           window.location='./index.php?r=food&ward=' + $ward+'&modal=1';
                });
        
        
//---------  ปุ่มแก้ไข ----------------------------------------        
   $('#edit').click(function() {
                    
                          console.log(document.location);
    });
   $('#fooddetail01-icode').change(function() {
        //alert('ddd');
       });
        
 //---------------- การกดแก้ไข ---------------------
  function edit(id,an,fooddate,foodtime,icode,Congenital_disease,bd,cal,comment){
        
         document.getElementById("fooddetail01-foodid").value = id;
         document.getElementById("fooddetail01-fooddate").value = fooddate;
         document.getElementById("fooddetail01-foodtime").value = foodtime;
         document.getElementById("fooddetail01-icode").value = icode;
         document.getElementById("fooddetail01-congenital_disease").value = Congenital_disease;
         document.getElementById("fooddetail01-comment").value = comment;
         document.getElementById("fooddetail01-bd").value = bd;
        document.getElementById("fooddetail01-cal").value = cal;
        
        
        document.getElementById("addt").disabled = true;
        document.getElementById("editf").disabled = false;
        
      
       
        
        
};   
        
        
        function link1(){
            var foodid = document.getElementById("fooddetail01-foodid").value;
            var icode = document.getElementById("fooddetail01-icode").value ;
            var cd = document.getElementById("fooddetail01-congenital_disease").value ;
            var comment = document.getElementById("fooddetail01-comment").value;
            var bd = document.getElementById("fooddetail01-bd").value;
            var cal = document.getElementById("fooddetail01-cal").value;
            console.log(cd);
            
        
        
        $.ajax({
            type: 'POST', url: './index.php?r=food/foodadd/update&id='+foodid+'&icode='+icode+'&cd='+cd+'&comment='+comment+'&bd='+bd+'&cal='+cal, dataType: 'json',
                data: {
                    
                    
                }, success: function(se) {
                    if(se>0){
                      alert('แก้ไขเรียบร้อยแล้ว');      
        }              window.location='./index.php?r=food&ward=' + $ward +'&modal=1';
                 }
        }); 

        
        };
        
 
 //-------------------- ปุ่มจำหน่าย ------------------------------------------
 $('#dis').click(function() {
        var tcheck = document.getElementById("dis").firstChild.data;
        if(tcheck=='ยกเลิกจำหน่าย'){
           $.ajax({
                type: 'POST', url: './index.php?r=food/foodadd/btndiscan&an='+an, dataType: 'json',
                    data: {


                    }, success: function(se) {
                        if(se>0){

                          alert('ยกเลิกจำหน่ายเรียบร้อยแล้ว'); 
                          document.getElementById("dis").firstChild.data  = "จำหน่าย";
                    }             
                     }
            }); 
        
        }else {
            $.ajax({
                type: 'POST', url: './index.php?r=food/foodadd/btndis&an='+an, dataType: 'json',
                    data: {


                    }, success: function(se) {
                        if(se>0){

                          alert('จำหน่ายเรียบร้อยแล้ว'); 
                          document.getElementById("dis").firstChild.data  = "ยกเลิกจำหน่าย";
                          //document.getElementById('dis').style.visibility = 'hidden';
                          //document.getElementById("dis").disabled = true; 
                    }             
                     },err(){
                        console.log('ddd');
                }
            }); 
   
        }
     
        
 });
    
        

   
JS;
    $this->registerJs($script);
    ?>



