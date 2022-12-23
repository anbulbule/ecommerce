<!-- Connection file -->
<?php
require '../includes/connect.php';
require '../functions/common_function.php';
// require 'session_start.php';
if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $select_query = "select * from user_orders where order_id=$order_id";
    $result = $con->query($select_query);
    $row = $result->fetch_assoc();
    $invoice_number = $row['invoice_number'];
    $amount = $row['amount_due'];
}

if(isset($_POST['confirm_payment'])){
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];

    // insert into user payment
    $insert_payment = "insert into user_payment (order_id,invoice_number,amount,payment_mode) values 
    ($order_id,$invoice_number,$amount,'$payment_mode')";
    $result_payment= $con->query($insert_payment);
    if($result_payment){
        echo '<h3 class="text-center text-light"> Successfully Payment done </h3>    ';
        
        // update user_order table
    $update_query = "update user_orders set order_status='complete' where order_id= $order_id";
    $result_order = $con->query($update_query);

    echo '<script>window.open("profile.php","_self")</script>';

    }
    

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment page</title>
    <?php require '../Bootstrap_links_header.php'; ?>
</head>
<body class="bg-secondary">
    <h1 class="text-center text-light mt-4">Confirm Payment</h1>
    <div class="container my-5">
        <form action="" method="post">
            <div class="form-outline my-4 text-center">
                <input type="text" class=" w-50 m-auto form-control" value="<?php echo $invoice_number ?>" name="invoice_number">
            </div>
            <div class="form-outline my-4 text-center">
                <label for="amount" class="text-light">Amount </label>
                <input type="text" id="amount" class=" w-50 m-auto form-control" value="<?php echo $amount ?>" name="amount">
            </div>
            <div class="form-outline my-4 text-center">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option value="">Select Mode</option>
                    <option >UPI</option>
                    <option >Netbanking</option>
                    <option >Paypal</option>
                    <option>Cash on Delivery</option>
                    <option>Pay Offline</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center">
                <input type="submit"  class="btn py-2 px-3 bg-info" name="confirm_payment" value="Confirm Payment">
            </div>
        </form>
    </div>


<?php require '../Bootstrap_links_footer.php'; ?>
</body>
</html>