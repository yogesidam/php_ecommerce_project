<?php 
include('../includes/connection.php'); 

if(isset($_POST['product_submit'])){
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];

    // to store image.
    $product_image1 = $_FILES['product_image1']['name'];
    $tmpname_image1 = $_FILES['product_image1']['tmp_name'];

    $product_image2 = $_FILES['product_image2']['name'];
    $tmpname_image2 = $_FILES['product_image2']['tmp_name'];

    $product_image3 = $_FILES['product_image3']['name'];
    $tmpname_image3 = $_FILES['product_image3']['tmp_name'];

    if($product_title == "" or $product_description == "" or $product_keywords == "" or $product_brand == "" 
     or $product_image1 == "" or $product_price == ""){
        echo "<script>alert('Please fill the field')</script>";
        exit();
     }
     else{
        move_uploaded_file($tmpname_image1, "./product_images/$product_image1");
        move_uploaded_file($tmpname_image2, "./product_images/$product_image2");
        move_uploaded_file($tmpname_image3, "./product_images/$product_image3");

        // insert query
        $insert_product = "INSERT INTO `product`(product_title,product_description,product_keywords,category_id,brand_id,product_image1,product_image2,product_image3,product_price) 
                           VALUES ('$product_title','$product_description','$product_keywords','$product_category','$product_brand','$product_image1','$product_image2','$product_image2','$product_price')";
        $data_product = mysqli_query($connection, $insert_product);
        if($data_product){
            echo "<script>alert('Product has been Stored Successfuly')</script>";
            echo "<script>window.open('./index.php?view_product', '_self')</script>";
        }
     }
 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product Admin-Dashbord</title>
    <!-- css -->
    <link rel="stylesheet" href="../style.css">
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- font awsemome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Product</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="input-title" class="form-label">Product Title</label>
                <input type="text" id="input-title" name="product_title" placeholder="Enter Product Title" class="form-control" autocomplete="off" required>
            </div>
            <!-- description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="input-description" class="form-label">Product Description</label>
                <input type="text" id="input-description" name="product_description" placeholder="Enter Product description" class="form-control" autocomplete="off" required>
            </div>
              <!-- Keywords -->
              <div class="form-outline mb-4 w-50 m-auto">
                <label for="input-keywords" class="form-label">Product Keywords</label>
                <input type="text" id="input-keywords" name="product_keywords" placeholder="Enter Product Keywords" class="form-control" autocomplete="off" required>
            </div>
              <!-- Categories -->
              <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" class="form-select">
                    <option value="">Select Category</option>
                    <?php
                      $select_category = "SELECT * FROM `category`";
                      $data_category = mysqli_query($connection, $select_category);
                      while($row = mysqli_fetch_assoc($data_category)){
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];

                        echo "<option value='$category_id'>$category_title</option>";
                      }
                    ?>
                </select>
            </div>
              <!-- Brands -->
              <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brand" class="form-select">
                    <option value="">Select Brands</option>
                    <?php
                      $select_brand = "SELECT * FROM `brand`";
                      $data_brand = mysqli_query($connection, $select_brand);
                      while($row = mysqli_fetch_assoc($data_brand)){
                        $brand_title = $row['brand_title'];
                        $brand_id = $row['brand_id'];

                        echo "<option value='$brand_id'>$brand_title</option>";
                      }
                    ?>
                </select>
            </div>
              <!-- Image_1 -->
              <div class="form-outline mb-4 w-50 m-auto">
              <label for="input-image1" class="form-label">Product Image1</label>
                <input type="file" id="input-image1" name="product_image1" class="form-control" required>
            </div>
            <!-- Image_2 -->
            <div class="form-outline mb-4 w-50 m-auto">
            <label for="input-image2" class="form-label">Product Image2</label>
              <input type="file" id="input-image2" name="product_image2" class="form-control" >
          </div>
              <!-- Image_3 -->
              <div class="form-outline mb-4 w-50 m-auto">
              <label for="image3" class="form-label">Product Image3</label>
                <input type="file" id="image3" name="product_image3" class="form-control" >
            </div>
             <!-- Price -->
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="input-price" class="form-label">Product Price</label>
                <input type="text" id="input-price" name="product_price" placeholder="Enter Product Price" class="form-control" autocomplete="off" required>
            </div>
             <!-- button -->
             <div class="form-outline mb-4 w-50 m-auto">
                <button type="submit" name="product_submit" class="btn btn-info mb-0 px-4">Insert Product</button>
            </div>
        </form>
    </div>
    
</body>
</html>