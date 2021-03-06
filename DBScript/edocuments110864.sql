-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2021 at 06:23 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edocuments`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--


CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eName` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `eCode` int(11) NOT NULL DEFAULT '0',
  `eFile` varchar(350) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '0',
  `userId` bigint(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `eStatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`eName`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` (`id`, `eName`, `eCode`, `eFile`, `userId`, `created_at`, `updated_at`, `eStatus`) VALUES
	(1, 'test3.pdf', 1, '0', 1, '2021-08-05 08:10:00', '2021-08-05 15:54:00', 1),
	(2, 'test2.pdf', 2, '0', 1, '2021-08-05 08:11:12', '2021-08-05 10:33:22', 1),
	(3, 'test151.pdf', 1, 'app/public/uploads/1628152152/test151.pdf', 1, '2021-08-05 08:29:12', '2021-08-05 15:53:39', 1),
	(4, 'test9.pdf', 5, 'app/public/uploads/1628607426/test9.pdf', 1, '2021-08-10 14:57:06', '2021-08-10 14:57:06', 1),
	(5, 'test13.pdf', 1, 'app/public/uploads/1628608145/test13.pdf', 1, '2021-08-10 15:09:05', '2021-08-10 15:31:00', 1),
	(6, 'test11.pdf', 5, 'app/publicuploads/1628614261/test11.pdf', 1, '2021-08-10 16:51:01', '2021-08-11 00:02:22', 1),
	(7, 'test6.pdf', 7, 'app/public/uploads/1628614347/test6.pdf', 1, '2021-08-10 16:52:27', '2021-08-11 00:02:38', 1),
	(8, 'test10.pdf', 2, 'app/public/uploads/1628615252/test10.pdf', 1, '2021-08-10 17:07:32', '2021-08-10 17:07:32', 1),
	(9, 'test12.pdf', 2, 'app/public/uploads/1628615774/test12.pdf', 1, '2021-08-11 00:16:15', '2021-08-11 00:16:15', 1);
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
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
-- Table structure for table `master_documents`
--

CREATE TABLE `master_documents` (
  `id` int(11) NOT NULL,
  `eCode` int(11) NOT NULL,
  `eName` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `createUser` int(20) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_documents`
--

INSERT INTO `master_documents` (`id`, `eCode`, `eName`, `created_at`, `updated_at`, `createUser`) VALUES
(1, 1, '??????????????????????????????????????? + ???????????????????????????????????????/?????????????????????????????????????????????????????????', '2021-07-18 00:00:00', '2021-07-30 16:17:24', 1),
(2, 2, '???????????????????????????????????????????????????????????????????????????????????? + ???????????????????????????????????????/?????????????????????????????????????????????????????????', '2021-07-18 00:00:00', '2021-07-18 00:00:00', 1),
(3, 3, '????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? + ???????????????????????????????????????/?????????????????????????????????????????????????????????', '2021-07-18 00:00:00', '2021-07-18 00:00:00', 1),
(4, 4, '??????????????????????????????????????????????????????????????????/????????????/???????????????????????????????????? + ????????????????????????????????????????????????????????????', '2021-07-18 00:00:00', '2021-07-18 00:00:00', 1),
(5, 5, '?????????????????????????????????????????????????????????????????????????????????????????????????????????', '2021-07-18 00:00:00', '2021-07-18 00:00:00', 1),
(6, 6, '??????????????????????????????????????????????????????????????????????????????????????????????????????????????????', '2021-07-18 00:00:00', '2021-07-18 00:00:00', 1),
(7, 7, '???????????????????????????????????????????????????????????????????????????', '2021-07-18 00:00:00', '2021-07-18 00:00:00', 1),
(8, 8, '????????????????????????????????????????????????????????????????????????????????????', '2021-07-18 00:00:00', '2021-07-18 00:00:00', 1),
(9, 9, '???????????????????????????????????????????????????????????????????????????', '2021-07-18 00:00:00', '2021-07-18 00:00:00', 1);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('narkapus@gmail.com', '$2y$10$0b/lXfbsPnf99bIZkfp41OHIUMBlvDwEz.6390iD7UggzI27XbL.C', '2021-07-01 21:18:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin Admin', 'admin@material.com', '2021-07-01 20:44:29', '$2y$10$tNdzmfDRom8mWGZr.dFivuoOSMqBHwnDi3BbQVfS8ozWIrcnTkt5a', 'rluJqfDUtVsRNKokK5i4Mw12DVlj9ZkW6zHyoaF6wOZBqq9rcRDcZz0OOy42', '2021-07-02 03:44:29', '2021-07-02 03:44:29', 1),
(2, '???????????????????????? ????????????????????????', 'narkapus@gmail.com', NULL, '$2y$10$QCXz2dgOMpgxLn.b/fWuYOCXLRyDLkBkzPGx2chXUUHKfD/Rc9ttq', 'zXRXj4CUtugJRoLeQCPKMcqftkm3dyegqeKEfYm8ILw3XpRWf2ks2W8STNxL', '2021-07-02 03:49:37', '2021-07-28 16:14:47', 1),
(6, 'Merle Botsford', 'shanon.cummings@example.org', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'e9U0mZdvPk', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(7, 'Claudie Rutherford', 'sryan@example.net', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vA6wFHIXE2', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(8, 'Domenic Denesik', 'alexzander.cartwright@example.org', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vQWBawvIRD', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(9, 'Sherwood Heller', 'mlind@example.com', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2d2MHEfFjM', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(10, 'Salvatore Bartoletti MD', 'luna.lemke@example.com', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1VRCsPTdWL', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(11, 'Leilani Ratke', 'crona.lindsey@example.net', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'l8lh7WrpGu', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(12, 'Elmo Cremin Sr.', 'yadira.schaefer@example.org', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pECciPcwTx', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(13, 'Mr. Clay Feil DVM', 'kaia.parker@example.com', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pcHODs0Ecr', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(14, 'Prof. Constance Carter III', 'zboncak.heath@example.net', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IHfCSfYoKC', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(15, 'Brayan Botsford DDS', 'jsporer@example.org', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XmsqzogwpB', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(16, 'Johnny Lubowitz', 'tschimmel@example.org', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'LC8AjkVw3i', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(17, 'Miss Elody Kihn', 'xbradtke@example.org', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '6dkUGZo3rC', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(18, 'Brando Witting', 'richard.harvey@example.net', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'VTGcPZDWes', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(19, 'Dr. Clark Wolf', 'claire.smitham@example.org', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'cv9808RBzn', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(20, 'Ms. Meda Koepp', 'lorine.rohan@example.org', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DIY1akBeyh', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(21, 'Lenore Rippin DVM', 'paolo13@example.net', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'GTXX5gZPh7', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(22, 'Ms. Trycia Harris III', 'dmorar@example.org', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'cc2sKMOPI4', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(23, 'Kathryn Marquardt', 'walker.mohr@example.org', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'YmRZ53Zohp', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(24, 'Ansel Jacobson', 'pbashirian@example.net', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'aeBpqgMPlV', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(25, 'Nella Blanda', 'tyree85@example.net', '2021-07-23 06:50:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pCvQksl51Y', '2021-07-23 13:50:38', '2021-07-23 13:50:38', 0),
(69, '??????????????? ?????????????????????', 'panidew@gmail.com', NULL, '$2y$10$1lm8c5dVijLx/A8B3dIiBeL1RH/jFawmzg9B8px6VqO1HZ5w7CuCe', NULL, '2021-07-30 11:21:47', '2021-07-30 11:21:47', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `master_documents`
--
ALTER TABLE `master_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_documents`
--
ALTER TABLE `master_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
