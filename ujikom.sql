-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 05:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujikom`
--

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `judul_foto` varchar(255) NOT NULL,
  `deskripsi_foto` text NOT NULL,
  `lokasi_file` varchar(255) NOT NULL,
  `tanggal_unggah` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`foto_id`, `user_id`, `nama_lengkap`, `judul_foto`, `deskripsi_foto`, `lokasi_file`, `tanggal_unggah`) VALUES
(1, 1, 'Elisa', 'Kegiatan Pagi Hari', 'Lari pagi di pagi yang indah', 'foto1713771247.jpg', '2024-04-22'),
(2, 6, 'Athariz', 'Lovely Family', 'Akan selalu ada waktu bersama keluarga kecil ini', 'foto1713772994.jpg', '2024-04-22'),
(3, 4, 'Dhea', 'Si Sulung waktu kecil', 'Foto sama si sulung pas lagi lucu lucunya wkwkwk', 'foto1713773085.jpg', '2024-04-22'),
(5, 3, 'Naufal', 'YUUUU', 'hari baru petualangan baru!', 'foto1713773194.jpg', '2024-04-22'),
(7, 2, 'Chandra', 'Friends', 'Should we do it again, buddy?', 'foto1713834711.jpg', '2024-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `komentar_foto`
--

CREATE TABLE `komentar_foto` (
  `komentar_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar_foto`
--

INSERT INTO `komentar_foto` (`komentar_id`, `foto_id`, `user_id`, `nama_lengkap`, `isi_komentar`, `tanggal_komentar`) VALUES
(2, 1, 2, 'Chandra', 'semangat!!!', '2024-04-22'),
(3, 1, 6, 'Athariz', 'waduhhh <br/> #kerenn', '2024-04-22'),
(4, 2, 5, 'Ayyara', 'anak akuuuu', '2024-04-22'),
(5, 5, 5, 'Ayyara', 'kemana tuhhh', '2024-04-22'),
(6, 1, 8, 'Anonymous', 'hii', '2024-04-23'),
(10, 7, 1, 'Elisa', 'love it', '2024-04-23'),
(11, 1, 8, 'Anonymous', 'cek', '2024-04-23'),
(12, 2, 8, 'Anonymous', 'soo', '2024-04-23'),
(13, 7, 8, 'Anonymous', 'soo', '2024-04-23'),
(14, 3, 8, 'Anonymous', 'lucuw adek sama buna', '2024-04-23'),
(15, 2, 8, 'Anonymous', 'halo', '2024-04-23'),
(16, 5, 8, 'Anonymous', 'gaa', '2024-04-23'),
(17, 5, 7, 'Karin', 'wowwww!', '2024-04-24'),
(18, 1, 11, 'Caca', 'semangat', '2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `like_foto`
--

CREATE TABLE `like_foto` (
  `like_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `tanggal_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `like_foto`
--

INSERT INTO `like_foto` (`like_id`, `foto_id`, `user_id`, `nama_lengkap`, `tanggal_like`) VALUES
(5, 1, 2, 'Chandra', '2024-04-22'),
(6, 1, 1, 'Elisa', '2024-04-22'),
(7, 1, 6, 'Athariz', '2024-04-22'),
(8, 2, 6, 'Athariz', '2024-04-22'),
(9, 2, 5, 'Ayyara', '2024-04-22'),
(10, 5, 5, 'Ayyara', '2024-04-22'),
(11, 1, 5, 'Ayyara', '2024-04-22'),
(12, 3, 5, 'Ayyara', '2024-04-22'),
(16, 1, 8, 'Anonymous', '2024-04-23'),
(20, 7, 8, 'Anonymous', '2024-04-23'),
(21, 3, 8, 'Anonymous', '2024-04-23'),
(23, 2, 8, 'Anonymous', '2024-04-23'),
(24, 5, 8, 'Anonymous', '2024-04-23'),
(26, 7, 1, 'Elisa', '2024-04-23'),
(28, 5, 7, 'Karin', '2024-04-24'),
(29, 1, 11, 'Caca', '2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama_lengkap`, `username`, `password`, `email`, `alamat`) VALUES
(1, 'Elisa', 'elisa', '222', 'meila@gmail.com', 'Trajaya'),
(2, 'Chandra', 'chandra', '111', 'chandra@gmail.com', 'Majalengka'),
(3, 'Naufal', 'nopal', '333', 'naufal@gmail.com', 'Tajur'),
(4, 'Dhea', 'dhea', '444', 'dhea@gmail.com', 'Cigasong'),
(5, 'Ayyara', 'ayay', '555', 'ayyara@gmail.com', 'Majalengka Wetan'),
(6, 'Athariz', 'ariz', '666', 'athariz@gmail.com', 'Rajagaluh'),
(7, 'Karin', 'karin', '777', 'karin@gmail.com', 'Maja'),
(8, 'Anonymous', 'anonymous', '888', 'anonim@gmail.com', 'Anonim'),
(10, 'Try', 'try', '123', 'try@gmail.com', 'Nope'),
(11, 'Caca', 'caca', '1010', 'caca@gmail.com', 'Majalengka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`foto_id`),
  ADD KEY `fotouser` (`user_id`);

--
-- Indexes for table `komentar_foto`
--
ALTER TABLE `komentar_foto`
  ADD PRIMARY KEY (`komentar_id`),
  ADD KEY `komenfoto` (`foto_id`),
  ADD KEY `komenuser` (`user_id`);

--
-- Indexes for table `like_foto`
--
ALTER TABLE `like_foto`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `likefoto` (`foto_id`),
  ADD KEY `likeuser` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `komentar_foto`
--
ALTER TABLE `komentar_foto`
  MODIFY `komentar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `like_foto`
--
ALTER TABLE `like_foto`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `fotouser` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `komentar_foto`
--
ALTER TABLE `komentar_foto`
  ADD CONSTRAINT `komenfoto` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`foto_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `komenuser` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `like_foto`
--
ALTER TABLE `like_foto`
  ADD CONSTRAINT `likefoto` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`foto_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likeuser` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
