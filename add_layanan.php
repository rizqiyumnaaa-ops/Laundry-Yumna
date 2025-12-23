<?php
session_start();
include "conection.php";

// Pastikan hanya owner atau role tertentu yang bisa menambah layanan jika diperlukan
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php')</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Service - Yumna Laundry</title>
    <link rel="stylesheet" href="style.css?v=2.0">
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
                <?php if($_SESSION['role'] == 'owner') { ?>
                    <a href="read_user.php">User Management</a>
                <?php } ?>
                <a href="logout.php">Logout</a>
            </nav>
        </aside>

        <main class="content-center">
            <div class="inner-container">
                <header class="header-text">
                    <h1>ADD NEW SERVICE</h1>
                    <p>Tambahkan jenis layanan laundry baru ke dalam sistem</p>
                </header>

                <div class="form-container">
                    <form method="post" action="create_layanan.php">
                        
                        <div class="form-group">
                            <label>Service Name (Nama Layanan)</label>
                            <input type="text" name="nama_layanan" placeholder="Contoh: Cuci Kering Setrika" required>
                        </div>

                        <div class="form-group">
                            <label>Price per Unit (Harga)</label>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <span style="font-weight: bold; color: #7f8c8d;">Rp</span>
                                <input type="number" name="harga_per_unit" placeholder="0" style="flex: 1;" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Unit (Satuan)</label>
                            <select name="satuan" required>
                                <option value="" disabled selected>-- Pilih Satuan --</option>
                                <option value="KG">KG (Kilogram)</option>
                                <option value="PCS">PCS (Satuan/Biji)</option>
                                <option value="SET">SET (Per Set)</option>
                                <option value="M2">M2 (Meter Persegi)</option>
                            </select>
                        </div>

                        <div style="display: flex; gap: 10px; margin-top: 25px;">
                            <button type="submit" name="save" class="btn btn-add" style="flex: 2; padding: 12px;">💾 SAVE SERVICE</button>
                            <a href="index.php" class="btn" style="flex: 1; background: #95a5a6; color: white; text-align: center; line-height: 24px;">CANCEL</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>
</body>
</html>