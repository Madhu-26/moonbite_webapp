<?php

session_start();
include('../config/db.php');

if(!isset($_SESSION['staff_id']))
{
    header("Location: login.php");
    exit();
}

if($_SESSION['role'] != 'Admin')
{
    die("Access Denied");
}

$id = (int)$_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM category
     WHERE category_id = $id"
);

header("Location: categories.php");
exit();

?>
