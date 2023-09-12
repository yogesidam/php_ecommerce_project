<?php
include('./includes/connection.php');
include('./functions/common_function.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce php project</title>
    <!-- css link -->
    <link rel="stylesheet" type="text/css" href="./public/styles.css">
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- font awsemome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        .logo {
            height: 50px;
            object-fit: contain;
            margin-right: 20px;
        }

        .card-img-viewmore {
            position: relative;
            top: 20px;
            object-fit: contain;
        }

        .quantity-wrapper {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            font-size: 18px;
            cursor: pointer;
        }

        #quantity-input {
            text-align: center;
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
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="display_all.php">Products</a>
                        </li>
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo " <li class='nav-item'>
                            <a class='nav-link active fw-bold' href='./user_area/profile.php'>My Account</a>
                            </li>";
                        } else {
                            echo "<li class='nav-item'>
                            <a class='nav-link active fw-bold' href='registration.php'>Registar</a>
                            </li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="cart.php"><i class="fa-sharp fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold " href="#">Total Price: <b><?php total_cart_price() ?></b></a>
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
        <div class="bg-light">
            <h3 class="text-center">Welcome to the ShopMarket</h3>
            <p class="text-center ">Enjoy your Journey, Get the desired items with the ToP Brands.</p>
        </div>

        <!-- forth child -->
        <div class="">
            <!-- products -->


            <!--  Featching products -->
            <?php
            // colling function...
            // view_details();
            get_selected_categories();
            get_selected_brands();


            if (isset($_GET['product_id'])) {
                if (!isset($_GET['category'])) {
                    if (!isset($_GET['brand'])) {
                        $product_id = $_GET['product_id'];
                        $select_query = "SELECT * FROM `product` WHERE product_id = '$product_id'";
                        $data = mysqli_query($connection, $select_query);
                        $row = mysqli_fetch_assoc($data);
                        $product_id = $row['product_id'];
                        $product_title = $row['product_title'];
                        $product_description = $row['product_description'];
                        $product_keywords = $row['product_keywords'];
                        $product_category = $row['category_id'];
                        $product_brand = $row['brand_id'];
                        $product_image1 = $row['product_image1'];
                        $product_image2 = $row['product_image2'];
                        $product_image3 = $row['product_image3'];
                        $product_price = $row['product_price'];
                    }
                }
            }
            ?>
            <form action="./user_area/order_details.php" method="POST">

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card mx-5 my-5 border-0">
                            <img src="./admin_area/product_images/<?= $product_image1 ?>" class="card-img-viewmore" alt="$product_title">
                            <input type="hidden" name="image" value="<?= $product_image1 ?>">
                            <div class="card-body">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!--KO related images -->
                        <div class="row mt-5">


                            <h5 class="card-title mt-4"><?= $product_title ?></h5>
                            <input type="hidden" name="product_id" value="<?= $product_id ?>">
                            <input type="hidden" name="title" value="<?= $product_title ?>">
                            <h5 class="card-text mt-4">price: <?= $product_price ?>/-</h5>
                            <input type="hidden" name="price" value="<?= $product_price ?>">
                            <br>
                            <div class="col-md-6">
                                <p class="card-des-top my-4" alt="<?= $product_title ?>"> <?= $product_description ?></p>

                                <div class="quantity-wrapper">
                                    <button class="quantity-btn btn-danger" id="decrease-btn">-</button>
                                    <input type="text" name="quantity" value="1" class="mx-2" style="width: 50px;" id="quantity-input">
                                    <button class="quantity-btn btn-danger" id="increase-btn">+</button>
                                </div>

                                <h5 class="my-4 text-danger">Available offers</h5>

                                <p>Bank Offer5% Cashback on mystore Axis Bank CardT&C </p>

                                <p>Bank Offer ₹50 off on 1200 for UPIT&C</p>

                                <p>Expiry Date 26 Oct 2023 <br>
                                    Manufactured date 29 Jun 2023</p>

                                <div class="d-flex align-items-center justify-content-center my-5">
                                    <a href="index.php?add_to_cart=<?= $product_id ?>" class="btn btn-danger mx-2">Add to cart</a>
                                    <?php
                                    if (isset($_SESSION['username'])) {
                                        $username = $_SESSION['username'];
                                        $get_user = "SELECT * FROM `user_table` WHERE username= '$username'";
                                        $result = mysqli_query($connection, $get_user);
                                        $row = mysqli_fetch_assoc($result);
                                        $user_id = $row['user_id'];
                                    }
                                    ?>
                                    <!-- <a href="./user_area/delivery_address.php?user_id=<?= $user_id ?>?total=<?= $product_price ?>" class="btn btn-success mx-2">Buy Now</a> -->
                                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                    <button type="submit" class="btn btn-success" name="buy">BUY</button>
                                </div>
            </form>

        </div>

    </div>
    </div>
    </div>

    </div>
    <!-- last child -->
    <!-- include footer -->
    <?php include('./includes/footer.php') ?>

    </div>

    <!-- bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            const quantityInput = $("#quantity-input");

            $("#decrease-btn").on("click", function(event) {
                event.preventDefault(); // Prevent form submission
                let quantity = parseInt(quantityInput.val());
                if (quantity > 1) {
                    quantity--;
                    quantityInput.val(quantity);
                }
            });

            $("#increase-btn").on("click", function(event) {
                event.preventDefault(); // Prevent form submission
                let quantity = parseInt(quantityInput.val());
                quantity++;
                quantityInput.val(quantity);
            });
        });
    </script>

</body>

</html>