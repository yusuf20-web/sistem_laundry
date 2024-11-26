<?php 
session_start();
include 'koneksi/koneksi.php';

// AMBIL ID DARI URL
$id  = isset($_GET['id'])? $_GET['id'] : '';
if (!$id) {
    header("location:paket.php?id=tidak-ditemukan"); 
}

// QUERY UNTUK AMBIL DATA LEVEL BERDASARKAN ID
$queryLevel = mysqli_query($koneksi, "SELECT * FROM paket WHERE id='$id'");
$rowLevel = mysqli_fetch_assoc($queryLevel);

// JIKA TOMBOL EDIT DIKLIK
if (isset($_POST['edit'])) {
    $namaLevel = $_POST['nama_level'];
    $queryUpdate = mysqli_query($koneksi, "UPDATE level SET nama_level='$namaLevel' WHERE id='$id'");
    header("location:level.php?edit-level=berhasil");
}


?>