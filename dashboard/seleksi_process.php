<?php

require '../system/controller.php';

$status = $_GET['status'];
$id_siswa = $_GET['id_siswa'];
$status_f = "";

if ($status == 'lulus') {
    $status_f = 'Lulus';
} else {
    $status_f = 'Tidak Lulus';
}

$update = mysqli_query($connect, "UPDATE seleksi SET status = '$status_f', progress = '100' WHERE id_siswa = '$id_siswa'");

if ($update) {
    redirect_msg("seleksi.php", "Berhasil Diubah status");
} else {
    redirect_msg("seleksi.php", "Gagal Diubah status!");
}
