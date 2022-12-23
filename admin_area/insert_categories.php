<?php require '../includes/connect.php';
require 'session_start.php';

if (isset($_POST['insert_cat'])) {
    $cat_title = $_POST['cat_title'];

    // Select query
    $select_query = "select * from category where category_title='$cat_title'";
    $result_select = $con->query($select_query);
    if ($result_select->num_rows > 0) {
        echo "<script> alert('Category title is already exist') </script>";
    } else {
        // Insert Query
        $insert_query = "insert into category(category_title) values('$cat_title')";
        $result = $con->query("$insert_query");
        if ($result) {
            echo "<script> alert('category has been inserted succeesfully') </script>";
        } else {
            echo "<script> alert('Failed to insert category') </script>";
        }
    }
}

?>
<h3 class="text-center"> Insert Categories</h3>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert Category" aria-label="categories"
            aria-describedby="basic-addon1" required>
    </div>
    <div class="input-group w-10 mb-2">
        <input type="submit" class="btn bg-info p-2 my-2" name="insert_cat" value="Insert Categories">
        <!-- <button class=" btn bg-info border-0 p-2 my-2"> Insert Categories </button> -->
    </div>
</form>