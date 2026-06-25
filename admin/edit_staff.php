<?php
include('../config/db.php');
include('includes/header.php');

if($_SESSION['role'] != 'Admin')
{
    die("Access Denied");
}

include('includes/sidebar.php');

$id = (int)$_GET['id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM staff
     WHERE staff_id = $id"
);

$staff = mysqli_fetch_assoc($result);

if(!$staff)
{
    die("Staff member not found");
}

if(isset($_POST['update']))
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    mysqli_query(
        $conn,
        "UPDATE staff SET
        name='$name',
        email='$email',
        role='$role'
        WHERE staff_id=$id"
    );

    header("Location: staff.php");
    exit();
}
?>

<div class="main">

<h2 class="page-title">
    Edit Staff Member
</h2>

<div class="form-container">

    <form method="POST">

        <div class="form-group">

            <input
                type="text"
                name="name"
                class="form-control"
                value="<?= $staff['name']; ?>"
                placeholder="Staff Name"
                required>

        </div>

        <div class="form-group">

            <input
                type="email"
                name="email"
                class="form-control"
                value="<?= $staff['email']; ?>"
                placeholder="Email Address"
                required>

        </div>

        <div class="form-group">

            <select
                name="role"
                class="form-control">

                <option
                    value="Admin"
                    <?= ($staff['role'] == 'Admin') ? 'selected' : ''; ?>>
                    Admin
                </option>

                <option
                    value="Staff"
                    <?= ($staff['role'] == 'Staff') ? 'selected' : ''; ?>>
                    Staff
                </option>

            </select>

        </div>

        <button
            type="submit"
            name="update"
            class="btn">
            Update Staff
        </button>

        <a
            href="staff.php"
            class="btn-secondary">
            ← Back
        </a>

    </form>

</div>

</div>

<?php include('includes/footer.php'); ?>
