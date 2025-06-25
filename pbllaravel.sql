-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2025 at 05:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pbllaravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `nama_barang`, `stok`, `created_at`, `updated_at`) VALUES
(3, 'Motor Servo', 951, '2025-05-04 05:51:57', '2025-06-22 08:48:30'),
(10, 'buzzer', 932, '2025-06-20 01:52:37', '2025-06-22 07:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
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
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
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
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_04_010108_create_barangs_table', 2),
(5, '2025_05_04_012222_add_role_to_users_table', 3),
(6, '2025_05_04_014256_create_peminjamen_table', 4),
(7, '2025_05_04_125004_add_timestamps_to_barangs_table', 5),
(8, '2025_05_04_141735_add_user_id_to_peminjamans_table', 6),
(9, '2025_05_05_013244_create_peminjaman_table', 7),
(10, '2025_05_05_131232_add_jumlah_to_peminjaman_table', 8),
(11, '2025_05_05_132743_add_tgl_pengembalian_to_peminjaman_table', 9),
(12, '2025_05_21_042736_add_timestamps_to_peminjaman_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tgl_peminjaman` datetime NOT NULL,
  `tgl_pengembalian` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `user_id`, `barang_id`, `jumlah`, `status`, `tgl_peminjaman`, `tgl_pengembalian`, `created_at`, `updated_at`) VALUES
(10, 5, 3, 4, 'Dikembalikan', '2025-05-05 13:22:39', NULL, NULL, NULL),
(35, 18, 3, 2, 'Dipinjam', '2025-06-17 04:46:35', NULL, '2025-06-16 21:46:35', '2025-06-16 21:46:35'),
(36, 18, 3, 1, 'Dipinjam', '2025-06-17 04:53:39', NULL, '2025-06-16 21:53:39', '2025-06-16 21:53:39'),
(37, 18, 3, 1, 'Dipinjam', '2025-06-17 09:47:36', NULL, '2025-06-17 02:47:36', '2025-06-17 02:47:36'),
(53, 18, 3, 1, 'Dipinjam', '2025-06-19 07:58:03', NULL, '2025-06-19 00:58:03', '2025-06-19 00:58:03'),
(58, 18, 3, 2, 'Dipinjam', '2025-06-20 05:31:55', NULL, '2025-06-19 22:31:55', '2025-06-19 22:31:55'),
(59, 18, 3, 1, 'Dipinjam', '2025-06-20 05:33:37', NULL, '2025-06-19 22:33:37', '2025-06-19 22:33:37'),
(65, 18, 3, 1, 'Dipinjam', '2025-06-20 08:39:32', NULL, '2025-06-20 01:39:32', '2025-06-20 01:39:32'),
(66, 18, 3, 1, 'Dipinjam', '2025-06-20 08:39:46', NULL, '2025-06-20 01:39:46', '2025-06-20 01:39:46'),
(69, 18, 3, 2, 'Dipinjam', '2025-06-20 08:41:36', NULL, '2025-06-20 01:41:36', '2025-06-20 01:41:36'),
(72, 18, 3, 1, 'Dipinjam', '2025-06-20 09:28:14', NULL, '2025-06-20 02:28:14', '2025-06-20 02:28:14'),
(73, 18, 10, 1, 'Dipinjam', '2025-06-20 09:29:52', NULL, '2025-06-20 02:29:52', '2025-06-20 02:29:52'),
(74, 18, 3, 1, 'Dipinjam', '2025-06-20 09:57:03', NULL, '2025-06-20 02:57:03', '2025-06-20 02:57:03'),
(75, 18, 10, 1, 'Dipinjam', '2025-06-20 10:00:00', NULL, '2025-06-20 03:00:00', '2025-06-20 03:00:00'),
(76, 18, 3, 1, 'Dipinjam', '2025-06-20 18:19:18', NULL, '2025-06-20 11:19:18', '2025-06-20 11:19:18'),
(77, 18, 10, 1, 'Dipinjam', '2025-06-20 18:20:22', NULL, '2025-06-20 11:20:22', '2025-06-20 11:20:22'),
(78, 18, 10, 1, 'Dipinjam', '2025-06-20 18:23:53', NULL, '2025-06-20 11:23:53', '2025-06-20 11:23:53'),
(79, 18, 3, 2, 'Dipinjam', '2025-06-20 18:24:46', NULL, '2025-06-20 11:24:46', '2025-06-20 11:24:46'),
(80, 18, 10, 1, 'Dipinjam', '2025-06-20 18:33:14', NULL, '2025-06-20 11:33:14', '2025-06-20 11:33:14'),
(81, 18, 10, 2, 'Dipinjam', '2025-06-20 18:34:33', NULL, '2025-06-20 11:34:33', '2025-06-20 11:34:33'),
(82, 18, 3, 1, 'Dipinjam', '2025-06-20 18:45:17', NULL, '2025-06-20 11:45:17', '2025-06-20 11:45:17'),
(83, 18, 3, 1, 'Dipinjam', '2025-06-20 19:03:47', NULL, '2025-06-20 12:03:47', '2025-06-20 12:03:47'),
(84, 18, 10, 1, 'Dipinjam', '2025-06-20 19:04:49', NULL, '2025-06-20 12:04:49', '2025-06-20 12:04:49'),
(85, 18, 10, 2, 'Dipinjam', '2025-06-20 19:05:43', NULL, '2025-06-20 12:05:43', '2025-06-20 12:05:43'),
(86, 18, 3, 1, 'Dipinjam', '2025-06-20 19:06:45', NULL, '2025-06-20 12:06:45', '2025-06-20 12:06:45'),
(87, 18, 3, 1, 'Dipinjam', '2025-06-20 19:07:36', NULL, '2025-06-20 12:07:36', '2025-06-20 12:07:36'),
(88, 18, 10, 1, 'Dipinjam', '2025-06-20 19:12:30', NULL, '2025-06-20 12:12:30', '2025-06-20 12:12:30'),
(89, 18, 3, 1, 'Dipinjam', '2025-06-20 19:13:58', NULL, '2025-06-20 12:13:58', '2025-06-20 12:13:58'),
(90, 18, 3, 2, 'Dipinjam', '2025-06-20 19:19:46', NULL, '2025-06-20 12:19:46', '2025-06-20 12:19:46'),
(91, 18, 10, 1, 'Dipinjam', '2025-06-21 07:49:00', NULL, '2025-06-21 00:49:00', '2025-06-21 00:49:00'),
(92, 18, 10, 1, 'Dipinjam', '2025-06-21 07:49:46', NULL, '2025-06-21 00:49:46', '2025-06-21 00:49:46'),
(93, 18, 3, 1, 'Dipinjam', '2025-06-21 07:50:29', NULL, '2025-06-21 00:50:29', '2025-06-21 00:50:29'),
(94, 18, 10, 1, 'Dipinjam', '2025-06-21 07:51:11', NULL, '2025-06-21 00:51:11', '2025-06-21 00:51:11'),
(95, 18, 3, 1, 'Dipinjam', '2025-06-21 07:55:59', NULL, '2025-06-21 00:55:59', '2025-06-21 00:55:59'),
(96, 18, 10, 2, 'Dipinjam', '2025-06-21 07:56:19', NULL, '2025-06-21 00:56:19', '2025-06-21 00:56:19'),
(97, 18, 10, 1, 'Dipinjam', '2025-06-21 07:56:43', NULL, '2025-06-21 00:56:43', '2025-06-21 00:56:43'),
(98, 18, 3, 2, 'Dipinjam', '2025-06-21 07:57:10', NULL, '2025-06-21 00:57:10', '2025-06-21 00:57:10'),
(99, 18, 3, 1, 'Dipinjam', '2025-06-21 07:57:58', NULL, '2025-06-21 00:57:58', '2025-06-21 00:57:58'),
(100, 18, 3, 1, 'Dipinjam', '2025-06-21 07:59:01', NULL, '2025-06-21 00:59:01', '2025-06-21 00:59:01'),
(101, 18, 10, 2, 'Dipinjam', '2025-06-21 07:59:27', NULL, '2025-06-21 00:59:27', '2025-06-21 00:59:27'),
(102, 18, 10, 1, 'Dipinjam', '2025-06-21 07:59:58', NULL, '2025-06-21 00:59:58', '2025-06-21 00:59:58'),
(103, 18, 10, 1, 'Dipinjam', '2025-06-21 08:00:15', NULL, '2025-06-21 01:00:15', '2025-06-21 01:00:15'),
(104, 18, 10, 1, 'Dipinjam', '2025-06-21 08:00:44', NULL, '2025-06-21 01:00:44', '2025-06-21 01:00:44'),
(105, 18, 10, 1, 'Dipinjam', '2025-06-21 08:01:36', NULL, '2025-06-21 01:01:36', '2025-06-21 01:01:36'),
(106, 18, 10, 1, 'Dipinjam', '2025-06-21 08:06:00', NULL, '2025-06-21 01:06:00', '2025-06-21 01:06:00'),
(107, 18, 3, 1, 'Dipinjam', '2025-06-21 08:06:17', NULL, '2025-06-21 01:06:17', '2025-06-21 01:06:17'),
(108, 18, 3, 2, 'Dipinjam', '2025-06-21 08:06:38', NULL, '2025-06-21 01:06:38', '2025-06-21 01:06:38'),
(109, 18, 10, 1, 'Dipinjam', '2025-06-21 08:07:05', NULL, '2025-06-21 01:07:05', '2025-06-21 01:07:05'),
(110, 18, 3, 1, 'Dipinjam', '2025-06-21 08:17:26', NULL, '2025-06-21 01:17:26', '2025-06-21 01:17:26'),
(111, 18, 10, 1, 'Dipinjam', '2025-06-21 08:17:47', NULL, '2025-06-21 01:17:47', '2025-06-21 01:17:47'),
(112, 18, 10, 2, 'Dipinjam', '2025-06-21 08:18:24', NULL, '2025-06-21 01:18:24', '2025-06-21 01:18:24'),
(113, 18, 10, 1, 'Dipinjam', '2025-06-21 08:18:48', NULL, '2025-06-21 01:18:48', '2025-06-21 01:18:48'),
(114, 18, 3, 2, 'Dipinjam', '2025-06-21 08:20:42', NULL, '2025-06-21 01:20:42', '2025-06-21 01:20:42'),
(115, 18, 10, 1, 'Dipinjam', '2025-06-21 08:21:05', NULL, '2025-06-21 01:21:05', '2025-06-21 01:21:05'),
(116, 18, 10, 1, 'Dipinjam', '2025-06-21 08:35:08', NULL, '2025-06-21 01:35:08', '2025-06-21 01:35:08'),
(117, 18, 3, 2, 'Dipinjam', '2025-06-21 08:35:35', NULL, '2025-06-21 01:35:35', '2025-06-21 01:35:35'),
(118, 18, 3, 2, 'Dipinjam', '2025-06-21 08:35:54', NULL, '2025-06-21 01:35:54', '2025-06-21 01:35:54'),
(119, 18, 3, 2, 'Dipinjam', '2025-06-21 08:36:30', NULL, '2025-06-21 01:36:30', '2025-06-21 01:36:30'),
(120, 18, 10, 2, 'Dipinjam', '2025-06-21 08:37:05', NULL, '2025-06-21 01:37:05', '2025-06-21 01:37:05'),
(121, 18, 10, 2, 'Dipinjam', '2025-06-21 08:37:26', NULL, '2025-06-21 01:37:26', '2025-06-21 01:37:26'),
(122, 18, 10, 2, 'Dipinjam', '2025-06-21 08:37:57', NULL, '2025-06-21 01:37:57', '2025-06-21 01:37:57'),
(123, 18, 3, 2, 'Dipinjam', '2025-06-21 08:38:20', NULL, '2025-06-21 01:38:20', '2025-06-21 01:38:20'),
(124, 18, 3, 2, 'Dipinjam', '2025-06-21 08:38:39', NULL, '2025-06-21 01:38:39', '2025-06-21 01:38:39'),
(125, 18, 3, 1, 'Dipinjam', '2025-06-21 08:38:56', NULL, '2025-06-21 01:38:56', '2025-06-21 01:38:56'),
(126, 18, 10, 2, 'Dipinjam', '2025-06-21 08:39:11', NULL, '2025-06-21 01:39:11', '2025-06-21 01:39:11'),
(127, 18, 10, 2, 'Dipinjam', '2025-06-21 08:39:45', NULL, '2025-06-21 01:39:45', '2025-06-21 01:39:45'),
(128, 18, 10, 2, 'Dipinjam', '2025-06-21 08:40:10', NULL, '2025-06-21 01:40:10', '2025-06-21 01:40:10'),
(129, 18, 10, 1, 'Dipinjam', '2025-06-21 08:41:17', NULL, '2025-06-21 01:41:17', '2025-06-21 01:41:17'),
(130, 18, 10, 2, 'Dipinjam', '2025-06-21 08:41:32', NULL, '2025-06-21 01:41:32', '2025-06-21 01:41:32'),
(131, 18, 10, 2, 'Dipinjam', '2025-06-21 08:43:27', NULL, '2025-06-21 01:43:27', '2025-06-21 01:43:27'),
(132, 18, 3, 2, 'Dipinjam', '2025-06-21 08:43:48', NULL, '2025-06-21 01:43:48', '2025-06-21 01:43:48'),
(133, 18, 3, 2, 'Dipinjam', '2025-06-21 08:44:07', NULL, '2025-06-21 01:44:07', '2025-06-21 01:44:07'),
(134, 18, 3, 1, 'Dipinjam', '2025-06-21 09:16:57', NULL, '2025-06-21 02:16:57', '2025-06-21 02:16:57'),
(135, 18, 10, 2, 'Dipinjam', '2025-06-21 09:17:12', NULL, '2025-06-21 02:17:12', '2025-06-21 02:17:12'),
(136, 18, 3, 1, 'Dipinjam', '2025-06-21 11:12:13', NULL, '2025-06-21 04:12:13', '2025-06-21 04:12:13'),
(137, 18, 3, 2, 'Dipinjam', '2025-06-21 11:12:26', NULL, '2025-06-21 04:12:26', '2025-06-21 04:12:26'),
(138, 18, 10, 2, 'Dipinjam', '2025-06-21 11:12:38', NULL, '2025-06-21 04:12:38', '2025-06-21 04:12:38'),
(139, 18, 10, 1, 'Dipinjam', '2025-06-21 11:13:00', NULL, '2025-06-21 04:13:00', '2025-06-21 04:13:00'),
(140, 18, 10, 2, 'Dipinjam', '2025-06-21 11:13:15', NULL, '2025-06-21 04:13:15', '2025-06-21 04:13:15'),
(141, 18, 10, 2, 'Dipinjam', '2025-06-21 11:13:35', NULL, '2025-06-21 04:13:35', '2025-06-21 04:13:35'),
(142, 18, 10, 2, 'Dipinjam', '2025-06-21 11:13:58', NULL, '2025-06-21 04:13:58', '2025-06-21 04:13:58'),
(143, 18, 10, 2, 'Dipinjam', '2025-06-21 11:14:12', NULL, '2025-06-21 04:14:12', '2025-06-21 04:14:12'),
(144, 18, 10, 2, 'Dipinjam', '2025-06-21 11:14:29', NULL, '2025-06-21 04:14:29', '2025-06-21 04:14:29'),
(145, 18, 3, 2, 'Dipinjam', '2025-06-21 11:14:41', NULL, '2025-06-21 04:14:41', '2025-06-21 04:14:41'),
(146, 18, 3, 1, 'Dipinjam', '2025-06-21 11:15:12', NULL, '2025-06-21 04:15:12', '2025-06-21 04:15:12'),
(147, 18, 3, 1, 'Dipinjam', '2025-06-21 11:16:06', NULL, '2025-06-21 04:16:06', '2025-06-21 04:16:06'),
(148, 18, 10, 2, 'Dipinjam', '2025-06-21 11:16:16', NULL, '2025-06-21 04:16:16', '2025-06-21 04:16:16'),
(149, 18, 10, 1, 'Dipinjam', '2025-06-21 11:16:33', NULL, '2025-06-21 04:16:33', '2025-06-21 04:16:33'),
(150, 18, 10, 2, 'Dipinjam', '2025-06-21 11:16:55', NULL, '2025-06-21 04:16:55', '2025-06-21 04:16:55'),
(151, 18, 10, 2, 'Dikembalikan', '2025-06-21 11:17:54', '2025-06-22 07:36:24', '2025-06-21 04:17:54', '2025-06-22 07:36:24'),
(152, 18, 10, 2, 'Dikembalikan', '2025-06-21 11:18:09', '2025-06-22 07:36:11', '2025-06-21 04:18:09', '2025-06-22 07:36:11'),
(153, 18, 3, 2, 'Dipinjam', '2025-06-22 15:48:15', NULL, '2025-06-22 08:48:15', '2025-06-22 08:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('enD2COMlBqFGYPObRWZapOofq8l5TWDqMzbn2Ui3', 18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ0VlSjN5RlB3M1hZQjl2Qm4zZU0xWDZFdTdpSk45cHNXYzJrUXhDQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9iYXJhbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxODt9', 1750607316);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `face_image` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nim`, `password`, `face_image`, `jenis_kelamin`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Esi Putriani', '2301081005', '$2y$12$kFBjU1iToiR9B7DTBpw5q.xz67fU5QpiDVLAw52UkzM4WyCkQF43y', '1746319301.png', 'Perempuan', '2025-05-03 17:41:41', '2025-05-03 17:41:41', 'user'),
(5, 'Smartlend', '230108', '$2y$12$Lxdf5XQJWNgNKb4EnKpeIeknEtyMNtB5s8f.aGLosPau9C7AlgnHS', NULL, 'Laki-laki', '2025-05-03 18:28:44', '2025-05-03 18:28:44', 'admin'),
(6, 'Chou', '2301081000', '$2y$12$sJ2O.ufFfEQ996NR9Kv0yekRnh2XwCaFS8mv0e5bbslfJSiVcR2ki', '1746618924.jpg', 'Laki-laki', '2025-05-07 04:55:25', '2025-05-07 04:55:25', 'user'),
(7, 'jaki', '2301081009', '$2y$12$2XhGSd59lw8ta9NX3t0nAOh33cFqyXdZqoeloVgsjnv1C7sHanDFC', NULL, 'Laki-laki', '2025-05-21 01:17:24', '2025-05-21 01:17:24', 'user'),
(8, 'SERI', '2301081008', '$2y$12$TwPngPZTV4sL5zlUk9d5tuxkUjy2Lke/gl7ft0bqFmjGMYIYYCHE6', '1747874056.jpg', 'Perempuan', '2025-05-21 17:34:17', '2025-05-21 17:34:17', 'user'),
(11, 'awdasfwetewgk', '2301089000', '$2y$12$xaJ8RpIiYawURVRNPsVI0u2h6FkXus8E6FPdW9sCbbYNGN2h2LKs6', '1748312650.jpg', 'Laki-laki', '2025-05-26 19:24:11', '2025-05-26 19:24:11', 'user'),
(12, 'Esi Putriani', '2301081010', '$2y$12$CfFB3KCMggOV4.YabhjOOuyTQa4Rd1m2trYo6sxqlO9NIuejmQcxq', '1748779767.jpg', 'Perempuan', '2025-06-01 05:09:28', '2025-06-01 05:09:28', 'user'),
(13, 'tttt', '09876', '$2y$12$4n.5897WSeNSuT3sxJBIuu1PpANd9hifpvZ05h30w7Skz0mBuYKN6', NULL, 'Perempuan', '2025-06-15 20:22:41', '2025-06-15 20:22:41', 'user'),
(14, 'Rosi Maltasariedit', 'ddfg', '$2y$12$.eOG7zmJQkIiuX1O8mS77eQcTpCpHPQLeRylDkEvUf.ZUC9xfIxde', NULL, 'Perempuan', '2025-06-15 20:28:52', '2025-06-15 20:28:52', 'user'),
(15, 'Rosi Maltasari', '123', '$2y$12$9tInQfJKXSE.9eIrk26N8eJ7bMJemTnMJXJdl4ySrULqBUXgLl3pS', NULL, 'Perempuan', '2025-06-16 10:42:11', '2025-06-16 10:42:11', 'user'),
(16, 'Rosi Maltasari', '2301083008', '$2y$12$VJsS9hgDzOUjVCDmbhKsT.zLfMhnJ0TXqewLCaDHaURoqygqgJ/ny', NULL, 'Perempuan', '2025-06-16 12:06:23', '2025-06-16 12:06:23', 'user'),
(17, 'Rosi Maltasari baru', '22222222', '$2y$12$Kt4Hjo6oD1w4pXT/MAH4SOStDlIYO9fDR1ao62cnT2HYyVzng0Xlu', NULL, 'Perempuan', '2025-06-16 18:49:20', '2025-06-16 18:49:20', 'user'),
(18, 'oci', '11111', '$2y$12$4JNNAnWhnVUuIqqAQHlda.IifUy7BdUWuZd1MQN0b5HFs8wLBmCHy', NULL, 'Perempuan', '2025-06-16 19:07:35', '2025-06-16 19:07:35', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_user_id_foreign` (`user_id`),
  ADD KEY `peminjaman_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
