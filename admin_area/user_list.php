<?php require 'session_start.php'; ?>
<h3 class="text-center text-success">All Users</h3>
<table class="table text-center table-bordered mt-5">
    <thead class="bg-info ">
        <tr>
            <th>Sl no.</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>User Image</th>
            <th>User address</th>
            <th>User Mobile No.</th>
            <th>Delete User</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
    <?php
        $get_payment = "select * from user_table";
        $result_payment = $con->query($get_payment);
        if($result_payment->num_rows>0){
            $number=1;
            while($row_payment=$result_payment->fetch_assoc()){
                $user_id = $row_payment['user_id']; 
                $username = $row_payment['username'];
                $useremail = $row_payment['useremail'];
                $user_img = $row_payment['user_img'];
                $user_address = $row_payment['user_address'];
                $user_mobile = $row_payment['user_mobile'];
            
            echo '<tr>
            <td>'.$number.'</td>
            <td>'.$username.'</td>
            <td>'.$useremail.'</td>
            <td><img src="../user_profile/'.$user_img.'" alt="" class="img-fluid" width="100"></td>
            <td>'.$user_address.'</td>
            <td>'.$user_mobile.'</td>
            <td> <a href="delete_user.php?delete_user='.$user_id.'" class="text-light"><i class="fa-solid fa-trash"></i></a> </td>
        </tr>';
        
        $number++;
            
            }
        }else{
            echo '<h3 class="text-danger text-center mt-5">No orders yet</h3>';
        }
    ?>

        
    </tbody>
</table>

