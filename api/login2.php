<?php

require_once 'pdodb.php' ;

$logfile = dirname(__FILE__).'/log/login2.txt' ;
file_put_contents($logfile, date("Y-m-d H:i:s")."\n".'reqeust: POST= '.json_encode($_POST)."\n", FILE_APPEND);

$username=trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS));
$password=trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));

$conn = new Demo;
$sql="select * from users where username='".$username."' and password='".$password."';";
$user=$conn->one($sql);

if($user){
  setcookie("username", $user['username']);
  $response = array('success' => 1 ,'name' => $user['name']);
}else{
  $response = array('success' => 0 );
}

file_put_contents($logfile, "username: $username, password: $password"."\n", FILE_APPEND);

echo json_encode($response);
exit;