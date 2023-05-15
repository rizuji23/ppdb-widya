<?php

$check_biodata = check_biodata($_SESSION['id_siswa']);
if (!$check_biodata) {
?>
    <div class="alert alert-danger">
        <span>Silahkan lengkapi biodata siswa <a href="biodata.php">Klik disini</a>.</span>
    </div>
<?php
}

?>

<div class="row">
    <div class="col-sm">
        <!-- Yearly Breakup -->
        <div class="card overflow-hidden">
            <div class="card-body p-4">
                <h5 class="card-title mb-9 fw-semibold">Data Siswa</h5>
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
                <a href="biodata.php" class="btn btn-primary float-end mt-0 btn-sm">Ganti Biodata</a>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <!-- Monthly Earnings -->
        <div class="card">
            <div class="card-body">
                <div class="row alig n-items-start">
                    <div class="col-8">
                        <?php
                        $count = get_count_pembayaran($_SESSION['id_siswa']);

                        ?>
                        <h5 class="card-title mb-9 fw-semibold">Total Pembayaran </h5>
                        <h4 class="fw-semibold mb-3">Rp. <?php echo rupiah($count['count']); ?></h4>

                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-end">
                            <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                <i class="ti ti-currency-dollar fs-6"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="list_pembayaran.php" class="btn btn-primary float-end mt-3 btn-sm">Kelola Keuangan</a>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="row mb-3">
                    <div class="col-sm">
                        <h5 class="card-title fw-semibold mb-4">Pembayaran Terbaru</h5>
                    </div>
                    <div class="col-sm text-end">
                        <a href="tambah_pembayaran.php" class="btn btn-primary">Tambah Pembayaran Baru</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Id Pembayaran</h6>
                                </th>

                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Jumlah Bayar</h6>
                                </th>

                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Tanggal</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Opsi</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $pemb = get_limit_pembayaran($_SESSION['id_siswa']);
                            $no = 1;
                            foreach ($pemb as $p) {
                            ?>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0"><?php echo $no++; ?></h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1"><?= $p['id_pembayaran'] ?></h6>

                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Rp. <?= rupiah($p['jumlah_bayar']) ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $p['created_at'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 fs-4"><a class="btn btn-info btn-sm" href="detail_pembayaran.php?id_pembayaran=<?php echo $p['id_pembayaran'] ?>">Detail</a></h6>
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