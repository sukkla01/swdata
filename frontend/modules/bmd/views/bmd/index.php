<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\bmd\models\BonemassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bonemasses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonemass-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bonemass', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'hn',
            'vstdate',
            'vn',
            'l1l4',
            // 'neck_lt',
            // 'neck_rt',
            // 'troch_lt',
            // 'troch_rt',
            // 'create_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
