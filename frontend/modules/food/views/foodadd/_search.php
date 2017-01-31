<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FoodDetail01Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="food-detail01-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'foodid') ?>

    <?= $form->field($model, 'fooddate') ?>

    <?= $form->field($model, 'foodtime') ?>

    <?= $form->field($model, 'an') ?>

    <?= $form->field($model, 'hn') ?>

    <?php // echo $form->field($model, 'meal') ?>

    <?php // echo $form->field($model, 'ward') ?>

    <?php // echo $form->field($model, 'icode') ?>

    <?php // echo $form->field($model, 'Congenital_disease') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'fooddate_rec') ?>

    <?php // echo $form->field($model, 'staff') ?>

    <?php // echo $form->field($model, 'bd') ?>

    <?php // echo $form->field($model, 'cal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
