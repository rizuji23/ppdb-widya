<?php

function redirect_msg($to, $message)
{
    echo "<script>alert('$message'); document.location.href = '$to'</script>";
}


function get_level($level)
{
    if ($level == 3) {
        return "Siswa";
    } else if ($level == 2) {
        return "Petugas";
    } else if ($level == 3) {
        return "Admin";
    }
}

function rupiah($angka)
{

    $hasil_rupiah = number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
