<?php
session_start();
include "conection.php";

// Keamanan: Hanya Owner yang boleh menambah user
if(!isset($_SESSION['login']) || $_SESSION['role'] !== 'owner') {
    echo "<script>alert('Akses ditolak!');window.location.replace('index.php')</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add User - Yumna Laundry</title>
    <link rel="stylesheet" href="style.css?v=2.1">
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
                <a href="read_user.php">User Management</a>
                <a href="logout.php">Logout</a>
            </nav>
        </aside>

        <main class="content-center">
            <div class="inner-container">
                <header class="header-text">
                    <h1>ADD NEW USER</h1>
                    <p>Daftarkan akun pegawai baru untuk sistem Yumna Laundry</p>
                </header>

                <div class="form-container">
                    <form method="post" action="create_user.php">
                        
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" placeholder="Masukkan username untuk login..." required>
                        </div>

                        <div class="form-group">
                            <label>Full Name (Nama Lengkap)</label>
                            <input type="text" name="full_name" placeholder="Masukkan nama lengkap pegawai..." required>
                        </div>

                        <div class="form-group">
                            <label>User Role / Type</label>
                            <div class="radio-group" style="display: flex; gap: 20px; padding: 10px 0;">
                                <label style="font-weight: normal; cursor: pointer;">
                                    <input type="radio" name="role" value="kasir" required> Kasir
                                </label>
                                <label style="font-weight: normal; cursor: pointer;">
                                    <input type="radio" name="role" value="owner" required> Owner
                                </label>
                            </div>
                            <small style="color: #7f8c8d;">* Password default biasanya diatur otomatis di sistem (misal: 123456)</small>
                        </div>

                        <div style="display: flex; gap: 10px; margin-top: 30px;">
                            <button type="submit" name="save" class="btn btn-add" style="flex: 2; padding: 12px;">💾 SAVE USER</button>
                            <button type="reset" class="btn" style="flex: 1; background: #95a5a6; color: white;">RESET</button>
                        </div>

                        <div style="text-align: center; margin-top: 20px;">
                            <a href="read_user.php" style="color: #7f8c8d; text-decoration: none; font-size: 0.9rem;">← Back to User List</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>
</body>
</html>