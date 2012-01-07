# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.5.18-log
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2012-01-07 13:54:42
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

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

# Dumping data for table test.todo: ~0 rows (approximately)
/*!40000 ALTER TABLE `todo` DISABLE KEYS */;
/*!40000 ALTER TABLE `todo` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
