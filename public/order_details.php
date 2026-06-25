<?php
session_start();
include('../config/db.php');
include('includes/header.php');
include('includes/navbar.php');

if(!isset($_SESSION['customer_id']))
{
    header("Location: login.php");
    exit();
}

$order_id = $_GET['id'];
$customer_id = $_SESSION['customer_id'];

/* Verify Order Belongs To Customer */

$order = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT *
         FROM orders
         WHERE order_id = $order_id
         AND customer_id = $customer_id"
    )
);

if(!$order)
{
    die("Order not found.");
}
?>

<div class="menu-section">

    <h1>
        Order #<?= $order['order_id']; ?>
    </h1>

    <div class="form-container">

        <h3>

            Status:

            <?php
            $status = $order['status'];

            if($status == 'Pending')
                echo '<span class="status pending">Pending</span>';

            elseif($status == 'Accepted')
                echo '<span class="status accepted">Accepted</span>';

            elseif($status == 'Preparing')
                echo '<span class="status preparing">Preparing</span>';

            elseif($status == 'Ready')
                echo '<span class="status ready">Ready</span>';

            elseif($status == 'Completed')
                echo '<span class="status completed">Completed</span>';

            else
                echo '<span class="status rejected">Rejected</span>';
            ?>

        </h3>

        <br>

        <p>
            <strong>Order Date:</strong>
            <?= date('d M Y H:i', strtotime($order['order_date'])); ?>
        </p>

        <br>

    </div>

    <br>

    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>Image</th>
                    <th>Food Item</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>

            </thead>

            <tbody>

            <?php

            $total = 0;

            $items = mysqli_query(
                $conn,
                "SELECT oi.*,
                        f.food_name,
                        f.image
                 FROM order_item oi
                 LEFT JOIN food f
                 ON oi.food_id = f.food_id
                 WHERE oi.order_id = $order_id"
            );

            while($item = mysqli_fetch_assoc($items))
            {
                $subtotal =
                    $item['price'] *
                    $item['quantity'];

                $total += $subtotal;
            ?>

                <tr>

                    <td>

                        <img
                        src="../uploads/<?= $item['image']; ?>"
                        width="80">

                    </td>

                    <td>
                        <?= $item['food_name']; ?>
                    </td>

                    <td>
                        Rs. <?= number_format($item['price'],2); ?>
                    </td>

                    <td>
                        <?= $item['quantity']; ?>
                    </td>

                    <td>
                        Rs. <?= number_format($subtotal,2); ?>
                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

    <br>

    <div class="form-container">

        <h2>

            Total:
            Rs. <?= number_format($total,2); ?>

        </h2>

        <br>

        <a
        href="myorders.php"
        class="btn-secondary">

            Back To My Orders

        </a>

    </div>

</div>

<?php include('includes/footer.php'); ?>