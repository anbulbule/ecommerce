<?php
    require '../includes/connect.php';
    require '../functions/common_function.php';
    // require 'session_start.php';
    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
    }
    // getting total items and total price of all item

    $get_ip_address = getIPAddress();
    $total_price = 0;
    $cart_query_price = "select * from cart_details where ip_address = '$get_ip_address'";
    $result_cart_price=$con->query($cart_query_price);
    $invoice_number = mt_rand();
    $status = 'pending';
    $count=$result_cart_price->num_rows;
    while($row_price = $result_cart_price->fetch_array()){
    $product_id = $row_price['product_id'];
        
        // query for select product table
        $select_product = "select * from product where prod_id=$product_id";
        $result_product_price = $con->query($select_product);
        while($row_product_price=$result_product_price->fetch_array()){
            $product_price = array($row_product_price['product_price']);
            $product_price_sum = array_sum($product_price);
            $total_price += $product_price_sum;
        }
    }
// getting quantity from cart
$get_cart = "select * from cart_details";
$result_cart_details = $con->query($get_cart);
$row_details = $result_cart_details->fetch_array();
$quantity = $row_details['quantity'];
if($quantity ==0){
    $quantity = 1;
    $subtotal =$total_price;
}else{
    $quantity = $quantity;
    $subtotal = $quantity * $total_price;
}
$insert_user_order = "insert into user_orders (user_id,amount_due,invoice_number,total_products,order_date,order_status)
value($user_id,$subtotal,$invoice_number,$count,now(),'$status')";
$result_query = $con->query($insert_user_order);
if($result_query){
    echo '<script> alert("orders are submitted successfully") </script>';
    echo '<script> window.open("profile.php","_self") </script>';
}

// orders pending
$insert_pending_order = "insert into order_pending (user_id,invoice_number,product_id,quantity,order_status)
value($user_id,$invoice_number,$product_id,$quantity,'$status')";
$result_pending_order = $con->query($insert_pending_order);

// delete items from cart 
$empty_query = "delete from cart_details where ip_address='$get_ip_address'";
$empty_result = $con->query($empty_query);