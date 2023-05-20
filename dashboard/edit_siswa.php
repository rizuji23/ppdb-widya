<?php

require '../system/controller.php';

if (empty($_SESSION['username']) && $_SESSION['level'] == 2 || $_SESSION['level'] == 1) {
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
            <?php include './include/navbar.php'; ?>

            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                <div class="card">
                    <div class="card-body">
                        <?php

                        $get = get_siswa_detail($_GET['id_siswa']);
                        $ttl = explode(" ", $get['ttl']);
                        if (isset($_POST['save'])){
                            edit_siswa($_POST, $get);
                        }
                        ?>
                        <form method="POST" enctype="multipart/form-data">
                            <h5 class="card-title fw-semibold mb-4">Edit Siswa</h5>
                            <div>
                                <div class="text-center">
                                    <img src="./media/<?= $get['foto_pas'] ?>" width="100" style="border-radius: 100%;" alt="">
                                </div>
                            </div>
                            <hr>

                            <div class="mb-4">
                                <h5 class="card-title fw-semibold mb-2">Data Personal</h5>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group mt-3">
                                            <label for="">Nama Siswa</label>
                                            <input type="text" value="<?= $get['nama'] ?>" class="form-control" name="nama_siswa">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Tempat Tanggal Lahir</label>
                                            <div class="d-flex">
                                                <div class="me-2">
                                                    <input type="text" value="<?= $ttl[0] ?>" class="form-control" name="tempat">
                                                </div>
                                                <div>
                                                    <input type="date" value="<?= $ttl[1] ?>" class="form-control" name="tanggal_lahir">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Jenis Kelamin</label>
                                            <select name="jk" class="form-control" id="">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="Laki-Laki" <?= $get['jk'] == 'Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
                                                <option value="Perempuan" <?= $get['jk'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Agama</label>
                                            <input type="text" value="<?= $get['agama'] ?>" class="form-control" name="agama">
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="form-group mt-3">
                                            <label for="">Alamat Tempat Tinggal</label>
                                            <textarea cols="10" rows="5" class="form-control" name="alamat_sekarang"><?= $get['alamat_sekarang'] ?></textarea>
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
                                            <input type="number" class="form-control" value="<?= $get['nisn'] ?>" name="nisn">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Sekolah Asal</label>
                                            <input type="text" value="<?= $get['asal_sekolah'] ?>" class="form-control" name="sekolah_asal">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Alamat Sekolah Asal</label>
                                            <textarea cols="10" rows="5" class="form-control" name="alamat_sekolah_asal"><?= $get['alamat_sekolah_asal'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group mt-3">
                                            <label for="">Nomer Peserta Ujian</label>
                                            <input type="number" class="form-control" value="<?= $get['nomor_peserta_ujian'] ?>" name="nomer_peserta_ujian">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Nomer STTB atau Tahun Lulus</label>
                                            <input type="number" value="<?= $get['nomor_sttb'] ?>" class="form-control" name="nomer_sttb">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Nomor SKHUN</label>
                                            <input type="number" value="<?= $get['nomor_skhun'] ?>" class="form-control" name="nomor_skhun">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Jumlah Nilai STTB</label>
                                            <input type="number" class="form-control" value="<?= $get['nilai_sttb'] ?>" name="jumlah_sttb">
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
                                            <input type="text" value="<?= $get['nama_ibu'] ?>" class="form-control" name="nama_ibu">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Tempat Tanggal Lahir</label>
                                            <div class="d-flex">
                                                <div class="me-2">
                                                    <input type="text" class="form-control" value="<?= explode(" ", $get['ttl_ibu'])[0] ?>" name="tempat_ibu">
                                                </div>
                                                <div>
                                                    <input type="date" class="form-control" value="<?= explode(" ", $get['ttl_ibu'])[1] ?>" name="tanggal_lahir_ibu">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Agama</label>
                                            <input type="text" class="form-control" value="<?= $get['agama_ibu'] ?>" name="agama_ibu">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Pekerjaan</label>
                                            <input type="text" class="form-control" value="<?= $get['pekerjaan_ibu'] ?>" name="pekerjaan_ibu">
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <h5 class="card-title fw-semibold mb-2">Ayah</h5>
                                        <div class="form-group mt-3">
                                            <label for="">Nama Ayah</label>
                                            <input type="text" class="form-control" value="<?= $get['nama_ayah'] ?>" name="nama_ayah">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Tempat Tanggal Lahir</label>
                                            <div class="d-flex">
                                                <div class="me-2">
                                                    <input type="text" class="form-control" value="<?= explode(" ", $get['ttl_ayah'])[0] ?>" name="tempat_ayah">
                                                </div>
                                                <div>
                                                    <input type="date" class="form-control" value="<?= explode(" ", $get['ttl_ayah'])[1] ?>" name="tanggal_lahir_ayah">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Agama</label>
                                            <input type="text" value="<?= $get['agama_ayah'] ?>" class="form-control" name="agama_ayah">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Pekerjaan</label>
                                            <input type="text" value="<?= $get['pekerjaan_ayah'] ?>" class="form-control" name="pekerjaan_ayah">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="">Nomer Telepon</label>
                                    <input type="number" class="form-control" value="<?= $get['no_telp'] ?>" name="no_telp">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Nomer Telepon Darurat</label>
                                    <input type="number" class="form-control" value="<?= $get['no_darurat'] ?>" name="no_telp_darurat">
                                </div>
                            </div>
                            <hr>
                            <div class="mb-4">
                                <h5 class="card-title fw-semibold mb-2">Data File Pelengkap</h5>
                                <div class="form-group mt-3">
                                    <label for="">Foto Surat Kelulusan</label>
                                    <br>
                                    <a href="./media/<?= $get['foto_surat_kelulusan'] ?>" class="btn btn-primary btn-sm mt-2" download>Download File</a>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Edit Foto Surat Kelulusan</label>
                                    <input type="file" class="form-control" name="foto_surat_kelulusan" accept="image/png, image/jpeg, image/webp, image/jpg">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Foto Surat Kelakukan Baik</label>
                                    <br>
                                    <a href="./media/<?= $get['foto_surat_kelakuan'] ?>" class="btn btn-primary btn-sm mt-2" download>Download File</a>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Edit Foto Surat Kelakukan Baik</label>
                                    <input type="file" class="form-control" name="foto_surat_kelakuan" accept="image/png, image/jpeg, image/webp, image/jpg">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Foto Pas Foto</label>
                                    <br>
                                    <a href="./media/<?= $get['foto_pas'] ?>" class="btn btn-primary btn-sm mt-2" download>Download File</a>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Edit Foto Pas Foto</label>
                                    <input type="file" class="form-control" name="foto_pas" accept="image/png, image/jpeg, image/webp, image/jpg">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Foto Akta Kelahiran</label>
                                    <br>
                                    <a href="./media/<?= $get['foto_akta'] ?>" class="btn btn-primary btn-sm mt-2" download>Download File</a>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Edit Foto Akta Kelahiran</label>
                                    <input type="file" class="form-control" name="foto_akta" accept="image/png, image/jpeg, image/webp, image/jpg">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Foto Kartu Keluarga</label>
                                    <br>
                                    <a href="./media/<?= $get['foto_kk'] ?>" class="btn btn-primary btn-sm mt-2" download>Download File</a>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Edit Foto Kartu Keluarga</label>
                                    <input type="file" class="form-control" name="foto_kk" accept="image/png, image/jpeg, image/webp, image/jpg">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Foto KTP Orang Tua</label>
                                    <br>
                                    <a href="./media/<?= $get['foto_ktp'] ?>" class="btn btn-primary btn-sm mt-2" download>Download File</a>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Edit Foto KTP Orang Tua</label>
                                    <input type="file" class="form-control" name="foto_ktp" accept="image/png, image/jpeg, image/webp, image/jpg">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Foto Ijazah</label>
                                    <br>
                                    <a href="./media/<?= $get['foto_ijazah'] ?>" class="btn btn-primary btn-sm mt-2" download>Download File</a>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Edit Foto Ijazah</label>
                                    <input type="file" class="form-control" name="foto_ijazah" accept="image/png, image/jpeg, image/webp, image/jpg">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Foto SKHUN</label>
                                    <br>
                                    <a href="./media/<?= $get['foto_skhun'] ?>" class="btn btn-primary btn-sm mt-2" download>Download File</a>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Edit Foto SKHUN</label>
                                    <input type="file" class="form-control" name="foto_skhun" accept="image/png, image/jpeg, image/webp, image/jpg">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Foto Kartu KIP</label>
                                    <br>
                                    <a href="./media/<?= $get['foto_kip'] ?>" class="btn btn-primary btn-sm mt-2" download>Download File</a>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Edit Foto Kartu KIP</label>
                                    <input type="file" class="form-control" name="foto_kip" accept="image/png, image/jpeg, image/webp, image/jpg">
                                </div>
                            </div>

                            <hr>
                            <div class="mb-4">
                                <h5 class="card-title fw-semibold mb-3">Data Pembayaran</h5>
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Pembayaran</th>
                                            <th>Jumlah Bayar</th>
                                            <th>Tanggal</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $get_pemb = get_pembayaran($_GET['id_siswa']);

                                        $no = 1;
                                        $total_pemb = 0;
                                        foreach ($get_pemb as $gb) {
                                            $total_pemb += $gb['jumlah_bayar'];
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $gb['id_pembayaran'] ?></td>
                                                <td>Rp. <?= rupiah($gb['jumlah_bayar']) ?></td>
                                                <td><?= $gb['created_at'] ?></td>
                                                <td><a class="btn btn-info btn-sm" href="edit_pembayaran.php?id_pembayaran=<?php echo $gb['id_pembayaran'] ?>">Edit</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <h5 class="text-end mt-4 mb-4">Total Pembayaran: Rp. <?php echo rupiah($total_pemb); ?></h5>
                            </div>

                            <div class="float-end">
                                <button class="btn btn-success me-3" type="submit" name="save">Simpan</button>
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