<?php
    use yii\widgets\Pjax;
    use kartik\grid\GridView;
    use yii\helpers\Url;
    use yii\bootstrap\Html;
    use yii\bootstrap\Modal;
?>


<?php
Modal::begin([
    'header' => '<h4>บันทึกข้อมูลผลงานวิจัย</h4>',
    'id' => 'modal',
    'size' => 'modal-lg'
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <div class="pull-left"><span style="font-weight: bold;" class="btn btn-primary btn-flat"><h5><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;บันทึกผลงานวิจัย</h5></span></div>



                <div class="box-tools pull-right">
                    
                    <button type="button" class="btn bg-olive margin" id="btnadd"><i class="fa fa-plus-square">&nbsp;&nbsp;บันทึก</i></button>
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
                        'attribute' => 'projectname',
                        'label' => 'ชื่อโครงการ'
                    ],
                     [
                        'attribute' => 'research_name',
                        'label' => 'ชื่อผู้วิจัย'
                    ],
                     [
                        'attribute' => 'project_no',
                        'label' => 'เลขที่โครงการ'
                    ],
                     [
                        'attribute' => 'projectname',
                        'label' => 'ชื่อโครงการ'
                    ],
                     [
                        'attribute' => 'dept',
                        'label' => 'สังกัดหน่วยงาน'
                    ],
                     [
                        'attribute' => 'date_comfirm',
                        'label' => 'วันที่รับรอง'
                    ],
                     [
                        'attribute' => 'note1',
                        'label' => 'ชื่อประธาน'
                    ],
                    [
                        'attribute' => 'an',
                        'label' => '#',
                        'value' => function($model, $key) {
                            $id = $model['id'];
                            
                            return Html::a("<span class='badge' style='background-color: #0099ff' ><i class='fa fa fa-print'></i></span> ", ['/research/default/pdf', 'id' => $id], [
                                        'class' => 'activity-add-link',
                                        'title' => 'สั่งอาหาร',
                                        'traget'=>'_blank'
                                      
                            ]);
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
                    'columns' => $gridColumns,
                    'responsive' => true,
                    'hover' => true,
                    'resizableColumns' => true,
                        // 'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
                        //'floatHeader' => true,
                        //'floatHeaderOptions' => ['scrollingTop' => '100'],
                        // 'pjax' => true,
                        //'pjaxSettings' => [
                        //    'neverTimeout' => true,
                        //'beforeGrid' => 'My fancy content before.',
                        //'afterGrid' => 'My fancy content after.',
                        //],
                ]);
                
                ?>






            </div>

        </div>

    </div>

</div>

<?php
$script = <<< JS
         
        
 $('#btnadd').click(function() {
        var date = '';
        $.get('index.php?r=research/research/create',{'date':date,'type':1},function(data){
            $('#modal').modal('show')
            .find('#modalContent')
            .html(data);
        
         });
        
   });
        

   
JS;
$this->registerJs($script);
?>