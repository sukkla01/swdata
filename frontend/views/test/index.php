<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsertypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usertypes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usertype-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Usertype', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $gridColumns = [
            [
            'attribute' => 'pa_no',
            'label' => 'รหัส'
        ],
            [
            'attribute' => 'vstdate',
            'label' => 'วันที่บันทึก'
        ],
            [
            'attribute' => 'tname',
            'header' => 'ชื่อ-สกุล'
        ],
            [
            'attribute' => 'hometel',
            'header' => 'เบอร์โทร'
        ],
            [
            'attribute' => 'taddr',
            'header' => 'ที่อยู่'
        ],
            [
            'attribute' => 'pps',
            'header' => 'pps'
        ],
            [
            'attribute' => 'pfname',
            'header' => 'pain score'
        ],
    ];



    echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'responsive' => true,
        'hover' => true,
        
        'toggleDataContainer' => ['class' => 'btn-group-sm'],
        'exportContainer' => ['class' => 'btn-group-sm']
    ]);
    ?>

</div>