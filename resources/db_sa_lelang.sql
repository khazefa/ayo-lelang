-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 14, 2019 at 01:37 PM
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
(2, 'aksesoris', 'Aksesoris', 'Aksesoris');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

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
(3, 'Jakarta Selatan');

-- --------------------------------------------------------

--
-- Table structure for table `lelang`
--

CREATE TABLE `lelang` (
  `id_lelang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_pelelang` int(11) NOT NULL,
  `nama_lelang` varchar(100) NOT NULL,
  `gambar_produk` varchar(100) NOT NULL,
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

INSERT INTO `lelang` (`id_lelang`, `id_kategori`, `id_pelelang`, `nama_lelang`, `gambar_produk`, `harga_awal`, `harga_maksimal`, `waktu_mulai`, `waktu_selesai`, `keterangan`, `status_lelang`) VALUES
(1, 1, 1, 'Xiaomi A2 China', 'xiaomi_a2.jpg', 2000000, 4500000, '2019-06-26 00:00:00', '2019-07-31 00:00:00', 'Xiaomi A2 China', 'active'),
(2, 1, 1, 'Xiaomi A2 China', 'xiaomi_a2.jpg', 2000000, 4500000, '2019-06-26 00:00:00', '2019-07-31 00:00:00', 'Xiaomi A2 China', 'active'),
(3, 1, 1, 'Xiaomi A2 China', 'xiaomi_a2.jpg', 2000000, 4500000, '2019-06-26 00:00:00', '2019-07-31 00:00:00', 'Xiaomi A2 China', 'active'),
(4, 1, 1, 'Xiaomi A2 China', 'xiaomi_a2.jpg', 2000000, 4500000, '2019-06-26 00:00:00', '2019-07-31 00:00:00', 'Xiaomi A2 China', 'active'),
(5, 1, 1, 'Xiaomi A2 China', 'xiaomi_a2.jpg', 2000000, 4500000, '2019-06-26 00:00:00', '2019-07-31 00:00:00', 'Xiaomi A2 China', 'active'),
(6, 1, 1, 'Xiaomi A2 China', 'xiaomi_a2.jpg', 2000000, 4500000, '2019-06-26 00:00:00', '2019-07-31 00:00:00', 'Xiaomi A2 China', 'active'),
(7, 1, 1, 'Xiaomi A2 China', 'xiaomi_a2.jpg', 2000000, 4500000, '2019-06-26 00:00:00', '2019-07-31 00:00:00', 'Xiaomi A2 China', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `order_lelang`
--

CREATE TABLE `order_lelang` (
  `id_order` int(11) NOT NULL,
  `notrans_order` varchar(11) NOT NULL,
  `tgl_order` datetime NOT NULL,
  `id_tawaran` int(11) NOT NULL,
  `id_biaya_kirim` int(11) NOT NULL,
  `status_order` enum('order','paid','sent','received') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pelelang`
--

CREATE TABLE `pelelang` (
  `id_pelelang` int(11) NOT NULL,
  `nama_pelelang` varchar(100) NOT NULL,
  `akun_pelelang` varchar(25) NOT NULL,
  `sandi_pelelang` varchar(64) NOT NULL,
  `email_pelelang` varchar(100) NOT NULL,
  `telepon_pelelang` varchar(32) NOT NULL,
  `status_pelelang` tinyint(1) NOT NULL,
  `alamat_pelelang` text NOT NULL,
  `tgl_daftar_pelelang` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pelelang`
--

INSERT INTO `pelelang` (`id_pelelang`, `nama_pelelang`, `akun_pelelang`, `sandi_pelelang`, `email_pelelang`, `telepon_pelelang`, `status_pelelang`, `alamat_pelelang`, `tgl_daftar_pelelang`) VALUES
(1, 'Fajar Hidayati', 'auctioner01', 'a62657dc10df0e8b98a651cb19e465f9a131087a', 'auctioner01@example.com', '08129999999', 1, 'Apartemen Ula Ilu Tower Melati Lantai 8 No.44\r\nJl. Kacang Kapri Muda Kav. 13\r\nUtan Kayu Selatan, Matraman, Jakarta Timur, Indonesia, 13120', '2019-06-20 00:00:00'),
(2, 'Laisa Ahza', 'auctioner02', 'c493d328a59c1aa1a091af2b2db30e40281d8f4b', 'auctioner02@example.com', '08129999876', 1, 'Jl. Cinta Boulevard No.3 RT 07/02\r\nBintaro, Pesanggrahan, Jaksel, 12330', '2019-06-21 00:00:00'),
(3, 'Udin Komarudin', 'auctioner03', '7ab3494a54d74915d4ca3baf5922bbb1085ec571', 'auctioner03@example.com', '081297373932', 0, 'Perumahan Griya Mandala, Jl. Kehormatan Blok A No.19 Rt.002 Rw.08\r\nDuri Kepa, Kebon Jeruk, Jakarta Barat, Indonesia, 11510', '2019-06-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `nama_peserta` varchar(100) NOT NULL,
  `akun_peserta` varchar(25) NOT NULL,
  `sandi_peserta` varchar(64) NOT NULL,
  `email_peserta` varchar(100) NOT NULL,
  `telepon_peserta` varchar(32) DEFAULT NULL,
  `alamat_peserta` text NOT NULL,
  `tgl_daftar_peserta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_peserta` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nama_peserta`, `akun_peserta`, `sandi_peserta`, `email_peserta`, `telepon_peserta`, `alamat_peserta`, `tgl_daftar_peserta`, `status_peserta`) VALUES
(1, 'Hyde Lawless', 'hydelaw', '6cf50439ff6959475621f3a762fcc9b2cf62b503', 'hydelaw@email.com', '081299998878', 'Jl Shinjuku Kosakabe No 07', '2019-07-14 10:28:38', 1),
(2, 'Jay Weinberg', 'jaywein', 'd70fa9ddea6eb70c28bf0f75ec5107614786129b', 'jaywein@example.com', '081276765454', 'Jl Core Sana No 08', '2019-07-14 10:32:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tawaran`
--

CREATE TABLE `tawaran` (
  `id_tawaran` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_lelang` int(11) NOT NULL,
  `jumlah_tawaran` int(11) NOT NULL,
  `waktu_tawaran` datetime NOT NULL,
  `status_tawaran` enum('accepted','unaccepted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lelang`
--
ALTER TABLE `lelang`
  MODIFY `id_lelang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_lelang`
--
ALTER TABLE `order_lelang`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelelang`
--
ALTER TABLE `pelelang`
  MODIFY `id_pelelang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
