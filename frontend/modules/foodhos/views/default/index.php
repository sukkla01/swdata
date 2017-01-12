<?php

use yii\bootstrap\Html;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>
<?php
$sql = "SELECT i.hn,i.an,a.bedno,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
                CONCAT(s.age_y,' ปี ',s.age_m,' เดือน ',s.age_d,' วัน') AS tage,
                i.regdate,i.regtime
                ,o.height,o.bw,o.bmi
                FROM ipt i
                LEFT JOIN patient p ON p.hn = i.hn
                LEFT JOIN iptadm a ON a.an = i.an
                LEFT JOIN an_stat s ON s.an = i.an
                LEFT JOIN opdscreen o ON o.vn = i.vn
                WHERE i.dchdate IS NULL AND i.ward ='$ward'";
$connection = Yii::$app->db2;
$data = $connection->createCommand($sql)
        ->queryAll();
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-body">



                <?= Html::beginForm(); ?>
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
                <div class="pull-left"><span style="font-weight: bold;" class="btn btn-primary btn-flat"><h5><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;โปรแกรมสั่งอาหารผู้ป่วยใน</h5></span></div>



                <div class="box-tools pull-right">

                    &nbsp;&nbsp;<a style="font-weight: bold;" class="btn btn-danger" id="btn_sql"><h5><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;สั่งอาหารเดิม</h5></a>
                    &nbsp;&nbsp;<a style="font-weight: bold;" class="btn btn-success" id="btn_sql"><h5><i class="fa fa-print"></i>&nbsp;&nbsp;พิมพ์</h5></a>
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
                            <?php if($tcheck=='Y') { ?>
                            <td><font color="green"><?=$fname?></font></td>
                            <td><font color="green"><?=$fooddate.' '.$foodtime?></font></td>
                            <td><font color="green"><?=$cd?></font></td>
                            <?php }else{ ?>
                            <td><font color="red"><?=$fname?></font></td>
                            <td><font color="red"><?=$fooddate.' '.$foodtime?></font></td>
                            <td><font color="red"><?=$cd?></font></td>
                            <?php } ?>
                            <td><?= $data[$i]['height'] ?></td>
                            <td><?= $data[$i]['bw'] ?></td>
                            <td><?= $data[$i]['bmi'] ?></td>
                            <td><a href="<?= Url::to(['/foodhos/foodadd/create','an'=>$an,'bed'=>$bed]) ?>" target="_blank"><i class='fa fa-cart-plus'></i></a></td>

                        </tr>   
                    <?php } ?>


                </table>




            </div>
        </div>
    </div>
</div>