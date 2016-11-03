<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reporttemplate */

$this->title = 'Create Reporttemplate';
$this->params['breadcrumbs'][] = ['label' => 'Reporttemplates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reporttemplate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
