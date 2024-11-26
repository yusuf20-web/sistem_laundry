<?php
session_start();
include 'koneksi/koneksi.php';

// membuat CRUD register
if (isset($_POST['registerButton'])) {
    $nama = $_POST['register-nama'];
    $username = $_POST['register-username'];
    $email = $_POST['register-email'];
    $password = $_POST['register-password'];

    // insert data ke database
    $queryRegister = mysqli_query($koneksi, "INSERT INTO user (nama, username, email, password) VALUES ('$nama', '$username', '$email', '$password')");

    if ($queryRegister) {
        header("location:login.php?register=berhasil");
    } else {
        header("location:login.php?register=gagal");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-login.css">
    <title>Sistem Laundry | Register</title>
</head>
<body>
   <div class="container">
   <form id="register-form" method="post">
            <h2>Register</h2>
            <div class="form-group">
                <label for="register-username">Nama</label>
                <input type="text" id="register-nama" name="register-nama" required>
            </div>
            <div class="form-group">
                <label for="register-username">Username</label>
                <input type="text" id="register-username" name="register-username" required>
            </div>
            <div class="form-group">
                <label for="register-email">Email</label>
                <input type="email" id="register-email" name="register-email" required>
            </div>
            <div class="form-group">
                <label for="register-password">Password</label>
                <input type="password" id="register-password" name="register-password" required>
            </div>
            <button type="submit" class="btn" name="registerButton">Register</button>
            <p class="switch-form">Sudah punya akun? Silahkan <a href="login.php">Login</a></p>
        </form>
   </div> 
</body>
</html>