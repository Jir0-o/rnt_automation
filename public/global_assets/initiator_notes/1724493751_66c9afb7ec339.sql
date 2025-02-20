-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2024 at 11:36 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `procurement_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocated_products`
--

CREATE TABLE `allocated_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `allocation_id` int(11) DEFAULT NULL,
  `requisition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `rni_no` int(11) DEFAULT NULL,
  `from_where` int(11) DEFAULT NULL,
  `to_send` int(11) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `product_condition_id` int(11) DEFAULT NULL,
  `product_identification_no` text DEFAULT NULL,
  `reverted` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allocated_products`
--

INSERT INTO `allocated_products` (`id`, `allocation_id`, `requisition_id`, `contract_id`, `rni_no`, `from_where`, `to_send`, `product_id`, `quantity`, `unit_price`, `total_price`, `product_condition_id`, `product_identification_no`, `reverted`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, 3, 5, 10, 50, NULL, NULL, NULL, 0, '2024-08-20 03:31:06', '2024-08-20 03:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `allocations`
--

CREATE TABLE `allocations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `allocation_date` date DEFAULT NULL,
  `allocation_no` text DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `validity_date` date DEFAULT NULL,
  `validity_days` int(11) DEFAULT NULL,
  `requisition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `auth_level` text DEFAULT NULL,
  `is_issue` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `cc` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reverted` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allocations`
--

INSERT INTO `allocations` (`id`, `allocation_date`, `allocation_no`, `subject`, `validity_date`, `validity_days`, `requisition_id`, `auth_level`, `is_issue`, `remarks`, `cc`, `user_id`, `reverted`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '2024-08-20', 'ALC202408206853', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 5, NULL, 0, '2024-08-20 03:31:06', '2024-08-20 03:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `authorized_persons`
--

CREATE TABLE `authorized_persons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `allocation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `authorized_person` varchar(250) DEFAULT NULL,
  `ap_id_no` varchar(50) DEFAULT NULL,
  `ap_designation` varchar(100) DEFAULT NULL,
  `ap_date` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `committees`
--

CREATE TABLE `committees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secretary` bigint(20) UNSIGNED DEFAULT NULL,
  `chairman_id` bigint(20) UNSIGNED DEFAULT NULL,
  `requisition_id` bigint(20) UNSIGNED NOT NULL,
  `committee_type` varchar(255) DEFAULT NULL,
  `is_dpm` tinyint(4) NOT NULL,
  `status` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `committees`
--

INSERT INTO `committees` (`id`, `name`, `secretary`, `chairman_id`, `requisition_id`, `committee_type`, `is_dpm`, `status`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, 1, NULL, 1, '8', 1, '2024-08-20 03:40:15', '2024-08-20 03:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'CSE Department', 'CSE 1021', '2024-08-03 07:54:30', '2024-08-03 07:54:30'),
(2, 'EEE DEpartment', 'EEE 363', '2024-08-20 07:54:30', '2024-08-29 07:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation` text DEFAULT NULL,
  `short` varchar(50) DEFAULT NULL,
  `priority_level` int(11) DEFAULT NULL,
  `allocation_auth_level` int(11) DEFAULT NULL,
  `iv_auth_level` int(11) DEFAULT NULL,
  `rni_auth_level` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation`, `short`, `priority_level`, `allocation_auth_level`, `iv_auth_level`, `rni_auth_level`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Manager', 'Mgr', 1, 2, 3, 2, 1, '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(2, 'Assistant Manager', 'AsstMgr', 2, 3, 2, 3, 1, '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(3, 'Vice Chancellor', 'VC', 2, 3, 2, 3, 1, '2024-06-19 03:59:37', '2024-06-19 03:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `drafts`
--

CREATE TABLE `drafts` (
  `id` bigint(20) NOT NULL,
  `note` text NOT NULL,
  `date` date NOT NULL,
  `attachment` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `file_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `file_committees`
--

