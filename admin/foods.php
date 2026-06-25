<?php
include('../config/db.php');
include('includes/header.php');
include('includes/sidebar.php');

if(isset($_POST['add']))
{
    $category_id = $_POST['category_id'];
    $food_name = trim($_POST['food_name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $availability = $_POST['availability'];
    $featured = $_POST['featured'];

    $image = "";

    if(!empty($_FILES['image']['name']))
    {
        $image = time() . "_" . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../uploads/" . $image
        );
    }

    mysqli_query(
        $conn,
        "INSERT INTO food
        (
            category_id,
            food_name,
            description,
            price,
            image,
            availability,
            featured
        )
        VALUES
        (
            '$category_id',
            '$food_name',
            '$description',
            '$price',
            '$image',
            '$availability',
            '$featured'
        )"
    );

    header("Location: foods.php");
    exit();
}
?>

<div class="main">

<h2 class="page-title">
    Food Management
</h2>

<div class="form-container">

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">

            <select
                name="category_id"
                class="form-control"
                required>

                <option value="">
                    Select Category
                </option>

                <?php
                $cat = mysqli_query(
                    $conn,
                    "SELECT * FROM category
                     ORDER BY category_name"
                );

                while($c = mysqli_fetch_assoc($cat))
                {
                ?>

                <option value="<?= $c['category_id']; ?>">
                    <?= $c['category_name']; ?>
                </option>

                <?php } ?>

            </select>

        </div>

        <div class="form-group">

            <input
                type="text"
                name="food_name"
                class="form-control"
                placeholder="Food Name"
                required>

        </div>

        <div class="form-group">

            <textarea
                name="description"
                class="form-control"
                placeholder="Food Description"></textarea>

        </div>

        <div class="form-group">

            <input
                type="number"
                step="0.01"
                name="price"
                class="form-control"
                placeholder="Price"
                required>

        </div>

        <div class="form-group">

            <input
                type="file"
                name="image"
                class="form-control"
                required>

        </div>

        <div class="form-group">

            <select
                name="availability"
                class="form-control">

                <option value="Available">
                    Available
                </option>

                <option value="Unavailable">
                    Unavailable
                </option>

            </select>

        </div>

        <div class="form-group">

            <label>Featured</label>

            <select
                name="featured"
                class="form-control">

                <option value="0">
                    No
                </option>

                <option value="1">
                    Yes
                </option>

            </select>

        </div>

        <button
            type="submit"
            name="add"
            class="btn">
            Add Food
        </button>

    </form>

</div>

<div class="table-container">

    <table>

        <thead>

            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Food</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th width="180">Action</th>
            </tr>

        </thead>

        <tbody>

        <?php

        $query = "
        SELECT food.*,
               category.category_name
        FROM food
        LEFT JOIN category
        ON food.category_id =
        category.category_id
        ORDER BY food.food_id DESC
        ";

        $result = mysqli_query($conn,$query);

        while($row = mysqli_fetch_assoc($result))
        {
        ?>

        <tr>

            <td>
                <?= $row['food_id']; ?>
            </td>

            <td>

                <img
                    src="../uploads/<?= $row['image']; ?>"
                    class="food-image">

            </td>

            <td>
                <?= $row['food_name']; ?>
            </td>

            <td>
                <?= $row['category_name']; ?>
            </td>

            <td>
                Rs. <?= number_format($row['price'],2); ?>
            </td>

            <td>

                <?php if($row['availability'] == 'Available') { ?>

                    <span class="status available">
                        Available
                    </span>

                <?php } else { ?>

                    <span class="status unavailable">
                        Unavailable
                    </span>

                <?php } ?>

            </td>

            <td>

                <div class="action-buttons">

                    <a
                        href="edit_food.php?id=<?= $row['food_id']; ?>"
                        class="btn-edit"
                        title="Edit Food">

                        <i class="fas fa-pen"></i>

                    </a>

                    <a
                        href="delete_food.php?id=<?= $row['food_id']; ?>"
                        class="btn-delete"
                        title="Delete Food"
                        onclick="return confirm('Delete this food?')">

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
