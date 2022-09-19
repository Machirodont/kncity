-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.0.22 - MySQL Community Server - GPL
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Дамп структуры для таблица kncity.api_users
CREATE TABLE IF NOT EXISTS `api_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `api_users` DISABLE KEYS */;
INSERT IGNORE INTO `api_users` (`id`, `username`, `password_hash`) VALUES
	(1, 'user', '$2y$10$klk9OoYLCK9RT0wxkG5s8unML6GuAELWPXJJ7j7s4Z8pb7qMlKuGq');
/*!40000 ALTER TABLE `api_users` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `test_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT IGNORE INTO `students` (`id`, `name`, `test_name`) VALUES
	(1, 'student1', 'test1'),
	(2, 'student2', 'test2'),
	(3, 'student3', 'test1'),
	(4, 'student4', 'test2'),
	(5, 'student5', 'test1'),
	(6, 'student6', 'test2'),
	(7, 'student7', 'test1'),
	(8, 'student8', 'test2'),
	(9, 'student9', 'test1'),
	(10, 'student10', 'test'),
	(11, 'student11', 'test'),
	(12, 'student12', 'test'),
	(13, 'student13', 'test'),
	(14, 'student14', 'test'),
	(15, 'student15', 'test'),
	(16, 'student', 'test'),
	(17, 'student', 'test'),
	(18, 'student', 'test'),
	(19, 'student', 'test'),
	(20, 'student', 'test'),
	(21, 'student', 'test'),
	(22, 'student', 'test'),
	(23, 'student', 'test'),
	(24, 'student', 'test'),
	(25, 'student', 'test'),
	(26, 'student', 'test'),
	(27, 'student', 'test'),
	(28, 'student', 'test'),
	(29, 'student', 'test'),
	(30, 'student', 'test'),
	(31, 'student', 'test'),
	(32, 'student', 'test'),
	(33, 'student', 'test'),
	(34, 'student', 'test'),
	(35, 'student', 'test'),
	(36, 'student', 'test'),
	(37, 'student', 'test'),
	(38, 'student', 'test'),
	(39, 'student', 'test'),
	(40, 'student', 'test'),
	(41, 'student', 'test'),
	(42, 'student', 'test'),
	(43, 'student', 'test'),
	(44, 'student', 'test'),
	(45, 'student', 'test'),
	(46, 'student', 'test'),
	(47, 'student', 'test'),
	(48, 'student', 'test'),
	(49, 'student', 'test'),
	(50, 'student', 'test'),
	(51, 'student', 'test'),
	(52, 'student', 'test'),
	(53, 'student', 'test'),
	(54, 'student', 'test'),
	(55, 'student', 'test'),
	(56, 'student', 'test'),
	(57, 'student', 'test'),
	(58, 'student', 'test'),
	(59, 'student', 'test');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

-- Дамп структуры для таблица kncity.user_sessions
CREATE TABLE IF NOT EXISTS `user_sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `auth_token` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `logout` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `auth_token` (`auth_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
