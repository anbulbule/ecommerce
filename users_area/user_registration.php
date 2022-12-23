<?php
include '../includes/connect.php';
include '../functions/common_function.php';

// <!-- Php code -->


if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $enc_password = md5($password);  // this function user for password protected
    $hash_password = password_hash($password,PASSWORD_DEFAULT);  // this function user for password protected
    $conf_password = $_POST['conf_password'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $user_ip = getIPAddress();

    // access files from form
    $img_name = $_FILES['img']['name'];
    $tmp_img_name = $_FILES['img']['tmp_name'];
    $img_size = $_FILES['img']['size'];

    $extension = pathinfo($img_name, PATHINFO_EXTENSION);
    $random = rand(0, 10000);
    $rename = 'upload' . date('ymd') . $random;
    $img = $rename . '.' . $extension;

    $imgs = move_uploaded_file($tmp_img_name, "../user_profile/" . $img);

    //Validation for user name and user email

    $select_query = "select * from user_table where username='$username' or useremail='$email'";
    $result = $con->query($select_query);
    if ($result->num_rows > 0) {
        echo "<script> alert('Username/email is already exist') </script>";
    } else if($password!= $conf_password){
        echo "<script> alert('Password is not matching') </script>";
    } else {
        // insert query
        if (
            $img_name == "" or $email == "" or $password == "" or $conf_password == "" or $address == "" or $contact == "" or
            $contact == "" or $user_ip == "" or $img == ""
        ) {
            $error = "<span class='text-danger'>* all fields are mandatory <span>";
        } else {
            $insert_query = "insert into user_table (username,useremail,user_password,user_img,user_ip,user_address,user_mobile) 
        values ('$username','$email','$hash_password','$img','$user_ip','$address',$contact)";

            $result = $con->query($insert_query);
            if ($result) {
                echo '<script>alert("Data inserted succcessfully")</script>';
            } else {
                die(mysqli_connect_error());
            }
        }
    }

    // selecting cart item to shop
    $select_cart_items= "select * from cart_details where ip_address = '$user_ip'";
    $result_cart_items = $con->query($select_cart_items);  
    if($result_cart_items->num_rows>0){
        $_SESSION['username'] =$username;
        echo '<script> alert("You have alerady items in your cart") </script>';
        echo '<script> window.open("checkout.php","_self") </script>';
    }else{
        echo '<script> window.open("../index.php","_self") </script>';
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
        <h2 class="text-center my-3">New User Registration</h2>

        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" autocomplete="off" method="post" enctype="multipart/form-data">
                    <?php if(isset($error)){echo $error;}  ?>

                    <!-- username field -->
                    <div class="form-outline">
                        <label for="username" class="form-label">
                            User Name :
                        </label>
                        <input type="text" class="form-control mb-3" name="username" id="username" placeholder="Enter your username"  />
                    </div>

                    <!-- email field -->
                    <div class="form-outline">
                        <label for="email" class="form-label">
                            User Email :
                        </label>
                        <input type="email" class="form-control mb-3" name="email" id="email" placeholder="Enter your email"  />
                    </div>

                    <!-- Image field -->
                    <div class="form-outline">
                        <label for="img" class="form-label">
                            User Image :
                        </label>
                        <input type="file" class="form-control mb-3" name="img" id="img"  />
                    </div>

                    <!-- password field -->
                    <div class="form-outline">
                        <label for="password" class="form-label">
                            User Password :
                        </label>
                        <input type="password" class="form-control mb-3" name="password" id="password" placeholder="Enter your password"  />
                    </div>

                    <!-- confirm password field -->
                    <div class="form-outline">
                        <label for="conf_password" class="form-label">
                            Confirm Password :
                        </label>
                        <input type="password" class="form-control mb-3" name="conf_password" id="conf_password" placeholder="Confirm your password"  />
                    </div>

                    <!-- Address field -->
                    <div class="form-outline">
                        <label for="address" class="form-label">
                            User Address :
                        </label>
                        <input type="text" class="form-control mb-3" name="address" id="address" placeholder="Enter your address"  />
                    </div>

                    <!-- Contact field -->
                    <div class="form-outline">
                        <label for="contact" class="form-label">
                            User contact :
                        </label>
                        <input type="number" class="form-control mb-1" name="contact" id="contact" placeholder="Enter your contact"  />
                    </div>
                    <div class="my-3 py-2">
                        <input type="submit" name="register" class="px-5 py-2 border-0 btn bg-info">
                        <p class="small fw-bold mt-3"> Already have an account ? <a href="user_login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require '../bootstrap_links_footer.php';  ?>
</body>

</html>

