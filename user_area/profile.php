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
        .profile_image {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        .edit_image {
            width: 100px;
            height: 100px;
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
                        <li class="nav-item text-danger" style="text-decoration:double">
                            <a class="nav-link active fw-bold" aria-current="page" href="../index.php">Home </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="../display_all.php">Products </a>
                        </li>

                        <?php
                        if (isset($_SESSION['username'])) {
                            echo " <li class='nav-item'>
                            <a class='nav-link active fw-bold text-light' href='profile.php'>My Account  </a>
                            </li>";
                        } else {
                            echo "<li class='nav-item'>
                            <a class='nav-link active fw-bold' href='../registration.php'>Registar  </a>
                            </li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="#">Contact </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="../cart.php"><i class="fa-sharp fa-solid fa-cart-shopping"></i><sup><b> <?php cart_item(); ?></b></sup> </a>
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
        <div class="row">
            <div class="col-md-2 mb-2">
                <ul class="navbar-nav bg-secondary text-center">
                    <li class="nav-item bg-info">
                        <a class="nav-link text-light" href="#">
                            <h4>Your profile</h4>
                        </a>
                    </li>

                    <!-- php code to call the user image... -->
                    <?php
                    $username = $_SESSION['username'];
                    $image_query = "SELECT * FROM `user_table` WHERE username= '$username' ";
                    $data = mysqli_query($connection, $image_query);
                    $row_image = mysqli_fetch_array($data);
                    $user_image = $row_image['user_image'];
                    echo "<li>
                    <img src='./user_images/" . $user_image . "' class='profile_image mt-2' alt=''>
                    </li>";

                    ?>

                    <!-- <li class="nav-item ">
                        <a class="nav-link text-light" href="profile.php">Panding order</a>
                    </li> -->
                    <li class="nav-item ">
                        <a class="nav-link text-light" href="profile.php?edit_account">Edit account</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-light" href="profile.php?my_order">Your orders</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-light" href="profile.php?delect_account">Delete Account</a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link text-light" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 text-center">
                <?php       
                if (isset($_GET['edit_account'])) {
                    include('edit_account.php');
                }
                if (isset($_GET['my_order'])) {
                    include('user_orders.php');
                }
                if (isset($_GET['delect_account'])) {
                    include('delect_account.php');
                }
                ?>
            </div>
        </div>
        <!-- last child -->
        <!-- include footer -->
        <?php include('../includes/footer.php') ?>

    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php
    if (isset($_SESSION['username'])) {
        if (!isset($_SESSION['login_shown'])) {
            $username = $_SESSION['username'];
    ?>
            <script>
                swal({
                    title: "Login Successfull",
                    text: "Welcome <?php echo $username ?>",
                    icon: "success",
                    button: false, // Remove the button
                });
            </script>
    <?php
            $_SESSION['login_shown'] = true;
        }
        // unset($_SESSION['login']);
    }
    ?>

</body>

</html>