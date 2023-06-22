-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2023 at 01:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_activities`
--

-- --------------------------------------------------------

--
-- Table structure for table `event_social`
--

CREATE TABLE `event_social` (
  `id` int(11) NOT NULL,
  `nama_acara` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `date` date NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `selesai` varchar(255) NOT NULL,
  `jumlah_pengikut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_social`
--

INSERT INTO `event_social` (`id`, `nama_acara`, `deskripsi`, `date`, `lokasi`, `selesai`, `jumlah_pengikut`) VALUES
(1, 'acara ui', 'pengajian di hadipolo', '2023-06-23', 'hadipolo jekulo ', '', 2),
(2, 'acara b', 'khajatan', '2023-06-19', 'jekulo', '1', 1),
(3, 'acara c', 'bersih desa', '2023-06-28', 'rt 5', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ikuti_acara`
--

CREATE TABLE `ikuti_acara` (
  `id` int(11) NOT NULL,
  `id_acara` int(11) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ikuti_acara`
--

INSERT INTO `ikuti_acara` (`id`, `id_acara`, `username`) VALUES
(8, 2, 'nafi'),
(11, 1, 'nafi'),
(12, 1, 'nino');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'riveer', 'hanafi', 'admin'),
(3, 'nafi', 'hanafi', 'user'),
(4, 'ichika', 'nakano\r\n', 'user'),
(5, 'itsuki', 'nakano', 'user'),
(6, 'nino', 'nakano', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event_social`
--
ALTER TABLE `event_social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ikuti_acara`
--
ALTER TABLE `ikuti_acara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event_social`
--
ALTER TABLE `event_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ikuti_acara`
--
ALTER TABLE `ikuti_acara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
