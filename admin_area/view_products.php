<?php require 'session_start.php'; ?>

<h3 class="text-center text-success">All Products</h3>
<table class="table table-bordered mt-5">
    <thead>
        <tr class="text-center">
            <th>Product Id</th>
            <th>Product title</th>
            <th>Product Image</th>
            <th>Product price</th>
            <th>Total sold</th>
            <th>status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $get_products = "select * from product";
        $result = $con->query($get_products);
        if ($result->num_rows > 0) {
            $i = 1;
            while ($row = $result->fetch_assoc()) {
                $product_id = $row['prod_id'];
                $product_title = $row['product_title'];
                $product_img1 = $row['product_img1'];
                $product_price = $row['product_price'];
                $status = $row['status'];
        ?>
                <tr class="text-center">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $product_title; ?></td>
                    <td><img src="prod_img/<?php echo $product_img1; ?>" class="object-fit-contain img-fluid " width="150px" height="150px"></td>
                    <td><?php echo $product_price; ?></td>
                    <td><?php
                        $get_count = "select * from order_pending where product_id=$product_id";
                        $result_count = $con->query($get_count);
                        if ($row_count = $result_count->num_rows > 0) {
                            echo $row_count;
                        } else {
                            echo 0;
                        }

                        ?></td>
                    <td><?php echo $status; ?></td>
                    <td><a href="index.php?edit_products=<?php echo $product_id; ?>" class="text-light"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a class="btn text-decoration-none text-light" data-toggle="modal" data-target="#exampleModal" href="index.php?delete_products=<?php echo $product_id; ?>" class="text-light"><i class="fa-solid fa-trash"></i></a></td>
                </tr>
        <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Are you sure you want to delete this ? </h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="index.php?view_products" class="px-3 text-decoration-none text-light">No</a></button>
                <button type="button" class="btn btn-primary"><a href="index.php?delete_products=<?php echo $product_id; ?>" class="px-3 text-decoration-none text-light"> Yes
                    </a></button>
            </div>
        </div>
    </div>
</div>