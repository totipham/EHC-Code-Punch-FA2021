-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2021 at 03:58 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `role` tinyint(1) NOT NULL
); 

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `fullname`, `email`, `phone`, `role`) VALUES
(3, 'sinh', 'd6a9a933c8aafc51e55ac0662b6e4d4a', 'Sinh', 'sinh@gmail.com', 12345, 1),
(4, 'giao', 'd6a9a933c8aafc51e55ac0662b6e4d4a', 'Giáo Viên', 'gv@gm.com', 12345, 1),
(5, 'giao2', 'd41d8cd98f00b204e9800998ecf8427e', 'Giáo Viên 2', 'gv@gv.com', 534545, 1),
(7, 'hs2', 'd41d8cd98f00b204e9800998ecf8427e', 'Học Sinh 2', 'hs2@hs.com', 1234568, 0),
(8, 'hs3', 'd6a9a933c8aafc51e55ac0662b6e4d4a', 'Học Sinh 3', 'hs3@hs.com', 123456, 0),
(9, 'gv3', 'd6a9a933c8aafc51e55ac0662b6e4d4a', 'Giáo Viên 3', 'gv3@gmail.com', 12345, 1),
(10, 'gv4', 'd6a9a933c8aafc51e55ac0662b6e4d4a', 'Giáo Viên 4', 'gv4@gmail.com', 12345, 1),
(12, 'hs_test', '20f5de9e146141dab4094d90d2d9c73d', 'Học Sinh Test', 'hs_test@gm.com', 12345, 1),
(13, 'hs_test2', 'faf32fc854242a0186ee15fc01f1eeee', 'Học Sinh Test 2', 'hs_test2@gm.com', 12345, 0),
(15, 'hs_add', 'd6a9a933c8aafc51e55ac0662b6e4d4a', 'Học Sinh Add', 'hsadd@gm.com', 12345, 0),
(18, 'gvpro2', 'd6a9a933c8aafc51e55ac0662b6e4d4a', 'Giáo Viên Pro Vip 22', 'gvpro2@gm.com', 12345, 1),
(19, 'mvc', 'd6a9a933c8aafc51e55ac0662b6e4d4a', 'MVC Test', 'mvc@gm.com', 12345, 1);

-- --------------------------------------------------------

--
-- Table structure for table `answerass`
--

CREATE TABLE `answerass` (
  `assID` int(11) NOT NULL,
  `assAnswer` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answerass`
--

INSERT INTO `answerass` (`assID`, `assAnswer`, `id`) VALUES
(37, 'uploads/assignment/key2.txt', 8),
(38, 'uploads/assignment/key4.txt', 7),
(39, '../uploads/assignment/flag_(3).txt', 8),
(41, 'uploads/assignment/flag_(1).txt', 7),
(49, 'uploads/assignment/flag_(1).txt', 8);

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assID` int(11) NOT NULL,
  `assName` varchar(25) NOT NULL,
  `assFile` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`assID`, `assName`, `assFile`) VALUES
(49, 'Bài 1', 'uploads/flag.txt');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `challID` int(11) NOT NULL,
  `gameFile` varchar(50) NOT NULL,
  `hint` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`challID`, `gameFile`, `hint`) VALUES
(1, 'uploads/lyrics.txt', 'what come before never gonna give u up');

-- --------------------------------------------------------

--
-- Table structure for table `gameans`
--

CREATE TABLE `gameans` (
  `id` int(11) NOT NULL,
  `result` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gameans`
--

INSERT INTO `gameans` (`id`, `result`) VALUES
(7, 1),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messID` int(11) NOT NULL,
  `toID` int(11) NOT NULL,
  `fromID` int(11) NOT NULL,
  `content` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`messID`, `toID`, `fromID`, `content`) VALUES
(1, 3, 8, 'Hello'),
(2, 3, 8, 'Hi'),
(3, 3, 8, 'Chào'),
(4, 3, 8, 'Xin chào'),
(5, 3, 8, 'Tôi là'),
(6, 3, 8, 'Học Sinh'),
(7, 18, 8, 'Hello Giáo Viên, tôi là Học Sinh 3'),
(8, 8, 18, 'Chào nha, tôi là Giáo Viên Pro 2'),
(9, 8, 18, 'Nếu cần gì thì alo'),
(10, 8, 18, 'Được chứ ?'),
(11, 18, 8, 'Ok luôn Giáo Viên Pro 2'),
(12, 18, 8, 'Bye nha'),
(13, 18, 8, 'Nha ?'),
(14, 18, 8, 'Nha nha ?\n'),
(15, 8, 18, 'Ok '),
(16, 8, 18, 'Bye bye'),
(17, 8, 18, ':>'),
(18, 8, 18, ':>>'),
(19, 8, 18, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),
(20, 8, 18, 'B?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answerass`
--
ALTER TABLE `answerass`
  ADD PRIMARY KEY (`assID`),
  ADD KEY `answerass_ibfk_2` (`id`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assID`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`challID`),
  ADD UNIQUE KEY `challID` (`challID`);

--
-- Indexes for table `gameans`
--
ALTER TABLE `gameans`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `assID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answerass`
--
ALTER TABLE `answerass`
  ADD CONSTRAINT `answerass_ibfk_1` FOREIGN KEY (`assID`) REFERENCES `assignment` (`assID`),
  ADD CONSTRAINT `answerass_ibfk_2` FOREIGN KEY (`id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gameans`
--
ALTER TABLE `gameans`
  ADD CONSTRAINT `gameans_ibfk_1` FOREIGN KEY (`id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
