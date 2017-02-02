<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\FoodDetail01 */
/* @var $form yii\widgets\ActiveForm */
$ward = '64';
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
<?php $form = ActiveForm::begin(['id'=>'foodF']); ?>


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
                            'options' => ['class' => 'form-control', 'value' => '2015-01-01',],
                            'clientOptions' => [
                                //'value' => '2015-01-01',
                                //'defaultDate' => '2016-01-01',
                                'todayHighlight' => true,
                                'autoclose' => true,
                                'dateFormat' => 'yyyy-mm-dd'
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
                            'initValueText' => 'ssss',
                            'value' => '1',
                            'data' =>
                            ArrayHelper::map(app\models\NutritionItems::find()->all(), 'icode', 'name'),
                            'options' => [
                                'placeholder' => '<--คลิก/พิมพ์เลือก-->',
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
                    /* [
                      'attribute' => 'foodid',
                      'label' => 'แก้ไข',
                      'value' => function($model, $key) {
                      $foodid = $model['foodid'];
                      $an = $model['an'];
                      $bed = $model['bedno'];
                      $fooddate = $model['fooddate'];
                      $foodtime = $model['foodtime'];
                      return Html::a("<i class='fa fa-pencil'></i>", ['', 'foodid' => $foodid,
                      'an' => $an, 'bed' => $bed, 'tstatus' => 'e'], [
                      ]);
                      },
                      'filterType' => GridView::FILTER_COLOR,
                      'hAlign' => 'middle',
                      'format' => 'raw',
                      ], */
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
                        $id= $model['foodid']   ;
                         $an=$model['an'];
                        $fooddate=$model['fooddate'];
                        $foodtime=$model['foodtime'];
                        $icode=$model['icode'];
                        $Congenital_disease=$model['Congenital_disease'];
                        $bd=$model['bd'];
                        $cal=$model['cal'];
                        $comment=$model['comment'];
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
</div>


<?php
$script = <<< JS
$('#taf').click(function() {
                    
                           window.location='./index.php?r=food&ward=' + $ward +'&modal=1';
                });
   $('#clan').click(function() {
                    
                           window.location='./index.php?r=food&ward=' + $ward+'&modal=1';
                });
        
   $('#edit').click(function() {
                    
                          console.log(document.location);
                });
        
  function edit(id,an,fooddate,foodtime,icode,Congenital_disease,bd,cal,comment){
        //document.getElementById("fooddetail01-comment").setAttribute('value','My default value');
        document.getElementById("fooddetail01-comment").value = comment;
        //console.log(current);
       // console.log(an);
}      
    
        
function init_click_handlers(){
  $(".edit").click(function() {
      // lol = document.getElementById('lolz');
  console.log(document.getElementById('gg'));
  });

  }
  init_click_handlers(); 
JS;
$this->registerJs($script);
?>



