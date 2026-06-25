<?php
include('../config/db.php');

if(isset($_POST['register']))
{
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $password   = $_POST['password'];
    $phone      = trim($_POST['phone']);
    $address    = trim($_POST['address']);

    $check = mysqli_query(
        $conn,
        "SELECT customer_id
         FROM customer
         WHERE email='$email'"
    );

    if(mysqli_num_rows($check) > 0)
    {
        $error = "Email already registered.";
    }
    else
    {
        mysqli_query(
            $conn,
            "INSERT INTO customer
            (
                first_name,
                last_name,
                email,
                password,
                phone,
                address
            )
            VALUES
            (
                '$first_name',
                '$last_name',
                '$email',
                '$password',
                '$phone',
                '$address'
            )"
        );

        header("Location: login.php");
        exit();
    }
}
?>

<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>

<div class="menu-section">

    <h1>Customer Registration</h1>

    <div class="form-container">

        <?php if(isset($error)) { ?>
            <div class="error">
                <?= $error; ?>
            </div>
        <?php } ?>

        <form method="POST">

            <div class="form-group">
                <input
                type="text"
                name="first_name"
                class="form-control"
                placeholder="First Name"
                required>
            </div>

            <div class="form-group">
                <input
                type="text"
                name="last_name"
                class="form-control"
                placeholder="Last Name"
                required>
            </div>

            <div class="form-group">
                <input
                type="email"
                name="email"
                class="form-control"
                placeholder="Email Address"
                required>
            </div>

            <div class="form-group">
                <input
                type="password"
                name="password"
                class="form-control"
                placeholder="Password"
                required>
            </div>

            <div class="form-group">
                <input
                type="text"
                name="phone"
                class="form-control"
                placeholder="Phone Number"
                required>
            </div>

            <div class="form-group">
                <textarea
                name="address"
                class="form-control"
                placeholder="Address"
                required></textarea>
            </div>

            <button
            type="submit"
            name="register"
            class="btn">

                Register

            </button>

        </form>

    </div>

</div>

<?php include('includes/footer.php'); ?>