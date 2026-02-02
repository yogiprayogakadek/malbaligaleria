-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2026 at 06:13 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_malbaligaleria`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36\"}', NULL, '2026-01-20 22:38:07', '2026-01-20 22:38:07'),
(2, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36\"}', NULL, '2026-01-21 21:42:35', '2026-01-21 21:42:35'),
(3, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36\"}', NULL, '2026-01-24 05:19:04', '2026-01-24 05:19:04'),
(4, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36\"}', NULL, '2026-01-24 20:23:06', '2026-01-24 20:23:06'),
(5, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36\"}', NULL, '2026-01-25 23:19:38', '2026-01-25 23:19:38'),
(6, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36\"}', NULL, '2026-01-26 19:09:25', '2026-01-26 19:09:25'),
(7, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36\"}', NULL, '2026-01-27 23:50:28', '2026-01-27 23:50:28'),
(8, 'default', 'updated', 'App\\Models\\Category', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"color_zone\":\"#FFF000\"},\"old\":{\"color_zone\":\"#e89121\"}}', NULL, '2026-01-28 00:22:42', '2026-01-28 00:22:42'),
(9, 'default', 'updated', 'App\\Models\\Category', 'updated', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"color_zone\":\"#0273B6\"},\"old\":{\"color_zone\":\"#408c92\"}}', NULL, '2026-01-28 00:23:42', '2026-01-28 00:23:42'),
(10, 'default', 'updated', 'App\\Models\\Category', 'updated', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"color_zone\":\"#B04B87\"},\"old\":{\"color_zone\":\"#a966fe\"}}', NULL, '2026-01-28 00:24:50', '2026-01-28 00:24:50'),
(11, 'default', 'updated', 'App\\Models\\Category', 'updated', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"color_zone\":\"#B9CCBC\"},\"old\":{\"color_zone\":\"#2d4624\"}}', NULL, '2026-01-28 00:26:33', '2026-01-28 00:26:33'),
(12, 'default', 'updated', 'App\\Models\\Category', 'updated', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"color_zone\":\"#009B4C\"},\"old\":{\"color_zone\":\"#d78d31\"}}', NULL, '2026-01-28 00:26:57', '2026-01-28 00:26:57'),
(13, 'default', 'updated', 'App\\Models\\Category', 'updated', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"color_zone\":\"#EEEEEF\"},\"old\":{\"color_zone\":\"#d04d78\"}}', NULL, '2026-01-28 00:29:23', '2026-01-28 00:29:23'),
(14, 'default', 'updated', 'App\\Models\\Category', 'updated', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"color_zone\":\"#A79CCB\"},\"old\":{\"color_zone\":\"#a66237\"}}', NULL, '2026-01-28 00:32:23', '2026-01-28 00:32:23'),
(15, 'default', 'updated', 'App\\Models\\Category', 'updated', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"color_zone\":\"#EF8781\"},\"old\":{\"color_zone\":\"#4926e1\"}}', NULL, '2026-01-28 00:32:57', '2026-01-28 00:32:57'),
(16, 'default', 'updated', 'App\\Models\\Category', 'updated', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"color_zone\":\"#F4B3B3\"},\"old\":{\"color_zone\":\"#8e8b3e\"}}', NULL, '2026-01-28 00:33:25', '2026-01-28 00:33:25'),
(17, 'default', 'updated', 'App\\Models\\Category', 'updated', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"color_zone\":\"#EEEEEF\"},\"old\":{\"color_zone\":\"#1b1365\"}}', NULL, '2026-01-28 00:34:04', '2026-01-28 00:34:04'),
(18, 'default', 'updated', 'App\\Models\\Category', 'updated', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"color_zone\":\"#DAB96B\"},\"old\":{\"color_zone\":\"#b4be62\"}}', NULL, '2026-01-28 00:34:28', '2026-01-28 00:34:28'),
(19, 'default', 'updated', 'App\\Models\\Category', 'updated', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"color_zone\":\"#F4B3B3\"},\"old\":{\"color_zone\":\"#12a5ab\"}}', NULL, '2026-01-28 00:35:25', '2026-01-28 00:35:25'),
(20, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36\"}', NULL, '2026-01-28 18:31:44', '2026-01-28 18:31:44'),
(21, 'default', 'created', 'App\\Models\\Category', 'created', 1, NULL, NULL, '{\"attributes\":{\"uuid\":\"a67b7bc1-aed9-43d9-88d4-c88e997fbee5\",\"name\":\"IT, Games & Gadgets\",\"color_zone\":\"#FFF000\",\"is_active\":1}}', NULL, '2026-01-29 20:09:46', '2026-01-29 20:09:46'),
(22, 'default', 'created', 'App\\Models\\Category', 'created', 2, NULL, NULL, '{\"attributes\":{\"uuid\":\"11efbb1b-68d8-4ca1-ad12-3f8e07944e00\",\"name\":\"Anchor Tenant\",\"color_zone\":\"#0273B6\",\"is_active\":1}}', NULL, '2026-01-29 20:09:46', '2026-01-29 20:09:46'),
(23, 'default', 'created', 'App\\Models\\Category', 'created', 3, NULL, NULL, '{\"attributes\":{\"uuid\":\"bad6ae0d-9659-4478-9c8f-d05df9d60040\",\"name\":\"Fashion, Beauty & Accessories\",\"color_zone\":\"#B04B87\",\"is_active\":1}}', NULL, '2026-01-29 20:09:47', '2026-01-29 20:09:47'),
(24, 'default', 'created', 'App\\Models\\Category', 'created', 4, NULL, NULL, '{\"attributes\":{\"uuid\":\"72fb1c2a-12d9-43b2-9897-2345c27fdcb8\",\"name\":\"Food & Beverages\",\"color_zone\":\"#5BA997\",\"is_active\":1}}', NULL, '2026-01-29 20:09:47', '2026-01-29 20:09:47'),
(25, 'default', 'created', 'App\\Models\\Category', 'created', 5, NULL, NULL, '{\"attributes\":{\"uuid\":\"b905ce65-4ee9-49e0-a277-14f896a4e333\",\"name\":\"Island Counter\",\"color_zone\":\"#009B4C\",\"is_active\":1}}', NULL, '2026-01-29 20:09:47', '2026-01-29 20:09:47'),
(26, 'default', 'created', 'App\\Models\\Category', 'created', 6, NULL, NULL, '{\"attributes\":{\"uuid\":\"c932da4d-86bb-4cf5-b423-0301b358621b\",\"name\":\"Household Goods & Furniture\",\"color_zone\":\"#B9CCBC\",\"is_active\":1}}', NULL, '2026-01-29 20:09:47', '2026-01-29 20:09:47'),
(27, 'default', 'created', 'App\\Models\\Category', 'created', 7, NULL, NULL, '{\"attributes\":{\"uuid\":\"833abbe1-e659-4670-8d34-f46c1dd49a9e\",\"name\":\"Bookstore\",\"color_zone\":\"#FBD7A3\",\"is_active\":1}}', NULL, '2026-01-29 20:09:47', '2026-01-29 20:09:47'),
(28, 'default', 'created', 'App\\Models\\Category', 'created', 8, NULL, NULL, '{\"attributes\":{\"uuid\":\"70a2f418-7775-481a-9bd9-ffebfc1810ba\",\"name\":\"Sport & Swim Apparel\",\"color_zone\":\"#A79CCB\",\"is_active\":1}}', NULL, '2026-01-29 20:09:47', '2026-01-29 20:09:47'),
(29, 'default', 'created', 'App\\Models\\Category', 'created', 9, NULL, NULL, '{\"attributes\":{\"uuid\":\"c94c3e3d-1ad9-4fcf-8f51-0a9533241372\",\"name\":\"Kids & Play Zone\",\"color_zone\":\"#925D23\",\"is_active\":1}}', NULL, '2026-01-29 20:09:47', '2026-01-29 20:09:47'),
(30, 'default', 'created', 'App\\Models\\Category', 'created', 10, NULL, NULL, '{\"attributes\":{\"uuid\":\"a3ff88a9-acf8-4b63-9a20-e1f914eda4af\",\"name\":\"Salon, Office & Services\",\"color_zone\":\"#F4B3B3\",\"is_active\":1}}', NULL, '2026-01-29 20:09:47', '2026-01-29 20:09:47'),
(31, 'default', 'created', 'App\\Models\\Category', 'created', 11, NULL, NULL, '{\"attributes\":{\"uuid\":\"24607ec1-415b-4b66-94b2-3add1c624336\",\"name\":\"Convetion Hall \\/ Museum\",\"color_zone\":\"#EEEEEF\",\"is_active\":1}}', NULL, '2026-01-29 20:09:47', '2026-01-29 20:09:47'),
(32, 'default', 'created', 'App\\Models\\Category', 'created', 12, NULL, NULL, '{\"attributes\":{\"uuid\":\"67dbbccb-cf1a-452e-8427-965183e6e115\",\"name\":\"Drugs & Pharmacy\",\"color_zone\":\"#DAB96B\",\"is_active\":1}}', NULL, '2026-01-29 20:09:47', '2026-01-29 20:09:47'),
(33, 'default', 'login', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36\"}', NULL, '2026-02-01 17:58:54', '2026-02-01 17:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-4bb5d57ec9725c3089e2e58ff8b59250', 'i:1;', 1769997591),
('laravel-cache-4bb5d57ec9725c3089e2e58ff8b59250:timer', 'i:1769997591;', 1769997591);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-tenant_floor_1st Floor_', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:213:{i:0;a:8:{s:2:\"id\";i:1;s:4:\"name\";s:13:\"Aora Jewellry\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A-22\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/aora jewellry.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:1;a:8:{s:2:\"id\";i:2;s:4:\"name\";s:13:\"Bamboo Blonde\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A-23\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/bamboo blonde.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:2;a:8:{s:2:\"id\";i:3;s:4:\"name\";s:5:\"Guess\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A-25\";s:4:\"logo\";s:57:\"http://127.0.0.1:8000/assets/images/tenant_logo/guess.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:3;a:8:{s:2:\"id\";i:4;s:4:\"name\";s:17:\"Bath & Body Works\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1A 26-27\";s:4:\"logo\";s:69:\"http://127.0.0.1:8000/assets/images/tenant_logo/bath & body works.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:4;a:8:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"L\'occitane\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A-28\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/l\'occitane.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:5;a:8:{s:2:\"id\";i:6;s:4:\"name\";s:7:\"Rotelli\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A-29\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/rotelli.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:6;a:8:{s:2:\"id\";i:7;s:4:\"name\";s:7:\"By Aura\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A-30\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/by aura.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:7;a:8:{s:2:\"id\";i:8;s:4:\"name\";s:12:\"Steve Madden\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A-31\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/steve madden.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:8;a:8:{s:2:\"id\";i:9;s:4:\"name\";s:5:\"Arena\";s:8:\"category\";s:20:\"Sport & Swim Apparel\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A-32\";s:4:\"logo\";s:57:\"http://127.0.0.1:8000/assets/images/tenant_logo/arena.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:9;a:8:{s:2:\"id\";i:10;s:4:\"name\";s:7:\"Naughty\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A-33\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/naughty.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:10;a:8:{s:2:\"id\";i:11;s:4:\"name\";s:12:\"Hush Puppies\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A-35\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/hush puppies.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:11;a:8:{s:2:\"id\";i:12;s:4:\"name\";s:6:\"Popits\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A-36\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/popits.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:12;a:8:{s:2:\"id\";i:13;s:4:\"name\";s:18:\"American Tourister\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A-37\";s:4:\"logo\";s:70:\"http://127.0.0.1:8000/assets/images/tenant_logo/american tourister.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:13;a:8:{s:2:\"id\";i:14;s:4:\"name\";s:10:\"Timberland\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A-38\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/timberland.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:14;a:8:{s:2:\"id\";i:15;s:4:\"name\";s:5:\"Hoops\";s:8:\"category\";s:20:\"Sport & Swim Apparel\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1A 39-40\";s:4:\"logo\";s:57:\"http://127.0.0.1:8000/assets/images/tenant_logo/hoops.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:15;a:8:{s:2:\"id\";i:16;s:4:\"name\";s:4:\"Polo\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1A 41-42\";s:4:\"logo\";s:56:\"http://127.0.0.1:8000/assets/images/tenant_logo/polo.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:16;a:8:{s:2:\"id\";i:17;s:4:\"name\";s:12:\"Camel Active\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A-43\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/camel active.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:17;a:8:{s:2:\"id\";i:18;s:4:\"name\";s:8:\"Matahari\";s:8:\"category\";s:13:\"Anchor Tenant\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/matahari.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:18;a:8:{s:2:\"id\";i:19;s:4:\"name\";s:6:\"Intimo\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1C-97\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/intimo.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:19;a:8:{s:2:\"id\";i:20;s:4:\"name\";s:8:\"Stroberi\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1C-96\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/stroberi.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:20;a:8:{s:2:\"id\";i:21;s:4:\"name\";s:9:\"Watchout!\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1C-95\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/watchout!.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:21;a:8:{s:2:\"id\";i:22;s:4:\"name\";s:4:\"Gosh\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1C-93\";s:4:\"logo\";s:56:\"http://127.0.0.1:8000/assets/images/tenant_logo/gosh.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:22;a:8:{s:2:\"id\";i:23;s:4:\"name\";s:6:\"Wacoal\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1C-92\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/wacoal.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:23;a:8:{s:2:\"id\";i:24;s:4:\"name\";s:8:\"Everbest\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1C-91\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/everbest.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:24;a:8:{s:2:\"id\";i:25;s:4:\"name\";s:4:\"Bata\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1C 89-90\";s:4:\"logo\";s:56:\"http://127.0.0.1:8000/assets/images/tenant_logo/bata.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:25;a:8:{s:2:\"id\";i:26;s:4:\"name\";s:16:\"The Perfume Shop\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1C-88\";s:4:\"logo\";s:68:\"http://127.0.0.1:8000/assets/images/tenant_logo/the perfume shop.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:26;a:8:{s:2:\"id\";i:27;s:4:\"name\";s:7:\"Minimal\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1C-87\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/minimal.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:27;a:8:{s:2:\"id\";i:28;s:4:\"name\";s:8:\"Bellagio\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1C-86\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/bellagio.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:28;a:8:{s:2:\"id\";i:29;s:4:\"name\";s:10:\"Mississipi\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1C-85\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/mississipi.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:29;a:8:{s:2:\"id\";i:30;s:4:\"name\";s:6:\"Levi\'s\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1C 82-82\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/levi\'s.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:30;a:8:{s:2:\"id\";i:31;s:4:\"name\";s:8:\"Giordano\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1C 80-81\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/giordano.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:31;a:8:{s:2:\"id\";i:32;s:4:\"name\";s:9:\"Havaianas\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1C-79\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/havaianas.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:32;a:8:{s:2:\"id\";i:33;s:4:\"name\";s:4:\"Keds\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1C-78\";s:4:\"logo\";s:56:\"http://127.0.0.1:8000/assets/images/tenant_logo/keds.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:33;a:8:{s:2:\"id\";i:34;s:4:\"name\";s:6:\"Donini\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1C-77\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/donini.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:34;a:8:{s:2:\"id\";i:35;s:4:\"name\";s:13:\"The Body Shop\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1C-76\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/the body shop.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:35;a:8:{s:2:\"id\";i:36;s:4:\"name\";s:4:\"Puma\";s:8:\"category\";s:20:\"Sport & Swim Apparel\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1C 73-75\";s:4:\"logo\";s:56:\"http://127.0.0.1:8000/assets/images/tenant_logo/puma.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:36;a:8:{s:2:\"id\";i:37;s:4:\"name\";s:17:\"Victoria\'s Secret\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"1C-72a\";s:4:\"logo\";s:69:\"http://127.0.0.1:8000/assets/images/tenant_logo/victoria\'s secret.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:37;a:8:{s:2:\"id\";i:38;s:4:\"name\";s:7:\"Whsmith\";s:8:\"category\";s:9:\"Bookstore\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"1C-72b\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/WHSmith.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:38;a:8:{s:2:\"id\";i:39;s:4:\"name\";s:13:\"This Is April\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1B-51\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/this is april.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:39;a:8:{s:2:\"id\";i:40;s:4:\"name\";s:13:\"Vinoti Living\";s:8:\"category\";s:27:\"Household Goods & Furniture\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1B-52\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/vinoti living.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:40;a:8:{s:2:\"id\";i:41;s:4:\"name\";s:6:\"Miniso\";s:8:\"category\";s:27:\"Household Goods & Furniture\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1B-53\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/miniso.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:41;a:8:{s:2:\"id\";i:42;s:4:\"name\";s:22:\"Hello The Healthy Brew\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:74:\"http://127.0.0.1:8000/assets/images/tenant_logo/hello the healthy brew.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:42;a:8:{s:2:\"id\";i:43;s:4:\"name\";s:10:\"Panlandwoo\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/panlandwoo.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:43;a:8:{s:2:\"id\";i:44;s:4:\"name\";s:7:\"Bananas\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/bananas.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:44;a:8:{s:2:\"id\";i:45;s:4:\"name\";s:8:\"Balinata\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/balinata.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:45;a:8:{s:2:\"id\";i:46;s:4:\"name\";s:9:\"Moncherie\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/moncherie.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:46;a:8:{s:2:\"id\";i:47;s:4:\"name\";s:11:\"Shake Shake\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:63:\"http://127.0.0.1:8000/assets/images/tenant_logo/shake shake.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:47;a:8:{s:2:\"id\";i:48;s:4:\"name\";s:4:\"Zuma\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:56:\"http://127.0.0.1:8000/assets/images/tenant_logo/zuma.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:48;a:8:{s:2:\"id\";i:49;s:4:\"name\";s:14:\"Captain Burger\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:66:\"http://127.0.0.1:8000/assets/images/tenant_logo/captain burger.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:49;a:8:{s:2:\"id\";i:50;s:4:\"name\";s:6:\"Kanini\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/kanini.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:50;a:8:{s:2:\"id\";i:51;s:4:\"name\";s:11:\"Dear Butter\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:63:\"http://127.0.0.1:8000/assets/images/tenant_logo/dear butter.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:51;a:8:{s:2:\"id\";i:52;s:4:\"name\";s:12:\"Beard Papa\'s\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/beard papa\'s.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:52;a:8:{s:2:\"id\";i:53;s:4:\"name\";s:10:\"Sour Sally\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/sour sally.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:53;a:8:{s:2:\"id\";i:54;s:4:\"name\";s:7:\"Chatime\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:2:\"K2\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/chatime.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:54;a:8:{s:2:\"id\";i:55;s:4:\"name\";s:10:\"Full Hardy\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/full hardy.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:55;a:8:{s:2:\"id\";i:56;s:4:\"name\";s:8:\"Roti Boy\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/roti boy.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:56;a:8:{s:2:\"id\";i:57;s:4:\"name\";s:7:\"Chikuro\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/chikuro.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:57;a:8:{s:2:\"id\";i:58;s:4:\"name\";s:7:\"Shihlin\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/shihlin.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:58;a:8:{s:2:\"id\";i:59;s:4:\"name\";s:4:\"Puyo\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:56:\"http://127.0.0.1:8000/assets/images/tenant_logo/puyo.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:59;a:8:{s:2:\"id\";i:60;s:4:\"name\";s:20:\"Somay Little Menteng\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:72:\"http://127.0.0.1:8000/assets/images/tenant_logo/somay little menteng.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:60;a:8:{s:2:\"id\";i:61;s:4:\"name\";s:7:\"Montato\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/montato.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:61;a:8:{s:2:\"id\";i:62;s:4:\"name\";s:9:\"Charlie\'s\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/charlie\'s.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:62;a:8:{s:2:\"id\";i:63;s:4:\"name\";s:11:\"Yves Rocher\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:2:\"1B\";s:4:\"logo\";s:63:\"http://127.0.0.1:8000/assets/images/tenant_logo/yves rocher.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:63;a:8:{s:2:\"id\";i:64;s:4:\"name\";s:15:\"C & F Perfumery\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:2:\"1B\";s:4:\"logo\";s:67:\"http://127.0.0.1:8000/assets/images/tenant_logo/c & f perfumery.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:64;a:8:{s:2:\"id\";i:65;s:4:\"name\";s:10:\"Optik Seis\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1B-49\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/optik seis.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:65;a:8:{s:2:\"id\";i:66;s:4:\"name\";s:7:\"Koi The\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:2:\"K1\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/koi the.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:66;a:8:{s:2:\"id\";i:67;s:4:\"name\";s:14:\"Parang Kencana\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1B-47\";s:4:\"logo\";s:66:\"http://127.0.0.1:8000/assets/images/tenant_logo/parang kencana.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:67;a:8:{s:2:\"id\";i:68;s:4:\"name\";s:7:\"Solaria\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:16:\"V4 Galeria Resto\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/solaria.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:68;a:8:{s:2:\"id\";i:69;s:4:\"name\";s:7:\"Excelso\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:16:\"V3 Galeria Resto\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/excelso.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:69;a:8:{s:2:\"id\";i:70;s:4:\"name\";s:8:\"Javabica\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:16:\"V2 Galeria Resto\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/javabica.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:70;a:8:{s:2:\"id\";i:71;s:4:\"name\";s:16:\"Starbucks Coffee\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:16:\"V1 Galeria Resto\";s:4:\"logo\";s:68:\"http://127.0.0.1:8000/assets/images/tenant_logo/starbucks coffee.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:71;a:8:{s:2:\"id\";i:72;s:4:\"name\";s:9:\"Ramen Ya!\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:17:\"V1A Galeria Resto\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/Ramen Ya!.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:72;a:8:{s:2:\"id\";i:73;s:4:\"name\";s:14:\"Tous Les Jours\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1C 70-71\";s:4:\"logo\";s:66:\"http://127.0.0.1:8000/assets/images/tenant_logo/tous les jours.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:73;a:8:{s:2:\"id\";i:74;s:4:\"name\";s:4:\"J.co\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1C 68-69\";s:4:\"logo\";s:56:\"http://127.0.0.1:8000/assets/images/tenant_logo/j.co.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:74;a:8:{s:2:\"id\";i:75;s:4:\"name\";s:20:\"Pizza Hut Ristorante\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1C 66-67\";s:4:\"logo\";s:72:\"http://127.0.0.1:8000/assets/images/tenant_logo/pizza hut ristorante.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:75;a:8:{s:2:\"id\";i:76;s:4:\"name\";s:12:\"Es Teller 77\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1C-65\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/es teller 77.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:76;a:8:{s:2:\"id\";i:77;s:4:\"name\";s:13:\"Marugame Udon\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1C 62-63\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/marugame udon.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:77;a:8:{s:2:\"id\";i:78;s:4:\"name\";s:7:\"Raa Cha\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1C 60-61\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/raa cha.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:78;a:8:{s:2:\"id\";i:79;s:4:\"name\";s:13:\"Ichiban Sushi\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1C 58-59\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/ichiban sushi.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:79;a:8:{s:2:\"id\";i:80;s:4:\"name\";s:26:\"Ryoshi Japanese Restaurant\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1C 55-57\";s:4:\"logo\";s:78:\"http://127.0.0.1:8000/assets/images/tenant_logo/ryoshi japanese restaurant.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:80;a:8:{s:2:\"id\";i:81;s:4:\"name\";s:7:\"Dum Dum\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/dum dum.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:81;a:8:{s:2:\"id\";i:82;s:4:\"name\";s:9:\"Herborist\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/herborist.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:82;a:8:{s:2:\"id\";i:83;s:4:\"name\";s:12:\"Penyetan Cok\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:10:\"1A 02a-02b\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/penyetan cok.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:83;a:8:{s:2:\"id\";i:84;s:4:\"name\";s:0:\"\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:2:\"1A\";s:4:\"logo\";s:52:\"http://127.0.0.1:8000/assets/images/tenant_logo/.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:84;a:8:{s:2:\"id\";i:85;s:4:\"name\";s:6:\"Ramen1\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1A 03-05\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/ramen1.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:85;a:8:{s:2:\"id\";i:86;s:4:\"name\";s:6:\"Ta Wan\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1A 06-07\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/ta wan.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:86;a:8:{s:2:\"id\";i:87;s:4:\"name\";s:7:\"Tik Tok\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A #A\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/tik tok.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:87;a:8:{s:2:\"id\";i:88;s:4:\"name\";s:10:\"Baso Afung\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1A-08\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/baso afung.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:88;a:8:{s:2:\"id\";i:89;s:4:\"name\";s:8:\"Mm Juice\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1A 09-10\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/MM juice.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:89;a:8:{s:2:\"id\";i:90;s:4:\"name\";s:13:\"Pandan Kuring\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1A 11-12\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/pandan kuring.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:90;a:8:{s:2:\"id\";i:91;s:4:\"name\";s:14:\"Dedari Kuliner\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:66:\"http://127.0.0.1:8000/assets/images/tenant_logo/dedari kuliner.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:91;a:8:{s:2:\"id\";i:92;s:4:\"name\";s:4:\"Relx\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:56:\"http://127.0.0.1:8000/assets/images/tenant_logo/relx.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:92;a:8:{s:2:\"id\";i:93;s:4:\"name\";s:16:\"London Taxi Bike\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:68:\"http://127.0.0.1:8000/assets/images/tenant_logo/london taxi bike.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:93;a:8:{s:2:\"id\";i:94;s:4:\"name\";s:5:\"Wakai\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1B-48\";s:4:\"logo\";s:57:\"http://127.0.0.1:8000/assets/images/tenant_logo/wakai.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:94;a:8:{s:2:\"id\";i:95;s:4:\"name\";s:6:\"Fossil\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1B-50\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/fossil.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:95;a:8:{s:2:\"id\";i:96;s:4:\"name\";s:4:\"Nike\";s:8:\"category\";s:13:\"Anchor Tenant\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:56:\"http://127.0.0.1:8000/assets/images/tenant_logo/nike.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:96;a:8:{s:2:\"id\";i:97;s:4:\"name\";s:3:\"H&M\";s:8:\"category\";s:13:\"Anchor Tenant\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:55:\"http://127.0.0.1:8000/assets/images/tenant_logo/h&m.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:97;a:8:{s:2:\"id\";i:98;s:4:\"name\";s:3:\"Xxi\";s:8:\"category\";s:13:\"Anchor Tenant\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:55:\"http://127.0.0.1:8000/assets/images/tenant_logo/XXI.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:98;a:8:{s:2:\"id\";i:99;s:4:\"name\";s:4:\"Azko\";s:8:\"category\";s:13:\"Anchor Tenant\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:56:\"http://127.0.0.1:8000/assets/images/tenant_logo/azko.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:99;a:8:{s:2:\"id\";i:100;s:4:\"name\";s:5:\"Asics\";s:8:\"category\";s:20:\"Sport & Swim Apparel\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1E-08\";s:4:\"logo\";s:57:\"http://127.0.0.1:8000/assets/images/tenant_logo/asics.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:100;a:8:{s:2:\"id\";i:101;s:4:\"name\";s:11:\"New Balance\";s:8:\"category\";s:20:\"Sport & Swim Apparel\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1E-07\";s:4:\"logo\";s:63:\"http://127.0.0.1:8000/assets/images/tenant_logo/new balance.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:101;a:8:{s:2:\"id\";i:102;s:4:\"name\";s:12:\"Flying Tiger\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1E-06\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/flying tiger.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:102;a:8:{s:2:\"id\";i:103;s:4:\"name\";s:7:\"Digimap\";s:8:\"category\";s:19:\"IT, Games & Gadgets\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1E-05\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/digimap.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:103;a:8:{s:2:\"id\";i:104;s:4:\"name\";s:7:\"Kipling\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"1E-03b\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/kipling.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:104;a:8:{s:2:\"id\";i:105;s:4:\"name\";s:7:\"Pandora\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"1E-03a\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/pandora.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:105;a:8:{s:2:\"id\";i:106;s:4:\"name\";s:9:\"Saturdays\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:10:\"CL Ext. 01\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/saturdays.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:106;a:8:{s:2:\"id\";i:107;s:4:\"name\";s:7:\"Owndays\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:10:\"CL Ext. 01\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/owndays.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:107;a:8:{s:2:\"id\";i:108;s:4:\"name\";s:8:\"Sociolla\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"1E-01a\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/sociolla.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:108;a:8:{s:2:\"id\";i:109;s:4:\"name\";s:6:\"Amaris\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1F-15\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/amaris.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:109;a:8:{s:2:\"id\";i:110;s:4:\"name\";s:15:\"Charles & Keith\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1F-16\";s:4:\"logo\";s:67:\"http://127.0.0.1:8000/assets/images/tenant_logo/charles & keith.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:110;a:8:{s:2:\"id\";i:111;s:4:\"name\";s:18:\"The Athlete\'s Foot\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1F-17\";s:4:\"logo\";s:70:\"http://127.0.0.1:8000/assets/images/tenant_logo/the athlete\'s foot.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:111;a:8:{s:2:\"id\";i:112;s:4:\"name\";s:12:\"Sport Direct\";s:8:\"category\";s:13:\"Anchor Tenant\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/sport direct.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:112;a:8:{s:2:\"id\";i:113;s:4:\"name\";s:4:\"Hoka\";s:8:\"category\";s:20:\"Sport & Swim Apparel\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1F-02\";s:4:\"logo\";s:56:\"http://127.0.0.1:8000/assets/images/tenant_logo/hoka.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:113;a:8:{s:2:\"id\";i:114;s:4:\"name\";s:4:\"Aldo\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"1F-03a\";s:4:\"logo\";s:56:\"http://127.0.0.1:8000/assets/images/tenant_logo/aldo.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:114;a:8:{s:2:\"id\";i:115;s:4:\"name\";s:15:\"Tommy Hillfiger\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"1F-05b\";s:4:\"logo\";s:67:\"http://127.0.0.1:8000/assets/images/tenant_logo/tommy hillfiger.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:115;a:8:{s:2:\"id\";i:116;s:4:\"name\";s:6:\"Adidas\";s:8:\"category\";s:20:\"Sport & Swim Apparel\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1F-06\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/adidas.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:116;a:8:{s:2:\"id\";i:117;s:4:\"name\";s:7:\"Lacoste\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"1F-07a\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/lacoste.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:117;a:8:{s:2:\"id\";i:118;s:4:\"name\";s:12:\"Calvin Klein\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"1F-07b\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/calvin klein.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:118;a:8:{s:2:\"id\";i:119;s:4:\"name\";s:15:\"Marks & Spencer\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"1F 08-09\";s:4:\"logo\";s:67:\"http://127.0.0.1:8000/assets/images/tenant_logo/marks & spencer.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:119;a:8:{s:2:\"id\";i:120;s:4:\"name\";s:9:\"Cotton On\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1F-10\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/cotton on.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:120;a:8:{s:2:\"id\";i:121;s:4:\"name\";s:12:\"Project Soul\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1F-11\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/project soul.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:121;a:8:{s:2:\"id\";i:122;s:4:\"name\";s:10:\"Frank & Co\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1F-12\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/frank & co.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:122;a:8:{s:2:\"id\";i:123;s:4:\"name\";s:8:\"Sensatia\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1F-22\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/sensatia.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:123;a:8:{s:2:\"id\";i:124;s:4:\"name\";s:17:\"Sate Khas Senayan\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"1E-02\";s:4:\"logo\";s:69:\"http://127.0.0.1:8000/assets/images/tenant_logo/sate khas senayan.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:124;a:8:{s:2:\"id\";i:125;s:4:\"name\";s:7:\"Crusita\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:9:\"Cl Ext-01\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/crusita.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:125;a:8:{s:2:\"id\";i:126;s:4:\"name\";s:13:\"Secret Garden\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:9:\"Cl Ext-02\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/secret garden.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:126;a:8:{s:2:\"id\";i:127;s:4:\"name\";s:9:\"Nespresso\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:9:\"Cl Ext-03\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/nespresso.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:127;a:8:{s:2:\"id\";i:128;s:4:\"name\";s:11:\"Shark Ninja\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:9:\"Cl Ext-01\";s:4:\"logo\";s:63:\"http://127.0.0.1:8000/assets/images/tenant_logo/shark ninja.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:128;a:8:{s:2:\"id\";i:129;s:4:\"name\";s:8:\"Skechers\";s:8:\"category\";s:20:\"Sport & Swim Apparel\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:9:\"2A 15-17b\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/skechers.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:129;a:8:{s:2:\"id\";i:130;s:4:\"name\";s:5:\"Crocs\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"2A 17a\";s:4:\"logo\";s:57:\"http://127.0.0.1:8000/assets/images/tenant_logo/crocs.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:130;a:8:{s:2:\"id\";i:131;s:4:\"name\";s:6:\"Uniqlo\";s:8:\"category\";s:13:\"Anchor Tenant\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/uniqlo.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:131;a:8:{s:2:\"id\";i:132;s:4:\"name\";s:7:\"Manzone\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2A-21\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/manzone.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:132;a:8:{s:2:\"id\";i:133;s:4:\"name\";s:8:\"Fit Flop\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2A-22\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/fit flop.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:133;a:8:{s:2:\"id\";i:134;s:4:\"name\";s:7:\"Celcius\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2A-23\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/celcius.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:134;a:8:{s:2:\"id\";i:135;s:4:\"name\";s:7:\"Advance\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2A-25\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/advance.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:135;a:8:{s:2:\"id\";i:136;s:4:\"name\";s:9:\"Dr. Specs\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2A-26\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/dr. specs.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:136;a:8:{s:2:\"id\";i:137;s:4:\"name\";s:10:\"Bag\'s City\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2A-27\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/bag\'s city.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:137;a:8:{s:2:\"id\";i:138;s:4:\"name\";s:9:\"Color Box\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"2A 28-29\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/color box.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:138;a:8:{s:2:\"id\";i:139;s:4:\"name\";s:13:\"Optik Tunggal\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2A-30\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/optik tunggal.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:139;a:8:{s:2:\"id\";i:140;s:4:\"name\";s:13:\"Optik Melawai\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2A-31\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/optik melawai.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:140;a:8:{s:2:\"id\";i:141;s:4:\"name\";s:9:\"Hypermart\";s:8:\"category\";s:13:\"Anchor Tenant\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/hypermart.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:141;a:8:{s:2:\"id\";i:142;s:4:\"name\";s:9:\"Matahari \";s:8:\"category\";s:13:\"Anchor Tenant\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/matahari .png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:142;a:8:{s:2:\"id\";i:143;s:4:\"name\";s:7:\"Simmons\";s:8:\"category\";s:27:\"Household Goods & Furniture\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2C-91\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/simmons.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:143;a:8:{s:2:\"id\";i:144;s:4:\"name\";s:5:\"Serta\";s:8:\"category\";s:27:\"Household Goods & Furniture\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"2C 88-89\";s:4:\"logo\";s:57:\"http://127.0.0.1:8000/assets/images/tenant_logo/serta.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:144;a:8:{s:2:\"id\";i:145;s:4:\"name\";s:14:\"Lady Americana\";s:8:\"category\";s:27:\"Household Goods & Furniture\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2C-87\";s:4:\"logo\";s:66:\"http://127.0.0.1:8000/assets/images/tenant_logo/lady americana.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:145;a:8:{s:2:\"id\";i:146;s:4:\"name\";s:17:\"Guardian Pharmacy\";s:8:\"category\";s:16:\"Drugs & Pharmacy\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"2C 85-86\";s:4:\"logo\";s:69:\"http://127.0.0.1:8000/assets/images/tenant_logo/guardian pharmacy.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:146;a:8:{s:2:\"id\";i:147;s:4:\"name\";s:20:\"Top Star Accessories\";s:8:\"category\";s:19:\"IT, Games & Gadgets\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2C-83\";s:4:\"logo\";s:72:\"http://127.0.0.1:8000/assets/images/tenant_logo/top star accessories.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:147;a:8:{s:2:\"id\";i:148;s:4:\"name\";s:4:\"Bose\";s:8:\"category\";s:19:\"IT, Games & Gadgets\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2C-82\";s:4:\"logo\";s:56:\"http://127.0.0.1:8000/assets/images/tenant_logo/bose.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:148;a:8:{s:2:\"id\";i:149;s:4:\"name\";s:8:\"Digiplus\";s:8:\"category\";s:19:\"IT, Games & Gadgets\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:9:\"2C 80-81b\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/digiplus.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:149;a:8:{s:2:\"id\";i:150;s:4:\"name\";s:10:\"Game Sport\";s:8:\"category\";s:19:\"IT, Games & Gadgets\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"2C-81a\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/game sport.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:150;a:8:{s:2:\"id\";i:151;s:4:\"name\";s:6:\"Xiamoi\";s:8:\"category\";s:19:\"IT, Games & Gadgets\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2C-79\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/xiamoi.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:151;a:8:{s:2:\"id\";i:152;s:4:\"name\";s:7:\"Samsung\";s:8:\"category\";s:19:\"IT, Games & Gadgets\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2C-78\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/samsung.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:152;a:8:{s:2:\"id\";i:153;s:4:\"name\";s:9:\"King Koil\";s:8:\"category\";s:27:\"Household Goods & Furniture\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"2C 76-77\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/king koil.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:153;a:8:{s:2:\"id\";i:154;s:4:\"name\";s:8:\"Staccato\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:3:\"D2B\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/staccato.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:154;a:8:{s:2:\"id\";i:155;s:4:\"name\";s:11:\"Birkenstock\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:3:\"D2B\";s:4:\"logo\";s:63:\"http://127.0.0.1:8000/assets/images/tenant_logo/birkenstock.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:155;a:8:{s:2:\"id\";i:156;s:4:\"name\";s:7:\"New Era\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:2:\"D3\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/new era.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:156;a:8:{s:2:\"id\";i:157;s:4:\"name\";s:6:\"Kcmtku\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2A-T1\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/kcmtku.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:157;a:8:{s:2:\"id\";i:158;s:4:\"name\";s:12:\"Watch Studio\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2A-T2\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/watch studio.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:158;a:8:{s:2:\"id\";i:159;s:4:\"name\";s:4:\"Iqos\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:56:\"http://127.0.0.1:8000/assets/images/tenant_logo/iqos.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:159;a:8:{s:2:\"id\";i:160;s:4:\"name\";s:12:\"Miracle & Co\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/miracle & co.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:160;a:8:{s:2:\"id\";i:161;s:4:\"name\";s:12:\"Gino Mariani\";s:8:\"category\";s:19:\"IT, Games & Gadgets\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/gino mariani.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:161;a:8:{s:2:\"id\";i:162;s:4:\"name\";s:3:\"Gnc\";s:8:\"category\";s:16:\"Drugs & Pharmacy\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2C-T2\";s:4:\"logo\";s:55:\"http://127.0.0.1:8000/assets/images/tenant_logo/gnc.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:162;a:8:{s:2:\"id\";i:163;s:4:\"name\";s:6:\"Tomomi\";s:8:\"category\";s:27:\"Household Goods & Furniture\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2C-T1\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/tomomi.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:163;a:8:{s:2:\"id\";i:164;s:4:\"name\";s:7:\"Churros\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/churros.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:164;a:8:{s:2:\"id\";i:165;s:4:\"name\";s:12:\"Lucky Cheese\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/lucky cheese.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:165;a:8:{s:2:\"id\";i:166;s:4:\"name\";s:8:\"Thai Inc\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/thai inc.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:166;a:8:{s:2:\"id\";i:167;s:4:\"name\";s:8:\"Photoinc\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/photoinc.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:167;a:8:{s:2:\"id\";i:168;s:4:\"name\";s:13:\"Perfect Relax\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/perfect relax.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:168;a:8:{s:2:\"id\";i:169;s:4:\"name\";s:9:\"24Bottles\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/24Bottles.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:169;a:8:{s:2:\"id\";i:170;s:4:\"name\";s:12:\"Doran Gadget\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/doran gadget.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:170;a:8:{s:2:\"id\";i:171;s:4:\"name\";s:17:\"Planet Sport Asia\";s:8:\"category\";s:13:\"Anchor Tenant\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:69:\"http://127.0.0.1:8000/assets/images/tenant_logo/Planet Sport Asia.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:171;a:8:{s:2:\"id\";i:172;s:4:\"name\";s:11:\"Foot Locker\";s:8:\"category\";s:13:\"Anchor Tenant\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:63:\"http://127.0.0.1:8000/assets/images/tenant_logo/foot locker.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:172;a:8:{s:2:\"id\";i:173;s:4:\"name\";s:10:\"Mothercare\";s:8:\"category\";s:16:\"Kids & Play Zone\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2C-69\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/Mothercare.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:173;a:8:{s:2:\"id\";i:174;s:4:\"name\";s:7:\"Erafone\";s:8:\"category\";s:19:\"IT, Games & Gadgets\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"2C 66-67\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/erafone.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:174;a:8:{s:2:\"id\";i:175;s:4:\"name\";s:20:\"Hair Creator Nailpia\";s:8:\"category\";s:24:\"Salon, Office & Services\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"2C 66-67\";s:4:\"logo\";s:72:\"http://127.0.0.1:8000/assets/images/tenant_logo/hair creator nailpia.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:175;a:8:{s:2:\"id\";i:176;s:4:\"name\";s:9:\"Jbl Store\";s:8:\"category\";s:19:\"IT, Games & Gadgets\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2C-63\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/jbl store.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:176;a:8:{s:2:\"id\";i:177;s:4:\"name\";s:6:\"Huawei\";s:8:\"category\";s:19:\"IT, Games & Gadgets\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2C-62\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/huawei.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:177;a:8:{s:2:\"id\";i:178;s:4:\"name\";s:9:\"Loly Poly\";s:8:\"category\";s:19:\"IT, Games & Gadgets\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2C-61\";s:4:\"logo\";s:61:\"http://127.0.0.1:8000/assets/images/tenant_logo/loly poly.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:178;a:8:{s:2:\"id\";i:179;s:4:\"name\";s:11:\"King Rabbit\";s:8:\"category\";s:27:\"Household Goods & Furniture\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2C-60\";s:4:\"logo\";s:63:\"http://127.0.0.1:8000/assets/images/tenant_logo/king rabbit.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:179;a:8:{s:2:\"id\";i:180;s:4:\"name\";s:8:\"Ur Store\";s:8:\"category\";s:19:\"IT, Games & Gadgets\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"2C 58-59\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/ur store.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:180;a:8:{s:2:\"id\";i:181;s:4:\"name\";s:14:\"Clean And Care\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:66:\"http://127.0.0.1:8000/assets/images/tenant_logo/clean and care.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:181;a:8:{s:2:\"id\";i:182;s:4:\"name\";s:6:\"Homcha\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:58:\"http://127.0.0.1:8000/assets/images/tenant_logo/homcha.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:182;a:8:{s:2:\"id\";i:183;s:4:\"name\";s:10:\"Phoooto.id\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/phoooto.id.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:183;a:8:{s:2:\"id\";i:184;s:4:\"name\";s:12:\"Gacha Corner\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/gacha corner.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:184;a:8:{s:2:\"id\";i:185;s:4:\"name\";s:12:\"Toys Kingdom\";s:8:\"category\";s:13:\"Anchor Tenant\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/toys kingdom.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:185;a:8:{s:2:\"id\";i:186;s:4:\"name\";s:7:\"Oni Ola\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/oni ola.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:186;a:8:{s:2:\"id\";i:187;s:4:\"name\";s:10:\"Small Town\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/small town.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:187;a:8:{s:2:\"id\";i:188;s:4:\"name\";s:8:\"Gramedia\";s:8:\"category\";s:13:\"Anchor Tenant\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/gramedia.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:188;a:8:{s:2:\"id\";i:189;s:4:\"name\";s:11:\"Batik Keris\";s:8:\"category\";s:13:\"Anchor Tenant\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:63:\"http://127.0.0.1:8000/assets/images/tenant_logo/batik keris.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:189;a:8:{s:2:\"id\";i:190;s:4:\"name\";s:17:\"Christopher Salon\";s:8:\"category\";s:24:\"Salon, Office & Services\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2A-07\";s:4:\"logo\";s:69:\"http://127.0.0.1:8000/assets/images/tenant_logo/christopher salon.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:190;a:8:{s:2:\"id\";i:191;s:4:\"name\";s:10:\"Cimb Niaga\";s:8:\"category\";s:24:\"Salon, Office & Services\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2A-08\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/cimb niaga.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:191;a:8:{s:2:\"id\";i:192;s:4:\"name\";s:11:\"Yopie Salon\";s:8:\"category\";s:24:\"Salon, Office & Services\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2A-09\";s:4:\"logo\";s:63:\"http://127.0.0.1:8000/assets/images/tenant_logo/yopie salon.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:192;a:8:{s:2:\"id\";i:193;s:4:\"name\";s:17:\"Grapari Telkomsel\";s:8:\"category\";s:24:\"Salon, Office & Services\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"2A 10-11\";s:4:\"logo\";s:69:\"http://127.0.0.1:8000/assets/images/tenant_logo/grapari telkomsel.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:193;a:8:{s:2:\"id\";i:194;s:4:\"name\";s:13:\"Johnny Andrea\";s:8:\"category\";s:24:\"Salon, Office & Services\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2A-12\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/johnny andrea.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:194;a:8:{s:2:\"id\";i:195;s:4:\"name\";s:10:\"Studio Tas\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"2A-12a\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/studio tas.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:195;a:8:{s:2:\"id\";i:196;s:4:\"name\";s:8:\"Photoism\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"2E-01c\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/photoism.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:196;a:8:{s:2:\"id\";i:197;s:4:\"name\";s:7:\"Zhengda\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"2E-01a\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/zhengda.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:197;a:8:{s:2:\"id\";i:198;s:4:\"name\";s:5:\"Mixue\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"2E-01b\";s:4:\"logo\";s:57:\"http://127.0.0.1:8000/assets/images/tenant_logo/mixue.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:198;a:8:{s:2:\"id\";i:199;s:4:\"name\";s:11:\"Selfie Time\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"2E-02a\";s:4:\"logo\";s:63:\"http://127.0.0.1:8000/assets/images/tenant_logo/selfie time.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:199;a:8:{s:2:\"id\";i:200;s:4:\"name\";s:8:\"Gong Cha\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"2E-02b\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/gong cha.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:200;a:8:{s:2:\"id\";i:201;s:4:\"name\";s:17:\"Tan-Panama Coffee\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"2E-03a\";s:4:\"logo\";s:69:\"http://127.0.0.1:8000/assets/images/tenant_logo/Tan-Panama Coffee.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:201;a:8:{s:2:\"id\";i:202;s:4:\"name\";s:13:\"Tomoro Coffee\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:6:\"2E-03b\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/tomoro coffee.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:202;a:8:{s:2:\"id\";i:203;s:4:\"name\";s:8:\"Gong Cha\";s:8:\"category\";s:16:\"Food & Beverages\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:8:\"2E 05-07\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/gong cha.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:203;a:8:{s:2:\"id\";i:204;s:4:\"name\";s:16:\"Bali Ice Skating\";s:8:\"category\";s:16:\"Kids & Play Zone\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:68:\"http://127.0.0.1:8000/assets/images/tenant_logo/bali ice skating.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:204;a:8:{s:2:\"id\";i:205;s:4:\"name\";s:10:\"Mindchamps\";s:8:\"category\";s:16:\"Kids & Play Zone\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/mindchamps.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:205;a:8:{s:2:\"id\";i:206;s:4:\"name\";s:13:\"Wangsa Gelato\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/wangsa gelato.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:206;a:8:{s:2:\"id\";i:207;s:4:\"name\";s:13:\"Orlenalycious\";s:8:\"category\";s:14:\"Island Counter\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:1:\"-\";s:4:\"logo\";s:65:\"http://127.0.0.1:8000/assets/images/tenant_logo/orlenalycious.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:207;a:8:{s:2:\"id\";i:208;s:4:\"name\";s:12:\"Kidz Station\";s:8:\"category\";s:16:\"Kids & Play Zone\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2E-17\";s:4:\"logo\";s:64:\"http://127.0.0.1:8000/assets/images/tenant_logo/kidz station.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:208;a:8:{s:2:\"id\";i:209;s:4:\"name\";s:7:\"Smiggle\";s:8:\"category\";s:16:\"Kids & Play Zone\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2E-18\";s:4:\"logo\";s:59:\"http://127.0.0.1:8000/assets/images/tenant_logo/smiggle.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:209;a:8:{s:2:\"id\";i:210;s:4:\"name\";s:8:\"Funifun!\";s:8:\"category\";s:16:\"Kids & Play Zone\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2E-19\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/FuniFun!.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:210;a:8:{s:2:\"id\";i:211;s:4:\"name\";s:8:\"Timezone\";s:8:\"category\";s:16:\"Kids & Play Zone\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2E-11\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/timezone.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:211;a:8:{s:2:\"id\";i:212;s:4:\"name\";s:8:\"Oh Some!\";s:8:\"category\";s:16:\"Kids & Play Zone\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2E-12\";s:4:\"logo\";s:60:\"http://127.0.0.1:8000/assets/images/tenant_logo/OH SOME!.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}i:212;a:8:{s:2:\"id\";i:213;s:4:\"name\";s:10:\"Mon Cherie\";s:8:\"category\";s:29:\"Fashion, Beauty & Accessories\";s:5:\"floor\";s:9:\"2nd Floor\";s:4:\"unit\";s:5:\"2E-15\";s:4:\"logo\";s:62:\"http://127.0.0.1:8000/assets/images/tenant_logo/Mon Cherie.png\";s:5:\"hours\";s:19:\"10:00 AM - 10:00 PM\";s:5:\"album\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1770001357);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_zone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `uuid`, `name`, `color_zone`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'a67b7bc1-aed9-43d9-88d4-c88e997fbee5', 'IT, Games & Gadgets', '#FFF000', 1, '2026-01-29 20:09:42', '2026-01-29 20:09:42', NULL),
(2, '11efbb1b-68d8-4ca1-ad12-3f8e07944e00', 'Anchor Tenant', '#0273B6', 1, '2026-01-29 20:09:46', '2026-01-29 20:09:46', NULL),
(3, 'bad6ae0d-9659-4478-9c8f-d05df9d60040', 'Fashion, Beauty & Accessories', '#B04B87', 1, '2026-01-29 20:09:46', '2026-01-29 20:09:46', NULL),
(4, '72fb1c2a-12d9-43b2-9897-2345c27fdcb8', 'Food & Beverages', '#5BA997', 1, '2026-01-29 20:09:47', '2026-01-29 20:09:47', NULL),
(5, 'b905ce65-4ee9-49e0-a277-14f896a4e333', 'Island Counter', '#009B4C', 1, '2026-01-29 20:09:47', '2026-01-29 20:09:47', NULL),
(6, 'c932da4d-86bb-4cf5-b423-0301b358621b', 'Household Goods & Furniture', '#B9CCBC', 1, '2026-01-29 20:09:47', '2026-01-29 20:09:47', NULL),
(7, '833abbe1-e659-4670-8d34-f46c1dd49a9e', 'Bookstore', '#FBD7A3', 1, '2026-01-29 20:09:47', '2026-01-29 20:09:47', NULL),
(8, '70a2f418-7775-481a-9bd9-ffebfc1810ba', 'Sport & Swim Apparel', '#A79CCB', 1, '2026-01-29 20:09:47', '2026-01-29 20:09:47', NULL),
(9, 'c94c3e3d-1ad9-4fcf-8f51-0a9533241372', 'Kids & Play Zone', '#925D23', 1, '2026-01-29 20:09:47', '2026-01-29 20:09:47', NULL),
(10, 'a3ff88a9-acf8-4b63-9a20-e1f914eda4af', 'Salon, Office & Services', '#F4B3B3', 1, '2026-01-29 20:09:47', '2026-01-29 20:09:47', NULL),
(11, '24607ec1-415b-4b66-94b2-3add1c624336', 'Convetion Hall / Museum', '#EEEEEF', 1, '2026-01-29 20:09:47', '2026-01-29 20:09:47', NULL),
(12, '67dbbccb-cf1a-452e-8427-965183e6e115', 'Drugs & Pharmacy', '#DAB96B', 1, '2026-01-29 20:09:47', '2026-01-29 20:09:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organizer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `price` decimal(15,2) DEFAULT NULL,
  `target_audience` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `highlights` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `uuid`, `name`, `start_date`, `end_date`, `start_time`, `end_time`, `description`, `location`, `organizer`, `is_paid`, `price`, `target_audience`, `highlights`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 'f65aa8c8-9e91-4838-82c0-f545f284deff', 'Grand Opening Celebration', '2026-02-01', '2026-02-07', '10:00:00', '22:00:00', 'Join us for our grand opening celebration with special performances, giveaways, and exclusive discounts throughout the week!', 'Main Atrium', 'Mal Bali Galeria', 0, NULL, 'General', 'Live Music, Giveaways', 1, '2026-01-28 23:12:30', '2026-01-28 23:12:30', NULL),
(12, '71d72bec-be91-4d30-820b-01b869af6aab', 'Valentine\'s Day Special', '2026-02-14', '2026-02-14', '12:00:00', '20:00:00', 'Celebrate love with romantic dining experiences, couple activities, and special Valentine\'s Day promotions at participating stores.', 'Garden Area', 'Events Team', 1, '150000.00', 'Couples', 'Romantic Dinner, Live Jazz', 1, '2026-01-28 23:12:30', '2026-01-28 23:12:30', NULL),
(13, '7cb58d78-e7cc-4838-a9b6-eae89d42e8b2', 'Kids Fun Festival', '2026-03-15', '2026-03-22', '11:00:00', '19:00:00', 'A week-long festival featuring fun activities for kids including face painting, magic shows, balloon art, and interactive games.', 'Kids Zone', 'Kids World', 1, '50000.00', 'Kids', 'Magic Show, Face Painting', 1, '2026-01-28 23:12:30', '2026-01-28 23:12:30', NULL),
(14, '507499f1-ed7a-4d23-9216-7699dc5b1485', 'Fashion Week Showcase', '2026-04-10', '2026-04-17', '14:00:00', '21:00:00', 'Experience the latest fashion trends with runway shows, styling workshops, and exclusive previews from top fashion brands.', 'Main Atrium', 'Fashion Indo', 0, NULL, 'Fashion Enthusiasts', 'Runway Show, Styling Tips', 1, '2026-01-28 23:12:30', '2026-01-28 23:12:30', NULL),
(15, 'f2781993-4a4d-4156-bfc5-95cfdf7fb369', 'Summer Music Festival', '2026-06-20', '2026-06-21', '16:00:00', '23:00:00', 'Two days of live music performances featuring local and international artists across multiple genres.', 'Outdoor Arena', 'Sound Check', 1, '250000.00', 'Youth', 'Live Concert, Food Trucks', 1, '2026-01-28 23:12:30', '2026-01-28 23:12:30', NULL),
(16, '810da108-bc22-484e-9418-70e217d0b793', 'Back to School Fair', '2026-07-15', '2026-07-31', '10:00:00', '21:00:00', 'Get ready for the new school year with special discounts on school supplies, uniforms, books, and educational materials.', 'East Wing', 'Education Dept', 0, NULL, 'Students', 'Book Fair, Tech Deals', 1, '2026-01-28 23:12:30', '2026-01-28 23:12:30', NULL),
(17, '396c2c47-5edb-4084-9dc5-082ac6400628', 'Mid-Year Mega Sale', '2026-07-01', '2026-07-15', '10:00:00', '22:00:00', 'Massive discounts up to 70% off on fashion, electronics, home goods, and more from all participating stores.', 'Mall Wide', 'Mal Bali Galeria', 0, NULL, 'General', 'Big Discounts, Flash Sale', 1, '2026-01-28 23:12:31', '2026-01-28 23:12:31', NULL),
(18, '8ca209b1-67b0-494f-a16a-f736d7050b82', 'Halloween Spooktacular', '2026-10-31', '2026-10-31', '15:00:00', '22:00:00', 'Trick-or-treat around the mall, costume contest, haunted house experience, and spooky decorations throughout.', 'Main Atrium', 'Spooky Events', 1, '75000.00', 'Kids & Family', 'Costume Contest, Haunted House', 1, '2026-01-28 23:12:31', '2026-01-28 23:12:31', NULL),
(19, 'be6358ca-03cf-4f15-8ac7-ec838b0ddb74', 'Black Friday Deals', '2026-11-27', '2026-11-29', '08:00:00', '23:00:00', 'The biggest shopping event of the year with unbeatable deals, doorbuster specials, and exclusive Black Friday offers.', 'Mall Wide', 'Mal Bali Galeria', 0, NULL, 'General', 'Doorbusters, Extended Hours', 1, '2026-01-28 23:12:31', '2026-01-28 23:12:31', NULL),
(20, '397ad1df-92a9-49db-a44c-0b816eefaa15', 'Christmas Wonderland', '2026-12-01', '2026-12-25', '10:00:00', '22:00:00', 'Experience the magic of Christmas with festive decorations, Santa meet & greet, carol performances, and holiday shopping.', 'Central Plaza', 'Santa Corp', 0, NULL, 'Family', 'Santa Visit, Snow Show', 1, '2026-01-28 23:12:31', '2026-01-28 23:12:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_photos`
--

