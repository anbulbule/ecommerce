<?php
    try{
        if($con = new mysqli("localhost","root","","ecommerce")){
        } else{
            throw new Exception("Connection failed");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
?>