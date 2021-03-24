-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 10, 2018 at 07:56 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kimlong`
--

-- --------------------------------------------------------

--
-- Table structure for table `vnw_configs`
--

DROP TABLE IF EXISTS `vnw_configs`;
CREATE TABLE IF NOT EXISTS `vnw_configs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci,
  `content1` text COLLATE utf8mb4_unicode_ci,
  `content2` text COLLATE utf8mb4_unicode_ci,
  `content3` text COLLATE utf8mb4_unicode_ci,
  `content4` text COLLATE utf8mb4_unicode_ci,
  `content5` text COLLATE utf8mb4_unicode_ci,
  `content6` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_configs`
--

INSERT INTO `vnw_configs` (`id`, `name`, `content`, `content1`, `content2`, `content3`, `content4`, `content5`, `content6`, `created_at`, `updated_at`) VALUES
(1, 'Header', '{\"favicon\":\"http://qcthong.vnwis/uploads/source/logo.png\", \"logo\":\"http://qcthong.vnwis/uploads/source/logo.png\",\"quangcao\":\"http://qcthong.vnwis/uploads/source/taisao.png\", \"hotline1\":\"545454545454\", \"hotline2\":\"thiengoan@gmail.com\", \"facebook\":\"\", \"skype\":\"\", \"youtube\":\"\", \"linkedin\":\"\"}', '{\"pic1\":\"http://qcthong.vnwis/uploads/source/images%20(4).png\",\"pic2\":\"http://qcthong.vnwis/uploads/source/images%20(2).jpg\",\"pic3\":\"http://qcthong.vnwis/uploads/source/images%20(1).jpg\",\"pic4\":\"http://qcthong.vnwis/uploads/source/images.jpg\",\"pic5\":\"http://qcthong.vnwis/uploads/source/images%20(4).png\",\"pic6\":\"http://qcthong.vnwis/uploads/source/images%20(2).jpg\",\"pic7\":\"http://qcthong.vnwis/uploads/source/images%20(3).png\",\"pic8\":\"http://qcthong.vnwis/uploads/source/download%20(2).jpg\"}', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-09 03:08:13'),
(2, 'Footer', '<p>Cong ty toi</p>', NULL, '{\"video1\":\"https://www.youtube.com/watch?v=OcN08qZo16A\",\"video2\":\"https://www.youtube.com/watch?v=OcN08qZo16A\",\"video3\":\"https://www.youtube.com/watch?v=OcN08qZo16A\",\"video4\":\"https://www.youtube.com/watch?v=OcN08qZo16A\",\"video5\":\"https://www.youtube.com/watch?v=OcN08qZo16A\"}', 'https://www.facebook.com/thietkewebsitetannoi', NULL, NULL, NULL, NULL, '2018-05-08 21:40:39'),
(3, 'Code', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vnw_contacts`
--

DROP TABLE IF EXISTS `vnw_contacts`;
CREATE TABLE IF NOT EXISTS `vnw_contacts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_contacts`
--

