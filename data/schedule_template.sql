-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.18-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4073
-- Date/time:                    2012-03-28 09:44:52
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;
-- Dumping data for table aiyouwei.schedule_template: ~4 rows (approximately)
DELETE FROM `schedule_template`;
/*!40000 ALTER TABLE `schedule_template` DISABLE KEYS */;
INSERT INTO `schedule_template` (`id`, `cate_id`, `name`, `code`, `content`, `memo`) VALUES
	(1, 1, '鲁朗3日', 'A1', 'D1，拉萨→巴松错→八一，沿途尼洋河，住八一\r\n D2，八一→鲁朗→八一，鲁朗林海、牧场、石锅鸡、色季拉山观南迦巴瓦，住八一\r\n D3，八一→拉萨\r\n', ''),
	(2, 1, '然乌4日', 'A4A', 'D1，拉萨→巴松错→八一\r\n D2，八一→鲁朗→波密→米堆冰川→然乌，住然乌，五日的话这天拆为两天，第一天住波密，第二天住然乌\r\n D3，然乌→八一，下午鲁朗石锅鸡，住八一\r\n D4，八一→拉萨\r\n ', ''),
	(3, 2, '珠峰+纳木错5日（需要办理边防证）', 'B2', 'D1，拉萨→羊湖→江孜→日喀则\r\n D2，日喀则→定日→珠峰\r\n D3，珠峰→日喀则\r\n D4，日喀则→大竹卡→纳木错\r\n D5，纳木错→羊八井→拉萨\r\n D6，拉萨→羊八井→拉萨', '');
/*!40000 ALTER TABLE `schedule_template` ENABLE KEYS */;

-- Dumping data for table aiyouwei.schedule_template_cate: ~4 rows (approximately)
DELETE FROM `schedule_template_cate`;
/*!40000 ALTER TABLE `schedule_template_cate` DISABLE KEYS */;
INSERT INTO `schedule_template_cate` (`id`, `name`, `description`) VALUES
	(1, 'A线：林芝方向', '2-5天，暂有6种玩法可供参考。'),
	(2, 'B线：日喀则、珠峰方向', '2-5天，暂有4种玩法可供参考。'),
	(3, 'C线：山南方向，含亚东', '2-4天，暂有3种玩法可供参考。');
/*!40000 ALTER TABLE `schedule_template_cate` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
