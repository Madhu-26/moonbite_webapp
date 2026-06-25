<?php
include('../config/db.php');
include('includes/header.php');
include('includes/sidebar.php');

$order_id = (int)$_GET['id'];

if(isset($_POST['update']))
{
    $status = $_POST['status'];

    mysqli_query(
        $conn,
        "UPDATE orders
         SET status='$status'
         WHERE order_id=$order_id"
    );

    header("Location: orders.php");
    exit();
}

$order = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT *
         FROM orders
         WHERE order_id=$order_id"
    )
);

if(!$order)
{
    die("Order not found");
}
?>

<div class="main">

<h2 class="page-title">
    Order #<?= $order_id; ?>
</h2>

<div class="form-container">

    <h3 style="margin-bottom:15px;">
        Current Status:
        <strong><?= $order['status']; ?></strong>
    </h3>

    <form method="POST">

        <div class="form-group">

            <select
                name="status"
                class="form-control">

                <option value="Pending"
                <?= ($order['status']=='Pending') ? 'selected' : ''; ?>>
                    Pending
                </option>

                <option value="Accepted"
                <?= ($order['status']=='Accepted') ? 'selected' : ''; ?>>
                    Accepted
                </option>

                <option value="Preparing"
                <?= ($order['status']=='Preparing') ? 'selected' : ''; ?>>
                    Preparing
                </option>

                <option value="Ready"
                <?= ($order['status']=='Ready') ? 'selected' : ''; ?>>
                    Ready
                </option>

                <option value="Completed"
                <?= ($order['status']=='Completed') ? 'selected' : ''; ?>>
                    Completed
                </option>

                <option value="Rejected"
                <?= ($order['status']=='Rejected') ? 'selected' : ''; ?>>
                    Rejected
                </option>

            </select>

        </div>

        <button
            type="submit"
            name="update"
            class="btn">
            Update Status
        </button>

        <a
            href="orders.php"
            class="btn-secondary">
            ← Back
        </a>

    </form>

</div>

<h2 class="page-title">
    Order Items
</h2>

<div class="table-container">

    <table>

        <thead>

            <tr>
                <th>Food</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>

        </thead>

        <tbody>

        <?php

        $query = "
        SELECT oi.*,
               f.food_name
        FROM order_item oi
        LEFT JOIN food f
        ON oi.food_id = f.food_id
        WHERE oi.order_id = $order_id
        ";

        $result = mysqli_query($conn,$query);

        $grand_total = 0;

        while($item = mysqli_fetch_assoc($result))
        {
            $subtotal =
                $item['quantity'] *
                $item['price'];

            $grand_total += $subtotal;
        ?>

        <tr>

            <td>
                <?= $item['food_name']; ?>
            </td>

            <td>
                <?= $item['quantity']; ?>
            </td>

            <td>
                Rs. <?= number_format($item['price'],2); ?>
            </td>

            <td>
                Rs. <?= number_format($subtotal,2); ?>
            </td>

        </tr>

        <?php } ?>

        <tr>

            <td colspan="3">
                <strong>Total Amount</strong>
            </td>

            <td>
                <strong>
                    Rs. <?= number_format($grand_total,2); ?>
                </strong>
            </td>

        </tr>

        </tbody>

    </table>

</div>

</div>

<?php include('includes/footer.php'); ?>
