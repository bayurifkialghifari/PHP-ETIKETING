-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2020 at 02:23 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `praujikom`
--

-- --------------------------------------------------------

--
-- Table structure for table `bandara`
--

CREATE TABLE `bandara` (
  `band_id` int(11) NOT NULL,
  `band_kode` varchar(50) NOT NULL,
  `band_nama` varchar(50) NOT NULL,
  `band_kota_id` int(11) NOT NULL,
  `band_nega_id` int(11) NOT NULL,
  `band_deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bandara`
--

INSERT INTO `bandara` (`band_id`, `band_kode`, `band_nama`, `band_kota_id`, `band_nega_id`, `band_deskripsi`) VALUES
(3, 'BAND-2019-00001', 'Bandar Udara Internasional Husein Sastranegara', 4, 1, '-'),
(4, 'BAND-2019-00002', 'Bandar Udara Internasional Soekarno–Hatta', 8, 1, '-'),
(5, 'BAND-2019-00003', 'Bandar Udara Internasional Ngurah Rai', 5, 1, '-'),
(6, 'BAND-2019-00004', 'Bandar Udara Internasional Kuala Lumpur', 6, 2, '-'),
(7, 'BAND-2019-00005', 'Bandar Udara Internasional Changi Singapura', 9, 3, '-');

-- --------------------------------------------------------

--
-- Table structure for table `gerbong`
--

CREATE TABLE `gerbong` (
  `gerb_id` int(11) NOT NULL,
  `gerb_jumlah_kursi` int(11) NOT NULL,
  `gerb_no_kursi` int(11) NOT NULL,
  `gerb_deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kereta`
--

CREATE TABLE `jadwal_kereta` (
  `jadk_id` int(11) NOT NULL,
  `jadk_kode` varchar(50) NOT NULL,
  `jadk_rute_kode` varchar(50) NOT NULL,
  `jadk_keret_id` int(11) NOT NULL,
  `jadk_tanggal_berangkat` date NOT NULL,
  `jadk_tanggal_pulang` date NOT NULL,
  `jadk_jam_berangkat` time NOT NULL,
  `jadk_jam_berangkat_sampai` time NOT NULL,
  `jadk_jam_pulang` time NOT NULL,
  `jadk_jam_pulang_sampai` time NOT NULL,
  `jadk_tipe` varchar(2) NOT NULL,
  `jadk_keterangan` text NOT NULL,
  `jadk_status` varchar(50) NOT NULL,
  `jadk_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_kereta`
--

INSERT INTO `jadwal_kereta` (`jadk_id`, `jadk_kode`, `jadk_rute_kode`, `jadk_keret_id`, `jadk_tanggal_berangkat`, `jadk_tanggal_pulang`, `jadk_jam_berangkat`, `jadk_jam_berangkat_sampai`, `jadk_jam_pulang`, `jadk_jam_pulang_sampai`, `jadk_tipe`, `jadk_keterangan`, `jadk_status`, `jadk_created_date`) VALUES
(3, 'PERJ-2019-00001', 'RKAI-2019-00001', 3, '2020-01-30', '0000-00-00', '01:00:00', '04:00:00', '00:00:00', '00:00:00', 'SJ', '-', 'Aktif', '2020-01-03 12:29:10'),
(4, 'PERJ-2019-00002', 'RKAI-2019-00001', 4, '2020-01-30', '2020-01-31', '01:00:00', '03:00:00', '01:00:00', '02:00:00', 'PP', '-', 'Aktif', '2020-01-03 12:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pesawat`
--

CREATE TABLE `jadwal_pesawat` (
  `jadp_id` int(11) NOT NULL,
  `jadp_kode` varchar(50) NOT NULL,
  `jadp_pesa_id` int(11) NOT NULL,
  `jadp_rute_kode` varchar(50) NOT NULL,
  `jadp_tanggal_berangkat` date NOT NULL,
  `jadp_tanggal_pulang` date NOT NULL,
  `jadp_jam_berangkat` time NOT NULL,
  `jadp_jam_pulang` time NOT NULL,
  `jadp_tanggal_berangkat_sampai` date NOT NULL,
  `jadp_tanggal_pulang_sampai` date NOT NULL,
  `jadp_jam_berangkat_sampai` time NOT NULL,
  `jadp_jam_pulang_sampai` time NOT NULL,
  `jadp_keterangan` text NOT NULL,
  `jadp_tipte_penerbangan` varchar(50) NOT NULL,
  `jadp_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_pesawat`
--

INSERT INTO `jadwal_pesawat` (`jadp_id`, `jadp_kode`, `jadp_pesa_id`, `jadp_rute_kode`, `jadp_tanggal_berangkat`, `jadp_tanggal_pulang`, `jadp_jam_berangkat`, `jadp_jam_pulang`, `jadp_tanggal_berangkat_sampai`, `jadp_tanggal_pulang_sampai`, `jadp_jam_berangkat_sampai`, `jadp_jam_pulang_sampai`, `jadp_keterangan`, `jadp_tipte_penerbangan`, `jadp_status`) VALUES
(1, 'PENE-2019-00001', 3, 'RUTE-2019-00001', '2020-01-28', '2020-01-30', '01:00:00', '01:00:00', '2020-01-29', '2020-01-31', '03:00:00', '03:00:00', '-', 'PP', 'Aktif'),
(2, 'PENE-2019-00002', 2, 'RUTE-2019-00001', '2020-01-30', '0000-00-00', '01:00:00', '00:00:00', '2020-01-31', '0000-00-00', '06:01:00', '00:00:00', '-', 'SJ', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kela_id` int(11) NOT NULL,
  `kela_kode` varchar(50) NOT NULL,
  `kela_nama` varchar(50) NOT NULL,
  `kela_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kela_id`, `kela_kode`, `kela_nama`, `kela_harga`) VALUES
(1, 'KELA-2019-00001', 'Ekonomi', 0),
(2, 'KELA-2019-00002', 'Bisnis', 20),
(3, 'KELA-2019-00003', 'First', 50),
(4, 'KELA-2019-00004', 'Eksekutif', 5);

-- --------------------------------------------------------

--
-- Table structure for table `kereta`
--

CREATE TABLE `kereta` (
  `keret_id` int(11) NOT NULL,
  `keret_kode` varchar(50) NOT NULL,
  `keret_nama` varchar(50) NOT NULL,
  `keret_keterangan` text NOT NULL,
  `keret_penumpang` int(11) NOT NULL,
  `keret_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kereta`
--

INSERT INTO `kereta` (`keret_id`, `keret_kode`, `keret_nama`, `keret_keterangan`, `keret_penumpang`, `keret_status`) VALUES
(3, 'KAI-PAN', 'PANGANDARAN', '-', 100, 'Aktif'),
(4, 'KAI-MAL', 'MALABAR', '-', 100, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `kota_id` int(11) NOT NULL,
  `kota_kode` varchar(50) NOT NULL,
  `kota_nama` varchar(50) NOT NULL,
  `kota_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`kota_id`, `kota_kode`, `kota_nama`, `kota_keterangan`) VALUES
(1, 'CMH', 'Cimahi', '-'),
(2, 'PDL', 'Padalarang', '-'),
(4, 'BDG', 'Bandung', '-'),
(5, 'DPN', 'Denpasar', '-'),
(6, 'KLR', 'Kuala Lumpur', '-'),
(7, 'TGR', 'Tanggerang', '-'),
(8, 'JKT', 'Jakarta', '-'),
(9, 'SGN', 'Singapura', '-'),
(10, 'TSM', 'Tasikmalaya', '-');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `lev_id` int(11) NOT NULL,
  `lev_nama` varchar(50) DEFAULT NULL,
  `lev_deskripsi` varchar(200) DEFAULT NULL,
  `lev_status` varchar(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`lev_id`, `lev_nama`, `lev_deskripsi`, `lev_status`, `created_date`) VALUES
(1, 'Administrator', '-', 'Aktif', '2019-05-01 23:20:02'),
(3, 'Customer', '-', 'Aktif', '2019-11-21 13:34:56'),
(5, 'Manajemen', '-', 'Aktif', '2019-11-21 13:34:30'),
(6, 'Guest', '-', 'Aktif', '2019-11-25 13:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `maskapai`
--

CREATE TABLE `maskapai` (
  `mask_id` int(11) NOT NULL,
  `mask_kode` varchar(50) NOT NULL,
  `mask_nama` varchar(50) NOT NULL,
  `mask_deskripsi` text NOT NULL,
  `mask_logo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maskapai`
--

INSERT INTO `maskapai` (`mask_id`, `mask_kode`, `mask_nama`, `mask_deskripsi`, `mask_logo`) VALUES
(2, 'MASK-2019-00001', 'Garuda Indonesia', '-', 'garuda_indonesia.jpg'),
(3, 'MASK-2019-00002', 'Citylink', '-', 'citylink.png');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_menu_id` int(11) DEFAULT '0',
  `menu_name` varchar(100) DEFAULT NULL,
  `menu_description` text,
  `menu_index` int(11) DEFAULT NULL,
  `menu_icon` varchar(100) DEFAULT NULL,
  `menu_url` varchar(200) DEFAULT NULL,
  `menu_status` varchar(10) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_menu_id`, `menu_name`, `menu_description`, `menu_index`, `menu_icon`, `menu_url`, `menu_status`, `created_date`) VALUES
(1, 0, 'Dashboard', '-', 1, 'fa fa-desktop', 'dashboard', 'Aktif', '2019-08-07 17:13:11'),
(27, 37, 'Pengguna', '-', 1, 'fa fa-caret-right', 'pengaturan/pengguna', 'Aktif', '2019-06-03 22:36:24'),
(37, 0, 'Pengaturan', '-', 11, 'fa fa-cogs', '#', 'Aktif', '2019-08-07 16:47:57'),
(61, 37, 'Level', '-', 2, 'fa fa-caret-right', 'pengaturan/level', 'Aktif', '2019-06-03 22:49:17'),
(63, 37, 'Menu', '-', 3, 'fa fa-caret-right', 'pengaturan/menu', 'Aktif', '2019-06-03 22:50:05'),
(64, 37, 'Hak Akses', '-', 4, 'fa fa-caret-right', 'pengaturan/hakAkses', 'Aktif', '2019-06-03 22:50:24'),
(65, 0, 'Referensi', '-', 10, 'fa fa-link', '#', 'Aktif', '2019-11-22 12:08:40'),
(66, 65, 'Kelas', '-', 1, 'fa fa-caret-right', 'referensi/kelas', 'Aktif', '2019-11-22 12:10:18'),
(67, 65, 'Negara', '-', 2, 'fa fa-caret-right', 'referensi/negara', 'Aktif', '2019-11-22 12:10:51'),
(68, 65, 'Kota', '-', 3, 'fa fa-caret-right', 'referensi/kota', 'Aktif', '2019-11-22 12:11:16'),
(69, 65, 'Stasiun', '-', 4, 'fa fa-caret-right', 'referensi/stasiun', 'Aktif', '2019-11-22 12:12:07'),
(70, 65, 'Bandara', '-', 5, 'fa fa-caret-right', 'referensi/bandara', 'Aktif', '2019-11-22 12:12:47'),
(71, 0, 'Pesawat', '-', 9, 'fa fa-plane', 'pesawat/data', 'Aktif', '2019-11-22 12:19:13'),
(72, 65, 'Maskapai', '-', 6, 'fa fa-caret-right', 'referensi/maskapai', 'Aktif', '2019-11-22 12:15:37'),
(77, 0, 'Pesawat', 'Pesawat Bagian User', 2, 'fa fa-plane', 'users/home', 'Aktif', '2019-12-04 15:22:24'),
(78, 0, 'Validasi Pembayaran', '-', 2, 'fa fa-check', '#', 'Aktif', '2019-12-12 06:42:18'),
(79, 78, 'Belum', '-', 1, 'fa fa-caret-right', 'pembayaran/data', 'Aktif', '2019-11-29 13:10:57'),
(80, 78, 'Tervalidasi', '-', 2, 'fa fa-caret-right', 'pembayaran/tervalidasi', 'Aktif', '2019-11-29 13:11:23'),
(81, 0, 'Kereta', 'Kereta Bagian Users', 3, 'fa fa-train', 'users/kereta', 'Aktif', '2019-12-12 06:39:40'),
(82, 78, 'Tidak Tervalidasi', '-', 3, 'fa fa-caret-right', 'pembayaran/tidakTervalidasi', 'Aktif', '2019-12-12 04:18:30'),
(83, 0, 'Kereta', '-', 8, 'fa fa-train', 'kereta/data', 'Aktif', '2019-12-12 06:48:13'),
(87, 0, 'Rute', '-', 7, 'fa fa-road', '#', 'Aktif', '2019-12-12 06:49:37'),
(88, 87, 'Rute Penerbangan', '-', 1, 'fa fa-caret-right', 'penerbangan/rute', 'Aktif', '2019-12-12 06:50:13'),
(89, 87, 'Rute Kereta', '-', 2, 'fa fa-caret-right', 'kereta/rute', 'Aktif', '2019-12-12 06:50:45'),
(90, 0, 'Jadwal', '-', 6, 'fa fa-calendar', '#', 'Aktif', '2019-12-12 06:51:27'),
(91, 90, 'Jadwal Penerbangan', '-', 1, 'fa fa-caret-right', 'penerbangan/jadwal', 'Aktif', '2019-12-12 06:52:04'),
(92, 90, 'Jadwal Perjalanan Kereta', '-', 2, 'fa fa-caret-right', 'kereta/jadwal', 'Aktif', '2019-12-20 04:07:48'),
(93, 0, 'Generate Tiket', '-', 5, 'fa fa-ticket', '#', 'Aktif', '2019-12-20 07:22:32'),
(94, 93, 'Generate Tiket Pesawat', '-', 1, 'fa fa-caret-right', 'penerbangan/generate', 'Aktif', '2019-12-12 06:56:04'),
(95, 93, 'Generate Tiket Kereta', '-', 2, 'fa fa-caret-right', 'kereta/generate', 'Aktif', '2019-12-12 06:56:16'),
(96, 0, 'Laporan', '-', 12, 'fa fa-file', '#', 'Aktif', '2019-12-20 12:22:06'),
(97, 96, 'Pembayaran', '-', 1, 'fa fa-caret-right', 'laporan/pembayaran', 'Aktif', '2019-12-29 13:36:37'),
(98, 96, 'Pemesanan', '-', 2, 'fa fa-caret-right', 'laporan/pemesanan', 'Aktif', '2019-12-29 13:37:02'),
(99, 96, 'Customer', '-', 3, 'fa fa-caret-right', 'laporan/customer', 'Aktif', '2019-12-29 13:38:19'),
(100, 96, 'Tiket Penerbangan', '-', 4, 'fa fa-caret-right', 'laporan/penerbangan', 'Aktif', '2019-12-29 13:39:28'),
(101, 96, 'Tiket Kereta', '-', 5, 'fa fa-caret-right', 'laporan/perjalanan', 'Aktif', '2019-12-29 13:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `negara`
--

CREATE TABLE `negara` (
  `nega_id` int(11) NOT NULL,
  `nega_nama` varchar(50) NOT NULL,
  `nega_keterangan` text NOT NULL,
  `nega_bendera` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `negara`
--

INSERT INTO `negara` (`nega_id`, `nega_nama`, `nega_keterangan`, `nega_bendera`) VALUES
(1, 'Indonesia', '-', 'indonesia.png'),
(2, 'Malaysia', '-', 'Flag_of_Malaysia.svg'),
(3, 'Singapura', '-', 'Flag_of_Singapore.svg');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `txn_id` int(11) NOT NULL,
  `peme_id` int(11) NOT NULL,
  `PaymentMethod` varchar(50) NOT NULL,
  `PayerStatus` varchar(50) NOT NULL,
  `PayerMail` varchar(50) NOT NULL,
  `Total` decimal(19,2) NOT NULL,
  `SubTotal` decimal(19,2) NOT NULL,
  `Tax` decimal(19,2) NOT NULL,
  `Payment_state` varchar(50) NOT NULL,
  `payerBuktiPembayaran` varchar(50) NOT NULL,
  `CreateTime` varchar(50) NOT NULL,
  `UpdateTime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`txn_id`, `peme_id`, `PaymentMethod`, `PayerStatus`, `PayerMail`, `Total`, `SubTotal`, `Tax`, `Payment_state`, `payerBuktiPembayaran`, `CreateTime`, `UpdateTime`) VALUES
(1, 1, 'paypal', 'VERIFIED', 'bayurifki916@gmail.com', '36.00', '36.00', '0.00', 'completed', '', '2019-12-22T09:14:51Z', '2019-12-22T09:14:51Z'),
(2, 1, 'paypal', 'VERIFIED', 'bayurifki916@gmail.com', '36.00', '36.00', '0.00', 'completed', '', '2019-12-22T09:14:51Z', '2019-12-22T09:14:51Z'),
(3, 2, 'paypal', 'VERIFIED', 'bayurifki916@gmail.com', '360.00', '360.00', '0.00', 'completed', '', '2019-12-24T08:55:29Z', '2019-12-24T08:55:29Z'),
(4, 3, 'paypal', 'VERIFIED', 'bayurifki916@gmail.com', '180.00', '180.00', '0.00', 'completed', '', '2019-12-24T11:24:59Z', '2019-12-24T11:24:59Z');

-- --------------------------------------------------------

--
-- Table structure for table `pemesan`
--

CREATE TABLE `pemesan` (
  `peme_id` int(11) NOT NULL,
  `peme_kode` varchar(50) NOT NULL,
  `peme_title` varchar(50) NOT NULL,
  `peme_nama` varchar(50) NOT NULL,
  `peme_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesan`
--

INSERT INTO `pemesan` (`peme_id`, `peme_kode`, `peme_title`, `peme_nama`, `peme_email`) VALUES
(1, 'PEME-2019-00001', 'Tuan', 'Bayu', 'bayurifkialgh@gmail.com'),
(2, 'PEME-2019-00002', 'Tuan', 'Bayu', 'bayurifkialgh@gmail.com'),
(3, 'PEME-2019-00003', 'Tuan', 'Bayu Rifki Alghifari', 'bayurifkialgh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pemesan_tiket`
--

CREATE TABLE `pemesan_tiket` (
  `pemt_id` int(11) NOT NULL,
  `pemt_kode` varchar(50) NOT NULL,
  `pemt_tikp_id` int(11) NOT NULL,
  `pemt_tipd_id` int(11) NOT NULL,
  `pemt_tikk_id` int(11) NOT NULL,
  `pemt_tikd_id` int(11) NOT NULL,
  `pemt_status_pesanan` varchar(50) NOT NULL,
  `pemt_peme_id` int(11) NOT NULL,
  `pemt_penu_id` int(11) NOT NULL,
  `pemt_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesan_tiket`
--

INSERT INTO `pemesan_tiket` (`pemt_id`, `pemt_kode`, `pemt_tikp_id`, `pemt_tipd_id`, `pemt_tikk_id`, `pemt_tikd_id`, `pemt_status_pesanan`, `pemt_peme_id`, `pemt_penu_id`, `pemt_status`) VALUES
(1, 'PESAN-2019-00001', 0, 0, 2, 3, 'Kereta', 1, 2, 'Terverivikasi'),
(2, 'PESAN-2019-00002', 0, 0, 2, 4, 'Kereta', 1, 1, 'Terverivikasi'),
(3, 'PESAN-2019-00003', 1, 1, 0, 0, 'Pesawat', 2, 4, 'Terverivikasi'),
(4, 'PESAN-2019-00004', 1, 3, 0, 0, 'Pesawat', 2, 3, 'Terverivikasi'),
(5, 'PESAN-2019-00005', 1, 4, 0, 0, 'Pesawat', 3, 6, 'Terverivikasi'),
(6, 'PESAN-2019-00006', 1, 4, 0, 0, 'Pesawat', 3, 5, 'Terverivikasi');

-- --------------------------------------------------------

--
-- Table structure for table `penumpang`
--

CREATE TABLE `penumpang` (
  `penu_id` int(11) NOT NULL,
  `penu_kode` varchar(50) NOT NULL,
  `penu_title` varchar(50) NOT NULL,
  `penu_nama` varchar(50) NOT NULL,
  `penu_email` varchar(50) NOT NULL,
  `penu_status` varchar(50) NOT NULL,
  `penu_nega_id` int(11) NOT NULL,
  `penu_ktp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penumpang`
--

INSERT INTO `penumpang` (`penu_id`, `penu_kode`, `penu_title`, `penu_nama`, `penu_email`, `penu_status`, `penu_nega_id`, `penu_ktp`) VALUES
(1, 'PENU-2019-00001', 'Tuan', 'Rifki', '', 'Dewasa', 0, 12312312),
(2, 'PENU-2019-00002', 'Tuan', 'Alghifari', '', 'Dewasa', 0, 12312312),
(3, 'PENU-2019-00003', 'Tuan', 'Rifki2', '', 'Dewasa', 1, 0),
(4, 'PENU-2019-00004', 'Tuan', 'Alghifari2', '', 'Dewasa', 1, 0),
(5, 'PENU-2019-00005', 'Tuan', 'Rifki', '', 'Dewasa', 1, 0),
(6, 'PENU-2019-00006', 'Tuan', 'Permana', '', 'Dewasa', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pesawat`
--

CREATE TABLE `pesawat` (
  `pesa_id` int(11) NOT NULL,
  `pesa_mask_id` int(11) NOT NULL,
  `pesa_kode` varchar(50) NOT NULL,
  `pesa_nama` varchar(50) NOT NULL,
  `pesa_deskripsi` text NOT NULL,
  `pesa_jumlah_kursi` int(11) NOT NULL,
  `pesa_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesawat`
--

INSERT INTO `pesawat` (`pesa_id`, `pesa_mask_id`, `pesa_kode`, `pesa_nama`, `pesa_deskripsi`, `pesa_jumlah_kursi`, `pesa_status`) VALUES
(2, 2, 'ATR 72 ', 'ATR', 'Pesawat penumpang regional jarak pendek bermesin twin-turboprop yang dibangun perusahaan pesawat Prancis-Italia ATR', 78, 'Aktif'),
(3, 2, 'Boeing 747-400', 'Boeing 747', 'Boeing 747-400 adalah versi kedua terbaru dari keluarga pesawat Boeing 747, yang akan digantikan oleh Boeing 747-8 yang lebih ekonomis dan maju. Model -400 terakhir diberikan pada konsumen pada bulan Desember 2009.', 428, 'Aktif'),
(4, 2, 'Airbus A330', 'Airbus A330', 'Pesawat terbang jet sipil komersial bermesin ganda (twinjet) jarak-menengah-hingga-jauh', 295, 'Aktif'),
(5, 2, 'Boeing 737 MAX', 'Boeing 737 MAX', 'Pesawat penumpang sipil (airliner) yang sedang dikembangkan oleh Boeing untuk menggantikan keluarga Boeing 737 Next Generation', 137, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `role_aplikasi`
--

CREATE TABLE `role_aplikasi` (
  `rola_id` int(11) NOT NULL,
  `rola_menu_id` int(11) DEFAULT NULL,
  `rola_lev_id` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_aplikasi`
--

INSERT INTO `role_aplikasi` (`rola_id`, `rola_menu_id`, `rola_lev_id`, `created_date`) VALUES
(1, 1, 1, '2019-11-21 13:28:03'),
(13, 64, 1, '2019-06-11 10:26:01'),
(15, 27, 1, '2019-06-11 10:24:53'),
(16, 61, 1, '2019-06-11 10:25:03'),
(17, 63, 1, '2019-06-11 10:25:13'),
(18, 37, 1, '2019-06-11 10:35:04'),
(19, 65, 1, '2019-11-22 12:07:34'),
(20, 66, 1, '2019-11-22 12:13:13'),
(21, 67, 1, '2019-11-22 12:13:22'),
(22, 68, 1, '2019-11-22 12:13:32'),
(23, 69, 1, '2019-11-22 12:13:39'),
(24, 70, 1, '2019-11-22 12:13:47'),
(25, 72, 0, '2019-11-22 12:16:07'),
(27, 72, 1, '2019-11-22 12:17:17'),
(32, 77, 6, '2019-11-25 13:56:21'),
(33, 78, 1, '2019-11-29 13:10:21'),
(34, 79, 1, '2019-11-29 13:11:36'),
(35, 80, 1, '2019-11-29 13:11:44'),
(36, 77, 3, '2019-12-04 15:38:46'),
(37, 81, 6, '2019-12-06 07:19:05'),
(38, 81, 3, '2019-12-06 07:19:12'),
(39, 82, 1, '2019-12-12 04:18:40'),
(44, 83, 1, '2019-12-12 06:48:46'),
(45, 71, 1, '2019-12-12 06:54:34'),
(46, 88, 1, '2019-12-12 06:52:34'),
(47, 89, 1, '2019-12-12 06:52:42'),
(48, 91, 1, '2019-12-12 06:53:26'),
(49, 92, 1, '2019-12-12 06:53:33'),
(50, 90, 1, '2019-12-12 06:53:52'),
(51, 87, 1, '2019-12-12 06:53:58'),
(52, 93, 1, '2019-12-12 06:56:24'),
(53, 94, 1, '2019-12-12 06:56:31'),
(54, 95, 1, '2019-12-12 06:56:38'),
(55, 1, 5, '2019-12-20 12:19:30'),
(56, 78, 5, '2019-12-20 12:19:38'),
(57, 79, 5, '2019-12-20 12:19:47'),
(58, 80, 5, '2019-12-20 12:19:54'),
(59, 82, 5, '2019-12-20 12:20:02'),
(60, 93, 5, '2019-12-20 12:20:12'),
(61, 94, 5, '2019-12-20 12:20:23'),
(62, 95, 5, '2019-12-20 12:20:32'),
(63, 90, 5, '2019-12-20 12:20:46'),
(64, 91, 5, '2019-12-20 12:20:54'),
(65, 92, 5, '2019-12-20 12:21:09'),
(66, 96, 1, '2019-12-20 12:22:14'),
(67, 96, 5, '2019-12-20 12:22:24'),
(69, 98, 1, '2019-12-29 13:37:19'),
(70, 99, 1, '2019-12-29 13:38:29'),
(71, 100, 1, '2019-12-29 13:40:02'),
(72, 101, 1, '2019-12-29 13:40:09'),
(73, 97, 5, '2019-12-29 13:41:47'),
(74, 98, 5, '2019-12-29 13:41:59'),
(76, 100, 5, '2019-12-29 13:42:17'),
(77, 97, 1, '2019-12-29 13:43:10'),
(78, 100, 5, '2019-12-29 13:43:32'),
(79, 101, 5, '2019-12-29 13:43:40');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `rolu_id` int(11) NOT NULL,
  `rolu_user_id` int(11) DEFAULT NULL,
  `rolu_lev_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`rolu_id`, `rolu_user_id`, `rolu_lev_id`, `created_at`, `created_date`) VALUES
(29, 31, 1, NULL, '2019-06-11 09:19:20'),
(30, 0, 6, NULL, '2019-11-25 13:46:51'),
(34, 1, 3, NULL, '2019-12-04 15:25:01'),
(35, 57, 3, NULL, '2020-01-03 12:26:53'),
(36, 58, 5, NULL, '2019-12-20 12:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `rute_id` int(11) NOT NULL,
  `rute_kota_asal_id` int(11) NOT NULL,
  `rute_kota_tujuan_id` int(11) NOT NULL,
  `rute_band_asal_id` int(11) NOT NULL,
  `rute_band_tujuan_id` int(11) NOT NULL,
  `rute_harga` int(11) NOT NULL,
  `rute_status` varchar(50) NOT NULL,
  `rute_kode` varchar(50) NOT NULL,
  `rute_jarak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`rute_id`, `rute_kota_asal_id`, `rute_kota_tujuan_id`, `rute_band_asal_id`, `rute_band_tujuan_id`, `rute_harga`, `rute_status`, `rute_kode`, `rute_jarak`) VALUES
(2, 4, 8, 3, 4, 40, 'Aktif', 'RUTE-2019-00001', 118),
(3, 8, 4, 4, 3, 40, 'Aktif', 'RUTE-2019-00002', 118);

-- --------------------------------------------------------

--
-- Table structure for table `rute_kereta`
--

CREATE TABLE `rute_kereta` (
  `rute_id` int(11) NOT NULL,
  `rute_kota_asal_id` int(11) NOT NULL,
  `rute_kota_tujuan_id` int(11) NOT NULL,
  `rute_stat_asal_id` int(11) NOT NULL,
  `rute_stat_tujuan_id` int(11) NOT NULL,
  `rute_harga` int(11) NOT NULL,
  `rute_harga_dolar` int(11) NOT NULL,
  `rute_status` varchar(50) NOT NULL,
  `rute_kode` varchar(50) NOT NULL,
  `rute_jarak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rute_kereta`
--

INSERT INTO `rute_kereta` (`rute_id`, `rute_kota_asal_id`, `rute_kota_tujuan_id`, `rute_stat_asal_id`, `rute_stat_tujuan_id`, `rute_harga`, `rute_harga_dolar`, `rute_status`, `rute_kode`, `rute_jarak`) VALUES
(2, 4, 10, 4, 6, 50000, 4, 'Aktif', 'RKAI-2019-00001', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stasiun`
--

CREATE TABLE `stasiun` (
  `stat_id` int(11) NOT NULL,
  `stat_kota_id` int(11) NOT NULL,
  `stat_nama` varchar(50) NOT NULL,
  `stat_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stasiun`
--

INSERT INTO `stasiun` (`stat_id`, `stat_kota_id`, `stat_nama`, `stat_keterangan`) VALUES
(3, 1, 'Stasiun Cimahi', '-'),
(4, 2, 'Stasiun Padalarang', '-'),
(5, 4, 'Stasiun Bandung', '-'),
(6, 10, 'Tasikmalaya', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tiket_kereta`
--

CREATE TABLE `tiket_kereta` (
  `tikk_id` int(11) NOT NULL,
  `tikk_jadk_kode` varchar(50) NOT NULL,
  `tikk_kela_id` int(11) NOT NULL,
  `tikk_jumlah_kursi` int(11) NOT NULL,
  `tikk_keterangan` text NOT NULL,
  `tikk_status` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket_kereta`
--

INSERT INTO `tiket_kereta` (`tikk_id`, `tikk_jadk_kode`, `tikk_kela_id`, `tikk_jumlah_kursi`, `tikk_keterangan`, `tikk_status`, `created_date`) VALUES
(2, 'PERJ-2019-00001', 4, 100, '-', 'Tersedia', '2019-12-20 11:53:29'),
(3, 'PERJ-2019-00002', 4, 100, '-', 'Tersedia', '2019-12-20 12:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `tiket_kereta_detail`
--

CREATE TABLE `tiket_kereta_detail` (
  `tikd_id` int(11) NOT NULL,
  `tikd_tikk_id` int(11) NOT NULL,
  `tikd_no_kursi` int(11) NOT NULL,
  `tikd_harga_usd` int(11) NOT NULL,
  `tikd_harga_idr` int(11) NOT NULL,
  `tikd_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket_kereta_detail`
--

INSERT INTO `tiket_kereta_detail` (`tikd_id`, `tikd_tikk_id`, `tikd_no_kursi`, `tikd_harga_usd`, `tikd_harga_idr`, `tikd_status`) VALUES
(1, 2, 1, 9, 126054, 'Sudah Dipesan'),
(2, 2, 2, 9, 126054, 'Sudah Dipesan'),
(3, 2, 3, 9, 126054, 'Sudah Dipesan'),
(4, 2, 4, 9, 126054, 'Sudah Dipesan'),
(5, 2, 5, 9, 126054, 'Tersedia'),
(6, 2, 6, 9, 126054, 'Tersedia'),
(7, 2, 7, 9, 126054, 'Tersedia'),
(8, 2, 8, 9, 126054, 'Tersedia'),
(9, 2, 9, 9, 126054, 'Tersedia'),
(10, 2, 10, 9, 126054, 'Tersedia'),
(11, 2, 11, 9, 126054, 'Tersedia'),
(12, 2, 12, 9, 126054, 'Tersedia'),
(13, 2, 13, 9, 126054, 'Tersedia'),
(14, 2, 14, 9, 126054, 'Tersedia'),
(15, 2, 15, 9, 126054, 'Tersedia'),
(16, 2, 16, 9, 126054, 'Tersedia'),
(17, 2, 17, 9, 126054, 'Tersedia'),
(18, 2, 18, 9, 126054, 'Tersedia'),
(19, 2, 19, 9, 126054, 'Tersedia'),
(20, 2, 20, 9, 126054, 'Tersedia'),
(21, 2, 21, 9, 126054, 'Tersedia'),
(22, 2, 22, 9, 126054, 'Tersedia'),
(23, 2, 23, 9, 126054, 'Tersedia'),
(24, 2, 24, 9, 126054, 'Tersedia'),
(25, 2, 25, 9, 126054, 'Tersedia'),
(26, 2, 26, 9, 126054, 'Tersedia'),
(27, 2, 27, 9, 126054, 'Tersedia'),
(28, 2, 28, 9, 126054, 'Tersedia'),
(29, 2, 29, 9, 126054, 'Tersedia'),
(30, 2, 30, 9, 126054, 'Tersedia'),
(31, 2, 31, 9, 126054, 'Tersedia'),
(32, 2, 32, 9, 126054, 'Tersedia'),
(33, 2, 33, 9, 126054, 'Tersedia'),
(34, 2, 34, 9, 126054, 'Tersedia'),
(35, 2, 35, 9, 126054, 'Tersedia'),
(36, 2, 36, 9, 126054, 'Tersedia'),
(37, 2, 37, 9, 126054, 'Tersedia'),
(38, 2, 38, 9, 126054, 'Tersedia'),
(39, 2, 39, 9, 126054, 'Tersedia'),
(40, 2, 40, 9, 126054, 'Tersedia'),
(41, 2, 41, 9, 126054, 'Tersedia'),
(42, 2, 42, 9, 126054, 'Tersedia'),
(43, 2, 43, 9, 126054, 'Tersedia'),
(44, 2, 44, 9, 126054, 'Tersedia'),
(45, 2, 45, 9, 126054, 'Tersedia'),
(46, 2, 46, 9, 126054, 'Tersedia'),
(47, 2, 47, 9, 126054, 'Tersedia'),
(48, 2, 48, 9, 126054, 'Tersedia'),
(49, 2, 49, 9, 126054, 'Tersedia'),
(50, 2, 50, 9, 126054, 'Tersedia'),
(51, 2, 51, 9, 126054, 'Tersedia'),
(52, 2, 52, 9, 126054, 'Tersedia'),
(53, 2, 53, 9, 126054, 'Tersedia'),
(54, 2, 54, 9, 126054, 'Tersedia'),
(55, 2, 55, 9, 126054, 'Tersedia'),
(56, 2, 56, 9, 126054, 'Tersedia'),
(57, 2, 57, 9, 126054, 'Tersedia'),
(58, 2, 58, 9, 126054, 'Tersedia'),
(59, 2, 59, 9, 126054, 'Tersedia'),
(60, 2, 60, 9, 126054, 'Tersedia'),
(61, 2, 61, 9, 126054, 'Tersedia'),
(62, 2, 62, 9, 126054, 'Tersedia'),
(63, 2, 63, 9, 126054, 'Tersedia'),
(64, 2, 64, 9, 126054, 'Tersedia'),
(65, 2, 65, 9, 126054, 'Tersedia'),
(66, 2, 66, 9, 126054, 'Tersedia'),
(67, 2, 67, 9, 126054, 'Tersedia'),
(68, 2, 68, 9, 126054, 'Tersedia'),
(69, 2, 69, 9, 126054, 'Tersedia'),
(70, 2, 70, 9, 126054, 'Tersedia'),
(71, 2, 71, 9, 126054, 'Tersedia'),
(72, 2, 72, 9, 126054, 'Tersedia'),
(73, 2, 73, 9, 126054, 'Tersedia'),
(74, 2, 74, 9, 126054, 'Tersedia'),
(75, 2, 75, 9, 126054, 'Tersedia'),
(76, 2, 76, 9, 126054, 'Tersedia'),
(77, 2, 77, 9, 126054, 'Tersedia'),
(78, 2, 78, 9, 126054, 'Tersedia'),
(79, 2, 79, 9, 126054, 'Tersedia'),
(80, 2, 80, 9, 126054, 'Tersedia'),
(81, 2, 81, 9, 126054, 'Tersedia'),
(82, 2, 82, 9, 126054, 'Tersedia'),
(83, 2, 83, 9, 126054, 'Tersedia'),
(84, 2, 84, 9, 126054, 'Tersedia'),
(85, 2, 85, 9, 126054, 'Tersedia'),
(86, 2, 86, 9, 126054, 'Tersedia'),
(87, 2, 87, 9, 126054, 'Tersedia'),
(88, 2, 88, 9, 126054, 'Tersedia'),
(89, 2, 89, 9, 126054, 'Tersedia'),
(90, 2, 90, 9, 126054, 'Tersedia'),
(91, 2, 91, 9, 126054, 'Tersedia'),
(92, 2, 92, 9, 126054, 'Tersedia'),
(93, 2, 93, 9, 126054, 'Tersedia'),
(94, 2, 94, 9, 126054, 'Tersedia'),
(95, 2, 95, 9, 126054, 'Tersedia'),
(96, 2, 96, 9, 126054, 'Tersedia'),
(97, 2, 97, 9, 126054, 'Tersedia'),
(98, 2, 98, 9, 126054, 'Tersedia'),
(99, 2, 99, 9, 126054, 'Tersedia'),
(100, 2, 100, 9, 126054, 'Tersedia'),
(101, 3, 1, 9, 126054, 'Tersedia'),
(102, 3, 2, 9, 126054, 'Tersedia'),
(103, 3, 3, 9, 126054, 'Tersedia'),
(104, 3, 4, 9, 126054, 'Tersedia'),
(105, 3, 5, 9, 126054, 'Tersedia'),
(106, 3, 6, 9, 126054, 'Tersedia'),
(107, 3, 7, 9, 126054, 'Tersedia'),
(108, 3, 8, 9, 126054, 'Tersedia'),
(109, 3, 9, 9, 126054, 'Tersedia'),
(110, 3, 10, 9, 126054, 'Tersedia'),
(111, 3, 11, 9, 126054, 'Tersedia'),
(112, 3, 12, 9, 126054, 'Tersedia'),
(113, 3, 13, 9, 126054, 'Tersedia'),
(114, 3, 14, 9, 126054, 'Tersedia'),
(115, 3, 15, 9, 126054, 'Tersedia'),
(116, 3, 16, 9, 126054, 'Tersedia'),
(117, 3, 17, 9, 126054, 'Tersedia'),
(118, 3, 18, 9, 126054, 'Tersedia'),
(119, 3, 19, 9, 126054, 'Tersedia'),
(120, 3, 20, 9, 126054, 'Tersedia'),
(121, 3, 21, 9, 126054, 'Tersedia'),
(122, 3, 22, 9, 126054, 'Tersedia'),
(123, 3, 23, 9, 126054, 'Tersedia'),
(124, 3, 24, 9, 126054, 'Tersedia'),
(125, 3, 25, 9, 126054, 'Tersedia'),
(126, 3, 26, 9, 126054, 'Tersedia'),
(127, 3, 27, 9, 126054, 'Tersedia'),
(128, 3, 28, 9, 126054, 'Tersedia'),
(129, 3, 29, 9, 126054, 'Tersedia'),
(130, 3, 30, 9, 126054, 'Tersedia'),
(131, 3, 31, 9, 126054, 'Tersedia'),
(132, 3, 32, 9, 126054, 'Tersedia'),
(133, 3, 33, 9, 126054, 'Tersedia'),
(134, 3, 34, 9, 126054, 'Tersedia'),
(135, 3, 35, 9, 126054, 'Tersedia'),
(136, 3, 36, 9, 126054, 'Tersedia'),
(137, 3, 37, 9, 126054, 'Tersedia'),
(138, 3, 38, 9, 126054, 'Tersedia'),
(139, 3, 39, 9, 126054, 'Tersedia'),
(140, 3, 40, 9, 126054, 'Tersedia'),
(141, 3, 41, 9, 126054, 'Tersedia'),
(142, 3, 42, 9, 126054, 'Tersedia'),
(143, 3, 43, 9, 126054, 'Tersedia'),
(144, 3, 44, 9, 126054, 'Tersedia'),
(145, 3, 45, 9, 126054, 'Tersedia'),
(146, 3, 46, 9, 126054, 'Tersedia'),
(147, 3, 47, 9, 126054, 'Tersedia'),
(148, 3, 48, 9, 126054, 'Tersedia'),
(149, 3, 49, 9, 126054, 'Tersedia'),
(150, 3, 50, 9, 126054, 'Tersedia'),
(151, 3, 51, 9, 126054, 'Tersedia'),
(152, 3, 52, 9, 126054, 'Tersedia'),
(153, 3, 53, 9, 126054, 'Tersedia'),
(154, 3, 54, 9, 126054, 'Tersedia'),
(155, 3, 55, 9, 126054, 'Tersedia'),
(156, 3, 56, 9, 126054, 'Tersedia'),
(157, 3, 57, 9, 126054, 'Tersedia'),
(158, 3, 58, 9, 126054, 'Tersedia'),
(159, 3, 59, 9, 126054, 'Tersedia'),
(160, 3, 60, 9, 126054, 'Tersedia'),
(161, 3, 61, 9, 126054, 'Tersedia'),
(162, 3, 62, 9, 126054, 'Tersedia'),
(163, 3, 63, 9, 126054, 'Tersedia'),
(164, 3, 64, 9, 126054, 'Tersedia'),
(165, 3, 65, 9, 126054, 'Tersedia'),
(166, 3, 66, 9, 126054, 'Tersedia'),
(167, 3, 67, 9, 126054, 'Tersedia'),
(168, 3, 68, 9, 126054, 'Tersedia'),
(169, 3, 69, 9, 126054, 'Tersedia'),
(170, 3, 70, 9, 126054, 'Tersedia'),
(171, 3, 71, 9, 126054, 'Tersedia'),
(172, 3, 72, 9, 126054, 'Tersedia'),
(173, 3, 73, 9, 126054, 'Tersedia'),
(174, 3, 74, 9, 126054, 'Tersedia'),
(175, 3, 75, 9, 126054, 'Tersedia'),
(176, 3, 76, 9, 126054, 'Tersedia'),
(177, 3, 77, 9, 126054, 'Tersedia'),
(178, 3, 78, 9, 126054, 'Tersedia'),
(179, 3, 79, 9, 126054, 'Tersedia'),
(180, 3, 80, 9, 126054, 'Tersedia'),
(181, 3, 81, 9, 126054, 'Tersedia'),
(182, 3, 82, 9, 126054, 'Tersedia'),
(183, 3, 83, 9, 126054, 'Tersedia'),
(184, 3, 84, 9, 126054, 'Tersedia'),
(185, 3, 85, 9, 126054, 'Tersedia'),
(186, 3, 86, 9, 126054, 'Tersedia'),
(187, 3, 87, 9, 126054, 'Tersedia'),
(188, 3, 88, 9, 126054, 'Tersedia'),
(189, 3, 89, 9, 126054, 'Tersedia'),
(190, 3, 90, 9, 126054, 'Tersedia'),
(191, 3, 91, 9, 126054, 'Tersedia'),
(192, 3, 92, 9, 126054, 'Tersedia'),
(193, 3, 93, 9, 126054, 'Tersedia'),
(194, 3, 94, 9, 126054, 'Tersedia'),
(195, 3, 95, 9, 126054, 'Tersedia'),
(196, 3, 96, 9, 126054, 'Tersedia'),
(197, 3, 97, 9, 126054, 'Tersedia'),
(198, 3, 98, 9, 126054, 'Tersedia'),
(199, 3, 99, 9, 126054, 'Tersedia'),
(200, 3, 100, 9, 126054, 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `tiket_pesawat`
--

CREATE TABLE `tiket_pesawat` (
  `tikp_id` int(11) NOT NULL,
  `tikp_jadp_kode` varchar(50) NOT NULL,
  `tikp_kela_id` int(11) NOT NULL,
  `tikp_jumlah_kursi` int(11) NOT NULL,
  `tikp_keterangan` text NOT NULL,
  `tikp_status` varchar(50) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket_pesawat`
--

INSERT INTO `tiket_pesawat` (`tikp_id`, `tikp_jadp_kode`, `tikp_kela_id`, `tikp_jumlah_kursi`, `tikp_keterangan`, `tikp_status`, `created_date`) VALUES
(1, 'PENE-2019-00002', 3, 78, '-', 'Tersedia', '2019-12-20'),
(2, 'PENE-2019-00002', 1, 78, '-', 'Tersedia', '2019-12-20'),
(3, 'PENE-2019-00002', 2, 78, '-', 'Tersedia', '2019-12-20');

-- --------------------------------------------------------

--
-- Table structure for table `tiket_pesawat_detail`
--

CREATE TABLE `tiket_pesawat_detail` (
  `tipd_id` int(11) NOT NULL,
  `tipd_tikp_id` int(11) NOT NULL,
  `tipd_no_kursi` int(11) NOT NULL,
  `tikp_harga_usd` int(11) NOT NULL,
  `tikp_harga_idr` int(11) NOT NULL,
  `tipd_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket_pesawat_detail`
--

INSERT INTO `tiket_pesawat_detail` (`tipd_id`, `tipd_tikp_id`, `tipd_no_kursi`, `tikp_harga_usd`, `tikp_harga_idr`, `tipd_status`) VALUES
(1, 1, 1, 90, 1260540, 'Sudah Dipesan'),
(2, 1, 2, 90, 1260540, 'Sudah Dipesan'),
(3, 1, 3, 90, 1260540, 'Sudah Dipesan'),
(4, 1, 4, 90, 1260540, 'Sudah Dipesan'),
(5, 1, 5, 90, 1260540, 'Tersedia'),
(6, 1, 6, 90, 1260540, 'Tersedia'),
(7, 1, 7, 90, 1260540, 'Tersedia'),
(8, 1, 8, 90, 1260540, 'Tersedia'),
(9, 1, 9, 90, 1260540, 'Tersedia'),
(10, 1, 10, 90, 1260540, 'Tersedia'),
(11, 1, 11, 90, 1260540, 'Tersedia'),
(12, 1, 12, 90, 1260540, 'Tersedia'),
(13, 1, 13, 90, 1260540, 'Tersedia'),
(14, 1, 14, 90, 1260540, 'Tersedia'),
(15, 1, 15, 90, 1260540, 'Tersedia'),
(16, 1, 16, 90, 1260540, 'Tersedia'),
(17, 1, 17, 90, 1260540, 'Tersedia'),
(18, 1, 18, 90, 1260540, 'Tersedia'),
(19, 1, 19, 90, 1260540, 'Tersedia'),
(20, 1, 20, 90, 1260540, 'Tersedia'),
(21, 1, 21, 90, 1260540, 'Tersedia'),
(22, 1, 22, 90, 1260540, 'Tersedia'),
(23, 1, 23, 90, 1260540, 'Tersedia'),
(24, 1, 24, 90, 1260540, 'Tersedia'),
(25, 1, 25, 90, 1260540, 'Tersedia'),
(26, 1, 26, 90, 1260540, 'Tersedia'),
(27, 1, 27, 90, 1260540, 'Tersedia'),
(28, 1, 28, 90, 1260540, 'Tersedia'),
(29, 1, 29, 90, 1260540, 'Tersedia'),
(30, 1, 30, 90, 1260540, 'Tersedia'),
(31, 1, 31, 90, 1260540, 'Tersedia'),
(32, 1, 32, 90, 1260540, 'Tersedia'),
(33, 1, 33, 90, 1260540, 'Tersedia'),
(34, 1, 34, 90, 1260540, 'Tersedia'),
(35, 1, 35, 90, 1260540, 'Tersedia'),
(36, 1, 36, 90, 1260540, 'Tersedia'),
(37, 1, 37, 90, 1260540, 'Tersedia'),
(38, 1, 38, 90, 1260540, 'Tersedia'),
(39, 1, 39, 90, 1260540, 'Tersedia'),
(40, 1, 40, 90, 1260540, 'Tersedia'),
(41, 1, 41, 90, 1260540, 'Tersedia'),
(42, 1, 42, 90, 1260540, 'Tersedia'),
(43, 1, 43, 90, 1260540, 'Tersedia'),
(44, 1, 44, 90, 1260540, 'Tersedia'),
(45, 1, 45, 90, 1260540, 'Tersedia'),
(46, 1, 46, 90, 1260540, 'Tersedia'),
(47, 1, 47, 90, 1260540, 'Tersedia'),
(48, 1, 48, 90, 1260540, 'Tersedia'),
(49, 1, 49, 90, 1260540, 'Tersedia'),
(50, 1, 50, 90, 1260540, 'Tersedia'),
(51, 1, 51, 90, 1260540, 'Tersedia'),
(52, 1, 52, 90, 1260540, 'Tersedia'),
(53, 1, 53, 90, 1260540, 'Tersedia'),
(54, 1, 54, 90, 1260540, 'Tersedia'),
(55, 1, 55, 90, 1260540, 'Tersedia'),
(56, 1, 56, 90, 1260540, 'Tersedia'),
(57, 1, 57, 90, 1260540, 'Tersedia'),
(58, 1, 58, 90, 1260540, 'Tersedia'),
(59, 1, 59, 90, 1260540, 'Tersedia'),
(60, 1, 60, 90, 1260540, 'Tersedia'),
(61, 1, 61, 90, 1260540, 'Tersedia'),
(62, 1, 62, 90, 1260540, 'Tersedia'),
(63, 1, 63, 90, 1260540, 'Tersedia'),
(64, 1, 64, 90, 1260540, 'Tersedia'),
(65, 1, 65, 90, 1260540, 'Tersedia'),
(66, 1, 66, 90, 1260540, 'Tersedia'),
(67, 1, 67, 90, 1260540, 'Tersedia'),
(68, 1, 68, 90, 1260540, 'Tersedia'),
(69, 1, 69, 90, 1260540, 'Tersedia'),
(70, 1, 70, 90, 1260540, 'Tersedia'),
(71, 1, 71, 90, 1260540, 'Tersedia'),
(72, 1, 72, 90, 1260540, 'Tersedia'),
(73, 1, 73, 90, 1260540, 'Tersedia'),
(74, 1, 74, 90, 1260540, 'Tersedia'),
(75, 1, 75, 90, 1260540, 'Tersedia'),
(76, 1, 76, 90, 1260540, 'Tersedia'),
(77, 1, 77, 90, 1260540, 'Tersedia'),
(78, 1, 78, 90, 1260540, 'Tersedia'),
(79, 2, 1, 40, 560240, 'Tersedia'),
(80, 2, 2, 40, 560240, 'Tersedia'),
(81, 2, 3, 40, 560240, 'Tersedia'),
(82, 2, 4, 40, 560240, 'Tersedia'),
(83, 2, 5, 40, 560240, 'Tersedia'),
(84, 2, 6, 40, 560240, 'Tersedia'),
(85, 2, 7, 40, 560240, 'Tersedia'),
(86, 2, 8, 40, 560240, 'Tersedia'),
(87, 2, 9, 40, 560240, 'Tersedia'),
(88, 2, 10, 40, 560240, 'Tersedia'),
(89, 2, 11, 40, 560240, 'Tersedia'),
(90, 2, 12, 40, 560240, 'Tersedia'),
(91, 2, 13, 40, 560240, 'Tersedia'),
(92, 2, 14, 40, 560240, 'Tersedia'),
(93, 2, 15, 40, 560240, 'Tersedia'),
(94, 2, 16, 40, 560240, 'Tersedia'),
(95, 2, 17, 40, 560240, 'Tersedia'),
(96, 2, 18, 40, 560240, 'Tersedia'),
(97, 2, 19, 40, 560240, 'Tersedia'),
(98, 2, 20, 40, 560240, 'Tersedia'),
(99, 2, 21, 40, 560240, 'Tersedia'),
(100, 2, 22, 40, 560240, 'Tersedia'),
(101, 2, 23, 40, 560240, 'Tersedia'),
(102, 2, 24, 40, 560240, 'Tersedia'),
(103, 2, 25, 40, 560240, 'Tersedia'),
(104, 2, 26, 40, 560240, 'Tersedia'),
(105, 2, 27, 40, 560240, 'Tersedia'),
(106, 2, 28, 40, 560240, 'Tersedia'),
(107, 2, 29, 40, 560240, 'Tersedia'),
(108, 2, 30, 40, 560240, 'Tersedia'),
(109, 2, 31, 40, 560240, 'Tersedia'),
(110, 2, 32, 40, 560240, 'Tersedia'),
(111, 2, 33, 40, 560240, 'Tersedia'),
(112, 2, 34, 40, 560240, 'Tersedia'),
(113, 2, 35, 40, 560240, 'Tersedia'),
(114, 2, 36, 40, 560240, 'Tersedia'),
(115, 2, 37, 40, 560240, 'Tersedia'),
(116, 2, 38, 40, 560240, 'Tersedia'),
(117, 2, 39, 40, 560240, 'Tersedia'),
(118, 2, 40, 40, 560240, 'Tersedia'),
(119, 2, 41, 40, 560240, 'Tersedia'),
(120, 2, 42, 40, 560240, 'Tersedia'),
(121, 2, 43, 40, 560240, 'Tersedia'),
(122, 2, 44, 40, 560240, 'Tersedia'),
(123, 2, 45, 40, 560240, 'Tersedia'),
(124, 2, 46, 40, 560240, 'Tersedia'),
(125, 2, 47, 40, 560240, 'Tersedia'),
(126, 2, 48, 40, 560240, 'Tersedia'),
(127, 2, 49, 40, 560240, 'Tersedia'),
(128, 2, 50, 40, 560240, 'Tersedia'),
(129, 2, 51, 40, 560240, 'Tersedia'),
(130, 2, 52, 40, 560240, 'Tersedia'),
(131, 2, 53, 40, 560240, 'Tersedia'),
(132, 2, 54, 40, 560240, 'Tersedia'),
(133, 2, 55, 40, 560240, 'Tersedia'),
(134, 2, 56, 40, 560240, 'Tersedia'),
(135, 2, 57, 40, 560240, 'Tersedia'),
(136, 2, 58, 40, 560240, 'Tersedia'),
(137, 2, 59, 40, 560240, 'Tersedia'),
(138, 2, 60, 40, 560240, 'Tersedia'),
(139, 2, 61, 40, 560240, 'Tersedia'),
(140, 2, 62, 40, 560240, 'Tersedia'),
(141, 2, 63, 40, 560240, 'Tersedia'),
(142, 2, 64, 40, 560240, 'Tersedia'),
(143, 2, 65, 40, 560240, 'Tersedia'),
(144, 2, 66, 40, 560240, 'Tersedia'),
(145, 2, 67, 40, 560240, 'Tersedia'),
(146, 2, 68, 40, 560240, 'Tersedia'),
(147, 2, 69, 40, 560240, 'Tersedia'),
(148, 2, 70, 40, 560240, 'Tersedia'),
(149, 2, 71, 40, 560240, 'Tersedia'),
(150, 2, 72, 40, 560240, 'Tersedia'),
(151, 2, 73, 40, 560240, 'Tersedia'),
(152, 2, 74, 40, 560240, 'Tersedia'),
(153, 2, 75, 40, 560240, 'Tersedia'),
(154, 2, 76, 40, 560240, 'Tersedia'),
(155, 2, 77, 40, 560240, 'Tersedia'),
(156, 2, 78, 40, 560240, 'Tersedia'),
(157, 3, 1, 60, 840360, 'Tersedia'),
(158, 3, 2, 60, 840360, 'Tersedia'),
(159, 3, 3, 60, 840360, 'Tersedia'),
(160, 3, 4, 60, 840360, 'Tersedia'),
(161, 3, 5, 60, 840360, 'Tersedia'),
(162, 3, 6, 60, 840360, 'Tersedia'),
(163, 3, 7, 60, 840360, 'Tersedia'),
(164, 3, 8, 60, 840360, 'Tersedia'),
(165, 3, 9, 60, 840360, 'Tersedia'),
(166, 3, 10, 60, 840360, 'Tersedia'),
(167, 3, 11, 60, 840360, 'Tersedia'),
(168, 3, 12, 60, 840360, 'Tersedia'),
(169, 3, 13, 60, 840360, 'Tersedia'),
(170, 3, 14, 60, 840360, 'Tersedia'),
(171, 3, 15, 60, 840360, 'Tersedia'),
(172, 3, 16, 60, 840360, 'Tersedia'),
(173, 3, 17, 60, 840360, 'Tersedia'),
(174, 3, 18, 60, 840360, 'Tersedia'),
(175, 3, 19, 60, 840360, 'Tersedia'),
(176, 3, 20, 60, 840360, 'Tersedia'),
(177, 3, 21, 60, 840360, 'Tersedia'),
(178, 3, 22, 60, 840360, 'Tersedia'),
(179, 3, 23, 60, 840360, 'Tersedia'),
(180, 3, 24, 60, 840360, 'Tersedia'),
(181, 3, 25, 60, 840360, 'Tersedia'),
(182, 3, 26, 60, 840360, 'Tersedia'),
(183, 3, 27, 60, 840360, 'Tersedia'),
(184, 3, 28, 60, 840360, 'Tersedia'),
(185, 3, 29, 60, 840360, 'Tersedia'),
(186, 3, 30, 60, 840360, 'Tersedia'),
(187, 3, 31, 60, 840360, 'Tersedia'),
(188, 3, 32, 60, 840360, 'Tersedia'),
(189, 3, 33, 60, 840360, 'Tersedia'),
(190, 3, 34, 60, 840360, 'Tersedia'),
(191, 3, 35, 60, 840360, 'Tersedia'),
(192, 3, 36, 60, 840360, 'Tersedia'),
(193, 3, 37, 60, 840360, 'Tersedia'),
(194, 3, 38, 60, 840360, 'Tersedia'),
(195, 3, 39, 60, 840360, 'Tersedia'),
(196, 3, 40, 60, 840360, 'Tersedia'),
(197, 3, 41, 60, 840360, 'Tersedia'),
(198, 3, 42, 60, 840360, 'Tersedia'),
(199, 3, 43, 60, 840360, 'Tersedia'),
(200, 3, 44, 60, 840360, 'Tersedia'),
(201, 3, 45, 60, 840360, 'Tersedia'),
(202, 3, 46, 60, 840360, 'Tersedia'),
(203, 3, 47, 60, 840360, 'Tersedia'),
(204, 3, 48, 60, 840360, 'Tersedia'),
(205, 3, 49, 60, 840360, 'Tersedia'),
(206, 3, 50, 60, 840360, 'Tersedia'),
(207, 3, 51, 60, 840360, 'Tersedia'),
(208, 3, 52, 60, 840360, 'Tersedia'),
(209, 3, 53, 60, 840360, 'Tersedia'),
(210, 3, 54, 60, 840360, 'Tersedia'),
(211, 3, 55, 60, 840360, 'Tersedia'),
(212, 3, 56, 60, 840360, 'Tersedia'),
(213, 3, 57, 60, 840360, 'Tersedia'),
(214, 3, 58, 60, 840360, 'Tersedia'),
(215, 3, 59, 60, 840360, 'Tersedia'),
(216, 3, 60, 60, 840360, 'Tersedia'),
(217, 3, 61, 60, 840360, 'Tersedia'),
(218, 3, 62, 60, 840360, 'Tersedia'),
(219, 3, 63, 60, 840360, 'Tersedia'),
(220, 3, 64, 60, 840360, 'Tersedia'),
(221, 3, 65, 60, 840360, 'Tersedia'),
(222, 3, 66, 60, 840360, 'Tersedia'),
(223, 3, 67, 60, 840360, 'Tersedia'),
(224, 3, 68, 60, 840360, 'Tersedia'),
(225, 3, 69, 60, 840360, 'Tersedia'),
(226, 3, 70, 60, 840360, 'Tersedia'),
(227, 3, 71, 60, 840360, 'Tersedia'),
(228, 3, 72, 60, 840360, 'Tersedia'),
(229, 3, 73, 60, 840360, 'Tersedia'),
(230, 3, 74, 60, 840360, 'Tersedia'),
(231, 3, 75, 60, 840360, 'Tersedia'),
(232, 3, 76, 60, 840360, 'Tersedia'),
(233, 3, 77, 60, 840360, 'Tersedia'),
(234, 3, 78, 60, 840360, 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `user_address` varchar(250) DEFAULT NULL,
  `user_status` varchar(50) NOT NULL,
  `user_token` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_name`, `user_phone`, `user_address`, `user_status`, `user_token`, `created_date`) VALUES
(31, 'administrator@gmail.com', 'utqQiS/p4vWKh3E81QVNBONFqJt14hRtvAx446gYROkV8.8kh11eS', 'Administrator', '08382225436', '-', 'Terverivikasi', '', '2019-11-28 02:38:47'),
(57, 'bayurifkialgh@gmail.com', '0ZskfySiV0X4ODHImmoTx.TEvZN5pQ8AIKs/V293eDw097BpkIKfO', 'Bayu Rifki Alghifari', '081909866787', '-', 'Terverivikasi', 's5B9A.uEm.cXq1bBJGO0.emLWyrn3Vxs/0DWgoSlg7HV9MW.nUV1a', '2020-01-03 12:26:53'),
(58, 'manajemen@gmail.com', 'D3BLnK..6Y2nZcC5E.41EeXdYuWAQTDgpOMD0Z3HHjWaRS0kgBJtC', 'Manajemen 1', '08123123', '-', 'Terverivikasi', '', '2019-12-20 12:18:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bandara`
--
ALTER TABLE `bandara`
  ADD PRIMARY KEY (`band_id`);

--
-- Indexes for table `gerbong`
--
ALTER TABLE `gerbong`
  ADD PRIMARY KEY (`gerb_id`);

--
-- Indexes for table `jadwal_kereta`
--
ALTER TABLE `jadwal_kereta`
  ADD PRIMARY KEY (`jadk_id`);

--
-- Indexes for table `jadwal_pesawat`
--
ALTER TABLE `jadwal_pesawat`
  ADD PRIMARY KEY (`jadp_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kela_id`);

--
-- Indexes for table `kereta`
--
ALTER TABLE `kereta`
  ADD PRIMARY KEY (`keret_id`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`kota_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`lev_id`);

--
-- Indexes for table `maskapai`
--
ALTER TABLE `maskapai`
  ADD PRIMARY KEY (`mask_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `negara`
--
ALTER TABLE `negara`
  ADD PRIMARY KEY (`nega_id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`txn_id`);

--
-- Indexes for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`peme_id`);

--
-- Indexes for table `pemesan_tiket`
--
ALTER TABLE `pemesan_tiket`
  ADD PRIMARY KEY (`pemt_id`);

--
-- Indexes for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD PRIMARY KEY (`penu_id`);

--
-- Indexes for table `pesawat`
--
ALTER TABLE `pesawat`
  ADD PRIMARY KEY (`pesa_id`);

--
-- Indexes for table `role_aplikasi`
--
ALTER TABLE `role_aplikasi`
  ADD PRIMARY KEY (`rola_id`),
  ADD KEY `rola_menu_id` (`rola_menu_id`),
  ADD KEY `rola_lev_id` (`rola_lev_id`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`rolu_id`),
  ADD KEY `rolu_user_id` (`rolu_user_id`),
  ADD KEY `rolu_lev_id` (`rolu_lev_id`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`rute_id`);

--
-- Indexes for table `rute_kereta`
--
ALTER TABLE `rute_kereta`
  ADD PRIMARY KEY (`rute_id`);

--
-- Indexes for table `stasiun`
--
ALTER TABLE `stasiun`
  ADD PRIMARY KEY (`stat_id`);

--
-- Indexes for table `tiket_kereta`
--
ALTER TABLE `tiket_kereta`
  ADD PRIMARY KEY (`tikk_id`);

--
-- Indexes for table `tiket_kereta_detail`
--
ALTER TABLE `tiket_kereta_detail`
  ADD PRIMARY KEY (`tikd_id`);

--
-- Indexes for table `tiket_pesawat`
--
ALTER TABLE `tiket_pesawat`
  ADD PRIMARY KEY (`tikp_id`);

--
-- Indexes for table `tiket_pesawat_detail`
--
ALTER TABLE `tiket_pesawat_detail`
  ADD PRIMARY KEY (`tipd_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bandara`
--
ALTER TABLE `bandara`
  MODIFY `band_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gerbong`
--
ALTER TABLE `gerbong`
  MODIFY `gerb_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_kereta`
--
ALTER TABLE `jadwal_kereta`
  MODIFY `jadk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jadwal_pesawat`
--
ALTER TABLE `jadwal_pesawat`
  MODIFY `jadp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kela_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kereta`
--
ALTER TABLE `kereta`
  MODIFY `keret_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `kota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `lev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `maskapai`
--
ALTER TABLE `maskapai`
  MODIFY `mask_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `negara`
--
ALTER TABLE `negara`
  MODIFY `nega_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `txn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemesan`
--
ALTER TABLE `pemesan`
  MODIFY `peme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pemesan_tiket`
--
ALTER TABLE `pemesan_tiket`
  MODIFY `pemt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penumpang`
--
ALTER TABLE `penumpang`
  MODIFY `penu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pesawat`
--
ALTER TABLE `pesawat`
  MODIFY `pesa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role_aplikasi`
--
ALTER TABLE `role_aplikasi`
  MODIFY `rola_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `rolu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `rute`
--
ALTER TABLE `rute`
  MODIFY `rute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rute_kereta`
--
ALTER TABLE `rute_kereta`
  MODIFY `rute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stasiun`
--
ALTER TABLE `stasiun`
  MODIFY `stat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tiket_kereta`
--
ALTER TABLE `tiket_kereta`
  MODIFY `tikk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tiket_kereta_detail`
--
ALTER TABLE `tiket_kereta_detail`
  MODIFY `tikd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `tiket_pesawat`
--
ALTER TABLE `tiket_pesawat`
  MODIFY `tikp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tiket_pesawat_detail`
--
ALTER TABLE `tiket_pesawat_detail`
  MODIFY `tipd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
