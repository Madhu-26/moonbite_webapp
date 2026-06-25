<?php

include('../config/db.php');
include('includes/header.php');
include('includes/navbar.php');

if(empty($_SESSION['cart']))
{
    header("Location: cart.php");
    exit();
}
?>

<div class="menu-section">

    <h1>Checkout</h1>

    <div class="form-container">

    <?php if(isset($_SESSION['customer_id'])) { ?>

        <?php

        $customer_id = $_SESSION['customer_id'];

        $customer = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                "SELECT *
                 FROM customer
                 WHERE customer_id = $customer_id"
            )
        );
        ?>

        <h3>Customer Details</h3>

        <br>

        <p>
            <strong>Name:</strong>
            <?= $customer['first_name']; ?>
            <?= $customer['last_name']; ?>
        </p>

        <br>

        <p>
            <strong>Email:</strong>
            <?= $customer['email']; ?>
        </p>

        <br>

        <p>
            <strong>Phone:</strong>
            <?= $customer['phone']; ?>
        </p>

        <br>

        <p>
            <strong>Address:</strong>
            <?= $customer['address']; ?>
        </p>

        <br><br>

        <form action="place_order.php" method="POST">

            <div class="form-group">

                <textarea
                name="notes"
                class="form-control"
                placeholder="Order Notes (Optional)"></textarea>

            </div>

            <button
            type="submit"
            class="btn">

                Place Order

            </button>

        </form>

    <?php } else { ?>

        <form action="place_order.php" method="POST">

            <div class="form-group">

                <input
                type="text"
                name="first_name"
                class="form-control"
                placeholder="First Name"
                required>

            </div>

            <div class="form-group">

                <input
                type="text"
                name="last_name"
                class="form-control"
                placeholder="Last Name"
                required>

            </div>

            <div class="form-group">

                <input
                type="email"
                name="email"
                class="form-control"
                placeholder="Email Address"
                required>

            </div>

            <div class="form-group">

                <input
                type="text"
                name="phone"
                class="form-control"
                placeholder="Phone Number"
                required>

            </div>

            <div class="form-group">

                <textarea
                name="address"
                class="form-control"
                placeholder="Delivery Address"
                required></textarea>

            </div>

            <div class="form-group">

                <textarea
                name="notes"
                class="form-control"
                placeholder="Order Notes (Optional)"></textarea>

            </div>

            <button
            type="submit"
            class="btn">

                Place Order

            </button>

        </form>

    <?php } ?>

    </div>

</div>

<?php include('includes/footer.php'); ?>