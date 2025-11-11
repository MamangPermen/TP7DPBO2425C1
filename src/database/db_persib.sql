-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_persib
CREATE DATABASE IF NOT EXISTS `db_persib` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_persib`;

-- Dumping structure for table db_persib.jadwal
CREATE TABLE IF NOT EXISTS `jadwal` (
  `id_jadwal` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `lawan` varchar(255) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table db_persib.pemain
CREATE TABLE IF NOT EXISTS `pemain` (
  `id_pemain` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `no_punggung` int NOT NULL,
  `usia` int NOT NULL,
  `asal` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pemain`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table db_persib.statistik
CREATE TABLE IF NOT EXISTS `statistik` (
  `id_stat` int NOT NULL AUTO_INCREMENT,
  `id_pemain` int NOT NULL,
  `penampilan` int DEFAULT '0',
  `gol` int DEFAULT '0',
  `assist` int DEFAULT '0',
  `kartu_kuning` int DEFAULT '0',
  `kartu_merah` int DEFAULT '0',
  PRIMARY KEY (`id_stat`),
  KEY `id_pemain` (`id_pemain`),
  CONSTRAINT `statistik_ibfk_1` FOREIGN KEY (`id_pemain`) REFERENCES `pemain` (`id_pemain`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
