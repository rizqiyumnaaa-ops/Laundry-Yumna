<?php
session_start();
include "conection.php";

if(!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php')</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Customer - Yumna Laundry</title>
    <link rel="stylesheet" href="style.css?v=1.9">
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
                <a href="logout.php">Logout</a>
            </nav>
        </aside>

        <main class="content-center">
            <div class="inner-container">
                <header class="header-text">
                    <h1>ADD NEW CUSTOMER</h1>
                    <p>Daftarkan pelanggan baru ke sistem Yumna Laundry</p>
                </header>

                <div class="form-container">
                    <form method="post" action="create_cust.php">
                        
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_customer" placeholder="Masukkan nama pelanggan..." required>
                        </div>

                        <div class="form-group">
                            <label>Nomor Telepon / WhatsApp</label>
                            <input type="text" name="no_telepon" placeholder="Contoh: 08123456789" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <textarea name="alamat" rows="4" placeholder="Masukkan alamat lengkap pelanggan..." required></textarea>
                        </div>

                        <div style="display: flex; gap: 10px; margin-top: 25px;">
                            <button type="submit" name="save" class="btn btn-add" style="flex: 2; padding: 12px;">💾 SAVE CUSTOMER</button>
                            <button type="reset" class="btn" style="flex: 1; background: #95a5a6; color: white;">RESET</button>
                        </div>
                        
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="read_cust.php" style="color: #7f8c8d; text-decoration: none; font-size: 0.9rem;">← Back to List</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>
</body>
</html>