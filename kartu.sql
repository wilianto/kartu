-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 24, 2015 at 02:02 AM
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
(1, 1, 'transaksi'),
(2, 1, 'saldo');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `auth_key`, `access_token`, `user_type`) VALUES
(1, 'wilianto', '0192023a7bbd73250516f069df18b500', NULL, NULL, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
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
-- AUTO_INCREMENT for table `kartu`
--
ALTER TABLE `kartu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

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
