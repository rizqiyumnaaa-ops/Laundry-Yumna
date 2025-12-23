<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include "conection.php"; 

if(!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php')</script>";
    exit;
}

$id = mysqli_real_escape_string($db_conection, $_GET['id']);

$query = "SELECT t.*, c.nama_customer, c.no_telepon 
          FROM transaksi t 
          JOIN customer c ON t.id_customer = c.id_customer 
          WHERE t.id_transaksi = '$id'";

$result = mysqli_query($db_conection, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data transaksi tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nota Transaksi #<?php echo $id; ?></title>
    <style>
        /* Desain khusus untuk struk belanja */
        body { 
            font-family: 'Courier New', Courier, monospace; 
            width: 300px; 
            margin: 0 auto; 
            padding: 20px;
            color: #000;
        }
        .header { text-align: center; margin-bottom: 10px; }
        .header b { font-size: 1.4rem; }
        .line { border-bottom: 1px dashed #000; margin: 10px 0; }
        .info-table, .item-table { width: 100%; font-size: 0.9rem; border-collapse: collapse; }
        .info-table td { padding: 2px 0; }
        .total-row { font-size: 1.1rem; padding-top: 10px; }
        .footer { text-align: center; margin-top: 20px; font-size: 0.8rem; }
        
        /* Tombol melayang untuk navigasi sebelum print */
        .no-print { 
            position: fixed; 
            bottom: 20px; 
            right: 20px; 
            background: #fff; 
            padding: 10px; 
            border: 1px solid #ccc; 
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn {
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-family: sans-serif;
            font-size: 14px;
            cursor: pointer;
            border: none;
        }
        .btn-print { background: #3498db; color: white; }
        .btn-back { background: #95a5a6; color: white; margin-left: 5px; }

        @media print { 
            .no-print { display: none; } 
            body { width: 100%; padding: 0; margin: 0; }
        }
    </style>
</head>
<body>
    <div class="header">
        <b>YUMNA LAUNDRY</b><br>
        <small>Bersih, Wangi, Terjangkau</small><br>
        <small>Telp: 0812-XXXX-XXXX</small>
    </div>

    <div class="line"></div>
    
    <table class="info-table">
        <tr><td>Nota</td><td>: #<?php echo $data['id_transaksi']; ?></td></tr>
        <tr><td>Tgl </td><td>: <?php echo date('d/m/Y H:i', strtotime($data['tanggal_masuk'])); ?></td></tr>
        <tr><td>Cust</td><td>: <?php echo $data['nama_customer']; ?></td></tr>
        <tr><td>Telp</td><td>: <?php echo $data['no_telepon']; ?></td></tr>
    </table>
    
    <div class="line"></div>
    
    <table class="item-table">
        <tr class="total-row">
            <td align="left"><b>TOTAL BAYAR</b></td>
            <td align="right"><b>Rp <?php echo number_format($data['total_bayar'], 0, ',', '.'); ?></b></td>
        </tr>
    </table>
    
    <div class="line"></div>
    
    <div class="footer">
        <strong>STATUS: <?php echo strtoupper($data['status_akhir']); ?></strong><br><br>
        Simpan nota ini sebagai bukti pengambilan.<br>
        --- Terima Kasih ---
    </div>

    <div class="no-print">
        <button onclick="window.print()" class="btn btn-print">Cetak Nota</button>
        <a href="read_transaksi.php" class="btn btn-back">Kembali</a>
    </div>

    <script>
        // Otomatis print saat halaman terbuka
        window.onload = function() { window.print(); }
    </script>
</body>
</html>