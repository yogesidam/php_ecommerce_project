<?php
if(isset($_GET['delete_category'])){
    $delete_category = $_GET['delete_category'];

    $delete_query = "DELETE FROM `category` WHERE category_id= $delete_category";
    $result = mysqli_query($connection, $delete_query);
    if($result){
        echo "<script>alert('Category Deleted Successfully')</script>";
        echo "<script>window.open('./index.php?view_categories', '_self')</script>";
    }
}
?>