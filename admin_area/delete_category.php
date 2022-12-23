<?php
require 'session_start.php';
    if(isset($_GET['delete_category'])){
        $delete_id = $_GET['delete_category'];

        $delete_query = "delete from category where category_id = '$delete_id'";
        $result = $con->query($delete_query);
        if($result){
            echo '<script>alert("Delete category successfully")</script>';
            echo '<script>window.open("index.php?view_category","_self")</script>';
        }
    }
?>