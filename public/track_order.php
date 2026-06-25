<?php
include('../config/db.php');
include('includes/header.php');
include('includes/navbar.php');

$order = null;

if(isset($_POST['search']))
{
    $order_id = $_POST['order_id'];

    $result = mysqli_query(
        $conn,
        "SELECT *
         FROM orders
         WHERE order_id = '$order_id'"
    );

    if(mysqli_num_rows($result) > 0)
    {
        $order = mysqli_fetch_assoc($result);
    }
}
?>

<div class="menu-section">

    <h1>Track Your Order</h1>

    <div class="form-container">

        <form method="POST">

            <div class="form-group">

                <input
                type="number"
                name="order_id"
                class="form-control"
                placeholder="Enter Order Number"
                required>

            </div>

            <button
            type="submit"
            name="search"
            class="btn">

                Check Status

            </button>

        </form>

    </div>

    <?php if($order) { ?>

        <div class="form-container">

            <h2>
                Order #<?= $order['order_id']; ?>
            </h2>

            <br>

            <?php if($order['status'] == 'Pending') { ?>

                <span class="status pending">
                    Pending
                </span>

            <?php } elseif($order['status'] == 'Accepted') { ?>

                <span class="status accepted">
                    Accepted
                </span>

            <?php } elseif($order['status'] == 'Preparing') { ?>

                <span class="status preparing">
                    Preparing
                </span>

            <?php } elseif($order['status'] == 'Ready') { ?>

                <span class="status ready">
                    Ready
                </span>

            <?php } elseif($order['status'] == 'Completed') { ?>

                <span class="status available">
                    Completed
                </span>

            <?php } else { ?>

                <span class="status unavailable">
                    Rejected
                </span>

            <?php } ?>

        </div>

    <?php } ?>

</div>

<?php include('includes/footer.php'); ?>