CREATE TABLE `event_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_photos`
--

INSERT INTO `event_photos` (`id`, `event_id`, `path`, `caption`, `is_primary`, `created_at`, `updated_at`) VALUES
(1, 11, 'event_images/MUNyI9PNCit6wi0JiW9QZAVwfG7GUiFNGxUiTjQA.jpg', 'Grand Opening', 1, '2026-01-28 23:25:00', '2026-01-28 23:25:00'),
(2, 11, 'event_images/DdOc8GDmGsYkIYhO3QjeksDWsgFFNaCEs18ZOa44.jpg', 'Grand Opening', 0, '2026-01-28 23:25:00', '2026-01-28 23:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_categories_table', 1),
(2, '0001_01_01_000001_create_tenants_table', 1),
(3, '0001_01_01_000002_create_users_table', 1),
(4, '0001_01_01_000003_create_cache_table', 1),
(5, '0001_01_01_000004_create_jobs_table', 1),
(6, '2025_11_25_052535_create_events_table', 1),
(7, '2025_11_25_052540_create_promos_table', 1),
(8, '2025_11_25_052548_create_settings_table', 1),
(9, '2025_11_27_015331_create_permission_tables', 1),
(10, '2025_11_27_025208_create_tenant_photos_table', 1),
(11, '2025_11_27_025753_create_event_photos_table', 1),
(12, '2025_11_27_031732_create_activity_log_table', 1),
(13, '2025_11_27_031733_add_event_column_to_activity_log_table', 1),
(14, '2025_11_27_031734_add_batch_uuid_column_to_activity_log_table', 1),
(15, '2025_11_27_045255_add_two_factor_columns_to_users_table', 1),
(16, '2025_12_01_014830_add_website_field_on_tenants_table', 1),
(17, '2025_12_02_071007_add_timestaps_field_to_tenant_photos_table', 1),
(18, '2025_12_10_075048_add_timestamps_field_to_event_photos_table', 1),
(19, '2025_12_22_023523_add_launched_at_field_to_tenants_table', 1),
(20, '2025_12_30_064821_add_is_new_field_to_tenants_table', 1),
(21, '2026_01_02_015439_add_status_note_field_to_users_table', 1),
(22, '2026_01_02_064936_create_notifications_table', 1),
(23, '2026_01_29_070712_add_details_to_events_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view tenants', 'web', '2026-01-20 22:37:43', '2026-01-20 22:37:43'),
(2, 'manage tenants', 'web', '2026-01-20 22:37:43', '2026-01-20 22:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `banner` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`id`, `uuid`, `tenant_id`, `name`, `start_date`, `end_date`, `description`, `is_active`, `banner`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'd8fa78d0-ee22-4e56-a1d5-88d45c34d48d', 56, 'Grand Opening Special - 50% Off', '2026-02-01', '2026-02-28', 'Celebrate our grand opening with 50% off on all items! Limited time only.', 1, 'promo_grand_opening.jpg', '2026-01-28 00:49:28', '2026-01-28 00:49:28', NULL),
(2, 'fbe2a4bc-b894-4327-a3b8-1ec1e42f7998', 40, 'Buy 1 Get 1 Free', '2026-02-10', '2026-02-20', 'Buy one item and get another one absolutely free! Valid on selected items.', 1, 'promo_buy1get1.jpg', '2026-01-28 00:49:28', '2026-01-28 00:49:28', NULL),
(3, '945e0233-a4da-4271-b178-d4499c45296c', 74, 'Valentine\'s Day Discount', '2026-02-10', '2026-02-14', 'Show your love with special Valentine\'s Day discounts up to 30% off on selected items.', 1, 'promo_valentine.jpg', '2026-01-28 00:49:28', '2026-01-28 00:49:28', NULL),
(4, '3c2a0c25-243d-4c79-9e17-591004deff79', 19, 'Spring Collection Launch', '2026-03-01', '2026-03-31', 'Discover our new spring collection with 20% off on all new arrivals.', 1, 'promo_spring.jpg', '2026-01-28 00:49:28', '2026-01-28 00:49:28', NULL),
(5, '3258ae9a-2fb2-4ba9-b09c-dc3339181e74', 54, 'Flash Sale - 3 Hours Only', '2026-03-15', '2026-03-15', 'Lightning deals! Up to 70% off for 3 hours only. Don\'t miss out!', 1, 'promo_flash_sale.jpg', '2026-01-28 00:49:28', '2026-01-28 00:49:28', NULL),
(6, '7d7626aa-0897-4bfa-ae62-085fcacd1fe4', 128, 'Member Exclusive - Extra 15% Off', '2026-04-01', '2026-04-30', 'Members get an extra 15% discount on top of existing promotions. Join now!', 1, 'promo_member.jpg', '2026-01-28 00:49:28', '2026-01-28 00:49:28', NULL),
(7, '978c258c-c55c-4a0b-86e4-065f861b3cc6', 43, 'Summer Clearance Sale', '2026-06-01', '2026-06-30', 'Clear out summer stock with massive discounts up to 60% off!', 1, 'promo_summer_clearance.jpg', '2026-01-28 00:49:28', '2026-01-28 00:49:28', NULL),
(8, '6d97193b-2c50-446d-a0fd-1fc54b6c10e6', 84, 'Back to School Promo', '2026-07-15', '2026-08-15', 'Get ready for school with 25% off on all school essentials and supplies.', 1, 'promo_back_to_school.jpg', '2026-01-28 00:49:28', '2026-01-28 00:49:28', NULL),
(9, '9a160038-ad74-47c1-8cda-12e9ea55c255', 4, 'Weekend Special - Free Gift', '2026-08-01', '2026-08-31', 'Shop this weekend and receive a free gift with every purchase over $100.', 1, 'promo_weekend.jpg', '2026-01-28 00:49:28', '2026-01-28 00:49:28', NULL),
(10, 'c1611e57-9309-449d-b66c-3194022e209e', 103, 'Mid-Year Mega Sale', '2026-07-01', '2026-07-15', 'Our biggest sale of the year! Up to 80% off on selected items.', 1, 'promo_mega_sale.jpg', '2026-01-28 00:49:28', '2026-01-28 00:49:28', NULL),
(11, '38d1ff31-d181-4775-b14d-6b63d0bab34b', 9, 'Black Friday Early Access', '2026-11-20', '2026-11-29', 'Get early access to Black Friday deals! Exclusive discounts for early birds.', 1, 'promo_black_friday.jpg', '2026-01-28 00:49:28', '2026-01-28 00:49:28', NULL),
(12, '0370f054-cf7d-45f7-950d-a035a947b607', 69, 'Cyber Monday Deals', '2026-11-30', '2026-11-30', 'Online exclusive deals for Cyber Monday! Shop from home and save big.', 1, 'promo_cyber_monday.jpg', '2026-01-28 00:49:28', '2026-01-28 00:49:28', NULL),
(13, '706f7149-50de-48b6-aed2-42bfc503a784', 66, 'Christmas Gift Guide Sale', '2026-12-01', '2026-12-24', 'Find the perfect Christmas gifts with special holiday discounts up to 40% off.', 1, 'promo_christmas.jpg', '2026-01-28 00:49:28', '2026-01-28 00:49:28', NULL),
(14, 'de620115-4175-4695-a50a-1cfc199aa3fe', 59, 'Year End Clearance', '2026-12-26', '2026-12-31', 'End the year with amazing deals! Clearance sale up to 75% off.', 1, 'promo_year_end.jpg', '2026-01-28 00:49:28', '2026-01-28 00:49:28', NULL),
(15, 'f062e7dc-b63b-471a-bf24-24852ca81e10', 123, 'New Year New You - Fitness Sale', '2027-01-01', '2027-01-15', 'Start the new year right with 30% off on all fitness and wellness products.', 1, 'promo_new_year.jpg', '2026-01-28 00:49:28', '2026-01-28 00:49:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2026-01-20 22:37:43', '2026-01-20 22:37:43'),
(2, 'tenant', 'web', '2026-01-20 22:37:43', '2026-01-20 22:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('h81rZmA3QamYHdljjZ6I2a4GszdwP51QiyEp2gQO', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUXVjWHJjNUl3YW45OHprYkd4VWtOUmJNZ3VwMGo1amlpRzlzakt3VyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ub3RpZmljYXRpb25zL2xhdGVzdCI7czo1OiJyb3V0ZSI7czoyMDoibm90aWZpY2F0aW9ucy5sYXRlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1770009167);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pages` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`payload`)),
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('default','custom') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'custom',
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `pages`, `name`, `payload`, `description`, `type`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'home', 'default', '{\"site_title\":\"Mal Bali Galeria\",\"hero_background\":\"assets\\/images\\/default\\/background.webp\",\"hero_title\":\"The FIRST Premium Shopping Mall & Life Style Destination in Bali\",\"hero_subtitle\":\"The Best Way to Predict The Future is to Create It and That Future is here...\"}', 'default setting for home page', 'default', 1, '2026-01-20 22:37:45', '2026-01-20 22:37:45', NULL),
(2, 'mal directory', 'default', '{\"site_title\":\"Mal Bali Galeria | Tenants Directory\",\"page_title\":\"Tenant Directory\",\"page_subtitle\":\"Discover our collection of premium brands and stores\"}', 'default setting for directory', 'default', 1, '2026-01-20 22:37:45', '2026-01-20 22:37:45', NULL),
(3, 'event', 'default', '{\"site_title\":\"Mal Bali Galeria | Event\",\"page_title\":\"Current Events\",\"page_subtitle\":\"Discover our collection of premium brands and stores\"}', 'default setting for event', 'default', 0, '2026-01-20 22:37:45', '2026-01-26 01:05:34', NULL),
(4, 'promo', 'default', '{\"site_title\":\"Mal Bali Galeria | Tenants Directory\",\"page_title\":\"Current Promotions\",\"page_subtitle\":\"Discover amazing deals and offers from our tenants\"}', 'default setting for promo', 'default', 0, '2026-01-20 22:37:45', '2026-01-26 01:02:07', NULL),
(5, 'others', 'default', '{\"company_address\":\"Jl. Bypass Ngurah Rai, Kuta, Badung, Bali 80361\",\"contact_email\":\"info@malbaligaleria.com\",\"contact_phone\":\"(0361) 755277\",\"social_facebook\":\"\",\"social_instagram\":\"malbaligaleria\",\"logo\":\"assets\\/images\\/default\\/logo.png\"}', 'default setting for others', 'default', 1, '2026-01-20 22:37:45', '2026-01-20 22:37:45', NULL),
(7, 'event', 'custom setting', '{\"site_title\":\"Event\",\"page_title\":\"Event\",\"page_subtitle\":\"Event\"}', 'custom setting', 'custom', 1, '2026-01-26 01:06:04', '2026-01-26 01:06:04', NULL),
(8, 'promo', 'Custom Seting', '{\"site_title\":\"Promo\'s\",\"page_title\":\"Promo\'s\",\"page_subtitle\":\"Discover amazing deals and offers from our tenants\"}', 'Custom setting for promotion page', 'custom', 1, '2026-01-26 01:44:20', '2026-01-26 01:44:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('tenant','island') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tenant',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_coords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`map_coords`)),
  `map_original_size` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`map_original_size`)),
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `launched_at` date DEFAULT NULL,
  `isNew` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `uuid`, `category_id`, `type`, `name`, `phone`, `email`, `website`, `map_coords`, `map_original_size`, `logo`, `description`, `is_active`, `launched_at`, `isNew`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '7407fe61-0579-4e93-877f-919c385de2e1', 3, 'tenant', 'Aora Jewellry', NULL, NULL, NULL, '{\"x\":\"1086\",\"y\":\"3186\",\"floor\":\"1\",\"unit\":\"1A-22\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/aora jewellry.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:12:50', NULL),
