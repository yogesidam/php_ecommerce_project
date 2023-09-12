<?php
session_start();
include('../includes/connection.php');
if(isset($_POST['amt']) && isset($_POST['name']) && isset($_POST['oid']) && isset($_POST['inv'])){
    $amt=$_POST['amt'];
    $name=$_POST['name'];
    $oid=$_POST['oid'];
    $inv=$_POST['inv'];
    $payment_status="pending";
    $payment_mode="Razorpay";
    $added_on=date('Y-m-d h:i:s');
    mysqli_query($connection,"INSERT INTO `payment` (name,amount,order_id,invoice_number,payment_status,payment_mode,added_on) VALUES ('$name','$amt','$oid','$inv','$payment_status','$payment_mode','$added_on')");
    $_SESSION['OID']=mysqli_insert_id($connection);
}


if(isset($_POST['payment_id']) && isset($_SESSION['OID'])){
    $payment_id=$_POST['payment_id'];
    mysqli_query($connection,"UPDATE `payment` SET payment_status='complete',payment_id='$payment_id' WHERE id='".$_SESSION['OID']."'");
}
?>