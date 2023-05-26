-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2022 at 06:33 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek_aplin`
--
CREATE DATABASE IF NOT EXISTS `proyek_aplin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proyek_aplin`;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `ID_Barang` int(10) NOT NULL,
  `FK_ID_TIPE` int(10) NOT NULL,
  `Kode_Produksi` varchar(20) NOT NULL,
  `status` int(2) NOT NULL COMMENT '0= tidak tersedia 1=tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`ID_Barang`, `FK_ID_TIPE`, `Kode_Produksi`, `status`) VALUES
(10, 61, '87878787', 1),
(11, 62, '456456645', 1),
(12, 63, '456456', 1),
(13, 64, '4564564', 1),
(14, 65, '45687786', 1),
(15, 66, '45645654678', 1),
(16, 67, '4645645654', 1),
(17, 68, '64567886', 1),
(18, 69, '8767866678', 1),
(20, 61, '1375654', 1),
(28, 61, '1375654', 1);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan` (
  `ID_Karyawan` varchar(20) NOT NULL,
  `Nama_Karyawan` varchar(50) NOT NULL,
  `NomorTelepon_Karyawan` int(20) NOT NULL,
  `Username_Karyawan` varchar(50) NOT NULL,
  `Password_Karyawan` varchar(50) NOT NULL,
  `Jabatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`ID_Karyawan`, `Nama_Karyawan`, `NomorTelepon_Karyawan`, `Username_Karyawan`, `Password_Karyawan`, `Jabatan`) VALUES
('1', 'matthew', 823, 'matt', 'matts', '0'),
('2', 'Anno', 9876578, 'Ann', 'no', '1'),
('3', 'SADMIN', 47567654, 'admin', 'admins', '2');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE `subscription` (
  `ID_Subscription` int(10) NOT NULL,
  `Nama_Subscription` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`ID_Subscription`, `Nama_Subscription`) VALUES
(3, '3 Hari'),
(7, '7 Hari'),
(14, '14 Hari');

-- --------------------------------------------------------

--
-- Table structure for table `tipe`
--

DROP TABLE IF EXISTS `tipe`;
CREATE TABLE `tipe` (
  `ID_Tipe` int(10) NOT NULL,
  `Jenis` varchar(255) NOT NULL,
  `Model` varchar(70) NOT NULL,
  `Keterangan` varchar(500) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipe`
--

INSERT INTO `tipe` (`ID_Tipe`, `Jenis`, `Model`, `Keterangan`, `harga`, `gambar`) VALUES
(61, 'iPhone 11', 'iPhone', 'Layar : 6.1 inch Liquid Retina IPS LCD,Baterai : Li-Ion 3110 mAh,Prosesor : Apple A13 Bionic,Ram : 4gb', 10000, '1653031856.png'),
(62, 'iPhone 11 pro', 'iPhone', 'Layar : 5.8 inch inch Super Retina XDR OLED,Baterai : Li-Ion 3046 mAh,Prosesor : Apple A13 Bionic,Ram : 4gb', 15000, '1653031876.png'),
(63, 'iPhone 11 pro max', 'iPhone', 'Layar : 6.5 inch Super Retina XDR OLED,Baterai : Li-Ion 3969 mAh,Prosesor : Apple A13 Bionic,Ram : 4gb', 20000, '1653031898.png'),
(64, 'iPhone 12', 'iPhone', 'Layar : 6.1 inch Super Retina XDR OLED,Baterai : Li-Ion 2815 mAh,Prosesor : Apple A14 Bionic,Ram : 4gb', 10000, '1653053552.png'),
(65, 'iPhone 12 pro', 'iPhone', 'Layar : 6.1 inch Super Retina XDR OLED,Baterai : Li-Ion 2815 mAh,Prosesor : Apple A14 Bionic, Ram : 6gb', 15000, '1653053577.png'),
(66, 'iPhone 12 pro max', 'iPhone', 'Layar : 6.7 inch Super Retina XDR OLED,Baterai : Li-Ion 3687 mAh,Prosesor : Apple A14 Bionic,Ram : 6gb', 20000, '1653053593.png'),
(67, 'iPhone 13', 'iPhone', 'Layar : 6.1 inch Super Retina XDR OLED,Baterai : Li-Ion 3240 mAh,Prosesor : Apple A15 Bionic,Ram : 4gb', 10000, '1653053615.png'),
(68, 'iPhone 13 Pro', 'iPhone', 'Layar : 6.1 inch Super Retina XDR OLED(PRO-MOTION 120HZ),Baterai : Li-Ion 3095 mAh,Prosesor : Apple A14 Bionic, Ram : 6gb', 15000, '1653053638.png'),
(69, 'iPhone 13 Pro Max', 'iPhone', 'Layar : 6.7 inch Super Retina XDR OLED(PRO-MOTION 120HZ),Baterai : Li-Ion 4352 mAh,Prosesor : Apple A14 Bionic,Ram : 6gb', 20000, '1653053655.png');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `ID_Trans` int(10) NOT NULL,
  `FK_ID_SUBSCRIPTION` int(10) NOT NULL,
  `FK_ID_USER` varchar(20) NOT NULL,
  `FK_ID_KARYAWAN` varchar(20) DEFAULT NULL,
  `FK_ID_BARANG` int(10) NOT NULL,
  `Status` int(2) NOT NULL,
  `Total` int(50) NOT NULL,
  `Tanggal_Transaksi` date NOT NULL,
  `FK_ID_TRANS_VOUCHER` int(10) DEFAULT NULL,
  `Start_date` date NOT NULL,
  `End_date` date NOT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_voucher`
--

DROP TABLE IF EXISTS `transaksi_voucher`;
CREATE TABLE `transaksi_voucher` (
  `ID_Trans_Voucher` int(10) NOT NULL,
  `Tanggal_Transaksi` date NOT NULL,
  `FK_ID_VOUCHER` int(10) NOT NULL,
  `FK_ID_USER` varchar(20) NOT NULL,
  `Total` int(50) NOT NULL,
  `Status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID_User` varchar(20) NOT NULL,
  `Nama_User` varchar(50) NOT NULL,
  `NIK_User` int(20) NOT NULL,
  `NomorTelepon_User` varchar(200) NOT NULL,
  `Username_User` varchar(50) NOT NULL,
  `Password_User` varchar(255) NOT NULL,
  `Email_User` varchar(200) NOT NULL,
  `Poin_User` int(10) DEFAULT NULL,
  `is_verified` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID_User`, `Nama_User`, `NIK_User`, `NomorTelepon_User`, `Username_User`, `Password_User`, `Email_User`, `Poin_User`, `is_verified`) VALUES
