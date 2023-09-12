<?php
// include('./includes/connection.php');
// include('../includes/connection.php');
// getting product.
function getproduct()
{
    global $connection;

    // condition to check isset  or not...
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $select_query = "SELECT * FROM `product` order by rand() limit 0,9";
            $data = mysqli_query($connection, $select_query);
            while ($row = mysqli_fetch_assoc($data)) {
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
                echo '<div class="col-md-3 mb-3">
                <div class="card " >
     <a href="product_detail.php?product_id=' . $product_id . '"><img class="card-img-top" src="./admin_area/product_images/' . $product_image1 . '" alt="' . $product_title . '"></a>
        <a href="product_detail.php?product_id=' . $product_id . '" class="text-decoration-none"> 
          <div class="card-body">
             <h5 class="card-title text-secondary">' . $product_title . '</h5>
             <p class="card-text text-dark my-3"><strong><i class="fa-solid fa-indian-rupee-sign"></i>  ' . $product_price . '</strong>/-</p>
             <a href="index.php?add_to_cart=' . $product_id . '" class="btn text-white btn-secondary btn-outline-dark">Add to cart</a>
         </div>
         </a>
     </div>
 </div>';
            }
        }
    }
}

// gatting all products....
function get_all_products()
{
    global $connection;

    // condition to check isset  or not...
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $select_query = "SELECT * FROM `product` order by rand()";
            $data = mysqli_query($connection, $select_query);
            while ($row = mysqli_fetch_assoc($data)) {
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
                echo '<div class="col-md-3 mb-3">
                <div class="card shadow" >
     <a href="product_detail.php?product_id=' . $product_id . '"><img class="card-img-top" src="./admin_area/product_images/' . $product_image1 . '" alt="' . $product_title . '"></a>
        <a href="product_detail.php?product_id=' . $product_id . '" class="text-decoration-none"> 
          <div class="card-body">
             <h5 class="card-title text-secondary">' . $product_title . '</h5>
             <p class="card-text text-dark my-3"><strong><i class="fa-solid fa-indian-rupee-sign"></i>  ' . $product_price . '</strong>/-</p>
             <a href="product_detail.php?product_id=' . $product_id . '" class="btn btn-secondary">View more</a>
             <a href="index.php?add_to_cart=' . $product_id . '" class="btn text-white btn-secondary btn-outline-dark">Add to cart</a>
         </div>
         </a>
     </div>
 </div>';
            }
        }
    }
}

// get selected categories only...
function get_selected_categories()
{
    global $connection;

    // condition to check isset  or not...
    if (isset($_GET['category'])) {
        $category_id =  $_GET['category'];
        $select_query = "SELECT * FROM `product` WHERE category_id ='$category_id' ";
        $data = mysqli_query($connection, $select_query);
        $number = mysqli_num_rows($data);

        if ($number == 0) {
            echo "<h2 class='text-danger text-center'>No Stocks are availiable.</h2>";
        }

        while ($row = mysqli_fetch_assoc($data)) {
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
            echo '<div class="col-md-3 mb-3">
            <div class="card shadow" >
 <a href="product_detail.php?product_id=' . $product_id . '"><img class="card-img-top" src="./admin_area/product_images/' . $product_image1 . '" alt="' . $product_title . '"></a>
    <a href="product_detail.php?product_id=' . $product_id . '" class="text-decoration-none"> 
      <div class="card-body">
         <h5 class="card-title text-secondary">' . $product_title . '</h5>
         <p class="card-text text-dark my-3"><strong><i class="fa-solid fa-indian-rupee-sign"></i>  ' . $product_price . '</strong>/-</p>
         <a href="product_detail.php?product_id=' . $product_id . '" class="btn btn-secondary">View more</a>
         <a href="index.php?add_to_cart=' . $product_id . '" class="btn text-white btn-secondary btn-outline-dark">Add to cart</a>
         </div>
     </a>
 </div>
</div>';
        }
    }
}

// get selected brands only....
function get_selected_brands()
{
    global $connection;

    // condition to check isset  or not...
    if (isset($_GET['brand'])) {
        $brand_id =  $_GET['brand'];
        $select_query = "SELECT * FROM `product` WHERE brand_id ='$brand_id' ";
        $data = mysqli_query($connection, $select_query);
        $number = mysqli_num_rows($data);

        if ($number == 0) {
            echo "<h2 class='text-danger text-center'>No Stocks are availiable.</h2>";
        }

        while ($row = mysqli_fetch_assoc($data)) {
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
            echo '<div class="col-md-3 mb-3">
            <div class="card shadow" >
 <a href="product_detail.php?product_id=' . $product_id . '"><img class="card-img-top" src="./admin_area/product_images/' . $product_image1 . '" alt="' . $product_title . '"></a>
    <a href="product_detail.php?product_id=' . $product_id . '" class="text-decoration-none"> 
      <div class="card-body">
         <h5 class="card-title text-secondary">' . $product_title . '</h5>
         <p class="card-text text-dark my-3"><strong><i class="fa-solid fa-indian-rupee-sign"></i>  ' . $product_price . '</strong>/-</p>
         <a href="product_detail.php?product_id=' . $product_id . '" class="btn btn-secondary">View more</a>
         <a href="index.php?add_to_cart=' . $product_id . '" class="btn text-white btn-secondary btn-outline-dark">Add to cart</a>
         </div>
     </a>
 </div>
</div>';
        }
    }
}

