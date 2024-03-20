-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour barber
CREATE DATABASE IF NOT EXISTS `barber` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `barber`;

-- Listage de la structure de table barber. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int NOT NULL,
  `nomCategorie` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table barber.categorie : ~5 rows (environ)
INSERT INTO `categorie` (`id_categorie`, `nomCategorie`) VALUES
	(1, 'coupe'),
	(2, 'barbe'),
	(3, 'coupe + barbe'),
	(4, 'soin'),
	(5, 'couleur');

-- Listage de la structure de table barber. service
CREATE TABLE IF NOT EXISTS `service` (
  `id_service` int NOT NULL DEFAULT '0',
  `nom` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `duree` time DEFAULT NULL,
  `categorie_id` int DEFAULT NULL,
  PRIMARY KEY (`id_service`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table barber.service : ~13 rows (environ)
INSERT INTO `service` (`id_service`, `nom`, `prix`, `duree`, `categorie_id`) VALUES
	(1, 'Coupe Homme', 30, '00:30:00', 1),
	(2, 'Coupe Etudiant', 25, '00:30:00', 1),
	(3, 'Coupe Enfant (-12 ans)', 20, '00:30:00', 1),
	(4, 'Coupe Premium', 50, '00:30:00', 1),
	(5, 'Barbe', 20, '00:30:00', 2),
	(6, 'Barbe Premium', 35, '00:30:00', 2),
	(7, 'Coupe + Barbe Homme', 40, '00:30:00', 3),
	(8, 'Coupe + Barbe Etudiant', 35, '00:30:00', 3),
	(9, 'Coupe + Barbe Premium', 70, '00:30:00', 3),
	(10, 'Soins du visage complet', 40, '00:30:00', 4),
	(11, 'Couleur tête entière', 80, '00:30:00', 5),
	(12, 'Mèches', 50, '00:30:00', 5),
	(13, 'Coloration barbe', 30, '00:30:00', 5);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
