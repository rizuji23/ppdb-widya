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
                                <h5 class="card-title fw-semibold mb-4">List Petugas</h5>
                            </div>
                            <div class="col-sm text-end">
                                <a href="tambah_user.php" class="btn btn-primary">Tambah Petugas</a>
                            </div>
                        </div>

                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Petugas</th>
                                    <th>Nama Petugas</th>
                                    <th>Username</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $get_seleksi = get_petugas_all();
                                $no = 1;
                                foreach ($get_seleksi as $gs) {

                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $gs['id_petugas'] ?></td>
                                        <td><?= $gs['nama'] ?></td>
                                        <td><?= $gs['username'] ?></td>
                                        <td>
                                            <?php

                                            if ($_SESSION['level'] !== 3) {
                                            ?>
                                                <a class="btn btn-success btn-sm" href="edit_user.php?id_petugas=<?= $gs['id_petugas'] ?>">Edit</a>

                                                <a class="btn btn-danger btn-sm" href="delete_petugas.php?id_petugas=<?= $gs['id_petugas'] ?>">Delete</a>
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