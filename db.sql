SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE `ni218283_1sql6` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ni218283_1sql6`;

CREATE TABLE `users` (
  `id` int(45) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(60000) NOT NULL,
  `email` varchar(45) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isbanned` int(1) NOT NULL DEFAULT '0',
  `oldusrname` varchar(20) DEFAULT NULL,
  `sig_bg` int(1) NOT NULL DEFAULT '1',
  `sig_font` int(1) NOT NULL DEFAULT '1',
  `usrname_color` varchar(6) NOT NULL DEFAULT 'ffffff',
  `bg_color` varchar(10) NOT NULL DEFAULT 'orange',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1580 ;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `ip`, `regdate`, `isbanned`, `oldusrname`, `sig_bg`, `sig_font`, `usrname_color`, `bg_color`) VALUES
(1, 'admin', '89aa27ef628f1a4228a80e291ebb983a6d5c250251064237de45183cf4073bda', 'admin@site.com', '62.235.240.82', '2015-01-01 00:00:00', 0, '', 1, 2, 'ffffff', 'orange');

CREATE TABLE `wow` (
  `wow_id` int(45) NOT NULL AUTO_INCREMENT,
  `wow_to` int(45) NOT NULL,
  `wow_from` varchar(45) NOT NULL,
  `wow_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `wow_ref` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`wow_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65325 ;

INSERT INTO `wow` (`wow_id`, `wow_to`, `wow_from`, `wow_date`, `wow_ref`) VALUES
(1, 1, '62.235.240.82', '2015-01-01 00:00:00', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
