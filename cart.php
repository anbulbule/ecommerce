<!-- Connection file -->
<?php
require 'includes/connect.php';
require 'functions/common_function.php';
// require 'session_start.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce website Cart details</title>
    <?php require 'Bootstrap_links_header.php'; ?>
</head>

<body>
    <!-- Navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="logo/company_logo.jpg" alt="" class="rounded logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?products">Products</a>
                        </li>
                        <?php
                            if(isset($_SESSION['username'])){
                                echo " <li class='nav-item'>
                                <a class='nav-link' href='users_area/profile.php'>My Account</a>
                            </li>";
                            }else{
                                echo " <li class='nav-item'>
                                <a class='nav-link' href='users_area/user_registration.php'>Register</a>
                            </li>";
                            }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-sharp fa-solid fa-cart-shopping"></i>
                                <sup><?php show_cart_item(); ?></sup>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </div>

    <!-- Calling cart function -->
    <?php cart();  ?>
    <!-- Second child -->
    <div class="navbar nav-expand-lg navbar-dark bg-secondary">
        <ul class="nav  me-auto ">
        <?php
                if(isset($_SESSION['username'])){
                    echo ' <li class="nav-item ">
                    <a class="nav-link text-decoration-none text-white" href="">'.$_SESSION['username'].'</a>
                </li>';
                }else{
                    echo ' <li class="nav-item ">
                    <a class="nav-link text-decoration-none text-white" href="">Welcome Guest</a>
                </li>';
                }
            
                if(!isset($_SESSION['username'])){
                    echo ' <li class="nav-item ">
                    <a class="nav-link text-decoration-none text-white" href="users_area/user_login.php">Login</a>
                </li>';
                }else{
                    echo ' <li class="nav-item ">
                    <a class="nav-link text-decoration-none text-white" href="users_area/user_logout.php">Logout</a>
                </li>';
                }
            ?>
        </ul>
    </div>
    <!-- third child -->

    <div class="bg-light pt-md-1 pt-3">
        <h3 class="text-center">Grocery Store</h3>
        <p class="text-center">
            Welcome to this Grocery world with Maximum discounts
        </p>
    </div>

    <!-- Forth child -->
    <div class="container">
        <div class="row">
            <div>
                <form action="" method="post">

                    <!-- Php code for fetch cart items -->
                    <?php
                            $ip = getIPAddress();
                            if(!isset($total_price)){ $total_price = 0; }
                            $select_cart = "select * from cart_details where ip_address='$ip'";
                            $cart_result = $con->query($select_cart);
                            if($cart_result->num_rows>0){
                                echo ' <table class="table table-bordered text-center">
                                <thead>
                                    <th>Product title</th>
                                    <th>Product Image</th>
                                    <th>Quantity</th>
                                    <th>Total price</th>
                                    <th>Remove</th>
                                    <th>Operation</th>
                                </thead>
                                <tbody>';
                                while ($row = $cart_result->fetch_array()) {
                                $total_cart_price =0;
                                $product_id = $row['product_id'];
                                $cart_quantity = $row['quantity'];
                                $select_product = "select * from product where prod_id='$product_id'";
                                $product_result = $con->query($select_product);
                                if ($product_result->num_rows > 0) {
                                    while ($product_row = $product_result->fetch_array()) {
                                        $product_price = array($product_row['product_price']);
                                        $product_price_value = array_sum($product_price);
                                        $price_table = $product_row['product_price'];
                                        $product_title = $product_row['product_title'];
                                        $product_img1 = $product_row['product_img1'];
                                        $total_cart_price += $product_price_value;
                            ?>
                    <tr>
                        <td><?php echo $product_title ?></td>
                        <td><a href="product_details.php?product_id=<?php echo $product_id ?>"><img
                                    src="admin_area/prod_img/<?php echo $product_img1; ?>" alt="" width="100px"
                                    height="100px"></a></td>

                                    <!-- fetch individual cart item quantity and its amount -->
                                        <?php
                                            $ip = getIPAddress();
                                            if(isset($_POST['update'])){
                                            $quantity = $_POST['quantity'];
                                            $update_cart = "update cart_details set quantity=$quantity where ip_address='$ip'";
                                            $update_result=$con->query($update_cart);
                                            $total_price=$total_price*$quantity;
                                            global $total_price;
                                        }
                                        ?>

                        <td><input type="number" class="form-input" name="quantity"
                                value="<?php if(isset($row['quantity'])){echo $row['quantity'];} ?>" id="">
                        </td>

                        <td><?php if($row['quantity']>0){
                           $item_price = $row['quantity'] *  $product_row['product_price'];
                        echo $item_price;
                        } else{
                            echo $item_price = $product_row['product_price'];
                        }
                        
                        ?></td>
                        <td><input type="checkbox" name="remove_item[]" value="<?php echo  $product_id ?>"></td>
                        <td>

                            <input type="submit" name="update" value="Update item"
                                class="border-0 mx-1  bg-secondary p-2 px-3 text-white rounded">
                            <input type="submit" name="remove" value="Remove item"
                                class="border-0 mx-1  bg-secondary p-2 px-3 text-white rounded">
                        </td>
                    </tr>
                    <?php
                                    }
                                }
                            }
                        
                            ?>
                    </tbody>
                    </table>



                    <!-- Total items and its prices -->
                    <div class="d-flex my-5">
                        <div class="col align-self-center">
                            <h4>Subtotal : <strong
                                    class="mx-2 align-center text-secondary"><?php echo $total_cart_price ?>/-</strong></h3>
                        </div>
                        <div class="col align-self-center">
                            <a href="index.php"
                                class="border-0 mx-4 align-self-center bg-secondary p-2 px-3 text-white rounded">
                                Continue Shopping </a>
                            <a href="users_area/checkout.php" class="border-0 mx-3 bg-success p-2 px-3 text-white rounded">Check
                                    Out</a>
                        </div>
                    </div>
                </form>
                <?php
                }else{
                    echo '<div class="text-danger text-center"> <h3>Cart is Empty</h3></div>';
                    echo '<a href="index.php" class="border-0 mx-4 align-self-center bg-secondary p-2 px-3 text-white rounded" > Continue
                    Shopping</a>';
                }
                ?>

                <!-- Function for remove items -->
                <?php
                    function remove_cart_item(){
                        global $con;

                        if(isset($_POST['remove'])){
                            foreach($_POST['remove_item'] as $remove_id){
                                echo $remove_id;
                                $delete_query = "delete from cart_details where product_id='$remove_id'";
                                $delete_result = $con->query($delete_query);
                                echo '<script> window.open("cart.php","_self") </script>';
                            }
                        }
                    }
                    remove_cart_item();
                ?>
            </div>
        </div>
    </div>

    <!-- last child -->
    <footer class="mt-5">
        <div class="fixed-bottom bg-dark text-light d-flex align-self-center py-2">
            <marquee behavior="" direction="right">
                <p class="m-0">All rights reserved &#169;- Designed by Abhi-2022</p>
            </marquee>
        </div>
    </footer>
    <?php require 'Bootstrap_links_footer.php'; ?>
</body>

</html>