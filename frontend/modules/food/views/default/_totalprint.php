
<?php

use yii\bootstrap\Html;

$sql = "SELECT t1.logdate,t1.logtime,t1.icode,n.name AS nname,t1.modifytype,t1.an,
			 CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
			 a.bedno,w.name AS wname
            FROM(
            SELECT * 
            FROM food_log_01 
            WHERE logdate = CURDATE() ) AS t1
            INNER JOIN (SELECT MAX(logtime) AS ttime,an FROM food_log_01  WHERE logdate = CURDATE() GROUP BY an ) AS t2 
                        ON t2.an = t1.an  AND t2.ttime = t1.logtime 
            LEFT JOIN nutrition_items n ON n.icode = t1.icode
            LEFT JOIN ipt i ON i.an = t1.an
            LEFT JOIN patient p ON p.hn =t1.hn
            LEFT JOIN iptadm a ON a.an = t1.an
            LEFT JOIN ward w ON w.ward = i.ward
            ORDER BY i.ward,a.bedno ";
$connection = Yii::$app->db2;
$data = $connection->createCommand($sql)
        ->queryAll();


$time = time();

$daten = Yii::$app->formatter->asDate($time, 'long');
?>

<table> 
    <tr> 
        <td> 
            <?= Html::img(Yii::getAlias('@frontend') . '/web/images/srisangworn.jpg', ['width' => 80]) ?> 
        </td> 
        <td> 
            <h3>ใบสรุปการเพิ่มอาหารหรือการเปลี่ยนอาหารรายวัน <?php ?></h3> <br />
            <h3>วันที่  <?= $daten; ?> </h3> 
        </td> 
    </tr> 
</table>

<table class="table_bordered" width="100%" border="0" cellpadding="2" cellspacing="0"> 
    <tr> 
        <td height="30" align="center" >No</td> 
        <td align="center">เตียง</td> 
        <td>ชื่อ-สกุล</td> 
        <td align="center">สถานะ</td> 
        <td align="center">รายการอาหาร</td> 
        <td align="center">วันเวลา</td> 
        <td>ward</td> 
    </tr> 
    <?php for ($i = 0; $i < sizeof($data); $i++) { ?>
        <?php
        $bedno = $data[$i]['bedno'];
        $tname = $data[$i]['tname'];
        $nname = $data[$i]['nname'];
        $modifytype = $data[$i]['modifytype'];
        $logdate = $data[$i]['logdate'];
        $logtime = $data[$i]['logtime'];
        $wname = $data[$i]['wname'];
        ?>
        <tr> 
            <td width="8%"  align="center" height="32"><?= $i + 1 ?></td> 
            <td width="8%" align="center"><?= $bedno ?></td> 
            <td width="25%" align="left">&nbsp; <?= $tname ?></td> 
            <td width="8%" align="center"><?= $modifytype ?></td> 
            <td width="35%" align="left"><?= $nname ?></td> 
            <td width="20%" align="left"><?= $logdate.' '.$logtime ?></td> 
            <td width="22%" align="left"><?= $wname ?></td> 
        </tr> 

    <?php } ?>
</table>