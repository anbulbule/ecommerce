<?php require '../includes/connect.php';
require 'session_start.php';
if (isset($_POST['insert_brand'])) {
    $brand_title = $_POST['brand_title'];

    // Select query
    $select_query = "select * from brands where brand_title='$brand_title'";
    $result_select = $con->query($select_query);
    if ($result_select->num_rows > 0) {
        echo "<script> alert('$brand_title is already exist') </script>";
    } else {
        // Insert Query
        $insert_query = "insert into brands(brand_title) values('$brand_title')";
        $result = $con->query($insert_query);
        if ($result) {
            echo "<script> alert('$brand_title has been inserted succeesfully') </script>";
        } else {
            echo "<script> alert('Failed to insert $brand_title') </script>";
        }
    }
}


?>
<h3 class="text-center"> Insert Brands</h3>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands" aria-label="brands"
            aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2">
        <input type="submit" class="btn bg-info" name="insert_brand" value="Insert Brands">
    </div>
</form>