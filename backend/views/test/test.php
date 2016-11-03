<?php

use yii\bootstrap\Html;
use yii\helpers\Url;

$sql = "select * from ict_check";
$connection = Yii::$app->db;
$data = $connection->createCommand($sql)
        ->queryAll();
//----------------------  Line Api --------------------
define('LINE_API', "https://notify-api.line.me/api/notify");
//define('LINE_TOKEN','Dn2Vk3PqIBYPb6L9DsqTcsIEbgoHnzw18vO8S7aSnHD');//test
//define('LINE_TOKEN', 'Dn2Vk3PqIBYPb6L9DsqTcsIEbgoHnzw18vO8S7aSnHD');
define('LINE_TOKEN', '2zkkjjAhJVTc93IZvgczy5oE8kyw3XCfZzzPORKDVhJ'); //ict check auto
?>
<meta http-equiv="refresh" content="3600;url=<?= Url::to('index.php?r=test/test') ?>">




<div class="row">
    <div class="col-md-12">
        
            <div class="box-body">
                <?php $color = "bgcolor='e6f5ff'"; ?>
                <table class="table ">

                    <tr bgcolor="999966">
                        <th>ระบบตรวจสอบ Server</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>

                    </tr>
                    <tr bgcolor="c2c2a3">
                        <th>#</th>
                        <th>Host</th>
                        <th>รายละเอียด</th>
                        <th>Port</th>
                        <th>สถานะ</th>

                    </tr>
                    <?php

                    function notify_message($message) {

                        $queryData = array('message' => $message);
                        $queryData = http_build_query($queryData, '', '&');
                        $headerOptions = array(
                            'http' => array(
                                'method' => 'POST',
                                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                                . "Authorization: Bearer " . LINE_TOKEN . "\r\n"
                                . "Content-Length: " . strlen($queryData) . "\r\n",
                                'content' => $queryData
                            )
                        );
                        $context = stream_context_create($headerOptions);
                        $result = file_get_contents(LINE_API, FALSE, $context);
                        $res = json_decode($result);
                        return $res;
                    }
                    ?>
                    <?php for ($i = 0; $i < sizeof($data); $i++) { ?>
                        <?php
                        $host = $data[$i]['host'];
                        $port = $data[$i]['port'];
                        $detail = $data[$i]['detail'];
                        if ($socket = @ fsockopen($host, $port, $errno, $errstr, 10)) {
                            $tstatus = 'online';
                            fclose($socket);
                        } else {




                            $tstatus = 'offline';
                            $res = notify_message($host . ' ' . $detail . ' ' . $tstatus);
                        }
                        ?>
                        <tr >
                            <th><?= $i + 1 ?></th>
                            <th><?= $host ?></th>
                            <th><?= $data[$i]['detail'] ?></th>
                            <th><?= $port ?></th>
                            <th>
                                <?php if ($tstatus == 'online') { ?>
                                    <button type="button" class="btn btn-success"><?= $tstatus ?></button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-danger"><?= $tstatus ?></button>
                                <?php } ?>
                            </th>

                        </tr>
                    <?php } ?>

                </table>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-md-12">
        <?= Html::a('เพิ่ม', ['/ictcheck/create'], ['class' => 'btn btn-primary']) ?>
    </div>
</div>

