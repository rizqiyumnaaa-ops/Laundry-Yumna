<?php
session_start();
include "conection.php";

if(!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php')</script>";
    exit;
}

// Ambil data customer berdasarkan ID
$id_cust = mysqli_real_escape_string($db_conection, $_GET['id']);
$query = "SELECT * FROM customer WHERE id_customer='$id_cust'";
$cust = mysqli_query($db_conection, $query);
$data = mysqli_fetch_assoc($cust);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer - Yumna Laundry</title>
    <link rel="stylesheet" href="style.css?v=2.4">
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
                    <h1>EDIT CUSTOMER</h1>
                    <p>Perbarui informasi pelanggan <strong><?=$data['nama_customer']?></strong></p>
                </header>

                <div class="form-container">
                    <form method="post" action="update_cust.php">
                        <input type="hidden" name="id_customer" value="<?=$data['id_customer']?>">
                        
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_customer" value="<?=$data['nama_customer']?>" placeholder="Masukkan nama pelanggan..." required>
                        </div>

                        <div class="form-group">
                            <label>Nomor Telepon / WhatsApp</label>
                            <input type="text" name="no_telepon" value="<?=$data['no_telepon']?>" placeholder="Contoh: 08123456789" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <textarea name="alamat" rows="4" placeholder="Masukkan alamat lengkap..." required><?=$data['alamat']?></textarea>
                        </div>

                        <div style="display: flex; gap: 10px; margin-top: 25px;">
                            <button type="submit" name="save" class="btn btn-add" style="flex: 2; padding: 12px; background: #3498db;">💾 UPDATE DATA</button>
                            <a href="read_cust.php" class="btn btn-back" style="flex: 1; text-align: center; line-height: 24px;">CANCEL</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>
</body>
</html>