<?php

use yii\bootstrap\Html;
use kartik\widgets\DatePicker;
//use kartik\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
?>


<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <div class="pull-left"><span style="font-weight: bold;" class="btn btn-primary btn-flat"><h5><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;โปรแกรมสั่งอาหารผู้ป่วยใน</h5></span></div>



                <div class="box-tools pull-right">

                    &nbsp;&nbsp;<a style="font-weight: bold;" class="btn btn-danger" id="btn_sql"><h5><i class="fa fa-filter"></i>&nbsp;&nbsp;สั่งอาหารเดิม</h5></a>
                    &nbsp;&nbsp;<a style="font-weight: bold;" class="btn btn-danger" id="btn_sql"><h5><i class="fa fa-filter"></i>&nbsp;&nbsp;พิมพ์</h5></a>
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
                        'attribute' => 'an',
                        'label' => 'AN'
                    ],
                        [
                        'attribute' => 'bedno',
                        'label' => 'เตียง'
                    ],
                        [
                        'attribute' => 'tname',
                        'label' => 'ชื่อ-สกุล'
                    ],
                        [
                        'attribute' => 'regdate',
                        'label' => 'วันที่ Admit'
                    ],
                        [
                        'attribute' => 'regtime',
                        'label' => 'เวลา Admit'
                    ],
                        [
                        'attribute' => 'nname',
                        'label' => 'รายการอาหาร'
                    ],
                        [
                        'attribute' => 'fooddate',
                        'label' => 'วันที่สั่งอาหารล่าสุด',
                        'value' => function ($model, $key, $index, $widget) {
                            $cdate = date('Y-m-d');
                            if ($model['fooddate'] == $cdate) {
                                return "<font class='text-green'>" . $model['fooddate'] . "</font>";
                            } else {
                                return "<font class='text-red'>" . $model['fooddate'] . "</font>";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        [
                        'attribute' => 'congenital_disease',
                        'label' => 'โรคประจำตัว'
                    ],
                        [
                        'attribute' => 'height',
                        'label' => 'สูง'
                    ],
                        [
                        'attribute' => 'bw',
                        'label' => 'น้ำหนัก'
                    ],
                        [
                        'attribute' => 'bmi',
                        'label' => 'bmi'
                    ],
                    [
                        'attribute' => 'an',
                        'label' => '#',
                        'value' => function($model)  {
                            
                                return Html::a("<span class='badge' style='background-color: #0099ff' ><i class='fa fa-cart-plus'></i></span>", [
                                    'smonthlist/smonth_cid',
                                    'year' => $model['an'],
                                ]);
                            },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
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
                    // 'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
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