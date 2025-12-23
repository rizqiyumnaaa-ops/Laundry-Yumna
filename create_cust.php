<?php
    if (isset($_POST ['save'])) {
        include "conection.php";

        $query = "INSERT INTO customer (nama_customer, no_telepon, alamat) 
        VALUES ('{$_POST['nama_customer']}', '{$_POST['no_telepon']}',
        '{$_POST['alamat']}')"; 

        $create = mysqli_query($db_conection,$query);

        if ($create) {
            echo "<script> alert('Customer added sucesfully !'); </script>";
        } else {
            echo "<script> alert('Customer added failed !'); </script>";
        }
    }
?>
<!--p><a href="read_pet_240032.php">Back To Pets List</a></p-->
<script>window.location.replace("read_cust.php");</script>