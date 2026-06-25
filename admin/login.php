<?php
session_start();
include('../config/db.php');

if(isset($_POST['login']))
{
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM staff
              WHERE email='$email'
              AND password='$password'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) == 1)
    {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['staff_id'] = $row['staff_id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];

        if($row['role'] == 'Admin')
        {
            header("Location: dashboard.php");
        }
        else
        {
            header("Location: dashboard.php");
        }

        exit();
    }
    else
    {
        $error = "Invalid Email or Password";
    }
}
?>

<!DOCTYPE html>

<html>
<head>

<title>MoonBite Café Login</title>

<link rel="stylesheet"
      href="../assets/css/style.css">

<meta name="viewport"
      content="width=device-width, initial-scale=1">

</head>

<body>

<div class="login-container">

<div class="login-box">

    <div class="login-logo">
        🌙 MoonBite Café
    </div>

    <div class="login-tagline">
        Where Every Bite Shines
    </div>

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
                placeholder="Enter Email Address"
                required>

        </div>

        <div class="form-group">

            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="Enter Password"
                required>

        </div>

        <button
            type="submit"
            name="login"
            class="btn login-btn">

            Login

        </button>

    </form>

</div>

</div>

</body>
</html>
