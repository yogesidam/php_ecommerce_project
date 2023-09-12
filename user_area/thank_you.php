<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- font awsemome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        .container{
            height: 350px;
            width: 500px;
            border-radius: 20px;
            border-color: green;
            position: relative;
            top: 100px;
        }
    </style>
</head>
<body>
    <div class="container bg-success" 2>
        <h1 class="text-center pt-5 text-light">Thank You</h1>
        <h3 class="text-center pt-5 text-light">Your Order is Placed</h3>
        <h2 class="text-center pt-5 text-light">Successfully</h2>
    </div>
    <?php
      session_start();
      if(isset($_SESSION['username'])){
        ?>
          <meta http-equiv="refresh" content="5 ; url =http://localhost/php_ecommerce%20project/index.php"> 
        <?php
      }
    ?>
</body>
</html>