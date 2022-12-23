<!-- Connection file -->
<?php
require 'includes/connect.php';
require 'functions/common_function.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce website using php and MYSQLI</title>
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
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price : <?php  total_cart_price(); ?>/-</a>
                        </li>
                    </ul>
                    <form action="" method="get" class="d-flex" role="search">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search"
                            aria-label="Search">
                        <input class="btn btn-outline-light" type="submit" value="Search" name="search_btn">
                    </form>
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
                    <a class="nav-link text-decoration-none text-white" href="users_area/profile.php">'.$_SESSION['username'].'</a>
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

    <!-- fourth child -->
    <div class="row bg-light">
        <div class="col-md-10 order-md-1 order-2 py-md-0 py-3">
            <!-- Display products -->
            <div class="row ml-5">

                <!-- fetching products -->

                <?php
                getProducts();
                // $ip = getIPAddress();
                // echo "Real ip address = $ip";
                display_all_products();
                get_unique_category_products();
                get_unique_brand_products();
                get_search_products();
                ?>


            </div>
        </div>

        <div class="col-md-2 bg-secondary p-0  py-md-0 py-3 ">
            <div>
                <!-- Display Brands -->
                <ul class="navbar-nav me-auto text-center order-md-2 order-1">
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white bg-dark">
                            <h4>Delivery Brands</h4>
                        </a>
                    </li>
                    <!-- Select brands from database -->
                    <?php
                    getbrand();
                    ?>
                </ul>

                <!-- Display Category -->
                <ul class="navbar-nav me-auto text-center mt-3">
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white bg-dark">
                            <h4>Categories</h4>
                        </a>
                    </li>

                    <!-- Select Category from database -->
                    <?php
                    getcategory();
                    ?>
                </ul>
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