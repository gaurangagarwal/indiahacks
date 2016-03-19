-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2016 at 05:33 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `indiahacks`
--

-- --------------------------------------------------------

--
-- Table structure for table `appdata`
--

CREATE TABLE IF NOT EXISTS `appdata` (
`appID` int(10) NOT NULL,
  `PlaceKey` varchar(30) NOT NULL,
  `appName` varchar(50) NOT NULL,
  `appLink` varchar(1000) NOT NULL,
  `appDesc` varchar(1000) NOT NULL,
  `comm` varchar(200) NOT NULL,
  `likes` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `appdata`
--

INSERT INTO `appdata` (`appID`, `PlaceKey`, `appName`, `appLink`, `appDesc`, `comm`, `likes`) VALUES
(1, 'ChIJHd27EkTtDzkRpTq5mNfGk2M', 'A landscape lover''s blog', 'https://landscapelover.wordpress.com/2013/02/23/the-rock-garden-chandigarh/', 'This entry was posted on February 23, 2013 by landscapelover in Gardens, India and tagged Chandigarh, Le Corbusier, Nek Chand, Rock Garden.', 'Gaurang31 Jan,16', 1),
(10, 'ChIJ-w3Sy1qwbTkRK34UR2ffIWI', 'Amber Fort Jaipur Travel Guide', 'https://play.google.com/store/apps/details?id=com.wi.guiddoo.amberfort&hl=en', 'Amber Fort Jaipur Travel Guide for Jaipur India attractions, places to visit, Jaipur Maps, restaurants in Jaipur which doubles as a Jaipur offline travel guide.', 'Amit Agarwal19 Mar,16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dodata`
--

CREATE TABLE IF NOT EXISTS `dodata` (
`doID` int(255) NOT NULL,
  `PlaceKey` int(255) NOT NULL,
  `do` varchar(1000) NOT NULL,
  `head` varchar(100) NOT NULL,
  `comm` varchar(50) NOT NULL,
  `likes` int(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `dodata`
--

INSERT INTO `dodata` (`doID`, `PlaceKey`, `do`, `head`, `comm`, `likes`) VALUES
(1, 1, 'Do visit jakhu temple and chruch at the end of mall road. ', 'VisitJakhu temple and church', 'Gaurang31 Jan,16', 1),
(3, 1, 'If you are from middle class family shopping at mall road can be expensive so shop at lakad market which has cheap and fixed rates and very nice products', 'Lakad market is cheap', 'Gaurang02 Feb,16', 0),
(4, 29, 'IF AND ONLY IF you have around 2 hrs to visit this place hire a guide , and he will explain you very well about this place. ', 'May hire Guide', 'Abhi31 Jan,16', 5),
(5, 29, 'For bollywood movie fans only.There are many hindi movies shot in amber fort e.g. Jodhaa Akbar , Khoobsurat, Baajirao Mastani , etc. Try previewing these movies before visit, to enhance the beauty of this place. ', 'Preview some movies', 'Rohan More31 Jan,16', 0),
(8, 2, 'If you visited Rock garden long time back please visit again because new exibits have been added to it after Nek Chand''s Death(Creator of Rock Garden). It has been cleaned a lot because of the visit of French President.', 'Visit it again', 'Subhashish01 Feb,16', 9),
(9, 29, 'If you are a student carry your student ID card while visiting places in Jaipur, their are special discounts for students. For e.g. a combined ticket for all places in jaipur costs 400 for adult where as only 75 for a student.', 'Carry Student ID', 'Gaurang Agarwal02 Feb,16', 0),
(10, 2, 'Try wear shoes when you visit this place because there are some rough places in Rock garden. ', 'Wear shoes', 'Gaurang31 Jan,16', 7),
(11, 36, 'The market near the dargah is very cheap and if you have time do visit market outside the dargarh. Also their is adhai din jhonpra (walking distance from there) , you may visit that too and where you can find some goats :P.', 'Market is cheap here', 'Rohan More 02 Feb,16', 0),
(16, 37, 'Wide range of Posters of Animes and TV shows are available. Try out the very famous milk shakes of Keventer''s', 'Posters of Tv/ animes are available', 'Jasdeep Singh03 Feb,16', 0),
(17, 35, 'Good for having an evening or morning walk. Must try boating to enjoy the most', 'Morning/Evening walks', 'Abhi03 Feb,16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dontdata`
--

CREATE TABLE IF NOT EXISTS `dontdata` (
`dontID` int(255) NOT NULL,
  `PlaceKey` int(10) NOT NULL,
  `dont` varchar(1000) NOT NULL,
  `head` varchar(100) NOT NULL,
  `comm` varchar(50) NOT NULL,
  `likes` int(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `dontdata`
--

INSERT INTO `dontdata` (`dontID`, `PlaceKey`, `dont`, `head`, `comm`, `likes`) VALUES
(1, 1, 'Some restaurants are too expensive on mall road, so think before you go in. Indian Coffee house is cheap and nice. Try visiting it if you have limited budget.', 'Mall road is Expensive', 'Abhi02 Feb,16', 7),
(2, 2, 'Do not visit Rock garden on hot or rainy day. Try visiting in the evening', 'Do not visit on Hot/rainy day', 'Abhi02 Feb,16', 7),
(5, 36, 'Do not carry valuables items inside the dargah, there have been many cases of pick pocketing there. Leave it behind at your hotel.  ', 'Do not carry valuables', 'Subhashish02 Feb,16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE IF NOT EXISTS `places` (
`ID` int(255) NOT NULL,
  `PlaceID` varchar(50) NOT NULL,
  `PlaceName` varchar(100) NOT NULL,
  `PlaceState` varchar(50) NOT NULL,
  `PlaceCountry` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`ID`, `PlaceID`, `PlaceName`, `PlaceState`, `PlaceCountry`) VALUES
(1, 'ChIJG1usnet4BTkRzQqb_Ys-JOg', 'Mall Road, Bemloi, Shimla, Himachal Pradesh, India', 'Shimla', 'India'),
(2, 'ChIJHd27EkTtDzkRpTq5mNfGk2M', 'Rock Garden, Chandigarh, India', 'Chandigarh', 'India'),
(23, 'ChIJC03rqdriDDkRXT6SJRGXFwc', 'India Gate, Rajpath, New Delhi, Delhi, India', 'New Delhi', 'India'),
(25, 'ChIJm5MaboqXyzsR-xPxquRpWss', 'Charminar, Hyderabad, Telangana, India', 'Hyderabad', 'India'),
(26, 'ChIJFx7ncR7O5zsRL8_3z75HHcI', 'Marine Drive, Marine Drive Jogging Track, Chowpatty, Mumbai, Maharashtra, India', 'Mumbai', 'India'),
(27, 'ChIJ8xjv0nvO5zsRVc_QGUqcfOg', 'Haji Ali, Mumbai, Maharashtra, India', 'Mumbai', 'India'),
(28, 'ChIJrVwNOsfR5zsRPHOcIKclCsc', 'Gateway Of India Mumbai, Mumbai, Maharashtra, India', 'Mumbai', 'India'),
(29, 'ChIJ-w3Sy1qwbTkRK34UR2ffIWI', 'Amber Fort, Amer, Jaipur, Rajasthan, India', 'Jaipur', 'India'),
(31, 'ChIJbf8C1yFxdDkR3n12P4DkKt0', 'Taj Mahal, Agra, Uttar Pradesh, India', 'Agra', 'India'),
(35, 'ChIJR5GNEzTtDzkRotUQxLcNeoo', 'Sukhna Lake, Sector 1, Chandigarh, India', 'Chandigarh', 'India'),
(36, 'ChIJAQAAAKu2bTkRRMCr-La6Nq8', 'Ajmer Sharif Dargah, Ajmer, Rajasthan, India', 'Ajmer', 'India'),
(37, 'ChIJV9BBtzf9DDkR8cOTc-SI7s0', 'Connaught Place, New Delhi, Delhi, India', 'New Delhi', 'India'),
(39, 'ChIJk-MbltviDDkRrhDd5l7vx_Y', 'India Gate, New Delhi, Delhi, India', 'New Delhi', 'India'),
(40, 'ChIJY8UqQBBwrzsRUA60iKH1ciU', 'Mysore Palace, Agrahara, Chamrajpura, Mysuru, Karnataka, India', '', ''),
(41, 'ChIJ-aH5AxFwrzsRDdokoeK6f8M', 'Mysore Palace, Sayyaji Rao Road, Mysuru, Karnataka, India', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `userdet`
--

CREATE TABLE IF NOT EXISTS `userdet` (
`ID` int(255) NOT NULL,
  `Name` varchar(1000) NOT NULL,
  `Password` varchar(1000) NOT NULL,
  `Email` varchar(1000) NOT NULL,
  `Age` int(100) NOT NULL,
  `State` varchar(100) NOT NULL,
  `Country` varchar(1000) NOT NULL,
  `ReqLocation1` varchar(1000) NOT NULL,
  `ReqLocation2` varchar(1000) NOT NULL,
  `ReqLocation3` varchar(1000) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `userdet`
--

INSERT INTO `userdet` (`ID`, `Name`, `Password`, `Email`, `Age`, `State`, `Country`, `ReqLocation1`, `ReqLocation2`, `ReqLocation3`) VALUES
(28, 'Gaurang Agarwal', '$2y$10$E70aPQ7g3l6jtrID/Afz8eR5q0a1/AhpmQrTWXzGncNZ2./2eDDd6', 'gaurang@gmail.com', 19, 'Chandigarh', 'India', 'Rock Garden, Chandigarh, India', '', ''),
(30, 'Abhi', '$2y$10$LctuPuteqs1xDzA63nh72Ot3gwdr9LsottKIc.6OJVszEUeEqjEZS', 'abhi@gmail.com', 19, 'New Delhi', 'India', 'India Gate, Rajpath, New Delhi, Delhi, India', '', ''),
(31, 'Rohan More ', '$2y$10$flazZGTWhUtkUfI5TjaXXO.seaK4aQMJrNnncwvloWj4uITBpkoHi', 'r@gmail.com', 20, 'Mumbai', 'India', '', '', ''),
(32, 'Yash Ubale', '$2y$10$uvMVMre55NHn7mIwwGsrTOfoJr3dqF0G5z43RkTesbb5K5cUfqmtC', 'y@g.com', 19, 'Hyderabad', 'India', '', '', ''),
(33, 'Shobhit Kumar', '$2y$10$MhFmw7HPtDf1XnWjTCNUUeJk.3NsiXVl9wu9EbrQexNimJ9ebqEDu', 'shobhit@gmail.com', 22, 'Naya Nangal', 'India', '', '', ''),
(34, 'Subhashish', '$2y$10$4M5L09UTeb66UrKkBb.FYuNHakX5h12d6ykscyJOhAJQUpR50UlzG', 'subh@g.com', 25, 'New Delhi', 'India', '', '', ''),
(35, 'Jasdeep Singh', '$2y$10$76UzTC1fX937ric4cDl2AeBchVyQ/6XrG//tf8.uyahzW1NiS6JCi', 'j@g.com', 20, 'Rupnagar', 'India', '', '', ''),
(36, 'Shobhit Kumar', '$2y$10$iRA0H5i.AiYZ/FLQTylAaelaYn0LL7KMK89c66Of/elRbX4D0.gkO', 'skrnation@gmail.com', 48, 'Chandigarh', 'India', 'Rock Garden, Chandigarh, India', '', ''),
(37, 'Kevin ', '$2y$10$kg1WOrg4.2uf0bjThsVqMO/hUQOobVO/j6M7jDev1.eLlTbRXmHRS', 'kevin_v@gmail.com', 50, 'Puducherry', 'India', '', '', ''),
(38, 'Shobhit Kumar', '$2y$10$EyLbuuHbkplycutUPY8/u.K1RBwaOzGVBpNTJTL0FSzyFg57kjuPO', 'hishobhit@gmail.com', 78, 'Chandigarh', 'India', 'Rock Garden, Chandigarh, India', '', ''),
(39, 'Avinash', '$2y$10$5iTryJXN6vkZ2oeNo2to3u8GjOTi2ighEAlnEPoJajmtTpXdZSX9y', 'avi@gmail.com', 19, 'Jaipur', 'India', 'Amer Fort, Amer, Jaipur, Rajasthan, India', '', ''),
(40, 'Amit Agarwal', '$2y$10$TNJm1bS.2NS3dGCsayN/wuDGYbpJhn0x8p14m4sWXbJ1e5A0pV8uG', 'amit@gmail.com', 30, 'Bengaluru', 'India', '', '', ''),
(44, 'Sakshum Sharma', '$2y$10$74QS6L3YtHZQf7KBdtSne.XIDm0gWZ44CYrr/FXlaZWFpzzmMI9fe', 'sakshum@gmail.com', 20, 'Jaipur', 'India', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appdata`
--
ALTER TABLE `appdata`
 ADD PRIMARY KEY (`appID`);

--
-- Indexes for table `dodata`
--
ALTER TABLE `dodata`
 ADD PRIMARY KEY (`doID`), ADD KEY `PlaceKey` (`PlaceKey`);

--
-- Indexes for table `dontdata`
--
ALTER TABLE `dontdata`
 ADD PRIMARY KEY (`dontID`), ADD KEY `PlaceKey` (`PlaceKey`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userdet`
--
ALTER TABLE `userdet`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appdata`
--
ALTER TABLE `appdata`
MODIFY `appID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `dodata`
--
ALTER TABLE `dodata`
MODIFY `doID` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `dontdata`
--
ALTER TABLE `dontdata`
MODIFY `dontID` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `userdet`
--
ALTER TABLE `userdet`
MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dodata`
--
ALTER TABLE `dodata`
ADD CONSTRAINT `Place keys` FOREIGN KEY (`PlaceKey`) REFERENCES `places` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dontdata`
--
ALTER TABLE `dontdata`
ADD CONSTRAINT `PlacesKeys` FOREIGN KEY (`PlaceKey`) REFERENCES `places` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
