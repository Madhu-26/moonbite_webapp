<?php
include('../config/db.php');
include('includes/header.php');

if($_SESSION['role'] != 'Admin')
{
    die("Access Denied");
}

include('includes/sidebar.php');

if(isset($_POST['add']))
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];

    mysqli_query(
        $conn,
        "INSERT INTO staff
        (
            name,
            email,
            password,
            role
        )
        VALUES
        (
            '$name',
            '$email',
            '$password',
            '$role'
        )"
    );

    header("Location: staff.php");
    exit();
}
?>

<div class="main">

<h2 class="page-title">
    Staff Management
</h2>

<div class="form-container">

    <form method="POST">

        <div class="form-group">

            <input
                type="text"
                name="name"
                class="form-control"
                placeholder="Staff Name"
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

            <select
                name="role"
                class="form-control">

                <option value="Admin">
                    Admin
                </option>

                <option value="Staff">
                    Staff
                </option>

            </select>

        </div>

        <button
            type="submit"
            name="add"
            class="btn">
            Add Staff
        </button>

    </form>

</div>

<div class="table-container">

    <table>

        <thead>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th width="120">Action</th>
            </tr>

        </thead>

        <tbody>

        <?php

        $result = mysqli_query(
            $conn,
            "SELECT *
             FROM staff
             ORDER BY staff_id DESC"
        );

        while($row = mysqli_fetch_assoc($result))
        {
        ?>

        <tr>

            <td>
                <?= $row['staff_id']; ?>
            </td>

            <td>
                <?= $row['name']; ?>
            </td>

            <td>
                <?= $row['email']; ?>
            </td>

            <td>

                <?php if($row['role'] == 'Admin') { ?>

                    <span class="status ready">
                        Admin
                    </span>

                <?php } else { ?>

                    <span class="status pending">
                        Staff
                    </span>

                <?php } ?>

            </td>

            <td>

                <div class="action-buttons">

                    <a
                        href="edit_staff.php?id=<?= $row['staff_id']; ?>"
                        class="btn-edit"
                        title="Edit Staff">

                        <i class="fas fa-pen"></i>

                    </a>

                    <a
                        href="delete_staff.php?id=<?= $row['staff_id']; ?>"
                        class="btn-delete"
                        title="Delete Staff"
                        onclick="return confirm('Delete this staff member?')">

                        <i class="fas fa-trash"></i>

                    </a>

                </div>

            </td>

        </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</div>

<?php include('includes/footer.php'); ?>
