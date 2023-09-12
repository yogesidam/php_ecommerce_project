<?php
  $serverside = "localhost";
  $username = "root";
  $password = "";
  $dbname = "php-mystore";
  
  $connection = mysqli_connect($serverside, $username, $password, $dbname);

  if(!$connection){
    echo "die(mysqli_error($connection))";
  }
 

?>