-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 12:16 PM
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
-- Table structure for table `data_bansos`
--

CREATE TABLE `data_bansos` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jenis_bansos` varchar(50) DEFAULT NULL,
  `total_dana_bansos` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_bansos`
--

INSERT INTO `data_bansos` (`id`, `nama`, `alamat`, `jenis_bansos`, `total_dana_bansos`, `status`) VALUES
(1, 'John Doe', 'Jl. Merdeka No. 123', 'Bantuan Sosial Tunai', 1000000.00, 'Ditolak'),
(2, 'Jane Smith', 'Jl. Raya Maju No. 456', 'Bantuan Pangan', 1500000.00, 'Disetujui'),
(3, 'Michael Johnson', 'Jl. Jendral Sudirman No. 789', 'Bantuan Sembako', 800000.00, 'Menunggu Keputusan'),
(4, 'Emily Davis', 'Jl. Diponegoro No. 101', 'Bantuan Langsung Tunai', 500000.00, 'Menunggu Keputusan'),
(5, 'Robert Wilson', 'Jl. Imam Bonjol No. 202', 'Bantuan Pendidikan', 1200000.00, 'Menunggu Keputusan'),
(6, 'Olivia Brown', 'Jl. Gatot Subroto No. 303', 'Bantuan Kesehatan', 900000.00, 'Disetujui'),
(7, 'William Taylor', 'Jl. Thamrin No. 404', 'Bantuan Sosial Non-Tunai', 700000.00, 'Disetujui'),
(8, 'Sophia Anderson', 'Jl. Veteran No. 505', 'Bantuan Produktif Usaha Mikro', 600000.00, 'Disetujui'),
(9, 'Jacob Thomas', 'Jl. Ahmad Yani No. 606', 'Bantuan Modal Usaha', 1000000.00, 'Disetujui'),
(11, 'ipnu', 'ipnu jekolu', 'bantuan organisasi', 500000.00, 'Ditolak'),
(12, 'hanafi', 'kudus', 'beasiswa', 5000000.00, 'Menunggu Keputusan'),
(13, 'eunha', 'sumber', 'beasiswa', 2000000.00, 'Menunggu Keputusan'),
(14, 'vicky', 'mejobo', 'beasiswa', 500000.00, 'Menunggu Keputusan'),
(15, 'karang taruna', 'hadipolo', 'bantuan organisasi', 5000000.00, 'Menunggu Keputusan'),
(16, 'pkk', 'entah', 'bantuan organisasi', 5000000.00, 'Disetujui'),
(17, 'entah', 'entah', 'entah', 0.00, 'Menunggu Keputusan');

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
(1, 'acara abc', 'pengajian di hadipolo', '2023-06-23', 'hadipolo jekulo ', '', 50),
(2, 'acara b', 'khajatan', '2023-06-19', 'jekulo', '1', 25),
(3, 'acara c', 'bersih desa', '2023-06-28', 'rt 5', '1', 30),
(4, 'acara abc', 'penyuluhan kesehatan ', '2023-07-08', 'semua dukuh bareng', '', 34);

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
(12, 1, 'nino'),
(15, 1, 'nafi');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id`, `nama`, `alamat`, `pekerjaan`) VALUES
(1, 'hanafi', 'kudus', 'asisten apoteker'),
(2, 'nakano nino', 'Jl. Sudirman No. 456', 'chef'),
(3, 'monkey d luffy', 'foosha east blue', 'pirate'),
(4, 'Emily Brown', 'Jl. Pahlawan No. 234', 'Guru'),
(5, 'Daniel Wilson', 'Jl. Diponegoro No. 567', 'Mahasiswa'),
(6, 'arima kana', 'Jl. Veteran No. 890', 'idol'),
(7, 'hoshino ai', 'Jl. Imam Bonjol No. 123', 'idol'),
(8, 'sanji', 'Germa ', 'chef'),
(9, 'zoro', 'Shimotsuki  East Blue', 'pirate'),
(10, 'guts', 'Jl. Cikini No. 234', 'army'),
(11, 'casca', 'entah', 'army'),
(12, 'jingga sakura', 'Jepang Pakis', 'mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_surat_domisili`
--

