<?php
include('../config/db.php');

if(isset($_GET['id']))
{
    $food_id = $_GET['id'];

    $food = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT featured
             FROM food
             WHERE food_id='$food_id'"
        )
    );

    if($food['featured'] == 1)
    {
        $new_value = 0;
    }
    else
    {
        $new_value = 1;
    }

    mysqli_query(
        $conn,
        "UPDATE food
         SET featured='$new_value'
         WHERE food_id='$food_id'"
    );
}

header("Location: foods.php");
exit();
?>