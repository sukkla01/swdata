<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IctCheckSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ict Checks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ict-check-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ict Check', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'host',
            'detail',
            'port',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
