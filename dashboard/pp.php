<?php
$file = get_file($_SESSION['id_siswa']);
if ($file != false) {
?>
    <img src="./media/<?= $file['foto_pas'] ?>" width="100" style="border-radius: 100%;" alt="">
<?php
} else {
?>
    <img src="assets/images/user.jpg" width="100" style="border-radius: 100%;" alt="">

<?php
}
?>