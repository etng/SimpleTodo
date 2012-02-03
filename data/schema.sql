# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.5.18-log
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2012-02-03 16:35:36
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping database structure for test
DROP DATABASE IF EXISTS `test`;
CREATE DATABASE IF NOT EXISTS `test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `test`;


# Dumping structure for table test.article
DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table test.contact
DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table test.plan
DROP TABLE IF EXISTS `plan`;
CREATE TABLE IF NOT EXISTS `plan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `car_request` text NOT NULL,
  `room_request` text NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `contact_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tourist_cnt` int(10) unsigned NOT NULL DEFAULT '1',
  `start_date` date NOT NULL,
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `paid` int(10) unsigned NOT NULL DEFAULT '0',
  `balance` int(10) NOT NULL DEFAULT '-1',
  `created` datetime NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table test.plan_history
DROP TABLE IF EXISTS `plan_history`;
CREATE TABLE IF NOT EXISTS `plan_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) unsigned NOT NULL DEFAULT '0',
  `operator` varchar(50) NOT NULL,
  `operation` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plan_id_created` (`plan_id`,`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table test.plan_invoice
DROP TABLE IF EXISTS `plan_invoice`;
CREATE TABLE IF NOT EXISTS `plan_invoice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `detail` varchar(50) NOT NULL,
  `memo` varchar(50) NOT NULL,
  `post_code` varchar(50) NOT NULL,
  `post_address` varchar(50) NOT NULL,
  `post_receiver` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table test.plan_payment
DROP TABLE IF EXISTS `plan_payment`;
CREATE TABLE IF NOT EXISTS `plan_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) NOT NULL,
  `via` varchar(50) NOT NULL,
  `amount` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `memo` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table test.plan_tour
DROP TABLE IF EXISTS `plan_tour`;
CREATE TABLE IF NOT EXISTS `plan_tour` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) unsigned NOT NULL,
  `tour_id` int(10) unsigned NOT NULL,
  `the_date` date NOT NULL,
  `car_cnt` int(10) unsigned NOT NULL DEFAULT '0',
  `room_cnt` int(10) unsigned NOT NULL DEFAULT '0',
  `tourist_cnt` int(10) unsigned NOT NULL DEFAULT '1',
  `market_price_sum` int(10) unsigned NOT NULL,
  `price_sum` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table test.plan_tour_tourist
DROP TABLE IF EXISTS `plan_tour_tourist`;
CREATE TABLE IF NOT EXISTS `plan_tour_tourist` (
  `plan_tour_id` int(10) unsigned NOT NULL,
  `tourist_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`plan_tour_id`,`tourist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table test.staff
DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table test.todo
DROP TABLE IF EXISTS `todo`;
CREATE TABLE IF NOT EXISTS `todo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单',
  `title` varchar(255) NOT NULL COMMENT '主题',
  `description` varchar(512) NOT NULL COMMENT '介绍',
  `start_date` datetime NOT NULL COMMENT '开始日期',
  `end_date` datetime NOT NULL COMMENT '结束日期',
  `url` varchar(255) NOT NULL COMMENT '查看地址',
  `background_color` varchar(10) NOT NULL COMMENT '背景色',
  `text_color` varchar(10) NOT NULL COMMENT '前景色',
  `border_color` varchar(10) NOT NULL COMMENT '边框色',
  `confirmed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否确认',
  `all_day` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否确认',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='待办事项';

# Data exporting was unselected.


# Dumping structure for table test.tour
DROP TABLE IF EXISTS `tour`;
CREATE TABLE IF NOT EXISTS `tour` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `market_price` int(10) unsigned NOT NULL DEFAULT '0',
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table test.tourist
DROP TABLE IF EXISTS `tourist`;
CREATE TABLE IF NOT EXISTS `tourist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
