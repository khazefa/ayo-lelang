-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2019 pada 11.30
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Struktur dari tabel `akun`
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
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_akun`, `nama_akun`, `sandi_akun`, `nama_lengkap_akun`, `email_akun`, `level_akun`, `status_akun`) VALUES
(1, 'admin01', 'cb0ef4c7be04ff1bf4cfcd104ef8df03251266ab', 'Admin 01', 'admin01@example.com', 'admin', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamat_peserta`
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
-- Struktur dari tabel `biaya_kirim`
--

CREATE TABLE `biaya_kirim` (
  `id_biaya_kirim` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `jumlah_biaya_kirim` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_order_lelang`
--

CREATE TABLE `detail_order_lelang` (
  `id_detail_order` int(11) NOT NULL,
  `notrans_order` varchar(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori` int(5) NOT NULL,
  `alias_kategori` varchar(100) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi_kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori`, `alias_kategori`, `nama_kategori`, `deskripsi_kategori`) VALUES
(1, 'hp', 'Handphone', 'Handphone'),
(2, 'aksesoris', 'Aksesoris', 'Aksesoris');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lelang`
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
-- Struktur dari tabel `order_lelang`
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
-- Struktur dari tabel `peserta`
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
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `alias_produk` varchar(150) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `status_produk` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `user_email` (`email_akun`);

--
-- Indeks untuk tabel `alamat_peserta`
--
ALTER TABLE `alamat_peserta`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indeks untuk tabel `biaya_kirim`
--
ALTER TABLE `biaya_kirim`
  ADD PRIMARY KEY (`id_biaya_kirim`);

--
-- Indeks untuk tabel `detail_order_lelang`
--
ALTER TABLE `detail_order_lelang`
  ADD PRIMARY KEY (`id_detail_order`);

--
-- Indeks untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `alias_kategori` (`alias_kategori`);

--
-- Indeks untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indeks untuk tabel `lelang`
--
ALTER TABLE `lelang`
  ADD PRIMARY KEY (`id_lelang`);

--
-- Indeks untuk tabel `order_lelang`
--
ALTER TABLE `order_lelang`
  ADD PRIMARY KEY (`id_order`),
  ADD UNIQUE KEY `notrans_order` (`notrans_order`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD UNIQUE KEY `email_peserta` (`email_peserta`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `alamat_peserta`
--
ALTER TABLE `alamat_peserta`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `order_lelang`
--
ALTER TABLE `order_lelang`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
