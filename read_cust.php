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
    <title>Customer List - Yumna Laundry</title>
    <link rel="stylesheet" href="style.css?v=1.3">
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
                <a href="index.php">Dashboard</a>
                <a href="user_photo.php">Change Photo</a>
                <a href="change_pw.php">Change Password</a>
                <a href="logout.php">Logout</a>
            </nav>
        </aside>

        <main class="content-center">
            <div class="inner-container">
                <header class="header-text">
                    <h1>CUSTOMER LIST</h1>
                    <p>Kelola data pelanggan laundry Anda</p>
                </header>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; gap: 20px;">
                    <a href="add_cust.php" class="btn btn-add" style="margin-bottom: 0;">+ Add New Customer</a>
                    
                    <form method="get" action="read_cust.php" class="search-form" style="display: flex; gap: 8px;">
                        <input type="text" name="search" placeholder="Cari nama..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                        <button type="submit" class="btn" style="background: #3498db; color: white;">Cari</button>
                        <?php if(isset($_GET['search'])): ?>
                            <a href="read_cust.php" class="btn" style="background: #95a5a6; color: white;">Reset</a>
                        <?php endif; ?>
                    </form>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Customer</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Opsi</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $search = "";
                        if (isset($_GET['search'])) {
                            $search = mysqli_real_escape_string($db_conection, $_GET['search']);
                            $query = "SELECT * FROM customer WHERE nama_customer LIKE '%$search%'";
                        } else {
                            $query = "SELECT * FROM customer";
                        }
                        
                        $cust = mysqli_query($db_conection, $query);
                        $i = 1;

                        if (mysqli_num_rows($cust) > 0) {
                            while ($data = mysqli_fetch_assoc($cust)) :
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><strong><?php echo $data['nama_customer']; ?></strong></td>
                            <td><?php echo $data['no_telepon']; ?></td>
                            <td><?php echo $data['alamat'];?></td>
                            <td>
                                <a href="add_transaksi.php?id=<?=$data['id_customer']?>" class="btn" style="background: #ebf5ff; color: #3498db; font-size: 0.75rem; padding: 6px 12px;">
                                    + Transaksi Baru
                                </a>
                            </td>
                            <td align="center">
                                <div style="display: flex; gap: 5px; justify-content: center;">
                                    <a href="edit_cust.php?id=<?=$data['id_customer']?>" class="btn btn-edit">Edit</a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            endwhile; 
                        } else {
                            echo "<tr><td colspan='6' align='center' style='padding: 30px; color: #999;'>Data customer tidak ditemukan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>

    </div>
</body>
</html>