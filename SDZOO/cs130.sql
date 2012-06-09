-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2012 at 11:14 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cs130`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

DROP TABLE IF EXISTS `animal`;
CREATE TABLE IF NOT EXISTS `animal` (
  `animal_id` int(11) NOT NULL,
  `animal_name` varchar(50) NOT NULL,
  `animal_species` int(11) NOT NULL,
  PRIMARY KEY (`animal_id`),
  KEY `animal_species` (`animal_species`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`animal_id`, `animal_name`, `animal_species`) VALUES
(1, 'Wasabi', 1),
(2, 'Thandi', 1),
(3, 'Tombi', 2),
(4, 'Sher', 2),
(5, 'Tangi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `animal_species`
--

DROP TABLE IF EXISTS `animal_species`;
CREATE TABLE IF NOT EXISTS `animal_species` (
  `species_id` int(11) NOT NULL,
  `species_name` varchar(50) NOT NULL,
  PRIMARY KEY (`species_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `animal_species`
--

INSERT INTO `animal_species` (`species_id`, `species_name`) VALUES
(1, 'South African Hedgehog'),
(2, 'Indian Tiger');

-- --------------------------------------------------------

--
-- Table structure for table `enrichment`
--

DROP TABLE IF EXISTS `enrichment`;
CREATE TABLE IF NOT EXISTS `enrichment` (
  `enrichment_id` int(11) NOT NULL,
  `enrichment_name` varchar(50) NOT NULL,
  `enrichment_category` varchar(50) NOT NULL,
  `enrichment_subcategory` varchar(50) NOT NULL,
  PRIMARY KEY (`enrichment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrichment`
--

INSERT INTO `enrichment` (`enrichment_id`, `enrichment_name`, `enrichment_category`, `enrichment_subcategory`) VALUES
(1, 'Curry', 'Sensory', 'Spices'),
(2, 'Thyme', 'Sensory', 'Spices'),
(3, 'Kitty Grass', 'Foraging', 'Foods'),
(4, 'Basket', 'Manipulanda', 'Manufactured'),
(5, 'Boomer Ball', 'Manipulanda', 'Manufactured');

-- --------------------------------------------------------

--
-- Table structure for table `enrichment_animal`
--

DROP TABLE IF EXISTS `enrichment_animal`;
CREATE TABLE IF NOT EXISTS `enrichment_animal` (
  `animal_id` int(11) NOT NULL,
  `zookeeper_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `enrichment_id` int(11) NOT NULL,
  `duration_observed` int(11) NOT NULL,
  `indirect_use` varchar(5) NOT NULL,
  `behavior` varchar(5) NOT NULL,
  `behavior_pos` varchar(20) NOT NULL,
  `duration_interaction` int(11) NOT NULL,
  KEY `animal_id` (`animal_id`),
  KEY `zookeeper_id` (`zookeeper_id`),
  KEY `enrichment_id` (`enrichment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrichment_animal`
--

INSERT INTO `enrichment_animal` (`animal_id`, `zookeeper_id`, `date`, `time`, `enrichment_id`, `duration_observed`, `indirect_use`, `behavior`, `behavior_pos`, `duration_interaction`) VALUES
(1, 1, '2012-05-07', '11:00:00', 1, 15, 'Y', 'P', 'NA', 10),
(3, 3, '2012-05-08', '12:10:00', 4, 12, 'N', 'A', 'EXPLORE', 10);

-- --------------------------------------------------------

--
-- Table structure for table `zookeeper_login`
--

DROP TABLE IF EXISTS `zookeeper_login`;
CREATE TABLE IF NOT EXISTS `zookeeper_login` (
  `id` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zookeeper_login`
--

INSERT INTO `zookeeper_login` (`id`, `password`) VALUES
(1, 'nitish'),
(2, 'neeraj'),
(3, 'Elliot'),
(4, 'tinna'),
(5, 'nicole'),
(6, 'morgan');

-- --------------------------------------------------------

--
-- Table structure for table `zookeeper_name`
--

DROP TABLE IF EXISTS `zookeeper_name`;
CREATE TABLE IF NOT EXISTS `zookeeper_name` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zookeeper_name`
--

INSERT INTO `zookeeper_name` (`id`, `name`) VALUES
(1, 'Nitish Dalal'),
(2, 'Neeraj'),
(3, 'Elliot'),
(4, 'Tinna'),
(5, 'Nicole'),
(6, 'Morgan');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`animal_species`) REFERENCES `animal_species` (`species_id`);

--
-- Constraints for table `enrichment_animal`
--
ALTER TABLE `enrichment_animal`
  ADD CONSTRAINT `enrichment_animal_ibfk_5` FOREIGN KEY (`enrichment_id`) REFERENCES `enrichment` (`enrichment_id`),
  ADD CONSTRAINT `enrichment_animal_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`),
  ADD CONSTRAINT `enrichment_animal_ibfk_2` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`),
  ADD CONSTRAINT `enrichment_animal_ibfk_3` FOREIGN KEY (`zookeeper_id`) REFERENCES `zookeeper_login` (`id`),
  ADD CONSTRAINT `enrichment_animal_ibfk_4` FOREIGN KEY (`zookeeper_id`) REFERENCES `zookeeper_login` (`id`);

--
-- Constraints for table `zookeeper_name`
--
ALTER TABLE `zookeeper_name`
  ADD CONSTRAINT `zookeeper_name_ibfk_1` FOREIGN KEY (`id`) REFERENCES `zookeeper_login` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
