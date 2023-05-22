<?php

require_once 'pdodb.php' ;


$conn = new Demo;
$sql="select * from message;";
$list=$conn->all($sql);

$response = array('success' => 1 ,'list' => $list);


echo json_encode($response);
exit;