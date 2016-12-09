<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FingerDownload */

$this->title = $model->year;
$this->params['breadcrumbs'][] = ['label' => 'Finger Downloads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finger-download-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'year' => $model->year, 'month' => $model->month], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'year' => $model->year, 'month' => $model->month], [
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
            'year',
            'month',
            'file1',
            'file2',
            'file3',
            'file4',
            'note1',
        ],
    ]) ?>

</div>