// displaying brands...
function getbrands()
{
    global $connection;
    $select_brand = "SELECT * FROM brand";
    $data_brand = mysqli_query($connection, $select_brand);

    while ($row = mysqli_fetch_assoc($data_brand)) {
        $brand_title = $row['brand_title'];
        $brand_id = $row['brand_id'];
        echo ' <li class="nav-item">
                  <a href="index.php?brand=' . $brand_id . '" class="nav-link text-white fw-bold" style="font-size: large;" >' . $brand_title . '</a><hr class="border border-white">
               </li>';
    }
}
//  display category
function getcategory()
{
    global $connection;
    $select_category = "SELECT * FROM category";
    $data_category = mysqli_query($connection, $select_category);

    while ($row = mysqli_fetch_assoc($data_category)) {
        $category_title = $row['category_title'];
        $category_id = $row['category_id'];
        echo ' <li class="nav-item ">
                      <a href="index.php?category=' . $category_id . '" class="nav-link text-white fw-bold" style="font-size: large;">' . $category_title . '</a><hr class="border border-white">
                   </li>';
    }
}

// searching products....
function searh_product()
{
    global $connection;
    if (isset($_GET['search'])) {
        $search_value = $_GET['search_data'];
        $select_query = "SELECT * FROM `product` WHERE product_keywords like '%$search_value%' ";
        $data = mysqli_query($connection, $select_query);
        $number = mysqli_num_rows($data);

        if ($number == 0) {
            echo "<h2 class='text-danger text-center'>No Products are availiable for this Category.</h2>";
        }
        while ($row = mysqli_fetch_assoc($data)) {
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
            echo '<div class="col-md-3 mb-3">
            <div class="card shadow" >
                <a href="product_detail.php?product_id=' . $product_id . '"><img class="card-img-top" src="./admin_area/product_images/' . $product_image1 . '" alt="' . $product_title . '"></a>
                    <a href="product_detail.php?product_id=' . $product_id . '" class="text-decoration-none"> 
                    <div class="card-body">
                        <h5 class="card-title text-secondary">' . $product_title . '</h5>
                        <p class="card-text text-dark my-3"><strong><i class="fa-solid fa-indian-rupee-sign"></i>  ' . $product_price . '</strong>/-</p>
                        <a href="product_detail.php?product_id=' . $product_id . '" class="btn btn-secondary">View more</a>
                        <a href="index.php?add_to_cart=' . $product_id . '" class="btn text-white btn-secondary btn-outline-dark">Add to cart</a>
                        </div>
                    </a>
                </div>
            </div>';
        }
    }
}

// view deatils functions
// function view_details()
// {
//     global $connection;

//     // condition to check isset  or not...
//     if (isset($_GET['product_id'])) {
//         if (!isset($_GET['category'])) {
//             if (!isset($_GET['brand'])) {
//                 $product_id = $_GET['product_id'];
//                 $select_query = "SELECT * FROM `product` WHERE product_id = '$product_id'";
//                 $data = mysqli_query($connection, $select_query);
//                 while ($row = mysqli_fetch_assoc($data)) {
//                     $product_id = $row['product_id'];
//                     $product_title = $row['product_title'];
//                     $product_description = $row['product_description'];
//                     $product_keywords = $row['product_keywords'];
//                     $product_category = $row['category_id'];
//                     $product_brand = $row['brand_id'];
//                     $product_image1 = $row['product_image1'];
//                     $product_image2 = $row['product_image2'];
//                     $product_image3 = $row['product_image3'];
//                     $product_price = $row['product_price'];
//                     echo " <div class='row'>
//                     <div class='col-md-6 mb-2'>
//                         <div class='card mx-4 border-0'>
//                             <img src='./admin_area/product_images/apple1.jpg' class='card-img-viewmore' alt='$product_title'>
//                             <div class='card-body'>
//                                 <h5 class='card-title'>$product_title</h5>
//                                 <div class='d-flex align-items-center justify-content-center mt-3'>
//                                     <a href='index.php?add_to_cart=$product_id' class='btn btn-info mx-2'>Add to cart</a>
//                                     <a href='./users_area/delivery.php' class='btn btn-secondary mx-2'>Buy Now</a>
//                                 </div>

