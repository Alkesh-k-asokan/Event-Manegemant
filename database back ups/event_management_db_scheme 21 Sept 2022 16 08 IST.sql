-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for event_management
CREATE DATABASE IF NOT EXISTS `event_management` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `event_management`;

-- Dumping structure for table event_management.company
CREATE TABLE IF NOT EXISTS `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `head_office` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table event_management.company: ~1 rows (approximately)
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` (`company_id`, `company_name`, `description`, `head_office`, `created_on`, `updated_on`) VALUES
	(1, 'Startagile', 'StratAgile is a data-driven growth enabler with a global reach in digital marketing, digital platforms and digital enhancement solutions for business.', 'SINGAPORE', '2022-09-15 11:49:50', '2022-09-15 12:00:37');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;

-- Dumping structure for table event_management.employee
CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(50) NOT NULL,
  `employee_email_id` varchar(50) NOT NULL,
  `employee_address` longtext NOT NULL,
  `employee_phone` varchar(15) NOT NULL,
  `employee_sec_phone` varchar(50) NOT NULL,
  `employee_designation` varchar(50) NOT NULL,
  `employee_blood_group` varchar(5) NOT NULL,
  `employee_company_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`employee_id`),
  UNIQUE KEY `employee_email_id` (`employee_email_id`),
  UNIQUE KEY `employee_phone` (`employee_phone`),
  KEY `company_id` (`employee_company_id`),
  CONSTRAINT `company_id` FOREIGN KEY (`employee_company_id`) REFERENCES `company` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- Dumping data for table event_management.employee: ~12 rows (approximately)
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` (`employee_id`, `employee_name`, `employee_email_id`, `employee_address`, `employee_phone`, `employee_sec_phone`, `employee_designation`, `employee_blood_group`, `employee_company_id`, `created_on`, `updated_on`) VALUES
	(1, 'Alkesh', 'a@gmial.com', 'Address', '+91 9846823801', '', 'Developer', 'AB+', 1, '2022-09-15 11:50:57', '2022-09-16 18:20:13'),
	(2, 'Balu', 'ab@gmial.com', 'Address', '+91 9846823802', '', 'Developer', 'AB+', 1, '2022-09-15 11:52:04', '2022-09-16 18:20:18'),
	(3, 'Prajeesh', 'ac@gmial.com', 'Address', '+91 9846823803', '', 'Developer', 'A+', 1, '2022-09-15 11:52:43', '2022-09-16 18:20:21'),
	(4, 'Navami', 'as@gmial.com', 'Address', '+91 9846823804', '', 'Testing', 'B+', 1, '2022-09-15 11:54:29', '2022-09-16 18:20:25'),
	(5, 'Sanjay', 'aw@gmial.com', 'Address', '+91 9846823805', '', 'UI Designer', 'A+', 1, '2022-09-15 11:55:16', '2022-09-16 18:20:28'),
	(6, 'Anuraj', 'aa@gmial.com', 'Address', '+91 9846823806', '', 'UI Designer', 'B+', 1, '2022-09-15 11:55:56', '2022-09-16 18:20:33'),
	(7, 'Arundas', 'ag@gmial.com', 'Address', '+91 9846823807', '', 'UI Designer', 'O+', 1, '2022-09-15 11:56:52', '2022-09-16 18:20:36'),
	(8, 'Nibi', 'at@gmial.com', 'Address', '+91 9846823808', '', 'Testing', 'A+', 1, '2022-09-15 11:57:40', '2022-09-16 18:20:39'),
	(9, 'Safther', 'ah@gmial.com', 'Address', '+91 9846823809', '', 'Developer', 'AB+', 1, '2022-09-15 11:58:26', '2022-09-16 18:20:44'),
	(10, 'Praveen', 'aq@gmial.com', 'Address', '+91 9846823810', '', 'Developer', 'B+', 1, '2022-09-15 11:58:58', '2022-09-16 18:20:47'),
	(30, 'alkesh', 'magento2@gmail.com', 'Kambalahboa', '+91 9846823800', '9747931800', 'Dev', 'AB+', 1, '2022-09-21 10:25:10', '2022-09-21 10:25:10'),
	(32, '', '', '', '', '', '', '', 1, '2022-09-21 14:09:05', '2022-09-21 14:09:05');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;

