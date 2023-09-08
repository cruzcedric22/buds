-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2023 at 04:00 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buds`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_list`
--

CREATE TABLE `application_list` (
  `ID` int(11) NOT NULL,
  `CompanyName` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barangay_list`
--

CREATE TABLE `barangay_list` (
  `ID` int(11) NOT NULL,
  `Barangay` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangay_list`
--

INSERT INTO `barangay_list` (`ID`, `Barangay`) VALUES
(1, 'Brgy. 1'),
(2, 'Brgy. 2'),
(3, 'Brgy. 3'),
(4, 'Brgy. 4'),
(5, 'Brgy. 5'),
(6, 'Brgy. 6'),
(7, 'Brgy. 7'),
(8, 'Brgy. 8'),
(9, 'Brgy. 9'),
(10, 'Brgy. 10'),
(11, 'Brgy. 11'),
(12, 'Brgy. 12'),
(13, 'Brgy. 13'),
(14, 'Brgy. 14'),
(15, 'Brgy. 15'),
(16, 'Brgy. 16'),
(17, 'Brgy. 17'),
(18, 'Brgy. 18'),
(19, 'Brgy. 19'),
(20, 'Brgy. 20'),
(21, 'Brgy. 21'),
(22, 'Brgy. 22'),
(23, 'Brgy. 23'),
(24, 'Brgy. 24'),
(25, 'Brgy. 25'),
(26, 'Brgy. 26'),
(27, 'Brgy. 27'),
(28, 'Brgy. 28'),
(29, 'Brgy. 29'),
(30, 'Brgy. 30'),
(31, 'Brgy. 31'),
(32, 'Brgy. 32'),
(33, 'Brgy. 33'),
(34, 'Brgy. 34'),
(35, 'Brgy. 35'),
(36, 'Brgy. 36'),
(37, 'Brgy. 37'),
(38, 'Brgy. 38'),
(39, 'Brgy. 39'),
(40, 'Brgy. 40'),
(41, 'Brgy. 41'),
(42, 'Brgy. 42'),
(43, 'Brgy. 43'),
(44, 'Brgy. 44'),
(45, 'Brgy. 45'),
(46, 'Brgy. 46'),
(47, 'Brgy. 47'),
(48, 'Brgy. 48'),
(49, 'Brgy. 49'),
(50, 'Brgy. 50'),
(51, 'Brgy. 51'),
(52, 'Brgy. 52'),
(53, 'Brgy. 53'),
(54, 'Brgy. 54'),
(55, 'Brgy. 55'),
(56, 'Brgy. 56'),
(57, 'Brgy. 57'),
(58, 'Brgy. 58'),
(59, 'Brgy. 59'),
(60, 'Brgy. 60'),
(61, 'Brgy. 61'),
(62, 'Brgy. 62'),
(63, 'Brgy. 63'),
(64, 'Brgy. 64'),
(65, 'Brgy. 65'),
(66, 'Brgy. 66'),
(67, 'Brgy. 67'),
(68, 'Brgy. 68'),
(69, 'Brgy. 69'),
(70, 'Brgy. 70'),
(71, 'Brgy. 71'),
(72, 'Brgy. 72'),
(73, 'Brgy. 73'),
(74, 'Brgy. 74'),
(75, 'Brgy. 75'),
(76, 'Brgy. 76'),
(77, 'Brgy. 77'),
(78, 'Brgy. 78'),
(79, 'Brgy. 79'),
(80, 'Brgy. 80'),
(81, 'Brgy. 81'),
(82, 'Brgy. 82'),
(83, 'Brgy. 83'),
(84, 'Brgy. 84'),
(85, 'Brgy. 85'),
(86, 'Brgy. 86'),
(87, 'Brgy. 87'),
(88, 'Brgy. 88'),
(89, 'Brgy. 89'),
(90, 'Brgy. 90'),
(91, 'Brgy. 91'),
(92, 'Brgy. 92'),
(93, 'Brgy. 93'),
(94, 'Brgy. 94'),
(95, 'Brgy. 95'),
(96, 'Brgy. 96'),
(97, 'Brgy. 97'),
(98, 'Brgy. 98'),
(99, 'Brgy. 99'),
(100, 'Brgy. 100'),
(101, 'Brgy. 101'),
(102, 'Brgy. 102'),
(103, 'Brgy. 103'),
(104, 'Brgy. 104'),
(105, 'Brgy. 105'),
(106, 'Brgy. 106'),
(107, 'Brgy. 107'),
(108, 'Brgy. 108'),
(109, 'Brgy. 109'),
(110, 'Brgy. 110'),
(111, 'Brgy. 111'),
(112, 'Brgy. 112'),
(113, 'Brgy. 113'),
(114, 'Brgy. 114'),
(115, 'Brgy. 115'),
(116, 'Brgy. 116'),
(117, 'Brgy. 117'),
(118, 'Brgy. 118'),
(119, 'Brgy. 119'),
(120, 'Brgy. 120'),
(121, 'Brgy. 121'),
(122, 'Brgy. 122'),
(123, 'Brgy. 123'),
(124, 'Brgy. 124'),
(125, 'Brgy. 125'),
(126, 'Brgy. 126'),
(127, 'Brgy. 127'),
(128, 'Brgy. 128'),
(129, 'Brgy. 129'),
(130, 'Brgy. 130'),
(131, 'Brgy. 131'),
(132, 'Brgy. 132'),
(133, 'Brgy. 133'),
(134, 'Brgy. 134'),
(135, 'Brgy. 135'),
(136, 'Brgy. 136'),
(137, 'Brgy. 137'),
(138, 'Brgy. 138'),
(139, 'Brgy. 139'),
(140, 'Brgy. 140'),
(141, 'Brgy. 141'),
(142, 'Brgy. 142'),
(143, 'Brgy. 143'),
(144, 'Brgy. 144'),
(145, 'Brgy. 145'),
(146, 'Brgy. 146'),
(147, 'Brgy. 147'),
(148, 'Brgy. 148'),
(149, 'Brgy. 149'),
(150, 'Brgy. 150'),
(151, 'Brgy. 151'),
(152, 'Brgy. 152'),
(153, 'Brgy. 153'),
(154, 'Brgy. 154'),
(155, 'Brgy. 155'),
(156, 'Brgy. 156'),
(157, 'Brgy. 157'),
(158, 'Brgy. 158'),
(159, 'Brgy. 159'),
(160, 'Brgy. 160'),
(161, 'Brgy. 161'),
(162, 'Brgy. 162'),
(163, 'Brgy. 163'),
(164, 'Brgy. 164'),
(165, 'Brgy. 165'),
(166, 'Brgy. 166'),
(167, 'Brgy. 167'),
(168, 'Brgy. 168'),
(169, 'Brgy. 169'),
(170, 'Brgy. 170'),
(171, 'Brgy. 171'),
(172, 'Brgy. 172'),
(173, 'Brgy. 173'),
(174, 'Brgy. 174'),
(175, 'Brgy. 175'),
(176, 'Brgy. 176'),
(177, 'Brgy. 177'),
(178, 'Brgy. 178'),
(179, 'Brgy. 179'),
(180, 'Brgy. 180'),
(181, 'Brgy. 181'),
(182, 'Brgy. 182'),
(183, 'Brgy. 183'),
(184, 'Brgy. 184'),
(185, 'Brgy. 185'),
(186, 'Brgy. 186'),
(187, 'Brgy. 187'),
(188, 'Brgy. 188');

-- --------------------------------------------------------

--
-- Table structure for table `brgyzone_list`
--

CREATE TABLE `brgyzone_list` (
  `ID` int(11) NOT NULL,
  `zone` int(11) NOT NULL,
  `barangay` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brgyzone_list`
--

INSERT INTO `brgyzone_list` (`ID`, `zone`, `barangay`) VALUES
(1, 1, 'Barangay 1'),
(2, 1, 'Barangay 2'),
(3, 1, 'Barangay 3'),
(4, 1, 'Barangay 4'),
(5, 1, 'Barangay 5'),
(6, 1, 'Barangay 6'),
(7, 1, 'Barangay 7'),
(8, 1, 'Barangay 8'),
(9, 1, 'Barangay 9'),
(10, 1, 'Barangay 10'),
(11, 1, 'Barangay 11'),
(12, 1, 'Barangay 12'),
(13, 2, 'Barangay 13'),
(14, 2, 'Barangay 14'),
(15, 2, 'Barangay 15'),
(16, 2, 'Barangay 16'),
(17, 2, 'Barangay 17'),
(18, 2, 'Barangay 18'),
(19, 2, 'Barangay 19'),
(20, 2, 'Barangay 20'),
(21, 2, 'Barangay 21'),
(22, 2, 'Barangay 22'),
(23, 2, 'Barangay 23'),
(24, 2, 'Barangay 24'),
(25, 3, 'Barangay 25'),
(26, 3, 'Barangay 26'),
(27, 3, 'Barangay 27'),
(28, 3, 'Barangay 28'),
(29, 3, 'Barangay 29'),
(30, 3, 'Barangay 30'),
(31, 3, 'Barangay 31'),
(32, 3, 'Barangay 32'),
(33, 3, 'Barangay 33'),
(34, 3, 'Barangay 34'),
(35, 3, 'Barangay 35'),
(36, 4, 'Barangay 36'),
(37, 4, 'Barangay 37'),
(38, 4, 'Barangay 38'),
(39, 4, 'Barangay 39'),
(40, 4, 'Barangay 40'),
(41, 4, 'Barangay 41'),
(42, 4, 'Barangay 42'),
(43, 4, 'Barangay 43'),
(44, 4, 'Barangay 44'),
(45, 4, 'Barangay 45'),
(46, 4, 'Barangay 46'),
(47, 4, 'Barangay 47'),
(48, 4, 'Barangay 48'),
(49, 5, 'Barangay 49'),
(50, 5, 'Barangay 50'),
(51, 5, 'Barangay 51'),
(52, 5, 'Barangay 52'),
(53, 5, 'Barangay 53'),
(54, 5, 'Barangay 54'),
(55, 5, 'Barangay 55'),
(56, 5, 'Barangay 56'),
(57, 5, 'Barangay 57'),
(58, 5, 'Barangay 58'),
(59, 6, 'Barangay 59'),
(60, 6, 'Barangay 60'),
(61, 6, 'Barangay 61'),
(62, 6, 'Barangay 62'),
(63, 6, 'Barangay 63'),
(64, 6, 'Barangay 64'),
(65, 6, 'Barangay 65'),
(66, 6, 'Barangay 66'),
(67, 6, 'Barangay 67'),
(68, 6, 'Barangay 68'),
(69, 6, 'Barangay 69'),
(70, 6, 'Barangay 70'),
(71, 7, 'Barangay 71'),
(72, 7, 'Barangay 72'),
(73, 7, 'Barangay 73'),
(74, 7, 'Barangay 74'),
(75, 7, 'Barangay 75'),
(76, 7, 'Barangay 76'),
(77, 7, 'Barangay 77'),
(78, 7, 'Barangay 78'),
(79, 7, 'Barangay 79'),
(80, 7, 'Barangay 80'),
(81, 8, 'Barangay 81'),
(82, 8, 'Barangay 82'),
(83, 8, 'Barangay 83'),
(84, 8, 'Barangay 84'),
(85, 8, 'Barangay 85'),
(86, 8, 'Barangay 86'),
(87, 8, 'Barangay 87'),
(88, 8, 'Barangay 88'),
(89, 8, 'Barangay 89'),
(90, 8, 'Barangay 90'),
(91, 8, 'Barangay 91'),
(92, 8, 'Barangay 92'),
(93, 8, 'Barangay 93'),
(94, 9, 'Barangay 94'),
(95, 9, 'Barangay 95'),
(96, 9, 'Barangay 96'),
(97, 9, 'Barangay 97'),
(98, 9, 'Barangay 98'),
(99, 9, 'Barangay 99'),
(100, 9, 'Barangay 100'),
(101, 9, 'Barangay 101'),
(102, 9, 'Barangay 102'),
(103, 9, 'Barangay 103'),
(104, 9, 'Barangay 104'),
(105, 9, 'Barangay 105'),
(106, 10, 'Barangay 106'),
(107, 10, 'Barangay 107'),
(108, 10, 'Barangay 108'),
(109, 10, 'Barangay 109'),
(110, 10, 'Barangay 110'),
(111, 10, 'Barangay 111'),
(112, 10, 'Barangay 112'),
(113, 10, 'Barangay 113'),
(114, 10, 'Barangay 114'),
(115, 10, 'Barangay 115'),
(116, 10, 'Barangay 116'),
(117, 10, 'Barangay 117'),
(118, 10, 'Barangay 118'),
(119, 10, 'Barangay 119'),
(120, 10, 'Barangay 120'),
(121, 11, 'Barangay 121'),
(122, 11, 'Barangay 122'),
(123, 11, 'Barangay 123'),
(124, 11, 'Barangay 124'),
(125, 11, 'Barangay 125'),
(126, 11, 'Barangay 126'),
(127, 11, 'Barangay 127'),
(128, 11, 'Barangay 128'),
(129, 11, 'Barangay 129'),
(130, 11, 'Barangay 130'),
(131, 11, 'Barangay 131'),
(132, 12, 'Barangay 132'),
(133, 12, 'Barangay 133'),
(134, 12, 'Barangay 134'),
(135, 12, 'Barangay 135'),
(136, 12, 'Barangay 136'),
(137, 12, 'Barangay 137'),
(138, 12, 'Barangay 138'),
(139, 12, 'Barangay 139'),
(140, 12, 'Barangay 140'),
(141, 12, 'Barangay 141'),
(142, 13, 'Barangay 142'),
(143, 13, 'Barangay 143'),
(144, 13, 'Barangay 144'),
(145, 13, 'Barangay 145'),
(146, 13, 'Barangay 146'),
(147, 13, 'Barangay 147'),
(148, 13, 'Barangay 148'),
(149, 13, 'Barangay 149'),
(150, 13, 'Barangay 150'),
(151, 13, 'Barangay 151'),
(152, 13, 'Barangay 152'),
(153, 13, 'Barangay 153'),
(154, 13, 'Barangay 154'),
(155, 13, 'Barangay 155'),
(156, 14, 'Barangay 156'),
(157, 14, 'Barangay 157'),
(158, 14, 'Barangay 158'),
(159, 14, 'Barangay 159'),
(160, 14, 'Barangay 160'),
(161, 14, 'Barangay 161'),
(162, 14, 'Barangay 162'),
(163, 14, 'Barangay 163'),
(164, 14, 'Barangay 164'),
(165, 15, 'Barangay 165'),
(166, 15, 'Barangay 166'),
(167, 15, 'Barangay 167'),
(168, 15, 'Barangay 168'),
(169, 15, 'Barangay 169'),
(170, 15, 'Barangay 170'),
(171, 15, 'Barangay 171'),
(172, 15, 'Barangay 172'),
(173, 15, 'Barangay 173'),
(174, 15, 'Barangay 174'),
(175, 15, 'Barangay 175'),
(176, 15, 'Barangay 176'),
(177, 15, 'Barangay 177'),
(178, 15, 'Barangay 178'),
(179, 16, 'Barangay 179'),
(180, 16, 'Barangay 180'),
(181, 16, 'Barangay 181'),
(182, 16, 'Barangay 182'),
(183, 16, 'Barangay 183'),
(184, 16, 'Barangay 184'),
(185, 16, 'Barangay 185'),
(186, 16, 'Barangay 186'),
(187, 16, 'Barangay 187'),
(188, 16, 'Barangay 188');

-- --------------------------------------------------------

--
-- Table structure for table `business_list`
--

CREATE TABLE `business_list` (
  `bus_id` bigint(20) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `BusinessName` varchar(255) NOT NULL,
  `BusinessEmail` varchar(255) NOT NULL,
  `BusinessBranch` varchar(255) NOT NULL,
  `BusinessEstablish` varchar(255) NOT NULL,
  `BusinessDescrip` text NOT NULL,
  `BusinessNumber` varchar(255) NOT NULL,
  `BusinessOpenHour` varchar(255) NOT NULL,
  `BusinessCloseHour` varchar(255) NOT NULL,
  `BusinessAddress` varchar(255) NOT NULL,
  `BusinessBrgy` varchar(255) NOT NULL,
  `BusinessZone` varchar(255) NOT NULL,
  `BusinessPostal` varchar(255) NOT NULL,
  `Latitude` double NOT NULL,
  `Longtitude` double NOT NULL,
  `BusinessWebsite` varchar(255) NOT NULL,
  `BusinessFb` varchar(255) NOT NULL,
  `BusinessTwitter` varchar(255) NOT NULL,
  `BusinessInstagram` varchar(255) NOT NULL,
  `BusinessCategory` varchar(255) DEFAULT NULL,
  `BusinessSubCategory` varchar(255) NOT NULL,
  `BusinessIdPicture` varchar(255) NOT NULL,
  `BusinessBrgyPermit` varchar(255) NOT NULL,
  `BusinessPermitCityHall` varchar(255) NOT NULL,
  `BusinessSanitaryPermit` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_list`
--

INSERT INTO `business_list` (`bus_id`, `ownerId`, `BusinessName`, `BusinessEmail`, `BusinessBranch`, `BusinessEstablish`, `BusinessDescrip`, `BusinessNumber`, `BusinessOpenHour`, `BusinessCloseHour`, `BusinessAddress`, `BusinessBrgy`, `BusinessZone`, `BusinessPostal`, `Latitude`, `Longtitude`, `BusinessWebsite`, `BusinessFb`, `BusinessTwitter`, `BusinessInstagram`, `BusinessCategory`, `BusinessSubCategory`, `BusinessIdPicture`, `BusinessBrgyPermit`, `BusinessPermitCityHall`, `BusinessSanitaryPermit`, `Status`, `location`) VALUES
(6, 1, 'Jollibee', '', '', '', 'dsa', '', '10:17', '22:17', 'Mcdo burger city', '1', '1', '178', 14.658763, 120.971904, '', 'https://web.facebook.com/Jalyntots', 'www.twitter.com', 'www.Instagram.com', '4', '28', '', '', '', '', '', '1'),
(7, 2, 'Tapsilog', '', '', '', 'ew', '', '10:18', '22:18', 'Bida Biday CItyyyyyy', '1', '2', '456', 14.64971, 120.966944, '', 'www.facebook.com', 'www.twitter.com', 'www.Instagram.com', '4', '29', '', '', '', '', '', '1'),
(8, 2, 'Sardina', '', '', '', 'asdfghjkl', '', '02:24', '14:24', 'Mcdollibee street', '2', '4', '1000', 14.637328, 120.982428, '', 'https://web.facebook.com/Jalyntots', 'https://twitter.com/laycosharmaine2', 'https://www.instagram.com/jlyngtrrz/', '4', '28', '', '', '', '', '', '1'),
(9, 1, '11', '', '', '', '1                                ', '', '', '', '', 'Barangay 14', '2', '2', 14.64971, 120.966944, '', '1', '1', '1', '2', '14', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `ID` bigint(20) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`ID`, `category`) VALUES
(1, 'Business Service'),
(2, 'Entertainment and Media'),
(3, 'Finances and Insurance'),
(4, 'Food and Drinks'),
(5, 'Health and Beauty'),
(6, 'Manufacturing & Industry'),
(7, 'Shopping'),
(8, 'Tourism and Accommodation'),
(9, 'Tradesmen and Construction'),
(10, 'Transport and Motoring'),
(11, 'Property');

-- --------------------------------------------------------

--
-- Table structure for table `district_list`
--

CREATE TABLE `district_list` (
  `ID` int(11) NOT NULL,
  `District` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `district_list`
--

INSERT INTO `district_list` (`ID`, `District`) VALUES
(1, '1st'),
(2, '2nd'),
(3, '3rd');

-- --------------------------------------------------------

--
-- Table structure for table `location_list`
--

CREATE TABLE `location_list` (
  `ID` bigint(20) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location_list`
--

INSERT INTO `location_list` (`ID`, `location`) VALUES
(1, 'North'),
(2, 'South');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userType` varchar(255) NOT NULL,
  `userProfile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `email`, `password`, `userType`, `userProfile`) VALUES
(1, 'jalynguts01@gmail.com', '3', '2', 0),
(2, 'jalynguts@gmail.com', '2', '2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `owner_list`
--

CREATE TABLE `owner_list` (
  `ID` int(11) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `MiddleName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `contactNumber` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Sex` varchar(255) NOT NULL,
  `Birthday` varchar(255) NOT NULL,
  `Age` int(11) NOT NULL,
  `user_cat` int(11) DEFAULT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner_list`
--

INSERT INTO `owner_list` (`ID`, `Surname`, `Firstname`, `MiddleName`, `Email`, `contactNumber`, `Address`, `Sex`, `Birthday`, `Age`, `user_cat`, `owner_name`, `photo`) VALUES
(1, 'Gutierrez', 'Jalyn', 'Maclang', 'jalynguts01@gmail.com', '09553254794', 'caloocan city', 'Female', '2001-12-01', 22, 2, '', ''),
(2, 'Gutierrez', 'Wow', 'Maclang', 'jalynguts@gmail.com', '09553254794', 'baltazar', 'Male', '2023-09-04', 32, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `post_event`
--

CREATE TABLE `post_event` (
  `ID` int(11) NOT NULL,
  `Events` varchar(255) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory_list`
--

CREATE TABLE `subcategory_list` (
  `ID` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `subCategory` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategory_list`
--

INSERT INTO `subcategory_list` (`ID`, `catId`, `subCategory`) VALUES
(1, 1, 'Training Center'),
(2, 1, 'Retail Services'),
(3, 1, 'Market Search'),
(4, 1, 'Laundry and Dry Cleaning'),
(5, 1, 'Housekeeping Service'),
(6, 1, 'Animal Shelters'),
(7, 1, 'Warehousing'),
(8, 1, 'Baby Sitters'),
(9, 1, 'Advertising'),
(10, 1, 'Health and Safety'),
(11, 1, 'Marketing'),
(12, 1, 'Consultants'),
(13, 1, 'Ac Repair Services'),
(14, 2, 'Arts and Crafts'),
(15, 2, 'Film, Televison and Video'),
(16, 2, 'Music'),
(17, 2, 'Fashion'),
(18, 2, 'Photography'),
(19, 3, 'Legal Services'),
(20, 3, 'Money Service Business'),
(21, 3, 'Banking Equipment'),
(22, 3, 'Personal Finance'),
(23, 3, 'Banks, Credit Unions'),
(24, 3, 'Insurance Company'),
(25, 3, 'Pawnshops'),
(26, 4, 'Restaurants'),
(27, 4, 'Catering Equipment'),
(28, 4, 'Farmers Market'),
(29, 4, 'Food Retailers'),
(30, 4, 'Supermarket'),
(31, 4, 'Catering'),
(32, 4, 'Cafes'),
(33, 4, 'Food Distributors'),
(34, 4, 'Food Manufacturing'),
(35, 4, 'Wine and Beer'),
(36, 5, 'Doctors and Clinics'),
(37, 5, 'Health Care'),
(38, 5, 'Hairdessers'),
(39, 5, 'Beauty Proffesional'),
(40, 5, 'Medical Equipment'),
(41, 5, 'Beauty Product'),
(42, 5, 'Nursing and Care'),
(43, 5, 'Pharmacies'),
(44, 5, 'Fitness'),
(45, 5, 'Massage Therapist'),
(46, 5, 'Dentists'),
(47, 5, 'Opticians'),
(48, 6, 'Industrial Services'),
(49, 6, 'Furniture Manufacturers'),
(50, 6, 'Automotive'),
(51, 6, 'Paper Products'),
(52, 6, 'Carpentry'),
(53, 6, 'Electrical Services'),
(54, 6, 'Oil and Gas Companies'),
(55, 6, 'Industrial Automation'),
(56, 6, 'Steel Products'),
(57, 7, 'Gadgets'),
(58, 7, 'Hardware Stores'),
(59, 7, 'Jewellery'),
(60, 7, 'Mobile Phone Shops'),
(61, 7, 'Music'),
(62, 7, 'Clothing and Accessories'),
(63, 7, 'Furniture'),
(64, 7, 'Books'),
(65, 7, 'Optical Shop'),
(66, 7, 'Pet Shop'),
(67, 8, 'Hotels'),
(68, 8, 'Travel Agents'),
(69, 8, 'Apartments'),
(70, 8, 'Hotel and Motel Equipment'),
(71, 9, 'Construction'),
(72, 9, 'Construction Equipment'),
(73, 9, 'Decorators'),
(74, 9, 'Handyman'),
(75, 9, 'Plumbers'),
(76, 9, 'Plumbing Services'),
(77, 9, 'Glass Manufacturing'),
(78, 10, 'Motorbikes'),
(79, 10, 'Vehicle Sales'),
(80, 10, 'Bicycles'),
(81, 10, 'Package Shipping'),
(82, 10, 'Auto Services'),
(83, 10, 'Bus Line'),
(84, 10, 'Transport'),
(85, 10, 'Car Rental'),
(86, 10, 'Driving School'),
(87, 10, 'Vehicle Manufacturers'),
(88, 10, 'Auto Supplies'),
(89, 10, 'Car Wash'),
(90, 11, 'Real Estate Agents'),
(91, 11, 'Property Management'),
(92, 11, 'Rental Property'),
(93, 11, 'Building Maintenance'),
(94, 11, 'Interior Design'),
(95, 11, 'Commercial Property'),
(96, 11, 'Renovation'),
(97, 11, 'Auctions'),
(98, 11, 'Security'),
(99, 11, 'Warehouses'),
(100, 11, 'Fire Safety Equipment'),
(101, 11, 'Apartment Rentals');

-- --------------------------------------------------------

--
-- Table structure for table `user_category`
--

CREATE TABLE `user_category` (
  `iD` int(11) NOT NULL,
  `userDesccription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_category`
--

INSERT INTO `user_category` (`iD`, `userDesccription`) VALUES
(1, 'CEIPO'),
(2, 'Business'),
(3, 'User'),
(4, 'super admin');

-- --------------------------------------------------------

--
-- Table structure for table `zone_list`
--

CREATE TABLE `zone_list` (
  `ID` int(11) NOT NULL,
  `Zone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zone_list`
--

INSERT INTO `zone_list` (`ID`, `Zone`) VALUES
(1, 'Zone 1'),
(2, 'Zone 2'),
(3, 'Zone 3'),
(4, 'Zone 4'),
(5, 'Zone 5'),
(6, 'Zone 6'),
(7, 'Zone 7'),
(8, 'Zone 8'),
(9, 'Zone 9'),
(10, 'Zone 10'),
(11, 'Zone 11'),
(12, 'Zone 12'),
(13, 'Zone 13'),
(14, 'Zone 14'),
(15, 'Zone 15'),
(16, 'Zone 16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangay_list`
--
ALTER TABLE `barangay_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `brgyzone_list`
--
ALTER TABLE `brgyzone_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `business_list`
--
ALTER TABLE `business_list`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `district_list`
--
ALTER TABLE `district_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `location_list`
--
ALTER TABLE `location_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `owner_list`
--
ALTER TABLE `owner_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `post_event`
--
ALTER TABLE `post_event`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `subcategory_list`
--
ALTER TABLE `subcategory_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_category`
--
ALTER TABLE `user_category`
  ADD PRIMARY KEY (`iD`);

--
-- Indexes for table `zone_list`
--
ALTER TABLE `zone_list`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangay_list`
--
ALTER TABLE `barangay_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `brgyzone_list`
--
ALTER TABLE `brgyzone_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `business_list`
--
ALTER TABLE `business_list`
  MODIFY `bus_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `district_list`
--
ALTER TABLE `district_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `location_list`
--
ALTER TABLE `location_list`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `owner_list`
--
ALTER TABLE `owner_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_event`
--
ALTER TABLE `post_event`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategory_list`
--
ALTER TABLE `subcategory_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `user_category`
--
ALTER TABLE `user_category`
  MODIFY `iD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `zone_list`
--
ALTER TABLE `zone_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
