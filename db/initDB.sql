-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 01, 2021 at 11:49 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
CREATE TABLE IF NOT EXISTS `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `score` int(11) NOT NULL,
  `cle` int(11) NOT NULL,
  `be` int(11) NOT NULL,
  `shown_images` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_98197A65E7927C74` (`email`),
  KEY `IDX_98197A65E5546315` (`idQuestion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`id`, `name`, `username`, `email`, `password`, `score`, `cle`, `be`, `shown_images`, `idQuestion`) VALUES
(1, 'Houssem', 'Houssem', 'Houssem@gmail.com', '$2y$13$3hvuyh1PrWEW9ELyJZyHM.lLAh2DFPYwpcZX31kCX.ZceVUXw8ONS', 50, 1, 1500, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank` int(11) NOT NULL,
  `response` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reward` int(11) NOT NULL,
  `image1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hint` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B6F7494E8879E8E5` (`rank`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `rank`, `response`, `reward`, `image1`, `image2`, `image3`, `image4`, `hint`) VALUES
(1, 1, 'kennen', 50, 'img/q1/1.JPG', 'img/q1/2.JPG', 'img/q1/3.JPG', 'img/q1/4.JPG', 'TOP/MID'),
(2, 2, 'kennen', 50, 'img/q2/1.JPG', 'img/q2/2.JPG', 'img/q2/3.JPG', 'img/q2/4.JPG', 'TOP/MID'),
(3, 3, 'kennen', 50, 'img/q3/1.JPG', 'img/q3/2.JPG', 'img/q3/3.JPG', 'img/q3/4.JPG', 'TOP/MID'),
(4, 4, 'kennen', 50, 'img/q4/1.JPG', 'img/q4/2.JPG', 'img/q4/3.JPG', 'img/q4/4.JPG', 'TOP/MID'),
(5, 5, 'kennen', 50, 'img/q5/1.JPG', 'img/q5/2.JPG', 'img/q5/3.JPG', 'img/q5/4.JPG', 'TOP/MID'),
(6, 6, 'kennen', 50, 'img/q6/1.JPG', 'img/q6/2.JPG', 'img/q6/3.JPG', 'img/q6/4.JPG', 'TOP/MID'),
(7, 7, 'kennen', 50, 'img/q7/1.JPG', 'img/q7/2.JPG', 'img/q7/3.JPG', 'img/q7/4.JPG', 'TOP/MID'),
(8, 8, 'kennen', 50, 'img/q8/1.JPG', 'img/q8/2.JPG', 'img/q8/3.JPG', 'img/q8/4.JPG', 'TOP/MID'),
(9, 9, 'kennen', 50, 'img/q9/1.JPG', 'img/q9/2.JPG', 'img/q9/3.JPG', 'img/q9/4.JPG', 'TOP/MID'),
(10, 10, 'kennen', 50, 'img/q10/1.JPG', 'img/q10/2.JPG', 'img/q10/3.JPG', 'img/q10/4.JPG', 'TOP/MID'),
(11, 11, 'kennen', 50, 'img/q11/1.JPG', 'img/q11/2.JPG', 'img/q11/3.JPG', 'img/q11/4.JPG', 'TOP/MID'),
(12, 12, 'kennen', 50, 'img/q12/1.JPG', 'img/q12/2.JPG', 'img/q12/3.JPG', 'img/q12/4.JPG', 'TOP/MID'),
(13, 13, 'kennen', 50, 'img/q13/1.JPG', 'img/q13/2.JPG', 'img/q13/3.JPG', 'img/q13/4.JPG', 'TOP/MID'),
(14, 14, 'kennen', 50, 'img/q14/1.JPG', 'img/q14/2.JPG', 'img/q14/3.JPG', 'img/q14/4.JPG', 'TOP/MID'),
(15, 15, 'kennen', 50, 'img/q15/1.JPG', 'img/q15/2.JPG', 'img/q15/3.JPG', 'img/q15/4.JPG', 'TOP/MID'),
(16, 16, 'kennen', 50, 'img/q16/1.JPG', 'img/q16/2.JPG', 'img/q16/3.JPG', 'img/q16/4.JPG', 'TOP/MID'),
(17, 17, 'kennen', 50, 'img/q17/1.JPG', 'img/q17/2.JPG', 'img/q17/3.JPG', 'img/q17/4.JPG', 'TOP/MID'),
(18, 18, 'kennen', 50, 'img/q18/1.JPG', 'img/q18/2.JPG', 'img/q18/3.JPG', 'img/q18/4.JPG', 'TOP/MID'),
(19, 19, 'kennen', 50, 'img/q19/1.JPG', 'img/q19/2.JPG', 'img/q19/3.JPG', 'img/q19/4.JPG', 'TOP/MID'),
(20, 20, 'kennen', 50, 'img/q20/1.JPG', 'img/q20/2.JPG', 'img/q20/3.JPG', 'img/q20/4.JPG', 'TOP/MID');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `FK_98197A65E5546315` FOREIGN KEY (`idQuestion`) REFERENCES `question` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
