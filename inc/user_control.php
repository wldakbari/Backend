<?php

require_once('./functions.php');

function registerUser($uname, $pw, $firstname, $lastname, $address, $zip, $city) {
    $db = openDb();


    $uname = filter_var($uname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $firstname = filter_var($firstname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($lastname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = filter_var($address, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $zip = filter_var($zip, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $city = filter_var($city, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //encode pw
    $pw = password_hash($pw, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (username, passwd, firstname, lastname, address, zip, city) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname, $pw, $firstname, $lastname, $address, $zip, $city));
}


function checkUser($uname,$pw){
    $db = openDb();

    $sql = "SELECT passwd FROM user WHERE username=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname));

    $hashedpw = $statement->fetchColumn();

    if(isset($hashedpw)){
        return password_verify($pw, $hashedpw) ? $uname : null;
    }
    return null;
}


function getUserInfo($uname){
    $db = openDb();

    $sql = "SELECT * FROM `user` WHERE username=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname));
    
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}