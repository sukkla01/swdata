<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FoodDetail01 */

$this->title = 'Update Food Detail01: ' . $model->foodid;
$this->params['breadcrumbs'][] = ['label' => 'Food Detail01s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->foodid, 'url' => ['view', 'id' => $model->foodid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="food-detail01-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
