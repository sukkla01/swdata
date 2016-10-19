<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ict001Ctpay */

$this->title = 'แก้ไขข้อมูล ระบบเบิกจ่ายค่า CT SCAN ' . $model->hos_guid;
$this->params['breadcrumbs'][] = ['label' => 'Ict001 Ctpays', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hos_guid, 'url' => ['view', 'id' => $model->hos_guid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ict001-ctpay-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
