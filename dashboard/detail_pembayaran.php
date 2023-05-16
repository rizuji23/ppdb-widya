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
    <title>Detail Pembayaran | PPDB SMK BAKTI NUSANTARA 666</title>
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
                <?php

                $get = get_selected_pembayaran($_GET['id_pembayaran']);

                ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Detail Pembayaran</h5>

                        <div class="form-group mt-3">
                            <label for="">ID Pembayaran</label>
                            <input type="text" class="form-control" value="<?php echo $get['id_pembayaran'] ?>" disabled>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Nama Siswa</label>
                            <input type="text" class="form-control" value="<?php echo $get['nama'] ?>" disabled>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Jumlah Bayar</label>
                            <input type="text" class="form-control" value="<?php echo rupiah($get['jumlah_bayar']) ?>" disabled>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Bukti Pembayaran</label><br>
                            <img src="./media/<?php echo $get['bukti_bayar'] ?>" width="300" alt="">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Tanggal</label>
                            <input type="text" class="form-control" value="<?php echo $get['created_at'] ?>" disabled>
                        </div>

                        <div class="d-grid mt-3">
                            <a href="list_pembayaran.php" class="btn btn-primary">Kembali</a>
                        </div>
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