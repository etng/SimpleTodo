-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.20-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-03-06 08:13:58
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.article: ~4 rows (approximately)
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`id`, `title`, `slug`, `content`, `hits`, `created`, `updated`) VALUES
	(1, 'About Us', 'about_us', 'please add it', 20079, '2012-02-20 21:01:43', '2012-02-20 21:01:43'),
	(2, 'Contact Us', 'contact_us', 'please add it', 17733, '2012-02-20 21:01:43', '2012-02-20 21:01:43'),
	(3, 'Hr', 'hr', 'please add it', 19849, '2012-02-20 21:01:43', '2012-02-20 21:01:43'),
	(4, 'Tos', 'tos', 'please add it', 13340, '2012-02-20 21:01:43', '2012-02-20 21:01:43');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;


-- Dumping structure for table aiyouwei.contact
DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `froum_uid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.contact: ~4 rows (approximately)
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` (`id`, `name`, `phone`, `fax`, `email`, `froum_uid`) VALUES
	(1, '张三', '89649090950', '', 'zhangsan@gmail.com', ''),
	(2, '张三', '89649090950', '', 'zhangsan@gmail.com', ''),
	(3, '张三', '89649090950', '', 'zhangsan@gmail.com', ''),
	(4, '王五', '89649090952', '', 'wangwu@gmail.com', '');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;


-- Dumping structure for table aiyouwei.destination
DROP TABLE IF EXISTS `destination`;
CREATE TABLE IF NOT EXISTS `destination` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.destination: ~10 rows (approximately)
/*!40000 ALTER TABLE `destination` DISABLE KEYS */;
INSERT INTO `destination` (`id`, `name`, `slug`, `description`, `hits`, `created`, `updated`) VALUES
	(1, '亚东', '亚东', '亚东', 0, '2012-02-20 21:01:41', '2012-02-20 21:01:41'),
	(2, '江孜', '江孜', '江孜', 0, '2012-02-20 21:01:41', '2012-02-20 21:01:41'),
	(3, '定日', '定日', '定日', 0, '2012-02-20 21:01:41', '2012-02-20 21:01:41'),
	(4, '纳木错', '纳木错', '纳木错', 0, '2012-02-20 21:01:41', '2012-02-20 21:01:41'),
	(5, '珠峰', '珠峰', '珠峰', 0, '2012-02-20 21:01:41', '2012-02-20 21:01:41'),
	(6, '山南', '山南', '山南', 0, '2012-02-20 21:01:41', '2012-02-20 21:01:41'),
	(7, '然乌', '然乌', '然乌', 0, '2012-02-20 21:01:41', '2012-02-20 21:01:41'),
	(8, '林芝', '林芝', '林芝', 0, '2012-02-20 21:01:41', '2012-02-20 21:01:41'),
	(9, '日喀则', '日喀则', '日喀则', 0, '2012-02-20 21:01:41', '2012-02-20 21:01:41'),
	(10, '拉萨', '拉萨', '拉萨', 0, '2012-02-20 21:01:41', '2012-02-20 21:01:41');
