-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2024 at 04:04 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikar_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE `angsuran` (
  `id` bigint UNSIGNED NOT NULL,
  `hutang_id` bigint UNSIGNED NOT NULL,
  `angsuran_pertama` decimal(15,2) DEFAULT NULL,
  `angsuran_kedua` decimal(15,2) DEFAULT NULL,
  `angsuran_ketiga` decimal(15,2) DEFAULT NULL,
  `angsuran_keempat` decimal(15,2) DEFAULT NULL,
  `tanggal_angsuran_pertama` date DEFAULT NULL,
  `tanggal_angsuran_kedua` date DEFAULT NULL,
  `tanggal_angsuran_ketiga` date DEFAULT NULL,
  `tanggal_angsuran_keempat` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id` bigint UNSIGNED NOT NULL,
  `id_karyawan` bigint UNSIGNED NOT NULL,
  `id_hutang` bigint UNSIGNED DEFAULT NULL,
  `id_kehadiran` bigint UNSIGNED DEFAULT NULL,
  `gaji` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `id` bigint UNSIGNED NOT NULL,
  `id_karyawan` bigint UNSIGNED NOT NULL,
  `total_hutang` decimal(10,2) NOT NULL,
  `maksimal_hutang` decimal(10,2) NOT NULL,
  `tanggal_hutang` date NOT NULL,
  `sisa_hutang` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED DEFAULT NULL,
  `nama_karyawan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id` bigint UNSIGNED NOT NULL,
  `id_karyawan` bigint UNSIGNED NOT NULL,
  `jam_hadir` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `tanggal` date NOT NULL,
  `tepat_waktu` int DEFAULT NULL,
  `telat` int DEFAULT NULL,
  `bonus` int DEFAULT NULL,
  `denda` int DEFAULT NULL,
  `status_kehadiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(23, '2014_10_12_000000_create_users_table', 1),
(24, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(25, '2019_08_19_000000_create_failed_jobs_table', 1),
(26, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(27, '2024_05_12_163151_create_karyawan_table', 1),
(28, '2024_05_12_163300_create_kehadiran_table', 1),
(29, '2024_05_12_163344_create_hutang_table', 1),
(30, '2024_05_12_163416_create_gaji_table', 1),
(31, '2024_05_12_164944_create_tunjangan_table', 1),
(32, '2024_06_18_172530_create_angsuran_table', 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tunjangan`
--

CREATE TABLE `tunjangan` (
  `id` bigint UNSIGNED NOT NULL,
  `id_karyawan` bigint UNSIGNED NOT NULL,
  `id_gaji` bigint UNSIGNED DEFAULT NULL,
  `nama_tunjangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','karyawan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone_number`, `avatar`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@123.com', '$2y$12$ko3wxN.mQyNia7slLlJFGuW9GJQhxmiL/UtEKXpaznvGPohjLhS9.', '085702169158', '', 'admin', '2024-07-08 06:49:19', '2024-07-08 06:49:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `angsuran_hutang_id_foreign` (`hutang_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gaji_id_karyawan_foreign` (`id_karyawan`),
  ADD KEY `gaji_id_hutang_foreign` (`id_hutang`),
  ADD KEY `gaji_id_kehadiran_foreign` (`id_kehadiran`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hutang_id_karyawan_foreign` (`id_karyawan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_id_user_foreign` (`id_user`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kehadiran_id_karyawan_foreign` (`id_karyawan`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tunjangan`
--
ALTER TABLE `tunjangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tunjangan_id_karyawan_foreign` (`id_karyawan`),
  ADD KEY `tunjangan_id_gaji_foreign` (`id_gaji`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tunjangan`
--
ALTER TABLE `tunjangan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD CONSTRAINT `angsuran_hutang_id_foreign` FOREIGN KEY (`hutang_id`) REFERENCES `hutang` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_id_hutang_foreign` FOREIGN KEY (`id_hutang`) REFERENCES `hutang` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `gaji_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gaji_id_kehadiran_foreign` FOREIGN KEY (`id_kehadiran`) REFERENCES `kehadiran` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `hutang`
--
ALTER TABLE `hutang`
  ADD CONSTRAINT `hutang_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `kehadiran_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tunjangan`
--
ALTER TABLE `tunjangan`
  ADD CONSTRAINT `tunjangan_id_gaji_foreign` FOREIGN KEY (`id_gaji`) REFERENCES `gaji` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tunjangan_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
