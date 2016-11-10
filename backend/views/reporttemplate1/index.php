<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReporttemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reporttemplates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reporttemplate-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มรายงาน', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'reportname',
            'module',
            'modulename',
            'url:url',
            // 'staff',
            // 'tsql',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
