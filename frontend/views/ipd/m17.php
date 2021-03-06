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
                    <h3 class="box-title"> <i class='glyphicon glyphicon-search'></i> รายงานผู้ป่วยโรคเข่าเสื่อม</h3>

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
                            'attribute' => 'an',
                            'label' => 'AN',
                            'value' => function($model, $key) {
                                $an = $model['an'];
                                return Html::a($an, ['/ipd/m17income', 'an' => $an],
                                        ['target'=>'_blank'], 
                                        ['title' => 'สั่งอาหาร']
                                        );
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'middle',
                            'format' => 'raw',
                        ],
                            [
                            'attribute' => 'hn',
                            'label' => 'HN'
                        ],
                            [
                            'attribute' => 'dchdate',
                            'label' => 'วัน dis'
                        ],
                            [
                            'attribute' => 'tname',
                            'header' => 'ชื่อ-สกุล'
                        ],
                            [
                            'attribute' => 'icd10',
                            'header' => 'icd10'
                        ],
                            [
                            'attribute' => 'cname',
                            'header' => 'โรคค'
                        ],
                            [
                            'attribute' => 'icd9',
                            'label' => 'icd9'
                        ],
                            [
                            'attribute' => '9name',
                            'label' => 'หัตถการ'
                        ],
                            [
                            'attribute' => 'rw',
                            'header' => 'RW'
                        ],
                            [
                            'attribute' => 'tsum',
                            'header' => 'ราคารวม',
                            'format' => ['decimal', 2],
                        ],
                            [
                            'attribute' => 'admday',
                            'header' => 'วันนอน'
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
                        //'pjax' => true,
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