/*!40000 ALTER TABLE `destination` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table aiyouwei.driver: ~2 rows (approximately)
/*!40000 ALTER TABLE `driver` DISABLE KEYS */;
INSERT INTO `driver` (`id`, `destination_id`, `name`, `nationality`, `age`, `car_type`, `car_capacity`, `car_plate_num`, `phone`, `star`, `description`, `created`, `updated`) VALUES
	(1, 1, 'dfdsa', 'fdsafdsa', 0, 'suv', 0, 'fdsadfsa', 'fsadfdsa', 3, 'dsafdsa', '2012-03-04 11:52:33', '0000-00-00 00:00:00'),
	(2, 1, 'dsafdsa', 'fdsafd', 0, 'jeep', 0, 'fdsa', 'fdsa', 3, 'fdsafdsa', '2012-03-04 11:52:48', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `driver` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table aiyouwei.hotel: ~30 rows (approximately)
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
INSERT INTO `hotel` (`id`, `destination_id`, `name`, `description`, `phone`, `fax`, `website`, `address`, `star`, `created`) VALUES
	(1, 1, '有间客栈', '有间客栈', '', '', '', '', 1, '2012-02-20 21:01:41'),
	(2, 1, '希尔顿', '希尔顿', '', '', '', '', 4, '2012-02-20 21:01:41'),
	(3, 1, '无名招待所', '无名招待所', '', '', '', '', 4, '2012-02-20 21:01:41'),
	(4, 2, '有间客栈', '有间客栈', '', '', '', '', 5, '2012-02-20 21:01:41'),
	(5, 2, '希尔顿', '希尔顿', '', '', '', '', 1, '2012-02-20 21:01:41'),
	(6, 2, '无名招待所', '无名招待所', '', '', '', '', 4, '2012-02-20 21:01:41'),
	(7, 3, '有间客栈', '有间客栈', '', '', '', '', 3, '2012-02-20 21:01:41'),
	(8, 3, '希尔顿', '希尔顿', '', '', '', '', 3, '2012-02-20 21:01:41'),
	(9, 3, '无名招待所', '无名招待所', '', '', '', '', 3, '2012-02-20 21:01:41'),
	(10, 4, '有间客栈', '有间客栈', '', '', '', '', 4, '2012-02-20 21:01:41'),
	(11, 4, '希尔顿', '希尔顿', '', '', '', '', 5, '2012-02-20 21:01:41'),
	(12, 4, '无名招待所', '无名招待所', '', '', '', '', 2, '2012-02-20 21:01:41'),
	(13, 5, '有间客栈', '有间客栈', '', '', '', '', 3, '2012-02-20 21:01:41'),
	(14, 5, '希尔顿', '希尔顿', '', '', '', '', 3, '2012-02-20 21:01:41'),
	(15, 5, '无名招待所', '无名招待所', '', '', '', '', 1, '2012-02-20 21:01:41'),
	(16, 6, '有间客栈', '有间客栈', '', '', '', '', 2, '2012-02-20 21:01:41'),
	(17, 6, '希尔顿', '希尔顿', '', '', '', '', 2, '2012-02-20 21:01:41'),
	(18, 6, '无名招待所', '无名招待所', '', '', '', '', 5, '2012-02-20 21:01:41'),
	(19, 7, '有间客栈', '有间客栈', '', '', '', '', 4, '2012-02-20 21:01:41'),
	(20, 7, '希尔顿', '希尔顿', '', '', '', '', 3, '2012-02-20 21:01:41'),
	(21, 7, '无名招待所', '无名招待所', '', '', '', '', 3, '2012-02-20 21:01:41'),
	(22, 8, '有间客栈', '有间客栈', '', '', '', '', 5, '2012-02-20 21:01:41'),
	(23, 8, '希尔顿', '希尔顿', '', '', '', '', 2, '2012-02-20 21:01:41'),
	(24, 8, '无名招待所', '无名招待所', '', '', '', '', 1, '2012-02-20 21:01:41'),
	(25, 9, '有间客栈', '有间客栈', '', '', '', '', 4, '2012-02-20 21:01:41'),
	(26, 9, '希尔顿', '希尔顿', '', '', '', '', 1, '2012-02-20 21:01:41'),
	(27, 9, '无名招待所', '无名招待所', '', '', '', '', 2, '2012-02-20 21:01:41'),
	(28, 10, '有间客栈', '有间客栈', '', '', '', '', 1, '2012-02-20 21:01:41'),
	(29, 10, '希尔顿', '希尔顿', '', '', '', '', 3, '2012-02-20 21:01:41'),
	(30, 10, '无名招待所', '无名招待所', '', '', '', '', 4, '2012-02-20 21:01:41');
/*!40000 ALTER TABLE `hotel` ENABLE KEYS */;


-- Dumping structure for table aiyouwei.message
DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(10) DEFAULT NULL,
  `staff_id` int(10) DEFAULT NULL,
  `subject` int(10) DEFAULT NULL,
  `body` int(10) DEFAULT NULL,
  `created` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.message: ~0 rows (approximately)
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;


-- Dumping structure for table aiyouwei.plan
DROP TABLE IF EXISTS `plan`;
CREATE TABLE IF NOT EXISTS `plan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `forum_url` varchar(255) NOT NULL DEFAULT '0',
  `car_request` text NOT NULL,
  `room_request` text NOT NULL,
  `other_request` text NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `contact_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tourist_cnt` int(10) unsigned NOT NULL DEFAULT '1',
  `start_date` date NOT NULL,
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `paid` int(10) unsigned NOT NULL DEFAULT '0',
  `balance` int(10) NOT NULL DEFAULT '-1',
  `created` datetime NOT NULL,
  `status` varchar(30) NOT NULL,
  `car_status` varchar(30) NOT NULL,
  `room_status` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.plan: ~4 rows (approximately)
/*!40000 ALTER TABLE `plan` DISABLE KEYS */;
INSERT INTO `plan` (`id`, `forum_url`, `car_request`, `room_request`, `other_request`, `user_id`, `contact_id`, `tourist_cnt`, `start_date`, `price`, `paid`, `balance`, `created`, `status`, `car_status`, `room_status`) VALUES
	(1, '0', '宽敞舒适的越野车就最好了', '要么三星级以上，要么本地农家', '', 1, 1, 2, '2012-02-20', 1440, 0, -1440, '2012-02-20 21:03:13', 'pending', 'locked', 'locked'),
	(2, '0', '宽敞舒适的越野车就最好了', '要么三星级以上，要么本地农家', '', 1, 2, 5, '2012-02-20', 2650, 0, -2650, '2012-02-20 21:51:55', 'pending', 'locked', 'locked'),
	(3, '0', '宽敞舒适的越野车就最好了', '要么三星级以上，要么本地农家', '', 1, 3, 2, '2012-02-20', 820, 920, 100, '2012-02-20 22:14:05', 'assignning', 'assignning', 'assignning'),
	(4, '', '宽敞舒适的越野车就最好了', '要么三星级以上，要么本地农家', '就这些，劳驾', 1, 4, 4, '2012-03-23', 2640, 0, -2640, '2012-03-04 14:36:33', 'pending', 'locked', 'locked');
/*!40000 ALTER TABLE `plan` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.plan_history: ~8 rows (approximately)
/*!40000 ALTER TABLE `plan_history` DISABLE KEYS */;
INSERT INTO `plan_history` (`id`, `plan_id`, `operator`, `operation`, `created`) VALUES
	(1, 1, 'Root', '计划创建完毕，等待进一步确认', '2012-02-20 21:03:13'),
	(2, 2, 'Root', '计划创建完毕，等待进一步确认', '2012-02-20 21:51:55'),
	(3, 3, 'Root', '计划创建完毕，等待进一步确认', '2012-02-20 22:14:05'),
	(4, 3, 'Root', '审核通过', '2012-02-29 14:59:16'),
	(5, 3, 'Root', '安排中', '2012-03-04 11:51:37'),
	(6, 3, 'Root', '酒店状态调整为：安排中', '2012-03-04 11:51:40'),
	(7, 3, 'Root', '车辆状态调整为：安排中', '2012-03-04 11:51:43'),
	(8, 4, 'Root', '计划创建完毕，等待进一步确认', '2012-03-04 14:36:33');
/*!40000 ALTER TABLE `plan_history` ENABLE KEYS */;


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

-- Dumping data for table aiyouwei.plan_invoice: ~0 rows (approximately)
/*!40000 ALTER TABLE `plan_invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `plan_invoice` ENABLE KEYS */;


-- Dumping structure for table aiyouwei.plan_note
DROP TABLE IF EXISTS `plan_note`;
CREATE TABLE IF NOT EXISTS `plan_note` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) unsigned DEFAULT NULL,
  `staff_id` int(10) unsigned DEFAULT NULL,
  `content` varchar(512) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='订单备注';

-- Dumping data for table aiyouwei.plan_note: ~1 rows (approximately)
/*!40000 ALTER TABLE `plan_note` DISABLE KEYS */;
INSERT INTO `plan_note` (`id`, `plan_id`, `staff_id`, `content`, `created`) VALUES
	(1, 3, 1, '客户明天进藏，请安排司机去接一下，联系电话13882249210', '2012-03-04 12:22:01');
/*!40000 ALTER TABLE `plan_note` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.plan_payment: ~2 rows (approximately)
/*!40000 ALTER TABLE `plan_payment` DISABLE KEYS */;
INSERT INTO `plan_payment` (`id`, `plan_id`, `via`, `operator`, `amount`, `created`, `memo`) VALUES
	(1, 3, 'alipay', 'Root', 120, '2012-03-04 12:00:02', 'etng2004@gmail.com'),
	(2, 3, 'alipay', 'Root', 800, '2012-03-04 12:01:22', '');
/*!40000 ALTER TABLE `plan_payment` ENABLE KEYS */;


