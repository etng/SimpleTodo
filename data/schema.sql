-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.20-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-03-28 01:11:20
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table aiyouwei.article
DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.contact
DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `forum_uid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.destination
DROP TABLE IF EXISTS `destination`;
CREATE TABLE IF NOT EXISTS `destination` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `need_passport` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否需要边防证',
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.driver
DROP TABLE IF EXISTS `driver`;
CREATE TABLE IF NOT EXISTS `driver` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `destination_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(10) unsigned NOT NULL,
  `car_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `car_capacity` int(10) unsigned NOT NULL,
  `car_plate_num` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `star` tinyint(1) unsigned NOT NULL DEFAULT '3',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.hotel
DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `destination_id` int(10) unsigned NOT NULL,
  `name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `star` tinyint(3) unsigned NOT NULL DEFAULT '3',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.message
DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(10) DEFAULT NULL,
  `staff_id` int(10) DEFAULT NULL,
  `subject` int(10) DEFAULT NULL,
  `body` int(10) DEFAULT NULL,
  `created` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.plan
DROP TABLE IF EXISTS `plan`;
CREATE TABLE IF NOT EXISTS `plan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `forum_url` varchar(255) NOT NULL,
  `car_request` text NOT NULL,
  `room_request` text NOT NULL,
  `other_request` text NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `contact_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tourist_cnt` int(10) unsigned NOT NULL DEFAULT '1',
  `start_date` date NOT NULL,
  `need_seeoff` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `need_passport` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `need_insurance` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `need_hotel` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `need_car` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `seeoff_date` date NOT NULL,
  `seeoff_destination` varchar(50) NOT NULL,
  `seeoff_method` varchar(50) NOT NULL,
  `seeoff_detail` varchar(512) NOT NULL,
  `need_receive` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `arrive_date` date NOT NULL,
  `arrive_destination` varchar(50) NOT NULL,
  `arrive_method` varchar(50) NOT NULL,
  `arrive_detail` varchar(512) NOT NULL,
  `schedule_template_id` varchar(512) NOT NULL,
  `schedule_txt` varchar(512) NOT NULL,
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `paid` int(10) unsigned NOT NULL DEFAULT '0',
  `balance` int(10) NOT NULL DEFAULT '-1',
  `created` datetime NOT NULL,
  `status` varchar(30) NOT NULL,
  `car_status` varchar(30) NOT NULL,
  `schedule_status` varchar(30) NOT NULL,
  `room_status` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.plan_history
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

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.plan_invoice
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

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.plan_note
DROP TABLE IF EXISTS `plan_note`;
CREATE TABLE IF NOT EXISTS `plan_note` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) unsigned DEFAULT NULL,
  `staff_id` int(10) unsigned DEFAULT NULL,
  `content` varchar(512) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单备注';

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.plan_payment
DROP TABLE IF EXISTS `plan_payment`;
CREATE TABLE IF NOT EXISTS `plan_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) NOT NULL,
  `via` varchar(50) NOT NULL,
  `operator` varchar(50) NOT NULL,
  `amount` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `memo` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.plan_tour
DROP TABLE IF EXISTS `plan_tour`;
CREATE TABLE IF NOT EXISTS `plan_tour` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) unsigned NOT NULL,
  `tour_id` int(10) unsigned NOT NULL,
  `destination_id` int(10) unsigned NOT NULL,
  `destination` varchar(50) NOT NULL,
  `the_date` date NOT NULL,
  `car_tourist_cnt` int(10) unsigned NOT NULL DEFAULT '0',
  `room_tourist_cnt` int(10) unsigned NOT NULL DEFAULT '0',
  `tourist_cnt` int(10) unsigned NOT NULL DEFAULT '1',
  `market_price_sum` int(10) unsigned NOT NULL,
  `price_sum` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.plan_tourist
DROP TABLE IF EXISTS `plan_tourist`;
CREATE TABLE IF NOT EXISTS `plan_tourist` (
  `plan_id` int(10) unsigned NOT NULL,
  `tourist_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`plan_id`,`tourist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.plan_tour_car
DROP TABLE IF EXISTS `plan_tour_car`;
CREATE TABLE IF NOT EXISTS `plan_tour_car` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plan_tour_id` int(10) unsigned NOT NULL,
  `plan_id` int(10) unsigned NOT NULL,
  `type` varchar(50) NOT NULL,
  `driver_id` varchar(10) NOT NULL,
  `tourist_cnt` int(10) unsigned NOT NULL DEFAULT '1',
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `memo` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.plan_tour_room
DROP TABLE IF EXISTS `plan_tour_room`;
CREATE TABLE IF NOT EXISTS `plan_tour_room` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clone_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '相同内容',
  `plan_tour_id` int(10) unsigned NOT NULL,
  `type` varchar(50) NOT NULL,
  `room_cnt` int(10) unsigned NOT NULL DEFAULT '1',
  `hotel_id` int(10) unsigned NOT NULL,
  `tourist_cnt` int(10) unsigned NOT NULL DEFAULT '0',
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `memo` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.plan_tour_tourist
DROP TABLE IF EXISTS `plan_tour_tourist`;
CREATE TABLE IF NOT EXISTS `plan_tour_tourist` (
  `plan_tour_id` int(10) unsigned NOT NULL,
  `tourist_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`plan_tour_id`,`tourist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.room_daily_price
DROP TABLE IF EXISTS `room_daily_price`;
CREATE TABLE IF NOT EXISTS `room_daily_price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `the_date` date NOT NULL,
  `hotel_id` int(10) unsigned NOT NULL DEFAULT '0',
  `room_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cost` int(10) unsigned NOT NULL,
  `public_price` int(10) unsigned NOT NULL,
  `min_price` int(10) unsigned NOT NULL,
  `default_price` int(10) unsigned NOT NULL,
  `max_price` int(10) unsigned NOT NULL,
  `memo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.schedule_template
DROP TABLE IF EXISTS `schedule_template`;
CREATE TABLE IF NOT EXISTS `schedule_template` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `cate_id` int(10) unsigned NOT NULL COMMENT '分类',
  `need_passport` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '需要边防证',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `code` varchar(50) NOT NULL COMMENT '代号',
  `content` text NOT NULL COMMENT '内容',
  `memo` varchar(512) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='日程模版';

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.schedule_template_cate
DROP TABLE IF EXISTS `schedule_template_cate`;
CREATE TABLE IF NOT EXISTS `schedule_template_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `description` varchar(512) NOT NULL COMMENT '介绍',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='日程模版分类';

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.staff
DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属组',
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `memo` varchar(512) NOT NULL,
  `privileges` text NOT NULL,
  `preference` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.staff_group
DROP TABLE IF EXISTS `staff_group`;
CREATE TABLE IF NOT EXISTS `staff_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `memo` varchar(512) NOT NULL,
  `privileges` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.todo
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

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.tour
DROP TABLE IF EXISTS `tour`;
CREATE TABLE IF NOT EXISTS `tour` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `destination_id` int(10) unsigned NOT NULL DEFAULT '0',
  `destination` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `market_price` int(10) unsigned NOT NULL DEFAULT '0',
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `distance` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table aiyouwei.tourist
DROP TABLE IF EXISTS `tourist`;
CREATE TABLE IF NOT EXISTS `tourist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `card_type` varchar(50) NOT NULL,
  `card_number` varchar(50) NOT NULL,
  `card_photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
