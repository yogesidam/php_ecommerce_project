<?php
include('./includes/connection.php');
include('./functions/common_function.php');
session_start();
if (isset($_SESSION['username'])) {
    $user_type = $_SESSION['user_type'];
    if ($user_type == 0) {
    } else {
        echo "<script>window.open('index.php','_self')</script>";
    }

    // $username = $_SESSION['username'];
    // if ($username == true) {

    // } else {
    //     echo "<script>window.open('login.php','_self')</script>";
    // }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce php project-Catr Details</title>
    <!-- css link -->
    <link rel="stylesheet" type="text/css" href="./public/styles.css">
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- font awsemome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        .cart_image {
            width: 80px;
            object-fit: contain;
        }

        #footer {
            position: relative;
            top: 120px;
        }
    </style>
</head>

<body style="overflow-x: hidden;">
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first-child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="./images/shopping_logo4.jpg" alt="" class="logo rounded-pill">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item text-danger" style="text-decoration:double">
                            <a class="nav-link active fw-bold" aria-current="page" href="index.php">Home </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="display_all.php">Products </a>
                        </li>

                        <?php
                        if (isset($_SESSION['username'])) {
                            echo " <li class='nav-item'>
                            <a class='nav-link active fw-bold' href='./user_area/profile.php'>My Account  </a>
                            </li>";
                        } else {
                            echo "<li class='nav-item'>
                            <a class='nav-link active fw-bold' href='registration.php'>Registar  </a>
                            </li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="#">Contact </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold text-light" href="cart.php"><i class="fa-sharp fa-solid fa-cart-shopping"></i><sup><b> <?php cart_item(); ?></b></sup> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="#">Total Price: <b><?php total_cart_price() ?> </b></a>
                        </li>
                    </ul>
                    <form class="d-flex" action="../search_product.php" method="GET">
                        <input class="form-control rounded-pill border border-primary" type="search" placeholder="Search" name="search_data" style="width: 300px;position:relative;left:73px">
                        <button type="submit" class="btn btn-primary rounded-pill" name="search" style="z-index: 1;">Search</button>
                    </form>
                </div>
            </div>
        </nav>


        <!-- add cart function here... -->
        <?php
        cart();
        ?>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                if (!isset($_SESSION['username'])) {
                    echo '  <li class="nav-item">
                               <a class="nav-link" href="#">Welcome Guest</a>
                            </li>';
                } else {
                    echo '  <li class="nav-item">
                               <a class="nav-link" href="#">Welcome: <span class="text-light fw-bolder">' . $_SESSION['username'] . '</span></a>
                            </li>';
                }
                ?>&nbsp;
                <?php
                if (!isset($_SESSION['username'])) {
                    echo ' <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                    </li>';
                } else {
                    echo ' <li class="nav-item">
                              <a class="nav-link" href="logout.php">Logout</a>
                           </li>';
                }
                ?>
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light border border-primary mb-2">
            <h3 class="text-center">Welcome to the ShopMarket</h3>
            <p class="text-center ">Enjoy your Journey, Get the desired items with the ToP Brands.</p>
        </div>

        <!-- fouth table -->
        <div class="container-fluid">
            <div class="row">
                <form action="" method="POST">
                    <table class="table table-bordered table-striped text-center ">

                        <tbody>

                            <!-- php code to display cart data... -->
                            <?php
                            $product_prices = array();

                            global $connection;
                            if (isset($_SESSION['username'])) {
                                $total_price = 0;
                                $username = $_SESSION['username'];
                                $get_user = "SELECT * FROM `user_table` WHERE username= '$username'";
                                $result = mysqli_query($connection, $get_user);
                                $row = mysqli_fetch_assoc($result);
                                $user_id = $row['user_id'];
                                $query = "SELECT * FROM `cart` WHERE user_id='$user_id' ";
                                $data = mysqli_query($connection, $query);
                                $number = mysqli_num_rows($data);
                                if ($number > 0) {
                                    echo " <thead class='bg-secondary text-light'>
                                <tr>
                                    <th>Product id</th>
                                    <th>Product Tite</th>
                                    <th>Product Image</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Update</th>
                                    <th colspan='2'>Remove</th>
                                </tr>
                            </thead>";
                                    $number = 0;

                                    foreach ($data as $d) {
                                        $product_id = $d['product_id'];
                                        $quantitys = $d['quantity'];
                                        $select_product = "SELECT * FROM `product` WHERE product_id ='$product_id' ";
                                        $data1 = mysqli_query($connection, $select_product);
                                        $number++;
                                        foreach ($data1 as $d1) {
                                            $product_id = $d1['product_id'];
                                            $product_price = $d1['product_price'];
                                            $product_title = $d1['product_title'];
                                            $product_image1 = $d1['product_image1'];
                                            $product = $product_price * $quantitys;
                                            $product_prices[] = $product;
                                        }

                            ?>
                                        <tr>
                                            <td>
                                                <?php echo $number ?>
                                                <input type="hidden" name="product_id[]" value="<?php echo $product_id ?>">
                                            </td>
                                            <td><?php echo $product_title ?></td>
                                            <td><img src="./admin_area/product_images/<?php echo $product_image1 ?>" class="cart_image" alt=""></td>
                                            <td><?php echo $product_price ?>/-</td>
                                            <td><input type="text" name="quantity[]" value="<?php echo $quantitys ?>" class="form-input text-center " style="width: 50px;"></td>
                                            <td><?php echo $product ?>/-</td>
                                            <td>
                                                <button type="submit" class="btn  " name="update_cart" value="<?php echo $product_id; ?>"><i class="fa-solid fa-pen-to-square" style="color: blue;"></i></button>
                                            </td>
                                            <td>
                                                <input type="checkbox" class="" name="remove_items[]" value="<?php echo $product_id; ?>">
                                                <button type="submit" class="btn " name="remove_cart"><i class="fa-solid fa-trash" style="color: red"></i></button>
                                            </td>
                                        </tr>
                                        <?php

                                    }
                                    // update cart item
                                    if (isset($_POST['update_cart'])) {
                                        // Get the product_ids and quantities from the form
                                        $product_ids = $_POST['product_id'];
                                        $quantities = $_POST['quantity'];

                                        // Iterate over the arrays and update the cart for each product
                                        for ($i = 0; $i < count($product_ids); $i++) {
                                            $product_id = $product_ids[$i];
                                            $quantity = $quantities[$i];

                                            if ($quantity > 0) {
                                                $update_query = "UPDATE `cart` SET quantity= $quantity WHERE product_id= $product_id";
                                                $data_update = mysqli_query($connection, $update_query);
                                                if ($data_update) {
                                                    $_SESSION['quantity'] = false;
                                        ?>
                                                    <meta http-equiv="refresh" content="2">
                            <?php
                                                } else {
                                                    // echo "<script>alert('Failed to update quantity for product_id $product_id.')</script>";
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    echo "<h4 class='text-center text-danger'>Cart is Empty.</h4>";
                                }
                            } else {
                                echo "<script>window.open('login.php','_self')</script>";
                            }

                            // To calculate total price.
                            $total_price = 0;
                            for ($i = 0; $i < count($product_prices); $i++) {
                                $total_price += $product_prices[$i];
                            }
                            $_SESSION['total_price'] = $total_price;
                            // echo $_SESSION['total_price'];


                            ?>
                        </tbody>
                    </table>

                    <!-- function to remove items.. -->
                    <?php
                    function remove_cart_item()
                    {
                        global $connection;
                        if (isset($_POST['remove_cart'])) {
                            if (isset($_POST['remove_items'])) {
                                foreach ($_POST['remove_items'] as $remove_id) {
                                    echo $remove_id;
                                    $delete_query = "DELETE FROM `cart` WHERE product_id= $remove_id";
                                    $data_delete = mysqli_query($connection, $delete_query);
                                    if ($data_delete) {
                                        $_SESSION['remove'] = true;
                    ?>
                                        <meta http-equiv="refresh" content="2">
                    <?php                                    }
                                }
                            } else {
                                echo "<script>alert('please check the remove box')</script>";
                                echo "<script>window.open('cart.php','_self')</script>";
                            }
                        }
                    }
                    echo $remove_id = remove_cart_item();
                    ?>


                    <!-- SubTotoal -->
                    <div class="d-flex mb-2">
                        <!-- display total and checkout if cart value is greater than one.. -->
                        <?php
                        global $connection;
                        $get_ip_add = getIPAddress();
                        $query = "SELECT * FROM `cart` WHERE user_id= $user_id ";
                        $data = mysqli_query($connection, $query);
                        $number = mysqli_num_rows($data);
                        if ($number > 0) {
                            echo '<h4 class="px-3" ><sapn class="text-danger" >Subtotal</span>: <strong class="text-dark text-decoration-underline">' . $total_price . '/-</strong></h4>                            
                            <a href="./user_area/order_details.php?user_id=' . $user_id . '" class="btn btn-success px-5 mx-3 text-white text-decoration-none">Buy</a>
                            <a href="index.php"><button type="submit" name="continue_shopping" class="btn btn-info mx-2">Continue Shoping</button></a>';
                        } else {
                            echo '<a href="index.php"><button type="submit" name="continue_shopping" class="bg-info px-3 py-1 border-0">Continue Shoping</button></a>';
                        }
                        if (isset($_POST['continue_shopping'])) {
                            echo "<script>window.open('index.php','_self')</script>";
                        }
                        ?>
                    </div>
            </div>
        </div>
        </form>

        <!-- last child -->
        <!-- include footer -->
        <div id="footer">
            <?php include('./includes/footer.php') ?>
        </div>
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php
    if (isset($_SESSION['quantity'])) {
    ?>
        <script>
            swal({
                title: "Quantity Updated successfully",
                text: "_______________________________",
                icon: "success",
                button: false, // Remove the button
            });
        </script>
    <?php
        unset($_SESSION['quantity']);
    }

    if (isset($_SESSION['remove'])) {
    ?>
        <script>
            swal({
                title: "Item Removed successfully",
                text: "____________________________",
                icon: "success",
                button: false, // Remove the button
            });
        </script>
    <?php
        unset($_SESSION['remove']);
    }
    ?>
</body>

</html>