<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FingerDownload */

$this->title = 'Create Finger Download';
$this->params['breadcrumbs'][] = ['label' => 'Finger Downloads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finger-download-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
