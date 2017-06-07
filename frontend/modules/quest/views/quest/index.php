<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\quest\models\QuestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quest-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Quest', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tname',
            'position',
            'dept',
            'inject_date',
            // 'inject_time',
            // 'mm',
            // 'pb',
            // 'ns',
            // 'pk',
            // 'pl',
            // 'nt',
            // 'td',
            // 'ps',
            // 'pi',
            // 'ot',
            // 's_mm',
            // 's_pb',
            // 's_kh',
            // 's_ns',
            // 's_pk',
            // 's_pl',
            // 's_nt',
            // 's_td',
            // 's_ps',
            // 's_pi',
            // 's_ot',
            // 'e_mm',
            // 'e_pb',
            // 'e_kh',
            // 'e_ns',
            // 'e_pk',
            // 'e_pl',
            // 'e_nt',
            // 'e_td',
            // 'e_ps',
            // 'e_pi',
            // 'e_ot',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
