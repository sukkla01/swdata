<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TmpThaicvriskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tmp Thaicvrisks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmp-thaicvrisk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tmp Thaicvrisk', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"> <i class='fa fa-user-circle-o'></i> &nbsp;การประเมินโอกาสเสี่ยงต่อการเกิดโรคหัวใจและหลอดเลือด (Thai CVD Risk ปี 59) ของผู้ป่วยที่ได้รับการวินิจฉัยโรคเบาหวาน/ความดัน</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    $gridColumns = [
                                ['class' => 'yii\grid\SerialColumn'],
                            //'id',
                            'vstdate',
                            'hn',
                            'vn',
                            'tname',
                            'age',
                            'bp',
                            'tc',
                            'sex',
                            'is_dm',
                            'smoker',
                            'waist',
                            'height',
                                [
                                'header' => 'color',
                                'attribute' => 'tcolor',
                                'value' => function ($model, $key, $index, $widget) {
                                    if ($model['tcolor'] === '1') {
                                        return "<span class='badge' style='background-color: #53ff1a' ><font  color='7a7a52'>" . $model['tcolor'] . "</font></span>  <code></code>";
                                    } else if ($model['tcolor'] === '2') {
                                        return "<span class='badge' style='background-color: #ffff00'><font  color='7a7a52'>" . $model['tcolor'] . "</font></span>  <code></code>";
                                    } else if ($model['tcolor'] === '3') {
                                        return "<span class='badge' style='background-color: #ff751a'><font  color='7a7a52'>" . $model['tcolor'] . "</font></span>  <code></code>";
                                    } else if ($model['tcolor'] === '4') {
                                        return "<span class='badge' style='background-color: #ff1a1a'><font  color='7a7a52'>" . $model['tcolor'] . "</font></span>  <code></code>";
                                    } else if ($model['tcolor'] === '5') {
                                        return "<span class='badge' style='background-color: #7a7a52'><font  color='7a7a52'>" . $model['tcolor'] . "</font></span>  <code></code>";
                                    } else {
                                        return "ไม่ทราบ";
                                    }
                                },
                                //'filterType' => GridView::FILTER_COLOR,
                                //'vAlign' => 'middle',
                                'format' => 'raw',
                            //'width' => '150px',
                            // 'noWrap' => true
                            ],
                        //['class' => 'yii\grid\ActionColumn'],
                        ];
                     echo '<div class="col-md-12" align="right" >';
                    echo ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $gridColumns
                    ]);
                    echo '</div>';
                    
                    ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => $gridColumns
                    ]);
                    ?>

                </div>
            </div>
        </div>
    </div>


</div>
