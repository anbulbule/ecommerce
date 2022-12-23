
<?php
require '../includes/connect.php';
require '../functions/common_function.php';
session_start();
if (isset($_POST['admin_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $enc_password = md5($password);

    // validation for login page and its credentials
    $select_query = "select * from admin_table where admin_name='$username'";
    $result = $con->query($select_query);
    if($result->num_rows>0){
        $row_data1 = $result->fetch_assoc();
        $passwords = $row_data1['admin_password'];
        $admin_id = $row_data1['admin_id'];
        if($enc_password == "$passwords"){
            echo '<script>alert("Admin loggd in successfully")</script>';
            $_SESSION['username']=$username;
            $_SESSION['admin_id']=$admin_id;
            echo '<script>window.open("index.php","_self")</script>';
        }else{
            echo '<script>alert("Please enter valid password")</script>';
        }
    }else{
        echo '<script>alert("Please enter valid credential")</script>';
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <?php require '../Bootstrap_links_header.php'; ?>
    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex mt-3 justify-content-around m-auto">
            <div class="col-lg-6 col-xl-4">
                <img src="../images/fruit_1.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username">User Name :</label>
                        <input type="text" class="form-control mt-2" id="username" name="username" placeholder="Enter Your name" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password">User Password :</label>
                        <input type="password" class="form-control mt-2" id="password" name="password" placeholder="Enter Your passowrd" required>
                    </div>
                    <div class="form-outline mt-2 mb-4">
                        <input type="submit" class="mb-2 btn bg-info px-5" value="login" name="admin_login" required>
                        <p><small class="fw-bold mt-3 ">Don't you have an account?&nbsp; <a class="link-danger" href="admin_registration.php">Register</a></small></p>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>

</html>