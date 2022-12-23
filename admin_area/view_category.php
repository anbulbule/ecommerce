<?php require 'session_start.php'; ?>

<h3 class="text-center text-success">
    All categories
</h3>
<table class="text-center mt-5 table table-bordered">
    <thead class="bg-info">
        <tr>
            <th>Sl no.</th>
            <th>Category title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="text-light bg-secondary">
        <?php
        $select_category = "select * from category";
        $result_category = $con->query($select_category);
        if ($result_category->num_rows > 0) {
            $number = 1;
            while ($row_category = $result_category->fetch_assoc()) {
                $category_id = $row_category['category_id'];
                $category_title = $row_category['category_title'];
                echo '<tr>
                        <td>'.$number.'</td>
                        <td>'.$category_title.'</td>
                        <td><a href="index.php?edit_category='.$category_id.'" class="text-light"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="index.php?delete_category='.$category_id.'" class="text-light"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>';
                $number++;
            }
        }
        ?>


    </tbody>
</table>

