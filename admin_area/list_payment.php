<?php
$get_paymnet = "SELECT * FROM `user_payment`";
$result = mysqli_query($connection, $get_paymnet);
$num_payment = mysqli_num_rows($result);
if ($num_payment == 0) {
    echo "<h3 class='text-center text-danger mt-5'>No Payment Recived</h3>";
} else {
?>
    <h3 class="text-center text-success mt-5">All Payments</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info text-center">
            <tr>
                <th>SL.no</th>
                <th>Order Id</th>
                <th>Invoice number</th>
                <th>Amount</th>
                <th>Payment mode</th>
                <th>Date</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light text-center">
            <?php
               $number = 0;
               while($row = mysqli_fetch_assoc($result)){
                 $payment_id = $row['payment_id'];
                 $order_id = $row['order_id'];
                 $invoice_number = $row['invoice_number'];
                 $amount = $row['amount'];
                 $payment_mode = $row['payment_mode'];
                 $date = $row['date'];
                 echo 
                 "<tr>
                   <td>$number</td>
                   <td>$order_id</td>
                   <td>$invoice_number</td>
                   <td>$amount</td>
                   <td>$payment_mode</td>
                   <td>$date</td>
                   <td><a href='index.php?delete_payment= $payment_id ' class='text-light'><i class='fa-solid fa-duotone fa-trash'></i></a></td>
                  </tr>";
               }
            ?>
        </tbody>
    </table>
<?php } ?>