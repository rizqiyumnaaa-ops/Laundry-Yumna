<?php
session_start();
include "conection.php";

if(!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php')</script>";
    exit;
}

// Ambil data customer berdasarkan ID dari URL
$id_cust = mysqli_real_escape_string($db_conection, $_GET['id']);
$querycust = "SELECT * FROM customer WHERE id_customer='$id_cust'";
$customer = mysqli_query($db_conection, $querycust);
$data_cust = mysqli_fetch_assoc($customer);

// Ambil daftar layanan dari database
$querylayanan = "SELECT * FROM layanan";
$layanan = mysqli_query($db_conection, $querylayanan);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Transaction - Yumna Laundry</title>
    <link rel="stylesheet" href="style.css?v=1.8">
    <script>
        function hitungTotal() {
            var layanan = document.getElementById("layanan");
            var harga = layanan.options[layanan.selectedIndex].getAttribute("data-harga");
            var berat = parseFloat(document.getElementById("berat").value);
            
            if (berat > 0 && harga > 0) {
                var total = berat * harga;
                document.getElementById("total_display").value = "Rp " + total.toLocaleString('id-ID');
                document.getElementById("total_bayar").value = total;
            } else {
                document.getElementById("total_display").value = "Rp 0";
                document.getElementById("total_bayar").value = 0;
            }
        }
    </script>
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
                    <h1>NEW TRANSACTION</h1>
                    <p>Membuat pesanan laundry untuk <strong><?=$data_cust['nama_customer']?></strong></p>
                </header>

                <div class="form-container">
                    <form method="post" action="create_transaksi.php">
                        <input type="hidden" name="id_customer" value="<?=$data_cust['id_customer']?>">
                        
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" value="<?=$data_cust['nama_customer']?>" readonly style="background-color: #f0f4f8;">
                        </div>

                        <div class="form-group">
                            <label>Pilih Layanan</label>
                            <select name="id_layanan" id="layanan" onchange="hitungTotal()" required>
                                <option value="" data-harga="0">-- Pilih Layanan --</option>
                                <?php while($row = mysqli_fetch_assoc($layanan)) { ?>
                                    <option value="<?=$row['id_layanan']?>" data-harga="<?=$row['harga_per_unit']?>">
                                        <?=$row['nama_layanan']?> (Rp <?=number_format($row['harga_per_unit'], 0, ',', '.')?>/<?=$row['satuan']?>)
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Berat / Qty</label>
                            <input type="number" name="berat_qty" id="berat" step="0.01" oninput="hitungTotal()" placeholder="0.00" required>
                        </div>

                        <div class="form-group">
                            <label>Total Bayar</label>
                            <input type="text" id="total_display" value="Rp 0" readonly style="font-weight: bold; color: #2ecc71; font-size: 1.2rem; background-color: #f9f9f9;">
                            <input type="hidden" name="total_bayar" id="total_bayar">
                        </div>

                        <div style="display: flex; gap: 10px; margin-top: 20px;">
                            <button type="submit" name="save" class="btn btn-add" style="flex: 2; padding: 15px;">💾 SAVE TRANSACTION</button>
                            <a href="read_cust.php" class="btn btn-back" style="flex: 1; padding: 15px; text-align: center;">CANCEL</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>
</body>
</html>