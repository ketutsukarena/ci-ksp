-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04 Agu 2019 pada 19.30
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id5711780_ksp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `id_jenis_transasksi` int(11) NOT NULL,
  `nama_transaksi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_transaksi`
--

INSERT INTO `jenis_transaksi` (`id_jenis_transasksi`, `nama_transaksi`) VALUES
(1, 'Kredit'),
(2, 'Angsuran Kredit'),
(3, 'Menabung'),
(4, 'Tarik Tabungan'),
(5, 'Simpanan Pokok'),
(6, 'Simpanan wajib'),
(7, 'Biaya'),
(8, 'Pendapatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_akun`
--

CREATE TABLE `tb_akun` (
  `id_akun` int(3) NOT NULL,
  `nama_akun` varchar(50) NOT NULL,
  `bertambah` enum('d','k') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_akun`
--

INSERT INTO `tb_akun` (`id_akun`, `nama_akun`, `bertambah`) VALUES
(100, 'Kas', 'd'),
(101, 'Simpanan Pokok', 'k'),
(102, 'Simpanan Wajib', 'k'),
(201, 'Setoran Tabungan', 'k'),
(202, 'Penarikan Tabungan', 'd'),
(203, 'Bunga Tabungan', 'd'),
(204, 'Koreksi Saldo Tabungan', 'k'),
(206, 'Hutang', 'k'),
(301, 'Pinjaman Kredit', 'd'),
(302, 'Angsuran Kredit', 'k'),
(401, 'Pendapatan', 'k'),
(501, 'Biaya', 'd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_biaya`
--

CREATE TABLE `tb_biaya` (
  `id_biaya` int(11) NOT NULL,
  `kode_biaya` varchar(5) NOT NULL,
  `id_akun` int(3) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_biaya`
--

INSERT INTO `tb_biaya` (`id_biaya`, `kode_biaya`, `id_akun`, `nama`) VALUES
(2, 'B2', 501, 'Bayar Listrik'),
(1, 'B1', 501, 'Sewa Gedung'),
(3, 'B3', 501, 'Bayar Air');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_buku_besar`
--

CREATE TABLE `tb_buku_besar` (
  `id_transaksi` varchar(32) NOT NULL,
  `no` int(11) NOT NULL,
  `id_akun` varchar(5) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `keterangan` text NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bungatabungan`
--

CREATE TABLE `tb_bungatabungan` (
  `id_bunga` int(11) NOT NULL,
  `id_akun` int(3) NOT NULL,
  `nominal` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bungatabungan`
--

INSERT INTO `tb_bungatabungan` (`id_bunga`, `id_akun`, `nominal`) VALUES
(1, 203, 0.04);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jns_simpanan`
--

CREATE TABLE `tb_jns_simpanan` (
  `id_simpanan` int(11) NOT NULL,
  `id_akun` int(3) NOT NULL,
  `nama_simpanan` varchar(20) NOT NULL,
  `nominal` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jns_simpanan`
--

INSERT INTO `tb_jns_simpanan` (`id_simpanan`, `id_akun`, `nama_simpanan`, `nominal`) VALUES
(11, 101, 'Simpanan Pokok', 1000000),
(2, 102, 'Simpanan Wajib', 10000),
(12, 100, 'Kas', 2000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jurnal`
--

CREATE TABLE `tb_jurnal` (
  `id_jurnal` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `bukti` varchar(100) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_tutup_buku` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jurnal`
--

INSERT INTO `tb_jurnal` (`id_jurnal`, `tgl_transaksi`, `keterangan`, `bukti`, `id_user`, `id_tutup_buku`) VALUES
(1, '2019-06-20', 'menabung - 4', NULL, 0, 1),
(2, '2019-06-20', 'menabung - 4', NULL, 13, 1),
(3, '2019-06-23', 'menabung - 5', NULL, 13, 1),
(4, '2019-06-23', 'menabung - 7/AD/2018', NULL, 13, 1),
(5, '2019-06-23', 'menabung (19/YO/2018 - I Made Su', NULL, 13, 1),
(6, '2019-06-23', 'menabung (21/MP/2018 - Sang Ayu ', NULL, 13, 1),
(7, '2019-06-23', 'menabung (21/MP/2018 - Sang Ayu ', NULL, 13, 1),
(8, '2019-06-23', 'menabung (21/MP/2018 - Sang Ayu Komang Juni Setiari)', NULL, 13, 1),
(9, '2019-06-23', 'menabung (14/YO/2018 - Ni Luh Putu Lestariningsih)', NULL, 13, 1),
(10, '2019-06-23', 'menabung (28/YO/2019 - ketut bagus)', NULL, 13, 1),
(11, '2019-06-24', 'menabung (27/MP/2018 - I Made Sucipta Yasa)', NULL, 13, 1),
(12, '2019-06-30', 'menabung (27/MP/2018 - I Made Sucipta Yasa)', NULL, 13, 2),
(13, '2019-06-30', 'menabung (27/MP/2018 - I Made Sucipta Yasa)', NULL, 13, 2),
(14, '2019-06-30', 'menabung (1/AD/2018 - Putu Dian Apriliantari)', NULL, 13, 2),
(15, '2019-06-30', 'menabung (4/AD/2018 - Fakhri Nurulhuda)', NULL, 13, 2),
(16, '2019-07-18', 'menabung (28/YO/2019 - ketut bagus)', '', 13, 2),
(17, '2019-07-18', 'testes', '17.png', 2, 2),
(18, '2019-07-19', 'Kredit  - Putu Dian Apriliantari', NULL, 4, 2),
(19, '2019-07-19', 'Biaya admin dan materai - Kredit  - Putu Dian Apriliantari', NULL, 4, 2),
(20, '2019-07-20', 'Angsuran', NULL, 4, 2),
(21, '2019-07-20', 'Angsuran', NULL, 4, 2),
(22, '2019-07-27', 'menabung (4/AD/2018 - Fakhri Nurulhuda)', '', 13, 3),
(23, '2019-07-27', 'menabung (2/AD/2018 - I Putu Erik Pertamayasa)', '', 13, 4),
(24, '2019-08-04', 'menabung (2/AD/2018 - I Putu Erik Pertamayasa)', '', 13, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jurnal_detail`
--

CREATE TABLE `tb_jurnal_detail` (
  `id_jurnal_detail` int(11) NOT NULL,
  `id_jurnal` int(11) NOT NULL,
  `id_akun` int(3) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jurnal_detail`
--

INSERT INTO `tb_jurnal_detail` (`id_jurnal_detail`, `id_jurnal`, `id_akun`, `debet`, `kredit`) VALUES
(1, 1, 100, 3000, 0),
(2, 1, 206, 0, 3000),
(3, 2, 100, 10000, 0),
(4, 2, 206, 0, 10000),
(5, 3, 100, 10000, 0),
(6, 3, 206, 0, 10000),
(7, 4, 100, 10000, 0),
(8, 4, 206, 0, 10000),
(9, 5, 100, 3000, 0),
(10, 5, 206, 0, 3000),
(11, 6, 100, 1000, 0),
(12, 6, 206, 0, 1000),
(13, 7, 100, 1000, 0),
(14, 7, 206, 0, 1000),
(15, 8, 100, 30000, 0),
(16, 8, 206, 0, 30000),
(17, 9, 100, 1000, 0),
(18, 9, 206, 0, 1000),
(19, 10, 100, 3000, 0),
(20, 10, 206, 0, 3000),
(21, 11, 100, 3000, 0),
(22, 11, 206, 0, 3000),
(23, 13, 100, 1000, 0),
(24, 13, 206, 0, 1000),
(25, 14, 100, 5000, 0),
(26, 14, 206, 0, 5000),
(27, 15, 100, 10000, 0),
(28, 15, 206, 0, 10000),
(29, 16, 100, 2000, 0),
(30, 16, 206, 0, 2000),
(33, 17, 501, 1000000, 0),
(34, 17, 100, 0, 1000000),
(63, 18, 301, 100000000, 0),
(64, 18, 100, 0, 100000000),
(65, 19, 100, 56000, 0),
(66, 19, 401, 0, 56000),
(67, 21, 100, 2550000, 0),
(68, 21, 302, 0, 2550000),
(69, 22, 100, 29000, 0),
(70, 22, 206, 0, 29000),
(71, 23, 100, 1000, 0),
(72, 23, 206, 0, 1000),
(73, 24, 100, 2000, 0),
(74, 24, 206, 0, 2000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kas`
--

CREATE TABLE `tb_kas` (
  `id_kas` int(11) NOT NULL,
  `jns_transaksi` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `id_akun` int(3) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kas`
--

INSERT INTO `tb_kas` (`id_kas`, `jns_transaksi`, `status`, `tgl_transaksi`, `id_akun`, `debet`, `kredit`) VALUES
(1, 1, 'TRX-Tabungan', '2018-07-01', 201, 100000, 0),
(2, 2, 'TRX-Tabungan', '2018-07-01', 201, 150000, 0),
(3, 3, 'TRX-Tabungan', '2018-07-01', 201, 150000, 0),
(4, 4, 'TRX-Tabungan', '2018-07-01', 201, 100000, 0),
(5, 5, 'TRX-Tabungan', '2018-07-01', 201, 100000, 0),
(6, 6, 'TRX-Tabungan', '2018-07-01', 201, 100000, 0),
(7, 7, 'TRX-Tabungan', '2018-07-01', 201, 100000, 0),
(8, 8, 'TRX-Tabungan', '2018-07-01', 201, 200000, 0),
(9, 9, 'TRX-Tabungan', '2018-07-01', 201, 150000, 0),
(10, 10, 'TRX-Tabungan', '2018-07-01', 201, 200000, 0),
(11, 11, 'TRX-Tabungan', '2018-07-01', 201, 100000, 0),
(12, 12, 'TRX-Tabungan', '2018-07-01', 201, 100000, 0),
(13, 13, 'TRX-Tabungan', '2018-07-01', 201, 150000, 0),
(14, 14, 'TRX-Tabungan', '2018-07-01', 201, 100000, 0),
(15, 15, 'TRX-Tabungan', '2018-07-01', 201, 200000, 0),
(16, 16, 'TRX-Tabungan', '2018-07-01', 201, 200000, 0),
(17, 17, 'TRX-Tabungan', '2018-07-01', 201, 200000, 0),
(18, 18, 'TRX-Tabungan', '2018-07-01', 201, 150000, 0),
(19, 19, 'TRX-Tabungan', '2018-07-01', 201, 100000, 0),
(20, 20, 'TRX-Tabungan', '2018-07-02', 201, 150000, 0),
(21, 21, 'TRX-Tabungan', '2018-07-02', 201, 200000, 0),
(22, 22, 'TRX-Tabungan', '2018-07-02', 201, 150000, 0),
(23, 23, 'TRX-Tabungan', '2018-07-02', 201, 100000, 0),
(24, 24, 'TRX-Tabungan', '2018-07-03', 201, 150000, 0),
(25, 25, 'TRX-Tabungan', '2018-07-03', 201, 200000, 0),
(26, 26, 'TRX-Tabungan', '2018-07-03', 201, 100000, 0),
(27, 27, 'TRX-Tabungan', '2018-07-03', 201, 150000, 0),
(28, 28, 'TRX-Tabungan', '2018-07-03', 201, 20000, 0),
(29, 29, 'TRX-Tabungan', '2018-07-03', 201, 50000, 0),
(30, 30, 'TRX-Tabungan', '2018-07-03', 201, 50000, 0),
(31, 31, 'TRX-Tabungan', '2018-07-03', 201, 20000, 0),
(32, 32, 'TRX-Tabungan', '2018-07-03', 201, 20000, 0),
(33, 33, 'TRX-Tabungan', '2018-07-03', 201, 20000, 0),
(34, 34, 'TRX-Tabungan', '2018-07-03', 201, 30000, 0),
(35, 35, 'TRX-Tabungan', '2018-07-03', 201, 25000, 0),
(36, 36, 'TRX-Tabungan', '2018-07-03', 201, 10000, 0),
(37, 37, 'TRX-Tabungan', '2018-07-03', 201, 10000, 0),
(38, 38, 'TRX-Tabungan', '2018-07-03', 201, 10000, 0),
(39, 39, 'TRX-Tabungan', '2018-07-03', 201, 20000, 0),
(40, 40, 'TRX-Tabungan', '2018-07-03', 201, 10000, 0),
(41, 41, 'TRX-Tabungan', '2018-07-03', 201, 20000, 0),
(42, 42, 'TRX-Tabungan', '2018-07-03', 201, 10000, 0),
(43, 43, 'TRX-Tabungan', '2018-07-03', 201, 20000, 0),
(44, 44, 'TRX-Tabungan', '2018-07-03', 201, 10000, 0),
(45, 45, 'TRX-Tabungan', '2018-07-04', 201, 10000, 0),
(46, 46, 'TRX-Tabungan', '2018-07-04', 201, 10000, 0),
(47, 47, 'TRX-Tabungan', '2018-07-04', 201, 20000, 0),
(48, 48, 'TRX-Tabungan', '2018-07-04', 201, 10000, 0),
(49, 49, 'TRX-Tabungan', '2018-07-04', 201, 20000, 0),
(50, 50, 'TRX-Tabungan', '2018-07-04', 201, 30000, 0),
(51, 51, 'TRX-Tabungan', '2018-07-04', 201, 10000, 0),
(52, 52, 'TRX-Tabungan', '2018-07-04', 201, 10000, 0),
(53, 53, 'TRX-Tabungan', '2018-07-04', 201, 20000, 0),
(54, 54, 'TRX-Tabungan', '2018-07-04', 201, 20000, 0),
(55, 55, 'TRX-Tabungan', '2018-07-04', 201, 20000, 0),
(56, 56, 'TRX-Tabungan', '2018-07-04', 201, 10000, 0),
(57, 57, 'TRX-Tabungan', '2018-07-04', 201, 30000, 0),
(58, 58, 'TRX-Tabungan', '2018-07-04', 201, 20000, 0),
(59, 59, 'TRX-Tabungan', '2018-07-04', 201, 10000, 0),
(60, 60, 'TRX-Tabungan', '2018-07-04', 201, 20000, 0),
(61, 61, 'TRX-Tabungan', '2018-07-04', 201, 20000, 0),
(62, 62, 'TRX-Tabungan', '2018-07-04', 201, 10000, 0),
(63, 63, 'TRX-Tabungan', '2018-07-04', 201, 30000, 0),
(64, 64, 'TRX-Tabungan', '2018-07-04', 201, 50000, 0),
(65, 65, 'TRX-Tabungan', '2018-07-04', 201, 20000, 0),
(66, 66, 'TRX-Tabungan', '2018-07-04', 201, 15000, 0),
(67, 67, 'TRX-Tabungan', '2018-07-04', 201, 25000, 0),
(68, 68, 'TRX-Tabungan', '2018-07-04', 201, 20000, 0),
(69, 69, 'TRX-Tabungan', '2018-07-04', 201, 10000, 0),
(70, 70, 'TRX-Tabungan', '2018-07-04', 201, 20000, 0),
(71, 71, 'TRX-Tabungan', '2018-07-04', 201, 10000, 0),
(72, 72, 'TRX-Tabungan', '2018-07-05', 201, 10000, 0),
(73, 73, 'TRX-Tabungan', '2018-07-05', 201, 20000, 0),
(74, 74, 'TRX-Tabungan', '2018-07-05', 201, 20000, 0),
(75, 75, 'TRX-Tabungan', '2018-07-05', 201, 10000, 0),
(76, 76, 'TRX-Tabungan', '2018-07-05', 201, 20000, 0),
(77, 77, 'TRX-Tabungan', '2018-07-05', 201, 10000, 0),
(78, 78, 'TRX-Tabungan', '2018-07-05', 201, 20000, 0),
(79, 79, 'TRX-Tabungan', '2018-07-05', 201, 10000, 0),
(80, 80, 'TRX-Tabungan', '2018-07-05', 201, 10000, 0),
(81, 81, 'TRX-Tabungan', '2018-07-05', 201, 10000, 0),
(82, 82, 'TRX-Tabungan', '2018-07-05', 201, 10000, 0),
(83, 83, 'TRX-Tabungan', '2018-07-05', 201, 10000, 0),
(84, 84, 'TRX-Tabungan', '2018-07-05', 201, 10000, 0),
(85, 85, 'TRX-Tabungan', '2018-07-05', 201, 10000, 0),
(86, 86, 'TRX-Tabungan', '2018-07-05', 201, 20000, 0),
(87, 87, 'TRX-Tabungan', '2018-07-05', 201, 20000, 0),
(88, 88, 'TRX-Tabungan', '2018-07-05', 201, 20000, 0),
(89, 89, 'TRX-Tabungan', '2018-07-05', 201, 10000, 0),
(90, 90, 'TRX-Tabungan', '2018-07-05', 201, 10000, 0),
(91, 91, 'TRX-Tabungan', '2018-07-05', 201, 30000, 0),
(92, 92, 'TRX-Tabungan', '2018-07-05', 201, 30000, 0),
(93, 93, 'TRX-Tabungan', '2018-07-05', 201, 20000, 0),
(94, 94, 'TRX-Tabungan', '2018-07-05', 201, 10000, 0),
(95, 95, 'TRX-Tabungan', '2018-07-05', 201, 10000, 0),
(96, 96, 'TRX-Tabungan', '2018-07-05', 201, 50000, 0),
(97, 97, 'TRX-Tabungan', '2018-07-06', 201, 50000, 0),
(98, 98, 'TRX-Tabungan', '2018-07-06', 201, 20000, 0),
(99, 99, 'TRX-Tabungan', '2018-07-06', 201, 20000, 0),
(100, 100, 'TRX-Tabungan', '2018-07-06', 201, 50000, 0),
(101, 101, 'TRX-Tabungan', '2018-07-06', 201, 20000, 0),
(102, 102, 'TRX-Tabungan', '2018-07-06', 201, 20000, 0),
(103, 103, 'TRX-Tabungan', '2018-07-06', 201, 20000, 0),
(104, 104, 'TRX-Tabungan', '2018-07-06', 201, 20000, 0),
(105, 105, 'TRX-Tabungan', '2018-07-06', 201, 20000, 0),
(106, 106, 'TRX-Tabungan', '2018-07-06', 201, 20000, 0),
(107, 107, 'TRX-Tabungan', '2018-07-06', 201, 30000, 0),
(108, 108, 'TRX-Tabungan', '2018-07-06', 201, 20000, 0),
(109, 109, 'TRX-Tabungan', '2018-07-06', 201, 30000, 0),
(110, 110, 'TRX-Tabungan', '2018-07-06', 201, 30000, 0),
(111, 111, 'TRX-Tabungan', '2018-07-06', 201, 30000, 0),
(112, 112, 'TRX-Tabungan', '2018-07-06', 201, 30000, 0),
(113, 113, 'TRX-Tabungan', '2018-07-06', 201, 20000, 0),
(114, 114, 'TRX-Tabungan', '2018-07-06', 201, 30000, 0),
(115, 115, 'TRX-Tabungan', '2018-07-06', 201, 20000, 0),
(116, 116, 'TRX-Tabungan', '2018-07-06', 201, 30000, 0),
(117, 117, 'TRX-Tabungan', '2018-07-09', 201, 20000, 0),
(118, 118, 'TRX-Tabungan', '2018-07-09', 201, 10000, 0),
(119, 119, 'TRX-Tabungan', '2018-07-09', 201, 10000, 0),
(120, 120, 'TRX-Tabungan', '2018-07-09', 201, 20000, 0),
(121, 121, 'TRX-Tabungan', '2018-07-09', 201, 20000, 0),
(122, 122, 'TRX-Tabungan', '2018-07-09', 201, 20000, 0),
(123, 123, 'TRX-Tabungan', '2018-07-09', 201, 20000, 0),
(124, 124, 'TRX-Tabungan', '2018-07-09', 201, 20000, 0),
(125, 125, 'TRX-Tabungan', '2018-07-09', 201, 20000, 0),
(126, 126, 'TRX-Tabungan', '2018-07-09', 201, 10000, 0),
(127, 127, 'TRX-Tabungan', '2018-07-09', 201, 10000, 0),
(128, 128, 'TRX-Tabungan', '2018-07-09', 201, 20000, 0),
(129, 129, 'TRX-Tabungan', '2018-07-09', 201, 30000, 0),
(130, 130, 'TRX-Tabungan', '2018-07-09', 201, 10000, 0),
(131, 131, 'TRX-Tabungan', '2018-07-09', 201, 50000, 0),
(132, 132, 'TRX-Tabungan', '2018-07-09', 201, 30000, 0),
(133, 133, 'TRX-Tabungan', '2018-07-09', 201, 20000, 0),
(134, 134, 'TRX-Tabungan', '2018-07-09', 201, 20000, 0),
(135, 135, 'TRX-Tabungan', '2018-07-09', 201, 20000, 0),
(136, 136, 'TRX-Tabungan', '2018-07-09', 201, 30000, 0),
(137, 137, 'TRX-Tabungan', '2018-07-09', 201, 10000, 0),
(138, 138, 'TRX-Tabungan', '2018-07-09', 201, 50000, 0),
(139, 139, 'TRX-Tabungan', '2018-07-09', 201, 10000, 0),
(140, 140, 'TRX-Tabungan', '2018-07-09', 201, 10000, 0),
(141, 141, 'TRX-Tabungan', '2018-07-09', 201, 20000, 0),
(142, 142, 'TRX-Tabungan', '2018-07-09', 201, 30000, 0),
(143, 143, 'TRX-Tabungan', '2018-07-09', 201, 30000, 0),
(144, 144, 'TRX-Tabungan', '2018-07-10', 201, 20000, 0),
(145, 145, 'TRX-Tabungan', '2018-07-10', 201, 20000, 0),
(146, 146, 'TRX-Tabungan', '2018-07-10', 201, 30000, 0),
(147, 147, 'TRX-Tabungan', '2018-07-10', 201, 10000, 0),
(148, 148, 'TRX-Tabungan', '2018-07-10', 201, 10000, 0),
(149, 149, 'TRX-Tabungan', '2018-07-10', 201, 20000, 0),
(150, 150, 'TRX-Tabungan', '2018-07-10', 201, 20000, 0),
(151, 151, 'TRX-Tabungan', '2018-07-10', 201, 20000, 0),
(152, 152, 'TRX-Tabungan', '2018-07-10', 201, 20000, 0),
(153, 153, 'TRX-Tabungan', '2018-07-10', 201, 20000, 0),
(154, 154, 'TRX-Tabungan', '2018-07-10', 201, 20000, 0),
(155, 155, 'TRX-Tabungan', '2018-07-10', 201, 30000, 0),
(156, 156, 'TRX-Tabungan', '2018-07-10', 201, 20000, 0),
(157, 157, 'TRX-Tabungan', '2018-07-10', 201, 30000, 0),
(158, 158, 'TRX-Tabungan', '2018-07-10', 201, 30000, 0),
(159, 159, 'TRX-Tabungan', '2018-07-10', 201, 10000, 0),
(160, 160, 'TRX-Tabungan', '2018-07-10', 201, 20000, 0),
(161, 161, 'TRX-Tabungan', '2018-07-10', 201, 30000, 0),
(162, 162, 'TRX-Tabungan', '2018-07-10', 201, 20000, 0),
(163, 163, 'TRX-Tabungan', '2018-07-11', 201, 50000, 0),
(164, 164, 'TRX-Tabungan', '2018-07-11', 201, 20000, 0),
(165, 165, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(166, 166, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(167, 167, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(168, 168, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(169, 169, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(170, 170, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(171, 171, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(172, 172, 'TRX-Tabungan', '2018-07-11', 201, 50000, 0),
(173, 173, 'TRX-Tabungan', '2018-07-11', 201, 50000, 0),
(174, 174, 'TRX-Tabungan', '2018-07-11', 201, 20000, 0),
(175, 175, 'TRX-Tabungan', '2018-07-11', 201, 20000, 0),
(176, 176, 'TRX-Tabungan', '2018-07-11', 201, 50000, 0),
(177, 177, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(178, 178, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(179, 179, 'TRX-Tabungan', '2018-07-11', 201, 50000, 0),
(180, 180, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(181, 181, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(182, 182, 'TRX-Tabungan', '2018-07-11', 201, 50000, 0),
(183, 183, 'TRX-Tabungan', '2018-07-11', 201, 50000, 0),
(184, 184, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(185, 185, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(186, 186, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(187, 187, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(188, 188, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(189, 189, 'TRX-Tabungan', '2018-07-11', 201, 30000, 0),
(190, 190, 'TRX-Tabungan', '2018-07-12', 201, 10000, 0),
(191, 191, 'TRX-Tabungan', '2018-07-12', 201, 10000, 0),
(192, 192, 'TRX-Tabungan', '2018-07-12', 201, 30000, 0),
(193, 193, 'TRX-Tabungan', '2018-07-12', 201, 10000, 0),
(194, 194, 'TRX-Tabungan', '2018-07-12', 201, 50000, 0),
(195, 195, 'TRX-Tabungan', '2018-07-12', 201, 50000, 0),
(196, 196, 'TRX-Tabungan', '2018-07-12', 201, 50000, 0),
(197, 197, 'TRX-Tabungan', '2018-07-12', 201, 30000, 0),
(198, 198, 'TRX-Tabungan', '2018-07-12', 201, 50000, 0),
(199, 199, 'TRX-Tabungan', '2018-07-12', 201, 30000, 0),
(200, 200, 'TRX-Tabungan', '2018-07-12', 201, 30000, 0),
(201, 201, 'TRX-Tabungan', '2018-07-12', 201, 30000, 0),
(202, 202, 'TRX-Tabungan', '2018-07-12', 201, 30000, 0),
(203, 203, 'TRX-Tabungan', '2018-07-12', 201, 30000, 0),
(204, 204, 'TRX-Tabungan', '2018-07-12', 201, 30000, 0),
(205, 205, 'TRX-Tabungan', '2018-07-12', 201, 50000, 0),
(206, 206, 'TRX-Tabungan', '2018-07-12', 201, 30000, 0),
(207, 207, 'TRX-Tabungan', '2018-07-12', 201, 50000, 0),
(208, 208, 'TRX-Tabungan', '2018-07-12', 201, 50000, 0),
(209, 209, 'TRX-Tabungan', '2018-07-12', 201, 50000, 0),
(210, 210, 'TRX-Tabungan', '2018-07-12', 201, 30000, 0),
(211, 211, 'TRX-Tabungan', '2018-07-12', 201, 30000, 0),
(212, 212, 'TRX-Tabungan', '2018-07-12', 201, 50000, 0),
(213, 213, 'TRX-Tabungan', '2018-07-12', 201, 30000, 0),
(214, 214, 'TRX-Tabungan', '2018-07-12', 201, 10000, 0),
(215, 215, 'TRX-Tabungan', '2018-07-12', 201, 30000, 0),
(216, 216, 'TRX-Tabungan', '2018-07-13', 201, 30000, 0),
(217, 217, 'TRX-Tabungan', '2018-07-13', 201, 30000, 0),
(218, 218, 'TRX-Tabungan', '2018-07-13', 201, 50000, 0),
(219, 219, 'TRX-Tabungan', '2018-07-13', 201, 30000, 0),
(220, 220, 'TRX-Tabungan', '2018-07-13', 201, 30000, 0),
(221, 221, 'TRX-Tabungan', '2018-07-13', 201, 30000, 0),
(222, 222, 'TRX-Tabungan', '2018-07-13', 201, 30000, 0),
(223, 223, 'TRX-Tabungan', '2018-07-13', 201, 30000, 0),
(224, 224, 'TRX-Tabungan', '2018-07-13', 201, 30000, 0),
(225, 225, 'TRX-Tabungan', '2018-07-13', 201, 30000, 0),
(226, 226, 'TRX-Tabungan', '2018-07-13', 201, 30000, 0),
(227, 227, 'TRX-Tabungan', '2018-07-13', 201, 30000, 0),
(228, 228, 'TRX-Tabungan', '2018-07-13', 201, 30000, 0),
(229, 229, 'TRX-Tabungan', '2018-07-13', 201, 50000, 0),
(230, 230, 'TRX-Tabungan', '2018-07-13', 201, 20000, 0),
(231, 231, 'TRX-Tabungan', '2018-07-13', 201, 30000, 0),
(232, 232, 'TRX-Tabungan', '2018-07-13', 201, 30000, 0),
(233, 233, 'TRX-Tabungan', '2018-07-13', 201, 20000, 0),
(234, 1, 'TRX-Pinjaman', '2018-07-19', 301, 0, 4000000),
(235, 1, 'TRX-Pinjaman', '2018-07-19', 401, 17000, 0),
(236, 1, 'TRX-Angsuran', '2018-07-19', 302, 1180000, 0),
(237, 2, 'TRX-Angsuran', '2018-08-13', 302, 1180000, 0),
(238, 3, 'TRX-Angsuran', '2018-08-13', 302, 1180000, 0),
(239, 4, 'TRX-Angsuran', '2018-08-13', 302, 1180000, 0),
(240, 2, 'TRX-Pinjaman', '2018-08-13', 301, 0, 90000000),
(241, 2, 'TRX-Pinjaman', '2018-08-13', 401, 17000, 0),
(242, 5, 'TRX-Angsuran', '2018-08-13', 302, 8850000, 0),
(243, 6, 'TRX-Angsuran', '2018-08-13', 302, 8850000, 0),
(244, 7, 'TRX-Angsuran', '2018-08-13', 302, 8850000, 0),
(245, 8, 'TRX-Angsuran', '2018-08-13', 302, 8850000, 0),
(246, 234, 'TRX-Tabungan', '2018-08-14', 201, 100000, 0),
(247, 235, 'TRX-Tabungan', '2018-08-14', 202, 0, 500000),
(248, 236, 'TRX-Tabungan', '2018-08-14', 202, 0, 100000),
(249, 237, 'TRX-Tabungan', '2018-08-14', 204, 50000, 0),
(250, 238, 'TRX-Tabungan', '2018-08-14', 201, 100000, 0),
(251, 239, 'TRX-Tabungan', '2018-08-14', 202, 0, 50000),
(252, 1, 'TRX-Simpanan', '2019-02-20', 102, 10000, 0),
(253, 2, 'TRX-Simpanan', '2019-02-20', 101, 1000000, 0),
(254, 3, 'TRX-Simpanan', '2019-02-20', 101, 1000000, 0),
(255, 4, 'TRX-Simpanan', '2019-02-20', 101, 3000000, 0),
(256, 1, 'TRX-Biaya', '2019-02-20', 501, 0, 5000000),
(257, 1, 'TRX-Pendapatan', '2019-02-20', 401, 6000, 0),
(258, 240, 'TRX-Tabungan', '2019-06-04', 201, 10000, 0),
(259, 241, 'TRX-Tabungan', '2019-06-04', 201, 10000, 0),
(260, 242, 'TRX-Tabungan', '2019-06-04', 201, 2000, 0),
(261, 243, 'TRX-Tabungan', '2019-06-04', 201, 2000, 0),
(262, 244, 'TRX-Tabungan', '2019-06-04', 201, 2000, 0),
(263, 245, 'TRX-Tabungan', '2019-06-04', 201, 2000, 0),
(264, 246, 'TRX-Tabungan', '2019-06-04', 201, 2000, 0),
(265, 247, 'TRX-Tabungan', '2019-06-04', 201, 3000, 0),
(266, 248, 'TRX-Tabungan', '2019-06-04', 201, 10000, 0),
(267, 249, 'TRX-Tabungan', '2019-06-04', 201, 1000, 0),
(268, 250, 'TRX-Tabungan', '2019-06-04', 201, 30000, 0),
(269, 251, 'TRX-Tabungan', '2019-06-04', 201, 3000, 0),
(270, 252, 'TRX-Tabungan', '2019-06-04', 202, 0, 29000),
(271, 253, 'TRX-Tabungan', '2019-06-04', 202, 0, 100000),
(272, 254, 'TRX-Tabungan', '2019-06-04', 202, 0, 100000),
(273, 255, 'TRX-Tabungan', '2019-06-05', 201, 3000, 0),
(274, 256, 'TRX-Tabungan', '2019-06-05', 201, 29000, 0),
(275, 257, 'TRX-Tabungan', '2019-06-05', 201, 5000, 0),
(276, 5, 'TRX-Simpanan', '2019-06-13', 101, 7000000, 0),
(277, 258, 'TRX-Tabungan', '2019-06-19', 201, 10000, 0),
(278, 259, 'TRX-Tabungan', '2019-06-19', 201, 10000, 0),
(279, 260, 'TRX-Tabungan', '2019-06-19', 201, 1000, 0),
(280, 261, 'TRX-Tabungan', '2019-06-19', 201, 10000, 0),
(281, 262, 'TRX-Tabungan', '2019-06-19', 201, 29000, 0),
(282, 263, 'TRX-Tabungan', '2019-06-19', 201, 29000, 0),
(283, 264, 'TRX-Tabungan', '2019-06-19', 201, 29000, 0),
(284, 265, 'TRX-Tabungan', '2019-06-19', 201, 2000, 0),
(285, 266, 'TRX-Tabungan', '2019-06-19', 201, 2000, 0),
(286, 267, 'TRX-Tabungan', '2019-06-19', 201, 29000, 0),
(287, 268, 'TRX-Tabungan', '2019-06-19', 201, 2000, 0),
(288, 269, 'TRX-Tabungan', '2019-06-19', 201, 1000, 0),
(289, 270, 'TRX-Tabungan', '2019-06-19', 201, 3000, 0),
(290, 271, 'TRX-Tabungan', '2019-06-20', 201, 3000, 0),
(291, 272, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(292, 273, 'TRX-Tabungan', '2019-06-20', 201, 2000, 0),
(293, 274, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(294, 275, 'TRX-Tabungan', '2019-06-20', 201, 2000, 0),
(295, 276, 'TRX-Tabungan', '2019-06-20', 201, 2000, 0),
(296, 277, 'TRX-Tabungan', '2019-06-20', 201, 2000, 0),
(297, 278, 'TRX-Tabungan', '2019-06-20', 201, 2000, 0),
(298, 279, 'TRX-Tabungan', '2019-06-20', 201, 2000, 0),
(299, 280, 'TRX-Tabungan', '2019-06-20', 201, 2000, 0),
(300, 281, 'TRX-Tabungan', '2019-06-20', 201, 2000, 0),
(301, 282, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(302, 283, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(303, 284, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(304, 285, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(305, 286, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(306, 287, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(307, 288, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(308, 289, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(309, 290, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(310, 291, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(311, 292, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(312, 293, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(313, 294, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(314, 295, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(315, 296, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(316, 297, 'TRX-Tabungan', '2019-06-20', 201, 1000, 0),
(317, 298, 'TRX-Tabungan', '2019-06-20', 201, 3000, 0),
(318, 299, 'TRX-Tabungan', '2019-06-20', 201, 10000, 0),
(319, 300, 'TRX-Tabungan', '2019-06-23', 201, 10000, 0),
(320, 301, 'TRX-Tabungan', '2019-06-23', 201, 10000, 0),
(321, 302, 'TRX-Tabungan', '2019-06-23', 201, 3000, 0),
(322, 303, 'TRX-Tabungan', '2019-06-23', 201, 1000, 0),
(323, 304, 'TRX-Tabungan', '2019-06-23', 201, 1000, 0),
(324, 305, 'TRX-Tabungan', '2019-06-23', 201, 30000, 0),
(325, 306, 'TRX-Tabungan', '2019-06-23', 201, 1000, 0),
(326, 307, 'TRX-Tabungan', '2019-06-23', 201, 3000, 0),
(327, 308, 'TRX-Tabungan', '2019-06-24', 201, 3000, 0),
(328, 309, 'TRX-Tabungan', '2019-06-30', 201, 1000, 0),
(329, 310, 'TRX-Tabungan', '2019-06-30', 201, 1000, 0),
(330, 311, 'TRX-Tabungan', '2019-06-30', 201, 1000, 0),
(331, 312, 'TRX-Tabungan', '2019-06-30', 201, 1000, 0),
(332, 313, 'TRX-Tabungan', '2019-06-30', 201, 1000, 0),
(333, 314, 'TRX-Tabungan', '2019-06-30', 201, 1000, 0),
(334, 315, 'TRX-Tabungan', '2019-06-30', 201, 5000, 0),
(335, 316, 'TRX-Tabungan', '2019-06-30', 201, 3000, 0),
(336, 317, 'TRX-Tabungan', '2019-06-30', 201, 10000, 0),
(337, 318, 'TRX-Tabungan', '2019-06-30', 201, 10000, 0),
(338, 2, 'TRX-Biaya', '2019-07-18', 501, 0, 555),
(339, 3, 'TRX-Biaya', '2019-07-18', 501, 0, 10000),
(340, 319, 'TRX-Tabungan', '2019-07-18', 201, 2000, 0),
(341, 4, 'TRX-Biaya', '2019-07-18', 501, 0, 10000),
(342, 5, 'TRX-Biaya', '2019-07-18', 501, 0, 10000),
(343, 6, 'TRX-Biaya', '2019-07-18', 501, 0, 10000),
(344, 7, 'TRX-Biaya', '2019-07-18', 501, 0, 1000000),
(345, 2, 'TRX-Pendapatan', '2019-07-19', 401, 6000, 0),
(346, 3, 'TRX-Pendapatan', '2019-07-19', 401, 6000, 0),
(347, 3, 'TRX-Pinjaman', '2019-07-19', 301, 0, 10000000),
(348, 3, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(349, 4, 'TRX-Pinjaman', '2019-07-19', 301, 0, 10000000),
(350, 4, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(351, 5, 'TRX-Pinjaman', '2019-07-19', 301, 0, 10000000),
(352, 5, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(353, 6, 'TRX-Pinjaman', '2019-07-19', 301, 0, 10000000),
(354, 6, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(355, 7, 'TRX-Pinjaman', '2019-07-19', 301, 0, 10000000),
(356, 7, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(357, 8, 'TRX-Pinjaman', '2019-07-19', 301, 0, 10000000),
(358, 8, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(359, 9, 'TRX-Pinjaman', '2019-07-19', 301, 0, 100000000),
(360, 9, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(361, 10, 'TRX-Pinjaman', '2019-07-19', 301, 0, 20000000),
(362, 10, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(363, 11, 'TRX-Pinjaman', '2019-07-19', 301, 0, 5000000),
(364, 11, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(365, 12, 'TRX-Pinjaman', '2019-07-19', 301, 0, 5000000),
(366, 12, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(367, 13, 'TRX-Pinjaman', '2019-07-19', 301, 0, 5000000),
(368, 13, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(369, 14, 'TRX-Pinjaman', '2019-07-19', 301, 0, 5000000),
(370, 14, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(371, 15, 'TRX-Pinjaman', '2019-07-19', 301, 0, 5000000),
(372, 15, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(373, 16, 'TRX-Pinjaman', '2019-07-19', 301, 0, 5000000),
(374, 16, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(375, 17, 'TRX-Pinjaman', '2019-07-19', 301, 0, 5000000),
(376, 17, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(377, 18, 'TRX-Pinjaman', '2019-07-19', 301, 0, 100000000),
(378, 18, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(379, 19, 'TRX-Pinjaman', '2019-07-19', 301, 0, 100000000),
(380, 19, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(381, 20, 'TRX-Pinjaman', '2019-07-19', 301, 0, 100000000),
(382, 20, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(383, 21, 'TRX-Pinjaman', '2019-07-19', 301, 0, 100000000),
(384, 21, 'TRX-Pinjaman', '2019-07-19', 401, 56000, 0),
(385, 9, 'TRX-Angsuran', '2019-07-20', 302, 2550000, 0),
(386, 10, 'TRX-Angsuran', '2019-07-20', 302, 2550000, 0),
(387, 11, 'TRX-Angsuran', '2019-07-20', 302, 2550000, 0),
(388, 12, 'TRX-Angsuran', '2019-07-20', 302, 2550000, 0),
(389, 320, 'TRX-Tabungan', '2019-07-27', 201, 29000, 0),
(390, 321, 'TRX-Tabungan', '2019-07-27', 201, 1000, 0),
(391, 322, 'TRX-Tabungan', '2019-08-04', 202, 0, 300000),
(392, 323, 'TRX-Tabungan', '2019-08-04', 201, 2000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kredit`
--

CREATE TABLE `tb_kredit` (
  `id_kredit` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `status_rumah` varchar(50) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `alamat_perusahaan` varchar(225) NOT NULL,
  `telp_perusahaan` varchar(15) NOT NULL,
  `jaminan` varchar(225) NOT NULL,
  `nama_penanggung` varchar(100) NOT NULL,
  `pekerjaan_penanggung` varchar(50) NOT NULL,
  `alamat_penanggung` varchar(255) NOT NULL,
  `telp_penanggung` varchar(15) NOT NULL,
  `hubungan` varchar(50) NOT NULL,
  `nominal_permohonan` int(11) NOT NULL,
  `ket_permohonan` varchar(225) NOT NULL,
  `tgl_permohonan` date NOT NULL,
  `status_permohonan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kredit`
--

INSERT INTO `tb_kredit` (`id_kredit`, `id_nasabah`, `status_rumah`, `nama_perusahaan`, `alamat_perusahaan`, `telp_perusahaan`, `jaminan`, `nama_penanggung`, `pekerjaan_penanggung`, `alamat_penanggung`, `telp_penanggung`, `hubungan`, `nominal_permohonan`, `ket_permohonan`, `tgl_permohonan`, `status_permohonan`) VALUES
(1, 8, 'Milik Sendiri', 'Olshop 4jovem', '-', '-', 'BPKB Vario Tahun 2017', 'I Putu Darmayasa', 'Pedagang', 'Jln Peguyangan Ahmad Yani No 16 Denpasar Utara', '085792486889', 'Ayah', 5000000, 'Menjual barang Olshop 4jovem', '2018-07-13', 'Terima'),
(2, 14, 'Milik Sendiri', 'Sutami Cell', '-', '081805386162', 'Surat Tanah 1 hektar', 'Ida Ayu Nyoman Tirta', 'Pedagang', 'Jln Nenas No 16 Bungaya Kangin', '08179798579', 'Ibu', 10000000, 'Jual Voucher Pulsa Listrik', '2018-07-13', 'Terima'),
(3, 16, 'Milik Sendiri', 'Bali Computer', '-', '-', 'BPKB Jupiter Mx 2016', 'Putu Pertama Yasa', 'PNS', 'Jln Kerobokan Kaje 06 Denpasar', '085792563214', 'Paman', 5000000, 'Jual voucher game', '2018-07-13', 'Tolak'),
(4, 11, 'Milik Sendiri', 'Fakhri Repair', '-', '-', 'Surat Tanah 1 Are', 'Komang Sukra Antara', 'Wiraswasta', 'Jln Padang Lestari Blok H5 Badung', '081456789', 'Ayah', 20000000, 'Membuat usaha perbaikan Handphone', '2018-07-19', 'Tolak'),
(5, 12, 'Milik Sendiri', 'Warung Linci', '-', '-', 'Surat Tanah 1 hektar', 'Muhammad Yamin', 'PNS', 'Jln Gunung Sangiang No 16 Denpasar', '085792852963', 'Paman', 100000000, 'Membangun usaha warung makan', '2018-07-19', 'Terima'),
(6, 9, 'Milik Sendiri', 'Olshop Sepatu', '-', '-', 'BPKB Vario 2016', 'Niya', 'Pedagang', 'Jln Tegal Wangi III No 34', '087861225771', 'Ibu', 5000000, 'Modal Usaha Toko Sepatu', '2018-07-19', 'Tolak'),
(7, 18, 'Milik Sendiri', 'The Urban Make Up', 'Jl Raya Puputan No 232', '0361234789', 'Surat Tanah', 'Ria', 'Pegawai', 'Jl Raya Sesetan No 64', '0812367129090', 'Saudara', 20000000, 'Modal Usaha', '2018-07-19', 'Terima'),
(8, 10, 'Milik Sendiri', 'Toko Bunga', 'Jl Raya Renon', '0361222777', 'Emas', 'Dian', 'Guru', 'Jl Raya Sukawati', '08179798579', 'Ibu', 5000000, 'Modal Usaha', '2018-07-19', 'Terima'),
(9, 36, 'Milik Sendiri', 'Rumah Makan', 'Jl Raya Uluwatu', '0361234789', 'Surat Tanah', 'Dayu Gita', 'Pegawai', 'Jl Raya Sempidi', '08179798579', 'Kakak', 5000000, 'Sewa Kontrak', '2018-07-19', 'Terima'),
(10, 24, 'Milik Sendiri', 'Toko Buku', 'Tabanan', '0361277890', 'Rumah', 'Eddi', 'Pedagang', 'Denpasar Selatan', '087861222780', 'Ayah', 100000000, 'Buat Toko', '2018-07-19', 'Terima'),
(11, 20, 'Milik Sendiri', 'Salon & Spa', 'Jl Raya Kuta', '087860330990', 'Rumah', 'Dian', 'Guru', 'Tabanan Kota', '0361998771', 'Ibu', 100000000, 'Modal Usaha', '2018-07-19', 'Terima'),
(12, 32, 'Milik Sendiri', 'Toko Aksesoris', 'Denpasar Utara', '0361277890', 'BPKB Mobil Jazz', 'Aprilia', 'PNS', 'Peguyangan', '08179798579', 'Ibu', 100000000, 'Sewa Toko', '2018-07-19', 'Terima'),
(13, 27, 'Sewa/Kontrak', 'Butik Kebaya', 'Jl Raya Sesetan No 23', '087860330990', 'Emas 1kg', 'Ayu Rani', 'Pedagang', 'Denpasar', '08179798579', 'Ibu', 100000000, 'Modal Usaha', '2018-07-19', 'Terima'),
(14, 13, 'Milik Sendiri', 'Toko Tas', 'Kuta', '0361222777', 'BPKB Vario 2917', 'Winda', 'Wirausaha', 'Kuta Utara', '08179798579', 'Ibu', 5000000, 'Modal Usaha', '2018-07-19', 'Terima'),
(15, 9, 'Milik Sendiri', 'vgdfdgdfg', 'fgdfdg', '566454', 'ghgfgfh', 'fgdfgdf', 'fgdfdfg', 'ghff', '465456464', 'dfdgdfgd', 4354533, 'xcvxcvx', '2019-07-27', 'Tunda');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_link_akun`
--

CREATE TABLE `tb_link_akun` (
  `id_link_akun` int(11) NOT NULL,
  `id_jenis_transaksi` int(11) NOT NULL,
  `id_akun` varchar(255) NOT NULL,
  `dk` enum('d','k') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_link_akun`
--

INSERT INTO `tb_link_akun` (`id_link_akun`, `id_jenis_transaksi`, `id_akun`, `dk`) VALUES
(1, 1, '301', 'd'),
(2, 1, '100', 'k'),
(3, 2, '100', 'd'),
(4, 2, '302', 'k'),
(5, 3, '100', 'd'),
(6, 3, '206', 'k'),
(7, 7, '501', 'd'),
(8, 7, '100', 'k'),
(13, 8, '100', 'd'),
(14, 8, '401', 'k');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nasabah`
--

CREATE TABLE `tb_nasabah` (
  `id_nasabah` int(11) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `tempat_lahir` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` varchar(25) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `status` enum('Anggota','Nasabah','Anggota & Nasabah') NOT NULL,
  `bln_akhir` int(11) NOT NULL,
  `thn_akhir` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_nasabah`
--

INSERT INTO `tb_nasabah` (`id_nasabah`, `no_ktp`, `nama`, `jk`, `pekerjaan`, `tempat_lahir`, `tgl_lahir`, `agama`, `alamat`, `no_hp`, `email`, `foto`, `tgl_daftar`, `status`, `bln_akhir`, `thn_akhir`) VALUES
(16, '5107044502980002', 'Ni Luh Putu Suparmini', 'Perempuan', 'Wiraswasta', 'Karangasem', '1999-02-05', 'Hindu', 'Tukad Batanghari IV A', '082236563210', 'amisuparmini89@gmail.com', '5107044502980002.jpg', '2018-07-02', 'Nasabah', 0, 0),
(15, '5107056310957841', 'Ida Bagus Wayan Kardika', 'Laki-laki', 'PNS', 'Bungaya Kangin', '1985-08-10', 'Hindu', 'Jln Nenas No 16 Bungaya Kangin', '081805386162', 'rinax99@gmail.com', '5107056310957841.jpg', '2018-07-03', 'Nasabah', 0, 0),
(14, '5107066308960003', 'Ni Luh Sutamiyanti', 'Perempuan', 'Wiraswasta', 'Bhuana Giri', '1986-08-23', 'Hindu', 'Br. Dinas Bukit Paon,Desa Bhuana Giri, Kec Bebandem, Kab Karangasem', '085739788351', 'sutamiyanti2308@gmail.com', '5107066308960003.jpg', '2018-07-01', 'Nasabah', 0, 0),
(13, '5107056310960001', 'Ni Made Citta Satwika', 'Perempuan', 'Guru', 'Ujung Pandang', '1986-10-23', 'Hindu', 'Br. Dina\'s bias, ababi, abang, karangasem', '08085792757933', 'cittasatwika@gmail.com', '5107056310960001.png', '2018-07-01', 'Nasabah', 0, 0),
(12, '5102030704970145', 'I Komang Suka Wedana', 'Laki-laki', 'Guru', 'Denpasar', '1984-02-07', 'Hindu', 'Jln Ayani Renon No 78 Denpasar Utara', '085792456789', 'sukawedana76@gmail.com', '5102030704970145.jpg', '2018-07-01', 'Nasabah', 0, 0),
(11, '5107062709978401', 'Fakhri Nurulhuda', 'Laki-laki', 'Mahasiswa', 'Denpasar', '1986-01-01', 'Hindu', 'Jln Peguyangan No 762 Denpasar Utara', '085792478965', 'fakrinurulhuda@gmail.com', '5107062709978401.png', '2018-07-03', 'Nasabah', 0, 0),
(10, '5107065709970001', 'Ni Wayan Sri Ayu Purnami', 'Perempuan', 'Guru', 'BUNGAYA', '1984-09-07', 'Hindu', 'Dusun Beji, Bungaya, Bebandem, Karangasem', '085857515692', 'sriayupurnami17@gmail.com', '5107065709970001.png', '2018-07-03', 'Nasabah', 0, 0),
(9, '5103022204970589', 'I Putu Erik Pertamayasa', 'Laki-laki', 'Wiraswasta', 'Gianyar', '1996-05-09', 'Hindu', 'Jln Gianyar Tulikup No 76 Belahbatuh', '08795248625', 'erikpertamayasa@gmail.com', '5103022204970589.jpg', '2018-07-01', 'Nasabah', 0, 0),
(8, '5103066704980010', 'Putu Dian Apriliantari', 'Laki-laki', 'Wirausaha', 'Buleleng', '1991-04-27', 'Hindu', 'Perum Padang Lestari Blok H/5 Lingk. Padang Lestari', '081338345505', 'dianapriliantari@gmail.com', '5103066704980010.jpg', '2018-07-01', 'Nasabah', 0, 0),
(7, '5102030704970001', 'Putu Maha Girinda Praba', 'Laki-laki', 'Buruh', 'Antosari', '0000-00-00', 'Hindu', 'Br. Dinas Petiles', '08199987132', 'mahagirinda@gmail.com', '5102030704970001.jpg', '2018-07-02', 'Anggota', 7, 2018),
(6, '5171040109960002', 'I Wayan Diva Dananjaya', 'Laki-laki', 'Mahasiswa', 'Denpasar', '1986-09-01', 'Hindu', 'Jln Cekomaria Gang Dikubu Banjar Kedua', '085792361610', 'dananjayadiva@gmail.com', '5171040109960002.jpg', '2018-07-02', 'Anggota', 7, 2018),
(5, '5103022204970004', 'I Nyoman Yoga Nugraha', 'Laki-laki', 'PNS', 'Badung', '1991-04-28', 'Hindu', 'Jl Gede Desa I No 8 Lingkungan Pekandelan', '081805502233', 'yo666an@gmail.com', '5103022204970004.jpg', '2018-07-01', 'Anggota', 7, 2018),
(4, '5107062709960001', 'Ida Bagus Ketut Adiyoga', 'Laki-laki', 'Wiraswasta', 'Bungaya', '1996-09-27', 'Hindu', 'Jln Nenas No 16 Bungaya Kangin Bali', '085792486889', 'ajusadiyoga@gmail.com', '5107062709960001.jpg', '2018-07-01', 'Anggota', 7, 2018),
(3, '5107062709960002', 'Cinta Tiara Dewi', 'Perempuan', 'Guru', 'Denpasar', '1997-02-04', 'Islam', 'Jl. Bedahulu No.12 Denpasar', '081222333111', 'cinta@gmail.com', '5107062709960002.jpg', '2018-07-01', 'Anggota', 7, 2018),
(1, '5104012710970004', 'I Gede Purnayasa', 'Laki-laki', 'PNS', 'Denpasar', '1997-10-28', 'Hindu', 'Jl. Ayani No.11X', '089672844172', 'eddiputra12@gmail.com', '5104012710970004.jpg', '2018-07-01', 'Anggota', 8, 2019),
(2, '5107062709960005', 'Ni Putu Leonita Wijayanti', 'Perempuan', 'Wiraswasta', 'Denpasar', '1997-03-13', 'Hindu', 'Jl. Nangka No.32X Denpasar', '081222333444', 'leonitawijayanti23@gmail.com', '5107062709960005.jpg', '2018-07-01', 'Anggota', 7, 2018),
(17, '5107051210960568', 'Ida Ayu Nyoman Dammayanti', 'Perempuan', 'PNS', 'Denpasar', '1995-08-25', 'Hindu', 'Jln Ahmad Yani No 122 Kelurahan Peguyangan', '085792532478', 'dammayanti08@gmail.com', '5107051210960568.jpg', '2018-07-01', 'Nasabah', 0, 0),
(18, '5102030644978741', 'Reza Akbar Hidayat', 'Laki-laki', 'Pegawai Swasta', 'Denpasar', '1986-08-27', 'Hindu', 'Jln Ahmad Yani no 123 Peguyangan Denpasar', '082236563210', 'rezaakbarhidayat@yahoo.com', '5102030644978741.jpg', '2018-07-01', 'Nasabah', 0, 0),
(19, '5107012310945101', 'Putu Indira Wiweka Putra', 'Laki-laki', 'Wiraswasta', 'Denpasar', '1987-01-03', 'Hindu', 'Jln Ahmad Yani Kesiman No 16 Denpasar Utara', '08085792757933', 'indirawiweka@gmail.com', '5107012310945101.jpg', '2018-07-01', 'Nasabah', 0, 0),
(20, '5107062709967116', 'Ni Putu Noviyanti Kusuma', 'Perempuan', 'Mahasiswa', 'Denpasar', '1991-02-28', 'Hindu', 'Jln Peguyangan Ahmad Yani No 16 Denpasar  Utara', '082236563210', 'noviyanti28@gmail.com', '5107062709967116.jpg', '2018-07-03', 'Nasabah', 0, 0),
(21, '5107062709967801', 'Ni Luh Putu Lestariningsih', 'Perempuan', 'Wiraswasta', 'Nusa Dua', '1992-08-15', 'Hindu', 'Jln Nusa Dua Kangin Kauh No 15 Jimbaran', '08579468245', 'lestariningsih27@gmail.com', '5107062709967801.jpg', '2018-07-02', 'Nasabah', 0, 0),
(22, '5107062899964461', 'Mirega Aldelan Nanda', 'Laki-laki', 'Tidak Bekerja', 'Denpasar', '1991-04-21', 'Hindu', 'Jln Ahmad Yani No 145 Peguyangan Denpasar Utara', '082236210888', 'miregaaldela21@gmail.com', '5107062899964461.png', '2018-07-01', 'Nasabah', 0, 0),
(23, '5107056310971241', 'Ida Ayu Putu Sribawa', 'Perempuan', 'Mahasiswi', 'Denpasar', '1991-09-09', 'Hindu', 'Jln Ahmad Yani No 98 Peguyangan Bali', '081222333174', 'sribawa02@gmail.com', '5107056310971241.png', '2018-07-01', 'Nasabah', 0, 0),
(24, '5103022207830004', 'I Wayan Yokego', 'Laki-laki', 'Wiraswasta', 'Denpasar', '0000-00-00', 'Hindu', 'Jln Ahmad Yani No 17 Peguyangan Denpasar Utara Bali', '085792421887', 'yokego89@gmail.com', '5103022207830004.jpg', '2018-07-01', 'Nasabah', 0, 0),
(25, '5107062709964731', 'Savanah Agusta Karmi Soares', 'Perempuan', 'Guru', 'Denpasar', '1991-08-09', 'Hindu', 'Jln Kerobokan No 16 Denpasar Utara', '081805746932', 'agustakarmi@gmail.com', '5107062709964731.jpg', '2018-07-01', 'Nasabah', 0, 0),
(26, '5107062709867116', 'I Made Suradita', 'Laki-laki', 'Pegawai Swasta', 'Denpasar Selatan', '1992-01-01', 'Hindu', 'Jln Danau Bayan 4 No 12, Sanur Kaja ', '082236563325', 'suradita76@gmail.com', '5107062709867116.png', '2018-07-01', 'Nasabah', 0, 0),
(27, '5107062709965475', 'Made Dian Putri Prabawati', 'Perempuan', 'Wiraswasta', 'Denpasar Selatan', '1994-02-08', 'Hindu', 'Jln Griya Anyar Banjar Kajeng, Pemogan', '0812223113224', 'prutriprabawati@gmail.com', '5107062709965475.jpg', '2018-07-01', 'Nasabah', 0, 0),
(28, '5107056310964111', 'Sang Ayu Komang Juni Setiari', 'Perempuan', 'Mahasiswa', 'Denpasar Barat', '1991-09-06', 'Hindu', 'Jln Gatot Subroto Barat No. 123 Padangsambian', '081239745896', 'junisetiari@gmail.com', '5107056310964111.jpg', '2018-07-01', 'Nasabah', 0, 0),
(29, '5107062709961475', 'Dewa Gde Paramaswara', 'Laki-laki', 'Pegawai Swasta', 'Denpasar Barat', '1994-07-09', 'Hindu', 'Jln Gunung Merbuk No 7 Tegal Kertha', '081915333444', 'paramaswara@gmail.com', '5107062709961475.jpg', '2018-07-01', 'Nasabah', 0, 0),
(30, '5107056310961241', 'Israq Anderson Permana', 'Perempuan', 'Mahasiswa', 'Denpasar Barat', '1994-07-08', 'Hindu', 'Jln Mahendratta No 88 Padangsambian', '082236563325', 'andersinpermana@gmail.com', '5107056310961241.jpg', '2018-07-01', 'Nasabah', 0, 0),
(31, '5107062709960009', 'Putu Elsa Oktavia Dewi', 'Perempuan', 'Mahasiswa', 'Denpasar Barat', '1996-12-18', 'Hindu', 'Jln Gatot Subroto Barat No 451B Padangsambian', '089672845892', 'oktavia1996@gmail.com', '5107062709960009.jpg', '2018-07-01', 'Nasabah', 0, 0),
(32, '5107062709964879', 'Putu Elsa Oktavia Dewi', 'Perempuan', 'Mahasiswa', 'Denpasar Barat', '1996-12-18', 'Hindu', 'Jln Gatot Subroto Barat No 451B Padangsambian', '089672845892', 'oktavia1996@gmail.com', '5107062709964879.jpg', '2018-07-01', 'Nasabah', 0, 0),
(33, '5107062709964501', 'Ni Luh Putu Mila Juliawathi', 'Perempuan', 'Guru', 'Denpasar Barat', '1995-08-19', 'Hindu', 'Jln Pura Demak No 12 Pemecutan Klod', '082236563220', 'juliawathimila@gmail.com', '5107062709964501.jpg', '2018-07-01', 'Nasabah', 0, 0),
(34, '5107062709990045', 'I Komang Ardi Widiantara', 'Laki-laki', 'Guru', 'Denpasar Barat', '1998-08-08', 'Islam', 'Jln Gunung Rinjani Tegal Harum Denpasar Barat', '085794654414', 'widiantaraardi@gmail.com', '5107062709990045.jpg', '2018-07-01', 'Nasabah', 0, 0),
(35, '5107062709988901', 'Putu Andi Satrya Yuda', 'Laki-laki', 'Mahasiswa', 'Denpasar Utara', '1994-12-16', 'Hindu', 'Jln Mawar No 11 Denpasar, Dangin Puri', '089672847792', 'satryayuda@gmail.com', '5107062709988901.jpg', '2018-07-01', 'Nasabah', 0, 0),
(36, '5103022204980014', 'I Made Sucipta Yasa', 'Laki-laki', 'Wiraswasta', 'Denpasar', '1991-01-02', 'Kristen Katolik', 'Jln Nenas No 16 Pemecutan Kaje', '085794656414', 'suciptayasa@gmail.com', '5103022204980014.jpg', '2018-07-01', 'Nasabah', 0, 0),
(37, '5104061005970005', 'ketut bagus', 'Laki-laki', 'Mahasiswa', 'Puakan', '1997-10-06', 'Hindu', 'puakan', '+6285739010882', 'csukarena@gmail.com', '5104061005970005.jpg', '2019-06-19', 'Nasabah', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pendapatan`
--

CREATE TABLE `tb_pendapatan` (
  `id_pendapatan` int(11) NOT NULL,
  `kode_pendapatan` varchar(5) NOT NULL,
  `id_akun` int(3) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pendapatan`
--

INSERT INTO `tb_pendapatan` (`id_pendapatan`, `kode_pendapatan`, `id_akun`, `nama`) VALUES
(1, 'P1', 401, 'Biaya Materai'),
(2, 'P2', 401, 'Biaya Administrasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_reknasabah`
--

CREATE TABLE `tb_reknasabah` (
  `id_reknasabah` int(11) NOT NULL,
  `no_rek` varchar(20) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `tgl_bukarek` date NOT NULL,
  `saldo_akhir` int(11) NOT NULL,
  `rek_status` enum('Baru','Lama') NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_reknasabah`
--

INSERT INTO `tb_reknasabah` (`id_reknasabah`, `no_rek`, `id_nasabah`, `tgl_bukarek`, `saldo_akhir`, `rek_status`, `id_user`) VALUES
(10, 'AD/2018', 17, '2018-07-01', 340000, 'Baru', 4),
(9, 'AD/2018', 16, '2018-07-01', 360000, 'Baru', 4),
(8, 'AD/2018', 15, '2018-07-01', 250000, 'Baru', 4),
(7, 'AD/2018', 14, '2018-07-01', 420000, 'Baru', 4),
(6, 'AD/2018', 13, '2018-07-01', 340000, 'Baru', 4),
(5, 'AD/2018', 12, '2018-07-01', 343000, 'Baru', 4),
(4, 'AD/2018', 11, '2018-07-01', 349000, 'Baru', 4),
(3, 'AD/2018', 10, '2018-07-01', 316000, 'Baru', 4),
(2, 'AD/2018', 9, '2018-07-01', 15000, 'Baru', 4),
(1, 'AD/2018', 8, '2018-07-01', -64000, 'Baru', 4),
(13, 'YO/2018', 20, '2018-07-01', 335000, 'Baru', 5),
(11, 'YO/2018', 18, '2018-07-01', 410000, 'Baru', 5),
(12, 'YO/2018', 19, '2018-07-01', 400000, 'Baru', 5),
(14, 'YO/2018', 21, '2018-07-01', 390000, 'Baru', 5),
(15, 'YO/2018', 22, '2018-07-01', 290000, 'Baru', 5),
(16, 'YO/2018', 23, '2018-07-01', 390000, 'Baru', 5),
(17, 'YO/2018', 24, '2018-07-01', 270000, 'Baru', 5),
(18, 'YO/2018', 25, '2018-07-01', 240000, 'Baru', 5),
(19, 'YO/2018', 26, '2018-07-01', 340000, 'Baru', 5),
(20, 'YO/2018', 27, '2018-07-01', 380000, 'Baru', 5),
(21, 'MP/2018', 28, '2018-07-01', 192000, 'Baru', 7),
(22, 'MP/2018', 29, '2018-07-01', 305000, 'Baru', 7),
(23, 'MP/2018', 30, '2018-07-01', 435000, 'Baru', 7),
(24, 'MP/2018', 32, '2018-07-01', 380000, 'Baru', 7),
(25, 'MP/2018', 34, '2018-07-01', 380000, 'Baru', 7),
(26, 'MP/2018', 35, '2018-07-01', 343000, 'Baru', 7),
(27, 'MP/2018', 36, '2018-07-01', 324000, 'Baru', 7),
(28, 'YO/2019', 37, '2019-06-19', 47000, 'Baru', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_trx_angsuran`
--

CREATE TABLE `tb_trx_angsuran` (
  `id_trx_angsuran` int(11) NOT NULL,
  `id_trx` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `id_akun` int(3) NOT NULL,
  `bulan_ke` int(11) NOT NULL,
  `nominal_angsuran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_trx_angsuran`
--

INSERT INTO `tb_trx_angsuran` (`id_trx_angsuran`, `id_trx`, `tgl_transaksi`, `id_akun`, `bulan_ke`, `nominal_angsuran`) VALUES
(1, 1, '2018-07-19', 302, 1, 1180000),
(2, 1, '2018-08-13', 302, 2, 1180000),
(3, 1, '2018-08-13', 302, 3, 1180000),
(4, 1, '2018-08-13', 302, 4, 1180000),
(5, 2, '2018-08-13', 302, 1, 8850000),
(6, 2, '2018-08-13', 302, 2, 8850000),
(7, 2, '2018-08-13', 302, 3, 8850000),
(8, 2, '2018-08-13', 302, 4, 8850000),
(9, 8, '2019-07-20', 302, 1, 2550000),
(10, 3, '2019-07-20', 302, 1, 2550000),
(11, 3, '2019-07-20', 302, 1, 2550000),
(12, 3, '2019-07-20', 302, 1, 2550000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_trx_biaya`
--

CREATE TABLE `tb_trx_biaya` (
  `id_trx` int(11) NOT NULL,
  `id_biaya` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `keterangan` varchar(225) NOT NULL,
  `tgl_transaksi` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_trx_biaya`
--

INSERT INTO `tb_trx_biaya` (`id_trx`, `id_biaya`, `nominal`, `keterangan`, `tgl_transaksi`) VALUES
(1, 1, 5000000, '1bulan', '2019-02-20'),
(2, 1, 555, 'eretrete', '2019-07-18'),
(3, 1, 10000, 'beli bensin', '2019-07-18'),
(4, 2, 10000, 'hahay', '2019-07-18'),
(5, 2, 10000, 'hahay', '2019-07-18'),
(6, 2, 10000, 'hahay', '2019-07-18'),
(7, 1, 1000000, 'testes', '2019-07-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_trx_pendapatan`
--

CREATE TABLE `tb_trx_pendapatan` (
  `id_trx` int(11) NOT NULL,
  `id_pendapatan` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `keterangan` varchar(225) NOT NULL,
  `tgl_transaksi` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_trx_pendapatan`
--

INSERT INTO `tb_trx_pendapatan` (`id_trx`, `id_pendapatan`, `nominal`, `keterangan`, `tgl_transaksi`) VALUES
(1, 1, 6000, 'ffff', '2019-02-20'),
(2, 1, 6000, 'iluh nyilih pis', '2019-07-19'),
(3, 1, 6000, 'iluh nyilih pis', '2019-07-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_trx_pinjaman`
--

CREATE TABLE `tb_trx_pinjaman` (
  `id_trx` int(11) NOT NULL,
  `id_akun` int(3) NOT NULL,
  `id_kredit` int(11) NOT NULL,
  `tgl_realisasi` date NOT NULL,
  `nominal_pinjaman` int(11) NOT NULL,
  `persenbunga` float NOT NULL,
  `angsurantotal` int(11) NOT NULL,
  `angsuranpokok` int(11) NOT NULL,
  `angsuranbunga` int(11) NOT NULL,
  `biaya_admin` int(11) NOT NULL,
  `biaya_materai` int(11) NOT NULL,
  `jangka_waktu` int(11) NOT NULL,
  `total_pinjaman` int(11) NOT NULL,
  `total_pinjaman_bayar` int(11) NOT NULL,
  `total_bulan` int(11) NOT NULL,
  `status_pinjaman` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_trx_pinjaman`
--

INSERT INTO `tb_trx_pinjaman` (`id_trx`, `id_akun`, `id_kredit`, `tgl_realisasi`, `nominal_pinjaman`, `persenbunga`, `angsurantotal`, `angsuranpokok`, `angsuranbunga`, `biaya_admin`, `biaya_materai`, `jangka_waktu`, `total_pinjaman`, `total_pinjaman_bayar`, `total_bulan`, `status_pinjaman`) VALUES
(1, 301, 1, '2018-07-19', 4000000, 18, 1180000, 1000000, 180000, 5000, 12000, 4, 4720000, 4720000, 4, 'Lunas'),
(2, 301, 5, '2018-08-13', 90000000, 18, 8850000, 7500000, 1350000, 5000, 12000, 12, 106200000, 35400000, 4, 'Belum Lunas'),
(3, 301, 2, '2019-07-19', 10000000, 2, 2550000, 2500000, 50000, 50000, 6000, 4, 10200000, 2550000, 1, 'Belum Lunas'),
(4, 301, 2, '2019-07-19', 10000000, 2, 2550000, 2500000, 50000, 50000, 6000, 4, 10200000, 0, 0, 'Belum Lunas'),
(5, 301, 2, '2019-07-19', 10000000, 2, 2550000, 2500000, 50000, 50000, 6000, 4, 10200000, 0, 0, 'Belum Lunas'),
(6, 301, 2, '2019-07-19', 10000000, 2, 2550000, 2500000, 50000, 50000, 6000, 4, 10200000, 0, 0, 'Belum Lunas'),
(7, 301, 2, '2019-07-19', 10000000, 2, 2550000, 2500000, 50000, 50000, 6000, 4, 10200000, 0, 0, 'Belum Lunas'),
(8, 301, 2, '2019-07-19', 10000000, 2, 2550000, 2500000, 50000, 50000, 6000, 4, 10200000, 2550000, 1, 'Belum Lunas'),
(9, 301, 13, '2019-07-19', 100000000, 2, 5100000, 5000000, 100000, 50000, 6000, 20, 102000000, 0, 0, 'Belum Lunas'),
(10, 301, 7, '2019-07-19', 20000000, 2, 1020000, 1000000, 20000, 50000, 6000, 20, 20400000, 0, 0, 'Belum Lunas'),
(11, 301, 8, '2019-07-19', 5000000, 2, 1020000, 1000000, 20000, 50000, 6000, 5, 5100000, 0, 0, 'Belum Lunas'),
(12, 301, 8, '2019-07-19', 5000000, 2, 1020000, 1000000, 20000, 50000, 6000, 5, 5100000, 0, 0, 'Belum Lunas'),
(13, 301, 8, '2019-07-19', 5000000, 2, 1020000, 1000000, 20000, 50000, 6000, 5, 5100000, 0, 0, 'Belum Lunas'),
(14, 301, 14, '2019-07-19', 5000000, 2, 510000, 500000, 10000, 50000, 6000, 10, 5100000, 0, 0, 'Belum Lunas'),
(15, 301, 14, '2019-07-19', 5000000, 2, 510000, 500000, 10000, 50000, 6000, 10, 5100000, 0, 0, 'Belum Lunas'),
(16, 301, 14, '2019-07-19', 5000000, 2, 510000, 500000, 10000, 50000, 6000, 10, 5100000, 0, 0, 'Belum Lunas'),
(17, 301, 9, '2019-07-19', 5000000, 2, 1020000, 1000000, 20000, 50000, 6000, 5, 5100000, 0, 0, 'Belum Lunas'),
(18, 301, 12, '2019-07-19', 100000000, 2, 5100000, 5000000, 100000, 50000, 6000, 20, 102000000, 0, 0, 'Belum Lunas'),
(19, 301, 12, '2019-07-19', 100000000, 2, 5100000, 5000000, 100000, 50000, 6000, 20, 102000000, 0, 0, 'Belum Lunas'),
(20, 301, 12, '2019-07-19', 100000000, 2, 5100000, 5000000, 100000, 50000, 6000, 20, 102000000, 0, 0, 'Belum Lunas'),
(21, 301, 10, '2019-07-19', 100000000, 2, 5100000, 5000000, 100000, 50000, 6000, 20, 102000000, 0, 0, 'Belum Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_trx_simpanan`
--

CREATE TABLE `tb_trx_simpanan` (
  `id_trx` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `id_simpanan` int(11) NOT NULL,
  `jumlah_bln` int(11) NOT NULL,
  `bln_mulai` int(11) NOT NULL,
  `total` double NOT NULL,
  `tgl_transaksi` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_trx_simpanan`
--

INSERT INTO `tb_trx_simpanan` (`id_trx`, `id_nasabah`, `id_simpanan`, `jumlah_bln`, `bln_mulai`, `total`, `tgl_transaksi`) VALUES
(1, 1, 2, 1, 7, 10000, '2019-02-20'),
(2, 1, 1, 1, 8, 1000000, '2019-02-20'),
(3, 2, 1, 1, 7, 1000000, '2019-02-20'),
(4, 1, 1, 3, 8, 3000000, '2019-02-20'),
(5, 1, 1, 7, 8, 7000000, '2019-06-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_trx_simpanan_det`
--

CREATE TABLE `tb_trx_simpanan_det` (
  `id_trx_simpanan_det` int(11) NOT NULL,
  `id_trx` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_trx_simpanan_det`
--

INSERT INTO `tb_trx_simpanan_det` (`id_trx_simpanan_det`, `id_trx`, `nominal`, `bulan`, `tahun`) VALUES
(1, 1, 10000, 7, 2018),
(2, 2, 1000000, 8, 2018),
(3, 3, 1000000, 7, 2018),
(4, 4, 1000000, 8, 2018),
(5, 4, 1000000, 9, 2018),
(6, 4, 1000000, 10, 2018),
(7, 5, 1000000, 8, 2018),
(8, 5, 1000000, 9, 2018),
(9, 5, 1000000, 10, 2018),
(10, 5, 1000000, 11, 2018),
(11, 5, 1000000, 12, 2018),
(12, 5, 1000000, 1, 2019),
(13, 5, 1000000, 2, 2019);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_trx_tabungan`
--

CREATE TABLE `tb_trx_tabungan` (
  `id_trx` int(11) NOT NULL,
  `id_reknasabah` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `id_akun` int(3) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_trx_tabungan`
--

INSERT INTO `tb_trx_tabungan` (`id_trx`, `id_reknasabah`, `tgl_transaksi`, `id_akun`, `debet`, `kredit`, `saldo`, `id_user`) VALUES
(1, 1, '2018-07-01', 201, 0, 100000, 100000, 3),
(2, 2, '2018-07-01', 201, 0, 150000, 150000, 3),
(3, 3, '2018-07-01', 201, 0, 150000, 150000, 3),
(4, 4, '2018-07-01', 201, 0, 100000, 100000, 3),
(5, 5, '2018-07-01', 201, 0, 100000, 100000, 3),
(6, 8, '2018-07-01', 201, 0, 100000, 100000, 3),
(7, 9, '2018-07-01', 201, 0, 100000, 100000, 3),
(8, 12, '2018-07-01', 201, 0, 200000, 200000, 3),
(9, 13, '2018-07-01', 201, 0, 150000, 150000, 3),
(10, 14, '2018-07-01', 201, 0, 200000, 200000, 3),
(11, 17, '2018-07-01', 201, 0, 100000, 100000, 3),
(12, 18, '2018-07-01', 201, 0, 100000, 100000, 3),
(13, 19, '2018-07-01', 201, 0, 150000, 150000, 3),
(14, 22, '2018-07-01', 201, 0, 100000, 100000, 3),
(15, 23, '2018-07-01', 201, 0, 200000, 200000, 3),
(16, 24, '2018-07-01', 201, 0, 200000, 200000, 3),
(17, 25, '2018-07-01', 201, 0, 200000, 200000, 3),
(18, 26, '2018-07-01', 201, 0, 150000, 150000, 3),
(19, 27, '2018-07-01', 201, 0, 100000, 100000, 3),
(20, 6, '2018-07-02', 201, 0, 150000, 150000, 3),
(21, 7, '2018-07-02', 201, 0, 200000, 200000, 3),
(22, 16, '2018-07-02', 201, 0, 150000, 150000, 3),
(23, 21, '2018-07-02', 201, 0, 100000, 100000, 3),
(24, 10, '2018-07-03', 201, 0, 150000, 150000, 3),
(25, 11, '2018-07-03', 201, 0, 200000, 200000, 3),
(26, 15, '2018-07-03', 201, 0, 100000, 100000, 3),
(27, 20, '2018-07-03', 201, 0, 150000, 150000, 3),
(28, 1, '2018-07-03', 201, 0, 20000, 120000, 4),
(29, 3, '2018-07-03', 201, 0, 50000, 200000, 4),
(30, 5, '2018-07-03', 201, 0, 50000, 150000, 4),
(31, 7, '2018-07-03', 201, 0, 20000, 220000, 4),
(32, 9, '2018-07-03', 201, 0, 20000, 120000, 4),
(33, 11, '2018-07-03', 201, 0, 20000, 220000, 5),
(34, 12, '2018-07-03', 201, 0, 30000, 230000, 5),
(35, 13, '2018-07-03', 201, 0, 25000, 175000, 5),
(36, 15, '2018-07-03', 201, 0, 10000, 110000, 5),
(37, 16, '2018-07-03', 201, 0, 10000, 160000, 5),
(38, 18, '2018-07-03', 201, 0, 10000, 110000, 5),
(39, 19, '2018-07-03', 201, 0, 20000, 170000, 5),
(40, 20, '2018-07-03', 201, 0, 10000, 160000, 5),
(41, 22, '2018-07-03', 201, 0, 20000, 120000, 7),
(42, 23, '2018-07-03', 201, 0, 10000, 210000, 7),
(43, 24, '2018-07-03', 201, 0, 20000, 220000, 7),
(44, 26, '2018-07-03', 201, 0, 10000, 160000, 7),
(45, 1, '2018-07-04', 201, 0, 10000, 130000, 4),
(46, 2, '2018-07-04', 201, 0, 10000, 160000, 4),
(47, 3, '2018-07-04', 201, 0, 20000, 220000, 4),
(48, 4, '2018-07-04', 201, 0, 10000, 110000, 4),
(49, 5, '2018-07-04', 201, 0, 20000, 170000, 4),
(50, 6, '2018-07-04', 201, 0, 30000, 180000, 4),
(51, 7, '2018-07-04', 201, 0, 10000, 230000, 4),
(52, 8, '2018-07-04', 201, 0, 10000, 110000, 4),
(53, 9, '2018-07-04', 201, 0, 20000, 140000, 4),
(54, 10, '2018-07-04', 201, 0, 20000, 170000, 4),
(55, 11, '2018-07-04', 201, 0, 20000, 240000, 5),
(56, 12, '2018-07-04', 201, 0, 10000, 240000, 5),
(57, 13, '2018-07-04', 201, 0, 30000, 205000, 5),
(58, 14, '2018-07-04', 201, 0, 20000, 220000, 5),
(59, 15, '2018-07-04', 201, 0, 10000, 120000, 5),
(60, 16, '2018-07-04', 201, 0, 20000, 180000, 5),
(61, 17, '2018-07-04', 201, 0, 20000, 120000, 5),
(62, 18, '2018-07-04', 201, 0, 10000, 120000, 5),
(63, 19, '2018-07-04', 201, 0, 30000, 200000, 5),
(64, 20, '2018-07-04', 201, 0, 50000, 210000, 5),
(65, 21, '2018-07-04', 201, 0, 20000, 120000, 7),
(66, 22, '2018-07-04', 201, 0, 15000, 135000, 7),
(67, 23, '2018-07-04', 201, 0, 25000, 235000, 7),
(68, 24, '2018-07-04', 201, 0, 20000, 240000, 7),
(69, 25, '2018-07-04', 201, 0, 10000, 210000, 7),
(70, 26, '2018-07-04', 201, 0, 20000, 180000, 7),
(71, 27, '2018-07-04', 201, 0, 10000, 110000, 7),
(72, 1, '2018-07-05', 201, 0, 10000, 140000, 4),
(73, 2, '2018-07-05', 201, 0, 20000, 180000, 4),
(74, 3, '2018-07-05', 201, 0, 20000, 240000, 4),
(75, 4, '2018-07-05', 201, 0, 10000, 120000, 4),
(76, 7, '2018-07-05', 201, 0, 20000, 250000, 4),
(77, 8, '2018-07-05', 201, 0, 10000, 120000, 4),
(78, 9, '2018-07-05', 201, 0, 20000, 160000, 4),
(79, 10, '2018-07-05', 201, 0, 10000, 180000, 4),
(80, 11, '2018-07-05', 201, 0, 10000, 250000, 5),
(81, 12, '2018-07-05', 201, 0, 10000, 250000, 5),
(82, 13, '2018-07-05', 201, 0, 10000, 215000, 5),
(83, 14, '2018-07-05', 201, 0, 10000, 230000, 5),
(84, 15, '2018-07-05', 201, 0, 10000, 130000, 5),
(85, 16, '2018-07-05', 201, 0, 10000, 190000, 5),
(86, 17, '2018-07-05', 201, 0, 20000, 140000, 5),
(87, 18, '2018-07-05', 201, 0, 20000, 140000, 5),
(88, 19, '2018-07-05', 201, 0, 20000, 220000, 5),
(89, 20, '2018-07-05', 201, 0, 10000, 220000, 5),
(90, 21, '2018-07-05', 201, 0, 10000, 130000, 7),
(91, 22, '2018-07-05', 201, 0, 30000, 165000, 7),
(92, 23, '2018-07-05', 201, 0, 30000, 265000, 7),
(93, 24, '2018-07-05', 201, 0, 20000, 260000, 7),
(94, 25, '2018-07-05', 201, 0, 10000, 220000, 7),
(95, 26, '2018-07-05', 201, 0, 10000, 190000, 7),
(96, 27, '2018-07-05', 201, 0, 50000, 160000, 7),
(97, 1, '2018-07-06', 201, 0, 50000, 190000, 4),
(98, 2, '2018-07-06', 201, 0, 20000, 200000, 4),
(99, 3, '2018-07-06', 201, 0, 20000, 260000, 4),
(100, 4, '2018-07-06', 201, 0, 50000, 170000, 4),
(101, 6, '2018-07-06', 201, 0, 20000, 200000, 4),
(102, 7, '2018-07-06', 201, 0, 20000, 270000, 4),
(103, 8, '2018-07-06', 201, 0, 20000, 140000, 4),
(104, 9, '2018-07-06', 201, 0, 20000, 180000, 4),
(105, 10, '2018-07-06', 201, 0, 20000, 200000, 4),
(106, 11, '2018-07-06', 201, 0, 20000, 270000, 5),
(107, 12, '2018-07-06', 201, 0, 30000, 280000, 5),
(108, 13, '2018-07-06', 201, 0, 20000, 235000, 5),
(109, 14, '2018-07-06', 201, 0, 30000, 260000, 5),
(110, 15, '2018-07-06', 201, 0, 30000, 160000, 5),
(111, 16, '2018-07-06', 201, 0, 30000, 220000, 5),
(112, 17, '2018-07-06', 201, 0, 30000, 170000, 5),
(113, 23, '2018-07-06', 201, 0, 20000, 285000, 7),
(114, 25, '2018-07-06', 201, 0, 30000, 250000, 7),
(115, 26, '2018-07-06', 201, 0, 20000, 210000, 7),
(116, 27, '2018-07-06', 201, 0, 30000, 190000, 7),
(117, 1, '2018-07-09', 201, 0, 20000, 210000, 4),
(118, 2, '2018-07-09', 201, 0, 10000, 210000, 4),
(119, 3, '2018-07-09', 201, 0, 10000, 270000, 4),
(120, 4, '2018-07-09', 201, 0, 20000, 190000, 4),
(121, 5, '2018-07-09', 201, 0, 20000, 190000, 4),
(122, 6, '2018-07-09', 201, 0, 20000, 220000, 4),
(123, 7, '2018-07-09', 201, 0, 20000, 290000, 4),
(124, 8, '2018-07-09', 201, 0, 20000, 160000, 4),
(125, 9, '2018-07-09', 201, 0, 20000, 200000, 4),
(126, 10, '2018-07-09', 201, 0, 10000, 210000, 4),
(127, 11, '2018-07-09', 201, 0, 10000, 280000, 5),
(128, 12, '2018-07-09', 201, 0, 20000, 300000, 5),
(129, 13, '2018-07-09', 201, 0, 30000, 265000, 5),
(130, 14, '2018-07-09', 201, 0, 10000, 270000, 5),
(131, 15, '2018-07-09', 201, 0, 50000, 210000, 5),
(132, 16, '2018-07-09', 201, 0, 30000, 250000, 5),
(133, 17, '2018-07-09', 201, 0, 20000, 190000, 5),
(134, 18, '2018-07-09', 201, 0, 20000, 160000, 5),
(135, 19, '2018-07-09', 201, 0, 20000, 240000, 5),
(136, 20, '2018-07-09', 201, 0, 30000, 250000, 5),
(137, 21, '2018-07-09', 201, 0, 10000, 140000, 7),
(138, 22, '2018-07-09', 201, 0, 50000, 215000, 7),
(139, 23, '2018-07-09', 201, 0, 10000, 295000, 7),
(140, 24, '2018-07-09', 201, 0, 10000, 270000, 7),
(141, 25, '2018-07-09', 201, 0, 20000, 270000, 7),
(142, 26, '2018-07-09', 201, 0, 30000, 240000, 7),
(143, 27, '2018-07-09', 201, 0, 30000, 220000, 7),
(144, 1, '2018-07-10', 201, 0, 20000, 230000, 4),
(145, 2, '2018-07-10', 201, 0, 20000, 230000, 4),
(146, 3, '2018-07-10', 201, 0, 30000, 300000, 4),
(147, 5, '2018-07-10', 201, 0, 10000, 200000, 4),
(148, 6, '2018-07-10', 201, 0, 10000, 230000, 4),
(149, 7, '2018-07-10', 201, 0, 20000, 310000, 4),
(150, 10, '2018-07-10', 201, 0, 20000, 230000, 4),
(151, 11, '2018-07-10', 201, 0, 20000, 300000, 5),
(152, 12, '2018-07-10', 201, 0, 20000, 320000, 5),
(153, 13, '2018-07-10', 201, 0, 20000, 285000, 5),
(154, 15, '2018-07-10', 201, 0, 20000, 230000, 5),
(155, 16, '2018-07-10', 201, 0, 30000, 280000, 5),
(156, 19, '2018-07-10', 201, 0, 20000, 260000, 5),
(157, 20, '2018-07-10', 201, 0, 30000, 280000, 5),
(158, 23, '2018-07-10', 201, 0, 30000, 325000, 7),
(159, 24, '2018-07-10', 201, 0, 10000, 280000, 7),
(160, 25, '2018-07-10', 201, 0, 20000, 290000, 7),
(161, 26, '2018-07-10', 201, 0, 30000, 270000, 7),
(162, 27, '2018-07-10', 201, 0, 20000, 240000, 7),
(163, 1, '2018-07-11', 201, 0, 50000, 280000, 4),
(164, 2, '2018-07-11', 201, 0, 20000, 250000, 4),
(165, 3, '2018-07-11', 201, 0, 30000, 330000, 4),
(166, 4, '2018-07-11', 201, 0, 30000, 220000, 4),
(167, 5, '2018-07-11', 201, 0, 30000, 230000, 4),
(168, 6, '2018-07-11', 201, 0, 30000, 260000, 4),
(169, 7, '2018-07-11', 201, 0, 30000, 340000, 4),
(170, 8, '2018-07-11', 201, 0, 30000, 190000, 4),
(171, 9, '2018-07-11', 201, 0, 30000, 230000, 4),
(172, 10, '2018-07-11', 201, 0, 50000, 280000, 4),
(173, 11, '2018-07-11', 201, 0, 50000, 350000, 5),
(174, 12, '2018-07-11', 201, 0, 20000, 340000, 5),
(175, 13, '2018-07-11', 201, 0, 20000, 305000, 5),
(176, 14, '2018-07-11', 201, 0, 50000, 320000, 5),
(177, 15, '2018-07-11', 201, 0, 30000, 260000, 5),
(178, 16, '2018-07-11', 201, 0, 30000, 310000, 5),
(179, 17, '2018-07-11', 201, 0, 50000, 240000, 5),
(180, 18, '2018-07-11', 201, 0, 30000, 190000, 5),
(181, 19, '2018-07-11', 201, 0, 30000, 290000, 5),
(182, 20, '2018-07-11', 201, 0, 50000, 330000, 5),
(183, 21, '2018-07-11', 201, 0, 50000, 190000, 7),
(184, 22, '2018-07-11', 201, 0, 30000, 245000, 7),
(185, 23, '2018-07-11', 201, 0, 30000, 355000, 7),
(186, 24, '2018-07-11', 201, 0, 30000, 310000, 7),
(187, 25, '2018-07-11', 201, 0, 30000, 320000, 7),
(188, 26, '2018-07-11', 201, 0, 30000, 300000, 7),
(189, 27, '2018-07-11', 201, 0, 30000, 270000, 7),
(190, 1, '2018-07-12', 201, 0, 10000, 290000, 4),
(191, 2, '2018-07-12', 201, 0, 10000, 260000, 4),
(192, 3, '2018-07-12', 201, 0, 30000, 360000, 4),
(193, 4, '2018-07-12', 201, 0, 10000, 230000, 4),
(194, 5, '2018-07-12', 201, 0, 50000, 280000, 4),
(195, 6, '2018-07-12', 201, 0, 50000, 310000, 4),
(196, 7, '2018-07-12', 201, 0, 50000, 390000, 4),
(197, 8, '2018-07-12', 201, 0, 30000, 220000, 4),
(198, 9, '2018-07-12', 201, 0, 50000, 280000, 4),
(199, 10, '2018-07-12', 201, 0, 30000, 310000, 4),
(200, 11, '2018-07-12', 201, 0, 30000, 380000, 5),
(201, 12, '2018-07-12', 201, 0, 30000, 370000, 5),
(202, 13, '2018-07-12', 201, 0, 30000, 335000, 5),
(203, 14, '2018-07-12', 201, 0, 30000, 350000, 5),
(204, 15, '2018-07-12', 201, 0, 30000, 290000, 5),
(205, 16, '2018-07-12', 201, 0, 50000, 360000, 5),
(206, 17, '2018-07-12', 201, 0, 30000, 270000, 5),
(207, 18, '2018-07-12', 201, 0, 50000, 240000, 5),
(208, 19, '2018-07-12', 201, 0, 50000, 340000, 5),
(209, 20, '2018-07-12', 201, 0, 50000, 380000, 5),
(210, 22, '2018-07-12', 201, 0, 30000, 275000, 7),
(211, 23, '2018-07-12', 201, 0, 30000, 385000, 7),
(212, 24, '2018-07-12', 201, 0, 50000, 360000, 7),
(213, 25, '2018-07-12', 201, 0, 30000, 350000, 7),
(214, 26, '2018-07-12', 201, 0, 10000, 310000, 7),
(215, 27, '2018-07-12', 201, 0, 30000, 300000, 7),
(216, 1, '2018-07-13', 201, 0, 30000, 320000, 4),
(217, 4, '2018-07-13', 201, 0, 30000, 260000, 4),
(218, 5, '2018-07-13', 201, 0, 50000, 330000, 4),
(219, 6, '2018-07-13', 201, 0, 30000, 340000, 4),
(220, 7, '2018-07-13', 201, 0, 30000, 420000, 4),
(221, 8, '2018-07-13', 201, 0, 30000, 250000, 4),
(222, 9, '2018-07-13', 201, 0, 30000, 310000, 4),
(223, 10, '2018-07-13', 201, 0, 30000, 340000, 4),
(224, 11, '2018-07-13', 201, 0, 30000, 410000, 5),
(225, 12, '2018-07-13', 201, 0, 30000, 400000, 5),
(226, 14, '2018-07-13', 201, 0, 30000, 380000, 5),
(227, 16, '2018-07-13', 201, 0, 30000, 390000, 5),
(228, 22, '2018-07-13', 201, 0, 30000, 305000, 7),
(229, 23, '2018-07-13', 201, 0, 50000, 435000, 7),
(230, 24, '2018-07-13', 201, 0, 20000, 380000, 7),
(231, 25, '2018-07-13', 201, 0, 30000, 380000, 7),
(232, 26, '2018-07-13', 201, 0, 30000, 340000, 7),
(233, 27, '2018-07-13', 201, 0, 20000, 320000, 7),
(234, 1, '2018-08-14', 201, 0, 100000, 420000, 3),
(235, 1, '2018-08-14', 202, 500000, 0, -80000, 3),
(236, 2, '2018-08-14', 202, 100000, 0, 160000, 3),
(237, 2, '2018-08-14', 204, 0, 50000, 210000, 3),
(238, 9, '2018-08-14', 201, 0, 100000, 410000, 4),
(239, 9, '2018-08-14', 202, 50000, 0, 360000, 4),
(240, 2, '2019-06-04', 201, 0, 10000, 220000, 13),
(241, 1, '2019-06-04', 201, 0, 10000, -70000, 13),
(242, 2, '2019-06-04', 201, 0, 2000, 222000, 13),
(243, 2, '2019-06-04', 201, 0, 2000, 222000, 13),
(244, 2, '2019-06-04', 201, 0, 2000, 222000, 13),
(245, 2, '2019-06-04', 201, 0, 2000, 222000, 13),
(246, 2, '2019-06-04', 201, 0, 2000, 222000, 13),
(247, 2, '2019-06-04', 201, 0, 3000, 225000, 13),
(248, 3, '2019-06-04', 201, 0, 10000, 370000, 13),
(249, 2, '2019-06-04', 201, 0, 1000, 226000, 13),
(250, 3, '2019-06-04', 201, 0, 30000, 400000, 13),
(251, 2, '2019-06-04', 201, 0, 3000, 229000, 13),
(252, 2, '2019-06-04', 202, 29000, 0, 200000, 13),
(253, 3, '2019-06-04', 202, 100000, 0, 300000, 13),
(254, 3, '2019-06-04', 202, 100000, 0, 300000, 13),
(255, 3, '2019-06-05', 201, 0, 3000, 303000, 13),
(256, 4, '2019-06-05', 201, 0, 29000, 289000, 13),
(257, 4, '2019-06-05', 201, 0, 5000, 294000, 13),
(258, 2, '2019-06-19', 201, 0, 10000, 210000, 13),
(259, 2, '2019-06-19', 201, 0, 10000, 220000, 13),
(260, 2, '2019-06-19', 201, 0, 1000, 221000, 13),
(261, 2, '2019-06-19', 201, 0, 10000, 231000, 13),
(262, 2, '2019-06-19', 201, 0, 29000, 260000, 13),
(263, 2, '2019-06-19', 201, 0, 29000, 260000, 13),
(264, 2, '2019-06-19', 201, 0, 29000, 260000, 13),
(265, 2, '2019-06-19', 201, 0, 2000, 262000, 13),
(266, 2, '2019-06-19', 201, 0, 2000, 264000, 13),
(267, 2, '2019-06-19', 201, 0, 29000, 293000, 13),
(268, 2, '2019-06-19', 201, 0, 2000, 295000, 13),
(269, 5, '2019-06-19', 201, 0, 1000, 331000, 13),
(270, 2, '2019-06-19', 201, 0, 3000, 298000, 13),
(271, 2, '2019-06-20', 201, 0, 3000, 301000, 13),
(272, 5, '2019-06-20', 201, 0, 1000, 332000, 13),
(273, 2, '2019-06-20', 201, 0, 2000, 303000, 13),
(274, 2, '2019-06-20', 201, 0, 1000, 304000, 13),
(275, 3, '2019-06-20', 201, 0, 2000, 305000, 13),
(276, 4, '2019-06-20', 201, 0, 2000, 296000, 13),
(277, 2, '2019-06-20', 201, 0, 2000, 306000, 13),
(278, 3, '2019-06-20', 201, 0, 2000, 307000, 13),
(279, 3, '2019-06-20', 201, 0, 2000, 309000, 13),
(280, 2, '2019-06-20', 201, 0, 2000, 308000, 13),
(281, 3, '2019-06-20', 201, 0, 2000, 311000, 13),
(282, 1, '2019-06-20', 201, 0, 1000, -69000, 13),
(283, 2, '2019-06-20', 201, 0, 1000, 309000, 13),
(284, 2, '2019-06-20', 201, 0, 1000, 310000, 13),
(285, 3, '2019-06-20', 201, 0, 1000, 312000, 13),
(286, 3, '2019-06-20', 201, 0, 1000, 313000, 13),
(287, 3, '2019-06-20', 201, 0, 1000, 313000, 13),
(288, 2, '2019-06-20', 201, 0, 1000, 311000, 13),
(289, 2, '2019-06-20', 201, 0, 1000, 311000, 13),
(290, 2, '2019-06-20', 201, 0, 1000, 311000, 13),
(291, 2, '2019-06-20', 201, 0, 1000, 311000, 13),
(292, 2, '2019-06-20', 201, 0, 1000, 311000, 13),
(293, 2, '2019-06-20', 201, 0, 1000, 311000, 13),
(294, 2, '2019-06-20', 201, 0, 1000, 312000, 13),
(295, 5, '2019-06-20', 201, 0, 1000, 333000, 13),
(296, 4, '2019-06-20', 201, 0, 1000, 297000, 13),
(297, 21, '2019-06-20', 201, 0, 1000, 191000, 13),
(298, 4, '2019-06-20', 201, 0, 3000, 300000, 13),
(299, 4, '2019-06-20', 201, 0, 10000, 310000, 13),
(300, 5, '2019-06-23', 201, 0, 10000, 343000, 13),
(301, 14, '2019-06-23', 201, 0, 10000, 390000, 13),
(302, 26, '2019-06-23', 201, 0, 3000, 343000, 13),
(303, 28, '2019-06-23', 201, 0, 1000, 1000, 13),
(304, 28, '2019-06-23', 201, 0, 1000, 2000, 13),
(305, 28, '2019-06-23', 201, 0, 30000, 32000, 13),
(306, 21, '2019-06-23', 201, 0, 1000, 192000, 13),
(307, 28, '2019-06-23', 201, 0, 3000, 35000, 13),
(308, 27, '2019-06-24', 201, 0, 3000, 323000, 13),
(309, 27, '2019-06-30', 201, 0, 1000, 324000, 13),
(310, 27, '2019-06-30', 201, 0, 1000, 324000, 13),
(311, 27, '2019-06-30', 201, 0, 1000, 324000, 13),
(312, 27, '2019-06-30', 201, 0, 1000, 324000, 13),
(313, 27, '2019-06-30', 201, 0, 1000, 324000, 13),
(314, 27, '2019-06-30', 201, 0, 1000, 324000, 13),
(315, 1, '2019-06-30', 201, 0, 5000, -64000, 13),
(316, 3, '2019-06-30', 201, 0, 3000, 316000, 13),
(317, 28, '2019-06-30', 201, 0, 10000, 45000, 13),
(318, 4, '2019-06-30', 201, 0, 10000, 320000, 13),
(319, 28, '2019-07-18', 201, 0, 2000, 47000, 13),
(320, 4, '2019-07-27', 201, 0, 29000, 349000, 13),
(321, 2, '2019-07-27', 201, 0, 1000, 313000, 13),
(322, 2, '2019-08-04', 202, 300000, 0, 13000, 13),
(323, 2, '2019-08-04', 201, 0, 2000, 15000, 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tutup_buku`
--

CREATE TABLE `tb_tutup_buku` (
  `id_tutup_buku` int(11) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_tutup_buku`
--

INSERT INTO `tb_tutup_buku` (`id_tutup_buku`, `tgl_awal`, `tgl_akhir`) VALUES
(1, '2019-06-20', '2019-06-24'),
(2, '2019-06-30', '2019-07-20'),
(3, '2019-07-27', '2019-07-27'),
(4, '2019-07-27', '2019-07-27'),
(5, '2019-08-04', '2019-08-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('Ketua','Admin','Kolektor','Bagian Tabungan','Bagian Kredit','Nasabah') NOT NULL,
  `kode_user` varchar(3) NOT NULL,
  `st` enum('Aktif','Tidak Aktif') NOT NULL,
  `kd_reset` varchar(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `id_nasabah`, `username`, `password`, `level`, `kode_user`, `st`, `kd_reset`) VALUES
(1, 1, 'ketua', '202cb962ac59075b964b07152d234b70', 'Ketua', '-', 'Aktif', 'eghb9f'),
(2, 2, 'admin', '202cb962ac59075b964b07152d234b70', 'Admin', 'ADM', 'Aktif', 'w8jvi9'),
(3, 3, 'kolektor', '202cb962ac59075b964b07152d234b70', 'Kolektor', 'BT', 'Aktif', ''),
(13, 13, 'batab', '202cb962ac59075b964b07152d234b70', 'Bagian Tabungan', '-', 'Aktif', 'ibtupb'),
(4, 4, 'bakre', '202cb962ac59075b964b07152d234b70', 'Bagian Kredit', 'AD', 'Aktif', 'be0ti2'),
(15, 15, 'nasabah', '202cb962ac59075b964b07152d234b70', 'Nasabah', '-', 'Aktif', ''),
(16, 16, '5107044502980002', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(5, 5, 'yosep', '827ccb0eea8a706c4c34a16891f84e7b', 'Kolektor', 'YO', 'Aktif', ''),
(6, 6, 'diva', '827ccb0eea8a706c4c34a16891f84e7b', 'Bagian Kredit', '-', 'Aktif', ''),
(7, 7, 'maha', '827ccb0eea8a706c4c34a16891f84e7b', 'Kolektor', 'MP', 'Tidak Aktif', ''),
(8, 8, '5103066704980010', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(9, 9, '5103022204970589', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(10, 10, '5107065709970001', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(11, 11, '5107062709978401', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(12, 12, '5102030704970145', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(14, 14, '5107066308960003', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(17, 17, '5107051210960568', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(18, 18, '5102030644978741', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(19, 19, '5107012310945101', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(20, 20, '5107062709967116', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(21, 21, '5107062709967801', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(22, 22, '5107062899964461', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(23, 23, '5107056310971241', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(24, 24, '5103022207830004', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(25, 25, '5107062709964731', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(26, 26, '5107062709867116', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(27, 27, '5107062709965475', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(28, 28, '5107056310964111', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(29, 29, '5107062709961475', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(30, 30, '5107056310961241', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(31, 31, '5107062709960009', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(32, 32, '5107062709964879', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(33, 33, '5107062709964501', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(34, 34, '5107062709990045', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(35, 35, '5107062709988901', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(36, 36, '5103022204980014', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', ''),
(878, 8789, 'ketut', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Ketua', '435', 'Aktif', '656'),
(8789898, 8789, 'ketut', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Ketua', '435', 'Aktif', '656'),
(76238472, 61312314, 'ketut', '12345678', 'Ketua', '8', 'Aktif', '713981'),
(76238473, 37, '5104061005970005', '827ccb0eea8a706c4c34a16891f84e7b', 'Nasabah', '-', 'Aktif', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD PRIMARY KEY (`id_jenis_transasksi`);

--
-- Indexes for table `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `tb_biaya`
--
ALTER TABLE `tb_biaya`
  ADD PRIMARY KEY (`id_biaya`);

--
-- Indexes for table `tb_buku_besar`
--
ALTER TABLE `tb_buku_besar`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tb_bungatabungan`
--
ALTER TABLE `tb_bungatabungan`
  ADD PRIMARY KEY (`id_bunga`);

--
-- Indexes for table `tb_jns_simpanan`
--
ALTER TABLE `tb_jns_simpanan`
  ADD PRIMARY KEY (`id_simpanan`);

--
-- Indexes for table `tb_jurnal`
--
ALTER TABLE `tb_jurnal`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_tutup_buku` (`id_tutup_buku`),
  ADD KEY `id_tutup_buku_2` (`id_tutup_buku`);

--
-- Indexes for table `tb_jurnal_detail`
--
ALTER TABLE `tb_jurnal_detail`
  ADD PRIMARY KEY (`id_jurnal_detail`),
  ADD KEY `id_jurnal` (`id_jurnal`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `tb_kas`
--
ALTER TABLE `tb_kas`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indexes for table `tb_kredit`
--
ALTER TABLE `tb_kredit`
  ADD PRIMARY KEY (`id_kredit`);

--
-- Indexes for table `tb_link_akun`
--
ALTER TABLE `tb_link_akun`
  ADD PRIMARY KEY (`id_link_akun`);

--
-- Indexes for table `tb_nasabah`
--
ALTER TABLE `tb_nasabah`
  ADD PRIMARY KEY (`id_nasabah`);

--
-- Indexes for table `tb_pendapatan`
--
ALTER TABLE `tb_pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`);

--
-- Indexes for table `tb_reknasabah`
--
ALTER TABLE `tb_reknasabah`
  ADD PRIMARY KEY (`id_reknasabah`);

--
-- Indexes for table `tb_trx_angsuran`
--
ALTER TABLE `tb_trx_angsuran`
  ADD PRIMARY KEY (`id_trx_angsuran`);

--
-- Indexes for table `tb_trx_biaya`
--
ALTER TABLE `tb_trx_biaya`
  ADD PRIMARY KEY (`id_trx`);

--
-- Indexes for table `tb_trx_pendapatan`
--
ALTER TABLE `tb_trx_pendapatan`
  ADD PRIMARY KEY (`id_trx`);

--
-- Indexes for table `tb_trx_pinjaman`
--
ALTER TABLE `tb_trx_pinjaman`
  ADD PRIMARY KEY (`id_trx`);

--
-- Indexes for table `tb_trx_simpanan`
--
ALTER TABLE `tb_trx_simpanan`
  ADD PRIMARY KEY (`id_trx`);

--
-- Indexes for table `tb_trx_simpanan_det`
--
ALTER TABLE `tb_trx_simpanan_det`
  ADD PRIMARY KEY (`id_trx_simpanan_det`);

--
-- Indexes for table `tb_trx_tabungan`
--
ALTER TABLE `tb_trx_tabungan`
  ADD PRIMARY KEY (`id_trx`);

--
-- Indexes for table `tb_tutup_buku`
--
ALTER TABLE `tb_tutup_buku`
  ADD PRIMARY KEY (`id_tutup_buku`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  MODIFY `id_jenis_transasksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_bungatabungan`
--
ALTER TABLE `tb_bungatabungan`
  MODIFY `id_bunga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_jns_simpanan`
--
ALTER TABLE `tb_jns_simpanan`
  MODIFY `id_simpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_jurnal_detail`
--
ALTER TABLE `tb_jurnal_detail`
  MODIFY `id_jurnal_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tb_kas`
--
ALTER TABLE `tb_kas`
  MODIFY `id_kas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;

--
-- AUTO_INCREMENT for table `tb_kredit`
--
ALTER TABLE `tb_kredit`
  MODIFY `id_kredit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_link_akun`
--
ALTER TABLE `tb_link_akun`
  MODIFY `id_link_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_trx_angsuran`
--
ALTER TABLE `tb_trx_angsuran`
  MODIFY `id_trx_angsuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_trx_biaya`
--
ALTER TABLE `tb_trx_biaya`
  MODIFY `id_trx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_trx_pendapatan`
--
ALTER TABLE `tb_trx_pendapatan`
  MODIFY `id_trx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_trx_pinjaman`
--
ALTER TABLE `tb_trx_pinjaman`
  MODIFY `id_trx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_trx_simpanan`
--
ALTER TABLE `tb_trx_simpanan`
  MODIFY `id_trx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_trx_simpanan_det`
--
ALTER TABLE `tb_trx_simpanan_det`
  MODIFY `id_trx_simpanan_det` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_trx_tabungan`
--
ALTER TABLE `tb_trx_tabungan`
  MODIFY `id_trx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76238474;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
