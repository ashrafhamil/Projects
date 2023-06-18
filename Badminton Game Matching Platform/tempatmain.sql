-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2023 at 11:54 PM
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
-- Database: `tempatmain`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bId` int(5) NOT NULL,
  `bBooker` varchar(255) NOT NULL,
  `bCourtName` varchar(255) NOT NULL,
  `bDate` date NOT NULL,
  `bTimeSlot` varchar(50) NOT NULL,
  `bCourtNumber` int(255) NOT NULL,
  `bTimeStamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `bPrice` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bId`, `bBooker`, `bCourtName`, `bDate`, `bTimeSlot`, `bCourtNumber`, `bTimeStamp`, `bPrice`) VALUES
(107, 'ashrafhamil@yahoo.com', 'Badminton Hall ILSAS', '2023-06-03', '8:00am - 10:00am', 5, '2023-06-01 21:47:42', 30),
(108, 'c@mail.com', 'IOI Sports Centre', '2023-06-04', '10:00am - 12:00pm', 15, '2023-06-01 21:53:09', 70),
(109, 'f@mail.com', 'KipMall', '2023-06-05', '8:00pm - 10:00pm', 7, '2023-06-01 22:15:56', 40),
(110, 'ashrafhamil@yahoo.com', 'IOI Sports Centre', '2023-06-10', '8:00am - 10:00am', 1, '2023-06-02 08:16:44', 35),
(111, 'ashrafhamil@yahoo.com', 'IOI Sports Centre', '2023-06-28', '8:00am - 10:00am', 1, '2023-06-03 18:40:37', 35),
(112, 'a@mail.com', 'IOI Sports Centre', '2023-06-25', '2:00pm - 4:00pm', 1, '2023-06-06 18:06:00', 35);

-- --------------------------------------------------------

--
-- Table structure for table `ccourt`
--

CREATE TABLE `ccourt` (
  `cname` varchar(50) NOT NULL,
  `cloca` varchar(255) NOT NULL,
  `cGoogleMapLink` varchar(100) NOT NULL,
  `cprice` decimal(5,2) NOT NULL,
  `cPhone` varchar(20) NOT NULL,
  `ctotal` int(2) NOT NULL,
  `cavail` int(3) NOT NULL,
  `copen` time NOT NULL,
  `cclose` time NOT NULL,
  `cdesc` varchar(100) NOT NULL,
  `cOwnerEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ccourt`
--

INSERT INTO `ccourt` (`cname`, `cloca`, `cGoogleMapLink`, `cprice`, `cPhone`, `ctotal`, `cavail`, `copen`, `cclose`, `cdesc`, `cOwnerEmail`) VALUES
('Badminton Hall ILSAS', 'TNB INTEGRATED LEARNING SOLUTION SDN BHD, KM 7, Jalan Ikram-Uniten, Institut Latihan Sultan Ahmad Shah', 'https://goo.gl/maps/Bpkxv79meotj3s9w8', '15.00', '0389227222', 5, 0, '08:00:00', '00:00:00', 'Facilities such as surau, toilet, vending machine, parking, gym is near!', 'z@mail.com'),
('IOI Sports Centre', '2AT-10,Level 4, East Wing Lebuh IRC, IOI Resort City Putrajaya, 62502 Sepang, Putrajaya', 'https://goo.gl/maps/ND3nWMJnzSth1Js87', '35.00', '0383288875', 20, 16, '08:00:00', '00:00:00', 'World Class Sports Facilities in Putrajaya!', 'z@mail.com'),
('KipMall', 'KipMall, Bandar Baru Bangi', 'https://goo.gl/maps/Pn8n6hf9BZeyTHv77', '20.00', '0182445118', 20, 19, '08:00:00', '00:00:00', 'Court KipMall ', 'x@mail.com'),
('Rexcool Sports Centre', '1397, Jln BS 3/1, Taman Bukit Serdang, 43300 Seri Kembangan, Selangor', 'https://goo.gl/maps/pT8Y1ANbCT9LQ88o6', '30.00', '0111193 1478', 20, 20, '08:00:00', '00:00:00', 'We welcome beginner and professional player!', 'x@mail.com'),
('Uptown Sport Center Bangi', '76828, Jln Angsana, 43650 Bandar Baru Bangi, Selangor', 'https://goo.gl/maps/xRpiDHVoHrX8dTJ76', '25.00', '0139208880', 20, 20, '08:00:00', '00:00:00', 'Best sport center!', 'x@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `court`
--

CREATE TABLE `court` (
  `cname` varchar(255) NOT NULL,
  `cadd1` varchar(255) NOT NULL,
  `cadd2` varchar(255) NOT NULL,
  `czip` varchar(6) NOT NULL,
  `ccity` varchar(255) NOT NULL,
  `cstate` varchar(255) NOT NULL,
  `cphone` varchar(15) NOT NULL,
  `cemail` varchar(255) NOT NULL,
  `cpass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court`
--

INSERT INTO `court` (`cname`, `cadd1`, `cadd2`, `czip`, `ccity`, `cstate`, `cphone`, `cemail`, `cpass`) VALUES
('z', 'z', 'z', '9', 'z', 'z', '9', 'z@mail.com', 'zzz');

-- --------------------------------------------------------

--
-- Table structure for table `courtowner`
--

CREATE TABLE `courtowner` (
  `cusername` varchar(255) NOT NULL,
  `cfname` varchar(255) NOT NULL,
  `clname` varchar(255) NOT NULL,
  `cemail` varchar(255) NOT NULL,
  `cadd` varchar(255) NOT NULL,
  `cphone` varchar(20) NOT NULL,
  `cpass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courtowner`
--

INSERT INTO `courtowner` (`cusername`, `cfname`, `clname`, `cemail`, `cadd`, `cphone`, `cpass`) VALUES
('xixii', 'Xi', 'Xii', 'x@mail.com', 'Jalan Xixi', '011223344', 'xxx'),
('zaimal', 'Zaimal', 'Asri', 'z@mail.com', 'Bandar Baru Bangi, Selangor', '0123456789', 'zzz');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `gname` varchar(100) NOT NULL,
  `organiserName` varchar(100) NOT NULL,
  `gameplayLevel` varchar(255) NOT NULL,
  `max` int(2) NOT NULL,
  `min` int(2) NOT NULL,
  `current` int(3) NOT NULL DEFAULT 1,
  `venue` varchar(100) NOT NULL,
  `courtNumber` int(3) NOT NULL,
  `googleMapLink` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`gname`, `organiserName`, `gameplayLevel`, `max`, `min`, `current`, `venue`, `courtNumber`, `googleMapLink`, `date`, `time`, `desc`) VALUES
('Kalah Bayar', 'Ashraf', 'Intermediate', 6, 4, 6, 'Badminton Hall ILSAS', 5, 'https://goo.gl/maps/Bpkxv79meotj3s9w8', '2023-06-03', '08:00:00', 'You lose, you pay'),
('Main Rilek-rilek', 'Cupcake', 'Beginner', 8, 4, 3, 'IOI Sports Centre', 15, 'https://goo.gl/maps/ND3nWMJnzSth1Js87', '2023-06-04', '10:00:00', 'Tak reti takpe, asalkan nak main'),
('Mixed Doubles Training', 'Froyo', 'Professional', 8, 4, 3, 'KipMall', 7, 'https://goo.gl/maps/Pn8n6hf9BZeyTHv77', '2023-06-05', '20:00:00', 'Boys n girls are invited :)'),
('Sunday Game', 'Ashraf', 'Beginner', 8, 4, 1, 'Rexcool Sports Centre', 4, 'https://goo.gl/maps/pT8Y1ANbCT9LQ88o6', '2023-06-04', '10:00:00', 'Sunday lets play badminton');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('tempatmain', 'tempatmain123');

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `playerUserName` varchar(50) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `add1` varchar(255) NOT NULL,
  `zip` varchar(6) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `profilePicture` varchar(255) NOT NULL,
  `gameplayLevel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`playerUserName`, `fname`, `lname`, `email`, `phone`, `add1`, `zip`, `city`, `state`, `pass`, `profilePicture`, `gameplayLevel`) VALUES
