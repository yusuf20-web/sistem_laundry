<?php 
session_start();
include 'controller/config/koneksi.php';
include 'controller/aksiCrudUser.php';
?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Laundry System | Tambah User</title>

    <meta name="description" content="" />

    <?php include 'cssTambah-user.php' ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php require_once 'sidebarTambah.php'; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include 'view/inc/nav.php'; ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header fs-1"><?php echo isset($_GET['edit']) ? 'EDIT' : 'TAMBAH' ?> USER</div>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">
                                                Data berhasil dihapus
                                            </div>
                                        <?php endif ?>

                                        <form action="controller/aksiCrudUser.php" method="post" enctype="multipart/form-data">
                                            <!-- MEMBUAT INPUT HIDDEN AGAR DAPAT MENAMPUNG NAME ID -->
                                        <input type="hidden" name="id_user" value="<?php echo isset($_GET['edit']) ? $rowEdit['id'] : '' ?>">
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">Nama</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="nama"
                                                        placeholder="Masukkan nama anda"
                                                        required
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['nama'] : '' ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">Username</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="username"
                                                        placeholder="Masukkan username anda"
                                                        required
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['username'] : '' ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">                                               
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">Email</label>
                                                    <input type="email"
                                                        class="form-control"
                                                        name="email"
                                                        placeholder="Masukkan email anda"
                                                        required
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['email'] : '' ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">Password</label>                                                   
                                                    <input type="password"
                                                        name="password"
                                                        placeholder="Masukkan password anda"
                                                        class="form-control"
                                                        id=""
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['password'] : '' ?>">
                                                </div>
                                            </div> 
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">LEVEL</label>
                                                    <select class="form-select" name="id_level" id="">
                                                        <option value="" class="form-option">Pilih Level Anda</option>
                                                        <!-- MENAMPILKAN JIKA USER MENGGUNAKAN LEVEL  -->
                                                        <?php while ($rowLevel = mysqli_fetch_assoc($queryTampilLevel)) : ?>
                                                            <!-- MENAMPILKAN JIKA USER MENGGUNAKAN LEVEL  -->
                                                            <option value="<?php echo $rowLevel['id']?>" 
                                                            <?php echo isset($_GET['edit']) && $rowLevel['id'] == $rowEdit['id_level'] ? 'selected' : ''?>>
                                                                <?php echo $rowLevel['nama_level']?>
                                                            </option>
                                                            <?php endwhile ?>
                                                    </select>
                                                </div>                                
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-4">
                                                    <label for="" class="form-label">Foto</label>
                                                    <input type="file"
                                                        name="foto"
                                                        class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                        <img src="upload/<?php echo $rowEdit['foto']?>" alt="" class="img-fluid" width="100">
                                                </div>
                                            </div>
                                            </div>                                            
                                            <div class="mb-3 row">
                                                <div class="col-sm-6 ms-4">
                                                    <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">
                                                    Simpan
                                                    </button>
                                                    <button class="btn btn-danger" type="reset">
                                                        Reset
                                                    </button>
                                                </div>                                               
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , made with ❤️ by
                                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                            </div>
                            <div>
                                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                                <a
                                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                                    target="_blank"
                                    class="footer-link me-4">Documentation</a>

                                <a
                                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                                    target="_blank"
                                    class="footer-link me-4">Support</a>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/assets/vendor/js/bootstrap.js"></script>
    <script src="assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>