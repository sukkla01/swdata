<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\oapp\models\OappEventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Oapp Events';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php
        Modal::begin([
            //'header' => '<h4>บันทึกข้อมูลการนัด</h4>',
            'id' => 'modal',
            'size' => 'modal-lg'
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <div class="pull-left"><span style="font-weight: bold;" class="btn btn-primary btn-flat"><h5><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;ระบบนัดออนไลน์</h5></span></div>

            </div>
            <div class="box-body">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <?php
                    echo \yii2fullcalendar\yii2fullcalendar::widget(array(
                        'events' => $events,
                        'options' => [
                            'lang' => 'th',
                        //... more options to be defined here!
                        ],
                    ));
                    ?> 
                </div>
            </div>
        </div>
    </div>
</div>




<?php
$script = <<< JS
        
$(document).on('click','.fc-day',function(){
        var date = $(this).attr('data-date');
        $.get('index.php?r=oapp/oappevent/create',{'date':date},function(data){
            $('#modal').modal('show')
            .find('#modalContent')
            .html(data);
        
         });
        
   });
        

   
JS;
$this->registerJs($script);
?>