-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2020 at 11:26 AM
-- Server version: 10.1.28-MariaDB
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
-- Database: `akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `dt_prodi`
--

CREATE TABLE `dt_prodi` (
  `idprodi` int(11) NOT NULL,
  `kdprodi` varchar(6) NOT NULL,
  `nmprodi` varchar(70) NOT NULL,
  `akreditasi` enum('A','B','C','-') NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dt_prodi`
--

INSERT INTO `dt_prodi` (`idprodi`, `kdprodi`, `nmprodi`, `akreditasi`) VALUES
(1, '753', 'Manajemen Informatika', 'B'),
(2, '752', 'Akuntansi', 'A'),
(3, '751', 'Agribisnis', 'B'),
(4, '754', 'Akuntansi Perpajakan', 'A'),
(5, '755', 'Agribisnis Pangan', 'B'),
(6, '756', 'Pariwisata', '-');

-- --------------------------------------------------------

--
-- Table structure for table `jenjang`
--

CREATE TABLE `jenjang` (
  `idjenjang` int(11) NOT NULL,
  `nmjenjang` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jenjang`
--

INSERT INTO `jenjang` (`idjenjang`, `nmjenjang`) VALUES
(1, 'D3'),
(2, 'D4'),
(3, 'S2'),
(4, 'S3');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `idmhs` int(11) NOT NULL,
  `npm` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `idprodi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`idmhs`, `npm`, `nama`, `idprodi`) VALUES
(1, '18753006', 'Ahmad Shobirin Al-ansyori', 1),
(2, '18753002', 'Ade Setiawan', 1),
(3, '18753001', 'David Saputra', 1),
(4, '18753022', 'Faninda Lenia Prastika', 1),
(5, '18753026', 'Ferdinand Aryadi', 1),
(6, '18753017', 'Gustin Setia Rahayu', 1),
(7, '18753026', 'Febri Gilang P', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `jenisuser` enum('0','1') NOT NULL DEFAULT '0',
  `level` enum('00','01','11') NOT NULL DEFAULT '00',
  `status` enum('F','T') NOT NULL DEFAULT 'F',
  `idprodi` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `jenisuser`, `level`, `status`, `idprodi`) VALUES
(1, 'superadmin', 'rahasia', '1', '01', 'F', 2),
(2, 'admin1', 'rahasia', '1', '11', 'F', 1),
(3, 'client1', 'rahasia', '0', '00', 'F', 2),
(4, 'david', 'david', '1', '01', 'F', 1),
(5, 'ade', 'ade', '1', '11', 'F', 1),
(6, 'shobirin', 'shobirin', '0', '00', 'F', 1),
(7, 'faninda', 'faninda', '0', '00', 'F', 1),
(8, 'ferdinand', 'ferdinand', '0', '00', 'F', 1),
(9, 'gustin', 'gustin', '0', '00', 'F', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dt_prodi`
--
ALTER TABLE `dt_prodi`
  ADD PRIMARY KEY (`idprodi`);

--
-- Indexes for table `jenjang`
--
ALTER TABLE `jenjang`
  ADD PRIMARY KEY (`idjenjang`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`idmhs`),
  ADD KEY `dt_prodi` (`idprodi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dt_prodi`
--
ALTER TABLE `dt_prodi`
  MODIFY `idprodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jenjang`
--
ALTER TABLE `jenjang`
  MODIFY `idjenjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `idmhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
