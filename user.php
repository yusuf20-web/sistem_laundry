<?php 
session_start();
include 'koneksi/koneksi.php';
// MENAMPILKAN KOLOM LEVEL DARI TABEL LEVEL DAN DI TAMPILKAN KEDALAM TABEL USER
$queryUser = mysqli_query($koneksi, "SELECT level.nama_level,  user.* FROM user 
LEFT JOIN level ON level.id = user.id_level
ORDER BY id DESC");


// Jika tombol delete ditekan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $queryDelete = mysqli_query($koneksi, "DELETE FROM user WHERE id='$id'");
    header("location:user.php?hapus=berhasil");
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

    <!-- Main Content -->
    <div class="main-content">
        <h1>Data User</h1>
        <div class="table-container">
            <!-- Button Tambah -->
            <div class="buttonTambah-Kembali" align="right">
                <button class="btn btn-back" onclick="history.back()">Kembali</button>
                <a class="btn btn-add" href="tambah-user.php">Tambah Data</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1;
                while ($rowUser = mysqli_fetch_assoc($queryUser)) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $rowUser['nama']; ?></td>
                        <td><?php echo $rowUser['nama_level']; ?></td>
                        <td><?php echo $rowUser['username']; ?></td>
                        <td><?php echo $rowUser['email']; ?></td>
                        <td><?php echo $rowUser['password']; ?></td>
                        <td><img class="img-fluid" width="100" src="upload/<?php echo $rowUser['foto']; ?>" alt="Foto User"></td>
                        <td>
                            <!-- Tombol Edit -->
                            <a class="btn btn-edit" href="edit-user.php?id=<?php echo $rowUser['id']; ?>">Edit</a>

                            <!-- Tombol Delete -->
                            <a class="btn btn-delete" href="user.php?hapus=<?php echo $rowUser['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
