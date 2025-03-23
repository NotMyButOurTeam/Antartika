/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.7.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: Antartika
-- ------------------------------------------------------
-- Server version	11.7.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `Account`
--

DROP TABLE IF EXISTS `Account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Account` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `privilege` int(2) NOT NULL,
  `name` varchar(32) NOT NULL,
  `email` varchar(48) NOT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Account`
--

LOCK TABLES `Account` WRITE;
/*!40000 ALTER TABLE `Account` DISABLE KEYS */;
INSERT INTO `Account` VALUES
(1,0,'Shawn \"Diddy\" Putra Hamza','diddy@baby.oil',NULL,'FazaLoveBabyOil'),
(2,1,'PencintaLoli','arafazkha@gmai.com',NULL,'KuSukaLoli'),
(3,2,'KickOrg','kickorg@kick.org',NULL,'KickAss'),
(4,1,'Lalu Diddy Putra Aziz','ditra@gmail.com',NULL,'123');
/*!40000 ALTER TABLE `Account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `App`
--

DROP TABLE IF EXISTS `App`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `App` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `published` datetime NOT NULL,
  `publisher` int(32) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `description` text DEFAULT NULL,
  `category` int(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `publisher` (`publisher`),
  CONSTRAINT `App_ibfk_1` FOREIGN KEY (`publisher`) REFERENCES `Account` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `App`
--

LOCK TABLES `App` WRITE;
/*!40000 ALTER TABLE `App` DISABLE KEYS */;
INSERT INTO `App` VALUES
(1,'2025-03-22 06:22:22',1,NULL,'LibreOffice','LibreOffice is a private, free and open source office suite – the successor project to OpenOffice.\nIt\'s compatible with Microsoft Office/365 files (.doc, .docx, .xls, .xlsx, .ppt, .pptx) and is backed by a non-profit organisation.',0),
(2,'2025-03-22 06:23:45',1,NULL,'GIMP',' GIMP is a cross-platform image editor available for GNU/Linux, macOS, Windows and more operating systems. It is free software, you can change its source code and distribute your changes.\n\nWhether you are a graphic designer, photographer, illustrator, or scientist, GIMP provides you with sophisticated tools to get your job done. You can further enhance your productivity with GIMP thanks to many customization options and 3rd party plugins.',0),
(3,'2025-03-22 06:25:30',1,NULL,'Krita','Krita is a professional FREE and open source painting program. It is made by artists that want to see affordable art tools for everyone.',0),
(4,'2025-03-22 06:29:03',1,NULL,'Kdenlive','Kdenlive is an acronym for KDE Non-Linear Video Editor. It works on GNU/Linux, Windows and BSD.\nKdenlive is a Free and Open Source video editing application, based on MLT Framework and KDE Frameworks 6. It is distributed under the GNU General Public License Version 3 or any later version that is accepted by the KDE project.',0),
(5,'2025-03-22 06:30:32',1,NULL,'OpenToonz','Based on the software \"Toonz\", developed by Digital Video S.p.A. in Italy, OpenToonz has been customized by Studio Ghibli, and used for the creation of its works for many years. Dwango has launched the OpenToonz project in cooperation with Digital Video and Studio Ghibli.',0),
(6,'2025-03-22 06:34:20',1,NULL,'Blender','Blender is a free and open-source 3D computer graphics software tool set that runs on Windows, macOS, BSD, Haiku, IRIX and Linux. It is used for creating animated films, visual effects, art, 3D-printed models, motion graphics, interactive 3D applications, and virtual reality. It is also used in creating video games.',0),
(7,'2025-03-22 06:40:04',1,NULL,'Wicked Engine','Wicked Engine is an open-source 3D engine with modern graphics. Use this as a C++ framework for your graphics projects, a standalone 3D editor, LUA scripting or just for learning.',0),
(8,'2025-03-22 06:43:07',1,NULL,'Godot','Godot Engine, the free and open source community-driven 2D and 3D game engine!\nGodot Engine is a feature-packed, cross-platform game engine to create 2D and 3D games from a unified interface. It provides a comprehensive set of common tools, so that users can focus on making games without having to reinvent the wheel. Games can be exported with one click to a number of platforms, including the major desktop platforms (Linux, macOS, Windows), mobile platforms (Android, iOS), as well as Web-based platforms and consoles.\nGodot is completely free and open source under the permissive MIT license. No strings attached, no royalties, nothing. Users\' games are theirs, down to the last line of engine code. Godot\'s development is fully independent and community-driven, empowering users to help shape their engine to match their expectations. It is supported by the Godot Foundation not-for-profit.',0),
(9,'2025-03-22 06:45:18',1,NULL,'OBS Studio','Free and open source software for video recording and live streaming.',0),
(10,'2025-03-23 03:31:57',2,NULL,'LMMS','LMMS is a digital audio workstation application program. It allows music to be produced by arranging samples, synthesizing sounds, entering notes via computer keyboard or mouse or by playing on a MIDI keyboard, and combining the features of trackers and sequencers.',0),
(11,'2025-03-23 03:36:51',2,NULL,'OnlyOffice','OnlyOffice (formerly TeamLab), stylized as ONLYOFFICE, is a free software office suite and ecosystem of collaborative applications. It consists of online editors for text documents, spreadsheets, presentations, forms and PDFs, and the room-based collaborative platform. ',6),
(12,'2025-03-23 03:45:09',2,NULL,'Firefox','Mozilla Firefox, or simply Firefox, is a free and open source web browser developed by the Mozilla Foundation and its subsidiary, the Mozilla Corporation. It uses the Gecko rendering engine to display web pages, which implements current and anticipated web standards.',5),
(13,'2025-03-23 03:46:30',2,NULL,'Spotify','Spotify is a Swedish audio streaming and media service provider founded on 23 April 2006 by Daniel Ek and Martin Lorentzon. As of December 2024, it is one of the largest providers of music streaming services, with over 675 million monthly active users comprising 263 million paying subscribers.',0);
/*!40000 ALTER TABLE `App` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AppBanner`
--

DROP TABLE IF EXISTS `AppBanner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `AppBanner` (
  `app` int(32) NOT NULL,
  `src` varchar(128) NOT NULL,
  KEY `app` (`app`),
  CONSTRAINT `AppBanner_ibfk_1` FOREIGN KEY (`app`) REFERENCES `App` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AppBanner`
--

LOCK TABLES `AppBanner` WRITE;
/*!40000 ALTER TABLE `AppBanner` DISABLE KEYS */;
/*!40000 ALTER TABLE `AppBanner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AppReview`
--

DROP TABLE IF EXISTS `AppReview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `AppReview` (
  `reviewer` int(32) NOT NULL,
  `reviewed` int(32) NOT NULL,
  `published` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `rating` int(3) NOT NULL,
  `content` text DEFAULT NULL,
  KEY `commenter` (`reviewer`),
  KEY `commented` (`reviewed`),
  CONSTRAINT `AppReview_ibfk_1` FOREIGN KEY (`reviewer`) REFERENCES `Account` (`id`),
  CONSTRAINT `AppReview_ibfk_2` FOREIGN KEY (`reviewed`) REFERENCES `App` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AppReview`
--

LOCK TABLES `AppReview` WRITE;
/*!40000 ALTER TABLE `AppReview` DISABLE KEYS */;
/*!40000 ALTER TABLE `AppReview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AppSource`
--

DROP TABLE IF EXISTS `AppSource`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `AppSource` (
  `app` int(32) NOT NULL,
  `target` int(3) NOT NULL,
  `title` varchar(128) NOT NULL,
  `link` varchar(128) NOT NULL,
  KEY `app` (`app`),
  CONSTRAINT `AppSource_ibfk_1` FOREIGN KEY (`app`) REFERENCES `App` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AppSource`
--

LOCK TABLES `AppSource` WRITE;
/*!40000 ALTER TABLE `AppSource` DISABLE KEYS */;
/*!40000 ALTER TABLE `AppSource` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-03-23 14:18:42
