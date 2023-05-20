-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 20, 2023 at 08:08 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata_siswa`
--

DROP TABLE IF EXISTS `biodata_siswa`;
CREATE TABLE IF NOT EXISTS `biodata_siswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_siswa` varchar(50) COLLATE utf8_bin NOT NULL,
  `id_daftar` varchar(50) COLLATE utf8_bin NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `tahun_ajaran` varchar(50) COLLATE utf8_bin NOT NULL,
  `nama` varchar(50) COLLATE utf8_bin NOT NULL,
  `jk` varchar(50) COLLATE utf8_bin NOT NULL,
  `ttl` varchar(50) COLLATE utf8_bin NOT NULL,
  `agama` varchar(50) COLLATE utf8_bin NOT NULL,
  `alamat_sekarang` text COLLATE utf8_bin NOT NULL,
  `alamat_sekolah_asal` text COLLATE utf8_bin NOT NULL,
  `nisn` int NOT NULL,
  `nomor_peserta_ujian` int NOT NULL,
  `nomor_sttb` int NOT NULL,
  `nomor_skhun` int NOT NULL,
  `nilai_sttb` int NOT NULL,
  `nama_ayah` varchar(50) COLLATE utf8_bin NOT NULL,
  `ttl_ayah` varchar(50) COLLATE utf8_bin NOT NULL,
  `agama_ayah` varchar(50) COLLATE utf8_bin NOT NULL,
  `pekerjaan_ayah` varchar(50) COLLATE utf8_bin NOT NULL,
  `nama_ibu` varchar(50) COLLATE utf8_bin NOT NULL,
  `ttl_ibu` varchar(50) COLLATE utf8_bin NOT NULL,
  `agama_ibu` varchar(50) COLLATE utf8_bin NOT NULL,
  `pekerjaan_ibu` varchar(50) COLLATE utf8_bin NOT NULL,
  `no_telp` int NOT NULL,
  `no_darurat` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `biodata_siswa`
--

INSERT INTO `biodata_siswa` (`id`, `id_siswa`, `id_daftar`, `tanggal_daftar`, `tahun_ajaran`, `nama`, `jk`, `ttl`, `agama`, `alamat_sekarang`, `alamat_sekolah_asal`, `nisn`, `nomor_peserta_ujian`, `nomor_sttb`, `nomor_skhun`, `nilai_sttb`, `nama_ayah`, `ttl_ayah`, `agama_ayah`, `pekerjaan_ayah`, `nama_ibu`, `ttl_ibu`, `agama_ibu`, `pekerjaan_ibu`, `no_telp`, `no_darurat`) VALUES
(5, '645fa5e6e8538', '6461c051a13c8', '2023-05-15', '2023', 'dawdaw', 'Laki-Laki', 'dawd 2222-02-22', 'dawdawd', 'dawd', 'dawd', 123123, 1, 1, 1, 1, 'daw', 'dawd 3333-02-12', 'dawd', 'dawd', 'dawd', 'dawd 2222-02-22', 'dawd', 'dawd', 12312, 123123);

-- --------------------------------------------------------

--
-- Table structure for table `file_siswa`
--

DROP TABLE IF EXISTS `file_siswa`;
CREATE TABLE IF NOT EXISTS `file_siswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_siswa` varchar(50) COLLATE utf8_bin NOT NULL,
  `foto_surat_kelulusan` varchar(100) COLLATE utf8_bin NOT NULL,
  `foto_kelakuan` varchar(100) COLLATE utf8_bin NOT NULL,
  `foto_pas` varchar(100) COLLATE utf8_bin NOT NULL,
  `foto_akta` varchar(100) COLLATE utf8_bin NOT NULL,
  `foto_kk` varchar(100) COLLATE utf8_bin NOT NULL,
  `foto_ktp` varchar(100) COLLATE utf8_bin NOT NULL,
  `foto_ijazah` varchar(100) COLLATE utf8_bin NOT NULL,
  `foto_skhun` varchar(100) COLLATE utf8_bin NOT NULL,
  `foto_kip` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `file_siswa`
--

INSERT INTO `file_siswa` (`id`, `id_siswa`, `foto_surat_kelulusan`, `foto_kelakuan`, `foto_pas`, `foto_akta`, `foto_kk`, `foto_ktp`, `foto_ijazah`, `foto_skhun`, `foto_kip`) VALUES
(5, '645fa5e6e8538', 'Asset 13@10x.png', 'Asset 13@10x.png', 'Asset 13@10x.png', 'Asset 13@10x.png', 'Asset 13@10x.png', 'Asset 13@10x.png', 'Asset 13@10x.png', 'Asset 13@10x.png', 'Asset 13@10x.png');

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

DROP TABLE IF EXISTS `informasi`;
CREATE TABLE IF NOT EXISTS `informasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_informasi` varchar(100) COLLATE utf8_bin NOT NULL,
  `berita` text COLLATE utf8_bin NOT NULL,
  `jadwal_masuk` text COLLATE utf8_bin NOT NULL,
  `agenda` text COLLATE utf8_bin NOT NULL,
  `pengumuman` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `kejuruan`
--

DROP TABLE IF EXISTS `kejuruan`;
CREATE TABLE IF NOT EXISTS `kejuruan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_kejuruan` varchar(50) COLLATE utf8_bin NOT NULL,
  `jurusan_sekolah` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pembayaran` varchar(50) COLLATE utf8_bin NOT NULL,
  `id_siswa` varchar(50) COLLATE utf8_bin NOT NULL,
  `jumlah_bayar` int NOT NULL,
  `bukti_bayar` varchar(200) COLLATE utf8_bin NOT NULL,
  `created_at` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_pembayaran`, `id_siswa`, `jumlah_bayar`, `bukti_bayar`, `created_at`) VALUES
(1, '6461e4e01b7f8', '645fa5e6e8538', 123123123, 'Asset 13@10x.png', '2023-05-15'),
(2, '6461e4e857a0d', '645fa5e6e8538', 123123123, 'Asset 13@10x.png', '2023-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `pendidik_kependidikan`
--

DROP TABLE IF EXISTS `pendidik_kependidikan`;
CREATE TABLE IF NOT EXISTS `pendidik_kependidikan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pendidik` varchar(50) COLLATE utf8_bin NOT NULL,
  `nama_guru` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

DROP TABLE IF EXISTS `petugas`;
CREATE TABLE IF NOT EXISTS `petugas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_petugas` varchar(50) COLLATE utf8_bin NOT NULL,
  `nama` varchar(50) COLLATE utf8_bin NOT NULL,
  `jabatan` varchar(50) COLLATE utf8_bin NOT NULL,
  `level_akses` int NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `id_petugas`, `nama`, `jabatan`, `level_akses`, `username`, `password`) VALUES
(1, 'TEST', 'petugas', 'petugas', 2, 'petugas', '570c396b3fc856eceb8aa7357f32af1a'),
(2, 'admin_123', 'admin', 'Admin', 1, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `prosedur_pendaftaran`
--

DROP TABLE IF EXISTS `prosedur_pendaftaran`;
CREATE TABLE IF NOT EXISTS `prosedur_pendaftaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_prosedur` varchar(50) COLLATE utf8_bin NOT NULL,
  `tahapan_pendaftaran` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `prosedur_pendaftaran`
--

INSERT INTO `prosedur_pendaftaran` (`id`, `id_prosedur`, `tahapan_pendaftaran`) VALUES
(1, '64672b03afceb', '<p>dawdawd</p>');

-- --------------------------------------------------------

--
-- Table structure for table `sejarah`
--

DROP TABLE IF EXISTS `sejarah`;
CREATE TABLE IF NOT EXISTS `sejarah` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_sejarah` varchar(50) COLLATE utf8_bin NOT NULL,
  `sejarah` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `sejarah`
