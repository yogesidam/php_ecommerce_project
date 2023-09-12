<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3 class="text-center text-success">All Products</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info text-center">
            <tr>
                <th>Product ID</th>
                <th>Product Title</th>
                <th>Product Image</th>
                <th>product Price</th>
                <th>Total Sold</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light text-center">

        <?php
          $get_product = "SELECT * FROM `product` ";
          $result = mysqli_query($connection, $get_product);
          $number=0;
          while($row = mysqli_fetch_assoc($result)){
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $status = $row['status'];
            $number++;
            ?>
        <tr>
           <td><?php echo $number ?></td>
           <td><?php echo $product_title ?></td>
           <td><img src='./product_images/<?php echo $product_image1 ?>' class='product_image'></td>
           <td><?php echo $product_price ?></td>
           <td>
            <?php
             $get_count = "SELECT * FROM `panding_order` WHERE product_id= '$product_id'";
             $result_count = mysqli_query($connection, $get_count);
             $row_count = mysqli_num_rows($result_count);
             echo $row_count;
            ?>
           </td>
           <td><?php echo $status ?></td>
           <td><a href='index.php?edit_product=<?php echo $product_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
           <td><a href='index.php?delete_product=<?php echo $product_id ?>' class='text-light'><i class='fa-solid fa-duotone fa-trash'></i></a></td>
       </tr>
     <?php } ?>
           
        </tbody>
    </table>
</body>
</html>