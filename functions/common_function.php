<?php
// include './includes/connect.php';
// session_start();
// getting products
function getProducts()
{
    global $con;
    // Condition for isset or not for category and brand
    if (!(isset($_GET['cat_id']) or isset($_GET['products']))) {
        if (!(isset($_GET['brand_id']) or isset($_GET['search']) or isset($_GET['search_btn']))) {
            $select_data = "select * from product order by rand() limit 0,3";
            $result_data = $con->query($select_data);
            if ($result_data->num_rows > 0) {
                while ($row_data = $result_data->fetch_assoc()) {
                    echo '<div class="bg-light col-lg-4 col-md-6 mb-4 ">
                    <div class="card justify-content-center">
                        <img class="card-img-top" src="./admin_area/prod_img/' . $row_data['product_img1'] . '" alt="' . $row_data['product_title'] . '">
                        <div class="card-body text-md-start text-center">
                            <h5 class="card-title">' . $row_data['product_title'] . '</h5>
                            <p class="card-text">' . $row_data['product_description'] . '</p>
                            <p class="card-text">Price: ' . $row_data['product_price'] . '/- </p>
                            <a href="index.php?add_cart=' . $row_data['prod_id'] . '" class="btn btn-info">Add to cart</a>
                            <a href="product_details.php?product_id=' . $row_data['prod_id'] . '" class="btn btn-secondary">View more</a>
                        </div>
                    </div>
                </div>';
                }
            }
        }
    }
}

// Display all products
function display_all_products()
{
    global $con;
    // Condition for isset or not for category and brand
    if (isset($_GET['products'])) {
        $select_data = "select * from product order by rand()";
        $result_data = $con->query($select_data);
        if ($result_data->num_rows > 0) {
            while ($row_data = $result_data->fetch_assoc()) {
                echo '<div class="col-lg-4 col-md-6 mb-4 ">
                    <div class="card justify-content-center">
                        <img class="card-img-top" src="./admin_area/prod_img/' . $row_data['product_img1'] . '" alt="' . $row_data['product_title'] . '">
                        <div class="card-body text-md-start text-center">
                            <h5 class="card-title">' . $row_data['product_title'] . '</h5>
                            <p class="card-text">' . $row_data['product_description'] . '</p>
                            <p class="card-text">Price: ' . $row_data['product_price'] . '/- </p>
                            <a href="index.php?add_cart=' . $row_data['prod_id'] . '" class="btn btn-info">Add to cart</a>
                            <a href="product_details.php?product_id=' . $row_data['prod_id'] . '" class="btn btn-secondary">View more</a>
                        </div>
                    </div>
                </div>';
            }
        }
    }
}

// individual display product details 
function product_details()
{
    global $con;

    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $select_data = "select * from product where prod_id = '$product_id' ";
        $result_data = $con->query($select_data);
        if ($result_data->num_rows > 0) {
            while ($row_data = $result_data->fetch_assoc()) {
                echo '<div class="col-lg-4 col-md-6 mb-4 ">
            <div class="card justify-content-center">
                <img class="card-img-top" src="./admin_area/prod_img/' . $row_data['product_img1'] . '"
                    alt="' . $row_data['product_title'] . '">
                <div class="card-body text-md-start text-center">
                    <h5 class="card-title">' . $row_data['product_title'] . '</h5>
                    <p class="card-text">' . $row_data['product_description'] . '</p>
                    <p class="card-text">Price: ' . $row_data['product_price'] . '/- </p>
                    <a href="index.php?add_cart=' . $row_data['prod_id'] . '" class="btn btn-info">Add to cart</a>
                    <a href="index.php" class="btn btn-secondary">Back to home</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 ">
            <div class="card justify-content-center border-none">
                <img class="card-img-top" src="./admin_area/prod_img/' . $row_data['product_img2'] . '"
                    alt="' . $row_data['product_title'] . '">
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 ">
            <div class="card justify-content-center">
                <img class="card-img-top" src="./admin_area/prod_img/' . $row_data['product_img3'] . '"
                    alt="' . $row_data['product_title'] . '">
            </div>
        </div>';
            }
        }
    }
}




