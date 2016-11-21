<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>จัดการระบบ!</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-lg btn-success" href="<?= Url::to('index.php?r=user') ?>">USERS SYSTEM</a></p>
        </div>
         <div class="col-md-3">
            <a class="btn btn-lg btn-info" href="<?= Url::to('index.php?r=reporttemplate') ?>">เพิ่มระบบรายงาน</a></p>
        </div>
         <div class="col-md-3">
             <a class="btn btn-lg btn-danger" href="<?= Url::to('index.php?r=test/test') ?>">ระบบตรวจสอบ Network</a></p>
        </div>
        <div class="col-md-3">
            <a class="btn btn-lg btn-primary" href="<?= Url::to('index.php?r=thaicv/process') ?>">ประมวลผล Thai CV Risk</a>
        </div>
    </div>
    
</div>