//                             </div>
//                         </div>
//                     </div>

//                     <div class='col-md-6'>
//                         <!--KO related images -->
//                         <div class='row mt-5'>

//                             <h5 class='card-text'>price: $product_price/-</h5>
//                             <br>
//                             <div class='col-md-6'>
//                                 <p class='card-des-top' alt='$product_title'>". $product_description."</p>

//                                 <h5>Available offers</h5>

//                                 <p>Bank Offer5% Cashback on mystore Axis Bank CardT&C </p>

//                                 <p>Bank Offer₹50 off on 1200 for UPIT&C</p>

//                                 <p>Expiry Date 26 Oct 2023 <br>
//                                     Manufactured date 29 Jun 2023</p>
//                             </div>


//                         </div>
//                     </div>
//                 </div>";
//                 }
//             }
//         }
//     }
// }

// get ip address function.....
function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


// cart function.....
function cart()
{
    if (isset($_GET['add_to_cart'])) {
        global $connection;
        $username = $_SESSION['username'];
        $get_user = "SELECT * FROM `user_table` WHERE username= '$username'";
        $result = mysqli_query($connection, $get_user);
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];
        $user_ip = $row['user_ip'];

        $get_product_id = $_GET['add_to_cart'];
        $select_query = "SELECT * FROM `cart` WHERE product_id= $get_product_id and user_id= $user_id";
        $data = mysqli_query($connection, $select_query);
        $number = mysqli_num_rows($data);
        if ($number > 0) {
            echo "<script>alert('The item is alerady present inside CART')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            $insert_query = "INSERT INTO `cart` (product_id, ip_address, user_id, quantity) VALUES ('$get_product_id', '$user_ip', '$user_id', 1) ";
            $data1 = mysqli_query($connection, $insert_query);
            if ($data1) {
                $_SESSION['add_to_cart'] = "item added";
                echo "<script>window.open('index.php','_self')</script>";
            }
        }
    }
}

// function to get cart item numbers....
function cart_item()
{
    if (isset($_GET['add_to_cart'])) {
        global $connection;
        if (!isset($_SESSION['username'])) {
            echo "<script>window.open('login.php','_self')</script>";
        }
    } else {
        global $connection;
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $get_user = "SELECT * FROM `user_table` WHERE username= '$username'";
            $result = mysqli_query($connection, $get_user);
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['user_id'];
            $select_query = "SELECT * FROM `cart` WHERE user_id= $user_id ";
            $data = mysqli_query($connection, $select_query);
            $count_cart_item = mysqli_num_rows($data);
            echo $count_cart_item;
        }
    }
}

// total price punction...
function total_cart_price()
{
    global $connection;
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $get_user = "SELECT * FROM `user_table` WHERE username= '$username'";
        $result = mysqli_query($connection, $get_user);
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];
        $total_price = 0;
        $query = "SELECT * FROM `cart` WHERE user_id= $user_id ";
        $data = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($data)) {
            $product_id = $row['product_id'];
            $quantitys = $row['quantity'];
            $select_product = "SELECT * FROM `product` WHERE product_id ='$product_id' ";
            $data1 = mysqli_query($connection, $select_product);
            while ($row_product_price = mysqli_fetch_array($data1)) {
                $product_price = $row_product_price['product_price'];
                $product = $product_price * $quantitys;
                $product_prices[] = $product;
                $total_price = 0;
                for ($i = 0; $i < count($product_prices); $i++) {
                    $total_price += $product_prices[$i];
                    $_SESSION['total'] = $total_price;
                }
            }
        }
        echo $total_price;
    } else {
    }
}


// get users order detailes...
// function get_user_order_detailes()
// {
//     global $connection;
//     $username = $_SESSION['username'];
//     $get_details = "SELECT * FROM `user_table` WHERE username= '$username'";
//     $result = mysqli_query($connection, $get_details);
//     while ($row = mysqli_fetch_assoc($result)) {
//         $user_id = $row['user_id'];
//         if (!isset($_GET['edit_account'])) {
//             if (!isset($_GET['my_order'])) {
//                 if (!isset($_GET['delect_account'])) {
//                     $get_orders = "SELECT * FROM `user_order` WHERE user_id= $user_id and order_status= 'pending' ";
//                     $result_order = mysqli_query($connection, $get_orders);
//                     $number = mysqli_num_rows($result_order);
//                     if ($number > 0) {
//                         echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$number</span> Panding orders</h3>
//                               <p class='text-center'><a href='profile.php?my_order' class=' text-dark'>Order_Deatils</a></p?";
//                     } else {
//                         echo "<h3 class='text-center text-success mt-5 mb-2'>You have Zero Panding orders</h3>
//                         <p class='text-center'><a href='../index.php' class=' text-dark'>Explore Products</a></p?";
//                     }
//                 }
//             }
//         }
//     }
// }
