<?php 
session_start();
include 'koneksi/koneksi.php';

// AMBIL ID DARI URL
$id  = isset($_GET['id'])? $_GET['id'] : '';
if (!$id) {
    header("location:paket.php?id=tidak-ditemukan"); 
}

// QUERY UNTUK AMBIL DATA LEVEL BERDASARKAN ID
$editPaket = mysqli_query($koneksi, "SELECT * FROM paket WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($editPaket);

// JIKA TOMBOL EDIT DIKLIK
if (isset($_POST['edit'])) {
    $namaPaket      = $_POST['nama_paket'];
    $harga          = $_POST['harga'];
    $keterangan     = $_POST['keterangan'];
    $queryUpdate = mysqli_query($koneksi, "UPDATE paket SET nama_paket='$namaPaket', harga='$harga', keterangan='$keterangan' WHERE id='$id'");
    header("location:paket.php?edit-paket=berhasil");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-user.css">
    <title>Sistem Laundry | Edit Paket</title>
</head>
<body>
    <!-- sidebar -->
     <?php include 'inc/sidebar.php';?>

     <!-- main content -->
      <div class="main-content">
        <h1>Edit Paket</h1>
            <div class="form-container">
                <form action="edit-paket.php?id=<?php echo $id; ?>" method="post">
                    <div class="form-group">
                        <label for="nama_paket">Nama Paket</label>
                        <input type="text" id="nama_paket" name="nama_paket" value="<?php echo $rowEdit['nama_paket'];?>">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" id="harga" name="harga" value="<?php echo $rowEdit['harga'];?>">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" id="keterangan" name="keterangan" value="<?php echo $rowEdit['keterangan'];?>">
                        <button type="submit" name="edit" class="btn btn-submit">Simpan</button>
                        <button class="btn btn-back" onclick="history.back()">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>