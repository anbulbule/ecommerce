<!-- Connection file -->
<?php
require '../includes/connect.php';
require '../functions/common_function.php';
session_start();
// require 'session_start.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php if (isset($_SESSION['username'])) {
                        echo $_SESSION['username'];
                    } else {
                        echo 'Guest';
                    } ?></title>
    <link rel="stylesheet" href="../css/style.css">
    <?php require '../Bootstrap_links_header.php'; ?>
    <style>
        .logo {
            width: 200px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../logo/company_logo.jpg" alt="" class="rounded logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php?products">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart.php"><i class="fa-sharp fa-solid fa-cart-shopping"></i>
                                <sup><?php show_cart_item(); ?></sup>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price : <?php total_cart_price(); ?>/-</a>
                        </li>
                    </ul>
                    <form action="" method="get" class="d-flex" role="search">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
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
            if (isset($_SESSION['username'])) {
                echo ' <li class="nav-item ">
                    <a class="nav-link text-decoration-none text-white" href="">' . $_SESSION['username'] . '</a>
                </li>';
            } else {
                echo ' <li class="nav-item ">
                    <a class="nav-link text-decoration-none text-white" href="">Welcome Guest</a>
                </li>';
            }

            if (!isset($_SESSION['username'])) {
                echo ' <li class="nav-item ">
                    <a class="nav-link text-decoration-none text-white" href="user_login.php">Login</a>
                </li>';
            } else {
                echo ' <li class="nav-item ">
                    <a class="nav-link text-decoration-none text-white" href="user_logout.php">Logout</a>
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
    <div class="row bg-light text-center ">
        <div class="col-md-2 profile py-md-0 py-3 bg-secondary">
            <!-- Display products -->
            <ul class="navbar-nav " style="height:100vh">
                <li class="nav-item">
                    <a class="mt-2 nav-link text-light text-align-center" href="">
                        <h4>Your profile</h4>
                    </a>
                </li>
                <?php
                $username = $_SESSION['username'];
                $user_query = "select * from user_table where username = '$username'";
                $result_img = $con->query($user_query);
                $row_img = $result_img->fetch_assoc();
                $user_img = $row_img['user_img'];

                ?>
                <li class='nav-item px-2 mb-4'>
                    <img src='../user_profile/<?php echo $user_img ?>' class='profile_img'>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php">
                        Pending Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php?edit_account">
                        Edit Account
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php?my_orders">
                        My Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php?delete_account">
                        Delete Account
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="user_logout.php">
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <div class="col-md-10 py-3 p-0">
            <div class="container-fluid ">
                <div>
                    <?php get_search_products();
                    user_order_details();
                    if (isset($_GET['edit_account'])) {
                        require 'edit_account.php';
                    }

                    if (isset($_GET['my_orders'])) {
                        include 'user_order.php';
                    }
                    if (isset($_GET['delete_account'])) {
                        include 'delete_account.php';
                    }
                    ?>
                </div>
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
    <?php require '../Bootstrap_links_footer.php'; ?>
</body>

</html>