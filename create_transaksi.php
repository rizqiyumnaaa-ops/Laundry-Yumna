<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
if (isset($_POST['save'])) {
    include "conection.php";
    
    $tgl = date("Y-m-d H:i:s");
    $id_cust = $_POST['id_customer'];
    $id_kasir = $_SESSION['userid']; // Diambil dari session login
    $total = $_POST['total_bayar'];
    $id_layanan = $_POST['id_layanan'];
    $berat = $_POST['berat_qty'];

    // 1. Insert ke tabel TRANSAKSI
    $query1 = "INSERT INTO TRANSAKSI (tanggal_masuk, id_customer, id_kasir, status_akhir, total_bayar) 
               VALUES ('$tgl', '$id_cust', '$id_kasir', 'BARU', '$total')";
    
    if (mysqli_query($db_conection, $query1)) {
        $id_transaksi_baru = mysqli_insert_id($db_conection);

        // 2. Insert ke tabel DETAIL_TRANSAKSI
        $query2 = "INSERT INTO DETAIL_TRANSAKSI (id_transaksi, id_layanan, berat_qty, subtotal) 
                   VALUES ('$id_transaksi_baru', '$id_layanan', '$berat', '$total')";
        mysqli_query($db_conection, $query2);

        echo "<script>alert('Transaksi Berhasil Disimpan!'); window.location.replace('read_transaksi.php');</script>";
    } else {
        echo "<script>alert('Gagal menyimpan transaksi!'); window.history.back();</script>";
    }
}
?>