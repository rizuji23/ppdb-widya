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
                        <div class="row mb-3">
                            <div class="col-sm">
                                <h5 class="card-title fw-semibold mb-4">List Pembayaran Siswa</h5>
                            </div>
                            <?php

                            if ($_SESSION['level'] == 3) {
                            ?>
                                <div class="col-sm text-end">
                                    <a href="tambah_pembayaran.php" class="btn btn-primary">Tambah Pembayaran Baru</a>
                                </div>
                            <?php
                            }

                            ?>
                        </div>

                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Pembayaran</th>
                                    <?php
                                    if ($_SESSION['level'] != 3) {
                                    ?>
                                        <th>Nama Siswa</th>
                                    <?php
                                    }
                                    ?>
                                    <th>Jumlah Bayar</th>
                                    <th>Tanggal</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($_SESSION['level'] == 3) {
                                    $get_seleksi = get_pembayaran($_SESSION['id_siswa']);
                                } else {
                                    $get_seleksi = get_pembayaran('all');
                                }
                                if (isset($_GET['id_pembayaran'])) {
                                    hapus_pembayaran($_GET['id_pembayaran']);
                                }
                                $no = 1;
                                foreach ($get_seleksi as $gs) {

                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $gs['id_pembayaran'] ?></td>
                                        <?php
                                        if ($_SESSION['level'] != 3) {
                                        ?>
                                            <td><?= $gs['nama'] ?></td>
                                        <?php
                                        }
                                        ?>
                                        <td><?= rupiah($gs['jumlah_bayar']) ?></td>
                                        <td><?= $gs['created_at'] ?></td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="detail_pembayaran.php?id_pembayaran=<?php echo $gs['id_pembayaran'] ?>">Detail</a>
                                            <a class="btn btn-success btn-sm" href="edit_pembayaran.php?id_pembayaran=<?php echo $gs['id_pembayaran'] ?>">Edit</a>
                                            <?php

                                            if ($_SESSION['level'] !== 3) {
                                            ?>
                                                <a class="btn btn-danger btn-sm" href="list_pembayaran.php?id_pembayaran=<?php echo $gs['id_pembayaran'] ?>">Delete</a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>