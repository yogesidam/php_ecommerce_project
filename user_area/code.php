<?php
include('../includes/connection.php');
if(isset($_POST['checking_add'])){
    $user_id = $_POST['user_id'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $pincode = $_POST['pincode'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $nearbye_location = $_POST['nearbye_location'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $invoice_number = mt_rand();
   $add_query = "INSERT INTO `delivery_detail` (user_id, invoice_number, address1, address2, pincode, city, state, nearbye_location, name, phone) 
                 VALUES ('$user_id', '$invoice_number', '$address1', '$address2', '$pincode', '$city', '$state', '$nearbye_location', '$name', '$phone') ";
   $add_result = mysqli_query($connection, $add_query);

   if($add_result){
       echo $return = "Successfully Stored Data";
   }
   else{
       echo $return = "Data not Stored";
   }
}
?>