CREATE TABLE `pengajuan_surat_domisili` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat_lama` varchar(100) DEFAULT NULL,
  `alamat_baru` varchar(100) DEFAULT NULL,
  `alasan` text DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_surat_domisili`
--

INSERT INTO `pengajuan_surat_domisili` (`id`, `nama`, `alamat_lama`, `alamat_baru`, `alasan`, `status`) VALUES
(2, 'Jane Smith', 'Jl. Sebelumnya No. 789', 'Jl. Sekarang No. 987', 'kerja', 'Dalam Proses'),
(4, 'windy', 'surakarta', 'kudus', 'kerja', 'Diterima'),
(6, 'VICKY', 'MEJOBO', 'HADIPOLO', 'MENIKAH', 'Diterima'),
(7, 'barada', 'blora', 'HADIPOLO', 'kerja', 'Menunggu'),
(9, 'orang 1', 'tempat a', 'tempat b', 'kerja', 'Dalam Proses'),
(19, 'Syafrudin', 'Hadipolo', 'Surabaya', 'kerja', 'Diterima'),
(20, 'guts', 'wond3er', 'afkjkfjlk', 'ajfkajfj', 'Menunggu'),
(21, 'Syafrudin', 'Hadipolo', 'jkjf', 'ajkajf', 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_miskin`
--

CREATE TABLE `surat_keterangan_miskin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_keterangan_miskin`
--

INSERT INTO `surat_keterangan_miskin` (`id`, `nama`, `alamat`, `pekerjaan`, `status`) VALUES
(1, 'John Doe', 'Jl. Merdeka No. 123', 'Buruh', 'Selesai'),
(2, 'Jane Smith', 'Jl. Pahlawan No. 456', 'Ibu Rumah Tangga', 'Dalam Proses'),
(3, 'Michael Johnson', 'Jl. Harapan Indah No. 789', 'Pegawai Swasta', 'Selesai'),
(4, 'one', 'entahlah', 'buruh', 'Belum Diproses'),
(5, 'abc', 'kudus', 'buruh tani', 'Belum Diproses'),
(9, 'fulan', 'kudus', 'pedagang', 'Selesai'),
(10, 'hanafi', 'mbareng', 'mahasiswa', 'Dalam Proses'),
(11, 'fulan a', 'ngawi', 'pedagang', 'Dalam Proses'),
(12, 'fulan c', 'sumber', 'buruh', 'Dalam Proses'),
(13, 'argounout', 'dungeon', 'petualang', 'Dalam Proses'),
(14, 'slamet', 'sumber', 'serabutan', 'Dalam Proses'),
(15, 'fulan a', 'entah', 'serabutan', 'Belum Diproses'),
(16, 'fulan c', 'entahku', 'serabutan', ''),
(17, 'fkjjfjka', 'kjafv', 'kakjkfaj', 'Menunggu'),
(18, 'guts', 'fjjf', 'akjfla', '');

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
-- Indexes for table `data_bansos`
--
ALTER TABLE `data_bansos`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_surat_domisili`
--
ALTER TABLE `pengajuan_surat_domisili`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_miskin`
--
ALTER TABLE `surat_keterangan_miskin`
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
-- AUTO_INCREMENT for table `data_bansos`
--
ALTER TABLE `data_bansos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `event_social`
--
ALTER TABLE `event_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ikuti_acara`
--
ALTER TABLE `ikuti_acara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengajuan_surat_domisili`
--
ALTER TABLE `pengajuan_surat_domisili`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `surat_keterangan_miskin`
--
ALTER TABLE `surat_keterangan_miskin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
