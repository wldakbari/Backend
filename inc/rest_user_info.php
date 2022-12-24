<?php
require("./headers.php");
session_start();
require('./user_control.php');

if(!isset($_SESSION["username"])){
    http_response_code(403); //403 = forbidden
    echo "Ei oikeuksia.";
    return;
}

$userInfo = getUserInfo($_SESSION["username"]);

$result = array();
$result['userinfo'] = $userInfo;

$json = json_encode($result);
header('Content-Type: application/json');
echo $json;