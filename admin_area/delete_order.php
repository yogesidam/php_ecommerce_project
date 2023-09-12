<?php
if(isset($_GET['delete_order'])){
    $delete_id = $_GET['delete_order'];

    $delete_query = "DELETE FROM `user_order` WHERE order_id= $delete_id";
    $result = mysqli_query($connection, $delete_query);
    if($result){
        echo "<script>alert('Order has been Deleted Successfully')</script>";
        echo "<script>window.open('index.php?list.order.php', '_self')</script>";
    }
}
?>