<?php

include('../config/db.php');

$customer_id = $_POST['customer_id'];
$food_id = $_POST['food_id'];

$check = mysqli_query(
    $conn,
    "SELECT *
     FROM cart
     WHERE customer_id='$customer_id'
     AND food_id='$food_id'"
);

if(mysqli_num_rows($check) > 0)
{
    mysqli_query(
        $conn,
        "UPDATE cart
         SET quantity = quantity + 1
         WHERE customer_id='$customer_id'
         AND food_id='$food_id'"
    );
}
else
{
    mysqli_query(
        $conn,
        "INSERT INTO cart
        (
            customer_id,
            food_id,
            quantity
        )
        VALUES
        (
            '$customer_id',
            '$food_id',
            1
        )"
    );
}

echo json_encode([
    "success" => true
]);