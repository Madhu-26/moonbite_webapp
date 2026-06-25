<?php

include('../config/db.php');

$result = mysqli_query(
    $conn,
    "SELECT food_id,
            food_name,
            price,
            image,
            description
     FROM food
     WHERE availability='Available'
     ORDER BY food_name"
);

$data = [];

while($row = mysqli_fetch_assoc($result))
{
    $row['image'] =
        "http://10.0.2.2/moonbite/uploads/" .
        $row['image'];

    $data[] = $row;
}

echo json_encode($data);