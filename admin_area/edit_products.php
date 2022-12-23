<?php
require 'session_start.php';

if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products'];
    $get_products = "select * from product where prod_id='$edit_id'";
    $result = $con->query($get_products);
    if ($result->num_rows > 0) {
        $row_edit = $result->fetch_assoc();
        $category_id = $row_edit['category_id'];
        $brand_id = $row_edit['brand_id'];
        $product_img1 = $row_edit['product_img1'];
        $product_img2 = $row_edit['product_img2'];
        $product_img3 = $row_edit['product_img3'];
    }
    // <!-- Fetching category id -->

    $category_product = "select * from category where category_id='$category_id'";
    $result_category = $con->query($category_product);
    if($result_category->num_rows>0){
    $row_category = $result_category->fetch_assoc();
    $category_title = $row_category['category_title'];
    }

    // <!-- Fetching Brand id -->

    $brand_product = "select * from brands where brand_id='$brand_id'";
    $result_brand = $con->query($brand_product);
    if($result_brand->num_rows>0){
        $row_brand = $result_brand->fetch_assoc();
        $brand_title = $row_brand['brand_title'];
    }
    
}
?>
<div class="container mt-5">
    <h3 class="text-center">Edit Products</h3>
    <form action="" method="post" class="m-auto w-50" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <label class="form-label" for="product_title">product title</label>
            <input type="text" value="<?php echo $row_edit['product_title']; ?>" id="product_title" name="product_title" class="form-control" required>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="product_description">product Description</label>
            <input type="text" id="product_description" value="<?php echo $row_edit['product_description']; ?>" name="product_description" class="form-control" required>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="product_keywords">product keywords</label>
            <input type="text" id="product_keywords" name="product_keywords" value="<?php echo $row_edit['product_keywords']; ?>" class="form-control" required>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="product_keywords">product category</label>

            <select name="product_category" class="form-select">
                <option value="<?php echo $row_category['category_id']; ?>"><?php echo $category_title; ?></option>
                <?php
                $category_product = "select * from category";
                $result_category = $con->query($category_product);
                if($result_category->num_rows>0){
                    while ($row_category = $result_category->fetch_assoc()) {
                        $category_title = $row_category['category_title'];
                        echo '<option value="' . $row_category['category_id'] . '">' . $category_title . '</option>';
                    }
                }
            
                ?>
            </select>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="product_keywords">product Brands</label>
            <select name="product_brands" class="form-select">
                <option value="<?php echo $row_brand['brand_id']; ?>"><?php echo $brand_title; ?></option>
                <?php
                $brand_product = "select * from brands";
                $brand_category = $con->query($brand_product);

                if($brand_category->num_rows>0){
                    while ($row_brand = $brand_category->fetch_assoc()) {
                        $brand_title = $row_brand['brand_title'];
                        echo '<option value="' . $row_brand['brand_id'] . '">' . $brand_title . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="product_img1">product Image 1</label>
            <div class="d-flex">
                <input type="file" id="product_img1" name="product_img1" class="form-control m-auto">
                <img src="./prod_img/<?php echo $row_edit['product_img1']; ?>" class="edit-img p-2" alt="">
            </div>
        </div>
        <div class="form-outline">
            <label class="form-label" for="product_img2">product Image 2</label>
            <div class="d-flex">
                <input type="file" id="product_img2" name="product_img2" class="form-control m-auto">
                <img src="./prod_img/<?php echo $row_edit['product_img2']; ?>" class="edit-img p-2" alt="">
            </div>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="product_img3">product Image 3</label>
            <div class="d-flex">
                <input type="file" id="product_img3" name="product_img3" class="form-control m-auto">
                <img src="./prod_img/<?php echo $row_edit['product_img3']; ?>" class="edit-img p-2" alt="">
            </div>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="product_price">Product Price </label>
            <div class="d-flex">
                <input type="text" value="<?php echo $row_edit['product_price']; ?>" id="product_price" name="product_price" class="form-control m-auto" required>
            </div>
        </div>
        <div class="d-flex">
        <div class="text-center m-auto">
            <input type="submit" id="edit_product" name="edit_product" value="Update" class="px-5 btn btn-primary form-control" required>
        </div>
        <div class="text-center m-auto">
            <a href="index.php" class="btn btn-primary">Back to admin Dashboard</a>
        </div>
        </div>
    </form>
</div>

<!-- update products -->
<?php
if (isset($_POST['edit_product'])) {
    $product_id = $edit_id;
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_brands = $_POST['product_brands'];
    $product_category = $_POST['product_category'];
    $product_img1 = $_FILES['product_img1'];
    $product_img2 = $_FILES['product_img2'];
    $product_img3 = $_FILES['product_img3'];
    $product_price = $_POST['product_price'];

    $product_img1_name = $_FILES['product_img1']['name'];
    $product_tmp_img1 = $_FILES['product_img1']['tmp_name'];
    $product_img2_name = $_FILES['product_img2']['name'];
    $product_tmp_img2 = $_FILES['product_img2']['tmp_name'];
    $product_img3_name = $_FILES['product_img3']['name'];
    $product_tmp_img3 = $_FILES['product_img3']['tmp_name'];


    // // checking for fields empty or not
    // if (
    //     $product_title = '' or $product_description = '' or $product_keywords = '' or $product_keywords = '' or $product_category = ''
    //     or $product_brands = '' or $product_price = ''
    // ) {
    //     echo '<script>alert("Please fill all the fields")</script>';
    // }
    
    // first image validation
    
    if ($product_img1_name ==''){
        $edit_id = $_GET['edit_products'];
        $get_products = "select * from product where prod_id='$edit_id'";
        $result = $con->query($get_products);
        $row_edit = $result->fetch_assoc();
        $product_img1_name = $row_edit['product_img1'];
    } else {
        echo $product_img1_name = $_FILES['product_img1']['name'];
        $product_tmp_img1 = $_FILES['product_img1']['tmp_name'];
        move_uploaded_file("$product_tmp_img1", "prod_img/$product_img1_name");
    }

    // second image validation
    if ($product_img2_name ==''){
        $edit_id = $_GET['edit_products'];
        $get_products = "select * from product where prod_id='$edit_id'";
        $result = $con->query($get_products);
        $row_edit = $result->fetch_assoc();
        $product_img2_name = $row_edit['product_img2'];
    } else {
        echo $product_img2_name = $_FILES['product_img2']['name'];
        $product_tmp_img2 = $_FILES['product_img2']['tmp_name'];
        move_uploaded_file("$product_tmp_img2", "prod_img/$product_img2_name");
    }
    // third image validation 
    if ($product_img3_name ==''){
        $edit_id = $_GET['edit_products'];
        $get_products = "select * from product where prod_id='$edit_id'";
        $result = $con->query($get_products);
        $row_edit = $result->fetch_assoc();
        $product_img3_name = $row_edit['product_img3'];
    } else {
        echo $product_img3_name = $_FILES['product_img3']['name'];
        $product_tmp_img3 = $_FILES['product_img3']['tmp_name'];
        move_uploaded_file("$product_tmp_img3", "prod_img/$product_img3_name");
    }

    // Update query
    $update_query = "update product set product_title='$product_title',product_description='$product_description', category_id='$product_category', brand_id='$product_brands',
        product_keywords='$product_keywords',product_img1='$product_img1_name',product_img2='$product_img2_name',product_img3='$product_img3_name',
        product_price='$product_price',date=NOW() where prod_id='$edit_id'";
        $update_result = $con->query($update_query);
    if ($update_result) {
        echo '<script>alert("Update sucxcessfully")</script>';
        echo '<script>window.open("index.php?view_products","_self")</script>';
    }
}


?>