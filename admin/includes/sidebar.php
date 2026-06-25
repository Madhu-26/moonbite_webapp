<div class="sidebar">

    <div class="logo">
        MoonBite
    </div>

    <ul>

        <li>
            <a href="dashboard.php">Dashboard</a>
        </li>

        <li>
            <a href="foods.php">Foods</a>
        </li>

        <li>
            <a href="orders.php">Orders</a>
        </li>

        <?php if($_SESSION['role'] == 'Admin') { ?>

        <li>
            <a href="categories.php">Categories</a>
        </li>

        <li>
            <a href="staff.php">Staff</a>
        </li>

        <?php } ?>

        <li>
            <a href="logout.php">Logout</a>
        </li>

    </ul>

</div>