-- Dumping structure for table aiyouwei.plan_tour
DROP TABLE IF EXISTS `plan_tour`;
CREATE TABLE IF NOT EXISTS `plan_tour` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) unsigned NOT NULL,
  `tour_id` int(10) unsigned NOT NULL,
  `destination` varchar(50) NOT NULL,
  `the_date` date NOT NULL,
  `car_tourist_cnt` int(10) unsigned NOT NULL DEFAULT '0',
  `room_tourist_cnt` int(10) unsigned NOT NULL DEFAULT '0',
  `tourist_cnt` int(10) unsigned NOT NULL DEFAULT '1',
  `market_price_sum` int(10) unsigned NOT NULL,
  `price_sum` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.plan_tour: ~13 rows (approximately)
/*!40000 ALTER TABLE `plan_tour` DISABLE KEYS */;
INSERT INTO `plan_tour` (`id`, `plan_id`, `tour_id`, `destination`, `the_date`, `car_tourist_cnt`, `room_tourist_cnt`, `tourist_cnt`, `market_price_sum`, `price_sum`) VALUES
	(1, 1, 8, '日喀则', '2012-02-20', 2, 2, 2, 600, 480),
	(2, 1, 4, '山南', '2012-02-21', 2, 2, 2, 960, 780),
	(3, 1, 2, '珠峰', '2012-02-22', 2, 2, 2, 220, 180),
	(4, 2, 5, '日喀则', '2012-02-20', 5, 5, 5, 700, 600),
	(5, 2, 10, '亚东', '2012-02-21', 5, 5, 5, 1800, 1450),
	(6, 2, 7, '山南', '2012-02-22', 5, 5, 5, 700, 600),
	(7, 3, 10, '亚东', '2012-02-20', 2, 2, 2, 720, 580),
	(8, 3, 7, '山南', '2012-02-21', 2, 2, 2, 280, 240),
	(9, 4, 8, '日喀则', '2012-03-23', 0, 0, 0, 0, 0),
	(10, 4, 1, '林芝', '2012-03-24', 4, 4, 4, 1640, 1320),
	(11, 4, 7, '山南', '2012-03-25', 4, 4, 4, 560, 480),
	(12, 4, 2, '珠峰', '2012-03-26', 4, 4, 4, 440, 360),
	(13, 4, 5, '日喀则', '2012-03-27', 4, 4, 4, 560, 480);
/*!40000 ALTER TABLE `plan_tour` ENABLE KEYS */;


