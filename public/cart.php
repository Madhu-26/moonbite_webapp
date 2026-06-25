<?php
include('../config/db.php');
include('includes/header.php');
include('includes/navbar.php');

$cart = isset($_SESSION['cart'])
    ? $_SESSION['cart']
    : [];

$total = 0;
?>

<div class="menu-section">

    <h1>Your Cart</h1>

    <?php if(empty($cart)) { ?>

        <div class="form-container">

            <h3>Your cart is empty.</h3>

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
                        <th>Image</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                <?php

                foreach($cart as $food_id => $qty)
                {
                    $result = mysqli_query(
                        $conn,
                        "SELECT *
                         FROM food
                         WHERE food_id = $food_id"
                    );

                    $food = mysqli_fetch_assoc($result);

                    if(!$food)
                    {
                        continue;
                    }

                    $subtotal = $food['price'] * $qty;
                    $total += $subtotal;
                ?>

                    <tr>

                        <td>

                            <img
                            src="../uploads/<?= $food['image']; ?>"
                            class="food-cart-image">

                        </td>

                        <td>
                            <?= $food['food_name']; ?>
                        </td>

                        <td>
                            Rs. <?= number_format($food['price'],2); ?>
                        </td>

                        <td>
                                <div class="qty-controls">

                                <a
                                href="update_cart.php?action=decrease&id=<?= $food_id; ?>"
                                class="qty-btn">
                                -
                                </a>

                                <span class="qty-number">
                                    <?= $qty; ?>
                                </span>

                                <a
                                href="update_cart.php?action=increase&id=<?= $food_id; ?>"
                                class="qty-btn">
                                +
                                </a>

                            </div>
                        </td>

                        <td>
                            Rs. <?= number_format($subtotal,2); ?>
                        </td>

                        <td>

                            <a
                            href="remove_cart.php?id=<?= $food_id; ?>"
                            class="btn-delete"
                            onclick="return confirm('Remove this item?')">

                                Remove

                            </a>

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

            <a href="menu.php" class="btn-secondary">
                Continue Shopping
            </a>

            <a href="checkout.php" class="btn">
                Checkout
            </a>

        </div>

    <?php } ?>

</div>

<?php include('includes/footer.php'); ?>