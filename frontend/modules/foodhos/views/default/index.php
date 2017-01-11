<?php
    use yii\bootstrap\Html;
    use kartik\widgets\Select2;
    use yii\helpers\ArrayHelper;
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-body">



                <?= Html::beginForm(); ?>
                <div class="col-md-4">
                    <?php
                    echo Select2::widget([
                        'name' => 'ward',
                        'value' => $ward,
                        'data' => ArrayHelper::map(app\models\Ward::find()->all(), 'ward', 'name'),
                        'theme' => Select2::THEME_KRAJEE, // this is the default if theme is not set
                        'options' => ['placeholder' => ' กรุณาเลือกหอผู้ป่วย...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); // Classic Theme
                    ?>
                </div>
                <button class='btn btn-danger'>ประมวลผล</button>

                <?= Html::endForm(); ?>



                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->

        </div>
    </div>
</div>