INSERT INTO `vnw_contacts` (`id`, `source`, `full_name`, `address`, `telephone`, `email`, `subject`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Trang liên hệ', 'Anh Hưng', '215 Lý Thường Kiệt, P.13, Q.10, TPHCM', '0932 009 009', 'hungpro@gmail.com', 'Anh thích thì anh liên hệ thôi', 'Anh thích thì anh liên hệ thôi, có vấn đề gì không?', 1, '2018-05-08 20:22:55', '2018-05-08 20:22:55'),
(2, 'Trang giới thiệu', 'Chị Phấn', '215 Lý Thường Kiệt, P.13, Q.10, TPHCM', '0932 999 999', 'phanpro@gmail.com', 'Chị thích thì anh liên hệ thôi', 'Chị thích thì anh liên hệ thôi, có vấn đề gì không?', 1, '2018-05-08 20:22:55', '2018-05-08 20:22:55'),
(3, 'Trang liên hệ', 'sdss', NULL, 'dsd', 'dsd', 'dsdd', 'dsds', 1, '2018-05-09 17:57:57', '2018-05-09 17:57:57');

-- --------------------------------------------------------

--
-- Table structure for table `vnw_menus`
--

DROP TABLE IF EXISTS `vnw_menus`;
CREATE TABLE IF NOT EXISTS `vnw_menus` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_menu_name_unique` (`menu_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_menus`
--

INSERT INTO `vnw_menus` (`id`, `menu_name`, `menu_content`, `created_at`, `updated_at`) VALUES
(1, 'Top Menu', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vnw_migrations`
--

DROP TABLE IF EXISTS `vnw_migrations`;
CREATE TABLE IF NOT EXISTS `vnw_migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_migrations`
--

INSERT INTO `vnw_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_03_22_085553_create_post_tags_table', 1),
(4, '2018_03_24_094250_create_post_categories_table', 1),
(5, '2018_03_26_013224_create_posts_table', 1),
(6, '2018_03_26_152750_create_post_tag_table', 1),
(7, '2018_03_27_033207_create_menus_table', 1),
(8, '2018_04_06_030152_create_product_categories_table', 1),
(9, '2018_04_06_030213_create_products_table', 1),
(10, '2018_04_06_042039_create_product_images_table', 1),
(11, '2018_04_07_023445_create_product_tags_table', 1),
(12, '2018_04_07_023531_create_product_tag_table', 1),
(13, '2018_04_07_041839_create_contacts_table', 1),
(14, '2018_04_07_162449_create_configs_table', 1),
(15, '2018_04_08_133324_create_static_pages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vnw_password_resets`
--

DROP TABLE IF EXISTS `vnw_password_resets`;
CREATE TABLE IF NOT EXISTS `vnw_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vnw_posts`
--

DROP TABLE IF EXISTS `vnw_posts`;
CREATE TABLE IF NOT EXISTS `vnw_posts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_description` text COLLATE utf8mb4_unicode_ci,
  `post_content` text COLLATE utf8mb4_unicode_ci,
  `post_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_status` tinyint(4) NOT NULL DEFAULT '1',
  `post_seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `post_seo_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `h1_tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `h2_tag` text COLLATE utf8mb4_unicode_ci,
  `h3_tag` text COLLATE utf8mb4_unicode_ci,
  `category_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_category_id_foreign` (`category_id`),
  KEY `posts_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_posts`
--

INSERT INTO `vnw_posts` (`id`, `post_title`, `post_slug`, `post_description`, `post_content`, `post_image`, `post_status`, `post_seo_title`, `post_seo_description`, `h1_tag`, `h2_tag`, `h3_tag`, `category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'tin tuc chung toi', 'tin-tuc-chung-toi', 'Tại tòa hôm nay, cựu Chủ tịch PVN tiếp tục khẳng định không phạm tội. Ông Thăng lý giải, phiên tòa hồi tháng 1 chưa xem xét toàn diện bối cảnh dự án Thái Bình 2 trong hoàn cảnh chung. Lúc đó, các tập đoàn kinh tế được phép đầu tư, phát triển kinh tế đa ngành.', NULL, 'http://qcthong.vnwis/uploads/source/images%20(1).jpg', 1, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-08 22:03:36', '2018-05-08 22:09:45'),
(2, 'tin tuc chung toi 2', 'tin-tuc-chung-toi', 'Tại tòa hôm nay, cựu Chủ tịch PVN tiếp tục khẳng định không phạm tội. Ông Thăng lý giải, phiên tòa hồi tháng 1 chưa xem xét toàn diện bối cảnh dự án Thái Bình 2 trong hoàn cảnh chung. Lúc đó, các tập đoàn kinh tế được phép đầu tư, phát triển kinh tế đa ngành.', NULL, 'http://qcthong.vnwis/uploads/source/images%20(4).png', 1, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-08 22:03:53', '2018-05-08 22:09:52'),
(3, 'tin tuc chung toi 3', 'tin-tuc-chung-toi-3', 'tin tuc', NULL, 'http://qcthong.vnwis/uploads/source/download%20(2).jpg', 1, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-08 23:48:04', '2018-05-08 23:48:04'),
(4, 'tin tuc chung toi 3', 'tin-tuc-chung-toi-3', NULL, NULL, 'http://qcthong.vnwis/uploads/source/images%20(4).png', 1, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-08 23:48:44', '2018-05-08 23:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `vnw_post_categories`
--

DROP TABLE IF EXISTS `vnw_post_categories`;
CREATE TABLE IF NOT EXISTS `vnw_post_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_seo_description` text COLLATE utf8mb4_unicode_ci,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_post_categories`
--

INSERT INTO `vnw_post_categories` (`id`, `category_name`, `category_slug`, `category_seo_title`, `category_seo_description`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Chuyên Mục 1', 'chuyen-muc-1', 'Chuyên Mục 1', 'Day la Chuyên Mục 1', 0, NULL, NULL),
(2, 'Chuyên Mục 2', 'chuyen-muc-2', 'Chuyên Mục 2', 'Day la Chuyên Mục 2', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vnw_post_tag`
--

DROP TABLE IF EXISTS `vnw_post_tag`;
CREATE TABLE IF NOT EXISTS `vnw_post_tag` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_tag_post_id_foreign` (`post_id`),
  KEY `post_tag_tag_id_foreign` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vnw_post_tags`
--

DROP TABLE IF EXISTS `vnw_post_tags`;
CREATE TABLE IF NOT EXISTS `vnw_post_tags` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_seo_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_post_tags`
--

INSERT INTO `vnw_post_tags` (`id`, `tag_name`, `tag_slug`, `tag_seo_title`, `tag_seo_description`, `created_at`, `updated_at`) VALUES
(1, 'Tag 1', 'tag-1', 'tag 1', 'Day la tag 1', NULL, NULL),
(2, 'Tag 2', 'tag-2', 'tag 2', 'Day la tag 2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vnw_products`
--

DROP TABLE IF EXISTS `vnw_products`;
CREATE TABLE IF NOT EXISTS `vnw_products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `masanpham` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `nhasanxuat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `product_old_price` int(11) DEFAULT '0',
  `product_new_price` int(11) DEFAULT '0',
  `product_description` text COLLATE utf8mb4_unicode_ci,
  `product_content` text COLLATE utf8mb4_unicode_ci,
  `product_feature_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_status` tinyint(4) NOT NULL DEFAULT '1',
  `product_noibat` tinyint(4) NOT NULL DEFAULT '0',
  `product_banchay` tinyint(4) NOT NULL DEFAULT '0',
  `product_view` int(11) NOT NULL DEFAULT '0',
  `stt` int(11) NOT NULL DEFAULT '1',
  `xuatxu` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `baohanh` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `product_seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `product_seo_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `h1_tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `h2_tag` text COLLATE utf8mb4_unicode_ci,
  `h3_tag` text COLLATE utf8mb4_unicode_ci,
  `product_category_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_product_category_id_foreign` (`product_category_id`),
  KEY `products_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_products`
--

INSERT INTO `vnw_products` (`id`, `product_title`, `product_slug`, `masanpham`, `nhasanxuat`, `product_old_price`, `product_new_price`, `product_description`, `product_content`, `product_feature_image`, `product_status`, `product_noibat`, `product_banchay`, `product_view`, `stt`, `xuatxu`, `baohanh`, `product_seo_title`, `product_seo_description`, `h1_tag`, `h2_tag`, `h3_tag`, `product_category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'dich vu noi bat', 'dich-vu-noi-bat', NULL, NULL, 0, 0, 'dsdsdsdssdsdsdsdsdss', NULL, 'http://qcthong.vnwis/uploads/source/dichvu.png', 1, 1, 0, 0, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-09 00:54:33', '2018-05-10 00:10:58'),
(2, 'bang quang cao', 'bang-quang-cao', NULL, NULL, 0, 0, NULL, NULL, 'http://qcthong.vnwis/uploads/source/congtrinh1.png', 1, 0, 1, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-09 06:34:55', '2018-05-09 06:35:03'),
(3, 'sơn tráng kẽm AAA', 'son-trang-kem-aaa', NULL, NULL, 0, 0, NULL, NULL, 'http://qcthong.vnwis/uploads/source/congtrinh%20(1).png', 1, 0, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-09 06:49:50', '2018-05-09 08:00:25'),
(4, 'quang cao', 'quang-cao', NULL, NULL, 0, 0, NULL, NULL, 'http://qcthong.vnwis/uploads/source/bien-quang-cao-may-tinh.jpg', 1, 1, 1, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-09 07:05:37', '2018-05-09 21:04:41'),
(5, 'quang cao fdfd', 'quang-cao-fdfd', NULL, NULL, 0, 0, NULL, NULL, 'http://qcthong.vnwis/uploads/source/received_1542206829132105-1.jpg', 1, 1, 1, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-09 07:06:14', '2018-05-09 21:04:39'),
(6, 'bang quang cao dfd', 'bang-quang-cao-dfd', NULL, NULL, 0, 0, 'dfdfdfdf', NULL, 'http://qcthong.vnwis/uploads/source/lam-bang-quang-cao.jpg', 1, 0, 1, 2, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-09 07:06:40', '2018-05-09 21:05:38'),
(7, 'ngoan', 'ngoan', NULL, NULL, 0, 0, NULL, NULL, 'http://qcthong.vnwis/uploads/source/pano.jpg', 1, 0, 1, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-09 22:06:44', '2018-05-09 22:07:28'),
(8, 'dsdsssdsdsdds', 'dsdsssdsdsdds', NULL, NULL, 0, 0, 'dsdsd', NULL, 'http://qcthong.vnwis/uploads/source/pano.jpg', 1, 0, 1, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-09 22:07:08', '2018-05-09 22:07:31');

-- --------------------------------------------------------

--
-- Table structure for table `vnw_product_categories`
--

DROP TABLE IF EXISTS `vnw_product_categories`;
CREATE TABLE IF NOT EXISTS `vnw_product_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category_price` int(11) DEFAULT '0',
  `product_category_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_category_description` text COLLATE utf8mb4_unicode_ci,
  `product_category_seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_category_seo_description` text COLLATE utf8mb4_unicode_ci,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_product_categories`
--

INSERT INTO `vnw_product_categories` (`id`, `product_category_name`, `product_category_slug`, `product_category_price`, `product_category_image`, `product_category_description`, `product_category_seo_title`, `product_category_seo_description`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'BẢNG QUẢNG CÁO NGOÀI TRỜI', 'product-category-1', 0, 'http://qcthong.vnwis/uploads/source/congtrinh.png', 'Tổ ĐBQH TP.HCM gồm ông Phan Nguyễn Như Khuê, bà Nguyễn Thị Quyết Tâm, Trịnh Ngọc Thúy đang tiếp xúc cử tri quận 2, hàng chục phóng viên các cơ quan truyền thông đến đưa tin.', 'Product Category 1', 'Day la Product Category 1', 0, NULL, '2018-05-09 01:35:14'),
(2, 'Thiết kế bảng hiệu', 'product-category-2', 130000, 'http://qcthong.vnwis/uploads/source/images%20(1).jpg', 'Tổ ĐBQH TP.HCM gồm ông Phan Nguyễn Như Khuê, bà Nguyễn Thị Quyết Tâm, Trịnh Ngọc Thúy đang tiếp xúc cử tri quận 2, hàng chục phóng viên các cơ quan truyền thông đến đưa tin.', 'Product Category 2', 'Day la Product Category 2', 0, NULL, '2018-05-09 01:35:41'),
(5, 'Quảng cáo LED', 'quang-cao-led', 0, 'http://qcthong.vnwis/uploads/source/slide.png', 'Tổ ĐBQH TP.HCM gồm ông Phan Nguyễn Như Khuê, bà Nguyễn Thị Quyết Tâm, Trịnh Ngọc Thúy đang tiếp xúc cử tri quận 2, hàng chục phóng viên các cơ quan truyền thông đến đưa tin.', NULL, NULL, 0, '2018-05-09 01:24:04', '2018-05-09 01:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `vnw_product_images`
--

DROP TABLE IF EXISTS `vnw_product_images`;
CREATE TABLE IF NOT EXISTS `vnw_product_images` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vnw_product_tag`
--

DROP TABLE IF EXISTS `vnw_product_tag`;
CREATE TABLE IF NOT EXISTS `vnw_product_tag` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_tag_product_id_foreign` (`product_id`),
  KEY `product_tag_tag_id_foreign` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vnw_product_tags`
--

DROP TABLE IF EXISTS `vnw_product_tags`;
CREATE TABLE IF NOT EXISTS `vnw_product_tags` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_seo_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_product_tags`
--

INSERT INTO `vnw_product_tags` (`id`, `tag_name`, `tag_slug`, `tag_seo_title`, `tag_seo_description`, `created_at`, `updated_at`) VALUES
(1, 'Product Tag 1', 'product-tag-1', 'Product tag 1', 'Day la Product tag 1', NULL, NULL),
(2, 'Product Tag 2', 'product-tag-2', 'Product tag 2', 'Day la Product tag 2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vnw_static_pages`
--

DROP TABLE IF EXISTS `vnw_static_pages`;
CREATE TABLE IF NOT EXISTS `vnw_static_pages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci,
  `content_1` text COLLATE utf8mb4_unicode_ci,
  `content_2` text COLLATE utf8mb4_unicode_ci,
  `content_3` text COLLATE utf8mb4_unicode_ci,
  `content_4` text COLLATE utf8mb4_unicode_ci,
  `content_5` text COLLATE utf8mb4_unicode_ci,
  `h1_tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `h2_tag` text COLLATE utf8mb4_unicode_ci,
  `h3_tag` text COLLATE utf8mb4_unicode_ci,
  `seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `seo_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_static_pages`
--

INSERT INTO `vnw_static_pages` (`id`, `name`, `title`, `content`, `content_1`, `content_2`, `content_3`, `content_4`, `content_5`, `h1_tag`, `h2_tag`, `h3_tag`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 'Home Page', '', '{\"link0\":\"http://qcthong.vnwis/uploads/source/slide.png\",\"link1\":\"http://qcthong.vnwis/uploads/source/quangcao2.png\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-09 01:01:19'),
(2, 'About Us', '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', NULL, NULL),
(3, 'Contact Us', 'Công ty quang  cao', '<p>sdsdsddsdd</p>\r\n\r\n<p>sd</p>\r\n\r\n<p>sdsd</p>\r\n\r\n<p>dsdsds</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-09 19:04:21'),
(4, 'Sản Phẩm', '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', NULL, NULL),
(5, 'Tuyển Dụng', 'tuyen dung', '<p>sdsdsdsd</p>', NULL, NULL, NULL, NULL, NULL, 'dsds', 'dsdsd', 'đsdd', 'dsds', 'ddsd', NULL, '2018-05-09 18:44:28');

-- --------------------------------------------------------

--
-- Table structure for table `vnw_users`
--

DROP TABLE IF EXISTS `vnw_users`;
CREATE TABLE IF NOT EXISTS `vnw_users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT '2',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_users`
--

INSERT INTO `vnw_users` (`id`, `username`, `name`, `email`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'admin@gmail.com', '$2y$10$c/gntaNdlvbvlSwlFSfWWuBfY9rNjHmGeCzp5e0P0bXawPSe8DFIG', 1, NULL, NULL, NULL),
(2, 'user1', 'User 1', 'user1@gmail.com', '$2y$10$q3ZqtJD8yffP5SM.Bjlc5.Gytdf4esmSlQ4zQRrY9Rx/V4kYSHWNe', 2, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vnw_posts`
--
ALTER TABLE `vnw_posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `vnw_post_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `vnw_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vnw_post_tag`
--
ALTER TABLE `vnw_post_tag`
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `vnw_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `vnw_post_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vnw_products`
--
ALTER TABLE `vnw_products`
  ADD CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `vnw_product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `vnw_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vnw_product_images`
--
ALTER TABLE `vnw_product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `vnw_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vnw_product_tag`
--
ALTER TABLE `vnw_product_tag`
  ADD CONSTRAINT `product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `vnw_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `vnw_product_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
