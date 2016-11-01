<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$sqleh001 = "SELECT COUNT(p.hn)  AS tcount
FROM patient p
LEFT JOIN person ps ON ps.patient_hn=p.hn
WHERE type_area IN('1','3') AND ps.cid IS NULL";
$command = Yii::$app->db2->createCommand($sqleh001);
$eh001 = $command->queryScalar();

$sqleh002 = "SELECT COUNT(p.cid) tcount
FROM person p
WHERE house_regist_type_id IS NULL";
$command = Yii::$app->db2->createCommand($sqleh002);
$eh002 = $command->queryScalar();

$sqleh003 = "SELECT COUNT(p.cid) tcount
FROM person p
WHERE person_house_position_id IS NULL";
$command = Yii::$app->db2->createCommand($sqleh003);
$eh003 = $command->queryScalar();

$sqleh004 = "SELECT COUNT(p.cid) tcount
FROM person p
WHERE education IS NULL";
$command = Yii::$app->db2->createCommand($sqleh004);
$eh004 = $command->queryScalar();

$sqleh005 = "SELECT COUNT(p.cid) tcount
FROM person p
WHERE Year(CURDATE())-YEAR(birthdate) BETWEEN '6' AND '12'
			AND education <>'1'";
$command = Yii::$app->db2->createCommand($sqleh005);
$eh005 = $command->queryScalar();

$sqleh006 = "SELECT COUNT(p.cid) tcount
FROM person p
WHERE occupation IS NULL";
$command = Yii::$app->db2->createCommand($sqleh006);
$eh006 = $command->queryScalar();

$sqleh007 = "SELECT COUNT(p.cid) tcount
FROM person p
WHERE pname IS NULL";
$command = Yii::$app->db2->createCommand($sqleh007);
$eh007 = $command->queryScalar();

$sqleh008 = "SELECT COUNT(p.cid) tcount
FROM person p
WHERE (pname IN('ด.ช.','นาย','พระ','พระครู') AND sex ='2') OR (pname IN('ด.ญ.','น.ส.','นาง') AND sex ='1')";
$command = Yii::$app->db2->createCommand($sqleh008);
$eh008 = $command->queryScalar();

$sqleh009 = "SELECT COUNT(p.cid) tcount
FROM person p
WHERE (pttype IS NULL OR pttype='') ";
$command = Yii::$app->db2->createCommand($sqleh009);
$eh009 = $command->queryScalar();

$sqleh010 = "SELECT COUNT(p.cid) tcount
FROM person p
WHERE  death ='Y' AND person_discharge_id='9' ";
$command = Yii::$app->db2->createCommand($sqleh010);
$eh010 = $command->queryScalar();

$sqleh011 = "SELECT COUNT(p.cid) tcount
FROM person p
WHERE  death ='Y' AND (discharge_date IS NULL OR discharge_date ='')";
$command = Yii::$app->db2->createCommand($sqleh011);
$eh011 = $command->queryScalar();

$sqleh012 = "SELECT COUNT(p.cid) tcount
FROM person p
WHERE house_regist_type_id IN('1','3') AND nationality='99' AND cid LIKE '0%'";
$command = Yii::$app->db2->createCommand($sqleh012);
$eh012 = $command->queryScalar();

$sqleh013 = "SELECT COUNT(p.cid) tcount
FROM person p
WHERE (YEAR(CURDATE())-YEAR(birthdate)) > 100";
$command = Yii::$app->db2->createCommand($sqleh013);
$eh013 = $command->queryScalar();

$sqleh014 = "SELECT COUNT(p.cid) tcount
FROM person p
WHERE house_regist_type_id IN('1','3') AND nationality<>'99' ";
$command = Yii::$app->db2->createCommand($sqleh014);
$eh014 = $command->queryScalar();
?>


<?php
echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' => [
            [
            'label' => 'ข้อมูล 43 แฟ้ม',
            //'url' => ['post-category/view'],
            //'template' => "<li><b>{link}</b></li>\n", // template for this link only
        ],
            
        'เอ๊ะ!!',
    ],
]);
?>


