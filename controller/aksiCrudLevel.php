<?php
// session_start();
require_once 'config/koneksi.php';

// MEMUNCULKAN KOLOM nama_level DARI TABEL level
$queryLevel = mysqli_query($conn, "SELECT * FROM level");
// JIKA BUTTON SIMPAN DI TEKAN (UNTUK FILE user.php)
if (isset($_POST['simpan'])) {
    $namaLevel     = $_POST['nama_level'];
    $insertLevel = mysqli_query($conn, "INSERT INTO level (nama_level) VALUES ('$namaLevel')");
    header("location:../view/level.php?simpan=berhasil");
    
}

$id_level  = isset($_GET['edit']) ? $_GET['edit'] : '';

$queryEditLevel = mysqli_query($conn, "SELECT * FROM level WHERE id ='$id_level'");

$rowEditLevel   = mysqli_fetch_assoc($queryEditLevel);

// JIKA BUTTON EDIT DI KLIK UNTUK FILE level.php
if (isset($_POST['edit'])) {
    $id_level = $_POST['id_level'];
    $nama_level   = $_POST['nama_level'];
    // query edit level
    $updateLevel = mysqli_query($conn, "UPDATE level SET nama_level='$nama_level' WHERE id ='$id_level'");
    header("location:../view/level.php?ubah=berhasil");
}
// cek apakah nilai edit sudah ada dalam URL dan mengatur $id_level

// button delete di tekan UNTUK FILE level.php
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; //mengambil nilai params

    // query / perintah hapus
    $deleteLevel = mysqli_query($conn, "DELETE FROM level  WHERE id ='$id'");
    header("location:../view/level.php?hapus=berhasil");
    
}
?>