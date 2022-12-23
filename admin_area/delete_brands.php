<?php
require 'session_start.php';
    if(isset($_GET['delete_brands'])){
        $delete_id = $_GET['delete_brands'];

        $delete_query = "delete from brands where brand_id = '$delete_id'";
        $result = $con->query($delete_query);
        if($result){
            echo '<script>alert("Delete brand successfully")</script>';
            echo '<script>window.open("index.php?view_brands","_self")</script>';
        }
    }
?>