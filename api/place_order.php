<?php

include('../config/db.php');

$customer_id = $_POST['customer_id'];
$total_amount = $_POST['total_amount'];

mysqli_query(
    $conn,
    "INSERT INTO orders
    (
        customer_id,
        total_amount,
        status
    )
    VALUES
    (
        '$customer_id',
        '$total_amount',
        'Pending'
    )"
);

$order_id = mysqli_insert_id($conn);

echo json_encode([
    "success" => true,
    "order_id" => $order_id
]);