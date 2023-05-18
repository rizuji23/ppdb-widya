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
        }
    } else {
        # check petugas
        $check_petugas = mysqli_query($connect, "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'");
        $cp = mysqli_fetch_assoc($check_petugas);
        $nums = mysqli_num_rows($check_petugas);

        if ($nums != 0) {
            if ($cp['username'] == $username && $cp['password'] == $password) {
                $_SESSION['username'] = $username;
                $_SESSION['level'] = $cp['level_akses'];
                $_SESSION['id_siswa'] = "";

                redirect_msg("dashboard/index.php", "Selamat Datang Petugas");
            } else {
                redirect_msg("login.php", "Username atau Password salah!!");
            }
        } else {
            redirect_msg("login.php", "Username atau Password salah!!");
        }
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
        return true;
    } else {
        return false;
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

function get_file($id_siswa)
{
    global $connect;
    $biodata = mysqli_query($connect, "SELECT * FROM file_siswa WHERE id_siswa = '$id_siswa'");
    $c = mysqli_num_rows($biodata);

    if ($c != 0) {
        $bo = mysqli_fetch_assoc($biodata);
        return $bo;
    } else {
        return false;
    }
}

function check_seleksi($id_siswa)
{
    global $connect;
    $seleksi = mysqli_query($connect, "SELECT * FROM seleksi WHERE id_siswa = '$id_siswa'");
    $s = mysqli_num_rows($seleksi);


    if ($s != 0) {
        $se = mysqli_fetch_assoc($seleksi);
        return $se;
    } else {
        return false;
    }
}

function get_count_pembayaran($id_siswa)
{
    global $connect;
    if (!empty($id_siswa['tipe_filter'])) {
        $tipe_filter = htmlspecialchars($id_siswa['tipe_filter']);
        if ($tipe_filter == 'Semua') {
            $get_siswa = mysqli_query($connect, "SELECT SUM(jumlah_bayar) AS count FROM pembayaran");
            $gs = mysqli_fetch_assoc($get_siswa);

            return $gs;
        } else if ($tipe_filter == 'Tanggal') {
            $start_date = htmlspecialchars($id_siswa['start_date']);
            $end_date = htmlspecialchars($id_siswa['end_date']);

            $get_siswa = mysqli_query($connect, "SELECT SUM(jumlah_bayar) AS count FROM pembayaran WHERE tanggal_daftar BETWEEN '$start_date' AND '$end_date'");
            $gs = mysqli_fetch_assoc($get_siswa);

            return $gs;
        } else if ($tipe_filter == 'Bulan') {
            $bulan = htmlspecialchars($id_siswa['bulan']);

            $get = mysqli_query($connect, "SELECT SUM(jumlah_bayar) AS count FROM pembayaran WHERE DATE_FORMAT(tanggal_daftar, '%Y-%m') = '$bulan'");
            $gs = mysqli_fetch_assoc($get);

            return $gs;
        }
    } else {
        if ($id_siswa != "all") {
            $get = mysqli_query($connect, "SELECT SUM(jumlah_bayar) AS count FROM pembayaran WHERE id_siswa = '$id_siswa'");
            $g = mysqli_fetch_assoc($get);
            return $g;
        } else {
            $get = mysqli_query($connect, "SELECT SUM(jumlah_bayar) AS count FROM pembayaran");
            $g = mysqli_fetch_assoc($get);
            return $g;
        }
    }
}

function get_pembayaran($id_siswa)
{
    global $connect;
    if ($id_siswa != "all") {
        $get = mysqli_query($connect, "SELECT * FROM pembayaran WHERE id_siswa = '$id_siswa'");
        return $get;
    } else {
        $get = mysqli_query($connect, "SELECT * FROM pembayaran INNER JOIN user_siswa ON pembayaran.id_siswa = user_siswa.id_siswa");
        return $get;
    }
}

function get_limit_pembayaran($id_siswa)
{
    global $connect;
    if ($id_siswa != "all") {
        $get = mysqli_query($connect, "SELECT * FROM pembayaran WHERE id_siswa = '$id_siswa' ORDER BY id LIMIT 5");
        return $get;
    } else {
        $get = mysqli_query($connect, "SELECT * FROM pembayaran INNER JOIN user_siswa ON pembayaran.id_siswa = user_siswa.id_siswa ORDER BY pembayaran.id LIMIT 5");
        return $get;
    }
}

function get_selected_pembayaran($id_pembayaran)
{
    global $connect;
    $get = mysqli_query($connect, "SELECT * FROM pembayaran INNER JOIN user_siswa ON pembayaran.id_siswa = user_siswa.id_siswa WHERE pembayaran.id_pembayaran = '$id_pembayaran'");
    $g = mysqli_fetch_assoc($get);

    return $g;
}

function get_seleksi_count($status)
{
    global $connect;

    if ($status == 'lulus') {
        $get = mysqli_query($connect, "SELECT COUNT(id) as count FROM seleksi WHERE status = 'Lulus'");
        $g = mysqli_fetch_assoc($get);
        return $g;
    } else {
        $get = mysqli_query($connect, "SELECT COUNT(id) as count FROM seleksi WHERE status = 'Tidak Lulus'");
        $g = mysqli_fetch_assoc($get);
        return $g;
    }
}

function get_seleksi_all()
{
    global $connect;

    $get_all = mysqli_query($connect, "SELECT * FROM seleksi INNER JOIN user_siswa ON seleksi.id_siswa = user_siswa.id_siswa ORDER BY seleksi.id DESC");
    return $get_all;
}

function get_siswa_detail($id_siswa)
{
    global $connect;

    $get = mysqli_query($connect, "SELECT * FROM user_siswa INNER JOIN biodata_siswa ON user_siswa.id_siswa = biodata_siswa.id_siswa INNER JOIN pembayaran ON user_siswa.id_siswa = pembayaran.id_siswa INNER JOIN seleksi ON user_siswa.id_siswa = seleksi.id_siswa INNER JOIN file_siswa ON user_siswa.id_siswa = file_siswa.id_siswa WHERE user_siswa.id_siswa = '$id_siswa'");

    $g = mysqli_fetch_assoc($get);

    return $g;
}

function save_pembayaran($data, $id_siswa)
{
    global $connect;

    $jumlah_bayar = htmlspecialchars($data['jumlah_bayar']);
    $bukti_bayar = $_FILES['bukti_bayar'];
    $dirupload = '../dashboard/media/';
    $id_pembayaran = uniqid();
    $date = date('Y-m-d');

    $upload_bukti = move_uploaded_file($bukti_bayar['tmp_name'], $dirupload . uniqid() . "bukti_bayar" . $bukti_bayar['name']);

    if ($upload_bukti) {
        $save = mysqli_query($connect, "INSERT INTO pembayaran VALUES(NULL, '$id_pembayaran', '$id_siswa', '$jumlah_bayar', '" . $bukti_bayar['name'] . "', '$date')");

        if ($save) {
            redirect_msg("list_pembayaran.php", "Berhasil Disimpan");
        } else {
            redirect_msg("tambah_pembayaran.php", "Gagal disimpan!");
        }
    }
}

function get_count_siswa($data)
{
    global $connect;

    if ($data != null) {
        $tipe_filter = htmlspecialchars($data['tipe_filter']);
        if ($tipe_filter == 'Semua') {
            $get_siswa = mysqli_query($connect, "SELECT COUNT(id) as count FROM user_siswa");
            $gs = mysqli_fetch_assoc($get_siswa);

            return $gs;
        } else if ($tipe_filter == 'Tanggal') {
            $start_date = htmlspecialchars($data['start_date']);
            $end_date = htmlspecialchars($data['end_date']);

            $get_siswa = mysqli_query($connect, "SELECT COUNT(user_siswa.id) as count FROM user_siswa INNER JOIN biodata_siswa ON user_siswa.id_siswa = biodata_siswa.id_siswa WHERE biodata_siswa.tanggal_daftar BETWEEN '$start_date' AND '$end_date'");
            $gs = mysqli_fetch_assoc($get_siswa);

            return $gs;
        } else if ($tipe_filter == 'Bulan') {
            $bulan = htmlspecialchars($data['bulan']);

            $get = mysqli_query($connect, "SELECT COUNT(user_siswa.id) FROM user_siswa INNER JOIN biodata_siswa ON user_siswa.id_siswa = biodata_siswa.id_siswa INNER JOIN seleksi ON user_siswa.id_siswa = seleksi.id_siswa WHERE DATE_FORMAT(biodata_siswa.tanggal_daftar, '%Y-%m') = '$bulan' ");
            $gs = mysqli_fetch_assoc($get);

            return $gs;
        }
    } else {
        $get_siswa = mysqli_query($connect, "SELECT COUNT(id) as count FROM user_siswa");
        $gs = mysqli_fetch_assoc($get_siswa);

        return $gs;
    }
}

function print_laporan($data)
{
    global $connect;

    $tipe_filter = htmlspecialchars($data['tipe_filter']);

    if ($tipe_filter == 'Semua') {
        $get = mysqli_query($connect, "SELECT * FROM user_siswa INNER JOIN biodata_siswa ON user_siswa.id_siswa = biodata_siswa.id_siswa INNER JOIN seleksi ON user_siswa.id_siswa = seleksi.id_siswa");
        return $get;
    } else if ($tipe_filter == 'Tanggal') {
        $start_date = htmlspecialchars($data['start_date']);
        $end_date = htmlspecialchars($data['end_date']);

        $get = mysqli_query($connect, "SELECT * FROM user_siswa INNER JOIN biodata_siswa ON user_siswa.id_siswa = biodata_siswa.id_siswa INNER JOIN seleksi ON user_siswa.id_siswa = seleksi.id_siswa WHERE biodata_siswa.tanggal_daftar BETWEEN '$start_date' AND '$end_date'");

        return $get;
    } else if ($tipe_filter == 'Bulan') {
        $bulan = htmlspecialchars($data['bulan']);

        $get = mysqli_query($connect, "SELECT * FROM user_siswa INNER JOIN biodata_siswa ON user_siswa.id_siswa = biodata_siswa.id_siswa INNER JOIN seleksi ON user_siswa.id_siswa = seleksi.id_siswa WHERE DATE_FORMAT(biodata_siswa.tanggal_daftar, '%Y-%m') = '$bulan' ");
        return $get;
    }
}

function save_bodata($data, $id_siswa)
{
    global $connect;

    $nama_siswa = htmlspecialchars($data['nama_siswa']);
    $tempat = htmlspecialchars($data['tempat']);
    $tanggal_lahir = htmlspecialchars($data['tanggal_lahir']);
    $jk = htmlspecialchars($data['jk']);
    $agama = htmlspecialchars($data['agama']);
    $alamat_sekarang = htmlspecialchars($data['alamat_sekarang']);
    $nisn = htmlspecialchars($data['nisn']);
    $alamat_sekolah_asal = htmlspecialchars($data['alamat_sekolah_asal']);
    $nomer_peserta_ujian = htmlspecialchars($data['nomer_peserta_ujian']);
    $nomer_sttb = htmlspecialchars($data['nomer_sttb']);
    $nomer_skhun = htmlspecialchars($data['nomor_skhun']);
    $jumlah_sttb = htmlspecialchars($data['jumlah_sttb']);

    $nama_ibu = htmlspecialchars($data['nama_ibu']);
    $tempat_ibu = htmlspecialchars($data['tempat_ibu']);
    $tanggal_lahir_ibu = htmlspecialchars($data['tanggal_lahir_ibu']);
    $agama_ibu = htmlspecialchars($data['agama_ibu']);
    $pekerjaan_ibu = htmlspecialchars($data['pekerjaan_ibu']);

    $nama_ayah = htmlspecialchars($data['nama_ayah']);
    $tempat_ayah = htmlspecialchars($data['tempat_ayah']);
    $tanggal_lahir_ayah = htmlspecialchars($data['tanggal_lahir_ayah']);
    $agama_ayah = htmlspecialchars($data['agama_ayah']);
    $pekerjaan_ayah = htmlspecialchars($data['pekerjaan_ayah']);

    $no_telp = htmlspecialchars($data['no_telp']);
    $no_telp_darurat = htmlspecialchars($data['no_telp_darurat']);

    $foto_surat_kelulusan = $_FILES['foto_surat_kelulusan'];
    $foto_surat_kelakuan = $_FILES['foto_surat_kelakuan'];
    $foto_pas = $_FILES['foto_pas'];
    $foto_akta = $_FILES['foto_akta'];
    $foto_kk = $_FILES['foto_kk'];
    $foto_ktp = $_FILES['foto_ktp'];
    $foto_ijazah = $_FILES['foto_ijazah'];
    $foto_skhun = $_FILES['foto_skhun'];
    $foto_kip = $_FILES['foto_kip'];

    $id_daftar = uniqid();
    $tanggal_daftar = date('Y-m-d');
    $tahun_ajaran = date('Y');
    $ttl = $tempat . " " . $tanggal_lahir;
    $ttl_ayah = $tempat_ayah . " " . $tanggal_lahir_ayah;
    $ttl_ibu = $tempat_ibu . " " . $tanggal_lahir_ibu;

    #save biodata first

    $save_biodata = mysqli_query($connect, "INSERT INTO biodata_siswa VALUES(NULL, '$id_siswa', '$id_daftar', '$tanggal_daftar', '$tahun_ajaran', '$nama_siswa', '$jk', '$ttl', '$agama', '$alamat_sekarang', '$alamat_sekolah_asal', '$nisn', '$nomer_peserta_ujian', '$nomer_sttb', '$nomer_skhun', '$jumlah_sttb', '$nama_ayah', '$ttl_ayah', '$agama_ayah', '$pekerjaan_ayah', '$nama_ibu', '$ttl_ibu', '$agama_ibu', '$pekerjaan_ibu', '$no_telp', '$no_telp_darurat')");

    if ($save_biodata) {
        # save all file
        # all name
        $dirupload = '../dashboard/media/';
        $upload_kelulusan = move_uploaded_file($foto_surat_kelulusan['tmp_name'], $dirupload . uniqid() . $foto_surat_kelulusan['name']);
        $upload_kelakuan = move_uploaded_file($foto_surat_kelakuan['tmp_name'], $dirupload . uniqid() . $foto_surat_kelakuan['name']);
        $upload_pas = move_uploaded_file($foto_pas['tmp_name'], $dirupload . uniqid() . $foto_pas['name']);
        $upload_akta = move_uploaded_file($foto_akta['tmp_name'], $dirupload . uniqid() . $foto_akta['name']);
        $upload_kk = move_uploaded_file($foto_kk['tmp_name'], $dirupload . uniqid() . $foto_kk['name']);
        $upload_ktp = move_uploaded_file($foto_ktp['tmp_name'], $dirupload . uniqid() . $foto_ktp['name']);
        $upload_ijazah = move_uploaded_file($foto_ijazah['tmp_name'], $dirupload . uniqid() . $foto_ijazah['name']);
        $upload_skhun = move_uploaded_file($foto_skhun['tmp_name'], $dirupload . uniqid() . $foto_skhun['name']);
        $upload_kip = move_uploaded_file($foto_kip['tmp_name'], $dirupload . uniqid() . $foto_kip['name']);

        # save to database
        $save_file = mysqli_query($connect, "INSERT INTO file_siswa VALUES(NULL, '$id_siswa', '" . $foto_surat_kelulusan['name'] . "', '" . $foto_surat_kelakuan['name'] . "', '" . $foto_pas['name'] . "', '" . $foto_akta['name'] . "', '" . $foto_kk['name'] . "', '" . $foto_ktp['name'] . "', '" . $foto_ijazah['name'] . "', '" . $foto_skhun['name'] . "', '" . $foto_kip['name'] . "')");

        if ($save_file) {
            redirect_msg("index.php", "Berhasil Disimpan");
        } else {
            redirect_msg("biodata.php", "Gagal disimpan!");
        }
    }
}
