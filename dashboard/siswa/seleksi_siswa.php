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