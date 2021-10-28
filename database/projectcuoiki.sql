-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 28, 2021 lúc 04:04 AM
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
  `id` int(11) NOT NULL,
  `sb_id` char(15) NOT NULL,
  `st_id` char(20) NOT NULL,
  `tea_id` int(11) NOT NULL,
  `ngay_dki` date NOT NULL,
  `phong_hoc` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_khoa`
--

CREATE TABLE `db_khoa` (
  `ma_khoa` char(25) NOT NULL,
  `ten_khoa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `db_khoa`
--

INSERT INTO `db_khoa` (`ma_khoa`, `ten_khoa`) VALUES
('KTPM', 'Kĩ thuật phần mềm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_student`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `db_student`
--

INSERT INTO `db_student` (`st_id`, `user_id`, `ma_khoa`, `st_ten`, `st_lop`, `st_sdt`, `st_email`, `st_diachi`) VALUES
('1951060664', 4, 'KTPM', 'Phạm Quốc Duy', '61PM1', '0936245396', 'duyph5588@gmail.com', 'Ha Noi'),
('1951060668', 1, 'KTPM', 'test', '61PM1', '123', 'test2', 'Hà Nội');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_subject`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_teacher`
--

CREATE TABLE `db_teacher` (
  `tea_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ma_khoa` char(25) NOT NULL,
  `tea_ten` varchar(50) NOT NULL,
  `tea_sdt` char(15) NOT NULL,
  `tea_email` char(50) NOT NULL,
  `tea_diachi` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_user`
--

CREATE TABLE `db_user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `email` char(255) NOT NULL,
  `created_time` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `db_user`
--

INSERT INTO `db_user` (`user_id`, `role_id`, `username`, `password`, `email`, `created_time`) VALUES
(1, 1, 'Admin1', '12345', 'test@gmail.com', '0000-00-00 00:00:00'),
(2, 2, 'Teacher', '$2y$10$cJSv1aYct2DYaZOjPxHKF.2xFvuZD5H81VHiHUX41HoZY5GvQoqFO', 'teacher@gmail.com', '0000-00-00 00:00:00'),
(4, 3, 'PhamDuy', '$2y$10$Rq/JzjJRnVlK5nm5g6kuVOIrmXfRHNPg.jJ/7OpJALvqhMKdCS0a2', 'duyph5588@gmail.com', '0000-00-00 00:00:00'),
(6, 3, 'MinhVu', '$2y$10$3CCKkIGDNmy4hzK0ytFvMeq889eBCc3b131UCZU/gyTysJ3PI1p52', 'minhvu@gmail.com', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Teacher'),
(3, 'Student');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `db_dkihoc`
--
ALTER TABLE `db_dkihoc`
  ADD PRIMARY KEY (`id`),
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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ma_khoa` (`ma_khoa`);

--
-- Chỉ mục cho bảng `db_subject`
--
ALTER TABLE `db_subject`
  ADD PRIMARY KEY (`sb_id`),
  ADD KEY `ma_khoa` (`ma_khoa`),
  ADD KEY `tea_id` (`tea_id`);

--
-- Chỉ mục cho bảng `db_teacher`
--
ALTER TABLE `db_teacher`
  ADD PRIMARY KEY (`tea_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ma_khoa` (`ma_khoa`);

--
-- Chỉ mục cho bảng `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `db_dkihoc`
--
ALTER TABLE `db_dkihoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `db_teacher`
--
ALTER TABLE `db_teacher`
  MODIFY `tea_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `db_user`
--
ALTER TABLE `db_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `db_student_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `db_user` (`user_id`),
  ADD CONSTRAINT `db_student_ibfk_2` FOREIGN KEY (`ma_khoa`) REFERENCES `db_khoa` (`ma_khoa`);

--
-- Các ràng buộc cho bảng `db_subject`
--
ALTER TABLE `db_subject`
  ADD CONSTRAINT `db_subject_ibfk_1` FOREIGN KEY (`ma_khoa`) REFERENCES `db_khoa` (`ma_khoa`),
  ADD CONSTRAINT `db_subject_ibfk_2` FOREIGN KEY (`tea_id`) REFERENCES `db_teacher` (`tea_id`);

--
-- Các ràng buộc cho bảng `db_teacher`
--
ALTER TABLE `db_teacher`
  ADD CONSTRAINT `db_teacher_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `db_user` (`user_id`),
  ADD CONSTRAINT `db_teacher_ibfk_2` FOREIGN KEY (`ma_khoa`) REFERENCES `db_khoa` (`ma_khoa`);

--
-- Các ràng buộc cho bảng `db_user`
--
ALTER TABLE `db_user`
  ADD CONSTRAINT `db_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
