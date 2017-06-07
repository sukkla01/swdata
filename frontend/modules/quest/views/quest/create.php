<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\quest\models\Quest */

$this->title = 'Create Quest';
$this->params['breadcrumbs'][] = ['label' => 'Quests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h4><p align="center"> แบบสอบถามอาการข้างเคียง ภายหลังได้รับวัคซีนป้องกันไข้หวัดใหญ่สายพันธุ์ ปี 2017</p></h4>
                <h4><p align="center"> (ภายหลังได้รับวัคซีน 7 วัน)</p></h4>

                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
