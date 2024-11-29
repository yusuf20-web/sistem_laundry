<?php
session_start();
include 'koneksi/koneksi.php';

$queryTrans = mysqli_query($koneksi, "SELECT * FROM trans_order");
// tampil data pelanggan
$queryPelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
// tampil nomor transaksi
// no invoice code
// 001, jika ada auto increment id + 1 = 002, selain itu 001
// MAX : terbesar MIN: terkecil
$queryInvoice = mysqli_query($koneksi, "SELECT MAX(id) AS no_transaksi FROM trans_order");
// jika di dalam table trans order ada datanya
$str_unique = "INV";
$date_now   = date("dmy");
if (mysqli_num_rows($queryInvoice) > 0) {
    $rowInvoice = mysqli_fetch_assoc($queryInvoice);
    $incrementPlus = $rowInvoice['no_invoice'] + 1;
    $code = $str_unique . "" . $date_now . "" . "000" . $incrementPlus;
} else {
    $code = $str_unique . "" . $date_now . "" . "0001";
}

// jika tombol simpan ditekan
    if (isset($_POST['simpan'])) {
        $id_level = $_POST['id_level'];
        // insert ke table trans_order
        mysqli_query($koneksi, "INSERT INTO trans_order (id_pelanggan, no_invoice) VALUES ('$id_level', '$code')");
        header("location: transaksi.php?simpan=berhasil");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-user.css">
    <title>Sistem Laundry | Tambah Transaksi</title>
</head>
<body>
    <!-- Sidebar -->
    <?php include 'inc/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Tambah Transaksi</h1>
        <div class="form-container">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <!-- MEMBUAT PILIHAN UNTUK MEMILIH PELANGGAN -->
                    <label for="id_level">Pelanggan</label>
                    <select name="id_level" id="id_level" class="select-control" required>
                        <option value="">---Pilih Pelanggan---</option>
                        <?php while($rowPelanggan = mysqli_fetch_assoc($queryPelanggan)) : ?>
                            <!-- Nama level diatur sebagai value dan teks opsi -->
                            <option value="<?php echo $rowPelanggan['id']; ?>">
                                <?php echo $rowPelanggan['nama_pelanggan']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div> 
                <div class="form-group">
                    <!-- MEMBUAT INPUT UNTUK MEMASUKKAN NAMA PAKET -->
                    <label for="no_transaksi">No Invoice</label>
                    <input type="text" id="no_transaksi" name="no_transaksi" readonly>
                </div>   
                <button type="submit" class="btn btn-submit" name="simpan">Simpan</button>
            </form>
            <button class="btn btn-back" onclick="history.back()">Kembali</button>
        </div>
    </div>
</body>
</html>
