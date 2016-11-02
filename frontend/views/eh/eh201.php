<?php

use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Html;



echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' => [
            [
            'label' => 'ข้อมูล 43 แฟ้ม',
            //'url' => ['post-category/view'],
            //'template' => "<li><b>{link}</b></li>\n", // template for this link only
        ],
            
        [
            'label' => 'เอ๊ะ!!',
            'url' => ['eh/'],
            //'template' => "<li><b>{link}</b></li>\n", // template for this link only
        ],
        'Eh201-->ผู้ป่วยที่ถูกวินิจฉัยว่าเป็นเบาหวานหรือความดัน แต่ยังไม่ได้ลงทะเบียนในคลินิก (clinicmember)  ปีงบ 2559'
    ],
]);

?>


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
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ],
            
        ]);
                            ?>
                    
                        ถึง
                       
                            
                            <?php
                             echo yii\jui\DatePicker::widget([
            'name' => 'date2',
            'value' => $date2,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
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
                    <h3 class="box-title"> <i class='glyphicon glyphicon-search'></i> ผู้ป่วยที่ถูกวินิจฉัยว่าเป็นเบาหวานหรือความดัน แต่ยังไม่ได้ลงทะเบียนในคลินิก (clinicmember)  ปีงบ 2559</h3>

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
                            [
                            'attribute' => 'hn',
                            'label' => 'hn'
                        ],
                            [
                            'attribute' => 'tname',
                            'header' => 'ชื่อ-สกุล'
                        ],
                           
                            [
                            'attribute' => 'taddr',
                            'label' => 'ที่อยู่'
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
                    
  
            
            
  
