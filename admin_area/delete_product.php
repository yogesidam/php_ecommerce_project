<?php
if(isset($_GET['delete_product'])){
    $delete_id = $_GET['delete_product'];
    // echo $delete_id;

    $delete_query = "DELETE FROM `product` WHERE product_id= $delete_id";
    $result = mysqli_query($connection, $delete_query);
    if($result){
        echo "<script>alert('Product Deleted Successfully')</script>";
    }
}
?>