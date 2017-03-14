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
                        'dateFormat' => 'yyyy-MM-dd',
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
                    <h3 class="box-title"> <i class='glyphicon glyphicon-search'></i> รายงานผู้ป่วยในลงรหัสโรค</h3>

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
                            [
                            'attribute' => 'an',
                            'label' => 'AN'
                        ],
                            [
                            'attribute' => 'hn',
                            'label' => 'HN'
                        ],
                            [
                            'attribute' => 'PatientName',
                            'header' => 'ชื่อ-สกุล'
                        ],
                            [
                            'attribute' => 'admday',
                            'header' => 'จ.วันAdmit'
                        ],
                            [
                            'attribute' => 'adjrw',
                            'header' => 'adjrw'
                        ],
                            [
                            'attribute' => 'dchstts',
                            'label' => 'dchstts'
                        ],
                            [
                            'attribute' => 'datemodify',
                            'label' => 'datemodify'
                        ],
                            [
                            'attribute' => 'tcount',
                            'label' => '#',
                            'value' => function($model, $key) {
                                $tcount = $model['tcount'];
                                $an = $model['an'];
                                $date1 = $model['date1'];
                                $date2 = $model['date2'];
                                if ($model['tcount'] > 6) {
                                    return Html::a("<span class='badge' style='background-color: #0099ff' >$tcount</span>", ['/report/mrs1detail', 'an' => $an,'date1'=>$date1,'date2'=>$date2], [
                                                'class' => 'activity-add-link',
                                                'title' => 'ดู diag ทั้งหมด',
                                                'data-toggle' => 'modal',
                                                'data-target' => '#modalvote',
                                                    //'data-whatever'=>$model['an'],
                                                    //'data-id' => $model['an'],
                                    ]);
                                } else {
                                    return  $model['tcount'];
                                }
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'middle',
                            'format' => 'raw',
                        ],
                            [
                            'attribute' => 'pdx',
                            'header' => 'pdx'
                        ],
                            [
                            'attribute' => 'name',
                            'header' => 'name'
                        ],
                            [
                            'attribute' => 'dx0',
                            'header' => 'dx0'
                        ],
                            [
                            'attribute' => 'dx1',
                            'header' => 'dx1'
                        ],
                            [
                            'attribute' => 'dx2',
                            'header' => 'dx2'
                        ],
                            [
                            'attribute' => 'dx3',
                            'header' => 'dx3'
                        ],
                            [
                            'attribute' => 'dx4',
                            'header' => 'dx4'
                        ],
                            [
                            'attribute' => 'dx5',
                            'header' => 'dx5'
                        ],
                            [
                            'attribute' => 'op0',
                            'header' => 'op0'
                        ],
                            [
                            'attribute' => 'op1',
                            'header' => 'op1'
                        ],
                            [
                            'attribute' => 'op2',
                            'header' => 'op2'
                        ],
                            [
                            'attribute' => 'op3',
                            'header' => 'op3'
                        ],
                            [
                            'attribute' => 'op4',
                            'header' => 'op4'
                        ],
                            [
                            'attribute' => 'op5',
                            'header' => 'op5'
                        ],
                            [
                            'attribute' => 'op6',
                            'header' => 'op6'
                        ]
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

<div class="modal remote fade " id="modalvote">
    <div class="modal-dialog modal-lg">
        <div class="modal-content  "></div>
    </div>
</div>