-- Dumping structure for table event_management.event
CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_type_id` int(11) NOT NULL,
  `event_name` varchar(50) NOT NULL DEFAULT '',
  `event_description` longtext NOT NULL,
  `event_points` float NOT NULL,
  `event_date` date NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`event_id`),
  KEY `event_type_id` (`event_type_id`),
  CONSTRAINT `event_type_id` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`event_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table event_management.event: ~2 rows (approximately)
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` (`event_id`, `event_type_id`, `event_name`, `event_description`, `event_points`, `event_date`, `created_on`, `updated_on`) VALUES
	(1, 1, 'Group Song', 'Lorem Ipsum', 0, '2022-10-15', '2022-09-15 12:06:59', '2022-09-15 12:50:16'),
	(2, 2, 'Lemon Race', 'Lorem Ipsum', 0, '2022-12-20', '2022-09-15 12:07:39', '2022-09-15 12:50:03');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;

-- Dumping structure for table event_management.event_participation
CREATE TABLE IF NOT EXISTS `event_participation` (
  `participation_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `points_earned` float NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`participation_id`),
  KEY `event_id` (`event_id`),
  KEY `employee_ids` (`employee_id`),
  CONSTRAINT `employee_ids` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  CONSTRAINT `event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table event_management.event_participation: ~2 rows (approximately)
/*!40000 ALTER TABLE `event_participation` DISABLE KEYS */;
INSERT INTO `event_participation` (`participation_id`, `event_id`, `employee_id`, `points_earned`, `start_date`, `end_date`, `created_on`, `updated_on`) VALUES
	(1, 1, 1, 50, '2022-09-15', '2022-09-18', '2022-09-15 12:08:43', '2022-09-15 12:08:43'),
	(2, 1, 3, 50, '2022-09-15', '2022-09-20', '2022-09-15 12:10:16', '2022-09-15 12:10:16');
/*!40000 ALTER TABLE `event_participation` ENABLE KEYS */;

-- Dumping structure for table event_management.event_type
CREATE TABLE IF NOT EXISTS `event_type` (
  `event_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_type_name` varchar(50) NOT NULL DEFAULT '',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`event_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table event_management.event_type: ~3 rows (approximately)
/*!40000 ALTER TABLE `event_type` DISABLE KEYS */;
INSERT INTO `event_type` (`event_type_id`, `event_type_name`, `created_on`, `updated_on`) VALUES
	(1, 'Onam', '2022-09-15 12:01:03', '2022-09-15 12:01:03'),
	(2, 'Xmas', '2022-09-15 12:01:10', '2022-09-15 12:01:10'),
	(3, 'Vishu', '2022-09-15 12:01:20', '2022-09-15 12:01:20');
/*!40000 ALTER TABLE `event_type` ENABLE KEYS */;

-- Dumping structure for table event_management.event_users
CREATE TABLE IF NOT EXISTS `event_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table event_management.event_users: ~1 rows (approximately)
/*!40000 ALTER TABLE `event_users` DISABLE KEYS */;
INSERT INTO `event_users` (`user_id`, `user_name`, `user_password`) VALUES
	(1, 'magento2@gmail.com', 'password');
/*!40000 ALTER TABLE `event_users` ENABLE KEYS */;

-- Dumping structure for table event_management.team
CREATE TABLE IF NOT EXISTS `team` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(50) NOT NULL,
  `team_description` longtext NOT NULL,
  `team_total_points` double NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table event_management.team: ~2 rows (approximately)
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` (`team_id`, `team_name`, `team_description`, `team_total_points`, `created_on`, `updated_on`) VALUES
	(1, 'Team 1', 'Description', 0, '2022-09-15 12:02:54', '2022-09-15 12:02:54'),
	(2, 'Team 2 ', 'Description', 0, '2022-09-15 12:03:09', '2022-09-15 12:03:09');
/*!40000 ALTER TABLE `team` ENABLE KEYS */;

-- Dumping structure for table event_management.team_members
CREATE TABLE IF NOT EXISTS `team_members` (
  `team_member_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`team_member_id`),
  KEY `team_id` (`team_id`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  CONSTRAINT `team_id` FOREIGN KEY (`team_id`) REFERENCES `team` (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table event_management.team_members: ~10 rows (approximately)
/*!40000 ALTER TABLE `team_members` DISABLE KEYS */;
INSERT INTO `team_members` (`team_member_id`, `team_id`, `employee_id`, `created_on`, `updated_on`) VALUES
	(1, 1, 1, '2022-09-15 12:10:48', '2022-09-15 12:10:48'),
	(2, 1, 3, '2022-09-15 12:11:01', '2022-09-15 12:11:01'),
	(3, 1, 5, '2022-09-15 12:11:13', '2022-09-15 12:11:13'),
	(4, 1, 7, '2022-09-15 12:11:26', '2022-09-15 12:11:26'),
	(5, 1, 9, '2022-09-15 12:11:42', '2022-09-15 12:11:42'),
	(6, 2, 2, '2022-09-15 12:12:02', '2022-09-15 12:12:02'),
	(7, 2, 4, '2022-09-15 12:12:12', '2022-09-15 12:12:12'),
	(8, 2, 6, '2022-09-15 12:12:26', '2022-09-15 12:12:26'),
	(9, 2, 8, '2022-09-15 12:12:38', '2022-09-15 12:12:38'),
	(10, 2, 10, '2022-09-15 12:12:54', '2022-09-15 12:12:54');
/*!40000 ALTER TABLE `team_members` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
