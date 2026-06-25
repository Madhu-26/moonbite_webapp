<?php
include('../config/db.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<section class="menu-section">

<h1>Our Menu</h1>

<div class="search-box">

    <form method="GET">

        <?php if(isset($_GET['category']) && !empty($_GET['category'])) { ?>

            <input
            type="hidden"
            name="category"
            value="<?= $_GET['category']; ?>">

        <?php } ?>

        <input
        type="text"
        name="search"
        class="search-input"
        placeholder="Search food..."
        value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>">

        <button
        type="submit"
        class="btn">

            Search

        </button>

    </form>

</div>

<div class="category-filter">

    <a href="menu.php" class="filter-btn">
        All
    </a>

    <?php

    $categories = mysqli_query(
        $conn,
        "SELECT *
         FROM category
         ORDER BY category_name"
    );

    while($cat = mysqli_fetch_assoc($categories))
    {
    ?>

        <a
        href="menu.php?category=<?= $cat['category_id']; ?>"
        class="filter-btn">

            <?= $cat['category_name']; ?>

        </a>

    <?php } ?>

</div>

<div class="food-grid">

<?php

$query = "
SELECT *
FROM food
WHERE availability='Available'
";

if(isset($_GET['category']) && !empty($_GET['category']))
{
    $category_id = mysqli_real_escape_string(
        $conn,
        $_GET['category']
    );

    $query .= "
    AND category_id='$category_id'
    ";
}

if(isset($_GET['search']) && !empty($_GET['search']))
{
    $search = mysqli_real_escape_string(
        $conn,
        $_GET['search']
    );

    $query .= "
    AND food_name LIKE '%$search%'
    ";
}

$query .= "
ORDER BY food_name
";

$result = mysqli_query($conn,$query);

while($food = mysqli_fetch_assoc($result))
{
?>

    <div class="food-card">

        <img
        src="../uploads/<?= $food['image']; ?>"
        alt="<?= $food['food_name']; ?>">

        <h3>
            <?= $food['food_name']; ?>
        </h3>

        <p class="price">
            Rs. <?= number_format($food['price'],2); ?>
        </p>

        <p class="description">
            <?= $food['description']; ?>
        </p>

        <a
        href="food_details.php?id=<?= $food['food_id']; ?>"
        class="mbtn">

            View Details

        </a>

    </div>

<?php } ?>

</div>

</section>

<?php include('includes/footer.php'); ?>