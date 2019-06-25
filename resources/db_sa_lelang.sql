-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2019 at 07:07 AM
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
  `status_lelang` enum('active','end') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `telepon_peserta` varchar(32) NOT NULL,
  `status_peserta` tinyint(1) NOT NULL,
  `alamat_peserta` text NOT NULL,
  `tgl_daftar_peserta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_lelang`
--
ALTER TABLE `order_lelang`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelelang`
--
ALTER TABLE `pelelang`
  MODIFY `id_pelelang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
