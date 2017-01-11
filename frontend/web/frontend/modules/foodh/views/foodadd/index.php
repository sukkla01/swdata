<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FoodDetail01Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Food Detail01s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-detail01-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Food Detail01', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'foodid',
            'fooddate',
            'foodtime',
            'an',
            'hn',
            // 'meal',
            // 'ward',
            // 'icode',
            // 'Congenital_disease',
            // 'comment',
            // 'fooddate_rec',
            // 'staff',
            // 'bd',
            // 'cal',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