(2, '5a679299-a252-4e11-a765-40a9e8281752', 3, 'tenant', 'Bamboo Blonde', NULL, NULL, NULL, '{\"x\":\"1083\",\"y\":\"3238\",\"floor\":\"1\",\"unit\":\"1A-23\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/bamboo blonde.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:13:09', NULL),
(3, '5242cfee-0753-437f-b732-9e2504068cb7', 3, 'tenant', 'Guess', NULL, NULL, NULL, '{\"x\":\"1086\",\"y\":\"3289\",\"floor\":\"1\",\"unit\":\"1A-25\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/guess.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:13:44', NULL),
(4, '3d0c01a4-4c90-4719-b3f1-3df4fc855c37', 3, 'tenant', 'Bath & Body Works', NULL, NULL, NULL, '{\"x\":\"1069\",\"y\":\"3375\",\"floor\":\"1\",\"unit\":\"1A 26-27\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/bath & body works.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:14:02', NULL),
(5, '9fdc69e6-8d44-42a6-a17f-9f5868f84d33', 3, 'tenant', 'L\'occitane', NULL, NULL, NULL, '{\"x\":\"1064\",\"y\":\"3460\",\"floor\":\"1\",\"unit\":\"1A-28\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'tenant_images/sMLAstfcdoYz2GeNHbWUtsAifwb6ovSzoFOtOFwb.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 21:10:33', NULL),
(6, 'bf1dd86d-3595-4326-bec7-5f97e959c632', 3, 'tenant', 'Rotelli', NULL, NULL, NULL, '{\"x\":\"1064\",\"y\":\"3518\",\"floor\":\"1\",\"unit\":\"1A-29\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/rotelli.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:14:52', NULL),
(7, 'd6c31ea8-a5d3-4bca-893c-14c16a1b4ba2', 3, 'tenant', 'By Aura', NULL, NULL, NULL, '{\"x\":\"1068\",\"y\":\"3564\",\"floor\":\"1\",\"unit\":\"1A-30\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/by aura.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:15:07', NULL),
(8, '5d6275eb-9be4-491c-a6ef-02c26c8055ec', 3, 'tenant', 'Steve Madden', NULL, NULL, NULL, '{\"x\":\"1064\",\"y\":\"3615\",\"floor\":\"1\",\"unit\":\"1A-31\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/steve madden.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:15:23', NULL),
(9, 'f4a9ef7a-39a1-41d3-981f-b12672c78bf1', 8, 'tenant', 'Arena', NULL, NULL, NULL, '{\"x\":\"1079\",\"y\":\"3678\",\"floor\":\"1\",\"unit\":\"1A-32\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/arena.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:15:38', NULL),
(10, 'd1b0cddc-2770-4076-a852-b694a047f163', 3, 'tenant', 'Naughty', NULL, NULL, NULL, '{\"x\":\"1081\",\"y\":\"3725\",\"floor\":\"1\",\"unit\":\"1A-33\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/naughty.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:15:55', NULL),
(11, '328a7005-d548-4663-87ef-53151847f07e', 3, 'tenant', 'Hush Puppies', NULL, NULL, NULL, '{\"x\":\"1081\",\"y\":\"3781\",\"floor\":\"1\",\"unit\":\"1A-35\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/hush puppies.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:16:18', NULL),
(12, '0d757864-d82d-4e3c-90be-62059fca1da9', 3, 'tenant', 'Popits', NULL, NULL, NULL, '{\"x\":\"1056\",\"y\":\"3838\",\"floor\":\"1\",\"unit\":\"1A-36\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/popits.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:16:37', NULL),
(13, '8799858a-625d-4a3b-acfb-7ae8b6a69682', 3, 'tenant', 'American Tourister', NULL, NULL, NULL, '{\"x\":\"1062\",\"y\":\"3887\",\"floor\":\"1\",\"unit\":\"1A-37\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/american tourister.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:17:08', NULL),
(14, 'd30d8f78-0d25-49ab-96ef-aa81b7f01153', 3, 'tenant', 'Timberland', NULL, NULL, NULL, '{\"x\":\"1066\",\"y\":\"3942\",\"floor\":\"1\",\"unit\":\"1A-38\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/timberland.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:17:23', NULL),
(15, 'bdda8c53-3944-45d7-9504-5f9f002e8033', 8, 'tenant', 'Hoops', NULL, NULL, NULL, '{\"x\":\"1068\",\"y\":\"4049\",\"floor\":\"1\",\"unit\":\"1A 39-40\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/hoops.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:17:45', NULL),
(16, 'a24d13b9-fa1e-4b8f-92be-d5cc612ce41a', 3, 'tenant', 'Polo', NULL, NULL, NULL, '{\"x\":\"1071\",\"y\":\"4130\",\"floor\":\"1\",\"unit\":\"1A 41-42\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/polo.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:18:00', NULL),
(17, '2475f420-0b4c-418e-8e19-eef724ad89d4', 3, 'tenant', 'Camel Active', NULL, NULL, NULL, '{\"x\":\"1073\",\"y\":\"4213\",\"floor\":\"1\",\"unit\":\"1A-43\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/camel active.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:18:15', NULL),
(18, 'd56d86b0-e6ae-4db6-b7aa-088d71283fd4', 2, 'tenant', 'Matahari', NULL, NULL, NULL, '{\"x\":\"778\",\"y\":\"4542\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/matahari.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:19:19', NULL),
(19, 'df73c66e-271f-4390-8bbb-cc8d5cec9e31', 3, 'tenant', 'Intimo', NULL, NULL, NULL, '{\"x\":\"543\",\"y\":\"4267\",\"floor\":\"1\",\"unit\":\"1C-97\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/intimo.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:19:36', NULL),
(20, 'a7646dcb-74cc-450b-8525-83b448fee000', 3, 'tenant', 'Stroberi', NULL, NULL, NULL, '{\"x\":\"522\",\"y\":\"4213\",\"floor\":\"1\",\"unit\":\"1C-96\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/stroberi.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:19:54', NULL),
(21, '56be29f4-0da8-4fed-b310-d900f2fb88cf', 3, 'tenant', 'Watchout!', NULL, NULL, NULL, '{\"x\":\"522\",\"y\":\"4158\",\"floor\":\"1\",\"unit\":\"1C-95\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/watchout!.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:20:15', NULL),
(22, '4696720d-7cab-4080-835c-583a2cd2f246', 3, 'tenant', 'Gosh', NULL, NULL, NULL, '{\"x\":\"535\",\"y\":\"4106\",\"floor\":\"1\",\"unit\":\"1C-93\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/gosh.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:20:36', NULL),
(23, 'd5d14b77-f1fc-4637-a171-73e1ed6d2592', 3, 'tenant', 'Wacoal', NULL, NULL, NULL, '{\"x\":\"526\",\"y\":\"4053\",\"floor\":\"1\",\"unit\":\"1C-92\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/wacoal.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:21:00', NULL),
(24, '71b19a85-d051-4c52-843c-1f789a9683c1', 3, 'tenant', 'Everbest', NULL, NULL, NULL, '{\"x\":\"530\",\"y\":\"3998\",\"floor\":\"1\",\"unit\":\"1C-91\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/everbest.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:21:19', NULL),
(25, 'f96942a2-05b8-42e7-b14a-43c71291ab94', 3, 'tenant', 'Bata', NULL, NULL, NULL, '{\"x\":\"526\",\"y\":\"3925\",\"floor\":\"1\",\"unit\":\"1C 89-90\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/bata.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:21:34', NULL),
(26, '18c6977b-d487-44ee-8f55-7ea34b2b31b2', 3, 'tenant', 'The Perfume Shop', NULL, NULL, NULL, '{\"x\":\"537\",\"y\":\"3838\",\"floor\":\"1\",\"unit\":\"1C-88\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/the perfume shop.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:22:26', NULL),
(27, '7528c731-5221-4d4b-b9b4-68ea6462d2ba', 3, 'tenant', 'Minimal', NULL, NULL, NULL, '{\"x\":\"524\",\"y\":\"3780\",\"floor\":\"1\",\"unit\":\"1C-87\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/minimal.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:22:48', NULL),
(28, 'f1596f0d-2297-4df5-8c6e-34609b7dbb88', 3, 'tenant', 'Bellagio', NULL, NULL, NULL, '{\"x\":\"526\",\"y\":\"3729\",\"floor\":\"1\",\"unit\":\"1C-86\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/bellagio.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:23:06', NULL),
(29, 'a21cdd71-2113-414e-9584-c394a3399c2f', 3, 'tenant', 'Mississipi', NULL, NULL, NULL, '{\"x\":\"516\",\"y\":\"3675\",\"floor\":\"1\",\"unit\":\"1C-85\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/mississipi.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:23:25', NULL),
(30, '2d35f624-68f4-40d8-ae8e-e7f6fd25c9f6', 3, 'tenant', 'Levi\'s', NULL, NULL, NULL, '{\"x\":\"537\",\"y\":\"3586\",\"floor\":\"1\",\"unit\":\"1C 82-82\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/levi\'s.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:23:54', NULL),
(31, '8898589a-1454-4245-af1a-654704f5f437', 3, 'tenant', 'Giordano', NULL, NULL, NULL, '{\"x\":\"532\",\"y\":\"3484\",\"floor\":\"1\",\"unit\":\"1C 80-81\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/giordano.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:24:13', NULL),
(32, 'a8b68baf-eda1-4923-b3d4-17b7387ce837', 3, 'tenant', 'Havaianas', NULL, NULL, NULL, '{\"x\":\"535\",\"y\":\"3400\",\"floor\":\"1\",\"unit\":\"1C-79\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/havaianas.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:24:36', NULL),
(33, 'd9abf2f8-0aa8-4d13-b565-3c891b9959b0', 3, 'tenant', 'Keds', NULL, NULL, NULL, '{\"x\":\"533\",\"y\":\"3345\",\"floor\":\"1\",\"unit\":\"1C-78\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/keds.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:24:55', NULL),
(34, '6bb60087-c065-45b8-958b-344d89136f78', 3, 'tenant', 'Donini', NULL, NULL, NULL, '{\"x\":\"513\",\"y\":\"3291\",\"floor\":\"1\",\"unit\":\"1C-77\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/donini.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:25:12', NULL),
(35, 'e2b50cfc-280b-459c-8945-624878194a9d', 3, 'tenant', 'The Body Shop', NULL, NULL, NULL, '{\"x\":\"501\",\"y\":\"3231\",\"floor\":\"1\",\"unit\":\"1C-76\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/the body shop.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:25:32', NULL),
(36, '4a3dd27a-ddc2-481d-89e4-36255af3c5b9', 8, 'tenant', 'Puma', NULL, NULL, NULL, '{\"x\":\"505\",\"y\":\"3154\",\"floor\":\"1\",\"unit\":\"1C 73-75\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/puma.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:25:48', NULL),
(37, 'ef945dba-d746-4532-b04e-7a2a764b9b53', 3, 'tenant', 'Victoria\'s Secret', NULL, NULL, NULL, '{\"x\":\"541\",\"y\":\"3065\",\"floor\":\"1\",\"unit\":\"1C-72a\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/victoria\'s secret.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:26:04', NULL),
(38, '8f0c1876-d42d-48be-876b-9a3a9c8b57d4', 7, 'tenant', 'Whsmith', NULL, NULL, NULL, '{\"x\":\"449\",\"y\":\"3061\",\"floor\":\"1\",\"unit\":\"1C-72b\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/WHSmith.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:26:20', NULL),
(39, 'a5074cab-d3e4-41f2-9026-c9d71fb91c06', 3, 'tenant', 'This Is April', NULL, NULL, NULL, '{\"x\":\"680\",\"y\":\"4197\",\"floor\":\"1\",\"unit\":\"1B-51\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/this is april.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:26:41', NULL),
(40, 'fdb68eb8-a565-4c20-8db2-8cba63614252', 6, 'tenant', 'Vinoti Living', NULL, NULL, NULL, '{\"x\":\"793\",\"y\":\"4169\",\"floor\":\"1\",\"unit\":\"1B-52\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/vinoti living.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:26:59', NULL),
(41, '823ab10b-584a-48de-b630-8339191eeffc', 6, 'tenant', 'Miniso', NULL, NULL, NULL, '{\"x\":\"921\",\"y\":\"4181\",\"floor\":\"1\",\"unit\":\"1B-53\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/miniso.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:27:18', NULL),
(42, 'bf764b3b-f314-46f4-847a-300c010f8fab', 5, 'island', 'Hello The Healthy Brew', NULL, NULL, NULL, '{\"x\":\"661\",\"y\":\"4096\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/hello the healthy brew.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:28:03', NULL),
(43, 'f8f270e6-830e-4ace-8226-6f2ebca1ea4c', 5, 'island', 'Panlandwoo', NULL, NULL, NULL, '{\"x\":\"934\",\"y\":\"4095\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/panlandwoo.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:27:42', NULL),
(44, '692e0800-a44d-4435-8886-52ef053a9914', 5, 'island', 'Bananas', NULL, NULL, NULL, '{\"x\":\"729\",\"y\":\"4051\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/bananas.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:28:45', NULL),
(45, 'b3ba19b6-59d3-4bab-aca9-630f5f0c659c', 5, 'island', 'Balinata', NULL, NULL, NULL, '{\"x\":\"879\",\"y\":\"4051\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/balinata.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:28:25', NULL),
(46, '0870da51-de72-4293-b132-f295a7c34488', 5, 'island', 'Moncherie', NULL, NULL, NULL, '{\"x\":\"669\",\"y\":\"3990\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/moncherie.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:29:18', NULL),
(47, '698e1c72-e4c2-473f-bb26-d23d831037d1', 5, 'island', 'Shake Shake', NULL, NULL, NULL, '{\"x\":\"876\",\"y\":\"3967\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/shake shake.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:29:40', NULL),
(48, '70a627f7-2491-4f22-ad00-21489ec3520c', 5, 'island', 'Zuma', NULL, NULL, NULL, '{\"x\":\"936\",\"y\":\"3907\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/zuma.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:29:57', NULL),
(49, 'f452c387-dacd-4aa9-a0d7-250b0dddd147', 5, 'island', 'Captain Burger', NULL, NULL, NULL, '{\"x\":\"878\",\"y\":\"3873\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/captain burger.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:30:20', NULL),
(50, 'c205e42b-fe7c-40b1-8727-133a92fad373', 5, 'island', 'Kanini', NULL, NULL, NULL, '{\"floor\":\"1\",\"unit\":\"-\"}', NULL, 'assets/images/tenant_logo/kanini.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-01-29 20:15:36', NULL),
(51, '2392bbd6-7f6c-4109-908c-e32158433570', 5, 'island', 'Dear Butter', NULL, NULL, NULL, '{\"x\":\"891\",\"y\":\"3788\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/dear butter.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:30:39', NULL),
(52, '45924598-ca8a-49b4-bb66-dfb242f0ccb1', 5, 'island', 'Beard Papa\'s', NULL, NULL, NULL, '{\"x\":\"712\",\"y\":\"3784\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/beard papa\'s.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:31:35', NULL),
(53, '3151f486-090c-447e-ad71-9021d748a2c5', 5, 'island', 'Sour Sally', NULL, NULL, NULL, '{\"x\":\"673\",\"y\":\"3782\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/sour sally.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:31:52', NULL),
(54, '35af7c60-5c23-4a13-8d8d-8f9616a0cbe8', 5, 'island', 'Chatime', NULL, NULL, NULL, '{\"x\":\"802\",\"y\":\"3729\",\"floor\":\"1\",\"unit\":\"K2\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/chatime.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:31:16', NULL),
(55, '4d12ec17-26b3-4241-b7bf-7091039acd2a', 5, 'island', 'Full Hardy', NULL, NULL, NULL, '{\"x\":\"936\",\"y\":\"3782\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/full hardy.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:30:55', NULL),
(56, '6ee5db4f-099a-4532-bc2f-d7761a2e46cf', 5, 'island', 'Roti Boy', NULL, NULL, NULL, '{\"x\":\"710\",\"y\":\"3668\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/roti boy.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:24:23', NULL),
(57, '78f2984d-c983-42b9-b887-ea7eb438efda', 5, 'island', 'Chikuro', NULL, NULL, NULL, '{\"x\":\"673\",\"y\":\"3674\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/chikuro.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:24:00', NULL),
(58, 'dd3056a3-d2be-4ed4-8033-f2bc2abbf140', 5, 'island', 'Shihlin', NULL, NULL, NULL, '{\"x\":\"896\",\"y\":\"3673\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/shihlin.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:24:42', NULL),
(59, '1e2c1c38-c1d1-4af9-88c8-af1ef1cb5bfb', 5, 'island', 'Puyo', NULL, NULL, NULL, '{\"x\":\"932\",\"y\":\"3673\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/puyo.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:24:57', NULL),
(60, '351b3a1c-3e56-4dd1-a2e8-590cc5041b23', 5, 'island', 'Somay Little Menteng', NULL, NULL, NULL, '{\"x\":\"876\",\"y\":\"3609\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/somay little menteng.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:25:16', NULL),
(61, '19aeaa2f-b24b-47a7-b91b-19ea4bcd94cb', 5, 'island', 'Montato', NULL, NULL, NULL, '{\"x\":\"876\",\"y\":\"3544\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/montato.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:25:36', NULL),
(62, 'e4859e9a-f1c5-4183-ba28-1f50345ace2e', 5, 'island', 'Charlie\'s', NULL, NULL, NULL, '{\"x\":\"876\",\"y\":\"3477\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/charlie\'s.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:25:54', NULL),
(63, 'c0dfa28e-9914-46b3-bdf4-7af383b11453', 3, 'tenant', 'Yves Rocher', NULL, NULL, NULL, '{\"x\":\"928\",\"y\":\"3359\",\"floor\":\"1\",\"unit\":\"1B\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/yves rocher.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:26:10', NULL),
(64, '253ef495-1bf8-4920-9b06-63c3c22ffc3f', 3, 'tenant', 'C & F Perfumery', NULL, NULL, NULL, '{\"x\":\"678\",\"y\":\"3353\",\"floor\":\"1\",\"unit\":\"1B\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/c & f perfumery.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:28:19', NULL),
(65, 'abb78631-7703-483e-a5ff-4f0af67689d5', 3, 'tenant', 'Optik Seis', NULL, NULL, NULL, '{\"x\":\"701\",\"y\":\"3217\",\"floor\":\"1\",\"unit\":\"1B-49\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/optik seis.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:26:59', NULL),
(66, 'ebf29f45-abd7-4e23-ad1c-a5087c35b088', 4, 'tenant', 'Koi The', NULL, NULL, NULL, '{\"x\":\"802\",\"y\":\"3212\",\"floor\":\"1\",\"unit\":\"K1\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/koi the.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:26:40', NULL),
(67, 'd86d8df3-51b9-45e9-b728-0c5614292c89', 3, 'tenant', 'Parang Kencana', NULL, NULL, NULL, '{\"x\":\"896\",\"y\":\"3212\",\"floor\":\"1\",\"unit\":\"1B-47\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/parang kencana.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:26:26', NULL),
(68, 'c5fc6f7c-6cbc-4cb6-a4e2-93a9e7792b5f', 4, 'tenant', 'Solaria', NULL, NULL, NULL, '{\"x\":\"163\",\"y\":\"3064\",\"floor\":\"1\",\"unit\":\"V4 Galeria Resto\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/solaria.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:13:00', NULL),
(69, '50482cbf-d2a0-4dde-9d1a-a948693c44ab', 4, 'tenant', 'Excelso', NULL, NULL, NULL, '{\"x\":\"167\",\"y\":\"2964\",\"floor\":\"1\",\"unit\":\"V3 Galeria Resto\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/excelso.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:13:11', NULL),
(70, '3c8f7511-177a-4457-81f3-581ffbe3da83', 4, 'tenant', 'Javabica', NULL, NULL, NULL, '{\"x\":\"159\",\"y\":\"2862\",\"floor\":\"1\",\"unit\":\"V2 Galeria Resto\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/javabica.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:13:25', NULL),
(71, '59563e7b-5c16-4b7c-afa6-4033228698be', 4, 'tenant', 'Starbucks Coffee', NULL, NULL, NULL, '{\"x\":\"165\",\"y\":\"2769\",\"floor\":\"1\",\"unit\":\"V1 Galeria Resto\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/starbucks coffee.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:13:44', NULL),
(72, '4327edb0-c975-4652-8636-db82958b3fab', 4, 'tenant', 'Ramen Ya!', NULL, NULL, NULL, '{\"x\":\"165\",\"y\":\"2677\",\"floor\":\"1\",\"unit\":\"V1A Galeria Resto\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/Ramen Ya!.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:13:55', NULL),
(73, '1bacea80-076b-4846-ba8b-75833e59d956', 4, 'tenant', 'Tous Les Jours', NULL, NULL, NULL, '{\"x\":\"509\",\"y\":\"2861\",\"floor\":\"1\",\"unit\":\"1C 70-71\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/tous les jours.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:14:13', NULL),
(74, 'ff5b353c-6f45-450b-81aa-6d252bb3aecc', 4, 'tenant', 'J.co', NULL, NULL, NULL, '{\"x\":\"503\",\"y\":\"2736\",\"floor\":\"1\",\"unit\":\"1C 68-69\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/j.co.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:14:32', NULL),
(75, '36bfc363-dd32-4d0c-93b5-e4efd34dbc45', 4, 'tenant', 'Pizza Hut Ristorante', NULL, NULL, NULL, '{\"x\":\"507\",\"y\":\"2613\",\"floor\":\"1\",\"unit\":\"1C 66-67\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/pizza hut ristorante.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:14:48', NULL),
(76, '56190c36-2e55-43cd-9ebe-1d6a65790fb7', 4, 'tenant', 'Es Teller 77', NULL, NULL, NULL, '{\"x\":\"530\",\"y\":\"2528\",\"floor\":\"1\",\"unit\":\"1C-65\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/es teller 77.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:15:08', NULL),
(77, 'b84889a5-8785-45fa-a550-3947ef408a27', 4, 'tenant', 'Marugame Udon', NULL, NULL, NULL, '{\"x\":\"528\",\"y\":\"2449\",\"floor\":\"1\",\"unit\":\"1C 62-63\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/marugame udon.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:15:28', NULL),
(78, '5d52e617-2c30-48ae-baa1-85ebe94a7b87', 4, 'tenant', 'Raa Cha', NULL, NULL, NULL, '{\"x\":\"537\",\"y\":\"2348\",\"floor\":\"1\",\"unit\":\"1C 60-61\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/raa cha.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:15:55', NULL),
(79, 'bb420ce8-924e-46be-84e2-595075c50cc8', 4, 'tenant', 'Ichiban Sushi', NULL, NULL, NULL, '{\"x\":\"537\",\"y\":\"2234\",\"floor\":\"1\",\"unit\":\"1C 58-59\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/ichiban sushi.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:16:09', NULL),
(80, '2b141686-a249-41ca-8928-2e73dc8bbc62', 4, 'tenant', 'Ryoshi Japanese Restaurant', NULL, NULL, NULL, '{\"x\":\"590\",\"y\":\"2142\",\"floor\":\"1\",\"unit\":\"1C 55-57\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/ryoshi japanese restaurant.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:19:05', NULL),
(81, '55a36437-74d6-4efa-9035-75d3180bc597', 5, 'island', 'Dum Dum', NULL, NULL, NULL, '{\"x\":\"706\",\"y\":\"2128\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/dum dum.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:19:45', NULL),
(82, '0befe313-62f4-43ed-8f1a-858e3b3eeb5c', 5, 'island', 'Herborist', NULL, NULL, NULL, '{\"x\":\"703\",\"y\":\"2015\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/herborist.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:19:28', NULL),
(83, 'd1b63edf-0a93-4f1d-979b-2b8ab4e7a529', 4, 'tenant', 'Penyetan Cok', NULL, NULL, NULL, '{\"x\":\"1039\",\"y\":\"2045\",\"floor\":\"1\",\"unit\":\"1A 02a-02b\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/penyetan cok.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:20:05', NULL),
(84, '078c4770-6ab4-4a83-939f-2acfb1d06732', 4, 'tenant', '', NULL, NULL, NULL, '{\"floor\":\"1\",\"unit\":\"1A\"}', NULL, 'assets/images/tenant_logo/.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-01-29 20:15:36', NULL),
(85, 'fb6b8de6-645e-4a96-8f21-bf206e33db8a', 4, 'tenant', 'Ramen1', NULL, NULL, NULL, '{\"x\":\"1039\",\"y\":\"2118\",\"floor\":\"1\",\"unit\":\"1A 03-05\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/ramen1.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:20:23', NULL),
(86, 'd2806109-68a6-40d3-b41a-4ecef861aa66', 4, 'tenant', 'Ta Wan', NULL, NULL, NULL, '{\"x\":\"1073\",\"y\":\"2234\",\"floor\":\"1\",\"unit\":\"1A 06-07\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/ta wan.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:20:44', NULL),
(87, 'ca897bdc-033a-40a8-8c45-0f4a76bdc712', 4, 'tenant', 'Tik Tok', NULL, NULL, NULL, '{\"x\":\"1167\",\"y\":\"2084\",\"floor\":\"1\",\"unit\":\"1A #A\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/tik tok.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:40:08', NULL),
(88, '996cf22b-0428-42b2-87f8-3b2e46281fba', 4, 'tenant', 'Baso Afung', NULL, NULL, NULL, '{\"x\":\"1066\",\"y\":\"2319\",\"floor\":\"1\",\"unit\":\"1A-08\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/baso afung.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:21:08', NULL),
(89, 'c8d580b0-eae4-401e-a5e4-cdb9cce9bfc0', 4, 'tenant', 'MM Juice', NULL, NULL, NULL, '{\"x\":\"1058\",\"y\":\"2395\",\"floor\":\"1\",\"unit\":\"1A 09-10\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/MM juice.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:21:32', NULL),
(90, '2c259714-af8d-4e69-8653-0818e3fe0b0f', 4, 'tenant', 'Pandan Kuring', NULL, NULL, NULL, '{\"x\":\"1068\",\"y\":\"2496\",\"floor\":\"1\",\"unit\":\"1A 11-12\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/pandan kuring.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:21:50', NULL),
(91, 'b58f6bc6-04c5-480c-8d71-901bb1a1e443', 5, 'island', 'Dedari Kuliner', NULL, NULL, NULL, '{\"x\":\"1022\",\"y\":\"2571\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/dedari kuliner.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:22:11', NULL),
(92, '63944302-2530-4b29-9717-0fac075506c0', 5, 'island', 'Relx', NULL, NULL, NULL, '{\"x\":\"1019\",\"y\":\"2597\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/relx.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:22:24', NULL),
(93, 'c1f758d5-94d7-4076-916d-043a67eeee4a', 5, 'island', 'London Taxi Bike', NULL, NULL, NULL, '{\"x\":\"802\",\"y\":\"2710\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/london taxi bike.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:23:37', NULL),
(94, 'a7457e83-0382-4449-9c4c-920b78fa8862', 3, 'tenant', 'Wakai', NULL, NULL, NULL, '{\"x\":\"904\",\"y\":\"2715\",\"floor\":\"1\",\"unit\":\"1B-48\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/wakai.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:23:19', NULL),
(95, '7827b230-68dd-408d-9526-db6663404b16', 3, 'tenant', 'Fossil', NULL, NULL, NULL, '{\"x\":\"705\",\"y\":\"2730\",\"floor\":\"1\",\"unit\":\"1B-50\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/fossil.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:23:04', NULL),
(96, '500d359c-dd08-4030-8799-0502371f4605', 2, 'tenant', 'Nike', NULL, NULL, NULL, '{\"x\":\"1290\",\"y\":\"2695\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/nike.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:12:12', NULL),
(97, '94d4e9d8-e25a-42e4-a8bd-83e7a1177839', 2, 'tenant', 'H&M', NULL, NULL, NULL, '{\"x\":\"1306\",\"y\":\"2975\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/h&m.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 18:12:32', NULL),
(98, '7d85c142-588d-46bc-8073-f7c3355f6154', 2, 'tenant', 'Cinema XXI', NULL, NULL, NULL, '{\"x\":\"1455\",\"y\":\"1780\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/XXI.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:28:56', NULL),
(99, '86e80e9e-9d6e-4ad9-84d0-006d699f6e1a', 2, 'tenant', 'Azko', NULL, NULL, NULL, '{\"x\":\"906\",\"y\":\"1794\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/azko.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:29:09', NULL),
(100, 'ca6af525-4046-48b7-9847-655e43a6c6c2', 8, 'tenant', 'Asics', NULL, NULL, NULL, '{\"x\":\"558\",\"y\":\"1854\",\"floor\":\"1\",\"unit\":\"1E-08\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/asics.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:29:22', NULL),
(101, '774ed31c-7dd1-48ff-a684-5cae3f33e30a', 8, 'tenant', 'New Balance', NULL, NULL, NULL, '{\"x\":\"545\",\"y\":\"1745\",\"floor\":\"1\",\"unit\":\"1E-07\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/new balance.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:29:35', NULL),
(102, 'd29257b9-c3b6-4772-947f-8b9b79a77df4', 3, 'tenant', 'Flying Tiger', NULL, NULL, NULL, '{\"x\":\"556\",\"y\":\"1628\",\"floor\":\"1\",\"unit\":\"1E-06\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/flying tiger.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:29:48', NULL),
(103, '2ad56da0-28b5-45de-9c86-c938f60d7aa5', 1, 'tenant', 'Digimap', NULL, NULL, NULL, '{\"x\":\"556\",\"y\":\"1501\",\"floor\":\"1\",\"unit\":\"1E-05\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/digimap.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:30:02', NULL),
(104, '0413ee37-696a-4c8e-a040-d481c53ca77f', 3, 'tenant', 'Kipling', NULL, NULL, NULL, '{\"x\":\"680\",\"y\":\"1402\",\"floor\":\"1\",\"unit\":\"1E-03b\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/kipling.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:39:38', NULL),
(105, '8b876add-0653-4575-bc84-c380aca6fbc5', 3, 'tenant', 'Pandora', NULL, NULL, NULL, '{\"x\":\"691\",\"y\":\"1325\",\"floor\":\"1\",\"unit\":\"1E-03a\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/pandora.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:39:52', NULL),
(106, 'd56c7690-1c90-4302-83ab-4713be0ba1f0', 3, 'tenant', 'Saturdays', NULL, NULL, NULL, '{\"x\":\"738\",\"y\":\"1621\",\"floor\":\"1\",\"unit\":\"CL Ext. 01\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/saturdays.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:30:17', NULL),
(107, 'a2eb4fc7-6a08-494d-a9a9-a69133712c69', 3, 'tenant', 'Owndays', NULL, NULL, NULL, '{\"x\":\"851\",\"y\":\"1570\",\"floor\":\"1\",\"unit\":\"CL Ext. 01\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/owndays.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:30:29', NULL),
(108, 'dfe08ad2-1979-422c-9063-f212e57e90d0', 3, 'tenant', 'Sociolla', NULL, NULL, NULL, '{\"x\":\"1167\",\"y\":\"1279\",\"floor\":\"1\",\"unit\":\"1E-01a\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/sociolla.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:30:47', NULL),
(109, '8f02f92e-d5cf-418d-a676-07b2c6956b0a', 3, 'tenant', 'Amaris Parfume', NULL, NULL, NULL, '{\"x\":\"1273\",\"y\":\"1123\",\"floor\":\"1\",\"unit\":\"1F-15\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/amaris.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:31:12', NULL),
(110, '1e7470a1-5e4a-4a45-ade9-d6fbfe1501cf', 3, 'tenant', 'Charles & Keith', NULL, NULL, NULL, '{\"x\":\"1416\",\"y\":\"1017\",\"floor\":\"1\",\"unit\":\"1F-16\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/charles & keith.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:31:29', NULL),
(111, 'd8376486-8ce4-4e45-b43f-0c735563b8ab', 3, 'tenant', 'The Athlete\'s Foot', NULL, NULL, NULL, '{\"x\":\"1504\",\"y\":\"1104\",\"floor\":\"1\",\"unit\":\"1F-17\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/the athlete\'s foot.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:31:56', NULL),
(112, 'e9bd19f2-f2e5-4e93-8106-e4bc3d47b466', 2, 'tenant', 'Sports Direct', NULL, NULL, NULL, '{\"x\":\"1732\",\"y\":\"1143\",\"floor\":\"1\",\"unit\":\"-\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/sport direct.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:32:31', NULL),
(113, '4d37c981-ac2b-47aa-bcd2-c0389ba60c15', 8, 'tenant', 'Hoka', NULL, NULL, NULL, '{\"x\":\"1703\",\"y\":\"875\",\"floor\":\"1\",\"unit\":\"1F-02\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/hoka.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:32:44', NULL),
(114, 'fa97707c-6f6d-467c-be90-9081eb0fc71d', 3, 'tenant', 'Aldo', NULL, NULL, NULL, '{\"x\":\"1634\",\"y\":\"803\",\"floor\":\"1\",\"unit\":\"1F-03a\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/aldo.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:33:07', NULL),
(115, '3f374754-6b73-4b28-8ba7-bb451e6b2f42', 3, 'tenant', 'Tommy Hillfiger', NULL, NULL, NULL, '{\"x\":\"1500\",\"y\":\"615\",\"floor\":\"1\",\"unit\":\"1F-05b\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/tommy hillfiger.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:35:57', NULL),
(116, 'e3de3768-2812-496b-ad73-33dd510be0ad', 8, 'tenant', 'Adidas', NULL, NULL, NULL, '{\"x\":\"1397\",\"y\":\"532\",\"floor\":\"1\",\"unit\":\"1F-06\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/adidas.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:36:11', NULL),
(117, 'f569149c-7dfd-474f-824a-ddeebb41ec11', 3, 'tenant', 'Lacoste', NULL, NULL, NULL, '{\"x\":\"1293\",\"y\":\"432\",\"floor\":\"1\",\"unit\":\"1F-07a\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/lacoste.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:36:25', NULL),
(118, '5d88dbe6-c934-42e7-8393-b8f2bc76935e', 3, 'tenant', 'Calvin Klein', NULL, NULL, NULL, '{\"x\":\"1180\",\"y\":\"383\",\"floor\":\"1\",\"unit\":\"1F-07b\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/calvin klein.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:36:42', NULL),
(119, '5e7c3cd1-db33-439c-86c8-5c9eae4d81cf', 3, 'tenant', 'Marks & Spencer', NULL, NULL, NULL, '{\"x\":\"1058\",\"y\":\"201\",\"floor\":\"1\",\"unit\":\"1F 08-09\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/marks & spencer.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:36:57', NULL),
(120, '6e3f3f98-d112-457e-b080-734c5ff59152', 3, 'tenant', 'Cotton On', NULL, NULL, NULL, '{\"x\":\"808\",\"y\":\"481\",\"floor\":\"1\",\"unit\":\"1F-10\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/cotton on.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:37:10', NULL),
(121, 'd351c919-faf5-4e93-9b58-2f660e83be3c', 3, 'tenant', 'Project Soul', NULL, NULL, NULL, '{\"x\":\"958\",\"y\":\"573\",\"floor\":\"1\",\"unit\":\"1F-11\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/project soul.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:37:27', NULL),
(122, 'de96c157-2500-4ac9-86eb-0ffbdf6ddaf8', 3, 'tenant', 'Frank & Co', NULL, NULL, NULL, '{\"x\":\"1079\",\"y\":\"702\",\"floor\":\"1\",\"unit\":\"1F-12\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/frank & co.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:37:43', NULL),
(123, 'e8c9dd20-b28a-4798-b656-4bc770f2ad9e', 3, 'tenant', 'Sensatia', NULL, NULL, NULL, '{\"x\":\"964\",\"y\":\"913\",\"floor\":\"1\",\"unit\":\"1F-22\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/sensatia.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:38:01', NULL),
(124, 'da70cf30-fc85-4350-8471-b8e0247146de', 4, 'tenant', 'Sate Khas Senayan', NULL, NULL, NULL, '{\"x\":\"827\",\"y\":\"973\",\"floor\":\"1\",\"unit\":\"1E-02\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/sate khas senayan.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:38:13', NULL),
(125, '098b9541-de47-4c72-aed5-1dcabd897315', 5, 'island', 'Crusita', NULL, NULL, NULL, '{\"x\":\"1098\",\"y\":\"541\",\"floor\":\"1\",\"unit\":\"Cl Ext-01\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/crusita.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:38:29', NULL),
(126, 'd7548e36-88ef-4262-b5b1-48750f0f8a66', 5, 'island', 'Secret Garden', NULL, NULL, NULL, '{\"x\":\"1199\",\"y\":\"622\",\"floor\":\"1\",\"unit\":\"Cl Ext-02\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/secret garden.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:38:44', NULL),
(127, '3fad5336-15d4-4f70-9d75-7abeb0fe6580', 5, 'island', 'Nespresso', NULL, NULL, NULL, '{\"x\":\"1297\",\"y\":\"713\",\"floor\":\"1\",\"unit\":\"Cl Ext-03\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/nespresso.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:39:01', NULL),
(128, 'd1b42dc2-ce8b-4e15-9f9c-55aced90b730', 5, 'island', 'Shark Ninja', NULL, NULL, NULL, '{\"x\":\"1393\",\"y\":\"805\",\"floor\":\"1\",\"unit\":\"Cl Ext-01\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'assets/images/tenant_logo/shark ninja.png', NULL, 1, NULL, 0, '2026-01-29 20:15:36', '2026-02-01 19:39:18', NULL),
(129, '05449d63-7341-479f-994d-eec13a5db483', 8, 'tenant', 'Skechers', NULL, NULL, NULL, '{\"x\":\"1116\",\"y\":\"2581\",\"floor\":\"2\",\"unit\":\"2A 15-17b\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/skechers.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:56:15', NULL),
(130, '7e39baff-6b53-4c3b-ad33-331d0f8d169c', 3, 'tenant', 'Crocs', NULL, NULL, NULL, '{\"x\":\"1118\",\"y\":\"2682\",\"floor\":\"2\",\"unit\":\"2A 17a\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/crocs.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:55:57', NULL),
(131, 'd94759d2-2ee3-496b-a4b2-44e5c04d6f5d', 2, 'tenant', 'Uniqlo', NULL, NULL, NULL, '{\"x\":\"1410\",\"y\":\"2845\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/uniqlo.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:55:34', NULL),
(132, 'f5bad766-ba95-4ef7-a114-c77732fa110f', 3, 'tenant', 'Manzone', NULL, NULL, NULL, '{\"x\":\"1120\",\"y\":\"3263\",\"floor\":\"2\",\"unit\":\"2A-21\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/manzone.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:55:13', NULL),
(133, 'c9417a00-9abb-4157-8bb6-381b336bed17', 3, 'tenant', 'Fit Flop', NULL, NULL, NULL, '{\"x\":\"1141\",\"y\":\"3092\",\"floor\":\"2\",\"unit\":\"2A-22\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/fit flop.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:54:54', NULL),
(134, '54ed1006-283a-4fe3-a801-ed2ea215fbed', 3, 'tenant', 'Celcius', NULL, NULL, NULL, '{\"x\":\"1135\",\"y\":\"3151\",\"floor\":\"2\",\"unit\":\"2A-23\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/celcius.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:54:40', NULL),
(135, '5e040c31-7ce2-457e-aff7-15dbc16293ac', 3, 'tenant', 'Advance', NULL, NULL, NULL, '{\"x\":\"1128\",\"y\":\"3195\",\"floor\":\"2\",\"unit\":\"2A-25\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/advance.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:54:26', NULL),
(136, 'ae5c9c5c-bbb7-4c40-b798-2beb355420c5', 3, 'tenant', 'Dr. Specs', NULL, NULL, NULL, '{\"x\":\"1110\",\"y\":\"3254\",\"floor\":\"2\",\"unit\":\"2A-26\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/dr. specs.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:54:02', NULL),
(137, '7e86ff11-c83e-4ff3-b473-75eef7aa81aa', 3, 'tenant', 'Bag\'s City', NULL, NULL, NULL, '{\"x\":\"1126\",\"y\":\"3313\",\"floor\":\"2\",\"unit\":\"2A-27\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/bag\'s city.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:53:44', NULL),
(138, '4f9f5b33-4a5d-4196-9e3c-ed787f0d43db', 3, 'tenant', 'Color Box', NULL, NULL, NULL, '{\"x\":\"1099\",\"y\":\"3392\",\"floor\":\"2\",\"unit\":\"2A 28-29\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/color box.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:53:28', NULL),
(139, 'a5cf5232-3610-4c51-8346-d67283cd48e9', 3, 'tenant', 'Optik Tunggal', NULL, NULL, NULL, '{\"x\":\"1110\",\"y\":\"3484\",\"floor\":\"2\",\"unit\":\"2A-30\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/optik tunggal.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:53:07', NULL),
(140, '7222c297-8a1c-4605-a172-a25623985855', 3, 'tenant', 'Optik Melawai', NULL, NULL, NULL, '{\"x\":\"1122\",\"y\":\"3540\",\"floor\":\"2\",\"unit\":\"2A-31\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/optik melawai.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:52:48', NULL),
(141, '2a21a6e0-7c9a-4868-9a6c-273e9a474017', 2, 'tenant', 'Hypermart', NULL, NULL, NULL, '{\"x\":\"1495\",\"y\":\"3828\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/hypermart.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:41:09', NULL),
(142, 'ee319ef9-7498-4162-bf38-637b9e4a5bd2', 2, 'tenant', 'Matahari', NULL, NULL, NULL, '{\"x\":\"878\",\"y\":\"4283\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/matahari .png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:41:24', NULL),
(143, '9266f8dd-3f31-4395-9eab-35260a932c0c', 6, 'tenant', 'Simmons', NULL, NULL, NULL, '{\"x\":\"580\",\"y\":\"3945\",\"floor\":\"2\",\"unit\":\"2C-91\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/simmons.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:41:47', NULL),
(144, '787e9be8-1565-4e73-a504-2523ef3f0c0b', 6, 'tenant', 'Serta', NULL, NULL, NULL, '{\"x\":\"582\",\"y\":\"3801\",\"floor\":\"2\",\"unit\":\"2C 88-89\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/serta.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:42:05', NULL),
(145, '59a6127d-0300-446c-b3db-d2ddb2371e19', 6, 'tenant', 'Lady Americana', NULL, NULL, NULL, '{\"x\":\"576\",\"y\":\"3717\",\"floor\":\"2\",\"unit\":\"2C-87\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/lady americana.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:42:22', NULL),
(146, '87b5e012-4ca0-4a96-ab7a-1dcab72d4641', 12, 'tenant', 'Guardian Pharmacy', NULL, NULL, NULL, '{\"x\":\"576\",\"y\":\"3631\",\"floor\":\"2\",\"unit\":\"2C 85-86\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/guardian pharmacy.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:42:36', NULL),
(147, 'b5286a84-e420-4c31-b135-5d8c1bf5a69f', 1, 'tenant', 'Top Star Accessories', NULL, NULL, NULL, '{\"x\":\"582\",\"y\":\"3543\",\"floor\":\"2\",\"unit\":\"2C-83\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/top star accessories.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:42:58', NULL),
(148, '4b85cae7-3b7d-4e42-ba0f-08cfbe6d2780', 1, 'tenant', 'Bose', NULL, NULL, NULL, '{\"x\":\"570\",\"y\":\"3488\",\"floor\":\"2\",\"unit\":\"2C-82\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/bose.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:43:20', NULL),
(149, 'ab2bd14e-85ec-4b5f-b14c-2e5f03e77901', 1, 'tenant', 'Digiplus', NULL, NULL, NULL, '{\"x\":\"539\",\"y\":\"3394\",\"floor\":\"2\",\"unit\":\"2C 80-81b\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/digiplus.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:44:00', NULL),
(150, '6bd3f0cd-057e-4485-85e7-26e2932a7b08', 1, 'tenant', 'Game Sport', NULL, NULL, NULL, '{\"x\":\"624\",\"y\":\"3430\",\"floor\":\"2\",\"unit\":\"2C-81a\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/game sport.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:43:42', NULL),
(151, '063ebf26-6965-4e86-97a2-b044cc3cb2c4', 1, 'tenant', 'Xiaomi', NULL, NULL, NULL, '{\"x\":\"564\",\"y\":\"3313\",\"floor\":\"2\",\"unit\":\"2C-79\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/xiamoi.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:44:27', NULL),
(152, '0d746dc0-8908-4eb4-82c2-1dd168645700', 1, 'tenant', 'Samsung', NULL, NULL, NULL, '{\"x\":\"584\",\"y\":\"3259\",\"floor\":\"2\",\"unit\":\"2C-78\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/samsung.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:45:47', NULL),
(153, 'e710bab1-0a9b-4d74-a762-3e5e6c57ff6f', 6, 'tenant', 'King Koil', NULL, NULL, NULL, '{\"x\":\"547\",\"y\":\"3181\",\"floor\":\"2\",\"unit\":\"2C 76-77\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/king koil.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:45:30', NULL),
(154, '89ad38be-7128-4c08-8563-956445791c41', 3, 'tenant', 'Staccato', NULL, NULL, NULL, '{\"x\":\"772\",\"y\":\"3148\",\"floor\":\"2\",\"unit\":\"D2B\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/staccato.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:46:46', NULL),
(155, '2b479dcc-3eb1-4b86-95a7-38d83f4b905c', 3, 'tenant', 'Birkenstock', NULL, NULL, NULL, '{\"x\":\"924\",\"y\":\"3147\",\"floor\":\"2\",\"unit\":\"D2B\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/birkenstock.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:47:18', NULL),
(156, '5a90e21c-aa12-40e4-acc2-9e404b1735c3', 3, 'tenant', 'New Era', NULL, NULL, NULL, '{\"x\":\"841\",\"y\":\"3056\",\"floor\":\"2\",\"unit\":\"D3\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/new era.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:47:03', NULL),
(157, 'b7398c82-6bce-4249-9804-48d2f1d9d370', 3, 'tenant', 'Kcmtku', NULL, NULL, NULL, '{\"x\":\"966\",\"y\":\"3407\",\"floor\":\"2\",\"unit\":\"2A-T1\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/kcmtku.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:47:52', NULL),
(158, '51090f7a-0ea5-472c-9321-fc2db5a139c8', 3, 'tenant', 'Watch Studio', NULL, NULL, NULL, '{\"x\":\"968\",\"y\":\"3503\",\"floor\":\"2\",\"unit\":\"2A-T2\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/watch studio.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:48:10', NULL);
INSERT INTO `tenants` (`id`, `uuid`, `category_id`, `type`, `name`, `phone`, `email`, `website`, `map_coords`, `map_original_size`, `logo`, `description`, `is_active`, `launched_at`, `isNew`, `created_at`, `updated_at`, `deleted_at`) VALUES
(159, '652e8fb9-1bae-4b31-8194-cf608952d2b8', 3, 'tenant', 'Iqos', NULL, NULL, NULL, '{\"x\":\"972\",\"y\":\"3615\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/iqos.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:48:31', NULL),
(160, 'e4e436ba-0887-45bb-949f-fe813982b56c', 3, 'tenant', 'Miracle & Co', NULL, NULL, NULL, '{\"x\":\"849\",\"y\":\"3652\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/miracle & co.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:48:48', NULL),
(161, '3c7689c0-d6c1-45f9-a495-936c6fdef353', 1, 'tenant', 'Gino Mariani', NULL, NULL, NULL, '{\"x\":\"726\",\"y\":\"3599\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/gino mariani.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:49:08', NULL),
(162, 'e076966b-110f-4c39-993b-680762d09850', 12, 'tenant', 'Gnc', NULL, NULL, NULL, '{\"x\":\"724\",\"y\":\"3497\",\"floor\":\"2\",\"unit\":\"2C-T2\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/gnc.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:49:38', NULL),
(163, '066479e6-ff33-4607-840b-8df11864e4b5', 6, 'tenant', 'Tomomi', NULL, NULL, NULL, '{\"x\":\"728\",\"y\":\"3396\",\"floor\":\"2\",\"unit\":\"2C-T1\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/tomomi.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:50:01', NULL),
(164, '718fad59-de5a-464b-8ab5-25f7f8fb9e79', 5, 'island', 'Churros', NULL, NULL, NULL, '{\"x\":\"753\",\"y\":\"3943\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/churros.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:50:20', NULL),
(165, 'e59a6249-85c0-4836-8cc5-34671886500b', 5, 'island', 'Lucky Cheese', NULL, NULL, NULL, '{\"x\":\"905\",\"y\":\"3943\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/lucky cheese.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:50:37', NULL),
(166, 'a5d3ee04-1c34-4631-9549-8c42cd4775d2', 5, 'island', 'Thai Inc', NULL, NULL, NULL, '{\"x\":\"943\",\"y\":\"3940\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/thai inc.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:50:54', NULL),
(167, '699dddb0-61cc-4d2a-ad72-c4472227fd79', 5, 'island', 'Photoinc', NULL, NULL, NULL, '{\"x\":\"1110\",\"y\":\"3959\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/photoinc.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:51:15', NULL),
(168, 'dbc98319-0644-4ba5-9004-625b366617dd', 5, 'island', 'Perfect Relax', NULL, NULL, NULL, '{\"x\":\"1164\",\"y\":\"3961\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/perfect relax.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:51:35', NULL),
(169, '3306e560-1132-46f3-b781-131b13e8507b', 5, 'island', '24Bottles', NULL, NULL, NULL, '{\"x\":\"1010\",\"y\":\"3856\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/24Bottles.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:52:00', NULL),
(170, '734cb139-94f8-4755-b31b-303c5ad28fc0', 5, 'island', 'Doran Gadget', NULL, NULL, NULL, '{\"x\":\"1014\",\"y\":\"3763\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/doran gadget.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:52:24', NULL),
(171, 'f33c3624-0d5b-482c-a050-42c29df1f1f4', 2, 'tenant', 'Planet Sport Asia', NULL, NULL, NULL, '{\"floor\":\"2\",\"unit\":\"-\"}', NULL, 'assets/images/tenant_logo/Planet Sport Asia.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-01-29 23:01:18', NULL),
(172, '1b76c73e-b6df-4607-812c-d80bab6c3ecd', 2, 'tenant', 'Foot Locker', NULL, NULL, NULL, '{\"floor\":\"2\",\"unit\":\"-\"}', NULL, 'assets/images/tenant_logo/foot locker.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-01-29 23:01:18', NULL),
(173, 'ca349f7a-50d1-4485-9474-ef9f27d7fa0e', 9, 'tenant', 'Mothercare', NULL, NULL, NULL, '{\"x\":\"539\",\"y\":\"2629\",\"floor\":\"2\",\"unit\":\"2C-69\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/Mothercare.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:59:45', NULL),
(174, '6736d67a-2081-4d26-a400-59cc52b25da0', 1, 'tenant', 'Erafone', NULL, NULL, NULL, '{\"x\":\"595\",\"y\":\"2521\",\"floor\":\"2\",\"unit\":\"2C 66-67\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/erafone.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 20:00:12', NULL),
(175, 'da1dbbcb-6bd1-4551-a29e-7d795d2f4e44', 10, 'tenant', 'Hair Creator Nailpia', NULL, NULL, NULL, '{\"x\":\"564\",\"y\":\"2436\",\"floor\":\"2\",\"unit\":\"2C 66-67\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/hair creator nailpia.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 20:00:30', NULL),
(176, 'e32a9095-b314-4fc1-8893-1664ea3205aa', 1, 'tenant', 'Jbl Store', NULL, NULL, NULL, '{\"x\":\"580\",\"y\":\"2377\",\"floor\":\"2\",\"unit\":\"2C-63\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/jbl store.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 20:00:50', NULL),
(177, '631b1022-3520-46df-8794-204313236df9', 1, 'tenant', 'Huawei', NULL, NULL, NULL, '{\"x\":\"578\",\"y\":\"2325\",\"floor\":\"2\",\"unit\":\"2C-62\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/huawei.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 20:01:10', NULL),
(178, '56f1722b-5ce5-4ea6-87cc-41d02c72cd47', 1, 'tenant', 'Loly Poly', NULL, NULL, NULL, '{\"x\":\"572\",\"y\":\"2276\",\"floor\":\"2\",\"unit\":\"2C-61\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/loly poly.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 20:01:26', NULL),
(179, '8b9a1577-d1a0-475c-b804-c5aa1adf8405', 6, 'tenant', 'King Rabbit', NULL, NULL, NULL, '{\"x\":\"580\",\"y\":\"2209\",\"floor\":\"2\",\"unit\":\"2C-60\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/king rabbit.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 20:01:41', NULL),
(180, '4ab229ff-d796-434d-837c-2b83947b7004', 1, 'tenant', 'Ur Store', NULL, NULL, NULL, '{\"x\":\"570\",\"y\":\"2146\",\"floor\":\"2\",\"unit\":\"2C 58-59\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/ur store.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 20:02:03', NULL),
(181, '327e000c-0371-4705-ac7b-5c5acf26b475', 5, 'island', 'Clean And Care', NULL, NULL, NULL, '{\"x\":\"687\",\"y\":\"2031\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/clean and care.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 20:02:25', NULL),
(182, '79b9e7c7-ce8d-49a7-ae47-3e832bfabcc3', 5, 'island', 'Homcha', NULL, NULL, NULL, '{\"x\":\"693\",\"y\":\"1976\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/homcha.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 20:02:41', NULL),
(183, 'f51361c4-8609-4e56-a5c3-73b9686137c5', 5, 'island', 'Phoooto.id', NULL, NULL, NULL, '{\"x\":\"691\",\"y\":\"1928\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/phoooto.id.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:01:23', NULL),
(184, '8c9490cd-41c5-4a39-afb5-bc5514476d3a', 5, 'island', 'Gacha Corner', NULL, NULL, NULL, '{\"x\":\"637\",\"y\":\"1919\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/gacha corner.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:01:44', NULL),
(185, '3b794600-cbec-4248-a3c6-763e029557a9', 2, 'tenant', 'Toys Kingdom', NULL, NULL, NULL, '{\"x\":\"589\",\"y\":\"1681\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/toys kingdom.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:02:00', NULL),
(186, 'de73c204-4261-4404-b79c-013a205dfecc', 5, 'island', 'Oni Ola', NULL, NULL, NULL, '{\"x\":\"791\",\"y\":\"1489\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/oni ola.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:02:17', NULL),
(187, 'b4272ab0-2262-4128-aa7a-98d3e11e39c7', 5, 'island', 'Small Town', NULL, NULL, NULL, '{\"x\":\"876\",\"y\":\"1490\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/small town.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:02:34', NULL),
(188, 'd58e72f2-bc15-4a19-a618-0cb12584b101', 2, 'tenant', 'Gramedia', NULL, NULL, NULL, '{\"x\":\"1010\",\"y\":\"1788\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/gramedia.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:59:20', NULL),
(189, 'a962d663-5a08-4a06-a809-2f28c9fc7270', 2, 'tenant', 'Batik Keris', NULL, NULL, NULL, '{\"x\":\"1076\",\"y\":\"2001\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/batik keris.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:59:05', NULL),
(190, '25ea2013-0867-4437-9086-3fe7c53612e0', 10, 'tenant', 'Christopher Salon', NULL, NULL, NULL, '{\"x\":\"1124\",\"y\":\"2155\",\"floor\":\"2\",\"unit\":\"2A-07\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/christopher salon.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:58:00', NULL),
(191, '8f3b367c-1d22-4f31-a1f8-1908a4b15e08', 10, 'tenant', 'Cimb Niaga', NULL, NULL, NULL, '{\"x\":\"1118\",\"y\":\"2218\",\"floor\":\"2\",\"unit\":\"2A-08\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/cimb niaga.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:57:44', NULL),
(192, '31ed3a19-15f4-43bf-a9a3-341eeb26fb04', 10, 'tenant', 'Yopie Salon', NULL, NULL, NULL, '{\"x\":\"1116\",\"y\":\"2267\",\"floor\":\"2\",\"unit\":\"2A-09\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/yopie salon.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:57:24', NULL),
(193, '9ec61a79-de61-4c03-aa7b-b3c36928de9d', 10, 'tenant', 'Grapari Telkomsel', NULL, NULL, NULL, '{\"x\":\"1116\",\"y\":\"2353\",\"floor\":\"2\",\"unit\":\"2A 10-11\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/grapari telkomsel.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:57:06', NULL),
(194, 'e0c5ebbf-92f3-467d-91a4-cd86783badab', 10, 'tenant', 'Johnny Andrea', NULL, NULL, NULL, '{\"x\":\"1118\",\"y\":\"2428\",\"floor\":\"2\",\"unit\":\"2A-12\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/johnny andrea.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:56:47', NULL),
(195, '58bdb805-723b-4dec-812e-0debfd72a259', 3, 'tenant', 'Studio Tas', NULL, NULL, NULL, '{\"x\":\"1118\",\"y\":\"2482\",\"floor\":\"2\",\"unit\":\"2A-12a\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/studio tas.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 19:56:31', NULL),
(196, 'ebdeac54-24e4-4d8d-ae21-c502fd39ac0b', 4, 'tenant', 'Photoism', NULL, NULL, NULL, '{\"x\":\"1035\",\"y\":\"1590\",\"floor\":\"2\",\"unit\":\"2E-01c\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/photoism.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:03:44', NULL),
(197, 'bd40d2f3-3c55-4f99-8609-e366b9515670', 4, 'tenant', 'Zhengda', NULL, NULL, NULL, '{\"x\":\"1037\",\"y\":\"1526\",\"floor\":\"2\",\"unit\":\"2E-01a\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/zhengda.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:03:56', NULL),
(198, '4f52122c-a661-4a4e-8228-a6160bcfd8eb', 4, 'tenant', 'Mixue', NULL, NULL, NULL, '{\"x\":\"1047\",\"y\":\"1469\",\"floor\":\"2\",\"unit\":\"2E-01b\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/mixue.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:04:14', NULL),
(199, 'e1159ef7-624c-47fc-9676-116e018b3469', 4, 'tenant', 'Selfie Time', NULL, NULL, NULL, '{\"x\":\"1085\",\"y\":\"1407\",\"floor\":\"2\",\"unit\":\"2E-02a\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/selfie time.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:04:33', NULL),
(200, 'c0a4d890-8d4a-4b1b-a347-5bf31e9089c5', 4, 'tenant', 'Gong Cha', NULL, NULL, NULL, '{\"x\":\"1166\",\"y\":\"1375\",\"floor\":\"2\",\"unit\":\"2E-02b\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/gong cha.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:04:53', NULL),
(201, '7dad682d-98e3-4fe1-98e8-65f2b86e2a0d', 4, 'tenant', 'Tan-Panama Coffee', NULL, NULL, NULL, '{\"x\":\"1197\",\"y\":\"1321\",\"floor\":\"2\",\"unit\":\"2E-03a\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/Tan-Panama Coffee.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:05:14', NULL),
(202, '451c268a-1eb3-4c2a-b61f-46577ded7d73', 4, 'tenant', 'Tomoro Coffee', NULL, NULL, NULL, '{\"x\":\"1231\",\"y\":\"1277\",\"floor\":\"2\",\"unit\":\"2E-03b\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/tomoro coffee.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:05:32', NULL),
(203, 'c2e1052d-7da1-4442-b699-be392df20932', 4, 'tenant', 'Hyang Togol', NULL, NULL, NULL, '{\"x\":\"1331\",\"y\":\"1171\",\"floor\":\"2\",\"unit\":\"2E 05-07\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/gong cha.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:06:24', NULL),
(204, '685da25c-3f5b-4156-8662-2288ae18df02', 9, 'tenant', 'Bali Ice Skating', NULL, NULL, NULL, '{\"x\":\"1574\",\"y\":\"1558\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/bali ice skating.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:07:53', NULL),
(205, '224f3f09-f200-47f7-a82e-41da75b16dcd', 9, 'tenant', 'Mindchamps', NULL, NULL, NULL, '{\"x\":\"776\",\"y\":\"1122\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/mindchamps.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:03:25', NULL),
(206, '1af24d62-544f-4410-b4d4-2cc862b5a90f', 5, 'island', 'Wangsa Gelato', NULL, NULL, NULL, '{\"x\":\"857\",\"y\":\"1344\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/wangsa gelato.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:03:08', NULL),
(207, 'cfba8a4f-0779-4765-bcde-63704c5ec3c9', 5, 'island', 'Orlenalycious', NULL, NULL, NULL, '{\"x\":\"816\",\"y\":\"1305\",\"floor\":\"2\",\"unit\":\"-\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/orlenalycious.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:02:53', NULL),
(208, 'edc70250-ebc4-4348-9b9b-fc9a6544ea3e', 9, 'tenant', 'Kidz Station', NULL, NULL, NULL, '{\"x\":\"1289\",\"y\":\"895\",\"floor\":\"2\",\"unit\":\"2E-17\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/kidz station.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:08:35', NULL),
(209, '0d7f9f42-b3af-45e8-9c3d-15d5ee4f0bca', 9, 'tenant', 'Smiggle', NULL, NULL, NULL, '{\"x\":\"1091\",\"y\":\"1092\",\"floor\":\"2\",\"unit\":\"2E-18\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/smiggle.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:08:09', NULL),
(210, '6bc40f3c-d6dd-4520-b9df-f2ad618d27bd', 9, 'tenant', 'Funifun!', NULL, NULL, NULL, '{\"x\":\"1491\",\"y\":\"684\",\"floor\":\"2\",\"unit\":\"2E-19\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/FuniFun!.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:08:56', NULL),
(211, '5cdc540a-043a-40b6-96f6-b08209955878', 9, 'tenant', 'Timezone', NULL, NULL, NULL, '{\"x\":\"1305\",\"y\":\"411\",\"floor\":\"2\",\"unit\":\"2E-11\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/timezone.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:09:09', NULL),
(212, '560e85c6-0f45-47aa-bb6f-957477158060', 9, 'tenant', 'Oh Some!', NULL, NULL, NULL, '{\"x\":\"910\",\"y\":\"536\",\"floor\":\"2\",\"unit\":\"2E-12\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/OH SOME!.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:09:26', NULL),
(213, '71ee3106-40d7-47ac-8a39-342594f5b0e9', 3, 'tenant', 'Mon Cherie', NULL, NULL, NULL, '{\"x\":\"1030\",\"y\":\"871\",\"floor\":\"2\",\"unit\":\"2E-15\"}', '{\"width\":\"2130\",\"height\":\"4728\"}', 'assets/images/tenant_logo/Mon Cherie.png', NULL, 1, NULL, 0, '2026-01-29 23:01:18', '2026-02-01 21:09:46', NULL),
(214, '980deb95-5a3b-4314-8a47-15013e205e7d', 8, 'tenant', 'Salomon', NULL, NULL, NULL, '{\"x\":\"1598\",\"y\":\"743\",\"floor\":\"1\",\"unit\":\"1F-03b\"}', '{\"width\":\"2084\",\"height\":\"4788\"}', 'tenant_images/EoW5gIlub0ITyhbMtfZKlZAWHY3orafXU9afQYHs.png', NULL, 1, NULL, NULL, '2026-02-01 19:35:38', '2026-02-01 19:35:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tenant_photos`
--

CREATE TABLE `tenant_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` char(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `tenant_id`, `name`, `email`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `google_id`, `phone`, `avatar`, `status`, `status_note`, `is_active`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Yogi Prayoga', 'yogi@malbaligaleria.com', '$2y$12$LJjRRCJBsJukWdrfwYssCOZhWeisBK5G6sFcQQbwsVX8F94iV4frq', NULL, NULL, NULL, NULL, '082237188923', NULL, 'approved', NULL, 1, '2025-11-27 18:48:51', NULL, '2026-01-20 22:37:44', '2026-01-20 22:37:44', NULL),
(2, NULL, 'Wahyu', 'wahyu@malbaligaleria.com', '$2y$12$T1aQkGqFHb1DD23yjXSgq.yhhS56LisKLxJRNAebISk.hGDvRgGgO', NULL, NULL, NULL, NULL, '082237188923', NULL, 'approved', NULL, 1, '2025-11-27 18:48:51', NULL, '2026-01-20 22:37:44', '2026-01-20 22:37:44', NULL),
(3, NULL, 'Riri', 'riri@malbaligaleria.com', '$2y$12$YJwFYbjsB9UozksW09m.aOREW1RGEv9BvDjZa6fR2Vta.XBs3idWe', NULL, NULL, NULL, NULL, '082237188923', NULL, 'approved', NULL, 1, '2025-11-27 18:48:51', NULL, '2026-01-20 22:37:45', '2026-01-20 22:37:45', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_uuid_unique` (`uuid`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `events_uuid_unique` (`uuid`),
  ADD KEY `events_start_date_end_date_index` (`start_date`,`end_date`);

--
-- Indexes for table `event_photos`
--
ALTER TABLE `event_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_photos_event_id_foreign` (`event_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_index` (`user_id`),
  ADD KEY `notifications_type_index` (`type`),
  ADD KEY `notifications_read_at_index` (`read_at`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promos_uuid_unique` (`uuid`),
  ADD KEY `promos_tenant_id_foreign` (`tenant_id`),
  ADD KEY `promos_start_date_end_date_index` (`start_date`,`end_date`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tenants_uuid_unique` (`uuid`),
  ADD KEY `tenants_category_id_foreign` (`category_id`);

--
-- Indexes for table `tenant_photos`
--
ALTER TABLE `tenant_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tenant_photos_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_google_id_unique` (`google_id`),
  ADD KEY `users_tenant_id_foreign` (`tenant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `event_photos`
--
ALTER TABLE `event_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `tenant_photos`
--
ALTER TABLE `tenant_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_photos`
--
ALTER TABLE `event_photos`
  ADD CONSTRAINT `event_photos_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promos`
--
ALTER TABLE `promos`
  ADD CONSTRAINT `promos_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tenants`
--
ALTER TABLE `tenants`
  ADD CONSTRAINT `tenants_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tenant_photos`
--
ALTER TABLE `tenant_photos`
  ADD CONSTRAINT `tenant_photos_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
