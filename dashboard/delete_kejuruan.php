<?php

require '../system/controller.php';

$id_kejuruan = $_GET['id_kejuruan'];

$delete = mysqli_query($connect, "DELETE FROM kejuruan WHERE id_kejuruan = '$id_kejuruan'");


if ($update) {
    redirect_msg("tampilan.php", "Berhasil dihapus");
} else {
    redirect_msg("tampilan.php", "Gagal dihapus!");
}
