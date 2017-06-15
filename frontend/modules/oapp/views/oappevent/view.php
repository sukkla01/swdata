<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\oapp\models\OappEvent */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Oapp Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oapp-event-view">


    <p>
        <?=
        Html::a('กลับหน้าหลัก', ['index'], ['class' => 'btn btn-primary', 'data' => [
                'confirm' => 'คุณต้องการกลับสู่หน้าหลักหรือไม  เมื่อกลับสู่หน้าคุณจะไม่สามารถพิมพ์ใบนัดได้',
                'method' => 'post',
            ],])
        ?>&nbsp;
        <?=
        Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'คุณต้องการลบหรือไม่',
                'method' => 'post',
            ],
        ])
        ?>&nbsp;
        <?=
        Html::a('พิมพ์ใบนัด', ['/oapp/pdfoapp', 'id' => $model->id ], ['class' => 'btn btn-success',])
        ?>
    </p>


    <div class="row" >
        <div class="col-md-12">
            <div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'hn',
                            'tname',
                            'cid',
                            'pttype_name',
                            'tel',
                            'created_date',
                        ],
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>




</div>