// getting unique category products
function get_unique_category_products()
{
    global $con;

    // Condition for isset for Unique category
    if (isset($_GET['cat_id'])) {
        $category_id = $_GET['cat_id'];
        $select_data = "select * from product where category_id = $category_id";
        $result_data = $con->query($select_data);
        if ($result_data->num_rows > 0) {
            while ($row_data = $result_data->fetch_assoc()) {
                echo '<div class="col-lg-4 col-md-6 mb-4 ">
                    <div class="card justify-content-center">
                        <img class="card-img-top" src="./admin_area/prod_img/' . $row_data['product_img1'] . '" alt="' . $row_data['product_title'] . '">
                        <div class="card-body text-md-start text-center">
                            <h5 class="card-title">' . $row_data['product_title'] . '</h5>
                            <p class="card-text">' . $row_data['product_description'] . '</p>
                            <p class="card-text">Price: ' . $row_data['product_price'] . '/- </p>
                            <a href="index.php?add_cart=' . $row_data['prod_id'] . '" class="btn btn-info">Add to cart</a>
                            <a href="product_details.php?product_id=' . $row_data['prod_id'] . '" class="btn btn-secondary">View more</a>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<div class="noresult_warning"><h3 class="text-danger"> No results match, No products found on this category</h3></div>';
        }
    }
}


// Condition for isset for Unique brand
function get_unique_brand_products()
{
    global $con;

    if (isset($_GET['brand_id'])) {
        $brand_id = $_GET['brand_id'];
        $select_data = "select * from product where brand_id =$brand_id";
        $result_data = $con->query($select_data);
        if ($result_data->num_rows > 0) {
            while ($row_data = $result_data->fetch_assoc()) {
                echo '<div class="col-lg-4 col-md-6 mb-4 ">
                        <div class="card justify-content-center">
                            <img class="card-img-top" src="./admin_area/prod_img/' . $row_data['product_img1'] . '" alt="' . $row_data['product_title'] . '">
                            <div class="card-body text-md-start text-center">
                                <h5 class="card-title">' . $row_data['product_title'] . '</h5>
                                <p class="card-text">' . $row_data['product_description'] . '</p>
                                <p class="card-text">Price: ' . $row_data['product_price'] . '/- </p>
                                <a href="index.php?add_cart=' . $row_data['prod_id'] . '" class="btn btn-info">Add to cart</a>
                                <a href="product_details.php?product_id=' . $row_data['prod_id'] . '" class="btn btn-secondary">View more</a>
                            </div>
                        </div>
                    </div>';
            }
        } else {
            echo '<div class="noresult_warning"><h3 class="text-danger"> No results match, No products found on this Brand </h3></div>';
        }
    }
}


// Search product data
function get_search_products()
{
    global $con;
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $select_data = "select * from product where product_keywords like '%$search%'";
        $result_data = $con->query($select_data);
        if ($result_data->num_rows > 0) {
            while ($row_data = $result_data->fetch_assoc()) {
                echo '<div class="col-lg-4 col-md-6 mb-4 ">
                        <div class="card justify-content-center">
                            <img class="card-img-top" src="./admin_area/prod_img/'.$row_data['product_img1'] . '" alt="' . $row_data['product_title'] . '">
                            <div class="card-body text-md-start text-center">
                                <h5 class="card-title">' . $row_data['product_title'] . '</h5>
                                <p class="card-text">' . $row_data['product_description'] . '</p>
                                <p class="card-text">Price: ' . $row_data['product_price'] . '/- </p>
                                <a href="index.php?add_cart=' . $row_data['prod_id'] . '" class="btn btn-info">Add to cart</a>
                                <a href="product_details.php?product_id=' . $row_data['prod_id'] . '" class="btn btn-secondary">View more</a>
                            </div>
                        </div>
                    </div>';
            }
        } else {
            echo '<div><h3 class="mt-2 text-danger"> No results match, No Search products found </h3></div>';
        }
    }
}


// Displaying brands in sidebar
function getbrand()
{
    global $con;
    $select_brands = "select * from brands";
    $result_brands = $con->query($select_brands);
    if ($result_brands->num_rows > 0) {
        while ($row_brand = $result_brands->fetch_assoc()) {
            echo '<li class="nav-item">
                <a href=index.php?brand_id=' . $row_brand['brand_id'] . '" class="nav-link text-white">'
                . strtoupper($row_brand['brand_title']) . '</a>
                    </li>';
        }
    } else {
        echo "No brands Available";
    }
}


