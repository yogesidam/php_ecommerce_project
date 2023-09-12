<?php
include('../includes/connection.php');
include('../functions/common_function.php');
session_start();
if (isset($_SESSION['usernname'])) {
  $user_type = $_SESSION['user_type'];
  if ($user_type == 1) {
  } else {
    echo "<script>window.open('../index.php','_self')</script>";
  }
  $username = $_SESSION['username'];
  if ($username == true) {
  } else {
    echo "<script>window.open('../user_area/user_login.php','_self')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- css -->
  <link rel="stylesheet" href="../public/styles.css">
  <!-- bootstrap cdn -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- font awsemome cdn -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    .admin_image {
      width: 100px;
      height: 100%;
      object-fit: contain;
    }

    .product_image {
      width: 100px;
      object-fit: contain;
    }
  </style>
</head>

<body style="overflow-x:hidden">
  <!-- navbar -->
  <div class="container-fluid p-0">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
      <div class="container-fluid">
        <img src="../images/shopping_logo.jpg" alt="" class="logo">
        <nav class="navbar navbar-expand-lg ">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="" class="nav-item me-4 text-dark text-decoration-none">Welcome <span class="fw-bold text-white text-decoration-underline"><?php echo $_SESSION['username'] ?></span></a>
            </li>
          </ul>
        </nav>
      </div>
    </nav>

    <!-- second child -->
    <div class="bg-light">
      <h3 class="text-center p-2">Manage Details</h3>
    </div>

    <!-- third child -->
    <div class="col-md-12">
      <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
        <div>

          <?php
          $username = $_SESSION['username'];
          $get_image = "SELECT * FROM `user_table` WHERE username= '$username' ";
          $result = mysqli_query($connection, $get_image);
          $row = mysqli_fetch_assoc($result);
          $admin_image = $row['user_image'];
          ?>
          <a href=""><img src="../images/<?php echo $admin_image ?>"  class="admin_image mx-1" alt=""></a>
          <p class="text-light text-center">Admin : <span class="fw-bold text-white"><?php echo $username ?></span></p>
        </div>
        <div class="button text-center my-2 ">

          <!-- emite to get multiple button with therir classes -->
          <!-- button*10>a.nav-link. -->

          <button class="mx-1"><a href="index.php?insert_product" class="nav-link text-light bg-info my-1 fw-bold">Insert Product</a></button>
          <button><a href="index.php?view_product" class="nav-link text-light bg-info my-1 fw-bold">View Product</a></button>
          <button><a href="index.php?insert_categories" class="nav-link text-light bg-info my-1 fw-bold">Insert Categories</a></button>
          <button><a href="index.php?view_categories" class="nav-link text-light bg-info my-1 fw-bold">View Categories</a></button>
          <button><a href="index.php?insert_brand" class="nav-link text-light bg-info my-1 fw-bold">Insert Brands</a></button>
          <button><a href="index.php?view_brand" class="nav-link text-light bg-info my-1 fw-bold">View Brands</a></button>
          <button><a href="index.php?list_order" class="nav-link text-light bg-info my-1 fw-bold">All Orders</a></button>
          <button><a href="index.php?list_payment" class="nav-link text-light bg-info my-1 fw-bold">All Payment</a></button>
          <button><a href="index.php?lit_all_users" class="nav-link text-light bg-info my-1 fw-bold">List Users</a></button>
          <button><a href="logout.php" class="nav-link text-light bg-info my-1 fw-bold">Logout</a></button>
        </div>
      </div>
    </div>

    <!-- fort child -->
    <div class="container my-3">
      <?php
      if (isset($_GET['insert_product'])) {
        include('insert_product.php');
      }
      if (isset($_GET['insert_categories'])) {
        include('insert_categories.php');
      }
      if (isset($_GET['insert_brand'])) {
        include('insert_brand.php');
      }
      if (isset($_GET['view_product'])) {
        include('view_product.php');
      }
      if (isset($_GET['edit_product'])) {
        include('edit_product.php');
      }
      if (isset($_GET['delete_product'])) {
        include('delete_product.php');
      }
      if (isset($_GET['view_categories'])) {
        include('view_categories.php');
      }
      if (isset($_GET['view_brand'])) {
        include('view_brand.php');
      }
      if (isset($_GET['edit_category'])) {
        include('edit_category.php');
      }
      if (isset($_GET['edit_brand'])) {
        include('edit_brand.php');
      }
      if (isset($_GET['delete_category'])) {
        include('delete_category.php');
      }
      if (isset($_GET['delete_brand'])) {
        include('delete_brand.php');
      }
      if (isset($_GET['list_order'])) {
        include('list_order.php');
      }
      if (isset($_GET['delete_order'])) {
        include('delete_order.php');
      }
      if (isset($_GET['list_payment'])) {
        include('list_payment.php');
      }
      if (isset($_GET['delete_payment'])) {
        include('delete_payment.php');
      }
      if (isset($_GET['lit_all_users'])) {
        include('lit_all_users.php');
      }
      ?>
    </div>

    <!-- last child -->
    <!-- include footer -->
    <?php include('../includes/footer.php') ?>

  </div>

  <!-- bootstrap js -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
    unset($_SESSION['login']);
  }
  ?>
  <!-- <script>
    // JavaScript code to handle multiple file inputs

    // Get all file input elements with the "file-input" class
    const fileInputs = document.querySelectorAll('.file-input');

    // Loop through each file input element
    fileInputs.forEach(function (fileInput) {
        // Get the corresponding existing image URL element
        const existingImageURL = fileInput.parentElement.querySelector('.existing-image-url').value;

        // Add an event listener to each file input to update the image when a new file is selected
        fileInput.addEventListener('change', function (event) {
            const selectedFile = event.target.files[0];
            if (selectedFile) {
                // A new file is selected, display its preview
                const reader = new FileReader();
                reader.onload = function () {
                    const imgPreview = fileInput.parentElement.querySelector('.product_image');
                    imgPreview.src = reader.result;
                };
                reader.readAsDataURL(selectedFile);
            } else {
                // No file selected, show the existing image
                const imgPreview = fileInput.parentElement.querySelector('.product_image');
                imgPreview.src = existingImageURL;
            }
        });

        // Set the initial image preview using the existing URL
        const imgPreview = fileInput.parentElement.querySelector('.product_image');
        imgPreview.src = existingImageURL;
    });
</script> -->
</body>

</html>