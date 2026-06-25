<?php

$cart_count = 0;

if(isset($_SESSION['cart']))
{
    foreach($_SESSION['cart'] as $qty)
    {
        $cart_count += $qty;
    }
}
?>

<nav class="navbar">

<div class="brand">

🌙 <span>MoonBite</span> Café

</div>

<ul>

    <li><a href="index.php">Home</a></li>

    <li><a href="menu.php">Menu</a></li>

    <li><a href="track_order.php">Track Order</a></li>

    <?php if(isset($_SESSION['customer_id'])) { ?>

        <li>
            <a href="cart.php">
                Cart
                <?php if($cart_count > 0) { ?>
                    <span class="cart-badge">
                        <?= $cart_count; ?>
                    </span>
                <?php } ?>
            </a>
        </li>

        <li>
            <a href="myorders.php">
                My Orders
            </a>
        </li>

        <li><a href="profile.php">My Profile</a></li>

        <li>
            <a href="logout.php">
                Logout
            </a>
        </li>

    <?php } else { ?>

        <li>
            <a href="register.php">
                Register
            </a>
        </li>

        <li>
            <a href="login.php">
                Login
            </a>
        </li>

    <?php } ?>

</ul>

</nav>
