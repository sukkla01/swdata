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
                    <h3 class="box-title"> <i class='glyphicon glyphicon-search'></i> รายงานผู้ป่วย ckd (n181,n182,n183,184,185,n189)</h3>

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
                            'header' => 'วันที่ diag'
                        ],
                            [
                            'attribute' => 'tname',
                            'header' => 'ชื่อ-สกุล'
                        ],
                        [
                            'attribute' => 'tage',
                            'header' => 'อายุ'
                        ],
                        [
                            'attribute' => 'taddr',
                            'header' => 'ที่อยู่'
                        ],
                            [
                            'attribute' => 'moopart',
                            'header' => 'หมู่'
                        ],
                            [
                            'attribute' => 'tmbpart',
                            'label' => 'ตำบล'
                        ],
                            [
                            'attribute' => 'amppart',
                            'label' => 'อำเภอ'
                        ],
                            [
                            'attribute' => 'chwpart',
                            'header' => 'จังหวัด'
                        ],
                         [
                            'attribute' => 'cid',
                            'header' => 'cid'
                        ],
                            ['attribute' => 'ht',
                            'label' => 'HT',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['ht'] > 0) {
                                    return "<span class='badge' style='background-color: #EC407A' >Y </span>";
                                } else {
                                    return "<span class='badge' style='background-color: #4CAF50' >N </span>";
                                }
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'middle',
                            'format' => 'raw',
                        //'width' => '150px',
                        //'noWrap' => true
                        ],
                            ['attribute' => 'dm',
                            'label' => 'DM',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['dm'] > 0) {
                                    return "<span class='badge' style='background-color: #EC407A' >Y </span>";
                                } else {
                                    return "<span class='badge' style='background-color: #4CAF50' >N </span>";
                                }
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'middle',
                            'format' => 'raw',
                        //'width' => '150px',
                        //'noWrap' => true
                        ],
                            [
                            'attribute' => 'type',
                            'header' => 'ประเภท'
                        ],
                            [
                            'attribute' => 'sname',
                            'header' => 'แผนก'
                        ],
                            [
                            'attribute' => 'icd10',
                            'header' => 'icd10'
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