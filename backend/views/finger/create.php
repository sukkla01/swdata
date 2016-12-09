<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FingerDownload */

$this->title = 'Create Finger Download';
$this->params['breadcrumbs'][] = ['label' => 'Finger Downloads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finger-download-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
