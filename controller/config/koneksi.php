<?php 
// membuat koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db = "sistem_laundry";
$conn = mysqli_connect($host, $user, $pass, $db);
    // mengecek koneksi
    if (!$conn) {
        die("Koneksi gagal: ". mysqli_connect_error());
    }

?>