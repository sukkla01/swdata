<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use lavrentiev\widgets\toastr\Notification;
use kartik\grid\GridView;

?>

<?php
$command = Yii::$app->db->createCommand("SELECT value FROM food_setting WHERE type='line_token'");
$line_token = $command->queryScalar();
$command = Yii::$app->db->createCommand("SELECT value FROM food_setting WHERE type='s_time_line'");
$s_time_line = $command->queryScalar();
$command = Yii::$app->db->createCommand("SELECT value FROM food_setting WHERE type='e_time_line'");
$e_time_line = $command->queryScalar();
$command = Yii::$app->db->createCommand("SELECT value FROM food_setting WHERE type='line_noti'");
$line_noti = $command->queryScalar();
$s_time_line = str_replace('.', ':', $s_time_line);
$e_time_line = str_replace('.', ':', $e_time_line);


// ------------ food history -----------

$rawData = \Yii::$app->db->createCommand("SELECT * FROM nur_congenital_disease")->queryAll();
$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $rawData,
    'pagination' => [
        'pageSize' => 50
    ],
        ]);
?>


<h1>ตั่งค่าระบบการสั่งอาหารผู้ปวยใน</h1>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><i class="fa fa-search"></i>ตั่งค่าการแจ้งเตือน</div>
            <div class="panel-body">

                <div class="form-group">
                    <label for="exampleInputEmail1">Line Token</label>
                    <input type="text" class="form-control" id="linetoken"  placeholder="Line Token" value="<?= $line_token ?>">
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputPassword1">แจ้งเตือนหรือไม (Y/N)</label>
                            <input type="text" class="form-control" id="noti" placeholder="Y" value="<?= $line_noti ?>" maxlength="1">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputPassword1">เวลาเริ่มต้นที่ไม่ให้แจ้งเตือน</label>
                            <input type="time" class="form-control" id="s_time" placeholder="11.30" value="<?= $s_time_line ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputPassword1">ถึงเวลาที่ไม่ให้แจ้งเตือน</label>
                            <input type="time" class="form-control" id="e_time" placeholder="11.30" value="<?= $e_time_line ?>">
                        </div>
                    </div>

                </div>
                <button type="button"  id="tok" class="btn btn-danger"  >ตกลง</button> 



            </div>



        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading"><i class="fa fa-search"></i>ตั่งค่าโรคประจำตัว</div>
            <div class="panel-body">
                <div class="col-md-10">
                    <input type="text" class="form-control" id="addcd" >

                </div>
                <div class="col-md-2">
                    <button type="button"  id="btaddcd" class="btn btn-danger"  >เพิ่ม</button> 
                </div>
                <div class="col-md-12">
                    <?php
                    $gridColumns = [
                    ];
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'autoXlFormat' => true,
                        'export' => [
                            'fontAwesome' => true,
                            'showConfirmAlert' => false,
                            'target' => GridView::TARGET_BLANK
                        ],
                        'columns' => $gridColumns,
                        'responsive' => true,
                        'hover' => true,
                        'resizableColumns' => true,
                            // 'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
                            //'floatHeader' => true,
                            //'floatHeaderOptions' => ['scrollingTop' => '100'],
                            // 'pjax' => true,
                            //'pjaxSettings' => [
                            //    'neverTimeout' => true,
                            //'beforeGrid' => 'My fancy content before.',
                            //'afterGrid' => 'My fancy content after.',
                            //],
                    ]);
                    ?>
                </div>



            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading"><i class="fa fa-search"></i>สูตร</div>
            <div class="panel-body">

            </div>
        </div>
    </div>
</div>

<div id="noti_alert" style="display:none" >


    <?php
    if ($_GET['alert'] == 1) {
        echo Notification::widget([
            'type' => 'success',
            'title' => 'ตั่งค่าเรียบร้อยแล้ว',
            'message' => 'สามารถใช้งานได้ปกติ',
            'options' => [
                "closeButton" => FALSE,
                "debug" => false,
                "newestOnTop" => true,
                "progressBar" => FALSE,
                "positionClass" => "toast-top-right",
                "preventDuplicates" => false,
                "onclick" => NULL,
                "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "5000",
                "extendedTimeOut" => "100",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]
        ]);
    }
    ?>
</div>

<?php
$script = <<< JS
   $(document).ready(function() {
        //document.getElementById("tok").disabled = true;
   });
        
        
   $('#tok').click(function() {
     var linetoken = document.getElementById("linetoken").value;
     var noti = document.getElementById("noti").value ;
     var s_time = document.getElementById("s_time").value ;
     var e_time = document.getElementById("e_time").value;   
        
     $.ajax({
            type: 'POST', url: './index.php?r=fsetting/addsetting&linetoken='+linetoken+'&noti='+noti+'&s_time='+s_time+'&e_time='+e_time, dataType: 'json',
              data: {
                    
                    
                }, success: function(se) {
                    if(se>0){
                     window.location='./index.php?r=fsetting&alert=1';
                }             
              }
        }); 
     
       
   });
        
   $('#btaddcd').click(function() {
     var addcd = document.getElementById("addcd").value; 
        
     $.ajax({
            type: 'POST', url: './index.php?r=fsetting/addcd&addcd='+addcd, dataType: 'json',
              data: {
                    
                    
                }, success: function(se) {
                    if(se>0){
                     window.location='./index.php?r=fsetting&alert=1';
                }             
              }
        }); 
     
       
   });
            
        
        
        
            
JS;
$this->registerJs($script);
?>
