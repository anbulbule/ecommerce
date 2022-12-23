<?php
require 'session_start.php';
if (isset($_GET['edit_account'])) {
    $username = $_SESSION['username'];
    $select_query = "select * from user_table where username='$username'";
    $result_query = $con->query($select_query);
    $row = $result_query->fetch_assoc();
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_email = $row['useremail'];
    $user_address = $row['user_address'];
    $user_mobile = $row['user_mobile'];
    $user_old_img = $row['user_img'];

    if (isset($_POST['update'])) {
        $user_id = $user_id;
        $username = $_POST['username'];
        $user_email = $_POST['email'];
        $user_address = $_POST['address'];
        $user_mobile = $_POST['user_mobile'];

        if ($_FILES['user_img_name'] != '') {
            $user_img_name = $_FILES['user_img_name']['name'];
            $user_tmp_img = $_FILES['user_img_name']['tmp_name'];
            move_uploaded_file($user_tmp_img, "../user_profile/$user_img_name");
        } else {
            $user_img_name = $row['user_img'];
        }



        // update query 
        $update_query = "update user_table set username='$username',useremail='$user_email',user_img='$user_img_name',user_mobile='$user_mobile' 
        where user_id= $user_id";
        $result_query = $con->query($update_query);
        if ($result_query) {
            echo '<script> alert("data updated successfully") </script>';
            echo "<script> window.open('user_logout.php','_self') </script>";
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
    <title>Edit account</title>
</head>

<body>
    <h3 class="text-success mb-4"> Edit Account </h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $username ?>" name="username"
                placeholder="Enter your User Name">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" name="email" value="<?php echo $user_email ?>"
                placeholder="Enter Your Email">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control m-auto" name="user_img_name" placeholder="Upload your profile pic">
            <img src="../user_profile/<?php echo $user_img; ?>" width=100px>
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="address" value="<?php echo $user_address ?>"
                placeholder="Enter your Address">
        </div>
        <div class="form-outline mb-4">
            <input type="number" class="form-control w-50 m-auto" name="user_mobile" value="<?php echo $user_mobile ?>"
                placeholder="Update your mobile number">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" class="btn btn-primary py-2 px-5 m-auto" name="update">
        </div>
    </form>

</body>

</html>