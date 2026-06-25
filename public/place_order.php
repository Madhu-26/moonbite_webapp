<?php
session_start();
include('../config/db.php');

if(empty($_SESSION['cart']))
{
    header("Location: cart.php");
    exit();
}

$cart = $_SESSION['cart'];

/* Get Customer */

if(isset($_SESSION['customer_id']))
{
    // Logged-in customer

    $customer_id = $_SESSION['customer_id'];
}
else
{
    // Guest checkout

    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $address    = $_POST['address'];

    $check = mysqli_query(
        $conn,
        "SELECT customer_id
         FROM customer
         WHERE email='$email'"
    );

    if(mysqli_num_rows($check) > 0)
    {
        $customer = mysqli_fetch_assoc($check);
        $customer_id = $customer['customer_id'];
    }
    else
    {
        mysqli_query(
            $conn,
            "INSERT INTO customer
            (
                first_name,
                last_name,
                email,
                password,
                phone,
                address
            )
            VALUES
            (
                '$first_name',
                '$last_name',
                '$email',
                NULL,
                '$phone',
                '$address'
            )"
        );

        $customer_id = mysqli_insert_id($conn);
    }
}

/* Calculate Total */

$total = 0;

foreach($cart as $food_id => $qty)
{
    $food = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT price
             FROM food
             WHERE food_id = $food_id"
        )
    );

    $total += ($food['price'] * $qty);
}

/* Create Order */

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
        '$total',
        'Pending'
    )"
);

$order_id = mysqli_insert_id($conn);

/* Create Order Items */

foreach($cart as $food_id => $qty)
{
    $food = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT price
             FROM food
             WHERE food_id = $food_id"
        )
    );

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
            '$qty',
            '{$food['price']}'
        )"
    );
}

/* Clear Cart */

unset($_SESSION['cart']);

/* Redirect */

header("Location: order_success.php?id=".$order_id);
exit();
?>