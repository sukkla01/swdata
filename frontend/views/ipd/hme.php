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
                    <h3 class="box-title"> <i class='glyphicon glyphicon-search'></i> รายงานยากลับบ้าน (INJECTIONS)ผู้ป่วยใน</h3>

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
                            'attribute' => 'rxdate',
                            'label' => 'วันมารับบริการ',
                        ],
                            [
                            'attribute' => 'tname',
                            'label' => 'ชื่อ-สกุล',
                            
                        ],
                            [
                            'attribute' => 'icode',
                            'label' => 'icode',
                        ],
                            [
                            'attribute' => 'dname',
                            'label' => 'รายการยา',
                             'pageSummary' => 'รวมทั้งหมด',
                        ],
                        [
                            'attribute' => 'qty',
                            'label' => 'จำนวน',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'unitcost',
                            'label' => 'ราคาทุน/vial',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'tcost',
                            'label' => 'มูลค่า(ราคาทุน)',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                         [
                            'attribute' => 'ipd_price',
                            'label' => 'ราคาขาย/vial',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                         [
                            'attribute' => 'tprice',
                            'label' => 'มูลค่า(ราคาขาย)',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                         [
                            'attribute' => 'thos',
                            'label' => 'รพ.',
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
                        'responsive' => true,
                        'hover' => true,
                        'columns' => $gridColumns,
                        'resizableColumns' => true,
                        //'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
                        //'floatHeader' => true,
                        //'floatHeaderOptions' => ['scrollingTop' => '100'],
                        'pjax' => true,
                        'pjaxSettings' => [
                            'neverTimeout' => true,
                        //'beforeGrid' => 'My fancy content before.',
                        //'afterGrid' => 'My fancy content after.',
                        ],
                        'showPageSummary' => true,
                            // 'pageSummary' => \app\components\PTotal::pageTotal($dataProvider->models,'price'),
                    ]);
                    ?>






                </div>

            </div>

        </div>

    </div>
</div>