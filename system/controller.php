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

function get_petugas_all()
{
    global $connect;

    $get_all = mysqli_query($connect, "SELECT * FROM petugas WHERE level_akses != 1");
    return $get_all;
}

function get_petugas($id_petugas)
{
    global $connect;

    $get_all = mysqli_query($connect, "SELECT * FROM petugas WHERE id_petugas = '$id_petugas'");
    $ga = mysqli_fetch_assoc($get_all);
    return $ga;
}

function get_tentang()
{
    global $connect;

    $get = mysqli_query($connect, "SELECT * FROM tentang_sekolah LIMIT 1");

    $check = mysqli_num_rows($get);
    if ($check != 0) {
        $g = mysqli_fetch_assoc($get);
        return $g;
    } else {
        return ['id_tentang_sekolah' => '', 'alamat_sekolah' => '', 'visi_misi' => ''];
    }
}

function get_sejarah()
{
    global $connect;

    $get = mysqli_query($connect, "SELECT * FROM sejarah LIMIT 1");

    $check = mysqli_num_rows($get);
    if ($check != 0) {
        $g = mysqli_fetch_assoc($get);
        return $g;
    } else {
        return ['id_sejarah' => '', 'sejarah' => ''];
    }
}

function get_prosedur()
{
    global $connect;

    $get = mysqli_query($connect, "SELECT * FROM prosedur_pendaftaran LIMIT 1");

    $check = mysqli_num_rows($get);
    if ($check != 0) {
        $g = mysqli_fetch_assoc($get);
        return $g;
    } else {
        return ['id_prosedur' => '', 'tahapan_pendaftaran' => ''];
    }
}

function update_sejarah($data)
{
    global $connect;

    $check = mysqli_query($connect, "SELECT * FROM sejarah");
    $c = mysqli_num_rows($check);
    $sejarah = $data['sejarah'];
    if ($c != 0) {
        $update = mysqli_query($connect, "UPDATE sejarah SET sejarah = '$sejarah'");
        if ($update) {
            redirect_msg("tampilan.php", "Berhasil Diedit");
        } else {
            redirect_msg("tampilan.php", "Berhasil Diedit");
        }
    } else {
        $id_sejarah = uniqid();
        $save = mysqli_query($connect, "INSERT INTO sejarah VALUES(NULL, '$id_sejarah', '$sejarah')");
        if ($save) {
            redirect_msg("tampilan.php", "Berhasil Diedit");
        } else {
            redirect_msg("tampilan.php", "Berhasil Diedit");
        }
    }
}

function get_guru($data)
{
    global $connect;

    if ($data == 'all') {
        $get = mysqli_query($connect, "SELECT * FROM pendidik_kependidikan");
        return $get;
    } else {
        $get = mysqli_query($connect, "SELECT * FROM pendidik_kependidikan WHERE id_pendidik = '$data'");
        $g = mysqli_fetch_assoc($get);
        return $g;
    }
}

function update_guru($data, $id)
{
    global $connect;

    $nama_guru = htmlspecialchars($data['nama_guru']);

    $update = mysqli_query($connect, "UPDATE pendidik_kependidikan SET nama_guru = '$nama_guru' WHERE id_pendidik = '$id'");
    if ($update) {
        redirect_msg("tampilan.php", "Berhasil Diedit");
    } else {
        redirect_msg("tampilan.php", "Berhasil Diedit");
    }
}

function save_kejuruan($data)
{
    global $connect;

    $nama_kejuruan = htmlspecialchars($data['nama_kejuruan']);
    $id_kejuruan = uniqid();
    $save = mysqli_query($connect, "INSERT INTO kejuruan VALUES(NULL, '$id_kejuruan', '$nama_kejuruan')");
    if ($save) {
        redirect_msg("tampilan.php", "Berhasil Ditambah");
    } else {
        redirect_msg("tampilan.php", "Berhasil Ditambah");
    }
}

function get_kejuruan($data)
{
    global $connect;

    if ($data == 'all') {
        $get = mysqli_query($connect, "SELECT * FROM kejuruan");
        return $get;
    } else {
        $get = mysqli_query($connect, "SELECT * FROM kejuruan WHERE id_kejuruan = '$data'");
        $g = mysqli_fetch_assoc($get);
        return $g;
    }
}

function save_kependidikan($data)
{
    global $connect;

    $nama_guru = htmlspecialchars($data['nama_guru']);
    $id_guru = uniqid();
    $save = mysqli_query($connect, "INSERT INTO pendidik_kependidikan VALUES(NULL, '$id_guru', '$nama_guru')");
    if ($save) {
        redirect_msg("tampilan.php", "Berhasil Ditambah");
    } else {
        redirect_msg("tampilan.php", "Berhasil Ditambah");
    }
}

