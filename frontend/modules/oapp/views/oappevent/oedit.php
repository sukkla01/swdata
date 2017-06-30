<?php

namespace app\controllers;

use yii;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;


$hn = '';
$tname = '';
$tel = '';
$pttype = '';
$create_date = '';
$ptname1='';
?>




<div class="col-md-12">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title"> <i class='glyphicon glyphicon-search'></i> ค้นหาข้อมูล</h3>
        </div>
        <div class="panel-body">
            <?= Html::beginForm(); ?>
            <div class="row">
                <div class="col-md-6">
                    รหัสบัตรประชาชน 13 หลัก:
                    <input type="text" name="cid" class="form-control" placeholder="XXXXXXXXXXXXX">
                </div>   
                <div class="col-md-6">
                    เลขที่:
                    <input type="text"  name="id" class="form-control" placeholder="xxx">
                </div>  
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-danger']); ?>
                </div>
            </div>


            <?= Html::endForm(); ?>
        </div>
    </div>
</div>


<?php if ($pg==1) { ?>
    <?php
    $connection = Yii::$app->db5;
    $sqlm = "SELECT * FROM oapp_event WHERE md5(cid)='$cid' AND id='$id'";
    $datam = $connection->createCommand($sqlm)
            ->queryAll();
    for ($im = 0; $im < sizeof($datam); $im++) {
        $hn = $datam[$im]['hn'];
        $tname = $datam[$im]['tname'];
        $create_date = $datam[$im]['created_date'];
        $cid = $datam[$im]['cid'];
        $tel = $datam[$im]['tel'];
        $ptname1 = $datam[$im]['pttype_name'];
        $pttype = $datam[$im]['pttype'];
    }
    ?>
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"> <i class='glyphicon glyphicon-edit'></i> รายการ</h3>
            </div>
            <div class="panel-body">
                <div style="width:100%; margin:0 auto;">
                    <div class="col-md-12">
                        <h4>วันที่นัด : <?= $create_date ?> </h4>
                    </div>
                    <div class="col-md-12">
                        <h4>HN : <?= $hn ?> </h4>
                    </div>
                    <div class="col-md-12">
                        <h4>ชื่อ-สกุล : <?= $tname ?> </h4>
                    </div>
                    <div class="col-md-12">
                        <h4>ปชช. : <?= $cid ?> </h4>
                    </div>
                    <div class="col-md-12">
                        <h4>เบอร์โทร : <?= $tel ?> </h4>
                    </div>
                    <div class="col-md-12">
                        <h4>สิทธิ : <?= $ptname1 ?> </h4>
                    </div>
                </div>

                <button type="button" class="btn bg-purple margin" id="btnedit"><i class="fa fa-edit">&nbsp;&nbsp;แก้ไข</i></button>
                <button type="button" class="btn bg-green margin" id="print"><i class="fa fa-print">&nbsp;&nbsp;พิมพ์</i></button>
            </div>
        </div>
    </div>
    <?php
    Modal::begin([
        'header' => '<h4>แก้ไขนัด</h4>',
        'id' => 'modal',
        'size' => 'modal-lg'
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
    ?>

<?php } ?>


<?php
$script = <<< JS
        var id = $id ;
        var hn = '$hn';
        var cid = '$cid';
        var tname = '$tname';
        var tel = '$tel';
        var pttype = '$pttype';
        var create_date = '$create_date';
   $('#btnedit').click(function() {
        var date = '';
        $.get('index.php?r=oapp/oappevent/create',{'id':id,'date':date,'type':1,'update':1,'hn':hn,'cid':cid,'tname':tname,'tel':tel,'pttype':pttype,'create_date':create_date},function(data){
            $('#modal').modal('show')
            .find('#modalContent')
            .html(data);
        
         });
        
   });   
        
   $('#print').click(function() {
        window.location='./index.php?r=/oapp/pdfoapp&id='+id;
        
   }); 
        
JS;
$this->registerJs($script);
?>






