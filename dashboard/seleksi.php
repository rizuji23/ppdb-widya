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
    <title>Seleksi Siswa | PPDB SMK BAKTI NUSANTARA 666</title>
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
            <?php if ($_SESSION['level'] == 3) {
                include 'include/navbar.php';
            } else if ($_SESSION['level'] == 2) {
                include 'include/navbar_petugas.php';
            } else if ($_SESSION['level'] == 1) {
                include 'include/navbar_admin.php';
            } ?>

            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Seleksi Siswa</h5>

                        <div class="d-flex">
                            <div class="me-4">
                                <?php include 'pp.php'; ?>
                            </div>
                            <div class="w-100">
                                <h4 class="fw-semibold mb-0">Nama</h4>
                                <p style="font-size: 20px" class="mb-0">
                                    <?php

                                    $user = get_user($_SESSION['username'], $_SESSION['level']);

                                    echo $user['nama'];

                                    ?>
                                </p>
                                <hr class="mb-2 mt-2">
                                <div class="d-flex align-items-center">
                                    <div class="me-4">
                                        <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                        <span class="fs-2">Tanggal Lahir: <?= $user['ttl'] ?></span>
                                    </div>
                                    <div class="me-4">
                                        <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                        <span class="fs-2">Asal Sekolah: <?= $user['asal_sekolah'] ?></span>
                                    </div>

                                </div>

                                <?php $bo = get_biodata($_SESSION['id_siswa']);


                                if ($bo != false) {
                                ?>
                                    <div class="me-4">
                                        <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                        <span class="fs-2">Jenis Kelamin: <?= $bo['jk'] ?></span>
                                    </div>
                                    <div class="me-4">
                                        <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                        <span class="fs-2">Tempat Tanggal Lahir: <?= $bo['ttl'] ?></span>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <p class="text-danger">Data tidak lengkap!.</p>
                                <?php } ?>
                            </div>

                        </div>
                        <div class="text-end">
                            <?php
                            if ($bo != false) {
                            ?>
                                <?php
                                $se = check_seleksi($_SESSION['id_siswa']);

                                if ($se != false) {
                                ?>
                                    <button class="btn btn-primary mt-0 btn-sm" disabled>Lakukan Seleksi</button>
                                <?php } else { ?>
                                    <a href="do_seleksi.php?id_siswa=<?php echo $_SESSION['id_siswa']; ?>" class="btn btn-primary  mt-0 btn-sm">Lakukan Seleksi</a>
                                <?php } ?>
                            <?php } else { ?>
                                <button class="btn btn-primary  mt-0 btn-sm" disabled>Lakukan Seleksi</button>
                            <?php } ?>
                        </div>
                        <hr>
                        <h5 class="card-title mb-9 fw-semibold">Progress Seleksi</h5>

                        <?php

                        $pro = check_seleksi($_SESSION['id_siswa']);

                        if ($pro != false) {

                        ?>
                            <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo $pro['progress'] ?>" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar overflow-visible" style="width: <?php echo $pro['progress'] ?>%"><b><?php echo $pro['progress'] ?>%</b></div>
                            </div>
                            <p class="mt-3">Status: <?php echo $pro['status'] ?>.</p>
                        <?php } else { ?>
                            <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar overflow-visible" style="width: 10%"><b>0%</b></div>
                            </div>
                            <p class="mt-3">Status: Menunggu Diseleksi oleh Siswa.</p>
                        <?php } ?>
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