<?php
include('../config/db.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<?php

$food_count = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM food
         WHERE availability='Available'"
    )
);

$order_count = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM orders"
    )
);

$customer_count = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM customer"
    )
);

?>

<section class="hero">

    <div class="hero-slider">

        <div class="slide active">
            <img src="../assets/images/slider1.jpg">
        </div>

        <div class="slide">
            <img src="../assets/images/slider2.jpg">
        </div>

        <div class="slide">
            <img src="../assets/images/slider3.jpg">
        </div>

    </div>

    <div class="hero-overlay">

            <span class="hero-tag">
        WELCOME TO MOONBITE CAFÉ
        </span>

        <h1>
            Where Every 
            <span>Bite Shines</span>
        </h1>

        <p>
            Fresh Coffee • Handcrafted Meals • Signature Desserts
            <br>
            Crafted with Passion, Served with Love.
        </p>

        <div class="hero-buttons">

            <a href="menu.php" class="hero-btn">
                Explore Our Menu
                <i class="fas fa-arrow-right"></i>
            </a>

        </div>

    </div>

    <div class="scroll-indicator">

        <a href="#about">

            <span class="scroll-mouse">
                <span class="scroll-wheel"></span>
            </span>

            <span class="scroll-text">
                Scroll to Explore
            </span>

        </a>

    </div>

</section>

<section class="welcome" id="about">

    <div class="welcome-container">

        <div class="welcome-content">

            <span class="welcome-tag">
                ABOUT MOONBITE
            </span>

            <h2>
                Crafted With Passion,
                Served With Love
            </h2>

            <p>
                Experience handcrafted meals, premium coffee,
                delightful desserts, and a warm atmosphere
                designed to make every visit memorable.
            </p>

            <div class="welcome-stats">

                <div class="stat-card">
                    <div class="stat-icon">🍽️</div>
                    <h3><?= $food_count['total']; ?>+</h3>
                    <p>Menu Items</p>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">📦</div>
                    <h3><?= $order_count['total']; ?>+</h3>
                    <p>Orders Delivered</p>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">😊</div>
                    <h3><?= $customer_count['total']; ?>+</h3>
                    <p>Happy Customers</p>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">⚡</div>
                    <h3>24/7</h3>
                    <p>Fresh Service</p>
                </div>

            </div>

        </div>

    </div>

</section>

<div class="section-divider">
    ✦
</div>

<section class="featured" id="featured">

<h2>Featured Menu</h2>

<div class="food-grid">

<?php

$result = mysqli_query(
    $conn,
    "SELECT *
     FROM food
     WHERE featured = 1
     AND availability='Available'
     ORDER BY food_name
     LIMIT 6"
);

while($food = mysqli_fetch_assoc($result))
{
?>

    <div class="feature-card">

        <span class="featured-badge">
            Featured
        </span>

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
            <?= substr($food['description'],0,80); ?>...
        </p>

        <a
        href="food_details.php?id=<?= $food['food_id']; ?>"
        class="btn">

        Order Now
        <i class="fas fa-arrow-right"></i>

        </a>

    </div>

<?php } ?>

</div>

</section>

<script>
let slides = document.querySelectorAll('.slide');
let current = 0;

setInterval(() => {

    slides[current].classList.remove('active');

    current++;

    if(current >= slides.length)
    {
        current = 0;
    }

    slides[current].classList.add('active');

}, 4000);
</script>

<?php
include('includes/footer.php');
?>