('Almond', 'Almond', 'a', 'a@mail.com', '011111111', 'a', '1', 'Kajang', 'a', 'aaa', 'ArisaHigashinoProfilePicture.jpg', 'Professional'),
('Ashraf', 'Ashraf', 'Hamil', 'ashrafhamil@yahoo.com', '01162521464', 'Lot 404, Lorong Jalan,', '33000', 'Kajang', 'Selangor', 'aaa', 'gambarYap.jpg', 'Intermediate'),
('Berry', 'Berry', 'b', 'b@mail.com', '012222222', 'b', 'b', 'Kajang', 'b', 'bbb', 'GintingProfilePicture.jpg', 'Intermediate'),
('Cupcake', 'Cupcake', 'c', 'c@mail.com', '0133333333', 'c', 'c', 'Bangi', 'c', 'ccc', 'KentoMomotaProfilePicture.jpg', 'Beginner'),
('Donut', 'Donut', 'd', 'd@mail.com', '014444444', 'd', 'd', 'Putrajaya', 'd', 'ddd', 'LinDanProfilePicture.png', 'Professional'),
('Eclair', 'Eclair', 'e', 'e@mail.com', '015555555', 'e', '33000', 'Seri Kembangan', 'e', 'eee', 'LeeChongWeiProfilePicture.png', 'Intermediate'),
('Froyo', 'Froyo', 'f', 'f@mail.com', '016666666', 'f', '33000', 'Serdang', 'f', 'fff', 'TaiTzuYingProfilePicture.jpg', 'Professional');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `jid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gname` varchar(255) NOT NULL,
  `gameplayLevel` varchar(255) NOT NULL,
  `max` int(3) NOT NULL,
  `current` int(3) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `courtNumber` int(3) NOT NULL,
  `googleMapLink` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`jid`, `email`, `gname`, `gameplayLevel`, `max`, `current`, `venue`, `courtNumber`, `googleMapLink`, `date`, `time`) VALUES
