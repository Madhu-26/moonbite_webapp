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

/* Prevent admin from deleting themselves */
if($id == $_SESSION['staff_id'])
{
    die("You cannot delete your own account.");
}

mysqli_query(
    $conn,
    "DELETE FROM staff
     WHERE staff_id = $id"
);

header("Location: staff.php");
exit();

?>
