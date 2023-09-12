<?php
include('../includes/connection.php');
include('../functions/common_function.php');
session_start();
$user_type = $_SESSION['user_type'];
if ($user_type == 0) {
} else {
    echo "<script>window.open('../index.php','_self')</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username'] ?></title>
    <!-- css link -->
    <link rel="stylesheet" type="text/css" href="../public/styles.css">
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- font awsemome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        .order_img {
            /* width: 100%; */
            height: 200px;
            position: relative;
            left: 100px;
        }
    </style>
</head>

<body style="overflow-x: hidden;">
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first-child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/shopping_logo4.jpg" alt="" class="logo rounded-pill">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="../display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold text-light" href="profile.php">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="../cart.php"><i class="fa-sharp fa-solid fa-cart-shopping"></i><sup><b> <?php cart_item(); ?></b></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="#">Total Price: <b><?php total_cart_price() ?></b></a>
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
                              <a class="nav-link" href="../login.php">Login</a>
                           </li>';
                } else {
                    echo ' <li class="nav-item">
                              <a class="nav-link" href="../logout.php">Logout</a>
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
        <div class="container border bg-light">
            <?php
            if (isset($_GET['order_id'])) {
                $order_id = $_GET['order_id'];
                $select_pending = "SELECT * FROM `user_order` WHERE order_id= '$order_id'";
                $result_pending = mysqli_query($connection, $select_pending);
                if (mysqli_num_rows($result_pending) > 0) {
                    $row_panding = mysqli_fetch_assoc($result_pending);
                    $amount_due = $row_panding['amount_due'];
                    $invoice_number = $row_panding['invoice_number'];
                    $total_product = $row_panding['total_product'];
                    $order_date = $row_panding['order_date'];
                    $product_id = $row_panding['product_id'];
                    $product_ids = explode(',', $product_id);
                    $quantity = $row_panding['quantity'];

                    echo " 
                    <div class='row my-3'>
                        <div class='col-md-2'>
                            <p class='fw-bold '>Order-ID :    $order_id</p>
                        </div>
                        <div class='col-md-4'>
                            <p class='fw-bold'>Invoice Number :      $invoice_number</p>
                        </div>
                        <div class='col-md-3'></div>
                        <div class='col-md-3 float-right'>
                            <p class='fw-bold'>Date :    $order_date</p>
                        </div>
                    </div>";

                    foreach ($product_ids as $id) {
                        // foreach ($quantities as $qid) {
                        // Use proper variable name to avoid overwriting the product_id variable
                        $select_product = "SELECT * FROM `product` WHERE product_id = '$id'";
                        $result_product = mysqli_query($connection, $select_product);

                        // Check if the query was successful before proceeding
                        if ($result_product) {
                            while ($row_product = mysqli_fetch_assoc($result_product)) {
                                $product_id = $row_product['product_id'];
                                $product_title = $row_product['product_title'];
                                $product_image1 = $row_product['product_image1'];
                                $product_price = $row_product['product_price'];

            ?>

                                <div class="row my-3">
                                    <div class="col-md-6">
                                        <img src="../admin_area//product_images/<?= $product_image1 ?>" class="order_img" alt="">
                                    </div>
                                    <div class="col-md-6 mt-5">
                                        <h4 class="mb-3"> <?= $product_title ?></h4>
                                        <h4> <?= $product_price ?>/-</h4>
                                        <!-- <h4>quantity : <?= $quantity ?></h4> -->
                                    </div>
                                </div>
            <?php
                            }
                        }
                    }
                }
            }
            ?>
        </div>
        <!-- last child -->
        <!-- include footer -->
        <?php include('../includes/footer.php') ?>

    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>