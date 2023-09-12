<?php
$get_order = "SELECT * FROM `user_order`";
$result = mysqli_query($connection, $get_order);
$num_order = mysqli_num_rows($result);
if ($num_order == 0) {
    echo "<h3 class='text-center text-danger mt-5'>No Orders</h3>";
} else {
?>
    <h3 class="text-center text-success">All Orders</h3>

    <table class="table table-bordered mt-5">
        <thead class="text-center bg-info">
            <tr>
                <th>SL.no</th>
                <th>Due amount</th>
                <th>Invooice number</th>
                <th>Order date</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class='bg-secondary text-light text-center'>
        <?php
        $number = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $order_id = $row['order_id'];
            $user_id = $row['user_id'];
            $amount_due = $row['amount_due'];
            $invoice_nbmber = $row['invoice_number'];
            $total_product = $row['total_product'];
            $order_date = $row['order_date'];
            $order_status = $row['order_status'];
            $number++;
            echo "
                <tr>
                <td> $number </td>
                <td> $amount_due </td>
                <td> $invoice_nbmber </td>
                <td> $order_date </td>
                <td> $order_status </td>
                <td><a href='index.php?delete_order= $order_id ' class='text-light'><i class='fa-solid fa-duotone fa-trash'></i></a></td>
            </tr>
                ";
        }
    }
        ?>

        </tbody>
    </table>