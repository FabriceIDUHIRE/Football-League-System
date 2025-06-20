-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 07:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rwandan_league`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `created_at`, `updated_at`, `team_id`) VALUES
(2, 'd', 'dkscbudjsobcnl', '2025-03-23 12:28:54', '2025-03-23 12:28:54', NULL),
(3, 'aaa', 'aaaaaaaaaaaaaaaa', '2025-03-25 06:57:36', '2025-03-25 06:57:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `player_id` bigint(20) UNSIGNED NOT NULL,
  `selling_team_id` bigint(20) UNSIGNED NOT NULL,
  `buying_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bid_amount` decimal(10,2) NOT NULL,
  `status` enum('Pending','Accepted','Rejected','Negotiating') NOT NULL DEFAULT 'Pending',
  `expiry_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `buying_team_message` text DEFAULT NULL,
  `selling_team_message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `player_id`, `selling_team_id`, `buying_team_id`, `bid_amount`, `status`, `expiry_date`, `created_at`, `updated_at`, `buying_team_message`, `selling_team_message`) VALUES
(11, 16, 2, 1, 90000000.00, 'Accepted', NULL, '2025-04-04 06:58:22', '2025-04-04 10:15:34', 'qqqqqqq', 'nooooo'),
(22, 14, 2, 10, 30000000.00, 'Pending', NULL, '2025-04-04 10:25:44', '2025-04-04 10:25:44', NULL, NULL);

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`id`, `name`, `team_id`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 1, '2025-02-16 20:21:00', '2025-02-16 20:21:00'),
(2, 'Jane Smith', 2, '2025-02-16 20:21:00', '2025-02-16 20:21:00'),
(3, 'Michael Johnson', 3, '2025-02-16 20:21:00', '2025-02-16 20:21:00'),
(4, 'Chris Williams', 4, '2025-02-16 20:21:00', '2025-02-16 20:21:00'),
(5, 'Sarah Brown', 5, '2025-02-16 20:21:00', '2025-02-16 20:21:00'),
(6, 'David Lee', 6, '2025-02-16 20:21:00', '2025-02-16 20:21:00'),
(7, 'Rebecca Miller', 7, '2025-02-16 20:21:00', '2025-02-16 20:21:00'),
(8, 'James Taylor', 8, '2025-02-16 20:21:00', '2025-02-16 20:21:00'),
(9, 'Laura Wilson', 9, '2025-02-16 20:21:00', '2025-02-16 20:21:00'),
(10, 'Daniel Martinez', 10, '2025-02-16 20:21:00', '2025-02-16 20:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `coach_team`
--

CREATE TABLE `coach_team` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coach_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `player_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `contract_status` enum('active','expired','terminated') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_pre_contract` tinyint(1) NOT NULL DEFAULT 0,
  `pre_contract_start_date` date DEFAULT NULL,
  `transfer_window_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`id`, `player_id`, `team_id`, `start_date`, `end_date`, `salary`, `contract_status`, `created_at`, `updated_at`, `is_pre_contract`, `pre_contract_start_date`, `transfer_window_id`) VALUES
