<?php
require 'session_start.php';
    require '../includes/connect.php';
    if(isset($_GET['delete_payment'])){
        $delete_id = $_GET['delete_payment'];

        $delete_query = "delete from user_payment where id = '$delete_id'";
        $result = $con->query($delete_query);
        if($result){
            echo '<script>alert("Delete payment data successfully")</script>';
            echo '<script>window.open("index.php?payment_list","_self")</script>';
        }
    }
?>