-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2021 at 03:51 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anime`
--

-- --------------------------------------------------------

--
-- Table structure for table `anime`
--

CREATE TABLE `anime` (
  `id` int(11) NOT NULL,
  `slug` text NOT NULL,
  `title` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `posterLink` text NOT NULL,
  `dateFrom` date NOT NULL,
  `dateTo` date NOT NULL,
  `storySypnosis` text NOT NULL,
  `titleKeywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anime`
--

INSERT INTO `anime` (`id`, `slug`, `title`, `status`, `posterLink`, `dateFrom`, `dateTo`, `storySypnosis`, `titleKeywords`) VALUES
(16, 'mitsuboshi-colors', 'Mitsuboshi Colors', 'Finished', 'https://avt4bnujzm0pvsronjxoba-on.drv.tw/Anime/MitsuboshiColors/Mitsuboshi.Colors.jpg', '2018-01-28', '2018-03-25', 'Residing within Tokyo&#039;s district of Ueno are the Colors, three individuals who protect their city by performing good deeds and aiding their community. Or, at the very least, they pretend to be the city&#039;s defenders. In reality, the Colors are just three young girls: the shy Yui Akamatsu, the noisy Sacchan, and the video game-loving Kotoha, who spend their time playing make-believe and exploring the city. The Colors&#039; activities are facilitated by the grandfatherly Daigorou &quot;Pops&quot; Kujiraoka, who uses his store&#039;s inventory of knick-knacks to entertain the rambunctious trio.\r\n\r\nNot everyone is a fan of the Colors though. The local policeman Saitou just wants to deal with his regular duties, but he often finds himself the target of the Colors&#039; attention, having been made the villain in most of their fantasies. But despite his personal feelings, Saitou always finds the time to go along with the three girls&#039; games. Even though the Colors do not actually defend Ueno, they definitely help brighten everyone&#039;s day.', 'Mitsuboshi Colors 三ツ星カラーズ'),
(19, 'jujutsu-kaisen-tv', 'Jujutsu Kaisen (TV)', 'Finished', 'https://avt4bnujzm0pvsronjxoba-on.drv.tw/Anime/JujutsuKaisen/Jujutsu.Kaisen.jpg', '2020-10-03', '2021-03-12', 'Idly indulging in baseless paranormal activities with the Occult Club, high schooler Yuuji Itadori spends his days at either the clubroom or the hospital, where he visits his bedridden grandfather. However, this leisurely lifestyle soon takes a turn for the strange when he unknowingly encounters a cursed item. Triggering a chain of supernatural occurrences, Yuuji finds himself suddenly thrust into the world of Curses—dreadful beings formed from human malice and negativity—after swallowing the said item, revealed to be a finger belonging to the demon Sukuna Ryoumen, the &quot;King of Curses.&quot;\r\n\r\nYuuji experiences first-hand the threat these Curses pose to society as he discovers his own newfound powers. Introduced to the Tokyo Metropolitan Jujutsu Technical High School, he begins to walk down a path from which he cannot return—the path of a Jujutsu sorcerer.', 'Jujutsu Kaisen (呪術廻戦, lit. &quot;Sorcery Fight&quot;)');

-- --------------------------------------------------------

--
-- Table structure for table `animegenre`
--

CREATE TABLE `animegenre` (
  `id` int(11) NOT NULL,
  `animeSlug` text NOT NULL,
  `genreId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animegenre`
--

INSERT INTO `animegenre` (`id`, `animeSlug`, `genreId`) VALUES
(70, 'mitsuboshi-colors', 12),
(71, 'mitsuboshi-colors', 11),
(72, 'mitsuboshi-colors', 5),
(80, 'jujutsu-kaisen-tv', 19),
(81, 'jujutsu-kaisen-tv', 18),
(82, 'jujutsu-kaisen-tv', 17),
(83, 'jujutsu-kaisen-tv', 11),
(84, 'jujutsu-kaisen-tv', 1);

-- --------------------------------------------------------

--
-- Table structure for table `animetype`
--

CREATE TABLE `animetype` (
  `id` int(11) NOT NULL,
  `animeSlug` text NOT NULL,
  `typeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animetype`
--

INSERT INTO `animetype` (`id`, `animeSlug`, `typeId`) VALUES
(49, 'mitsuboshi-colors', 5),
(53, 'jujutsu-kaisen-tv', 5);

-- --------------------------------------------------------

--
-- Table structure for table `episode`
--

CREATE TABLE `episode` (
  `id` int(11) NOT NULL,
  `animeSlug` text NOT NULL,
  `episodeNumber` int(100) NOT NULL,
  `episodeLink` text NOT NULL,
  `dateAdded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `episode`
