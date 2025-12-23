<?php
    if (isset($_POST['save'])) {
        include "conection.php"; // Pastikan nama file koneksi Anda benar

        // Menangkap data dari form edit_status.php
        $id = $_POST['id_transaksi'];
        $status = $_POST['status_akhir'];

        // Query update status pada tabel transaksi
        $query = "UPDATE transaksi SET status_akhir = '$status' WHERE id_transaksi = '$id'";
        
        $update = mysqli_query($db_conection, $query);

        if ($update) {
            echo "<script> alert('Transaction status updated successfully!'); </script>";
        } else {
            echo "<script> alert('Failed to update status!'); </script>";
        }
    }
?>
<script>window.location.replace("read_transaksi.php");</script>