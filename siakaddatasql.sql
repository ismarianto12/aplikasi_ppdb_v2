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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biaya_ppdb`
--

LOCK TABLES `biaya_ppdb` WRITE;
/*!40000 ALTER TABLE `biaya_ppdb` DISABLE KEYS */;
INSERT INTO `biaya_ppdb` VALUES (1,'FORM',200000.00,'1'),(2,'FORM',200000.00,'2'),(3,'FORM',300000.00,'3'),(4,'FORM',400000.00,'4');
/*!40000 ALTER TABLE `biaya_ppdb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ppdb`
--

DROP TABLE IF EXISTS `ppdb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ppdb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ppdb_id` int(14) DEFAULT NULL,
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
  `bukti_bayar` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ppdb`
--

LOCK TABLES `ppdb` WRITE;
/*!40000 ALTER TABLE `ppdb` DISABLE KEYS */;
INSERT INTO `ppdb` VALUES (1,NULL,'PPDB-915169552','11313','2342424','243242','242342@adsa.com','132128','$2y$10$VrvLNyjkuIDJX8u8PS5wOOWzw/FlnJDAp6yRJYtKyPW7glPITbdcK','P','2023-10-20','15','1502','1502021','1502021005','312313','13123','131231','Pedagang','Pedagang','132131','Pedagang','Rp.2.000.000 - Rp.3.000.000','131321',2,'13123',21313,'Blum Set',1,1,1,'/Applications/XAMPP/xamppfiles/temp/phpritjcl','/Applications/XAMPP/xamppfiles/temp/phppPHyzI','/Applications/XAMPP/xamppfiles/temp/phpYs4L7n','/Applications/XAMPP/xamppfiles/temp/phptgQyFT',1,0,'1','2023-10-26',1,'0',0,'2023-10-26','0',1,'test.png'),(2,NULL,'PPDB-1554153932','312303123','12313','3131332','313123','12313131','$2y$10$S71WpLhuyxXU7ktzoni30OH3Po0vfH0l77wU10LVCyfT9VNVDxbwe','L','2023-10-05','14','1402','1402021','1402021003','23131','3123','1231231','Buruh','Wiraswasta','12313','Pedagang','Rp.2.000.000 - Rp.3.000.000','13131',2,'123131',2020,'Blum Set',1,1,1,'/Applications/XAMPP/xamppfiles/temp/phpZE3Gzi','kosong','/Applications/XAMPP/xamppfiles/temp/phpPeUsMW','/Applications/XAMPP/xamppfiles/temp/phpPrfKrD',1,0,'1','2023-10-28',1,'0',0,'2023-10-28','0',1,'test.png');
/*!40000 ALTER TABLE `ppdb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siswa`
--

DROP TABLE IF EXISTS `siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `role_id` int(2) NOT NULL,
  `ppdb_id` int(14) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siswa`
--

LOCK TABLES `siswa` WRITE;
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
INSERT INTO `siswa` VALUES (1,1,'11313','2342424','243242','242342@adsa.com','132128','$2y$10$VrvLNyjkuIDJX8u8PS5wOOWzw/FlnJDAp6yRJYtKyPW7glPITbdcK','P','2023-10-20','15','1502','312313','13123','131231','Pedagang','Pedagang','132131','Pedagang','Rp.2.000.000 - Rp.3.000.000','131321',2,'13123','Blum Set','/Applications/XAMPP/xamppfiles/temp/phpritjcl','/Applications/XAMPP/xamppfiles/temp/phppPHyzI','/Applications/XAMPP/xamppfiles/temp/phpYs4L7n','/Applications/XAMPP/xamppfiles/temp/phptgQyFT',1,1,1,1,'2023-10-29',3,NULL),(2,1,'312303123','12313','3131332','313123','12313131','$2y$10$S71WpLhuyxXU7ktzoni30OH3Po0vfH0l77wU10LVCyfT9VNVDxbwe','L','2023-10-05','14','1402','23131','3123','1231231','Buruh','Wiraswasta','12313','Pedagang','Rp.2.000.000 - Rp.3.000.000','13131',2,'123131','Blum Set','/Applications/XAMPP/xamppfiles/temp/phpZE3Gzi','kosong','/Applications/XAMPP/xamppfiles/temp/phpPeUsMW','/Applications/XAMPP/xamppfiles/temp/phpPrfKrD',1,1,1,1,'2023-10-29',3,2),(3,1,'11313','2342424','243242','242342@adsa.com','132128','$2y$10$VrvLNyjkuIDJX8u8PS5wOOWzw/FlnJDAp6yRJYtKyPW7glPITbdcK','P','2023-10-20','15','1502','312313','13123','131231','Pedagang','Pedagang','132131','Pedagang','Rp.2.000.000 - Rp.3.000.000','131321',2,'13123','Blum Set','/Applications/XAMPP/xamppfiles/temp/phpritjcl','/Applications/XAMPP/xamppfiles/temp/phppPHyzI','/Applications/XAMPP/xamppfiles/temp/phpYs4L7n','/Applications/XAMPP/xamppfiles/temp/phptgQyFT',1,1,1,1,'2023-10-29',3,1);
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tahunAkademik`
--

DROP TABLE IF EXISTS `tahunAkademik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tahunAkademik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) DEFAULT NULL,
  `Semester` varchar(10) DEFAULT NULL,
  `active` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tahunAkademik`
--

LOCK TABLES `tahunAkademik` WRITE;
/*!40000 ALTER TABLE `tahunAkademik` DISABLE KEYS */;
INSERT INTO `tahunAkademik` VALUES (1,2023,'Ganjil','1'),(2,2023,'Genap',NULL),(3,2024,'Ganjil',NULL),(4,2024,'Genap',NULL);
/*!40000 ALTER TABLE `tahunAkademik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tingkat`
--

DROP TABLE IF EXISTS `tingkat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tingkat` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `kode` varchar(14) NOT NULL,
  `tingkat` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tingkat`
--

LOCK TABLES `tingkat` WRITE;
/*!40000 ALTER TABLE `tingkat` DISABLE KEYS */;
INSERT INTO `tingkat` VALUES (1,'TKA','TK'),(2,'TKA','TK'),(3,'TKA','SD'),(4,'TKA','SMP');
/*!40000 ALTER TABLE `tingkat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(15) NOT NULL,
  `user_id` int(14) NOT NULL,
  `role` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `statuslogin` varchar(10) DEFAULT NULL,
  `token` text DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$VrvLNyjkuIDJX8u8PS5wOOWzw/FlnJDAp6yRJYtKyPW7glPITbdcK','email@gmail.com',1,'1',NULL,'1','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL3NpYWthZF9zZGl0XC9wdWJsaWNcL2FwaVwvdjFcL2xvZ2luIiwiaWF0IjoxNjk4NjAyMzM3LCJuYmYiOjE2OTg2MDIzMzcsImp0aSI6IlFyaTBrMTFveEJvS3g3SU0iLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.PBkTW9NULwbbJdQChXNBG6PwpOcoR7QSJKkD33RNGkI',NULL);
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

-- Dump completed on 2023-10-31  9:47:54
