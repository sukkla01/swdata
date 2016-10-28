<?php
/* @var $this yii\web\View */

$this->title = 'My Yii Application';

use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
use kongoon\c3js\C3JS;

$connection = Yii::$app->db;
$sql = "SELECT 
SUM(IF(typeicd='DM',1,0)) AS dm,
SUM(IF(typeicd='HT',1,0)) AS ht,
SUM(IF(typeicd='DMHT',1,0)) AS dmht
FROM tmp_dmht ";
$data = $connection->createCommand($sql)
        ->queryAll();
for ($nu = 0; $nu < sizeof($data); $nu++) {
    $dm = $data[$nu]['dm'];
    $ht = $data[$nu]['ht'];
    $dmht = $data[$nu]['dmht'];
}
//print_r($tyear1)
?>
<div class="site-index">

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $dm ?></h3>

                    <p>ผู้ป่วยเบาหวาน(คน)</p>
                </div>
                <div class="icon">
                    <i class="fa fa-area-chart"></i>
                </div>
                <a href="<?= Url::to('index.php?r=dmht/dm') ?>" class="small-box-footer">
                    คลิกดูข้อมูล <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $ht ?></h3>

                    <p>ผู้ป่วยความดัน(คน)</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cart-plus"></i>
                </div>
                <a href="<?= Url::to('index.php?r=dmht/ht') ?>" class="small-box-footer">
                    คลิกดูข้อมูล <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= $dmht ?></h3>

                    <p>ผู้ป่วยที่เป็นเบาหวานและความดัน(คน)</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="<?= Url::to('index.php?r=dmht/dmht') ?>" class="small-box-footer">
                    คลิกดูข้อมูล <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-red">
                <div class="inner">
                    <h3>0</h3>

                    <p>comming</p>
                </div>
                <div class="icon">
                    <i class="fa fa-bell"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div> 
    </div>

</div>


<div class="body-content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <i class="fa fa-bell"></i>
                    ผู้ป่วยมะเร็งรายใหม่
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    echo Highcharts::widget([
                        'options' => [
                            'title' => ['text' => ''],
                            'xAxis' => [
                                'categories' => $tyear
                            ],
                            'yAxis' => [
                                'title' => ['text' => 'จำนวน(คน)']
                            ],
                            'series' => [
                                    ['type' => 'column',
                                    'name' => 'ผู้ป่วยมะเร็ง',
                                    'data' => $tcount,
                                    'color' => '#db7093',
                                    //'shadow' => TRUE
                                    'pointWidth' => 50
                                ],
                                    ['type' => 'line',
                                    //'name' => 'จัดการได้',
                                    'data' => $tcount,
                                ],
                            //['name' => 'John', 'data' => [5, 7, 3]]
                            ]
                        ]
                    ]);
                    ?>





                </div>
                <!-- /.box-header -->

            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">


                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?=
                    C3JS::widget([
                        'options' => [
                            'data' => [
                                'x' => 'x',
                                'columns' => [
                                        ['x', '2016-01-01', '2016-02-01', '2016-03-01', '2016-04-01', '2016-05-01', '2016-06-01'],
                                        ['data1', 30, 200, 100, 400, 150, 250],
                                        ['data2', 50, 20, 10, 40, 15, 25]
                                ],
                                'types' => [
                                    'data1' => 'bar',
                                    //'data2' => 'bar'
                                ],
                            ],
                            'axis' => [
                                'y' => [
                                    'label' => [
                                        'text' => 'Y Label',
                                        'position' => 'outer-middle',
                                    ]
                                ],
                                'x' => [
                                    'type' => 'timeseries',
                                    'tick' => [
                                        'format' => '%Y-%m-%d'
                                    ],
                                    'label' => [
                                        'text' => 'X Label',
                                        'position' => 'outer-middle',
                                    ]
                                ]
                            ]
                        ],
                    ])
                    ?>
                </div>
                <!-- /.box-header -->

            </div>
        </div>
    </div>
</div>

<hr>
<?php
//echo Yii::$app->security->generatePasswordHash('p07437');
?>



