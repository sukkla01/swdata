<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ict001Ctpay */

$this->title = $model->hos_guid;
$this->params['breadcrumbs'][] = ['label' => 'แสดงข้อมูลระบบเบิกจ่ายค่า CT SCAN', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ict001-ctpay-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->hos_guid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->hos_guid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'hos_guid',
            'vstdate',
            'rxdate',
            'vn',
            'hn',
            'an',
            'fullname',
            'ward',
            'wardname',
            'dep_code',
            'department',
            'icode',
            'drugname',
            'billcode',
            'qty',
            'unitprice',
            'pttype',
            'pttypename',
            'income',
            'paidst',
            'sum_price',
            'reason',
            'necessary',
            'payprice',
            'command_doctor',
            'age_y',
            'CTstatus',
        ],
    ]) ?>

</div>