function update_kejuruan($data, $id)
{
    global $connect;

    $nama_kejuruan = htmlspecialchars($data['nama_kejuruan']);
    $update = mysqli_query($connect, "UPDATE kejuruan SET jurusan_sekolah = '$nama_kejuruan' WHERE id_kejuruan = '$id'");
    if ($update) {
        redirect_msg("tampilan.php", "Berhasil diedit");
    } else {
        redirect_msg("tampilan.php", "Berhasil diedit");
    }
}

function update_prosedur($data)
{
    global $connect;

    $check = mysqli_query($connect, "SELECT * FROM prosedur_pendaftaran");
    $c = mysqli_num_rows($check);
    $prosedur = $data['prosuder_pendaftaran'];
    if ($c != 0) {
        $update = mysqli_query($connect, "UPDATE prosedur_pendaftaran SET tahapan_pendaftaran = '$prosedur'");
        if ($update) {
            redirect_msg("tampilan.php", "Berhasil Diedit");
        } else {
            redirect_msg("tampilan.php", "Berhasil Diedit");
        }
    } else {
        $id_prosedur = uniqid();
        $save = mysqli_query($connect, "INSERT INTO prosedur_pendaftaran VALUES(NULL, '$id_prosedur', '$prosedur')");
        if ($save) {
            redirect_msg("tampilan.php", "Berhasil Diedit");
        } else {
            redirect_msg("tampilan.php", "Berhasil Diedit");
        }
    }
}

function update_tentang($data)
{
    global $connect;

    $check = mysqli_query($connect, "SELECT * FROM tentang_sekolah");
    $c = mysqli_num_rows($check);

    $alamat_sekolah = htmlspecialchars($data['alamat_sekolah']);
    $visi_misi = $data['visi_misi'];

    if ($c != 0) {
        $update = mysqli_query($connect, "UPDATE tentang_sekolah SET alamat_sekolah = '$alamat_sekolah', visi_misi = '$visi_misi'");
        if ($update) {
            redirect_msg("tampilan.php", "Berhasil Diedit");
        } else {
            redirect_msg("tampilan.php", "Berhasil Diedit");
        }
    } else {
        $id_tentang = uniqid();
        $save = mysqli_query($connect, "INSERT INTO tentang_sekolah VALUES(NULL, '$id_tentang', '$alamat_sekolah', '$visi_misi')");
        if ($save) {
            redirect_msg("tampilan.php", "Berhasil Diedit");
        } else {
            redirect_msg("tampilan.php", "Berhasil Diedit");
        }
    }
}

function save_petugas($data)
{
    global $connect;

    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars(md5($data['password']));
    $id_petugas = uniqid();

    $save = mysqli_query($connect, "INSERT INTO petugas VALUES(NULL, '$id_petugas', '$nama', 'Petugas', 2, '$username', '$password')");

    if ($save) {
        redirect_msg("list_user.php", "Berhasil Disimpan");
    } else {
        redirect_msg("tambah_user.php", "Gagal disimpan!");
    }
}

function update_petugas($data, $id_petugas)
{
    global $connect;
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);

    $update = mysqli_query($connect, "UPDATE petugas SET nama = '$nama', username = '$username' WHERE id_petugas = '$id_petugas'");

    if ($update) {
        redirect_msg("list_user.php", "Berhasil Diedit");
    } else {
        redirect_msg("list_user.php", "Gagal Diedit!");
    }
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

function edit_pembayaran($data, $data_old)
{
    global $connect;

    $jumlah_bayar = isset($data['jml_bayar']) ? htmlspecialchars($data['jml_bayar']) : 0;
    $bukti_bayar = $_FILES['bukti_bayar'] ? $_FILES['bukti_bayar'] : null;
    if ($bukti_bayar['name']) {
        $name_file = uniqid() . "bukti_bayar" . $bukti_bayar['name'];
        $dirupload = '../dashboard/media/';
        $upload_bukti = move_uploaded_file($bukti_bayar['tmp_name'], $dirupload . $name_file);
    } else {
        $name_file = $data_old['bukti_bayar'];
    }
    $id = $data_old["id_pembayaran"];
    $save = mysqli_query($connect, "UPDATE pembayaran SET jumlah_bayar = '$jumlah_bayar', bukti_bayar = '$name_file' WHERE id_pembayaran = '$id'");
    if ($save) {
        redirect_msg("list_pembayaran.php", "Berhasil Diedit");
    } else {
        redirect_msg("edit_pembayaran.php?id_pembayaran=$id", "Gagal Diedit!");
    }
}