--

INSERT INTO `episode` (`id`, `animeSlug`, `episodeNumber`, `episodeLink`, `dateAdded`) VALUES
(22, 'mitsuboshi-colors', 1, 'https://drive.google.com/file/d/1ldblP6a4i61frpCc_UGagv-pu7PbWzMV/preview', '2021-03-29 19:14:06'),
(23, 'mitsuboshi-colors', 2, 'https://drive.google.com/file/d/1LZ3l_sfMxFK5Ab45zYiDYrvshcqzardT/preview', '2021-03-29 19:24:23'),
(37, 'jujutsu-kaisen-tv', 1, 'https://drive.google.com/file/d/1XEkqBsChQy-EBS4Ddp4AwloHf9XH7Oi-/preview', '2021-04-12 19:23:35'),
(38, 'jujutsu-kaisen-tv', 2, 'https://drive.google.com/file/d/1gCPhsu5T19GsJLgZcn-VWa344oe1esa4/preview', '2021-04-12 19:24:54'),
(39, 'jujutsu-kaisen-tv', 3, 'https://drive.google.com/file/d/1sDntc0vWSCGWX-RCklex3ZUpqaru1FVi/preview', '2021-04-12 19:34:22'),
(40, 'jujutsu-kaisen-tv', 4, 'https://drive.google.com/file/d/15KssGlM0oRpkxHV3BgvbcemNNFXwOAJF/preview', '2021-04-12 19:34:22'),
(41, 'jujutsu-kaisen-tv', 5, 'https://drive.google.com/file/d/1VP4JhmSuWwuUmVsc61BIPPUnnqcPQ6Z8/preview', '2021-04-12 19:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `genreName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `genreName`) VALUES
(1, 'Action'),
(2, 'Fantasy'),
(4, 'Adventure'),
(5, 'Comedy'),
(9, 'Drama'),
(10, 'Horror'),
(11, 'Shounen'),
(12, 'Slice of Life'),
(17, 'Demons'),
(18, 'Supernatural'),
(19, 'School');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `animeName` text NOT NULL,
  `episodeNumber` int(11) NOT NULL,
  `reason` text NOT NULL,
  `isRead` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `animeName` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `isRead` tinyint(1) NOT NULL DEFAULT 0,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `animeName`, `status`, `isRead`, `createdAt`) VALUES
(25, 'The Hidden Dungeon I Can Only Enter', 'pending', 1, '2021-04-12 14:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `animeSlug` varchar(255) NOT NULL,
  `bannerLink` text NOT NULL,
  `marginTop` int(11) NOT NULL DEFAULT -999999,
  `marginBottom` int(11) NOT NULL DEFAULT -999999
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `animeSlug`, `bannerLink`, `marginTop`, `marginBottom`) VALUES
(25, 'mitsuboshi-colors', 'https://i.pinimg.com/564x/77/7f/ba/777fbab46e70de6ddae8304ea3e35a9b.jpg', -999999, -200),
(26, 'jujutsu-kaisen-tv', 'https://www.awn.com/sites/default/files/styles/inline_wide/public/image/attached/1052727-jujutsukaisen16x9.jpg?itok=nUmcAI6H', -100, -999999);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `typeName` varchar(255) NOT NULL,
  `backgroundColor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `typeName`, `backgroundColor`) VALUES
(2, 'OVA', '#2026d5'),
(5, 'TV', '#e3e60f'),
(6, 'Special', '#19e170'),
(7, 'Movie', '#00a247');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(4, 'user', '$2y$10$D1yDqg9JiCsNCg6M.NT92umWt5w508smh6SddTt9uuAPlzBHhk1tG', 'User'),
(6, 'romar', '$2y$10$1/bnMoybyfJlTZZbmggeM.OYZRqqxFCPAkFOEb9ohE6BYx4c3eYsq', 'Admin'),
(7, 'admin', '$2y$10$sV2o3YHLntqlItXs8l/pTulIeiCuaCr00PMq0w8ajimY4N00P8hni', 'Admin'),
(8, 'agol', '$2y$10$8XnZBR4UStcIQFgrjBaKneakMChP.lCkWUsfsvqLdafWoiGWZ3tOi', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `animegenre`
--
ALTER TABLE `animegenre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `animetype`
--
ALTER TABLE `animetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episode`
--
ALTER TABLE `episode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anime`
--
ALTER TABLE `anime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `animegenre`
--
ALTER TABLE `animegenre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `animetype`
--
ALTER TABLE `animetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `episode`
--
ALTER TABLE `episode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
