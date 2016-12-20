<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use kartik\widgets\DatePicker;
//use kartik\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

?>

<div class="body-content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body">

 
                            
                  <?= Html::beginForm(); ?>
                        
                       ประมวลข้อมูลระหว่าง :
                            <?php
                            echo yii\jui\DatePicker::widget([
            'name' => 'date1',
            'value' => $date1,
            'language' => 'th',
            //'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
                'dateFormat' => 'yy-mm-dd'
            ],
            
        ]);
                            ?>
                    
                        ถึง
                       
                            
                            <?php
                             echo yii\jui\DatePicker::widget([
            'name' => 'date2',
            'value' => $date2,
            'language' => 'th',
            //'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
                'dateFormat' => 'yy-mm-dd'
            ]
        ]);
                            ?>
                        
                        <button class='btn btn-danger'>ประมวลผล</button>

           <?= Html::endForm(); ?>



                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"> <i class='glyphicon glyphicon-search'></i> รายงานผลการตรวจ Creantinine คำนวนผล eGFR คลินิกเบาหวานความดัน</h3>

                    <div class="box-tools pull-right">
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
                            'label' => 'hn'
                        ],
                            [
                            'attribute' => 'tname',
                            'header' => 'ชื่อ-สกุล'
                        ],
                            [
                            'attribute' => 'age',
                            'header' => 'อายุ'
                        ],
                            [
                            'attribute' => 'tspclty',
                            'header' => 'แผนก'
                        ],
                            [
                            'attribute' => 'addrfull',
                            'label' => 'ที่อยู่'
                        ],
                            [
                            'attribute' => 'addressid',
                            'label' => 'บ้านเลขที่'
                        ],
                            [
                            'attribute' => 'moopart',
                            'header' => 'หมู่'
                        ],
                            [
                            'attribute' => 'tmbpart',
                            'header' => 'ตำบล'
                        ],
                            [
                            'attribute' => 'amppart',
                            'header' => 'อำเภอ'
                        ],
                            [
                            'attribute' => 'chwpart',
                            'header' => 'จังหวัด'
                        ],
                            [
                            'attribute' => 'ptname',
                            'header' => 'สิทธิ'
                        ],
                            [
                            'attribute' => 'albu_result',
                            'header' => 'albunmin'
                        ],
                            [
                            'attribute' => 'micro_result',
                            'header' => 'micro'
                        ],
                            [
                            'attribute' => 'test_result',
                            'header' => 'UMA test'
                        ],
                            [
                            'attribute' => 'lab_order_result',
                            'header' => 'cr'
                        ],
                            [
                            'attribute' => 'gfr',
                            'header' => 'gfr'
                        ],
                            [
                            'attribute' => 'icd10dx',
                            'header' => 'โรค'
                        ]
                    ];

                    echo '<div class="col-md-12" align="right" >';
                    echo ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $gridColumns
                    ]);
                    echo '</div>';
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
                        'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
                        //'floatHeader' => true,
                        //'floatHeaderOptions' => ['scrollingTop' => '100'],
                        'pjax' => true,
                        'pjaxSettings' => [
                            'neverTimeout' => true,
                        //'beforeGrid' => 'My fancy content before.',
                        //'afterGrid' => 'My fancy content after.',
                        ],
                    ]);
                    ?>






                </div>

            </div>

        </div>

    </div>
</div>