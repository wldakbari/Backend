<?php

require("./headers.php");
session_start();
require('./user_control.php');

$body = file_get_contents('php://input');
$user = json_decode($body);

if(!isset($user->uname) || !isset($user->pw)){
    http_response_code(400); //400 = "bad request"
    echo "Käyttäjätunnusta ei määritetty";
    return;
}

registerUser($user->uname, $user->pw, $user->firstname, $user->lastname, $user->address, $user->zip, $user->city);

$_SESSION['username'] = $user->uname;

http_response_code(200);
echo "Käyttäjä" .$user->uname. "rekisteröity";