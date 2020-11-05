-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th10 05, 2020 lúc 05:22 PM
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
-- Cấu trúc bảng cho bảng `table_gallery`
--

DROP TABLE IF EXISTS `table_gallery`;
CREATE TABLE IF NOT EXISTS `table_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `com` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `own_id` int(11) DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stt` int(11) DEFAULT NULL,
  `hienthi` int(11) DEFAULT NULL,
  `ngaytao` int(11) DEFAULT NULL,
  `ngaysua` int(11) DEFAULT NULL,
  `ten` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Cấu trúc bảng cho bảng `table_product`
--

DROP TABLE IF EXISTS `table_product`;
CREATE TABLE IF NOT EXISTS `table_product` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_list` int(11) DEFAULT 0,
  `id_item` int(11) DEFAULT 0,
  `id_cat` int(11) DEFAULT 0,
  `id_sub` int(11) DEFAULT 0,
  `id_brand` int(11) DEFAULT 0,
  `id_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_mau` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_tags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noibat` tinyint(1) DEFAULT 0,
  `moi` tinyint(1) DEFAULT 0,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tenkhongdau` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noidung_en` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `noidung_vi` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `mota_en` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `mota_vi` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_vi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `taptin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `masp` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giaban` double DEFAULT 0,
  `giacu` double DEFAULT 0,
  `giamoi` double DEFAULT 0,
  `tinhtrang` tinyint(1) DEFAULT 0,
  `link_video` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `stt` int(11) DEFAULT 0,
  `hienthi` tinyint(1) DEFAULT 0,
  `type` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaytao` int(11) DEFAULT 0,
  `ngaysua` int(11) DEFAULT 0,
  `luotxem` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `table_product`
--

INSERT INTO `table_product` (`id`, `id_list`, `id_item`, `id_cat`, `id_sub`, `id_brand`, `id_size`, `id_mau`, `id_tags`, `noibat`, `moi`, `photo`, `options`, `tenkhongdau`, `noidung_en`, `noidung_vi`, `mota_en`, `mota_vi`, `ten_en`, `ten_vi`, `taptin`, `link`, `masp`, `giaban`, `giacu`, `giamoi`, `tinhtrang`, `link_video`, `stt`, `hienthi`, `type`, `ngaytao`, `ngaysua`, `luotxem`) VALUES
(35, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, 0, 'preview-watermark-5253.jpg', NULL, 'ad-ad', '', '', '', '', '', 'ad ad', NULL, NULL, NULL, 0, 0, 0, 0, NULL, 1, 1, 'san-pham', 1604377981, 1604566241, 0);

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
-- Cấu trúc bảng cho bảng `table_seo`
--

DROP TABLE IF EXISTS `table_seo`;
CREATE TABLE IF NOT EXISTS `table_seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `own_id` int(11) DEFAULT NULL,
  `com` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `table_seo`
--

INSERT INTO `table_seo` (`id`, `own_id`, `com`, `lang`, `title`, `keywords`, `description`) VALUES
(64, 35, 'product', 'en', 'dada', 'adada', 'ada'),
(63, 35, 'product', 'vi', 'ad ad', 'ad ad', 'adadadad ad ');

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
(1, 0, 'admin', '222f1525c510ad3aea64c99e06240d63', '', '', 'ADMIN', '', '', '', 0, '1f88f222897441aacb56b427fe55da0a', '62ed31709f4d7bfe67eef08293794447', '1604566253', 1, '1f88f222897441aacb56b427fe55da0a', 0, 0, 1),
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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `table_user_log`
--

INSERT INTO `table_user_log` (`id`, `id_user`, `ip`, `timelog`, `user_agent`) VALUES
(1, 1, '::1', 1598944939, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'),
(2, 1, '::1', 1598944985, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'),
(3, 1, '::1', 1598946100, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'),
(4, 1, '::1', 1598946266, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'),
(5, 1, '::1', 1598947631, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'),
(6, 1, '::1', 1598947706, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'),
(7, 1, '::1', 1599095638, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
(8, 1, '::1', 1601865880, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36'),
(9, 1, '::1', 1601957230, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36'),
(10, 1, '::1', 1602042616, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36'),
(11, 1, '::1', 1602213104, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36'),
(12, 1, '::1', 1602213131, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36'),
(13, 1, '::1', 1602492362, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36'),
(14, 1, '::1', 1602662166, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36'),
(15, 1, '::1', 1604117089, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36'),
(16, 1, '::1', 1604280892, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36'),
(17, 1, '::1', 1604281483, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36'),
(18, 1, '::1', 1604367090, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36'),
(19, 1, '::1', 1604558512, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36'),
(20, 1, '::1', 1604566253, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
