-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2021 at 07:02 PM
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

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `eCode` int(11) NOT NULL,
  `eName` varchar(250) NOT NULL,
  `eFile` blob NOT NULL,
  `userId` bigint(20) NOT NULL,
  `createDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `eCode`, `eName`, `eFile`, `userId`, `createDate`) VALUES
(1, 3, 'หนังสือเปลี่ยนแปลงตั้งผู้รับโอนประโยชน์ + บัตรข้าราชการ/บัตรประจำตัวประชาชน', '', 1, '2021-07-18 15:45:40'),
(2, 4, 'หนังสือเปลี่ยนแปลงชื่อ/สกุล/คำนำหน้าชื่อ + สำเนาเอกสารของทางการ', '', 1, '2021-07-18 15:45:58'),
(3, 1, 'ใบสมัครสมาชิก + บัตรข้าราชการ/บัตรประจำตัวประชาชน', '', 2, '2021-07-18 15:45:05'),
(4, 2, 'หนังสือตั้งผู้รับโอนประโยชน์ + บัตรข้าราชการ/บัตรประจำตัวประชาชน', '', 2, '2021-07-18 15:45:05');

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
  `eCode` int(11) NOT NULL,
  `eName` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `createUser` int(20) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_documents`
--

INSERT INTO `master_documents` (`eCode`, `eName`, `created_at`, `updated_at`, `createUser`) VALUES
(1, 'ใบสมัครสมาชิก + บัตรข้าราชการ/บัตรประจำตัวประชาชน', '2021-07-18 08:29:05', '2021-07-18 08:29:05', 1),
(2, 'หนังสือตั้งผู้รับโอนประโยชน์ + บัตรข้าราชการ/บัตรประจำตัวประชาชน', '2021-07-18 08:29:05', '2021-07-18 08:29:05', 1),
(3, 'หนังสือเปลี่ยนแปลงตั้งผู้รับโอนประโยชน์ + บัตรข้าราชการ/บัตรประจำตัวประชาชน', '2021-07-18 08:37:26', '2021-07-18 08:37:26', 1),
(4, 'หนังสือเปลี่ยนแปลงชื่อ/สกุล/คำนำหน้าชื่อ + สำเนาเอกสารของทางการ', '2021-07-18 08:37:26', '2021-07-18 08:37:26', 1),
(5, 'สัญญาเงินกู้แบบบุคคลและบริษัทประกัน', '2021-07-18 08:37:26', '2021-07-18 08:37:26', 1),
(6, 'สัญญาเงินกู้แบบไม่เกินมูลค่าหุ้นตัวเอง', '2021-07-18 08:37:26', '2021-07-18 08:37:26', 1),
(7, 'สัญญาเงินกู้เพื่อการศึกษา', '2021-07-18 08:37:26', '2021-07-18 08:37:26', 1),
(8, 'สัญญาเงินกู้เพื่อเหตุฉุกเฉิน', '2021-07-18 08:37:26', '2021-07-18 08:37:26', 1),
(9, 'หนังสือขอเปิดบัญชีเงินฝาก', '2021-07-18 08:37:26', '2021-07-18 08:37:26', 1),
(10, 'ทดสอบ', '2021-07-19 09:50:56', '2021-07-19 09:50:56', 1),
(11, 'ทดสอบ2', '2021-07-19 09:51:17', '2021-07-19 09:51:17', 1),
(22, 'ทดสอบqq', '2021-07-19 09:57:11', '2021-07-19 09:57:11', 1),
(112, 'ทดสอบxx', '2021-07-19 09:57:47', '2021-07-19 09:57:47', 2),
(555, 'ทดสอบ555', '2021-07-19 09:51:26', '2021-07-19 09:51:26', 1);

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
('narkapus@gmail.com', '$2y$10$0b/lXfbsPnf99bIZkfp41OHIUMBlvDwEz.6390iD7UggzI27XbL.C', '2021-07-02 04:18:57');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Admin', 'admin@material.com', '2021-07-02 03:44:29', '$2y$10$tNdzmfDRom8mWGZr.dFivuoOSMqBHwnDi3BbQVfS8ozWIrcnTkt5a', 'rluJqfDUtVsRNKokK5i4Mw12DVlj9ZkW6zHyoaF6wOZBqq9rcRDcZz0OOy42', '2021-07-02 03:44:29', '2021-07-02 03:44:29'),
(2, 'ศุภกานต์ เกตุแก้ว', 'narkapus@gmail.com', NULL, '$2y$10$6IInjfyBSIaarroufQ1Kk.ZVDWJ4tpor/iIxvjfqQeGlltfCPXR.a', NULL, '2021-07-02 03:49:37', '2021-07-02 03:49:37');

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
  ADD PRIMARY KEY (`eCode`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
