<?php
session_start();

if(!isset($_SESSION['staff_id']))
{
    header("Location: ../admin/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>MoonBite Café</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>