('aa1234567891234567', 'a', 2147483647, '2002020222616', 'aaa', '$2y$10$l6aKgbKLW15uPkIKNEZEJu5XreV/5VZ0AgkG925.3x7zBVcaGJ5sO', 'codysimpsons46@gmail.com', 0, 1),
('bb1234567891234567', 'b', 2147483647, '2002020222616', 'bbb', '$2y$10$X.PF23IVwDvxWBhXFERhsOdmFesaom4rsLPfD/xXuVHUbhv0TgiOa', 'sadmewoy@gmail.com', 0, 1),
('ma8765432198765432', 'matthew', 2147483647, '3456789765432', 'matt', '$2y$10$tO7tL.nqWKWBo04TGtB9LO8vnVPrVAJMzi7x12OsO951zziir0Ksi', 'thevenomxdchannel@gmail.com', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

DROP TABLE IF EXISTS `voucher`;
CREATE TABLE `voucher` (
  `ID_Voucher` int(10) NOT NULL,
  `Potongan` int(10) NOT NULL,
  `Harga_Voucher` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_Barang`),
  ADD KEY `FK_ID_TIPE` (`FK_ID_TIPE`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`ID_Karyawan`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`ID_Subscription`);

--
-- Indexes for table `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`ID_Tipe`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_Trans`),
  ADD KEY `FK_ID_SUBSCRIPTION` (`FK_ID_SUBSCRIPTION`),
  ADD KEY `FK_ID_BARANG` (`FK_ID_BARANG`),
  ADD KEY `FK_ID_KARYAWAN` (`FK_ID_KARYAWAN`),
  ADD KEY `FK_ID_TRANS_VOUCHER` (`FK_ID_TRANS_VOUCHER`),
  ADD KEY `FK_ID_USERS` (`FK_ID_USER`);

--
-- Indexes for table `transaksi_voucher`
--
ALTER TABLE `transaksi_voucher`
  ADD PRIMARY KEY (`ID_Trans_Voucher`),
  ADD KEY `FK_ID_VOUCHER` (`FK_ID_VOUCHER`),
  ADD KEY `FK_ID_USER` (`FK_ID_USER`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_User`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`ID_Voucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `ID_Barang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tipe`
--
ALTER TABLE `tipe`
  MODIFY `ID_Tipe` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `ID_Trans` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `transaksi_voucher`
--
ALTER TABLE `transaksi_voucher`
  MODIFY `ID_Trans_Voucher` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `ID_Voucher` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `FK_ID_TIPE` FOREIGN KEY (`FK_ID_TIPE`) REFERENCES `tipe` (`ID_Tipe`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `FK_ID_BARANG` FOREIGN KEY (`FK_ID_BARANG`) REFERENCES `barang` (`ID_Barang`),
  ADD CONSTRAINT `FK_ID_KARYAWAN` FOREIGN KEY (`FK_ID_KARYAWAN`) REFERENCES `karyawan` (`ID_Karyawan`),
  ADD CONSTRAINT `FK_ID_SUBSCRIPTION` FOREIGN KEY (`FK_ID_SUBSCRIPTION`) REFERENCES `subscription` (`ID_Subscription`),
  ADD CONSTRAINT `FK_ID_TRANS_VOUCHER` FOREIGN KEY (`FK_ID_TRANS_VOUCHER`) REFERENCES `transaksi_voucher` (`ID_Trans_Voucher`),
  ADD CONSTRAINT `FK_ID_USERS` FOREIGN KEY (`FK_ID_USER`) REFERENCES `users` (`ID_User`);

--
-- Constraints for table `transaksi_voucher`
--
ALTER TABLE `transaksi_voucher`
  ADD CONSTRAINT `FK_ID_USER` FOREIGN KEY (`FK_ID_USER`) REFERENCES `users` (`ID_User`),
  ADD CONSTRAINT `FK_ID_VOUCHER` FOREIGN KEY (`FK_ID_VOUCHER`) REFERENCES `voucher` (`ID_Voucher`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
