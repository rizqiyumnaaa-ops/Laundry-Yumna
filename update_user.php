<?php
    if (isset($_POST ['save'])) {
        include "conection.php";

        $query = "UPDATE pengguna SET
        username = '{$_POST['username']}',
        password = '{$_POST['password']}',
        role = '{$_POST['role']}', 
        full_name = '{$_POST['full_name']}'  
        WHERE id_pengguna = '{$_POST['id_pengguna']}'";
        
        $update = mysqli_query($db_conection,$query);

        if ($update) {
            echo "<script> alert('user update sucesfully !'); </script>";
        } else {
            echo "<script> alert('user update failed !'); </script>";
        }
    }
?>
<script>window.location.replace("read_user.php");</script>