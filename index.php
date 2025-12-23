<?php
session_start();
include "conection.php"; 

if(!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php')</script>";
    exit;
}

$tgl = date('Y-m-d');
$q_order = mysqli_query($db_conection, "SELECT COUNT(*) as total FROM transaksi WHERE DATE(tanggal_masuk) = '$tgl'");
$d_order = mysqli_fetch_assoc($q_order);

$q_duit = mysqli_query($db_conection, "SELECT SUM(total_bayar) as total FROM transaksi WHERE DATE(tanggal_masuk) = '$tgl'");
$d_duit = mysqli_fetch_assoc($q_duit);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Yumna Laundry - Dashboard</title>
    <link rel="stylesheet" href="style.css?v=1.2">
</head>
<body>
    <div class="dashboard-wrapper">
        
        <aside class="sidebar-left">
            <div class="profile-card">
                <img src="upload/user/<?php echo $_SESSION['photo']; ?>" class="profile-img">
            </div>
            <div class="user-info">
                <p>Welcome <strong><?php echo $_SESSION['fullname']; ?></strong></p>
                <p>You are login as <strong><?php echo $_SESSION['role']; ?></strong></p>
            </div>
            <nav class="nav-links">
                <a href="user_photo.php">Change Photo</a>
                <a href="change_pw.php">Change Password</a>
                <a href="logout.php">Logout</a>
            </nav>
        </aside>

        <main class="content-center">
            <div class="inner-container">
                <header class="header-text">
                    <h1>YUMNA LAUNDRY</h1>
                    <p>bersih wangi murah</p>
                </header>

                <div class="menu-scroll">
                    <a href="read_cust.php" class="menu-item">
                        <div class="menu-icon">
                            <img src="upload/asset/1.png" alt="Customer">
                        </div>
                        <div class="menu-desc">
                            <h4>CUSTOMER LIST AND NEW TRANSACTION</h4>
                            <p>Kelola data pelanggan dan buat pesanan laundry baru.</p>
                        </div>
                    </a>

                    <a href="read_transaksi.php" class="menu-item">
                        <div class="menu-icon">
                            <img src="upload/asset/2.png" alt="Transaction">
                        </div>
                        <div class="menu-desc">
                            <h4>TRANSACTION HISTORY AND STATUS</h4>
                            <p>Lihat riwayat transaksi dan perbarui status cucian.</p>
                        </div>
                    </a>

                    <?php if($_SESSION['role'] == 'owner') { ?>
                    <a href="read_user.php" class="menu-item">
                        <div class="menu-icon">
                            <img src="upload/asset/3.png" alt="Users">
                        </div>
                        <div class="menu-desc">
                            <h4>USER MANAGEMENT</h4>
                            <p>Pengaturan akun pegawai (Kasir dan Admin).</p>
                        </div>
                    </a>

                    <a href="report.php" class="menu-item">
                        <div class="menu-icon">
                            <img src="upload/asset/4.png" alt="Report">
                        </div>
                        <div class="menu-desc">
                            <h4>MONTHLY SALES REPORT</h4>
                            <p>Ringkasan laporan pendapatan bulanan untuk Owner.</p>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </main>

        <aside class="sidebar-right">
            <div class="stat-box">
                <p>Total orderan hari ini</p>
                <h2 class="stat-number"><?php echo $d_order['total']; ?> Order</h2>
            </div>
            <div class="stat-box">
                <p>Total pendapatan hari ini</p>
                <h2 class="stat-number">Rp <?php echo number_format($d_duit['total'] ?? 0, 0, ',', '.'); ?></h2>
            </div>
        </aside>

    </div>
</body>
</html>