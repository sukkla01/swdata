<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\quest\models\Quest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Quests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;



?>

<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon  fa fa-check"></i> กรอกแบบสอบถามเรียบร้อยแล้ว!</h4>
        <p>ชื่อ-สกุล : <?=$tname?> อายุ : <?=$age?> ปี</p>
        <p>หน่วยงาน : <?=$dept?></p>
        <p>ตำแหน่ง : <?=$position ?></p>
</div>

<p align="center"><img src="../web/images/thank_you.png"/></p>




