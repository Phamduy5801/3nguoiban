-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2021 at 06:25 AM
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
-- Table structure for table `db_dkihoc`
--

CREATE TABLE `db_dkihoc` (
  `sb_id` char(50) NOT NULL,
  `st_id` char(15) NOT NULL,
  `tea_id` int(11) NOT NULL,
  `ngay_dki` date NOT NULL,
  `ten_monhoc` varchar(255) NOT NULL,
  `lop_hoc` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_khoa`
--

CREATE TABLE `db_khoa` (
  `ma_khoa` char(15) NOT NULL,
  `ten_khoa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_student`
--

CREATE TABLE `db_student` (
  `st_id` char(15) NOT NULL,
  `st_ten` varchar(50) NOT NULL,
  `st_lop` char(15) NOT NULL,
  `st_sdt` char(15) NOT NULL,
  `st_email` char(50) NOT NULL,
  `st_diachi` varchar(255) NOT NULL,
  `ma_khoa` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_subject`
--

CREATE TABLE `db_subject` (
  `sb_id` char(50) NOT NULL,
  `ma_khoa` char(15) NOT NULL,
  `sb_ten` varchar(255) NOT NULL,
  `ngay_batdau` date NOT NULL,
  `ngay_ketthuc` date NOT NULL,
  `thoigian_hoc` varchar(255) NOT NULL,
  `giang_vien` varchar(50) NOT NULL,
  `sb_tinchi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_teacher`
--

CREATE TABLE `db_teacher` (
  `tea_id` int(11) NOT NULL,
  `tea_ten` varchar(50) NOT NULL,
  `tea_sdt` char(15) NOT NULL,
  `tea_email` char(50) NOT NULL,
  `tea_diachi` varchar(255) NOT NULL,
  `ma_khoa` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_user`
--

CREATE TABLE `db_user` (
  `id` int(11) NOT NULL,
  `username` char(255) NOT NULL,
  `password` char(50) NOT NULL,
  `email` char(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expiry_date` date NOT NULL,
  `st_id` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_dkihoc`
--
ALTER TABLE `db_dkihoc`
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
  ADD KEY `ma_khoa` (`ma_khoa`);

--
-- Indexes for table `db_subject`
--
ALTER TABLE `db_subject`
  ADD PRIMARY KEY (`sb_id`),
  ADD KEY `ma_khoa` (`ma_khoa`);

--
-- Indexes for table `db_teacher`
--
ALTER TABLE `db_teacher`
  ADD PRIMARY KEY (`tea_id`),
  ADD KEY `ma_khoa` (`ma_khoa`);

--
-- Indexes for table `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `st_id` (`st_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `db_student_ibfk_1` FOREIGN KEY (`ma_khoa`) REFERENCES `db_khoa` (`ma_khoa`);

--
-- Constraints for table `db_subject`
--
ALTER TABLE `db_subject`
  ADD CONSTRAINT `db_subject_ibfk_1` FOREIGN KEY (`ma_khoa`) REFERENCES `db_khoa` (`ma_khoa`);

--
-- Constraints for table `db_teacher`
--
ALTER TABLE `db_teacher`
  ADD CONSTRAINT `db_teacher_ibfk_1` FOREIGN KEY (`ma_khoa`) REFERENCES `db_khoa` (`ma_khoa`);

--
-- Constraints for table `db_user`
--
ALTER TABLE `db_user`
  ADD CONSTRAINT `db_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `db_user_ibfk_2` FOREIGN KEY (`st_id`) REFERENCES `db_student` (`st_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
