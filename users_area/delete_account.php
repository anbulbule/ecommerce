<!-- <?php require 'session_start.php'; ?> -->
    <h3 class="text-danger mb-4">Delete Account</h3>

    <form action="" method="post" class="mt-5">
        <div class="form-outline mb-4">
            <input type="submit" name="delete" value="Delete" class=" mx-auto form-control w-50">
        </div>
        <div class="form-outline">
            <input type="submit" value="Dont Delete Account" class=" mx-auto form-control w-50" name="dont_delete">
        </div>
    </form>


    <?php
    $username_session = $_SESSION['username'];
    if(isset($_POST['delete'])){
        $delete_query= "delete from user_table where username = '$username_session'";
        $result = $con->query($delete_query);
        if($result){
            session_destroy();
            echo '<script> alert("Account deleted successfully") </script>';
            echo '<script>window.open("../index.php","_self")</script>';
        }else{
            echo '<script>window.open("profile.php","_self")</script>';
        }
    }
    $username_session = $_SESSION['username'];
    if(isset($_POST['dont_delete'])){
        echo '<script>window.open("profile.php","_self")</script>';
    }
    ?>