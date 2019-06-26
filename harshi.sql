-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2019 at 02:24 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `harshi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `seq` int(100) NOT NULL,
  `codeLplus1` varchar(20) NOT NULL,
  `nameLplus1` varchar(40) NOT NULL,
  `codeminus` varchar(40) NOT NULL,
  `wdate` date NOT NULL,
  `utilization` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`seq`, `codeLplus1`, `nameLplus1`, `codeminus`, `wdate`, `utilization`) VALUES
(1, '100', 'Head 1', '11', '2019-06-10', 32),
(2, '100', 'Head 1', '12', '2019-06-10', 67),
(3, '100', 'Head 1', '11', '2019-06-17', 64),
(4, '101', 'Head 2', '41', '2019-06-10', 89),
(6, '100', 'Head 1', '12', '2019-06-17', 67),
(7, '100', 'Head 1', '13', '2019-06-10', 100),
(8, '100', 'Head 1', '14', '2019-06-10', 34),
(9, '101', 'Head 2', '43', '2019-06-17', 25),
(10, '100', 'Head 1', '13', '2019-06-17', 89),
(11, '100', 'Head 1', '14', '2019-06-17', 78),
(12, '100', 'Head 1', '6789', '2019-06-10', 89),
(13, '103', 'xyz', '87', '2019-06-17', 50),
(14, '103', 'xyz', '56', '2019-06-17', 67),
(15, '103', 'xyz', '67', '2019-06-17', 98),
(16, '100', 'Head 1', '12', '2019-06-24', 96),
(17, '100', 'Head 1', '6789', '2019-06-24', 67),
(18, '100', 'Head 1', '13', '2019-06-24', 89),
(19, '100', 'Head 1', '14', '2019-06-24', 90),
(20, '100', 'Head 1', '11', '2019-06-24', 118),
(22, '103', 'xyz', '56', '2019-06-03', 24),
(23, '103', 'xyz', '87', '2019-06-03', 34),
(24, '103', 'xyz', '67', '2019-06-03', 56),
(25, '101', 'Head 2', '41', '2019-06-03', 67),
(26, '101', 'Head 2', '43', '2019-06-03', 25),
(27, '101', 'Head 2', '42', '2019-06-03', 67),
(28, '100', 'Head 1', '11', '0000-00-00', 56),
(29, '100', 'Head 1', '13', '0000-00-00', 18),
(30, '100', 'Head 1', '14', '0000-00-00', 67),
(31, '100', 'Head 1', '11', '2019-07-01', 56),
(32, '100', 'Head 1', '6789', '2019-07-01', 98),
(34, '103', 'xyz', '56', '2019-06-24', 6),
(35, '103', 'xyz', '67', '2019-06-24', 5),
(36, '103', 'xyz', '87', '2019-06-24', 8),
(37, '103', 'xyz', '56', '2019-07-01', 0),
(38, '103', 'xyz', '87', '2019-07-01', 0),
(39, '103', 'xyz', '56', '2019-06-25', 0),
(40, '103', 'xyz', '87', '2019-06-25', 0),
(41, '103', 'xyz', '67', '2019-07-01', 0),
(42, '103', 'xyz', '56', '2019-07-08', 0),
(43, '103', 'xyz', '56', '2019-07-15', 0),
(44, '103', 'xyz', '67', '2019-07-15', 0),
(45, '103', 'xyz', '87', '2019-07-15', 0),
(46, '103', 'xyz', '56', '2019-06-10', 0),
(47, '103', 'xyz', '67', '2019-06-10', 0),
(48, '103', 'xyz', '87', '2019-06-10', 0),
(49, '103', 'xyz', '56', '2019-08-05', 0),
(50, '103', 'xyz', '67', '2019-08-05', 0),
(51, '103', 'xyz', '87', '2019-08-05', 0),
(52, '103', 'xyz', '56', '2019-07-22', 0),
(60, '100', 'Head 1', '11', '2019-06-03', 0),
(61, '100', 'Head 1', '12', '2019-06-03', 0),
(62, '100', 'Head 1', '11', '2019-07-29', 33),
(63, '100', 'Head 1', '13', '2019-07-29', 1028),
(67, '100', 'Head 1', '12', '2019-07-29', 8),
(68, '100', 'Head 1', '14', '2019-07-29', 19),
(81, '100', 'Head 1', '11', '2019-07-08', 118),
(87, '100', 'Head 1', '12', '2019-07-08', 101),
(93, '100', 'Head 1', '13', '2019-07-08', 100),
(96, '100', 'Head 1', '14', '2019-07-08', 100),
(100, '100', 'Head 1', '6789', '2019-07-08', 99),
(102, '100', 'Head 1', '11', '2019-07-15', 100),
(107, '100', 'Head 1', '12', '2019-07-15', 94),
(119, '100', 'Head 1', '483', '2019-06-24', 54),
(127, '100', 'Head 1', '13', '2019-07-15', 24);

-- --------------------------------------------------------

--
-- Table structure for table `lminus`
--

CREATE TABLE `lminus` (
  `codeplus1` varchar(30) NOT NULL,
  `codeminus1` varchar(30) NOT NULL,
  `nameMinus1` varchar(30) NOT NULL,
  `domain` varchar(30) NOT NULL,
  `dept` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lminus`
--

