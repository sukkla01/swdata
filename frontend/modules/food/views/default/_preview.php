<?php

use yii\helpers\Html;

?>


<?php

    $excu =0;
    $normal=0;

 $sql_ward = "SELECT IF(ward IN('61','62','63','64'),name,CONCAT(name,',พิเศษ',name)) AS name2 FROM ward WHERE spclty = '$ward' LIMIT 1 ";
        $command = Yii::$app->db2->createCommand($sql_ward);
        $t_ward = $command->queryScalar();


$sql = "SELECT a.bedno,CONCAT(p.pname,p.fname,' ',p.lname)  AS tname,
            CONCAT(s.age_y) AS tage,
            f.Congenital_disease as cd,CONCAT(f.bd,' ',f.cal,' ',n.name) AS nname,f.comment
            FROM ipt i
            LEFT JOIN patient p ON p.hn = i.hn
            LEFT JOIN iptadm a ON a.an = i.an
            LEFT JOIN an_stat s ON s.an = i.an
            LEFT JOIN food_detail_01 f ON f.an = i.an AND f.fooddate = CURDATE()
            LEFT JOIN nutrition_items n ON n.icode = f.icode
            LEFT JOIN ward w ON w.ward = i.ward
            WHERE i.dchdate IS NULL AND w.spclty ='$ward'
                #AND n.name IS NOT NULL
            ORDER BY  a.bedno ";
$connection = Yii::$app->db2;
$data = $connection->createCommand($sql)
        ->queryAll();

Yii::$app->formatter->locale = 'th_TH';
$time = time();

$daten= Yii::$app->formatter->asDate($time, 'long');


 $tsql ="SELECT i.bedno
            FROM food_detail_01 f
            LEFT JOIN iptadm i ON i.an= f.an
            LEFT JOIN ipt it ON it.an=f.an
            LEFT JOIN ward w ON w.ward = it.ward
            WHERE f.fooddate = CURDATE() AND  w.spclty ='$ward' AND it.dchdate IS NULL ";
$tdata = $connection->createCommand($tsql)
        ->queryAll(); 
for ($ti = 0; $ti < sizeof($tdata); $ti++) {
    $bedno = $tdata[$ti]['bedno'];
    $tbed = substr($bedno,0,1);
            
         if(($tbed=='s' or $tbed=='6' or $tbed=='t') and substr($bedno,0,2)<>'tr' and substr($bedno,0,2)<>'sw' ) {
             $excu = $excu+1;
         }else{
             $normal = $normal+1; 
         }
}


?>

<table> 
    <tr> 
        <td> 
            <?= Html::img(Yii::getAlias('@frontend') . '/web/images/srisangworn.jpg', ['width' => 80]) ?> 
        </td> 
        <td> 
            <h3>ใบสั่งอาหารผู้ป่วยใน วันที่ <?php echo $daten ?></h3> <br />
            <h3>หอผู้ป่วย <?=$t_ward?> </h3> 
        </td> 
    </tr> 
</table>

<table class="table_bordered" width="100%" border="0" cellpadding="2" cellspacing="0"> 
    <tr> 
        <td height="30" align="center" >No</td> 
        <td align="center">เตียง</td> 
        <td>ชื่อ-สกุล</td> 
        <td align="center">อายุ/ปี</td> 
        <td align="center">โรคประจำตัว</td> 
        <td>รายการอาหาร</td> 
        <td>หมายเหตุ</td> 
    </tr> 
    <?php for ($i = 0; $i < sizeof($data); $i++) { ?>
        <?php
        $bedno = $data[$i]['bedno'];
        $tname = $data[$i]['tname'];
        $tage = $data[$i]['tage'];
        $cd = $data[$i]['cd'];
        $nname = $data[$i]['nname'];
        $comment = $data[$i]['comment'];
       
        ?>
        <tr> 
            <td width="3%"  align="center" height="32"><?= $i + 1 ?></td> 
            <td width="5%" align="center"><?=$bedno?></td> 
            <td width="25%" align="left">&nbsp; <?=$tname?></td> 
            <td width="8%" align="center"><?=$tage?></td> 
            <td width="10%" align="left"><?=$cd?></td> 
            <td width="35%" align="left"><?=$nname?></td> 
            <td width="22%" align="left"><?=$comment?></td> 
        </tr> 

    <?php } ?>
    <tr> 
            <td width="3%" align="center" height="28"><?= $i + 1 ?> </td> 
            <td ></td> 
            <td></td> 
            <td></td> 
            <td></td> 
            <td></td> 
            <td></td> 
        </tr> 
         <tr> 
            <td width="3%" align="center" height="28"><?= $i + 2 ?> </td> 
            <td></td> 
            <td></td> 
            <td></td> 
            <td></td> 
            <td></td> 
            <td></td> 
        </tr> 
         <tr> 
            <td width="3%" align="center" height="28"> <?= $i + 3 ?></td> 
            <td></td> 
            <td></td> 
            <td></td> 
            <td></td> 
            <td></td> 
            <td></td> 
        </tr> 
        
</table> 




<table width="100%"> 
    <tr> 
        <td>รวมยอดผู้ป่วย       ........<?=$i?>...... คน</td> 
        
    </tr> 
    <tr> 
        <td>รวมยอดผู้ป่วยสั่งอาหารพิเศษ       ........<?=$excu?>........ คน</td> 
        
    </tr>
    <tr> 
        <td>รวมยอดผู้ป่วยสั่งอาหารสามัญ       ........<?=$normal?>........ คน</td> 
        
    </tr>
</table> 