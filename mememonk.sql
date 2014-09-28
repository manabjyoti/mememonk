-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 04, 2014 at 07:10 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mememonk`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `img_url` varchar(60) DEFAULT NULL,
  `love` int(11) DEFAULT NULL,
  `fid` varchar(70) NOT NULL,
  `mailid` varchar(100) NOT NULL,
  PRIMARY KEY (`img_id`),
  UNIQUE KEY `img_url` (`img_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`img_id`, `img_url`, `love`, `fid`, `mailid`) VALUES
(1, 'gallery/manabmemek-1409424697.png', 1, '', ''),
(2, 'gallery/manabmemek-1409440133.png', 0, '', ''),
(3, 'gallery/manabmemek-1409473416.png', 0, '', ''),
(4, 'gallery/manabmemek-1409495584.png', 0, '', ''),
(18, 'gallery/manabmemek-1409596115.png', 0, '', ''),
(25, 'gallery/manabmemek-1409598228.png', 0, '', ''),
(26, 'gallery/manabmemek-1409598438.png', 0, '', ''),
(28, 'gallery/manabmemek-1409600931.png', 0, '', ''),
(33, 'gallery/manabmemek-1409601919.png', 0, '', ''),
(37, 'gallery/manabmemek-1409679912.png', 0, '', ''),
(38, 'gallery/manabmemek-1409680645.png', 1, '', ''),
(40, 'gallery/manabmemek-1409681136.png', 0, '', ''),
(41, 'gallery/manabmemek-1409684766.png', 0, '', ''),
(43, 'gallery/manabmemek-1409685949.png', 0, '10201524168021201', 'manab_27@yahoo.com'),
(53, 'gallery/manabmemek-1409856909.png', 0, '10201524168021201', 'manab_27@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `image_ip`
--

CREATE TABLE IF NOT EXISTS `image_ip` (
  `ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `img_id_fk` int(11) DEFAULT NULL,
  `ip_add` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`ip_id`),
  KEY `img_id_fk` (`img_id_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `image_ip`
--

INSERT INTO `image_ip` (`ip_id`, `img_id_fk`, `ip_add`) VALUES
(4, 1, '127.0.0.1'),
(5, 38, '127.0.0.1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image_ip`
--
ALTER TABLE `image_ip`
  ADD CONSTRAINT `image_ip_ibfk_1` FOREIGN KEY (`img_id_fk`) REFERENCES `images` (`img_id`);
