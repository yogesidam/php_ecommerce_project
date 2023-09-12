<?php
if(isset($_GET['edit_account'])){
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM `user_table` WHERE username= '$user_session_name' ";
    $result_query = mysqli_query($connection, $select_query);
    $row = mysqli_fetch_assoc($result_query);
    $id = $row['user_id'];
    $username = $row['username'];
    $email = $row['user_email'];
    $address = $row['user_address'];
    $mobile = $row['user_mobile'];

    if(isset($_POST['update'])){
        $user_id = $id;
        $user_name = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_mobile = $_POST['user_mobile'];

        $user_image = $_FILES['user_image']['name'];
        $tmp_name = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($tmp_name,"./user_images/$user_image");

        // update query...
        $update_query = "UPDATE `user_table` set username= '$user_name', user_email= '$user_email', 
        user_image= '$user_image', user_address= '$user_address', user_mobile= '$user_mobile' WHERE 
        user_id= $user_id ";
        $data = mysqli_query($connection, $update_query);
        if($data){
            echo "<script>alert('Data Updated Successfully')</script>";
            echo "<script>window.open('../logout.php', '_self')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>
<body>
    <h3 class="text-center text-success mb-4">Edit Account</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-outline mb-4">
           <input type="text" class="form-control w-50 m-auto" name="username" value="<?php echo $username ?>">
        </div>
        <div class="form-outline mb-4">
           <input type="email" class="form-control w-50 m-auto" name="user_email" value="<?php echo $email ?>">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
           <input type="file" class="form-control m-auto" name="user_image">
           <img src="./user_images/<?php echo $user_image ?>" class="edit_image" alt="">
        </div>
        <div class="form-outline mb-4">
           <input type="text" class="form-control w-50 m-auto" name="user_address" value="<?php echo $address ?>">
        </div>
        <div class="form-outline mb-4">
           <input type="number" class="form-control w-50 m-auto" name="user_mobile" value="<?php echo $mobile ?>">
        </div>
        <button type="submit" name="update" class="bg-info py-2 px-3 border-0 mb-4 ">Update</button>
    </form>
</body>
</html>