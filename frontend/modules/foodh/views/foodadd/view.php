<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FoodDetail01 */

$this->title = $model->foodid;
$this->params['breadcrumbs'][] = ['label' => 'Food Detail01s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-detail01-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->foodid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->foodid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'foodid',
            'fooddate',
            'foodtime',
            'an',
            'hn',
            'meal',
            'ward',
            'icode',
            'Congenital_disease',
            'comment',
            'fooddate_rec',
            'staff',
            'bd',
            'cal',
        ],
    ]) ?>

</div>
