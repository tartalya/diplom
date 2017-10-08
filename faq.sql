-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: diplom
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB-0+deb9u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `diplom`
--

-- CREATE DATABASE /*!32312 IF NOT EXISTS*/ `diplom` /*!40100 DEFAULT CHARACTER SET utf8 */;

-- USE `diplom`;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Телефоны','2017-09-21 07:24:04','0000-00-00 00:00:00'),(2,'Телевизоры','2017-09-21 07:24:04','0000-00-00 00:00:00'),(3,'Игровые приставки','2017-09-21 07:24:04','0000-00-00 00:00:00'),(4,'Аудиотехника','2017-10-05 09:25:19','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `questioner_name` varchar(50) NOT NULL,
  `questioner_email` varchar(50) NOT NULL,
  `question` text NOT NULL,
  `answer` text,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (2,'2017-09-13 10:45:36',2,2,'saha','admin@perchina.ru','Какие телевизоры бывают ?','Аналоговые и цифровые\r\nАналоговые — самый распространенный тип. Они доступны по цене большинству покупателей. Это их главное преимущество. В аналоговых типах нет четкого распределения пикселей по экрану. Потому качество изображения напрямую зависит от мощности сигнала. Стоит отметить, что большинство телеканалов вещает в нецифровых форматах. А раз большая часть аналоговых телевизоров мультисистемны, то они могут поддержать многие существующие аналоговые форматы.\r\n\r\nКачество «картинки» в цифровых же очень хорошее. Сигнал в них передается в виде условного кода (0 и 1). Именно поэтому, четкость изображение на цифровых эранах не зависит ни от мощности сигнала, ни от помех. Сигнал передается либо полностью, либо совсем не передается.\r\n\r\nФормат экрана или соотношение сторон\r\n\r\nСоотношение сторон обычного телевизора отличается от соотношения сторон экрана кинотеатра. В большинстве (кроме широкоформатных) формат 4:3 (ширина: высота). В кинотеатрах и дорогих цифровых — 16:9. Широкоформатное изображение не соответствует 4:3 и наоборот. Поэтому изображение при необходимости либо растягивается, либо обрезается, либо дополняется черными рамками. Для что посмотреть широкоформатный фильм хорошего качества лучше всего подойдет экран формата 16:9.\r\n\r\nТипы ТВ:\r\n\r\n\r\nЭЛТ\r\nПожалуй, самый бюджетный вариант. Это простые кинескопны, которые без дополнительных конвертов не могут принимать цифровой сигнал. Экраны у них в зависимости от цены модели могут быть плоскими, суперплоскими. Изображение на них почти не искривляется.\r\n\r\nLCD или ЖК\r\nТелевизоры Sony Bravia LCD\r\n\r\n \r\nТелевизоры Sony Bravia LCD\r\nЦенность LCD — тонкая панель. Даже при больших размерах экрана, толщина панели настолько мала, что телевизор можно повесить на стену. В производстве есть и аналоговые, и цифровые ЖК.','2017-10-05 08:40:39','0000-00-00 00:00:00'),(3,'2017-09-13 10:52:29',1,2,'saha','saha@kalopsia.ru','Что такое смартфон ?','Смартфо́н (англ. smartphone — умный телефон) — мобильный телефон, дополненный функциональностью карманного персонального компьютера.\r\n\r\nТакже коммуникатор (англ. communicator, PDA phone) — карманный персональный компьютер, дополненный функциональностью мобильного телефона.\r\n\r\nХотя в мобильных телефонах практически всегда были дополнительные функции (калькулятор, календарь), со временем выпускались все более и более интеллектуальные модели, для подчеркивания возросшей функциональности и вычислительной мощности таких моделей ввели термин «смартфон». В эру роста популярности КПК — они стали выпускаться с функциями мобильного телефона, такие устройства были названы коммуникаторами. В настоящее время разделение на смартфоны и коммуникаторы не актуально, оба термина обозначают одно и то же.[почему?]\r\n\r\nСмартфоны отличаются от обычных мобильных телефонов наличием достаточно развитой операционной системы, открытой для разработки программного обеспечения сторонними разработчиками (операционная система обычных мобильных телефонов закрыта для сторонних разработчиков). Установка дополнительных приложений позволяет значительно улучшить функциональность смартфонов по сравнению с обычными мобильными телефонами.\r\n\r\nОднако в последнее время граница между «обычными» телефонами и смартфонами всё больше стирается, новые телефоны (за исключением самых дешёвых моделей) давно обзавелись функциональностью, некогда присущей только смартфонам, например, электронной почтой и HTML-браузером, а также многозадачностью[1].','2017-10-05 10:37:04','0000-00-00 00:00:00'),(4,'2017-09-13 10:54:31',3,3,'saha','alina@kabaeva.ru','Что такое игровая приставка ?','Игрова́я приста́вка (игровая консоль) — специализированное электронное устройство, предназначенное для видеоигр. Для таких устройств, в отличие от персональных компьютеров, запуск и воспроизведение видеоигр является основной задачей. Домашние игровые приставки используют телевизор, проектор или компьютерный монитор в качестве независимого устройства отображения. Портативные (карманные) игровые системы имеют собственное встроенное устройство отображения (ни к чему не приставляются), поэтому называть их игровыми приставками несколько некорректно.\r\n\r\nИзначально игровые приставки отличались от персональных компьютеров по ряду важных признаков — они предполагали использование телевизора в качестве основного отображающего устройства и не поддерживали большинство из стандартных периферийных устройств, созданных для персональных компьютеров — таких как клавиатура или модем. До недавнего времени почти все продаваемые приставки предназначались для запуска собственнических игр, распространяемых на условиях отсутствия поддержки других приставок. Схемы и программное обеспечение некоторых приставок могут распространяться, в виде исключения, под свободными лицензиями.\r\n\r\nРынок игровых приставок развился из сравнительно простых электронных телевизионных игровых систем, таких как Pong, превратившись в наши дни в мощные многофункциональные игровые системы.','0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'2017-09-13 10:58:38',4,3,'saha','hoho@audio.ru','Что такое аудиосистема ?','Аудиосистема – это электронное устройство или несколько устройств, предназначенных для преобразования аналогового или цифрового сигнала в акустические волны (звук). Источником исходного сигнала в данном случае может быть также любое электронное устройство.\r\n\r\nКак правило, аудиосистема состоит из преобразователя и усилителя исходного сигнала, акустической системы и соединительных проводов (электрических кабелей). Однако выпускаются аудиосистемы, которые для передачи и приема сигнала используют беспроводные сети, например радиоканал Bluetooth.\r\n\r\nПреобразователь\r\n\r\nВ роли преобразователя, а не редко и усилителя сигнала может выступать магнитола, проигрыватель компакт-дисков, mp3-плеер, тюнер (радиоприемник) и другие устройства. Преобразователь предназначен для приема сигнала извне и передачу его на усилитель.\r\n\r\nУсилитель\r\n\r\nУсилитель сигнала в аудиосистеме может быть совмещен с преобразователем, а может представлять собой и отдельное электронное устройство. Усилитель имеет вход сигнала и выход или несколько выходов, если к нему подключается многоканальная акустика. Задача усилителя принять относительно слабый по амплитуде сигнал, усилить его до требуемого уровня и передать на акустику.\r\n\r\nАкустика\r\n\r\nАкустика в аудиосистеме представляет собой набор активных или пассивных звуковых излучателей (громкоговорителей, динамиков). Их задача преобразовать электрический сигнал в звуковые волны. Активные динамики помимо самых звукоизлучающих головок имеют собственные усилители сигнала.\r\n\r\nОтдельный излучатель может быть как широкополосным (способным воспроизводить звуковые волны во всем спектре слышимых человеческим ухом частот), так и узкополосным. Узкополосные излучатели разделяются на низкочастотные (НЧ) – воспроизводят звук на частоте 20 – 60 Гц; низко-среднечастотные (НЧ/СЧ) – 60 – 200 Гц; среднечастотные (СЧ) – 200 – 4000 Гц и высокочастотные (ВЧ) – 4000 – 20000 Гц.','0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,'2017-09-15 09:33:24',1,3,'saha','saha@kalopsia.ru','Как организована многозадачность в андроид','Приложения для Android состоят из нескольких компонентов. Выделяют четыре типа компонентов: Activities, Services, Broadcast receivers и Content providers. \r\nActivities представляют собой графический пользовательский интерфейс для определенной задачи. К примеру, приложение для SMS может иметь одно activity для вывода списка контактов, одно для создания сообщения и т.д. Activity может находиться в одном из трех состояний: \r\n1. Active или running – в этом состоянии он находится на переднем плане и взаимодействует с пользователем; \r\n2. Paused – находится на втором плане, но виден пользователю, например, частично перекрыт новым activity; \r\n3. Stopped – полностью перекрыт другим activity. Но он по-прежнему сохраняет своё состояние, хотя и полностью скрыт от пользователя. \r\n\r\nВ состояниях Paused и Stopped – activity может быть выгружен из памяти. Может возникнуть ситуация, когда пользователь, возвращаясь к выгруженному activity, хотел бы его увидеть в том состоянии, в котором его оставил. Это возможно, если перед выгрузкой activity вызвать метод onSaveInstanceState(), а во время восстановления или создания activity вызвать метод onRestoreInstanceState(). В этом случае возможно сохранение текущего (на момент выгрузки) состояния activity. Здесь можно провести аналогию с режимом гибернации в ОС для ПК.','0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,'2017-09-18 15:04:40',2,3,'Александр Корчагин','brutal4028@gmail.com','Что выбрать: ЖК или плазменный телевизор?','ЖК и плазмы воспроизводят разные типы изображения. Вообще говоря, считается что ЖК дисплеи, как правило, представляют более четкое, яркое и насыщенное изображение, а плазменным присуща более богатая и естественная картинка с глубокими уровнями черного. Серьезные продавцы должны предоставить покупателю возможность выбора с демонстрацией разных моделей.','2017-09-25 13:17:17','0000-00-00 00:00:00'),(15,'2017-09-19 15:40:20',4,3,'Александр Корчагин','brutal4028@gmail.com','Что такое динамический микрофон','Динамический (электродинамический) микрофон — микрофон, сходный по конструкции с динамическим громкоговорителем. Он представляет собой мембрану, соединённую с проводником, который помещен в сильное магнитное поле, создаваемое постоянным магнитом. Колебания давления воздуха (звук) воздействуют на мембрану и приводят в движение проводник. Когда проводник пересекает силовые линии магнитного поля, в нём наводится ЭДС индукции. ЭДС индукции пропорциональна как амплитуде колебаний мембраны, так и частоте колебаний.\r\n\r\nВ отличие от конденсаторных, динамические микрофоны не требуют фантомного питания.','0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,'2017-10-05 13:23:16',2,1,'Александр Корчагин','brutal4028@gmail.com','Что такое HDMI',NULL,'2017-10-05 10:23:18','2017-10-05 13:23:18');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuses`
--

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` VALUES (1,'ожидает ответа'),(2,'скрыт'),(3,'опубликован');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Администратор','admin','saha@kalopsia.ru','$2a$04$a7T.7SJvhqgwppXsLfx67uEgmRCbuSLvlA1tgy/r0y0HNp/nfVZTK','TKOGfQMUMgbrjS9dApMlLzD4xUeM3eYrghPpyne70uboN2jTqrjMdpGmFRL6','2017-10-05 09:14:29','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-08 19:48:32
