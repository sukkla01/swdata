<?php
        use kartik\grid\GridView;
        use yii\helpers\Html;
?>

<div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"> <i class='fa fa-user-circle-o'></i> &nbsp;ข้อมูลสแกนลายนิ้วมือ</h3>

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
                         ['class' => 'kartik\grid\SerialColumn'],
                         [
                            'attribute' => 'year',
                            'label' => 'ปี'
                        ],
                         [
                            'attribute' => 'name',
                            'label' => 'เดือน'
                        ],
                         [
                            'attribute' => 'file1',
                            'label' => 'วันที่1-10',
                            'value' => function($model, $key) {
                                return Html::a("<i class='fa fa-download'></i>",
                                                ['dfile','file'=>$model['file1']], ['target'=>'_blank',
                                            'title' => 'สั่งอาหาร',
                  ]);
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'center',
                            'format' => 'raw',
                        ],
                                    [
                            'attribute' => 'file2',
                            'label' => 'วันที่11-20',
                            'value' => function($model, $key) {
                                return Html::a("<i class='fa fa-download'></i>",
                                                ['dfile','file'=>$model['file2']], ['target'=>'_blank',
                                            'title' => 'สั่งอาหาร',
                  ]);
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'center',
                            'format' => 'raw',
                        ],
                                    [
                            'attribute' => 'file3',
                            'label' => 'วันที่21-31',
                            'value' => function($model, $key) {
                                return Html::a("<i class='fa fa-download'></i>",
                                                ['dfile','file'=>$model['file3']], ['target'=>'_blank',
                                            'title' => 'สั่งอาหาร',
                  ]);
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'center',
                            'format' => 'raw',
                        ],
                                               [
                            'attribute' => 'file4',
                            'label' => 'รวม OPD',
                            'value' => function($model, $key) {
                                return Html::a("<i class='fa fa-download'></i>",
                                                ['dfile','file'=>$model['file4']], ['target'=>'_blank',
                                            'title' => 'สั่งอาหาร',
                  ]);
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'center',
                            'format' => 'raw',
                        ],
                                     [
                            'attribute' => 'note1',
                            'label' => 'หมายเหตุ'
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
                        'columns' => $gridColumns,
                        'resizableColumns' => true,
                        'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
                        //'floatHeader' => true,
                        //'floatHeaderOptions' => ['scrollingTop' => '100'],
                        /*'pjax' => true,
                        'pjaxSettings' => [
                            'neverTimeout' => true,
                        //'beforeGrid' => 'My fancy content before.',
                        //'afterGrid' => 'My fancy content after.',
                        ]*/
                    ]);
                    ?>






                </div>

            </div>

        </div>

    </div>