CREATE TABLE `file_committees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `committee_name` varchar(255) NOT NULL,
  `secretary` bigint(20) UNSIGNED NOT NULL,
  `chairman` bigint(20) UNSIGNED NOT NULL,
  `initiator_file_id` bigint(20) UNSIGNED NOT NULL,
  `initiator_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_committees`
--

INSERT INTO `file_committees` (`id`, `committee_name`, `secretary`, `chairman`, `initiator_file_id`, `initiator_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'TOC Committee', 7, 2, 1, 5, 1, '2024-08-20 03:44:33', '2024-08-20 03:44:33'),
(2, 'TEC Committee', 4, 3, 1, 5, 1, '2024-08-20 03:44:48', '2024-08-20 03:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `important_purchases`
--

CREATE TABLE `important_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `spec` text DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `important_purchases`
--

INSERT INTO `important_purchases` (`id`, `requisition_id`, `product_id`, `quantity`, `user_id`, `spec`, `status`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2, 5, '12GB RAM', '1', 1, '2024-08-20 03:31:34', '2024-08-20 03:31:34'),
(2, 2, 1, 1, 5, '12GB RAM 1TB SSD', '0', 1, '2024-08-24 02:11:46', '2024-08-24 02:11:46'),
(3, 2, 4, 1, 5, 'Galaxy AI, 12GB RAM, 200MP Camera', '0', 1, '2024-08-24 02:12:29', '2024-08-24 02:12:29');

-- --------------------------------------------------------

--
-- Table structure for table `initiator_files`
--

CREATE TABLE `initiator_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_number` varchar(255) NOT NULL,
  `file_catagory` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `opening_date` date NOT NULL,
  `oce_dpm` bigint(20) UNSIGNED DEFAULT NULL,
  `approver` varchar(255) DEFAULT NULL,
  `reviewer` varchar(255) DEFAULT NULL,
  `review_status` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `toc_committee_member` varchar(20) DEFAULT NULL,
  `tec_committee_member` varchar(20) DEFAULT NULL,
  `initiator_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `is_forword` tinyint(1) NOT NULL DEFAULT 1,
  `is_toc_committee` tinyint(4) DEFAULT 0,
  `is_tec_committee` tinyint(4) NOT NULL DEFAULT 0,
  `is_complete` tinyint(4) NOT NULL DEFAULT 0,
  `full_review` tinyint(4) NOT NULL DEFAULT 0,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `initiator_files`
--

INSERT INTO `initiator_files` (`id`, `file_name`, `file_number`, `file_catagory`, `department`, `opening_date`, `oce_dpm`, `approver`, `reviewer`, `review_status`, `toc_committee_member`, `tec_committee_member`, `initiator_id`, `status`, `is_forword`, `is_toc_committee`, `is_tec_committee`, `is_complete`, `full_review`, `note`, `created_at`, `updated_at`) VALUES
(1, 'Final Show', 'ABCD1235', 'ABCD', 'ABC', '2024-08-20', 1, '6', '5, 3, 4, 6', '[]', '5, 7, 2, 6', '5, 3, 4, 6', 5, '1', 1, 1, 1, 1, 1, NULL, '2024-08-20 03:40:15', '2024-08-24 01:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `initiator_notes`
--

CREATE TABLE `initiator_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `initiator_file_id` bigint(20) UNSIGNED DEFAULT NULL,
  `initiator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `reviewer_note` text DEFAULT NULL,
  `review_status` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`review_status`)),
  `is_forword` tinyint(4) DEFAULT 1,
  `is_toc` tinyint(4) NOT NULL DEFAULT 0,
  `is_tec` tinyint(4) NOT NULL DEFAULT 0,
  `is_closing_note` tinyint(4) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `vc_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `initiator_notes`
--

INSERT INTO `initiator_notes` (`id`, `initiator_file_id`, `initiator_id`, `note`, `date`, `reviewer_note`, `review_status`, `is_forword`, `is_toc`, `is_tec`, `is_closing_note`, `status`, `vc_note`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '<p>অনুসন্ধানের তালিকায় রয়েছেন- সাবেক বাণিজ্য মন্ত্রী টিপু মুনশি, সাবেক স্বাস্থ্যমন্ত্রী জাহিদ মালেক, সাবেক জ্বালানি খনিজ সম্পদ বিষয়ক প্রতিমন্ত্রী নসরুল হামিদ বিপু, সাবেক ত্রাণমন্ত্রী ডা. এনামুর রহমান, সাবেক সমাজকল্যাণমন্ত্রী ডা. দীপু মনি, সাবেক আইনমন্ত্রী আনিসুল হক, সাবেক নৌপ্রতিমন্ত্রী খালিদ মাহমুদ চৌধুরী, সাবেক স্থানীয় সরকার মন্ত্রী তাজুল ইসলাম, সাবেক শিক্ষামন্ত্রী মুহিবুল হাসান চৌধুরী, সাবেক আইসিটি প্রতিমন্ত্রী জুনাইদ আহমেদ পলক, সাবেক ধর্মমন্ত্রী ফরিদুল হক, সাবেক &nbsp;খাদ্যমন্ত্রী সাধন চন্দ্র মজুমদার, সাবেক প্রবাসীকল্যাণ মন্ত্রী &nbsp;ইমরান আহমেদ, সাবেক নৌ মন্ত্রী শাহজান খান, সাবেক পররাষ্ট্র মন্ত্রী হাছান মাহমুদ, সাবেক প্রাথমিক ও গণশিক্ষা প্রতিমন্ত্রী জাকির হোসেন, সাবেক পাট ও বস্ত্রমন্ত্রী গোলাম দস্তগীর গাজী, সাবেক শিল্পমন্ত্রী নূরুল মজিদ মাহমুদ হুমায়ূন, সাবেক শিল্প প্রতিমন্ত্রী কামাল আহমেদ মজুমদার, সাবেক যুব ও ক্রীড়া প্রতিমন্ত্রী জাহিদ আহসান রাসেল, সাবেক ত্রাণ প্রতিমন্ত্রী মহিবুর রহমান।</p>', '2024-08-21', NULL, NULL, 1, 0, 0, NULL, '0', NULL, '2024-08-20 03:47:25', '2024-08-20 03:47:25'),
(2, 1, 5, '<p>ওই সংশোধনীর ফলে বিশেষ পরিস্থিতিতে অত্যাবশ্যক বিবেচনা করলে সরকার জনস্বার্থে কোনো সিটি করপোরেশন ও পৌরসভার মেয়র এবং কাউন্সিলরকে অপসারণ করতে পারবে।</p>\n', '2024-08-21', NULL, NULL, 0, 0, 0, NULL, '0', NULL, '2024-08-20 03:50:10', '2024-08-20 03:50:10'),
(3, 1, 5, '<p>যশোর আওয়ামী লীগের সাধারণ সম্পাদক এবং যশোর-৬ (কেশবপুর) আসনের সাবেক সংসদ সদস্য শাহীন চাকলাদারের মালিকানাধীন হোটেল জাবির ইন্টারন্যাশনালে ভাঙচুর, লুটপাট ও অগ্নিসংযোগ করে ২৪ জনকে হত্যার অভিযোগে ২০০ জনকে অজ্ঞাতনামা আসামি করে মামলা করা হয়েছে।</p>\n', '2024-08-22', NULL, NULL, 1, 0, 0, NULL, '0', NULL, '2024-08-20 03:50:59', '2024-08-20 03:50:59'),
(4, 1, 5, '<p>ছাত্র-জনতার গণ-আন্দোলনের মুখে ৫ আগস্ট প্রধানমন্ত্রীর পদ থেকে শেখ হাসিনার পদত্যাগের পর স্থানীয় সরকারের জনপ্রতিনিধিদের অধিকাংশই আত্মগোপনে চলে গেছেন। জেলা ও উপজেলা পরিষদ থেকে শুরু করে সিটি করপোরেশন ও পৌরসভার প্রায় সব শীর্ষ পদই আওয়ামী লীগের নেতা-কর্মীদের দখলে ছিল। এমন পরিস্থিতিতে স্থানীয় সরকার প্রতিষ্ঠানগুলোর কার্যক্রম ব্যাহত হচ্ছিল। পরে বিকল্প ব্যবস্থা করে সরকার। যেমন উপজেলা চেয়ারম্যান অনুপস্থিত থাকলে দায়িত্ব পালন করবেন উপজেলা নির্বাহী কর্মকর্তা (ইউএনও)। এখন অধ্যাদেশের মাধ্যমে আইন সংশোধন করে মেয়র-চেয়ারম্যানদের অপসারণ করে প্রশাসক নিয়োগের সুযোগ তৈরি করছে সরকার।</p>\n', '2024-08-21', NULL, NULL, 1, 0, 0, NULL, '0', NULL, '2024-08-20 03:52:20', '2024-08-20 03:52:20'),
(5, 1, 5, '<p>এর আগে গত ১৬ আগস্ট সরকারি এক তথ্য বিবরণীতে জানানো হয়, বিশেষ পরিস্থিতিতে অত্যাবশ্যক বিবেচনা করলে সরকার জনস্বার্থে কোনো সিটি করপোরেশন ও পৌরসভার মেয়র এবং কাউন্সিলরকে অপসারণ করতে পারবে।</p>\n\n<p>একইভাবে জেলা পরিষদের চেয়ারম্যান ও সদস্য এবং উপজেলা পরিষদের চেয়ারম্যান, ভাইস চেয়ারম্যান ও মহিলা ভাইস চেয়ারম্যানদের অপসারণ করতে পারবে। একই সঙ্গে এগুলোতে প্রশাসক নিয়োগ দিতে পারবে সরকার।</p>\n\n<p>এমন বিধান রেখে &lsquo;স্থানীয় সরকার (সিটি করপোরেশন) (সংশোধন) অধ্যাদেশ, ২০২৪ &rsquo;, &lsquo;স্থানীয় সরকার (পৌরসভা) (সংশোধন) অধ্যাদেশ, ২০২৪ &rsquo;, &lsquo;জেলা পরিষদ (সংশোধন) অধ্যাদেশ, ২০২৪&rsquo; ও &lsquo;উপজেলা পরিষদ (সংশোধন) অধ্যাদেশ, ২০২৪&rsquo;&ndash;এর খসড়া অনুমোদন করেছে অন্তর্বর্তী সরকারের উপদেষ্টা পরিষদ। পরে তা অধ্যাদেশ আকারে জারি করা হয়।</p>\n', '2024-08-22', NULL, NULL, 0, 0, 0, NULL, '0', NULL, '2024-08-21 03:25:25', '2024-08-21 03:25:25'),
(9, 1, 5, NULL, '2024-08-21', NULL, NULL, 0, 0, 0, NULL, '0', NULL, '2024-08-21 03:36:32', '2024-08-21 03:36:32'),
(14, 1, 5, NULL, '2024-08-22', NULL, NULL, 0, 0, 0, NULL, '0', NULL, '2024-08-22 03:52:38', '2024-08-22 03:52:38'),
(17, 1, 5, '<p>নিরাপত্তাকর্মীরা বাধা দিতে গেলে তাদের দিকে লাঠি নিয়ে তেড়ে যায় দুষ্কৃতকারীরা। এ সময় ওই সময় প্রতিষ্ঠানটিতে কর্মরতদের ধাওয়া করে দুষ্কৃতকারীরা। কয়েকজনকে মারধরও করা হয়। মুহূর্তের মধ্যে শান্ত স্বাভাবিক কর্মপরিবেশ সন্ত্রাসী হামলায় লণ্ডভণ্ড হয়ে যায়। দুষ্কৃতকারীদের হামলা থেকে প্রাণে বাঁচতে অনেকে দিগ্বিদিক ছোটাছুটি শুরু করেন।</p>\n', '2024-08-23', NULL, NULL, 1, 1, 0, NULL, '0', NULL, '2024-08-22 04:40:08', '2024-08-22 04:40:08'),
(18, 1, 5, NULL, '2024-08-22', NULL, NULL, 0, 1, 0, NULL, '0', NULL, '2024-08-22 05:40:40', '2024-08-22 05:40:40'),
(19, 1, 5, NULL, '2024-08-22', NULL, NULL, 0, 1, 0, NULL, '0', NULL, '2024-08-22 05:41:27', '2024-08-22 05:41:27'),
(20, 1, 5, '<p>বতসোয়ানার রাজধানী গ্যাবোরোনের প্রায় ৫০০ কিলোমিটার উত্তরে কারোই খনিতে হীরাটি পাওয়া গেছে। দেশটির সরকার জানিয়েছে, এটি তাদের আবিষ্কৃত সবচেয়ে বড় হীরা। এর আগে তাদের সবচেয়ে বড় আবিষ্কার ছিল এক হাজার ৭৫৮ ক্যারেটের একটি পাথর, যা ২০১৯ সালে একই খনিতে পাওয়া গিয়েছিল।</p>\n', '2024-08-23', NULL, NULL, 1, 1, 0, NULL, '0', NULL, '2024-08-22 05:42:31', '2024-08-22 05:42:31'),
(21, 1, 5, NULL, '2024-08-22', NULL, NULL, 0, 1, 0, NULL, '0', NULL, '2024-08-22 05:54:46', '2024-08-22 05:54:46'),
(32, 1, 5, NULL, '2024-08-22', NULL, NULL, 0, 1, 0, NULL, '0', NULL, '2024-08-22 06:53:47', '2024-08-22 06:53:47'),
(33, 1, 5, NULL, '2024-08-22', NULL, NULL, 0, 1, 0, NULL, '0', NULL, '2024-08-22 06:54:14', '2024-08-22 06:54:14'),
(34, 1, 5, '<p>অনুসন্ধানের তালিকায় রয়েছেন- সাবেক বাণিজ্য মন্ত্রী টিপু মুনশি, সাবেক স্বাস্থ্যমন্ত্রী জাহিদ মালেক, সাবেক জ্বালানি খনিজ সম্পদ বিষয়ক প্রতিমন্ত্রী নসরুল হামিদ বিপু, সাবেক ত্রাণমন্ত্রী ডা. এনামুর রহমান, সাবেক সমাজকল্যাণমন্ত্রী ডা. দীপু মনি, সাবেক আইনমন্ত্রী আনিসুল হক, সাবেক নৌপ্রতিমন্ত্রী খালিদ মাহমুদ চৌধুরী, সাবেক স্থানীয় সরকার মন্ত্রী তাজুল ইসলাম, সাবেক শিক্ষামন্ত্রী মুহিবুল হাসান চৌধুরী, সাবেক আইসিটি প্রতিমন্ত্রী জুনাইদ আহমেদ পলক, সাবেক ধর্মমন্ত্রী ফরিদুল হক, সাবেক &nbsp;খাদ্যমন্ত্রী সাধন চন্দ্র মজুমদার, সাবেক প্রবাসীকল্যাণ মন্ত্রী &nbsp;ইমরান আহমেদ, সাবেক নৌ মন্ত্রী শাহজান খান, সাবেক পররাষ্ট্র মন্ত্রী হাছান মাহমুদ, সাবেক প্রাথমিক ও গণশিক্ষা প্রতিমন্ত্রী জাকির হোসেন, সাবেক পাট ও বস্ত্রমন্ত্রী গোলাম দস্তগীর গাজী, সাবেক শিল্পমন্ত্রী নূরুল মজিদ মাহমুদ হুমায়ূন, সাবেক শিল্প প্রতিমন্ত্রী কামাল আহমেদ মজুমদার, সাবেক যুব ও ক্রীড়া প্রতিমন্ত্রী জাহিদ আহসান রাসেল, সাবেক ত্রাণ প্রতিমন্ত্রী মহিবুর রহমান।</p>\n', '2024-08-24', NULL, NULL, 1, 0, 1, NULL, '0', NULL, '2024-08-24 00:25:36', '2024-08-24 00:25:36'),
(35, 1, 5, '<p>ছাত্র-জনতার গণ-আন্দোলনের মুখে ৫ আগস্ট প্রধানমন্ত্রীর পদ থেকে শেখ হাসিনার পদত্যাগের পর স্থানীয় সরকারের জনপ্রতিনিধিদের অধিকাংশই আত্মগোপনে চলে গেছেন। জেলা ও উপজেলা পরিষদ থেকে শুরু করে সিটি করপোরেশন ও পৌরসভার প্রায় সব শীর্ষ পদই আওয়ামী লীগের নেতা-কর্মীদের দখলে ছিল। এমন পরিস্থিতিতে স্থানীয় সরকার প্রতিষ্ঠানগুলোর কার্যক্রম ব্যাহত হচ্ছিল। পরে বিকল্প ব্যবস্থা করে সরকার। যেমন উপজেলা চেয়ারম্যান অনুপস্থিত থাকলে দায়িত্ব পালন করবেন উপজেলা নির্বাহী কর্মকর্তা (ইউএনও)। এখন অধ্যাদেশের মাধ্যমে আইন সংশোধন করে মেয়র-চেয়ারম্যানদের অপসারণ করে প্রশাসক নিয়োগের সুযোগ তৈরি করছে সরকার।</p>\n', '2024-08-25', NULL, NULL, 1, 0, 1, NULL, '0', NULL, '2024-08-24 00:31:38', '2024-08-24 00:31:38'),
(38, 1, 5, NULL, '2024-08-24', NULL, NULL, 0, 0, 1, NULL, '0', NULL, '2024-08-24 01:47:27', '2024-08-24 01:47:27'),
(39, 1, 5, NULL, '2024-08-24', NULL, NULL, 0, 0, 1, NULL, '0', NULL, '2024-08-24 01:47:43', '2024-08-24 01:47:43'),
(40, 1, 5, NULL, '2024-08-24', NULL, NULL, 0, 0, 1, NULL, '0', NULL, '2024-08-24 01:47:59', '2024-08-24 01:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `initiator_note_attachments`
--

CREATE TABLE `initiator_note_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `initiator_note_id` bigint(20) UNSIGNED NOT NULL,
  `files` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `initiator_note_attachments`
