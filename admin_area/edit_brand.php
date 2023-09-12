<?php
if(isset($_GET['edit_brand'])){
    $edit_brand = $_GET['edit_brand'];

    $select_query = "SELECT * FROM `brand` WHERE brand_id= $edit_brand";
    $result_query = mysqli_query($connection, $select_query);
    $row = mysqli_fetch_assoc($result_query);
}
?>

<div class="container mt-3">
    <h1 class="text-center">Edit Brand</h1>
    <form action="" method="POST" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="input-title">Brand Title</label>
            <input type="text" name="brand_title" id="input-title" class="form-control" value="<?php echo $row['brand_title'] ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-info px-3 mb-3">Update Brand</button>
    </form>
</div>

<?php
if(isset($_POST['update'])){
    $brand_title = $_POST['brand_title'];

    $update_query = "UPDATE `brand` set brand_title= '$brand_title' WHERE brand_id= '$edit_brand' ";
    $result_update = mysqli_query($connection, $update_query);
    if($result_update){
        echo "<script>alert('Category Updated Successfully')</script>";
        echo "<script>window.open('./index.php?view_brand', '_self')</script>";
    }
}
?>