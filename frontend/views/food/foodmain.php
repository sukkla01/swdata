<?php

use yii\bootstrap\Html;
use kartik\widgets\DatePicker;
//use kartik\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
?>

<div class="container" id="ttt">
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <div class="pull-left"><span style="font-weight: bold;" class="btn btn-primary btn-flat"><h5><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;โปรแกรมสั่งอาหารผู้ป่วยใน</h5></span></div>



                <div class="box-tools pull-right">

                    &nbsp;&nbsp;<a style="font-weight: bold;" class="btn btn-danger" id="btn_sql"><h5><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;สั่งอาหารเดิม</h5></a>
                    &nbsp;&nbsp;<a style="font-weight: bold;" class="btn btn-success" id="btn_sql"><h5><i class="fa fa-print"></i>&nbsp;&nbsp;พิมพ์</h5></a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                   

                <?php
                $gridColumns = [
                        ['class' => 'kartik\grid\SerialColumn'],
                        [
                        'attribute' => 'hn',
                        'label' => 'HN'
                    ],
                        [
                        'attribute' => 'an',
                        'label' => 'AN'
                    ],
                        [
                        'attribute' => 'bedno',
                        'label' => 'เตียง'
                    ],
                        [
                        'attribute' => 'tname',
                        'label' => 'ชื่อ-สกุล'
                    ],
                        [
                        'attribute' => 'regdate',
                        'label' => 'วันที่ Admit'
                    ],
                        [
                        'attribute' => 'regtime',
                        'label' => 'เวลา Admit'
                    ],
                        [
                        'attribute' => 'nname',
                        'label' => 'รายการอาหาร'
                    ],
                        [
                        'attribute' => 'fooddate',
                        'label' => 'วันที่สั่งอาหารล่าสุด',
                        'value' => function ($model, $key, $index, $widget) {
                            $cdate = date('Y-m-d');
                            if ($model['fooddate'] == $cdate) {
                                return "<font class='text-green'>" . $model['fooddate'] . "</font>";
                            } else {
                                return "<font class='text-red'>" . $model['fooddate'] . "</font>";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        [
                        'attribute' => 'congenital_disease',
                        'label' => 'โรคประจำตัว'
                    ],
                        [
                        'attribute' => 'height',
                        'label' => 'สูง'
                    ],
                        [
                        'attribute' => 'bw',
                        'label' => 'น้ำหนัก'
                    ],
                        [
                        'attribute' => 'bmi',
                        'label' => 'bmi'
                    ],
                        [
                        'attribute' => 'an',
                        'label' => '#',
                        'value' => function($model, $key) {
                            $an = $model['an'];
                            $bed = $model['bedno'];
                            return Html::a("<span class='badge' style='background-color: #0099ff' ><i class='fa fa-cart-plus'></i></span>", ['/food/test', 'an' => $an, 'bed' => $bed], [
                                        'class' => 'activity-add-link',
                                        'title' => 'สั่งอาหาร',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#modalvote',
                                        'data-id' => $model['an'],
                                        
                            ]);
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    ],
                ];

                echo '<div class="col-md-12" align="right" >';
                echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns
                ]);
                echo '</div>';
                Pjax::begin(['id' => 'tfood']); 
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'autoXlFormat' => true,
                    'export' => [
                        'fontAwesome' => true,
                        'showConfirmAlert' => false,
                        'target' => GridView::TARGET_BLANK
                    ],
                    'columns' => $gridColumns,
                    'resizableColumns' => true,
                    // 'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
                    //'floatHeader' => true,
                    //'floatHeaderOptions' => ['scrollingTop' => '100'],
                   // 'pjax' => true,
                    //'pjaxSettings' => [
                    //    'neverTimeout' => true,
                    //'beforeGrid' => 'My fancy content before.',
                    //'afterGrid' => 'My fancy content after.',
                    //],
                ]);
                Pjax::end();
                ?>






            </div>

        </div>

    </div>

</div>

    <div class="modal remote fade " id="modalvote">
        <div class="modal-dialog modal-lg">
            <div class="modal-content  "></div>
        </div>
    </div>
</div>

<?php
/* Modal::begin([
  'id' => 'fm_add',
  'size' => 'modal-lg',
  'header' => '<h2>สั่งอาหาร</h2>',
  'toggleButton' => [
  'label' => 'บันทึก',
  'tag' => 'button',
  'class' => 'btn btn-success'
  ],
  'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
  ]);

  ActiveForm::begin([
  'action' => ['/foodmain'],
  'method' => 'get',
  'options' => [
  'class' => 'navbar-form navbar-left'
  ]
  ]);
  echo '<div class="input-group input-group-sm">';
  echo yii\helpers\Html::input(
  'type: text'
  );
  echo '</div>';
  ActiveForm::end();
  Modal::end(); */
?>


<?php
/*$this->registerJs('
        function init_click_handlers(){
            $(".activity-add-link").click("pjax:end",function() {
                    
                    console.log("gggggggg");
                   // $.pjax.reload({container:"#tfood"});
                });
            
        }
        init_click_handlers(); //first run
        ');*/
?>