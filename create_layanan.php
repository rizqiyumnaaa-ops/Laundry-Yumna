<?php
    if (isset($_POST['save'])) {
        include "conection.php";

        // Mengambil data dari form sesuai kolom di tabel layanan
        $nama_layanan = $_POST['nama_layanan'];
        $harga = $_POST['harga_per_unit'];
        $satuan = $_POST['satuan'];

        $query = "INSERT INTO layanan (nama_layanan, harga_per_unit, satuan) 
                  VALUES ('$nama_layanan', '$harga', '$satuan')"; 

        $create = mysqli_query($db_conection, $query);

        if ($create) {
            echo "<script> alert('Service added successfully!'); </script>";
        } else {
            echo "<script> alert('Service added failed!'); </script>";
        }
    }
?>
<script>window.location.replace("index.php");</script>