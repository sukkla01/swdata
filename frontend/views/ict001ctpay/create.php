<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ict001Ctpay */

$this->title = 'เพิ่มข้อมูล ระบบเบิกจ่ายค่า CT SCAN';
$this->params['breadcrumbs'][] = ['label' => 'Ict001 Ctpays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ict001-ctpay-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
