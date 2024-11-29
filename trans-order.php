<?php
session_start();
include 'koneksi/koneksi.php';
// munculkan / pilih sebuah atau semua kolom dari table user
$queryTrans = mysqli_query($koneksi, "SELECT pelanggan.nama_pelanggan, trans_order.* FROM trans_order LEFT JOIN pelanggan ON pelanggan.id = trans_order.id_pelanggan ORDER BY id DESC");

// mysqli_fetch_assoc($query) = untuk menjadikan hasil query menjadi sebuah data (object,array)

// jika parameternya ada ?delete=nilai param
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus']; //mengambil nilai params

    // query / perintah hapus
    $delete = mysqli_query($koneksi, "DELETE FROM trans_order WHERE id ='$id'");
    header("location:trans_order.php?hapus=berhasil");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-user.css">
    <title>Sistem Laundry | Data Transaksi</title>
</head>
<body>
    <!-- Sidebar -->
    <?php include 'inc/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Data Transaksi</h1>
        <div class="table-container">
            <!-- Button Tambah -->
            <div class="buttonTambah-Kembali" align="right">
                <button class="btn btn-back" onclick="history.back()">Kembali</button>
                <a class="btn btn-add" href="tambah-trans.php">Tambah Data</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Transaksi</th>
                        <th>Pelanggan</th>
                        <th>Tanggal Laundry</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1;
                while ($rowTrans = mysqli_fetch_assoc($queryTrans)) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $rowTrans['no_transaksi']; ?></td>
                        <td><?php echo $rowTrans['nama_pelanggan']; ?></td>
                        <td><?php echo $rowTrans['tanggal_laundry']; ?></td>
                        <td>
                        <?php
                            switch ($rowTrans['status']) {
                                case 1:
                                $badge = "<span class='badge bg-success'>Sudah dikembalikan</span>";
                                break;
                            default:
                                $badge = "<span class='badge bg-warning'>Baru</span>";
                                break;
                            }
                            echo $badge;
                        ?>
                        </td>
                        <td>
                            <!-- Tombol Detail -->
                            <a class="btn btn-edit" href="tambah-trans.php?id=<?php echo $rowUser['id']; ?>">Detail</a>

                            <!-- Tombol Print -->
                            <a class="btn btn-edit" href="print.php?id=<?php echo $rowUser['id']; ?>">Print</a>
                           
                            <!-- Tombol Delete -->
                            <a class="btn btn-delete" href="trans-order.php?hapus=<?php echo $rowUser['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
