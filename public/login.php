<?php
include('../config/db.php');
include('includes/header.php');

if(isset($_POST['login']))
{
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query(
        $conn,
        "SELECT *
         FROM customer
         WHERE email='$email'
         AND password='$password'"
    );

    if(mysqli_num_rows($result) == 1)
    {
        $customer = mysqli_fetch_assoc($result);

        $_SESSION['customer_id'] = $customer['customer_id'];

        $_SESSION['customer_name'] =
            $customer['first_name'] . ' ' .
            $customer['last_name'];

        header("Location: index.php");
        exit();
    }
    else
    {
        $error = "Invalid Email or Password";
    }
}
?>

<?php include('includes/navbar.php'); ?>

<div class="menu-section">

    <h1>Customer Login</h1>

    <div class="form-container">

        <?php if(isset($error)) { ?>

            <div class="error">
                <?= $error; ?>
            </div>

        <?php } ?>

        <form method="POST">

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

            <button
            type="submit"
            name="login"
            class="btn">

                Login

            </button>

        </form>

        <br>

        <p>

            Don't have an account?

            <a href="register.php">
                Register Here
            </a>

        </p>

    </div>

</div>

<?php include('includes/footer.php'); ?>