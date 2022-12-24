<?php

require_once '../inc/functions.php';
require_once '../inc/headers.php';

$db = null;

$input = json_decode(file_get_contents('php://input'));

$cart = $input->cart;
$user_id = $input->id;

try {
    $db = openDb();
    $db->beginTransaction();

    $sql = "INSERT INTO `order` (user_id) VALUES ($user_id)";
    $order_id = executeInsert($db,$sql);

    foreach ($cart as $product) {
    $sql = "INSERT INTO order_row (order_id,product_id, amount) VALUES ("
    .
        $order_id . "," .
        $product->id . "," . 
        $product->amount 
    .   ")";
    executeInsert($db,$sql);
    }
    $db->commit();
    header('HTTP/1.1 200 OK');
    $data = array('id' => $user_id);
    echo json_encode($data);
}
catch (PDOException $pdoex) {
    $db->rollback();
    returnError($pdoex);
    echo($pdoex);
}
?>