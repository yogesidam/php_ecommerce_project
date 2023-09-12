<?php
include('../includes/connection.php');
if (isset($_POST['submit'])) {
    $category_title = $_POST['categories_title'];

    $select_query = "SELECT * FROM category WHERE category_title ='$category_title' ";
    $data = mysqli_query($connection, $select_query);
    $number = mysqli_num_rows($data);
    if ($number > 0) {
        echo "<script>alert('This Category is already exixts.')</script>";
    } else {
        $insert_query = "INSERT INTO category(category_title) VALUES('$category_title') ";
        $data2 = mysqli_query($connection, $insert_query);
        if ($data2) {
            echo "<script>alert('Category has been Inserted Successfully')</script>";
            echo "<script>window.open('./index.php?view_categories', '_self')</script>";
        }
    }
}
?>

<h2 class="text-center">Insert Categories</h2>
<form action="" method="POST" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" placeholder="Insert Categories" name="categories_title">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <!-- <input type="submit" class="form-control bg-info" name="insert_cat" value="Insert Categories"> -->
        <button type="submit" class="bg-info p-2 my-3 border-0" name="submit">Insert Categories</button>
    </div>
</form>