<?php require 'session_start.php'; ?>
<h3 class="text-center text-success">Order Payments</h3>
<table class="table text-center table-bordered mt-5">
    <thead class="bg-info ">
        <tr>
            <th>Sl no.</th>
            <th>Invoice number</th>
            <th>Amount</th>
            <th>Payment mode</th>
            <th>order date</th>
            <th>delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
    <?php
        $get_payment = "select * from user_payment";
        $result_payment = $con->query($get_payment);
        if($result_payment->num_rows>0){
            $number=1;
            while($row_payment=$result_payment->fetch_assoc()){
                $payment_id = $row_payment['id']; 
                $order_id = $row_payment['order_id'];
                $amount = $row_payment['amount'];
                $invoice_number = $row_payment['invoice_number'];
                $payment_mode = $row_payment['payment_mode'];
                $payment_date = $row_payment['date'];
            
            echo '<tr>
            <td>'.$number.'</td>
            <td>'.$invoice_number.'</td>
            <td>'.$amount.'</td>
            <td>'.$payment_mode.'</td>
            <td>'.$payment_date.'</td>
            <td> <a href="delete_payment.php?delete_payment='.$payment_id.'" class="text-light"><i class="fa-solid fa-trash"></i></a> </td>
        </tr>';
        
        $number++;
            
            }
        }else{
            echo '<h3 class="text-danger text-center mt-5">No orders yet</h3>';
        }
    ?>

        
    </tbody>
</table>