INSERT INTO `lminus` (`codeplus1`, `codeminus1`, `nameMinus1`, `domain`, `dept`) VALUES
('100', '11', 'e1', '', ''),
('100', '12', 'e2', '', ''),
('100', '12123', 'Harshita Agrawal', 'Retail', 'IT'),
('100', '13', 'e3', '', ''),
('100', '14', 'e4', '', ''),
('102', '34', 'rishi', '', ''),
('101', '41', 'a1', '', ''),
('101', '42', 'a2', '', ''),
('101', '43', 'a3', '', ''),
('100', '483', 'Harshita Agrawal', 'Retail', 'IT'),
('103', '56', 'rama abc', '', ''),
('103', '67', 'harshi', '', ''),
('100', '6789', 'Harshuuu', '', ''),
('103', '87', 'Kashi', 'RETAIL', 'BU2');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `inc` int(40) NOT NULL,
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `hours` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`inc`, `id`, `name`, `hours`) VALUES
(1, 3, 'Mercedes', 14),
(2, 3, 'Volvo', 13),
(3, 16, 'Hi', 1),
(4, 16, 'Audi', 10),
(5, 16, 'dfdgdfcvbcxb', 0),
(6, 16, 'Mercedes', 10),
(7, 16, 'Saab', 10),
(8, 16, 'Volvo', 10),
(9, 20, 'dffHi', 10),
(10, 20, 'Audihiiiiiiiiiiiiiii', 10),
(11, 20, 'vbvbcvbcxb', 0),
(12, 20, 'Mercedes', 10),
(13, 20, 'Saab', 10),
(14, 20, 'Volvo', 10),
(15, 37, 'Volvo', 5),
(16, 38, 'Volvo', 5),
(17, 39, 'Saab', 42),
(18, 40, 'Mercedes', 23),
(19, 41, 'Saab', 23),
(20, 42, 'Volvo', 41),
(21, 43, 'Hi', 0),
(22, 44, 'Hi', 0),
(23, 45, 'bye', 0),
(24, 46, 'Mercedes', 41),
(25, 47, 'Mercedes', 12),
(26, 48, '12', 2),
(27, 49, 'Saab', 12),
(28, 50, 'Volvo', 0),
(29, 51, 'Volvo', 23),
(30, 52, '', 0),
(31, 60, 'Volvo', 13),
(32, 61, 'Mercedes', 16),
(33, 63, 'Audi', 8),
(34, 63, 'Mercedes', 1000),
(35, 63, 'Saab', 20),
(36, 67, 'Mercedes', 8),
(37, 68, 'Mercedes', 9),
(38, 68, 'Saab', 10),
(39, 81, 'Audi', 10),
(40, 81, 'Mercedes', 10),
(41, 81, 'Saab', 20),
(42, 81, 'Volvo', 10),
(43, 87, 'Mercedes', 1),
(44, 87, 'Saab', 2),
(45, 87, 'Volvo', 40),
(46, 93, 'Mercedes', 0.5),
(47, 93, 'Saab', 2),
(48, 93, 'Volvo', 40),
(49, 96, 'Audi', 0.5),
(50, 96, 'Mercedes', 1.4),
(51, 96, 'Volvo', 40.6),
(52, 100, 'Volvo', 42),
(53, 102, 'Audi', 0.5),
(54, 102, 'Mercedes', 12),
(55, 102, 'Saab', 20),
(56, 102, 'Volvo', 10),
(57, 107, 'Mercedes', 30),
(58, 107, 'Volvo', 10),
(59, 119, '23', 23),
(60, 127, 'Saab', 10);

--
-- Triggers `project`
--
DELIMITER $$
CREATE TRIGGER `cal_avg` AFTER INSERT ON `project` FOR EACH ROW BEGIN
UPDATE details set utilization = (SELECT sum(hours) FROM project where id=new.id)/0.425 where seq=new.id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cal_avg_upd` AFTER UPDATE ON `project` FOR EACH ROW BEGIN
UPDATE details set utilization = (SELECT sum(hours) FROM project where id=new.id)/0.425 where seq=new.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(10) NOT NULL,
  `passw` varchar(20) NOT NULL,
  `Namep` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `passw`, `Namep`) VALUES
('100', '123', 'Harshita Agrawal'),
('101', '123', 'Sanjali Dhamale'),
('102', '123', 'abc'),
('103', '123', 'xyz'),
('2453', '123', 'Pooja '),
('9', '333', '333');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`seq`),
  ADD UNIQUE KEY `my_unique_key` (`codeLplus1`,`codeminus`,`wdate`),
  ADD KEY `codeminus` (`codeminus`);

--
-- Indexes for table `lminus`
--
ALTER TABLE `lminus`
  ADD PRIMARY KEY (`codeminus1`),
  ADD KEY `codeplus1` (`codeplus1`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`inc`),
  ADD UNIQUE KEY `project_unique_key` (`id`,`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `seq` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `inc` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `details_ibfk_1` FOREIGN KEY (`codeminus`) REFERENCES `lminus` (`codeminus1`),
  ADD CONSTRAINT `details_ibfk_2` FOREIGN KEY (`codeLplus1`) REFERENCES `user` (`username`);

--
-- Constraints for table `lminus`
--
ALTER TABLE `lminus`
  ADD CONSTRAINT `lminus_ibfk_1` FOREIGN KEY (`codeplus1`) REFERENCES `user` (`username`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`id`) REFERENCES `details` (`seq`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
