<?php 
session_start();
include 'koneksi/koneksi.php';
//MENAMPILKAN DATA PELANGGAN DARI TABEL PELANGGAN

$queryPelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");

// Jika tombol delete ditekan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $queryDelete = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id='$id'");
    header("location:pelanggan.php?hapus=berhasil");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-user.css">
    <title>Sistem Laundry | Data Pelanggan</title>
</head>
<body>
    <!-- Sidebar -->
    <?php include 'inc/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Data Pelanggan</h1>
        <div class="table-container">
            <!-- Button Tambah -->
            <div class="buttonTambah-Kembali" align="right">
                <button class="btn btn-back" onclick="history.back()">Kembali</button>
                <a class="btn btn-add" href="tambah-pelanggan.php">Tambah Data</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Nama Paket</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1;
                while ($rowPelanggan = mysqli_fetch_assoc($queryPelanggan)) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $rowPelanggan['nama_pelanggan']; ?></td>
                        <td><?php echo $rowPelanggan['alamat']; ?></td>
                        <td><?php echo $rowPelanggan['telepon']; ?></td>
                        <td></td>
                        <td>
                            <!-- Tombol Edit -->
                            <a class="btn btn-edit" href="edit-pelanggan.php?id=<?php echo $rowpelanggan['id']; ?>">Edit</a>

                            <!-- Tombol Delete -->
                            <a class="btn btn-delete" href="pelanggan.php?hapus=<?php echo $rowpelanggan['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>