(28, 'ashrafhamil@yahoo.com', 'Kalah Bayar', 'Intermediate', 6, 1, 'Badminton Hall ILSAS', 0, 'https://goo.gl/maps/Bpkxv79meotj3s9w8', '2023-06-03', '08:00:00'),
(29, 'b@mail.com', 'Kalah Bayar', 'Intermediate', 6, 2, 'Badminton Hall ILSAS', 0, 'https://goo.gl/maps/Bpkxv79meotj3s9w8', '2023-06-03', '08:00:00'),
(30, 'c@mail.com', 'Kalah Bayar', 'Intermediate', 6, 3, 'Badminton Hall ILSAS', 0, 'https://goo.gl/maps/Bpkxv79meotj3s9w8', '2023-06-03', '08:00:00'),
(31, 'c@mail.com', 'Main Rilek-rilek', 'Beginner', 8, 1, 'IOI Sports Centre', 0, 'https://goo.gl/maps/ND3nWMJnzSth1Js87', '2023-06-04', '10:00:00'),
(32, 'f@mail.com', 'Main Rilek-rilek', 'Beginner', 8, 2, 'IOI Sports Centre', 0, 'https://goo.gl/maps/ND3nWMJnzSth1Js87', '2023-06-04', '10:00:00'),
(33, 'f@mail.com', 'Mixed Doubles Training', 'Professional', 8, 1, 'KipMall', 0, 'https://goo.gl/maps/Pn8n6hf9BZeyTHv77', '2023-06-05', '20:00:00'),
(34, 'a@mail.com', 'Mixed Doubles Training', 'Professional', 8, 2, 'KipMall', 0, 'https://goo.gl/maps/Pn8n6hf9BZeyTHv77', '2023-06-05', '20:00:00'),
(35, 'ashrafhamil@yahoo.com', 'Main Rilek-rilek', 'Beginner', 8, 3, 'IOI Sports Centre', 0, 'https://goo.gl/maps/ND3nWMJnzSth1Js87', '2023-06-04', '10:00:00'),
(36, 'ashrafhamil@yahoo.com', 'Sunday Game', 'Beginner', 8, 1, 'Rexcool Sports Centre', 0, 'https://goo.gl/maps/pT8Y1ANbCT9LQ88o6', '2023-06-04', '10:00:00'),
(37, 'd@mail.com', 'Kalah Bayar', 'Intermediate', 6, 4, 'Badminton Hall ILSAS', 0, 'https://goo.gl/maps/Bpkxv79meotj3s9w8', '2023-06-03', '08:00:00'),
(38, 'e@mail.com', 'Kalah Bayar', 'Intermediate', 6, 5, 'Badminton Hall ILSAS', 0, 'https://goo.gl/maps/Bpkxv79meotj3s9w8', '2023-06-03', '08:00:00'),
(39, 'f@mail.com', 'Kalah Bayar', 'Intermediate', 6, 6, 'Badminton Hall ILSAS', 0, 'https://goo.gl/maps/Bpkxv79meotj3s9w8', '2023-06-03', '08:00:00'),
(40, 'ashrafhamil@yahoo.com', 'Mixed Doubles Training', 'Professional', 8, 3, 'KipMall', 0, 'https://goo.gl/maps/Pn8n6hf9BZeyTHv77', '2023-06-05', '20:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bId`);

--
-- Indexes for table `ccourt`
--
ALTER TABLE `ccourt`
  ADD PRIMARY KEY (`cname`);

--
-- Indexes for table `court`
--
ALTER TABLE `court`
  ADD PRIMARY KEY (`cname`);

--
-- Indexes for table `courtowner`
--
ALTER TABLE `courtowner`
  ADD PRIMARY KEY (`cemail`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`gname`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`jid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `jid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
