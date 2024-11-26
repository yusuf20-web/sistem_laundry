<?php 
session_start();
include 'koneksi/koneksi.php';

// membuat function untuk bisa login menggunakan email atau username
function loginQuery($koneksi, $kolom, $params){
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE $kolom='$params'");
    if(mysqli_num_rows($query) > 0){
        return  $query;
    } else {
        return false;
    }
}

// membuat CRUD login
if (isset($_POST['loginButton'])) {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];

    $queryLogin = loginQuery($koneksi,"username", $email);
    $queryEmail = loginQuery($koneksi,"email", $email);

    // login menggunakan username
    if($queryLogin){  
        $rowLogin = mysqli_fetch_assoc($queryLogin);
        // cek kondisi apakah password cocok
        if ($password == $rowLogin['login-password']) {
            $_SESSION['username'] = $rowLogin['username'];
            $_SESSION['nama'] = $rowLogin['nama'];
            $_SESSION['id']   = $rowLogin['id'];
            $_SESSION['id_level'] = $rowLogin['id_level'];
            header("location:index.php?login=berhasil=menggunakan=username");
        } else {
            header("location:login.php?login=gagal");
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
    header("location:index.php?login=berhasil=menggunakan=email");
} else {
    header("location:login.php?login=gagal");
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-login.css">
    <title>Sistem Laundry | Login</title>
</head>
<body>
    <div class="container" id="form-container">
        <form id="login-form" method="post">
            <h2>Login</h2>
            <div class="form-group">
                <label for="login-email">Email or Username</label>
                <input type="text" id="login-email" name="login-email" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="login-password" required>
            </div>
            <button type="submit" class="btn" name="loginButton">Login</button>
            <p class="switch-form">Belum punya akun? Silahkan <a href="register.php">Register</a></p>
        </form>
    </div>
    <!-- <script>
        function showRegister() {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('register-form').style.display = 'block';
        }
        function showLogin() {
            document.getElementById('register-form').style.display = 'none';
            document.getElementById('login-form').style.display = 'block';
        }
    </script> -->
</body>
</html>
