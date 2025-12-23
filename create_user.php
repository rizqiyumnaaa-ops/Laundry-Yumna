<?php
    if (isset($_POST ['save'])) {
        include "conection.php";

        $password = password_hash($_POST['role'], PASSWORD_DEFAULT);

        $query = "INSERT INTO pengguna (username, password, role, full_name)
         VALUES ('{$_POST['username']}', '$password',
        '{$_POST['role']}', '{$_POST['full_name']}')"; 

        $create = mysqli_query($db_conection,$query);

        if ($create) {
            echo "<script> alert('User added sucesfully !'); </script>";
        } else {
            echo "<script> alert('User added failed !'); </script>";
        }
    }
?>
<!--p><a href="read_pet_240032.php">Back To Pets List</a></p-->
<script>window.location.replace("read_user.php");</script>