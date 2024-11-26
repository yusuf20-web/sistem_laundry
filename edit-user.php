<?php 
session_start();
include 'koneksi/koneksi.php';

// Ambil ID dari URL
$id  = isset($_GET['id']) ? $_GET['id'] : '';
if (!$id) {
    echo "ID tidak valid!";
    die;
}

// Ambil data user berdasarkan ID
$queryEdit = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$rowEdit   = mysqli_fetch_assoc($queryEdit);

// Menampilkan data level
$queryLevel = mysqli_query($koneksi, "SELECT * FROM level");    


if (!$rowEdit) {
    echo "Data user tidak ditemukan!";
    die;
}

// Jika tombol Edit ditekan
if (isset($_POST['edit'])) {
    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $idLevel  = $_POST['id_level'];

    // Jika user ingin mengubah foto
    if (!empty($_FILES['foto']['name'])) {
        $nama_foto = $_FILES['foto']['name'];
        $ukuran_foto = $_FILES['foto']['size'];

        // Ekstensi yang diperbolehkan
        $ext = array('png', 'jpg', 'jpeg');
        $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

        if (!in_array($extFoto, $ext)) {
            echo "Ekstensi file tidak valid!";
            die;
        } else {
            // Hapus foto lama dan simpan foto baru
            unlink('upload/' . $rowEdit['foto']);
            move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);

            // Query update dengan foto
            $update = mysqli_query($koneksi, "UPDATE user SET nama='$nama', id_level='$idLevel', username='$username', email='$email', password='$password', foto='$nama_foto' WHERE id='$id'");
            header("location:user.php?edit-dengan-foto=berhasil");
        }
    } else {
        // Query update tanpa foto
        $update = mysqli_query($koneksi, "UPDATE user SET nama='$nama', id_level='$idLevel', username='$username', email='$email', password='$password' WHERE id='$id'");
        header("location:user.php?edit-tanpa-foto=berhasil");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-user.css">
    <title>Data User</title>
</head>
<body>
    <!-- Sidebar -->
    <?php include 'inc/sidebar.php'; ?>

    <!-- TAMPILKAN DATA KETIKA DI EDIT -->
    <div class="main-content">
        <h1>Edit Data User</h1>
        <div class="form-container">
        <form action="edit-user.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <label>Nama</label>    
            <input type="text" name="nama" value="<?php echo htmlspecialchars($rowEdit['nama']); ?>" class="form-control" required>

            <!-- membuat pilihan untuk menampilkan level -->
            <label>Level</label>
            <select name="id_level" class="select-control" required>
                <option value="">-- Pilih Level --</option>
                <?php while ($rowLevel = mysqli_fetch_assoc($queryLevel)) {?>
                    <!-- KETIKA DI EDIT, MAKA OPTION NYA MUNCUL BERDASARKAN LEVEL USER YANG SUDAH DI PILIH SEBELUMNYA -->
                    <option value="<?php echo $rowLevel['id'];?>" <?php if ($rowLevel['id'] == $rowEdit['id_level']) echo "selected";?>>
                    <?php echo $rowLevel['nama_level'];?></option>
                <?php }?>
            </select>

            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($rowEdit['username']); ?>" class="form-control" required>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($rowEdit['email']); ?>" class="form-control" required>

            <label>Password</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($rowEdit['password']); ?>" class="form-control" required>

            <label>Foto</label>
            <input type="file" name="foto" class="form-control">
            <?php if (!empty($rowEdit['foto'])) { ?>
                <img src="upload/<?php echo $rowEdit['foto']; ?>" alt="Foto User" width="100">
            <?php } ?>

            <button type="submit" name="edit" class="btn btn-submit">Simpan</button>
        </form>
            <button class="btn btn-back" onclick="history.back()">Kembali</button>
        </div>
    </div>
</body>
</html>