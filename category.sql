-- MariaDB dump 10.19  Distrib 10.4.21-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: darulmaza_siakad
-- ------------------------------------------------------
-- Server version	10.4.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id_category` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `seotitle` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `active` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `created_on` datetime DEFAULT NULL,
  `created_by` int(14) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(14) DEFAULT NULL,
  `user_id` int(14) DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (12,'Yearly / Outlook','yearly--outlook','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(13,'Company Update','company-update','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(9,'Weekly Highlight','weekly-highlight','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(10,'Monthly Highlight','monthly-highlight','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(11,'Quarterly','quarterly','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(8,'Fixed Income','daily-debt-market--fixed-income','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(7,'Daily: Technical','daily-technical','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(14,'Market Focus','market-focus','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(6,'Daily Highlight','daily-highlight','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(15,'Index MNC36','index-mnc-36','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(16,'Economic Report','economic-report','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(17,'Spotlight','spotlight','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(18,'Early Bird','early-bird','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(19,'Video','video','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(24,'MNCS Daily Scope Wave','mncs-daily-scope-wave','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(26,'MNCS Morning Navigator','mncs-morning-navigator','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(27,'MNCS Compendium','mncs-compendium','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(34,'MNCS FIXED INCOME','mncs-fixed-income','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(35,'Article','article','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(36,'News Update','press-release','Y','2023-11-22 00:00:00',1,'2023-11-22 00:00:00',1,NULL),(41,'adsad','adadas','Y',NULL,NULL,NULL,NULL,NULL),(42,'adsad','adadas','Y',NULL,NULL,NULL,NULL,NULL),(43,'adsad','adadas','Y',NULL,NULL,NULL,NULL,NULL),(44,'asdadasd','','Y',NULL,NULL,'2023-11-27 09:31:13',1,NULL),(46,'adasd','adasd','Y','2023-11-27 09:31:27',1,'2023-11-28 08:52:01',1,NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-11 20:54:31
