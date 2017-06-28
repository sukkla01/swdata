<?php
   use yii\bootstrap\Html;
   use kartik\grid\GridView;
?>
<h1><p align="center"> ระบบบันทึกข้อมูลการตรวจมวลกระดูก</p></h1>

<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-body">

                  <?= Html::beginForm(); ?>

                    ประมวลข้อมูลระหว่าง :
                    <?php
                    echo yii\jui\DatePicker::widget([
                        'name' => 'date1',
                        'value' => $date1,
                        'language' => 'th',
                        'dateFormat' => 'yyyy-MM-dd',
                        'clientOptions' => [
                            'changeMonth' => true,
                            'changeYear' => true,
                        ],
                    ]);
                    ?>

                    ถึง


                    <?php
                    echo yii\jui\DatePicker::widget([
                        'name' => 'date2',
                        'value' => $date2,
                        'language' => 'th',
                        'dateFormat' => 'yyyy-MM-dd',
                        'clientOptions' => [
                            'changeMonth' => true,
                            'changeYear' => true,
                        ]
                    ]);
                    ?>

                    <button class='btn btn-danger'>ตกลง</button>

                    <?= Html::endForm(); ?>


            </div>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-body">

                <?php
                    $gridColumns = [
                        ['class' => 'kartik\grid\SerialColumn'],
                        [
                        'attribute' => 'hn',
                        'label' => 'HN'
                    ],
                        [
                        'attribute' => 'vn',
                        'label' => 'VN'
                    ],
                        [
                        'attribute' => 'vstdate',
                        'label' => 'วันที่รับบริการ'
                    ],
                        [
                        'attribute' => 'tname',
                        'label' => 'ชื่อ-สกุล'
                    ],
                        [
                        'attribute' => 'age_y',
                        'label' => 'อายุ'
                    ],
                          [
                        'attribute' => 'pdx',
                        'label' => 'PDX'
                    ],
                        [
                        'attribute' => 'ptname',
                        'label' => 'สิทธิ์การรักษา'
                    ],
                          [
                        'attribute' => 'l1l4',
                        'label' => 'L1-L4'
                    ],
                          [
                        'attribute' => 'neck_lt',
                        'label' => 'Neck Lt'
                    ],
                          [
                        'attribute' => 'neck_rt',
                        'label' => 'Neck Rt'
                    ],
                          [
                        'attribute' => 'troch_lt',
                        'label' => 'Troch Lt'
                    ],
                         [
                        'attribute' => 'troch_rt',
                        'label' => 'Troch Rt'
                    ],
                        [
                        'attribute' => 'vn',
                        'label' => '#',
                        'value' => function($model, $key) {
                            $vn = $model['vn'];
                            $hn = $model['hn'];
                            $vstdate = $model['vstdate'];
                            $date1 = $model['date1'];
                            $date2 = $model['date2'];
                            $id = $model['id'];
                            if($model['tck']=='N'){
                            return Html::a("<span class='badge' style='background-color: #D84315' ><i class='fa fa-universal-access'></i></span>", ['/bmd/bmd/create', 'vn' => $vn, 'hn' => $hn, 'vstdate' => $vstdate,'date1'=>$date1,'date2'=>$date2,'id'=>$id], [
                                        'class' => 'activity-add-link',
                                        'title' => 'ลง BMD',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#modalvote',
                                            //'data-whatever'=>$model['an'],
                                            //'data-id' => $model['an'],
                            ]);
                            }else{
                               return Html::a("<span class='badge' style='background-color: #4CAF50' ><i class='fa fa-universal-access'></i></span>", ['/bmd/bmd/create','vn' => $vn, 'hn' => $hn, 'vstdate' => $vstdate,'date1'=>$date1,'date2'=>$date2,'id'=>$id], [
                                        'class' => 'activity-add-link',
                                        'title' => 'ลง BMD',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#modalvote',
                                            //'data-whatever'=>$model['an'],
                                            //'data-id' => $model['an'],
                            ]); 
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    ],
                        
                        
                    ];
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'autoXlFormat' => true,
                        'export' => [
                            'fontAwesome' => true,
                            'showConfirmAlert' => false,
                            'target' => GridView::TARGET_BLANK
                        ],
                        'responsive' => true,
                        'hover' => true,
                        'columns' => $gridColumns,
                            // 'pageSummary' => \app\components\PTotal::pageTotal($dataProvider->models,'price'),
                    ]);
                
                ?>


            </div>

        </div>
    </div>
</div>

<div class="modal remote fade " id="modalvote">
    <div class="modal-dialog modal-lg">
        <div class="modal-content  "></div>
    </div>
</div>