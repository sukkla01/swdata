<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use kartik\widgets\DatePicker;
//use kartik\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use miloschuman\highcharts\Highcharts;

$connection = Yii::$app->db;
$sql = "SELECT 
(SELECT COUNT(hn) 
FROM swdata.tmb_thaicvrisk_ngob_web WHERE year_ng='2559' ) AS tregis,
(SELECT COUNT(hn) 
FROM swdata.tmb_thaicvrisk_ngob_web WHERE tcolor <>'ไม่ทราบ'  AND year_ng='2559') AS trisk,
(SELECT COUNT(hn) 
FROM swdata.tmb_thaicvrisk_ngob_web WHERE tcolor IN('1','2')  AND year_ng='2559') AS r1,
(SELECT COUNT(hn) 
FROM swdata.tmb_thaicvrisk_ngob_web WHERE tcolor ='3'  AND year_ng='2559') AS r2,
(SELECT COUNT(hn) 
FROM swdata.tmb_thaicvrisk_ngob_web WHERE tcolor IN('4','5')  AND year_ng='2559') AS r3 ";
$data = $connection->createCommand($sql)
        ->queryAll();
for ($nu = 0; $nu < sizeof($data); $nu++) {
    $tregis = $data[$nu]['tregis'];
    $trisk = $data[$nu]['trisk'];
    $r1 = $data[$nu]['r1'];
    $r2 = $data[$nu]['r2'];
    $r3 = $data[$nu]['r3'];
}

?>

<div class="body-content">

    <div class="row">
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon" style="background-color: #476b6b"><i class="fa fa-user-circle" ></i></span>

                <div class="info-box-content">
                    <span class="info-box-text" data-toggle='tooltip' title='จำนวนผู้ป่วย DM/HT ที่ลงทะเบียนทั้งหมด'><small>ขึ้นทะเบียนทั้งหมด(คน)</small></span>
                    <span class="info-box-number"><?= number_format($tregis) ?></span>
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
                    <span class="info-box-text" data-toggle='tooltip' title='จำนวนผู้ป่วย DM/HT ที่ด้รับารประเมิณ Thai CV Risk'>Thai CV Risk(คน)</span>
                    <span class="info-box-number"><?= number_format($trisk) ?></span>
                    <span >
                        <?php
                        $persen = ($trisk / $tregis) * 100;
                        $persen = number_format($persen);
                        echo 'ร้อยละ ' . $persen;
                        ?>
                    </span>
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
                <span class="info-box-icon" style="background-color: #476b6b"><i class="fa fa-tags" style="color:#1a1a00;"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text" data-toggle='tooltip' title='จำนวนกลุ่มเสี่ยงปานกลาง (<20%)'>ปานกลาง(คน)</span>
                    <span class="info-box-number "><?= number_format($r1) ?></span>
                    <span >
                        <?php
                        $persen1 = ($r1 / $trisk) * 100;
                        $persen1 = number_format($persen1);
                        echo 'ร้อยละ ' . $persen1;
                        ?>
                    </span>

                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-2">
            <div class="info-box">
                <span class="info-box-icon" style="background-color: #476b6b"><i class="fa fa-tags" style="color:#330033;"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"data-toggle='tooltip' title='จำนวนกลุ่มเสี่ยงสูง (20-<30%)'>สูง(คน)</span>
                    <span class="info-box-number"><?= $r2 ?></span>
                    <span >
                        <?php
                        $persen2 = ($r2 / $trisk) * 100;
                        $persen2 = number_format($persen2);
                        echo 'ร้อยละ ' . $persen2;
                        ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-2">
            <div class="info-box">
                <span class="info-box-icon" style="background-color: #476b6b"><i class="fa fa-tags" style="color:#660000;"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text" data-toggle='tooltip' title='จำนวนกลุ่มเสี่ยงสูงมาก (>=30%)'>สูงมาก(คน)</span>
                    <span class="info-box-number"><?= $r3 ?></span>
                    <span >
                        <?php
                        $persen3 = ($r3 / $trisk) * 100;
                        $persen3 = number_format($persen3);
                        echo 'ร้อยละ ' . $persen3;
                        ?>
                    </span>
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
                    <div class="col-md-2">
                        <div class="form-group" >
                            <label>Color : </label>
                            <select class="form-control" name ="color">
                                <option value="0">--- select ---</option>
                                <option value="1" style="background-color: #53ff1a">1</option>
                                <option value="2" style="background-color: #ffff00">2</option>
                                <option value="3" style="background-color: #ff751a">3</option>
                                <option value="4" style="background-color: #ff1a1a">4</option>
                                <option value="5" style="background-color: #990000">5</option>
                                <option value="null" style="background-color: #ffffff">ไม่ทราบ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>ประเภทผู้ป่วย : </label>
                            <select class="form-control" name="type" >
                                <option value="0">--- select ---</option>
                                <option value="1" style="background-color: #0099ff">DM</option>
                                <option value="2" style="background-color: #99e600">HT</option>
                                <option value="3" style="background-color: #ff0066">DMHT</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <br>
                         &nbsp;&nbsp;<button class='btn btn-danger'>ประมวลผล</button>
                    </div>

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