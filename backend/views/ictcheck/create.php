<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IctCheck */

$this->title = 'Create Ict Check';
$this->params['breadcrumbs'][] = ['label' => 'Ict Checks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ict-check-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
