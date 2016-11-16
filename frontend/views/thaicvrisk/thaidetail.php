<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use kartik\widgets\DatePicker;
//use kartik\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use miloschuman\highcharts\Highcharts;

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
                    <h3 class="box-title"> <i class='fa fa-bar-chart'></i> &nbsp;กราฟ</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    echo Highcharts::widget([
                        'options' => [
                            'title' => ['text' => ''],
                            'xAxis' => [
                                'categories' => $tcolor
                            ],
                            'yAxis' => [
                                'title' => ['text' => 'จำนวน(คน)']
                            ],
                            'series' => [
                                    ['type' => 'column',
                                    'name' => 'color',
                                    'data' => $tcount,
                                    'color' => '#a3a375',
                                    //'shadow' => TRUE
                                    'pointWidth' => 70
                                ],
                                    ['type' => 'line',
                                    'name' => 's',
                                    'data' => $tcount,
                                        'color' => '#e6005c',
                                ],
                            //['name' => 'John', 'data' => [5, 7, 3]]
                            ]
                        ]
                    ]);
                    ?>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"> <i class='fa fa-user-circle-o'></i> &nbsp;การประเมินโอกาสเสี่ยงต่อการเกิดโรคหัวใจและหลอดเลือด (Thai CVD Risk ปี 59) ของผู้ป่วยที่ได้รับการวินิจฉัยโรคเบาหวาน/ความดัน</h3>

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
                            'attribute' => 'vstdate',
                            'label' => 'วันมารับบริการ'
                        ],
                            [
                            'attribute' => 'hn',
                            'label' => 'HN'
                        ],
                            [
                            'attribute' => 'vn',
                            'label' => 'VN'
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
                            'attribute' => 'bp',
                            'header' => 'BP'
                        ],
                            [
                            'attribute' => 'tc',
                            'label' => 'tc'
                        ],
                            [
                            'attribute' => 'sex',
                            'label' => 'เพศ'
                        ],
                            [
                            'attribute' => 'is_dm',
                            'header' => 'เป็นเบาหวาน'
                        ],
                            [
                            'attribute' => 'smoker',
                            'header' => 'สูบบุหรี่',
                        ],
                            [
                            'attribute' => 'waist',
                            'header' => 'รอบเอว',
                            'format' => ['decimal', 0],
                        ],
                            [
                            'attribute' => 'height',
                            'header' => 'สูง'
                        ],
                            [
                            'header' => 'color',
                            'attribute' => 'tcolor',
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['tcolor'] === '1') {
                                    return "<span class='badge' style='background-color: #53ff1a' ><font  color='7a7a52'>" . $model['tcolor'] . "</font></span>  <code></code>";
                                } else if ($model['tcolor'] === '2') {
                                    return "<span class='badge' style='background-color: #ffff00'><font  color='7a7a52'>" . $model['tcolor'] . "</font></span>  <code></code>";
                                } else if ($model['tcolor'] === '3') {
                                    return "<span class='badge' style='background-color: #ff751a'><font  color='7a7a52'>" . $model['tcolor'] . "</font></span>  <code></code>";
                                } else if ($model['tcolor'] === '4') {
                                    return "<span class='badge' style='background-color: #ff1a1a'><font  color='7a7a52'>" . $model['tcolor'] . "</font></span>  <code></code>";
                                } else if ($model['tcolor'] === '5') {
                                    return "<span class='badge' style='background-color: #7a7a52'><font  color='7a7a52'>" . $model['tcolor'] . "</font></span>  <code></code>";
                                } else {
                                    return "ไม่ทราบ";
                                }
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'vAlign' => 'middle',
                            'format' => 'raw',
                            'width' => '150px',
                            'noWrap' => true
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
                        'filterModel' => $searchModel,
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