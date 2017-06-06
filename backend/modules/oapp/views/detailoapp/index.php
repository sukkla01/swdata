<?php

use yii\bootstrap\Html;
use kartik\grid\GridView;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-body">
                <div class="container">
                    <div class="row">
                        <?= Html::beginForm(); ?>
                        <div class="col-md-2">
                            <label>เลือกวันที่ : </label>
                            <div class="form-group" >

                                <?php
                                echo yii\jui\DatePicker::widget([
                                    'name' => 'date1',
                                    'value' => $date1,
                                    'language' => 'th',
                                    'dateFormat' => 'yyyy-MM-dd',
                                    'clientOptions' => [
                                        'changeMonth' => true,
                                        'changeYear' => true,
                                    //'dateFormat' => 'yy-mm-dd'
                                    ],
                                ]);
                              
                                ?>

                            </div>
                        </div>


                        <div class="col-md-2">
                            <br>
                            &nbsp;&nbsp;<button class='btn btn-danger' id="btloading">ตกลง</button>
                        </div>
                        <div id="res"   class="col-md-2" style="display: none">
                            <img src="../../assets/images/l1.gif"   height="80" width="80">
                        </div>




                        <?= Html::endForm(); ?>




                        <!-- /.box-header -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"> <i class='fa fa-wheelchair'></i> &nbsp;ผู้ป่วยที่นัดมารับบริการที่ หูคอจมูก วันที่  <?=$date1?>  </h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <?php
                $gridColumns = [
                     ['class' => 'kartik\grid\SerialColumn'],
                        [
                        'attribute' => 'created_date',
                        'label' => 'วันที่นัด'
                    ],
                        [
                        'attribute' => 'hn',
                        'label' => 'HN'
                    ],
                        [
                        'attribute' => 'tname',
                        'label' => 'ชื่อ-สกุล'
                    ],
                        [
                        'attribute' => 'cid',
                        'label' => 'CID'
                    ],
                        [
                        'attribute' => 'pttype',
                        'label' => 'สิทธืการรักษา'
                    ],
                       
                     [
                        'attribute' => 'tel',
                        'label' => 'เบอร์โทร'
                    ],
                ];
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'autoXlFormat' => true,
                    'columns' => $gridColumns,
                    'resizableColumns' => true,
                    'pjaxSettings' => [
                        'neverTimeout' => true,
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>