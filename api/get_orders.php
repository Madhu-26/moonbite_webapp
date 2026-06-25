<?php

include('../config/db.php');

$customer_id = $_GET['customer_id'];

$result = mysqli_query(
    $conn,
    "SELECT *
     FROM orders
     WHERE customer_id='$customer_id'
     ORDER BY order_id DESC"
);

$data = [];

while($row = mysqli_fetch_assoc($result))
{
    $data[] = $row;
}

echo json_encode($data);