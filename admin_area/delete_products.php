<?php
require 'session_start.php';
    if(isset($_GET['delete_products'])){
        $delete_id = $_GET['delete_products'];

        $delete_query = "delete from product where prod_id = '$delete_id'";
        $result = $con->query($delete_query);
        if($result){
            echo '<script>alert("Delete product successfully")</script>';
            echo '<script>window.open("index.php?view_products","_self")</script>';
        }
    }
?>