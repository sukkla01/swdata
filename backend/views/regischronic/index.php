<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use kartik\widgets\DatePicker;
//use kartik\grid\GridView;
use yii\grid\GridView;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
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

                <button class='btn btn-danger'>ประมวลผล</button>

                <?= Html::endForm(); ?>



                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->

        </div>
    </div>
</div>

<?php if($i<>'') { ?>
<h1>ลงทะเบียนทั้งหมด <?=$i ?> คน</h1>

<?php } ?>