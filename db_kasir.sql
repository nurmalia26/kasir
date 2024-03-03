-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Feb 2024 pada 07.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail`
--

CREATE TABLE `tbl_detail` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_produk` varchar(7) NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_detail`
--

INSERT INTO `tbl_detail` (`id_detail`, `id_transaksi`, `id_produk`, `jumlah_produk`, `sub_total`) VALUES
(1, 1, 'BRG0001', 2, 300000.00),
(2, 1, 'BRG0002', 1, 150000.00),
(3, 2, '000003', 2, 24000.00),
(4, 2, '000002', 2, 36000.00),
(5, 3, '000003', 2, 24000.00),
(6, 3, '000002', 2, 36000.00),
(7, 4, '000009', 10, 150000.00),
(8, 4, 'BRG0001', 20, 3000000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_telpon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `nama`, `alamat`, `no_telpon`) VALUES
(1, 'Anton', 'jl. h. dul', '081231238123818'),
(2, 'David', 'Jl. Merpati', '081231238123819'),
(3, 'keisha', 'jl.rawageni', '0897554332'),
(4, 'keisha', 'jl.kencana', '0897554332');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` varchar(7) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `nama_produk`, `harga`, `stok`) VALUES
('000001', 'Meteran Karet uk.5meter', 8000.00, 0),
('000002', 'Amplas meteran Premium 4inch x 1 meter', 18000.00, 11),
('000003', 'Tang Kombinasi 7 inch', 12000.00, 6),
('000004', 'Semen Tiga Roda 1 SAK (50 KG)', 80000.00, 20),
('000005', 'Semen Merah Putih 1 SAK (40 KG)', 60000.00, 15),
('000006', 'Semen Holchim 1 SAK (50KG)', 85000.00, 50),
('000007', 'Benang Nylon Bangunan Besar 1 roll', 2500.00, 100),
('000008', 'Lem Fox', 10000.00, 12),
('000009', 'pasir 1 kg', 15000.00, 90),
('BRG0001', 'Cat Nippon Paint Blue ', 150000.00, 180),
('BRG0002', 'Cat Nippon Paint Red', 150000.00, 100),
('BRG0004', 'Cat Nippon Paint Yellow', 250000.00, 10),
('BRG0005', 'Cat Nippon Paint Black', 100000.00, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `id_pelanggan`, `id_user`, `tanggal`, `total_harga`) VALUES
(1, 1, 2, '2024-02-11', 200000.00),
(2, NULL, 10, '2024-02-17', 60000.00),
(3, NULL, 10, '2024-02-17', 60000.00),
(4, 4, 10, '2024-02-17', 3150000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','pegawai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama`, `username`, `password`, `role`) VALUES
(1, 'nurmalia', 'lia', '123', 'admin'),
(2, 'dwiananda', 'dwi', '123', 'pegawai'),
(3, 'Developer', 'dev', 'P@ssw0rd', 'admin'),
(4, 'syahla', 'ale', '12', 'pegawai'),
(9, 'khirani', 'lia', '89', 'pegawai'),
(10, 'syahla', 'ale', '123', 'pegawai');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_detail`
--
ALTER TABLE `tbl_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_detail`
--
ALTER TABLE `tbl_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
