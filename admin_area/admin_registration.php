<?php
include '../includes/connect.php';
include '../functions/common_function.php';
// <!-- Php code -->


if (isset($_POST['admin_registration'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $enc_password = md5($password);  // this function user for password protected
    // var_dump($enc_password);die();
    // $hash_password = password_hash($password,PASSWORD_DEFAULT);  // this function user for password protected
    $conf_password = $_POST['conf_password'];


    //Validation for user name and user email

    $select_query = "select * from admin_table where admin_name='$username' or admin_email='$email'";
    $result = $con->query($select_query);
    if ($result->num_rows > 0) {
        echo "<script> alert('Username/email is already exist') </script>";
    } else if($password!= $conf_password){
        echo "<script> alert('Password is not matching') </script>";
    } else {
        // insert query
        if (
            $username == "" or $email == "" or $password == "" or $conf_password == ""
        ) {
            $error = "<span class='text-danger'>* all fields are mandatory <span>";
        } else {
            $insert_query = "insert into admin_table (admin_name,admin_email,admin_password) 
        values ('$username','$email','$enc_password')";

            $result = $con->query($insert_query);
            if ($result) {
                echo '<script>alert("Data inserted succcessfully")</script>';
            } else {
                die(mysqli_connect_error());
            }
        }
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
        <h2 class="text-center mb-5">Admin Registration</h2>
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
                        <label for="useremail">User Email :</label>
                        <input type="email" class="form-control mt-2" id="useremail" name="email" placeholder="Enter Your Email" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password">User Password :</label>
                        <input type="password" class="form-control mt-2" id="password" name="password" placeholder="Enter Your passowrd" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="conf_password">Confirm Password :</label>
                        <input type="password" class="form-control mt-2" id="conf_password" name="conf_password" placeholder="Confirm Your passowrd" required>
                    </div>
                    <div class="form-outline mt-2 mb-4">
                        <input type="submit" class="mb-2 btn bg-info px-5" value="register" name="admin_registration" required>
                        <p><small class="fw-bold mt-3 ">Do you have an account?&nbsp; <a class="link-danger" href="admin_login.php">Login</a></small></p>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>

</html>