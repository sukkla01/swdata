<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use kartik\widgets\DatePicker;
//use kartik\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\widgets\Select2;

$tyearl = date('Y') + 543;
?>

<div class="body-content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body">

                    <?= Html::beginForm(); ?>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>ปีงบประมาณ : </label>
                            <?=
                            Select2::widget([
                                'name' => 'type',
                                'value' => $type,
                                'data' => [$tyearl - 3, $tyearl - 2, $tyearl - 1, $tyearl],
                                'options' => ['multiple' => false, 'placeholder' => '<--คลิก/พิมพ์เลือก-->']
                            ]);
                            ?>
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
                    <h3 class="box-title"> <i class='glyphicon glyphicon-search'></i> รายงานผู้ป่วยเบาหวานในเขตพื้นที่รับผิดชอบ หมู่ 3 4 6 8 (แสดงผล FBS) ปีงบประมาณ : <?=$tyear+543?></h3>

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
                            'attribute' => 'icd10',
                            'label' => 'icd10'
                        ],
                            [
                            'attribute' => 'tname',
                            'label' => 'ชื่อ-สกุล'
                        ],
                        [
                            'attribute' => 'moopart',
                            'label' => 'หมู่'
                        ],
                            ['attribute' => 'l10',
                            'label' => 'ต.ค.',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['l10'] == null) {
                                    return '';
                                } else {
                                    return $model['l10'];
                                }
                            }
                        ],
                            ['attribute' => 'l11',
                            'label' => 'พ.ย.',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['l11'] == null) {
                                    return '';
                                } else {
                                    return $model['l11'];
                                }
                            }
                        ],
                            ['attribute' => 'l12',
                            'label' => 'ธ.ค.',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['l12'] == null) {
                                    return '';
                                } else {
                                    return $model['l12'];
                                }
                            }
                        ],
                            ['attribute' => 'l01',
                            'label' => 'ม.ค.',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['l01'] == null) {
                                    return '';
                                } else {
                                    return $model['l01'];
                                }
                            }
                        ],
                            ['attribute' => 'l02',
                            'label' => 'ก.พ.',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['l02'] == null) {
                                    return '';
                                } else {
                                    return $model['l02'];
                                }
                            }
                        ],
                            ['attribute' => 'l03',
                            'label' => 'มี.ค.',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['l03'] == null) {
                                    return '';
                                } else {
                                    return $model['l03'];
                                }
                            }
                        ],
                            ['attribute' => 'l04',
                            'label' => 'เม.ย.',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['l04'] == null) {
                                    return '';
                                } else {
                                    return $model['l04'];
                                }
                            }
                        ],
                            ['attribute' => 'l05',
                            'label' => 'พ.ค.',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['l05'] == null) {
                                    return '';
                                } else {
                                    return $model['l05'];
                                }
                            }
                        ],
                            ['attribute' => 'l06',
                            'label' => 'มิ.ย.',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['l06'] == null) {
                                    return '';
                                } else {
                                    return $model['l06'];
                                }
                            }
                        ],
                            ['attribute' => 'l07',
                            'label' => 'ก.ค.',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['l07'] == null) {
                                    return '';
                                } else {
                                    return $model['l07'];
                                }
                            }
                        ],
                            ['attribute' => 'l08',
                            'label' => 'ส.ค.',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['l08'] == null) {
                                    return '';
                                } else {
                                    return $model['l08'];
                                }
                            }
                        ],
                            ['attribute' => 'l09',
                            'label' => 'ก.ย.',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['l09'] == null) {
                                    return '';
                                } else {
                                    return $model['l09'];
                                }
                            }
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