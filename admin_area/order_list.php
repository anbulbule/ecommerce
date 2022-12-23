<?php require 'session_start.php'; ?>
<h3 class="text-center text-success">All orders</h3>
<table class="table text-center table-bordered mt-5">
    <thead class="bg-info ">
        <tr>
            <th>Sl no.</th>
            <th>Due Amount</th>
            <th>invoice Number</th>
            <th>total Products</th>
            <th>order date</th>
            <th>status</th>
            <th>delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
    <?php
        $select_orders = "select * from user_orders";
        $result_orders = $con->query($select_orders);
        if($result_orders->num_rows>0){
            $number=1;
            while($row_orders=$result_orders->fetch_assoc()){

                $order_id = $row_orders['order_id'];
                $user_id = $row_orders['user_id'];
                $due_amount = $row_orders['amount_due'];
                $invoice_number = $row_orders['invoice_number'];
                $total_products = $row_orders['total_products'];
                $order_date = $row_orders['order_date'];
                $order_status = $row_orders['order_status'];
            
            echo '<tr>
            <td>'.$number.'</td>
            <td>'.$due_amount.'</td>
            <td>'.$invoice_number.'</td>
            <td>'.$total_products.'</td>
            <td>'.$order_date.'</td>
            <td>'.$order_status.'</td>
            <td> <a href="delete_order.php?delete_order='.$order_id.'" class="text-light"><i class="fa-solid fa-trash"></i></a> </td>
        </tr>';
        
        $number++;
            
            }
        }else{
            echo '<h3 class="text-danger text-center mt-5">No orders yet</h3>';
        }
    ?>

        
    </tbody>
</table>