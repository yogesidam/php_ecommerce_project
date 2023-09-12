<?php
if(isset($_GET['delete_brand'])){
    $delete_brand = $_GET['delete_brand'];

    $delete_query = "DELETE FROM `brand` WHERE brand_id= $delete_brand";
    $result = mysqli_query($connection, $delete_query);
    if($result){
        echo "<script>alert('Brand Deleted Successfully')</script>";
        echo "<script>window.open('./index.php?view_brand', '_self')</script>";
    }
}
?>