--

INSERT INTO `sejarah` (`id`, `id_sejarah`, `sejarah`) VALUES
(1, '646729637ff8e', '<p>dawdawd</p>');

-- --------------------------------------------------------

--
-- Table structure for table `seleksi`
--

DROP TABLE IF EXISTS `seleksi`;
CREATE TABLE IF NOT EXISTS `seleksi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_seleksi` varchar(50) COLLATE utf8_bin NOT NULL,
  `id_siswa` varchar(50) COLLATE utf8_bin NOT NULL,
  `id_daftar` varchar(50) COLLATE utf8_bin NOT NULL,
  `status` varchar(100) COLLATE utf8_bin NOT NULL,
  `progress` varchar(30) COLLATE utf8_bin NOT NULL,
  `created_at` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `seleksi`
--

INSERT INTO `seleksi` (`id`, `id_seleksi`, `id_siswa`, `id_daftar`, `status`, `progress`, `created_at`) VALUES
(1, '6461db53bb07a', '645fa5e6e8538', '6461c051a13c8', 'Lulus', '100', '2023-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `tentang_sekolah`
--

DROP TABLE IF EXISTS `tentang_sekolah`;
CREATE TABLE IF NOT EXISTS `tentang_sekolah` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_tentang_sekolah` varchar(100) COLLATE utf8_bin NOT NULL,
  `alamat_sekolah` text COLLATE utf8_bin NOT NULL,
  `visi_misi` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `tentang_sekolah`
--

INSERT INTO `tentang_sekolah` (`id`, `id_tentang_sekolah`, `alamat_sekolah`, `visi_misi`) VALUES
(1, '646727d6ac750', 'dawdawd', '<p>dawdawds</p>');

-- --------------------------------------------------------

--
-- Table structure for table `user_siswa`
--

DROP TABLE IF EXISTS `user_siswa`;
CREATE TABLE IF NOT EXISTS `user_siswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_siswa` varchar(50) COLLATE utf8_bin NOT NULL,
  `nama` varchar(50) COLLATE utf8_bin NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `ttl` date NOT NULL,
  `asal_sekolah` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `user_siswa`
--

INSERT INTO `user_siswa` (`id`, `id_siswa`, `nama`, `username`, `password`, `ttl`, `asal_sekolah`) VALUES
(2, '645fa5e6e8538', 'uji', 'test', 'cc03e747a6afbbcbf8be7668acfebee5', '2023-05-13', 'dawdawd');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
