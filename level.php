<?php 
session_start();
include 'koneksi/koneksi.php';
$queryUser = mysqli_query($koneksi, "SELECT * FROM level");

// Jika tombol delete ditekan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $queryDelete = mysqli_query($koneksi, "DELETE FROM level WHERE id='$id'");
    header("location:user.php?hapus-level=berhasil");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-user.css">
    <title>Sistem Laundry | Data Level</title>
</head>
<body>
    <!-- Sidebar -->
    <?php include 'inc/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Data Level</h1>
        <div class="table-container">
            <!-- Button Tambah -->
            <div class="buttonTambah-Kembali" align="right">
                <button class="btn btn-back" onclick="history.back()">Kembali</button>
                <a class="btn btn-add" href="tambah-level.php">Tambah Data</a>
            </div>
            <!-- Memunculkan alert ketika data berhasil di edit -->
                 <?php if (isset($_GET['edit-level'])) {?>
                    <div class="tampilan-alert">Data Level berhasil diedit.</div>
                <?php }?>            
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1;
                while ($rowLevel = mysqli_fetch_assoc($queryUser)) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $rowLevel['nama_level']; ?></td>
                        <td>
                            <!-- Tombol Edit -->
                            <a class="btn btn-edit" href="edit-level.php?id=<?php echo $rowLevel['id']; ?>">Edit</a>

                            <!-- Tombol Delete -->
                            <a class="btn btn-delete" href="user.php?hapus=<?php echo $rowLevel['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
