-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2024 at 11:18 AM
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
-- Database: `ku_handbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `university_missions`
--

CREATE TABLE `university_missions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `um_number` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `version` int(11) NOT NULL,
  `university_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `university_missions`
--

INSERT INTO `university_missions` (`id`, `um_number`, `description`, `version`, `university_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'UM1', 'Explore human potential to the fullest extent and produce self-motivated, aspiring leaders to work for the betterment of the humankind based on wisdom, freethinking, creativity and unhindered intellectual exercises.', 2024, 1, 1, NULL, NULL),
(2, 'UM2', 'Ensure a transformative educational experience that enables creative learning, entrepreneurship and inquisitiveness among the students.', 2024, 1, 1, NULL, NULL),
(3, 'UM3', 'Create an inclusive research environment that enables graduates to make demonstrable economic and social impacts through translating knowledge and innovation into practice driven by moral values and professional ethics.', 2024, 1, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `university_missions`
--
ALTER TABLE `university_missions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `university_missions_university_id_foreign` (`university_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `university_missions`
--
ALTER TABLE `university_missions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `university_missions`
--
ALTER TABLE `university_missions`
  ADD CONSTRAINT `university_missions_university_id_foreign` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
