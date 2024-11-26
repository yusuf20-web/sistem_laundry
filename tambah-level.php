<?php 
session_start();
include 'koneksi/koneksi.php';
$queryTampilUser = mysqli_query($koneksi, "SELECT * FROM user");

// JIKA BUTTON SIMPAN DI TEKAN (UNTUK FILE level.php)
if (isset($_POST['simpan'])) {
    $nama     = $_POST['nama_level'];
    $queryLevel = mysqli_query($koneksi, "INSERT INTO level (nama_level) VALUES ('$nama')");
    header("location:level.php?tambah-level=berhasil"); 
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-user.css">
    <title>Sistem Laundry | Tambah Level</title>
</head>
<body>
    <!-- Sidebar -->
    <?php include 'inc/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Tambah Level User</h1>
        <div class="form-container">
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="nama">Nama Level</label>
                <input type="text" id="nama" name="nama_level" required>

                <button type="submit" class="btn btn-submit" name="simpan">Simpan</button>
            </form>
            <button class="btn btn-back" onclick="history.back()">Kembali</button>
        </div>
    </div>
</body>
</html>
