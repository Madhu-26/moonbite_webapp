<?php
include('../config/db.php');
include('includes/header.php');
include('includes/sidebar.php');

$food_count = mysqli_fetch_row(
    mysqli_query($conn,"SELECT COUNT(*) FROM food")
)[0];

$category_count = mysqli_fetch_row(
    mysqli_query($conn,"SELECT COUNT(*) FROM category")
)[0];

$customer_count = mysqli_fetch_row(
    mysqli_query($conn,"SELECT COUNT(*) FROM customer")
)[0];

$order_count = mysqli_fetch_row(
    mysqli_query($conn,"SELECT COUNT(*) FROM orders")
)[0];
?>

<div class="main">

<div class="topbar">
    <h3>Welcome, <?php echo $_SESSION['name']; ?></h3>

    <div>
        Role: <strong><?php echo $_SESSION['role']; ?></strong>
    </div>
</div>

<div class="cards">

    <div class="card">
        <h2>Foods</h2>
        <p><?php echo $food_count; ?></p>
    </div>

    <?php if($_SESSION['role'] == 'Admin') { ?>

    <div class="card">
        <h2>Categories</h2>
        <p><?php echo $category_count; ?></p>
    </div>

    <?php } ?>

    <div class="card">
        <h2>Customers</h2>
        <p><?php echo $customer_count; ?></p>
    </div>

    <div class="card">
        <h2>Orders</h2>
        <p><?php echo $order_count; ?></p>
    </div>

</div>

<h2 class="page-title">Recently Added Foods</h2>

<div class="table-container">

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Food</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

        <?php

        $result = mysqli_query(
            $conn,
            "SELECT * FROM food
             ORDER BY food_id DESC
             LIMIT 5"
        );

        while($row = mysqli_fetch_assoc($result))
        {
        ?>

        <tr>
            <td><?= $row['food_id']; ?></td>

            <td><?= $row['food_name']; ?></td>

            <td>Rs. <?= number_format($row['price'],2); ?></td>

            <td>

                <?php if($row['availability'] == 'Available') { ?>

                    <span class="status available">
                        Available
                    </span>

                <?php } else { ?>

                    <span class="status unavailable">
                        Unavailable
                    </span>

                <?php } ?>

            </td>
        </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</div>

<?php include('includes/footer.php'); ?>
