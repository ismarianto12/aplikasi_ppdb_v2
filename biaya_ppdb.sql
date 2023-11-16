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
-- Table structure for table `biaya_ppdb`
--

DROP TABLE IF EXISTS `biaya_ppdb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biaya_ppdb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_biaya` varchar(255) NOT NULL,
  `nominal` decimal(10,2) NOT NULL,
  `tingkat` varchar(30) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `kode` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biaya_ppdb`
--

LOCK TABLES `biaya_ppdb` WRITE;
/*!40000 ALTER TABLE `biaya_ppdb` DISABLE KEYS */;
INSERT INTO `biaya_ppdb` VALUES (1,'FORM',200000.00,'1',NULL,'PPDB'),(2,'FORM',200000.00,'2',NULL,'PPDB'),(3,'FORM',300000.00,'3',NULL,'PPDB'),(4,'FORM',400000.00,'4',NULL,'PPDB'),(7,'Buku Paket MA',200000.00,NULL,NULL,'AKADEMIK'),(8,'Buku Paket MTS',180000.00,NULL,NULL,'AKADEMIK'),(9,'Infaq Bangunan',350000.00,NULL,NULL,'AKADEMIK'),(10,'IURAN JALAN JALAN',50000.00,NULL,NULL,'AKADEMIK'),(11,'SPP',250000.00,NULL,NULL,'AKADEMIK'),(12,'SPP BULANAN',100000.00,NULL,NULL,'AKADEMIK'),(13,'SPP MA',350000.00,NULL,NULL,'AKADEMIK'),(14,'SPP MTS',275000.00,NULL,NULL,'AKADEMIK'),(15,'UAS-GANJIL',200000.00,NULL,NULL,'AKADEMIK'),(16,'UAS-GENAP',250000.00,NULL,NULL,'AKADEMIK');
/*!40000 ALTER TABLE `biaya_ppdb` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-10  1:01:39
