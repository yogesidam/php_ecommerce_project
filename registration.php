<?php
include('./includes/connection.php');
include('./functions/common_function.php');

if (isset($_POST['user_registar'])) {
    $name = $_POST['name'];
    $username = $_POST['user_username'];
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $conf_password = $_POST['conf_user_password'];
    $address = $_POST['user_address'];
    $contact = $_POST['user_contact'];

    $filename = $_FILES['user_image']['name'];
    $tmpname = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($tmpname, "./user_area/user_images/$filename");
    $user_ip = getIPAddress();
    $user_type = 0;

    if($name != "" && $username != "" && $email != "" && $password != "" && $conf_password != "" && $address != "" && $contact != ""){
    $select_query = "SELECT * FROM `user_table` WHERE username= '$username' or user_email= '$email' ";
    $data2 = mysqli_query($connection, $select_query);
    
    if (mysqli_num_rows($data2) > 0) {
        $_SESSION['user'] = true;
        // header('Refresh:2');
    } 
    elseif ($password != $conf_password) {
        $_SESSION['pass'] = true;
        // header('Refresh:2');
    }
     else {
        // insert Query...
        $query = "INSERT INTO `user_table` (name, username, user_email, user_password, user_image, user_type, user_ip, user_address, user_mobile)
            VALUES ('$name', '$username', '$email', '$password_hash', '$filename', '$user_type', '$user_ip', '$address', '$contact')";
        $data = mysqli_query($connection, $query);
        if ($data) {
            $_SESSION['register'] = true;
            header('Refresh:2');
        } else {
            echo "die(mysqli_error($data))";
        }
    }
    }

    //   selecting cart item..
    // $select_cart = "SELECT * FROM `cart` WHERE ip_address= '$user_ip' ";
    // $data3 = mysqli_query($connection, $select_cart);
    // $cart_number = mysqli_num_rows($data3);
    // if ($cart_number > 0) {
    //     $_SESSION['username'] = $username;
    //     echo "<script>alert('You have item in your cart')</script>";
    //     echo "<script>window.open('checkout.php', '_self')</script>";
    // } else {
    //     echo "<script>window.open('../index.php', '_self')</script>";
    // }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- font awsemome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <div class="container-fluid">
        <h2 class="text-center my-4 text-success text-decoration-underline">New User Registration</h2>
        <div class="row d-flex align-items-cemter justify-content-center">
            <div class="col-lg-12 col-xl-6">

                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- name field -->
                    <div class="form-outline mb-4">
                        <label for="inputname" class="form-label text-decoration-underline fw-bold">Name</label>
                        <input type="text" name="name" id="inputname" class="form-control" placeholder="Enter your name" autocomplete="off" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" />
                        <?php if (isset($_POST['user_registar']) && empty($name)) { ?>
                            <span class="text-danger">Please fill in the name</span>
                        <?php } ?>
                    </div>
                    <!-- username field -->
                    <div class="form-outline mb-4">
                        <label for="inputusername" class="form-label text-decoration-underline fw-bold">Username</label>
                        <input type="text" name="user_username" id="inputusername" class="form-control" placeholder="Enter your Username" autocomplete="off" value="<?php echo isset($_POST['user_username']) ? htmlspecialchars($_POST['user_username']) : ''; ?>" />
                        <?php if (isset($_POST['user_registar']) && empty($username)) { ?>
                            <span class="text-danger">Please fill in the username</span>
                        <?php } ?>
                    </div>
                    <!-- email field -->
                    <div class="form-outline mb-4">
                        <label for="inputemail" class="form-label text-decoration-underline fw-bold">Email</label>
                        <input type="email" name="user_email" id="inputemail" class="form-control" placeholder="Enter your Email" autocomplete="off" value="<?php echo isset($_POST['user_email']) ? htmlspecialchars($_POST['user_email']) : ''; ?>" />
                        <?php if (isset($_POST['user_registar']) && empty($email)) { ?>
                            <span class="text-danger">Please fill in the email</span>
                        <?php } ?>
                    </div>
                    <!-- Image Field -->
                    <div class="form-outline mb-4">
                        <label for="inputimage" class="form-label text-decoration-underline fw-bold">User Image</label>
                        <input type="file" name="user_image" id="inputimage" class="form-control" autocomplete="off" />
                    </div>
                    <!-- Password field -->
                    <div class="form-outline mb-4">
                        <label for="inputpassword" class="form-label text-decoration-underline fw-bold">Password</label>
                        <input type="password" name="user_password" id="inputpassword" class="form-control" placeholder="Enter your Password" autocomplete="off" value="<?php echo isset($_POST['user_password']) ? htmlspecialchars($_POST['user_password']) : ''; ?>" />
                        <?php if (isset($_POST['user_registar']) && empty($password)) { ?>
                            <span class="text-danger">Please fill in the password</span>
                        <?php } ?>
                    </div>
                    <!-- Confirm Password field -->
                    <div class="form-outline mb-4">
                        <label for="inputconfirmpassword" class="form-label text-decoration-underline fw-bold">Confirm Password</label>
                        <input type="password" name="conf_user_password" id="inputconfirmpassword" class="form-control" placeholder="Confirm your Password" autocomplete="off" value="<?php echo isset($_POST['conf_user_password']) ? htmlspecialchars($_POST['conf_user_password']) : ''; ?>" />
                        <?php if (isset($_POST['user_registar']) && empty($conf_password)) { ?>
                            <span class="text-danger">Please fill in the confirm Password</span>
                        <?php } ?>
                    </div>
                    <!-- Address field -->
                    <div class="form-outline mb-4">
                        <label for="inputaddress" class="form-label text-decoration-underline fw-bold">Address</label>
                        <input type="text" name="user_address" id="inputaddress" class="form-control" placeholder="Enter your Address" autocomplete="off" value="<?php echo isset($_POST['user_address']) ? htmlspecialchars($_POST['user_address']) : ''; ?>" />
                        <?php if (isset($_POST['user_registar']) && empty($address)) { ?>
                            <span class="text-danger">Please fill in the address</span>
                        <?php } ?>
                    </div>
                    <!-- Contact field -->
                    <div class="form-outline mb-4">
                        <label for="inputcontact" class="form-label text-decoration-underline fw-bold">Contact</label>
                        <input type="number" name="user_contact" id="inputcontact" class="form-control" placeholder="Enter your Contact" autocomplete="off" value="<?php echo isset($_POST['user_contact']) ? htmlspecialchars($_POST['user_contact']) : ''; ?>" />
                        <?php if (isset($_POST['user_registar']) && empty($contact)) { ?>
                            <span class="text-danger">Please fill in the contact</span>
                        <?php } ?>
                    </div>
                    <div class="text-center mt-4 pt-2">
                        <button type="submit" class="bg-info py-2 px-3 border-0" name="user_registar">Register</button>
                        <p class="small fw-bold mt-2 pt-1">Already have an account ? <a href="login.php" class="text-danger text-decoration-none"> Login</a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
    if (isset($_SESSION['register'])) {
    ?>
        <script>
            swal({
                title: "Register Successfull",
                text: "Welcomr to grocery",
                icon: "success",
                button: false, // Remove the button
            });
        </script>
    <?php
        unset($_SESSION['register']);
    }
    if (isset($_SESSION['user'])) {
    ?>
        <script>
            swal({
                title: "Username already exist",
                text: "Please use different username",
                icon: "error",
                button: false, // Remove the button
            });
        </script>
    <?php
        unset($_SESSION['user']);
    }
    if (isset($_SESSION['pass'])) {
    ?>
        <script>
            swal({
                title: "Password do not match",
                text: "Please make sure 'pass' and 'confirm pass' are both same",
                icon: "error",
                button: false, // Remove the button
            });
        </script>
    <?php
        unset($_SESSION['pass']);
    }
    ?>

</body>

</html>

<?php

?>