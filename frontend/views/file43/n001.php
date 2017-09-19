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
                            'dateFormat' => 'yy-mm-dd',
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
                            'dateFormat' => 'yy-mm-dd',
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
                    <h3 class="box-title"> <i class='glyphicon glyphicon-search'></i> ข้อมูลผู้ป่วยที่มารับบริการ แต่ไม่ได้ลงการคัดกรองเบาหวานความดัน (NCDSCREEN)</h3>

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
                            'label' => 'HN',
                            //'pageSummary' => 'รวมทั้งหมด',
                            //'contentOptions' => ['class' => 'text-center'],
                            'headerOptions' => ['class' => 'text-center']
                        ],
                            [
                            'attribute' => 'vstdate',
                            'label' => 'วันมารับบริการ',
                        ],
                            [
                            'attribute' => 'PatientName',
                            'label' => 'ชื่อ-สกุล',
                        ],
                            [
                            'attribute' => 'bw',
                            'label' => 'Bw',
                            'format' => ['decimal', 0],
                        ],
                        [
                            'attribute' => 'systolic',
                            'label' => 'Systolic',
                            'format' => ['decimal', 0],
                        ],
                        [
                            'attribute' => 'diastolic',
                            'label' => 'Diastolic',
                            'format' => ['decimal', 0],
                        ],
                        [
                            'attribute' => 'height',
                            'label' => 'Height',
                           
                        ],
                        [
                            'attribute' => 'fbs',
                            'label' => 'FBS',
                        ],
                        [
                            'attribute' => 'person_id',
                            'label' => 'PID',
                        ],
                         [
                            'attribute' => 'yearlast',
                            'label' => 'ปีงบคัดกรองล่าสุด',
                        ],
                         [
                            'attribute' => 'visityear',
                            'label' => 'ปีงบวันที่มา',
                        ],
                        [  
                            'header' => '#',
                            'attribute' => 'tckperson',
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['tckperson'] === 'บัญชี1') {
                                    return "<span class='badge' style='background-color: #cc0052'>" . $model['tckperson'] . "</span>  <code></code>";
                                } else if ($model['tckperson'] === 'เพิ่ม') {
                                    return "<span class='badge' style='background-color: #ff9933'>" . $model['tckperson'] . "</span>  <code></code>";
                                } else if ($model['tckperson'] === 'ปีงบวันที่มาไม่ตรงกับปีงบคัดกรองล่าสุด') {
                                    return "<span class='badge' style='background-color: #999966'>" . $model['tckperson'] . "</span>  <code></code>";
                                }else{
                                    return "<span class='badge' style='background-color: #3399ff'>" . $model['tckperson'] . "</span>  <code></code>";
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