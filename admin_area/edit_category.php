<?php require '../includes/connect.php';
require 'session_start.php';

// edit query for fetching single data
if(isset($_GET['edit_category'])){
    $edit_id = $_GET['edit_category'];
    $select_query= "select * from category where category_id = $edit_id "; 
    $update_result = $con->query($select_query);
    if($update_result->num_rows>0){
        $update_row = $update_result->fetch_assoc();
        $category_title = $update_row['category_title'];
    }
}
// Update query
if(isset($_POST['update_cat'])){
    $category_title = $_POST['cat_title'];
    $update_query= "update category set category_title = '$category_title' where category_id = $edit_id "; 
    $update_results = $con->query($update_query);
    if($update_results){
        echo '<script>alert("Updated successfully")</script>';
        echo '<script>window.open("index.php?edit_category")</script>';
    }
}

?>
<h3 class="text-center"> Update Categories</h3>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" value="<?php echo $category_title ?>" name="cat_title" placeholder="Update Category" aria-label="categories"
            aria-describedby="basic-addon1" required>
    </div>
    <div class="input-group w-10 mb-2">
        <input type="submit" class="btn bg-info p-2 my-2" name="update_cat" value="Update Category">
        <!-- <button class=" btn bg-info border-0 p-2 my-2"> Insert Categories </button> -->
    </div>
</form>