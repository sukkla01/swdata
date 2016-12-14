<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
//use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Html;
use kartik\grid\GridView;
?>


<div class="row">
    <div class="col-md-12">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <i class="fa fa-search"></i> 
                <h3 class="box-title">ค้นหาผู้ป่วย</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?= Html::beginForm(); ?>

                <label for="pwd">เลขบัตรประชาชน 13 หลัก : &nbsp;&nbsp; </label>
                <input type="text"  name="cid"  placeholder="">


                &nbsp;&nbsp;<button class='btn btn-danger'>ค้นหา</button>
                <?= Html::endForm(); ?>


            </div>
        </div>
    </div>
</div>

<?php if ($cid <> '') { ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-id-card-o"></i> 
                    <h3 class="box-title">ข้อมูลบุคคล</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <?php
                    if ($sex == '1') {
                        $ipath = Yii::$app->request->baseUrl . '/images/men.png';
                    } else {
                        $ipath = Yii::$app->request->baseUrl . '/images/women.png';
                    }
                    ?>


                    <div class="row" >
                        <div class="col-md-2">
                            <img src="<?= $ipath ?>" class="img-circle" alt="User Image" height="100" width="100" >
                        </div>
                        <div class="col-md-10">
                            <p> ชื่อ-สกุล  : <?= $tname ?> </p>
                            <p> ที่อยู่  : <?= $taddr ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="box box-info box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-calendar-check-o"></i> 
                    <h3 class="box-title">วันที่รับบริการ</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    <?php
                    $gridColumns = [
                            ['class' => 'kartik\grid\SerialColumn'],
                            [
                            'attribute' => 'date_serv',
                            'label' => 'วันที่'
                        ],
                            [
                            'attribute' => 'time_serv',
                            'label' => 'เวลา'
                        ],
                            [
                            'attribute' => 'hospcode',
                            'label' => 'สถานที่',
                            'value' => function($model, $key) {
                                return Html::a($model['hospcode'], ['emr', 'hospcode' => $model['hospcode'],
                                                                    'pid'=>$model['pid'],
                                                                    'seq'=>$model['seq']], ['target' => '_blank',
                                            'title' => $model['hospname'],
                                ]);
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'center',
                            'format' => 'raw',
                        ]
                    ];

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
                            /* 'pjax' => true,
                              'pjaxSettings' => [
                              'neverTimeout' => true,
                              //'beforeGrid' => 'My fancy content before.',
                              //'afterGrid' => 'My fancy content after.',
                              ] */
                    ]);
                    ?>

                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-info box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-th-large"></i> 
                    <h3 class="box-title">รายละเอียด</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="active"><a href="#">Lab</a></li>
                        <li role="presentation"><a href="#">ยา</a></li>
                        <li role="presentation"><a href="#">Messages</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php } ?>



