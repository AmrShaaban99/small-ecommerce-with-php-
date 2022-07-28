-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2022 at 04:50 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `parent` int(11) NOT NULL,
  `Ordering` int(11) DEFAULT NULL,
  `Visibility` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_Comment` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_Ads` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `parent`, `Ordering`, `Visibility`, `Allow_Comment`, `Allow_Ads`) VALUES
(10, 'Hand Made', 'Hand made items', 0, 1, 0, 0, 0),
(11, 'computer', 'computers items', 0, 2, 0, 0, 0),
(12, 'Cell Phones', 'Cell Phones ', 0, 3, 0, 0, 0),
(13, 'Clothing ', 'Clothing and Fashion', 0, 4, 0, 0, 0),
(14, 'Home tools', 'home tools', 0, 5, 0, 0, 0),
(15, 'nokia', 'nokia discribtion', 12, 1, 0, 0, 0),
(16, 'toshiba', 'the discribtion', 11, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `C_ID` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`C_ID`, `content`, `status`, `comment_date`, `item_id`, `user_id`) VALUES
(7, 'good work', 1, '0000-00-00', 10, 18),
(8, 'good work', 1, '0000-00-00', 10, 18),
(13, 'the frist', 1, '0000-00-00', 8, 12),
(20, 'sadsadasd', 1, '2021-05-05', 8, 18),
(21, 'the 222222222', 1, '2021-05-13', 8, 18),
(23, 'ssssssssssssss', 0, '2021-05-20', 8, 18),
(24, '', 0, '2021-05-20', 8, 18);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Item_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Colors` varchar(255) DEFAULT NULL,
  `Size` varchar(50) NOT NULL,
  `Composition` varchar(50) NOT NULL,
  `Brand` varchar(11) NOT NULL,
  `Rating` smallint(6) NOT NULL,
  `Approve` tinyint(4) NOT NULL DEFAULT 0,
  `Cat_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Item_ID`, `Name`, `Description`, `Price`, `Add_Date`, `Country_Made`, `Image`, `Status`, `Colors`, `Size`, `Composition`, `Brand`, `Rating`, `Approve`, `Cat_ID`, `Member_ID`) VALUES
(8, 'Speaker', 'very good Speaker', '$100', '2021-04-21', 'egypt', '2137_item_XXL_131861585_106312e297ffd.jpg', '1', 'blue', 'auto', 'iron', 'samsung', 0, 1, 11, 29),
(9, 'Yeti blue mic', 'very good Microphone', '$108', '2021-04-21', 'USA', '', '1', '', '', '', '', 0, 1, 11, 25),
(10, 'iPhone 6s', 'Apple iPhone 6s', '$300', '2021-04-21', 'USA', '223_item_XXL_8992852_9434517.jpg', '2', 'white', 'auto', '...', '..', 0, 1, 12, 20),
(11, 'Magic Mouse', 'Mouse', '$50', '2021-04-21', 'egypt', '2054_item_XXL_66096507_97553706a8cd8.jpg', '1', 'red', 'auto', 'plastic', 'samsung', 0, 1, 11, 12),
(13, 'adidas shoes', 'the discribtion', '$100', '2021-05-07', 'egypt', '9259_shoes151581651.png', '1', 'green,white', '45,46', 'Blake Rapid', 'adidas', 0, 1, 13, 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL COMMENT 'To identify User',
  `Avatar` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL COMMENT 'Username To login',
  `password` varchar(255) NOT NULL COMMENT 'password To login',
  `Email` varchar(255) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT 0 COMMENT 'Identify User Group',
  `TrustStatus` int(11) NOT NULL DEFAULT 0 COMMENT 'Seller Rank',
  `RegStatus` int(11) NOT NULL DEFAULT 0 COMMENT 'User Approval',
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `Avatar`, `Username`, `password`, `Email`, `Fullname`, `GroupID`, `TrustStatus`, `RegStatus`, `Date`) VALUES
(12, '7460_download.jpg', 'badr', '5e9795e3f3ab55e7790a6283507c085db0d764fc', 'badr@gmail.com', 'badr tarek', 0, 0, 1, '2021-02-07'),
(18, '9600_download.png', 'amr', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'amr@gmail.com', 'amr shaaban', 1, 0, 1, '2021-02-09'),
(20, '4454_download.png', 'omar', '60149a289a3623cd214943af2892e103f4bddafb', 'omar@gmail.com', 'omar samy', 0, 0, 1, '2021-02-10'),
(25, '2752_download.jpg', 'mega 2', '60149a289a3623cd214943af2892e103f4bddafb', 'mega@mega.com', 'mega ahmed', 0, 0, 1, '2021-04-01'),
(26, '9600_download.png', 'abdullah ', '69c5fcebaa65b560eaf06c3fbeb481ae44b8d618', 'abdullah@gmail.com', 'Abdullah med7at', 0, 0, 1, '2021-04-01'),
(27, '6277_download.jpg', 'mahmoud', '60149a289a3623cd214943af2892e103f4bddafb', 'mahmoud@gmail.com', 'mahmoud mahmoud', 0, 0, 0, '2021-04-03'),
(28, '9600_download.png', 'amrsda', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'shaabanamr975@gmail.com', 'sadsadas', 0, 0, 1, '2021-04-22'),
(29, '5152_download.jpg', 'amrs', '3da0a5528cbeee9f8a56160fc30a41e552e0401b', 'shaabanamr@ymail.com', 'mega  Ahmeds', 0, 0, 0, '2021-04-22'),
(30, '9600_download.png', 'amrgjbgjs', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'amr@gmail.com', 'amrsadsad', 0, 0, 1, '2021-05-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`C_ID`),
  ADD KEY `items_comment` (`item_id`),
  ADD KEY `comment_user` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_ID`),
  ADD UNIQUE KEY `Name` (`Name`),
  ADD KEY `member_1` (`Member_ID`),
  ADD KEY `cat_1` (`Cat_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'To identify User', AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
