<?php

session_start();
include('../config/db.php');

if(!isset($_SESSION['staff_id']))
{
    header("Location: login.php");
    exit();
}

$id = (int)$_GET['id'];

/* Get image name before deleting */
$result = mysqli_query(
    $conn,
    "SELECT image
     FROM food
     WHERE food_id = $id"
);

$food = mysqli_fetch_assoc($result);

if($food)
{
    $image_path = "../uploads/" . $food['image'];

    if(
        !empty($food['image']) &&
        file_exists($image_path)
    )
    {
        unlink($image_path);
    }

    mysqli_query(
        $conn,
        "DELETE FROM food
         WHERE food_id = $id"
    );
}

header("Location: foods.php");
exit();

?>
