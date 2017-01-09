<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use kartik\widgets\DatePicker;
//use kartik\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

$sql="SELECT i.hn,i.an,CONCAT(p.pname,p.fname,'   ',p.lname) AS tname,a.age_y
FROM ipt i
LEFT JOIN patient p ON p.hn=i.hn
LEFT JOIN an_stat a ON a.an=i.an
WHERE i.an='$an'" ;

$connection = Yii::$app->db2;
$datat = $connection->createCommand($sql)
                ->queryAll();

        for ($i = 0; $i < sizeof($datat); $i++) {
            $hn = $datat[$i]['hn'];
            $an = $datat[$i]['an'];
            $tname = $datat[$i]['tname'];
            $age_y = $datat[$i]['age_y'] * 1;
        }
?>

<div class="body-content">
    
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body">
                    AN : <?=$an?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ชื่อ-สกุล : <?=$tname?>
                    <p>HN : <?=$hn?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; อายุ : <?=$age_y?>  </p>
                    <p>หมวด :  </p>
 
                </div>

            </div>
        </div>
    </div>
    

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"> <i class='glyphicon glyphicon-search'></i> รายงานผู้ป่วยโรคเข่าเสื่อม</h3>

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
                            'attribute' => 'rxdate',
                            'header' => 'วันที่สั่ง'
                        ],
                         [
                            'attribute' => 'icode',
                            'header' => 'icode'
                        ],
                        [
                            'attribute' => 'sname',
                            'header' => 'รายการ',
                            'pageSummary' => 'รวมทั้งหมด'
                        ],
                        [
                            'attribute' => 'qty',
                            'header' => 'จำนวน',
                             'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                             'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                         [
                            'attribute' => 'cost',
                            'header' => 'ราคาต้นทุน',
                             'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                             'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                         [
                            'attribute' => 'sum_price',
                            'header' => 'ราคาขาย',
                             'format' => ['decimal', 2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                             'pageSummaryOptions' => ['id' => 'total_sum'],
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
                        'showPageSummary' => true,
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