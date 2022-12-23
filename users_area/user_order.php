<!-- <?php require 'session_start.php'; ?> -->
<h3 class="text-success"> All my Orders </h3>
<table class="mx-3 table table-bordered mt-5">
    <thead class="bg-info">
        <th>Sl No.</th>
        <th>Amount Due</th>
        <th>Total Products</th>
        <th>Invoice Number</th>
        <th>Date</th>
        <th>Complete/Incomplete</th>
        <th>Status</th>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $username = $_SESSION['username'];
        $get_users = "select * from user_table where username = '$username'";
        $result = $con->query($get_users);
        $row_fetch = $result->fetch_assoc();
        $user_id = $row_fetch['user_id'];


        // user order table
        $get_order = "select * from user_orders where user_id = $user_id";
        $result_order = $con->query($get_order);
        $number = 1;
        while ($row_order = $result_order->fetch_assoc()) {
            $order_id = $row_order['order_id'];
            $amount_due = $row_order['amount_due'];
            $invoice_number = $row_order['invoice_number'];
            $total_products = $row_order['total_products'];
            $order_date = $row_order['order_date'];
            $order_status = $row_order['order_status'];
            if ($order_status == 'pending') {
                $order_status = 'incomplete';
            } else {
                $order_status = 'Complete';
            }

            echo "<tr>
            <td>$number</td>
            <td>$amount_due</td>
            <td>$total_products</td>
            <td>$invoice_number</td>
            <td>$order_date</td>
            <td>$order_status</td>";
            ?>

            <?php
            if($order_status=='Complete'){
                echo "<td> paid </td> </tr>";
            }else{
                echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a></td>
                </tr>";
            }
            $number++;
        }

        ?>

    </tbody>
</table>