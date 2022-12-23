<?php  require 'session_start.php'; ?>
<h3 class="text-center text-success">
    All Brands
</h3>
<table class="text-center mt-5 table table-bordered">
    <thead class="bg-info">
        <tr>
            <th>Sl no.</th>
            <th>Brand title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="text-light bg-secondary">
        <?php
        $select_brands = "select * from brands";
        $result_brands = $con->query($select_brands);
        if ($result_brands->num_rows > 0) {
            $number = 1;
            while ($row_brands = $result_brands->fetch_assoc()) {
                $brands_id = $row_brands['brand_id'];
                $brands_title = $row_brands['brand_title'];
                echo '<tr>
                        <td>'.$number.'</td>
                        <td>'.$brands_title.'</td>
                        <td><a href="index.php?edit_brands='.$brands_id.'" class="text-light"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="index.php?delete_brands='.$brands_id.'" class="text-light"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>';
                $number++;
            }
        }
        ?>


    </tbody>
</table>