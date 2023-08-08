-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: mysql.ct8.pl
-- Generation Time: Aug 07, 2023 at 06:10 PM
-- Server version: 8.0.32
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m34533_nounblx`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` int NOT NULL,
  `text` longtext NOT NULL,
  `color` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `bans`
--

CREATE TABLE `bans` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `userid` int NOT NULL,
  `moderator` int NOT NULL,
  `reason` varchar(4096) NOT NULL,
  `unbantime` bigint NOT NULL,
  `ip` varchar(255) NOT NULL,
  `bantype` enum('reminder','warning','1dayban','3dayban','7dayban','14dayban','deleteaccount','hwidban','ipban') NOT NULL,
  `unbanned` tinyint(1) NOT NULL,
  `note` varchar(4096) NOT NULL DEFAULT '',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bantime`
--

CREATE TABLE `bantime` (
  `id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE `catalog` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `description` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT '/Thumbs/catalog/',
  `creatorid` int NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `buywith` enum('tix','robux') CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT 'tix',
  `price` int NOT NULL,
  `type` varchar(20) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT 'hat',
  `assetid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` int NOT NULL,
  `author` int NOT NULL,
  `reply_to` int NOT NULL,
  `title` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `content` varchar(8192) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `time_posted` bigint NOT NULL,
  `category` int NOT NULL,
  `is_pinned` int NOT NULL DEFAULT '0',
  `is_locked` tinyint(1) NOT NULL DEFAULT '0',
  `is_important` tinyint(1) NOT NULL DEFAULT '0',
  `is_announcement` tinyint(1) NOT NULL DEFAULT '0',
  `views` int NOT NULL,
  `bump` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forumgroups`
--

CREATE TABLE `forumgroups` (
  `id` int NOT NULL,
  `name` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `forumgroups`
--

INSERT INTO `forumgroups` (`id`, `name`) VALUES
(1, 'NOUNBLOX'),
(2, 'Help Center'),
(3, 'Fun'),
(4, 'Entertainment');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int NOT NULL,
  `user_from` int NOT NULL,
  `user_to` int NOT NULL,
  `arefriends` int NOT NULL,
  `hash` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `description` varchar(1000) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `thumbnail` longtext CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `players` int NOT NULL,
  `favorites` int NOT NULL,
  `creator_id` int NOT NULL,
  `ip` varchar(50) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT '127.0.0.1',
  `port` varchar(5) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT '53640',
  `playerlimit` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `gamesvisits`
--

CREATE TABLE `gamesvisits` (
  `id` int NOT NULL,
  `gameid` int NOT NULL,
  `visitorid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `global`
--