--

INSERT INTO `initiator_note_attachments` (`id`, `initiator_note_id`, `files`, `created_at`, `updated_at`) VALUES
(1, 1, '1724147245_66c4662db1fe1.txt', '2024-08-20 03:47:25', '2024-08-20 03:47:25'),
(2, 1, '1724147245_66c4662db3346.png', '2024-08-20 03:47:25', '2024-08-20 03:47:25'),
(3, 1, '1724147245_66c4662db3f1a.png', '2024-08-20 03:47:25', '2024-08-20 03:47:25');

-- --------------------------------------------------------

--
-- Table structure for table `initiator_note_reviews`
--

CREATE TABLE `initiator_note_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `initiator_note_id` bigint(20) UNSIGNED NOT NULL,
  `reviewer_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `signature` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `designation` bigint(20) UNSIGNED DEFAULT NULL,
  `department` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `initiator_note_reviews`
--

INSERT INTO `initiator_note_reviews` (`id`, `initiator_note_id`, `reviewer_id`, `comment`, `signature`, `date`, `designation`, `department`, `created_at`, `updated_at`) VALUES
(1, 1, 5, NULL, '240702.1719910771.9520103_R_Z001A.jpeg', '2024-08-21', 1, 2, '2024-08-20 03:47:25', '2024-08-20 03:47:25'),
(2, 1, 3, NULL, '240702.1719910806.download (1).png', NULL, 1, 1, '2024-08-20 03:49:12', '2024-08-20 03:49:12'),
(3, 2, 4, NULL, '240702.1719910795.20220911_1662871418_659911.jpeg', NULL, 2, 2, '2024-08-20 03:50:10', '2024-08-20 03:50:10'),
(4, 3, 3, NULL, '240702.1719910806.download (1).png', NULL, 1, 1, '2024-08-20 03:50:59', '2024-08-20 03:50:59'),
(5, 4, 4, NULL, '240702.1719910795.20220911_1662871418_659911.jpeg', NULL, 2, 2, '2024-08-20 03:52:20', '2024-08-20 03:52:20'),
(11, 4, 6, NULL, '240702.1719910771.9520103_R_Z001A.jpeg', NULL, 2, 1, '2024-08-21 03:20:04', '2024-08-21 03:20:04'),
(12, 5, 4, NULL, '240702.1719910795.20220911_1662871418_659911.jpeg', NULL, 2, 2, '2024-08-21 03:25:25', '2024-08-21 03:25:25'),
(13, 9, 3, NULL, '240702.1719910806.download (1).png', '2024-08-21', 1, 1, '2024-08-21 03:36:32', '2024-08-21 03:36:32'),
(18, 14, 5, NULL, '240702.1719910771.9520103_R_Z001A.jpeg', '2024-08-22', 1, 2, '2024-08-22 03:52:38', '2024-08-22 03:52:38'),
(22, 17, 7, NULL, '240704.1720117107.download.png', NULL, 3, 2, '2024-08-22 04:40:08', '2024-08-22 04:40:08'),
(23, 17, 2, NULL, '240702.1719910831.happy-new-year-2024-with-fireworks-background-celebration-new-year-2024-2DCBC44.jpg', NULL, 2, 2, '2024-08-22 04:46:15', '2024-08-22 04:46:15'),
(24, 18, 6, NULL, '240702.1719910771.9520103_R_Z001A.jpeg', '2024-08-22', 2, 1, '2024-08-22 05:40:40', '2024-08-22 05:40:40'),
(25, 19, 2, NULL, '240702.1719910831.happy-new-year-2024-with-fireworks-background-celebration-new-year-2024-2DCBC44.jpg', '2024-08-22', 2, 2, '2024-08-22 05:41:27', '2024-08-22 05:41:27'),
(26, 20, 7, NULL, '240704.1720117107.download.png', NULL, 3, 2, '2024-08-22 05:42:31', '2024-08-22 05:42:31'),
(27, 20, 2, NULL, '240702.1719910831.happy-new-year-2024-with-fireworks-background-celebration-new-year-2024-2DCBC44.jpg', NULL, 2, 2, '2024-08-22 05:42:51', '2024-08-22 05:42:51'),
(28, 20, 6, NULL, '240702.1719910771.9520103_R_Z001A.jpeg', NULL, 2, 1, '2024-08-22 05:43:32', '2024-08-22 05:43:32'),
(29, 21, 2, NULL, '240702.1719910831.happy-new-year-2024-with-fireworks-background-celebration-new-year-2024-2DCBC44.jpg', '2024-08-22', 2, 2, '2024-08-22 05:54:46', '2024-08-22 05:54:46'),
(40, 32, 7, NULL, '240704.1720117107.download.png', '2024-08-22', 3, 2, '2024-08-22 06:53:47', '2024-08-22 06:53:47'),
(41, 33, 5, NULL, '240702.1719910771.9520103_R_Z001A.jpeg', '2024-08-22', 1, 2, '2024-08-22 06:54:14', '2024-08-22 06:54:14'),
(42, 34, 5, NULL, '240702.1719910771.9520103_R_Z001A.jpeg', NULL, 1, 2, '2024-08-24 00:25:36', '2024-08-24 00:25:36'),
(43, 34, 4, NULL, '240702.1719910795.20220911_1662871418_659911.jpeg', NULL, 2, 2, '2024-08-24 00:26:57', '2024-08-24 00:26:57'),
(44, 35, 6, NULL, '240702.1719910771.9520103_R_Z001A.jpeg', NULL, 2, 1, '2024-08-24 00:31:38', '2024-08-24 00:31:38'),
(45, 36, 4, NULL, '240702.1719910795.20220911_1662871418_659911.jpeg', '2024-08-24', 2, 2, '2024-08-24 00:32:37', '2024-08-24 00:32:37'),
(48, 38, 4, NULL, '240702.1719910795.20220911_1662871418_659911.jpeg', '2024-08-24', 2, 2, '2024-08-24 01:47:27', '2024-08-24 01:47:27'),
(49, 39, 3, NULL, '240702.1719910806.download (1).png', '2024-08-24', 1, 1, '2024-08-24 01:47:43', '2024-08-24 01:47:43'),
(50, 40, 5, NULL, '240702.1719910771.9520103_R_Z001A.jpeg', '2024-08-24', 1, 2, '2024-08-24 01:47:59', '2024-08-24 01:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `issue_vouchers`
--

CREATE TABLE `issue_vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auth_id` int(11) DEFAULT NULL,
  `issue_no` text DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `issue_by_where` int(11) DEFAULT NULL,
  `vehicle` text DEFAULT NULL,
  `allocation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `auth` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_vouchers`
--

INSERT INTO `issue_vouchers` (`id`, `auth_id`, `issue_no`, `issue_date`, `issue_by_where`, `vehicle`, `allocation_id`, `user_id`, `status`, `auth`, `remarks`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, 'IV202408206210', '2024-08-20', NULL, NULL, 1, 5, 1, NULL, NULL, 1, '2024-08-20 03:32:15', '2024-08-20 03:32:33');

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
(1, '2013_06_14_000000_create_designations_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2023_11_26_103955_create_permission_tables', 1),
(8, '2023_11_26_104124_create_sessions_table', 1),
(9, '2023_11_27_095311_create_settings_table', 1),
(10, '2024_06_14_095724_create_requisition_types_table', 1),
(11, '2024_06_14_095725_create_requisitions_table', 1),
(12, '2024_06_14_095726_create_unit_types_table', 1),
(13, '2024_06_14_095727_create_product_categories_table', 1),
(14, '2024_06_14_095811_create_product_sub_categories_table', 1),
(15, '2024_06_14_095812_create_products_table', 1),
(16, '2024_06_14_095813_create_requisition_products_table', 1),
(17, '2024_06_14_095917_create_zones_table', 1),
(18, '2024_06_14_095918_create_store_information_table', 1),
(19, '2024_06_14_095951_create_store_product_finals_table', 1),
(20, '2024_06_14_100017_create_supplier_information_table', 1),
(21, '2024_06_14_100044_create_procurement_information_table', 1),
(22, '2024_06_14_100045_create_supply_order_information_table', 1),
(23, '2024_06_14_100142_create_temp_allocated_products_table', 1),
(24, '2024_06_14_100208_create_temp_received_products_table', 1),
(25, '2024_06_14_100257_create_temp_requested_products_table', 1),
(26, '2024_06_14_104111_create_allocations_table', 1),
(27, '2024_06_14_104112_create_allocated_products_table', 1),
(28, '2024_06_14_104203_create_authorized_people_table', 1),
(29, '2024_06_14_104308_create_issue_vouchers_table', 1),
(30, '2024_06_14_104531_create_recieve_information_table', 1),
(31, '2024_06_14_104532_create_received_products_table', 1),
(32, '2024_06_14_125309_create_requisition_attachments_table', 1),
(33, '2024_07_02_073453_create_committees_table', 2),
(34, '2024_07_02_073454_create_product_committees_table', 2),
(35, '2024_07_02_073455_create_initiator_files_table', 2),
(36, '2024_07_02_073456_create_file_committees_table', 2),
(37, '2024_07_02_073457_create_initiator_notes_table', 3),
(38, '2024_07_02_073458_create_initiator_note_attachments_table', 3),
(39, '2024_07_02_073459_create_initiator_note_reviews_table', 3),
(40, '2024_07_10_091855_create_important_purchases_table', 4),
(41, '2024_07_10_120450_create_requisition_signatures_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 6);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'User List', 'web', '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(2, 'Create User', 'web', '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(3, 'edit User', 'web', '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(4, 'delete User', 'web', '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(5, 'Role List', 'web', '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(6, 'Create Role', 'web', '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(7, 'edit Role', 'web', '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(8, 'delete Role', 'web', '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(9, 'Can Access Category & Item Menu', 'web', '2024-06-21 05:10:08', '2024-06-21 05:10:08'),
(10, 'Can Access Approved List Manu', 'web', '2024-06-21 05:10:36', '2024-06-21 05:11:01'),
(11, 'Can Access Inventory Manu', 'web', '2024-06-21 05:10:54', '2024-06-21 05:10:54'),
(12, 'Can Access Requisitions', 'web', '2024-06-21 05:11:49', '2024-06-21 05:11:49'),
(13, 'Can Access Allocations', 'web', '2024-06-21 05:11:59', '2024-06-21 05:11:59'),
(14, 'Can Access Purchase Invoice', 'web', '2024-06-21 05:12:17', '2024-06-21 05:12:17'),
(15, 'Can Access Requisitions Accept and Reject', 'web', '2024-06-21 05:15:50', '2024-06-21 05:15:50'),
(16, 'Can Access Requisitions Create', 'web', '2024-06-21 05:16:16', '2024-06-21 05:16:16'),
(18, 'Can Access Issue', 'web', '2024-06-21 05:37:28', '2024-06-21 05:37:28'),
(19, 'Can Access Allocation Create', 'web', '2024-06-21 05:38:02', '2024-06-21 05:38:02'),
(20, 'Can Access Issue List', 'web', '2024-06-21 05:39:18', '2024-06-21 05:39:18'),
(21, 'Can Access Approves Gatepass and Reject Gatepass', 'web', '2024-06-21 05:41:26', '2024-06-21 05:41:26'),
(22, 'Can Access Allocation List', 'web', '2024-06-21 05:42:56', '2024-06-21 05:42:56'),
(23, 'Can Access Product List', 'web', '2024-06-21 05:43:41', '2024-06-21 05:43:41'),
(24, 'Can Access Setting', 'web', '2024-06-21 06:03:02', '2024-06-21 06:03:02'),
(25, 'Can Access Product', 'web', '2024-06-21 06:23:55', '2024-06-21 06:23:55'),
(26, 'Can Access Product Create', 'web', '2024-06-21 06:24:12', '2024-06-21 06:24:12'),
(27, 'Can Access Category', 'web', '2024-06-21 06:31:57', '2024-06-21 06:31:57'),
(28, 'Can Access Sub Category', 'web', '2024-06-21 06:32:04', '2024-06-21 06:32:04'),
(29, 'Can Access User Card', 'web', '2024-06-22 12:16:28', '2024-06-22 12:16:28'),
(30, 'Can Access Requisition Card', 'web', '2024-06-22 12:16:47', '2024-06-22 12:16:47'),
(31, 'Can Access Allocation Card', 'web', '2024-06-22 12:16:56', '2024-06-22 12:16:56'),
(32, 'Can Access Full Card', 'web', '2024-06-22 12:17:19', '2024-06-22 12:17:19'),
(33, 'Can Access Product Accept & Reject', 'web', '2024-06-24 11:35:35', '2024-06-24 11:35:35'),
(34, 'Can Access Requisition All Tabs', 'web', '2024-06-24 11:53:50', '2024-06-24 11:53:50'),
(35, 'Can Access Unlock File', 'web', '2024-07-03 19:49:57', '2024-07-03 19:49:57'),
(36, 'Can Access File Approved List', 'web', '2024-08-01 05:30:07', '2024-08-01 05:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `procurement_informations`
--

CREATE TABLE `procurement_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tender_number` varchar(300) DEFAULT NULL,
  `tender_date` date DEFAULT NULL,
  `tender_winner` varchar(300) DEFAULT NULL,
  `supplier_address` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(250) DEFAULT NULL,
  `final_quantity` double DEFAULT NULL,
  `temp_quantity` double DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `spec` text DEFAULT NULL,
  `request_quantity` double DEFAULT NULL,
  `allocation_quantity` double DEFAULT NULL,
  `bar_code` varchar(255) DEFAULT NULL,
  `unit_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_sub_categorie_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_frac` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `final_quantity`, `temp_quantity`, `unit_price`, `total_price`, `spec`, `request_quantity`, `allocation_quantity`, `bar_code`, `unit_type_id`, `product_sub_categorie_id`, `is_frac`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'iPhone 13', 82, 72, 1000, 10000, '12GB RAM 1TB SSD', NULL, 75, '0', 1, 1, 0, 0, '2024-06-19 03:59:37', '2024-07-30 00:57:06'),
(2, 'MacBook Pro', 38, 38, 2000, 10000, 'HD Screen 12GB  RAM', NULL, 17, '0', 1, 2, 0, 0, '2024-06-19 03:59:37', '2024-07-30 00:48:41'),
(3, 'The Great Gatsby', 116, 116, 10, 200, '8GB RAM', NULL, 5, '0', 1, 1, 0, 0, '2024-06-19 03:59:37', '2024-08-20 03:32:15'),
(4, 'Samsung S24 Ulta', 54, 67, 10000, NULL, 'Galaxy AI, 12GB RAM, 200MP Camera', NULL, 64, '0', 1, 1, NULL, 0, '2024-06-20 12:51:28', '2024-08-20 03:38:05'),
(5, 'Gucci', 43, 43, 2000, NULL, NULL, NULL, 23, '0', 1, 4, NULL, 0, '2024-06-20 12:55:40', '2024-07-30 00:48:41'),
(6, 'Charger', 20, 20, 1500, NULL, NULL, NULL, NULL, '0006', 1, 3, NULL, 0, '2024-06-22 04:39:50', '2024-07-30 00:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_category_name` varchar(150) DEFAULT NULL,
  `minimum_quantity` int(11) DEFAULT NULL,
  `is_defined_individually` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `product_category_name`, `minimum_quantity`, `is_defined_individually`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', 10, 0, 1, '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(2, 'Books', 5, 0, 1, '2024-06-19 03:59:37', '2024-06-20 12:53:49'),
(3, 'Cloth', NULL, NULL, 1, '2024-06-20 12:53:25', '2024-06-20 12:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `product_committees`
--

CREATE TABLE `product_committees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `demand_committee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tech_committee_id` int(11) DEFAULT NULL,
  `requisition_id` int(11) NOT NULL,
  `sub_catagory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_dpm` int(11) NOT NULL DEFAULT 0,
  `note` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_committees`
--

INSERT INTO `product_committees` (`id`, `quantity`, `unit_price`, `total_price`, `product_id`, `demand_committee_id`, `tech_committee_id`, `requisition_id`, `sub_catagory_id`, `status`, `is_dpm`, `note`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL, 3, NULL, NULL, 1, 1, '3', 1, NULL, 1, '2024-08-20 03:39:20', '2024-08-20 03:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_categories`
--

CREATE TABLE `product_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_sub_category_name` varchar(150) DEFAULT NULL,
  `product_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sub_categories`
--

INSERT INTO `product_sub_categories` (`id`, `product_sub_category_name`, `product_category_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Smartphones', 1, 1, '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(2, 'Laptops', 1, 1, '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(3, 'Fiction', 2, 1, '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(4, 'T-Shirt', 3, 1, '2024-06-20 12:54:39', '2024-06-20 12:55:01');

-- --------------------------------------------------------

--
-- Table structure for table `received_informations`
--

CREATE TABLE `received_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `rni_no` int(11) DEFAULT NULL,
  `recieve_date` date DEFAULT NULL,
  `recieved_by` text DEFAULT NULL,
  `auth` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `cc` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `receive_no` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `received_informations`
--

INSERT INTO `received_informations` (`id`, `contract_id`, `rni_no`, `recieve_date`, `recieved_by`, `auth`, `status`, `comments`, `cc`, `user_id`, `receive_no`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '2024-08-20', NULL, NULL, 1, NULL, NULL, 4, 'REC202408201975', 1, '2024-08-20 03:37:34', '2024-08-20 03:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `received_products`
--

CREATE TABLE `received_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Received_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `rni_no` int(11) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `unit_type` int(11) DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `recieved_store` int(11) DEFAULT NULL,
  `product_condition_id` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `received_products`
--

INSERT INTO `received_products` (`id`, `Received_id`, `contract_id`, `rni_no`, `product_id`, `unit_price`, `total_price`, `unit_type`, `quantity`, `recieved_store`, `product_condition_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 4, 10000, 100000, NULL, 10, NULL, NULL, 1, '2024-08-20 03:37:34', '2024-08-20 03:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE `requisitions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_send` int(11) DEFAULT NULL,
  `requisition_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `requisition_date` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `requisition_no` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `auth` int(11) DEFAULT NULL,
  `allocation` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `cc` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisitions`
--

INSERT INTO `requisitions` (`id`, `requisition_send`, `requisition_type_id`, `requisition_date`, `user_id`, `requisition_no`, `status`, `auth`, `allocation`, `remarks`, `cc`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '2024-08-21', 5, 'REQ202408208766', 5, NULL, NULL, '<p>Urgent</p>', NULL, 1, '2024-08-20 03:29:39', '2024-08-20 03:32:33'),
(2, NULL, NULL, '2024-08-24', 5, 'REQ202408248892', 1, NULL, NULL, '<p>Urgent</p>', NULL, 1, '2024-08-24 02:11:00', '2024-08-24 02:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `requisition_attachments`
--

CREATE TABLE `requisition_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `filename` text DEFAULT NULL,
  `extension` text DEFAULT NULL,
  `file` blob DEFAULT NULL,
  `upload_date` date DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requisition_products`
--

CREATE TABLE `requisition_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `spec` text DEFAULT NULL,
  `allocated_quantity` float DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisition_products`
--

INSERT INTO `requisition_products` (`id`, `requisition_id`, `product_id`, `quantity`, `spec`, `allocated_quantity`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '12GB RAM 1TB SSD', NULL, 1, '2024-08-20 03:29:39', '2024-08-20 03:29:39'),
(2, 1, 3, 7, '12GB RAM', 5, 1, '2024-08-20 03:29:39', '2024-08-20 03:31:06'),
(3, 2, 1, 1, '12GB RAM 1TB SSD', NULL, 1, '2024-08-24 02:11:00', '2024-08-24 02:11:00'),
(4, 2, 4, 1, 'Galaxy AI, 12GB RAM, 200MP Camera', NULL, 1, '2024-08-24 02:11:00', '2024-08-24 02:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `requisition_signatures`
--

CREATE TABLE `requisition_signatures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_id` bigint(20) UNSIGNED NOT NULL,
  `signature` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisition_signatures`
--

INSERT INTO `requisition_signatures` (`id`, `requisition_id`, `signature`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '240702.1719910771.9520103_R_Z001A.jpeg', '2024-08-20', '1', '2024-08-20 03:29:39', '2024-08-20 03:29:39'),
(2, 1, '240702.1719910806.download (1).png', '2024-08-20', '1', '2024-08-20 03:30:15', '2024-08-20 03:30:15'),
(3, 2, '240702.1719910771.9520103_R_Z001A.jpeg', '2024-08-24', '1', '2024-08-24 02:11:00', '2024-08-24 02:11:00'),
(4, 2, '240702.1719910806.download (1).png', '2024-08-24', '1', '2024-08-24 02:11:23', '2024-08-24 02:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `requisition_types`
--

CREATE TABLE `requisition_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisition_types`
--

INSERT INTO `requisition_types` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Purchase', 1, '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(2, 'Maintenance', 1, '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(3, 'Office Supplies', 1, '2024-06-19 03:59:37', '2024-06-19 03:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'System Admin', 'web', '2024-06-19 03:59:37', '2024-06-21 05:07:58'),
(2, 'Procurement Admin', 'web', '2024-06-21 05:08:10', '2024-06-21 05:08:10'),
(3, 'Store Keeper', 'web', '2024-06-21 05:08:19', '2024-06-21 05:08:19'),
(4, 'General User', 'web', '2024-06-21 05:08:38', '2024-06-21 05:08:38');

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
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(9, 3),
(10, 2),
(10, 3),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(12, 1),
(12, 2),
(12, 3),
(12, 4),
(13, 2),
(13, 3),
(14, 3),
(15, 2),
(16, 4),
(18, 3),
(19, 2),
(20, 2),
(20, 3),
(21, 2),
(22, 2),
(22, 3),
(23, 2),
(23, 3),
(24, 1),
(25, 1),
(25, 2),
(25, 3),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(30, 2),
(30, 3),
(30, 4),
(31, 2),
(31, 3),
(32, 1),
(32, 2),
(32, 3),
(33, 2),
(34, 2),
(34, 4),
(35, 2),
(36, 2);

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
('2tpxfvCbhBXogZDWdr0KhZ8MVNrQ4cHaCKhE2uBB', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMVROY0FNSzBkakh1SzF6eWFrZU1IRkpoWkhsdzVwVEhoS3FxQmxTWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJE01cUlkck4wQmhrbXlMNXc2cGRQWE9neGhST1RyWnpueE1kaW1idWJPMHlwcWhJbmpsTUt1Ijt9', 1719910857),
('2y1AI1tJt8AiLOWUkNZhnXMXAndc1ABnoIqIX2Hl', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTmUyZ2VFWGRsZ013VXdTOEpSOFpYVFVQQ3N5VTYxT1VCenJTVzFCdyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRNNXFJZHJOMEJoa215TDV3NnBkUFhPZ3hoUk9Uclp6bnhNZGltYnViTzB5cHFoSW5qbE1LdSI7fQ==', 1719080586),
('7ICxPjqg0ZwI2xEW0RuFskCBbhpO2SCDBy3SrfcK', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVkNweWlIZ0tGc09PTXQ5UHc0dzgyakJpVkZBNkNGOWlBR1VZTUJlNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wcm9kdWN0L3JlcXVlc3QvbGlzdCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkTmhVWVZVamtvZnlzM05LYnY3L1RhZXFwWHpsbVhkNUxUbTZ6ZXl2NW5BaDlLSEhTam9YUWUiO30=', 1719307903),
('aOtx9fTCBdi3gwKom4c8NOjUIbxFIi5MuCHBcJJJ', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36 Edg/127.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieElNa2RwdklPbW95VGRzd3lmU2pkSmN4Y09zc3FhWXFsd1ZuY0YwWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jcmVhdGUtbm90ZS8xIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRNNXFJZHJOMEJoa215TDV3NnBkUFhPZ3hoUk9Uclp6bnhNZGltYnViTzB5cHFoSW5qbE1LdSI7fQ==', 1724492144),
('BFeTKSUlxhmfD4K10PwiWYCwH6boZ1yIUlet7JlP', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWjBNaWFhZzBPb3htNnVYTzlRUlhNUVpNajFaSm84WEdQTXBiM01HeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jcmVhdGUtbm90ZS8yNyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkTTVxSWRyTjBCaGtteUw1dzZwZFBYT2d4aFJPVHJaem54TWRpbWJ1Yk8weXBxaEluamxNS3UiO30=', 1723398542),
('BSmjlgOv1erIQxx3vtQkbbhQHmqjD45ZVfu3H8OA', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTTdYTURBeVk4QWIwakxLWnR6b3lycGJDdVNna0g1R2NxeGw3WFVJNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9vY2UtY29tbWl0dGVlLWxpc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJE01cUlkck4wQmhrbXlMNXc2cGRQWE9neGhST1RyWnpueE1kaW1idWJPMHlwcWhJbmpsTUt1Ijt9', 1720432590),
('CNaHFW5738VnTIxAgpv0zHGetUiyE38b7Va83zkq', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiN0RBVjg4ZUQ3STJWdTNVZjB0WUlZN2xxZ2NuUlBubWRxbElFWTkwOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hbGxvY2F0aW9uL2NyZWF0ZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkUFJNSVJpOWlTVzVZVU5RY0dMbXM0ZXdnMTJCalpDNTlHMGZWWXpUYkFXNnF0RmRZUGdxNG0iO30=', 1724492127),
('cnAL4qL3glkh95kSYP789jPjlafPNeWKMgHnxCaf', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoicUhNTDU1bm93dzdBOEM4ODBXUHVEcEJucklPMmh5RVpaVHZqcTB1NSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvc2hvdy1yZXZpZXcvMiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkTmhVWVZVamtvZnlzM05LYnY3L1RhZXFwWHpsbVhkNUxUbTZ6ZXl2NW5BaDlLSEhTam9YUWUiO30=', 1723753228),
('cnDqX9bdkQlpGL4F9LLTFf2gAGtnro6dOoru9JSE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZTR1a1dSRkZsSEcxV0lkVEdhZXBSN3cybUdjbmg5R0JadDNESFVvNCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3JlcXVpc2l0aW9uL2NyZWF0ZSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1719230651),
('dOBesUFbtBxrTgHymzC0oFQyG12TjBJFjDPqfdMi', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiM3JZVzlZRnJyaXJWdEdXaHlaYUNFRGlsUzExb0dpaGR6NnM3QUUxUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbml0aWF0b3Itbm90ZXMvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRNNXFJZHJOMEJoa215TDV3NnBkUFhPZ3hoUk9Uclp6bnhNZGltYnViTzB5cHFoSW5qbE1LdSI7fQ==', 1723573070),
('e0FbYcsdPBo3MlCh0IUJDxUSJd3GNIZXIn1LCUcB', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieGNNZ3V4bHFWUnJNWmVGdFVMQlJmdjkwdHZ0QVBCSVp5NWVWd2xodyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zaG93LXJldmlldy8yIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRNNXFJZHJOMEJoa215TDV3NnBkUFhPZ3hoUk9Uclp6bnhNZGltYnViTzB5cHFoSW5qbE1LdSI7fQ==', 1723937986),
('e3BWp6Bt1M8QhhO9FZWCS2dl116ZjXyUS7vITmzw', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaG1rdnJlT2tUV0RtblpWM2hYWFRWMTF2MlNZcmszeFIwblhZMm1vYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jcmVhdGUtbm90ZS8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRNNXFJZHJOMEJoa215TDV3NnBkUFhPZ3hoUk9Uclp6bnhNZGltYnViTzB5cHFoSW5qbE1LdSI7fQ==', 1723472377),
('f0X8jnKFH32GAvHD67IwTALbLjj7r4CI6A5Hju7F', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRFRlRGFEZnJwVmJhMTNKeXJhQkVQM1BJNXgyalJJWmFvZldKVXJzTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaG93LXJldmlldy8yIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiROaFVZVlVqa29meXMzTktidjcvVGFlcXBYemxtWGQ1TFRtNnpleXY1bkFoOUtISFNqb1hRZSI7fQ==', 1723723344),
('fK8k1PiKtrnSw18ki4bHPlbGctpz96iCHfh7YhTA', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWUZQa3JqUlRremdDbUllc0htR1IzSmFPcXl4R1NhcW1WS3lOVHlzbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zaG93LWZpbGUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJFFIcEJTNUpNSXpIVDB5TDFmVnJ6c2VHb2t2bzRNcEoxSWFxb2xzbHFhMi82eDBqV0YxOHJXIjt9', 1724492127),
('fsd4oI9Ii95MZn2mVf73Nu7TpTc3KiESI4AWTlq4', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiY1hHa0dpeWVVSFh4elk1Q3gxUmpBVnVzMXZRSVh2YmwweXRXMEN2QyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90ZWNoQ29tbWl0dGVlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRNNXFJZHJOMEJoa215TDV3NnBkUFhPZ3hoUk9Uclp6bnhNZGltYnViTzB5cHFoSW5qbE1LdSI7fQ==', 1720041690),
('gdycs3x4UbJK3dx1pXN7jAUkex1HgtTciqGwWwxa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibXlhbUZ1VlpLbmV4Zmkzcm9mN0JpSHEwc0thSlpadVdITmM0OUFvVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1719860625),
('gnrKh72Y5GvETI7xju5cGG3NolzwAg9P6d9xDJKe', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVmQ3blh2MFo4Q0xIdlNLU0lpU2hDcFFZUlBlN3RaN0dENDR0S1lQRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZXF1aXNpdGlvbnMvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRNNXFJZHJOMEJoa215TDV3NnBkUFhPZ3hoUk9Uclp6bnhNZGltYnViTzB5cHFoSW5qbE1LdSI7fQ==', 1720724340),
('gQYSY5vYZToBsX54Cjuali4V8eQ3Mtz6yTBFzIDz', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUzBYZU1aUkFmQ1dyZWxBSmlSVFNUQlYzR1A0aHJPcFM1emtSVmNFVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbml0aWF0b3Itbm90ZXMvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRNNXFJZHJOMEJoa215TDV3NnBkUFhPZ3hoUk9Uclp6bnhNZGltYnViTzB5cHFoSW5qbE1LdSI7fQ==', 1723566184),
('HCvjkBwtn2udqln7QU02db3mdxfEkI154IRT71lx', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNHcxQmJtRnNWSFJmNllUZmN0QlBUcGltY2JETmc3aURabk5iYXJxbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbml0aWF0b3Itbm90ZS1hdHRhY2htZW50cy9jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJE01cUlkck4wQmhrbXlMNXc2cGRQWE9neGhST1RyWnpueE1kaW1idWJPMHlwcWhJbmpsTUt1Ijt9', 1723545824),
('jN0lz0IeTrWS0gDR8qC9bJfJMIFmVx7uB7CRbW44', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiazJERU9mREw3V2VCYW1Hc2c0c1lObE16OU5jODVLNmM5bG5vT2ZKdiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVxdWlzaXRpb25zL2NyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkTTVxSWRyTjBCaGtteUw1dzZwZFBYT2d4aFJPVHJaem54TWRpbWJ1Yk8weXBxaEluamxNS3UiO30=', 1720861725),
('jQO7aCuSSZp1k1vWMbUFUDTOcT8MptGUKSF6wWWq', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNTg1dEU5dzYxME92REVHMjFseEY4TFB5TUROUDk4ZlRYUEtvSlNNWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9pbml0aWF0b3Itbm90ZS1hdHRhY2htZW50cy9jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJE01cUlkck4wQmhrbXlMNXc2cGRQWE9neGhST1RyWnpueE1kaW1idWJPMHlwcWhJbmpsTUt1Ijt9', 1721071718),
('MS44CIpTAC1uQQnAfNlsIsbWrHonCKYMp1Eslz7M', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidG5rQXB4NFJTdWhsd25SYVFtMWY1dzFVNTFTNzlwNlVETGFWWFIybiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaG93LXJldmlldy8yIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRQUk1JUmk5aVNXNVlVTlFjR0xtczRld2cxMkJqWkM1OUcwZlZZelRiQVc2cXRGZFlQZ3E0bSI7fQ==', 1723575500),
('msfmMTikoZiP4SThThnkiMPkgTAQvw4I6anYQAxf', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWW1ZeTV0dVZheHNHbVRWVnVIWlhZQXhxaEFuSmJSRDdIcFJJcGNsNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbml0aWF0b3Itbm90ZXMvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiROaFVZVlVqa29meXMzTktidjcvVGFlcXBYemxtWGQ1TFRtNnpleXY1bkFoOUtISFNqb1hRZSI7fQ==', 1720057833),
('mwdRTpMIpgBmscFt0tsOoopRtXfFhF7l4YmYyjNk', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTWZ3OVlmaTdDWWxsWDR6ZWJJcFlIM1d0QjE2VzFCUjJYOWlJdElEbSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kZW1hbmRDb21taXR0ZWUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJE01cUlkck4wQmhrbXlMNXc2cGRQWE9neGhST1RyWnpueE1kaW1idWJPMHlwcWhJbmpsTUt1Ijt9', 1720268841),
('NDc2FAHRQUu5U7NT3wQqqnZJfjP6lXYlh51Ce8nq', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiY1oybjllbU9TOHg1RFRNb2RWbzdlOWRkV3lXNWRaNDVNb1c1MTdRZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbml0aWF0b3Itbm90ZXMvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRQUk1JUmk5aVNXNVlVTlFjR0xtczRld2cxMkJqWkM1OUcwZlZZelRiQVc2cXRGZFlQZ3E0bSI7fQ==', 1723398557),
('Nxh6frC1uXHE8vYMvDUZBUzXP5nTTh1gUoKv2dzy', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoielJQT05hMnRKbkNNODFZeWR1UWRXd2IyYlBQUHhJTE50VVlWRHRDSyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJFBjV0RRb055OE9NWnpJUXFSYUpCV2VvMnJkeE9UVmNNVWZxd0R2dVZQYXBYZnNMZVJwUVp1Ijt9', 1721648219),
('PdRFNOlxG9vOYAK80cJ2ZgreIWjmpMXdaV0SGJeD', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRGJHUEdheWtNRVZrbm5WNDZqQ0hjTGcyNUJEY0xuZVlNQjBSdm5hbSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbml0aWF0b3Itbm90ZXMvY3JlYXRlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRNNXFJZHJOMEJoa215TDV3NnBkUFhPZ3hoUk9Uclp6bnhNZGltYnViTzB5cHFoSW5qbE1LdSI7fQ==', 1723723301),
('PqbkAT7pJ5ziexxpYdZrzTjpAoUUU7YowsDu1wZB', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZWVJeG5YdFV6MmxLTkVQczl4dlI1NjZEa2lZS2VGcDdPaXplMk43ViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbml0aWF0b3Itbm90ZS1hdHRhY2htZW50cy9jcmVhdGUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJFFIcEJTNUpNSXpIVDB5TDFmVnJ6c2VHb2t2bzRNcEoxSWFxb2xzbHFhMi82eDBqV0YxOHJXIjt9', 1720057516),
('QhzrRIvd8VTEqpq84Eokyp2HQ0pZijiVFRdcTSik', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUEVzRllWdGt4UjRXUkNOclZzdU5MWWUyb1lOTmVLVHhxRFBWcUUzcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9pbml0aWF0b3Itbm90ZS1hdHRhY2htZW50cy9jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJE5oVVlWVWprb2Z5czNOS2J2Ny9UYWVxcFh6bG1YZDVMVG02emV5djVuQWg5S0hIU2pvWFFlIjt9', 1722492722),
('qTjicOzepyPR9kMrhTEd1aTsP5KV0mnaZLK7VLYj', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTEdMblVCem5XRzQ4YjFwRjN0clNSUWFsQXJjMnljZklVQVRkek4xaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbml0aWF0b3Itbm90ZS1hdHRhY2htZW50cy9jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJE01cUlkck4wQmhrbXlMNXc2cGRQWE9neGhST1RyWnpueE1kaW1idWJPMHlwcWhJbmpsTUt1Ijt9', 1723534398),
('rKAdzT9RvtwNl0kbpsOaZeuRzjvZt7sZYc8myn9r', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiejB0MHlwMG9mWnNodGhPeWNTVFkxMFZxb2tjeklkb3R1M2UzNDhXbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hbGxvY2F0aW9uL2NyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkUFJNSVJpOWlTVzVZVU5RY0dMbXM0ZXdnMTJCalpDNTlHMGZWWXpUYkFXNnF0RmRZUGdxNG0iO30=', 1719897355),
('rnomGCFJw7y1c0YrPBNcECkhEH8zuq1iPDiTshkJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia3BpZzYyMUFnTEVaRXhJRGtETWNFZmhNOVZVaGZOdmtnZlp4clFoMiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NToiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2luaXRpYXRvci1ub3RlLWF0dGFjaG1lbnRzL2NyZWF0ZSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1721124059),
('sbrmF7KTBfhOVAmKEWPgvYKgTU6BCsXm4cerMtiG', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNklpdVBGR3BpVExrMlBZR1VFd3hSSmFVbmRjTzloUldNMWtPaWYzRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbml0aWF0b3Itbm90ZS1hdHRhY2htZW50cy9jcmVhdGUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJE01cUlkck4wQmhrbXlMNXc2cGRQWE9neGhST1RyWnpueE1kaW1idWJPMHlwcWhJbmpsTUt1Ijt9', 1720057618),
('snSi24ZA8xewq02d36jXztAtVJW9zvYcAbjm3Ng0', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSjByTGxyeWNtanBBOVUzSUlmN3poQ1FENno0bVBKM1JkZ0QwZmNXMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbml0aWF0b3Itbm90ZXMvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRNNXFJZHJOMEJoa215TDV3NnBkUFhPZ3hoUk9Uclp6bnhNZGltYnViTzB5cHFoSW5qbE1LdSI7fQ==', 1723459532),
('uC52xSfdlVJLiGI973WdqjLf2XkVYVkrkm6LmtQC', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSDZWNjZEaHkxVFlPUGtNZmFYRmtScWc1R0FpYklRRFY4cFdwTE1EcCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9maW5hbC1maWxlcy9jcmVhdGUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJFBjV0RRb055OE9NWnpJUXFSYUpCV2VvMnJkeE9UVmNNVWZxd0R2dVZQYXBYZnNMZVJwUVp1Ijt9', 1720057675),
('uzYlYzZm3p7tUoIghKKAuZXgd1YHVkrwK8axW8pm', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMlBBcFQyMjZkaW9OVnp2eTBFZ2xUUzBsaXk2U25keTV5OWlhT0p2QSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbml0aWF0b3Itbm90ZS1hdHRhY2htZW50cy9jcmVhdGUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJFFIcEJTNUpNSXpIVDB5TDFmVnJ6c2VHb2t2bzRNcEoxSWFxb2xzbHFhMi82eDBqV0YxOHJXIjt9', 1723575498),
('VlIhd9HLCodMB8v2UnT6HhhN2etHpkuppOOqcDKJ', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYkNRQkpaU0NaSFBhSGZDUG0yUXdVV0VPbWtCRjA1ZnNyWU9mMDNLdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC90ZWNoQ29tbWl0dGVlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiROaFVZVlVqa29meXMzTktidjcvVGFlcXBYemxtWGQ1TFRtNnpleXY1bkFoOUtISFNqb1hRZSI7fQ==', 1721926747),
('vLLft2gIwjXFjvmGGw7RgbJ091T1sX9hvx4o1E3t', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRHZVTWJ0clJsbEFVM0x3dGxDMFVReUlwc2dEVkhwVGNQZHQ1UnliaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vY2UtYWRkLXByb2R1Y3QtdmFsdWVzLzEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJE01cUlkck4wQmhrbXlMNXc2cGRQWE9neGhST1RyWnpueE1kaW1idWJPMHlwcWhJbmpsTUt1Ijt9', 1719928129),
('Vm0zTAXWA3uGVizvR9fJthPaSQjwYcGRG9YiUfvk', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoid3Rkd0hLbmNIQUhxUXgzR2JvSFJrMmJDOW1FMlR2NWJ1cldYeU03SyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJE5oVVlWVWprb2Z5czNOS2J2Ny9UYWVxcFh6bG1YZDVMVG02emV5djVuQWg5S0hIU2pvWFFlIjt9', 1719080565),
('VPLjBVWL17lmXeWBbIE7Sz9hx6BOBDRvyqBdITrE', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiN0k2RHFYNGZSQWxsTTcweEh0UTZtZ1I1TjZVTTQ5cENlOXZMZjJJUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJFFIcEJTNUpNSXpIVDB5TDFmVnJ6c2VHb2t2bzRNcEoxSWFxb2xzbHFhMi82eDBqV0YxOHJXIjt9', 1723398544),
('vvHMHk8U7k1MrbuzyijUmK0R5OyCw5qXrstjncbe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWxLR1ZkSjRLZlB6QUN4OTcwcmtJd0kyV0V6ekpXbVFheUlNdGJ1eiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1720029250),
('W3VmrXtQGBWJa39H9CIFooILYv61CbGLM9GnDctc', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSERRYU11MUM2aUI0cTJUZUt4TThiZjREU3hkWjNaZXdreGZvR1BvSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0L3JlcXVlc3QvbGlzdCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkUFJNSVJpOWlTVzVZVU5RY0dMbXM0ZXdnMTJCalpDNTlHMGZWWXpUYkFXNnF0RmRZUGdxNG0iO30=', 1719307854),
('wOgVxxE0qRhiiK28h9au0BcLqEXEGG6Ca69vtcVs', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYk5aNG1ybkhaT2dmNGhaZTNYMEljYm5tM29MTGVGYVczbzh3a0QxZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vY2UtY29tbWl0dGVlLWxpc3QiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJE5oVVlWVWprb2Z5czNOS2J2Ny9UYWVxcFh6bG1YZDVMVG02emV5djVuQWg5S0hIU2pvWFFlIjt9', 1720011212),
('WOKJJO0PqkbPLZ1tXDB4O6pBz9J2l47dIr0RJgm6', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVGZRTldkaUNzeXF0eXFJcjB0WUxsRXVOQVQyQjhSOXk5WmNYWFo0aCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9pbml0aWF0b3Itbm90ZXMvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiROaFVZVlVqa29meXMzTktidjcvVGFlcXBYemxtWGQ1TFRtNnpleXY1bkFoOUtISFNqb1hRZSI7fQ==', 1721898349),
('wUjXTdhH0v6Ymy4jR681yAgZDao4oFpR1ODZ0Xk1', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoid2EyTjdsYkRhQnU3TmJvSWc2TFVvZU8wY2FTMmpkdnNYUXlFV2d3QiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZXF1aXNpdGlvbnMvY3JlYXRlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRWYWJ5em00S3Z0Umd3VkhXdjhLb3F1L1JzaU5haFB1aGNCei9nSlZycGhVVW5kcHBvbUdvTyI7fQ==', 1724492140),
('XAXM6IqwIYVKv1QAYZCWR14oUtbOPxNjVQNWj3u5', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidGZzVXJ0UGltaXBadk0zR2dhdHBOUUN6cElhdjlocUpCVFUwQzZGdiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2luaXRpYXRvci1maWxlcy8xOCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaW5pdGlhdG9yLWZpbGVzLzE4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1720053381),
('ykqf8QqE9uDyD7yyrNnEVnFtSCSVEWeOdrnqEJFf', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWlM4RkZDZGs4TkEydmJibUFNQ3JYWE5rWlhIYkx6TlhBWnFjNEhFMSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9pbml0aWF0b3Itbm90ZS1hdHRhY2htZW50cy9jcmVhdGUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJE5oVVlWVWprb2Z5czNOS2J2Ny9UYWVxcFh6bG1YZDVMVG02emV5djVuQWg5S0hIU2pvWFFlIjt9', 1724492159),
('Z1s7skL3lFfztPBt4m8F92NVEn6oIVHmw8sWPDZf', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQVBuWUZVZGVLeG5YSWQzeEN4N2Z0Rjl2R2NEVW83bmNSYjQzb0ptciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9pbml0aWF0b3Itbm90ZS1hdHRhY2htZW50cy9jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJE5oVVlWVWprb2Z5czNOS2J2Ny9UYWVxcFh6bG1YZDVMVG02emV5djVuQWg5S0hIU2pvWFFlIjt9', 1722216036);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_informations`
--

CREATE TABLE `store_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_name` varchar(250) DEFAULT NULL,
  `store_location` varchar(250) DEFAULT NULL,
  `store_contact` varchar(50) DEFAULT NULL,
  `store_type_id` int(11) DEFAULT NULL,
  `circle_id` int(11) DEFAULT NULL,
  `zone_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_office` int(11) DEFAULT NULL,
  `office_type` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_product_finals`
--

CREATE TABLE `store_product_finals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `rni_no` int(11) DEFAULT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `final_quantity` double DEFAULT NULL,
  `temp_quantity` double DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_informations`
--

CREATE TABLE `supplier_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` text DEFAULT NULL,
  `supplier_address` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supply_order_informations`
--

CREATE TABLE `supply_order_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proc_id` bigint(20) UNSIGNED DEFAULT NULL,
  `so_no` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `so_date` date DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_allocated_products`
--

CREATE TABLE `temp_allocated_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `requisition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `rni_no` int(11) DEFAULT NULL,
  `from_wh` int(11) DEFAULT NULL,
  `to_snd` int(11) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `spec` text DEFAULT NULL,
  `product_condition_id` int(11) DEFAULT NULL,
  `product_identification_no` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_received_products`
--

CREATE TABLE `temp_received_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `unit_type` int(11) DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `spec` text DEFAULT NULL,
  `recieved_store` int(11) DEFAULT NULL,
  `product_condition_id` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_requisition_products`
--

CREATE TABLE `temp_requisition_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `spec` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_types`
--

CREATE TABLE `unit_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `symbol` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_types`
--

INSERT INTO `unit_types` (`id`, `name`, `symbol`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Piece', 'pc', 1, '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(2, 'Kilogram', 'kg', 1, '2024-06-19 03:59:37', '2024-06-19 03:59:37'),
(3, 'Liter', 'L', 1, '2024-06-19 03:59:37', '2024-06-19 03:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `designation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `auth_by` bigint(20) UNSIGNED DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `designation_id`, `department_id`, `auth_by`, `store_id`, `profile_photo_path`, `signature`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Md. Kamrul Hasan', 'hasan@email.com', NULL, '$2y$12$/YrnijodL8bA9twUSiQZKOoujo3D6VaiCVxag0CN.HFCQjZoCRz0u', NULL, NULL, NULL, NULL, 1, 1, 5, NULL, '240620.1718911245.253814227_4690324451088536_6378174989429893401_n.jpg', '240702.1719910816.download.png', 1, '2024-06-19 03:59:37', '2024-07-02 03:00:16'),
(2, 'Nadim Hossain', 'nadim@gmail.com', NULL, '$2y$12$QHpBS5JMIzHT0yL1fVrzseGokvo4MpJ1Iaqolslqa2/6x0jWF18rW', NULL, NULL, NULL, NULL, 2, 2, 1, NULL, '240620.1718911451.344432260_606360931199690_2525309686793001460_n.jpg', '240702.1719910831.happy-new-year-2024-with-fireworks-background-celebration-new-year-2024-2DCBC44.jpg', 1, '2024-06-19 03:59:37', '2024-07-02 03:00:31'),
(3, 'Prince', 'prince@ussbd.com', NULL, '$2y$12$PRMIRi9iSW5YUNQcGLms4ewg12BjZC59G0fVYzTbAW6qtFdYPgq4m', NULL, NULL, NULL, NULL, 1, 1, 2, NULL, '240621.1718971438.Abu Bakar Siddique.jpg', '240702.1719910806.download (1).png', 1, '2024-06-21 06:03:59', '2024-07-02 03:00:06'),
(4, 'Rasel', 'rasel@ussbd.com', NULL, '$2y$12$NhUYVUjkofys3NKbv7/TaeqpXzlmXd5LTm6zeyv5nAh9KHHSjoXQe', NULL, NULL, NULL, NULL, 2, 2, 3, NULL, '240621.1718971502.344357323_271830475199232_2199113541025589111_n.jpg', '240702.1719910795.20220911_1662871418_659911.jpeg', 1, '2024-06-21 06:05:02', '2024-07-02 02:59:55'),
(5, 'Abdur Rahman', 'abdur@gmail.com', NULL, '$2y$12$M5qIdrN0BhkmyL5w6pdPXOgxhROTrZznxMdimbubO0ypqhInjlMKu', NULL, NULL, NULL, NULL, 1, 2, 3, NULL, '240621.1718971541.408299200_2059730854392121_7300253619520243600_n.jpg', '240702.1719910771.9520103_R_Z001A.jpeg', 1, '2024-06-21 06:05:41', '2024-07-02 02:59:31'),
(6, 'Naim Hossain', 'naim@gmail.com', NULL, '$2y$12$Vabyzm4KvtRgwVHWv8Koqu/RsiNahPuhcBz/gJVrphUUndppomGoO', NULL, NULL, NULL, NULL, 2, 1, NULL, NULL, NULL, '240702.1719910771.9520103_R_Z001A.jpeg', 1, '2024-06-23 03:33:04', '2024-06-23 03:33:04'),
(7, 'test User', 'test@gmail.com', NULL, '$2y$12$PcWDQoNy8OMZzIQqRaJBWeo2rdxOTVcMUfqwDvuVPapXfsLeRpQZu', NULL, NULL, NULL, NULL, 3, 2, 4, NULL, '240624.1719221213.404293411_3629874550591190_7306627091761002814_n.jpg', '240704.1720117107.download.png', 1, '2024-06-24 03:26:53', '2024-07-04 12:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocated_products`
--
ALTER TABLE `allocated_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `allocated_products_requisition_id_foreign` (`requisition_id`),
  ADD KEY `allocated_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `allocations`
--
ALTER TABLE `allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `allocations_user_id_foreign` (`user_id`),
  ADD KEY `allocations_requisition_id_foreign` (`requisition_id`);

--
-- Indexes for table `authorized_persons`
--
ALTER TABLE `authorized_persons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authorized_persons_allocation_id_foreign` (`allocation_id`);

--
-- Indexes for table `committees`
--
ALTER TABLE `committees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `committees_secretary_foreign` (`secretary`),
  ADD KEY `committees_chairman_id_foreign` (`chairman_id`),
  ADD KEY `committees_requisition_id_foreign` (`requisition_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drafts`
--
ALTER TABLE `drafts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_id` (`file_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `file_committees`
--
ALTER TABLE `file_committees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_committees_secretary_foreign` (`secretary`),
  ADD KEY `file_committees_chairman_foreign` (`chairman`),
  ADD KEY `file_committees_initiator_file_id_foreign` (`initiator_file_id`),
  ADD KEY `file_committees_initiator_id_foreign` (`initiator_id`);

--
-- Indexes for table `important_purchases`
--
ALTER TABLE `important_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `important_purchases_requisition_id_foreign` (`requisition_id`),
  ADD KEY `important_purchases_product_id_foreign` (`product_id`),
  ADD KEY `important_purchases_user_id_foreign` (`user_id`);

--
-- Indexes for table `initiator_files`
--
ALTER TABLE `initiator_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `initiator_files_oce_dpm_foreign` (`oce_dpm`);

--
-- Indexes for table `initiator_notes`
--
ALTER TABLE `initiator_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `initiator_notes_initiator_file_id_foreign` (`initiator_file_id`),
  ADD KEY `initiator_notes_initiator_id_foreign` (`initiator_id`);

--
-- Indexes for table `initiator_note_attachments`
--
ALTER TABLE `initiator_note_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `initiator_note_attachments_initiator_note_id_foreign` (`initiator_note_id`);

--
-- Indexes for table `initiator_note_reviews`
--
ALTER TABLE `initiator_note_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `initiator_note_reviews_initiator_note_id_foreign` (`initiator_note_id`),
  ADD KEY `initiator_note_reviews_reviewer_id_foreign` (`reviewer_id`),
  ADD KEY `department` (`department`),
  ADD KEY `designation` (`designation`);

--
-- Indexes for table `issue_vouchers`
--
ALTER TABLE `issue_vouchers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issue_vouchers_allocation_id_foreign` (`allocation_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `procurement_informations`
--
ALTER TABLE `procurement_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_product_sub_categorie_id_foreign` (`product_sub_categorie_id`),
  ADD KEY `products_unit_type_id_foreign` (`unit_type_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_committees`
--
ALTER TABLE `product_committees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_committees_product_id_foreign` (`product_id`),
  ADD KEY `product_committees_committee_id_foreign` (`demand_committee_id`),
  ADD KEY `product_committees_sub_catagory_id_foreign` (`sub_catagory_id`);

--
-- Indexes for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_sub_categories_product_category_id_foreign` (`product_category_id`);

--
-- Indexes for table `received_informations`
--
ALTER TABLE `received_informations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `received_informations_user_id_foreign` (`user_id`);

--
-- Indexes for table `received_products`
--
ALTER TABLE `received_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `received_products_received_id_foreign` (`Received_id`),
  ADD KEY `received_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requisitions_user_id_foreign` (`user_id`),
  ADD KEY `requisitions_requisition_type_id_foreign` (`requisition_type_id`);

--
-- Indexes for table `requisition_attachments`
--
ALTER TABLE `requisition_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requisition_attachments_requisition_id_foreign` (`requisition_id`);

--
-- Indexes for table `requisition_products`
--
ALTER TABLE `requisition_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requisition_products_requisition_id_foreign` (`requisition_id`),
  ADD KEY `requisition_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `requisition_signatures`
--
ALTER TABLE `requisition_signatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requisition_signatures_requisition_id_foreign` (`requisition_id`);

--
-- Indexes for table `requisition_types`
--
ALTER TABLE `requisition_types`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `store_informations`
--
ALTER TABLE `store_informations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_informations_zone_id_foreign` (`zone_id`);

--
-- Indexes for table `store_product_finals`
--
ALTER TABLE `store_product_finals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_product_finals_product_id_foreign` (`product_id`),
  ADD KEY `store_product_finals_store_id_foreign` (`store_id`);

--
-- Indexes for table `supplier_informations`
--
ALTER TABLE `supplier_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supply_order_informations`
--
ALTER TABLE `supply_order_informations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supply_order_informations_proc_id_foreign` (`proc_id`);

--
-- Indexes for table `temp_allocated_products`
--
ALTER TABLE `temp_allocated_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temp_allocated_products_user_id_foreign` (`user_id`),
  ADD KEY `temp_allocated_products_requisition_id_foreign` (`requisition_id`),
  ADD KEY `temp_allocated_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `temp_received_products`
--
ALTER TABLE `temp_received_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temp_received_products_user_id_foreign` (`user_id`),
  ADD KEY `temp_received_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `temp_requisition_products`
--
ALTER TABLE `temp_requisition_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temp_requisition_products_user_id_foreign` (`user_id`),
  ADD KEY `temp_requisition_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `unit_types`
--
ALTER TABLE `unit_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_designation_id_foreign` (`designation_id`),
  ADD KEY `auth_by` (`auth_by`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocated_products`
--
ALTER TABLE `allocated_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `allocations`
--
ALTER TABLE `allocations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `authorized_persons`
--
ALTER TABLE `authorized_persons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `committees`
--
ALTER TABLE `committees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drafts`
--
ALTER TABLE `drafts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_committees`
--
ALTER TABLE `file_committees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `important_purchases`
--
ALTER TABLE `important_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `initiator_files`
--
ALTER TABLE `initiator_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `initiator_notes`
--
ALTER TABLE `initiator_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `initiator_note_attachments`
--
ALTER TABLE `initiator_note_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `initiator_note_reviews`
--
ALTER TABLE `initiator_note_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `issue_vouchers`
--
ALTER TABLE `issue_vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `procurement_informations`
--
ALTER TABLE `procurement_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_committees`
--
ALTER TABLE `product_committees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `received_informations`
--
ALTER TABLE `received_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `received_products`
--
ALTER TABLE `received_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requisitions`
--
ALTER TABLE `requisitions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requisition_attachments`
--
ALTER TABLE `requisition_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requisition_products`
--
ALTER TABLE `requisition_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requisition_signatures`
--
ALTER TABLE `requisition_signatures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requisition_types`
--
ALTER TABLE `requisition_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_informations`
--
ALTER TABLE `store_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_product_finals`
--
ALTER TABLE `store_product_finals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_informations`
--
ALTER TABLE `supplier_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supply_order_informations`
--
ALTER TABLE `supply_order_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_allocated_products`
--
ALTER TABLE `temp_allocated_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_received_products`
--
ALTER TABLE `temp_received_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_requisition_products`
--
ALTER TABLE `temp_requisition_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unit_types`
--
ALTER TABLE `unit_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allocated_products`
--
ALTER TABLE `allocated_products`
  ADD CONSTRAINT `allocated_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `allocated_products_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`);

--
-- Constraints for table `allocations`
--
ALTER TABLE `allocations`
  ADD CONSTRAINT `allocations_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`),
  ADD CONSTRAINT `allocations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `authorized_persons`
--
ALTER TABLE `authorized_persons`
  ADD CONSTRAINT `authorized_persons_allocation_id_foreign` FOREIGN KEY (`allocation_id`) REFERENCES `allocations` (`id`);

--
-- Constraints for table `committees`
--
ALTER TABLE `committees`
  ADD CONSTRAINT `committees_chairman_id_foreign` FOREIGN KEY (`chairman_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `committees_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`),
  ADD CONSTRAINT `committees_secretary_foreign` FOREIGN KEY (`secretary`) REFERENCES `users` (`id`);

--
-- Constraints for table `drafts`
--
ALTER TABLE `drafts`
  ADD CONSTRAINT `drafts_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `initiator_files` (`id`),
  ADD CONSTRAINT `drafts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `file_committees`
--
ALTER TABLE `file_committees`
  ADD CONSTRAINT `file_committees_chairman_foreign` FOREIGN KEY (`chairman`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `file_committees_initiator_file_id_foreign` FOREIGN KEY (`initiator_file_id`) REFERENCES `initiator_files` (`id`),
  ADD CONSTRAINT `file_committees_initiator_id_foreign` FOREIGN KEY (`initiator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `file_committees_secretary_foreign` FOREIGN KEY (`secretary`) REFERENCES `users` (`id`);

--
-- Constraints for table `important_purchases`
--
ALTER TABLE `important_purchases`
  ADD CONSTRAINT `important_purchases_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `important_purchases_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `important_purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `initiator_files`
--
ALTER TABLE `initiator_files`
  ADD CONSTRAINT `initiator_files_oce_dpm_foreign` FOREIGN KEY (`oce_dpm`) REFERENCES `committees` (`id`);

--
-- Constraints for table `initiator_notes`
--
ALTER TABLE `initiator_notes`
  ADD CONSTRAINT `initiator_notes_initiator_file_id_foreign` FOREIGN KEY (`initiator_file_id`) REFERENCES `initiator_files` (`id`),
  ADD CONSTRAINT `initiator_notes_initiator_id_foreign` FOREIGN KEY (`initiator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `initiator_note_attachments`
--
ALTER TABLE `initiator_note_attachments`
  ADD CONSTRAINT `initiator_note_attachments_initiator_note_id_foreign` FOREIGN KEY (`initiator_note_id`) REFERENCES `initiator_notes` (`id`);

--
-- Constraints for table `initiator_note_reviews`
--
ALTER TABLE `initiator_note_reviews`
  ADD CONSTRAINT `initiator_note_reviews_ibfk_1` FOREIGN KEY (`department`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `initiator_note_reviews_ibfk_2` FOREIGN KEY (`designation`) REFERENCES `designations` (`id`),
  ADD CONSTRAINT `initiator_note_reviews_initiator_note_id_foreign` FOREIGN KEY (`initiator_note_id`) REFERENCES `initiator_notes` (`id`),
  ADD CONSTRAINT `initiator_note_reviews_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `issue_vouchers`
--
ALTER TABLE `issue_vouchers`
  ADD CONSTRAINT `issue_vouchers_allocation_id_foreign` FOREIGN KEY (`allocation_id`) REFERENCES `allocations` (`id`);

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
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_product_sub_categorie_id_foreign` FOREIGN KEY (`product_sub_categorie_id`) REFERENCES `product_sub_categories` (`id`),
  ADD CONSTRAINT `products_unit_type_id_foreign` FOREIGN KEY (`unit_type_id`) REFERENCES `unit_types` (`id`);

--
-- Constraints for table `product_committees`
--
ALTER TABLE `product_committees`
  ADD CONSTRAINT `product_committees_committee_id_foreign` FOREIGN KEY (`demand_committee_id`) REFERENCES `committees` (`id`),
  ADD CONSTRAINT `product_committees_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_committees_sub_catagory_id_foreign` FOREIGN KEY (`sub_catagory_id`) REFERENCES `product_sub_categories` (`id`);

--
-- Constraints for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  ADD CONSTRAINT `product_sub_categories_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`);

--
-- Constraints for table `received_informations`
--
ALTER TABLE `received_informations`
  ADD CONSTRAINT `received_informations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `received_products`
--
ALTER TABLE `received_products`
  ADD CONSTRAINT `received_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `received_products_received_id_foreign` FOREIGN KEY (`Received_id`) REFERENCES `received_informations` (`id`);

--
-- Constraints for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD CONSTRAINT `requisitions_requisition_type_id_foreign` FOREIGN KEY (`requisition_type_id`) REFERENCES `requisition_types` (`id`),
  ADD CONSTRAINT `requisitions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `requisition_attachments`
--
ALTER TABLE `requisition_attachments`
  ADD CONSTRAINT `requisition_attachments_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`);

--
-- Constraints for table `requisition_products`
--
ALTER TABLE `requisition_products`
  ADD CONSTRAINT `requisition_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `requisition_products_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`);

--
-- Constraints for table `requisition_signatures`
--
ALTER TABLE `requisition_signatures`
  ADD CONSTRAINT `requisition_signatures_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `store_informations`
--
ALTER TABLE `store_informations`
  ADD CONSTRAINT `store_informations_zone_id_foreign` FOREIGN KEY (`zone_id`) REFERENCES `zones` (`id`);

--
-- Constraints for table `store_product_finals`
--
ALTER TABLE `store_product_finals`
  ADD CONSTRAINT `store_product_finals_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `store_product_finals_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `store_informations` (`id`);

--
-- Constraints for table `supply_order_informations`
--
ALTER TABLE `supply_order_informations`
  ADD CONSTRAINT `supply_order_informations_proc_id_foreign` FOREIGN KEY (`proc_id`) REFERENCES `procurement_informations` (`id`);

--
-- Constraints for table `temp_allocated_products`
--
ALTER TABLE `temp_allocated_products`
  ADD CONSTRAINT `temp_allocated_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `temp_allocated_products_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`),
  ADD CONSTRAINT `temp_allocated_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `temp_received_products`
--
ALTER TABLE `temp_received_products`
  ADD CONSTRAINT `temp_received_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `temp_received_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `temp_requisition_products`
--
ALTER TABLE `temp_requisition_products`
  ADD CONSTRAINT `temp_requisition_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `temp_requisition_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`),
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`auth_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
