<div class="row">
    <div class="col-sm">
        <div class="card overflow-hidden">
            <div class="card-body p-4">
                <div class="row alig n-items-start">
                    <div class="col-8">
                        <?php $get_count = get_count_siswa(null); ?>
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
                    <?php $get_sum = get_count_pembayaran('all') ?>
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
                <a href="list_pembayaran.php" class="btn btn-primary float-end mt-3 btn-sm">Kelola Keuangan</a>
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

<div class="row">
    <div class="">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="row mb-3">
                    <div class="col-sm">
                        <h5 class="card-title fw-semibold mb-4">Pembayaran Terbaru</h5>
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
                                    <h6 class="fw-semibold mb-0">Nama Siswa</h6>
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
                            $pemb = get_limit_pembayaran('all');
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
                                        <h6 class="fw-semibold mb-1"><?= $p['nama'] ?></h6>

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