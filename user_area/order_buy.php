<?php
include('../includes/connection.php');
session_start();

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $select = "SELECT * FROM `delivery_detail` WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1";
    $result_select = mysqli_query($connection, $select);
    if (mysqli_num_rows($result_select) > 0) {
        $row = mysqli_fetch_assoc($result_select);
        $invoice_number = $row['invoice_number'];
    }

    $product_id = $_SESSION['product_id'];
    $title = $_SESSION['title'];
    $price = $_SESSION['price'];

    $quantity = $_SESSION['quantity'];
    $status = "Pending";

    $insert_orders = "INSERT INTO `user_order`( user_id, amount_due, invoice_number, total_product, product_id, quantity, order_status)
                     VALUES('$user_id','$price','$invoice_number',1,'$product_id','$quantity','$status')";
    $result_query = mysqli_query($connection, $insert_orders);
    if ($result_query) {
        $select = "SELECT * FROM `user_order` WHERE user_id=$user_id && invoice_number ='$invoice_number'";
        $result = mysqli_query($connection, $select);
        $row = mysqli_fetch_assoc($result);
        $order_id = $row['order_id'];
        $_SESSION['order_id'] = $order_id;
        $_SESSION['invoice_number'] = $invoice_number;
        $_SESSION['total_price'] = $price;
        echo "<script>window.open('confirm_payment.php','_self')</script>";
    }
}
