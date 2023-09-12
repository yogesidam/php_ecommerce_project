<?php
include('../includes/connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- font awsemome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js" ></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script> -->

</head>

<body>

    <div class="container my-5">

        <h1 class="text-center my-3">Select Payment Method</h1>
        <hr>

        <?php
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $get_user = "SELECT * FROM `user_table` WHERE username= '$username'";
            $result = mysqli_query($connection, $get_user);
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
        }        
        ?>

        <center>
            <form class="w-50">
                <input type="textbox" class="form-control w-50 text-center" name="name" id="name" value="<?= $name ?>" placeholder="Enter your name" /><br /><br />
                <input type="textbox" class="form-control w-50 text-center" name="amt" id="amt" value="<?= $_SESSION['total_price'] ?>" placeholder="Enter amt" /><br /><br />
                <input type="textbox" class="form-control w-50 text-center" name="oid" id="oid" value="<?= $_SESSION['order_id'] ?>" placeholder="Enter oid" /><br /><br />
                <input type="textbox" class="form-control w-50 text-center" name="inv" id="inv" value="<?= $_SESSION['invoice_number'] ?>" placeholder="Enter inv" /><br /><br />
                <input type="button" class="btn btn-success px-5 mx-5 fw-bold" name="btn" id="btn" value="Place Order" onclick="pay_now()" />
            </form>
        </center>

        <!-- Make sure to include jQuery and Razorpay libraries in your HTML -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

        <script>
            function pay_now() {
                var name = jQuery('#name').val();
                var amt = jQuery('#amt').val();
                var oid = jQuery('#oid').val();
                var inv = jQuery('#inv').val();

                jQuery.ajax({
                    type: 'post',
                    url: 'payment_process.php',
                    data: "amt=" + amt + "& name=" + name + "& oid=" + oid + "& inv=" + inv,
                    success: function(result) {
                        var options = {
                            "key": "rzp_test_evEOCCEcbjwPij",
                            "amount": amt * 100,
                            "currency": "INR",
                            "name": "Acme Corp",
                            "description": "Test Transaction",
                            "image": "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
                            "handler": function(response) {
                                jQuery.ajax({
                                    type: 'post',
                                    url: 'payment_process.php',
                                    data: "payment_id=" + response.razorpay_payment_id,
                                    success: function(result) {
                                        window.location.href = "thank_you.php";
                                    }
                                });
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    }
                });


            }
        </script>

    </div>
</body>

</html>