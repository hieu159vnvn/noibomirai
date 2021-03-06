-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 11, 2018 at 01:31 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.0.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vnwisco_cncqc`
--

-- --------------------------------------------------------

--
-- Table structure for table `vnw_configs`
--

CREATE TABLE `vnw_configs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci,
  `content1` text COLLATE utf8mb4_unicode_ci,
  `content2` text COLLATE utf8mb4_unicode_ci,
  `content3` text COLLATE utf8mb4_unicode_ci,
  `content4` text COLLATE utf8mb4_unicode_ci,
  `content5` text COLLATE utf8mb4_unicode_ci,
  `content6` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_configs`
--

INSERT INTO `vnw_configs` (`id`, `name`, `content`, `content1`, `content2`, `content3`, `content4`, `content5`, `content6`, `created_at`, `updated_at`) VALUES
(1, 'Header', '{\"favicon\":\"http://cnc-bangdenled.vnwis.com/uploads/source/8100991833logo_vi.png\", \"logo\":\"http://cnc-bangdenled.vnwis.com/uploads/source/logo%20(3).png\",\"quangcao\":\"http://cnc-bangdenled.vnwis.com/uploads/source/quangcao.png\", \"hotline1\":\"0908 303 369\", \"hotline2\":\"thinhtinphatqc@gmail.com\", \"facebook\":\"https://www.facebook.com/profile.php?id=100010614458791\", \"skype\":\"\", \"youtube\":\"\", \"linkedin\":\"\"}', '{\"pic1\":\"http://cnc-bangdenled.vnwis.com/uploads/source/Total-png-logo-download.png\",\"pic2\":\"http://cnc-bangdenled.vnwis.com/uploads/source/new-google-logo-knockoff.png\",\"pic3\":\"http://cnc-bangdenled.vnwis.com/uploads/source/mastercard-logo-png.png\",\"pic4\":\"http://cnc-bangdenled.vnwis.com/uploads/source/Intel_logo.png\",\"pic5\":\"http://cnc-bangdenled.vnwis.com/uploads/source/audi-logo-png-wallpaper-6.png\",\"pic6\":\"http://cnc-bangdenled.vnwis.com/uploads/source/ebay-logo-Transparent-download-png.png\",\"pic7\":\"http://cnc-bangdenled.vnwis.com/uploads/source/audi-logo-png-wallpaper-6.png\",\"pic8\":\"http://cnc-bangdenled.vnwis.com/uploads/source/adidas-logo-png-black-0.png\"}', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-11 01:37:09'),
(2, 'Footer', '<h1><span style=\"font-size:14px\"><strong>C&Ocirc;NG TY TNHH D???CH V??? QU???NG C&Aacute;O TH???NH T&Iacute;N PH&Aacute;T</strong></span></h1>\r\n\r\n<p>?????a ch???:&nbsp;163 L????ng ?????nh C???a, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>??i???n tho???i: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'QU???NG C??O TH???NH PH??T;163 L????ng ?????nh C???a, P. B??nh Kh??nh, Q.2, Tp. HCM;0908 303 369;thinhtinphatqc@gmail.com;10.787878;106.734376', '{\"video1\":\"https://www.youtube.com/watch?v=bGCtU_eXKZI\",\"video2\":\"https://www.youtube.com/watch?v=8BAdhoeabUM\",\"video3\":\"https://www.youtube.com/watch?v=zQwKxVCR1y8\",\"video4\":\"https://www.youtube.com/watch?v=uwlGzAprCrw\",\"video5\":\"https://www.youtube.com/watch?v=Q5_-ub_nvtU\"}', 'https://www.facebook.com/thietkewebsitetannoi/', NULL, NULL, NULL, NULL, '2018-05-11 00:21:08'),
(3, 'Code', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vnw_contacts`
--

CREATE TABLE `vnw_contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vnw_menus`
--

CREATE TABLE `vnw_menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_menus`
--

