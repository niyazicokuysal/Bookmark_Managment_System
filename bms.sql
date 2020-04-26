-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 24, 2020 at 09:10 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bms`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

DROP TABLE IF EXISTS `bookmark`;
CREATE TABLE IF NOT EXISTS `bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8mb4_turkish_ci NOT NULL,
  `url` varchar(512) COLLATE utf8mb4_turkish_ci NOT NULL,
  `note` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `owner` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`id`, `title`, `url`, `note`, `owner`, `created`) VALUES
(28, 'Free 3D Models', 'https://www.cgtrader.com/free-3d-models', 'This site contains thousands of free 3D objects in Wavefront obj, Autodesk fbx, 3D Studio Max, and Blender formats. Highly recommended.', 60, '2020-04-24 19:50:40'),
(29, 'Yamaha Recent Motorbike Prices', 'https://www.yamaha-motor.eu/tr/tr/Deneyim/Fiyat-Listesi/', 'Updated prices in Turkey. ', 62, '2020-04-24 19:52:08'),
(30, 'PHP Reference Page', 'http://www.php.net', 'This site is the main page for php functions.\r\nHighly recommended.', 62, '2020-04-24 20:20:07'),
(31, 'Cooking Recipes', 'https://www.allrecipes.com/recipes/1642/everyday-cooking/', 'You can find tons of interesting recipes. ', 61, '2020-04-24 21:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8mb4_turkish_ci NOT NULL,
  `email` varchar(256) COLLATE utf8mb4_turkish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `bday` date NOT NULL,
  `profile` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `bday`, `profile`) VALUES
(59, 'Burcu Doğulugil', 'burcu.dogulu@gmail.com', '12345', '1988-12-10', 'f7aeef014fcab70b7d2ce99c8081d6d33c14e680_profile1.jpg'),
(60, 'Mustafa Kemal Durmaz', 'mkdurmaz@bilkent.edu.tr', '23041920', '1975-09-01', '97c5d51f36a8ee0cd100db1381b2e2a43b2b662d_profile2.jpg'),
(61, 'Ali Gül', 'ali.gul@hotmail.com', 'asdfasdf', '1977-03-22', '34ddb55f01d520a9abe20548d4fa3cc67f20ff47_profile3.jpg'),
(62, 'Özge Can Öztürk', 'ozgeozturk@metu.edu.tr', 'arwersdf', '1997-09-13', '932c81aea4d0b8c60989412acff319fb6f85c176_profile4.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD CONSTRAINT `bookmark_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
