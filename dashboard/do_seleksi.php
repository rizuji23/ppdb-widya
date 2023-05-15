<?php

include '../system/controller.php';

$id_siswa = $_GET['id_siswa'];
$id_seleksi = uniqid();

$check = get_biodata($id_siswa);
$date = date('Y-m-d');
$save = mysqli_query($connect, "INSERT INTO seleksi VALUES(NULL, '$id_seleksi', '$id_siswa', '" . $check['id_daftar'] . "', 'Sedang Diproses', '20', '$date')");

if ($save) {
    redirect_msg("seleksi.php", "Berhasil Disimpan");
} else {
    redirect_msg("seleksi.php", "Gagal Disimpan!");
}
