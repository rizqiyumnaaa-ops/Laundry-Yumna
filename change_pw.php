<?php 
session_start();
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php')</script>";
    exit;
}
?>
<!doctype html>
<html>
<head>
    <title>Change Password - Yumna Laundry</title>
    <link rel="stylesheet" href="style.css?v=2.5">
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
                <a href="user_photo.php">Change Photo</a>
                <a href="logout.php">Logout</a>
            </nav>
        </aside>

        <main class="content-center">
            <div class="inner-container">
                <header class="header-text">
                    <h1>SECURITY SETTINGS</h1>
                    <p>Perbarui kata sandi akun Anda secara berkala</p>
                </header>

                <div class="form-container">
                    <form method="post" action="update_pw.php">
                        
                        <div class="form-group">
                            <label>New Password (Kata Sandi Baru)</label>
                            <input type="password" name="new_password" id="new" placeholder="Masukkan password baru..." required>
                        </div>

                        <div class="checkbox-container" style="display: flex; align-items: center; gap: 8px; margin-bottom: 20px;">
                            <input type="checkbox" id="show-pw" onclick="show()" style="width: 18px; height: 18px; cursor: pointer;"> 
                            <label for="show-pw" style="cursor: pointer; font-size: 0.9rem; color: #7f8c8d;">Show Password</label>
                        </div>

                        <div style="display: flex; gap: 10px; margin-top: 25px;">
                            <button type="submit" name="change" class="btn btn-add" style="flex: 2; padding: 12px; background: #e74c3c;">CHANGE PASSWORD</button>
                            <a href="index.php" class="btn" style="flex: 1; background: #95a5a6; color: white; text-align: center; line-height: 24px;">CANCEL</a>
                        </div>

                    </form>
                </div>
            </div>
        </main>

    </div>

    <script>
    function show() {
        var x = document.getElementById("new");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>
</body>
</html>