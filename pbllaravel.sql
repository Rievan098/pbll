-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 09, 2025 at 03:34 PM
-- Server version: 8.0.30
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
  `id` bigint UNSIGNED NOT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `nama_barang`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'Arduino Uno', 27, NULL, '2025-06-01 05:11:34'),
(3, 'Motor Servo', 20, '2025-05-04 05:51:57', '2025-05-19 19:14:22'),
(6, 'Esp-32cam', 10, '2025-05-19 19:05:36', '2025-05-19 19:45:00'),
(7, 'Selenoid', 8, '2025-05-21 00:30:56', '2025-05-21 17:35:05'),
(8, 'esp8266', 8, '2025-05-21 20:04:35', '2025-05-23 00:38:25');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
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
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_peminjaman` datetime NOT NULL,
  `tgl_pengembalian` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `user_id`, `barang_id`, `jumlah`, `status`, `tgl_peminjaman`, `tgl_pengembalian`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 'Dikembalikan', '2025-05-05 02:11:53', NULL, NULL, NULL),
(3, 1, 1, 0, 'Dikembalikan', '2025-05-05 02:39:58', NULL, NULL, NULL),
(4, 1, 1, 0, 'Dikembalikan', '2025-05-05 02:39:58', NULL, NULL, NULL),
(6, 1, 1, 0, 'Dikembalikan', '2025-05-05 11:11:54', NULL, NULL, NULL),
(9, 1, 1, 2, 'Dikembalikan', '2025-05-05 13:21:30', NULL, NULL, NULL),
(10, 5, 3, 4, 'Dikembalikan', '2025-05-05 13:22:39', NULL, NULL, NULL),
(11, 1, 1, 4, 'Dikembalikan', '2025-05-06 01:16:19', '2025-05-19 19:26:42', NULL, NULL),
(12, 1, 1, 5, 'Dikembalikan', '2025-05-06 12:34:23', '2025-05-19 19:26:37', NULL, NULL),
(13, 1, 1, 2, 'Dikembalikan', '2025-05-06 14:42:05', '2025-05-19 19:26:32', NULL, NULL),
(14, 1, 1, 5, 'Dikembalikan', '2025-05-07 07:19:44', NULL, NULL, NULL),
(15, 6, 1, 2, 'Dikembalikan', '2025-05-07 11:55:58', NULL, NULL, NULL),
(16, 1, 1, 1, 'Dikembalikan', '2025-05-20 02:30:15', '2025-05-19 19:30:48', NULL, NULL),
(17, 5, 1, 1, 'Dikembalikan', '2025-05-20 02:38:44', '2025-05-19 19:45:06', NULL, NULL),
(18, 1, 6, 1, 'Dikembalikan', '2025-05-20 02:41:22', '2025-05-19 19:45:00', NULL, NULL),
(19, 1, 1, 2, 'Dikembalikan', '2025-05-20 02:54:01', '2025-05-19 19:54:16', NULL, NULL),
(20, 6, 1, 4, 'Dikembalikan', '2025-05-20 03:09:50', '2025-05-19 20:10:17', NULL, NULL),
(21, 6, 1, 1, 'Dipinjam', '2025-05-21 04:28:37', NULL, '2025-05-20 21:28:37', '2025-05-20 21:28:37'),
(22, 6, 1, 1, 'Dipinjam', '2025-05-21 08:21:31', NULL, '2025-05-21 01:21:31', '2025-05-21 01:21:31'),
(23, 8, 7, 2, 'Dipinjam', '2025-05-22 00:35:05', NULL, '2025-05-21 17:35:05', '2025-05-21 17:35:05'),
(24, 1, 8, 5, 'Dikembalikan', '2025-05-22 03:05:29', '2025-05-21 20:06:04', '2025-05-21 20:05:29', '2025-05-21 20:06:04'),
(25, 8, 8, 2, 'Dipinjam', '2025-05-22 03:06:59', NULL, '2025-05-21 20:06:59', '2025-05-21 20:06:59'),
(26, 1, 8, 5, 'Dikembalikan', '2025-05-22 03:07:30', '2025-05-23 00:38:25', '2025-05-21 20:07:30', '2025-05-23 00:38:25'),
(27, 5, 1, 2, 'Dipinjam', '2025-05-23 07:38:57', NULL, '2025-05-23 00:38:57', '2025-05-23 00:38:57'),
(28, 6, 1, 2, 'Dikembalikan', '2025-05-27 01:56:57', '2025-05-27 21:37:54', '2025-05-26 18:56:57', '2025-05-27 21:37:54'),
(29, 8, 1, 4, 'Dikembalikan', '2025-05-28 04:22:26', '2025-05-27 21:37:40', '2025-05-27 21:22:26', '2025-05-27 21:37:40'),
(30, 12, 1, 3, 'Dikembalikan', '2025-06-01 12:10:15', '2025-06-01 05:11:34', '2025-06-01 05:10:15', '2025-06-01 05:11:34');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('E6ibBe7YNbJ4RyqwyZMYQKuqbX1UkrA0oLycll9W', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUm1aTFpaTWhVRWU2QW9QYllPMnR4SWpKdnVEUWEyUUowWlZWVTlGSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9wYmxsLnRlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748779902),
('P6oHEjKg2hpT8rxd5Q8GN5wDZjHYnPuCDm2KHoow', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ01SaGdXMms0ZDljSVlBSEcyRmw2ZGJLSHNmZ2c4bFBFMkdQekZsdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9wYmxsLnRlc3QvcmVnaXN0ZXIiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo4O30=', 1749482837),
('ph8d4Z1gokEKmfQbXAxbYhdemRMAdbvvhlFbyLDT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicHViaGw5UHVmRXpaRFk2bkw3b29qQ1ZiTzJ4anFWblB2RFpIUUxBSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9wYmxsLnRlc3QvcmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748834220),
('Pyz6dF2qg7d5F6htAg0mihTQTeiDcQ5KoHgXLEjd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRjVqaEZDaldqdG5kYVc3RXJjSDBrSUI0WWZlcTR6dkVIbW1WeXljeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9wYmxsLnRlc3QvcmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1749469321);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `face_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
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
(12, 'Esi Putriani', '2301081010', '$2y$12$CfFB3KCMggOV4.YabhjOOuyTQa4Rd1m2trYo6sxqlO9NIuejmQcxq', '1748779767.jpg', 'Perempuan', '2025-06-01 05:09:28', '2025-06-01 05:09:28', 'user');

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
