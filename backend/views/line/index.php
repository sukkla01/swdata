<?php

/* @var $this yii\web\View */
define('LINE_API', "https://notify-api.line.me/api/notify");
//define('LINE_TOKEN','Dn2Vk3PqIBYPb6L9DsqTcsIEbgoHnzw18vO8S7aSnHD');//test
//define('LINE_TOKEN', 'Dn2Vk3PqIBYPb6L9DsqTcsIEbgoHnzw18vO8S7aSnHD');
//define('LINE_TOKEN', '2zkkjjAhJVTc93IZvgczy5oE8kyw3XCfZzzPORKDVhJ'); //ict check auto

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

//$res = notify_message('นอนได้แล้ว ไม่กวนแล้ว');
//var_dump($res);

	$ip = "192.168.0.20";
	$exe= shell_exec("ping -n 3 $ip");
        //echo $exe;
	if(strrpos($exe, "100% loss") > 0)
	{
		 echo "Server ".$ip.  " Offline <br>";
	}
	else
	{
		echo "Server  ".$ip.  " Online <br>";
	}
        
        $ip = "192.168.0.7";
	$exe= shell_exec("ping -n 3 $ip");
        //echo $exe;
	if(strrpos($exe, "100% loss") > 0)
	{
		 echo "Server ".$ip.  " Offline <br>";
	}
	else
	{
		echo "Server  ".$ip.  " Online<br>";
	}
        $ip = "192.168.0.25";
	$exe= shell_exec("ping -n 3 $ip");
        //echo $exe;
	if(strrpos($exe, "100% loss") > 0)
	{
		 echo "Server ".$ip.  " Offline <br>";
	}
	else
	{
		echo "Server  ".$ip.  " Online<br>";
	}
        $res = notify_message('ขออณุญาตทดสอบส่งข้อมูล เพื่อทำระบบเช็ค server ครับ (Jub)');
?>


