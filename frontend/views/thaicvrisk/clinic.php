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
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon" style="background-color: #476b6b"><i class="fa fa-id-card"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text" data-toggle='tooltip' title='จำนวนผู้ป่วย DM/HT ที่ลงทะเบียนทั้งหมด'><small>ขึ้นทะเบียนทั้งหมด</small></span>
                    <span class="info-box-number">90<small>%</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon " style="background-color: #476b6b"><i class="fa fa-heartbeat"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text" data-toggle='tooltip' title='จำนวนผู้ป่วย DM/HT ที่ด้รับารประเมิณ Thai CV Risk'>Thai CV Risk</span>
                    <span class="info-box-number">41,410</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-2">
            <div class="info-box">
                <span class="info-box-icon" style="background-color: #476b6b"><i class="fa fa-heart-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text" data-toggle='tooltip' title='จำนวนกลุ่มเสี่ยงปานกลาง (<20%)'>ปานกลาง</span>
                    <span class="info-box-number">760</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-2">
            <div class="info-box">
                <span class="info-box-icon" style="background-color: #476b6b"><i class="fa fa-heart-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"data-toggle='tooltip' title='จำนวนกลุ่มเสี่ยงสูง (20-<30%)'>สูง</span>
                    <span class="info-box-number">2,000</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-2">
            <div class="info-box">
                <span class="info-box-icon" style="background-color: #476b6b"><i class="fa fa-heart-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text" data-toggle='tooltip' title='จำนวนกลุ่มเสี่ยงสูงมาก (>=30%)'>สูงมาก</span>
                    <span class="info-box-number">2,000</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row" id="sql" style="display: none">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body">



                    <?= Html::beginForm(); ?>
                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;
                    ประมวลข้อมูลระหว่าง :
                    <?php
                    echo yii\jui\DatePicker::widget([
                        'name' => 'date1',
                        'value' => '',
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
                        'value' => '',
                        'language' => 'th',
                        'dateFormat' => 'yyyy-MM-dd',
                        'clientOptions' => [
                            'changeMonth' => true,
                            'changeYear' => true,
                        ]
                    ]);
                    ?>

                    &nbsp;&nbsp;<button class='btn btn-danger'>ประมวลผล</button>

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
                    <div class="pull-left"><span style="font-weight: bold;" class="btn btn-success btn-flat"><h5><i class="fa fa-user-circle-o"></i>&nbsp;&nbsp;การประเมินโอกาสเสี่ยงต่อการเกิดโรคหัวใจและหลอดเลือด (Thai CVD Risk ปีงบ 59) ของผู้ป่วยที่ได้รับการวินิจฉัยโรคเบาหวาน/ความดัน</h5></span></div>
                    &nbsp;&nbsp;<a style="font-weight: bold;" class="btn btn-danger" id="btn_sql"><h5><i class="fa fa-filter"></i>&nbsp;&nbsp;กรองข้อมูล</h5></a>


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
                            'label' => 'HN'
                        ],
                            [
                            'attribute' => 'vstdate',
                            'label' => 'วันมารับบริการ',
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['vstdate'] > 0) {
                                    return $model['vstdate'];
                                } else {
                                    return '';
                                }
                            }
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
                            'attribute' => 'bps',
                            'header' => 'BP',
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['bps'] > 0) {
                                    return $model['bps'];
                                } else {
                                    return '';
                                }
                            }
                        ],
                            [
                            'attribute' => 'tc',
                            'label' => 'tc',
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['tc'] > 0) {
                                    return $model['tc'];
                                } else {
                                    return '';
                                }
                            }
                        ],
                            [
                            'header' => 'เพศ',
                            'attribute' => 'sex',
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['sex'] === '1') {
                                    return "<i data-toggle='tooltip' title='ชาย' class='fa fa-mars-stroke fa-lg text-green' ></i>";
                                } else if ($model['sex'] === '2') {
                                    return "<i data-toggle='tooltip' title='หญิง'  class='fa fa-venus fa-lg text-maroon'></i>";
                                }
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'vAlign' => 'middle',
                            'format' => 'raw',
                            'width' => '150px',
                            'noWrap' => true
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
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['waist'] > 0) {
                                    return $model['waist'];
                                } else {
                                    return '';
                                }
                            }
                        ],
                            [
                            'attribute' => 'height',
                            'header' => 'สูง',
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['height'] > 0) {
                                    return $model['height'];
                                } else {
                                    return '';
                                }
                            }
                        ],
                            [
                            'header' => 'color',
                            'attribute' => 'tcolor',
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['tcolor'] === '1') {
                                    return "<span class='badge' style='background-color: #53ff1a' ><font  color='7a7a52'>" . $model['tcolor'] . "</font></span>";
                                } else if ($model['tcolor'] === '2') {
                                    return "<span class='badge' style='background-color: #ffff00'><font  color='7a7a52'>" . $model['tcolor'] . "</font></span>";
                                } else if ($model['tcolor'] === '3') {
                                    return "<span class='badge' style='background-color: #ff751a'><font  color='ffffff'>" . $model['tcolor'] . "</font></span>";
                                } else if ($model['tcolor'] === '4') {
                                    return "<span class='badge' style='background-color: #ff1a1a'><font  color='7a7a52'>" . $model['tcolor'] . "</font></span>";
                                } else if ($model['tcolor'] === '5') {
                                    return "<span class='badge' style='background-color: #990000'><font  color='ffffff'>" . $model['tcolor'] . "</font></span>";
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
                            [
                            'header' => '#',
                            'attribute' => 'type',
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['type'] === 'DM') {
                                    return "<span class='badge' style='background-color: #0099ff' ><font  color='ffffff'>" . $model['type'] . "</font></span>";
                                } else if ($model['type'] === 'HT') {
                                    return "<span class='badge' style='background-color: #99e600'><font  color='333300'>" . $model['type'] . "</font></span>";
                                } else if ($model['type'] === 'DMHT') {
                                    return "<span class='badge' style='background-color: #ff0066'><font  color='ccccb3'>" . $model['type'] . "</font></span>";
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

<?php
$script = <<< JS
$(function(){
    $("label[title='Show all data']").hide();
});
        
$('#btn_sql').on('click', function(e) {
    
   $('#sql').toggle();
});
JS;
$this->registerJs($script);
?>