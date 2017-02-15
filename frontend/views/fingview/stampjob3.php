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
                    <h3 class="box-title"> <i class='fa fa-bookmark-o'></i>&nbsp;&nbsp;รายชื่อเวรดึกเจ้าหน้าที่ขึ้นปฏิบัติงาน 00.30 - 08.30 น.</h3>

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
                            'attribute' => 'Badgenumber',
                            'label' => 'เลขสแกนลายนิ้วมือ',
                        ],
                            [
                            'attribute' => 'username',
                            'label' => 'User',
                        ],
                            [
                            'attribute' => 'Fullname',
                            'label' => 'ชื่อ-สกุล',
                        ],
                            [
                            'attribute' => 'Tdate',
                            'label' => 'วันที',
                        ],
                        [
                            'attribute' => 'TTime',
                            'label' => 'เวลา',
                        ],
                        [
                            'attribute' => 'deptnamenew',
                            'label' => 'แผนก',
                        ],
                        [
                            'attribute' => 'deptnamenew',
                            'label' => 'แผนก',
                        ],
                        [
                            'attribute' => 'position',
                            'label' => 'ตำแหน่ง',
                        ]
                        ,
                        [
                            'attribute' => 'Tlevel',
                            'label' => 'ระดับ',
                        ],
                        [  
                            'header' => 'สถานะการเข้าปฎิบัตงาน',
                            'attribute' => 'WrokTime',
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['WrokTime'] === 'สาย') {
                                    return "<span class='badge' style='background-color: #cc0052'>" . $model['WrokTime'] . "</span>  <code></code>";
                                } else if ($model['WrokTime'] === 'ในเวลา') {
                                    return "<span class='badge' style='background-color: #00cc99'>" . $model['WrokTime'] . "</span>  <code></code>";
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