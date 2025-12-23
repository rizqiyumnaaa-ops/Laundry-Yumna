<?php
    if (isset($_POST ['save'])) {
        include "conection.php";

        $query = "UPDATE customer SET
        nama_customer = '{$_POST['nama_customer']}',
        no_telepon = '{$_POST['no_telepon']}',
        alamat = '{$_POST['alamat']}' 
        WHERE id_customer = '{$_POST['id_customer']}'";
        
        $update = mysqli_query($db_conection,$query);

        if ($update) {
            echo "<script> alert('customer update sucesfully !'); </script>";
        } else {
            echo "<script> alert('customer update failed !'); </script>";
        }
    }
?>
<script>window.location.replace("read_cust.php");</script>