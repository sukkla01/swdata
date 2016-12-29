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
                    <h3 class="box-title"> <i class='glyphicon glyphicon-search'></i> รายงานผู้ป่วยในนอนนานมากกว่า 30 วัน</h3>

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
                            //'pageSummary' => 'รวมทั้งหมด',
                            //'contentOptions' => ['class' => 'text-center'],
                            'headerOptions' => ['class' => 'text-center']
                        ],
                            [
                            'attribute' => 'dchdate',
                            'label' => 'วัน Dis',
                        ],
                            [
                            'attribute' => 'tname',
                            'label' => 'ชื่อ-สกุล',
                        ],
                            [
                            'header' => 'วันนอน',
                            'attribute' => 'admday',
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['admday'] > 50) {
                                    return "<span class='badge' style='background-color: #cc0052'>" . $model['admday'] . "</span>  <code></code>";
                                } else if ($model['admday'] > 70) {
                                    return "<span class='badge' style='background-color: #ff9933'>" . $model['admday'] . "</span>  <code></code>";
                                } else {
                                    return "<span class='badge' style='background-color: #999966'>" . $model['admday'] . "</span>  <code></code>";
                                }
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'middle',
                            'format' => 'raw',
                            'width' => '150px',
                            'noWrap' => true
                        ],
                            [
                            'attribute' => 'adjrw',
                            'label' => 'AdjRW',
                        ],
                            [
                            'attribute' => 'wname',
                            'label' => 'ward',
                        ],
                            [
                            'attribute' => 'icd9',
                            'label' => 'icd9',
                        ],
                            [
                            'attribute' => 'cname',
                            'label' => 'หัตถการ',
                            'pageSummary' => 'รวมทั้งหมด',
                        ],
                            [
                            'attribute' => 'pdx',
                            'label' => 'icd10',
                        ],
                            [
                            'attribute' => 'tsum',
                            'label' => 'ราคารวม',
                            'format' => ['decimal', 2],
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
                        'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
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