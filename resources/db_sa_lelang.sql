-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 27, 2019 at 10:18 PM
-- Server version: 5.7.25
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sa_lelang`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

DROP TABLE IF EXISTS `akun`;
CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `nama_akun` varchar(25) NOT NULL,
  `sandi_akun` varchar(64) NOT NULL,
  `nama_lengkap_akun` varchar(100) NOT NULL,
  `email_akun` varchar(100) NOT NULL,
  `level_akun` enum('admin','staff') NOT NULL,
  `status_akun` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `nama_akun`, `sandi_akun`, `nama_lengkap_akun`, `email_akun`, `level_akun`, `status_akun`) VALUES
(1, 'admin01', 'cb0ef4c7be04ff1bf4cfcd104ef8df03251266ab', 'Admin 01', 'admin01@example.com', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `biaya_kirim`
--

DROP TABLE IF EXISTS `biaya_kirim`;
CREATE TABLE `biaya_kirim` (
  `id_biaya_kirim` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `jumlah_biaya_kirim` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `biaya_kirim`
--

INSERT INTO `biaya_kirim` (`id_biaya_kirim`, `id_kota`, `jumlah_biaya_kirim`) VALUES
(1, 1, 9000),
(2, 3, 9000),
(3, 2, 9000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `alias_kategori` varchar(100) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi_kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `alias_kategori`, `nama_kategori`, `deskripsi_kategori`) VALUES
(1, 'hp', 'Handphone', 'Handphone'),
(2, 'aksesoris', 'Aksesoris', 'Aksesoris'),
(3, 'komputer-dan-laptop', 'Komputer & Laptop', 'Komputer & Laptop'),
(4, 'fotografi', 'Fotografi', 'Fotografi');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi_bayar`
--

