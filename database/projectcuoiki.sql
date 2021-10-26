-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 25, 2021 lúc 03:29 PM
-- Phiên bản máy phục vụ: 8.0.17
-- Phiên bản PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `projectcuoiki`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_dkihoc`
--

CREATE TABLE `db_dkihoc` (
  `sb_id` char(50) NOT NULL,
  `st_id` char(15) NOT NULL,
  `tea_id` int(11) NOT NULL,
  `ngay_dki` date NOT NULL,
  `ten_monhoc` varchar(255) NOT NULL,
  `lop_hoc` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_khoa`
--

CREATE TABLE `db_khoa` (
  `ma_khoa` char(15) NOT NULL,
  `ten_khoa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_student`
--

CREATE TABLE `db_student` (
  `st_id` char(15) NOT NULL,
  `st_ten` varchar(50) NOT NULL,
  `st_lop` char(15) NOT NULL,
  `st_sdt` char(15) NOT NULL,
  `st_email` char(50) NOT NULL,
  `st_diachi` varchar(255) NOT NULL,
  `ma_khoa` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_subject`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_teacher`
--

CREATE TABLE `db_teacher` (
  `tea_id` int(11) NOT NULL,
  `tea_ten` varchar(50) NOT NULL,
  `tea_sdt` char(15) NOT NULL,
  `tea_email` char(50) NOT NULL,
  `tea_diachi` varchar(255) NOT NULL,
  `ma_khoa` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_user`
--

CREATE TABLE `db_user` (
  `id` int(11) NOT NULL,
  `username` char(255) NOT NULL,
  `password` char(50) NOT NULL,
  `email` char(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_time` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `db_dkihoc`
--
ALTER TABLE `db_dkihoc`
  ADD KEY `sb_id` (`sb_id`),
  ADD KEY `st_id` (`st_id`),
  ADD KEY `tea_id` (`tea_id`);

--
-- Chỉ mục cho bảng `db_khoa`
--
ALTER TABLE `db_khoa`
  ADD PRIMARY KEY (`ma_khoa`);

--
-- Chỉ mục cho bảng `db_student`
--
ALTER TABLE `db_student`
  ADD PRIMARY KEY (`st_id`),
  ADD KEY `ma_khoa` (`ma_khoa`);

--
-- Chỉ mục cho bảng `db_subject`
--
ALTER TABLE `db_subject`
  ADD PRIMARY KEY (`sb_id`),
  ADD KEY `ma_khoa` (`ma_khoa`);

--
-- Chỉ mục cho bảng `db_teacher`
--
ALTER TABLE `db_teacher`
  ADD PRIMARY KEY (`tea_id`),
  ADD KEY `ma_khoa` (`ma_khoa`);

--
-- Chỉ mục cho bảng `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `db_dkihoc`
--
ALTER TABLE `db_dkihoc`
  ADD CONSTRAINT `db_dkihoc_ibfk_1` FOREIGN KEY (`sb_id`) REFERENCES `db_subject` (`sb_id`),
  ADD CONSTRAINT `db_dkihoc_ibfk_2` FOREIGN KEY (`st_id`) REFERENCES `db_student` (`st_id`),
  ADD CONSTRAINT `db_dkihoc_ibfk_3` FOREIGN KEY (`tea_id`) REFERENCES `db_teacher` (`tea_id`);

--
-- Các ràng buộc cho bảng `db_student`
--
ALTER TABLE `db_student`
  ADD CONSTRAINT `db_student_ibfk_1` FOREIGN KEY (`ma_khoa`) REFERENCES `db_khoa` (`ma_khoa`);

--
-- Các ràng buộc cho bảng `db_subject`
--
ALTER TABLE `db_subject`
  ADD CONSTRAINT `db_subject_ibfk_1` FOREIGN KEY (`ma_khoa`) REFERENCES `db_khoa` (`ma_khoa`);

--
-- Các ràng buộc cho bảng `db_teacher`
--
ALTER TABLE `db_teacher`
  ADD CONSTRAINT `db_teacher_ibfk_1` FOREIGN KEY (`ma_khoa`) REFERENCES `db_khoa` (`ma_khoa`);

--
-- Các ràng buộc cho bảng `db_user`
--
ALTER TABLE `db_user`
  ADD CONSTRAINT `db_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
