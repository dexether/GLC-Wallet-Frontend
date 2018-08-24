-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2018 at 02:27 AM
-- Server version: 10.1.31-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `socimmlh_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `activations`
--

CREATE TABLE IF NOT EXISTS `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `activations`
--

INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, '6ipxjLiXBeDy3ntJsKMMSOXS9JhWskjX', 1, '2018-03-05 13:02:22', '2018-03-05 13:02:22', '2018-03-05 13:02:22'),
(2, 2, 'NKOeVhmszxOW3tnoB5A7AgJ6gvRm0iX3', 1, '2018-03-15 11:36:21', '2018-03-15 11:36:21', '2018-03-15 11:36:21'),
(3, 3, '4AzXC9mBGBX9cS4pBCMpvEfv4VRFPcxe', 1, '2018-03-29 05:33:38', '2018-03-29 05:33:38', '2018-03-29 05:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE IF NOT EXISTS `audit_trail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=171 ;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `user_id`, `user`, `module`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-03-05 13:02:32', '2018-03-05 13:02:32'),
(2, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-15 11:38:15', '2018-03-15 11:38:15'),
(3, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-03-15 11:38:23', '2018-03-15 11:38:23'),
(4, 1, 'Admin Admin', NULL, 'Updated user with id:1', '2018-03-15 11:38:58', '2018-03-15 11:38:58'),
(5, 1, 'Admin Admin', NULL, 'Updated user with id:2', '2018-03-15 11:39:43', '2018-03-15 11:39:43'),
(6, 1, 'Admin Admin', NULL, 'Updated Settings', '2018-03-15 11:41:42', '2018-03-15 11:41:42'),
(7, 1, 'Admin Admin', NULL, 'Updated Settings', '2018-03-15 11:42:58', '2018-03-15 11:42:58'),
(8, 1, 'Admin Admin', NULL, 'Updated trade currency with id:3', '2018-03-15 11:46:02', '2018-03-15 11:46:02'),
(9, 1, 'Admin Admin', NULL, 'Logged out of system', '2018-03-15 11:47:56', '2018-03-15 11:47:56'),
(10, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-15 11:47:58', '2018-03-15 11:47:58'),
(11, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-15 11:49:24', '2018-03-15 11:49:24'),
(12, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-03-15 11:49:40', '2018-03-15 11:49:40'),
(13, 1, 'Admin Admin', NULL, 'Updated trade currency with id:4', '2018-03-15 11:52:17', '2018-03-15 11:52:17'),
(14, 1, 'Admin Admin', NULL, 'Logged out of system', '2018-03-15 11:53:54', '2018-03-15 11:53:54'),
(15, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-15 11:53:58', '2018-03-15 11:53:58'),
(16, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-15 11:54:48', '2018-03-15 11:54:48'),
(17, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-03-15 11:54:55', '2018-03-15 11:54:55'),
(18, 1, 'Admin Admin', NULL, 'Updated user with id:2', '2018-03-15 11:55:10', '2018-03-15 11:55:10'),
(19, 1, 'Admin Admin', NULL, 'Logged out of system', '2018-03-15 11:55:14', '2018-03-15 11:55:14'),
(20, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-15 11:55:17', '2018-03-15 11:55:17'),
(21, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-15 11:57:12', '2018-03-15 11:57:12'),
(22, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-03-15 11:57:17', '2018-03-15 11:57:17'),
(23, 1, 'Admin Admin', NULL, 'Updated trade currency with id:5', '2018-03-15 11:57:42', '2018-03-15 11:57:42'),
(24, 1, 'Admin Admin', NULL, 'Logged out of system', '2018-03-15 11:57:51', '2018-03-15 11:57:51'),
(25, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-15 11:57:54', '2018-03-15 11:57:54'),
(26, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-15 12:04:24', '2018-03-15 12:04:24'),
(27, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-03-15 12:04:31', '2018-03-15 12:04:31'),
(28, 1, 'Admin Admin', NULL, 'Updated Settings', '2018-03-15 12:06:07', '2018-03-15 12:06:07'),
(29, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-17 21:47:06', '2018-03-17 21:47:06'),
(30, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-17 21:49:43', '2018-03-17 21:49:43'),
(31, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-17 22:25:26', '2018-03-17 22:25:26'),
(32, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-03-17 22:25:33', '2018-03-17 22:25:33'),
(33, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-17 22:45:56', '2018-03-17 22:45:56'),
(34, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-18 01:43:14', '2018-03-18 01:43:14'),
(35, 1, 'Admin Admin', NULL, 'Logged out of system', '2018-03-18 03:22:56', '2018-03-18 03:22:56'),
(36, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-18 03:22:58', '2018-03-18 03:22:58'),
(37, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-18 19:53:49', '2018-03-18 19:53:49'),
(38, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-03-18 19:53:55', '2018-03-18 19:53:55'),
(39, 1, 'Admin Admin', NULL, 'Logged out of system', '2018-03-19 01:46:53', '2018-03-19 01:46:53'),
(40, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-19 01:46:55', '2018-03-19 01:46:55'),
(41, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-19 03:25:36', '2018-03-19 03:25:36'),
(42, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-03-19 03:25:40', '2018-03-19 03:25:40'),
(43, 1, 'Admin Admin', NULL, 'Updated trade currency with id:6', '2018-03-19 03:26:44', '2018-03-19 03:26:44'),
(44, 1, 'Admin Admin', NULL, 'Logged out of system', '2018-03-19 03:26:56', '2018-03-19 03:26:56'),
(45, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-19 03:26:58', '2018-03-19 03:26:58'),
(46, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-19 04:03:49', '2018-03-19 04:03:49'),
(47, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-03-19 04:03:53', '2018-03-19 04:03:53'),
(48, 1, 'Admin Admin', NULL, 'Logged out of system', '2018-03-19 08:54:11', '2018-03-19 08:54:11'),
(49, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-19 08:54:14', '2018-03-19 08:54:14'),
(50, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-19 09:05:07', '2018-03-19 09:05:07'),
(51, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-19 10:02:05', '2018-03-19 10:02:05'),
(52, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-19 10:02:31', '2018-03-19 10:02:31'),
(53, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-19 10:42:06', '2018-03-19 10:42:06'),
(54, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-19 10:51:03', '2018-03-19 10:51:03'),
(55, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-19 11:31:58', '2018-03-19 11:31:58'),
(56, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-19 13:37:23', '2018-03-19 13:37:23'),
(57, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-21 10:39:26', '2018-03-21 10:39:26'),
(58, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-21 17:13:01', '2018-03-21 17:13:01'),
(59, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-22 08:04:59', '2018-03-22 08:04:59'),
(60, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-22 08:11:19', '2018-03-22 08:11:19'),
(61, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-22 10:12:22', '2018-03-22 10:12:22'),
(62, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-22 10:25:35', '2018-03-22 10:25:35'),
(63, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-03-22 10:25:41', '2018-03-22 10:25:41'),
(64, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-22 11:47:13', '2018-03-22 11:47:13'),
(65, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-22 12:37:54', '2018-03-22 12:37:54'),
(66, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-22 12:42:26', '2018-03-22 12:42:26'),
(67, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-22 15:04:59', '2018-03-22 15:04:59'),
(68, 1, 'Admin Admin', NULL, 'Logged out of system', '2018-03-23 10:24:18', '2018-03-23 10:24:18'),
(69, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-23 10:24:20', '2018-03-23 10:24:20'),
(70, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-23 10:36:20', '2018-03-23 10:36:20'),
(71, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-23 10:36:27', '2018-03-23 10:36:27'),
(72, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-23 10:36:36', '2018-03-23 10:36:36'),
(73, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-23 10:51:50', '2018-03-23 10:51:50'),
(74, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-23 01:51:42', '2018-03-23 01:51:42'),
(75, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-23 01:51:54', '2018-03-23 01:51:54'),
(76, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-23 01:52:31', '2018-03-23 01:52:31'),
(77, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-23 03:17:13', '2018-03-23 03:17:13'),
(78, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-26 23:33:35', '2018-03-26 23:33:35'),
(79, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-27 00:24:10', '2018-03-27 00:24:10'),
(80, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-27 00:24:33', '2018-03-27 00:24:33'),
(81, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-27 00:29:29', '2018-03-27 00:29:29'),
(82, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-27 03:42:02', '2018-03-27 03:42:02'),
(83, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-27 03:42:05', '2018-03-27 03:42:05'),
(84, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-27 04:41:47', '2018-03-27 04:41:47'),
(85, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-27 18:50:31', '2018-03-27 18:50:31'),
(86, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-27 19:58:30', '2018-03-27 19:58:30'),
(87, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-27 20:02:30', '2018-03-27 20:02:30'),
(88, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-27 21:25:31', '2018-03-27 21:25:31'),
(89, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-28 18:27:48', '2018-03-28 18:27:48'),
(90, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-28 19:31:49', '2018-03-28 19:31:49'),
(91, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-29 05:30:49', '2018-03-29 05:30:49'),
(92, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-29 05:33:05', '2018-03-29 05:33:05'),
(93, 3, 'Monark Modi', NULL, 'Logged out of system', '2018-03-29 05:36:42', '2018-03-29 05:36:42'),
(94, 3, 'Monark Modi', NULL, 'Logged in to system', '2018-03-29 05:36:49', '2018-03-29 05:36:49'),
(95, 3, 'Monark Modi', NULL, 'Logged out of system', '2018-03-29 05:36:53', '2018-03-29 05:36:53'),
(96, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-29 05:36:57', '2018-03-29 05:36:57'),
(97, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-29 05:37:27', '2018-03-29 05:37:27'),
(98, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-29 05:40:16', '2018-03-29 05:40:16'),
(99, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-29 05:41:05', '2018-03-29 05:41:05'),
(100, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-29 08:47:56', '2018-03-29 08:47:56'),
(101, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-29 18:11:25', '2018-03-29 18:11:25'),
(102, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-29 19:41:17', '2018-03-29 19:41:17'),
(103, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-29 19:48:34', '2018-03-29 19:48:34'),
(104, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-30 08:45:46', '2018-03-30 08:45:46'),
(105, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-30 09:17:35', '2018-03-30 09:17:35'),
(106, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-30 18:50:49', '2018-03-30 18:50:49'),
(107, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-03-30 19:03:44', '2018-03-30 19:03:44'),
(108, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-30 19:21:00', '2018-03-30 19:21:00'),
(109, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-03-30 21:00:10', '2018-03-30 21:00:10'),
(110, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-01 07:06:37', '2018-04-01 07:06:37'),
(111, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-02 07:32:41', '2018-04-02 07:32:41'),
(112, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-02 09:20:51', '2018-04-02 09:20:51'),
(113, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-02 10:49:05', '2018-04-02 10:49:05'),
(114, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-02 11:16:23', '2018-04-02 11:16:23'),
(115, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-02 18:18:38', '2018-04-02 18:18:38'),
(116, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 05:23:59', '2018-04-03 05:23:59'),
(117, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-04-03 07:23:43', '2018-04-03 07:23:43'),
(118, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-04-03 07:23:50', '2018-04-03 07:23:50'),
(119, 1, 'Admin Admin', NULL, 'Logged out of system', '2018-04-03 07:28:03', '2018-04-03 07:28:03'),
(120, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 07:37:51', '2018-04-03 07:37:51'),
(121, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 08:48:25', '2018-04-03 08:48:25'),
(122, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 08:53:02', '2018-04-03 08:53:02'),
(123, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-04-03 08:58:05', '2018-04-03 08:58:05'),
(124, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-04-03 08:58:24', '2018-04-03 08:58:24'),
(125, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 09:01:09', '2018-04-03 09:01:09'),
(126, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 09:09:20', '2018-04-03 09:09:20'),
(127, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-04-03 09:18:02', '2018-04-03 09:18:02'),
(128, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 09:20:36', '2018-04-03 09:20:36'),
(129, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 09:26:03', '2018-04-03 09:26:03'),
(130, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-04-03 09:31:24', '2018-04-03 09:31:24'),
(131, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 09:37:20', '2018-04-03 09:37:20'),
(132, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-04-03 09:37:27', '2018-04-03 09:37:27'),
(133, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 09:52:46', '2018-04-03 09:52:46'),
(134, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-04-03 09:54:07', '2018-04-03 09:54:07'),
(135, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 09:59:22', '2018-04-03 09:59:22'),
(136, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-04-03 09:59:52', '2018-04-03 09:59:52'),
(137, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 10:16:13', '2018-04-03 10:16:13'),
(138, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-04-03 10:16:59', '2018-04-03 10:16:59'),
(139, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 10:37:36', '2018-04-03 10:37:36'),
(140, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-04-03 10:37:50', '2018-04-03 10:37:50'),
(141, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 10:49:51', '2018-04-03 10:49:51'),
(142, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-04-03 10:51:26', '2018-04-03 10:51:26'),
(143, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 13:51:07', '2018-04-03 13:51:07'),
(144, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 14:07:18', '2018-04-03 14:07:18'),
(145, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-04-03 14:07:27', '2018-04-03 14:07:27'),
(146, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 17:56:21', '2018-04-03 17:56:21'),
(147, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-04-03 17:57:22', '2018-04-03 17:57:22'),
(148, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-03 21:56:49', '2018-04-03 21:56:49'),
(149, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-04-04 07:19:57', '2018-04-04 07:19:57'),
(150, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-04-04 07:20:06', '2018-04-04 07:20:06'),
(151, 1, 'Admin Admin', NULL, 'Updated trade currency with id:4', '2018-04-04 07:22:15', '2018-04-04 07:22:15'),
(152, 1, 'Admin Admin', NULL, 'Logged out of system', '2018-04-04 07:22:55', '2018-04-04 07:22:55'),
(153, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-04 07:22:59', '2018-04-04 07:22:59'),
(154, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-04-04 07:25:57', '2018-04-04 07:25:57'),
(155, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-04 08:24:37', '2018-04-04 08:24:37'),
(156, 2, 'Monark Modi', NULL, 'Logged out of system', '2018-04-04 08:59:51', '2018-04-04 08:59:51'),
(157, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-04-04 08:59:57', '2018-04-04 08:59:57'),
(158, 1, 'Admin Admin', NULL, 'Updated trade currency with id:4', '2018-04-04 09:01:15', '2018-04-04 09:01:15'),
(159, 1, 'Admin Admin', NULL, 'Updated trade currency with id:5', '2018-04-04 09:01:29', '2018-04-04 09:01:29'),
(160, 1, 'Admin Admin', NULL, 'Updated trade currency with id:2', '2018-04-04 09:01:52', '2018-04-04 09:01:52'),
(161, 1, 'Admin Admin', NULL, 'Updated trade currency with id:1', '2018-04-04 09:02:14', '2018-04-04 09:02:14'),
(162, 1, 'Admin Admin', NULL, 'Updated trade currency with id:3', '2018-04-04 09:04:01', '2018-04-04 09:04:01'),
(163, 1, 'Admin Admin', NULL, 'Logged out of system', '2018-04-04 09:04:11', '2018-04-04 09:04:11'),
(164, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-04 09:04:14', '2018-04-04 09:04:14'),
(165, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-04-04 09:48:16', '2018-04-04 09:48:16'),
(166, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-04 09:48:40', '2018-04-04 09:48:40'),
(167, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-04-04 09:50:08', '2018-04-04 09:50:08'),
(168, 1, 'Admin Admin', NULL, 'Logged in to system', '2018-04-04 10:06:34', '2018-04-04 10:06:34'),
(169, 1, 'Admin Admin', NULL, 'Logged out of system', '2018-04-04 10:17:41', '2018-04-04 10:17:41'),
(170, 2, 'Monark Modi', NULL, 'Logged in to system', '2018-04-04 10:17:55', '2018-04-04 10:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sortname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `signup_page` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=247 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `active`, `signup_page`) VALUES
(1, 'AF', 'Afghanistan', 1, 1),
(2, 'AL', 'Albania', 1, 1),
(3, 'DZ', 'Algeria', 1, 1),
(4, 'AS', 'American Samoa', 1, 1),
(5, 'AD', 'Andorra', 1, 1),
(6, 'AO', 'Angola', 1, 1),
(7, 'AI', 'Anguilla', 1, 1),
(8, 'AQ', 'Antarctica', 1, 1),
(9, 'AG', 'Antigua And Barbuda', 1, 1),
(10, 'AR', 'Argentina', 1, 1),
(11, 'AM', 'Armenia', 1, 1),
(12, 'AW', 'Aruba', 1, 1),
(13, 'AU', 'Australia', 1, 1),
(14, 'AT', 'Austria', 1, 1),
(15, 'AZ', 'Azerbaijan', 1, 1),
(16, 'BS', 'Bahamas The', 1, 1),
(17, 'BH', 'Bahrain', 1, 1),
(18, 'BD', 'Bangladesh', 1, 1),
(19, 'BB', 'Barbados', 1, 1),
(20, 'BY', 'Belarus', 1, 1),
(21, 'BE', 'Belgium', 1, 1),
(22, 'BZ', 'Belize', 1, 1),
(23, 'BJ', 'Benin', 1, 1),
(24, 'BM', 'Bermuda', 1, 1),
(25, 'BT', 'Bhutan', 1, 1),
(26, 'BO', 'Bolivia', 1, 1),
(27, 'BA', 'Bosnia and Herzegovina', 1, 1),
(28, 'BW', 'Botswana', 1, 1),
(29, 'BV', 'Bouvet Island', 1, 1),
(30, 'BR', 'Brazil', 1, 1),
(31, 'IO', 'British Indian Ocean Territory', 1, 1),
(32, 'BN', 'Brunei', 1, 1),
(33, 'BG', 'Bulgaria', 1, 1),
(34, 'BF', 'Burkina Faso', 1, 1),
(35, 'BI', 'Burundi', 1, 1),
(36, 'KH', 'Cambodia', 1, 1),
(37, 'CM', 'Cameroon', 1, 1),
(38, 'CA', 'Canada', 1, 1),
(39, 'CV', 'Cape Verde', 1, 1),
(40, 'KY', 'Cayman Islands', 1, 1),
(41, 'CF', 'Central African Republic', 1, 1),
(42, 'TD', 'Chad', 1, 1),
(43, 'CL', 'Chile', 1, 1),
(44, 'CN', 'China', 1, 1),
(45, 'CX', 'Christmas Island', 1, 1),
(46, 'CC', 'Cocos (Keeling) Islands', 1, 1),
(47, 'CO', 'Colombia', 1, 1),
(48, 'KM', 'Comoros', 1, 1),
(49, 'CG', 'Congo', 1, 1),
(50, 'CD', 'Congo The Democratic Republic Of The', 1, 1),
(51, 'CK', 'Cook Islands', 1, 1),
(52, 'CR', 'Costa Rica', 1, 1),
(53, 'CI', 'Cote D''Ivoire (Ivory Coast)', 1, 1),
(54, 'HR', 'Croatia (Hrvatska)', 1, 1),
(55, 'CU', 'Cuba', 1, 1),
(56, 'CY', 'Cyprus', 1, 1),
(57, 'CZ', 'Czech Republic', 1, 1),
(58, 'DK', 'Denmark', 1, 1),
(59, 'DJ', 'Djibouti', 1, 1),
(60, 'DM', 'Dominica', 1, 1),
(61, 'DO', 'Dominican Republic', 1, 1),
(62, 'TP', 'East Timor', 1, 1),
(63, 'EC', 'Ecuador', 1, 1),
(64, 'EG', 'Egypt', 1, 1),
(65, 'SV', 'El Salvador', 1, 1),
(66, 'GQ', 'Equatorial Guinea', 1, 1),
(67, 'ER', 'Eritrea', 1, 1),
(68, 'EE', 'Estonia', 1, 1),
(69, 'ET', 'Ethiopia', 1, 1),
(70, 'XA', 'External Territories of Australia', 1, 1),
(71, 'FK', 'Falkland Islands', 1, 1),
(72, 'FO', 'Faroe Islands', 1, 1),
(73, 'FJ', 'Fiji Islands', 1, 1),
(74, 'FI', 'Finland', 1, 1),
(75, 'FR', 'France', 1, 1),
(76, 'GF', 'French Guiana', 1, 1),
(77, 'PF', 'French Polynesia', 1, 1),
(78, 'TF', 'French Southern Territories', 1, 1),
(79, 'GA', 'Gabon', 1, 1),
(80, 'GM', 'Gambia The', 1, 1),
(81, 'GE', 'Georgia', 1, 1),
(82, 'DE', 'Germany', 1, 1),
(83, 'GH', 'Ghana', 1, 1),
(84, 'GI', 'Gibraltar', 1, 1),
(85, 'GR', 'Greece', 1, 1),
(86, 'GL', 'Greenland', 1, 1),
(87, 'GD', 'Grenada', 1, 1),
(88, 'GP', 'Guadeloupe', 1, 1),
(89, 'GU', 'Guam', 1, 1),
(90, 'GT', 'Guatemala', 1, 1),
(91, 'XU', 'Guernsey and Alderney', 1, 1),
(92, 'GN', 'Guinea', 1, 1),
(93, 'GW', 'Guinea-Bissau', 1, 1),
(94, 'GY', 'Guyana', 1, 1),
(95, 'HT', 'Haiti', 1, 1),
(96, 'HM', 'Heard and McDonald Islands', 1, 1),
(97, 'HN', 'Honduras', 1, 1),
(98, 'HK', 'Hong Kong S.A.R.', 1, 1),
(99, 'HU', 'Hungary', 1, 1),
(100, 'IS', 'Iceland', 1, 1),
(101, 'IN', 'India', 1, 1),
(102, 'ID', 'Indonesia', 1, 1),
(103, 'IR', 'Iran', 1, 1),
(104, 'IQ', 'Iraq', 1, 1),
(105, 'IE', 'Ireland', 1, 1),
(106, 'IL', 'Israel', 1, 1),
(107, 'IT', 'Italy', 1, 1),
(108, 'JM', 'Jamaica', 1, 1),
(109, 'JP', 'Japan', 1, 1),
(110, 'XJ', 'Jersey', 1, 1),
(111, 'JO', 'Jordan', 1, 1),
(112, 'KZ', 'Kazakhstan', 1, 1),
(113, 'KE', 'Kenya', 1, 1),
(114, 'KI', 'Kiribati', 1, 1),
(115, 'KP', 'Korea North', 1, 1),
(116, 'KR', 'Korea South', 1, 1),
(117, 'KW', 'Kuwait', 1, 1),
(118, 'KG', 'Kyrgyzstan', 1, 1),
(119, 'LA', 'Laos', 1, 1),
(120, 'LV', 'Latvia', 1, 1),
(121, 'LB', 'Lebanon', 1, 1),
(122, 'LS', 'Lesotho', 1, 1),
(123, 'LR', 'Liberia', 1, 1),
(124, 'LY', 'Libya', 1, 1),
(125, 'LI', 'Liechtenstein', 1, 1),
(126, 'LT', 'Lithuania', 1, 1),
(127, 'LU', 'Luxembourg', 1, 1),
(128, 'MO', 'Macau S.A.R.', 1, 1),
(129, 'MK', 'Macedonia', 1, 1),
(130, 'MG', 'Madagascar', 1, 1),
(131, 'MW', 'Malawi', 1, 1),
(132, 'MY', 'Malaysia', 1, 1),
(133, 'MV', 'Maldives', 1, 1),
(134, 'ML', 'Mali', 1, 1),
(135, 'MT', 'Malta', 1, 1),
(136, 'XM', 'Man (Isle of)', 1, 1),
(137, 'MH', 'Marshall Islands', 1, 1),
(138, 'MQ', 'Martinique', 1, 1),
(139, 'MR', 'Mauritania', 1, 1),
(140, 'MU', 'Mauritius', 1, 1),
(141, 'YT', 'Mayotte', 1, 1),
(142, 'MX', 'Mexico', 1, 1),
(143, 'FM', 'Micronesia', 1, 1),
(144, 'MD', 'Moldova', 1, 1),
(145, 'MC', 'Monaco', 1, 1),
(146, 'MN', 'Mongolia', 1, 1),
(147, 'MS', 'Montserrat', 1, 1),
(148, 'MA', 'Morocco', 1, 1),
(149, 'MZ', 'Mozambique', 1, 1),
(150, 'MM', 'Myanmar', 1, 1),
(151, 'NA', 'Namibia', 1, 1),
(152, 'NR', 'Nauru', 1, 1),
(153, 'NP', 'Nepal', 1, 1),
(154, 'AN', 'Netherlands Antilles', 1, 1),
(155, 'NL', 'Netherlands The', 1, 1),
(156, 'NC', 'New Caledonia', 1, 1),
(157, 'NZ', 'New Zealand', 1, 1),
(158, 'NI', 'Nicaragua', 1, 1),
(159, 'NE', 'Niger', 1, 1),
(160, 'NG', 'Nigeria', 1, 1),
(161, 'NU', 'Niue', 1, 1),
(162, 'NF', 'Norfolk Island', 1, 1),
(163, 'MP', 'Northern Mariana Islands', 1, 1),
(164, 'NO', 'Norway', 1, 1),
(165, 'OM', 'Oman', 1, 1),
(166, 'PK', 'Pakistan', 1, 1),
(167, 'PW', 'Palau', 1, 1),
(168, 'PS', 'Palestinian Territory Occupied', 1, 1),
(169, 'PA', 'Panama', 1, 1),
(170, 'PG', 'Papua new Guinea', 1, 1),
(171, 'PY', 'Paraguay', 1, 1),
(172, 'PE', 'Peru', 1, 1),
(173, 'PH', 'Philippines', 1, 1),
(174, 'PN', 'Pitcairn Island', 1, 1),
(175, 'PL', 'Poland', 1, 1),
(176, 'PT', 'Portugal', 1, 1),
(177, 'PR', 'Puerto Rico', 1, 1),
(178, 'QA', 'Qatar', 1, 1),
(179, 'RE', 'Reunion', 1, 1),
(180, 'RO', 'Romania', 1, 1),
(181, 'RU', 'Russia', 1, 1),
(182, 'RW', 'Rwanda', 1, 1),
(183, 'SH', 'Saint Helena', 1, 1),
(184, 'KN', 'Saint Kitts And Nevis', 1, 1),
(185, 'LC', 'Saint Lucia', 1, 1),
(186, 'PM', 'Saint Pierre and Miquelon', 1, 1),
(187, 'VC', 'Saint Vincent And The Grenadines', 1, 1),
(188, 'WS', 'Samoa', 1, 1),
(189, 'SM', 'San Marino', 1, 1),
(190, 'ST', 'Sao Tome and Principe', 1, 1),
(191, 'SA', 'Saudi Arabia', 1, 1),
(192, 'SN', 'Senegal', 1, 1),
(193, 'RS', 'Serbia', 1, 1),
(194, 'SC', 'Seychelles', 1, 1),
(195, 'SL', 'Sierra Leone', 1, 1),
(196, 'SG', 'Singapore', 1, 1),
(197, 'SK', 'Slovakia', 1, 1),
(198, 'SI', 'Slovenia', 1, 1),
(199, 'XG', 'Smaller Territories of the UK', 1, 1),
(200, 'SB', 'Solomon Islands', 1, 1),
(201, 'SO', 'Somalia', 1, 1),
(202, 'ZA', 'South Africa', 1, 1),
(203, 'GS', 'South Georgia', 1, 1),
(204, 'SS', 'South Sudan', 1, 1),
(205, 'ES', 'Spain', 1, 1),
(206, 'LK', 'Sri Lanka', 1, 1),
(207, 'SD', 'Sudan', 1, 1),
(208, 'SR', 'Suriname', 1, 1),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 1, 1),
(210, 'SZ', 'Swaziland', 1, 1),
(211, 'SE', 'Sweden', 1, 1),
(212, 'CH', 'Switzerland', 1, 1),
(213, 'SY', 'Syria', 1, 1),
(214, 'TW', 'Taiwan', 1, 1),
(215, 'TJ', 'Tajikistan', 1, 1),
(216, 'TZ', 'Tanzania', 1, 1),
(217, 'TH', 'Thailand', 1, 1),
(218, 'TG', 'Togo', 1, 1),
(219, 'TK', 'Tokelau', 1, 1),
(220, 'TO', 'Tonga', 1, 1),
(221, 'TT', 'Trinidad And Tobago', 1, 1),
(222, 'TN', 'Tunisia', 1, 1),
(223, 'TR', 'Turkey', 1, 1),
(224, 'TM', 'Turkmenistan', 1, 1),
(225, 'TC', 'Turks And Caicos Islands', 1, 1),
(226, 'TV', 'Tuvalu', 1, 1),
(227, 'UG', 'Uganda', 1, 1),
(228, 'UA', 'Ukraine', 1, 1),
(229, 'AE', 'United Arab Emirates', 1, 1),
(230, 'GB', 'United Kingdom', 1, 1),
(231, 'US', 'United States', 1, 1),
(232, 'UM', 'United States Minor Outlying Islands', 1, 1),
(233, 'UY', 'Uruguay', 1, 1),
(234, 'UZ', 'Uzbekistan', 1, 1),
(235, 'VU', 'Vanuatu', 1, 1),
(236, 'VA', 'Vatican City State (Holy See)', 1, 1),
(237, 'VE', 'Venezuela', 1, 1),
(238, 'VN', 'Vietnam', 1, 1),
(239, 'VG', 'Virgin Islands (British)', 1, 1),
(240, 'VI', 'Virgin Islands (US)', 1, 1),
(241, 'WF', 'Wallis And Futuna Islands', 1, 1),
(242, 'EH', 'Western Sahara', 1, 1),
(243, 'YE', 'Yemen', 1, 1),
(244, 'YU', 'Yugoslavia', 1, 1),
(245, 'ZM', 'Zambia', 1, 1),
(246, 'ZW', 'Zimbabwe', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `rate` text COLLATE utf8_unicode_ci,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `symbol` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` enum('left','right') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'left',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `user_id`, `rate`, `code`, `name`, `symbol`, `position`) VALUES
(1, NULL, '1.00', 'USD', 'United States dollar', '$', 'left');

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE IF NOT EXISTS `custom_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_type` enum('number','textfield','date','decimal','textarea','select','radio','checkbox') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'textfield',
  `required` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields_meta`
--

CREATE TABLE IF NOT EXISTS `custom_fields_meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `custom_field_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE IF NOT EXISTS `deposits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wallet_address_id` int(11) DEFAULT NULL,
  `sender_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receiver_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` text COLLATE utf8_unicode_ci,
  `confirmations` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `trade_currency_id` int(11) DEFAULT NULL,
  `deposit_method_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `amount` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `total` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `status` enum('pending','processing','cancelled','done','accepted') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `network` enum('usd','bitcoin','litecoin','dogecoin','ethereum','ripple') COLLATE utf8_unicode_ci DEFAULT 'usd',
  `deposit_type` enum('bank','manual','commission','system') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'bank',
  `notes` text COLLATE utf8_unicode_ci,
  `otp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_bank_account_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deposits_id_index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `wallet_address_id`, `sender_address`, `receiver_address`, `account_name`, `account_number`, `transaction_id`, `confirmations`, `user_id`, `trade_currency_id`, `deposit_method_id`, `name`, `amount`, `fee`, `total`, `status`, `network`, `deposit_type`, `notes`, `otp`, `created_at`, `updated_at`, `user_bank_account_id`) VALUES
(1, 1, '2N6MfS6yTfm5m4PgnV39fqtsiCJjhpuM8rC', '2N6MfS6yTfm5m4PgnV39fqtsiCJjhpuM8rC', 'BTC Deposit', '1', 'dd6af56c5f0ef6b20216289e0f0bfa1c02fad7079ab1a0f0ba776ff2116b8c6c', 2, 2, 4, 1, NULL, '5000.000000000000000000000000000000', '50.000000000000000000000000000000', '5500.000000000000000000000000000000', 'processing', 'usd', 'bank', NULL, '123', '2018-03-20 04:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `recipients` int(10) unsigned NOT NULL,
  `send_to` text COLLATE utf8_unicode_ci,
  `notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=125 ;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(124, '2018_02_21_201427_add_ethereum_and_ripple_to_trade_currencies_table', 1),
(97, '2014_07_02_230147_migration_cartalyst_sentinel', 1),
(98, '2016_07_23_173226_create_sms_table', 1),
(99, '2016_07_23_173242_create_settings_table', 1),
(100, '2016_11_05_062734_create_permissions_table', 1),
(101, '2017_02_23_002300_create_custom_fields_table', 1),
(102, '2017_02_23_003720_create_custom_fields_meta_table', 1),
(103, '2017_04_18_083800_create_emails_table', 1),
(104, '2017_05_04_103559_create_countries_table', 1),
(105, '2017_07_23_064420_create_audit_trail_table', 1),
(106, '2017_11_03_105326_create_sms_gateways_table', 1),
(107, '2017_11_03_164336_add_currencies_table', 1),
(108, '2018_01_19_091022_create_order_book_table', 1),
(109, '2018_01_19_091819_create_trade_history_table', 1),
(110, '2018_01_19_091844_create_deposits_table', 1),
(111, '2018_01_19_091918_create_withdrawals_table', 1),
(112, '2018_01_19_093520_create_referral_commissions_table', 1),
(113, '2018_01_19_100710_create_trade_currencies_table', 1),
(114, '2018_01_19_104048_create_payment_gateways_table', 1),
(115, '2018_01_19_104607_create_withdrawal_methods_table', 1),
(116, '2018_01_20_123806_create_wallet_addresses_table', 1),
(117, '2018_02_09_154912_create_user_bank_accounts_table', 1),
(118, '2018_02_20_104421_offline_wallets_table', 1),
(119, '2018_02_20_110418_create_pages_table', 1),
(120, '2018_02_20_131821_add_offline_wallet_to_settings_table', 1),
(121, '2018_02_20_141003_create_order_fulfilments_table', 1),
(122, '2018_02_20_172900_add_bank_account_to_withdrawals_table', 1),
(123, '2018_02_20_183225_add_bank_account_to_deposits_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `offline_wallets`
--

CREATE TABLE IF NOT EXISTS `offline_wallets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `trade_currency_id` int(11) DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `private_key` text COLLATE utf8_unicode_ci,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offline_wallets_id_index` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_book`
--

CREATE TABLE IF NOT EXISTS `order_book` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trade_currency_id` int(11) DEFAULT NULL,
  `from_currency_id` int(11) DEFAULT NULL,
  `to_currency_id` int(11) DEFAULT NULL,
  `linked_order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_type` enum('bid','ask') COLLATE utf8_unicode_ci NOT NULL,
  `market_type` enum('limit','market') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'limit',
  `amount` decimal(65,30) DEFAULT NULL,
  `price` decimal(65,30) DEFAULT NULL,
  `volume` decimal(65,30) DEFAULT NULL,
  `fulfilled_volume` decimal(65,30) DEFAULT NULL,
  `fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `status` enum('pending','cancelled','done') COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `month` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `otp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `network` enum('usd','bitcoin','litecoin','dogecoin','ethereum','ripple') COLLATE utf8_unicode_ci DEFAULT 'usd',
  PRIMARY KEY (`id`),
  KEY `order_book_id_index` (`id`),
  KEY `order_book_order_type_index` (`order_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `order_book`
--

INSERT INTO `order_book` (`id`, `trade_currency_id`, `from_currency_id`, `to_currency_id`, `linked_order_id`, `user_id`, `order_type`, `market_type`, `amount`, `price`, `volume`, `fulfilled_volume`, `fee`, `status`, `date`, `month`, `year`, `otp`, `created_at`, `updated_at`, `network`) VALUES
(1, 4, 1, 1, NULL, 2, 'bid', 'limit', '8000.000000000000000000000000000000', '7450.000000000000000000000000000000', '1.400000000000000000000000000000', '1.400000000000000000000000000000', '70.000000000000000000000000000000', 'done', '2018-03-20', NULL, NULL, NULL, '2018-03-13 04:00:00', NULL, 'usd'),
(2, 4, 1, 1, NULL, 2, 'ask', 'limit', '7450.000000000000000000000000000000', '7450.000000000000000000000000000000', '1.000000000000000000000000000000', '1.000000000000000000000000000000', '70.000000000000000000000000000000', 'done', '2018-03-20', NULL, NULL, NULL, '2018-03-13 04:00:00', NULL, 'usd'),
(3, 1, 1, 1, NULL, 2, 'ask', 'limit', '10000.000000000000000000000000000000', '2000.000000000000000000000000000000', '5.000000000000000000000000000000', NULL, '100.000000000000000000000000000000', 'done', NULL, NULL, NULL, NULL, '2018-03-20 20:03:01', '2018-03-20 20:03:01', 'ethereum'),
(4, 4, NULL, NULL, NULL, 2, 'ask', 'limit', '1480.000000000000000000000000000000', '7400.000000000000000000000000000000', '0.200000000000000000000000000000', NULL, '0.000000000000000000000000000000', 'cancelled', NULL, NULL, NULL, NULL, '2018-03-20 20:05:55', '2018-03-21 14:41:21', 'bitcoin'),
(5, 4, NULL, NULL, NULL, 2, 'bid', 'limit', '7400.000000000000000000000000000000', '7400.000000000000000000000000000000', '1.000000000000000000000000000000', NULL, '0.000000000000000000000000000000', 'cancelled', NULL, NULL, NULL, NULL, '2018-03-20 20:06:23', '2018-03-20 20:06:47', 'bitcoin'),
(6, 4, NULL, NULL, NULL, 2, 'bid', 'limit', '1480.000000000000000000000000000000', '7400.000000000000000000000000000000', '0.200000000000000000000000000000', NULL, '0.000000000000000000000000000000', 'pending', NULL, NULL, NULL, NULL, '2018-03-20 20:06:57', '2018-03-20 20:06:57', 'bitcoin'),
(7, 2, 1, 1, NULL, 2, 'bid', 'limit', '100.000000000000000000000000000000', '100.000000000000000000000000000000', '1.000000000000000000000000000000', NULL, '2.000000000000000000000000000000', 'done', NULL, NULL, NULL, NULL, '2018-03-20 20:03:01', '2018-03-20 20:03:01', 'ripple'),
(8, 4, NULL, NULL, NULL, 2, 'bid', 'limit', '0.000000000000000000000000000000', '4564564.000000000000000000000000000000', '0.000000000000000000000000000000', NULL, '0.000000000000000000000000000000', 'cancelled', NULL, NULL, NULL, NULL, '2018-03-21 11:02:47', '2018-03-30 22:45:30', 'bitcoin'),
(9, 4, NULL, NULL, NULL, 2, 'bid', 'limit', '231.000000000000000000000000000000', '231.000000000000000000000000000000', '1.000000000000000000000000000000', NULL, '0.000000000000000000000000000000', 'pending', NULL, NULL, NULL, NULL, '2018-03-21 11:03:03', '2018-03-21 11:03:03', 'bitcoin'),
(10, 4, NULL, NULL, NULL, 2, 'bid', 'limit', '1480.000000000000000000000000000000', '7400.000000000000000000000000000000', '0.200000000000000000000000000000', NULL, '0.000000000000000000000000000000', 'pending', NULL, NULL, NULL, NULL, '2018-03-21 11:22:40', '2018-03-21 11:22:40', 'bitcoin'),
(11, 4, NULL, NULL, NULL, 2, 'ask', 'limit', '0.000000000000000000000000000000', '4564564.000000000000000000000000000000', '0.000000000000000000000000000000', NULL, '0.000000000000000000000000000000', 'cancelled', NULL, NULL, NULL, NULL, '2018-03-21 11:32:26', '2018-03-30 22:45:24', 'bitcoin'),
(12, 4, NULL, NULL, NULL, 2, 'ask', 'limit', '0.000000000000000000000000000000', '4564564.000000000000000000000000000000', '0.000000000000000000000000000000', NULL, '0.000000000000000000000000000000', 'cancelled', NULL, NULL, NULL, NULL, '2018-03-21 13:36:04', '2018-03-30 22:45:18', 'bitcoin'),
(13, 4, NULL, NULL, NULL, 2, 'ask', 'limit', '740.000000000000000000000000000000', '7400.000000000000000000000000000000', '0.100000000000000000000000000000', NULL, '0.000000000000000000000000000000', 'pending', NULL, NULL, NULL, NULL, '2018-03-29 22:56:58', '2018-03-29 22:56:58', 'bitcoin'),
(14, 4, NULL, NULL, NULL, 2, 'bid', 'limit', '740.000000000000000000000000000000', '7400.000000000000000000000000000000', '0.100000000000000000000000000000', NULL, '0.000000000000000000000000000000', 'cancelled', NULL, NULL, NULL, NULL, '2018-03-30 08:37:36', '2018-04-02 14:15:34', 'bitcoin'),
(15, 4, NULL, NULL, NULL, 2, 'ask', 'limit', '350.000000000000000000000000000000', '7000.000000000000000000000000000000', '0.050000000000000000000000000000', NULL, '0.000000000000000000000000000000', 'pending', NULL, NULL, NULL, NULL, '2018-04-04 07:23:56', '2018-04-04 07:23:56', 'bitcoin');

-- --------------------------------------------------------

--
-- Table structure for table `order_fulfilments`
--

CREATE TABLE IF NOT EXISTS `order_fulfilments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_currency_id` int(11) DEFAULT NULL,
  `to_currency_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `linked_order_id` int(11) DEFAULT NULL,
  `amount` decimal(65,30) DEFAULT NULL,
  `price` decimal(65,30) DEFAULT NULL,
  `volume` decimal(65,30) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `month` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `order_fulfilments`
--

INSERT INTO `order_fulfilments` (`id`, `from_currency_id`, `to_currency_id`, `user_id`, `order_id`, `linked_order_id`, `amount`, `price`, `volume`, `date`, `month`, `year`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 1, NULL, '8000.000000000000000000000000000000', '7450.000000000000000000000000000000', '1.400000000000000000000000000000', '2018-03-20', 'March', '2018', '2018-03-20 04:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `name` text COLLATE utf8_unicode_ci,
  `slug` text COLLATE utf8_unicode_ci,
  `notes` text COLLATE utf8_unicode_ci,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE IF NOT EXISTS `payment_gateways` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `logo` text COLLATE utf8_unicode_ci,
  `paypal_email` text COLLATE utf8_unicode_ci,
  `stripe_secret_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stripe_publishable_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paynow_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paynow_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `perfect_money_alternate_phrase` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `perfect_money_account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fee_method` enum('fixed','percentage','both') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'percentage',
  `fixed_fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `percentage_fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `minimum_amount` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `maximum_amount` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `notes` text COLLATE utf8_unicode_ci,
  `confirmations` int(11) NOT NULL DEFAULT '3',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_gateways_id_index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `system`, `name`, `user_id`, `logo`, `paypal_email`, `stripe_secret_key`, `stripe_publishable_key`, `paynow_key`, `paynow_id`, `perfect_money_alternate_phrase`, `perfect_money_account`, `fee_method`, `fixed_fee`, `percentage_fee`, `minimum_amount`, `maximum_amount`, `notes`, `confirmations`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Paypal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'percentage', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', 'Payment Via Paypal', 3, 1, NULL, NULL),
(2, 1, 'Stripe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'percentage', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', 'Payment Via Stripe', 3, 1, NULL, NULL),
(3, 1, 'Paynow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'percentage', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', 'Payment Via Paynow', 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `parent_id`, `name`, `slug`, `description`) VALUES
(1, 0, 'Reports', 'reports', 'Access Reports Module'),
(2, 0, 'Communication', 'communication', 'Access Communication Module'),
(3, 2, 'Create Communication', 'communication.create', 'Send Emails & SMS'),
(4, 2, 'Delete Communication', 'communication.delete', 'Delete Communication'),
(5, 0, 'Custom Fields', 'custom_fields', 'Access Custom Fields Module'),
(6, 5, 'View Custom Fields', 'custom_fields.view', 'View Custom fields'),
(7, 5, 'Create Custom Fields', 'custom_fields.create', 'Create Custom Fields'),
(8, 5, 'Custom Fields', 'custom_fields.update', 'Update Custom Fields'),
(9, 5, 'Delete Custom Fields', 'custom_fields.delete', 'Delete Custom Fields'),
(10, 0, 'Users', 'users', 'Access Users Module'),
(11, 10, 'View Users', 'users.view', 'View Users '),
(12, 10, 'Create Users', 'users.create', 'Create users'),
(13, 10, 'Update Users', 'users.update', 'Update Users'),
(14, 10, 'Delete Users', 'users.delete', 'Delete Users'),
(15, 10, 'Manage Roles', 'users.roles', 'Manage user roles'),
(16, 0, 'Settings', 'settings', 'Manage Settings'),
(17, 0, 'Audit Trail', 'audit_trail', 'Access Audit Trail'),
(18, 0, 'Currencies', 'currencies', 'Access Currencies menu'),
(19, 18, 'View Currencies', 'currencies.view', NULL),
(20, 18, 'Create Currencies', 'currencies.create', NULL),
(21, 18, 'Update Currencies', 'currencies.update', NULL),
(22, 18, 'Delete Currencies', 'currencies.delete', NULL),
(23, 0, 'Withdrawals', 'withdrawals', 'Access Withdrawals menu'),
(24, 23, 'View Withdrawals', 'withdrawals.view', NULL),
(25, 23, 'Create Withdrawals', 'withdrawals.create', NULL),
(26, 23, 'Update Withdrawals', 'withdrawals.update', NULL),
(27, 23, 'Delete Withdrawals', 'withdrawals.delete', NULL),
(28, 0, 'Deposits', 'deposits', 'Access Deposits menu'),
(29, 28, 'View Deposits', 'deposits.view', NULL),
(30, 28, 'Create Deposits', 'deposits.create', NULL),
(31, 28, 'Update Deposits', 'deposits.update', NULL),
(32, 28, 'Delete Deposits', 'deposits.delete', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `persistences`
--

CREATE TABLE IF NOT EXISTS `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=105 ;

--
-- Dumping data for table `persistences`
--

INSERT INTO `persistences` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(99, 2, 'uIgCJwVDoTNymtEDLLFT7PARkCD2gYLR', '2018-04-04 09:04:14', '2018-04-04 09:04:14'),
(101, 2, 'TzeT78aecp1GIaXcnGtPYmN3ReCE5y6J', '2018-04-04 09:48:40', '2018-04-04 09:48:40'),
(104, 2, 'eH9WHpiQKcgk4ngPSyXYxXuUCMCIKUY2', '2018-04-04 10:17:55', '2018-04-04 10:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `referral_commissions`
--

CREATE TABLE IF NOT EXISTS `referral_commissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `trade_currency_id` int(11) DEFAULT NULL,
  `amount` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `status` enum('pending','processing','cancelled','done','paid') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `referral_commissions_id_index` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE IF NOT EXISTS `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', '{"reports":true,"communication":true,"communication.create":true,"communication.delete":true,"custom_fields":true,"custom_fields.view":true,"custom_fields.create":true,"custom_fields.update":true,"custom_fields.delete":true,"users":true,"users.view":true,"users.create":true,"users.update":true,"users.delete":true,"users.roles":true,"settings":true,"audit_trail":true,"currencies":true,"currencies.view":true,"currencies.create":true,"currencies.update":true,"currencies.delete":true,"withdrawals":true,"withdrawals.view":true,"withdrawals.create":true,"withdrawals.update":true,"withdrawals.delete":true,"deposits":true,"deposits.view":true,"deposits.create":true,"deposits.update":true,"deposits.delete":true}', NULL, NULL),
(2, 'client', 'Client', '{}', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE IF NOT EXISTS `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-03-05 13:02:22', '2018-03-05 13:02:22'),
(2, 2, '2018-03-15 11:36:21', '2018-03-15 11:36:21'),
(3, 2, '2018-03-29 05:33:38', '2018-03-29 05:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_setting_key_unique` (`setting_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES
(1, 'wallet_address_source', '1'),
(2, 'account_accessed_notification', '0'),
(3, 'account_accessed_email_subject', 'Account Accessed'),
(4, 'account_accessed_email_template', '<p>Dear {name}. Your account was accessed from {ip}</p>'),
(5, 'enable_withdrawal_otp', '1'),
(6, 'enable_partial_order_fulfilment', '0'),
(7, 'site_online', '1'),
(8, 'enable_frontend', '1'),
(9, 'enable_coin_to_coin', NULL),
(10, 'order_expire_days', '0'),
(11, 'company_name', 'Baytrade Exchange'),
(12, 'company_address', 'Deira'),
(13, 'company_currency', 'AED'),
(14, 'company_website', 'http://www.baytrade.io'),
(15, 'company_country', '229'),
(16, 'system_version', '1.0'),
(17, 'sms_enabled', '1'),
(18, 'active_sms', NULL),
(19, 'portal_address', 'http://www.'),
(20, 'company_email', 'contact@baytrade.io'),
(21, 'currency_symbol', 'د.إ'),
(22, 'currency_position', 'left'),
(23, 'company_logo', 'BT-white-blue.png'),
(24, 'phone_verify', '1'),
(25, 'email_verify', '1'),
(26, 'documents_verify', '1'),
(27, 'auto_email_activation', '1'),
(28, 'referral_commission', '0'),
(29, 'minimum_payout', '100'),
(30, 'cancel_withdrawal', '1'),
(31, 'notify_withdrawal_request', '1'),
(32, 'notify_exchange_complete', '1'),
(33, 'custom_header_javascript', NULL),
(34, 'custom_footer_javascript', NULL),
(35, 'enable_google_recaptcha', '0'),
(36, 'google_recaptcha_site_key', NULL),
(37, 'google_recaptcha_secret_key', NULL),
(38, 'password_reset_subject', 'Password reset instructions'),
(39, 'password_reset_template', '<p>Dear {name}, you have requested to change password.Click <a href="http://btrade.socialinnovationcon.org/setting/{resetLink}">here</a> to reset your password. If link does not work, paste this link in your browser: {resetLink}</p>'),
(40, 'new_account_subject', 'New Account Information'),
(41, 'new_account_template', '<p>Thank you for creating an account. Click <a href="http://btrade.socialinnovationcon.org/setting/{activationLink}">here</a> to activate your account. If link does not work, paste this link in your browser: {activationLink}</p>'),
(42, 'withdrawal_paid_sms_template', NULL),
(43, 'withdrawal_paid_email_template', '<p>Dear {name}, Your cash out request was paid.<br /> Transaction ID: {transactionId}. Amount:${amount}. Thank you</p>'),
(44, 'withdrawal_paid_email_subject', 'Withdrawal Paid'),
(45, 'withdrawal_declined_email_template', '<p>Dear {name}, Your cash out request was declined.<br /> Transaction ID: {transactionId}. <br />Amount:${amount}. <br />Thank you</p>'),
(46, 'withdrawal_declined_email_subject', 'Withdrawal Declined'),
(47, 'payment_email_subject', 'Payment Receipt'),
(48, 'payment_email_template', '<p>Dear {name},You received new payment. Transaction ID: {transactionId}.<br />Payment Type:{paymentType}<br />Amount:${amount}.<br /> Thank you</p>'),
(49, 'sell_email_subject', 'Crypto Currency Sold'),
(50, 'sell_email_template', '<p>Dear {name}, your cryptocurrency has been purchased.<br />Order ID:{orderId}}</p>'),
(51, 'withdrawal_request_email_subject', 'Withdrawal Request'),
(52, 'withdrawal_request_email_template', '<p>Dear Admin. {name} has made a withdrawal request.Transaction ID: {transactionId}.<br />Payment Type:{paymentType}<br />Amount:${amount}.<br /> Thank you</p>'),
(53, 'non_reply_email', 'nonreply@baytrade.io'),
(54, 'cron_last_run', NULL),
(55, 'enable_cron', '0'),
(56, 'admin_email', 'admin@webstudio.co.zw'),
(57, 'alerts_email', 'alerts@webstudio.co.zw'),
(58, 'wallet_address_limit', '1'),
(59, 'otp_sms_template', 'Your OTP is {otp}'),
(60, 'announcement', ''),
(61, 'announcement_type', 'info'),
(62, 'update_url', 'http://webstudio.co.zw/uce/update');

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE IF NOT EXISTS `sms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `recipients` int(10) unsigned NOT NULL,
  `send_to` text COLLATE utf8_unicode_ci,
  `notes` text COLLATE utf8_unicode_ci,
  `gateway` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sms_gateways`
--

CREATE TABLE IF NOT EXISTS `sms_gateways` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `from_name` text COLLATE utf8_unicode_ci,
  `to_name` text COLLATE utf8_unicode_ci,
  `url` text COLLATE utf8_unicode_ci,
  `msg_name` text COLLATE utf8_unicode_ci,
  `notes` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE IF NOT EXISTS `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `type`, `ip`, `created_at`, `updated_at`) VALUES
(1, NULL, 'global', NULL, '2018-03-18 01:42:51', '2018-03-18 01:42:51'),
(2, NULL, 'ip', '27.6.230.105', '2018-03-18 01:42:51', '2018-03-18 01:42:51'),
(3, 2, 'user', NULL, '2018-03-18 01:42:51', '2018-03-18 01:42:51'),
(4, NULL, 'global', NULL, '2018-03-23 10:35:17', '2018-03-23 10:35:17'),
(5, NULL, 'ip', '103.88.54.250', '2018-03-23 10:35:17', '2018-03-23 10:35:17'),
(6, 2, 'user', NULL, '2018-03-23 10:35:17', '2018-03-23 10:35:17'),
(7, NULL, 'global', NULL, '2018-03-23 10:35:36', '2018-03-23 10:35:36'),
(8, NULL, 'ip', '103.88.54.250', '2018-03-23 10:35:36', '2018-03-23 10:35:36'),
(9, 2, 'user', NULL, '2018-03-23 10:35:36', '2018-03-23 10:35:36'),
(10, NULL, 'global', NULL, '2018-03-23 10:36:18', '2018-03-23 10:36:18'),
(11, NULL, 'ip', '103.88.54.250', '2018-03-23 10:36:18', '2018-03-23 10:36:18'),
(12, 2, 'user', NULL, '2018-03-23 10:36:18', '2018-03-23 10:36:18'),
(13, NULL, 'global', NULL, '2018-03-29 05:33:09', '2018-03-29 05:33:09'),
(14, NULL, 'ip', '75.69.44.245', '2018-03-29 05:33:09', '2018-03-29 05:33:09'),
(15, NULL, 'global', NULL, '2018-03-29 05:33:17', '2018-03-29 05:33:17'),
(16, NULL, 'ip', '75.69.44.245', '2018-03-29 05:33:17', '2018-03-29 05:33:17'),
(17, NULL, 'global', NULL, '2018-03-29 05:36:44', '2018-03-29 05:36:44'),
(18, NULL, 'ip', '75.69.44.245', '2018-03-29 05:36:44', '2018-03-29 05:36:44'),
(19, NULL, 'global', NULL, '2018-04-03 08:39:23', '2018-04-03 08:39:23'),
(20, NULL, 'ip', '122.173.22.204', '2018-04-03 08:39:23', '2018-04-03 08:39:23'),
(21, 2, 'user', NULL, '2018-04-03 08:39:23', '2018-04-03 08:39:23'),
(22, NULL, 'global', NULL, '2018-04-03 08:39:42', '2018-04-03 08:39:42'),
(23, NULL, 'ip', '122.173.22.204', '2018-04-03 08:39:42', '2018-04-03 08:39:42'),
(24, 2, 'user', NULL, '2018-04-03 08:39:42', '2018-04-03 08:39:42'),
(25, NULL, 'global', NULL, '2018-04-03 08:39:56', '2018-04-03 08:39:56'),
(26, NULL, 'ip', '122.173.22.204', '2018-04-03 08:39:56', '2018-04-03 08:39:56'),
(27, 2, 'user', NULL, '2018-04-03 08:39:56', '2018-04-03 08:39:56'),
(28, NULL, 'global', NULL, '2018-04-03 08:40:14', '2018-04-03 08:40:14'),
(29, NULL, 'ip', '122.173.22.204', '2018-04-03 08:40:14', '2018-04-03 08:40:14'),
(30, 2, 'user', NULL, '2018-04-03 08:40:14', '2018-04-03 08:40:14');

-- --------------------------------------------------------

--
-- Table structure for table `trade_currencies`
--

CREATE TABLE IF NOT EXISTS `trade_currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `default_currency` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `confirmations` int(11) DEFAULT '3',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fee_method` enum('fixed','percentage','both') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'percentage',
  `deposit_fixed_fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `withdrawal_fixed_fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `deposit_percentage_fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `withdrawal_percentage_fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `trade_percentage_fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `trade_fixed_fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `minimum_amount` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `maximum_amount` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `commission_fixed_fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `commission_percentage_fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `allow_commission` tinyint(4) NOT NULL DEFAULT '1',
  `allow_receiving` tinyint(4) NOT NULL DEFAULT '1',
  `allow_sending` tinyint(4) NOT NULL DEFAULT '1',
  `allow_withdrawal` tinyint(4) NOT NULL DEFAULT '1',
  `cryptocurrency` tinyint(4) NOT NULL DEFAULT '1',
  `api_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `network` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secret_pin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `xml_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8_unicode_ci,
  `decimals` int(11) NOT NULL DEFAULT '4',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trade_currencies_id_index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `trade_currencies`
--

INSERT INTO `trade_currencies` (`id`, `default_currency`, `user_id`, `confirmations`, `name`, `fee_method`, `deposit_fixed_fee`, `withdrawal_fixed_fee`, `deposit_percentage_fee`, `withdrawal_percentage_fee`, `trade_percentage_fee`, `trade_fixed_fee`, `minimum_amount`, `maximum_amount`, `commission_fixed_fee`, `commission_percentage_fee`, `allow_commission`, `allow_receiving`, `allow_sending`, `allow_withdrawal`, `cryptocurrency`, `api_key`, `network`, `address`, `secret_pin`, `xml_code`, `site_code`, `logo`, `decimals`, `active`, `notes`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, 3, 'Ethereum', 'percentage', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', 1, 1, 1, 1, 1, '#', 'ethereum', '#', NULL, 'ETH', NULL, 'logo_5ac45c56095cf.png', 4, 1, NULL, NULL, '2018-04-04 09:02:14'),
(2, 0, NULL, 3, 'Ripple', 'percentage', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', 1, 1, 1, 1, 1, '#', 'ripple', '#', NULL, 'XRP', NULL, 'logo_5ac45c40e907a.png', 4, 1, NULL, NULL, '2018-04-04 09:01:52'),
(3, 1, NULL, 3, 'AED', 'percentage', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '1.000000000000000000000000000000', '1.000000000000000000000000000000', '1.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', 1, 1, 1, 1, 0, '', '', NULL, NULL, 'AED', NULL, 'logo_5ac45cc1cc75d.png', 4, 1, NULL, NULL, '2018-04-04 09:04:01'),
(4, 0, NULL, 3, 'Bitcoin', 'percentage', '0.000000000000000000000000000000', '20.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '1.000000000000000000000000000000', '0.000000000000000000000000000000', '500.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', 0, 1, 1, 1, 1, '0d50-e232-3233-4cb9', 'bitcoin', '32HpKz8HXGa7y7yegMnuuRAXTe3VBaVtsK', NULL, 'BTC', NULL, 'logo_5ac45c1b8c1a5.png', 4, 1, NULL, NULL, '2018-04-04 09:01:15'),
(5, 0, NULL, 3, 'Litecoin', 'percentage', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', 1, 1, 1, 1, 1, 'b20b-c3ae-045f-9102', 'litecoin', '3G33A3Sk6i4MwSaPjp26i7qrgwQtXtW1D1', NULL, 'LTC', NULL, 'logo_5ac45c295e6bf.png', 4, 1, NULL, NULL, '2018-04-04 09:01:29'),
(6, 0, NULL, 3, 'Dogecoin', 'percentage', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', 0, 0, 0, 0, 1, '1111111', 'dogecoin', '111111', NULL, 'DOGE', NULL, NULL, 4, 0, NULL, NULL, '2018-03-19 03:26:44');

-- --------------------------------------------------------

--
-- Table structure for table `trade_history`
--

CREATE TABLE IF NOT EXISTS `trade_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `trade_currency_id` int(11) DEFAULT NULL,
  `reference` int(11) DEFAULT NULL,
  `type` enum('deposit','withdrawal') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'deposit',
  `transaction_id` text COLLATE utf8_unicode_ci,
  `amount` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `total` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trade_history_id_index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `trade_history`
--

INSERT INTO `trade_history` (`id`, `user_id`, `trade_currency_id`, `reference`, `type`, `transaction_id`, `amount`, `fee`, `total`, `created_at`, `updated_at`) VALUES
(1, 2, 4, NULL, 'deposit', 'dd6af56c5f0ef6b20216289e0f0bfa1c02fad7079ab1a0f0ba776ff2116b8c6c', '7480.000000000000000000000000000000', '70.000000000000000000000000000000', '7550.000000000000000000000000000000', '2018-03-20 13:07:36', '2018-03-20 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_type` enum('id_card','passport','driver_license') COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_picture` text COLLATE utf8_unicode_ci,
  `proof_of_residence_type` enum('bank_statement','utility_bill') COLLATE utf8_unicode_ci DEFAULT NULL,
  `proof_of_residence_picture` text COLLATE utf8_unicode_ci,
  `email_verified` tinyint(4) NOT NULL DEFAULT '0',
  `phone_verified` tinyint(4) NOT NULL DEFAULT '0',
  `documents_verified` tinyint(4) NOT NULL DEFAULT '0',
  `subscribed` tinyint(4) NOT NULL DEFAULT '0',
  `blocked` tinyint(4) NOT NULL DEFAULT '0',
  `referral_id` int(11) DEFAULT NULL,
  `status` enum('active','inactive','banned') COLLATE utf8_unicode_ci DEFAULT NULL,
  `wallet_address_limit` int(11) NOT NULL DEFAULT '1',
  `default_balance` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `bitcoin_balance` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `litecoin_balance` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `dodgecoin_balance` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `otp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `permissions`, `last_login`, `name`, `first_name`, `last_name`, `address`, `phone`, `city`, `gender`, `dob`, `country_id`, `zip`, `id_type`, `id_number`, `id_picture`, `proof_of_residence_type`, `proof_of_residence_picture`, `email_verified`, `phone_verified`, `documents_verified`, `subscribed`, `blocked`, `referral_id`, `status`, `wallet_address_limit`, `default_balance`, `bitcoin_balance`, `litecoin_balance`, `dodgecoin_balance`, `otp`, `notes`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin@admin.com', '$2y$10$AM5T.uEtxl1Er5JU8dRy9.s8SDgOe/wdBiyhbngT/GWgV1tbDlctq', NULL, '2018-04-04 10:06:34', 'Admin', 'Admin', 'Admin', NULL, NULL, NULL, 'male', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, NULL, NULL, 1, '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', NULL, NULL, '2018-03-05 13:02:22', '2018-04-04 10:06:34'),
(2, NULL, 'test1@test.com', '$2y$10$SKdlsmSya7q8u.B6oOglge3vIOUfHtzYhtfymFEYT.P0w005q1PVi', NULL, '2018-04-04 10:17:55', NULL, 'Monark', 'Modi', '123 Admin', '1234567890', 'Dubai', 'male', '1990-02-14', '229', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, NULL, NULL, 1, '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '20249', NULL, '2018-03-15 11:36:21', '2018-04-04 10:17:55'),
(3, NULL, 'test3@test.com', '$2y$10$M1IxmzduW38Qw.KwhfGloOM7vM8dofl.sA19Zbuy5YDlb1wRqzOvO', NULL, '2018-03-29 05:36:49', NULL, 'Monark', 'Modi', '123 Admin', '4132759344', 'Sunderland', 'male', '1990-02-14', '1', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, NULL, 1, '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '0.000000000000000000000000000000', '20832', NULL, '2018-03-29 05:33:38', '2018-03-29 05:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_bank_accounts`
--

CREATE TABLE IF NOT EXISTS `user_bank_accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `withdrawal_method_id` int(11) DEFAULT NULL,
  `default_account` tinyint(4) NOT NULL DEFAULT '0',
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agency_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_bank_accounts`
--

INSERT INTO `user_bank_accounts` (`id`, `user_id`, `withdrawal_method_id`, `default_account`, `account_name`, `bank_name`, `agency_number`, `account_number`, `cpf_number`, `notes`, `active`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 0, 'BOA', 'Bank of America', '0000000000', '1234554321', NULL, NULL, 1, '2018-03-20 12:34:26', '2018-03-20 13:15:13');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_addresses`
--

CREATE TABLE IF NOT EXISTS `wallet_addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `trade_currency_id` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wallet_addresses_id_index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `wallet_addresses`
--

INSERT INTO `wallet_addresses` (`id`, `user_id`, `trade_currency_id`, `address`, `current`, `created_at`, `updated_at`) VALUES
(1, 2, 4, '2N6MfS6yTfm5m4PgnV39fqtsiCJjhpuM8rC', 1, '2018-03-15 11:54:08', '2018-03-15 11:54:08'),
(2, 2, 5, '2Mx5b7snqdECUtQou6gieRoCxyjqMM6t25T', 1, '2018-03-15 11:58:00', '2018-03-15 11:58:00'),
(3, 3, 4, '2NDPChVQoyd2VTSAfTRN32DoNJ1BUC5baSc', 1, '2018-03-29 05:33:39', '2018-03-29 05:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE IF NOT EXISTS `withdrawals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` text COLLATE utf8_unicode_ci,
  `residential_address` text COLLATE utf8_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `trade_currency_id` int(11) DEFAULT NULL,
  `withdrawal_method_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `amount` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `total` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `status` enum('pending','processing','cancelled','done') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `network` enum('usd','bitcoin','litecoin','dogecoin','ethereum','ripple') COLLATE utf8_unicode_ci DEFAULT 'usd',
  `sender_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receiver_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `otp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_bank_account_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `withdrawals_id_index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `account_name`, `account_number`, `address`, `transaction_id`, `residential_address`, `user_id`, `trade_currency_id`, `withdrawal_method_id`, `name`, `amount`, `fee`, `total`, `status`, `network`, `sender_address`, `receiver_address`, `notes`, `otp`, `created_at`, `updated_at`, `user_bank_account_id`) VALUES
(1, 'BTC Deposit', '1', '2N6MfS6yTfm5m4PgnV39fqtsiCJjhpuM8rC', 'dd6af56c5f0ef6b20216289e0f0bfa1c', '123 Commonwealth Ave', 2, 4, 1, NULL, '0.100000000000000000000000000000', '0.005000000000000000000000000000', '0.105000000000000000000000000000', 'done', 'usd', 'dd6af56c5f0ef6b20216289e0f0bfa1', 'dd6af56c5f0ef6b20216289e0f0bfa1c...', NULL, NULL, '2018-03-20 04:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_methods`
--

CREATE TABLE IF NOT EXISTS `withdrawal_methods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `logo` text COLLATE utf8_unicode_ci,
  `fee_method` enum('fixed','percentage','both') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'percentage',
  `fixed_fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `percentage_fee` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `minimum_amount` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `maximum_amount` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `notes` text COLLATE utf8_unicode_ci,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `withdrawal_methods_id_index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `withdrawal_methods`
--

INSERT INTO `withdrawal_methods` (`id`, `system`, `name`, `user_id`, `logo`, `fee_method`, `fixed_fee`, `percentage_fee`, `minimum_amount`, `maximum_amount`, `notes`, `active`, `created_at`, `updated_at`) VALUES
(1, 0, 'Bank Transfer', 2, NULL, 'fixed', '20.000000000000000000000000000000', '0.000000000000000000000000000000', '1000.000000000000000000000000000000', '10000.000000000000000000000000000000', NULL, 1, '2018-03-20 13:12:32', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
