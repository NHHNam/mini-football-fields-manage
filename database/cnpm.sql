-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2021 at 11:10 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cnpm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `name`, `image`) VALUES
('admin', 'admin', 'Admin', 'images/admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `id` int(11) NOT NULL,
  `username_khachhang` varchar(50) NOT NULL,
  `maSan` varchar(10) NOT NULL,
  `ngaydat` date NOT NULL,
  `giodat` time NOT NULL,
  `thoigian` int(11) NOT NULL,
  `ngayLap` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `giohang`
--

INSERT INTO `giohang` (`id`, `username_khachhang`, `maSan`, `ngaydat`, `giodat`, `thoigian`, `ngayLap`) VALUES
(4, 'ngoctran', 'sanBTD', '2021-12-13', '19:00:00', 45, '2021-12-12'),
(7, 'hoainam', 'sanTN', '2021-12-14', '17:05:00', 15, '2021-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`id`, `name`, `username`, `password`, `image`) VALUES
(1, 'Hoài Nam', 'hoainam', '123', 'images/1.jpg'),
(3, 'Lê Ngọc Trân', 'ngoctran', '1234', 'images/42fe704235a61f2a58060cc0ff8f95d7.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `sanbong`
--

CREATE TABLE `sanbong` (
  `id` int(11) NOT NULL,
  `maSan` varchar(10) NOT NULL,
  `tenSan` varchar(50) NOT NULL,
  `giaSan` int(11) NOT NULL,
  `imageSan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sanbong`
--

INSERT INTO `sanbong` (`id`, `maSan`, `tenSan`, `giaSan`, `imageSan`) VALUES
(15, 'sanBTD', 'sân bóng bình trị đông', 3500, 'images/64b1562d3d90a600c742979e9e844203.JPG'),
(16, 'sanNam', 'sân bóng của Nam', 3000, 'images/3c70e5fde5b13986a2fa98a4d00841e8.JPG'),
(17, 'sanNu', 'sân bóng của nữ', 3000, 'images/57e7b27431a064135e11f2ecdcdfa54c.JPG'),
(20, 'sanTN', 'sân bóng Thiện Nhân', 3500, 'images/tn.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sanbong`
--
ALTER TABLE `sanbong`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sanbong`
--
ALTER TABLE `sanbong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
