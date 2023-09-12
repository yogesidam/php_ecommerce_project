<?php
include('./includes/connection.php');
include('./functions/common_function.php');
@session_start();

if (isset($_POST['user_login'])) {
    $username = $_POST['user_username'];
    $password = $_POST['user_password'];

        $select_query = "SELECT * FROM `user_table` WHERE username= '$username' ";
        $data = mysqli_query($connection, $select_query);
        if(mysqli_num_rows($data) > 0){
        $result = mysqli_fetch_assoc($data);
        $user_password = $result['user_password'];
        $user_type = $result['user_type'];
        $user_id = $result['user_id'];

        $_SESSION['user_id'] = $user_id;
        if ($user_type == 0) {
            if (password_verify($password, $user_password)) {
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = $user_type;
                echo "<script>window.open('./user_area/profile.php','_self')</script>";
                // exit; // Stop execution to prevent showing the form again
            } else {
                $_SESSION['login_fail'] = true;
                // header('Refresh:2'); // Set login failure flag
            }
        } elseif ($user_type == 1) {
            if (password_verify($password, $user_password)) {
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = $user_type;
                echo "<script>window.open('./admin_area/index.php','_self')</script>";
                exit; // Stop execution to prevsent showing the form again
            } else {
                $_SESSION['login_fail'] = true; // Set login failure flag
                // header('Refresh:2'); // Set login failure flag
            }
        }
    }
    else {
        $_SESSION['login_fail'] = true; // Set login failure flag
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- font awsemome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        .container{
            width: 500px;
            border-radius: 20px;
            position: relative;
            top: 100px;
        }
        .input{
            height: 50px;
            border-radius: 20px;
        }
        .btn{
            border-radius: 30px;
        }
    </style>
</head>

<body style="overflow-x: hidden;" class="bg-info">
    <div class="container border border-info bg-light">
        <h2 class="text-center mt-5 text-dark">Login</h2><hr>
        <div class="row d-flex align-items-cemter justify-content-center">
            <div class="col-lg-12  ">
                <form action="" method="POST">
                    <!-- username field -->
                    <div class="form-outline mb-4 mt-3">
                        <input type="text" name="user_username" id="inputusername" class="form-control border border-info text-center input"  placeholder="Enter your Username" autocomplete="off" value="<?php echo isset($_POST['user_username']) ? htmlspecialchars($_POST['user_username']) : ''; ?>" />
                        <?php if (isset($_POST['user_login']) && empty($username)) { ?>
                            <span class="text-info">Please fill in the username</span>
                        <?php } ?>
                    </div>
                    <!-- Password field -->
                    <div class="form-outline mb-4">
                        <input type="password" name="user_password" id="inputpassword" class="form-control border border-info text-center input" placeholder="Enter your Password" autocomplete="off" value="<?php echo isset($_POST['user_password']) ? htmlspecialchars($_POST['user_password']) : ''; ?>" />
                        <?php if (isset($_POST['user_login']) && empty($password)) { ?>
                            <span class="text-info">Please fill in the Password</span>
                        <?php } ?>
                    </div>
                    <div class="text-center mt-4 pt-2">
                        <button type="submit" class="btn btn-info py-2 px-5 fw-bold mb-2" name="user_login">Login</button>
                        <p class="small fw-bold mt-2 pt-1">Don't have an account? &nbsp; <a href="registration.php" class="text-danger text-decoration-none">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php
    if (isset($_SESSION['login_fail'])) {
    ?>
        <script>
            swal({
                title: "Login Failed",
                text: "Please check the username & password",
                icon: "error",
                button: false, // Remove the button
            });
        </script>
    <?php
        unset($_SESSION['login_fail']);
    }
    ?>
</body>

</html>

<?php

?>