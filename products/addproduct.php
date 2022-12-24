<?php

require_once '../inc/functions.php';
require_once '../inc/headers.php';


$input = json_decode(file_get_contents('php://input'));
$name = filter_var($input->name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$brewery = filter_var($input->brewery, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$price = filter_var($input->price, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$category_id = filter_var($input->categoryid, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$percent = filter_var($input->percent, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$description = filter_var($input->description, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

try {
    $db = openDb();
    $sql = "INSERT INTO product (name, brewery, price, category_id, percent, image, description) VALUES ('$name', '$brewery', $price, $category_id, $percent, 'placeholder.png', '$description')";
    executeInsert($db,$sql);
    $data = array('id' => $db->lastInsertId(), 'name' => $name, 'brewery' => $brewery, 'price' => $price, 'percent' => $percent, 'image' => 'placeholder.png', 'description' => $description);
    print json_encode($data);
}
catch (PDOException $pdoex) {
    returnError($pdoex);
}