INSERT INTO `vnw_menus` (`id`, `menu_name`, `menu_content`, `created_at`, `updated_at`) VALUES
(1, 'Top Menu', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vnw_migrations`
--

CREATE TABLE `vnw_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `vnw_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vnw_posts`
--

CREATE TABLE `vnw_posts` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_posts`
--

INSERT INTO `vnw_posts` (`id`, `post_title`, `post_slug`, `post_description`, `post_content`, `post_image`, `post_status`, `post_seo_title`, `post_seo_description`, `h1_tag`, `h2_tag`, `h3_tag`, `category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'tin tuc chung toi', 'tin-tuc-chung-toi', 'T???i t??a h??m nay, c???u Ch??? t???ch PVN ti???p t???c kh???ng ?????nh kh??ng ph???m t???i. ??ng Th??ng l?? gi???i, phi??n t??a h???i th??ng 1 ch??a xem x??t to??n di???n b???i c???nh d??? ??n Th??i B??nh 2 trong ho??n c???nh chung. L??c ????, c??c t???p ??o??n kinh t??? ???????c ph??p ?????u t??, ph??t tri???n kinh t??? ??a ng??nh.', NULL, 'http://qcthong.vnwis/uploads/source/images%20(1).jpg', 1, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-08 22:03:36', '2018-05-08 22:09:45'),
(2, 'tin tuc chung toi 2', 'tin-tuc-chung-toi', 'T???i t??a h??m nay, c???u Ch??? t???ch PVN ti???p t???c kh???ng ?????nh kh??ng ph???m t???i. ??ng Th??ng l?? gi???i, phi??n t??a h???i th??ng 1 ch??a xem x??t to??n di???n b???i c???nh d??? ??n Th??i B??nh 2 trong ho??n c???nh chung. L??c ????, c??c t???p ??o??n kinh t??? ???????c ph??p ?????u t??, ph??t tri???n kinh t??? ??a ng??nh.', NULL, 'http://qcthong.vnwis/uploads/source/images%20(4).png', 1, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-08 22:03:53', '2018-05-08 22:09:52'),
(3, 'tin tuc chung toi 3', 'tin-tuc-chung-toi-3', 'tin tuc', NULL, 'http://qcthong.vnwis/uploads/source/download%20(2).jpg', 1, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-08 23:48:04', '2018-05-08 23:48:04'),
(4, 'tin tuc chung toi 3', 'tin-tuc-chung-toi-3', NULL, NULL, 'http://qcthong.vnwis/uploads/source/images%20(4).png', 1, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-08 23:48:44', '2018-05-08 23:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `vnw_post_categories`
--

CREATE TABLE `vnw_post_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_seo_description` text COLLATE utf8mb4_unicode_ci,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_post_categories`
--

INSERT INTO `vnw_post_categories` (`id`, `category_name`, `category_slug`, `category_seo_title`, `category_seo_description`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Chuy??n M???c 1', 'chuyen-muc-1', 'Chuy??n M???c 1', 'Day la Chuy??n M???c 1', 0, NULL, NULL),
(2, 'Chuy??n M???c 2', 'chuyen-muc-2', 'Chuy??n M???c 2', 'Day la Chuy??n M???c 2', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vnw_post_tag`
--

CREATE TABLE `vnw_post_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vnw_post_tags`
--

CREATE TABLE `vnw_post_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_seo_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `vnw_products` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_products`
--

INSERT INTO `vnw_products` (`id`, `product_title`, `product_slug`, `masanpham`, `nhasanxuat`, `product_old_price`, `product_new_price`, `product_description`, `product_content`, `product_feature_image`, `product_status`, `product_noibat`, `product_banchay`, `product_view`, `stt`, `xuatxu`, `baohanh`, `product_seo_title`, `product_seo_description`, `h1_tag`, `h2_tag`, `h3_tag`, `product_category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(9, 'bang led', 'bang-led', NULL, NULL, 0, 0, NULL, NULL, 'http://cnc-bangdenled.vnwis.com/uploads/source/pano.jpg', 1, 1, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-10 20:38:54', '2018-05-11 02:27:05'),
(10, 'fgfgfg', 'fgfgfg', NULL, NULL, 0, 0, NULL, NULL, 'http://cnc-bangdenled.vnwis.com/uploads/source/pano.jpg', 1, 1, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-10 21:05:21', '2018-05-11 02:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `vnw_product_categories`
--

CREATE TABLE `vnw_product_categories` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `product_category_content` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_product_categories`
--

INSERT INTO `vnw_product_categories` (`id`, `product_category_name`, `product_category_slug`, `product_category_price`, `product_category_image`, `product_category_description`, `product_category_seo_title`, `product_category_seo_description`, `parent_id`, `created_at`, `updated_at`, `product_category_content`) VALUES
(1, 'B???NG LED ??I???N T???', 'bang-led-dien-tu', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/1a35a802c2913bc03cdff90171b1d2bc.jpg', '<p style=\"text-align:justify\">Qu???ng c&aacute;o LED, LED ma tr???n, B???ng di???n t???, M&agrave;n h&igrave;nh LED</p>\r\n\r\n<p style=\"text-align:justify\">C&ocirc;ng ty TH???NH T&Iacute;N PH&Aacute;T&nbsp;chuy&ecirc;n thi???t k???, thi c&ocirc;ng v&agrave; l???p ?????t b???ng hi???u qu???ng c&aacute;o LED:&nbsp;<strong>LED ma tr???n, m&agrave;n h&igrave;nh LED, b???ng ??i???n t???, LED modul &acirc;m ch???, LED d&acirc;y, LED trang tr&iacute;, H???p ??&egrave;n LED si&ecirc;u m???ng&hellip;</strong></p>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/BANGDENLED.png\" style=\"height:400px; width:1170px\" /></p>\r\n\r\n<p style=\"text-align:justify\">??&egrave;n LED d???a tr&ecirc;n c&ocirc;ng ngh??? b&aacute;n d???n ng&agrave;y c&agrave;ng t??ng v??? ????? chi???u s&aacute;ng, hi???u su???t v&agrave; tu???i th???, gi???ng nh?? b??? x??? l&yacute; c???a m&aacute;y t&iacute;nh, ph&aacute;t tri???n ng&agrave;y c&agrave;ng nhanh v&agrave; gi&aacute; th&agrave;nh ng&agrave;y c&agrave;ng gi???m theo th???i gian.</p>\r\n\r\n<p style=\"text-align:justify\">C&ocirc;ng ty TH???NH T&Iacute;N PH&Aacute;T&nbsp;chuy&ecirc;n s???n xu???t, cung c???p, l???p ?????t &amp; thi c&ocirc;ng c&aacute;c s???n ph???m c&ocirc;ng ngh??? qu???ng c&aacute;o LED, LED ma tr???n, m&agrave;n h???nh LED&hellip;<img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/BANGLED2.png\" style=\"height:400px; width:1170px\" />V???i ?????i ng?? l&agrave; t???p th??? c&aacute;c Chuy&ecirc;n gia, K??? s??, Chuy&ecirc;n vi&ecirc;n c&oacute; b??? d???y kinh nghi???m, Ch&uacute;ng t&ocirc;i kh&ocirc;ng ng???ng nghi&ecirc;n c???u, thi???t k??? v&agrave; cho ra ?????i c&aacute;c d&ograve;ng s???n ph???m B???ng ??i???n t??? ch???t l?????ng cao, c&oacute; t&iacute;nh n??ng ??u vi???t v&agrave; mang t&iacute;nh ?????t ph&aacute; v??? c&ocirc;ng ngh???.</p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH D???CH V??? QU???NG C&Aacute;O TH???NH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>?????a ch???:&nbsp;163 L????ng ?????nh C???a, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>??i???n tho???i: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'bang led dien tu', 'bang led dien tu', 0, NULL, '2018-05-11 02:53:07', ''),
(2, 'THI C??NG B???NG HI???U', 'thi-cong-bang-hieu', 130000, 'http://cnc-bangdenled.vnwis.com/uploads/source/sb2.jpg', '<p>?????n v???i C&ocirc;ng ty TH???NH T&Iacute;N PH&Aacute;T, q&uacute;y kh&aacute;ch h&agrave;ng s??? nh???n ???????c nh???ng ??u ??i???m n???i b???t h??n nh???ng c?? s??? kh&aacute;c nh??:<br />\r\n&ndash; ?????i ng?? th??? thi c&ocirc;ng m???t d???ng Alu chuy&ecirc;n nghi???p, v???i h??n 10 N??m kinh nghi???m ???p m???t d???ng alu cao c???p, th???c hi???n cho nh???ng c&ocirc;ng tr&igrave;nh l???n t???i t???t c??? c&aacute;c t???nh l???n c???n TP.HCM.<br />\r\n&ndash; Th???i gian thi c&ocirc;ng nhanh, th&iacute;ch h???p cho nh???ng C???a h&agrave;ng Showroom c???n k??? ng&agrave;y Khai tr????ng.<br />\r\n&ndash; S??? d???ng nguy&ecirc;n v???t li???u Aluminium cao c???p, ?????m b???o ????? b???n cao cho qu&yacute; kh&aacute;ch h&agrave;ng.<br />\r\n&ndash; Nh&acirc;n vi&ecirc;n t?? v???n ??o ?????t nhi???t t&igrave;nh, ?????n t???n n??i t?? v???n cho qu&yacute; kh&aacute;ch h&agrave;ng, nh???ng gi???i ph&aacute;p t???i ??u nh???t nh??: Phong th???y m???t ti???n, Ph&ocirc;ng ch??? b???ng hi???u, M&agrave;u s???c t??ng t&iacute;nh n???i b???t, S??? d???ng v???t li???u ph&ugrave; h???p t&uacute;i ti???n.. T?? v???n k??? c&agrave;ng h??n nh???m mang t&iacute;nh gi???m thi???u Chi Ph&iacute; cho qu&yacute; kh&aacute;ch h&agrave;ng.</p>\r\n\r\n<p><img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/thicongbanghieu.png\" style=\"height:400px; width:1170px\" /></p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH D???CH V??? QU???NG C&Aacute;O TH???NH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>?????a ch???:&nbsp;163 L????ng ?????nh C???a, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>??i???n tho???i: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'thi cong bang hieu', 'thi cong bang hieu', 0, NULL, '2018-05-11 02:52:58', ''),
(5, 'H???P ????N HIFLEX - MICA', 'hop-den-hiflex-mica', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/hopdensieumong4(2).jpg', '<p>chuy&ecirc;n thi???t k???, thi c&ocirc;ng v&agrave; l???p ?????t H???p ??&egrave;n mica, h???p ??&egrave;n hiflex, &hellip; Ch&uacute;ng t&ocirc;i chuy&ecirc;n s???n xu???t, cung c???p, l???p ?????t &amp; thi c&ocirc;ng c&aacute;c s???n ph???m c&ocirc;ng gh??? m???i nh???t</p>\r\n\r\n<p>??&egrave;n LED d???a tr&ecirc;n c&ocirc;ng ngh??? b&aacute;n d???n ng&agrave;y c&agrave;ng t??ng v??? ????? chi???u s&aacute;ng, hi???u su???t v&agrave; tu???i th???, gi???ng nh?? b??? x??? l&yacute; c???a m&aacute;y t&iacute;nh, ph&aacute;t tri???n ng&agrave;y c&agrave;ng nhanh v&agrave; gi&aacute; th&agrave;nh ng&agrave;y c&agrave;ng gi???m theo th???i gian.<br />\r\nC&ocirc;ng ty TH???NH T&Iacute;N PH&Aacute;T&nbsp;chuy&ecirc;n s???n xu???t, cung c???p, l???p ?????t &amp; thi c&ocirc;ng c&aacute;c s???n ph???m c&ocirc;ng gh??? m???i nh???t<img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/HIX.png\" style=\"height:600px; width:1170px\" /><br />\r\nV???i ?????i ng?? l&agrave; t???p th??? c&aacute;c Chuy&ecirc;n gia, K??? s??, Chuy&ecirc;n vi&ecirc;n c&oacute; b??? d???y kinh nghi???m, Ch&uacute;ng t&ocirc;i kh&ocirc;ng ng???ng nghi&ecirc;n c???u, thi???t k??? v&agrave; cho ra ?????i c&aacute;c d&ograve;ng s???n ph???m ch???t l?????ng cao, c&oacute; t&iacute;nh n??ng ??u vi???t v&agrave; mang t&iacute;nh ?????t ph&aacute; v??? c&ocirc;ng ngh???.</p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH D???CH V??? QU???NG C&Aacute;O TH???NH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>?????a ch???:&nbsp;163 L????ng ?????nh C???a, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>??i???n tho???i: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'H???P ????N HIFLEX - MICA', 'H???P ????N HIFLEX - MICA', 0, '2018-05-09 01:24:04', '2018-05-11 02:52:43', ''),
(6, 'M???T D???NG ALU', 'mat-dung-alu', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/showroom-KYMCO.jpg', '<p>Chuy&ecirc;n thi???t k??? &amp; thi c&ocirc;ng m???t d???ng t&ograve;a nh&agrave;, showroom, c&aacute;c lo???i b???ng hi???u ????n gi???n, kh&ocirc;ng c???u k??? cho ?????n ph???c t???p.<img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/ALU2.png\" style=\"height:600px; width:1170px\" /></p>\r\n\r\n<p>Thi???t k??? &amp; thi c&ocirc;ng m???t d???ng nh&ocirc;m Alu cho c&aacute;c c???a h&agrave;ng, c&ocirc;ng ty, showroom thu&ecirc; m???t b???ng kinh doanh c???n ti???t ki???m chi ph&iacute; (v&igrave; th???i gian thu&ecirc; m???t b???ng kh&ocirc;ng cao, th?????ng th&igrave; t??? 3 &ndash; 5 n??m) nh??ng v???n b???o ?????m t&iacute;nh th???m m???, hi???n ?????i, ????? b???n cao</p>\r\n\r\n<p>C&ocirc;ng ty qu???ng c&aacute;o TH???NH T&Iacute;N PH&Aacute;T&nbsp;chuy&ecirc;n thi c&ocirc;ng c&aacute;c c&ocirc;ng tr&igrave;nh c???n s??? d???ng t???m nh&ocirc;m nh???a d&ugrave;ng trang tr&iacute; theo y&ecirc;u c???u b???n v??? ki???n tr&uacute;c.<br />\r\nD???ch v??? Thi c&ocirc;ng ???p m???t d???ng aluminum c???a c&ocirc;ng ty ch&uacute;ng t&ocirc;i s??? ??&aacute;p ???ng y&ecirc;u c???u c???a qu&yacute; kh&aacute;ch v??? th???i gian, m??? thu???t, ????? b???n, an to&agrave;n v&agrave; ti???t ki???m.</p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH D???CH V??? QU???NG C&Aacute;O TH???NH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>?????a ch???:&nbsp;163 L????ng ?????nh C???a, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>??i???n tho???i: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'M???T D???NG ALU', 'M???T D???NG ALU', 0, '2018-05-10 20:08:58', '2018-05-11 02:52:32', ''),
(7, 'CH??? N???I INOX', 'chu-noi-inox', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/chu-noi-inox-hat-chan-3.jpg', '<p>Ch&uacute;ng t&ocirc;i chuy&ecirc;n thi c&ocirc;ng v&agrave; gia c&ocirc;ng ch??? qu???ng c&aacute;o b???ng m&aacute;y chuy&ecirc;n d???ng t??? ?????ng &amp; hi???n ?????i:ch??? Inox (tr???ng ho???c Inox m&agrave;u),c&oacute; l???p ?????t LED b&ecirc;n trong ch???.</p>\r\n\r\n<p>&nbsp;N???u n&oacute;i b???ng Aluminium ho???c m???t d???ng Aluminium ???????c xem nh?? n???n c???a m???t b???ng hi???u th&igrave; ch??? n???i qu???ng c&aacute;o, ch??? inox l&agrave; th&agrave;nh ph???n ch&iacute;nh ???????c l???p ?????t b??? tr&iacute; h&agrave;i h&ograve;a ????? t???o n&ecirc;n m???t b???ng hi???u ?????p, chuy&ecirc;n nghi???p.<img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/INOX.png\" style=\"height:600px; width:1170px\" />Ch??? n???i qu???ng c&aacute;o do C&ocirc;ng ty TH???NH T&Iacute;N PH&Aacute;T&nbsp;th???c hi???n, ???????c gia c&ocirc;ng tr&ecirc;n m&aacute;y c???t laser Fiber kim lo???i, m&aacute;y u???n ch??? inox t??? ?????ng v&agrave; m&aacute;y h&agrave;n ch??? inox c&ocirc;ng ngh??? laser hi???n ?????i, n&ecirc;n s???n ph???m r???t s???c s???o v&agrave; ho&agrave;n h???o .</p>\r\n\r\n<p>C&ocirc;ng ty TH???NH T&Iacute;N PH&Aacute;T&nbsp;tr&acirc;n tr???ng k&iacute;nh m???i qu&yacute; kh&aacute;ch h&agrave;ng vui l&ograve;ng b???t ch&uacute;t th???i gian gh&eacute; qua c&ocirc;ng ty ch&uacute;ng t&ocirc;i ????? tham kh???o m???u v&agrave; ????? ch&uacute;ng t&ocirc;i ???????c ph???c v??? cho qu&yacute; kh&aacute;ch h&agrave;ng t???t nh???t tr?????c khi quy???t ?????nh ?????t h&agrave;ng. ?????i v???i kh&aacute;ch h&agrave;ng ??? xa, ??? t???nh, xin vui l&ograve;ng cung c???p k&iacute;ch th?????c, s??? ??o ????? ch&uacute;ng t&ocirc;i thi???t k??? &amp; b&aacute;o gi&aacute;.</p>\r\n\r\n<p>N???u l&agrave; ????n h&agrave;ng c???n l???p ?????t ch&uacute;ng t&ocirc;i s??? ????a th??? ?????n l???p ?????t T???t c??? s???n ph???m do c&ocirc;ng ty ch&uacute;ng t&ocirc;i th???c hi???n ?????u d?????c b???o h&agrave;nh &iacute;t nh???t l&agrave; 12 th&aacute;ng.</p>\r\n\r\n<p>Nh???n gia c&ocirc;ng ch??? inox,Mica: (Giao h&agrave;ng to&agrave;n qu???c) C???t ch??? b???ng m&aacute;y laser Fiber kim lo???i S???n xu???t ch??? b???ng m&aacute;y u???n t??? ?????ng H&agrave;n ch??? b???ng m&aacute;y h&agrave;n laser hi???n ?????i Nhanh, g???n, ?????p. C&oacute; th??? gia c&ocirc;ng u???n ch??? t??? 10 cm tr??? l&ecirc;n Kh&ocirc;ng d&ugrave;ng Ax&iacute;t, kh&ocirc;ng d&ugrave;ng ch&igrave;, r???t an to&agrave;n cho s???c kh???e Kh&ocirc;ng c???n ??&aacute;nh b&oacute;ng v??? sinh Gia c&ocirc;ng xong l&agrave; l???p ?????t lu&ocirc;n L&agrave;m h&agrave;i l&ograve;ng kh&aacute;ch h&agrave;ng k??? c??? nh???ng kh&aacute;ch h&agrave;ng kh&oacute; t&iacute;nh nh???t</p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH D???CH V??? QU???NG C&Aacute;O TH???NH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>?????a ch???:&nbsp;163 L????ng ?????nh C???a, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>??i???n tho???i: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'CH??? N???I INOX', 'CH??? N???I INOX', 0, '2018-05-10 20:11:54', '2018-05-11 02:52:22', ''),
(8, 'CH??? N???I MICA', 'chu-noi-mica', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/banghieucaphedep-thumbs-600x400.jpg', '<p>Ch&uacute;ng t&ocirc;i chuy&ecirc;n thi c&ocirc;ng v&agrave; gia c&ocirc;ng ch??? n???i mica, ch??? n???i inox, ch??? n???i alu b???ng m&aacute;y chuy&ecirc;n d???ng t??? ?????ng &amp; v???i gi&aacute; th&agrave;nh ph&ugrave; h???p.</p>\r\n\r\n<p>Ch&uacute;ng t&ocirc;i chuy&ecirc;n thi c&ocirc;ng v&agrave; gia c&ocirc;ng ch??? qu???ng c&aacute;o b???ng m&aacute;y chuy&ecirc;n d???ng t??? ?????ng &amp; hi???n ?????i, ch??? n???i LED l???p ?????t tr&ecirc;n c&aacute;c t&ograve;a nh&agrave;, nh&agrave; x?????ng, ch??? t&ocirc;n (ho???c Inox) s??n t??nh ??i???n, ch??? Mica, ch??? Alu&hellip;</p>\r\n\r\n<ul>\r\n	<li>N???u n&oacute;i b???ng Aluminium ho???c m???t d???ng Aluminium ???????c xem nh?? n???n c???a m???t b???ng hi???u th&igrave; ch??? n???i qu???ng c&aacute;o, ch??? mica l&agrave; th&agrave;nh ph???n ch&iacute;nh ???????c l???p ?????t b??? tr&iacute; h&agrave;i h&ograve;a ????? t???o n&ecirc;n m???t b???ng hi???u ?????p, chuy&ecirc;n nghi???p.</li>\r\n	<li>Ch??? n???i qu???ng c&aacute;o do C&ocirc;ng ty T&Agrave;I H??NG TH???NH&nbsp;th???c hi???n, ???????c gia c&ocirc;ng tr&ecirc;n m&aacute;y c???t laser ,</li>\r\n	<li>C&ocirc;ng ty TH???NH T&Iacute;N PH&Aacute;T tr&acirc;n tr???ng k&iacute;nh m???i qu&yacute; kh&aacute;ch h&agrave;ng vui l&ograve;ng b???t ch&uacute;t th???i gian gh&eacute; qua c&ocirc;ng ty ch&uacute;ng t&ocirc;i ????? tham kh???o m???u v&agrave; ????? ch&uacute;ng t&ocirc;i ???????c ph???c v??? cho qu&yacute; kh&aacute;ch h&agrave;ng t???t nh???t tr?????c khi quy???t ?????nh ?????t h&agrave;ng.<img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/MICA1.png\" style=\"height:720px; width:1170px\" /></li>\r\n	<li>?????i v???i kh&aacute;ch h&agrave;ng ??? xa, ??? t???nh, xin vui l&ograve;ng cung c???p k&iacute;ch th?????c, s??? ??o ????? ch&uacute;ng t&ocirc;i thi???t k??? &amp; b&aacute;o gi&aacute;. N???u l&agrave; ????n h&agrave;ng c???n l???p ?????t ch&uacute;ng t&ocirc;i s??? ????a th??? ?????n l???p ?????t</li>\r\n	<li>T???t c??? s???n ph???m do c&ocirc;ng ty ch&uacute;ng t&ocirc;i th???c hi???n ?????u d?????c b???o h&agrave;nh &iacute;t nh???t l&agrave; 12 th&aacute;ng.</li>\r\n</ul>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH D???CH V??? QU???NG C&Aacute;O TH???NH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>?????a ch???:&nbsp;163 L????ng ?????nh C???a, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>??i???n tho???i: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 'CH??? N???I MICA', 'CH??? N???I MICA', 0, '2018-05-10 20:13:47', '2018-05-11 02:52:05', ''),
(10, 'C???T V??CH NG??N CNC', 'cat-vach-ngan-cnc', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/vach-ngan-cnc-phong-khach-dep-8.jpg', '<p>Chuy&ecirc;n cung c???p , ph&acirc;n ph???i v&agrave; thi c&ocirc;ng v&aacute;ch cnc v&aacute;ch ng??n trang tr&iacute; , v&aacute;ch ng??n di ?????ng ?????p,??&uacute;ng phong th???y , ch???ng n?????c , ch???ng ch&aacute;y , gi&aacute; t???t t???i tphcm</p>\r\n\r\n<p><img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/cnc1.png\" style=\"height:1000px; width:1170px\" /></p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH D???CH V??? QU???NG C&Aacute;O TH???NH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>?????a ch???:&nbsp;163 L????ng ?????nh C???a, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>??i???n tho???i: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'cat vach ngan cnc', 'cat vach ngan cnc', 0, '2018-05-10 20:26:21', '2018-05-11 02:51:50', ''),
(11, 'THI C??NG V??CH NG??N CNC', 'thi-cong-vach-ngan-cnc', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/b278d57212ede2b7c8e8deb9ee2bbd75.jpg', '<p>V&aacute;ch Ng??n CNC Ph&ograve;ng Kh&aacute;ch, Ph&ograve;ng Ng???,ph&ograve;ng th???-V&aacute;ch ng??n Hoa V??n 2D 3D- gi&aacute; r??? t???i TPHCM m???u m&atilde; ?????p ??a d???ng,gi&aacute; c??? h???p l&yacute;.Li&ecirc;n h??? ngay ????? ???????c ch&uacute;ng t&ocirc;i t?? v???n</p>\r\n\r\n<p><img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/cnc.png\" style=\"height:1000px; width:1170px\" /></p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH D???CH V??? QU???NG C&Aacute;O TH???NH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>?????a ch???:&nbsp;163 L????ng ?????nh C???a, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>??i???n tho???i: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'vach ngan cnc', 'vach ngan cnc', 0, '2018-05-10 20:28:44', '2018-05-11 02:51:21', ''),
(12, 'CUNG C???P V??CH NG??N CNC', 'cung-cap-vach-ngan-cnc', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/a690da59bca19bf612b0f9c2bc4100c6.jpg', '<p>V&aacute;ch cnc - v&aacute;ch ng??n g??? cnc trang tr&iacute; n???i th???t cao c???p ???ng d???ng cho nhi???u kh&ocirc;ng gian. V&aacute;ch cnc ph&ograve;ng kh&aacute;ch, v&aacute;ch ng??n cnc ph&ograve;ng th???, v&aacute;ch ng??n c???u thang cnc ... l&agrave; nh???ng ???ng d???ng tuy???t v???i c???a v&aacute;ch cnc</p>\r\n\r\n<p><img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/cnc1.png\" style=\"height:1000px; width:1170px\" /><img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/cnc.png\" style=\"height:1000px; width:1170px\" /></p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH D???CH V??? QU???NG C&Aacute;O TH???NH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>?????a ch???:&nbsp;163 L????ng ?????nh C???a, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>??i???n tho???i: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'vach ngan cnc gia re', 'vach ngan cnc gia re', 0, '2018-05-10 20:34:29', '2018-05-11 02:50:15', '');

-- --------------------------------------------------------

--
-- Table structure for table `vnw_product_images`
--

CREATE TABLE `vnw_product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vnw_product_tag`
--

CREATE TABLE `vnw_product_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vnw_product_tags`
--

CREATE TABLE `vnw_product_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_seo_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `vnw_static_pages` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_static_pages`
--

INSERT INTO `vnw_static_pages` (`id`, `name`, `title`, `content`, `content_1`, `content_2`, `content_3`, `content_4`, `content_5`, `h1_tag`, `h2_tag`, `h3_tag`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 'Home Page', '', '{\"link0\":\"http://cnc-bangdenled.vnwis.com/uploads/source/quangcao2.png\",\"link1\":\"http://cnc-bangdenled.vnwis.com/uploads/source/slide.png\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-10 18:51:27'),
(2, 'About Us', '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', NULL, NULL),
(3, 'Contact Us', 'C??NG TY TNHH D???CH V??? QU???NG C??O TH???NH T??N PH??T', '<h1>&nbsp;</h1>\r\n\r\n<p>?????a ch???:&nbsp;163 L????ng ?????nh C???a, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>??i???n tho???i: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'QU???NG C??O TH???NH PH??T;163 L????ng ?????nh C???a, P. B??nh Kh??nh, Q.2, Tp. HCM;0908 303 369;thinhtinphatqc@gmail.com;10.787878;106.734376', NULL, NULL, NULL, NULL, 'bangdenled-cnc', 'bangdenled,vachngancnc', 'bangdenled,vachngancnc', 'bangdenled,vachngancnc', 'bangdenled,vachngancnc', NULL, '2018-05-11 00:20:28'),
(4, 'S???n Ph???m', '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', NULL, NULL),
(5, 'Tuy???n D???ng', 'n???i dung ??ang ???????c c???p nh???t....', NULL, NULL, NULL, NULL, NULL, NULL, 'dsds', 'dsdsd', '??sdd', 'dsds', 'ddsd', NULL, '2018-05-10 21:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `vnw_users`
--

CREATE TABLE `vnw_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT '2',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vnw_users`
--

INSERT INTO `vnw_users` (`id`, `username`, `name`, `email`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'admin@gmail.com', '$2y$10$c/gntaNdlvbvlSwlFSfWWuBfY9rNjHmGeCzp5e0P0bXawPSe8DFIG', 1, NULL, NULL, NULL),
(2, 'user1', 'User 1', 'user1@gmail.com', '$2y$10$q3ZqtJD8yffP5SM.Bjlc5.Gytdf4esmSlQ4zQRrY9Rx/V4kYSHWNe', 2, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vnw_configs`
--
ALTER TABLE `vnw_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vnw_contacts`
--
ALTER TABLE `vnw_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vnw_menus`
--
ALTER TABLE `vnw_menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_menu_name_unique` (`menu_name`);

--
-- Indexes for table `vnw_migrations`
--
ALTER TABLE `vnw_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vnw_password_resets`
--
ALTER TABLE `vnw_password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `vnw_posts`
--
ALTER TABLE `vnw_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `vnw_post_categories`
--
ALTER TABLE `vnw_post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vnw_post_tag`
--
ALTER TABLE `vnw_post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_tag_post_id_foreign` (`post_id`),
  ADD KEY `post_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `vnw_post_tags`
--
ALTER TABLE `vnw_post_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vnw_products`
--
ALTER TABLE `vnw_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_product_category_id_foreign` (`product_category_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `vnw_product_categories`
--
ALTER TABLE `vnw_product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vnw_product_images`
--
ALTER TABLE `vnw_product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `vnw_product_tag`
--
ALTER TABLE `vnw_product_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_tag_product_id_foreign` (`product_id`),
  ADD KEY `product_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `vnw_product_tags`
--
ALTER TABLE `vnw_product_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vnw_static_pages`
--
ALTER TABLE `vnw_static_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vnw_users`
--
ALTER TABLE `vnw_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vnw_configs`
--
ALTER TABLE `vnw_configs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vnw_contacts`
--
ALTER TABLE `vnw_contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vnw_menus`
--
ALTER TABLE `vnw_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vnw_migrations`
--
ALTER TABLE `vnw_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `vnw_posts`
--
ALTER TABLE `vnw_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vnw_post_categories`
--
ALTER TABLE `vnw_post_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vnw_post_tag`
--
ALTER TABLE `vnw_post_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vnw_post_tags`
--
ALTER TABLE `vnw_post_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vnw_products`
--
ALTER TABLE `vnw_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `vnw_product_categories`
--
ALTER TABLE `vnw_product_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `vnw_product_images`
--
ALTER TABLE `vnw_product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vnw_product_tag`
--
ALTER TABLE `vnw_product_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vnw_product_tags`
--
ALTER TABLE `vnw_product_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vnw_static_pages`
--
ALTER TABLE `vnw_static_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vnw_users`
--
ALTER TABLE `vnw_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
