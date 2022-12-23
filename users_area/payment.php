<!-- <?php require 'session_start.php'; ?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../bootstrap_links_footer.php'; 
    require '../functions/common_function.php';
?>
    <title>Payment</title>
   </head>

<body>
    <?php
        // php code to access for user id
        $user_ip=getIPAddress();
        $get_user="select * from user_table where user_ip='$user_ip'";
        $result = $con->query($get_user);
        $row = $result->fetch_array();
        $user_id = $row['user_id'];
        ?>
    <div class="container">
        <div class="text-center text-primary">
            <h1>Payment option</h1>
        </div>
        <div class="row mt-5 d-flex align-items-center justify-content-center">
            <div class=" col-md-6">
                <a href="https://www.paypal.com"  target="blank"><img class="col-6 pay" src="../images/upi_pay.jpg" alt=""></a>
            </div>
            <div class="col-md-6">
                <a href="order.php?user_id=<?php echo $user_id ?>"> <h3>Pay offline</h3></a>
            </div>
        </div>
        <?php require '../bootstrap_links_footer.php'; ?>
    </div>
</body>

</html>