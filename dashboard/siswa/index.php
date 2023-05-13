<?php

$check_biodata = check_biodata($_SESSION['id_siswa']);

if (!$check_biodata) {
?>
    <div class="alert alert-danger">
        <span>Silahkan lengkapi biodata siswa <a href="#">Klik disini</a>.</span>
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
                        <img src="assets/images/user.jpg" width="100" style="border-radius: 100%;" alt="">
                    </div>
                    <div class="w-100">
                        <h4 class="fw-semibold mb-0">Nama</h4>
                        <p style="font-size: 20px" class="mb-0"><?php

                                                                $user = get_user($_SESSION['username'], $_SESSION['level']);

                                                                echo $user['nama'];

                                                                ?></p>
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

                        <div class="d-flex mt-3">
                            <?php $bo = get_biodata($_SESSION['id_siswa']);

                            if ($bo != false) {
                            } else {
                            ?>
                                <p class="text-danger">Data tidak lengkap!.</p>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                <a href="#" class="btn btn-primary float-end mt-0 btn-sm">Ganti Biodata</a>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <!-- Monthly Earnings -->
        <div class="card">
            <div class="card-body">
                <div class="row alig n-items-start">
                    <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold">Total Pembayaran </h5>
                        <h4 class="fw-semibold mb-3">Rp. 1.500.000</h4>

                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-end">
                            <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                <i class="ti ti-currency-dollar fs-6"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" class="btn btn-primary float-end mt-3 btn-sm">Kelola Keuangan</a>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Pembayaran Terbaru</h5>
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
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">1</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">Sunil Joshi</h6>
                                    <span class="fw-normal">Web Designer</span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">Elite Admin</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-primary rounded-3 fw-semibold">Low</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">$3.9</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">2</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">Andrew McDownland</h6>
                                    <span class="fw-normal">Project Manager</span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">Real Homes WP Theme</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-secondary rounded-3 fw-semibold">Medium</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">$24.5k</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">3</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">Christopher Jamil</h6>
                                    <span class="fw-normal">Project Manager</span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">MedicalPro WP Theme</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-danger rounded-3 fw-semibold">High</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">$12.8k</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">4</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">Nirav Joshi</h6>
                                    <span class="fw-normal">Frontend Engineer</span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">Hosting Press HTML</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-success rounded-3 fw-semibold">Critical</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">$2.4k</h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card overflow-hidden rounded-2">
            <div class="position-relative">
                <a href="javascript:void(0)"><img src="assets/images/products/s4.jpg" class="card-img-top rounded-0" alt="..."></a>
                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
            </div>
            <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Boat Headphone</h6>
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="fw-semibold fs-4 mb-0">$50 <span class="ms-2 fw-normal text-muted fs-3"><del>$65</del></span></h6>
                    <ul class="list-unstyled d-flex align-items-center mb-0">
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card overflow-hidden rounded-2">
            <div class="position-relative">
                <a href="javascript:void(0)"><img src="assets/images/products/s5.jpg" class="card-img-top rounded-0" alt="..."></a>
                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
            </div>
            <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">MacBook Air Pro</h6>
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="fw-semibold fs-4 mb-0">$650 <span class="ms-2 fw-normal text-muted fs-3"><del>$900</del></span></h6>
                    <ul class="list-unstyled d-flex align-items-center mb-0">
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card overflow-hidden rounded-2">
            <div class="position-relative">
                <a href="javascript:void(0)"><img src="assets/images/products/s7.jpg" class="card-img-top rounded-0" alt="..."></a>
                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
            </div>
            <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Red Valvet Dress</h6>
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="fw-semibold fs-4 mb-0">$150 <span class="ms-2 fw-normal text-muted fs-3"><del>$200</del></span></h6>
                    <ul class="list-unstyled d-flex align-items-center mb-0">
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card overflow-hidden rounded-2">
            <div class="position-relative">
                <a href="javascript:void(0)"><img src="assets/images/products/s11.jpg" class="card-img-top rounded-0" alt="..."></a>
                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
            </div>
            <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Cute Soft Teddybear</h6>
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="fw-semibold fs-4 mb-0">$285 <span class="ms-2 fw-normal text-muted fs-3"><del>$345</del></span></h6>
                    <ul class="list-unstyled d-flex align-items-center mb-0">
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>