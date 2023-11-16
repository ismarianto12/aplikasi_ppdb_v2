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
-- Table structure for table `ppdb`
--

DROP TABLE IF EXISTS `ppdb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ppdb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_daftar` varchar(30) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `ttl` date NOT NULL,
  `prov` varchar(250) NOT NULL,
  `kab` varchar(100) NOT NULL,
  `kec` varchar(255) NOT NULL,
  `kel` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nama_ayah` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `pek_ayah` varchar(100) NOT NULL,
  `pek_ibu` varchar(100) NOT NULL,
  `nama_wali` varchar(255) NOT NULL,
  `pek_wali` varchar(255) NOT NULL,
  `peng_ortu` varchar(255) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `thn_msk` int(11) NOT NULL,
  `sekolah_asal` varchar(255) NOT NULL,
  `thn_lls` int(11) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `id_pend` int(11) NOT NULL,
  `id_majors` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `img_siswa` varchar(255) NOT NULL,
  `img_kk` varchar(255) NOT NULL,
  `img_ijazah` varchar(255) NOT NULL,
  `img_ktp` varchar(255) NOT NULL,
  `raport` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `alasan` text NOT NULL,
  `date_created` date NOT NULL,
  `kode_inv` int(20) NOT NULL,
  `url_inv` varchar(255) NOT NULL,
  `inv` int(5) NOT NULL,
  `date_inv` date NOT NULL,
  `kode_reff` varchar(100) NOT NULL,
  `staff_konfirmasi` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ppdb`
--

LOCK TABLES `ppdb` WRITE;
/*!40000 ALTER TABLE `ppdb` DISABLE KEYS */;
INSERT INTO `ppdb` VALUES (1,'PPDB-915169552','11313','2342424','243242','242342@adsa.com','132128','$2y$10$VrvLNyjkuIDJX8u8PS5wOOWzw/FlnJDAp6yRJYtKyPW7glPITbdcK','P','2023-10-20','15','1502','1502021','1502021005','312313','13123','131231','Pedagang','Pedagang','132131','Pedagang','Rp.2.000.000 - Rp.3.000.000','131321',2,'13123',21313,'Blum Set',1,1,1,'/Applications/XAMPP/xamppfiles/temp/phpritjcl','/Applications/XAMPP/xamppfiles/temp/phppPHyzI','/Applications/XAMPP/xamppfiles/temp/phpYs4L7n','/Applications/XAMPP/xamppfiles/temp/phptgQyFT',1,1,'1','2023-10-26',1,'0',0,'2023-10-26','0',1);
/*!40000 ALTER TABLE `ppdb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siswa`
--

DROP TABLE IF EXISTS `siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `ttl` date NOT NULL,
  `prov` varchar(250) NOT NULL,
  `kab` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `nama_ayah` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `pek_ayah` varchar(100) NOT NULL,
  `pek_ibu` varchar(100) NOT NULL,
  `nama_wali` varchar(255) NOT NULL,
  `pek_wali` varchar(255) NOT NULL,
  `peng_ortu` varchar(255) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `thn_msk` int(11) NOT NULL,
  `sekolah_asal` varchar(255) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `img_siswa` varchar(255) NOT NULL,
  `img_kk` varchar(255) NOT NULL,
  `img_ijazah` varchar(255) NOT NULL,
  `img_ktp` varchar(255) NOT NULL,
  `id_pend` int(11) NOT NULL,
  `id_majors` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `date_created` date NOT NULL,
  `role_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siswa`
--

LOCK TABLES `siswa` WRITE;
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(15) NOT NULL,
  `user_id` int(14) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2023-10-28 14:10:00
