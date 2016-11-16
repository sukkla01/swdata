<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TmpThaicvrisk */

$this->title = 'Create Tmp Thaicvrisk';
$this->params['breadcrumbs'][] = ['label' => 'Tmp Thaicvrisks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmp-thaicvrisk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
