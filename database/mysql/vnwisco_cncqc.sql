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
(2, 'Footer', '<h1><span style=\"font-size:14px\"><strong>C&Ocirc;NG TY TNHH DỊCH VỤ QUẢNG C&Aacute;O THỊNH T&Iacute;N PH&Aacute;T</strong></span></h1>\r\n\r\n<p>Địa chỉ:&nbsp;163 Lương Định Của, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>Điện thoại: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'QUẢNG CÁO THỊNH PHÁT;163 Lương Định Của, P. Bình Khánh, Q.2, Tp. HCM;0908 303 369;thinhtinphatqc@gmail.com;10.787878;106.734376', '{\"video1\":\"https://www.youtube.com/watch?v=bGCtU_eXKZI\",\"video2\":\"https://www.youtube.com/watch?v=8BAdhoeabUM\",\"video3\":\"https://www.youtube.com/watch?v=zQwKxVCR1y8\",\"video4\":\"https://www.youtube.com/watch?v=uwlGzAprCrw\",\"video5\":\"https://www.youtube.com/watch?v=Q5_-ub_nvtU\"}', 'https://www.facebook.com/thietkewebsitetannoi/', NULL, NULL, NULL, NULL, '2018-05-11 00:21:08'),
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
(1, 'tin tuc chung toi', 'tin-tuc-chung-toi', 'Tại tòa hôm nay, cựu Chủ tịch PVN tiếp tục khẳng định không phạm tội. Ông Thăng lý giải, phiên tòa hồi tháng 1 chưa xem xét toàn diện bối cảnh dự án Thái Bình 2 trong hoàn cảnh chung. Lúc đó, các tập đoàn kinh tế được phép đầu tư, phát triển kinh tế đa ngành.', NULL, 'http://qcthong.vnwis/uploads/source/images%20(1).jpg', 1, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-08 22:03:36', '2018-05-08 22:09:45'),
(2, 'tin tuc chung toi 2', 'tin-tuc-chung-toi', 'Tại tòa hôm nay, cựu Chủ tịch PVN tiếp tục khẳng định không phạm tội. Ông Thăng lý giải, phiên tòa hồi tháng 1 chưa xem xét toàn diện bối cảnh dự án Thái Bình 2 trong hoàn cảnh chung. Lúc đó, các tập đoàn kinh tế được phép đầu tư, phát triển kinh tế đa ngành.', NULL, 'http://qcthong.vnwis/uploads/source/images%20(4).png', 1, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-08 22:03:53', '2018-05-08 22:09:52'),
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
(1, 'Chuyên Mục 1', 'chuyen-muc-1', 'Chuyên Mục 1', 'Day la Chuyên Mục 1', 0, NULL, NULL),
(2, 'Chuyên Mục 2', 'chuyen-muc-2', 'Chuyên Mục 2', 'Day la Chuyên Mục 2', 0, NULL, NULL);

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
(1, 'BẢNG LED ĐIỆN TỬ', 'bang-led-dien-tu', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/1a35a802c2913bc03cdff90171b1d2bc.jpg', '<p style=\"text-align:justify\">Quảng c&aacute;o LED, LED ma trận, Bảng diện tử, M&agrave;n h&igrave;nh LED</p>\r\n\r\n<p style=\"text-align:justify\">C&ocirc;ng ty THỊNH T&Iacute;N PH&Aacute;T&nbsp;chuy&ecirc;n thiết kế, thi c&ocirc;ng v&agrave; lắp đặt bảng hiệu quảng c&aacute;o LED:&nbsp;<strong>LED ma trận, m&agrave;n h&igrave;nh LED, bảng điện tử, LED modul &acirc;m chữ, LED d&acirc;y, LED trang tr&iacute;, Hộp đ&egrave;n LED si&ecirc;u mỏng&hellip;</strong></p>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/BANGDENLED.png\" style=\"height:400px; width:1170px\" /></p>\r\n\r\n<p style=\"text-align:justify\">Đ&egrave;n LED dựa tr&ecirc;n c&ocirc;ng nghệ b&aacute;n dẫn ng&agrave;y c&agrave;ng tăng về độ chiếu s&aacute;ng, hiệu suất v&agrave; tuổi thọ, giống như bộ xử l&yacute; của m&aacute;y t&iacute;nh, ph&aacute;t triển ng&agrave;y c&agrave;ng nhanh v&agrave; gi&aacute; th&agrave;nh ng&agrave;y c&agrave;ng giảm theo thời gian.</p>\r\n\r\n<p style=\"text-align:justify\">C&ocirc;ng ty THỊNH T&Iacute;N PH&Aacute;T&nbsp;chuy&ecirc;n sản xuất, cung cấp, lắp đặt &amp; thi c&ocirc;ng c&aacute;c sản phẩm c&ocirc;ng nghệ quảng c&aacute;o LED, LED ma trận, m&agrave;n hỉnh LED&hellip;<img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/BANGLED2.png\" style=\"height:400px; width:1170px\" />Với đội ngũ l&agrave; tập thể c&aacute;c Chuy&ecirc;n gia, Kỹ sư, Chuy&ecirc;n vi&ecirc;n c&oacute; bề dầy kinh nghiệm, Ch&uacute;ng t&ocirc;i kh&ocirc;ng ngừng nghi&ecirc;n cứu, thiết kế v&agrave; cho ra đời c&aacute;c d&ograve;ng sản phẩm Bảng điện tử chất lượng cao, c&oacute; t&iacute;nh năng ưu việt v&agrave; mang t&iacute;nh đột ph&aacute; về c&ocirc;ng nghệ.</p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH DỊCH VỤ QUẢNG C&Aacute;O THỊNH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>Địa chỉ:&nbsp;163 Lương Định Của, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>Điện thoại: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'bang led dien tu', 'bang led dien tu', 0, NULL, '2018-05-11 02:53:07', ''),
(2, 'THI CÔNG BẢNG HIỆU', 'thi-cong-bang-hieu', 130000, 'http://cnc-bangdenled.vnwis.com/uploads/source/sb2.jpg', '<p>Đến với C&ocirc;ng ty THỊNH T&Iacute;N PH&Aacute;T, q&uacute;y kh&aacute;ch h&agrave;ng sẽ nhận được những ưu điểm nổi bật hơn những cơ sở kh&aacute;c như:<br />\r\n&ndash; Đội ngũ thợ thi c&ocirc;ng mặt dựng Alu chuy&ecirc;n nghiệp, với hơn 10 Năm kinh nghiệm ốp mặt dựng alu cao cấp, thực hiện cho những c&ocirc;ng tr&igrave;nh lớn tại tất cả c&aacute;c tỉnh lận cận TP.HCM.<br />\r\n&ndash; Thời gian thi c&ocirc;ng nhanh, th&iacute;ch hợp cho những Cửa h&agrave;ng Showroom cận kề ng&agrave;y Khai trương.<br />\r\n&ndash; Sử dụng nguy&ecirc;n vật liệu Aluminium cao cấp, đảm bảo độ bền cao cho qu&yacute; kh&aacute;ch h&agrave;ng.<br />\r\n&ndash; Nh&acirc;n vi&ecirc;n tư vấn đo đạt nhiệt t&igrave;nh, đến tận nơi tư vấn cho qu&yacute; kh&aacute;ch h&agrave;ng, những giải ph&aacute;p tối ưu nhất như: Phong thủy mặt tiền, Ph&ocirc;ng chữ bảng hiệu, M&agrave;u sắc tăng t&iacute;nh nổi bật, Sử dụng vật liệu ph&ugrave; hợp t&uacute;i tiền.. Tư vấn kỹ c&agrave;ng hơn nhằm mang t&iacute;nh giảm thiểu Chi Ph&iacute; cho qu&yacute; kh&aacute;ch h&agrave;ng.</p>\r\n\r\n<p><img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/thicongbanghieu.png\" style=\"height:400px; width:1170px\" /></p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH DỊCH VỤ QUẢNG C&Aacute;O THỊNH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>Địa chỉ:&nbsp;163 Lương Định Của, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>Điện thoại: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'thi cong bang hieu', 'thi cong bang hieu', 0, NULL, '2018-05-11 02:52:58', ''),
(5, 'HỘP ĐÈN HIFLEX - MICA', 'hop-den-hiflex-mica', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/hopdensieumong4(2).jpg', '<p>chuy&ecirc;n thiết kế, thi c&ocirc;ng v&agrave; lắp đặt Hộp đ&egrave;n mica, hộp đ&egrave;n hiflex, &hellip; Ch&uacute;ng t&ocirc;i chuy&ecirc;n sản xuất, cung cấp, lắp đặt &amp; thi c&ocirc;ng c&aacute;c sản phẩm c&ocirc;ng ghệ mới nhất</p>\r\n\r\n<p>Đ&egrave;n LED dựa tr&ecirc;n c&ocirc;ng nghệ b&aacute;n dẫn ng&agrave;y c&agrave;ng tăng về độ chiếu s&aacute;ng, hiệu suất v&agrave; tuổi thọ, giống như bộ xử l&yacute; của m&aacute;y t&iacute;nh, ph&aacute;t triển ng&agrave;y c&agrave;ng nhanh v&agrave; gi&aacute; th&agrave;nh ng&agrave;y c&agrave;ng giảm theo thời gian.<br />\r\nC&ocirc;ng ty THỊNH T&Iacute;N PH&Aacute;T&nbsp;chuy&ecirc;n sản xuất, cung cấp, lắp đặt &amp; thi c&ocirc;ng c&aacute;c sản phẩm c&ocirc;ng ghệ mới nhất<img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/HIX.png\" style=\"height:600px; width:1170px\" /><br />\r\nVới đội ngũ l&agrave; tập thể c&aacute;c Chuy&ecirc;n gia, Kỹ sư, Chuy&ecirc;n vi&ecirc;n c&oacute; bề dầy kinh nghiệm, Ch&uacute;ng t&ocirc;i kh&ocirc;ng ngừng nghi&ecirc;n cứu, thiết kế v&agrave; cho ra đời c&aacute;c d&ograve;ng sản phẩm chất lượng cao, c&oacute; t&iacute;nh năng ưu việt v&agrave; mang t&iacute;nh đột ph&aacute; về c&ocirc;ng nghệ.</p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH DỊCH VỤ QUẢNG C&Aacute;O THỊNH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>Địa chỉ:&nbsp;163 Lương Định Của, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>Điện thoại: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'HỘP ĐÈN HIFLEX - MICA', 'HỘP ĐÈN HIFLEX - MICA', 0, '2018-05-09 01:24:04', '2018-05-11 02:52:43', ''),
(6, 'MẶT DỰNG ALU', 'mat-dung-alu', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/showroom-KYMCO.jpg', '<p>Chuy&ecirc;n thiết kế &amp; thi c&ocirc;ng mặt dựng t&ograve;a nh&agrave;, showroom, c&aacute;c loại bảng hiệu đơn giản, kh&ocirc;ng cầu kỳ cho đến phức tạp.<img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/ALU2.png\" style=\"height:600px; width:1170px\" /></p>\r\n\r\n<p>Thiết kế &amp; thi c&ocirc;ng mặt dựng nh&ocirc;m Alu cho c&aacute;c cửa h&agrave;ng, c&ocirc;ng ty, showroom thu&ecirc; mặt bằng kinh doanh cần tiết kiệm chi ph&iacute; (v&igrave; thời gian thu&ecirc; mặt bằng kh&ocirc;ng cao, thường th&igrave; từ 3 &ndash; 5 năm) nhưng vẫn bảo đảm t&iacute;nh thẩm mỹ, hiện đại, độ bền cao</p>\r\n\r\n<p>C&ocirc;ng ty quảng c&aacute;o THỊNH T&Iacute;N PH&Aacute;T&nbsp;chuy&ecirc;n thi c&ocirc;ng c&aacute;c c&ocirc;ng tr&igrave;nh cần sử dụng tấm nh&ocirc;m nhựa d&ugrave;ng trang tr&iacute; theo y&ecirc;u cầu bản vẽ kiến tr&uacute;c.<br />\r\nDịch vụ Thi c&ocirc;ng ốp mặt dựng aluminum của c&ocirc;ng ty ch&uacute;ng t&ocirc;i sẽ đ&aacute;p ứng y&ecirc;u cầu của qu&yacute; kh&aacute;ch về thời gian, mỹ thuật, độ bền, an to&agrave;n v&agrave; tiết kiệm.</p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH DỊCH VỤ QUẢNG C&Aacute;O THỊNH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>Địa chỉ:&nbsp;163 Lương Định Của, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>Điện thoại: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'MẶT DỰNG ALU', 'MẶT DỰNG ALU', 0, '2018-05-10 20:08:58', '2018-05-11 02:52:32', ''),
(7, 'CHỮ NỔI INOX', 'chu-noi-inox', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/chu-noi-inox-hat-chan-3.jpg', '<p>Ch&uacute;ng t&ocirc;i chuy&ecirc;n thi c&ocirc;ng v&agrave; gia c&ocirc;ng chữ quảng c&aacute;o bằng m&aacute;y chuy&ecirc;n dụng tự động &amp; hiện đại:chữ Inox (trắng hoặc Inox m&agrave;u),c&oacute; lắp đặt LED b&ecirc;n trong chữ.</p>\r\n\r\n<p>&nbsp;Nếu n&oacute;i bảng Aluminium hoặc mặt dựng Aluminium được xem như nền của một bảng hiệu th&igrave; chữ nổi quảng c&aacute;o, chữ inox l&agrave; th&agrave;nh phần ch&iacute;nh được lắp đặt bố tr&iacute; h&agrave;i h&ograve;a để tạo n&ecirc;n một bảng hiệu đẹp, chuy&ecirc;n nghiệp.<img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/INOX.png\" style=\"height:600px; width:1170px\" />Chữ nổi quảng c&aacute;o do C&ocirc;ng ty THỊNH T&Iacute;N PH&Aacute;T&nbsp;thực hiện, được gia c&ocirc;ng tr&ecirc;n m&aacute;y cắt laser Fiber kim loại, m&aacute;y uốn chữ inox tự động v&agrave; m&aacute;y h&agrave;n chữ inox c&ocirc;ng nghệ laser hiện đại, n&ecirc;n sản phẩm rất sắc sảo v&agrave; ho&agrave;n hảo .</p>\r\n\r\n<p>C&ocirc;ng ty THỊNH T&Iacute;N PH&Aacute;T&nbsp;tr&acirc;n trọng k&iacute;nh mời qu&yacute; kh&aacute;ch h&agrave;ng vui l&ograve;ng bớt ch&uacute;t thời gian gh&eacute; qua c&ocirc;ng ty ch&uacute;ng t&ocirc;i để tham khảo mẫu v&agrave; để ch&uacute;ng t&ocirc;i được phục vụ cho qu&yacute; kh&aacute;ch h&agrave;ng tốt nhất trước khi quyết định đặt h&agrave;ng. Đối với kh&aacute;ch h&agrave;ng ở xa, ở tỉnh, xin vui l&ograve;ng cung cấp k&iacute;ch thước, số đo để ch&uacute;ng t&ocirc;i thiết kế &amp; b&aacute;o gi&aacute;.</p>\r\n\r\n<p>Nếu l&agrave; đơn h&agrave;ng cần lắp đặt ch&uacute;ng t&ocirc;i sẽ đưa thợ đến lắp đặt Tất cả sản phẩm do c&ocirc;ng ty ch&uacute;ng t&ocirc;i thực hiện đều dược bảo h&agrave;nh &iacute;t nhất l&agrave; 12 th&aacute;ng.</p>\r\n\r\n<p>Nhận gia c&ocirc;ng chữ inox,Mica: (Giao h&agrave;ng to&agrave;n quốc) Cắt chữ bằng m&aacute;y laser Fiber kim loại Sản xuất chữ bằng m&aacute;y uốn tự động H&agrave;n chữ bằng m&aacute;y h&agrave;n laser hiện đại Nhanh, gọn, đẹp. C&oacute; thể gia c&ocirc;ng uốn chữ từ 10 cm trở l&ecirc;n Kh&ocirc;ng d&ugrave;ng Ax&iacute;t, kh&ocirc;ng d&ugrave;ng ch&igrave;, rất an to&agrave;n cho sức khỏe Kh&ocirc;ng cần đ&aacute;nh b&oacute;ng vệ sinh Gia c&ocirc;ng xong l&agrave; lắp đặt lu&ocirc;n L&agrave;m h&agrave;i l&ograve;ng kh&aacute;ch h&agrave;ng kể cả những kh&aacute;ch h&agrave;ng kh&oacute; t&iacute;nh nhất</p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH DỊCH VỤ QUẢNG C&Aacute;O THỊNH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>Địa chỉ:&nbsp;163 Lương Định Của, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>Điện thoại: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'CHỮ NỔI INOX', 'CHỮ NỔI INOX', 0, '2018-05-10 20:11:54', '2018-05-11 02:52:22', ''),
(8, 'CHỮ NỔI MICA', 'chu-noi-mica', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/banghieucaphedep-thumbs-600x400.jpg', '<p>Ch&uacute;ng t&ocirc;i chuy&ecirc;n thi c&ocirc;ng v&agrave; gia c&ocirc;ng chữ nổi mica, chữ nổi inox, chữ nổi alu bằng m&aacute;y chuy&ecirc;n dụng tự động &amp; với gi&aacute; th&agrave;nh ph&ugrave; hợp.</p>\r\n\r\n<p>Ch&uacute;ng t&ocirc;i chuy&ecirc;n thi c&ocirc;ng v&agrave; gia c&ocirc;ng chữ quảng c&aacute;o bằng m&aacute;y chuy&ecirc;n dụng tự động &amp; hiện đại, chữ nổi LED lắp đặt tr&ecirc;n c&aacute;c t&ograve;a nh&agrave;, nh&agrave; xưởng, chữ t&ocirc;n (hoặc Inox) sơn tĩnh điện, chữ Mica, chữ Alu&hellip;</p>\r\n\r\n<ul>\r\n	<li>Nếu n&oacute;i bảng Aluminium hoặc mặt dựng Aluminium được xem như nền của một bảng hiệu th&igrave; chữ nổi quảng c&aacute;o, chữ mica l&agrave; th&agrave;nh phần ch&iacute;nh được lắp đặt bố tr&iacute; h&agrave;i h&ograve;a để tạo n&ecirc;n một bảng hiệu đẹp, chuy&ecirc;n nghiệp.</li>\r\n	<li>Chữ nổi quảng c&aacute;o do C&ocirc;ng ty T&Agrave;I HƯNG THỊNH&nbsp;thực hiện, được gia c&ocirc;ng tr&ecirc;n m&aacute;y cắt laser ,</li>\r\n	<li>C&ocirc;ng ty THỊNH T&Iacute;N PH&Aacute;T tr&acirc;n trọng k&iacute;nh mời qu&yacute; kh&aacute;ch h&agrave;ng vui l&ograve;ng bớt ch&uacute;t thời gian gh&eacute; qua c&ocirc;ng ty ch&uacute;ng t&ocirc;i để tham khảo mẫu v&agrave; để ch&uacute;ng t&ocirc;i được phục vụ cho qu&yacute; kh&aacute;ch h&agrave;ng tốt nhất trước khi quyết định đặt h&agrave;ng.<img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/MICA1.png\" style=\"height:720px; width:1170px\" /></li>\r\n	<li>Đối với kh&aacute;ch h&agrave;ng ở xa, ở tỉnh, xin vui l&ograve;ng cung cấp k&iacute;ch thước, số đo để ch&uacute;ng t&ocirc;i thiết kế &amp; b&aacute;o gi&aacute;. Nếu l&agrave; đơn h&agrave;ng cần lắp đặt ch&uacute;ng t&ocirc;i sẽ đưa thợ đến lắp đặt</li>\r\n	<li>Tất cả sản phẩm do c&ocirc;ng ty ch&uacute;ng t&ocirc;i thực hiện đều dược bảo h&agrave;nh &iacute;t nhất l&agrave; 12 th&aacute;ng.</li>\r\n</ul>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH DỊCH VỤ QUẢNG C&Aacute;O THỊNH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>Địa chỉ:&nbsp;163 Lương Định Của, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>Điện thoại: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 'CHỮ NỔI MICA', 'CHỮ NỔI MICA', 0, '2018-05-10 20:13:47', '2018-05-11 02:52:05', ''),
(10, 'CẮT VÁCH NGĂN CNC', 'cat-vach-ngan-cnc', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/vach-ngan-cnc-phong-khach-dep-8.jpg', '<p>Chuy&ecirc;n cung cấp , ph&acirc;n phối v&agrave; thi c&ocirc;ng v&aacute;ch cnc v&aacute;ch ngăn trang tr&iacute; , v&aacute;ch ngăn di động đẹp,đ&uacute;ng phong thủy , chống nước , chống ch&aacute;y , gi&aacute; tốt tại tphcm</p>\r\n\r\n<p><img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/cnc1.png\" style=\"height:1000px; width:1170px\" /></p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH DỊCH VỤ QUẢNG C&Aacute;O THỊNH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>Địa chỉ:&nbsp;163 Lương Định Của, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>Điện thoại: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'cat vach ngan cnc', 'cat vach ngan cnc', 0, '2018-05-10 20:26:21', '2018-05-11 02:51:50', ''),
(11, 'THI CÔNG VÁCH NGĂN CNC', 'thi-cong-vach-ngan-cnc', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/b278d57212ede2b7c8e8deb9ee2bbd75.jpg', '<p>V&aacute;ch Ngăn CNC Ph&ograve;ng Kh&aacute;ch, Ph&ograve;ng Ngủ,ph&ograve;ng thờ-V&aacute;ch ngăn Hoa Văn 2D 3D- gi&aacute; rẻ tại TPHCM mẫu m&atilde; đẹp đa dạng,gi&aacute; cả hợp l&yacute;.Li&ecirc;n hệ ngay để được ch&uacute;ng t&ocirc;i tư vấn</p>\r\n\r\n<p><img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/cnc.png\" style=\"height:1000px; width:1170px\" /></p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH DỊCH VỤ QUẢNG C&Aacute;O THỊNH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>Địa chỉ:&nbsp;163 Lương Định Của, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>Điện thoại: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'vach ngan cnc', 'vach ngan cnc', 0, '2018-05-10 20:28:44', '2018-05-11 02:51:21', ''),
(12, 'CUNG CẤP VÁCH NGĂN CNC', 'cung-cap-vach-ngan-cnc', 0, 'http://cnc-bangdenled.vnwis.com/uploads/source/a690da59bca19bf612b0f9c2bc4100c6.jpg', '<p>V&aacute;ch cnc - v&aacute;ch ngăn gỗ cnc trang tr&iacute; nội thất cao cấp ứng dụng cho nhiều kh&ocirc;ng gian. V&aacute;ch cnc ph&ograve;ng kh&aacute;ch, v&aacute;ch ngăn cnc ph&ograve;ng thờ, v&aacute;ch ngăn cầu thang cnc ... l&agrave; những ứng dụng tuyệt vời của v&aacute;ch cnc</p>\r\n\r\n<p><img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/cnc1.png\" style=\"height:1000px; width:1170px\" /><img alt=\"\" src=\"http://cnc-bangdenled.vnwis.com/uploads/source/cnc.png\" style=\"height:1000px; width:1170px\" /></p>\r\n\r\n<p><strong>C&Ocirc;NG TY TNHH DỊCH VỤ QUẢNG C&Aacute;O THỊNH T&Iacute;N PH&Aacute;T</strong></p>\r\n\r\n<p>Địa chỉ:&nbsp;163 Lương Định Của, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>Điện thoại: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'vach ngan cnc gia re', 'vach ngan cnc gia re', 0, '2018-05-10 20:34:29', '2018-05-11 02:50:15', '');

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
(3, 'Contact Us', 'CÔNG TY TNHH DỊCH VỤ QUẢNG CÁO THỊNH TÍN PHÁT', '<h1>&nbsp;</h1>\r\n\r\n<p>Địa chỉ:&nbsp;163 Lương Định Của, P. B&igrave;nh Kh&aacute;nh, Q.2, Tp. HCM</p>\r\n\r\n<p>Điện thoại: 0908 303 369</p>\r\n\r\n<p>Email: thinhtinphatqc@gmail.com</p>\r\n\r\n<p>Website: http://www.cnc-bangdenled.com</p>', 'QUẢNG CÁO THỊNH PHÁT;163 Lương Định Của, P. Bình Khánh, Q.2, Tp. HCM;0908 303 369;thinhtinphatqc@gmail.com;10.787878;106.734376', NULL, NULL, NULL, NULL, 'bangdenled-cnc', 'bangdenled,vachngancnc', 'bangdenled,vachngancnc', 'bangdenled,vachngancnc', 'bangdenled,vachngancnc', NULL, '2018-05-11 00:20:28'),
(4, 'Sản Phẩm', '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', NULL, NULL),
(5, 'Tuyển Dụng', 'nội dung đang được cập nhật....', NULL, NULL, NULL, NULL, NULL, NULL, 'dsds', 'dsdsd', 'đsdd', 'dsds', 'ddsd', NULL, '2018-05-10 21:51:49');

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
