<?php

require '../system/controller.php';

$id_pendidik = $_GET['id_guru'];

$delete = mysqli_query($connect, "DELETE FROM pendidik_kependidikan WHERE id_pendidik = '$id_pendidik'");


if ($update) {
    redirect_msg("tampilan.php", "Berhasil dihapus");
} else {
    redirect_msg("tampilan.php", "Gagal dihapus!");
}
