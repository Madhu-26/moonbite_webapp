<?php

include('../config/db.php');

$order_id = $_GET['order_id'];

$result = mysqli_query(
    $conn,
    "SELECT
        food.food_name,
        order_item.quantity,
        order_item.price
     FROM order_item
     JOIN food
     ON order_item.food_id =
        food.food_id
     WHERE order_item.order_id='$order_id'"
);

$data = [];

while($row = mysqli_fetch_assoc($result))
{
    $data[] = $row;
}

echo json_encode($data);