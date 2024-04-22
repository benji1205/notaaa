-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 04:41 PM
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
-- Database: `notaaa`
--
CREATE DATABASE IF NOT EXISTS `notaaa` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `notaaa`;

-- --------------------------------------------------------

--
-- Table structure for table `acccustomise`
--

CREATE TABLE `acccustomise` (
  `username` varchar(12) NOT NULL,
  `CoverPhoto` varchar(255) NOT NULL,
  `HeadFont` varchar(100) NOT NULL,
  `AccentColour1` varchar(7) NOT NULL,
  `AccentColour2` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acccustomise`
--

INSERT INTO `acccustomise` (`username`, `CoverPhoto`, `HeadFont`, `AccentColour1`, `AccentColour2`) VALUES
('useracc', 'image/cover/coverdefault.png', 'Comfortaa', '#000000', '#f5f5f5');

-- --------------------------------------------------------

--
-- Table structure for table `accsecurity`
--

CREATE TABLE `accsecurity` (
  `username` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `SQuestion1` int(1) NOT NULL,
  `SAnswer1` varchar(50) NOT NULL,
  `InfoSaved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accsecurity`
--

INSERT INTO `accsecurity` (`username`, `password`, `SQuestion1`, `SAnswer1`, `InfoSaved`) VALUES
('useracc', '$2y$10$sgROSEQVgjKyHWBxko66yOnoxrkBudXggUESJ7EpQDCY0UnIMP57e', 1, 'Test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `NoteID` int(7) NOT NULL,
  `username` varchar(12) NOT NULL,
  `NoteTitle` varchar(255) NOT NULL,
  `Content` varchar(255) NOT NULL,
  `NoteHeadFont` varchar(10) NOT NULL,
  `NoteAccentColour` varchar(7) NOT NULL,
  `Tag1` varchar(20) NOT NULL,
  `Tag2` varchar(20) NOT NULL,
  `LastEdit` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`NoteID`, `username`, `NoteTitle`, `Content`, `NoteHeadFont`, `NoteAccentColour`, `Tag1`, `Tag2`, `LastEdit`) VALUES
(1, 'useracc', 'Test Note', 'notes/useracc_6625b90d0be46.json', 'Comfortaa', '#ffffff', '', '', '2024-04-22 11:18:30'),
(2, 'useracc', 'Soya', 'notes/useracc_6625d2173d1ea.json', 'Comfortaa', '#ffffff', '', '', '2024-04-22 11:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(12) NOT NULL,
  `name` varchar(50) NOT NULL,
  `userpfp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `name`, `userpfp`) VALUES
('useracc', 'Test Account', 'userdefault.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acccustomise`
--
ALTER TABLE `acccustomise`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `accsecurity`
--
ALTER TABLE `accsecurity`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`NoteID`,`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `NoteID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
