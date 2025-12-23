<?php
session_start();
include "conection.php";

// Keamanan tambahan: Hanya owner yang boleh akses halaman ini
if(!isset($_SESSION['login']) || $_SESSION['role'] !== 'owner') {
    echo "<script>alert('Akses ditolak! Hanya Owner yang boleh mengelola user.');window.location.replace('index.php')</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Management - Yumna Laundry</title>
    <link rel="stylesheet" href="style.css?v=1.5">
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
                <a href="read_cust.php">Customer List</a>
                <a href="read_tansaksi.php">Transactions</a>
                <a href="logout.php">Logout</a>
            </nav>
        </aside>

        <main class="content-center">
            <div class="inner-container">
                <header class="header-text">
                    <h1>USER MANAGEMENT</h1>
                    <p>Kelola akun pegawai dan hak akses sistem</p>
                </header>

                <div style="margin-bottom: 20px;">
                    <a href="add_user.php" class="btn btn-add">+ Add New User</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM pengguna";
                        $users = mysqli_query($db_conection, $query);
                        $i = 1;
                        foreach ($users as $data) :
                            // Warna badge berdasarkan role
                            $role_class = ($data['role'] == 'owner') ? 'badge-owner' : 'badge-staff';
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><strong><?php echo $data['username']; ?></strong></td>
                            <td><?php echo $data['full_name']; ?></td>
                            <td><span class="badge-role <?php echo $role_class; ?>"><?php echo $data['role']; ?></span></td>
                            <td align="center">
                                <div style="display: flex; gap: 5px; justify-content: center;">
                                    <a href="edit_user.php?id=<?=$data['id_pengguna']?>" class="btn btn-edit">Edit</a>
                                    
                                    <a href="reset_password_240032.php?id=<?=$data['id_pengguna']?>&type=<?=$data['role'];?>" 
                                       class="btn" style="background: #3498db; color: white; font-size: 0.75rem;" 
                                       onclick="return confirm('Yakin ingin reset password user ini?')">Reset PW</a>

                                    <a href="delete_user.php?id=<?=$data['id_pengguna']?>" 
                                       class="btn btn-delete" 
                                       onclick="return confirm('Hapus user ini?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>

    </div>
</body>
</html>