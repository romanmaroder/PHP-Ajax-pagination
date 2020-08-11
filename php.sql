CREATE DATABASE IF NOT EXISTS `pagination` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pagination`;

-- --------------------------------------------------------

--
-- Структура таблицы `guest_book`
--

CREATE TABLE IF NOT EXISTS `guest_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
COMMIT;