(1, 4, 2, '2025-03-17', '2028-08-17', 700000.00, 'terminated', '2025-03-18 06:58:11', '2025-03-18 07:35:33', 0, NULL, NULL),
(2, 10, 2, '2025-03-17', '2030-10-21', 890510.00, 'active', '2025-03-18 07:35:20', '2025-03-18 07:35:20', 0, NULL, NULL),
(3, 1, 3, '2025-03-27', '2025-04-04', 111.00, 'active', '2025-03-28 13:17:30', '2025-03-28 13:17:30', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `team_id`, `name`, `specialization`, `contact_info`, `created_at`, `updated_at`) VALUES
(1, 4, 'Umuganda Stadium', 'qqq', 'qqqqq', '2025-02-27 10:41:30', '2025-02-27 10:41:30'),
(2, 4, 'www', 'www', 'ww', '2025-02-27 10:54:08', '2025-02-27 10:54:08'),
(3, 2, 'Fabrice IDUHIRE', 'rrrqq', 'rrrr', '2025-03-18 00:07:45', '2025-03-28 14:51:29'),
(4, 2, 'Dr. Aiden Carter', 'Cardiologist', 'aiden.carter@hospital.com, +250 789 123 456', '2025-03-18 00:09:50', '2025-03-18 00:09:50'),
(5, 2, 'Dr. Sophia Kim', 'Neurologist', 'sophia.kim@hospital.com, +250 788 654 321', '2025-03-18 00:10:17', '2025-03-18 00:10:17'),
(6, 2, 'Dr. James Nkurunziza', 'Orthopedic Surgeon', 'james.nkurunziza@hospital.com, +250 787 345 678', '2025-03-18 00:10:50', '2025-03-18 00:10:50'),
(7, 2, 'Dr. Olivia Mbonyumutwa', 'Pediatrician', 'olivia.mbon@hospital.com, +250 786 567 890', '2025-03-18 00:11:18', '2025-03-18 00:11:18'),
(8, 2, 'Dr. Ethan Mugisha', 'General Surgeon', 'ethan.mugisha@hospital.com, +250 785 987 654', '2025-03-18 00:11:45', '2025-03-18 00:11:45'),
(9, 10, 'Mandy', 'Pediatrician', 'james.nkurunziza@hospital.com, +250 787 345 678', '2025-03-21 12:17:20', '2025-03-21 12:17:20'),
(10, 3, 'qq', 'Pediatrician', 'james.nkurunziza@hospital.com, +250 787 345 678', '2025-03-28 13:11:28', '2025-03-28 13:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `fan_engagement`
--

CREATE TABLE `fan_engagement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `activity_description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fan_team`
--

CREATE TABLE `fan_team` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fan_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `team_id`, `created_at`, `updated_at`) VALUES
(1, 'IDUHIRE Fabrice', 'princebuingo2@gmail.com', 'Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development to fill empty spaces in a layout that does not yet have content. It consists of a sequence of Latin words that do not form complete sentences but serve as placeholders until actual content is added.\r\nWikipedia', 3, '2025-03-27 06:53:22', '2025-03-27 06:53:22'),
(2, 'IDUHIRE Fabrice', 'fabriceiduhire@gmail.com', 'Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development to fill empty spaces in a layout that does not yet have content. It consists of a sequence of Latin words that do not form complete sentences but serve as placeholders until actual content is added.\r\nWikipedia', 1, '2025-03-27 07:29:43', '2025-03-27 07:29:43'),
(3, 'John Doe', 'johndoe@gmail.com', 'k7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcvk7jntbhrgvcfdxvbnmnbhgvcfcv', 3, '2025-03-27 10:18:58', '2025-03-27 10:18:58'),
(4, 'Moe', 'moe@gmail.com', 'hbhvmsvchwdbfbekcbcvbbsdvjhvwdvcyuwevcdhvs', 2, '2025-04-15 07:25:45', '2025-04-15 07:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `financials`
--

CREATE TABLE `financials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `transaction_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE `fixtures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home_team_id` bigint(20) UNSIGNED NOT NULL,
  `away_team_id` bigint(20) UNSIGNED NOT NULL,
  `stadium_id` bigint(20) UNSIGNED NOT NULL,
  `match_category_id` bigint(20) UNSIGNED NOT NULL,
  `match_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match_id` bigint(20) UNSIGNED NOT NULL,
  `player_id` bigint(20) UNSIGNED NOT NULL,
  `team_type` enum('home','away') NOT NULL,
  `minute` int(11) NOT NULL,
  `injury` varchar(255) DEFAULT NULL,
  `card` enum('yellow','red') DEFAULT NULL,
  `goal_scored` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `match_id`, `player_id`, `team_type`, `minute`, `injury`, `card`, `goal_scored`, `created_at`, `updated_at`) VALUES
(27, 10, 1, 'home', 12, NULL, 'yellow', 0, '2025-04-12 17:27:47', '2025-04-12 17:27:47'),
(28, 10, 1, 'home', 38, NULL, NULL, 1, '2025-04-12 17:28:12', '2025-04-12 17:28:12'),
(29, 10, 9, 'away', 54, NULL, 'yellow', 0, '2025-04-12 17:28:47', '2025-04-12 17:28:47'),
(30, 10, 5, 'away', 62, NULL, NULL, 1, '2025-04-12 17:29:15', '2025-04-12 17:29:15'),
(31, 10, 5, 'away', 71, NULL, NULL, 1, '2025-04-12 17:29:39', '2025-04-12 17:29:39'),
(32, 10, 5, 'away', 88, NULL, NULL, 1, '2025-04-12 17:30:03', '2025-04-12 17:30:03'),
(33, 10, 5, 'away', 90, 'Muscle', NULL, 0, '2025-04-12 17:30:25', '2025-04-12 17:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `historical_teams`
--

CREATE TABLE `historical_teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `historical_season` varchar(255) NOT NULL,
  `reason` text DEFAULT NULL,
  `historical_date` date NOT NULL,
  `final_position` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `injuries`
--

CREATE TABLE `injuries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `player_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `injury_type` varchar(255) NOT NULL,
  `severity` enum('minor','moderate','severe') NOT NULL DEFAULT 'minor',
  `injury_date` date NOT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `expected_recovery_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `injuries`
--

INSERT INTO `injuries` (`id`, `player_id`, `team_id`, `injury_type`, `severity`, `injury_date`, `doctor_id`, `expected_recovery_date`, `notes`, `created_at`, `updated_at`) VALUES
(11, 11, 2, 'Muscle', 'moderate', '2025-04-09', 5, '2025-05-07', 'aaaaaaaaaaaaaaaaaaaaaaaaaa', '2025-04-10 06:33:42', '2025-04-10 06:34:39');

-- --------------------------------------------------------

--
-- Table structure for table `league_table`
--

CREATE TABLE `league_table` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `points` int(11) NOT NULL,
  `matches_played` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `draws` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lineups`
--

CREATE TABLE `lineups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `formation` varchar(255) NOT NULL,
  `player_ids` text NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `substitute_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`substitute_ids`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lineups`
--

INSERT INTO `lineups` (`id`, `match_id`, `team_id`, `formation`, `player_ids`, `created_at`, `updated_at`, `substitute_ids`) VALUES
(12, 6, 2, '4-3-3', '', '2025-03-26 16:26:11', '2025-03-26 16:26:11', NULL),
(13, 6, 2, '4-3-3', '', '2025-03-30 12:04:22', '2025-03-30 12:04:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lineup_players`
--

CREATE TABLE `lineup_players` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lineup_id` bigint(20) UNSIGNED NOT NULL,
  `player_id` bigint(20) UNSIGNED NOT NULL,
  `position_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lineup_players`
--

INSERT INTO `lineup_players` (`id`, `lineup_id`, `player_id`, `position_type`, `created_at`, `updated_at`) VALUES
(78, 12, 14, 'Starting', '2025-03-26 16:26:11', '2025-03-26 16:26:11'),
(79, 12, 10, 'Starting', '2025-03-26 16:26:11', '2025-03-26 16:26:11'),
(80, 12, 2, 'Starting', '2025-03-26 16:26:11', '2025-03-26 16:26:11'),
(81, 12, 7, 'Starting', '2025-03-26 16:26:11', '2025-03-26 16:26:11'),
(82, 12, 9, 'Starting', '2025-03-26 16:26:11', '2025-03-26 16:26:11'),
(83, 12, 15, 'Starting', '2025-03-26 16:26:11', '2025-03-26 16:26:11'),
(84, 12, 16, 'Starting', '2025-03-26 16:26:11', '2025-03-26 16:26:11'),
(85, 12, 17, 'Starting', '2025-03-26 16:26:11', '2025-03-26 16:26:11'),
(86, 12, 5, 'Starting', '2025-03-26 16:26:11', '2025-03-26 16:26:11'),
(87, 12, 6, 'Starting', '2025-03-26 16:26:11', '2025-03-26 16:26:11'),
(88, 12, 12, 'Starting', '2025-03-26 16:26:11', '2025-03-26 16:26:11'),
(89, 13, 14, 'Starting', '2025-03-30 12:04:22', '2025-03-30 12:04:22'),
(90, 13, 7, 'Starting', '2025-03-30 12:04:22', '2025-03-30 12:04:22'),
(91, 13, 9, 'Starting', '2025-03-30 12:04:22', '2025-03-30 12:04:22'),
(92, 13, 10, 'Starting', '2025-03-30 12:04:22', '2025-03-30 12:04:22'),
(93, 13, 11, 'Starting', '2025-03-30 12:04:22', '2025-03-30 12:04:22'),
(94, 13, 15, 'Starting', '2025-03-30 12:04:22', '2025-03-30 12:04:22'),
(95, 13, 17, 'Starting', '2025-03-30 12:04:22', '2025-03-30 12:04:22'),
(96, 13, 16, 'Starting', '2025-03-30 12:04:22', '2025-03-30 12:04:22'),
(97, 13, 6, 'Starting', '2025-03-30 12:04:22', '2025-03-30 12:04:22'),
(98, 13, 5, 'Starting', '2025-03-30 12:04:22', '2025-03-30 12:04:22'),
(99, 13, 12, 'Starting', '2025-03-30 12:04:22', '2025-03-30 12:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `loan_deals`
--

CREATE TABLE `loan_deals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `player_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `receiving_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `loan_start_date` date NOT NULL,
  `loan_end_date` date NOT NULL,
  `has_buy_clause` tinyint(1) NOT NULL DEFAULT 0,
  `buy_clause_fee` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_deals`
--

INSERT INTO `loan_deals` (`id`, `player_id`, `team_id`, `receiving_team_id`, `loan_start_date`, `loan_end_date`, `has_buy_clause`, `buy_clause_fee`, `created_at`, `updated_at`) VALUES
(1, 12, 2, 10, '2025-04-04', '2025-05-08', 0, NULL, '2025-04-05 01:52:42', '2025-04-07 11:39:40'),
(2, 15, 2, NULL, '2025-04-04', '2025-05-13', 1, 55534555.00, '2025-04-05 01:53:15', '2025-04-05 01:53:15');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manager_team`
--

CREATE TABLE `manager_team` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manager_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matchs`
--

CREATE TABLE `matchs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match_date` datetime NOT NULL,
  `stadium_id` bigint(20) UNSIGNED NOT NULL,
  `home_team_id` bigint(20) UNSIGNED NOT NULL,
  `away_team_id` bigint(20) UNSIGNED NOT NULL,
  `referee_id` bigint(20) UNSIGNED NOT NULL,
  `assistant_referee1_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assistant_referee2_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fourth_referee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `match_commissioner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `match_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matchs`
--

INSERT INTO `matchs` (`id`, `match_date`, `stadium_id`, `home_team_id`, `away_team_id`, `referee_id`, `assistant_referee1_id`, `assistant_referee2_id`, `fourth_referee_id`, `match_commissioner_id`, `match_category_id`, `created_at`, `updated_at`) VALUES
(2, '2025-02-28 19:16:00', 1, 6, 9, 1, 4, 8, 2, 1, 4, '2025-02-18 15:23:51', '2025-02-18 15:23:51'),
(3, '2025-02-25 14:06:00', 3, 5, 8, 7, 9, 4, 7, 3, 1, '2025-02-25 10:07:04', '2025-02-25 10:07:04'),
(6, '2025-03-27 16:00:00', 1, 2, 10, 8, 9, 8, 5, 3, 1, '2025-02-25 12:56:14', '2025-02-25 12:56:14'),
(7, '2025-03-20 18:30:00', 2, 1, 2, 8, 4, 8, 5, 2, 1, '2025-03-21 12:25:32', '2025-03-21 12:25:32'),
(10, '2025-04-12 17:30:00', 1, 3, 2, 3, 4, 8, 7, 2, 1, '2025-04-11 05:45:56', '2025-04-12 17:06:33'),
(11, '2025-04-12 15:15:00', 4, 1, 3, 6, 4, 8, 5, 3, 1, '2025-04-12 17:08:59', '2025-04-12 17:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `match_categories`
--

CREATE TABLE `match_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `match_categories`
--

INSERT INTO `match_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Primier League', NULL, '2025-02-07 07:59:07', '2025-02-09 14:45:07'),
(2, 'CAF Champions League', NULL, '2025-02-07 07:59:07', '2025-02-09 14:43:47'),
(3, 'CHAN', NULL, '2025-02-07 07:59:07', '2025-02-09 14:44:09'),
(4, 'Friendly Match', NULL, '2025-02-09 14:44:36', '2025-02-09 14:44:36');

-- --------------------------------------------------------

--
-- Table structure for table `match_commissioners`
--

CREATE TABLE `match_commissioners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `match_commissioners`
--

INSERT INTO `match_commissioners` (`id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'IDUHIRE Fabrice', 'fabriceiduhire@gmail.com', '0784661878', NULL, '2025-03-22 08:54:18', '2025-03-22 08:54:18'),
(2, 'Prince Buingo', 'princebuingo2@gmail.com', '0784661878', NULL, '2025-03-22 08:55:18', '2025-03-22 08:55:18'),
(3, 'JOHN Doe', 'json76554@gmail.com', '0789220813', NULL, '2025-03-22 08:55:54', '2025-03-22 08:55:54');

-- --------------------------------------------------------

--
-- Table structure for table `match_lineup`
--

CREATE TABLE `match_lineup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match_id` bigint(20) UNSIGNED NOT NULL,
  `player_id` bigint(20) UNSIGNED NOT NULL,
  `position` enum('Goalkeeper','Defender','Midfielder','Forward') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `match_results`
--

CREATE TABLE `match_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `goals_home_team` int(11) NOT NULL DEFAULT 0,
  `goals_away_team` int(11) NOT NULL DEFAULT 0,
  `yellow_cards_home_team` int(11) NOT NULL DEFAULT 0,
  `yellow_cards_away_team` int(11) NOT NULL DEFAULT 0,
  `red_cards_home_team` int(11) NOT NULL DEFAULT 0,
  `red_cards_away_team` int(11) NOT NULL DEFAULT 0,
  `shots_on_target_home_team` int(11) NOT NULL DEFAULT 0,
  `shots_on_target_away_team` int(11) NOT NULL DEFAULT 0,
  `shots_off_target_home_team` int(11) NOT NULL DEFAULT 0,
  `shots_off_target_away_team` int(11) NOT NULL DEFAULT 0,
  `possession_home_team` int(11) NOT NULL DEFAULT 0,
  `possession_away_team` int(11) NOT NULL DEFAULT 0,
  `injured_players_home_team` int(11) NOT NULL DEFAULT 0,
  `injured_players_away_team` int(11) NOT NULL DEFAULT 0,
  `substitutions_home_team` int(11) NOT NULL DEFAULT 0,
  `substitutions_away_team` int(11) NOT NULL DEFAULT 0,
  `assists_home_team` int(11) NOT NULL DEFAULT 0,
  `assists_away_team` int(11) NOT NULL DEFAULT 0,
  `fourth_referee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `referee_assessor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `match_commissioner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `home_team_id` bigint(20) UNSIGNED NOT NULL,
  `away_team_id` bigint(20) UNSIGNED NOT NULL,
  `referee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assistant_referee_1_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assistant_referee_2_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `match_summary_view`
-- (See below for the actual view)
--
CREATE TABLE `match_summary_view` (
`match_id` bigint(20) unsigned
,`total_injuries` bigint(21)
,`total_cards` bigint(21)
,`yellow_cards` bigint(21)
,`red_cards` bigint(21)
,`total_goals` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2025_01_30_181212_create_roles_table', 1),
(2, '2025_01_20_100630_create_teamss_table', 2),
(3, '2025_01_10_235613_create_stadiums_table', 3),
(4, '2025_01_21_125304_create_categories_table', 4),
(5, '2025_01_09_235525_create_announcements_table', 5),
(6, '2025_01_13_015617_create_sponsors_table', 6),
(7, '2025_01_21_182045_create_tickets_table', 7),
(8, '2025_01_29_143843_create_doctors_table', 8),
(9, '2025_01_29_143855_create_notifications_table', 9),
(10, '0001_01_01_000000_create_users_table', 10),
(11, '2025_01_30_181526_create_role_user_table', 11),
(12, '2025_01_11_041319_create_match_categories_table', 12),
(13, '2025_01_22_123546_create_fixtures_table', 13),
(14, '2025_02_06_075430_create_players_table', 14),
(15, '2025_01_09_235156_create_matchs_table', 15),
(16, '2025_02_06_082053_create_revenues_table', 16),
(17, '2025_01_10_225230_create_financials_table', 17),
(18, '2025_02_06_083129_create_staff_table', 18),
(19, '2025_02_06_083239_create_referees_table', 19),
(20, '2025_02_06_083311_create_media_table', 20),
(21, '2025_02_06_083351_create_managers_table', 21),
(22, '2025_02_06_083416_create_league_table', 22),
(23, '2025_02_06_083445_create_fan_engagement_table', 23),
(26, '2025_02_06_083520_create_coaches_table', 24),
(27, '2025_02_06_084430_update_teamss_table', 24),
(28, '2025_01_30_175327_update_users_table', 25),
(29, '2025_01_30_184905_add_team_id_to_users_table', 26),
(30, '2025_01_13_171512_add_location_and_capacity_to_stadiums_table', 27),
(31, '2025_02_06_140444_add_role_to_users_table', 28),
(32, '2025_01_22_105524_add_status_to_tickets_table', 29),
(33, '2025_01_22_103003_update_price_column_in_tickets_table', 30),
(34, '2025_01_22_100507_add_match_category_id_to_fixtures_table', 31),
(35, '2025_02_07_152856_add_user_id_to_teamss_table', 32),
(36, '2025_02_09_165548_add_home_away_teams_to_tickets', 33),
(37, '2025_02_09_180511_add_foreign_keys_to_tickets_table', 34),
(38, '2025_02_14_155114_add_status_to_users_table', 35),
(39, '2025_02_14_160908_create_cache_table', 36),
(40, '2025_02_14_170132_create_punishments_table', 37),
(41, '2025_02_14_174342_add_team_id_to_punishments_table', 38),
(42, '2025_02_14_180820_rename_description_to_reason_in_punishments_table', 39),
(43, '2025_02_14_180944_add_start_date_to_punishments_table', 40),
(44, '2025_02_16_184313_add_roles_to_punishments_table', 41),
(45, '2025_02_16_184517_modify_user_id_nullable_in_punishments', 42),
(46, '2025_02_16_194008_update_punishments_table', 43),
(47, '2025_02_18_180309_create_posts_table', 44),
(48, '2025_02_28_144110_add_jersey_number_to_players_table', 45),
(49, '2025_02_28_153238_create_player_performances_table', 46),
(50, '2025_02_28_153837_create_performances_table', 47),
(51, '2025_02_28_163408_create_team_performance_table', 48),
(52, '2025_02_28_163412_create_goals_table', 48),
(53, '2025_02_28_164516_add_team_and_cards_to_player_performances', 49),
(54, '2025_02_28_191344_add_yellow_cards_and_red_cards_to_performances', 50),
(55, '2025_03_02_180944_add_matches_played_and_minutes_played_to_player_performances_table', 51),
(56, '2025_03_07_102024_create_contracts_table', 52),
(57, '2025_03_07_102101_create_injuries_table', 52),
(58, '2025_03_07_102159_create_lineups_table', 52),
(59, '2025_03_07_104605_create_coach_team_table', 52),
(60, '2025_03_07_104605_create_player_team_table', 52),
(61, '2025_03_07_104607_create_staff_team_table', 52),
(62, '2025_03_07_104608_create_sponsorships_table', 52),
(63, '2025_03_07_104609_create_manager_team_table', 52),
(64, '2025_03_07_105659_create_historical_teams_table', 52),
(65, '2025_03_07_110622_create_transfers_table', 52),
(66, '2025_03_07_112140_create_fan_team_table', 52),
(67, '2025_03_07_112149_create_player_injury_table', 52),
(68, '2025_03_07_112208_create_match_lineup_table', 52),
(69, '2025_03_07_112248_create_punishment_player_table', 52),
(70, '2025_03_07_112254_create_punishment_coach_table', 52),
(71, '2025_03_07_112301_create_staff_team_bridge_table', 52),
(72, '2025_03_07_112324_create_player_transfer_table', 52),
(73, '2025_03_07_115641_create_match_results_table', 52),
(74, '2025_03_07_122338_update_match_results_table', 52),
(75, '2025_03_07_130636_add_type_to_referees_table', 52),
(76, '2025_03_07_140944_add_home_away_team_ids_to_match_results', 52),
(77, '2025_03_11_075910_add_referee_assessor_and_match_commissioner_to_match_results', 52),
(78, '2025_03_11_084755_create_match_commissioners_table', 52),
(79, '2025_03_11_094320_add_referee_columns_to_match_results_table', 52),
(80, '2025_03_14_031007_add_formation_to_lineups', 53),
(81, '2025_03_14_042920_create_lineup_players_table', 54),
(82, '2025_03_14_183428_create_lineups_table', 55),
(83, '2025_03_14_183521_create_lineup_players_table', 55),
(84, '2025_03_14_191741_create_lineups_table', 56),
(85, '2025_03_14_191804_create_lineup_players_table', 56),
(86, '2025_03_14_203156_update_player_ids_in_lineups_table', 57),
(87, '2025_03_17_192738_add_substitute_ids_to_lineups_table', 58),
(88, '2025_03_17_192758_add_position_type_to_lineup_players_table', 59),
(89, '2025_03_18_000935_add_status_to_contracts_table', 60),
(90, '2025_03_18_191108_add_notified_to_transfers_table', 61),
(91, '2025_03_19_171114_add_injury_and_card_to_goals_table', 62),
(92, '2025_03_19_171729_create_match_views', 63),
(93, '2025_03_19_174333_add_goal_scored_to_goals_table', 64),
(94, '2025_03_19_222809_add_away_team_and_goals_conceded_to_goals_table', 65),
(95, '2025_03_20_014318_modify_team_and_away_team_nullable_on_goals_table', 66),
(96, '2025_03_20_184140_remove_goals_conceded_from_goals_table', 67),
(97, '2025_03_21_174611_add_previous_team_id_to_players_table', 68),
(98, '2025_03_21_191900_update_sponsors_table_remove_team_id_add_user_id', 69),
(99, '2025_03_21_201907_update_sponsors_table_remove_user_id_add_team_id', 70),
(100, '2025_03_21_204121_add_user_id_to_sponsors_table', 71),
(101, '2025_03_22_021613_add_referees_and_commissioner_to_matchs_table', 72),
(102, '2025_03_22_040808_create_transfer_windows_table', 73),
(103, '2025_03_22_042324_create_transfer_windows_table', 74),
(104, '2025_03_23_060007_add_team_and_doctor_to_injuries_table', 75),
(105, '2025_03_26_042607_remove_team_id_from_goals', 76),
(106, '2025_03_26_064713_create_team_standings_view', 77),
(107, '2025_03_26_072939_update_team_standings_view', 78),
(108, '2025_03_26_201047_add_image_to_sponsors_table', 79),
(109, '2025_03_26_224737_add_logo_to_sponsors_table', 80),
(110, '2025_03_26_232246_create_feedback_table', 81),
(111, '2025_03_31_012225_add_image_to_sponsors_table', 82),
(112, '2025_03_31_033753_add_image_to_players_table', 83),
(113, '2025_03_31_050737_add_logo_to_sponsors_table', 84),
(114, '2025_04_01_195506_add_lineup_to_posts_table', 85),
(115, '2025_04_03_225849_create_bids_table', 86),
(116, '2025_04_04_000955_add_message_to_bids_table', 87),
(117, '2025_04_04_025509_add_team_messages_to_bids_table', 88),
(118, '2025_04_04_061249_add_expiry_date_to_bids_table', 89),
(119, '2025_04_04_180446_add_pre_contract_columns_to_contracts_table', 90),
(120, '2025_04_04_181032_create_loan_deals_table', 91),
(121, '2025_04_07_035739_add_receiving_team_id_to_loan_deals_table', 92);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `performances`
--

CREATE TABLE `performances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `wins` int(11) NOT NULL DEFAULT 0,
  `losses` int(11) NOT NULL DEFAULT 0,
  `draws` int(11) NOT NULL DEFAULT 0,
  `goals_scored` int(11) NOT NULL DEFAULT 0,
  `goals_conceded` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `yellow_cards` int(11) NOT NULL DEFAULT 0,
  `red_cards` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `performances`
--

INSERT INTO `performances` (`id`, `team_id`, `wins`, `losses`, `draws`, `goals_scored`, `goals_conceded`, `created_at`, `updated_at`, `yellow_cards`, `red_cards`) VALUES
(1, 1, 0, 0, 0, 0, 0, '2025-02-28 13:42:42', '2025-02-28 13:42:42', 0, 0),
(2, 2, 12, 2, 4, 34, 9, '2025-02-28 13:42:42', '2025-02-28 17:22:30', 7, 2),
(3, 3, 0, 0, 0, 0, 0, '2025-02-28 13:42:42', '2025-02-28 13:42:42', 0, 0),
(4, 4, 0, 0, 0, 0, 0, '2025-02-28 13:42:42', '2025-02-28 13:42:42', 0, 0),
(5, 5, 0, 0, 0, 0, 0, '2025-02-28 13:42:42', '2025-02-28 13:42:42', 0, 0),
(6, 6, 0, 0, 0, 0, 0, '2025-02-28 13:42:42', '2025-02-28 13:42:42', 0, 0),
(7, 7, 0, 0, 0, 0, 0, '2025-02-28 13:42:42', '2025-02-28 13:42:42', 0, 0),
(8, 8, 0, 0, 0, 0, 0, '2025-02-28 13:42:42', '2025-02-28 13:42:42', 0, 0),
(9, 9, 0, 0, 0, 0, 0, '2025-02-28 13:42:42', '2025-02-28 13:42:42', 0, 0),
(10, 10, 0, 0, 0, 0, 0, '2025-02-28 13:42:42', '2025-02-28 13:42:42', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `previous_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dob` date NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `jersey_number` int(11) DEFAULT NULL,
  `contract_start_date` date DEFAULT NULL,
  `contract_end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `position`, `team_id`, `previous_team_id`, `dob`, `nationality`, `jersey_number`, `contract_start_date`, `contract_end_date`, `created_at`, `updated_at`, `image`) VALUES
(1, 'John Doe', 'Defender', 3, NULL, '1994-01-28', 'Rwandan', 5, '2025-02-28', '2033-03-04', '2025-02-28 12:57:01', '2025-04-09 09:24:00', 'logos/67f5da40c0f01.png'),
(2, 'IDUHIRE Fabrice', 'Defender', 2, NULL, '2025-03-06', 'Rwandan', 5, '2024-10-14', '2027-09-23', '2025-03-02 15:36:15', '2025-03-31 11:44:06', 'logos/67ea1d960f129.png'),
(3, 'Manzi Thierry', 'Left Back', 10, NULL, '2023-06-06', 'Rwandan', 9, '2025-02-23', '2028-11-30', '2025-03-02 17:43:00', '2025-03-22 16:19:10', NULL),
(4, 'JOHN Doe', 'CB', 2, NULL, '1999-08-13', 'Rwandan', 4, '2025-03-01', '2026-02-26', '2025-03-14 10:51:59', '2025-03-31 11:44:19', 'logos/67ea1da3a3996.png'),
(5, 'Mutabazi Prince', 'Forward', 2, NULL, '2024-10-02', 'Rwandan', 7, '2024-06-13', '2027-09-14', '2025-03-15 00:28:37', '2025-04-05 06:28:52', 'logos/67f06b3483729.png'),
(6, 'Alain King', 'Forward', 2, NULL, '2024-02-06', 'Rwandan', 12, '2024-04-16', '2030-07-14', '2025-03-15 00:29:50', '2025-03-31 11:44:48', 'logos/67ea1dc07a463.png'),
(7, 'Varane', 'Defender', 2, NULL, '2023-06-14', 'France', 4, '2023-11-29', '2029-03-14', '2025-03-15 00:31:33', '2025-03-31 11:44:59', 'logos/67ea1dcb133d8.png'),
(8, 'Nevas', 'GoalKeeper', 2, NULL, '2000-09-14', 'Norway', 1, '2021-02-09', '2028-07-14', '2025-03-15 00:32:59', '2025-03-31 12:00:32', 'logos/67ea2170508f2.jpg'),
(9, 'Marcello', 'Defender', 1, NULL, '1999-07-14', 'Brazilian', 3, '2022-03-14', '2026-10-21', '2025-03-15 00:34:19', '2025-04-15 10:23:23', 'logos/67ea1de32bd44.png'),
(10, 'Pepe', 'Defender', 2, NULL, '1896-03-05', 'Portugal', 12, '2024-04-08', '2027-12-17', '2025-03-15 00:35:34', '2025-03-31 11:45:35', 'logos/67ea1def8d60a.png'),
(11, 'Antonio Rudiger', 'Defender', 2, NULL, '1889-03-05', 'Germany', 17, '2022-01-04', '2027-09-15', '2025-03-15 00:36:52', '2025-03-31 11:45:49', 'logos/67ea1dfd68cb9.png'),
(12, 'Karim', 'Forward', 2, NULL, '1899-03-05', 'France', 9, '2020-10-06', '2025-11-12', '2025-03-15 00:38:16', '2025-03-31 11:46:02', 'logos/67ea1e0a46e7a.png'),
(13, 'Mandy', 'Forward', 1, NULL, '2000-03-02', 'France', 21, '2025-03-18', '2026-02-16', '2025-03-15 00:39:25', '2025-03-19 02:55:37', NULL),
(14, 'Gishweka', 'GoalKeeper', 2, NULL, '1999-03-04', 'Rwandan', 30, '2020-03-01', '2025-07-02', '2025-03-15 00:40:23', '2025-03-31 11:58:55', 'logos/67ea210f49b6e.jpg'),
(15, 'Jude', 'MF', 2, NULL, '2001-03-06', 'England', 21, '2024-06-12', '2028-07-13', '2025-03-15 00:41:57', '2025-03-31 11:46:32', 'logos/67ea1e280c563.png'),
(16, 'Olmo', 'MF', 2, NULL, '2002-02-25', 'Spain', 19, '2024-11-19', '2028-02-29', '2025-03-18 00:13:41', '2025-03-31 11:46:45', 'logos/67ea1e3548169.png'),
(17, 'Rodri', 'MF', 2, NULL, '1998-03-07', 'Spain', 14, '2022-03-13', '2028-05-15', '2025-03-18 00:14:45', '2025-03-31 11:46:57', 'logos/67ea1e41101a7.png'),
(18, 'IRANZI Kevin', 'GoalKeeper', 1, NULL, '2000-01-18', 'Rwandan', 2, '2024-11-12', '2030-05-16', '2025-03-19 04:39:57', '2025-03-19 04:40:13', NULL),
(19, 'Jean Pierre', 'Goalkeeper', 10, NULL, '1995-06-12', 'Rwanda', 1, '2024-01-01', '2026-12-31', '2025-03-20 02:29:13', '2025-03-23 10:05:19', NULL),
(20, 'Didier Hakizimana', 'Defender', 10, NULL, '1998-04-23', 'Rwanda', 2, '2023-07-15', '2025-06-30', '2025-03-20 02:29:13', '2025-03-20 02:29:13', NULL),
(21, 'Eric Mugisha (C)', 'Defender', 10, NULL, '1997-09-14', 'Rwanda', 3, '2023-08-01', '2026-07-31', '2025-03-20 02:29:13', '2025-03-21 12:09:07', NULL),
(22, 'Patrick Ndizeye', 'Defender', 10, NULL, '1996-12-05', 'Rwanda', 4, '2024-02-01', '2027-01-31', '2025-03-20 02:29:13', '2025-03-20 02:29:13', NULL),
(23, 'Alex Twizeyimana', 'Midfielder', 10, NULL, '1999-03-19', 'Rwanda', 5, '2023-10-10', '2026-09-30', '2025-03-20 02:29:13', '2025-03-20 02:29:13', NULL),
(24, 'Claude Niyibizi', 'Midfielder', 10, NULL, '2000-07-07', 'Rwanda', 6, '2024-01-15', '2027-12-31', '2025-03-20 02:29:13', '2025-03-20 02:29:13', NULL),
(25, 'Emmanuel Nkurunziza', 'Midfielder', 10, NULL, '1998-11-22', 'Rwanda', 7, '2023-09-01', '2025-08-31', '2025-03-20 02:29:13', '2025-03-20 02:29:13', NULL),
(26, 'Alain Habimana', 'Forward', 10, NULL, '1997-05-30', 'Rwanda', 8, '2023-06-01', '2026-05-31', '2025-03-20 02:29:13', '2025-03-20 02:29:13', NULL),
(27, 'Fabrice Kwizera', 'Forward', 10, NULL, '2001-01-17', 'Rwanda', 9, '2024-03-01', '2027-02-28', '2025-03-20 02:29:13', '2025-03-20 02:29:13', NULL),
(28, 'Yannick Bizimana (C)', 'Forward', 10, NULL, '1999-08-21', 'Rwanda', 10, '2023-05-20', '2025-04-30', '2025-03-20 02:29:13', '2025-03-23 09:57:52', NULL),
(29, 'Olivier Nshuti', 'Forward', 10, NULL, '1998-02-14', 'Rwanda', 11, '2023-11-01', '2026-10-31', '2025-03-20 02:29:13', '2025-03-20 02:29:13', NULL),
(30, 'Arnaud Tuyisenge', 'Forward', 10, NULL, '2000-12-08', 'Rwanda', 12, '2024-04-01', '2027-03-31', '2025-03-20 02:29:13', '2025-03-20 02:29:13', NULL),
(31, 'Kasambungu Bolingo', 'Forward', 10, NULL, '1997-03-04', 'Congo', 31, '2024-11-05', '2027-04-14', '2025-03-20 09:30:24', '2025-03-20 09:30:24', NULL),
(32, 'Kasambungu Bolingo', 'Forward', 10, NULL, '1997-03-04', 'Congo', 31, '2024-11-05', '2027-04-14', '2025-03-20 09:30:51', '2025-03-20 09:30:51', NULL),
(33, 'Kasambungu Bolingo', 'Forward', 10, NULL, '1997-03-04', 'Congo', 31, '2024-06-09', '2027-12-14', '2025-03-20 09:39:02', '2025-03-20 09:39:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `player_injury`
--

CREATE TABLE `player_injury` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `player_id` bigint(20) UNSIGNED NOT NULL,
  `injury_id` bigint(20) UNSIGNED NOT NULL,
  `date_reported` date NOT NULL,
  `recovery_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `player_performance_view`
-- (See below for the actual view)
--
CREATE TABLE `player_performance_view` (
`match_id` bigint(20) unsigned
,`player_id` bigint(20) unsigned
,`injuries` bigint(21)
,`cards` bigint(21)
,`yellow_cards` bigint(21)
,`red_cards` bigint(21)
,`goals` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `player_team`
--

CREATE TABLE `player_team` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `player_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `player_transfer`
--

CREATE TABLE `player_transfer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `player_id` bigint(20) UNSIGNED NOT NULL,
  `from_team_id` bigint(20) UNSIGNED NOT NULL,
  `to_team_id` bigint(20) UNSIGNED NOT NULL,
  `transfer_date` date NOT NULL,
  `transfer_fee` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `lineup` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `team_id`, `title`, `content`, `lineup`, `image`, `category`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Hola', 'amamamamamamama', NULL, 'uploads/23oDPUQtTz4kDC9txZhUoFiMm9j93ZW1tJfSrx8p.png', 'news', 'published', '2025-03-27 10:12:14', '2025-04-02 04:12:27'),
(2, 3, 'Match Derby', 'Don\'t miss in our Match Derby on this comming Saturday', NULL, 'uploads/7TiDw4zfsMyT3A9ibSFBzjjRTyBwstGXt7na2N21.png', 'next_event', 'draft', '2025-03-28 03:01:53', '2025-04-02 04:13:56'),
(3, 3, 'dddd', 'cxcxcxcxcx', NULL, 'uploads/rfJCvq1SyysXzHouHloI4892zPuSUuxJ66qJrUJh.png', 'news', 'published', '2025-04-02 04:19:45', '2025-04-02 04:19:45');

-- --------------------------------------------------------

--
-- Table structure for table `punishments`
--

CREATE TABLE `punishments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `reason` text DEFAULT NULL,
  `team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `player_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coach_id` bigint(20) UNSIGNED DEFAULT NULL,
  `referee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `punishments`
--

INSERT INTO `punishments` (`id`, `type`, `reason`, `team_id`, `player_id`, `coach_id`, `referee_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(13, 'Relegation', 'Corruption', 2, NULL, NULL, NULL, '2025-02-16', '2025-02-28', '2025-02-17 12:08:17', '2025-02-17 10:12:46'),
(14, 'hgbh', 'ss', 3, NULL, NULL, 1, '2025-02-17', '2025-02-25', '2025-02-17 10:13:13', '2025-02-17 10:13:13'),
(15, 'red card', 'eeeee', 1, NULL, 6, NULL, '2025-02-26', '2025-03-19', '2025-02-25 10:08:55', '2025-02-25 10:08:55'),
(16, 'wwwwwww', 'dccdfgvhbjknrfhgdguchjihknufgivbucdjbhbfvjdvvibvevcdywc', NULL, 28, NULL, NULL, '2025-03-28', '2025-04-03', '2025-03-28 06:00:10', '2025-03-28 06:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `punishment_coach`
--

CREATE TABLE `punishment_coach` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coach_id` bigint(20) UNSIGNED NOT NULL,
  `punishment_id` bigint(20) UNSIGNED NOT NULL,
  `date_imposed` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `punishment_player`
--

CREATE TABLE `punishment_player` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `player_id` bigint(20) UNSIGNED NOT NULL,
  `punishment_id` bigint(20) UNSIGNED NOT NULL,
  `date_imposed` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referees`
--

CREATE TABLE `referees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `certification` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referees`
--

INSERT INTO `referees` (`id`, `name`, `certification`, `created_at`, `updated_at`, `type`) VALUES
(1, 'John Doe', 'FIFA Elite Referee', '2025-02-16 20:22:27', '2025-02-16 20:22:27', 'Main Referee'),
(2, 'Jane Smith', 'CAF Elite Referee', '2025-02-16 20:22:27', '2025-02-16 20:22:27', 'Fourth Referee'),
(3, 'Ali Hassan', 'UEFA Category 1', '2025-02-16 20:22:27', '2025-02-16 20:22:27', 'Main Referee'),
(4, 'David Kimani', 'FIFA Assistant Referee', '2025-02-16 20:22:27', '2025-02-16 20:22:27', 'Assistant Referee'),
(5, 'Carlos Mendes', 'CONMEBOL Referee License', '2025-02-16 20:22:27', '2025-02-16 20:22:27', 'Fourth Referee'),
(6, 'Michael Johnson', 'AFC Elite Referee', '2025-02-16 20:22:27', '2025-02-16 20:22:27', 'Main Referee'),
(7, 'Samuel Owusu', 'CAF Category A', '2025-02-16 20:22:27', '2025-02-16 20:22:27', 'Fourth Referee'),
(8, 'Hiroshi Tanaka', 'AFC Assistant Referee', '2025-02-16 20:22:27', '2025-02-16 20:22:27', 'Assistant Referee'),
(9, 'Pierre Dubois', 'UEFA Assistant Referee', '2025-02-16 20:22:27', '2025-02-16 20:22:27', 'Assistant Referee'),
(10, 'Ahmed Mostafa', 'FIFA International Referee', '2025-02-16 20:22:27', '2025-02-16 20:22:27', 'Main Referee');

-- --------------------------------------------------------

--
-- Table structure for table `revenues`
--

CREATE TABLE `revenues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(4, 'Admin', 'admin', '2025-02-06 13:05:47', '2025-02-06 13:05:47'),
(5, 'Team Manager', 'team-manager', '2025-02-06 13:05:47', '2025-02-06 13:05:47'),
(6, 'Coach', 'coach', '2025-02-06 13:05:47', '2025-02-06 13:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('eZqioMt14w0AvBmeC3blTBXYCuGgBpRO8jOF3cVJ', 'APR FC', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSDFWWGZtYjgwbnA3UzJ4elVySTd0aXpEcm44VjVRN2p4YWNVUEN1MCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90ZWFtL2Rhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtzOjY6IkFQUiBGQyI7fQ==', 1744677013),
('MVMtpBlVGvmZG2E0QEMgjxw3oItuBulQ5XxkrisW', 'APR FC', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOEZLeVdJSmVJMUFiZjRWREJEMnY3OU5EQVdJcmRvOFZIY05uc1VBSyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdGVhbS9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czo2OiJBUFIgRkMiO30=', 1744677579),
('XbCClYkFUHlBgCDyVgFFKY8VUXRIwd5C51Su9r2L', 'APR FC', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVEI4eUV1VmwwVjl3UlRTTFNibDg4VTNzc2E2dkVUSUpUdURMbG14cSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmFuc2ZlcnMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czo2OiJBUFIgRkMiO30=', 1744677657);

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sponsor_name` varchar(255) NOT NULL,
  `team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contract_start_date` date NOT NULL,
  `contract_end_date` date NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `sponsor_name`, `team_id`, `contract_start_date`, `contract_end_date`, `amount`, `created_at`, `updated_at`, `user_id`, `image_path`) VALUES
(1, 'sss', 10, '2025-03-20', '2025-04-04', 40000.00, '2025-03-22 03:53:06', '2025-03-22 03:53:06', NULL, NULL),
(2, 'Kiss', 10, '2025-03-21', '2025-03-28', 40000.00, '2025-03-22 03:56:14', '2025-03-22 03:56:14', NULL, NULL),
(3, 'aaq', 1, '2025-03-21', '2025-03-28', 2000.00, '2025-03-22 04:27:39', '2025-03-22 05:47:17', NULL, NULL),
(4, 'Radio1', NULL, '2025-03-21', '2025-03-28', 1111.00, '2025-03-22 04:39:46', '2025-03-22 05:26:04', NULL, NULL),
(5, 'qa', 10, '2025-03-21', '2025-03-29', 1111111.00, '2025-03-22 04:48:53', '2025-03-22 04:48:53', NULL, NULL),
(7, 'TV1', 1, '2025-03-01', '2030-08-21', 100000000.00, '2025-03-22 05:03:19', '2025-03-22 05:03:19', NULL, NULL),
(8, 'Primus Rwanda', NULL, '2010-02-13', '2040-05-21', 10000000000.00, '2025-03-22 05:48:33', '2025-03-22 05:48:33', NULL, NULL),
(9, 'BK', NULL, '2025-02-24', '2050-05-08', 1000000000.00, '2025-03-22 05:51:08', '2025-03-22 05:51:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sponsorships`
--

CREATE TABLE `sponsorships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sponsor_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `contract_start_date` date NOT NULL,
  `contract_end_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stadiums`
--

CREATE TABLE `stadiums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stadiums`
--

INSERT INTO `stadiums` (`id`, `name`, `created_at`, `updated_at`, `location`, `capacity`) VALUES
(1, 'Amahoro Stadium', '2025-02-07 09:00:35', '2025-02-07 09:00:35', 'Gasabo, Kigali', 45000),
(2, 'Kigali Pele Stadium', '2025-02-24 15:41:35', '2025-02-24 15:41:35', 'Nyarugenge, Kigali', 25000),
(3, 'Huye Stadium', '2025-02-24 15:42:06', '2025-02-24 15:42:06', 'Huye', 25000),
(4, 'Umuganda Stadium', '2025-02-24 15:42:38', '2025-02-24 15:42:38', 'Gisenyi, Rubavu', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `position`, `team_id`, `created_at`, `updated_at`) VALUES
(1, 'KAMANZI Ephrem', 'Marketing Manager', 2, '2025-03-24 23:35:36', '2025-03-24 23:35:36'),
(2, 'qqww', 'aaaaaa', 1, '2025-03-25 08:33:05', '2025-03-25 08:40:05'),
(3, 'MAKENGA Augistin', 'Marketing Manager', 3, '2025-03-28 13:08:30', '2025-03-28 13:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `staff_team`
--

CREATE TABLE `staff_team` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_team_bridge`
--

CREATE TABLE `staff_team_bridge` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_team_bridge`
--

INSERT INTO `staff_team_bridge` (`id`, `staff_id`, `team_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2025-03-24 23:35:55', '2025-03-24 23:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `teamss`
--

CREATE TABLE `teamss` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `primary_color` varchar(255) NOT NULL,
  `secondary_color` varchar(255) NOT NULL DEFAULT '#000000',
  `location` varchar(255) NOT NULL,
  `history` text DEFAULT NULL,
  `stadium` varchar(255) DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `manager` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 5,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teamss`
--

INSERT INTO `teamss` (`id`, `name`, `logo`, `primary_color`, `secondary_color`, `location`, `history`, `stadium`, `points`, `manager`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Gasogi United', 'logos/veKk8GkKq1K4itO6nZ4vroj9uuJdLCEMt3VTGm8D.jpg', '#e6410a', '#ffffff', 'Kicukiro, Kigali', 'jhcdhwcvjheverhfv', 'Umuganda', 0, 'Kalinda', 4, 5, '2025-02-07 09:35:25', '2025-03-31 10:59:59'),
(2, 'APR FC', 'logos/uJVfZCnSR36N3iP7nOfiNYrFMi53eYS1GCprf22K.jpg', '#ffffff', '#000000', 'Gasabo, Kigali', 'Where does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 'Umuganda', 0, 'Adili', 5, 5, '2025-02-07 09:38:29', '2025-03-31 11:01:03'),
(3, 'Rayon Sport', 'logos/eZK5rL1C6abfwY3T37YOlc4ru7yq5rLYBhTi5Zlg.jpg', '#2483ff', '#faf9f9', 'Nyanza', 'jhcdhwcvjheverhfv', 'Umuganda', 0, 'Frank', 6, 5, '2025-02-07 09:39:52', '2025-04-02 04:16:36'),
(4, 'Kiyovu Sport', 'logos/D2nOHldxwnFRTaKccOKsVSURE5uT5si8KNsaCXV5.jpg', '#03593f', '#faf9f9', 'Kicukiro, Kigali', 'qqqqqqqqqq', 'Umuganda', 0, 'Mourisa', 7, 5, '2025-02-07 09:40:21', '2025-04-02 04:16:48'),
(5, 'Mukura FC', 'logos/zlXtnraNdRERxq21tKHC1CsPSxoBQBlwNRpRpl28.png', '#f9d41a', '#000000', 'Rwamagana', 'fescsdce', 'Rwamagana', 0, 'Mbanda', NULL, 5, '2025-02-16 18:13:13', '2025-04-02 04:17:00'),
(6, 'Musanze FC', 'logos/eVl9Cxedzpao6xtJYkqYkRw9tEX1tQ8teKXn9nZy.jpg', '#f94343', '#000000', 'Musanze City', 'scbhshdc', 'Musanze Stadium', 0, 'Placide', NULL, 5, '2025-02-16 18:14:25', '2025-04-02 04:17:12'),
(7, 'AS Kigali', 'logos/AusD8qaBm08tKqgJQRZ75CIys6XrIWFSCWRgj1hF.png', '#102650', '#000000', 'Kigali City', 'scfvbhgnfgbv', 'Pele Stadium', 0, 'Maombi Prince', NULL, 5, '2025-02-16 18:16:11', '2025-04-02 04:17:24'),
(8, 'Gorilla FC', 'logos/WM7OcPMNfofOx0JpMmYOpG5QN7JJdSiwQrUAWIzO.jpg', '#101b33', '#000000', 'Nyanza City', 'sdfghjkl', 'Umuganda Stadium', 0, 'Ngenzi Fred', NULL, 5, '2025-02-16 18:18:15', '2025-04-02 04:17:35'),
(9, 'Police Fc', 'logos/EDJKSTBgopOXGFfcu1LVIQzSW5vRAu9omP1OpENs.jpg', '#183c77', '#000000', 'Kigali City', 'sdfghjkl;', 'Nyamirambo Stadium', 0, 'John Doe', NULL, 5, '2025-02-16 18:19:14', '2025-04-02 04:17:50'),
(10, 'Amagaju FC', 'logos/IOfkQDilN8mPD9l1fSzlVwB1ERVtv3dDZ23A9fk7.jpg', '#b3f9bb', '#000000', 'Rubavu city', 'dfghjkl', 'Umuganda Stadium', 0, 'Jene Smith', NULL, 5, '2025-02-16 18:20:31', '2025-04-02 04:18:01'),
(11, 'Rwamagana FC', 'logos/hlFh0zIF88h6kxWL75nSg4XV1P8Avi4YYP5Vyt1D.jpg', '#0e433d', '#dd2c2c', 'Rwamagana', 'Lorem Ipsum dolar', 'Rwamagana', 0, 'Murekezi Aimable', NULL, 5, '2025-03-25 05:30:49', '2025-04-02 04:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `team_performance`
--

CREATE TABLE `team_performance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `wins` int(11) NOT NULL DEFAULT 0,
  `losses` int(11) NOT NULL DEFAULT 0,
  `draws` int(11) NOT NULL DEFAULT 0,
  `goals_scored` int(11) NOT NULL DEFAULT 0,
  `goals_conceded` int(11) NOT NULL DEFAULT 0,
  `yellow_cards` int(11) NOT NULL DEFAULT 0,
  `red_cards` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `team_standings`
-- (See below for the actual view)
--
CREATE TABLE `team_standings` (
`team_id` bigint(20) unsigned
,`team_name` varchar(255)
,`wins` bigint(21)
,`away_wins` bigint(21)
,`draws` bigint(21)
,`away_draws` bigint(21)
,`losses` bigint(21)
,`away_losses` bigint(21)
,`goals_for` decimal(32,0)
,`away_goals_for` decimal(32,0)
,`goals_against` decimal(32,0)
,`away_goals_against` decimal(32,0)
,`goal_difference` decimal(33,0)
,`total_goals` decimal(33,0)
,`points` bigint(24)
);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event` varchar(255) NOT NULL,
  `home_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `away_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `seats` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `event`, `home_team_id`, `away_team_id`, `price`, `seats`, `created_at`, `updated_at`, `status`) VALUES
(1, 'derble', NULL, NULL, 23.00, 23, '2025-02-09 15:36:24', '2025-02-09 15:36:24', 'Active'),
(2, 'derble', NULL, NULL, 23.00, 23, '2025-02-09 15:50:51', '2025-02-09 15:50:51', 'Active'),
(3, 'derble', NULL, NULL, 23.00, 23, '2025-02-09 16:12:27', '2025-02-09 16:12:27', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `player_id` bigint(20) UNSIGNED NOT NULL,
  `from_team_id` bigint(20) UNSIGNED NOT NULL,
  `to_team_id` bigint(20) UNSIGNED NOT NULL,
  `transfer_fee` decimal(10,2) DEFAULT NULL,
  `transfer_date` date NOT NULL,
  `contract_duration` varchar(255) NOT NULL DEFAULT '1 year',
  `status` varchar(255) NOT NULL DEFAULT 'completed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `player_id`, `from_team_id`, `to_team_id`, `transfer_fee`, `transfer_date`, `contract_duration`, `status`, `created_at`, `updated_at`, `notified`) VALUES
(1, 13, 2, 1, 50000000.00, '2025-03-19', '3', 'Pending', '2025-03-19 01:12:35', '2025-04-15 10:22:50', 1),
(2, 3, 2, 10, 50000000.00, '2025-03-23', '1 year', 'rejected', '2025-03-22 13:53:10', '2025-03-22 16:18:48', 1),
(3, 3, 2, 10, 50000000.00, '2025-03-23', '1 year', 'approved', '2025-03-22 16:18:19', '2025-03-22 16:19:09', 1),
(4, 17, 2, 1, 50000000.00, '2025-03-26', '1 year', 'rejected', '2025-03-27 10:40:57', '2025-04-15 10:22:50', 1),
(5, 31, 10, 1, 50000000.00, '2025-04-09', '1 year', 'pending', '2025-04-10 13:18:35', '2025-04-15 10:22:50', 1),
(6, 9, 2, 1, 50000000.00, '2025-04-14', '1 year', 'approved', '2025-04-15 10:21:57', '2025-04-15 10:23:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_windows`
--

CREATE TABLE `transfer_windows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_open` tinyint(1) NOT NULL DEFAULT 0,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transfer_windows`
--

INSERT INTO `transfer_windows` (`id`, `is_open`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-04-07', '2025-05-05', '2025-03-22 04:43:24', '2025-04-07 10:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT 'Team',
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'team_manager',
  `status` enum('active','blocked') NOT NULL DEFAULT 'active',
  `blocked_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `team_id`, `role`, `status`, `blocked_at`) VALUES
(1, 'admin@gmail.com', 'admin@gmail.com', NULL, '$2y$12$DlE9zgc1fs.2chicoeYzoe.mG.t/oJSvZMlno86VaWN7/naR3vjAS', NULL, '2025-02-06 13:50:50', '2025-02-25 17:24:04', NULL, 'admin', 'active', NULL),
(3, NULL, NULL, NULL, '$2y$12$0UJf/etXZWtjzJ45y2BIKuHoie8br4lcb1Nxrkt1yF5fi.gpfYPMa', NULL, '2025-02-07 09:40:21', '2025-03-21 12:26:51', NULL, 'team_manager', 'active', NULL),
(4, 'Gasogi United', 'gasogi@example.com', NULL, '$2y$12$lYbT2F0g2cHQCVdSRbs5LeQjPdG1/7xUCo12EfX5i/14kdCAWLOzO', NULL, '2025-02-07 15:16:39', '2025-02-07 15:16:39', 1, 'team_manager', 'active', NULL),
(5, 'APR FC', 'apr@example.com', NULL, '$2y$12$xLv3upZVAKaHOvZjQdt3f.mfl8yr6nsMOo7ZJJgT/eUUThlybvMxS', 'uzU2PticniVnlzN8t5q11E1DF1P6dPlDE3QaY12glVymgW3rWmO6uNEv7KZo', '2025-02-07 15:16:40', '2025-02-07 15:16:40', 2, 'team_manager', 'active', NULL),
(6, 'Rayon Sport', 'rayon@example.com', NULL, '$2y$12$6AUjMSbkCZVQBljH4ySmzu3kl.Q60RL0flIEuvpoGXs373mvTk2Qa', NULL, '2025-02-07 15:16:41', '2025-04-13 07:02:21', 3, 'team_manager', 'active', NULL),
(7, 'Kiyovu Sport', 'kiyovu@example.com', NULL, '$2y$12$UeNftqdLUCekoPwvyYKdDOeEruGt/zrMJAcsFcBkm/h4bUqpDLTHS', NULL, '2025-02-07 15:16:42', '2025-02-14 14:18:46', 4, 'team_manager', 'active', NULL),
(16, 'Mukura FC', 'mukurafc@gmail.com', NULL, '$2y$12$t5pmXGDFy8Nnry.y.oXJV.CMfvY92rJ1JWTAnZ7D6wNZxs4yDHAnq', NULL, '2025-02-16 18:13:13', '2025-02-16 18:13:13', 5, 'team_manager', 'active', NULL),
(17, 'Musanze FC', 'musanzefc@gmail.com', NULL, '$2y$12$U9ht0k7RSBGJeX6vZk6iDOiv12MiixW7ZKZlHEig6eZ3h4LC/nGDC', NULL, '2025-02-16 18:14:25', '2025-04-11 04:13:03', 6, 'team_manager', 'active', NULL),
(18, 'AS Kigali', 'askigali@gmail.com', NULL, '$2y$12$gobS0FwgkhbZtZpoRCXtxeDELHtM2wKV9YtoZqP8eNz5oeKmTGQ86', NULL, '2025-02-16 18:16:11', '2025-02-16 18:16:11', 7, 'team_manager', 'active', NULL),
(19, 'Gorilla FC', 'gorillafc@gmail.com', NULL, '$2y$12$UYvd/yBADkQ80zMnInyaneqE6dvBJef0dF9y6YFu4aHey74EX.Q46', NULL, '2025-02-16 18:18:15', '2025-02-16 18:18:15', 8, 'team_manager', 'active', NULL),
(20, 'Police Fc', 'policefc@gmail.com', NULL, '$2y$12$US2pGKlxEJ/R.mw3JpU02eiGfRfPu2BQGaB7uKhz4g8um47pqcctu', NULL, '2025-02-16 18:19:14', '2025-02-16 18:19:14', 9, 'team_manager', 'active', NULL),
(21, 'Amagaju FC', 'amagajufc@gmail.com', NULL, '$2y$12$29yuNnhxb9BiRr9ot6atb./pKb9P/p96vTcu8afLVhnjR3Tczhjde', NULL, '2025-02-16 18:20:32', '2025-02-16 18:20:32', 10, 'team_manager', 'active', NULL),
(22, 'user', 'user@gmail.com', NULL, '$2y$12$MpYSP0.ydpMqVioFWk82NurK9XAQkiQHE0AHglrD7E8p1mZHFhd9S', NULL, '2025-02-24 07:53:14', '2025-04-13 07:02:28', NULL, 'team_manager', 'active', NULL),
(23, 'Rwamagana FC', 'rwamagana@gmail.com', NULL, '$2y$12$7sgxqVAzYpivvwG0gagTs.VJZdyYtgHSJ4YYN9NCC0xrtPJ0I28oW', NULL, '2025-03-25 05:30:49', '2025-03-25 06:06:57', 11, 'team_manager', 'active', NULL);

-- --------------------------------------------------------

--
-- Structure for view `match_summary_view`
--
DROP TABLE IF EXISTS `match_summary_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `match_summary_view`  AS SELECT `goals`.`match_id` AS `match_id`, count(case when `goals`.`injury` is not null then 1 end) AS `total_injuries`, count(case when `goals`.`card` is not null then 1 end) AS `total_cards`, count(case when `goals`.`card` = 'yellow' then 1 end) AS `yellow_cards`, count(case when `goals`.`card` = 'red' then 1 end) AS `red_cards`, count(case when `goals`.`injury` is null and `goals`.`card` is null then 1 end) AS `total_goals` FROM `goals` GROUP BY `goals`.`match_id` ;

-- --------------------------------------------------------

--
-- Structure for view `player_performance_view`
--
DROP TABLE IF EXISTS `player_performance_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `player_performance_view`  AS SELECT `goals`.`match_id` AS `match_id`, `goals`.`player_id` AS `player_id`, count(case when `goals`.`injury` is not null then 1 end) AS `injuries`, count(case when `goals`.`card` is not null then 1 end) AS `cards`, count(case when `goals`.`card` = 'yellow' then 1 end) AS `yellow_cards`, count(case when `goals`.`card` = 'red' then 1 end) AS `red_cards`, count(case when `goals`.`injury` is null and `goals`.`card` is null then 1 end) AS `goals` FROM `goals` GROUP BY `goals`.`match_id`, `goals`.`player_id` ;

-- --------------------------------------------------------

--
-- Structure for view `team_standings`
--
DROP TABLE IF EXISTS `team_standings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `team_standings`  AS SELECT `teamss`.`id` AS `team_id`, `teamss`.`name` AS `team_name`, count(case when `home_goals`.`team_type` = 'home' and `home_goals`.`goal_scored` > `away_goals`.`goal_scored` then 1 end) AS `wins`, count(case when `away_goals`.`team_type` = 'away' and `away_goals`.`goal_scored` > `home_goals`.`goal_scored` then 1 end) AS `away_wins`, count(case when `home_goals`.`team_type` = 'home' and `home_goals`.`goal_scored` = `away_goals`.`goal_scored` then 1 end) AS `draws`, count(case when `away_goals`.`team_type` = 'away' and `away_goals`.`goal_scored` = `home_goals`.`goal_scored` then 1 end) AS `away_draws`, count(case when `home_goals`.`team_type` = 'home' and `home_goals`.`goal_scored` < `away_goals`.`goal_scored` then 1 end) AS `losses`, count(case when `away_goals`.`team_type` = 'away' and `away_goals`.`goal_scored` < `home_goals`.`goal_scored` then 1 end) AS `away_losses`, sum(case when `home_goals`.`team_type` = 'home' then `home_goals`.`goal_scored` else 0 end) AS `goals_for`, sum(case when `away_goals`.`team_type` = 'away' then `away_goals`.`goal_scored` else 0 end) AS `away_goals_for`, sum(case when `home_goals`.`team_type` = 'home' then `away_goals`.`goal_scored` else 0 end) AS `goals_against`, sum(case when `away_goals`.`team_type` = 'away' then `home_goals`.`goal_scored` else 0 end) AS `away_goals_against`, sum(case when `home_goals`.`team_type` = 'home' then `home_goals`.`goal_scored` else 0 end) - sum(case when `home_goals`.`team_type` = 'home' then `away_goals`.`goal_scored` else 0 end) AS `goal_difference`, sum(case when `home_goals`.`team_type` = 'home' then `home_goals`.`goal_scored` else 0 end) + sum(case when `away_goals`.`team_type` = 'away' then `away_goals`.`goal_scored` else 0 end) AS `total_goals`, (count(case when `home_goals`.`team_type` = 'home' and `home_goals`.`goal_scored` > `away_goals`.`goal_scored` then 1 end) + count(case when `away_goals`.`team_type` = 'away' and `away_goals`.`goal_scored` > `home_goals`.`goal_scored` then 1 end)) * 3 + (count(case when `home_goals`.`team_type` = 'home' and `home_goals`.`goal_scored` = `away_goals`.`goal_scored` then 1 end) + count(case when `away_goals`.`team_type` = 'away' and `away_goals`.`goal_scored` = `home_goals`.`goal_scored` then 1 end)) AS `points` FROM (((`teamss` left join `matchs` `m` on(`m`.`home_team_id` = `teamss`.`id` or `m`.`away_team_id` = `teamss`.`id`)) left join `goals` `home_goals` on(`home_goals`.`match_id` = `m`.`id` and `home_goals`.`team_type` = 'home')) left join `goals` `away_goals` on(`away_goals`.`match_id` = `m`.`id` and `away_goals`.`team_type` = 'away')) GROUP BY `teamss`.`id`, `teamss`.`name` ORDER BY (count(case when `home_goals`.`team_type` = 'home' and `home_goals`.`goal_scored` > `away_goals`.`goal_scored` then 1 end) + count(case when `away_goals`.`team_type` = 'away' and `away_goals`.`goal_scored` > `home_goals`.`goal_scored` then 1 end)) * 3 + (count(case when `home_goals`.`team_type` = 'home' and `home_goals`.`goal_scored` = `away_goals`.`goal_scored` then 1 end) + count(case when `away_goals`.`team_type` = 'away' and `away_goals`.`goal_scored` = `home_goals`.`goal_scored` then 1 end)) DESC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_team_id` (`team_id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bids_player_id_foreign` (`player_id`),
  ADD KEY `bids_selling_team_id_foreign` (`selling_team_id`),
  ADD KEY `bids_buying_team_id_foreign` (`buying_team_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coaches_team_id_foreign` (`team_id`);

--
-- Indexes for table `coach_team`
--
ALTER TABLE `coach_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coach_team_coach_id_foreign` (`coach_id`),
  ADD KEY `coach_team_team_id_foreign` (`team_id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contracts_player_id_foreign` (`player_id`),
  ADD KEY `contracts_team_id_foreign` (`team_id`),
  ADD KEY `contracts_transfer_window_id_foreign` (`transfer_window_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_team_id_foreign` (`team_id`);

--
-- Indexes for table `fan_engagement`
--
ALTER TABLE `fan_engagement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fan_engagement_team_id_foreign` (`team_id`);

--
-- Indexes for table `fan_team`
--
ALTER TABLE `fan_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fan_team_fan_id_foreign` (`fan_id`),
  ADD KEY `fan_team_team_id_foreign` (`team_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_team_id_foreign` (`team_id`);

--
-- Indexes for table `financials`
--
ALTER TABLE `financials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fixtures_home_team_id_foreign` (`home_team_id`),
  ADD KEY `fixtures_away_team_id_foreign` (`away_team_id`),
  ADD KEY `fixtures_stadium_id_foreign` (`stadium_id`),
  ADD KEY `category_id` (`match_category_id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goals_match_id_foreign` (`match_id`),
  ADD KEY `goals_player_id_foreign` (`player_id`);

--
-- Indexes for table `historical_teams`
--
ALTER TABLE `historical_teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historical_teams_team_id_foreign` (`team_id`);

--
-- Indexes for table `injuries`
--
ALTER TABLE `injuries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `injuries_player_id_foreign` (`player_id`),
  ADD KEY `injuries_team_id_foreign` (`team_id`),
  ADD KEY `injuries_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `league_table`
--
ALTER TABLE `league_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `league_table_team_id_foreign` (`team_id`);

--
-- Indexes for table `lineups`
--
ALTER TABLE `lineups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lineups_match_id_foreign` (`match_id`);

--
-- Indexes for table `lineup_players`
--
ALTER TABLE `lineup_players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lineup_players_lineup_id_foreign` (`lineup_id`),
  ADD KEY `lineup_players_player_id_foreign` (`player_id`);

--
-- Indexes for table `loan_deals`
--
ALTER TABLE `loan_deals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_deals_player_id_foreign` (`player_id`),
  ADD KEY `loan_deals_team_id_foreign` (`team_id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `managers_team_id_foreign` (`team_id`);

--
-- Indexes for table `manager_team`
--
ALTER TABLE `manager_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manager_team_manager_id_foreign` (`manager_id`),
  ADD KEY `manager_team_team_id_foreign` (`team_id`);

--
-- Indexes for table `matchs`
--
ALTER TABLE `matchs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matchs_stadium_id_foreign` (`stadium_id`),
  ADD KEY `matchs_home_team_id_foreign` (`home_team_id`),
  ADD KEY `matchs_away_team_id_foreign` (`away_team_id`),
  ADD KEY `matchs_match_category_id_foreign` (`match_category_id`),
  ADD KEY `referee_id` (`referee_id`),
  ADD KEY `matchs_assistant_referee1_id_foreign` (`assistant_referee1_id`),
  ADD KEY `matchs_assistant_referee2_id_foreign` (`assistant_referee2_id`),
  ADD KEY `matchs_fourth_referee_id_foreign` (`fourth_referee_id`),
  ADD KEY `matchs_match_commissioner_id_foreign` (`match_commissioner_id`);

--
-- Indexes for table `match_categories`
--
ALTER TABLE `match_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `match_commissioners`
--
ALTER TABLE `match_commissioners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `match_commissioners_email_unique` (`email`);

--
-- Indexes for table `match_lineup`
--
ALTER TABLE `match_lineup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_lineup_match_id_foreign` (`match_id`),
  ADD KEY `match_lineup_player_id_foreign` (`player_id`);

--
-- Indexes for table `match_results`
--
ALTER TABLE `match_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_results_fourth_referee_id_foreign` (`fourth_referee_id`),
  ADD KEY `match_results_home_team_id_foreign` (`home_team_id`),
  ADD KEY `match_results_away_team_id_foreign` (`away_team_id`),
  ADD KEY `match_results_referee_assessor_id_foreign` (`referee_assessor_id`),
  ADD KEY `match_results_match_commissioner_id_foreign` (`match_commissioner_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_team_id_foreign` (`team_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `performances`
--
ALTER TABLE `performances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `performances_team_id_foreign` (`team_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `players_team_id_foreign` (`team_id`),
  ADD KEY `players_previous_team_id_foreign` (`previous_team_id`);

--
-- Indexes for table `player_injury`
--
ALTER TABLE `player_injury`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_injury_player_id_foreign` (`player_id`),
  ADD KEY `player_injury_injury_id_foreign` (`injury_id`);

--
-- Indexes for table `player_team`
--
ALTER TABLE `player_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_team_player_id_foreign` (`player_id`),
  ADD KEY `player_team_team_id_foreign` (`team_id`);

--
-- Indexes for table `player_transfer`
--
ALTER TABLE `player_transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_transfer_player_id_foreign` (`player_id`),
  ADD KEY `player_transfer_from_team_id_foreign` (`from_team_id`),
  ADD KEY `player_transfer_to_team_id_foreign` (`to_team_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_team_id_foreign` (`team_id`);

--
-- Indexes for table `punishments`
--
ALTER TABLE `punishments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `punishment_coach`
--
ALTER TABLE `punishment_coach`
  ADD PRIMARY KEY (`id`),
  ADD KEY `punishment_coach_coach_id_foreign` (`coach_id`),
  ADD KEY `punishment_coach_punishment_id_foreign` (`punishment_id`);

--
-- Indexes for table `punishment_player`
--
ALTER TABLE `punishment_player`
  ADD PRIMARY KEY (`id`),
  ADD KEY `punishment_player_player_id_foreign` (`player_id`),
  ADD KEY `punishment_player_punishment_id_foreign` (`punishment_id`);

--
-- Indexes for table `referees`
--
ALTER TABLE `referees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revenues`
--
ALTER TABLE `revenues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sponsors_team_id_foreign` (`team_id`),
  ADD KEY `sponsors_user_id_foreign` (`user_id`);

--
-- Indexes for table `sponsorships`
--
ALTER TABLE `sponsorships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sponsorships_sponsor_id_foreign` (`sponsor_id`),
  ADD KEY `sponsorships_team_id_foreign` (`team_id`);

--
-- Indexes for table `stadiums`
--
ALTER TABLE `stadiums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_team_id_foreign` (`team_id`);

--
-- Indexes for table `staff_team`
--
ALTER TABLE `staff_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_team_staff_id_foreign` (`staff_id`),
  ADD KEY `staff_team_team_id_foreign` (`team_id`);

--
-- Indexes for table `staff_team_bridge`
--
ALTER TABLE `staff_team_bridge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_team_bridge_staff_id_foreign` (`staff_id`),
  ADD KEY `staff_team_bridge_team_id_foreign` (`team_id`);

--
-- Indexes for table `teamss`
--
ALTER TABLE `teamss`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teamss_role_id_foreign` (`role_id`),
  ADD KEY `teamss_user_id_foreign` (`user_id`);

--
-- Indexes for table `team_performance`
--
ALTER TABLE `team_performance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_performance_team_id_foreign` (`team_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_home_team_id_foreign` (`home_team_id`),
  ADD KEY `tickets_away_team_id_foreign` (`away_team_id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfers_player_id_foreign` (`player_id`),
  ADD KEY `transfers_from_team_id_foreign` (`from_team_id`),
  ADD KEY `transfers_to_team_id_foreign` (`to_team_id`);

--
-- Indexes for table `transfer_windows`
--
ALTER TABLE `transfer_windows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_team_id_foreign` (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coach_team`
--
ALTER TABLE `coach_team`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fan_engagement`
--
ALTER TABLE `fan_engagement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fan_team`
--
ALTER TABLE `fan_team`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `financials`
--
ALTER TABLE `financials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fixtures`
--
ALTER TABLE `fixtures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `historical_teams`
--
ALTER TABLE `historical_teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `injuries`
--
ALTER TABLE `injuries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `league_table`
--
ALTER TABLE `league_table`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lineups`
--
ALTER TABLE `lineups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `lineup_players`
--
ALTER TABLE `lineup_players`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `loan_deals`
--
ALTER TABLE `loan_deals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manager_team`
--
ALTER TABLE `manager_team`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matchs`
--
ALTER TABLE `matchs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `match_categories`
--
ALTER TABLE `match_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `match_commissioners`
--
ALTER TABLE `match_commissioners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `match_lineup`
--
ALTER TABLE `match_lineup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `match_results`
--
ALTER TABLE `match_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `performances`
--
ALTER TABLE `performances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `player_injury`
--
ALTER TABLE `player_injury`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player_team`
--
ALTER TABLE `player_team`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player_transfer`
--
ALTER TABLE `player_transfer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `punishments`
--
ALTER TABLE `punishments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `punishment_coach`
--
ALTER TABLE `punishment_coach`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `punishment_player`
--
ALTER TABLE `punishment_player`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referees`
--
ALTER TABLE `referees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `revenues`
--
ALTER TABLE `revenues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `sponsorships`
--
ALTER TABLE `sponsorships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stadiums`
--
ALTER TABLE `stadiums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff_team`
--
ALTER TABLE `staff_team`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_team_bridge`
--
ALTER TABLE `staff_team_bridge`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teamss`
--
ALTER TABLE `teamss`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `team_performance`
--
ALTER TABLE `team_performance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transfer_windows`
--
ALTER TABLE `transfer_windows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `fk_team_id` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_buying_team_id_foreign` FOREIGN KEY (`buying_team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bids_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bids_selling_team_id_foreign` FOREIGN KEY (`selling_team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coaches`
--
ALTER TABLE `coaches`
  ADD CONSTRAINT `coaches_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coach_team`
--
ALTER TABLE `coach_team`
  ADD CONSTRAINT `coach_team_coach_id_foreign` FOREIGN KEY (`coach_id`) REFERENCES `coaches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coach_team_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `contracts_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contracts_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contracts_transfer_window_id_foreign` FOREIGN KEY (`transfer_window_id`) REFERENCES `transfer_windows` (`id`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fan_engagement`
--
ALTER TABLE `fan_engagement`
  ADD CONSTRAINT `fan_engagement_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fan_team`
--
ALTER TABLE `fan_team`
  ADD CONSTRAINT `fan_team_fan_id_foreign` FOREIGN KEY (`fan_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fan_team_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD CONSTRAINT `fixtures_away_team_id_foreign` FOREIGN KEY (`away_team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fixtures_home_team_id_foreign` FOREIGN KEY (`home_team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fixtures_ibfk_1` FOREIGN KEY (`match_category_id`) REFERENCES `match_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fixtures_stadium_id_foreign` FOREIGN KEY (`stadium_id`) REFERENCES `stadiums` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `goals_match_id_foreign` FOREIGN KEY (`match_id`) REFERENCES `matchs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `goals_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `historical_teams`
--
ALTER TABLE `historical_teams`
  ADD CONSTRAINT `historical_teams_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `injuries`
--
ALTER TABLE `injuries`
  ADD CONSTRAINT `injuries_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `injuries_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `injuries_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `league_table`
--
ALTER TABLE `league_table`
  ADD CONSTRAINT `league_table_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lineups`
--
ALTER TABLE `lineups`
  ADD CONSTRAINT `lineups_match_id_foreign` FOREIGN KEY (`match_id`) REFERENCES `matchs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lineup_players`
--
ALTER TABLE `lineup_players`
  ADD CONSTRAINT `lineup_players_lineup_id_foreign` FOREIGN KEY (`lineup_id`) REFERENCES `lineups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lineup_players_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loan_deals`
--
ALTER TABLE `loan_deals`
  ADD CONSTRAINT `loan_deals_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `loan_deals_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`);

--
-- Constraints for table `managers`
--
ALTER TABLE `managers`
  ADD CONSTRAINT `managers_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `manager_team`
--
ALTER TABLE `manager_team`
  ADD CONSTRAINT `manager_team_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `managers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `manager_team_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `matchs`
--
ALTER TABLE `matchs`
  ADD CONSTRAINT `matchs_assistant_referee1_id_foreign` FOREIGN KEY (`assistant_referee1_id`) REFERENCES `referees` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `matchs_assistant_referee2_id_foreign` FOREIGN KEY (`assistant_referee2_id`) REFERENCES `referees` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `matchs_away_team_id_foreign` FOREIGN KEY (`away_team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matchs_fourth_referee_id_foreign` FOREIGN KEY (`fourth_referee_id`) REFERENCES `referees` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `matchs_home_team_id_foreign` FOREIGN KEY (`home_team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matchs_ibfk_1` FOREIGN KEY (`referee_id`) REFERENCES `referees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matchs_match_category_id_foreign` FOREIGN KEY (`match_category_id`) REFERENCES `match_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matchs_match_commissioner_id_foreign` FOREIGN KEY (`match_commissioner_id`) REFERENCES `match_commissioners` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `matchs_stadium_id_foreign` FOREIGN KEY (`stadium_id`) REFERENCES `stadiums` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `match_lineup`
--
ALTER TABLE `match_lineup`
  ADD CONSTRAINT `match_lineup_match_id_foreign` FOREIGN KEY (`match_id`) REFERENCES `matchs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `match_lineup_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `match_results`
--
ALTER TABLE `match_results`
  ADD CONSTRAINT `match_results_away_team_id_foreign` FOREIGN KEY (`away_team_id`) REFERENCES `teamss` (`id`),
  ADD CONSTRAINT `match_results_fourth_referee_id_foreign` FOREIGN KEY (`fourth_referee_id`) REFERENCES `referees` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `match_results_home_team_id_foreign` FOREIGN KEY (`home_team_id`) REFERENCES `teamss` (`id`),
  ADD CONSTRAINT `match_results_match_commissioner_id_foreign` FOREIGN KEY (`match_commissioner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `match_results_referee_assessor_id_foreign` FOREIGN KEY (`referee_assessor_id`) REFERENCES `referees` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `performances`
--
ALTER TABLE `performances`
  ADD CONSTRAINT `performances_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_previous_team_id_foreign` FOREIGN KEY (`previous_team_id`) REFERENCES `teamss` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `players_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `player_injury`
--
ALTER TABLE `player_injury`
  ADD CONSTRAINT `player_injury_injury_id_foreign` FOREIGN KEY (`injury_id`) REFERENCES `injuries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `player_injury_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `player_team`
--
ALTER TABLE `player_team`
  ADD CONSTRAINT `player_team_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `player_team_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `player_transfer`
--
ALTER TABLE `player_transfer`
  ADD CONSTRAINT `player_transfer_from_team_id_foreign` FOREIGN KEY (`from_team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `player_transfer_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `player_transfer_to_team_id_foreign` FOREIGN KEY (`to_team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `punishment_coach`
--
ALTER TABLE `punishment_coach`
  ADD CONSTRAINT `punishment_coach_coach_id_foreign` FOREIGN KEY (`coach_id`) REFERENCES `coaches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `punishment_coach_punishment_id_foreign` FOREIGN KEY (`punishment_id`) REFERENCES `punishments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `punishment_player`
--
ALTER TABLE `punishment_player`
  ADD CONSTRAINT `punishment_player_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `punishment_player_punishment_id_foreign` FOREIGN KEY (`punishment_id`) REFERENCES `punishments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD CONSTRAINT `sponsors_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sponsors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sponsorships`
--
ALTER TABLE `sponsorships`
  ADD CONSTRAINT `sponsorships_sponsor_id_foreign` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sponsorships_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_team`
--
ALTER TABLE `staff_team`
  ADD CONSTRAINT `staff_team_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `staff_team_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_team_bridge`
--
ALTER TABLE `staff_team_bridge`
  ADD CONSTRAINT `staff_team_bridge_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `staff_team_bridge_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teamss`
--
ALTER TABLE `teamss`
  ADD CONSTRAINT `teamss_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `teamss_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_performance`
--
ALTER TABLE `team_performance`
  ADD CONSTRAINT `team_performance_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_away_team_id_foreign` FOREIGN KEY (`away_team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_home_team_id_foreign` FOREIGN KEY (`home_team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_from_team_id_foreign` FOREIGN KEY (`from_team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfers_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfers_to_team_id_foreign` FOREIGN KEY (`to_team_id`) REFERENCES `teamss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teamss` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