-- Dumping structure for table aiyouwei.plan_tourist
DROP TABLE IF EXISTS `plan_tourist`;
CREATE TABLE IF NOT EXISTS `plan_tourist` (
  `plan_id` int(10) unsigned NOT NULL,
  `tourist_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`plan_id`,`tourist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.plan_tourist: ~6 rows (approximately)
/*!40000 ALTER TABLE `plan_tourist` DISABLE KEYS */;
INSERT INTO `plan_tourist` (`plan_id`, `tourist_id`) VALUES
	(3, 1),
	(3, 2),
	(4, 3),
	(4, 4),
	(4, 5),
	(4, 6);
/*!40000 ALTER TABLE `plan_tourist` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.plan_tour_car: ~3 rows (approximately)
/*!40000 ALTER TABLE `plan_tour_car` DISABLE KEYS */;
INSERT INTO `plan_tour_car` (`id`, `plan_tour_id`, `plan_id`, `type`, `driver_id`, `tourist_cnt`, `price`, `memo`) VALUES
	(1, 7, 3, 'jeep', '2', 2, 60, ''),
	(2, 7, 3, 'car', '1', 2, 100, ''),
	(3, 7, 3, 'suv', '1', 2, 140, '');
/*!40000 ALTER TABLE `plan_tour_car` ENABLE KEYS */;


-- Dumping structure for table aiyouwei.plan_tour_room
DROP TABLE IF EXISTS `plan_tour_room`;
CREATE TABLE IF NOT EXISTS `plan_tour_room` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plan_tour_id` int(10) unsigned NOT NULL,
  `type` varchar(50) NOT NULL,
  `room_cnt` int(10) unsigned NOT NULL DEFAULT '1',
  `hotel_id` int(10) unsigned NOT NULL,
  `tourist_cnt` int(10) unsigned NOT NULL DEFAULT '0',
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `memo` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.plan_tour_room: ~1 rows (approximately)
/*!40000 ALTER TABLE `plan_tour_room` DISABLE KEYS */;
INSERT INTO `plan_tour_room` (`id`, `plan_tour_id`, `type`, `room_cnt`, `hotel_id`, `tourist_cnt`, `price`, `memo`) VALUES
	(1, 7, 'std', 1, 1, 2, 888, '');
/*!40000 ALTER TABLE `plan_tour_room` ENABLE KEYS */;


-- Dumping structure for table aiyouwei.plan_tour_tourist
DROP TABLE IF EXISTS `plan_tour_tourist`;
CREATE TABLE IF NOT EXISTS `plan_tour_tourist` (
  `plan_tour_id` int(10) unsigned NOT NULL,
  `tourist_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`plan_tour_id`,`tourist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.plan_tour_tourist: ~0 rows (approximately)
/*!40000 ALTER TABLE `plan_tour_tourist` DISABLE KEYS */;
/*!40000 ALTER TABLE `plan_tour_tourist` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table aiyouwei.room_daily_price: ~4 rows (approximately)
/*!40000 ALTER TABLE `room_daily_price` DISABLE KEYS */;
INSERT INTO `room_daily_price` (`id`, `the_date`, `hotel_id`, `room_type`, `cost`, `public_price`, `min_price`, `default_price`, `max_price`, `memo`, `updated`) VALUES
	(1, '2012-03-21', 30, 'tao', 200, 400, 300, 320, 360, 'hhhh', '2012-03-04 11:50:53'),
	(2, '2012-03-22', 30, 'tao', 200, 400, 300, 320, 360, 'hhhh', '2012-03-04 11:50:53'),
	(3, '2012-03-23', 30, 'tao', 200, 400, 300, 320, 360, 'hhhh', '2012-03-04 11:50:53'),
	(4, '2012-03-24', 30, 'tao', 200, 400, 300, 320, 360, 'hhhh', '2012-03-04 11:50:53');
/*!40000 ALTER TABLE `room_daily_price` ENABLE KEYS */;


-- Dumping structure for table aiyouwei.schedule_template
DROP TABLE IF EXISTS `schedule_template`;
CREATE TABLE IF NOT EXISTS `schedule_template` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `memo` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.schedule_template: ~3 rows (approximately)
/*!40000 ALTER TABLE `schedule_template` DISABLE KEYS */;
INSERT INTO `schedule_template` (`id`, `cate_id`, `name`, `code`, `content`, `memo`) VALUES
	(1, 1, '鲁朗3日', 'A1', 'D1，拉萨→巴松错→八一，沿途尼洋河，住八一\r\n D2，八一→鲁朗→八一，鲁朗林海、牧场、石锅鸡、色季拉山观南迦巴瓦，住八一\r\n D3，八一→拉萨\r\n', ''),
	(2, 1, '然乌4日', 'A4A', 'D1，拉萨→巴松错→八一\r\n D2，八一→鲁朗→波密→米堆冰川→然乌，住然乌，五日的话这天拆为两天，第一天住波密，第二天住然乌\r\n D3，然乌→八一，下午鲁朗石锅鸡，住八一\r\n D4，八一→拉萨\r\n ', ''),
	(3, 2, '珠峰+纳木错5日（需要办理边防证）', 'B2', 'D1，拉萨→羊湖→江孜→日喀则\r\n D2，日喀则→定日→珠峰\r\n D3，珠峰→日喀则\r\n D4，日喀则→大竹卡→纳木错\r\n D5，纳木错→羊八井→拉萨\r\n ', '');
/*!40000 ALTER TABLE `schedule_template` ENABLE KEYS */;


-- Dumping structure for table aiyouwei.schedule_template_cate
DROP TABLE IF EXISTS `schedule_template_cate`;
CREATE TABLE IF NOT EXISTS `schedule_template_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.schedule_template_cate: ~3 rows (approximately)
/*!40000 ALTER TABLE `schedule_template_cate` DISABLE KEYS */;
INSERT INTO `schedule_template_cate` (`id`, `name`, `description`) VALUES
	(1, 'A线：林芝方向', '2-5天，暂有6种玩法可供参考。'),
	(2, 'B线：日喀则、珠峰方向', '2-5天，暂有4种玩法可供参考。'),
	(3, 'C线：山南方向，含亚东', '2-4天，暂有3种玩法可供参考。');
/*!40000 ALTER TABLE `schedule_template_cate` ENABLE KEYS */;


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
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.staff: ~6 rows (approximately)
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` (`id`, `group_id`, `username`, `password`, `name`, `phone`, `email`, `memo`, `privileges`, `created`) VALUES
	(1, 1, 'root', 'dfaf92dba2802618c4bc8e4008713737', '小皮', '', '', '', '*', '2012-02-20 21:01:43'),
	(2, 1, 'demo', '782f70cecb2a29d314eb9c5c8eef11db', 'Demo', '', '', '', '*.list,*.view', '2012-02-20 21:01:43'),
	(3, 1, 'caiwu', '49d5620d7845e177876ca9daebf13332', 'Caiwu', '', '', '', '*.list,*.view,plan.add-payment', '2012-02-20 21:01:43'),
	(4, 1, 'hotel_staff', '6b45fb4fc12dfd6955c1f6b32d92c290', 'Hotel Staff', '', '', '', '*.list,*.view,hotel.*,plan.add-room,plan.set-room-status,plan.get-room-price,plan.get-destination-hotels,plan.get-plan-tour_rooms', '2012-02-20 21:01:43'),
	(5, 1, 'car_staff', '88234e69b6bd409dd7e00f4eee6bd565', 'Car Staff', '', '', '', '*.list,*.view,driver.*,plan.add-car,plan.set-car-status,plan.get-destination-drivers,plan.get-plan-tour_cars', '2012-02-20 21:01:43'),
	(6, 8, 'dsafdsa', 'be813a0289f17ad62e6ea46909463c72', 'dsafas', 'fsadfsad', 'fsadfsa', 'dsafsad', '*,*.list,*.view,*.add,*.edit,*.del,hotel.*,hotel.list,hotel.view,hotel.add,hotel.del,hotel.add-price,destination.*,destination.list,destination.view,destination.add,destination.del,tour.*,tour.list,tour.view,tour.add,tour.del,driver.*,driver.list,driver.view,driver.add,driver.del,staff.*,staff.list,staff.view,staff.add,staff.del,article.*,article.list,article.view,article.add,article.del,plan.*,plan.list,plan.view,plan.add,plan.del,plan.add-payment,plan.get-plan-tour_rooms,plan.get-plan-tour_cars,plan.get-destination-hotels,plan.get-destination-drivers,plan.get-room-price,plan.add-car,plan.add-room,plan.set-status,plan.set-car-status,plan.set-room-status', '2012-03-04 11:09:39');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.staff_group: ~8 rows (approximately)
/*!40000 ALTER TABLE `staff_group` DISABLE KEYS */;
INSERT INTO `staff_group` (`id`, `name`, `phone`, `memo`, `privileges`, `created`) VALUES
	(1, '总经理', '', '', '', '0000-00-00 00:00:00'),
	(2, '营销部', '', '', '', '0000-00-00 00:00:00'),
	(3, '市场部', '', '', '', '0000-00-00 00:00:00'),
	(4, '后勤部', '', '', '', '0000-00-00 00:00:00'),
	(5, '', '', '', '', '2012-03-04 10:31:49'),
	(6, '', '', '', '', '2012-03-04 10:36:08'),
	(7, '', '', '', '', '2012-03-04 10:56:06'),
	(8, 'dsfdsaf', '11211212', 'dsfsad', '*,*.list,*.view,*.add,*.edit,*.del,hotel.*,hotel.list,hotel.view,hotel.add,hotel.del,hotel.add-price,destination.*,destination.list,destination.view,destination.add,destination.del,tour.*,tour.list,tour.view,tour.add,tour.del,driver.*,driver.list,driver.view,driver.add,driver.del,staff.*,staff.list,staff.view,staff.add,staff.del,article.*,article.list,article.view,article.add,article.del,plan.*,plan.list,plan.view,plan.add,plan.del,plan.add-payment,plan.get-plan-tour_rooms,plan.get-plan-tour_cars,plan.get-destination-hotels,plan.get-destination-drivers,plan.get-room-price,plan.add-car,plan.add-room,plan.set-status,plan.set-car-status,plan.set-room-status', '2012-03-04 11:09:20');
/*!40000 ALTER TABLE `staff_group` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COMMENT='待办事项';

-- Dumping data for table aiyouwei.todo: ~100 rows (approximately)
/*!40000 ALTER TABLE `todo` DISABLE KEYS */;
INSERT INTO `todo` (`id`, `user_id`, `order_id`, `title`, `description`, `start_date`, `end_date`, `url`, `background_color`, `text_color`, `border_color`, `confirmed`, `all_day`) VALUES
	(1, 0, 0, '定日', '从2012-02-23到2012-03-02,共计9天', '2012-02-23 21:01:32', '2012-03-02 21:01:32', 'todo.php?act=view&id=1', '', '', '', 0, 1),
	(2, 0, 0, '林芝', '从2012-03-04到2012-03-06,共计3天', '2012-03-04 21:01:32', '2012-03-06 21:01:32', 'todo.php?act=view&id=2', '', '', '', 1, 1),
	(3, 0, 0, '江孜', '从2012-03-07到2012-03-14,共计8天', '2012-03-07 21:01:32', '2012-03-14 21:01:32', 'todo.php?act=view&id=3', '', '', '', 0, 1),
	(4, 0, 0, '定日', '从2012-03-16到2012-03-20,共计5天', '2012-03-16 21:01:32', '2012-03-20 21:01:32', 'todo.php?act=view&id=4', '', '', '', 1, 1),
	(5, 0, 0, '纳木错', '从2012-03-23到2012-03-25,共计3天', '2012-03-23 21:01:32', '2012-03-25 21:01:32', 'todo.php?act=view&id=5', '', '', '', 0, 1),
	(6, 0, 0, '定日', '从2012-03-27到2012-03-27,共计1天', '2012-03-27 21:01:32', '2012-03-27 21:01:32', 'todo.php?act=view&id=6', '', '', '', 1, 1),
	(7, 0, 0, '林芝', '从2012-03-29到2012-04-01,共计4天', '2012-03-29 21:01:32', '2012-04-01 21:01:32', 'todo.php?act=view&id=7', '', '', '', 0, 1),
	(8, 0, 0, '然乌', '从2012-04-02到2012-04-02,共计1天', '2012-04-02 21:01:32', '2012-04-02 21:01:32', 'todo.php?act=view&id=8', '', '', '', 1, 1),
	(9, 0, 0, '珠峰', '从2012-04-04到2012-04-11,共计8天', '2012-04-04 21:01:32', '2012-04-11 21:01:32', 'todo.php?act=view&id=9', '', '', '', 0, 1),
	(10, 0, 0, '拉萨', '从2012-04-12到2012-04-16,共计5天', '2012-04-12 21:01:32', '2012-04-16 21:01:32', 'todo.php?act=view&id=10', '', '', '', 1, 1),
	(11, 0, 0, '山南', '从2012-04-17到2012-04-25,共计9天', '2012-04-17 21:01:32', '2012-04-25 21:01:32', 'todo.php?act=view&id=11', '', '', '', 0, 1),
	(12, 0, 0, '然乌', '从2012-04-26到2012-04-26,共计1天', '2012-04-26 21:01:32', '2012-04-26 21:01:32', 'todo.php?act=view&id=12', '', '', '', 1, 1),
	(13, 0, 0, '亚东', '从2012-04-29到2012-05-04,共计6天', '2012-04-29 21:01:32', '2012-05-04 21:01:32', 'todo.php?act=view&id=13', '', '', '', 0, 1),
	(14, 0, 0, '林芝', '从2012-05-05到2012-05-08,共计4天', '2012-05-05 21:01:32', '2012-05-08 21:01:32', 'todo.php?act=view&id=14', '', '', '', 1, 1),
	(15, 0, 0, '江孜', '从2012-05-09到2012-05-11,共计3天', '2012-05-09 21:01:32', '2012-05-11 21:01:32', 'todo.php?act=view&id=15', '', '', '', 0, 1),
	(16, 0, 0, '然乌', '从2012-05-14到2012-05-22,共计9天', '2012-05-14 21:01:32', '2012-05-22 21:01:32', 'todo.php?act=view&id=16', '', '', '', 1, 1),
	(17, 0, 0, '林芝', '从2012-05-24到2012-05-27,共计4天', '2012-05-24 21:01:32', '2012-05-27 21:01:32', 'todo.php?act=view&id=17', '', '', '', 0, 1),
	(18, 0, 0, '亚东', '从2012-05-29到2012-06-03,共计6天', '2012-05-29 21:01:32', '2012-06-03 21:01:32', 'todo.php?act=view&id=18', '', '', '', 1, 1),
	(19, 0, 0, '拉萨', '从2012-06-06到2012-06-13,共计8天', '2012-06-06 21:01:32', '2012-06-13 21:01:32', 'todo.php?act=view&id=19', '', '', '', 0, 1),
	(20, 0, 0, '然乌', '从2012-06-15到2012-06-22,共计8天', '2012-06-15 21:01:32', '2012-06-22 21:01:32', 'todo.php?act=view&id=20', '', '', '', 1, 1),
	(21, 0, 0, '然乌', '从2012-06-25到2012-07-04,共计10天', '2012-06-25 21:01:32', '2012-07-04 21:01:32', 'todo.php?act=view&id=21', '', '', '', 0, 1),
	(22, 0, 0, '日喀则', '从2012-07-07到2012-07-15,共计9天', '2012-07-07 21:01:32', '2012-07-15 21:01:32', 'todo.php?act=view&id=22', '', '', '', 1, 1),
	(23, 0, 0, '亚东', '从2012-07-17到2012-07-25,共计9天', '2012-07-17 21:01:32', '2012-07-25 21:01:32', 'todo.php?act=view&id=23', '', '', '', 0, 1),
	(24, 0, 0, '纳木错', '从2012-07-28到2012-07-28,共计1天', '2012-07-28 21:01:32', '2012-07-28 21:01:32', 'todo.php?act=view&id=24', '', '', '', 1, 1),
	(25, 0, 0, '定日', '从2012-07-30到2012-07-31,共计2天', '2012-07-30 21:01:32', '2012-07-31 21:01:32', 'todo.php?act=view&id=25', '', '', '', 0, 1),
	(26, 0, 0, '然乌', '从2012-08-03到2012-08-07,共计5天', '2012-08-03 21:01:32', '2012-08-07 21:01:32', 'todo.php?act=view&id=26', '', '', '', 1, 1),
	(27, 0, 0, '林芝', '从2012-08-09到2012-08-13,共计5天', '2012-08-09 21:01:32', '2012-08-13 21:01:32', 'todo.php?act=view&id=27', '', '', '', 0, 1),
	(28, 0, 0, '拉萨', '从2012-08-14到2012-08-16,共计3天', '2012-08-14 21:01:32', '2012-08-16 21:01:32', 'todo.php?act=view&id=28', '', '', '', 1, 1),
	(29, 0, 0, '江孜', '从2012-08-19到2012-08-23,共计5天', '2012-08-19 21:01:32', '2012-08-23 21:01:32', 'todo.php?act=view&id=29', '', '', '', 0, 1),
	(30, 0, 0, '亚东', '从2012-08-25到2012-08-27,共计3天', '2012-08-25 21:01:32', '2012-08-27 21:01:32', 'todo.php?act=view&id=30', '', '', '', 1, 1),
	(31, 0, 0, '拉萨', '从2012-08-30到2012-09-08,共计10天', '2012-08-30 21:01:32', '2012-09-08 21:01:32', 'todo.php?act=view&id=31', '', '', '', 0, 1),
	(32, 0, 0, '江孜', '从2012-09-11到2012-09-11,共计1天', '2012-09-11 21:01:32', '2012-09-11 21:01:32', 'todo.php?act=view&id=32', '', '', '', 1, 1),
	(33, 0, 0, '珠峰', '从2012-09-12到2012-09-18,共计7天', '2012-09-12 21:01:32', '2012-09-18 21:01:32', 'todo.php?act=view&id=33', '', '', '', 0, 1),
	(34, 0, 0, '亚东', '从2012-09-21到2012-09-30,共计10天', '2012-09-21 21:01:32', '2012-09-30 21:01:32', 'todo.php?act=view&id=34', '', '', '', 1, 1),
	(35, 0, 0, '拉萨', '从2012-10-01到2012-10-01,共计1天', '2012-10-01 21:01:32', '2012-10-01 21:01:32', 'todo.php?act=view&id=35', '', '', '', 0, 1),
	(36, 0, 0, '定日', '从2012-10-02到2012-10-10,共计9天', '2012-10-02 21:01:32', '2012-10-10 21:01:32', 'todo.php?act=view&id=36', '', '', '', 1, 1),
	(37, 0, 0, '山南', '从2012-10-12到2012-10-21,共计10天', '2012-10-12 21:01:32', '2012-10-21 21:01:32', 'todo.php?act=view&id=37', '', '', '', 0, 1),
	(38, 0, 0, '林芝', '从2012-10-24到2012-10-26,共计3天', '2012-10-24 21:01:32', '2012-10-26 21:01:32', 'todo.php?act=view&id=38', '', '', '', 1, 1),
	(39, 0, 0, '拉萨', '从2012-10-28到2012-10-29,共计2天', '2012-10-28 21:01:32', '2012-10-29 21:01:32', 'todo.php?act=view&id=39', '', '', '', 0, 1),
	(40, 0, 0, '纳木错', '从2012-10-30到2012-11-08,共计10天', '2012-10-30 21:01:32', '2012-11-08 21:01:32', 'todo.php?act=view&id=40', '', '', '', 1, 1),
	(41, 0, 0, '纳木错', '从2012-11-10到2012-11-19,共计10天', '2012-11-10 21:01:32', '2012-11-19 21:01:32', 'todo.php?act=view&id=41', '', '', '', 0, 1),
	(42, 0, 0, '珠峰', '从2012-11-21到2012-11-26,共计6天', '2012-11-21 21:01:32', '2012-11-26 21:01:32', 'todo.php?act=view&id=42', '', '', '', 1, 1),
	(43, 0, 0, '日喀则', '从2012-11-28到2012-12-07,共计10天', '2012-11-28 21:01:32', '2012-12-07 21:01:32', 'todo.php?act=view&id=43', '', '', '', 0, 1),
	(44, 0, 0, '珠峰', '从2012-12-10到2012-12-17,共计8天', '2012-12-10 21:01:32', '2012-12-17 21:01:32', 'todo.php?act=view&id=44', '', '', '', 1, 1),
	(45, 0, 0, '拉萨', '从2012-12-20到2012-12-21,共计2天', '2012-12-20 21:01:32', '2012-12-21 21:01:32', 'todo.php?act=view&id=45', '', '', '', 0, 1),
	(46, 0, 0, '亚东', '从2012-12-22到2012-12-26,共计5天', '2012-12-22 21:01:32', '2012-12-26 21:01:32', 'todo.php?act=view&id=46', '', '', '', 1, 1),
	(47, 0, 0, '然乌', '从2012-12-27到2012-12-31,共计5天', '2012-12-27 21:01:32', '2012-12-31 21:01:32', 'todo.php?act=view&id=47', '', '', '', 0, 1),
	(48, 0, 0, '山南', '从2013-01-03到2013-01-12,共计10天', '2013-01-03 21:01:32', '2013-01-12 21:01:32', 'todo.php?act=view&id=48', '', '', '', 1, 1),
	(49, 0, 0, '江孜', '从2013-01-14到2013-01-23,共计10天', '2013-01-14 21:01:32', '2013-01-23 21:01:32', 'todo.php?act=view&id=49', '', '', '', 0, 1),
	(50, 0, 0, '日喀则', '从2013-01-24到2013-01-28,共计5天', '2013-01-24 21:01:32', '2013-01-28 21:01:32', 'todo.php?act=view&id=50', '', '', '', 1, 1),
	(51, 0, 0, '定日', '从2013-01-31到2013-02-07,共计8天', '2013-01-31 21:01:32', '2013-02-07 21:01:32', 'todo.php?act=view&id=51', '', '', '', 0, 1),
	(52, 0, 0, '日喀则', '从2013-02-08到2013-02-13,共计6天', '2013-02-08 21:01:32', '2013-02-13 21:01:32', 'todo.php?act=view&id=52', '', '', '', 1, 1),
	(53, 0, 0, '拉萨', '从2013-02-15到2013-02-17,共计3天', '2013-02-15 21:01:32', '2013-02-17 21:01:32', 'todo.php?act=view&id=53', '', '', '', 0, 1),
	(54, 0, 0, '然乌', '从2013-02-20到2013-03-01,共计10天', '2013-02-20 21:01:32', '2013-03-01 21:01:32', 'todo.php?act=view&id=54', '', '', '', 1, 1),
	(55, 0, 0, '定日', '从2013-03-04到2013-03-07,共计4天', '2013-03-04 21:01:32', '2013-03-07 21:01:32', 'todo.php?act=view&id=55', '', '', '', 0, 1),
	(56, 0, 0, '山南', '从2013-03-08到2013-03-17,共计10天', '2013-03-08 21:01:32', '2013-03-17 21:01:32', 'todo.php?act=view&id=56', '', '', '', 1, 1),
	(57, 0, 0, '定日', '从2013-03-18到2013-03-27,共计10天', '2013-03-18 21:01:32', '2013-03-27 21:01:32', 'todo.php?act=view&id=57', '', '', '', 0, 1),
	(58, 0, 0, '然乌', '从2013-03-30到2013-04-04,共计6天', '2013-03-30 21:01:32', '2013-04-04 21:01:32', 'todo.php?act=view&id=58', '', '', '', 1, 1),
	(59, 0, 0, '珠峰', '从2013-04-05到2013-04-08,共计4天', '2013-04-05 21:01:32', '2013-04-08 21:01:32', 'todo.php?act=view&id=59', '', '', '', 0, 1),
	(60, 0, 0, '纳木错', '从2013-04-11到2013-04-12,共计2天', '2013-04-11 21:01:32', '2013-04-12 21:01:32', 'todo.php?act=view&id=60', '', '', '', 1, 1),
	(61, 0, 0, '林芝', '从2013-04-15到2013-04-21,共计7天', '2013-04-15 21:01:32', '2013-04-21 21:01:32', 'todo.php?act=view&id=61', '', '', '', 0, 1),
	(62, 0, 0, '江孜', '从2013-04-24到2013-05-01,共计8天', '2013-04-24 21:01:32', '2013-05-01 21:01:32', 'todo.php?act=view&id=62', '', '', '', 1, 1),
	(63, 0, 0, '定日', '从2013-05-03到2013-05-11,共计9天', '2013-05-03 21:01:32', '2013-05-11 21:01:32', 'todo.php?act=view&id=63', '', '', '', 0, 1),
	(64, 0, 0, '然乌', '从2013-05-14到2013-05-21,共计8天', '2013-05-14 21:01:32', '2013-05-21 21:01:32', 'todo.php?act=view&id=64', '', '', '', 1, 1),
	(65, 0, 0, '江孜', '从2013-05-22到2013-05-31,共计10天', '2013-05-22 21:01:32', '2013-05-31 21:01:32', 'todo.php?act=view&id=65', '', '', '', 0, 1),
	(66, 0, 0, '林芝', '从2013-06-01到2013-06-10,共计10天', '2013-06-01 21:01:32', '2013-06-10 21:01:32', 'todo.php?act=view&id=66', '', '', '', 1, 1),
	(67, 0, 0, '日喀则', '从2013-06-11到2013-06-18,共计8天', '2013-06-11 21:01:32', '2013-06-18 21:01:32', 'todo.php?act=view&id=67', '', '', '', 0, 1),
	(68, 0, 0, '定日', '从2013-06-20到2013-06-26,共计7天', '2013-06-20 21:01:32', '2013-06-26 21:01:32', 'todo.php?act=view&id=68', '', '', '', 1, 1),
	(69, 0, 0, '山南', '从2013-06-28到2013-06-30,共计3天', '2013-06-28 21:01:32', '2013-06-30 21:01:32', 'todo.php?act=view&id=69', '', '', '', 0, 1),
	(70, 0, 0, '定日', '从2013-07-02到2013-07-07,共计6天', '2013-07-02 21:01:32', '2013-07-07 21:01:32', 'todo.php?act=view&id=70', '', '', '', 1, 1),
	(71, 0, 0, '日喀则', '从2013-07-09到2013-07-13,共计5天', '2013-07-09 21:01:32', '2013-07-13 21:01:32', 'todo.php?act=view&id=71', '', '', '', 0, 1),
	(72, 0, 0, '林芝', '从2013-07-16到2013-07-18,共计3天', '2013-07-16 21:01:32', '2013-07-18 21:01:32', 'todo.php?act=view&id=72', '', '', '', 1, 1),
	(73, 0, 0, '珠峰', '从2013-07-21到2013-07-27,共计7天', '2013-07-21 21:01:32', '2013-07-27 21:01:32', 'todo.php?act=view&id=73', '', '', '', 0, 1),
	(74, 0, 0, '定日', '从2013-07-30到2013-07-30,共计1天', '2013-07-30 21:01:32', '2013-07-30 21:01:32', 'todo.php?act=view&id=74', '', '', '', 1, 1),
	(75, 0, 0, '山南', '从2013-08-01到2013-08-10,共计10天', '2013-08-01 21:01:32', '2013-08-10 21:01:32', 'todo.php?act=view&id=75', '', '', '', 0, 1),
	(76, 0, 0, '定日', '从2013-08-11到2013-08-15,共计5天', '2013-08-11 21:01:32', '2013-08-15 21:01:32', 'todo.php?act=view&id=76', '', '', '', 1, 1),
	(77, 0, 0, '纳木错', '从2013-08-18到2013-08-20,共计3天', '2013-08-18 21:01:32', '2013-08-20 21:01:32', 'todo.php?act=view&id=77', '', '', '', 0, 1),
	(78, 0, 0, '珠峰', '从2013-08-23到2013-08-26,共计4天', '2013-08-23 21:01:32', '2013-08-26 21:01:32', 'todo.php?act=view&id=78', '', '', '', 1, 1),
	(79, 0, 0, '定日', '从2013-08-28到2013-08-28,共计1天', '2013-08-28 21:01:32', '2013-08-28 21:01:32', 'todo.php?act=view&id=79', '', '', '', 0, 1),
	(80, 0, 0, '定日', '从2013-08-29到2013-09-05,共计8天', '2013-08-29 21:01:32', '2013-09-05 21:01:32', 'todo.php?act=view&id=80', '', '', '', 1, 1),
	(81, 0, 0, '定日', '从2013-09-08到2013-09-11,共计4天', '2013-09-08 21:01:32', '2013-09-11 21:01:32', 'todo.php?act=view&id=81', '', '', '', 0, 1),
	(82, 0, 0, '纳木错', '从2013-09-12到2013-09-12,共计1天', '2013-09-12 21:01:32', '2013-09-12 21:01:32', 'todo.php?act=view&id=82', '', '', '', 1, 1),
	(83, 0, 0, '江孜', '从2013-09-14到2013-09-17,共计4天', '2013-09-14 21:01:32', '2013-09-17 21:01:32', 'todo.php?act=view&id=83', '', '', '', 0, 1),
	(84, 0, 0, '山南', '从2013-09-18到2013-09-20,共计3天', '2013-09-18 21:01:32', '2013-09-20 21:01:32', 'todo.php?act=view&id=84', '', '', '', 1, 1),
	(85, 0, 0, '定日', '从2013-09-23到2013-09-30,共计8天', '2013-09-23 21:01:32', '2013-09-30 21:01:32', 'todo.php?act=view&id=85', '', '', '', 0, 1),
	(86, 0, 0, '山南', '从2013-10-03到2013-10-03,共计1天', '2013-10-03 21:01:32', '2013-10-03 21:01:32', 'todo.php?act=view&id=86', '', '', '', 1, 1),
	(87, 0, 0, '亚东', '从2013-10-05到2013-10-05,共计1天', '2013-10-05 21:01:32', '2013-10-05 21:01:32', 'todo.php?act=view&id=87', '', '', '', 0, 1),
	(88, 0, 0, '日喀则', '从2013-10-07到2013-10-08,共计2天', '2013-10-07 21:01:32', '2013-10-08 21:01:32', 'todo.php?act=view&id=88', '', '', '', 1, 1),
	(89, 0, 0, '纳木错', '从2013-10-09到2013-10-18,共计10天', '2013-10-09 21:01:32', '2013-10-18 21:01:32', 'todo.php?act=view&id=89', '', '', '', 0, 1),
	(90, 0, 0, '山南', '从2013-10-21到2013-10-24,共计4天', '2013-10-21 21:01:32', '2013-10-24 21:01:32', 'todo.php?act=view&id=90', '', '', '', 1, 1),
	(91, 0, 0, '定日', '从2013-10-25到2013-10-26,共计2天', '2013-10-25 21:01:32', '2013-10-26 21:01:32', 'todo.php?act=view&id=91', '', '', '', 0, 1),
	(92, 0, 0, '日喀则', '从2013-10-27到2013-10-30,共计4天', '2013-10-27 21:01:32', '2013-10-30 21:01:32', 'todo.php?act=view&id=92', '', '', '', 1, 1),
	(93, 0, 0, '纳木错', '从2013-11-02到2013-11-08,共计7天', '2013-11-02 21:01:32', '2013-11-08 21:01:32', 'todo.php?act=view&id=93', '', '', '', 0, 1),
	(94, 0, 0, '亚东', '从2013-11-11到2013-11-20,共计10天', '2013-11-11 21:01:32', '2013-11-20 21:01:32', 'todo.php?act=view&id=94', '', '', '', 1, 1),
	(95, 0, 0, '日喀则', '从2013-11-22到2013-11-30,共计9天', '2013-11-22 21:01:32', '2013-11-30 21:01:32', 'todo.php?act=view&id=95', '', '', '', 0, 1),
	(96, 0, 0, '亚东', '从2013-12-01到2013-12-02,共计2天', '2013-12-01 21:01:32', '2013-12-02 21:01:32', 'todo.php?act=view&id=96', '', '', '', 1, 1),
	(97, 0, 0, '拉萨', '从2013-12-03到2013-12-11,共计9天', '2013-12-03 21:01:32', '2013-12-11 21:01:32', 'todo.php?act=view&id=97', '', '', '', 0, 1),
	(98, 0, 0, '拉萨', '从2013-12-13到2013-12-18,共计6天', '2013-12-13 21:01:32', '2013-12-18 21:01:32', 'todo.php?act=view&id=98', '', '', '', 1, 1),
	(99, 0, 0, '珠峰', '从2013-12-19到2013-12-27,共计9天', '2013-12-19 21:01:32', '2013-12-27 21:01:32', 'todo.php?act=view&id=99', '', '', '', 0, 1),
	(100, 0, 0, '拉萨', '从2013-12-28到2014-01-06,共计10天', '2013-12-28 21:01:32', '2014-01-06 21:01:32', 'todo.php?act=view&id=100', '', '', '', 1, 1);
/*!40000 ALTER TABLE `todo` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.tour: ~10 rows (approximately)
/*!40000 ALTER TABLE `tour` DISABLE KEYS */;
INSERT INTO `tour` (`id`, `name`, `destination_id`, `destination`, `description`, `market_price`, `price`, `distance`, `created`, `updated`) VALUES
	(1, '珠峰 - 拉萨 - 纳木错 - 定日 - 林芝', 8, '林芝', '珠峰 - 拉萨 - 纳木错 - 定日 - 林芝', 410, 330, 210, '2012-02-20 21:01:43', '2012-02-20 21:01:43'),
	(2, '林芝 - 江孜 - 拉萨 - 珠峰', 5, '珠峰', '林芝 - 江孜 - 拉萨 - 珠峰', 110, 90, 420, '2012-02-20 21:01:43', '2012-02-20 21:01:43'),
	(3, '林芝 - 纳木错 - 拉萨 - 山南 - 亚东', 1, '亚东', '林芝 - 纳木错 - 拉萨 - 山南 - 亚东', 130, 110, 400, '2012-02-20 21:01:43', '2012-02-20 21:01:43'),
	(4, '拉萨 - 纳木错 - 日喀则 - 然乌 - 山南', 6, '山南', '拉萨 - 纳木错 - 日喀则 - 然乌 - 山南', 480, 390, 200, '2012-02-20 21:01:43', '2012-02-20 21:01:43'),
	(5, '珠峰 - 然乌 - 亚东 - 拉萨 - 日喀则', 9, '日喀则', '珠峰 - 然乌 - 亚东 - 拉萨 - 日喀则', 140, 120, 100, '2012-02-20 21:01:43', '2012-02-20 21:01:43'),
	(6, '日喀则 - 江孜 - 山南 - 然乌', 7, '然乌', '日喀则 - 江孜 - 山南 - 然乌', 370, 300, 150, '2012-02-20 21:01:43', '2012-02-20 21:01:43'),
	(7, '林芝 - 亚东 - 山南', 6, '山南', '林芝 - 亚东 - 山南', 140, 120, 230, '2012-02-20 21:01:43', '2012-02-20 21:01:43'),
	(8, '珠峰 - 江孜 - 林芝 - 纳木错 - 日喀则', 9, '日喀则', '珠峰 - 江孜 - 林芝 - 纳木错 - 日喀则', 300, 240, 380, '2012-02-20 21:01:43', '2012-02-20 21:01:43'),
	(9, '江孜 - 然乌 - 林芝 - 珠峰', 5, '珠峰', '江孜 - 然乌 - 林芝 - 珠峰', 230, 190, 480, '2012-02-20 21:01:43', '2012-02-20 21:01:43'),
	(10, '然乌 - 江孜 - 亚东', 1, '亚东', '然乌 - 江孜 - 亚东', 360, 290, 180, '2012-02-20 21:01:43', '2012-02-20 21:01:43');
/*!40000 ALTER TABLE `tour` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table aiyouwei.tourist: ~6 rows (approximately)
/*!40000 ALTER TABLE `tourist` DISABLE KEYS */;
INSERT INTO `tourist` (`id`, `name`, `phone`, `card_type`, `card_number`, `card_photo`) VALUES
	(1, 'adsfs', '1221312', 'jmsfz', '1212121', '/files/tourist/card_photo/base//201202/20/0343cc0e.jpg'),
	(2, 'dsafasdfasdf', 'dsfasdfa', 'jmsfz', 'sdfasdfasd', '/files/tourist/card_photo/base//201202/20/2cb4da2a.jpg'),
	(3, '', '', 'jmsfz', '', ''),
	(4, '', '', 'jmsfz', '', ''),
	(5, '', '', 'jmsfz', '', ''),
	(6, '', '', 'jmsfz', '', '');
/*!40000 ALTER TABLE `tourist` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
