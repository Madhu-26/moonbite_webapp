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
    $category_name = trim($_POST['category_name']);

    if(!empty($category_name))
    {
        mysqli_query(
            $conn,
            "INSERT INTO category(category_name)
             VALUES('$category_name')"
        );

        header("Location: categories.php");
        exit();
    }
}
?>

<div class="main">

<h2 class="page-title">
    Category Management
</h2>

<div class="form-container">

    <form method="POST">

        <div class="form-group">

            <input
                type="text"
                name="category_name"
                class="form-control"
                placeholder="Enter Category Name"
                required>

        </div>

        <button
            type="submit"
            name="add"
            class="btn">
            Add Category
        </button>

    </form>

</div>

<div class="table-container">

    <table>

        <thead>

            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th width="120">Action</th>
            </tr>

        </thead>

        <tbody>

        <?php

        $result = mysqli_query(
            $conn,
            "SELECT *
             FROM category
             ORDER BY category_id DESC"
        );

        while($row = mysqli_fetch_assoc($result))
        {
        ?>

        <tr>

            <td>
                <?= $row['category_id']; ?>
            </td>

            <td>
                <?= $row['category_name']; ?>
            </td>

            <td>

                <div class="action-buttons">

                    <a
                        href="delete_category.php?id=<?= $row['category_id']; ?>"
                        class="btn-delete"
                        title="Delete Category"
                        onclick="return confirm('Delete this category?')">

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
