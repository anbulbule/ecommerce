<?php
require '../includes/connect.php';
require '../functions/common_function.php';
require 'session_start.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap css link -->
    <?php require '../Bootstrap_links_header.php'; ?>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="nav navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid ">
                <img class="logo" src="../logo/company_logo.jpg" alt="">
                <nav class="nav navbar navbar-expand-lg navbar-light bg-info">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <h5> Welcome Guest </h5>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
        <!-- second child -->
        <div class="bg-light mt-2">
            <h3 class="text-center">
                Manage details
            </h3>
        </div>

        <!-- third child -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex">
                <div class="px-5 pt-2">
                    <a href="#">
                        <img src="../images/cookie_2.jpg" class="admin-image" alt="">
                    </a>
                    <div class="align-self-end text-white"><span>Admin Name</span></div>
                </div>
                <div class="button text-center py-3 align-self-center">
                    <button class="my-2"><a href="insert_product.php" class=" nav-link text-light bg-info my-1"> Insert Products
                        </a></button>
                    <button class="my-2"><a href="index.php?view_products" class="nav-link text-light bg-info my-1"> View Products
                        </a></button>
                    <button class="my-2"><a href="index.php?insert_category" class="nav-link text-light bg-info my-1">
                            Insert Categories
                        </a></button>
                    <button class="my-2"><a href="index.php?view_category" class="nav-link text-light bg-info my-1"> View Categories
                        </a></button>
                    <button class="my-2"><a href="index.php?insert_brand" class="nav-link text-light bg-info my-1"> Insert Brands
                        </a></button>
                    <button class="my-2"> <a href="index.php?view_brands" class="nav-link text-light bg-info my-1"> view Brands </a></button>
                    <button class="my-2"><a href="index.php?order_list" class="nav-link text-light bg-info my-1"> All Orders </a></button>
                    <button class="my-2"><a href="index.php?payment_list" class="nav-link text-light bg-info my-1"> All Payments </a></button>
                    <button class="my-2"><a href="index.php?user_list" class="nav-link text-light bg-info my-1"> User list </a></button>
                    <button class="my-2"><a href="admin_logout.php" class="nav-link text-light bg-info my-1"> Logout </a></button>
                </div>
            </div>
        </div>

        <!-- Fourth child -->
        <div class="container mt-3">
            <?php
            if(isset($_GET['insert_category'])){
                require 'insert_categories.php';
            }
            if(isset($_GET['insert_brand'])){
                require 'insert_brands.php';
            }
            if(isset($_GET['view_products'])){
                require 'view_products.php';
            }
            if(isset($_GET['edit_products'])){
                require 'edit_products.php';
            }
            if(isset($_GET['delete_products'])){
                require 'delete_products.php';
            }
            if(isset($_GET['view_category'])){
                require 'view_category.php';
            }
            if(isset($_GET['view_brands'])){
                require 'view_brands.php';
            }
            if(isset($_GET['edit_category'])){
                require 'edit_category.php';
            }
            if(isset($_GET['delete_category'])){
                require 'delete_category.php';
            }
            if(isset($_GET['edit_brands'])){
                require 'edit_brands.php';
            }
            if(isset($_GET['delete_brands'])){
                require 'delete_brands.php';
            }
            if(isset($_GET['order_list'])){
                require 'order_list.php';
            }
            if(isset($_GET['payment_list'])){
                require 'payment_list.php';
            }
            if(isset($_GET['user_list'])){
                require 'user_list.php';
            }
            if(isset($_GET['delete_user'])){
                require 'delete_user.php';
            }

        ?>
        </div>



        <!-- last child -->
        <footer class="mt-5">
            <div class="fixed-bottom bg-dark text-light d-flex align-self-center py-2">
                <marquee behavior="" direction="right">
                    <p class="m-0">All rights reserved &#169;- Designed by Abhi-2022</p>
                </marquee>
            </div>
        </footer>
        <!-- Bootstrap js link -->
        <?php require '../Bootstrap_links_footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>