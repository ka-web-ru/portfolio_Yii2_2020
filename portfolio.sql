-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.29 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.0.0.5958
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица portfolio.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы portfolio.migration: ~3 rows (приблизительно)
DELETE FROM `migration`;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1599392000),
	('m130524_201442_init', 1599392007),
	('m190124_110200_add_verification_token_column_to_user_table', 1599392008);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Дамп структуры для таблица portfolio.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы portfolio.user: ~4 rows (приблизительно)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
	(1, 'admin', '7ClWcEWzgTMEVfSM8p6V29DPYM1jCWwi', '$2y$13$9f0ksLFFs./Q1h9oJsto9.f9zOa/Dzy1kCGoHp2iqktDi.N51gqP.', NULL, 'it@zauralkurort.ru', 9, 1599392474, 1599392474, 'viUODrTFifqkQkHfRqTu8TH1d4HfLwdJ_1599392474'),
	(2, 'admin2', 'Ws4eBvfnMEvq9K2LYPjLoUkm_ooZbjfT', '$2y$13$aJf49a3ss.VGJ.pNsmL4k.TYdUZeQZdEcc3XvpUVsp3KX/A81OH3m', NULL, 'kalinin-av2016@yandex.ru', 10, 1599392767, 1599392767, 'EfJvH0z_Wj4QtC1ltrN-smwDejyRll60_1599392767'),
	(3, 'user', '5BTIP8HV7ykya8ScQ50vwBOVXJ96i4Cq', '$2y$13$n.F48VDIaJmVbYbOFZwmIOnsandlmG/gQX0ldgn7P1flVNMC7K8cy', NULL, 'it1@zauralkurort.ru', 9, 1599452004, 1599452004, 'DvMay0GTCEXAvUxcpqWQlvi0JmiF0W04_1599452004'),
	(4, 'user1', 'TrVNCqOQbotReOyQjav5W-RQ8GxUvBlZ', '$2y$13$Ui646cxW6kJ8GNzPssNtqurHKwjgbl4hDuNiEtMYHbUI9w4cOhJ5W', NULL, 'it2@zauralkurort.ru', 9, 1599452928, 1599452928, 'iZpOjiT0puoVEbv9F_Eerdfb2zSgGIbx_1599452928');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
