<?php

include('../config/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query(
        $conn,
        "SELECT *
         FROM customer
         WHERE email='$email'
         AND password='$password'"
    );

    if(mysqli_num_rows($result) > 0)
    {
        $customer = mysqli_fetch_assoc($result);

        echo json_encode([
            "success" => true,
            "customer_id" => $customer['customer_id'],
            "first_name" => $customer['first_name'],
            "last_name" => $customer['last_name']
        ]);
    }
    else
    {
        echo json_encode([
            "success" => false,
            "message" => "Invalid Login"
        ]);
    }
}
else
{
    echo json_encode([
        "success" => false,
        "message" => "POST request required"
    ]);
}
?>