<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FingerDownloadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Finger Downloads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finger-download-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Finger Download', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'year',
            'month',
            'file1',
            'file2',
            'file3',
            // 'file4',
            // 'note1',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
