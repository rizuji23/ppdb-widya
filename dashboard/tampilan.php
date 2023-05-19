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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

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
                                <h5 class="card-title fw-semibold mb-4">Tentang Sekolah</h5>
                                <?php

                                $get_tentang = get_tentang();

                                if (isset($_POST['edit_tentang'])) {
                                    update_tentang($_POST);
                                }

                                ?>
                                <form method="POST">
                                    <div class="form-group mt-3">
                                        <label for="">Alamat Sekolah</label>
                                        <textarea class="form-control mt-1" name="alamat_sekolah"><?= $get_tentang['alamat_sekolah'] ?></textarea>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="">Visi Misi</label>
                                        <textarea id="visi_misi" name="visi_misi" class="mt-3"><?= $get_tentang['visi_misi'] ?></textarea>
                                    </div>

                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary" name="edit_tentang">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm">
                                <h5 class="card-title fw-semibold mb-4">Sejarah</h5>
                                <?php

                                $get_sejarah = get_sejarah();

                                if (isset($_POST['edit_sejarah'])) {
                                    update_sejarah($_POST);
                                }

                                ?>
                                <form method="POST">
                                    <div class="form-group mt-3">
                                        <textarea id="sejarah" name="sejarah" class="mt-3"><?= $get_sejarah['sejarah'] ?></textarea>
                                    </div>

                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary" name="edit_sejarah">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm">
                                        <h5 class="card-title fw-semibold mb-4">Prosedur Pendaftaran</h5>
                                        <?php

                                        $get_prosedur = get_prosedur();

                                        if (isset($_POST['edit_prosedur'])) {
                                            update_prosedur($_POST);
                                        }

                                        ?>
                                        <form method="POST">
                                            <div class="form-group mt-3">
                                                <textarea id="prosuder_pendaftaran" name="prosuder_pendaftaran" class="mt-3"><?= $get_prosedur['tahapan_pendaftaran'] ?></textarea>
                                            </div>

                                            <div class="text-end mt-3">
                                                <button class="btn btn-primary" name="edit_prosedur">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <h5 class="card-title fw-semibold mb-4">Pendidik Kependidikan</h5>
                                    <?php

                                    if (isset($_POST['save_guru'])) {
                                        save_kependidikan($_POST);
                                    }


                                    ?>
                                    <form method="POST">
                                        <div class="form-group mt-3">
                                            <label for="">Nama Guru</label>
                                            <input type="text" class="form-control mt-1" name="nama_guru">
                                        </div>

                                        <div class="text-end mt-3">
                                            <button class="btn btn-primary" name="save_guru">Tambah</button>
                                        </div>
                                    </form>

                                    <table class="table">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Guru</th>
                                            <th>Opsi</th>
                                        </tr>
                                        <?php

                                        $get_guru = get_guru('all');

                                        $no = 1;

                                        foreach ($get_guru as $gg) {

                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $gg['nama_guru'] ?></td>
                                                <td>
                                                    <a href="edit_guru.php?id_guru=<?= $gg['id_pendidik'] ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <a href="delete_guru.php?id_guru=<?= $gg['id_pendidik'] ?>" class="btn btn-danger btn-sm">Delete</a>

                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <h5 class="card-title fw-semibold mb-4">Kejuruan</h5>
                                    <?php

                                    if (isset($_POST['save_kejuruan'])) {
                                        save_kejuruan($_POST);
                                    }

                                    ?>
                                    <form method="POST">
                                        <div class="form-group mt-3">
                                            <label for="">Nama Kejuruan</label>
                                            <input type="text" class="form-control mt-1" name="nama_kejuruan">
                                        </div>

                                        <div class="text-end mt-3">
                                            <button class="btn btn-primary" name="save_kejuruan">Tambah</button>
                                        </div>
                                    </form>

                                    <table class="table">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kejuruan</th>
                                            <th>Opsi</th>
                                        </tr>
                                        <?php

                                        $get_kejuran = get_kejuruan('all');
                                        $no = 1;

                                        foreach ($get_kejuran as $gj) {

                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $gj['jurusan_sekolah'] ?></td>
                                                <td>
                                                    <a href="edit_kejuruan.php?id_kejuruan=<?= $gj['id_kejuruan'] ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <a href="delete_kejuruan.php?id_kejuruan=<?= $gj['id_kejuruan'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#sejarah').summernote();
            $('#visi_misi').summernote();
            $('#prosuder_pendaftaran').summernote();
        });
    </script>
</body>

</html>