-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2023 at 07:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `netflop`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `not_id` bigint(200) NOT NULL,
  `body` text NOT NULL,
  `post_id` varchar(255) NOT NULL,
  `read_by` longtext DEFAULT NULL,
  `posted_time` datetime NOT NULL DEFAULT current_timestamp(),
  `triggered_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`not_id`, `body`, `post_id`, `read_by`, `posted_time`, `triggered_by`) VALUES
(1, 'There are some discussions going wild about \'Family Guy\'', 'tv/1434', '4zur3/_____/admin', '2023-12-11 16:22:56', 'admin'),
(2, 'There is a wild discussion about \'Doctor Who\'', 'tv/57243', 'admin', '2023-12-11 16:57:03', 'admin'),
(3, 'There is a wild discussion about \'Formula 1: Drive to Survive\'', 'tv/87083', NULL, '2023-12-11 19:25:18', 'admin'),
(4, 'There is a new review about \'Formula 1: Drive to Survive\', it\'s getting hot!', 'tv/87083', NULL, '2023-12-11 19:29:02', '4zur3'),
(5, 'test notification', 'tv/1434', 'hung15902/_____/4zur3', '2023-12-11 20:14:22', 'admin'),
(6, 'more testing', 'tv/1434', 'hung15902/_____/4zur3/_____/testy', '2023-12-11 20:19:47', 'admin'),
(7, 'There is a new review about \'Family Guy\', it\'s getting hot!', 'tv/1434', '4zur3', '2023-12-11 20:35:43', 'hung15902'),
(8, 'There is a new review about \'Family Guy\', it\'s getting hot!', 'tv/1434', '4zur3', '2023-12-12 20:08:12', 'datlogarit'),
(9, '[ADMIN] test global announcement', 'admin', 'ronaldo/_____/4zur3', '2023-12-17 19:24:09', 'admin'),
(10, '[ADMIN] alo la co tien', 'admin', 'ronaldo/_____/4zur3/_____/testy', '2023-12-17 19:47:12', 'admin'),
(11, 'There is a new review about \'Trolls Band Together\', it\'s getting hot!', 'm/901362', NULL, '2023-12-18 21:35:49', 'admin'),
(12, 'There is a new review about \'Trolls Band Together\', it\'s getting hot!', 'm/901362', NULL, '2023-12-18 21:41:48', '4zur3'),
(13, 'There is a new review about \'Trolls Band Together\', it\'s getting hot!', 'm/901362', NULL, '2023-12-19 11:06:58', 'testy'),
(14, 'There is a new review about \'Trolls Band Together\', it\'s getting hot!', 'm/901362', NULL, '2023-12-19 11:40:07', 'admin'),
(15, 'There is a new review about \'Trolls Band Together\', it\'s getting hot!', 'm/901362', NULL, '2023-12-19 11:41:56', 'admin'),
(16, 'There is a new review about \'Trolls Band Together\', it\'s getting hot!', 'm/901362', NULL, '2023-12-19 11:42:39', 'admin'),
(17, 'There is a new review about \'Trolls Band Together\', it\'s getting hot!', 'm/901362', NULL, '2023-12-19 12:07:34', 'admin'),
(18, 'There is a new review about \'Trolls Band Together\', it\'s getting hot!', 'm/901362', NULL, '2023-12-19 20:47:01', 'testy'),
(19, 'There is a new review about \'Phineas and Ferb The Movie: Candace Against the Universe\', it\'s getting hot!', 'm/594328', NULL, '2023-12-19 21:23:36', 'hung15902'),
(20, 'There is a new review about \'Family Guy\', it\'s getting hot!', 'tv/1434', '4zur3/_____/admin', '2023-12-20 10:49:53', 'ronaldo'),
(21, '[ADMIN] test thong bao 21/12/2023', 'admin', NULL, '2023-12-21 22:44:58', 'admin'),
(22, '[ADMIN] test thong bao admin2', 'admin', NULL, '2023-12-21 22:47:33', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` bigint(20) UNSIGNED NOT NULL,
  `reason` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `review_id` bigint(20) UNSIGNED NOT NULL,
  `review_body` text DEFAULT NULL,
  `reported_by` varchar(255) NOT NULL,
  `is_solved` int(2) NOT NULL DEFAULT 0 COMMENT '0: normal, 1: solved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `reason`, `username`, `review_id`, `review_body`, `reported_by`, `is_solved`) VALUES
