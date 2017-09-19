<?php

use yii\helpers\Html;
?>


<?php
$connection = Yii::$app->db;

$projectname = "";
$research_name = "";
$project_no = "";
$dept = "";
$date_comfirm = "";
$note1 = "";

$sql = "SELECT * FROM research where id='$id' ";
$datad = $connection->createCommand($sql)
        ->queryAll();
for ($i1 = 0; $i1 < sizeof($datad); $i1++) {
    $projectname = $datad[$i1]['projectname'];
    $research_name = $datad[$i1]['research_name'];
    $project_no = $datad[$i1]['project_no'];
    $dept = $datad[$i1]['dept'];
    $date_comfirm = $datad[$i1]['date_comfirm'];
    $note1 = $datad[$i1]['note1'];
}
?>
<table style="height: 37px;" width="100%">
    <tbody>
        <tr>
            <td style="width: 426px;">&nbsp;</td>
            <td style="width: 428px;">&nbsp;</td>
        </tr>
    </tbody>
</table>
<table style="height: 130px;" width="100%">
    <tbody>
        <tr>
            <td style="width: 295px; text-align: right;"><?= Html::img(Yii::getAlias('@frontend') . '/web/images/srisangworn.jpg', ['width' => 160]) ?> </td>
            <td style="width: 634px; text-align: center;">
                <h2><strong>&nbsp;เอกสารรับรองโครงการวิจัยในมนุษย์</strong></h2><br>
                <h2><strong>คณะกรรมการจริยธรรมการวิจัยในมนุษย์ โรงพยาบาลศรีสังวรสุโขทัย</strong></h2>
            </td>
        </tr>
    </tbody>
</table>
<hr />
<table style="height: 600px; width: 100%;">
    <tbody>
        <tr style="height: 70px;">
            <td style="width: 20%; text-align: right; height: 60px;">
                <h3><strong>&nbsp;ชื่อโครงการ</strong></h3>
            </td>
            <td style="width: 5%; text-align: right; height: 60px;">
                <h3><strong></strong></h3>
            </td>
            <td style="width: 75%; height: 60px;">
                <h4><?=$projectname;?></h4>
            </td>
        </tr>
    </tbody>
</table>
<table style="height: 600px; width: 100%;">
    <tbody>
        <tr style="height: 100px;">
            <td style="width: 20%; text-align: right; height: 100px;">
                <h3><strong>&nbsp;ชื่อผู้วิจัย</strong></h3>
            </td>
            <td style="width: 5%; text-align: right; height: 100px;">
                <h3><strong></strong></h3>
            </td>
            <td style="width: 75%; height: 100px;">
                <h4><?=$research_name;?></h4>
            </td>
        </tr>
    </tbody>
</table>
<table style="height: 600px; width: 100%;">
    <tbody>
        <tr style="height: 100px;">
            <td style="width: 20%; text-align: right; height: 100px;">
                <h3><strong>&nbsp;เลขที่โครงการ</strong></h3>
            </td>
            <td style="width: 5%; text-align: right; height: 100px;">
                <h3><strong></strong></h3>
            </td>
            <td style="width: 75%; height: 100px;">
                <h4><?=$project_no;?></h4>
            </td>
        </tr>
    </tbody>
</table>
<table style="height: 600px; width: 100%;">
    <tbody>
        <tr style="height: 100px;">
            <td style="width: 20%; text-align: right; height: 60px;">
                <h3><strong>&nbsp;สังกัดหน่วยงาน</strong></h3>
            </td>
            <td style="width: 5%; text-align: right; height: 60px;">
                <h3><strong></strong></h3>
            </td>
            <td style="width: 75%; height: 60px;">
                <h4><?=$dept;?></h4>
            </td>
        </tr>
    </tbody>
</table>
<table style="height: 10px; width: 100%;">
    <tbody>
        <tr style="height: 100px;">
            <td style="width: 20%; text-align: right; height: 10px;">
                <h3><strong>&nbsp;การรับรอง</strong></h3>
            </td>
            <td style="width: 5%; text-align: right; height: 10px;">
                <h3><strong></strong></h3>
            </td>
            <td style="width: 75%; height: 10px;">
                <h4>ขอรับรองโครงการวิจัยดังกล่าวข้างบนนี้ได้ผ่านการพิจารณาและรับรองจาก </h4>
               
            </td>
        </tr>
    </tbody>
    <tbody>
        <tr style="height: 1px;">
            <td style="width: 20%; text-align: right; height: 10px;">
                <h3><strong></strong></h3>
            <td style="width: 5%; text-align: right; height: 10px;">
                <h3><strong></strong></h3>
            </td>
            <td style="width: 75%; height: 10px;">
                <h4>คณะกรรมการจริยธรรมการวิจัยในมนุษย์ โรงพยาบาลศรีสังวรสุโขทัย</h4>
                
            </td>
        </tr>
    </tbody>
    <tbody>
        <tr style="height: 1px;">
            <td style="width: 20%; text-align: right; height: 10px;">
                <h3><strong></strong></h3>
            <td style="width: 5%; text-align: right; height: 10px;">
                <h3><strong></strong></h3>
            </td>
            <td style="width: 75%; height: 10px;">
                <h4>เมื่อวันที่&nbsp; &nbsp; <?php echo Yii::$app->thaiFormatter->asDate($date_comfirm, 'long'); ?>  </h4>
                
            </td>
        </tr>
    </tbody>
</table>

<table style="height: 300px;" width="850">
    <tbody>
        <tr>
            <td style="width: 424px; height: 300px;">&nbsp;</td>
            <td style="width: 425px;">&nbsp;</td>
        </tr>
    </tbody>
</table>
<table style="height: 24px;" width="851">
    <tbody>
        <tr>
            <td style="width: 424px;">&nbsp;</td>
            <td style="width: 426px;">
                <h3>ลงนาม</h3>
                <h3>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ( <?=$note1;?>)</h3>
                <br>
                <h3>ประธาณคณะกรรมการจริยธรรมการวิจัยในมนุษย์</h3>
            </td>
        </tr>
    </tbody>
</table>