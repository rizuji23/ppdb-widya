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
    <title>Data Pembayaran | PPDB SMK BAKTI NUSANTARA 666</title>
    <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="box-header">
            <div class="d-flex mt-1">
                <div class="">
                    <img src="../assets/download.jpeg" width="150" alt="">
                </div>
                <div class="text-center w-100 align-self-center">
                    <h1>Laporan PPDB</h1>
                    <p>SMK Bakti Nusantara</p>
                </div>
            </div>
            <hr>
        </div>

        <div class="box-info">
            <div class="row">
                <div class="col-sm">
                    <div class="card overflow-hidden">
                        <div class="card-body p-4">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                    <?php $get_count = get_count_siswa($_GET); ?>
                                    <h5 class="card-title mb-9 fw-semibold">Total Jumlah Calon Siswa</h5>
                                    <h4 class="fw-semibold mb-3"><?php echo $get_count['count'] ?> Orang</h4>

                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-user fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <!-- Monthly Earnings -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row alig n-items-start">
                                <?php $get_sum = get_count_pembayaran($_GET) ?>
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold">Total Semua Pembayaran </h5>
                                    <h4 class="fw-semibold mb-3">Rp. <?php echo rupiah($get_sum['count']) ?></h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-currency-dollar fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <div class="card overflow-hidden">
                        <div class="card-body p-4">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                    <?php $count_lulus = get_seleksi_count('lulus'); ?>
                                    <h5 class="card-title mb-9 fw-semibold">Jumlah Calon Siswa Lulus</h5>
                                    <h4 class="fw-semibold mb-3"><?php echo $count_lulus['count'] ?> Orang</h4>

                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-check fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <!-- Monthly Earnings -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                    <?php $count_tidak_lulus = get_seleksi_count('tidak_lulus'); ?>
                                    <h5 class="card-title mb-9 fw-semibold">Jumlah Calon Siswa Tidak Lulus</h5>
                                    <h4 class="fw-semibold mb-3"><?php echo $count_tidak_lulus['count'] ?> Orang</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-minus fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="box-content">
            <table class="table">
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Asal Sekolah</th>
                    <th>Status</th>
                    <th>Tanggal Daftar</th>
                </tr>
                <?php

                $get = print_laporan($_GET);
                $no = 1;
                foreach ($get as $g) {

                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $g['nama'] ?></td>
                        <td><?php echo $g['asal_sekolah'] ?></td>
                        <td><?php echo $g['status'] ?></td>
                        <td><?php echo $g['tanggal_daftar'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>

    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sidebarmenu.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="assets/js/dashboard.js"></script>

    <script>
        window.print();
    </script>
</body>

</html>