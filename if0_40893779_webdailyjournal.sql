-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql112.byetcluster.com
-- Generation Time: Jan 15, 2026 at 02:33 PM
-- Server version: 11.4.9-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_40893779_webdailyjournal`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `judul` text DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(5, 'Star Platinum', 'Star Platinum adalah Stand milik Jotaro Kujo, yang terutama ditampilkan dalam bagian ketiga dariJoJo\'s Bizarre Adventure,Stardust Crusaders. Ia juga muncul di bagian keempat,Diamond is Unbreakable, dan bagian keenam,Stone Ocean.', '202601160140136969348da6376.jpg', '2026-01-16 01:40:13', 'admin'),
(7, 'The World', 'The World adalah Stand milik DIO, yang ditampilkan dalam bagian ketiga dariJoJo\'s Bizarre Adventure,Stardust Crusaders. Karakter ini adalah villain dari season 1 hingga 7', '202601160138206969341cce834.jpg', '2026-01-16 01:38:20', 'admin'),
(8, 'Stone Free', 'Stone Free adalah Stand milik Jolyne Cujoh, yang muncul di bagian keenam dariJoJo\'s Bizarre Adventure,Stone Ocean. Jolyne sendiri adalah putri dari Jotaro.', '20260116013623696933a751d96.jpg', '2026-01-16 01:36:23', 'admin'),
(9, 'Gold Experience Requiem', 'Gold Experience Requiem adalah Stand Requiem milik Giorno Giovanna, yang ditampilkan dalam bagian kelima dariJoJo\'s Bizarre Adventure,Vento Aureo.', '202601160134216969332de900d.jpg', '2026-01-16 01:34:21', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `tanggal`, `gambar`, `deskripsi`, `users_id`) VALUES
(9, '2026-01-15 11:08:49', '2026011602130569693c412e18e.jpg', 'Sticky Finger', 1),
(10, '2026-01-15 11:10:29', '2026011602113469693be62dad6.jpg', 'Purple Haze', 1),
(7, '2026-01-15 11:06:48', '2026011602141569693c87899e7.jpg', 'King Crimson', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `foto`) VALUES
(0, 'admin', '$2y$10$OlPYwsXcZwjQeojl1nmd..uRJAPLC5znl9zSSAdj4bsfPAFFoTJKm', '2026011601104869692da83da1d.jpg'),
(1, 'april', '$2y$10$k9bGeOynv.K0eR9B8fKmHuR1TxohUeJ7JnKQ9N3f6FeN9jHrT8qB.', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
