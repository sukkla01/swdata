<?php

use yii\bootstrap\Html;
use kartik\widgets\DatePicker;
//use kartik\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\alert\Alert;
//use lavrentiev\widgets\toastr\NotificationFlash;
use lavrentiev\widgets\toastr\Notification;
?>

<?php
$tan = '';
$sql = "SELECT f.an,
                        COUNT(foodid)  as tcount
                        FROM food_detail_01  f
                        LEFT JOIN ipt i ON i.an=f.an
                        WHERE f.fooddate=CURDATE() 
                        AND f.ward='$ward' AND i.dchdate IS NULL
                        GROUP BY an,fooddate
                        HAVING tcount >1  ";
$connection = Yii::$app->db2;
$data = $connection->createCommand($sql)
        ->queryAll();
for ($i = 0; $i < sizeof($data); $i++) {
    $tan = $data[$i]['an'];
}
?>


<?php
if ($order_complete == 'Y') {
    echo Alert::widget([
        'type' => Alert::TYPE_DANGER,
        'title' => 'ไม่สามารถสั่งซ้ำได้  ',
        'titleOptions' => ['icon' => 'info-sign'],
        'body' => 'เนื่องจากวันนี้มีการสั่งอาหารเดิมแล้ว'
    ]);
}
?>

<?php if ($process == 'Y') { ?>
    <div class="col-md-12">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> สั่งอาหารเรียบร้อยแล้ว!  refresh ข้อมูลโดยการกด ประมวลผล</h4>

        </div>    
    </div>
<?php } ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-body">



                <?php
                ActiveForm::begin([
                    'method' => 'post',
                    'action' => Url::to(['/food', ['ward' => $ward]]),
                ])
                ?>
                <div class="col-md-4">
                    <?php
                    echo Select2::widget([
                        'name' => 'ward',
                        'value' => $ward,
                        'data' => ArrayHelper::map(app\models\Ward::find()->all(), 'ward', 'name'),
                        'theme' => Select2::THEME_KRAJEE, // this is the default if theme is not set
                        'options' => ['placeholder' => ' กรุณาเลือกหอผู้ป่วย...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); // Classic Theme
                    ?>
                </div>
                <button class='btn btn-danger'>ประมวลผล</button>

                <?php ActiveForm::end(); ?>



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
                <div class="pull-left"><span style="font-weight: bold;" class="btn btn-primary btn-flat"><h5><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;โปรแกรมสั่งอาหารผู้ป่วยใน</h5></span></div>



                <div class="box-tools pull-right">
                    &nbsp;&nbsp;<a style="font-weight: bold;" class="btn btn-info"  href="<?= Url::to(['/food/default/pdftotal', 'ward' => $ward]) ?>" target="_blank"><h5><i class="fa fa-pinterest-p"></i>&nbsp;&nbsp;พิมพ์การเพิ่มอาหาร</h5></a>
                    &nbsp;&nbsp;<a style="font-weight: bold;" class="btn btn-danger"  href="<?= Url::to(['/food/default/orderold', 'ward' => $ward]) ?>"><h5><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;สั่งอาหารเดิม</h5></a>
                    <?php if ($tan <> '') { ?>
                        <a style="font-weight: bold;" class="btn btn-success" data-toggle="modal" data-target="#myModal" ><h5><i class="fa fa-print" ></i>&nbsp;&nbsp;พิมพ์</h5></a>
                    <?php } else { ?>
                        &nbsp;&nbsp;<a style="font-weight: bold;" class="btn btn-success" id="btn_sql" data-dismiss="modal" href="<?= Url::to(['/food/default/pdf', 'ward' => $ward]) ?>" target="_blank" ><h5><i class="fa fa-print" ></i>&nbsp;&nbsp;พิมพ์</h5></a>
                    <?php } ?>
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
                        'label' => 'AN',
                        'value' => function ($model, $key, $index, $widget) {
                            $cdate = date('Y-m-d');
                            if ($model['dis'] == 'Y') {
                                return "<font class='text-red'>" . $model['an'] . "</font>";
                            } else {
                                return "<font class='text-black'>" . $model['an'] . "</font>";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        [
                        'attribute' => 'bedno',
                        'label' => 'เตียง',
                        'value' => function ($model, $key, $index, $widget) {
                            $cdate = date('Y-m-d');
                            if ($model['dis'] == 'Y') {
                                return "<font class='text-red'>" . $model['bedno'] . "</font>";
                            } else {
                                return "<font class='text-black'>" . $model['bedno'] . "</font>";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        [
                        'attribute' => 'tname',
                        'label' => 'ชื่อ-สกุล',
                        'value' => function ($model, $key, $index, $widget) {
                            $cdate = date('Y-m-d');
                            if ($model['dis'] == 'Y') {
                                return "<font class='text-red'>" . $model['tname'] . "</font>";
                            } else {
                                return "<font class='text-black'>" . $model['tname'] . "</font>";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        [
                        'attribute' => 'regdate',
                        'label' => 'วันที่ Admit',
                        'value' => function ($model, $key, $index, $widget) {
                            $cdate = date('Y-m-d');
                            if ($model['dis'] == 'Y') {
                                return "<font class='text-red'>" . $model['regdate'] . "</font>";
                            } else {
                                return "<font class='text-black'>" . $model['regdate'] . "</font>";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        [
                        'attribute' => 'regtime',
                        'label' => 'เวลา Admit',
                        'value' => function ($model, $key, $index, $widget) {
                            $cdate = date('Y-m-d');
                            if ($model['dis'] == 'Y') {
                                return "<font class='text-red'>" . $model['regtime'] . "</font>";
                            } else {
                                return "<font class='text-black'>" . $model['regtime'] . "</font>";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        [
                        'attribute' => 'nname',
                        'label' => 'รายการอาหาร',
                        'value' => function ($model, $key, $index, $widget) {
                            $cdate = date('Y-m-d');
                            if ($model['dis'] == 'Y') {
                                return "<font class='text-red'>" . $model['nname'] . "</font>";
                            } else {
                                if ($model['fooddate'] == $cdate) {
                                    return "<font class='text-green'>" . $model['nname'] . "</font>";
                                } else {
                                    return "<font class='text-red'>" . $model['nname'] . "</font>";
                                }
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        [
                        'attribute' => 'fooddate',
                        'label' => 'วันที่สั่งอาหารล่าสุด',
                        'value' => function ($model, $key, $index, $widget) {
                            $cdate = date('Y-m-d');
                            if ($model['dis'] == 'Y') {
                                return "<font class='text-red'>" . $model['fooddate'] . ' ' . $model['foodtime'] . "</font>";
                            } else {
                                if ($model['fooddate'] == $cdate) {
                                    return "<font class='text-green'>" . $model['fooddate'] . ' ' . $model['foodtime'] . "</font>";
                                } else {
                                    return "<font class='text-red'>" . $model['fooddate'] . ' ' . $model['foodtime'] . "</font>";
                                }
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
                        'label' => 'น้ำหนัก',
                        'format' => ['decimal', 0],
                        'hAlign' => 'center',
                    ],
                        [
                        'attribute' => 'bmi',
                        'label' => 'bmi'
                    ],
                        [
                        'attribute' => 'an',
                        'label' => '#',
                        'value' => function($model, $key) {
                            $an = $model['an'];
                            $bed = $model['bedno'];
                            $ward = $model['ward'];
                            return Html::a("<span class='badge' style='background-color: #0099ff' ><i class='fa fa-cart-plus'></i></span>", ['/food/foodadd/create', 'an' => $an, 'bed' => $bed, 'ward' => $ward], [
                                        'class' => 'activity-add-link',
                                        'title' => 'สั่งอาหาร',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#modalvote',
                                            //'data-whatever'=>$model['an'],
                                            //'data-id' => $model['an'],
                            ]);
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    ],
                ];
                /*
                  echo '<div class="col-md-12" align="right" >';
                  echo ExportMenu::widget([
                  'dataProvider' => $dataProvider,
                  'columns' => $gridColumns
                  ]);
                  echo '</div>'; */
                Pjax::begin(['id' => 'tfood']);
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
                    'responsive' => true,
                    'hover' => true,
                    'resizableColumns' => true,
                        // 'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
                        //'floatHeader' => true,
                        //'floatHeaderOptions' => ['scrollingTop' => '100'],
                        // 'pjax' => true,
                        //'pjaxSettings' => [
                        //    'neverTimeout' => true,
                        //'beforeGrid' => 'My fancy content before.',
                        //'afterGrid' => 'My fancy content after.',
                        //],
                ]);
                Pjax::end();
                ?>






            </div>

        </div>

    </div>

</div>

<div class="modal remote fade " id="modalvote">
    <div class="modal-dialog modal-lg">
        <div class="modal-content  "></div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-ban" ></i>&nbsp;&nbsp;ไม่สามารถสั่งพิมพ์ได้ เนื่องจากมีการสั่งอาหารซ้ำ ดังนี้</h3>
                </div>
                <div class="panel-body">
                    <div class="modal-body">
                        <?php
                        $tan = '';
                        $sql = "SELECT f.an,f.hn,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
                            COUNT(foodid)  as tcount,bedno
                            FROM food_detail_01  f
                            LEFT JOIN patient p ON p.hn=f.hn
			    LEFT JOIN ipt i ON i.an=f.an
                            left join iptadm d on d.an = f.an
                            WHERE f.fooddate=CURDATE() 
                            AND f.ward='$ward' AND i.dchdate IS NULL
                            GROUP BY an,fooddate
                            HAVING tcount >1 ";
                        $connection = Yii::$app->db2;
                        $data = $connection->createCommand($sql)
                                ->queryAll();
                        ?>
                        <table class="table">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>#</th>
                                    <th>เตียง</th>
                                    <th>AN</th>
                                    <th>HN</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th>จำนวนการสั่งวันนี้/ครั้ง</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < sizeof($data); $i++) { ?>
                                    <tr>
                                        <th scope="row"><?= $i + 1 ?></th>
                                        <td><?= $data[$i]['bedno']; ?></td>
                                        <td><?= $data[$i]['an']; ?></td>
                                        <td><?= $data[$i]['hn']; ?></td>

                                        <td><?= $data[$i]['tname']; ?></td>
                                        <td align="center"><?= $data[$i]['tcount']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>



        </div>

    </div>
</div>
<div class="container">
    <div class="row">
        <p><font size="5" >หมายเหตุ</font></p>
        <p><font size="3" color="red">*** an เตียง ชื่อ เป็นสีแดง แสดงว่าคนไข้คนนั้นถูกจำหน่ายเรียบร้อยแล้ว</font></p>
        <p><font size="3" color="red">*** รายการอาหารเป็นสีแดง แสดงว่า วันนี้ยังไม่ได้สั่งอาหาร</font></p>
        <p><font size="3" color="green">*** รายการอาหารเป็นสีเขียว แสดงว่า วันนี้สั่งอาหารเรียบร้อยแล้ว</font></p>
    </div>
</div>


<?php
if (isset($_GET['modal'])) {
    $modal = $_GET['modal'];
}

if ($modal <> '1') {
    $sql3 = " SELECT name FROM ward WHERE ward ='$ward' ";
    $command = Yii::$app->db2->createCommand($sql3);
    $wname = $command->queryScalar();
    echo Notification::widget([
        'type' => 'info',
        'title' => 'ยินดีต้อนรับระบบสั่งอาหารผู้ป่วยใน',
        'message' => 'หอผู้ป่วย : ' . $wname,
        'options' => [
            "closeButton" => FALSE,
            "debug" => false,
            "newestOnTop" => true,
            "progressBar" => true,
            "positionClass" => "toast-top-center",
            "preventDuplicates" => false,
            "onclick" => NULL,
            "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "5000",
            "extendedTimeOut" => "100",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut"
        ]
    ]);
}
?>


<?php
/* $this->registerJs('
  function init_click_handlers(){
  $(".activity-add-link").click("pjax:end",function() {

  console.log("gggggggg");
  // $.pjax.reload({container:"#tfood"});
  });

  }
  init_click_handlers(); //first run
  '); */
?>