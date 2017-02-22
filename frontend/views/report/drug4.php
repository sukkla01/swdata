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
                    <h3 class="box-title"> <i class='glyphicon glyphicon-search'></i> 	รายงานการใช้ยา  cefixime ร่วมกับ CefTRIAXONE,CEFTAZIDIME </h3>

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
                            'attribute' => 'rxdate1',
                            'label' => 'วันที่รับยา',
                        ],
                            [
                            'attribute' => 'thn',
                            'label' => 'HN',
                        //'pageSummary' => 'รวมทั้งหมด',
                        //'contentOptions' => ['class' => 'text-center'],
                        ],
                            [
                            'attribute' => 'ttype',
                            'label' => 'OPD/IPD',
                        ],
                            [
                            'attribute' => 'vn1',
                            'label' => 'vn/an',
                        ],
                            [
                            'attribute' => 'qty1',
                            'label' => 'จำนวน/cefixime',
                            'hAlign' => 'center',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'sumprice1',
                            'label' => 'ราคา/cefixime',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'qty2',
                            'label' => 'จำนวน/CefTRIAXONE',
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['qty2'] == '') {
                                    return '';
                                } else {
                                    return $model['qty2'];
                                }
                            },
                            'hAlign' => 'center',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'sumprice2',
                            'label' => 'ราคา/CefTRIAXONE',
                            'format' => ['decimal', 2],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['sumprice2'] == '') {
                                    return '';
                                } else {
                                    return $model['sumprice2'];
                                }
                            },
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'qty3',
                            'label' => 'จำนวน/CEFTAZIDIME',
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['qty3'] == '') {
                                    return '';
                                } else {
                                    return $model['qty3'];
                                }
                            },
                            'hAlign' => 'center',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'sumprice3',
                            'label' => 'ราคา/CEFTAZIDIME',
                            'format' => ['decimal', 2],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['sumprice3'] == '') {
                                    return '';
                                } else {
                                    return $model['sumprice3'];
                                }
                            },
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
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