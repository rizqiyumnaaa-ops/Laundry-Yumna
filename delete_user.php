<?php
    if (isset($_GET ['id'])) {
        include "conection.php";

        $query = "DELETE FROM pengguna WHERE id_pengguna = '{$_GET['id']}'";
        $delete = mysqli_query($db_conection,$query);

        if ($delete) {
            echo "<script> alert('user update sucesfully !'); </script>";
        } else {
            echo "<script> alert('user update failed !'); </script>";
        }
    }
?>
<script>window.location.replace("read_user.php");</script>