<?php
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
use yii\helpers\Url;


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
            <div class="col-md-12">
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

                       
                        <!-- /.box-tools -->
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



