<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\FingerDownload */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="finger-download-form">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="row" >
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">อัพโหลดไฟล์ข้อมูลสแกนลายนิ้วมือ (.pdf)</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-4">
                        <?=
                        $form->field($model, 'year')->dropDownList(['2559' => '2559',
                            '2560' => '2560',
                            '2561' => '2561',
                            '2562' => '2562',
                            '2563' => '2563',], ['prompt' => ''])
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?=
                        $form->field($model, 'month')->widget(Select2::className(), ['data' =>
                            ArrayHelper::map(app\models\FingerMonth::find()->all(), 'code', 'name'),
                            'options' => [
                                'placeholder' => '<--คลิก/พิมพ์เลือก-->'],
                            'pluginOptions' =>
                                [
                                'allowClear' => true
                            ],
                        ]);
                        ?> 

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?=
                        $form->field($model, 'file1')->widget(FileInput::classname(), [
                            //'options' => ['accept' => 'image/*'],
                            'pluginOptions' => [
                                'initialPreview' => [],
                                'allowedFileExtensions' => ['pdf'],
                                'showPreview' => true,
                                'showRemove' => true,
                                'showUpload' => true
                            ]
                        ]);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?=
                        $form->field($model, 'file2')->widget(FileInput::classname(), [
                            //'options' => ['accept' => 'image/*'],
                            'pluginOptions' => [
                                'initialPreview' => [],
                                'allowedFileExtensions' => ['pdf'],
                                'showPreview' => false,
                                'showPreview' => true,
                                'showUpload' => false
                            ]
                        ]);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?=
                        $form->field($model, 'file3')->widget(FileInput::classname(), [
                            //'options' => ['accept' => 'image/*'],
                            'pluginOptions' => [
                                'initialPreview' => [],
                                'allowedFileExtensions' => ['pdf'],
                                'showPreview' => true,
                                'showRemove' => true,
                                'showUpload' => false
                            ]
                        ]);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?=
                        $form->field($model, 'file4')->widget(FileInput::classname(), [
                            //'options' => ['accept' => 'image/*'],
                            'pluginOptions' => [
                                'initialPreview' => [],
                                'allowedFileExtensions' => ['pdf'],
                                'showPreview' => true,
                                'showRemove' => true,
                                'showUpload' => false
                            ]
                        ]);
                        ?>
                    </div>
                </div>






                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'note1')->textarea(['maxlength' => true]) ?>
                    </div>
                </div>



                

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
