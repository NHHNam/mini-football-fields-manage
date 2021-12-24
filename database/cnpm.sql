-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 24, 2021 at 10:50 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

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
-- Table structure for table `drink`
--

CREATE TABLE `drink` (
  `id` int(11) NOT NULL,
  `maDrink` varchar(20) NOT NULL,
  `nameDrink` varchar(50) NOT NULL,
  `priceDrink` int(11) NOT NULL,
  `imageDrink` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drink`
--

INSERT INTO `drink` (`id`, `maDrink`, `nameDrink`, `priceDrink`, `imageDrink`) VALUES
(1, 'coca', 'Nước ngọt Coca', 12000, 'images/coca.jpeg'),
(3, 'pepsi', 'Pepsi', 12000, 'images/pepsi.jpeg'),
(4, 'nuoc', 'nước suối', 5500, 'images/aquafina.jpeg'),
(5, 'revive', 'Revive', 12000, 'images/revive.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `id` int(11) NOT NULL,
  `maKH` varchar(50) NOT NULL,
  `maSan` varchar(10) NOT NULL,
  `ngaydat` date NOT NULL,
  `giodat` time NOT NULL,
  `thoigian` int(11) NOT NULL,
  `ngayLap` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `giohangdrink`
--

CREATE TABLE `giohangdrink` (
  `id` int(11) NOT NULL,
  `maDrink` varchar(20) NOT NULL,
  `maKH` varchar(50) NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `id` int(11) NOT NULL,
  `maDon` varchar(100) NOT NULL,
  `maKH` varchar(50) NOT NULL,
  `hinhthuc` varchar(50) NOT NULL,
  `tongtien` int(11) NOT NULL,
  `ngayLap` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`id`, `maDon`, `maKH`, `hinhthuc`, `tongtien`, `ngayLap`, `status`) VALUES
(23, 'Don6610', 'hoainam', 'Trực tiếp', 280500, '2021-12-24', 'Success'),
(25, 'Don3995', 'ngoctran', 'Trực tiếp', 545000, '2021-12-24', 'Success');

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
(1, 'Nguyễn Hưng Hoài Nam', 'hoainam', '1234', 'images/3b7e2e7c2a0405fa1c805b76c83aad34.JPG'),
(3, 'Lê Ngọc Trân', 'ngoctran', '1234', 'images/42fe704235a61f2a58060cc0ff8f95d7.JPG'),
(5, 'Trần Thị Kiều', 'kieu', '1234', 'images/3c70e5fde5b13986a2fa98a4d00841e8.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`id`, `name`, `username`, `password`, `image`) VALUES
(2, 'Mai Nguyễn Thái Học', 'nvhoc', '123', 'images/2.png'),
(3, 'Lê Đăng Trường', 'nvtruong', '123', 'images/eifiel.jpeg');

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
(20, 'sanTN', 'sân bóng Thiện Nhân', 3000, 'images/tn.webp');

-- --------------------------------------------------------

--
-- Table structure for table `tamgiohangdrink`
--

CREATE TABLE `tamgiohangdrink` (
  `id` int(11) NOT NULL,
  `maDon` varchar(50) NOT NULL,
  `maDrink` varchar(20) NOT NULL,
  `maKH` varchar(50) NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tamgiohangdrink`
--

INSERT INTO `tamgiohangdrink` (`id`, `maDon`, `maDrink`, `maKH`, `soluong`) VALUES
(41, 'Don6610', 'coca', 'hoainam', 1),
(42, 'Don6610', 'pepsi', 'hoainam', 3),
(43, 'Don3995', 'coca', 'ngoctran', 10),
(44, 'Don3995', 'pepsi', 'ngoctran', 2),
(45, 'Don3995', 'nuoc', 'ngoctran', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tamgiohangsan`
--

CREATE TABLE `tamgiohangsan` (
  `id` int(11) NOT NULL,
  `maDon` varchar(50) NOT NULL,
  `maKH` varchar(50) NOT NULL,
  `maSan` varchar(10) NOT NULL,
  `ngaydat` date NOT NULL,
  `giodat` time NOT NULL,
  `thoigian` int(11) NOT NULL,
  `ngayLap` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tamgiohangsan`
--

INSERT INTO `tamgiohangsan` (`id`, `maDon`, `maKH`, `maSan`, `ngaydat`, `giodat`, `thoigian`, `ngayLap`) VALUES
(28, 'Don6610', 'hoainam', 'sanBTD', '2021-12-26', '16:12:00', 15, '2021-12-24'),
(29, 'Don6610', 'hoainam', 'sanTN', '2021-12-30', '16:15:00', 60, '2021-12-24'),
(30, 'Don3995', 'ngoctran', 'sanNu', '2021-12-26', '22:30:00', 60, '2021-12-24'),
(31, 'Don3995', 'ngoctran', 'sanBTD', '2021-12-29', '17:30:00', 60, '2021-12-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drink`
--
ALTER TABLE `drink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `giohangdrink`
--
ALTER TABLE `giohangdrink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sanbong`
--
ALTER TABLE `sanbong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tamgiohangdrink`
--
ALTER TABLE `tamgiohangdrink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tamgiohangsan`
--
ALTER TABLE `tamgiohangsan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drink`
--
ALTER TABLE `drink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `giohangdrink`
--
ALTER TABLE `giohangdrink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sanbong`
--
ALTER TABLE `sanbong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tamgiohangdrink`
--
ALTER TABLE `tamgiohangdrink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tamgiohangsan`
--
ALTER TABLE `tamgiohangsan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
