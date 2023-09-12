<?php
if(isset($_GET['delete_payment'])){
    $delete_id = $_GET['delete_payment'];

    $delete_query = "DELETE FROM `user_payment` WHERE payment_id= $delete_id";
    $result = mysqli_query($connection, $delete_query);
    if($result){
        echo "<script>alert('Payment has been DELEATED Successfully')</script>";
        echo "<script>window.open('index.php?list_payment', '_self')</script>";
    }
}
?>