CREATE TABLE `global` (
  `id` int NOT NULL,
  `ShowingSiteAlert1` varchar(255) NOT NULL,
  `SiteAlert1` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ShowingSiteAlert2` varchar(255) NOT NULL,
  `SiteAlert2` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ShowingSiteAlert3` varchar(255) NOT NULL,
  `SiteAlert3` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ShowingSiteAlert4` varchar(255) NOT NULL,
  `SiteAlert4` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ShowingSiteAlert5` varchar(255) NOT NULL,
  `SiteAlert5` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `maintenanceEnabled` varchar(255) NOT NULL,
  `maintenance` varchar(255) NOT NULL,
  `shutdownEnabled` varchar(255) NOT NULL,
  `shutdown` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `invitekeys`
--

CREATE TABLE `invitekeys` (
  `id` int NOT NULL,
  `invkey` varchar(255) NOT NULL,
  `isredeemed` varchar(255) NOT NULL DEFAULT 'no',
  `creatorid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ip_bans`
--

CREATE TABLE `ip_bans` (
  `id` int NOT NULL,
  `ip` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT '0.0.0.0',
  `banned_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `user_from` int NOT NULL,
  `user_to` int NOT NULL,
  `subject` varchar(64) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `datesent` int NOT NULL,
  `readfrom` tinyint(1) NOT NULL DEFAULT '0',
  `readto` tinyint(1) NOT NULL DEFAULT '0',
  `deletefrom` tinyint(1) NOT NULL DEFAULT '0',
  `deleteto` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owned_achievements`
--

CREATE TABLE `owned_achievements` (
  `id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `owned_items`
--

CREATE TABLE `owned_items` (
  `id` int NOT NULL,
  `itemid` int NOT NULL,
  `ownerid` int NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `profileviews`
--

CREATE TABLE `profileviews` (
  `id` int NOT NULL,
  `profile` int NOT NULL,
  `viewer` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int NOT NULL,
  `name` longtext NOT NULL,
  `description` longtext NOT NULL,
  `category` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(20) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `password` varchar(1000) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `robux` int NOT NULL,
  `tix` int NOT NULL DEFAULT '0',
  `next_tix_reward` int NOT NULL,
  `BC` enum('BC','None') CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT 'None',
  `BCExpire` date NOT NULL,
  `next_bc_reward` int NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visittick` int NOT NULL,
  `expiretime` int NOT NULL,
  `blurb` varchar(1000) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `USER_PERMISSIONS` enum('Administrator','Forum_Moderator','None') CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT 'None',
  `chatMode` int NOT NULL DEFAULT '0',
  `age` int NOT NULL DEFAULT '1',
  `rblxid` bigint NOT NULL DEFAULT '156',
  `bantype` enum('None','Reminder','Warning','Ban') CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT 'None',
  `banreason` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `bantime` int NOT NULL,
  `ip` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT '0.0.0.0',
  `accountcode` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `HeadColor` int NOT NULL DEFAULT '24',
  `TorsoColor` int NOT NULL DEFAULT '23',
  `RightLegColor` int NOT NULL DEFAULT '119',
  `RightArmColor` int NOT NULL DEFAULT '24',
  `LeftLegColor` int NOT NULL DEFAULT '119',
  `LeftArmColor` int NOT NULL DEFAULT '24',
  `pose` text CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `thumb` longtext CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `language` enum('EN','FR') CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `bandate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gamesflood` int NOT NULL,
  `forumpostflood` int NOT NULL,
  `forumreplyflood` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `robux`, `tix`, `next_tix_reward`, `BC`, `BCExpire`, `next_bc_reward`, `join_date`, `visittick`, `expiretime`, `blurb`, `USER_PERMISSIONS`, `chatMode`, `age`, `rblxid`, `bantype`, `banreason`, `bantime`, `ip`, `accountcode`, `HeadColor`, `TorsoColor`, `RightLegColor`, `RightArmColor`, `LeftLegColor`, `LeftArmColor`, `pose`, `thumb`, `language`, `bandate`, `gamesflood`, `forumpostflood`, `forumreplyflood`) VALUES
(2, 'Admin', '$2y$10$GfEuFZ5qTcradFvwjHYv5uNCREV9NB.zB1BTdsQLUvxGJt9VlBXCO', 0, 10, 1691510979, 'None', '0000-00-00', 0, '2023-08-07 18:09:39', 1691424594, 1691424894, '', 'None', 0, 0, 156, 'None', '', 0, '47.221.57.19', '', 24, 23, 119, 24, 119, 24, '', '', 'EN', '2023-08-07 18:09:39', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wearing`
--

CREATE TABLE `wearing` (
  `id` int NOT NULL,
  `userid` int NOT NULL,
  `itemid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forumgroups`
--
ALTER TABLE `forumgroups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gamesvisits`
--
ALTER TABLE `gamesvisits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `global`
--
ALTER TABLE `global`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invitekeys`
--
ALTER TABLE `invitekeys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ip_bans`
--
ALTER TABLE `ip_bans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owned_achievements`
--
ALTER TABLE `owned_achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owned_items`
--
ALTER TABLE `owned_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profileviews`
--
ALTER TABLE `profileviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wearing`
--
ALTER TABLE `wearing`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forumgroups`
--
ALTER TABLE `forumgroups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gamesvisits`
--
ALTER TABLE `gamesvisits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `global`
--
ALTER TABLE `global`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invitekeys`
--
ALTER TABLE `invitekeys`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ip_bans`
--
ALTER TABLE `ip_bans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owned_achievements`
--
ALTER TABLE `owned_achievements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owned_items`
--
ALTER TABLE `owned_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profileviews`
--
ALTER TABLE `profileviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wearing`
--
ALTER TABLE `wearing`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
