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
    <title>Transaction List - Yumna Laundry</title>
    <link rel="stylesheet" href="style.css?v=1.4">
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
                <a href="user_photo.php">Change Photo</a>
                <a href="logout.php">Logout</a>
            </nav>
        </aside>

        <main class="content-center">
            <div class="inner-container">
                <header class="header-text">
                    <h1>TRANSACTION HISTORY</h1>
                    <p>Pantau semua transaksi masuk dan status cucian</p>
                </header>

                <div style="margin-bottom: 20px;">
                    <a href="read_cust.php" class="btn btn-add">+ New Transaction</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Total Pay</th>
                            <th>Status</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT t.*, c.nama_customer, p.username 
                                      FROM transaksi t
                                      JOIN customer c ON t.id_customer = c.id_customer
                                      JOIN pengguna p ON t.id_kasir = p.id_pengguna
                                      ORDER BY t.tanggal_masuk DESC";
                            
                            $result = mysqli_query($db_conection, $query);
                            $no = 1;

                            while($row = mysqli_fetch_assoc($result)) {
                                // Logika untuk warna status
                                $status_class = "status-badge ";
                                if($row['status_akhir'] == 'Baru') $status_class .= "badge-new";
                                elseif($row['status_akhir'] == 'Proses') $status_class .= "badge-process";
                                elseif($row['status_akhir'] == 'Selesai') $status_class .= "badge-done";
                                else $status_class .= "badge-taken";
                        ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><small><?=date('d M Y, H:i', strtotime($row['tanggal_masuk']))?></small></td>
                            <td>
                                <strong><?=$row['nama_customer']?></strong><br>
                                <small style="color: #7f8c8d;">Kasir: <?=$row['username']?></small>
                            </td>
                            <td><strong>Rp <?=number_format($row['total_bayar'], 0, ',', '.')?></strong></td>
                            <td><span class="<?=$status_class?>"><?=$row['status_akhir']?></span></td>
                            <td align="center">
                                <div style="display: flex; gap: 5px; justify-content: center;">
                                    <a href="detail_transaksi.php?id=<?=$row['id_transaksi']?>" class="btn" style="background: #3498db; color: white;">Detail</a>
                                    <a href="edit_status.php?id=<?=$row['id_transaksi']?>" class="btn btn-edit">Update</a>
                                    <a href="print_nota.php?id=<?=$row['id_transaksi']?>" target="_blank" class="btn" style="background: #95a5a6; color: white;">Print</a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>

    </div>
</body>
</html>