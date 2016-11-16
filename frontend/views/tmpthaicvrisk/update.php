<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TmpThaicvrisk */

$this->title = 'Update Tmp Thaicvrisk: ' . $model->vn;
$this->params['breadcrumbs'][] = ['label' => 'Tmp Thaicvrisks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->vn, 'url' => ['view', 'id' => $model->vn]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tmp-thaicvrisk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