// displaying categories in sidebar
function getcategory()
{
    global $con;
    $select_category = "select * from category";
    $result_category = $con->query($select_category);
    if ($result_category->num_rows > 0) {
        while ($row_category = $result_category->fetch_assoc()) {
            echo '<li class="nav-item">
                            <a href= index.php?cat_id=' . $row_category['category_id'] . ' class="nav-link text-white">'
                . strtoupper($row_category['category_title']) .
                '</a>
                        </li>';
        }
    } else {
        echo "No brands Available";
    }
}

// Get ip address function
function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;  


// function for add item to cart
function cart()
{
    global $con;
    if (isset($_GET['add_cart'])) {
        $ip = getIPAddress();
        $product_id = $_GET['add_cart'];
        $select_query = "select * from cart_details where ip_address='$ip' and product_id= $product_id";
        $result = $con->query($select_query);
        if (!$result->num_rows > 0) {
            $insert_query = "insert into cart_details (product_id,ip_address,quantity) values ($product_id,'$ip',0)";
            $result = $con->query($insert_query);
            echo '<script> alert("This item is add to cart")</script>';
            echo '<script> window.open("index.php","_SELF") </script>';
        } else {
            echo '<script>alert("This item is already added to a cart")</script>';
            echo '<script> window.open("index.php","_SELF") </script>';
        }
    }
}

// function for show cart items

function show_cart_item()
{
    global $con;
    if (isset($_GET['add_cart'])) {
        $ip = getIPAddress();
        $select_query = "select * from cart_details where ip_address='$ip'";
        $result = $con->query($select_query);
        $count_cart_item = $result->num_rows;
    } else {
        global $con;
        $ip = getIPAddress();
        $select_query = "select * from cart_details where ip_address='$ip'";
        $result = $con->query($select_query);
        $count_cart_item = $result->num_rows;
    }
    echo $count_cart_item;
}


// function for total cart price
function total_cart_price()
{
    global $con;
    $ip = getIPAddress();
    $total_price = 0;
    $select_cart = "select * from cart_details where ip_address='$ip'";
    $cart_result = $con->query($select_cart);
    while ($row = $cart_result->fetch_array()) {
        global $product_id;
        $product_id = $row['product_id'];
        $select_product = "select * from product where prod_id=$product_id";
        $product_result = $con->query($select_product);
        if ($product_result->num_rows > 0) {
            while ($product_row = $product_result->fetch_array()) {
                $product_price = array($product_row['product_price']);
                $product_price_value = array_sum($product_price);
                $total_price += $product_price_value;
            }
        }
    }
    echo $total_price;
}


// function for item quantity
function item_quantity()
{
    if (isset($_POST['update'])) {
        global $product_id;
        echo $product_id;
        die();
        global $con;
        global $total_price;
        global $cart_quantity;
        $ip = getIPAddress();
        $update_quantity = $_POST['quantity'];
        $update_cart = "update cart_details set quantity=$update_quantity where ip_address='$ip'";
        $result_cart = $con->query($update_cart);
        $cart_quantity = (int)$cart_quantity;
        $total_price = $total_price * $cart_quantity;
    }
}

// get user order details

function user_order_details(){
    global $con;
    $username = $_SESSION['username'];
    $get_details = "select * from user_table where username = '$username'";
    $result_details = $con->query($get_details);
    while($row_query = $result_details->fetch_array()){
        $user_id = $row_query['user_id'];
        if(!isset($_GET['edit_account'])){
            if(!isset($_GET['my_orders'])){
                if(!isset($_GET['delete_account'])){
                    $get_orders = "select * from user_orders where user_id = $user_id and order_status='pending'";
                    $result_orders_query=$con->query($get_orders);
                    $row_count = $result_orders_query->num_rows;
                    if($row_count>0){
                        echo "<h3 class='mt-4 text-success my-3'> You have <span class='text-danger'>  ".$row_count."</span> pending orders </h3>";
                        echo '<a class="text-dark" href="profile.php?order_details"> Order Details </a>';
                    }else{
                        echo "<h3 class='mt-4 text-success my-3'> You have Zero pending orders </h3>";
                        echo '<a class="text-dark" href="../index.php"> Explore Products </a>';
                    }
                }
            }
        }
    }
}   
