<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TmpThaicvrisk */

$this->title = $model->vn;
$this->params['breadcrumbs'][] = ['label' => 'Tmp Thaicvrisks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmp-thaicvrisk-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->vn], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->vn], [
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
            'id',
            'vstdate',
            'hn',
            'vn',
            'tname',
            'age',
            'bp',
            'tc',
            'sex',
            'is_dm',
            'smoker',
            'waist',
            'height',
            'tcolor',
        ],
    ]) ?>

</div>
