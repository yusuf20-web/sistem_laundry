<?php 
// membuat koneksi ke database
$host = "localhost";
 $username = "root";
 $password = "";
 $database = "laundry_yusuf";
 
 // koneksi ke database
 $koneksi = mysqli_connect($host, $username, $password, $database);
 
 // cek koneksi
 if (!$koneksi) {
     die("Koneksi gagal: ". mysqli_connect_error());
 }
?>