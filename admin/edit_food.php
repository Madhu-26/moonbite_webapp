<?php
include('../config/db.php');
include('includes/header.php');
include('includes/sidebar.php');

$id = (int)$_GET['id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM food WHERE food_id = $id"
);

$food = mysqli_fetch_assoc($result);

if(!$food)
{
    die("Food not found");
}

if(isset($_POST['update']))
{
    $category_id = $_POST['category_id'];
    $food_name = trim($_POST['food_name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $availability = $_POST['availability'];
    $featured = $_POST['featured'];

    $image = $food['image'];

    if(!empty($_FILES['image']['name']))
    {
        $new_image = time() . "_" . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../uploads/" . $new_image
        );

        /* Delete old image */
        if(
            !empty($food['image']) &&
            file_exists("../uploads/" . $food['image'])
        )
        {
            unlink("../uploads/" . $food['image']);
        }

        $image = $new_image;
    }

    mysqli_query(
        $conn,
        "UPDATE food SET
        category_id='$category_id',
        food_name='$food_name',
        description='$description',
        price='$price',
        image='$image',
        availability='$availability',
        featured='$featured'
        WHERE food_id=$id"
    );

    header("Location: foods.php");
    exit();
}
?>

<div class="main">

<h2 class="page-title">
    Edit Food
</h2>

<div class="form-container">

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">

            <select
                name="category_id"
                class="form-control"
                required>

                <?php
                $cat = mysqli_query(
                    $conn,
                    "SELECT * FROM category
                     ORDER BY category_name"
                );

                while($c = mysqli_fetch_assoc($cat))
                {
                ?>

                <option
                    value="<?= $c['category_id']; ?>"
                    <?= ($food['category_id'] == $c['category_id']) ? 'selected' : ''; ?>>

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
                value="<?= $food['food_name']; ?>"
                required>

        </div>

        <div class="form-group">

            <textarea
                name="description"
                class="form-control"><?= $food['description']; ?></textarea>

        </div>

        <div class="form-group">

            <input
                type="number"
                step="0.01"
                name="price"
                class="form-control"
                value="<?= $food['price']; ?>"
                required>

        </div>

        <div class="form-group">

            <img
                src="../uploads/<?= $food['image']; ?>"
                class="food-preview">

        </div>

        <div class="form-group">

            <input
                type="file"
                name="image"
                class="form-control">

        </div>

        <div class="form-group">

            <select
                name="availability"
                class="form-control">

                <option
                    value="Available"
                    <?= ($food['availability'] == 'Available') ? 'selected' : ''; ?>>
                    Available
                </option>

                <option
                    value="Unavailable"
                    <?= ($food['availability'] == 'Unavailable') ? 'selected' : ''; ?>>
                    Unavailable
                </option>

            </select>

        </div>

        <div class="form-group">

            <label>Featured</label>

            <select
                name="featured"
                class="form-control">

                <option value="1"
                <?= ($food['featured']==1)?'selected':''; ?>>
                    Yes
                </option>

                <option value="0"
                <?= ($food['featured']==0)?'selected':''; ?>>
                    No
                </option>

            </select>

        </div>

        <button
            type="submit"
            name="update"
            class="btn">
            Update Food
        </button>

            <a
        href="foods.php"
        class="btn-secondary">
        ← Back
    </a>

    </form>

</div>

</div>

<?php include('includes/footer.php'); ?>
