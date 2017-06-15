<?php

use yii\helpers\Url;
use yii\bootstrap\Html;
?>
<br>


<?php
$connection = Yii::$app->db5;
$sql = "SELECT * FROM oapp_event WHERE id ='$id' ";

$data = $connection->createCommand($sql)
        ->queryAll();
for ($i = 0; $i < sizeof($data); $i++) {
    $tname = $data[$i]['tname'];
    $hn = $data[$i]['hn'];
    $cid = $data[$i]['cid'];
    $pttype = $data[$i]['pttype'];
    $odate = $data[$i]['created_date'];
}
?>
<table style="margin: 0px auto;"> 
    <tr> 
        <td> 
            <?= Html::img(Yii::getAlias('@frontend') . '/web/images/srisangworn.jpg', ['width' => 120]) ?> 
        </td> 
        <td> 

        </td> 
    </tr> 
</table>

<table style="width:100%">
    <tr>
        <td width="20%"  align="right" height="60"><h2>ชื่อ - สกุล :</h2> </td>
        <td><h3><?= $tname ?></h3></td>
    </tr>
    <tr>
        <td width="50%"  align="right" height="60"><h3>เลขประจำตัวบัตรประชาชน  : </h3> </td>
        <td><h3><?= $cid ?></h3></td>
    </tr>
    <tr>
        <td width="50%"  align="right" height="60"><h2>HN  : </h2> </td>
        <td><h3><?= $hn ?></h3></td>
    </tr>
    <tr>
        <td width="50%"  align="right" height="60"><h2>วันที่นัด  : </h2> </td>
        <td><h3> <?= $odate ?></h3></td>
    </tr>



</table>
<table style="width:100%">
    <tr>
        <td width="100%"  align="center" height="60"><h2>แผนก หู คอ จมูก</h2> </td>

    </tr>
</table>
<br>

<table style="width:100%">
    <tr>
        <td width="10%" ></td>
        <td width="100%"  align="left" height="40"><h2>*หมายเหตุ</h2> </td>

    </tr>
</table>
<table style="width:100%">
     <tr>
        <td width="20%" ></td>
        <td width="100%"  align="left" height="40"><h3>- ติดต่อแผนกหู คอ จมูก ช่วงเวลา 9.00 - 11.00 น.</h3> </td>

    </tr>
    <tr>
        <td width="20%" ></td>
        <td width="100%"  align="left" height="40"><h3>- กรุณาจับบัตรคิวหน้าห้องตรวจหู คอ จมูก</h3> </td>

    </tr>
    <tr>
        <td width="20%" ></td>
        <td width="100%"  align="left" height="40"><h3>- นำบัตรประจำตัวประชาชนมาด้วย</h3> </td>

    </tr>
    <tr>
        <td width="20%" ></td>
        <td width="100%"  align="left" height="40"><h3>- กรณีเป็นคนไข้นอกเขต อ.ศรีสำโรง ให้นำใบส่งตัวมาด้วย</h3> </td>

    </tr>
</table>

