<?php
/* @var $this yii\web\View */
use yii\bootstrap\Html;
use yii\jui\DatePicker;
//use kartik\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

$sql="select vstdate from tmp_dmht ORDER BY  vstdate desc limit 1";
$connection = Yii::$app->db;
$data = $connection->createCommand($sql)
        ->queryAll();
for ($nu = 0; $nu < sizeof($data); $nu++) {
    $vstdate = $data[$nu]['vstdate'];
}
?>


<div class="body-content">
    <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-body">
                       ประมวลข้อมูลระหว่าง 2015-10-01  ถึง  <?=$vstdate?>

                       
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"> <i class='glyphicon glyphicon-search'></i> ผู้ป่วยความดัน</h3>

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
                            'attribute' => 'hn',
                            'label' => 'hn'
                        ],
                            [
                            'attribute' => 'vstdate',
                            'label' => 'วันที่'
                        ],
                            [
                            'attribute' => 'tname',
                            'header' => 'ชื่อ-สกุล'
                        ],
                            [
                            'attribute' => 'cid',
                            'header' => 'CID'
                        ],
                            [
                            'attribute' => 'age_y',
                            'header' => 'อายุ'
                        ],
                            [
                            'attribute' => 'taddr',
                            'label' => 'ที่อยู่'
                        ],
                            [
                            'attribute' => 'moopart',
                            'header' => 'หมู่'
                        ],
                            [
                            'attribute' => 'tmbpart',
                            'header' => 'ตำบล'
                        ],
                            [
                            'attribute' => 'amppart',
                            'header' => 'อำเภอ'
                        ],
                            [
                            'attribute' => 'chwpart',
                            'header' => 'จังหวัด'
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