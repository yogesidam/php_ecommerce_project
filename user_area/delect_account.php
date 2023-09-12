
    <h3 class="text-danger mb-4">Delete Account</h3>
    <form action="" method="POST" class="mt-5">
        <div class="form-outline mb-4">
            <button type="submit" class="form-control w-50 m-auto" name="delete">Delete Account</button>
        </div>
        <div class="form-outline">
            <button type="submit" class="form-control w-50 m-auto" name="dont_delete">Dont Delete Account</button>
        </div>
    </form>

    
<?php
$username_session = $_SESSION['username'];
if(isset($_POST['delete'])){
    $delete_query = "DELETE FROM `user_table` WHERE username= '$username_session' ";
    $result = mysqli_query($connection, $delete_query);
    if($result){
        session_destroy();
        echo "<script>alert('Account Deleted Successfully')</script>";
        echo "<script>window.open('../index.php', '_self')</script>";
    }
}

if(isset($_POST['dont_delete'])){
    echo "<script>window.open('profile.php', '_self')</script>";
}
?>