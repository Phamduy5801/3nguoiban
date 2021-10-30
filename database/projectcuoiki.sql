-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2021 at 12:12 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectcuoiki`
--

-- --------------------------------------------------------

--
-- Table structure for table `damnhiemmn`
--

CREATE TABLE `damnhiemmn` (
  `id` int(11) NOT NULL,
  `tea_id` int(11) NOT NULL,
  `sb_id` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `db_dkihoc`
--

CREATE TABLE `db_dkihoc` (
  `id` int(11) NOT NULL,
  `sb_id` char(15) NOT NULL,
  `st_id` char(20) NOT NULL,
  `tea_id` int(11) NOT NULL,
  `ngay_dki` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_dkihoc`
--

INSERT INTO `db_dkihoc` (`id`, `sb_id`, `st_id`, `tea_id`, `ngay_dki`) VALUES
(1, 'HQTCSDL', '1951060664', 1, '2021-10-28'),
(68, 'CNW', '1951060664', 1, '2021-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `db_khoa`
--

CREATE TABLE `db_khoa` (
  `ma_khoa` char(25) NOT NULL,
  `ten_khoa` varchar(255) NOT NULL,
  `tb_khoa` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_khoa`
--

INSERT INTO `db_khoa` (`ma_khoa`, `ten_khoa`, `tb_khoa`) VALUES
('CT', 'Công trình', ''),
('HTTT', 'Hệ thống thông tin', ''),
('K', 'Kinh tế', ''),
('KTPM', 'Kĩ thuật phần mềm', ''),
('QTKD', 'Quản trị kinh doanh', '');

-- --------------------------------------------------------

--
-- Table structure for table `db_student`
--

CREATE TABLE `db_student` (
  `st_id` char(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ma_khoa` char(25) NOT NULL,
  `st_ten` varchar(50) NOT NULL,
  `st_lop` char(15) NOT NULL,
  `st_sdt` char(15) NOT NULL,
  `st_email` char(30) NOT NULL,
  `st_diachi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_student`
--

INSERT INTO `db_student` (`st_id`, `user_id`, `ma_khoa`, `st_ten`, `st_lop`, `st_sdt`, `st_email`, `st_diachi`) VALUES
('1951060664', 4, 'KTPM', 'Phạm Quốc Duy', '61PM1', '0936245396', 'duyph5588@gmail.com', 'Ha Noi');

-- --------------------------------------------------------

--
-- Table structure for table `db_subject`
--

CREATE TABLE `db_subject` (
  `sb_id` char(15) NOT NULL,
  `ma_khoa` char(25) NOT NULL,
  `tea_id` int(11) NOT NULL,
  `sb_ten` varchar(50) NOT NULL,
  `ngay_batdau` date NOT NULL,
  `ngay_ketthuc` date NOT NULL,
  `thoigian_hoc` varchar(50) NOT NULL,
  `sb_tinchi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_subject`
--

INSERT INTO `db_subject` (`sb_id`, `ma_khoa`, `tea_id`, `sb_ten`, `ngay_batdau`, `ngay_ketthuc`, `thoigian_hoc`, `sb_tinchi`) VALUES
('CNW', 'KTPM', 1, 'Công nghệ web', '2021-09-10', '2021-10-28', 'Tiết 7-9 (12h55-15h35) Thứ 2 và thứ 5', 3),
('CNW01', 'KTPM', 1, '[value-4]', '0000-00-00', '0000-00-00', '[value-7]', 0),
('HQTCSDL', 'KTPM', 2, 'Hệ quản trị cơ sở dữ liệu', '2021-09-01', '2021-10-26', 'Tiết 7-9 (12h55-15h35)', 3);

-- --------------------------------------------------------

--
-- Table structure for table `db_teacher`
--

CREATE TABLE `db_teacher` (
  `tea_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ma_khoa` char(25) NOT NULL,
  `tea_ten` varchar(50) NOT NULL,
  `tea_sdt` char(15) NOT NULL,
  `tea_email` char(50) NOT NULL,
  `tea_diachi` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_teacher`
--

INSERT INTO `db_teacher` (`tea_id`, `user_id`, `ma_khoa`, `tea_ten`, `tea_sdt`, `tea_email`, `tea_diachi`) VALUES
(1, 8, 'KTPM', 'Kiều Tuấn Dũng', '123456', 'ktdz@gmail.com', 'Hà Nội'),
(2, 10, 'HTTT', 'Nguyen Ngoc Quynh Chau', '123321123', 'nnqchau@gmail.com', 'Hà Nội'),
(3, 11, 'KTPM', 'Đoàn Thị Quế', '456456456', 'dtque@gmail.com', 'Hà Nội');

-- --------------------------------------------------------

--
-- Table structure for table `db_user`
--

CREATE TABLE `db_user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `email` char(255) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_user`
--

INSERT INTO `db_user` (`user_id`, `role_id`, `username`, `password`, `email`, `created_time`) VALUES
(1, 1, 'Admin1', '12345', 'test@gmail.com', '0000-00-00 00:00:00'),
(4, 3, 'PhamDuy', '12345', 'duyph5588@gmail.com', '0000-00-00 00:00:00'),
(6, 3, 'MinhVu', '$2y$10$3CCKkIGDNmy4hzK0ytFvMeq889eBCc3b131UCZU/gyTysJ3PI1p52', 'minhvu@gmail.com', '0000-00-00 00:00:00'),
(7, 3, 'MinhVuong', '$2y$10$hQNwMhugpqXUGRsiWwEY7u8s4rZM056rCONd41z5xzyucMedR.UEu', 'minhvuong@gmail.com', '0000-00-00 00:00:00'),
(8, 2, 'ktdz1', '12345', 'ktdz@gmail.com', '0000-00-00 00:00:00'),
(10, 2, 'NNQChau', '$2y$10$vqps4Li4qU1z7yUTdyIAV.YjfDIThGC4HeFOkoo5VX32fMDKg982O', 'nnqchau@gmail.com', '0000-00-00 00:00:00'),
(11, 2, 'Dtque', '$2y$10$QKsbn.w2sMJ16MWB29.FDOJ4WeR4rTolF1AjCRzHHYkoRUERT1ilK', 'dtque@gmail.com', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Teacher'),
(3, 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `damnhiemmn`
--
ALTER TABLE `damnhiemmn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tea_id` (`tea_id`),
  ADD KEY `sb_id` (`sb_id`);

--
-- Indexes for table `db_dkihoc`
--
ALTER TABLE `db_dkihoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sb_id` (`sb_id`),
  ADD KEY `st_id` (`st_id`),
  ADD KEY `tea_id` (`tea_id`);

--
-- Indexes for table `db_khoa`
--
ALTER TABLE `db_khoa`
  ADD PRIMARY KEY (`ma_khoa`);

--
-- Indexes for table `db_student`
--
ALTER TABLE `db_student`
  ADD PRIMARY KEY (`st_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ma_khoa` (`ma_khoa`);

--
-- Indexes for table `db_subject`
--
ALTER TABLE `db_subject`
  ADD PRIMARY KEY (`sb_id`),
  ADD KEY `ma_khoa` (`ma_khoa`),
  ADD KEY `tea_id` (`tea_id`);

--
-- Indexes for table `db_teacher`
--
ALTER TABLE `db_teacher`
  ADD PRIMARY KEY (`tea_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ma_khoa` (`ma_khoa`);

--
-- Indexes for table `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `damnhiemmn`
--
ALTER TABLE `damnhiemmn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_dkihoc`
--
ALTER TABLE `db_dkihoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `db_teacher`
--
ALTER TABLE `db_teacher`
  MODIFY `tea_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1235;

--
-- AUTO_INCREMENT for table `db_user`
--
ALTER TABLE `db_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `damnhiemmn`
--
ALTER TABLE `damnhiemmn`
  ADD CONSTRAINT `damnhiemmn_ibfk_1` FOREIGN KEY (`tea_id`) REFERENCES `db_teacher` (`tea_id`),
  ADD CONSTRAINT `damnhiemmn_ibfk_2` FOREIGN KEY (`sb_id`) REFERENCES `db_subject` (`sb_id`);

--
-- Constraints for table `db_dkihoc`
--
ALTER TABLE `db_dkihoc`
  ADD CONSTRAINT `db_dkihoc_ibfk_1` FOREIGN KEY (`sb_id`) REFERENCES `db_subject` (`sb_id`),
  ADD CONSTRAINT `db_dkihoc_ibfk_2` FOREIGN KEY (`st_id`) REFERENCES `db_student` (`st_id`),
  ADD CONSTRAINT `db_dkihoc_ibfk_3` FOREIGN KEY (`tea_id`) REFERENCES `db_teacher` (`tea_id`);

--
-- Constraints for table `db_student`
--
ALTER TABLE `db_student`
  ADD CONSTRAINT `db_student_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `db_user` (`user_id`),
  ADD CONSTRAINT `db_student_ibfk_2` FOREIGN KEY (`ma_khoa`) REFERENCES `db_khoa` (`ma_khoa`);

--
-- Constraints for table `db_subject`
--
ALTER TABLE `db_subject`
  ADD CONSTRAINT `db_subject_ibfk_1` FOREIGN KEY (`ma_khoa`) REFERENCES `db_khoa` (`ma_khoa`),
  ADD CONSTRAINT `db_subject_ibfk_2` FOREIGN KEY (`tea_id`) REFERENCES `db_teacher` (`tea_id`);

--
-- Constraints for table `db_teacher`
--
ALTER TABLE `db_teacher`
  ADD CONSTRAINT `db_teacher_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `db_user` (`user_id`),
  ADD CONSTRAINT `db_teacher_ibfk_2` FOREIGN KEY (`ma_khoa`) REFERENCES `db_khoa` (`ma_khoa`);

--
-- Constraints for table `db_user`
--
ALTER TABLE `db_user`
  ADD CONSTRAINT `db_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
