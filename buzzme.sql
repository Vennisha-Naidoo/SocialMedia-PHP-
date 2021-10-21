-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2020 at 02:20 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buzzme`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `CommentContent` varchar(255) NOT NULL,
  `CommentDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentID`, `UserID`, `PostID`, `CommentContent`, `CommentDate`) VALUES
(1, 1, 6, 'hello', '2020-10-12 02:33:38'),
(2, 1, 14, 'She is beautiful 😱🥵', '2020-10-12 02:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `FriendsID` int(100) NOT NULL,
  `UserOne` int(100) NOT NULL,
  `UserTwo` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`FriendsID`, `UserOne`, `UserTwo`) VALUES
(6, 1, 2),
(7, 2, 1),
(8, 3, 1),
(9, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `LikeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`LikeID`, `UserID`, `PostID`) VALUES
(16, 1, 1),
(17, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `MessageID` int(11) NOT NULL,
  `UserOne` int(11) NOT NULL,
  `UserTwo` int(11) NOT NULL,
  `MessageConent` varchar(255) NOT NULL,
  `MessageDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`MessageID`, `UserOne`, `UserTwo`, `MessageConent`, `MessageDate`) VALUES
(1, 0, 0, 'test', '0000-00-00 00:00:00'),
(2, 0, 0, 'Hello', '2020-10-11 03:31:55'),
(3, 0, 0, 'test', '2020-10-11 03:33:48'),
(4, 1, 2, 'Hello', '2020-10-11 03:59:48'),
(5, 2, 1, 'How are you?', '2020-10-11 04:17:45'),
(6, 1, 2, 'test', '2020-10-11 04:31:59'),
(7, 1, 2, 'I am Thea', '2020-10-11 23:05:24'),
(8, 2, 1, 'You are annoying', '2020-10-11 23:43:25'),
(9, 2, 1, 'Go away', '2020-10-11 23:43:36'),
(10, 2, 1, 'Woot?', '2020-10-11 23:43:54'),
(11, 1, 2, 'You are so mean', '2020-10-11 23:44:49'),
(12, 1, 2, 'Did you know11% of people are left handed Did you knowAugust has the highest percentage of births', '2020-10-11 23:58:47'),
(13, 1, 2, 'Lol', '2020-10-11 23:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `PostID` int(50) NOT NULL,
  `PostContent` varchar(255) NOT NULL,
  `PostImage` varchar(255) NOT NULL,
  `UserID` int(50) NOT NULL,
  `PostDate` datetime NOT NULL,
  `NumLikes` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`PostID`, `PostContent`, `PostImage`, `UserID`, `PostDate`, `NumLikes`) VALUES
(1, 'My name is Prenayan but, you can call me \"Pre\".', 'Prenayan.jpg', 2, '2020-09-28 04:15:43', 1),
(2, 'This is Vennisha Naidoo.', 'Thea.jpg', 2, '2020-09-29 00:27:36', 0),
(5, 'I am known by friends as Vennisha.', 'Vennisha.jpg', 1, '2020-09-29 02:53:29', 0),
(6, 'This is my third post', '', 2, '2020-10-01 03:06:55', 1),
(7, '', 'Vennisha.jpg', 2, '2020-10-01 03:08:38', 0),
(12, 'This is Ruvy', 'Ruvyy.jpg', 3, '2020-10-11 22:19:30', 0),
(14, 'Oh my God, it actually worked!', '', 1, '2020-10-12 02:34:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `RequestID` int(100) NOT NULL,
  `UserID_One` int(100) NOT NULL,
  `UserID_Two` int(100) NOT NULL,
  `Confirmation` enum('0','1') NOT NULL,
  `ConfirmationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`RequestID`, `UserID_One`, `UserID_Two`, `Confirmation`, `ConfirmationDate`) VALUES
(25, 3, 2, '', '2020-10-12 06:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(255) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Surname` varchar(30) NOT NULL,
  `EmailAddress` varchar(50) NOT NULL,
  `PhoneNumber` varchar(10) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Nationality` varchar(25) NOT NULL,
  `Biography` varchar(300) NOT NULL,
  `ProfilePicture` varchar(255) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Question` varchar(255) NOT NULL,
  `Answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `Surname`, `EmailAddress`, `PhoneNumber`, `Username`, `Password`, `Gender`, `Nationality`, `Biography`, `ProfilePicture`, `DateOfBirth`, `Question`, `Answer`) VALUES
(1, 'Thea', 'Naidoo', 'theavn31@gmail.com', '0791515551', 'theavn31', 'vennisha31', 'Female', 'South African', 'Hi. Looking forward to being friends.', 'Vennisha.jpg', '2001-05-31', 'Who is most important to you?', 'Vennisha Naidoo'),
(2, 'Prenayan', 'Naidoo', 'prenayann@gmail.com', '0849262009', 'prenayan47', 'pre07092000', 'Male', 'South African', 'Hi. Wanna be friends?', 'Prenayan.jpg', '2000-09-07', '', ''),
(3, 'Caitlin', 'Pillay', 'caityp@gmail.com', '', 'cait14', 'cait13022001', 'Female', 'South African', 'No DMs.', 'Ruvyy.jpg', '2001-02-13', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentID`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`FriendsID`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`LikeID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MessageID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`PostID`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `UserID` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `FriendsID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `LikeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `PostID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `RequestID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
