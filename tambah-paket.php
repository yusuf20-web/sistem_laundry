<?php
session_start();
include 'koneksi/koneksi.php';

// MEMBUAT AKSI UNTUK TAMBAH DATA PAKET

if (isset($_POST['simpan'])) {
    $namaPaket      = $_POST['nama_paket'];
    $harga          = $_POST['harga'];
    $keterangan     = $_POST['keterangan'];

    // QUERY UNTUK INSERT DATA PAKET
    $queryPaket = mysqli_query($koneksi, "INSERT INTO paket (nama_paket, harga, keterangan) VALUES ('$namaPaket', '$harga', '$keterangan')");

    // MENAMPILKAN PESAN KE USER UNTUK MENAMPILKAN NOTIFIKASI
    header("location: paket.php?tambah-paket=berhasil");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-user.css">
    <title>Sistem Laundry | Tambah Paket</title>
</head>
    <body>
<!-- sidebar -->
<?php include 'inc/sidebar.php'; ?>

<!-- FORM UNTUK TAMBAH PAKET -->
        <div class="main-content">
            <h1>Tambah Paket</h1>
            <div class="form-container">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nama_paket">Nama Paket</label>
                        <input type="text" id="nama_paket" name="nama_paket" placeholder="Masukan nama paket" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" id="harga" name="harga" placeholder="Masukan harga paket" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" id="keterangan" name="keterangan" placeholder="Masukan keterangan" required>
                    </div>
                        <button class="btn btn-submit" type="submit" name="simpan">Simpan</button>
                        <button class="btn btn-back" onclick="history.back()" name="kembali">Kembali</button>
                </form>
            </div>
        </div>
    </body>
</html>