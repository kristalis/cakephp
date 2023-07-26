-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2023 at 01:06 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kabook`
--

-- --------------------------------------------------------

--
-- Table structure for table `clips`
--

CREATE TABLE `clips` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clips`
--

INSERT INTO `clips` (`id`, `name`, `created_at`, `updated_at`, `video`) VALUES
(1, 'Cakephp', '2023-07-25 03:06:15', '2023-07-25 03:06:15', ''),
(2, 'Java', '2023-07-25 03:06:15', '2023-07-25 03:06:15', ''),
(3, 'Java Script', '2023-07-25 03:06:15', '2023-07-25 03:06:15', ''),
(4, 'Laravel', '2023-07-25 03:06:15', '2023-07-25 03:06:15', ''),
(5, 'Life Science', '2023-07-25 09:06:49', '2023-07-25 09:06:49', 'Life Science_1690258009.mp4'),
(6, 'Space Science', '2023-07-25 09:06:49', '2023-07-25 09:06:49', 'Space Science_1690258009.mp4'),
(7, 'Water Engineering', '2023-07-25 09:06:50', '2023-07-25 09:06:50', 'Water Engineering_1690258010.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `clip_collections`
--

CREATE TABLE `clip_collections` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `screen_collection_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clip_collections`
--

INSERT INTO `clip_collections` (`id`, `name`, `screen_collection_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'Cakephp', 1, '2023-06-30', '2023-07-07', '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(2, 'Laravel', 2, '2023-06-29', '2023-07-17', '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(3, 'PHP', 3, '2023-06-29', '2023-07-17', '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(4, 'Yii', 4, '2023-06-29', '2023-07-17', '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(5, 'Science F', 3, '2023-07-25', '2023-07-25', '2023-07-25 09:06:49', '2023-07-25 09:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `clip_collections_items`
--

CREATE TABLE `clip_collections_items` (
  `id` int(11) NOT NULL,
  `clip_collection_id` int(11) DEFAULT NULL,
  `clip_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clip_collections_items`
--

INSERT INTO `clip_collections_items` (`id`, `clip_collection_id`, `clip_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(2, 2, 2, '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(3, 2, 3, '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(4, 3, 3, '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(5, 3, 2, '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(6, 3, 4, '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(7, 4, 3, '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(8, 4, 1, '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(9, 4, 2, '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(10, 4, 4, '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(11, 5, 5, '2023-07-25 09:06:49', '2023-07-25 09:06:49'),
(12, 5, 6, '2023-07-25 09:06:49', '2023-07-25 09:06:49'),
(13, 5, 7, '2023-07-25 09:06:50', '2023-07-25 09:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `clip_images`
--

CREATE TABLE `clip_images` (
  `id` int(11) NOT NULL,
  `clip_id` int(11) DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clip_images`
--

INSERT INTO `clip_images` (`id`, `clip_id`, `filename`, `created_at`, `updated_at`) VALUES
(1, 1, 'ckae_image.jpg', '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(2, 2, 'java.jpg', '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(3, 3, 'java_script.jpg', '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(4, 4, 'laravel.jpg', '2023-07-25 03:06:15', '2023-07-25 03:06:15'),
(5, 5, 'Life Science_1690258009.jpg', '2023-07-25 09:06:49', '2023-07-25 09:06:49'),
(6, 6, 'Space Science_1690258009.jpg', '2023-07-25 09:06:49', '2023-07-25 09:06:49'),
(7, 7, 'Water Engineering_1690258010.jpg', '2023-07-25 09:06:50', '2023-07-25 09:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20230701092649, 'Createclips', '2023-07-25 03:05:56', '2023-07-25 03:05:56', 0),
(20230701110846, 'CreateBookImages', '2023-07-25 03:05:56', '2023-07-25 03:05:57', 0),
(20230701111449, 'CreateLibCollections', '2023-07-25 03:05:57', '2023-07-25 03:05:58', 0),
(20230701111652, 'CreateBookCollections', '2023-07-25 03:05:58', '2023-07-25 03:05:59', 0),
(20230701112247, 'CreateBookCollectionsclips', '2023-07-25 03:05:59', '2023-07-25 03:06:00', 0),
(20230720213633, 'ChangeclipsTable', '2023-07-25 03:06:00', '2023-07-25 03:06:00', 0),
(20230721193652, 'ChangeclipsTableVideoColumn', '2023-07-25 03:06:00', '2023-07-25 03:06:00', 0),
(20230721193915, 'ChangeclipsTableVideoColumn1', '2023-07-25 03:06:00', '2023-07-25 03:06:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `screen_collections`
--

CREATE TABLE `screen_collections` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `screen_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `screen_collections`
--

INSERT INTO `screen_collections` (`id`, `name`, `screen_count`, `created_at`, `updated_at`) VALUES
(1, 'Screen 1', 1, '2023-07-25 03:06:15', '2023-07-26 10:27:36'),
(2, 'Screen 2', 2, '2023-07-25 03:06:15', '2023-07-26 10:27:46'),
(3, 'Screen 3', 3, '2023-07-25 03:06:15', '2023-07-26 10:27:51'),
(4, 'Screen 4', 4, '2023-07-25 03:06:15', '2023-07-26 10:27:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clips`
--
ALTER TABLE `clips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clip_collections`
--
ALTER TABLE `clip_collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `screen_collection_id` (`screen_collection_id`);

--
-- Indexes for table `clip_collections_items`
--
ALTER TABLE `clip_collections_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clip_collection_id` (`clip_collection_id`),
  ADD KEY `clip_id` (`clip_id`);

--
-- Indexes for table `clip_images`
--
ALTER TABLE `clip_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clip_id` (`clip_id`);

--
-- Indexes for table `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `screen_collections`
--
ALTER TABLE `screen_collections`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clips`
--
ALTER TABLE `clips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clip_collections`
--
ALTER TABLE `clip_collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clip_collections_items`
--
ALTER TABLE `clip_collections_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `clip_images`
--
ALTER TABLE `clip_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `screen_collections`
--
ALTER TABLE `screen_collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clip_collections`
--
ALTER TABLE `clip_collections`
  ADD CONSTRAINT `clip_collections_ibfk_1` FOREIGN KEY (`screen_collection_id`) REFERENCES `screen_collections` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `clip_collections_items`
--
ALTER TABLE `clip_collections_items`
  ADD CONSTRAINT `clip_collections_items_ibfk_1` FOREIGN KEY (`clip_collection_id`) REFERENCES `clip_collections` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `clip_collections_items_ibfk_2` FOREIGN KEY (`clip_id`) REFERENCES `clips` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `clip_images`
--
ALTER TABLE `clip_images`
  ADD CONSTRAINT `clip_images_ibfk_1` FOREIGN KEY (`clip_id`) REFERENCES `clips` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
