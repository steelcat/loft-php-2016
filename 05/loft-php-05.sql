-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.48 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица loft-php-05.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users` (`user_id`),
  CONSTRAINT `fk_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы loft-php-05.images: ~9 rows (приблизительно)
DELETE FROM `images`;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`id`, `user_id`, `image`) VALUES
	(17, 2, '2-5835efba5bd3c-1479929786.jpg'),
	(18, 2, '2-5835f014e7468-1479929876.jpg'),
	(19, 2, '2-5835f0410e1e3-1479929921.jpg'),
	(20, 2, '2-5835f1f365b9f-1479930355.png'),
	(21, 2, '2-5835f1fab23ea-1479930362.jpg'),
	(22, 2, '2-5835f305331b3-1479930629.jpg'),
	(23, 1, '1-5835f32c47abf-1479930668.jpg'),
	(24, 5, '5-5835f35770504-1479930711.jpg'),
	(25, 2, '2-58372e36bd8d6-1480011318.jpg');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;


-- Дамп структуры для таблица loft-php-05.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `age` int(10) unsigned DEFAULT NULL,
  `about` text,
  `avatar` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы loft-php-05.users: ~6 rows (приблизительно)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `password`, `name`, `age`, `about`, `avatar`) VALUES
	(1, 'new', 'newnew', '1234', 34, 'ываыва', '1-5835f32c47abf-1479930668.jpg'),
	(2, 'test', 'test', 'Толян', 43, 'цукцук', '2-58372e36bd8d6-1480011318.jpg'),
	(3, 'steel', 'steel', NULL, NULL, NULL, NULL),
	(4, 'set', 'set', NULL, NULL, NULL, NULL),
	(5, 'bam', 'bam', 'Еуые', 45, 'укеукеуке', '5-5835f35770504-1479930711.jpg'),
	(6, 'иуые', 'ропорыва', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