DROP TABLE IF EXISTS `konfirmasi_bayar`;
CREATE TABLE `konfirmasi_bayar` (
  `id_konfirmasi` int(11) NOT NULL,
  `tgl_konfirmasi` datetime NOT NULL,
  `notrans_order` varchar(11) NOT NULL,
  `no_rek` varchar(50) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `atas_nama` varchar(100) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tgl_transfer` datetime NOT NULL,
  `file_konfirmasi` varchar(150) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `bank_tujuan` varchar(100) NOT NULL,
  `status_konfirmasi` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: Pending, 1: Accepted, 2: Unverified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `konfirmasi_bayar`
--

INSERT INTO `konfirmasi_bayar` (`id_konfirmasi`, `tgl_konfirmasi`, `notrans_order`, `no_rek`, `nama_bank`, `atas_nama`, `nominal`, `tgl_transfer`, `file_konfirmasi`, `id_peserta`, `bank_tujuan`, `status_konfirmasi`) VALUES
(1, '2019-08-25 16:00:49', 'TR19080001', '0283116322', 'BCA', 'Hyde Lawless', 2609000, '2019-08-25 16:00:00', 'bukti_transfer_1.jpg', 1, 'BCA - 0283116411', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

DROP TABLE IF EXISTS `kota`;
CREATE TABLE `kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`) VALUES
(1, 'Jakarta Pusat'),
(2, 'Jakarta Timur'),
(3, 'Jakarta Selatan'),
(4, 'Jakarta Barat'),
(5, 'Jakarta Utara'),
(6, 'Bogor'),
(7, 'Bekasi'),
(8, 'Depok');

-- --------------------------------------------------------

--
-- Table structure for table `lelang`
--

DROP TABLE IF EXISTS `lelang`;
CREATE TABLE `lelang` (
  `id_lelang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_pelelang` int(11) NOT NULL,
  `nama_lelang` varchar(100) NOT NULL,
  `gambar_produk` varchar(100) NOT NULL,
  `berat_produk` int(5) NOT NULL DEFAULT '0',
  `harga_awal` int(11) NOT NULL,
  `harga_maksimal` int(11) NOT NULL,
  `waktu_mulai` datetime NOT NULL,
  `waktu_selesai` datetime NOT NULL,
  `keterangan` text NOT NULL,
  `status_lelang` enum('active','end') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lelang`
--

INSERT INTO `lelang` (`id_lelang`, `id_kategori`, `id_pelelang`, `nama_lelang`, `gambar_produk`, `berat_produk`, `harga_awal`, `harga_maksimal`, `waktu_mulai`, `waktu_selesai`, `keterangan`, `status_lelang`) VALUES
(1, 1, 1, 'Xiaomi A2 Lite', 'xiaomi_mi_a2_lite.jpg', 200, 500000, 5000000, '2019-08-01 09:30:00', '2019-08-31 00:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'active'),
(2, 1, 1, 'Meizu M3 Note', 'l-20190807114138.jpg', 170, 500000, 1250000, '2019-08-01 00:00:00', '2019-08-13 00:00:00', 'Meizu M3 Note\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'active'),
(3, 1, 1, 'Iphone 6s 64 Gb', 'l-20190621230933.jpg', 250, 1000000, 3000000, '2019-08-01 00:00:00', '2019-08-15 00:00:00', 'Iphone 6s 64 gb rose gold\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'end'),
(4, 1, 1, 'Xiaomi Redmi Note 7', 'l-20190624143409.jpg', 200, 500000, 2500000, '2019-08-01 00:00:00', '2019-08-22 00:00:00', 'Xiaomi Redmi Note 7 4/64\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'end'),
(5, 1, 1, 'Samsung Galaxy Note 4', 'l-20180409235352.jpg', 500, 1000000, 2500000, '2019-08-01 00:00:00', '2019-08-21 00:00:00', 'Samsung Galaxy Note 4 SEIN Fullset\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'active'),
(6, 1, 1, 'Xiaomi A2 China', 'xiaomi_a2.jpg', 0, 2000000, 4500000, '2019-06-26 00:00:00', '2019-07-31 00:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'active'),
(8, 3, 2, 'Laptop ASUS X441U', 'l-20190810115.jpeg', 3000, 1000000, 4000000, '2019-08-01 00:00:00', '2019-09-01 00:00:00', 'Laptop ASUS X441U Intel Core i3/RAM 4GB/HDD 1TB/Windows 10\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'active'),
(9, 3, 2, 'Lenovo IdeaPad G50', 'l-20190709130119.jpg', 3000, 1500000, 6750000, '2019-08-01 00:00:00', '2019-09-01 00:00:00', 'Lenovo IdeaPad G50 Core i5-5200U\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'active'),
(10, 3, 2, 'Hp EliteBook 820 G1', 'l-20190703231403.jpg', 3000, 1500000, 6725000, '2019-08-01 00:00:00', '2019-09-01 00:00:00', 'Hp EliteBook 820 G1 Core i7-4510U\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `order_lelang`
--

DROP TABLE IF EXISTS `order_lelang`;
CREATE TABLE `order_lelang` (
  `id_order` int(11) NOT NULL,
  `notrans_order` varchar(11) NOT NULL,
  `tgl_order` datetime NOT NULL,
  `id_tawaran` int(11) NOT NULL,
  `id_biaya_kirim` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `order_no_resi` varchar(32) DEFAULT NULL,
  `status_order` enum('order','verify_pay','paid','sent','received') NOT NULL DEFAULT 'order'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_lelang`
--

INSERT INTO `order_lelang` (`id_order`, `notrans_order`, `tgl_order`, `id_tawaran`, `id_biaya_kirim`, `id_peserta`, `order_no_resi`, `status_order`) VALUES
(1, 'TR19080001', '2019-08-25 13:22:46', 1, 3, 1, '2342553456345676', 'sent');

-- --------------------------------------------------------

--
-- Table structure for table `pelelang`
--

DROP TABLE IF EXISTS `pelelang`;
CREATE TABLE `pelelang` (
  `id_pelelang` int(11) NOT NULL,
  `nama_pelelang` varchar(100) NOT NULL,
  `akun_pelelang` varchar(25) NOT NULL,
  `sandi_pelelang` varchar(64) NOT NULL,
  `email_pelelang` varchar(100) NOT NULL,
  `telepon_pelelang` varchar(32) NOT NULL,
  `status_pelelang` tinyint(1) NOT NULL,
  `alamat_pelelang` text NOT NULL,
  `id_kota` int(11) NOT NULL,
  `tgl_daftar_pelelang` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pelelang`
--

INSERT INTO `pelelang` (`id_pelelang`, `nama_pelelang`, `akun_pelelang`, `sandi_pelelang`, `email_pelelang`, `telepon_pelelang`, `status_pelelang`, `alamat_pelelang`, `id_kota`, `tgl_daftar_pelelang`) VALUES
(1, 'Fajar Hidayati', 'auctioner01', 'a62657dc10df0e8b98a651cb19e465f9a131087a', 'auctioner01@example.com', '08129999999', 1, 'Apartemen Ula Ilu Tower Melati Lantai 8 No.44\r\nJl. Kacang Kapri Muda Kav. 13\r\nUtan Kayu Selatan, Matraman, Jakarta Timur, Indonesia, 13120', 1, '2019-06-20 00:00:00'),
(2, 'Laisa Ahza', 'auctioner02', 'c493d328a59c1aa1a091af2b2db30e40281d8f4b', 'auctioner02@example.com', '08129999876', 1, 'Jl. Cinta Boulevard No.3 RT 07/02\r\nBintaro, Pesanggrahan, Jaksel, 12330', 2, '2019-06-21 00:00:00'),
(3, 'Udin Komarudin', 'auctioner03', '7ab3494a54d74915d4ca3baf5922bbb1085ec571', 'auctioner03@example.com', '081297373932', 1, 'Perumahan Griya Mandala, Jl. Kehormatan Blok A No.19 Rt.002 Rw.08\r\nDuri Kepa, Kebon Jeruk, Jakarta Barat, Indonesia, 11510', 3, '2019-06-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

DROP TABLE IF EXISTS `peserta`;
CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `nama_peserta` varchar(100) NOT NULL,
  `akun_peserta` varchar(25) NOT NULL,
  `sandi_peserta` varchar(64) NOT NULL,
  `email_peserta` varchar(100) NOT NULL,
  `telepon_peserta` varchar(32) DEFAULT NULL,
  `alamat_peserta` text NOT NULL,
  `id_kota` int(11) NOT NULL,
  `tgl_daftar_peserta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_peserta` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nama_peserta`, `akun_peserta`, `sandi_peserta`, `email_peserta`, `telepon_peserta`, `alamat_peserta`, `id_kota`, `tgl_daftar_peserta`, `status_peserta`) VALUES
(1, 'Hyde Lawlesss', 'hydelaw', '6cf50439ff6959475621f3a762fcc9b2cf62b503', 'hydelaw@email.com', '081299998878', 'Jl Shinjuku Kosakabe No 07', 3, '2019-07-14 10:28:38', 1),
(2, 'Jay Weinberg', 'jaywein', 'd70fa9ddea6eb70c28bf0f75ec5107614786129b', 'jaywein@email.com', '081276765454', 'Jl Core Sana No 08', 1, '2019-07-14 10:32:14', 1),
(3, 'Zainal Abidin', 'zainalay', '7b72713003291020cc46b79d7486dba899f0b604', 'zainalay@email.com', '081298987676', 'Jl. KH Agus Salim 16, Sabang, Menteng Jakarta Pusat', 5, '2019-08-10 14:08:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tawaran`
--

DROP TABLE IF EXISTS `tawaran`;
CREATE TABLE `tawaran` (
  `id_tawaran` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_lelang` int(11) NOT NULL,
  `id_pelelang` int(11) NOT NULL,
  `jumlah_tawaran` int(11) NOT NULL,
  `waktu_tawaran` datetime NOT NULL,
  `tipe_tawaran` enum('bid','bin') NOT NULL,
  `status_tawaran` enum('accepted','postponed','rejected') NOT NULL DEFAULT 'postponed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tawaran`
--

INSERT INTO `tawaran` (`id_tawaran`, `id_peserta`, `id_lelang`, `id_pelelang`, `jumlah_tawaran`, `waktu_tawaran`, `tipe_tawaran`, `status_tawaran`) VALUES
(1, 1, 4, 1, 2600000, '2019-08-14 20:48:51', 'bid', 'accepted'),
(2, 2, 4, 1, 1200000, '2019-08-14 20:40:16', 'bid', 'rejected'),
(3, 3, 4, 1, 1500000, '2019-08-14 20:48:14', 'bid', 'rejected');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `user_email` (`email_akun`);

--
-- Indexes for table `biaya_kirim`
--
ALTER TABLE `biaya_kirim`
  ADD PRIMARY KEY (`id_biaya_kirim`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `alias_kategori` (`alias_kategori`);

--
-- Indexes for table `konfirmasi_bayar`
--
ALTER TABLE `konfirmasi_bayar`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `lelang`
--
ALTER TABLE `lelang`
  ADD PRIMARY KEY (`id_lelang`);

--
-- Indexes for table `order_lelang`
--
ALTER TABLE `order_lelang`
  ADD PRIMARY KEY (`id_order`),
  ADD UNIQUE KEY `notrans_order` (`notrans_order`);

--
-- Indexes for table `pelelang`
--
ALTER TABLE `pelelang`
  ADD PRIMARY KEY (`id_pelelang`),
  ADD UNIQUE KEY `akun_pelelang` (`akun_pelelang`),
  ADD UNIQUE KEY `email_pelelang` (`email_pelelang`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD UNIQUE KEY `email_peserta` (`email_peserta`);

--
-- Indexes for table `tawaran`
--
ALTER TABLE `tawaran`
  ADD PRIMARY KEY (`id_tawaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `biaya_kirim`
--
ALTER TABLE `biaya_kirim`
  MODIFY `id_biaya_kirim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `konfirmasi_bayar`
--
ALTER TABLE `konfirmasi_bayar`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lelang`
--
ALTER TABLE `lelang`
  MODIFY `id_lelang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_lelang`
--
ALTER TABLE `order_lelang`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelelang`
--
ALTER TABLE `pelelang`
  MODIFY `id_pelelang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tawaran`
--
ALTER TABLE `tawaran`
  MODIFY `id_tawaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
