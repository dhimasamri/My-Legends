-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2020 at 06:47 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpdasar`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `idakun` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `bio` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`idakun`, `username`, `email`, `password`, `gambar`, `bio`) VALUES
(1, 'apakek', 'apakek@gmail.com', '$2y$10$/O12dWdCkofjX0E6MnmdfuXKWkeSwbPlYOcC7eUtUvXAh9Y/glSO6', '5fdb34ec4cfeb.jpg', ''),
(2, 'admin', 'admin@gmail.com', '$2y$10$0U3U8BPpn6KX2iEsQ2xIte3Oo3/aApt5WbjmW5BXXrjIFpyg3MiHC', 'Ahmad.png', 'player Assassin dan Marksman'),
(3, 'nyoba', 'nyoba@gmail.com', '$2y$10$33SWYLNl3cpX/iwlDUfDI.JIoypfoxV5jZIbWksOJQ09TM6t8iLvG', 'Ahmadpng', ''),
(5, 'test', 'test@gmail.com', '$2y$10$YGasw6hrPuN28iP9i6Rn/OGvESRncgBBdbMeMdvhySK7LIshWoaIK', '5fdb8cdff0627.png', ''),
(6, 'asd', 'asdasd@adasd', '$2y$10$2Cry/3Dlm9H6Hxpok8HMnupw4B13EvqbUxYyCUyCjlz2/jvnwNMca', '', ''),
(7, 'zaidan', 'zaidan@gmail.com', '$2y$10$RjfGnyLP4wvJJBTbdmB1Uu6MXUVAUEPc4AUOdzHypeXABhN4QP7WC', 'Ahmad.png', ''),
(12, '1234', '1234@gmail.com', '$2y$10$Xcm6FOnx49BN3qeF7d.0QuUeecLf4U0lkD3nnYHCK/Qlm4C9LI136', 'Ahmad.png', ''),
(13, '12345', '12345@gmail.com', '$2y$10$IwxeeaGSeng6lSIqRjQdp.UxS0LX42J3ZWvnfqupOF/iez6xtjkBS', 'Default.png', ''),
(14, 'Fernando Manalu', 'fernando@gmail.com', '$2y$10$BjuV/MCYxgaybC43R7Gn2.6NL3ukWjluV7.W5NlQzMTsmSA9JArBe', '5fe617959cd5d.jpg', 'Tank user');

-- --------------------------------------------------------

--
-- Table structure for table `forgot`
--

CREATE TABLE `forgot` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forgot`
--

INSERT INTO `forgot` (`id`, `email`) VALUES
(1, ''),
(2, '');

-- --------------------------------------------------------

--
-- Table structure for table `postingan`
--

CREATE TABLE `postingan` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `caption` varchar(250) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `ava` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postingan`
--

INSERT INTO `postingan` (`id`, `judul`, `gambar`, `caption`, `tag`, `nama`, `ava`) VALUES
(1, 'Gameplay Harith', '5fd9925f34664.jpg', 'mage terbaik', 'harith mage', 'admin', 'Ahmad.png'),
(2, 'Gussion Savage!!!', '5fd9937a9d501.jpg', 'emblem assassin', 'assassin mage gussion', 'admin', 'Ahmad.png'),
(3, 'Zilong GG', '5fdec1e0c812d.jpg', 'maniac 4x dalam 1 game', 'assassin fighter ranked', 'admin', 'Ahmad.png'),
(7, 'SPLIT PUSH!!', '5fe5a9c60be99.jpg', 'Ngancurin tower base sendirian', 'hayabusa splitpush asssassin soloplayer', '12345', 'Default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`idakun`);

--
-- Indexes for table `forgot`
--
ALTER TABLE `forgot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postingan`
--
ALTER TABLE `postingan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `idakun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `forgot`
--
ALTER TABLE `forgot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `postingan`
--
ALTER TABLE `postingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
