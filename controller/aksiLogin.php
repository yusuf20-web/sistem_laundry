<?php
session_start();
include '../config/koneksi.php';
// Membuat function untuk bisa login menggunakan username atau email
function loginQuery($conn, $kolom, $params){
    $query = mysqli_query($conn, "SELECT * FROM user WHERE $kolom='$params'");
    if(mysqli_num_rows($query) > 0){
        return  $query;
    } else {
        return false;
    }
}


if (isset($_POST['login'])) {
    $email    = $_POST['email']; //untuk mengambil nilai dari input
    $password = $_POST['password'];

    $queryLogin = loginQuery($conn,"username", $email);
    $queryEmail = loginQuery($conn,"email", $email);
    // login dengan username
    if($queryLogin){
        
            $rowLogin = mysqli_fetch_assoc($queryLogin);
            // cek kondisi apakah password cocok
            if ($password == $rowLogin['password']) {
                $_SESSION['email'] = $rowLogin['email'];
                $_SESSION['nama'] = $rowLogin['nama'];
                $_SESSION['id']   = $rowLogin['id'];
                $_SESSION['id_level'] = $rowLogin['id_level'];
                header("location:../view/index.php?login=berhasil=menggunakan=username");
            } else {
                header("location:../view/login.php?login=gagal");
            }
    // jika login menggunakan email
    } elseif ($queryEmail){
        $rowLogin = mysqli_fetch_assoc($queryEmail);
        // cek kondisi apakah password cocok
        if ($password == $rowLogin['password']){
            $_SESSION['email'] = $rowLogin['email'];
            $_SESSION['nama'] = $rowLogin['nama'];
            $_SESSION['id']   = $rowLogin['id'];
            $_SESSION['id_level'] = $rowLogin['id_level'];
        }
        header("location:../view/index.php?login=berhasil=menggunakan=email");
    } else {
        header("location:../view/login.php?login=gagal");
    }
} 

?>