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


    </style>
</head>

<body style="overflow-x: hidden;">
    <!-- navbar -->
    <div class="container-fluid px-0">
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
                            <a class="nav-link active fw-bold rounded text-light  " aria-current="page" href="index.php">Home  </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="display_all.php">Products  </a>
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
                            <a class="nav-link active fw-bold" href="#">Contact  </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="cart.php"><i class="fa-sharp fa-solid fa-cart-shopping"></i><sup><b> <?php cart_item(); ?></b></sup>  </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="#">Total Price: <b><?php total_cart_price() ?>  </b></a>
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
        <div class="bg-light" >
            <h3 class="text-center">Welcome to the ShopMarket</h3>
            <p class="text-center ">Enjoy your Journey, Get the desired items with the ToP Brands.</p>
        </div>

        <!-- forth child -->
        <div class="row">
            <div class="col-md-10">
                <!-- products -->
                <div class="row px-4">
                    <!--  Featching products -->
                    <?php
                    // colling function...
                    getproduct();
                    get_selected_categories();
                    get_selected_brands();
                    // $ip = getIPAddress();  
                    // echo 'User Real IP Address - '.$ip;                  
                    ?>

                </div>
            </div>
            <div class="col-md-2 bg-secondary mb-1 p-0" id="sidebar">
                <!-- Sidenav -->
                <!-- brand to be displayed -->
                <div class="sidebar-section">
                    <ul class="navbar-nav me-auto text-center mb-2">
                        <li class="nav-item bg-info ">
                            <a href="#" class="nav-link text-dark">
                                <h4>Delivery Brands</h4>
                            </a>
                        </li>
                        <div class="scrollable-list">
                            <?php
                            // get brands....
                            getbrands();
                            ?>
                        </div>
                    </ul>
                </div>

                <!-- Categories to be displayed -->
                <div class="sidebar-section">
                    <ul class="navbar-nav me-auto text-center mb-2">
                        <li class="nav-item bg-info ">
                            <a href="#" class="nav-link text-dark">
                                <h4>Categories</h4>
                            </a>
                        </li>
                        <div class="scrollable-list">
                            <?php
                            // get categories....
                            getcategory();
                            ?>
                        </div>
                    </ul>
                </div>
            </div>

            <!-- last child -->
            <!-- include footer -->
            <?php include('./includes/footer.php') ?>

        </div>

        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Include the SweetAlert library -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <?php
        if (isset($_SESSION['add_to_cart'])) {
        ?>
            <script>
                swal({
                    title: "<?php echo$_SESSION['add_to_cart']?>",
                    // text: "Please check the username & password",
                    icon: "success",
                    button: false, // Remove the button
                });
            </script>
        <?php
            unset($_SESSION['add_to_cart']);
        }
        ?>


</body>

</html>