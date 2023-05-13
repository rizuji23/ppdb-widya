<?php
session_start();
require 'connection.php';
require 'system.php';


function register($data)
{
    global $connect;

    $nama_siswa = htmlspecialchars($data['nama_siswa']);
    $ttl = htmlspecialchars($data['ttl']);
    $asal_sekolah = htmlspecialchars($data['asal_sekolah']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars(md5($data['password']));

    $id_siswa = uniqid();

    $save = mysqli_query($connect, "INSERT INTO user_siswa VALUES(NULL, '$id_siswa', '$nama_siswa', '$username', '$password', '$ttl', '$asal_sekolah')");

    if ($save) {
        redirect_msg("login.php", 'Siswa terdaftar.');
    } else {
        redirect_msg("register.php", 'Siswa gagal terdaftar.');
    }
}


function login($data)
{
    global $connect;

    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars(md5($data['password']));

    #check siswa first
    $check_siswa = mysqli_query($connect, "SELECT * FROM user_siswa WHERE username = '$username' AND password = '$password'");
    $cs = mysqli_fetch_assoc($check_siswa);
    $num = mysqli_num_rows($check_siswa);

    if ($num != 0) {
        if ($cs['username'] == $username && $cs['password'] == $password) {
            $_SESSION['username'] = $username;
            $_SESSION['level'] = 3;
            $_SESSION['id_siswa'] = $cs['id_siswa'];

            redirect_msg("dashboard/index.php", "Selamat Datang");
        } else {
            # check petugas
            $check_petugas = mysqli_query($connect, "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'");
            $cp = mysqli_fetch_assoc($check_petugas);
            $nums = mysqli_num_rows($check_petugas);

            if ($nums != 0) {
                if ($cp['username'] == $username && $cp['password'] == $password) {
                    $_SESSION['username'] = $username;
                    $_SESSION['level'] = $cs['level'];
                    $_SESSION['id_siswa'] = $cs['id_siswa'];

                    redirect_msg("dashboard/index.php", "Selamat Datang");
                } else {
                    redirect_msg("login.php", "Username atau Password salah!!");
                }
            } else {
                redirect_msg("login.php", "Username atau Password salah!!");
            }
        }
    } else {
        redirect_msg("login.php", "Username atau Password salah!!");
    }
}

function get_user($username, $level)
{
    global $connect;
    $table = "";
    if ($level == 3) {
        $table = "user_siswa";
    } else {
        $table = "petugas";
    }

    $get_user = mysqli_query($connect, "SELECT * FROM $table WHERE username = '$username'");
    $gu = mysqli_fetch_assoc($get_user);

    return $gu;
}

function check_biodata($id_siswa)
{
    global $connect;
    $check = mysqli_query($connect, "SELECT * FROM user_siswa WHERE id_siswa = '$id_siswa'");
    $c = mysqli_num_rows($check);

    if ($c != 0) {
        return false;
    } else {
        return true;
    }
}

function get_biodata($id_siswa)
{
    global $connect;

    $biodata = mysqli_query($connect, "SELECT * FROM biodata_siswa WHERE id_siswa = '$id_siswa'");
    $c = mysqli_num_rows($biodata);

    if ($c != 0) {
        $bo = mysqli_fetch_assoc($biodata);

        return $bo;
    } else {
        return false;
    }
}
