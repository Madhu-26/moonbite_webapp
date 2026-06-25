<?php
session_start();

$food_id = $_POST['food_id'];
$quantity = $_POST['quantity'];

if(!isset($_SESSION['cart']))
{
    $_SESSION['cart'] = [];
}

if(isset($_SESSION['cart'][$food_id]))
{
    $_SESSION['cart'][$food_id] += $quantity;
}
else
{
    $_SESSION['cart'][$food_id] = $quantity;
}

header("Location: cart.php");
exit();
?>