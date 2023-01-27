-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2021 at 07:46 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tenders`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
                               `id` bigint(20) UNSIGNED NOT NULL,
                               `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `routes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                               `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                               `created_at` timestamp NULL DEFAULT NULL,
                               `updated_at` timestamp NULL DEFAULT NULL,
                               PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `routes`, `group`, `created_at`, `updated_at`) VALUES

    (1, 'عرض المستخدمين', 'admin', 'users.index', 'المستخدمين', NULL, NULL),
    (2, 'اضافة مستخدم', 'admin', 'users.create,users.store', 'المستخدمين', NULL, NULL),
    (3, 'تعديل مستخدم', 'admin', 'users.edit,users.update', 'المستخدمين', NULL, NULL),
    (4, 'حذف مستخدم', 'admin', 'users.destroy', 'المستخدمين', NULL, NULL),
    (5, 'عرض العملاء', 'admin', 'clients.index', 'العملاء', NULL, NULL),
    (6, 'اضافة عميل', 'admin', 'clients.create,clients.store', 'العملاء', NULL, NULL),
    (7, 'تعديل عميل', 'admin', 'clients.edit,clients.update', 'العملاء', NULL, NULL),
    (8, 'حذف عميل', 'admin', 'clients.destroy', 'العملاء', NULL, NULL),
    (9, 'عرض اﻹستشارات', 'admin', 'consults.index', 'اﻹستشارات', NULL, NULL),
    (10, 'تعديل إستشارة', 'admin', 'consults.edit,consults.update', 'اﻹستشارات', NULL, NULL),
    (11, 'حذف إستشارة', 'admin', 'consults.destroy', 'اﻹستشارات', NULL, NULL),
    (12, 'عرض المحامين', 'admin', 'laywers.index', 'المحامين', NULL, NULL),
    (13, 'اضافة محامي', 'admin', 'laywers.create,laywers.store', 'المحامين', NULL, NULL),
    (14, 'تعديل محامي', 'admin', 'laywers.edit,laywers.update', 'المحامين', NULL, NULL),
    (15, 'حذف محامي', 'admin', 'laywers.destroy', 'المحامين', NULL, NULL),
    (16, 'عرض الرتب', 'admin', 'roles.index', 'الرتب', NULL, NULL),
    (17, 'اضافة رتبة', 'admin', 'roles.create,roles.store', 'الرتب', NULL, NULL),
    (18, 'تعديل رتبة', 'admin', 'roles.edit,roles.update', 'الرتب', NULL, NULL),
    (19, 'حذف رتبة', 'admin', 'roles.destroy', 'الرتب', NULL, NULL),
    (20, 'عرض اﻹعدادات', 'admin', 'setting.index', 'اﻹعدادات', NULL, NULL),
    (21, 'تعديل اﻹعدادات', 'admin', 'setting.edit,setting.update', 'اﻹعدادات', NULL, NULL),
    (22, 'عرض السجلات', 'admin', 'log.index', 'السجلات', NULL, NULL),
    (23, 'عرض رسائل التواصل', 'admin', 'contacts.index', 'رسائل التواصل', NULL, NULL),
    (24, 'عرض طلبات الإنضمام', 'admin', 'join-requests.index', 'طلبات الإنضمام', NULL, NULL),
    (25, 'حذف طلب إنضمام', 'admin', 'join-requests.destroy', 'طلبات الإنضمام', NULL, NULL),
    (26, 'عرض المقالات', 'admin', 'articles.index', 'المقالات', NULL, NULL),
    (27, 'اضافة مقالة', 'admin', 'articles.create,articles.store', 'المقالات', NULL, NULL),
    (28, 'تعديل مقالة', 'admin', 'articles.edit,articles.update', 'المقالات', NULL, NULL),
    (29, 'حذف مقالة', 'admin', 'articles.destroy', 'المقالات', NULL, NULL);
COMMIT;

INSERT INTO `settings` (`id`,
    `site_name`,
    `about_us`,
    `goal`,
    `our_services_sub_title`,
    `commercial_issues_sub_title`,
    `our_team_sub_title`,
    `our_clients_sub_title`,
    `faq_sub_title`,
    `blog_sub_title`,
    `expert_laywers`,
    `closed_cases`,
    `successful_casses`,
    `trusted_client`,
    `phone`,
    `email`,
    `twitter`,
    `linkedin`,
    `created_at`,
    `updated_at`
) VALUES(
    1,
    '{\"ar\":\"more_first_graph ar\",\"en\":\"more_first_graph en\"}',
    '{\"ar\":\"more_first_graph ar\",\"en\":\"more_first_graph en\"}',
    '{\"ar\":\"more_first_graph ar\",\"en\":\"more_first_graph en\"}',
    '{\"ar\":\"more_first_graph ar\",\"en\":\"more_first_graph en\"}',
    '{\"ar\":\"more_first_graph ar\",\"en\":\"more_first_graph en\"}',
    '{\"ar\":\"more_first_graph ar\",\"en\":\"more_first_graph en\"}',
    '{\"ar\":\"more_first_graph ar\",\"en\":\"more_first_graph en\"}',
    '{\"ar\":\"more_first_graph ar\",\"en\":\"more_first_graph en\"}',
    '{\"ar\":\"more_first_graph ar\",\"en\":\"more_first_graph en\"}',
    '1', '2', '3', '4', '132', 'ads@das.com', 'as', 'ads', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
