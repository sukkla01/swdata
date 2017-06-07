<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\quest\models\QuestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quest-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tname') ?>

    <?= $form->field($model, 'position') ?>

    <?= $form->field($model, 'dept') ?>

    <?= $form->field($model, 'inject_date') ?>

    <?php // echo $form->field($model, 'inject_time') ?>

    <?php // echo $form->field($model, 'mm') ?>

    <?php // echo $form->field($model, 'pb') ?>

    <?php // echo $form->field($model, 'ns') ?>

    <?php // echo $form->field($model, 'pk') ?>

    <?php // echo $form->field($model, 'pl') ?>

    <?php // echo $form->field($model, 'nt') ?>

    <?php // echo $form->field($model, 'td') ?>

    <?php // echo $form->field($model, 'ps') ?>

    <?php // echo $form->field($model, 'pi') ?>

    <?php // echo $form->field($model, 'ot') ?>

    <?php // echo $form->field($model, 's_mm') ?>

    <?php // echo $form->field($model, 's_pb') ?>

    <?php // echo $form->field($model, 's_kh') ?>

    <?php // echo $form->field($model, 's_ns') ?>

    <?php // echo $form->field($model, 's_pk') ?>

    <?php // echo $form->field($model, 's_pl') ?>

    <?php // echo $form->field($model, 's_nt') ?>

    <?php // echo $form->field($model, 's_td') ?>

    <?php // echo $form->field($model, 's_ps') ?>

    <?php // echo $form->field($model, 's_pi') ?>

    <?php // echo $form->field($model, 's_ot') ?>

    <?php // echo $form->field($model, 'e_mm') ?>

    <?php // echo $form->field($model, 'e_pb') ?>

    <?php // echo $form->field($model, 'e_kh') ?>

    <?php // echo $form->field($model, 'e_ns') ?>

    <?php // echo $form->field($model, 'e_pk') ?>

    <?php // echo $form->field($model, 'e_pl') ?>

    <?php // echo $form->field($model, 'e_nt') ?>

    <?php // echo $form->field($model, 'e_td') ?>

    <?php // echo $form->field($model, 'e_ps') ?>

    <?php // echo $form->field($model, 'e_pi') ?>

    <?php // echo $form->field($model, 'e_ot') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
