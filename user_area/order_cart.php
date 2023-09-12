<?php
include('../includes/connection.php');
include('../functions/common_function.php');
session_start();

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    // Handle the case when user_id is not present in the URL
    // You can display an error message or redirect the user to an appropriate page
    echo "User ID not found";
    exit();
}

// getting total items and total price of all items
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $select = "SELECT * FROM `delivery_detail` WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1";
    $result_select = mysqli_query($connection, $select);
        $row = mysqli_fetch_assoc($result_select);
        $invoice_number = $row['invoice_number'];

    $subtotal = $_SESSION['total_price'];
    $status = 'pending';
    
    $product_ids = array();
    $quantities = array();
    $cart_query = "SELECT * FROM `cart` WHERE user_id= $user_id ";
    $data = mysqli_query($connection, $cart_query);
    $total_product = mysqli_num_rows($data);
    foreach ($data as $d) {
        $product_id = $d['product_id'];
        $product_ids[] = $product_id;
        $quantity = $d['quantity'];
        $quantities[] = $quantity;
    }

    //  string mde data lane ke liye
    $all_product_id = implode(',', $product_ids);
    $all_quantities = implode(',', $quantities);

    // echo $all_quantities;
    $insert_orders = "INSERT INTO `user_order`( user_id, amount_due, invoice_number, total_product, product_id, quantity, order_status)
                      VALUES('$user_id','$subtotal','$invoice_number','$total_product','$all_product_id','$all_quantities','$status')";
    $result_query = mysqli_query($connection, $insert_orders);
    if ($result_query) {
        $select = "SELECT * FROM `user_order` WHERE user_id=$user_id && invoice_number ='$invoice_number'";
        $result = mysqli_query($connection, $select);
        $row = mysqli_fetch_assoc($result);
        $order_id = $row['order_id'];
        $_SESSION['order_id'] = $order_id;
        $_SESSION['invoice_number'] = $invoice_number;
        $_SESSION['total_price'] = $subtotal;
        echo "<script>window.open('confirm_payment.php','_self')</script>";
    }
    
    $delete_cart = "DELETE FROM `cart` WHERE user_id= $user_id";
    $delete_result = mysqli_query($connection, $delete_cart);

}
