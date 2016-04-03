-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 01 2016 г., 17:13
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `piano`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_session` varchar(100) NOT NULL,
  `id_price` int(11) NOT NULL,
  `kol` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `id_session`, `id_price`, `kol`, `date`) VALUES
(1, '11b014cfe1cc9f5fc73424f280796a73', 68, 1, '2015-11-27 09:16:21'),
(2, '221569f96ac7a034a8acd18f38f6dff9', 123, 1, '2015-12-23 16:56:55');

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE IF NOT EXISTS `catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `nn` int(11) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `parent`, `nn`, `name_en`, `name_ru`, `title`, `desc`, `keywords`) VALUES
(23, 0, 1, 'antikvarnyie-pianino-i-royali', 'Антикварные пианино и рояли', 'Антикварные пианино и рояли', 'Антикварные пианино и рояли', 'Антикварные пианино и рояли'),
(24, 0, 5, 'pianino-(118-125-sm)', 'Пианино (118-125 см)', 'Пианино (118-125 см)', 'Пианино (118-125 см)', 'Пианино (118-125 см)'),
(25, 0, 9, 'kontsertnyie-pianino-(125-134-sm)', 'Концертные пианино (125-134 см)', 'Концертные пианино (125-134 см)', 'Концертные пианино (125-134 см)', 'Концертные пианино (125-134 см)'),
(26, 0, 13, 'kabinetnyie-royali-(148-160-sm)', 'Кабинетные рояли (148-160 см)', 'Кабинетные рояли (148-160 см)', 'Кабинетные рояли (148-160 см)', 'Кабинетные рояли (148-160 см)'),
(27, 0, 17, 'calonnyie-royali-(175-200-sm)', 'Cалонные рояли (175-200 см)', 'Cалонные рояли (175-200 см)', 'Cалонные рояли (175-200 см)', 'Cалонные рояли (175-200 см)'),
(28, 0, 21, 'kontsertnyie-royali-(210-308-sm)', 'Концертные рояли (210-308 см)', 'Концертные рояли (210-308 см)', 'Концертные рояли (210-308 см)', 'Концертные рояли (210-308 см)'),
(29, 0, 25, 'dizaynerskie-modeli', 'Дизайнерские модели', 'Дизайнерские модели', 'Дизайнерские модели', 'Дизайнерские модели'),
(30, 23, 2, 'dlya-obucheniya', 'Антикварные пианино и рояли для обучения', 'Антикварные пианино и рояли для обучения', 'Для обучения', 'Антикварные пианино и рояли для обучения'),
(31, 23, 3, 'dlya-professionalov', 'Антикварные пианино и рояли для профессионалов', 'Антикварные пианино и рояли для профессионалов', 'Для профессионалов', 'Антикварные пианино и рояли для профессионалов'),
(32, 23, 4, 'dlya-interera', 'Антикварные пианино и рояли для интерьера', 'Антикварные пианино и рояли для интерьера', 'Антикварные пианино и рояли для интерьера', 'Антикварные пианино и рояли для интерьера'),
(33, 24, 6, 'dlya-obucheniya', 'Пианино для обучения', 'Пианино для обучения', 'Для обучения', 'Пианино для обучения'),
(34, 24, 7, 'dlya-professionalov', 'Пианино для профессионалов', 'Пианино для профессионалов', 'Пианино для профессионалов', 'Пианино для профессионалов'),
(35, 24, 8, 'dlya-interera', 'Пианино для интерьера', 'Пианино для интерьера', 'Пианино для интерьера', 'Пианино для интерьера'),
(36, 25, 10, 'dlya-obucheniya', 'Концертные пианино для обучения', 'Концертные пианино для обучения', 'Концертные пианино для обучения', 'Концертные пианино для обучения'),
(37, 25, 11, 'dlya-professionalov', 'Концертные пианино для профессионалов', 'Концертные пианино для профессионалов', 'Концертные пианино для профессионалов', 'Концертные пианино для профессионалов'),
(38, 25, 12, 'dlya-interera', 'Концертные пианино для интерьера', 'Концертные пианино для интерьера', 'Концертные пианино для интерьера', 'Концертные пианино для интерьера'),
(39, 26, 14, 'dlya-obucheniya', 'Кабинетные рояли для обучения', 'Кабинетные рояли для обучения', 'Кабинетные рояли для обучения', 'Кабинетные рояли для обучения'),
(40, 26, 15, 'dlya-professionalov', 'Кабинетные рояли для профессионалов', 'Кабинетные рояли (148-160 см) для профессионалов', 'Кабинетные рояли (148-160 см) для профессионалов', 'Кабинетные рояли (148-160 см) для профессионалов'),
(41, 26, 16, 'dlya-interera', 'Кабинетные рояли для интерьера', 'Кабинетные рояли (148-160 см) для интерьера', 'Кабинетные рояли (148-160 см) для интерьера', 'Кабинетные рояли (148-160 см) для интерьера'),
(42, 27, 18, 'dlya-obucheniya', 'Салонные рояли для обучения', 'Салонные рояли для обучения', 'Салонные рояли для обучения', 'Салонные рояли для обучения'),
(43, 27, 19, 'dlya-professionalov', 'Салонные рояли для профессионалов', 'Салонные рояли для профессионалов', 'Салонные рояли для профессионалов', 'Салонные рояли для профессионалов'),
(44, 27, 20, 'dlya-interera', 'Салонные рояли для интерьера', 'Салонные рояли для интерьера', 'Салонные рояли для интерьера', 'Салонные рояли для интерьера'),
(45, 28, 22, 'dlya-obucheniya', 'Концертные рояли для обучения', 'Концертные рояли (210-308 см) для обучения', 'Концертные рояли (210-308 см) для обучения', 'Концертные рояли (210-308 см) для обучения'),
(46, 28, 23, 'dlya-professionalov', 'Концертные рояли для профессионалов', 'Концертные рояли (210-308 см) для профессионалов', 'Концертные рояли (210-308 см) для профессионалов', 'Концертные рояли (210-308 см) для профессионалов'),
(47, 28, 24, 'dlya-interera', 'Концертные рояли для интерьера', 'Концертные рояли (210-308 см) для интерьера', 'Концертные рояли (210-308 см) для интерьера', 'Концертные рояли (210-308 см) для интерьера'),
(48, 29, 26, 'dlya-obucheniya', 'Дизайнерские модели для обучения', 'Дизайнерские модели для обучения', 'Дизайнерские модели для обучения', 'Дизайнерские модели для обучения'),
(49, 29, 27, 'dlya-professionalov', 'Дизайнерские модели для профессионалов', 'Дизайнерские модели для профессионалов', 'Дизайнерские модели для профессионалов', 'Дизайнерские модели для профессионалов'),
(50, 29, 28, 'dlya-interera', 'Дизайнерские модели для интерьера', 'Дизайнерские модели для интерьера', 'Дизайнерские модели для интерьера', 'Дизайнерские модели для интерьера');

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `name`, `phone`, `email`) VALUES
(1, 'Иван', '89996126070', 'torredo@inbox.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `colors`
--

CREATE TABLE IF NOT EXISTS `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `colors`
--

INSERT INTO `colors` (`id`, `name`) VALUES
(2, 'Белый '),
(3, 'Черный'),
(4, 'Махогони'),
(5, 'Вишня'),
(6, 'Орех'),
(7, 'Черный (золотые и серебрянный вставки)'),
(8, 'Бубинга');

-- --------------------------------------------------------

--
-- Структура таблицы `factory`
--

CREATE TABLE IF NOT EXISTS `factory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_factory_type` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `factory`
--

INSERT INTO `factory` (`id`, `name`, `type_id`) VALUES
(1, 'AUGUST FOERSTER', 1),
(2, 'AUGUST FOERSTER', 2),
(3, 'BECHSTEIN', 2),
(4, 'BECHSTEIN', 1),
(5, 'C. BECHSTEIN', 2),
(6, 'C. BECHSTEIN', 1),
(7, 'BLUTHNER', 2),
(8, 'BLUTHNER', 1),
(9, 'IRMLER', 2),
(10, 'IRMLER', 1),
(11, 'FAZIOLI', 1),
(12, 'PETROF', 2),
(13, 'SAUTER', 1),
(14, 'SAUTER', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `install`
--

CREATE TABLE IF NOT EXISTS `install` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `site` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `install`
--

INSERT INTO `install` (`id`, `name`, `site`) VALUES
(1, 'PIANOS-CMS', 'http://cms-full.ru/');

-- --------------------------------------------------------

--
-- Структура таблицы `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_clients` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `form` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mailer`
--

CREATE TABLE IF NOT EXISTS `mailer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(233) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `mailer`
--

INSERT INTO `mailer` (`id`, `email`) VALUES
(1, 'torredo@inbox.ru'),
(2, 'autozipp@mail.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `models`
--

CREATE TABLE IF NOT EXISTS `models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `id_factory` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_models_factory` (`id_factory`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `models`
--

INSERT INTO `models` (`id`, `name`, `id_factory`) VALUES
(1, 'MODEL 125G', 2),
(2, 'MODEL 125', 2),
(3, 'MODEL 125F', 2),
(4, 'B 120 SELECT', 3),
(5, 'B 116 COMPACT', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `payment_config`
--

CREATE TABLE IF NOT EXISTS `payment_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `payment_config`
--

INSERT INTO `payment_config` (`id`, `type`, `active`) VALUES
(1, 'Я.Касса', 0),
(2, 'Робокасса', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `price`
--

CREATE TABLE IF NOT EXISTS `price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` int(11) NOT NULL COMMENT 'раздел',
  `factory_id` int(11) NOT NULL COMMENT 'Фабрика',
  `model_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `colors` varchar(1000) NOT NULL,
  `link` char(255) DEFAULT NULL,
  `name` char(50) DEFAULT NULL,
  `nomer` char(50) NOT NULL,
  `kol` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `title` char(100) NOT NULL,
  `description` char(100) NOT NULL,
  `keywords` char(100) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `img_title` char(100) NOT NULL,
  `img_alt` char(100) NOT NULL,
  `nn` int(11) NOT NULL,
  `best` int(11) NOT NULL,
  `hide` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_price_factory` (`factory_id`),
  KEY `FK_price_models` (`model_id`),
  KEY `FK_price_size` (`size_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `price`
--

INSERT INTO `price` (`id`, `section`, `factory_id`, `model_id`, `size_id`, `colors`, `link`, `name`, `nomer`, `kol`, `price`, `title`, `description`, `keywords`, `img`, `img_title`, `img_alt`, `nn`, `best`, `hide`) VALUES
(1, 30, 5, 3, 9, 'a:3:{i:0;s:1:"2";i:1;s:1:"4";i:2;s:1:"6";}', '', NULL, '', 0, '0.00', '', '', '', 'a:4:{i:0;s:17:"56fd34737b7b8.jpg";i:1;s:18:"56fd34737772c.jpeg";i:2;s:18:"56fd347379131.jpeg";i:3;s:18:"56fd34737a9fc.jpeg";}', '', '', 4, 0, 0),
(2, 30, 5, 3, 9, 'a:3:{i:0;s:1:"2";i:1;s:1:"4";i:2;s:1:"6";}', '', NULL, '', 0, '0.00', '', '', '', 'a:4:{i:0;s:17:"56fd3599b4c9f.jpg";i:1;s:18:"56fd3599ab1bc.jpeg";i:2;s:18:"56fd3599b1c41.jpeg";i:3;s:18:"56fd3599b35fd.jpeg";}', '', '', 5, 0, 0),
(3, 30, 7, 1, 9, 'a:4:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";}', 'www.link.com', NULL, '', 0, '0.00', '', '', '', 'a:4:{i:0;s:17:"56fd522d11204.jpg";i:1;s:18:"56fd522d0e808.jpeg";i:2;s:18:"56fd522d0f6a6.jpeg";i:3;s:18:"56fd522d106bd.jpeg";}', '', '', 2, 1, 0),
(4, 30, 7, 1, 9, 'a:5:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"6";}', 'www.link.com', NULL, '', 0, '0.00', '', '', '', 'a:4:{i:0;s:17:"56fd525d6b9c6.jpg";i:1;s:18:"56fd525d6926b.jpeg";i:2;s:18:"56fd525d6a20b.jpeg";i:3;s:18:"56fd525d6adf3.jpeg";}', '', '', 1, 1, 0),
(5, 31, 13, 2, 9, 'a:4:{i:0;s:1:"2";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"6";}', 'www.link.com', NULL, '', 0, '0.00', '', '', '', 'a:4:{i:0;s:17:"56fd54d59552c.jpg";i:1;s:18:"56fd54d592db9.jpeg";i:2;s:18:"56fd54d593a53.jpeg";i:3;s:18:"56fd54d59499f.jpeg";}', '', '', 7, 0, 0),
(6, 31, 13, 2, 9, 'a:4:{i:0;s:1:"2";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"6";}', 'www.link.com', NULL, '', 0, '0.00', '', '', '', 'a:1:{i:0;s:17:"56fd5501642f1.jpg";}', '', '', 8, 0, 0),
(9, 34, 5, 4, 9, 'a:3:{i:0;s:1:"2";i:1;s:1:"3";i:2;s:1:"4";}', '', NULL, '', 0, '0.00', '', '', '', 'a:3:{i:0;s:17:"56fd555e4cf10.jpg";i:1;s:18:"56fd555e4b5e2.jpeg";i:2;s:18:"56fd555e4c2ec.jpeg";}', '', '', 9, 0, 0),
(10, 30, 6, 1, 11, 'a:2:{i:0;s:1:"2";i:1;s:1:"3";}', '', NULL, '', 0, '0.00', '', '', '', 'a:4:{i:0;s:17:"56fe3091dc0b1.jpg";i:1;s:18:"56fe3091d5f1a.jpeg";i:2;s:18:"56fe3091d6c23.jpeg";i:3;s:18:"56fe3091d77cc.jpeg";}', '', '', 6, 0, 1),
(11, 30, 6, 2, 11, 'a:3:{i:0;s:1:"3";i:1;s:1:"4";i:2;s:1:"5";}', '', NULL, '', 0, '0.00', '', '', '', 'a:3:{i:0;s:17:"56fe30d7a44cc.jpg";i:1;s:18:"56fe30d7a245c.jpeg";i:2;s:18:"56fe30d7a32c1.jpeg";}', '', '', 3, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `robokassa_config`
--

CREATE TABLE IF NOT EXISTS `robokassa_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_payment` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `pass1` varchar(100) NOT NULL,
  `pass2` varchar(100) NOT NULL,
  `ResultUrl` varchar(200) NOT NULL,
  `method` varchar(4) NOT NULL,
  `SuccessUrl` varchar(200) NOT NULL,
  `FailUrl` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `robokassa_config`
--

INSERT INTO `robokassa_config` (`id`, `id_payment`, `login`, `pass1`, `pass2`, `ResultUrl`, `method`, `SuccessUrl`, `FailUrl`) VALUES
(1, 2, '', '', '', 'payment/rk/result.php', 'POST', 'payment/rk/success.php', 'payment/rk/fail.php');

-- --------------------------------------------------------

--
-- Структура таблицы `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `nn` int(11) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `section`
--

INSERT INTO `section` (`id`, `parent`, `nn`, `name_en`, `name_ru`) VALUES
(2, 0, 2, 'certificate', 'Сертификаты'),
(3, 0, 4, 'devilry', 'Оплата и доставка'),
(4, 0, 5, 'contact', 'Контакты'),
(5, 0, 1, 'home', 'Главная'),
(6, 0, 6, 'cart', 'Корзина'),
(7, 0, 3, 'references', 'Рекомендации');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(255) NOT NULL,
  `site` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email_osnovnoy` varchar(100) NOT NULL,
  `email_rasslka` varchar(100) NOT NULL,
  `soc_vk` varchar(200) NOT NULL,
  `soc_fb` varchar(200) NOT NULL,
  `soc_tw` varchar(200) NOT NULL,
  `soc_im` varchar(200) NOT NULL,
  `maps` varchar(500) NOT NULL,
  `eur` decimal(10,2) NOT NULL,
  `percent` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `company`, `site`, `phone`, `address`, `email_osnovnoy`, `email_rasslka`, `soc_vk`, `soc_fb`, `soc_tw`, `soc_im`, `maps`, `eur`, `percent`) VALUES
(1, 'PIANOS', 'pianos.ru', '+7(777) 777-77-77', 'г.Москва. ул.Тестовая 7/7', 'info@autozipp.ru', 'autozipp@mail.ru', '#', '#', '#', '#', '<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=_yvfBXGhr0X_kyiTtLVmBcke3kRLfAYi&width=100%&height=400&lang=ru_RU&sourceType=constructor"></script>', '81.00', '1.30');

-- --------------------------------------------------------

--
-- Структура таблицы `size`
--

CREATE TABLE IF NOT EXISTS `size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `length` int(4) DEFAULT NULL COMMENT 'длина рояля',
  `height` int(4) DEFAULT NULL COMMENT 'высота пианино',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `size`
--

INSERT INTO `size` (`id`, `length`, `height`) VALUES
(8, 148, NULL),
(9, NULL, 150),
(10, 160, NULL),
(11, 175, NULL),
(12, 188, NULL),
(13, 190, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `status-zakaz`
--

CREATE TABLE IF NOT EXISTS `status-zakaz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `color` varchar(30) NOT NULL,
  `default` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `status-zakaz`
--

INSERT INTO `status-zakaz` (`id`, `name`, `color`, `default`) VALUES
(1, 'Заказано', 'warning', 1),
(2, 'В работе', 'success', 0),
(3, 'В резерве', 'primary', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'РОЯЛЬ'),
(2, 'ПИАНИНО');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `company` varchar(20) NOT NULL,
  `img` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `status`, `name`, `email`, `phone`, `company`, `img`) VALUES
(2, 'admin', '262bf10fb530b2e6188583609a7d7811', '559ecd5c696cb', 'admin', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `ym_config`
--

CREATE TABLE IF NOT EXISTS `ym_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_payment` int(11) NOT NULL,
  `shopId` varchar(20) NOT NULL,
  `scId_test` varchar(100) NOT NULL,
  `scId` varchar(20) NOT NULL,
  `ShopPassword` varchar(100) NOT NULL,
  `checkURL` varchar(200) NOT NULL,
  `avisoURL` varchar(200) NOT NULL,
  `checkURL_test` varchar(200) NOT NULL,
  `avisoURL_test` varchar(200) NOT NULL,
  `successURL` varchar(200) NOT NULL,
  `failURL` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `ym_config`
--

INSERT INTO `ym_config` (`id`, `id_payment`, `shopId`, `scId_test`, `scId`, `ShopPassword`, `checkURL`, `avisoURL`, `checkURL_test`, `avisoURL_test`, `successURL`, `failURL`) VALUES
(1, 1, '', '', '', '', 'payment/ym/checkorder.php', 'payment/ym/paymentaviso.php', 'payment/ym-test/checkorder.php', 'payment/ym-test/paymentaviso.php', 'payment/ym/successurl.php', 'payment/ym/failurl.php');

-- --------------------------------------------------------

--
-- Структура таблицы `zakaz`
--

CREATE TABLE IF NOT EXISTS `zakaz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_clients` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `id_price` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `factory`
--
ALTER TABLE `factory`
  ADD CONSTRAINT `FK_factory_type` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Ограничения внешнего ключа таблицы `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `FK_models_factory` FOREIGN KEY (`id_factory`) REFERENCES `factory` (`id`);

--
-- Ограничения внешнего ключа таблицы `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `FK_price_factory` FOREIGN KEY (`factory_id`) REFERENCES `factory` (`id`),
  ADD CONSTRAINT `FK_price_models` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`),
  ADD CONSTRAINT `FK_price_size` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
