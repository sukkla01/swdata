<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Ict001CtpaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ระบบเบิกจ่ายค่า CT SCANjjjjjj';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ict001-ctpay-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มข้อมูลรายชื่อผู้ทำ CT SCAN', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'hos_guid',
            'vstdate',
            'rxdate',
            // 'vn',
            'hn',
            // 'an',
            'fullname',
            // 'ward',
            'wardname',
            // 'dep_code',
            // 'department',
            'icode',
            'drugname',
            // 'billcode',
            'qty',
            // 'unitprice',
            // 'pttype',
            // 'pttypename',
            // 'income',
            // 'paidst',
            'sum_price',
            // 'reason',
            // 'necessary',
            // 'payprice',
            // 'command_doctor',
            // 'age_y',
            // 'CTstatus',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
