<?php
session_start();
include "conection.php";

// Keamanan: Hanya Owner yang bisa melihat laporan
if(!isset($_SESSION['login']) || $_SESSION['role'] !== 'owner') {
    echo "<script>alert('Akses ditolak!');window.location.replace('index.php')</script>";
    exit;
}

// Ambil bulan dan tahun dari form, jika tidak ada, gunakan bulan & tahun sekarang
$bulan_pilih = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun_pilih = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

// 1. Query Total Pendapatan berdasarkan bulan dan tahun yang dipilih
$query_total = mysqli_query($db_conection, "SELECT SUM(total_bayar) as total FROM transaksi 
                WHERE MONTH(tanggal_masuk) = '$bulan_pilih' AND YEAR(tanggal_masuk) = '$tahun_pilih'");
$data_total = mysqli_fetch_assoc($query_total);

// 2. Query Detail Transaksi berdasarkan bulan dan tahun yang dipilih
$query_detail = "SELECT t.id_transaksi, t.tanggal_masuk, c.nama_customer, t.total_bayar, t.status_akhir 
                 FROM transaksi t 
                 JOIN customer c ON t.id_customer = c.id_customer 
                 WHERE MONTH(t.tanggal_masuk) = '$bulan_pilih' AND YEAR(t.tanggal_masuk) = '$tahun_pilih'
                 ORDER BY t.tanggal_masuk DESC";
$result_detail = mysqli_query($db_conection, $query_detail);

// Daftar nama bulan untuk dropdown
$nama_bulan = [
    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', 
    '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', 
    '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Monthly Report - Yumna Laundry</title>
    <link rel="stylesheet" href="style.css?v=1.7">
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
                <a href="read_cust.php">Customer List</a>
                <a href="read_tansaksi.php">Transactions</a>
                <a href="read_user.php">User Management</a>
                <a href="logout.php">Logout</a>
            </nav>
        </aside>

        <main class="content-center">
            <div class="inner-container">
                <header class="header-text">
                    <h1>SALES REPORT</h1>
                    <p>Laporan Pendapatan: <?php echo $nama_bulan[$bulan_pilih] . " " . $tahun_pilih; ?></p>
                </header>

                <div class="filter-card">
                    <form method="get" action="report.php" class="filter-form">
                        <div class="filter-group">
                            <label>Pilih Bulan:</label>
                            <select name="bulan">
                                <?php foreach ($nama_bulan as $m => $nama): ?>
                                    <option value="<?php echo $m; ?>" <?php if($m == $bulan_pilih) echo 'selected'; ?>>
                                        <?php echo $nama; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Pilih Tahun:</label>
                            <select name="tahun">
                                <?php 
                                $tahun_sekarang = date('Y');
                                for($y = $tahun_sekarang; $y >= $tahun_sekarang-5; $y--): 
                                ?>
                                    <option value="<?php echo $y; ?>" <?php if($y == $tahun_pilih) echo 'selected'; ?>>
                                        <?php echo $y; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn" style="background: #3498db; color: white; margin-top: 18px;">Tampilkan Data</button>
                    </form>
                </div>

                <div class="report-summary-card">
                    <div class="report-info">
                        <span>Total Pendapatan Bulan Ini</span>
                        <h2>Rp <?php echo number_format($data_total['total'] ?? 0, 0, ',', '.'); ?></h2>
                    </div>
                    <div class="report-icon">💰</div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <h3>Detail Transaksi</h3>
                    <button onclick="window.print()" class="btn" style="background: #95a5a6; color: white;">🖨️ Print Report</button>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Tanggal</th>
                            <th>Nama Customer</th>
                            <th>Status</th>
                            <th style="text-align: right;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if (mysqli_num_rows($result_detail) > 0) {
                            while($row = mysqli_fetch_assoc($result_detail)) { 
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['tanggal_masuk'])); ?></td>
                            <td><strong><?php echo $row['nama_customer']; ?></strong></td>
                            <td><span class="status-badge badge-done"><?php echo $row['status_akhir']; ?></span></td>
                            <td style="text-align: right; font-weight: 600;">
                                Rp <?php echo number_format($row['total_bayar'], 0, ',', '.'); ?>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='5' align='center' style='padding: 30px; color: #999;'>Tidak ada transaksi di bulan ini.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>