(1, 'noi nang vo van', 'testy', 10, NULL, '4zur3', 1),
(2, 'test report', 'test1', 7, NULL, 'testy', 1),
(3, 'test report trung ten', 'test1', 7, NULL, '4zur3', 1),
(10, 'test report kem context', 'hung15902', 11, 'toi thay ok', '4zur3', 0),
(11, 'test report moi\' 19/12', '4zur3', 14, 'review troll band together 2023', 'testy', 0),
(12, 'bảy chọ vấp cỏ hôi pen', 'ronaldo', 22, 'ronaldo da xem', 'testy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` bigint(20) UNSIGNED NOT NULL,
  `type` char(5) NOT NULL,
  `post_id` char(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `body` text NOT NULL,
  `submit_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `type`, `post_id`, `username`, `rating`, `body`, `submit_time`) VALUES
(1, 'tv', '1434', 'admin', 9, 'phim ok', '2023-12-10 06:19:17'),
(4, 'tv', '1434', '4zur3', 9, 'vua xoa xong cho nen review lai', '2023-12-11 12:45:50'),
(8, 'tv', '57243', 'admin', 5, 'alo', '2023-12-11 09:57:02'),
(10, 'tv', '87083', 'testy', 1, 'huh', '2023-12-11 12:29:01'),
(11, 'tv', '1434', 'hung15902', 7, 'toi thay ok', '2023-12-11 13:35:43'),
(14, 'm', '901362', '4zur3', 8, 'review troll band together 2023', '2023-12-18 14:41:47'),
(19, 'm', '901362', 'admin', 5, 'test test testttttttt', '2023-12-19 05:07:33'),
(20, 'm', '901362', 'testy', 9, 'review lai do vua bi xoa', '2023-12-19 13:47:01'),
(21, 'm', '594328', 'hung15902', 9, 'xem r, phim hay', '2023-12-19 14:23:36'),
(22, 'tv', '1434', 'ronaldo', 8, 'ronaldo da xem', '2023-12-20 03:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `role` char(255) NOT NULL DEFAULT 'normal',
  `email` varchar(255) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fullname` varchar(255) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1: normal, 0:banned',
  `dob` date DEFAULT NULL,
  `favorite` longtext DEFAULT '\'admin\''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `hash`, `role`, `email`, `created_time`, `fullname`, `status`, `dob`, `favorite`) VALUES
('4zur3', '052e3982a284e3f5d40b7d81012328755eaa5142567d0bc24b1a32d662b14333', 'normal', 'sbg.hungboyz@gmail.com', '2023-12-20 12:55:41', 'Do Viet Hung', 1, '2002-09-15', 'tv/1434,admin'),
('admin', 'd200ae5a4aeb88e378c533f71b4eaf8c83daaf932e925aaa193f6d071273ca0d', 'admin', '4zur3.com@gmail.com', '2023-12-21 12:47:36', 'Hunter Do', 1, '2002-09-15', 'tv/87083,tv/1434,m/1057088,m/71689,m/1048903,m/793822,m/668068,m/1063616,m/901362,m/1047041,m/257512'),
('admin2', 'd200ae5a4aeb88e378c533f71b4eaf8c83daaf932e925aaa193f6d071273ca0d', 'admin', 'admin2@gmail.com', '2023-12-17 12:18:53', 'Test admin phu', 1, NULL, 'admin'),
('bantest', '3f8bb66db22c3223b8484385c2ad00a8d69d492b945891aacb37e9435f5b42f4', 'normal', 'test@gmail.com', '2023-12-21 15:44:25', NULL, 0, NULL, 'admin'),
('bugfix', '3f8bb66db22c3223b8484385c2ad00a8d69d492b945891aacb37e9435f5b42f4', 'normal', 'bug@gmail.com', '2023-12-24 02:41:32', NULL, 1, NULL, '\'admin\',tv/1433'),
('datlogarit', '3f8bb66db22c3223b8484385c2ad00a8d69d492b945891aacb37e9435f5b42f4', 'normal', 'datlogarit@gmail.com', '2023-12-17 12:18:59', NULL, 1, NULL, 'admin'),
('hung15902', '052e3982a284e3f5d40b7d81012328755eaa5142567d0bc24b1a32d662b14333', 'normal', 'doviethung15092002@gmail.com', '2023-12-17 12:19:02', NULL, 1, NULL, 'tv/1434,tv/87083,admin'),
('messi', '3f8bb66db22c3223b8484385c2ad00a8d69d492b945891aacb37e9435f5b42f4', 'normal', 'work@messi.com', '2023-12-17 12:19:05', 'Lionel Messi', 1, '1987-06-24', 'admin'),
('ronaldo', '3f8bb66db22c3223b8484385c2ad00a8d69d492b945891aacb37e9435f5b42f4', 'normal', 'work@cr7.com', '2023-12-17 12:19:08', NULL, 1, NULL, 'admin'),
('test1', '3f8bb66db22c3223b8484385c2ad00a8d69d492b945891aacb37e9435f5b42f4', 'normal', 'test1@gmail.com', '2023-12-21 15:44:45', NULL, 0, NULL, 'admin'),
('test2', '3f8bb66db22c3223b8484385c2ad00a8d69d492b945891aacb37e9435f5b42f4', 'normal', 'test@gmail.come', '2023-12-17 12:19:14', 'TEST', 1, '2003-02-01', 'admin'),
('test3', '3f8bb66db22c3223b8484385c2ad00a8d69d492b945891aacb37e9435f5b42f4', 'normal', 'test3@gmail.com', '2023-12-17 12:19:16', NULL, 1, NULL, 'admin'),
('test4', '3f8bb66db22c3223b8484385c2ad00a8d69d492b945891aacb37e9435f5b42f4', 'normal', 'test4@gmail.com', '2023-12-17 12:19:18', NULL, 1, NULL, 'admin'),
('test5', '3f8bb66db22c3223b8484385c2ad00a8d69d492b945891aacb37e9435f5b42f4', 'normal', 'test5@gmail.com', '2023-12-17 12:19:20', NULL, 1, NULL, 'admin'),
('test6', '3f8bb66db22c3223b8484385c2ad00a8d69d492b945891aacb37e9435f5b42f4', 'normal', 'test6@gmail.com', '2023-12-17 12:19:23', NULL, 1, NULL, 'admin'),
('test7', '3f8bb66db22c3223b8484385c2ad00a8d69d492b945891aacb37e9435f5b42f4', 'normal', 'test7@gmail.com', '2023-12-17 12:19:26', NULL, 1, NULL, 'admin'),
('testy', '3f8bb66db22c3223b8484385c2ad00a8d69d492b945891aacb37e9435f5b42f4', 'normal', 'testy@gmail.com', '2023-12-21 12:25:33', NULL, 1, NULL, 'tv/87083,admin,tv/1434');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`not_id`),
  ADD KEY `not_triggered_by_foreign` (`triggered_by`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `reports_username_foreign` (`username`),
  ADD KEY `reports_reported_by_foreign` (`reported_by`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `reviews_username_foreign` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `not_id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `not_triggered_by_foreign` FOREIGN KEY (`triggered_by`) REFERENCES `users` (`username`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_reported_by_foreign` FOREIGN KEY (`reported_by`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `reports_username_foreign` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_username_foreign` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
