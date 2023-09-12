<?php
include('../includes/connection.php');
if (isset($_POST['submit'])) {
    $brand_title = $_POST['brand_title'];

    $select_query = " SELECT * FROM brand WHERE brand_title ='$brand_title' ";
    $data = mysqli_query($connection, $select_query);
    $number = mysqli_num_rows($data);
    if ($number > 0) {
        echo " <script>alert('This Title is already exists.')</script> ";
    } else {
        $insert_query = " INSERT INTO brand(brand_title) VALUES('$brand_title') ";
        $data1 = mysqli_query($connection, $insert_query);
        if ($data1) {
            echo " <script>alert('Brand has been added Successfully.')</script> ";
            echo "<script>window.open('./index.php?view_brand', '_self')</script>";
        }
    }
}
?>

<h2 class="text-center">Insert Brand</h2>
<form action="" method="POST" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert brand" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <!-- <input type="submit" class="form-control bg-info" name="insert_cat" value="Insert Categories"> -->
        <button type="submit" class="bg-info p-2 my-3 border-0" name="submit">Insert Brand</button>
    </div>
</form>