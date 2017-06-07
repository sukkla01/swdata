<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\quest\models\Quest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Quests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quest-view">

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
            'tname',
            'position',
            'dept',
            'inject_date',
            'inject_time',
            'mm',
            'pb',
            'ns',
            'pk',
            'pl',
            'nt',
            'td',
            'ps',
            'pi',
            'ot',
            's_mm',
            's_pb',
            's_kh',
            's_ns',
            's_pk',
            's_pl',
            's_nt',
            's_td',
            's_ps',
            's_pi',
            's_ot',
            'e_mm',
            'e_pb',
            'e_kh',
            'e_ns',
            'e_pk',
            'e_pl',
            'e_nt',
            'e_td',
            'e_ps',
            'e_pi',
            'e_ot',
        ],
    ]) ?>

</div>
