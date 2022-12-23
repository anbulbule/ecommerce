<?php
require '../includes/connect.php';
require '../functions/common_function.php';
@session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // validation for login page and its credentials
    $select_query = "select * from user_table where username='$username'";
    $result = $con->query($select_query);
    if($result->num_rows>0){
        $row_data1 = $result->fetch_assoc();
        $passwords = $row_data1['user_password'];
    }
    $user_ip = getIPAddress();

    // cart item 
    $select_cart = "select * from cart_details where ip_address = '$user_ip'";
    $result_cart = $con->query($select_cart);

    if ($row = $result->num_rows > 0) {
        $_SESSION['username'] =$username;
        $row_data2 = $result_cart->fetch_assoc();
        if (password_verify($password, $passwords)) {
            if ($result_cart->num_rows == 0 and $row == 1) {
                $_SESSION['username'] =$username;
                echo '<script> alert("You have logged in Successfully") </script>';
                echo '<script> window.open("profile.php","_self") </script>';
            }
            $_SESSION['username'] =$username;
            echo '<script> alert("You have logged in Successfully") </script>';
            echo '<script> window.open("checkout.php","_self") </script>';
        } else {
            echo '<script> alert("Invalid Password") </script>';
        }
    } else {
        echo '<script> alert("Invalid Credentials") </script>';
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <?php require '../bootstrap_links_header.php'; ?>
</head>

<body>
    <div class="container-fluid">

        <!-- form heading  -->
        <h2 class="text-center my-3">Login Form</h2>

        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" autocomplete="off" method="post">

                    <!-- username field -->
                    <div class="form-outline">
                        <label for="username" class="form-label">
                            User Name :
                        </label>
                        <input type="text" class="form-control mb-3" name="username" id="username" placeholder="Enter your username" required />
                    </div>

                    <!-- password field -->
                    <div class="form-outline">
                        <label for="password" class="form-label">
                            User Password :
                        </label>
                        <input type="password" class="form-control mb-3" name="password" id="password" placeholder="Enter your password" required />
                    </div>

                    <div class="my-3 py-2">
                        <input type="submit" name="login" class="px-5 py-2 border-0 btn bg-info" value="Login">
                        <p class="small fw-bold mt-3"> Already have an account ? <a href="user_registration.php"> Register </a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php require '../bootstrap_links_footer.php';  ?>
</body>

</html>