<?php
session_start();
include "conection.php";

if(!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php')</script>";
    exit;
}

// Ambil ID Transaksi dari URL
$id_t = mysqli_real_escape_string($db_conection, $_GET['id']);

// Query untuk mengambil informasi utama transaksi (Nama Customer & Tanggal)
$query_info = "SELECT t.tanggal_masuk, c.nama_customer 
               FROM transaksi t 
               JOIN customer c ON t.id_customer = c.id_customer 
               WHERE t.id_transaksi = '$id_t'";
$res_info = mysqli_query($db_conection, $query_info);
$info = mysqli_fetch_assoc($res_info);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transaction Detail - Yumna Laundry</title>
    <link rel="stylesheet" href="style.css?v=2.2">
</head>
<body>
    <div class="dashboard-wrapper">
        
        <aside class="sidebar-left">
            <div class="profile-card">
                <img src="upload/user/<?php echo $_SESSION['photo']; ?>" class="profile-img">
            </div>
            <div class="user-info">
                <p>Welcome <strong><?php echo $_SESSION['fullname']; ?></strong></p>
                <p>Role: <strong><?php echo $_SESSION['role']; ?></strong></p>
            </div>
            <nav class="nav-links">
                <a href="index.php">Dashboard</a>
                <a href="read_tansaksi.php">Transactions History</a>
                <a href="logout.php">Logout</a>
            </nav>
        </aside>

        <main class="content-center">
            <div class="inner-container">
                <header class="header-text">
                    <h1>TRANSACTION DETAIL</h1>
                    <p>Rincian pesanan untuk Nota <strong>#<?php echo $id_t; ?></strong></p>
                </header>

                <div style="background: white; padding: 20px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; justify-content: space-between;">
                    <div>
                        <span style="color: #7f8c8d; font-size: 0.85rem; text-transform: uppercase;">Customer</span>
                        <h3 style="color: #2c3e50;"><?php echo $info['nama_customer']; ?></h3>
                    </div>
                    <div style="text-align: right;">
                        <span style="color: #7f8c8d; font-size: 0.85rem; text-transform: uppercase;">Tanggal Masuk</span>
                        <h3 style="color: #2c3e50;"><?php echo date('d M Y, H:i', strtotime($info['tanggal_masuk'])); ?></h3>
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Service Name</th>
                            <th style="text-align: center;">Weight/Qty</th>
                            <th style="text-align: right;">Price/Unit</th>
                            <th style="text-align: right;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT dt.*, l.nama_layanan, l.harga_per_unit 
                                      FROM detail_transaksi dt 
                                      JOIN layanan l ON dt.id_layanan = l.id_layanan 
                                      WHERE dt.id_transaksi = '$id_t'";
                            
                            $result = mysqli_query($db_conection, $query);
                            $total_akhir = 0;
                            
                            while($data = mysqli_fetch_assoc($result)) {
                                $total_akhir += $data['subtotal'];
                        ?>
                        <tr>
                            <td><strong><?=$data['nama_layanan']?></strong></td>
                            <td align="center"><?=$data['berat_qty']?></td>
                            <td align="right">Rp <?=number_format($data['harga_per_unit'], 0, ',', '.')?></td>
                            <td align="right" style="font-weight: 600;">Rp <?=number_format($data['subtotal'], 0, ',', '.')?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr style="background: #f8fafc;">
                            <td colspan="3" align="right" style="padding: 20px; font-weight: bold; text-transform: uppercase;">Total Pembayaran</td>
                            <td align="right" style="padding: 20px; font-size: 1.2rem; color: #2ecc71; font-weight: bold;">
                                Rp <?=number_format($total_akhir, 0, ',', '.')?>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <div style="margin-top: 30px; display: flex; gap: 10px;">
                    <a href="read_transaksi.php" class="btn btn-back">← Back to List</a>
                    <a href="print_nota.php?id=<?=$id_t?>" target="_blank" class="btn" style="background: #3498db; color: white;">🖨️ Print Nota</a>
                </div>
            </div>
        </main>

    </div>
</body>
</html>