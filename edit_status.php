<?php
session_start();
include "conection.php";

if(!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php')</script>";
    exit;
}

// Ambil data transaksi berdasarkan ID
$id_t = mysqli_real_escape_string($db_conection, $_GET['id']);
$query = "SELECT t.*, c.nama_customer FROM transaksi t 
          JOIN customer c ON t.id_customer = c.id_customer 
          WHERE t.id_transaksi='$id_t'";
$data = mysqli_fetch_assoc(mysqli_query($db_conection, $query));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Status - Yumna Laundry</title>
    <link rel="stylesheet" href="style.css?v=2.3">
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
                    <h1>UPDATE STATUS</h1>
                    <p>Perbarui status cucian untuk nota <strong>#<?php echo $id_t; ?></strong></p>
                </header>

                <div class="form-container">
                    <form method="post" action="update_status.php">
                        <input type="hidden" name="id_transaksi" value="<?=$data['id_transaksi']?>">
                        
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" value="<?=$data['nama_customer']?>" readonly style="background: #f0f4f8;">
                        </div>

                        <div class="form-group">
                            <label>Status Saat Ini</label>
                            <div style="margin-bottom: 10px;">
                                <?php 
                                    $s = $data['status_akhir'];
                                    $badge = ($s == 'SELESAI') ? 'badge-done' : (($s == 'BARU') ? 'badge-new' : 'badge-process');
                                ?>
                                <span class="status-badge <?=$badge?>"><?=$s?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Pilih Status Baru</label>
                            <select name="status_akhir" required>
                                <option value="BARU" <?=($data['status_akhir']=='BARU')?'selected':''?>>BARU</option>
                                <option value="DIPROSES" <?=($data['status_akhir']=='DIPROSES')?'selected':''?>>DIPROSES</option>
                                <option value="SIAP_AMBIL" <?=($data['status_akhir']=='SIAP_AMBIL')?'selected':''?>>SIAP AMBIL</option>
                                <option value="SELESAI" <?=($data['status_akhir']=='SELESAI')?'selected':''?>>SELESAI</option>
                            </select>
                        </div>

                        <div style="display: flex; gap: 10px; margin-top: 30px;">
                            <button type="submit" name="save" class="btn btn-add" style="flex: 2; padding: 12px;">UPDATE STATUS</button>
                            <a href="read_tansaksi.php" class="btn btn-back" style="flex: 1; text-align: center; line-height: 24px;">CANCEL</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>
</body>
</html>