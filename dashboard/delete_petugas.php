<?php

require '../system/controller.php';

$id_petugas = $_GET['id_petugas'];

$delete = mysqli_query($connect, "DELETE FROM petugas WHERE id_petugas = '$id_petugas'");


if ($update) {
    redirect_msg("list_user.php", "Berhasil dihapus");
} else {
    redirect_msg("list_user.php", "Gagal dihapus!");
}
