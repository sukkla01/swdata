<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

<?= Html::a('<span class="logo-mini">SW</span><span class="logo-lg">' . 'รพ.ศรีสังวรสุโขทัย' . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">สแกนลายนิ้วมือ<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= Url::to('index.php?r=fingview') ?>"><i class="fa fa-cloud-download"></i>ดาวโหลด</a></li>
                        <li><a href="<?= Url::to('index.php?r=fingview') ?>"><i class="fa fa-bars"></i>ข้อมูลการเข้า-ออก การปฎิบัติงาน</a></li>
                        <li><a href="<?= Url::to('index.php?r=fingview/stampjob1') ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>รายชื่อเวรเช้าเจ้าหน้าที่ขึ้นปฏิบัติงาน 04.00 - 8.30 น.</a></li>
                        <li><a href="<?= Url::to('index.php?r=fingview/stampjob2') ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>รายชื่อเวรบ่ายเจ้าหน้าที่ขึ้นปฏิบัติงาน 16.30 - 00.30 น.</a></li>
                        <li><a href="<?= Url::to('index.php?r=fingview/stampjob3') ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>รายชื่อเวรดึกเจ้าหน้าที่ขึ้นปฏิบัติงาน 00.30 - 08.30 น.</a></li>
                        <!--<li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>-->
                    </ul>
                </li>
                

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
