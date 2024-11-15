<?php
// session_start();
require_once 'config/koneksi.php';

// MEMUNCULKAN KOLOM nama_level DARI TABEL level KEDALAM TABEL user (UNTUK FILE user.php)
$queryUser = mysqli_query($conn, "SELECT user.*, level.nama_level FROM user LEFT JOIN level ON user.id_level = level.id");
// MENAMPILKAN ISI TABEL user (UNTUK FILE user.php)
$queryTampilUser = mysqli_query($conn, "SELECT * FROM user");
// MENAMPILKAN ISI LEVEL KEDALAM TAMPILAN tambah-user.php
$queryTampilLevel = mysqli_query($conn, "SELECT * FROM level");
// JIKA BUTTON SIMPAN DI TEKAN (UNTUK FILE user.php)
if (isset($_POST['simpan'])) {
    $idLevel  = $_POST['id_level'];
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    // JIKA USER INGIN MENAMBAHKAN FOTO
    if (!empty($_FILES['foto']['name'])) {
        $nama_foto = $_FILES['foto']['name'];
        $ukuran_foto = $_FILES['foto']['size'];

        // png, jpg, jpeg
        $ext = array('png', 'jpg', 'jpeg');
        $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

        // JIKA EXTENSI FOTO TIDAK ADA EXT YANG TERDAFTAR DI ARRAY EXT
        if (!in_array($extFoto, $ext)) {
            echo "Ext tidak ditemukan";
            die;
        } else {
            // pindahkan gambar dari tmp folder ke folder yang sudah kita buat
            move_uploaded_file($_FILES['foto']['tmp_name'], '../upload/' . $nama_foto);
            // MENAMBAH DATA KEDALAM TAMPILAN TAMBAH USER
            $insert = mysqli_query($conn, "INSERT INTO user (id_level, nama, foto, username, email, password) VALUES ('$idLevel','$nama','$nama_foto','$username','$email','$password')");
            $pesanTambah = 'Anda telah berhasil tambah data dengan foto';
            header("location:../view/user.php?tambah=dengan=foto=berhasil");
        }
    } else {
        // JIKA USER TIDAK INGIN MENAMBAHKAN FOTO
        $insert = mysqli_query($conn, "INSERT INTO user (id_level, nama, username, email, password) VALUES ('$idLevel','$nama','$username','$email','$password')");
        $pesan = 'Anda telah berhasil tambah data tanpa foto';
        header("location:../view/user.php?tambah=tanpa=foto=berhasil");
    }
}



// JIKA BUTTON EDIT DI KLIK UNTUK FILE user.php
$id = isset($_GET['edit']) ? $_GET['edit'] : '';

$queryEdit = mysqli_query($conn, "SELECT * FROM user WHERE id ='$id'");

$rowEdit   = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
    $nama       = $_POST['nama'];
    $email      = $_POST['email'];
    $username   = $_POST['username'];
    $idLevel    = $_POST['id_level'];
    $password   = $_POST['password'];
    $id         = $_POST['id_user']; //mengambil name input = id_user
    // JIKA USER INGIN MENAMBAHKAN FOTO
    if (!empty($_FILES['foto']['name'])) {        
        $nama_foto = $_FILES['foto']['name'];
        $ukuran_foto = $_FILES['foto']['size'];

        // png, jpg, jpeg
        $ext = array('png', 'jpg', 'jpeg');
        $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

        // JIKA EXTENSI FOTO TIDAK ADA EXT YANG TERDAFTAR DI ARRAY EXT
        if (!in_array($extFoto, $ext)) {
            echo "Ext tidak ditemukan";
            die;
        } else {
            // pindahkan gambar dari tmp folder ke folder yang sudah kita buat
            unlink('upload/' . $rowEdit['foto']);
            move_uploaded_file($_FILES['foto']['tmp_name'], '../upload/' . $nama_foto);
            // MENAMBAH DATA KEDALAM TAMPILAN TAMBAH USER
            $update = mysqli_query($conn, "UPDATE user SET id_level='$idLevel', nama='$nama', foto='$nama_foto', username='$username', email='$email', password ='$password' WHERE id='$id'");
            header("location:../view/user.php?ubah=dengan=foto=berhasil");
        }
    } else {
        // JIKA USER TIDAK INGIN MENAMBAHKAN FOTO
        $update = mysqli_query($conn, "UPDATE user SET id_level='$idLevel', nama='$nama', username='$username', email='$email', password ='$password' WHERE id='$id'");
        header("location:../view/user.php?ubah=tanpa=foto=berhasil");
    }
}




// mysqli_fetch_assoc($query) = untuk menjadikan hasil query menjadi sebuah data (object,array)

// button delete di tekan (UNTUK FILE level.php dan user.php)
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; //mengambil nilai params

    // query / perintah hapus
    
    $delete = mysqli_query($conn, "DELETE FROM user  WHERE id ='$id'");
    header("location:../view/user.php?hapus=berhasil"); 
}
?>