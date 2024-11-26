<?php 
session_start();
include 'koneksi/koneksi.php';
// MENAMPILKAN DATA PELANGGAN
$queryTampilPelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");

// JIKA BUTTON SIMPAN DI TEKAN 
if (isset($_POST['simpan'])) {
    $namaPelanggan      = $_POST['nama_pelanggan']; //mengambil dari isi name pada form
    $alamat             = $_POST['alamat'];
    $telepon            = $_POST['telepon'];
    
// TAMBAH DATA PELANGGAN
    $insertPelanggan = mysqli_query($koneksi, "INSERT INTO pelanggan (nama_pelanggan, alamat, telepon) VALUES ('$namaPelanggan', '$alamat', '$telepon')");
    header("location:pelanggan.php?tambah-pelanggan=berhasil"); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-user.css">
    <title>Sistem Laundry | Tambah Data Pelanggan</title>
</head>
    <body>
    <!-- Sidebar -->
    <?php include 'inc/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Tambah Data Pelanggan</h1>
        <div class="form-container">
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama_pelanggan">Nama Pelanggan</label>
                    <input type="text" id="nama_pelanggan" name="nama_pelanggan" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" required>
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" id="telepon" name="telepon" required>
                </div>
            </form>
            <div class="button">
                <button type="submit" name="simpan" class="btn btn-submit">Simpan</button>
                <button class="btn btn-back" onclick="history.back()">Kembali</button>
            </div>
        </div>
    </body>
</html>
