<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\bmd\models\Bonemass */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bonemasses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonemass-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'hn',
            'vstdate',
            'vn',
            'l1l4',
            'neck_lt',
            'neck_rt',
            'troch_lt',
            'troch_rt',
            'create_date',
        ],
    ]) ?>

</div>
