<?php

require '../system/controller.php';

if (empty($_SESSION['username'])) {
    header("location: ../login.php");
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah User | PPDB SMK BAKTI NUSANTARA 666</title>
    <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->

        <?php

        include 'include/sidebar_core.php';

        ?>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <?php include './include/navbar.php'; ?>

            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Tambah Petugas Baru</h5>
                        <?php
                        if (isset($_POST['save'])) {
                            save_petugas($_POST);
                        }

                        ?>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group mt-3">
                                <label for="">Nama Petugas</label>
                                <input type="text" class="form-control" name="nama">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Username</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="text-end mt-3">
                                <button type="submit" name="save" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sidebarmenu.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="assets/js/dashboard.js"></script>
</body>

</html>