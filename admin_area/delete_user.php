<?php
require 'session_start.php';
    require '../includes/connect.php';
    if(isset($_GET['delete_user'])){
        $delete_id = $_GET['delete_user'];

        $delete_query = "delete from user_table where id = '$delete_id'";
        $result = $con->query($delete_query);
        if($result){
            echo '<script>alert("Delete User data successfully")</script>';
            echo '<script>window.open("index.php?user_list","_self")</script>';
        }
    }
?>