function hapus_pembayaran($id_pembayaran)
{
    global $connect;

    if ($id_pembayaran){
        $sql = mysqli_query($connect, "DELETE FROM pembayaran WHERE id_pembayaran = '$id_pembayaran'");
        if ($sql) {
            redirect_msg("list_pembayaran.php", "Berhasil Dihapus");
        } else {
            redirect_msg("list_pembayaran.php", "Gagal Dihapus!");
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

function tambah_siswa($data)
{
    global $connect;

    $nama_siswa = htmlspecialchars($data['nama_siswa']);
    $ttl = htmlspecialchars($data['tanggal_lahir']);
    $asal_sekolah = htmlspecialchars($data['sekolah_asal']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars(md5($data['password']));

    $id_siswa_new = uniqid();

    $save_data_login = mysqli_query($connect, "INSERT INTO user_siswa VALUES(NULL, '$id_siswa_new', '$nama_siswa', '$username', '$password', '$ttl', '$asal_sekolah')");

    if (!$save_data_login) {
        redirect_msg("tambah_siswa.php", "Gagal ditambahkan!");
    }

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

    $save_biodata = mysqli_query($connect, "INSERT INTO biodata_siswa VALUES(NULL, '$id_siswa_new', '$id_daftar', '$tanggal_daftar', '$tahun_ajaran', '$nama_siswa', '$jk', '$ttl', '$agama', '$alamat_sekarang', '$alamat_sekolah_asal', '$nisn', '$nomer_peserta_ujian', '$nomer_sttb', '$nomer_skhun', '$jumlah_sttb', '$nama_ayah', '$ttl_ayah', '$agama_ayah', '$pekerjaan_ayah', '$nama_ibu', '$ttl_ibu', '$agama_ibu', '$pekerjaan_ibu', '$no_telp', '$no_telp_darurat')");

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
        $save_file = mysqli_query($connect, "INSERT INTO file_siswa VALUES(NULL, '$id_siswa_new', '" . $foto_surat_kelulusan['name'] . "', '" . $foto_surat_kelakuan['name'] . "', '" . $foto_pas['name'] . "', '" . $foto_akta['name'] . "', '" . $foto_kk['name'] . "', '" . $foto_ktp['name'] . "', '" . $foto_ijazah['name'] . "', '" . $foto_skhun['name'] . "', '" . $foto_kip['name'] . "')");

        if ($save_file) {
            redirect_msg("list_siswa.php", "Berhasil Disimpan");
        } else {
            redirect_msg("tambah_siswa.php", "Gagal disimpan!");
        }
    } else {
        $msg = mysqli_error($connect);
        redirect_msg("tambah_siswa.php", $msg);
    }
}

function edit_siswa($data, $data_old)
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

    $ttl = $tempat . " " . $tanggal_lahir;
    $ttl_ayah = $tempat_ayah . " " . $tanggal_lahir_ayah;
    $ttl_ibu = $tempat_ibu . " " . $tanggal_lahir_ibu;

    $dirupload = '../dashboard/media/';
    if ($foto_surat_kelulusan) {
        $name_file_kelulusan = uniqid() . "bukti_bayar" . $foto_surat_kelulusan['name'];
    }else if (!$foto_surat_kelulusan) {
        $name_file_kelulusan = $data_old['foto_surat_kelulusan'];
    }

    if ($foto_surat_kelakuan) {
        $nama_file_kelakuan = uniqid() . "bukti_bayar" . $foto_surat_kelakuan['name'];
    } else if (!$foto_surat_kelakuan) {
        $nama_file_kelakuan = $data_old['foto_surat_kelakuan'];
    }

    if ($foto_pas) {
        $nama_file_pas = uniqid() . "bukti_bayar" . $foto_pas['name'];
    } else if (!$foto_pas) {
        $nama_file_pas = $data_old['foto_pas'];
    }

    if ($foto_akta) {
        $nama_file_foto_akta = uniqid() . "bukti_bayar" . $foto_akta['name'];
    } else if (!$foto_akta) {
        $nama_file_foto_akta = $data_old['foto_akta'];
    }

    if ($foto_kk) {
        $nama_file_kk = uniqid() . "bukti_bayar" . $foto_kk['name'];
    }else if ($foto_kk) {
        $nama_file_kk = $data_old['foto_kk'];
    }

    if ($foto_ktp) {
        $nama_file_ktp = uniqid() . "bukti_bayar" . $foto_ktp['name'];
    }else if (!$foto_ktp) {
        $nama_file_ktp = $data_old['foto_ktp'];
    }

    if ($foto_ijazah) {
        $nama_file_ijazah = uniqid() . "bukti_bayar" . $foto_ijazah['name'];
    } else if (!$foto_ijazah) {
        $nama_file_ijazah = $data_old['foto_ijazah'];
    }

    if ($foto_skhun) {
        $nama_file_skhun = uniqid() . "bukti_bayar" . $foto_skhun['name'];
    }else if(!$foto_skhun) {
        $nama_file_skhun = $data_old['foto_skhun'];
    }

    if ($foto_kip) {
        $nama_file_kip = uniqid() . "bukti_bayar" . $foto_kip['name'];
    } else if (!$foto_kip) {
        $nama_file_kip = $data_old['foto_kip'];
    }

    $save_biodata = mysqli_query($connect, "UPDATE biodata_siswa SET  nama = '$nama_siswa', jk = '$jk', ttl = '$ttl', agama = '$agama', alamat_sekarang = '$alamat_sekarang', alamat_sekolah_asal = '$alamat_sekolah_asal', nisn = '$nisn',  nomor_peserta_ujian = '$nomer_peserta_ujian', nomor_sttb = '$nomer_sttb', nomor_skhun = '$nomer_skhun', nilai_sttb = '$jumlah_sttb', nama_ayah = '$nama_ayah', ttl_ayah = '$ttl_ayah', agama_ayah = '$agama_ayah', pekerjaan_ayah = '$pekerjaan_ayah', nama_ibu = '$nama_ibu', ttl_ibu = '$ttl_ibu', agama_ibu = '$agama_ibu', pekerjaan_ibu = '$pekerjaan_ibu', no_telp = '$no_telp', no_darurat = '$no_telp_darurat'");

    if ($save_biodata) {
        $upload_kelulusan = $foto_surat_kelulusan ? move_uploaded_file($foto_surat_kelulusan['tmp_name'], $dirupload . $name_file_kelulusan) : '';
        $upload_kelakuan = $foto_surat_kelakuan ? move_uploaded_file($foto_surat_kelakuan['tmp_name'], $dirupload . $nama_file_kelakuan) : '';
        $upload_pas = $foto_pas ? move_uploaded_file($foto_pas['tmp_name'], $dirupload . $nama_file_pas) : '';
        $upload_akta = $foto_akta ? move_uploaded_file($foto_akta['tmp_name'], $dirupload . $nama_file_foto_akta) : '';
        $upload_kk = $foto_kk ? move_uploaded_file($foto_kk['tmp_name'], $dirupload . $nama_file_kk) : '';
        $upload_ktp = $foto_ktp ? move_uploaded_file($foto_ktp['tmp_name'], $dirupload . $nama_file_ktp) : '';
        $upload_ijazah = $foto_ijazah ? move_uploaded_file($foto_ijazah['tmp_name'], $dirupload . $nama_file_ijazah) : '';
        $upload_skhun = $foto_skhun ? move_uploaded_file($foto_skhun['tmp_name'], $dirupload . $nama_file_skhun) : '';
        $upload_kip = $foto_kip ? move_uploaded_file($foto_kip['tmp_name'], $dirupload . $nama_file_kip) : '';

        $save_file = mysqli_query($connect, "UPDATE file_siswa SET foto_surat_kelulusan = '$name_file_kelulusan', foto_kelakuan = '$nama_file_kelakuan', foto_pas = '$nama_file_pas', foto_akta = '$nama_file_foto_akta', foto_kk = '$nama_file_kk', foto_ktp = '$nama_file_ktp', foto_ijazah = '$nama_file_ijazah', foto_skhun = '$nama_file_skhun', foto_kip = '$nama_file_kip'");

        if ($save_file) {
            redirect_msg("list_siswa.php", "Berhasil Diedit");
        } else {
            redirect_msg("edit_siswa.php?id_siswa=$data_old[id_siswa]", "Gagal Diedit!");
        }
    } else {
        $data = mysqli_error($connect);
    }
}

function hapus_siswa($id_siswa) {
    global $connect;

    if ($id_siswa){
        $sql = mysqli_query($connect, "DELETE FROM user_siswa INNER JOIN biodata_siswa ON user_siswa.id_siswa = biodata_siswa.id_siswa INNER JOIN pembayaran ON user_siswa.id_siswa = pembayaran.id_siswa INNER JOIN seleksi ON user_siswa.id_siswa = seleksi.id_siswa INNER JOIN file_siswa ON user_siswa.id_siswa = file_siswa.id_siswa WHERE user_siswa.id_siswa = '$id_siswa'");
        if ($sql) {
            redirect_msg("list_pembayaran.php", "Berhasil Dihapus");
        } else {
            redirect_msg("list_pembayaran.php", "Gagal Dihapus!");
        }
    }
}

function get_pendaftaran()
{
    global $connect;
    $daftar = mysqli_query($connect, "SELECT * FROM prosedur_pendaftaran LIMIT 1");
    $daftar = mysqli_fetch_assoc($daftar);

    return $daftar;
}

function get_pendidikan()
{
    global $connect;
    $pendidikan = mysqli_query($connect, "SELECT * FROM pendidik_kependidikan");
    return $pendidikan;
}