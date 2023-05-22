<?php

require_once 'pdodb.php' ;

$logfile = dirname(__FILE__).'/log/login.txt' ;
file_put_contents($logfile, date("Y-m-d H:i:s")."\n".'reqeust: POST= '.json_encode($_POST)."\n", FILE_APPEND);

$username=trim($_POST['username']);
$password=trim($_POST['password']);

$conn = new Demo;
$sql="select * from users where username='".$username."' and password='".$password."';";
$user=$conn->one($sql);

if($user){
  setcookie("username", $user['username']);
  $response = array('success' => 1 ,'name' => $user['name']);
}else{
  $response = array('success' => 0);
}

file_put_contents($logfile, "username: $username, password: $password"."\n", FILE_APPEND);

echo json_encode($response);
exit;