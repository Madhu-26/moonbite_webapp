<?php
include('../config/db.php');
include('includes/header.php');
include('includes/navbar.php');

$id = $_GET['id'];

$result = mysqli_query(
    $conn,
    "SELECT *
     FROM food
     WHERE food_id = $id"
);

$food = mysqli_fetch_assoc($result);

if(!$food)
{
    die("Food not found");
}
?>

<div class="food-details-container">

    <div class="food-details-card">

        <div class="food-image">

            <img
            src="../uploads/<?= $food['image']; ?>"
            alt="<?= $food['food_name']; ?>">

        </div>

        <div class="food-info">

            <h1>
                <?= $food['food_name']; ?>
            </h1>

            <h2>
                Rs. <?= number_format($food['price'],2); ?>
            </h2>

            <p>
                <?= $food['description']; ?>
            </p>

            <form action="add_to_cart.php" method="POST">

                <input
                type="hidden"
                name="food_id"
                value="<?= $food['food_id']; ?>">

                <label>
                    Quantity
                </label>

                <input
                type="number"
                name="quantity"
                value="1"
                min="1"
                class="qty-box">

                <br><br>

                <button
                type="submit"
                class="btn">

                    Add To Cart

                </button>

                <a
                href="menu.php"
                class="back-btn">

                Back To Menu

                </a>

            </form>

        </div>

    </div>

</div>

<?php
include('includes/footer.php');
?>