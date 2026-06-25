<?php

include('../config/db.php');

$order_id = $_POST['order_id'];
$food_id = $_POST['food_id'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

mysqli_query(
    $conn,
    "INSERT INTO order_item
    (
        order_id,
        food_id,
        quantity,
        price
    )
    VALUES
    (
        '$order_id',
        '$food_id',
        '$quantity',
        '$price'
    )"
);

echo json_encode([
    "success" => true
]);