<?php
require 'session_start.php';
    require '../includes/connect.php';
    if(isset($_GET['delete_order'])){
        $delete_id = $_GET['delete_order'];

        $delete_query = "delete from user_orders where order_id = '$delete_id'";
        $result = $con->query($delete_query);
        if($result){
            echo '<script>alert("Delete order successfully")</script>';
            echo '<script>window.open("index.php?order_list","_self")</script>';
        }
    }
?>