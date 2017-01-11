<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FoodDetail01 */

$this->title = 'Create Food Detail01';
$this->params['breadcrumbs'][] = ['label' => 'Food Detail01s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-detail01-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
