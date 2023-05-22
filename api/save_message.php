<?php

require_once 'pdodb.php' ;

$logfile = dirname(__FILE__).'/log/save_message.txt' ;
file_put_contents($logfile, date("Y-m-d H:i:s")."\n".'reqeust: POST= '.json_encode($_POST)."\n", FILE_APPEND);

$name=trim($_POST['name']);
$message=trim($_POST['message']);

$conn = new Demo;
$sql="insert into message (name, message) values ('$name', '$message');";
$user=$conn->exeSql($sql);

$response = array('success' => 1);

echo json_encode($response);
exit;