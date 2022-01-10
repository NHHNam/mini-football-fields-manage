-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 10, 2022 at 05:40 AM
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
-- Table structure for table `doanhthu`
--

CREATE TABLE `doanhthu` (
  `id` int(11) NOT NULL,
  `sodon` int(11) NOT NULL,
  `doanhthu` int(11) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doanhthu`
--

INSERT INTO `doanhthu` (`id`, `sodon`, `doanhthu`, `date`) VALUES
(10, 3, 400000, '2022-01-02'),
(11, 5, 600000, '2022-01-01'),
(12, 5, 500000, '2021-12-31'),
(13, 6, 700000, '2021-12-30'),
(14, 10, 4000000, '2021-02-02'),
(15, 3, 400000, '2022-01-03'),
(16, 6, 500000, '2021-12-29'),
(17, 6, 800000, '2021-12-28'),
(18, 6, 600000, '2021-12-27'),
(19, 6, 600000, '2021-12-26'),
(20, 2, 1660000, '2022-01-04'),
(21, 1, 960000, '2022-01-05'),
(22, 3, 837500, '2022-01-08'),
(23, 3, 712500, '2022-01-09');

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
(6, 'pepsi', 'Pepsi', 10500, 'images/pepsi.jpeg'),
(7, 'coca', 'Coca', 10000, 'images/coca.jpeg'),
(8, 'revive', 'Revive', 12000, 'images/revive.jpeg'),
(10, 'nuoc', 'Nước suối', 5000, 'images/aquafina.jpeg');

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
  `soluong` int(11) NOT NULL,
  `ngayLap` varchar(20) NOT NULL
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
(42, 'Don2515', 'hoainam', 'MoMo', 357500, '2022-01-08', 'Success'),
(43, 'Don9513', 'hoainam', 'Trực tiếp', 240000, '2022-01-08', 'Success'),
(44, 'Don5596', 'hoainam', 'MoMo', 435000, '2022-01-08', 'Success'),
(45, 'Don8758', 'hoainam', 'Trực tiếp', 157500, '2022-01-09', 'Success'),
(46, 'Don433', 'hoainam', 'Trực tiếp', 120000, '2022-01-09', 'Success');

-- --------------------------------------------------------

--
-- Table structure for table `sanbong`
--

CREATE TABLE `sanbong` (
  `id` int(11) NOT NULL,
  `maSan` varchar(10) NOT NULL,
  `tenSan` varchar(50) NOT NULL,
  `giaSan` int(11) NOT NULL,
  `imageSan` varchar(50) NOT NULL,
  `SL` int(11) NOT NULL,
  `addressSan` varchar(100) NOT NULL,
  `descSan` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sanbong`
--

INSERT INTO `sanbong` (`id`, `maSan`, `tenSan`, `giaSan`, `imageSan`, `SL`, `addressSan`, `descSan`) VALUES
(27, 'san1', 'Thế Giới', 3500, 'images/san1.jpeg', 2, '399/45 Bình Thành , Khu phố 2 , P. Bình Hưng Hoà B, Quận Bình Tân, Tp Hồ Chí Minh', 'được xây dựng hệ thống nhiều sân, tổ hợp gồm 6 sân 5 người. Sân bóng có đầy đủ tiện ích, công trình phụ trợ được đầu tư bài bản. Nằm ở khu vực giao thông thuận lợi, vị trí rộng rãi, thoáng mát.'),
(28, 'san2', 'Thiên Tinh', 4000, 'images/san2.jpeg', 4, 'Hồ Chí Minh', 'được đầu tư xây dựng gồm 2 sân bóng 5 người đá, với kích thước sân là 20 x 40m. '),
(29, 'san3', 'Khuất Bóng', 4500, 'images/san3.jpeg', 0, 'Hồ Chí Minh', 'Cấu trúc là 1 sân đơn 5 người, kích thước tiêu chuẩn 20x40m'),
(30, 'san4', 'Rộng Lớn', 4500, 'images/san4.jpeg', 0, 'Tân Xuân, huyện Hóc Môn, TP. Hồ Chí Mình', 'Sân bóng có đầy đủ tiện ích, công trình phụ được đầu tư xây dựng bài bản. Hệ thống đèn chiếu sáng hiện đại, cho ánh sáng chân thực nhất.Sân được xây dựng theo cấu trúc gồm 3 sân bóng 5 người, có thể kinh động ghép lại đá sân 7.'),
(31, 'san5', 'Future', 5000, 'images/san5.jpeg', 0, 'Hồ Chí Minh', 'gồm nhiều sân bóng 5 người có kích thước tiêu chuẩn mỗi sân 20x40m, sân có thể ghép lại để đá sân 7.'),
(32, 'san6', 'Thiến Binh', 4000, 'images/san6.jpeg', 0, 'Hồ Chí Minh', 'Được thiết kế với cấu trúc sân gồm 2 sân bóng đá 5 người, có đầy đủ tiện ích, công trình phụ trợ được đầu tư bài bản. Các tiêu chuẩn về độ rộng của sân, lề sân cũng như lưới bao bọc xung quanh khá là hợp lý.\r\n\r\n'),
(33, 'san7', 'Liên Khúc', 4500, 'images/san7.jpeg', 1, 'Hồ Chí Minh', 'Sân bóng được thiết kế theo cấu trúc 2 sân bóng đá mini 5 người với kích thước tiêu chuẩn mỗi sân 20x40m. Sân có đầy đủ tiện ích, công trình phụ trợ được đầu tư bài bản.'),
(34, 'san8', 'Khuân Linh', 4000, 'images/san8.jpeg', 0, 'Hồ Chí Minh', 'cấu trúc sân gồm 2 sân cỏ nhân tạo 5 người, sân thoáng, rỗng rãi, phù hợp tổ chức giải đấu phong trào, giải nghiệp dư bán chuyên. Có thêm cả khu vực nước uống, cafe giải khát và bàn bida.'),
(35, 'san9', 'Vang Vọng', 5000, 'images/san9.jpeg', 1, 'Hồ Chí Minh', 'sân bóng cấu trúc là 1 sân đơn 5 người với kích thước tiêu chuẩn 20x40m. Sân bóng xây dựng hệ thống tiện ích đầy đủ, đèn chiếu sáng cho ánh sáng chân thực, công trình phụ trợ được đầu tư bài bản. Hệ thống lưới chắn bóng đảm bảo độ cao.'),
(36, 'san10', 'Vạn Linh', 5000, 'images/san10.jpeg', 1, 'Hồ Chí Minh', 'Sân nằm trong khuôn viên được cải tạo bài bản, chất lượng sân đặt tiêu chuẩn quốc tế. Dù đã được đưa vào khai thác lâu nhưng chất lượng vẫn đảm bảo và tuyệt vời do sân thường xuyên được bảo trì và chăm sóc.');

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
(63, 'Don2515', 'pepsi', 'hoainam', 20),
(64, 'Don1671', 'pepsi', 'hoainam', 20),
(65, 'Don5596', 'pepsi', 'hoainam', 20);

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
(53, 'Don2515', 'hoainam', 'san2', '2022-01-09', '15:50:00', 30, '2022-01-08'),
(54, 'Don2515', 'hoainam', 'san1', '2022-01-09', '18:50:00', 45, '2022-01-08'),
(55, 'Don4943', 'hoainam', 'san2', '2022-01-10', '15:00:00', 60, '2022-01-08'),
(56, 'Don1671', 'hoainam', 'san7', '2022-01-09', '20:35:00', 45, '2022-01-08'),
(57, 'Don1671', 'hoainam', 'san9', '2022-01-10', '18:35:00', 60, '2022-01-08'),
(58, 'Don9513', 'hoainam', 'san2', '2022-01-09', '17:34:00', 60, '2022-01-08'),
(59, 'Don5596', 'hoainam', 'san10', '2022-01-09', '20:00:00', 45, '2022-01-08'),
(60, 'Don8758', 'hoainam', 'san1', '2022-01-09', '21:25:00', 45, '2022-01-09'),
(68, 'Don433', 'hoainam', 'san2', '2022-01-09', '17:00:00', 30, '2022-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sdt` int(11) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `image` varchar(50) NOT NULL,
  `capBac` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `sdt`, `diachi`, `gender`, `username`, `password`, `image`, `capBac`) VALUES
(11, 'Châu Phối Kim', 'kim@example.com', 1234567890, '123 Đinh Tiên Hoàng', 'Nữ', 'admin', '$2y$10$oybQO0O8CVbnnuy4GuSCm..u3GrdaMRCYm5s14dPdRZByk0.hsWAm', 'images/admin.jpg', 'quanly'),
(17, 'Nguyễn Hưng Hoài Nam', 'nam@example.com', 123456789, '790/31 Hoà Bình', 'Nam', 'hoainam', '$2y$10$RB3zz.JqeXPHLqBoEvUMSureTKT1a6Nolbha2uwa8g9rimk1TZUOO', 'images/4e975854d36f7d8ccea32c7eb36e3b71.JPG', 'khachhang'),
(18, 'Mai Nguyễn Thái Học', 'hoc@example.com', 12345679, '123/212 lee', 'Nam', 'nvhoc', '$2y$10$RB3zz.JqeXPHLqBoEvUMSureTKT1a6Nolbha2uwa8g9rimk1TZUOO', 'images/2.jpg', 'nhanvien'),
(22, 'Lê Ngọc Trân', 'tran@example.com', 123456789, '98 Lê Đình Cẩn', 'Nữ', 'ngoctran', '$2y$10$RB3zz.JqeXPHLqBoEvUMSureTKT1a6Nolbha2uwa8g9rimk1TZUOO', 'images/5.jpg', 'khachhang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doanhthu`
--
ALTER TABLE `doanhthu`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doanhthu`
--
ALTER TABLE `doanhthu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `drink`
--
ALTER TABLE `drink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `giohangdrink`
--
ALTER TABLE `giohangdrink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `sanbong`
--
ALTER TABLE `sanbong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tamgiohangdrink`
--
ALTER TABLE `tamgiohangdrink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tamgiohangsan`
--
ALTER TABLE `tamgiohangsan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
