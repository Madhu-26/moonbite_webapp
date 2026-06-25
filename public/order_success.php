<?php
include('includes/header.php');
include('includes/navbar.php');

$order_id = $_GET['id'];
?>

<div class="menu-section">

    <div class="form-container" style="text-align:center;">

        <h1>🎉 Order Placed Successfully</h1>

        <br>

        <h2>
            Order Number:
            #<?= $order_id; ?>
        </h2>

        <br>

        <p>
            Please save your Order Number to track your order.
        </p>

        <p>
            Thank you for choosing MoonBite Café.
        </p>


        <br>

        <a href="menu.php" class="btn">
            Continue Shopping
        </a>

    </div>

</div>

<?php include('includes/footer.php'); ?>