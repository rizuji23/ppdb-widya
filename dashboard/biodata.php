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
    <title>Biodata Siswa | PPDB SMK BAKTI NUSANTARA 666</title>
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
                        <form action="">
                            <h5 class="card-title fw-semibold mb-4">Biodata Siswa</h5>
                            <div>
                                <div class="text-center">
                                    <img src="./assets/images/user.jpg" width="130" style="border-radius: 100%;" alt="">
                                </div>
                            </div>
                            <hr>

                            <div class="mb-4">
                                <h5 class="card-title fw-semibold mb-2">Data Personal</h5>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group mt-3">
                                            <label for="">Nama Siswa</label>
                                            <input type="text" class="form-control" name="nama_siswa">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Tempat Tanggal Lahir</label>
                                            <div class="d-flex">
                                                <div class="me-2">
                                                    <input type="text" class="form-control" name="tempat">
                                                </div>
                                                <div>
                                                    <input type="date" class="form-control" name="tanggal_lahir">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Jenis Kelamin</label>
                                            <select name="" class="form-control" id="">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Agama</label>
                                            <input type="text" class="form-control" name="agama">
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="form-group mt-3">
                                            <label for="">Alamat Tempat Tinggal</label>
                                            <textarea cols="10" rows="5" class="form-control" name="alamat_sekarang"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="mb-4">
                                <h5 class="card-title fw-semibold mb-2">Data Sekolah</h5>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group mt-3">
                                            <label for="">NISN</label>
                                            <input type="number" class="form-control" name="nisn">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Sekolah Asal</label>
                                            <input type="text" class="form-control" name="sekolah_asal">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Alamat Sekolah Asal</label>
                                            <textarea cols="10" rows="5" class="form-control" name="alamat_sekolah_asal"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group mt-3">
                                            <label for="">Nomer Peserta Ujian</label>
                                            <input type="number" class="form-control" name="nisn">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Nomer STTB atau Tahun Lulus</label>
                                            <input type="number" class="form-control" name="nisn">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Nomor SKHUN</label>
                                            <input type="number" class="form-control" name="nisn">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Jumlah Nilai STTB</label>
                                            <input type="number" class="form-control" name="nisn">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="mb-4">
                                <h5 class="card-title fw-semibold mb-3">Data Orang Tua</h5>
                                <div class="row">
                                    <div class="col-sm">
                                        <h5 class="card-title fw-semibold mb-2">Ibu</h5>
                                        <div class="form-group mt-3">
                                            <label for="">Nama Ibu</label>
                                            <input type="text" class="form-control" name="sekolah_asal">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Tempat Tanggal Lahir</label>
                                            <div class="d-flex">
                                                <div class="me-2">
                                                    <input type="text" class="form-control" name="tempat">
                                                </div>
                                                <div>
                                                    <input type="date" class="form-control" name="tanggal_lahir">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Agama</label>
                                            <input type="text" class="form-control" name="agama">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Pekerjaan</label>
                                            <input type="text" class="form-control" name="sekolah_asal">
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <h5 class="card-title fw-semibold mb-2">Ayah</h5>
                                        <div class="form-group mt-3">
                                            <label for="">Nama Ayah</label>
                                            <input type="text" class="form-control" name="sekolah_asal">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Tempat Tanggal Lahir</label>
                                            <div class="d-flex">
                                                <div class="me-2">
                                                    <input type="text" class="form-control" name="tempat">
                                                </div>
                                                <div>
                                                    <input type="date" class="form-control" name="tanggal_lahir">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Agama</label>
                                            <input type="text" class="form-control" name="agama">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Pekerjaan</label>
                                            <input type="text" class="form-control" name="sekolah_asal">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="">Nomer Telepon</label>
                                    <input type="number" class="form-control" name="sekolah_asal">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Nomer Telepon Darurat</label>
                                    <input type="number" class="form-control" name="sekolah_asal">
                                </div>
                            </div>
                            <hr>
                            <div class="mb-4">
                                <h5 class="card-title fw-semibold mb-2">Data File Pelengkap</h5>
                                <div class="form-group mt-3">
                                    <label for="">Foto Surat Kelulusan</label>
                                    <input type="file" class="form-control" name="sekolah_asal">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="">Foto Surat Kelakukan Baik</label>
                                    <input type="file" class="form-control" name="sekolah_asal">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="">Foto Pas Foto</label>
                                    <input type="file" class="form-control" name="sekolah_asal">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="">Foto Akta Kelahiran</label>
                                    <input type="file" class="form-control" name="sekolah_asal">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="">Foto Kartu Keluarga</label>
                                    <input type="file" class="form-control" name="sekolah_asal">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="">Foto KTP Orang Tua</label>
                                    <input type="file" class="form-control" name="sekolah_asal">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="">Foto Ijazah</label>
                                    <input type="file" class="form-control" name="sekolah_asal">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="">Foto SKHUN</label>
                                    <input type="file" class="form-control" name="sekolah_asal">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="">Foto Kartu KIP</label>
                                    <input type="file" class="form-control" name="sekolah_asal">
                                </div>
                            </div>

                            <div class="float-end">
                                <button class="btn btn-primary">Simpan</button>
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