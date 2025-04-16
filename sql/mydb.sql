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
-- Table structure for table `Application`
--

DROP TABLE IF EXISTS `Application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Application` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `publisher` int(32) NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `publisher` (`publisher`),
  CONSTRAINT `Application_ibfk_1` FOREIGN KEY (`publisher`) REFERENCES `Publisher` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Application`
--

LOCK TABLES `Application` WRITE;
/*!40000 ALTER TABLE `Application` DISABLE KEYS */;
INSERT INTO `Application` VALUES
(1,1,'Godot','Godot is a fast and lightweight game engine capable of creating 2d and 3d game. Godot is open source software so you are able to tweak it as you please.');
/*!40000 ALTER TABLE `Application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ApplicationPreview`
--

DROP TABLE IF EXISTS `ApplicationPreview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ApplicationPreview` (
  `app` int(32) NOT NULL,
  `preview` int(32) NOT NULL,
  KEY `app` (`app`),
  KEY `preview` (`preview`),
  CONSTRAINT `ApplicationPreview_ibfk_1` FOREIGN KEY (`app`) REFERENCES `Application` (`id`),
  CONSTRAINT `ApplicationPreview_ibfk_2` FOREIGN KEY (`preview`) REFERENCES `Preview` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ApplicationPreview`
--

LOCK TABLES `ApplicationPreview` WRITE;
/*!40000 ALTER TABLE `ApplicationPreview` DISABLE KEYS */;
INSERT INTO `ApplicationPreview` VALUES
(1,1),
(1,2),
(1,3),
(1,4);
/*!40000 ALTER TABLE `ApplicationPreview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ApplicationReview`
--

DROP TABLE IF EXISTS `ApplicationReview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ApplicationReview` (
  `app` int(32) NOT NULL,
  `review` int(32) NOT NULL,
  KEY `app` (`app`),
  KEY `review` (`review`),
  CONSTRAINT `ApplicationReview_ibfk_1` FOREIGN KEY (`app`) REFERENCES `Application` (`id`),
  CONSTRAINT `ApplicationReview_ibfk_2` FOREIGN KEY (`review`) REFERENCES `Review` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ApplicationReview`
--

LOCK TABLES `ApplicationReview` WRITE;
/*!40000 ALTER TABLE `ApplicationReview` DISABLE KEYS */;
/*!40000 ALTER TABLE `ApplicationReview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ApplicationTag`
--

DROP TABLE IF EXISTS `ApplicationTag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ApplicationTag` (
  `app` int(32) NOT NULL,
  `tag` int(32) NOT NULL,
  KEY `app` (`app`),
  KEY `tag` (`tag`),
  CONSTRAINT `ApplicationTag_ibfk_1` FOREIGN KEY (`app`) REFERENCES `Application` (`id`),
  CONSTRAINT `ApplicationTag_ibfk_2` FOREIGN KEY (`tag`) REFERENCES `Tag` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ApplicationTag`
--

LOCK TABLES `ApplicationTag` WRITE;
/*!40000 ALTER TABLE `ApplicationTag` DISABLE KEYS */;
/*!40000 ALTER TABLE `ApplicationTag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ApplicationVerification`
--

DROP TABLE IF EXISTS `ApplicationVerification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ApplicationVerification` (
  `app` int(32) NOT NULL,
  `moderator` int(32) DEFAULT NULL,
  KEY `app` (`app`),
  KEY `moderator` (`moderator`),
  CONSTRAINT `ApplicationVerification_ibfk_1` FOREIGN KEY (`app`) REFERENCES `Application` (`id`),
  CONSTRAINT `ApplicationVerification_ibfk_2` FOREIGN KEY (`moderator`) REFERENCES `Moderator` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ApplicationVerification`
--

LOCK TABLES `ApplicationVerification` WRITE;
/*!40000 ALTER TABLE `ApplicationVerification` DISABLE KEYS */;
/*!40000 ALTER TABLE `ApplicationVerification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Moderator`
--

DROP TABLE IF EXISTS `Moderator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Moderator` (
  `id` int(32) NOT NULL,
  `authority` int(2) NOT NULL,
  KEY `id` (`id`),
  CONSTRAINT `Moderator_ibfk_1` FOREIGN KEY (`id`) REFERENCES `User` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Moderator`
--

LOCK TABLES `Moderator` WRITE;
/*!40000 ALTER TABLE `Moderator` DISABLE KEYS */;
/*!40000 ALTER TABLE `Moderator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Preview`
--

DROP TABLE IF EXISTS `Preview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Preview` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Preview`
--

LOCK TABLES `Preview` WRITE;
/*!40000 ALTER TABLE `Preview` DISABLE KEYS */;
INSERT INTO `Preview` VALUES
(1,'Godot3.4.png'),
(2,'3089913491688650043gol1.jpg'),
(3,'5206049111708347229gol1.jpg'),
(4,'editor_tps_demo_1920x1080.jpg');
/*!40000 ALTER TABLE `Preview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Publisher`
--

DROP TABLE IF EXISTS `Publisher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Publisher` (
  `id` int(32) NOT NULL,
  `reputation` float DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `Publisher_ibfk_1` FOREIGN KEY (`id`) REFERENCES `User` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Publisher`
--

LOCK TABLES `Publisher` WRITE;
/*!40000 ALTER TABLE `Publisher` DISABLE KEYS */;
INSERT INTO `Publisher` VALUES
(1,0);
/*!40000 ALTER TABLE `Publisher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PublisherReview`
--

DROP TABLE IF EXISTS `PublisherReview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `PublisherReview` (
  `publisher` int(32) NOT NULL,
  `review` int(32) NOT NULL,
  KEY `publisher` (`publisher`),
  KEY `review` (`review`),
  CONSTRAINT `PublisherReview_ibfk_1` FOREIGN KEY (`publisher`) REFERENCES `Publisher` (`id`),
  CONSTRAINT `PublisherReview_ibfk_2` FOREIGN KEY (`review`) REFERENCES `Review` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PublisherReview`
--

LOCK TABLES `PublisherReview` WRITE;
/*!40000 ALTER TABLE `PublisherReview` DISABLE KEYS */;
/*!40000 ALTER TABLE `PublisherReview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Review`
--

DROP TABLE IF EXISTS `Review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Review` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `writer` int(32) NOT NULL,
  `rating` int(1) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Review`
--

LOCK TABLES `Review` WRITE;
/*!40000 ALTER TABLE `Review` DISABLE KEYS */;
/*!40000 ALTER TABLE `Review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tag`
--

DROP TABLE IF EXISTS `Tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Tag` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `string` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tag`
--

LOCK TABLES `Tag` WRITE;
/*!40000 ALTER TABLE `Tag` DISABLE KEYS */;
INSERT INTO `Tag` VALUES
(1,'2d'),
(2,'3d');
/*!40000 ALTER TABLE `Tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `email` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `profile` text DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES
(1,'diddy@baby.oil','Ahmad Diddy Aziz','I love baby oil...','baby');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-04-16 18:22:25
