<?php require '../includes/connect.php'; 
    require 'session_start.php';
if(isset($_POST['insert_product'])){
    $prod_title = $_POST['product_title'];
    $description = $_POST['product_title'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    // accessing images
    $image1 = $_FILES['product_image1']['name'];
    $image2 = $_FILES['product_image2']['name'];
    $image3 = $_FILES['product_image3']['name'];

    // accessing img temp name
    $tmp_image1 = $_FILES['product_image1']['tmp_name'];
    $tmp_image2 = $_FILES['product_image2']['tmp_name'];
    $tmp_image3 = $_FILES['product_image3']['tmp_name'];

    // file size should be less that 1mb
    $size_image1 = $_FILES['product_image1']['size'];
    $size_image2 = $_FILES['product_image2']['size'];
    $size_image3 = $_FILES['product_image3']['size'];
    
    $extension1 = pathinfo($image1,PATHINFO_EXTENSION);
    $random1 = rand(0,10000);
    $rename1 = 'upload'.date('ymd').$random1;
    $product_image1 = $rename1.'.'.$extension1;

    $extension2 = pathinfo($image2,PATHINFO_EXTENSION);
    $random2 = rand(0,10000);
    $rename2 = 'upload'.date('ymd').$random2;
    $product_image2 = $rename2.'.'.$extension2;

    $extension3 = pathinfo($image3,PATHINFO_EXTENSION);
    $random3 = rand(0,10000);
    $rename3 = 'upload'.date('ymd').$random3;
    $product_image3 = $rename3.'.'.$extension3;

    // checking empty condition
    if($prod_title=="" or $description=="" or $product_keywords=="" or 
    $product_category=="" or $product_brands=="" or  $product_price=="" or $product_image1=="" 
    or $product_image2=="" or $product_image3=="" or $product_price==""){
        echo "<script> alert('Please fill all fields') </script>";
        exit();
    }else{

        if($size_image1 <= 1024*1024 && $size_image2 <= 1024*1024 and $size_image3 <= 1024*1024 ){

            move_uploaded_file($tmp_image1, "./prod_img/".$product_image1);
            move_uploaded_file($tmp_image2, "./prod_img/".$product_image2);
            move_uploaded_file($tmp_image3, "./prod_img/".$product_image3);

            // insert products
            $insert_product = "insert into product (product_title,product_description,product_keywords,category_id,brand_id,
            product_img1,product_img2,product_img3,product_price,date,status) values ('$prod_title','$description','$product_keywords',
            $product_category,$product_brands,'$product_image1','$product_image2','$product_image3',$product_price,now(),
            '$product_status')";
            $result_query=$con->query($insert_product);
            if($result_query){
                echo "<script> alert('successfully inserted products') </script>";
            }else{
                echo"<script> alert('failed to insert products data') </script>";
            }
        }else{
            echo "File size should be less than 1 MB";
            exit();
        }
    }

}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product-Admin Dashboard</title>
    <?php require '../Bootstrap_links_header.php'; ?>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-light">
    <div class="container prod-form shadow-lg mt-3 mb-5 rounded">
        <h1 class="text-center pt-2 mb-3">Insert Products</h1>
        <hr>
        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- prod title -->
            <div class="form-outline mb-4 m-auto">
                <label for="product_title" class="form-label">
                    Product Title :
                </label>
                <input type="text" name="product_title" id="product_title" class="form-control"
                    placeholder="Enter Product title" autocomplete="off" required>
            </div>
            <!-- prod description -->
            <div class="form-outline mb-4 m-auto ">
                <label for="description" class="form-label">
                    Product Description :
                </label>
                <input type="text" name="description" id="description" class="form-control"
                    placeholder="Enter Product Description" autocomplete="off" required>
            </div>
            <!-- prod Keywords -->
            <div class="form-outline mb-4 m-auto ">
                <label for="product_keywords" class="form-label">
                    Product Keywords :
                </label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control"
                    placeholder="Enter Product Keywords" autocomplete="off" required>
            </div>
            <!-- select category -->
            <div class="form-outline mb-4 m-auto ">
                <select name="product_category" class="form-select" id="">
                    <option value="">Select Category</option>
                    <?php  
                        $select_cat="select * from category";
                        $result_cat=$con->query($select_cat);
                        if($result_cat->num_rows>0){
                            while($row_cat=$result_cat->fetch_assoc()){
                                echo '<option value="'.$row_cat['category_id'].'">'.$row_cat['category_title'].'</option>';
                            }
                        }
                    ?>
                </select>
            </div>
            <!-- select Brands -->
            <div class="form-outline mb-4 m-auto ">
                <select name="product_brands" class="form-select" id="">
                    <option value="">Select Brands</option>
                    <?php  
                        $select_brand="select * from brands";
                        $result_brand=$con->query($select_brand);
                        if($result_brand->num_rows>0){
                            while($row_brand=$result_brand->fetch_assoc()){
                                echo '<option value="'.$row_brand['brand_id'].'">'.$row_brand['brand_title'].'</option>';
                            }
                        }
                    ?>
                </select>
            </div>
            <!-- Select Image1 -->
            <div class="form-outline mb-4 m-auto ">
                <label for="product_image1" class="form-label">
                    Product Image 1 :
                </label>
                <input type="file" name="product_image1" id="product_image1" class="form-control"
                    placeholder="Enter Product Image1" autocomplete="off" required>
            </div>
            <!-- Select Image2 -->
            <div class="form-outline mb-4 m-auto">
                <label for="product_image2" class="form-label">
                    Product Image 2 :
                </label>
                <input type="file" name="product_image2" id="product_image2" class="form-control"
                    placeholder="Enter Product Image2" autocomplete="off" required>
            </div>
            <!-- Select Image3 -->
            <div class="form-outline mb-4 m-auto">
                <label for="product_image3" class="form-label">
                    Product Image 3 :
                </label>
                <input type="file" name="product_image3" id="product_image3" class="form-control"
                    placeholder="Enter Product Image3" autocomplete="off" required>
            </div>
            <!-- prod Price -->
            <div class="form-outline mb-4 m-auto ">
                <label for="product_price" class="form-label">
                    Product Price :
                </label>
                <input type="text" name="product_price" id="product_price" class="form-control"
                    placeholder="Enter Product Price" autocomplete="off" required>
            </div>
            <!-- submit button -->
            <div class="row">
                <div class="col-4 mb-4 ">
                    <input type="submit" name="insert_product" id="insert_product" value="Insert Button"
                        class="py-2 px-4 btn btn-primary">
                </div>
                <div class="col-4 mb-4 ml-4">
                    <a href="index.php" class="py-2 px-5 btn btn-primary"> Back </a>
                </div>
            </div>
        </form>
    </div>
    <?php require '../Bootstrap_links_footer.php'; ?>
</body>

</html>