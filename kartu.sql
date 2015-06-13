-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 13, 2015 at 05:34 AM
-- Server version: 5.5.40
-- PHP Version: 5.4.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kartu`
--

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE IF NOT EXISTS `counter` (
`id` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `tipe` varchar(16) NOT NULL COMMENT 'transaksi, saldo'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`id`, `no`, `tipe`) VALUES
(1, 10, 'transaksi'),
(2, 14, 'saldo');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE IF NOT EXISTS `detail_transaksi` (
`id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `nama` varchar(200) NOT NULL,
  `harga` decimal(16,2) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
`id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` decimal(16,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kartu`
--

CREATE TABLE IF NOT EXISTS `kartu` (
`id` int(11) NOT NULL,
  `no_kartu` varchar(32) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(32) NOT NULL,
  `saldo` decimal(16,2) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kartu`
--

INSERT INTO `kartu` (`id`, `no_kartu`, `tgl_daftar`, `nama`, `alamat`, `no_tlp`, `saldo`, `user_id`) VALUES
(3, '1234567890', '2015-05-27', 'Wilianto Indrawan ST', 'Taman Kopo Indah', '08562288023', '63000.00', 1),
(4, '123456789', '2015-05-27', 'Vinsensius Kevin', 'Taman Kopo Indah 1', '0225419204', '12000.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
`id` int(11) NOT NULL,
  `no` varchar(10) NOT NULL,
  `tgl` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `kartu_id` int(11) NOT NULL,
  `nominal` decimal(16,2) NOT NULL,
  `saldo_awal` decimal(16,2) NOT NULL,
  `keterangan` text NOT NULL,
  `tipe` varchar(16) NOT NULL COMMENT 'transaksi, saldo'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `no`, `tgl`, `user_id`, `kartu_id`, `nominal`, `saldo_awal`, `keterangan`, `tipe`) VALUES
(1, 'S000000001', '2015-05-27', 1, 3, '2000.00', '100000.00', 'Saldo awal', 'saldo'),
(3, 'S000000003', '2015-05-27', 1, 4, '50000.00', '10000.00', 'Cek n ricek', 'saldo'),
(4, 'S000000004', '2015-05-27', 1, 4, '2000.00', '60000.00', '', 'saldo'),
(5, 'S000000006', '2015-05-27', 1, 4, '1000.00', '62000.00', '', 'saldo'),
(7, 'T000000002', '2015-05-27', 1, 3, '2000.00', '102000.00', '', 'transaksi'),
(8, 'S000000007', '2015-05-27', 1, 4, '50000.00', '63000.00', '', 'saldo'),
(9, 'T000000003', '2015-05-27', 1, 3, '50000.00', '100000.00', '', 'transaksi'),
(10, 'T000000004', '2015-05-27', 1, 4, '100000.00', '113000.00', '', 'transaksi'),
(11, 'S000000008', '2015-05-29', 2, 3, '3000.00', '50000.00', '', 'saldo'),
(12, 'T000000005', '2015-05-29', 2, 3, '50000.00', '53000.00', '', 'transaksi'),
(13, 'S000000010', '2015-05-29', 1, 3, '50000.00', '3000.00', '', 'saldo'),
(14, 'S000000013', '2015-05-29', 1, 3, '10000.00', '53000.00', '', 'saldo'),
(15, 'T000000006', '2015-05-29', 1, 4, '1000.00', '13000.00', '', 'transaksi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `auth_key` varchar(128) DEFAULT NULL,
  `access_token` varchar(128) DEFAULT NULL,
  `user_type` varchar(16) NOT NULL COMMENT 'blokir, admin, operator '
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `auth_key`, `access_token`, `user_type`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', NULL, NULL, 'admin'),
(2, 'operator', '0192023a7bbd73250516f069df18b500', NULL, NULL, 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
 ADD PRIMARY KEY (`id`), ADD KEY `transaksi_id` (`transaksi_id`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kartu`
--
ALTER TABLE `kartu`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `no_kartu` (`no_kartu`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `no` (`no`), ADD KEY `user_id` (`user_id`), ADD KEY `kartu_id` (`kartu_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kartu`
--
ALTER TABLE `kartu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
ADD CONSTRAINT `FK_Detail_Item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `FK_Detail_Transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kartu`
--
ALTER TABLE `kartu`
ADD CONSTRAINT `FK_Kartu_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
ADD CONSTRAINT `FK_Transaksi_Kartu` FOREIGN KEY (`kartu_id`) REFERENCES `kartu` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `FK_Transaksi_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
