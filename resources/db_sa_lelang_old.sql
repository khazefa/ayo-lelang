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
-- Database: `db_sa_lelang_old`
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
-- Table structure for table `alamat_peserta`
--

CREATE TABLE `alamat_peserta` (
  `id_alamat` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `label_alamat` varchar(100) NOT NULL,
  `deskripsi_alamat` text NOT NULL,
  `id_kota` int(11) NOT NULL,
  `alamat_utama` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Table structure for table `detail_order_lelang`
--

CREATE TABLE `detail_order_lelang` (
  `id_detail_order` int(11) NOT NULL,
  `notrans_order` varchar(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori` int(5) NOT NULL,
  `alias_kategori` varchar(100) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi_kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori`, `alias_kategori`, `nama_kategori`, `deskripsi_kategori`) VALUES
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
  `id_produk` int(11) NOT NULL,
  `harga_buka` int(11) NOT NULL,
  `harga_tawar` int(11) NOT NULL,
  `harga_tutup` int(11) NOT NULL,
  `status_lelang` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_lelang`
--

CREATE TABLE `order_lelang` (
  `id_order` int(11) NOT NULL,
  `notrans_order` varchar(11) NOT NULL,
  `tgl_order` datetime NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_biaya_kirim` int(11) NOT NULL,
  `status_order` tinyint(1) NOT NULL
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
  `status_peserta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `alias_produk` varchar(150) NOT NULL,
  `harga_produk` int(11) NOT NULL DEFAULT '0',
  `deskripsi_produk` text NOT NULL,
  `gambar_produk` varchar(255) NOT NULL,
  `status_produk` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `alias_produk`, `harga_produk`, `deskripsi_produk`, `gambar_produk`, `status_produk`) VALUES
(1, 1, 'HP Xiaomi A2', 'xiaomi-a2', 0, 'HP Xiaomi A2', 'xiaomi-a2.jpg', 1);

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
-- Indexes for table `alamat_peserta`
--
ALTER TABLE `alamat_peserta`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indexes for table `biaya_kirim`
--
ALTER TABLE `biaya_kirim`
  ADD PRIMARY KEY (`id_biaya_kirim`);

--
-- Indexes for table `detail_order_lelang`
--
ALTER TABLE `detail_order_lelang`
  ADD PRIMARY KEY (`id_detail_order`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
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
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD UNIQUE KEY `email_peserta` (`email_peserta`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alamat_peserta`
--
ALTER TABLE `alamat_peserta`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
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
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
