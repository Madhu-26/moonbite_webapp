<?php
session_start();
include('../config/db.php');
include('includes/header.php');
include('includes/navbar.php');

if(!isset($_SESSION['customer_id']))
{
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

if(isset($_POST['update']))
{
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $phone      = $_POST['phone'];
    $address    = $_POST['address'];

    mysqli_query(
        $conn,
        "UPDATE customer
         SET first_name='$first_name',
             last_name='$last_name',
             phone='$phone',
             address='$address'
         WHERE customer_id=$customer_id"
    );

    $success = "Profile updated successfully.";
}

$customer = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT *
         FROM customer
         WHERE customer_id=$customer_id"
    )
);
?>

<div class="menu-section">

    <h1>My Profile</h1>

    <div class="form-container">

        <?php if(isset($success)) { ?>
            <div class="success">
                <?= $success ?>
            </div>
        <?php } ?>

        <form method="POST">

            <div class="form-group">
                <input
                type="text"
                name="first_name"
                class="form-control"
                value="<?= $customer['first_name']; ?>"
                required>
            </div>

            <div class="form-group">
                <input
                type="text"
                name="last_name"
                class="form-control"
                value="<?= $customer['last_name']; ?>"
                required>
            </div>

            <div class="form-group">
                <input
                type="email"
                class="form-control"
                value="<?= $customer['email']; ?>"
                readonly>
            </div>

            <div class="form-group">
                <input
                type="text"
                name="phone"
                class="form-control"
                value="<?= $customer['phone']; ?>">
            </div>

            <div class="form-group">
                <textarea
                name="address"
                class="form-control"><?= $customer['address']; ?></textarea>
            </div>

            <button
            type="submit"
            name="update"
            class="btn">

                Update Profile

            </button>

        </form>

    </div>

</div>

<?php include('includes/footer.php'); ?>