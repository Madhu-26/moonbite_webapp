<?php
include('../config/db.php');
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="main">

<h2 class="page-title">
    Order Management
</h2>

<div class="table-container">

    <table>

        <thead>

            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
                <th width="120">Action</th>
            </tr>

        </thead>

        <tbody>

        <?php

        $query = "
        SELECT o.*,
               CONCAT(c.first_name,' ',c.last_name) AS customer_name
        FROM orders o
        LEFT JOIN customer c
        ON o.customer_id = c.customer_id
        ORDER BY o.order_id DESC
        ";

        $result = mysqli_query($conn,$query);

        while($row = mysqli_fetch_assoc($result))
        {
            $status_class = strtolower($row['status']);
        ?>

        <tr>

            <td>
                #<?= $row['order_id']; ?>
            </td>

            <td>
                <?= $row['customer_name']; ?>
            </td>

            <td>
                <?= date('d M Y', strtotime($row['order_date'])); ?>
            </td>

            <td>
                Rs. <?= number_format($row['total_amount'],2); ?>
            </td>

            <td>

                <span class="status <?= $status_class; ?>">
                    <?= $row['status']; ?>
                </span>

            </td>

            <td>

                <div class="action-buttons">

                    <a
                        href="view_order.php?id=<?= $row['order_id']; ?>"
                        class="btn-edit"
                        title="View Order">

                        <i class="fas fa-eye"></i>

                    </a>

                </div>

            </td>

        </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</div>

<?php include('includes/footer.php'); ?>
