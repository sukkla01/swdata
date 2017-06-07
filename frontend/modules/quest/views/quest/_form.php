<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\quest\models\Quest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quest-form">

    <div class="row" >
        <div class="col-md-12">
            <div class="box box-info box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">ข้อมูลทั่วไป</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">

                    <?php $form = ActiveForm::begin(); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'tname')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($model, 'age')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'dept')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 'inject_date')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>

                        </div>
                        <div class="col-md-3">
                            <?= $form->field($model, 'inject_time')->textInput() ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <h4><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โปรดทำเครื่อง <input type="checkbox" id="queue-order" name="Queue[order]" value="1" checked> หน้าข้อที่ท่านมีอาการข้างเคียง และกรอกรายละเอียดตามแบบฟอร์มภายกลังได้รับวัคซีน 7 วัน</p></h4>
 

    <div class="row" >
        <div class="col-md-12">
            <div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">อาการผิดปกติที่เกิดขึ้นใน 7 วันหลังฉีดวัคซีน</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-4">
                            <?php echo $form->field($model, 'mm')->checkBox(['label' => '  ไม่มีอาการข้างเคียง', 'uncheck' => null, 'checked' => 'checked']); ?>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <br> 
                            <?php echo $form->field($model, 'pb')->checkBox(['label' => '  ปวด บวมแดง บริเวณที่ฉีด', 'uncheck' => null, 'checked' => 'checked']); ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 's_pb')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 'e_pb')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <br> 
                            <?php echo $form->field($model, 'ns')->checkBox(['label' => '  หนาวสั่น', 'uncheck' => null, 'checked' => 'checked']); ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 's_ns')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 'e_ns')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <br> 
                            <?php echo $form->field($model, 'pk')->checkBox(['label' => '  ปวดกล้ามเนื้อ', 'uncheck' => null, 'checked' => 'checked']); ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 's_pk')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 'e_pk')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <br> 
                            <?php echo $form->field($model, 'pl')->checkBox(['label' => '  ผื่น / คัน', 'uncheck' => null, 'checked' => 'checked']); ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 's_pl')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 'e_pl')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <br> 
                            <?php echo $form->field($model, 'nt')->checkBox(['label' => '  หน้า / ตัว บวม', 'uncheck' => null, 'checked' => 'checked']); ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 's_nt')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 'e_nt')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>

                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2">
                            <br> 
                            <?php echo $form->field($model, 'td')->checkBox(['label' => '  ตาแดง', 'uncheck' => null, 'checked' => 'checked']); ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 's_td')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 'e_td')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <br> 
                            <?php echo $form->field($model, 'ps')->checkBox(['label' => '  ปวดศรีษะ', 'uncheck' => null, 'checked' => 'checked']); ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 's_ps')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 'e_ps')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>

                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2">
                            <br> 
                            <?php echo $form->field($model, 'pi')->checkBox(['label' => '  ปวดข้อ', 'uncheck' => null, 'checked' => 'checked']); ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 's_pi')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 'e_pi')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>

                        </div>
                    </div>
                    
                     <div class="row">
                        <div class="col-md-2">
                            <br> 
                            <?php echo $form->field($model, 'ot')->checkBox(['label' => '  อื่นๆ / ระบุ', 'uncheck' => null, 'checked' => 'checked']); ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 's_ot')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($model, 'e_ot')->widget(
                                    DatePicker::className(), [
                                'language' => 'th',
                                'inline' => FALSE,
                                //'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    //'value' => '2015-01-01',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                    'dateFormat' => 'yy-mm-dd'
                                ],
                            ]);
                            ?>

                        </div>
                    </div>

                    <?= $form->field($model, 's_mm')->hiddenInput(['maxlength' => true, 'value' => NULL])->label(FALSE); ?>
                    <?= $form->field($model, 'e_mm')->hiddenInput(['maxlength' => true, 'value' => NULL])->label(FALSE); ?>

                 

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>

            </div>
        </div>
    </div>
