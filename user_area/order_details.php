<?php
include('../includes/connection.php');
include('../functions/common_function.php');
session_start();
//  echo $_SESSION['invoice_number'];
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $get_user = "SELECT * FROM `user_table` WHERE username= '$username'";
    $result = mysqli_query($connection, $get_user);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
    $select = "SELECT * FROM `delivery_detail` WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1";
    $result_select = mysqli_query($connection, $select);
    if (mysqli_num_rows($result_select) > 0) {
        $row = mysqli_fetch_assoc($result_select);
    } else {
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <!-- css link -->
    <link rel="stylesheet" type="text/css" href="../public/styles.css">
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- font awsemome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        .addbtn {
            position: relative;
            right: -800px;
        }

        fieldset {
            border: 2px solid red;
            padding: 10px;
            max-width: 400px;
            margin: 0 auto;
            /* position: relative;
      right: -100px;
      top: -10px; */
        }

        .no-border {
            border: none;
            background-color: transparent;
            font-weight: bold;
            /* Add other styles as per your design requirements */
        }

        .inactive-button {
            pointer-events: none;
            /* Prevents clicking on the button */
            opacity: 0.3;
            /* Makes the button appear grayed out */
        }
    </style>
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="address_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" class="form-control user_id" value="<?= $user_id ?>">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ADD Address</h1>
                    <!-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control address1" placeholder="House no. / Building Name">
                    </div>
                    <div class="form-group mt-4">
                        <input type="text" class="form-control address2" placeholder="Road Name / Area / Colony">
                    </div>
                    <div class="form-group mt-4 ">
                        <input type="text" class="form-control pincode" placeholder="Pincode">
                    </div>
                    <div class="form-group row mt-4">
                        <div class="col-md-6">
                            <input type="text" class="form-control city" placeholder="City">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control state" placeholder="State">
                        </div>
                    </div>
                    <div class="form-group mt-4 ">
                        <input type="text" class="form-control nearbye_location" placeholder="Nearby Famous Place / Shope / School ,etc/">
                    </div>
                    <h1 class="modal-title fs-5 mt-4">Contact Details</h1>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="text" class="form-control name" placeholder="Enter your Name">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control phone" placeholder="Enter your Phone no">
                        </div>
                    </div>
                    </form>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-danger btn-lg update_details">Submit</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger my-3 addbtn" data-toggle="modal" data-target="#address_modal">
            + ADD Address
        </button>
        <!-- <fieldset id="fieldset">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6"><?= $row['invoice_number'] ?>
                        <input type="text" class="no-border" value="<?= $row['address1'] ?>" readonly><br><br>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="no-border" value="<?= $row['pincode'] ?>" readonly>
                    </div>
                </div>
                <input type="text" class="no-border" value="<?= $row['address2'] ?>" readonly><br><br>
                <input type="text" class="no-border" value="<?= $row['nearbye_location'] ?>" readonly><br><br>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="no-border" value="<?= $row['name'] ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="no-border" value="<?= $row['phone'] ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="no-border" value="<?= $row['city'] ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="no-border" value="<?= $row['state'] ?>" readonly>
                    </div>
                </div>

        </fieldset> -->
        <div class="show_message">

        </div>

        <div class="row justify-content-center">
            <div class="col-md-10 mb-5">

                <h3 class="mt-4 text-center">Producr Details </h3>

                <?php

                if (isset($_POST['buy'])) {
                    $user_id = $_POST['user_id'];
                    $product_id = $_POST['product_id'];
                    $title = $_POST['title'];
                    $price = $_POST['price'];
                    $image = $_POST['image'];
                    $quantity = $_POST['quantity'];

                    $total = $price * $quantity;

                    $_SESSION['product_id'] = $product_id;
                    $_SESSION['price'] = $total;
                    $_SESSION['quantity'] = $quantity;
                    // echo $_SESSION['id'];
                ?>
                    <table class="table mt-5">
                        <tr>
                            <th     >Product Name : </th>
                            <td><?= $title ?></td>
                            <td rowspan="4" class="text-center"><img src="../admin_area/product_images/<?= $image ?>" width="200"></td>
                        </tr>
                        <tr>
                            <th     >Product Price : </th>
                            <td>Rs. <?= $price ?>/-</td>
                        </tr>
                        <tr>
                            <th     >Product quantiyy : </th>
                            <td> <?= $quantity ?> </td>
                        </tr>
                        <tr>
                            <th     >Delivery Charge : </th>
                            <td>free deliveary.</td>
                        </tr>

                    </table>

                    <h3 class="text-danger fw-bold">SubTotal Rs. <span class="text-dark"><?= $total ?>/-</span></h3>
                    <div id="active" class="d-flex justify-content-center align-items-center">
                        <a href="order_buy.php?user_id=<?= $user_id ?>" class="btn btn-danger btn-lg mt-4 px-5 inactive-button">Continue</a>
                    </div>
                    <?php
                } else {
                    $subtotal = $_SESSION['total_price'];
                    if (isset($_SESSION['user_id'])) {
                        $user_id = $_SESSION['user_id'];
                        $cart_query = "SELECT * FROM `cart` WHERE user_id= $user_id ";
                        $data = mysqli_query($connection, $cart_query);
                        foreach ($data as $d) {
                            $product_id = $d['product_id'];
                            $quantity = $d['quantity'];
                            $select_product = "SELECT * FROM `product` WHERE product_id ='$product_id' ";
                            $data1 = mysqli_query($connection, $select_product);
                            foreach ($data1 as $d1) {
                                $product_price = $d1['product_price'];
                                $product_title = $d1['product_title'];
                                $product_image1 = $d1['product_image1'];
                            }

                    ?>

                            <table class="table table-bordered  mt-5">
                                <tr>
                                    <th>Product Name : </th>
                                    <td><?= $product_title ?></td>
                                    <td rowspan="4" class="text-center"><img src="../admin_area/product_images/<?= $product_image1 ?>" width="200"></td>
                                </tr>
                                <tr>
                                    <th>Product Price : </th>
                                    <td>Rs. <?= $product_price ?>/-</td>
                                </tr>
                                <tr>
                                    <th>Product quantiyy : </th>
                                    <td> <?= $quantity ?></td>
                                </tr>
                                <tr>
                                    <th>Delivery Charge : </th>
                                    <td>free deliveary.</td>
                                </tr>

                            </table>

                    <?php
                        }
                    }
                    ?>

                    <h3 class="text-danger fw-bold">SubTotal Rs. <span class="text-dark"><?= $subtotal ?>/-</span></h3>
                    <div id="activec" class="d-flex justify-content-center align-items-center ">
                        <a href="order_cart.php?user_id=<?= $user_id ?>" class="btn btn-danger btn-lg mt-4 px-5 inactive-button">Continue</a>
                    </div>
                <?php
                }

                ?>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.update_details').click(function(e) {
                e.preventDefault();

                var user_id = $('.user_id').val();
                var address1 = $('.address1').val();
                var address2 = $('.address2').val();
                var pincode = $('.pincode').val();
                var city = $('.city').val();
                var state = $('.state').val();
                var nearbye_location = $('.nearbye_location').val();
                var name = $('.name').val();
                var phone = $('.phone').val();

                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'checking_add': true,
                        'user_id': user_id,
                        'address1': address1,
                        'address2': address2,
                        'pincode': pincode,
                        'city': city,
                        'state': state,
                        'nearbye_location': nearbye_location,
                        'name': name,
                        'phone': phone,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#address_modal').modal('hide');
                        $('.show_message').append('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                            '  <strong> ' + response + ' </strong>' +
                            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>')
                        $('.form_address').html('');
                        $('#active').html('<a href="order_buy.php?user_id=<?= $user_id ?>" class="btn btn-primary btn-lg mt-4 px-5">Continue</a>');
                        // Make the button active
                        $('#active a').removeClass('inactive-button');
                        $('#active a').removeAttr('disabled');

                        $('#activec').html('<a href="order_cart.php?user_id=<?= $user_id ?>" class="btn btn-primary btn-lg mt-4 px-5">Continue</a>');
                        // Make the button active
                        $('#activec a').removeClass('inactive-button');
                        $('#activec a').removeAttr('disabled');
                    }
                });
            });
        });
    </script>
</body>

</html>