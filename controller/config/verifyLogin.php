<?php 
session_start();
// MEMBUAT KONDISI, JIKA USER MENGAKSES INDEX.PHP MAKA USER HARUS LOGIN TERLEBIH DAHULU
if (empty($_SESSION['email']) && empty($_SESSION['nama'])) { 
    // Jika belum login, arahkan ke halaman login
    header("location:../../view/login.php");
}

?>