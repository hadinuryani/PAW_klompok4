-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: perpustakaan
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrator` (
  `id_administrator` int NOT NULL AUTO_INCREMENT,
  `username_admin` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profil_administrator` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_administrator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrator`
--

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buku`
--

DROP TABLE IF EXISTS `buku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `buku` (
  `id_buku` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) DEFAULT NULL,
  `penulis` varchar(200) DEFAULT NULL,
  `penerbit` varchar(200) DEFAULT NULL,
  `tahun_terbit` year DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `kategori` enum('umum','referensi','fiksi','skripsi','jurnal') DEFAULT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku`
--

LOCK TABLES `buku` WRITE;
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` VALUES (1,'Pengantar Teknologi Informasi','Dimas Pratama','Informatika Press',2020,'https://images.unsplash.com/photo-1517430816045-df4b7de11d1d','referensi'),(2,'Dasar Pemrograman Web','Nadia Putri','Graha Ilmu',2021,'https://images.unsplash.com/photo-1518770660439-4636190af475','umum'),(3,'Analisis Sistem Informasi Akademik','Heri Santoso','Andi Publisher',2019,'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f','referensi'),(4,'Novel Senja di Ujung Kota','Anita Rahma','Pena Nusantara',2018,'https://images.unsplash.com/photo-1507842217343-583bb7270b66','fiksi'),(5,'Skripsi Sistem Peminjaman Buku Digital','Budi Setiawan','Universitas XYZ',2023,'https://images.unsplash.com/photo-1528207776546-365bb710ee93','skripsi'),(6,'Jurnal Riset Informatika Vol. 12','Tim Peneliti UXYZ','LPPM UXYZ',2022,'https://images.unsplash.com/photo-1551836022-4c4c79ecde51','jurnal'),(7,'Manajemen Basis Data Lanjut','Riko Firmansyah','Andi Publisher',2020,'https://images.unsplash.com/photo-1515378791036-0648a3ef77b2','referensi'),(8,'Psikologi Belajar Mahasiswa','Laras Dewi','Ganesha Press',2019,'https://images.unsplash.com/photo-1472289065668-ce650ac443d2','umum'),(9,'Novel Angin Musim Hujan','Fajar Nugraha','Bentang Pustaka',2017,'https://images.unsplash.com/photo-1473862170181-d12f61f7f1e9','fiksi'),(10,'Skripsi Analisis Jaringan Kampus','Rina Amalia','Universitas XYZ',2023,'https://images.unsplash.com/photo-1498050108023-c5249f4df085','skripsi');
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peminjaman` (
  `id_peminjaman` int NOT NULL AUTO_INCREMENT,
  `id_pemustaka` int DEFAULT NULL,
  `id_buku` int DEFAULT NULL,
  `id_administrator` int DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('pending','aproved','borrowed','returned','rejected') DEFAULT 'pending',
  PRIMARY KEY (`id_peminjaman`),
  KEY `fk_peminjaman_pemustaka` (`id_pemustaka`),
  KEY `fk_peminjaman_buku` (`id_buku`),
  KEY `fk_peminjaman_administrator` (`id_administrator`),
  CONSTRAINT `fk_peminjaman_administrator` FOREIGN KEY (`id_administrator`) REFERENCES `administrator` (`id_administrator`),
  CONSTRAINT `fk_peminjaman_buku` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  CONSTRAINT `fk_peminjaman_pemustaka` FOREIGN KEY (`id_pemustaka`) REFERENCES `pemustaka` (`id_pemustaka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjaman`
--

LOCK TABLES `peminjaman` WRITE;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemustaka`
--

DROP TABLE IF EXISTS `pemustaka`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pemustaka` (
  `id_pemustaka` int NOT NULL AUTO_INCREMENT,
  `nama_pemustaka` varchar(100) DEFAULT NULL,
  `email_pemustaka` varchar(200) DEFAULT NULL,
  `nim_nip_pemustaka` varchar(100) DEFAULT NULL,
  `password_pemustaka` varchar(255) DEFAULT NULL,
  `profil_pemustaka` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pemustaka`),
  UNIQUE KEY `unq_email` (`email_pemustaka`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemustaka`
--

LOCK TABLES `pemustaka` WRITE;
/*!40000 ALTER TABLE `pemustaka` DISABLE KEYS */;
INSERT INTO `pemustaka` VALUES (1,'wito','danenda@gmail.com','22041110001','$2y$10$bqtg/VPwiZE5Pcs7F8udx.8fGXUYorM/W2yUtWt7nh9VDoOUJ6uq6',NULL);
/*!40000 ALTER TABLE `pemustaka` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-11 19:07:35
