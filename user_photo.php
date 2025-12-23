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
    <title>Change Photo - Yumna Laundry</title>
    <link rel="stylesheet" href="style.css?v=1.10">
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
                <a href="read_transaksi.php">Transactions</a>
                <a href="logout.php">Logout</a>
            </nav>
        </aside>

        <main class="content-center">
            <div class="inner-container">
                <header class="header-text">
                    <h1>CHANGE USER PHOTO</h1>
                    <p>Perbarui foto profil akun Anda</p>
                </header>

                <?php
                    include "conection.php";
                    $userid = $_SESSION['userid'];
                    $query = "SELECT * FROM pengguna WHERE id_pengguna = '$userid'";
                    $user = mysqli_query($db_conection,$query);
                    $data = mysqli_fetch_assoc($user);
                ?>

                <div class="form-container">
                    <form method="post" action="user_upload.php" enctype="multipart/form-data">
                        
                        <div class="form-group" style="text-align: center; align-items: center;">
                            <label>Current Photo</label>
                            <div style="margin: 15px 0;">
                                <img src="upload/user/<?=$data['photo']?>" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #3498db; padding: 5px;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Select New Photo</label>
                            <input type="file" name="new_photo" required style="border: 1px dashed #3498db; background: #f9f9f9;" />
                            <small style="color: #7f8c8d; margin-top: 5px;">* Format: JPG, PNG, atau GIF (Maks. 2MB)</small>
                        </div>

                        <div style="display: flex; gap: 10px; margin-top: 25px;">
                            <button type="submit" name="upload" class="btn btn-add" style="flex: 2; padding: 12px;">📤 UPLOAD PHOTO</button>
                            <a href="index.php" class="btn" style="flex: 1; background: #95a5a6; color: white; text-align: center; line-height: 24px;">CANCEL</a>
                        </div>

                        <input type="hidden" name="photo" value="<?=$data['photo']?>" />
                        <input type="hidden" name="id_pengguna" value="<?=$data['id_pengguna']?>" />
                    </form>
                </div>
            </div>
        </main>

    </div>
</body>
</html>