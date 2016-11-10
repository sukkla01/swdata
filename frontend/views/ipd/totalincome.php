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
                    <h3 class="box-title"> <i class='glyphicon glyphicon-search'></i> รายงานค่ารักษาผู้ป่วยใน (ดึงวัน Dischage)</h3>

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
                            'attribute' => 'pname',
                            'label' => 'สิทธิ์',
                            'pageSummary' => 'รวมทั้งหมด',
                            //'contentOptions' => ['class' => 'text-center'],
                            'headerOptions' => ['class' => 'text-center']
                        ],
                            [
                            'attribute' => 'in1',
                            'label' => 'หมวด1',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in2',
                            'label' => 'หมวด2',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in3',
                            'label' => 'หมวด3',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in4',
                            'label' => 'หมวด4',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in5',
                            'label' => 'หมวด5',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in6',
                            'label' => 'หมวด6',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in7',
                            'label' => 'หมวด7',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in8',
                            'label' => 'หมวด8',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in9',
                            'label' => 'หมวด9',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in10',
                            'label' => 'หมวด10',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in11',
                            'label' => 'หมวด11',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in12',
                            'label' => 'หมวด12',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in13',
                            'label' => 'หมวด13',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in14',
                            'label' => 'หมวด14',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in15',
                            'label' => 'หมวด15',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in16',
                            'label' => 'หมวด16',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'in17',
                            'label' => 'หมวด17',
                            'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'tsum',
                            'label' => 'รวม',
                            'format' => ['decimal', 2],
                            /* 'value' => function ($model, $key, $index, $widget) {

                              return "<span class='badge' style='background-color: #cc0052'>" . $model['tsum'] . "</span>  <code></code>";
                              },
                              'filterType' => GridView::FILTER_COLOR,
                              'vAlign' => 'middle',
                              'format' => 'raw',
                              'width' => '150px',
                              'noWrap' => true, */
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