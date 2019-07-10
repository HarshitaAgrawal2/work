-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2019 at 03:44 PM
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
(185, '100', 'Parul', '4', '2019-07-01', 71),
(186, '100', 'Parul', '1', '2019-07-01', 64),
(190, '100', 'Parul', '1', '2019-07-08', 94),
(192, '100', 'Parul', '1', '2019-07-15', 24),
(193, '100', 'Parul', '4', '2019-07-15', 24),
(194, '100', 'Parul', '6', '2019-07-22', 96),
(195, '100', 'Parul', '5', '2019-07-22', 28),
(196, '100', 'Parul', '5', '2019-07-15', 24),
(197, '100', 'Parul', '6', '2019-07-15', 24),
(198, '100', 'Parul', '7', '2019-07-15', 24),
(199, '100', 'Parul', '8', '2019-07-15', 28),
(200, '100', 'Parul', '5', '2019-07-01', 35),
(201, '100', 'Parul', '8', '2019-07-08', 35),
(203, '100', 'Parul', '5', '2019-07-08', 47),
(204, '100', 'Parul', '7', '2019-07-08', 100),
(209, '100', 'Parul', '4', '2019-07-08', 24),
(210, '100', 'Parul', '6', '2019-07-08', 24),
(211, '100', 'Parul', '1', '0000-00-00', 71),
(212, '100', 'Parul', '7', '0000-00-00', 82),
(216, '100', 'Parul', '1', '2019-08-12', 94),
(217, '100', 'Parul', '6', '2019-08-19', 24),
(218, '100', 'Parul', '5', '2019-09-16', 99),
(219, '100', 'Parul', '6', '2019-09-09', 47),
(220, '100', 'Parul', '5', '2019-11-04', 47);

--
-- Triggers `details`
--
DELIMITER $$
CREATE TRIGGER `delete_project` BEFORE DELETE ON `details` FOR EACH ROW BEGIN
delete from project where id=old.seq;
END
$$
DELIMITER ;

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
('100', '1', 'Harshita ', 'Retail', 'Sales'),
('101', '2', 'Pramod', 'Tech', 'IT'),
('100', '4', 'Vaibhav', 'Tech', 'IT'),
('100', '5', 'Priyanka', 'retail', 'IT'),
('100', '6', 'Arnav', 'Tech', 'IT'),
('100', '7', 'Pooja', 'retail', 'IT'),
('100', '8', 'Arnavi', 'Tech', 'IT');

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
(110, 185, 'Navision', 30),
(111, 186, 'Project 1', 15),
(112, 186, 'Enterprise', 11),
(113, 186, 'Project 3', 1),
(114, 190, 'Project 2', 10),
(115, 190, 'Navision', 20),
(116, 192, 'Enterprise', 10),
(117, 193, 'Enterprise', 10),
(118, 194, 'Enterprise', 41),
(119, 195, 'Navision', 12),
(120, 196, 'Enterprise', 10),
(121, 197, 'Enterprise', 10),
(122, 198, 'Navision', 10),
(123, 199, 'Project 2', 12),
(124, 200, 'Enterprise', 15),
(125, 201, 'Navision', 15),
(127, 203, 'Project 4', 20),
(128, 204, 'Project 2', 10),
(129, 204, 'Project 6', 32.5),
(130, 190, 'Project 3', 10),
(131, 209, 'Enterprise', 10),
(132, 210, 'Navision', 10),
(133, 211, 'Enterprise', 10),
(134, 212, 'Project 1', 20),
(135, 211, 'Project 1', 20),
(136, 212, 'Navision', 10),
(137, 212, 'Project 3', 5),
(138, 216, 'Navision', 40),
(139, 217, 'Project 4', 10),
(140, 218, 'Project 1', 42),
(141, 219, 'Navision', 20),
(142, 220, 'Project 4', 20);

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
-- Table structure for table `projectlist`
--

CREATE TABLE `projectlist` (
  `namep` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projectlist`
--

INSERT INTO `projectlist` (`namep`) VALUES
('Enterprise'),
('Navision'),
('Project 1'),
('Project 2'),
('Project 3'),
('Project 4'),
('Project 5'),
('Project 6'),
('Project 7'),
('Project 8');

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
('100', '100', 'Parul'),
('101', '101', 'Anand'),
('103', '103', 'Pooja Yadav Raj');

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
-- Indexes for table `projectlist`
--
ALTER TABLE `projectlist`
  ADD UNIQUE KEY `namep` (`namep`);

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
  MODIFY `seq` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `inc` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

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
