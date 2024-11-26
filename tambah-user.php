<?php 
session_start();
include 'koneksi/koneksi.php';
$queryTampilUser = mysqli_query($koneksi, "SELECT * FROM user");
$queryTampilLevel = mysqli_query($koneksi, "SELECT * FROM level");
// JIKA BUTTON SIMPAN DI TEKAN (UNTUK FILE user.php)
if (isset($_POST['simpan'])) {
    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $idLevel  = $_POST['id_level'];
    
// JIKA USER INGIN MENAMBAHKAN FOTO
if (!empty($_FILES['foto']['name'])) {
    $nama_foto = $_FILES['foto']['name'];
    $ukuran_foto = $_FILES['foto']['size'];

    // png, jpg, jpeg
    $ext = array('png', 'jpg', 'jpeg');
    $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

    // JIKA EXTENSI FOTO TIDAK ADA EXT YANG TERDAFTAR DI ARRAY EXT
    if (!in_array($extFoto, $ext)) {
        echo "Ext tidak ditemukan";
        die;
    } else {
        // pindahkan gambar dari tmp folder ke folder yang sudah kita buat
        move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);
        // MENAMBAH DATA KEDALAM TAMPILAN TAMBAH USER
        $insert = mysqli_query($koneksi, "INSERT INTO user (nama, id_level, username, email, password, foto) VALUES ('$nama','$idLevel','$username','$email','$password','$nama_foto')");
        header("location:user.php?tambah=dengan=foto=berhasil");
    }
} else {
    // JIKA USER TIDAK INGIN MENAMBAHKAN FOTO
    $insert = mysqli_query($koneksi, "INSERT INTO user (nama, id_level, username, email, password) VALUES ('$nama','$idLevel','$username','$email','$password')");
    header("location:user.php?tambah=tanpa=foto=berhasil");
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-user.css">
    <title>Sistem Laundry | Tambah Data User</title>
</head>
<body>
    <!-- Sidebar -->
    <?php include 'inc/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Tambah Data User</h1>
        <div class="form-container">
            <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" required>
            </div>

            <div class="form-group">
                <!-- MEMBUAT PILIHAN UNTUK MEMILIH LEVEL -->
                <label for="id_level">Level</label>
                <select name="id_level" id="id_level" class="select-control" required>
                    <option value="">---Pilih Level---</option>
                    <?php while($rowLevel = mysqli_fetch_assoc($queryTampilLevel)) : ?>
                        <!-- Nama level diatur sebagai value dan teks opsi -->
                        <option value="<?php echo $rowLevel['id']; ?>">
                            <?php echo $rowLevel['nama_level']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>    
            
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" id="foto" name="foto">
                </div>

                <button type="submit" class="btn btn-submit" name="simpan">Simpan</button>
            </form>
            <button class="btn btn-back" onclick="history.back()">Kembali</button>
        </div>
    </div>
</body>
</html>