<div class="row">
    <div class="col-md-12">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">เอ๊ะ!! ในบัญชี 1 และเวชระเบียน</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php $color = "bgcolor='e6f5ff'"; ?>
                <table class="table table-hover">

                    <tr bgcolor="ccccb3">
                        <th>#</th>
                        <th>รายการ</th>
                        <th>จำนวน/คน</th>
                        <th align="center">Preview</th>
                    </tr>
                    <tr <?= $color ?> >
                        <td>1</td>
                        <td>ผู้ป่วย Type 1 กับ 3 ที่อยู่ใน Patient แต่ไม่อยู่ในบัญชี 1</td>
                        <td>
                            <?php if ($eh001 > 0) { ?>
                                <span class="label label-danger"><?= $eh001 ?></span>
                            <?php } else { ?>
                                <span class="label label-success"><?= $eh001 ?></span>
                            <?php } ?>

                        </td>
                        <td ><a href="<?= Url::to('index.php?r=eh/eh001') ?>"><i class='fa fa-tv'></i></a></td>
                    </tr >
                    <tr <?= $color ?>>
                        <td>2</td>
                        <td>ผู้ป่วย TypeArea ในบัญชี 1 เป็นค่าว่าง</td>
                        <td>
                            <?php if ($eh002 > 0) { ?>
                                <span class="label label-danger"><?= $eh002 ?></span>
                            <?php } else { ?>
                                <span class="label label-success"><?= $eh002 ?></span>
                            <?php } ?>
                        </td>
                        <td ><a href="<?= Url::to('index.php?r=eh/eh002') ?>"><i class='fa fa-tv'></i></a></td>
                        
                    </tr>
                    <tr <?= $color ?>>
                        <td>3</td>
                        <td>สถานะในครอบครัว 1=เจ้าบ้าน 2=ผู้อาศัย ในบัญชี 1 ว่าง</td>
                        <td>
                            <?php if ($eh003 > 0) { ?>
                                <span class="label label-danger"><?= $eh003 ?></span>
                            <?php } else { ?>
                                <span class="label label-success"><?= $eh003 ?></span>
                            <?php } ?>
                        </td>
                        <td ><a href="<?= Url::to('index.php?r=eh/eh003') ?>"><i class='fa fa-tv'></i></a></td>
                    </tr>

                    <tr <?= $color ?>>
                        <td>4</td>
                        <td>การศึกษาในบัญชี 1 เป็นค่าว่าง</td>
                        <td>
                            <?php if ($eh004 > 0) { ?>
                                <span class="label label-danger"><?= $eh004 ?></span>
                            <?php } else { ?>
                                <span class="label label-success"><?= $eh004 ?></span>
                            <?php } ?>
                        </td>
                        <td ><a href="<?= Url::to('index.php?r=eh/eh004') ?>"><i class='fa fa-tv'></i></a></td>
                    </tr >
                    <tr <?= $color ?>>
                        <td>5</td>
                        <td>การศึกษา อายุ 6-12 ปีไม่ใช่ชั้นประถมในบัญชี 1 มีผลต่อ HDC</td>
                        <td>
                            <?php if ($eh005 > 0) { ?>
                                <span class="label label-danger"><?= $eh005 ?></span>
                            <?php } else { ?>
                                <span class="label label-success"><?= $eh005 ?></span>
                            <?php } ?>
                        </td>
                        <td ><a href="<?= Url::to('index.php?r=eh/eh005') ?>"><i class='fa fa-tv'></i></a></td>
                    </tr>
                    <tr <?= $color ?>>
                        <td>6</td>
                        <td>อาชีพในบัญชี 1 เป็นค่าว่าง</td>
                        <td>
                            <?php if ($eh006 > 0) { ?>
                                <span class="label label-danger"><?= $eh006 ?></span>
                            <?php } else { ?>
                                <span class="label label-success"><?= $eh006 ?></span>
                            <?php } ?>
                        </td>
                        <td ><a href="<?= Url::to('index.php?r=eh/eh006') ?>"><i class='fa fa-tv'></i></a></td>
                    </tr>
                    <tr <?= $color ?>>
                        <td>7</td>
                        <td>คำนำหน้าในบัญชี 1 pname เป็นค่าว่าง</td>
                        <td>
                            <?php if ($eh007 > 0) { ?>
                                <span class="label label-danger"><?= $eh007 ?></span>
                            <?php } else { ?>
                                <span class="label label-success"><?= $eh007 ?></span>
                            <?php } ?>
                        </td>
                        <td ><a href="<?= Url::to('index.php?r=eh/eh007') ?>"><i class='fa fa-tv'></i></a></td>
                    </tr >
                    <tr <?= $color ?>>
                        <td>8</td>
                        <td>คำนำหน้ากับเพศ ไม่สัมพันธ์กันเลยน่ะ</td>
                        <td>
                            <?php if ($eh008 > 0) { ?>
                                <span class="label label-danger"><?= $eh008 ?></span>
                            <?php } else { ?>
                                <span class="label label-success"><?= $eh008 ?></span>
                            <?php } ?>
                        </td>
                        <td ><a href="<?= Url::to('index.php?r=eh/eh008') ?>"><i class='fa fa-tv'></i></a></td>
                    </tr>
                    <tr <?= $color ?>>
                        <td>9</td>
                        <td>สิทธิการรักษาในบัญชี 1 เป็นค่าว่างทำให้ส่งออกไม่ได้</td>
                        <td>
                            <?php if ($eh009 > 0) { ?>
                                <span class="label label-danger"><?= $eh009 ?></span>
                            <?php } else { ?>
                                <span class="label label-success"><?= $eh009 ?></span>
                            <?php } ?>
                        </td>
                        <td ><a href="<?= Url::to('index.php?r=eh/eh009') ?>"><i class='fa fa-tv'></i></a></td>
                    </tr>
                    <tr <?= $color ?>>
                        <td>10</td>
                        <td>ลงติ๊กว่าเสียชีวิตแล้วในบัญชี 1 แต่แต่สถานะยังมีชีวิตอยู่ </td>
                        <td>
                            <?php if ($eh010 > 0) { ?>
                                <span class="label label-danger"><?= $eh010 ?></span>
                            <?php } else { ?>
                                <span class="label label-success"><?= $eh010 ?></span>
                            <?php } ?>
                        </td>
                        <td ><a href="<?= Url::to('index.php?r=eh/eh010') ?>"><i class='fa fa-tv'></i></a></td>
                    </tr >
                    <tr <?= $color ?>>
                        <td>11</td>
                        <td>ลงติ๊กว่าเสียชีวิตแล้วในบัญชี 1 แต่สถานะยังไม่ได้จำหน่าย</td>
                        <td>
                            <?php if ($eh011 > 0) { ?>
                                <span class="label label-danger"><?= $eh011 ?></span>
                            <?php } else { ?>
                                <span class="label label-success"><?= $eh011 ?></span>
                            <?php } ?>
                        </td>
                        <td ><a href="<?= Url::to('index.php?r=eh/eh011') ?>"><i class='fa fa-tv'></i></a></td>
                    </tr>
                    <tr <?= $color ?>>
                        <td>12</td>
                        <td>มีสัญชาตไทย แต่เลขที่บัตรประชาชน ขึ้นต้นด้วย 0 เฉพาะ Type 1,3</td>
                        <td>
                            <?php if ($eh012 > 0) { ?>
                                <span class="label label-danger"><?= $eh012 ?></span>
                            <?php } else { ?>
                                <span class="label label-success"><?= $eh012 ?></span>
                            <?php } ?>
                        </td>
                        <td ><a href="<?= Url::to('index.php?r=eh/eh012') ?>"><i class='fa fa-tv'></i></a></td>
                    </tr>
                    <tr <?= $color ?>>
                        <td>13</td>
                        <td>อายุเกิน 100 ปี</td>
                        <td>
                            <?php if ($eh013 > 0) { ?>
                                <span class="label label-danger"><?= $eh013 ?></span>
                            <?php } else { ?>
                                <span class="label label-success"><?= $eh013 ?></span>
                            <?php } ?>
                        </td>
                        <td ><a href="<?= Url::to('index.php?r=eh/eh013') ?>"><i class='fa fa-tv'></i></a></td>
                    </tr>
                    <tr <?= $color ?>>
                        <td>14</td>
                        <td>ไม่ใช่คนไทย แต่สถานะบุคคล เป็น Type 1,3</td>
                        <td>
                            <?php if ($eh014 > 0) { ?>
                                <span class="label label-danger"><?= $eh014 ?></span>
                            <?php } else { ?>
                                <span class="label label-success"><?= $eh014 ?></span>
                            <?php } ?>
                        </td>
                        <td ><a href="<?= Url::to('index.php?r=eh/eh014') ?>"><i class='fa fa-tv'></i></a></td>
                    </tr>


                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">เอ๊ะ!! ในทะเบียนคลินิกพิเศษ</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

            </div>
        </div>
    </div>
</div>