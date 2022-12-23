<?php require '../includes/connect.php';
require 'session_start.php';

// edit query for fetching single data
if(isset($_GET['edit_brands'])){
    $edit_id = $_GET['edit_brands'];
    $select_query= "select * from brands where brand_id = $edit_id "; 
    $update_result = $con->query($select_query);
    if($update_result->num_rows>0){
        $update_row = $update_result->fetch_assoc();
        $brand_title = $update_row['brand_title'];
    }
}
// Update query
if(isset($_POST['update_brand'])){
    $edit_id = $_GET['edit_brands'];
    $brand_title = $_POST['brand_title'];
    $update_query= "update brands set brand_title='$brand_title' where brand_id = $edit_id "; 
    $update_results= $con->query($update_query);
    if($update_results){
        echo '<script>alert("Updated successfully")</script>';
        echo '<script>window.open("index.php?view_brands","_self")</script>';
    }
}

?>
<h3 class="text-center"> Update Brands</h3>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" value="<?php echo $brand_title; ?>" name="brand_title" placeholder="Update Brands" aria-label="brands"
            aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2">
        <input type="submit" class="btn bg-info" name="update_brand" value="Update Brands">
    </div>
</form>