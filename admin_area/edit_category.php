<?php
if(isset($_GET['edit_category'])){
    $edit_category = $_GET['edit_category'];

    $select_category = "SELECT * FROM `category` WHERE category_id= $edit_category";
    $result_category = mysqli_query($connection, $select_category);
    $row = mysqli_fetch_assoc($result_category);
}
?>

<div class="container mt-3">
    <h1 class="text-center">Edit Category</h1>
    <form action="" method="POST" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="input-title">Category Title</label>
            <input type="text" name="category_title" id="input-title" class="form-control" value="<?php echo $row['category_title'] ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-info px-3 mb-3">Update Category</button>
    </form>
</div>

<?php
if(isset($_POST['update'])){
    $category_title = $_POST['category_title'];

    $update_query = "UPDATE `category` set category_title= '$category_title' WHERE category_id= '$edit_category' ";
    $result_update = mysqli_query($connection, $update_query);
    if($result_update){
        echo "<script>alert('Category Updated Successfully')</script>";
        echo "<script>window.open('./index.php?view_categories', '_self')</script>";
    }
}
?>