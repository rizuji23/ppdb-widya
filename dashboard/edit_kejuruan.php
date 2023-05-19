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
                                <h5 class="card-title fw-semibold mb-4">Edit Kejuruan</h5>
                            </div>
                            <?php

                            $get_kejuruan = get_kejuruan($_GET['id_kejuruan']);

                            if (isset($_POST['edit_kejuruan'])) {
                                update_kejuruan($_POST, $_GET['id_kejuruan']);
                            }

                            ?>
                            <form method="POST">
                                <div class="form-group mt-3">
                                    <label for="">Jurusan Sekolah</label>
                                    <input type="text" class="form-control mt-1" name="nama_kejuruan" value="<?= $get_kejuruan['jurusan_sekolah'] ?>">
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary mt-3" type="submit" name="edit_kejuruan">Edit</button>
                                </div>
                            </form>
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
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        $("#tipe_filter").change(() => {
            const tipe = $("#tipe_filter").val();
            var data = ``;

            switch (tipe) {
                case 'Tanggal':
                    data = `
                        <div class="form-group mt-3">
                            <label>Dari Tanggal</label>
                            <input class="form-control" type="date" name="start_date" />
                        </div>
                        <div class="form-group mt-3">
                            <label>Sampai Tanggal</label>
                            <input class="form-control" type="date" name="end_date" />
                        </div>
                    `;
                    break;
                case 'Bulan':
                    data = `
                        <div class="form-group mt-3">
                            <label>Bulan</label>
                            <input class="form-control" type="month" name="bulan" />
                        </div>
                    `;
                    break;
                case 'Semua':
                    data = ``;
                    break;
            }

            $("#box_filter").html(data);
        })
    </script>
</body>

</html>