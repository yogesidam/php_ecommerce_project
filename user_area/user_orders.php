<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .table{
            width: 900px;
        }
    </style>
</head>

<body>

    <!-- php coe start here... -->
    <?php
    $username = $_SESSION['username'];
    $query = "SELECT * FROM `user_table` WHERE username= '$username' ";
    $data = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($data);
    $user_id = $row['user_id'];
    // echo $user_id;
    ?>
    <div class="d-flex aligh-intems-center justify-content-center">
    <table class="table table-bordered  ">
        <thead class="bg-info ">
            <tr>
                <th>SL.no</th>
                <th>Order number</th>
                <th>Amount Due</th>
                <th>Invoice number</th>
                <th>Date</th>
                <th>More info</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light fw-bold">

            <?php
            $select_query = "SELECT * FROM `user_order` WHERE user_id= $user_id";
            $data2 = mysqli_query($connection, $select_query);
            $number = 1;
            while ($row_orders = mysqli_fetch_assoc($data2)) {
                $order_id = $row_orders['order_id'];
                $amount_due = $row_orders['amount_due'];
                $total_product = $row_orders['total_product'];
                $order_date = $row_orders['order_date'];
                $number++;

                echo "<tr>
            <td>$number</td>
            <td>$order_id</td>
            <td>$amount_due</td>
            <td>$total_product</td>
            <td>$order_date</td>
            <td><a href='order_info.php?order_id=$order_id' class='text-light text-decoration-none'>detail</a></td>";
             }
         ?>
        </tbody>
    </table>
    </div>
</body>

</html>