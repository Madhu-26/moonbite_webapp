<?php
include('../config/db.php');
include('includes/header.php');
include('includes/navbar.php');

if(!isset($_SESSION['customer_id']))
{
    header("Location: login.php");
    exit();
}

// echo "Customer ID : " . $_SESSION['customer_id'];
$customer_id = $_SESSION['customer_id'];

$result = mysqli_query(
    $conn,
    "SELECT *
     FROM orders
     WHERE customer_id = $customer_id
     ORDER BY order_id DESC"
);
?>

<div class="menu-section">

    <h1>My Orders</h1>

    <?php if(mysqli_num_rows($result) == 0) { ?>

        <div class="form-container">

            <h3>No orders found.</h3>

            <br>

            <a href="menu.php" class="btn">
                Browse Menu
            </a>

        </div>

    <?php } else { ?>

        <div class="table-container">

            <table>

                <thead>

                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                <?php while($order = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td>
                            #<?= $order['order_id']; ?>
                        </td>

                        <td>
                            <?= date('d M Y H:i', strtotime($order['order_date'])); ?>
                        </td>

                        <td>
                            Rs. <?= number_format($order['total_amount'],2); ?>
                        </td>

                        <td>

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

                        </td>

                        <td>

                            <a
                            href="order_details.php?id=<?= $order['order_id']; ?>"
                            class="btn-edit"
                            title="View Order">

                                <i class="fas fa-eye"></i>

                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    <?php } ?>

</div>

<?php include('includes/footer.php'); ?>