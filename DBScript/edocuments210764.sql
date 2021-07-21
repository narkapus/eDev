-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table edocuments.documents
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eCode` int(11) NOT NULL,
  `eName` varchar(250) NOT NULL,
  `eFile` blob NOT NULL,
  `userId` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table edocuments.documents: ~11 rows (approximately)
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` (`id`, `eCode`, `eName`, `eFile`, `userId`, `created_at`, `updated_at`) VALUES
	(1, 3, 'หนังสือเปลี่ยนแปลงตั้งผู้รับโอนประโยชน์ + บัตรข้าราชการ/บัตรประจำตัวประชาชน', _binary '', 1, '2021-07-18 15:45:40', '2021-07-21 07:34:58'),
	(2, 4, 'หนังสือเปลี่ยนแปลงชื่อ/สกุล/คำนำหน้าชื่อ + สำเนาเอกสารของทางการ', _binary '', 1, '2021-07-18 15:45:58', '2021-07-21 07:34:58'),
	(3, 1, 'ใบสมัครสมาชิก + บัตรข้าราชการ/บัตรประจำตัวประชาชน', _binary '', 2, '2021-07-18 15:45:05', '2021-07-21 07:34:58'),
	(4, 2, 'หนังสือตั้งผู้รับโอนประโยชน์ + บัตรข้าราชการ/บัตรประจำตัวประชาชน', _binary '', 2, '2021-07-18 15:45:05', '2021-07-21 07:34:58'),
	(5, 2, 'NULL', _binary 0x7676767676, 1, '2021-07-21 00:49:51', '2021-07-21 00:49:51'),
	(6, 2, 'NULL', _binary 0x767676767677777777, 1, '2021-07-21 01:01:34', '2021-07-21 01:01:34'),
	(7, 12, 'NULL', _binary 0x656565656565, 1, '2021-07-21 01:02:03', '2021-07-21 01:02:03'),
	(8, 2, 'NULL', _binary 0x31363236383539393636746573742E706466, 1, '2021-07-21 02:32:47', '2021-07-21 02:32:47'),
	(9, 11, 'NULL', _binary 0x313632363836303530382F746573742E706466, 1, '2021-07-21 02:41:48', '2021-07-21 02:41:48'),
	(10, 11, 'NULL', _binary 0x313632363836303637342F746573742E706466, 1, '2021-07-21 02:44:34', '2021-07-21 02:44:34'),
	(11, 5, 'null', _binary 0x2F73746F726167652F75706C6F6164732F313632363836323135352F746573742E706466, 1, '2021-07-21 03:09:15', '2021-07-21 10:35:01');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;

-- Dumping structure for table edocuments.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edocuments.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table edocuments.master_documents
CREATE TABLE IF NOT EXISTS `master_documents` (
  `eCode` int(11) NOT NULL,
  `eName` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createUser` int(20) DEFAULT '1',
  PRIMARY KEY (`eCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table edocuments.master_documents: ~14 rows (approximately)
/*!40000 ALTER TABLE `master_documents` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `master_documents` ENABLE KEYS */;

-- Dumping structure for table edocuments.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edocuments.migrations: ~3 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table edocuments.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edocuments.password_resets: ~1 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('narkapus@gmail.com', '$2y$10$0b/lXfbsPnf99bIZkfp41OHIUMBlvDwEz.6390iD7UggzI27XbL.C', '2021-07-02 04:18:57');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table edocuments.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edocuments.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin Admin', 'admin@material.com', '2021-07-02 03:44:29', '$2y$10$tNdzmfDRom8mWGZr.dFivuoOSMqBHwnDi3BbQVfS8ozWIrcnTkt5a', 'rluJqfDUtVsRNKokK5i4Mw12DVlj9ZkW6zHyoaF6wOZBqq9rcRDcZz0OOy42', '2021-07-02 03:44:29', '2021-07-02 03:44:29'),
	(2, 'ศุภกานต์ เกตุแก้ว', 'narkapus@gmail.com', NULL, '$2y$10$6IInjfyBSIaarroufQ1Kk.ZVDWJ4tpor/iIxvjfqQeGlltfCPXR.a', NULL, '2021-07-02 03:49:37', '2021-07-02 03:49:37');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
