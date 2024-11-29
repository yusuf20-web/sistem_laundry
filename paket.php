<?php 
session_start();
include 'koneksi/koneksi.php';
$queryPaket = mysqli_query($koneksi, "SELECT * FROM paket");

// Jika tombol delete ditekan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $queryDelete = mysqli_query($koneksi, "DELETE FROM paket WHERE id='$id'");
    header("location:paket.php?hapus-paket=berhasil");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-user.css">
    <title>Sistem Laundry | Data Paket</title>
</head>
<body>
    <!-- Sidebar -->
    <?php include 'inc/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Data Paket</h1>
        <div class="table-container">
            <!-- Button Tambah -->
            <div class="buttonTambah-Kembali" align="right">
                <button class="btn btn-back" onclick="history.back()">Kembali</button>
                <a class="btn btn-add" href="tambah-paket.php">Tambah Data</a>
            </div>
            <!-- Memunculkan alert ketika data berhasil di edit -->
                 <?php if (isset($_GET['edit-paket'])) {?>
                    <div class="tampilan-alert">Data Paket berhasil diedit.</div>
                <?php }?>            
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Harga Paket</th>
                        <th>Keterangan Paket</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1;
                while ($rowPaket = mysqli_fetch_assoc($queryPaket)) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $rowPaket['nama_paket']; ?></td>
                        <td><?php echo $rowPaket['harga']; ?></td>
                        <td><?php echo $rowPaket['keterangan']; ?></td>
                        <td>
                            <!-- Tombol Edit -->
                            <a class="btn btn-edit" href="edit-paket.php?id=<?php echo $rowPaket['id']; ?>">Edit</a>

                            <!-- Tombol Delete -->
                            <a class="btn btn-delete" href="paket.php?hapus=<?php echo $rowPaket['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
