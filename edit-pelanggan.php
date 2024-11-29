<?php 
session_start();
include 'koneksi/koneksi.php';

// AMBIL ID DARI URL
$id  = isset($_GET['id'])? $_GET['id'] : '';
if (!$id) {
    header("location:pelanggan.php?id=tidak-ditemukan"); 
}

// QUERY UNTUK AMBIL DATA LEVEL BERDASARKAN ID
$editPelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($editPelanggan);

// JIKA TOMBOL EDIT DIKLIK
if (isset($_POST['edit'])) {
    $namaPelanggan      = $_POST['nama_pelanggan']; //mengambil dari isi name pada form
    $alamat             = $_POST['alamat'];
    $telepon            = $_POST['telepon'];

    // query Update Pelanggan
    $queryUpdate = mysqli_query($koneksi, "UPDATE pelanggan SET nama_pelanggan='$namaPelanggan', alamat='$alamat', telepon='$telepon' WHERE id='$id'");
    header("location:pelanggan.php?edit-pelanggan=berhasil");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-user.css">
    <title>Sistem Laundry | Edit Pelanggan</title>
</head>
<body>
    <!-- sidebar -->
     <?php include 'inc/sidebar.php';?>

     <!-- main content -->
      <div class="main-content">
        <h1>Edit Pelanggan</h1>
            <div class="form-container">
                <form action="edit-pelanggan.php?id=<?php echo $id; ?>" method="post">
                    <div class="form-group">
                        <label for="nama_pelanggan">Nama Pelanggan</label>
                        <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo $rowEdit['nama_pelanggan'];?>">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" value="<?php echo $rowEdit['alamat'];?>">
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" id="telepon" name="telepon" value="<?php echo $rowEdit['telepon'];?>">         
                        <button type="submit" name="edit" class="btn btn-submit" style="margin-top: 20px;">Simpan</button>
                        <button class="btn btn-back" onclick="history.back()">Kembali</button>            
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>