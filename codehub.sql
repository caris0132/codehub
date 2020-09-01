-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th9 01, 2020 lúc 05:02 PM
-- Phiên bản máy phục vụ: 10.4.10-MariaDB
-- Phiên bản PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `codehub`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_permission`
--

DROP TABLE IF EXISTS `table_permission`;
CREATE TABLE IF NOT EXISTS `table_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `per_group_id` int(11) DEFAULT NULL,
  `model` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_permission_group`
--

DROP TABLE IF EXISTS `table_permission_group`;
CREATE TABLE IF NOT EXISTS `table_permission_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stt` int(11) DEFAULT NULL,
  `hienthi` int(1) DEFAULT NULL,
  `ngaytao` int(11) DEFAULT NULL,
  `ngaysua` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_product_list`
--

DROP TABLE IF EXISTS `table_product_list`;
CREATE TABLE IF NOT EXISTS `table_product_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_vi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ten_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noidung_vi` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noidung_en` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hienthi` int(11) DEFAULT NULL,
  `noibat` int(11) DEFAULT NULL,
  `photo` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngaytao` int(11) DEFAULT NULL,
  `ngaysua` int(11) DEFAULT NULL,
  `mota_vi` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mota_en` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stt` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_user`
--

DROP TABLE IF EXISTS `table_user`;
CREATE TABLE IF NOT EXISTS `table_user` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_nhomquyen` int(11) DEFAULT 0,
  `username` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maxacnhan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dienthoai` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachi` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gioitinh` tinyint(1) DEFAULT 0,
  `login_session` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastlogin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hienthi` tinyint(1) DEFAULT 0,
  `quyen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaysinh` int(11) DEFAULT 0,
  `stt` int(11) DEFAULT 0,
  `is_root` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `table_user`
--

INSERT INTO `table_user` (`id`, `id_nhomquyen`, `username`, `password`, `maxacnhan`, `avatar`, `ten`, `dienthoai`, `email`, `diachi`, `gioitinh`, `login_session`, `user_token`, `lastlogin`, `hienthi`, `quyen`, `ngaysinh`, `stt`, `is_root`) VALUES
(1, 0, 'admin', '222f1525c510ad3aea64c99e06240d63', '', '', 'ADMIN', '', '', '', 0, '1f88f222897441aacb56b427fe55da0a', '04c130ed991e4f03e5cacf436ca06bd9', '1598947706', 1, '1f88f222897441aacb56b427fe55da0a', 0, 0, 1),
(59, 0, 'coder', '4d82cf22472b6767cfa4c852c967016c', '', '', 'Diệp Phúc Tài', '0939 584 506', 'phuctai.nina@gmail.com', 'Đường huỳnh thị na, xã đông thạnh, huyện hóc môn', 1, '63b3cc71a5199a0bf35ecaa73431d78f', '1db29cadfe50f1d9c70144406723740f', '1592972710', 1, '63b3cc71a5199a0bf35ecaa73431d78f', 774205200, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_user_limit`
--

DROP TABLE IF EXISTS `table_user_limit`;
CREATE TABLE IF NOT EXISTS `table_user_limit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `login_attempts` int(11) NOT NULL,
  `attempt_time` int(11) NOT NULL,
  `locked_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `table_user_limit`
--

INSERT INTO `table_user_limit` (`id`, `login_ip`, `login_attempts`, `attempt_time`, `locked_time`) VALUES
(1, '::1', 0, 1593186736, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_user_log`
--

DROP TABLE IF EXISTS `table_user_log`;
CREATE TABLE IF NOT EXISTS `table_user_log` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT 0,
  `ip` varchar(16) COLLATE utf8_unicode_ci DEFAULT '0.0.0.0',
  `timelog` int(11) DEFAULT 0,
  `user_agent` text COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `table_user_log`
--

INSERT INTO `table_user_log` (`id`, `id_user`, `ip`, `timelog`, `user_agent`) VALUES
(1, 1, '::1', 1598944939, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'),
(2, 1, '::1', 1598944985, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'),
(3, 1, '::1', 1598946100, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'),
(4, 1, '::1', 1598946266, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'),
(5, 1, '::1', 1598947631, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'),
(6, 1, '::1', 1598947706, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
