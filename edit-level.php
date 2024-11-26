<?php 
session_start();
include 'koneksi/koneksi.php';

// AMBIL ID DARI URL

$id  = isset($_GET['id'])? $_GET['id'] : '';
if (!$id) {
    header("location:level.php?id=tidak-ditemukan"); 
}

// QUERY UNTUK AMBIL DATA LEVEL BERDASARKAN ID
$queryLevel = mysqli_query($koneksi, "SELECT * FROM level WHERE id='$id'");
$rowLevel = mysqli_fetch_assoc($queryLevel);

// JIKA TOMBOL EDIT DIKLIK
if (isset($_POST['edit'])) {
    $namaLevel = $_POST['nama_level'];
    $queryUpdate = mysqli_query($koneksi, "UPDATE level SET nama_level='$namaLevel' WHERE id='$id'");
    header("location:level.php?edit-level=berhasil");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-user.css">
    <title>Sistrm Laundry | Edit Level</title>
</head>
<body>
    <!-- munculkan sidebar -->
     <?php include 'inc/sidebar.php';?>

     <!-- TAMPILKAN DATA KETIKA DI EDIT -->
      <div class="main-content">
        <h1>Edit Level</h1>
        <div class="form-container">
            <form action="edit-level.php?id=<?php echo $id; ?>" method="post">
                <label for="nama_level">Nama Level</label>
                <input type="text" id="nama_level" name="nama_level" value="<?php echo $rowLevel['nama_level'];?>">
                <button type="submit" name="edit" class="btn btn-submit">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>