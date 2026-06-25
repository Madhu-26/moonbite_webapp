<?php
session_start();

/* Remove Customer Session */

unset($_SESSION['customer_id']);
unset($_SESSION['customer_name']);

/* Optional: Clear Cart */

unset($_SESSION['cart']);

/* Destroy Session */

session_destroy();

/* Redirect */

header("Location: index.php");
exit();
?>