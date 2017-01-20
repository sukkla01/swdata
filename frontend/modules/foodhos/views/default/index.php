<?php

use yii\bootstrap\Html;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\alert\Alert;
use yii\bootstrap\Modal;
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




$sql = "SELECT i.hn,i.an,a.bedno,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
                CONCAT(s.age_y,' ปี ',s.age_m,' เดือน ',s.age_d,' วัน') AS tage,
                i.regdate,i.regtime
                ,o.height,o.bw,o.bmi
                FROM ipt i
                LEFT JOIN patient p ON p.hn = i.hn
                LEFT JOIN iptadm a ON a.an = i.an
                LEFT JOIN an_stat s ON s.an = i.an
                LEFT JOIN opdscreen o ON o.vn = i.vn
                WHERE i.dchdate IS NULL AND i.ward ='$ward' 
                ORDER BY  bedno    ";
$connection = Yii::$app->db2;
$data = $connection->createCommand($sql)
        ->queryAll();
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
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-body">



                <?php
                ActiveForm::begin([
                    'method' => 'post',
                    'action' => Url::to(['/foodhos', ['ward' => $ward]]),
                ])
                ?>
                <div class="col-md-1">หอผู้ป่วย  :</div>
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
<?php if ($process == 'Y') { ?>
    <div class="col-md-6">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> สั่งอาหารเรียบร้อยแล้ว!</h4>

        </div>    
    </div>
<?php } ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <div class="pull-left"><span style="font-weight: bold;" class="btn btn-primary btn-flat"><h5><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;โปรแกรมสั่งอาหารผู้ป่วยใน</h5></span></div>



                <div class="box-tools pull-right">

                    &nbsp;&nbsp;<a style="font-weight: bold;" class="btn btn-danger"  href="<?= Url::to(['/foodhos/default/orderold', 'ward' => $ward]) ?>"><h5><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;สั่งอาหารเดิม</h5></a>
                    <?php if ($tan <> '') { ?>
                        <a style="font-weight: bold;" class="btn btn-success" data-toggle="modal" data-target="#myModal" ><h5><i class="fa fa-print" ></i>&nbsp;&nbsp;พิมพ์</h5></a>
                    <?php } else { ?>
                        &nbsp;&nbsp;<a style="font-weight: bold;" class="btn btn-success" id="btn_sql" data-dismiss="modal" href="<?= Url::to(['/foodhos/default/pdf', 'ward' => $ward]) ?>" target="_blank" ><h5><i class="fa fa-print" ></i>&nbsp;&nbsp;พิมพ์</h5></a>
                    <?php } ?>


                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">

                <table class="table table-hover">
                    <?php $color = "bgcolor='e6f5ff'"; ?>
                    <tr bgcolor="ccccb3">
                        <th>#</th>
                        <th>HN</th>
                        <th>AN</th>
                        <!--<th align="center">Preview</th>-->
                        <th>เตียง</th>
                        <th>ชื่อ-สกุล</th>
                        <th>วันที่ Admit</th>
                        <th>เวลา Admit</th>
                        <th>รายการอาหาร</th>
                        <th>วันที่สั่งหาหารล่าสุด</th>
                        <th>โรคประจำตัว</th>
                        <th>สูง</th>
                        <th>น้ำหนัก</th>
                        <th>bmi</th>
                        <th>#</th>

                    </tr>

                    <?php for ($i = 0; $i < sizeof($data); $i++) { ?>
                        <?php
                        $an = $data[$i]['an'];
                        $bed = $data[$i]['bedno'];
                        $fooddate = '';
                        $foodtime = '';
                        $fname = '';
                        $tcheck = 'N';
                        $cd = '';
                        $sqlf = "SELECT fooddate,foodtime,n.name,bd,cal,Congenital_disease,comment,
                                        IF(fooddate=CURDATE(),'Y','N') AS tcheck
                                        FROM food_detail_01  f
                                        LEFT JOIN nutrition_items n ON n.icode = f.icode
                                        WHERE an='$an'
                                        ORDER BY foodid DESC
                                        LIMIT 1";
                        $dataf = $connection->createCommand($sqlf)
                                ->queryAll();
                        for ($il = 0; $il < sizeof($dataf); $il++) {
                            $fooddate = $dataf[$il]['fooddate'];
                            $foodtime = $dataf[$il]['foodtime'];
                            $fname = $dataf[$il]['name'];
                            $cd = $dataf[$il]['Congenital_disease'];
                            $tcheck = $dataf[$il]['tcheck'];
                        }
                        ?>
                        <tr <?= $color ?> >
                            <td><?= $i + 1 ?></td>
                            <td><?= $data[$i]['hn'] ?></td>
                            <td><?= $data[$i]['an'] ?></td>
                            <td><?= $data[$i]['bedno'] ?></td>
                            <td><?= $data[$i]['tname'] ?></td>
                            <td><?= $data[$i]['regdate'] ?></td>
                            <td><?= $data[$i]['regtime'] ?></td>
                            <?php if ($tcheck == 'Y') { ?>
                                <td><font color="green"><?= $fname ?></font></td>
                                <td><font color="green"><?= $fooddate . ' ' . $foodtime ?></font></td>
                                <td><font color="green"><?= $cd ?></font></td>
                            <?php } else { ?>
                                <td><font color="red"><?= $fname ?></font></td>
                                <td><font color="red"><?= $fooddate . ' ' . $foodtime ?></font></td>
                                <td><font color="red"><?= $cd ?></font></td>
                            <?php } ?>
                            <td><?= $data[$i]['height'] ?></td>
                            <td><?= $data[$i]['bw'] ?></td>
                            <td><?= $data[$i]['bmi'] ?></td>
                            <td><a href="<?= Url::to(['/foodhos/foodadd/create', 'an' => $an, 'bed' => $bed]) ?>" target="_blank"><i class='fa fa-cart-plus'></i></a></td>

                        </tr>   
                    <?php } ?>


                </table>




            </div>
        </div>
    </div>
</div>



<!-- Modal -->
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>



        </div>

    </div>
</div>