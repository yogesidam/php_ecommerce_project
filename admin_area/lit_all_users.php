<?php
$get_paymnet = "SELECT * FROM `user_table`";
$result = mysqli_query($connection, $get_paymnet);
$num_payment = mysqli_num_rows($result);
if ($num_payment == 0) {
    echo "<h3 class='text-center text-danger mt-5'>No Users Availiable</h3>";
} else {
?>
    <h3 class="text-center text-success mt-5">All Users</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info text-center">
            <tr>
                <th>SL.no</th>
                <th>Username</th>
                <th>User Email</th>
                <th>User Password</th>
                <th>User address</th>
                <th>User mobile</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light text-center">
            <?php
               $number = 0;
               while($row = mysqli_fetch_assoc($result)){
                 $user_id = $row['user_id'];
                 $Username = $row['username'];
                 $user_email = $row['user_email'];
                 $user_image = $row['user_image'];
                 $user_type = $row['user_type'];
                 $user_address = $row['user_address'];
                 $user_mobile = $row['user_mobile'];
                 $number++;
                 echo 
                 "<tr>
                   <td>$number</td>
                   <td>$Username</td>
                   <td>$user_email</td>
                   <td><img src='./product_images/$user_image' class='product_image'></td>
                   <td>$user_address</td>
                   <td>$user_mobile</td>";
                   if($user_type == 0){
                    echo"
                   <td><a href='index.php?delete_user= $user_id ' class='text-light'><i class='fa-solid fa-duotone fa-trash'></i></a></td>";
                   }
                   else{
                    echo "<td></td>
                    </tr>";
                   }
                 
               }
            ?>
        </tbody>
    </table>
<?php } ?>