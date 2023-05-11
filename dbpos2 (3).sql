-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 11, 2023 at 12:45 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpos2`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_produk`
--

CREATE TABLE `jenis_produk` (
  `id` int NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `jenis_produk`
--

INSERT INTO `jenis_produk` (`id`, `nama`) VALUES
(1, 'elektronik'),
(2, 'furniture'),
(3, 'makanan'),
(4, 'minuman'),
(5, 'komputer');

-- --------------------------------------------------------

--
-- Table structure for table `kartu`
--

CREATE TABLE `kartu` (
  `id` int NOT NULL,
  `kode` varchar(6) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `iuran` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `kartu`
--

INSERT INTO `kartu` (`id`, `kode`, `nama`, `diskon`, `iuran`) VALUES
(6, 'K001', 'Platinum', 20, 300000),
(7, 'K002', 'Gold', 15, 200);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int NOT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nama_pelanggan` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `jk` char(1) DEFAULT NULL,
  `tmp_lahir` varchar(30) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `kartu_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `kode`, `nama_pelanggan`, `jk`, `tmp_lahir`, `tgl_lahir`, `email`, `kartu_id`) VALUES
(17, 'A001', 'Rama test', 'L', 'jakarta', '2001-01-01', 'rama@gmail.com', 6),
(19, 'A002', 'Alfin', 'L', 'Jakarta', '2001-12-31', 'alfinrama1@gmail.com', 7);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `nokuitansi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah_bayar` double DEFAULT NULL,
  `jumlah_pemesanan` int DEFAULT NULL,
  `pesanan_id` int NOT NULL,
  `status_pembayaran` varchar(100) DEFAULT 'Belum Lunas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int NOT NULL,
  `tanggal` varchar(45) DEFAULT NULL,
  `nomor` varchar(10) DEFAULT NULL,
  `produk_id` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `vendor_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `tanggal`, `nomor`, `produk_id`, `jumlah`, `harga`, `vendor_id`) VALUES
(1, '2019-10-10', 'P001', 1, 2, 3500000, 1),
(2, '2019-11-20', 'P002', 2, 5, 5500000, 2),
(3, '2019-12-12', 'P003', 2, 5, 5400000, 1),
(4, '2020-01-20', 'P004', 7, 200, 1800, 3),
(5, '2020-01-20', 'P005', 5, 100, 2300, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int NOT NULL,
  `tanggal` date DEFAULT NULL,
  `total` double DEFAULT NULL,
  `pelanggan_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `tanggal`, `total`, `pelanggan_id`) VALUES
(144, '2023-04-27', 200000, 17);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_items`
--

CREATE TABLE `pesanan_items` (
  `id` int NOT NULL,
  `produk_id` int NOT NULL,
  `pesanan_id` int NOT NULL,
  `qty` int DEFAULT NULL,
  `harga` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Stand-in structure for view `pesanan_produk_vw`
-- (See below for the actual view)
--
CREATE TABLE `pesanan_produk_vw` (
`pesanan_id` int
,`tanggal` date
,`pelanggan_kode` varchar(10)
,`nama_pelanggan` varchar(45)
,`produk_kode` varchar(10)
,`nama_produk` varchar(45)
,`qty` int
,`harga_jual` double
,`total_harga` double
);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `harga_beli` double DEFAULT NULL,
  `harga_jual` double DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `min_stok` int DEFAULT NULL,
  `jenis_produk_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode`, `nama`, `harga_beli`, `harga_jual`, `stok`, `min_stok`, `jenis_produk_id`) VALUES
(1, 'TV01', 'Televisi 21 inch', 3500000, 5040000, 5, 2, 1),
(2, 'TV02', 'Televisi 40 inch', 5500000, 7440000, 4, 2, 1),
(3, 'K001', 'Kulkas 2 pintu', 3500000, 4680000, 6, 2, 1),
(4, 'M001', 'Meja Makan', 500000, 600000, 4, 3, 2),
(5, 'TK01', 'Teh Kotak', 3000, 3500, 6, 10, 4),
(6, 'PC01', 'PC Desktop HP', 7000000, 9600000, 9, 2, 5),
(7, 'TB01', 'Teh Botol', 2000, 2500, 53, 10, 4),
(8, 'AC01', 'Notebook Acer', 8000000, 10800000, 7, 2, 5),
(9, 'LN01', 'Notebook Lenovo', 9000000, 12000000, 9, 2, 5),
(10, 'L004', 'Laptop HP', 12000000, 13000000, 20, 5, 5),
(11, 'L002', 'Laptop ASUS', 10000000, 15000000, 50, 10, 5),
(13, 'L003', 'Laptop ACER', 10000000, 15000000, 50, 10, 5),
(14, 'L005', 'Laptop MAC', 10000000, 15000000, 50, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$l4i/sQwkn7ct7P2TkPOTseCEb0jUrK8zYrAax0NUrVrhWEptsCleq'),
(2, 'test', 'test@gmail.com', '$2y$10$ul4hED9e6fYG72qJd3Iloem3k1d8.HKlY992b5rIn9vOaVTPXTZUa');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int NOT NULL,
  `nomor` varchar(4) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `kota` varchar(30) DEFAULT NULL,
  `kontak` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `nomor`, `nama`, `kota`, `kontak`) VALUES
(1, 'V001', 'PT Guna Samudra', 'Surabaya', 'Ali Nurdin'),
(2, 'V002', 'PT Pondok C9', 'Depok', 'Putri Ramadhani'),
(3, 'V003', 'CV Jaya Raya Semesta', 'Jakarta', 'Dwi Rahayu'),
(4, 'V004', 'PT Lekulo X', 'Kebumen', 'Mbambang G'),
(5, 'V005', 'PT IT Prima', 'Jakarta', 'David W');

-- --------------------------------------------------------

--
-- Structure for view `pesanan_produk_vw`
--
DROP TABLE IF EXISTS `pesanan_produk_vw`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pesanan_produk_vw`  AS SELECT `pesanan`.`id` AS `pesanan_id`, `pesanan`.`tanggal` AS `tanggal`, `pelanggan`.`kode` AS `pelanggan_kode`, `pelanggan`.`nama_pelanggan` AS `nama_pelanggan`, `produk`.`kode` AS `produk_kode`, `produk`.`nama` AS `nama_produk`, `pesanan_items`.`qty` AS `qty`, `produk`.`harga_jual` AS `harga_jual`, sum((`pesanan_items`.`qty` * `pesanan_items`.`harga`)) AS `total_harga` FROM (((`pesanan` join `pelanggan` on((`pesanan`.`pelanggan_id` = `pelanggan`.`id`))) join `pesanan_items` on((`pesanan`.`id` = `pesanan_items`.`pesanan_id`))) join `produk` on((`pesanan_items`.`produk_id` = `produk`.`id`))) GROUP BY `pesanan`.`id`, `produk`.`id`, `pesanan_items`.`id`, `pelanggan`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_produk`
--
ALTER TABLE `jenis_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kartu`
--
ALTER TABLE `kartu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_UNIQUE` (`kode`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pelanggan_kartu1_idx` (`kartu_id`) USING BTREE;

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nokuitansi_UNIQUE` (`nokuitansi`),
  ADD KEY `fk_pembayaran_pesanan1_idx` (`pesanan_id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_UNIQUE` (`nomor`),
  ADD KEY `produk_id` (`produk_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pesanan_customer_idx` (`pelanggan_id`);

--
-- Indexes for table `pesanan_items`
--
ALTER TABLE `pesanan_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pesanan_items_pesanan1_idx` (`pesanan_id`),
  ADD KEY `fk_pesanan_items_produk1_idx` (`produk_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_UNIQUE` (`kode`),
  ADD KEY `fk_produk_jenis_produk1_idx` (`jenis_produk_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor` (`nomor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_produk`
--
ALTER TABLE `jenis_produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kartu`
--
ALTER TABLE `kartu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `pesanan_items`
--
ALTER TABLE `pesanan_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`kartu_id`) REFERENCES `kartu` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan_items`
--
ALTER TABLE `pesanan_items`
  ADD CONSTRAINT `fk_pesanan_items_pesanan1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`),
  ADD CONSTRAINT `fk_pesanan_items_produk1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_produk_jenis_produk1` FOREIGN KEY (`jenis_produk_id`) REFERENCES `jenis_produk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
