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


-- Listage de la structure de la base pour barber2
DROP DATABASE IF EXISTS `barber2`;
CREATE DATABASE IF NOT EXISTS `barber2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `barber2`;

-- Listage de la structure de table barber2. category
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL,
  `categoryName` varchar(50) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber2.category : ~5 rows (environ)
INSERT INTO `category` (`id_category`, `categoryName`) VALUES
	(1, 'coupe'),
	(2, 'barbe'),
	(3, 'coupe + barbe'),
	(4, 'soin'),
	(5, 'couleur');

-- Listage de la structure de table barber2. category_contact
DROP TABLE IF EXISTS `category_contact`;
CREATE TABLE IF NOT EXISTS `category_contact` (
  `id_categoryContact` int NOT NULL AUTO_INCREMENT,
  `nameCategory` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categoryContact`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber2.category_contact : ~5 rows (environ)
INSERT INTO `category_contact` (`id_categoryContact`, `nameCategory`) VALUES
	(1, 'Demande d\'informations\r\n'),
	(2, 'Réclamations'),
	(3, 'Problèmes techniques'),
	(4, 'Partenariats et collaborations'),
	(5, 'Autres demandes');

-- Listage de la structure de table barber2. client
DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(55) NOT NULL,
  `telephone` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(55) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `resetToken` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber2.client : ~9 rows (environ)
INSERT INTO `client` (`id_client`, `prenom`, `telephone`, `email`, `password`, `role`, `creationDate`, `resetToken`) VALUES
	(1, 'said', '0388218891', 'said@said.fr', '$2y$10$QoqcloB/5FORzc3J9ulyM.ri5kaMK2.rvbqVJjou9gO0o7tx/h6.i', 'Utilisateur', '2024-03-21 22:00:00', NULL),
	(2, 'MOMO', '0388218895', 'momo@gmail.com', '$2y$10$bn0U1Jha0C5FV1kV66RtKe7M25Z/mxQFzrrkqlqvvlI.KhtNLZRzC', 'Utilisateur', '2024-03-22 08:52:25', NULL),
	(3, 'sarah', '0303030303', 'sarah@sarah.fr', '$2y$10$QjJFgZg9hETmhJCs2p8eReDpZrWK5p0c5RK0WU4885W1mEhNFzAN.', 'Utilisateur', '2024-03-27 16:16:31', NULL),
	(4, 'souf', '0388218891', 'gmail1@gmail.com', '$2y$10$Bns14Giw6evUUn.49jY6gO/odImbgw4wW3BgP/KGghJjnn8q7yliy', 'Utilisateur', '2024-05-13 09:34:27', NULL),
	(5, 'Sonia', '0633333333', 'gmail@g.com', '$2y$10$11CvGEwYDq3OPppPzfKAsePeP9PCyejW0AYnNUgUk5tpdd./1ebIC', 'Utilisateur', '2024-05-19 21:52:58', NULL),
	(6, 'Admin', '0388218891', 'admin1@gmail.com', '$2y$10$PdbyvMi2Yvd7wGD7f4d1ReqTa38A5hI7MvUe7mqc/FNwOMQ60xd3W', 'Utilisateur', '2024-05-20 14:05:16', NULL),
	(7, 'stephane', '0388218891', 'steph@gmail.com', '$2y$10$yhh4yGq1krRUsouqqt.SiukFAaMe4Bw3NHgsU592h5tAmpCDeOHcm', 'Utilisateur', '2024-05-24 11:25:44', NULL),
	(8, 'si', '771719928', 'boukhdimi@gmail.com', '$2y$10$QqBEppga0JixBr69bLq6GeFvKCyLAhjqot5EZtXZvGAMb6sFvpGsm', 'Utilisateur', '2024-05-24 14:13:57', NULL),
	(9, 'administrateur', '605270495', 'admin@gmail.com', '$2y$10$ng.ZreuGhYNz8y/MHvBftuhkTEsevSVtwfsBDErX0hjyac5V/Yb/G', 'admin', '2024-06-09 18:23:33', NULL);

-- Listage de la structure de table barber2. galerie
DROP TABLE IF EXISTS `galerie`;
CREATE TABLE IF NOT EXISTS `galerie` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `imageUrl` varchar(500) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_image`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber2.galerie : ~4 rows (environ)
INSERT INTO `galerie` (`id_image`, `titre`, `imageUrl`, `date_creation`) VALUES
	(1, 'coupe', 'image1.jpeg', '2024-04-25 13:10:57'),
	(2, 'coupe de cheveux', 'image2.jpeg', '2024-04-25 13:10:57'),
	(3, '', 'image0.jpeg', '2024-04-23 11:39:21'),
	(4, 'coupe de cheveux', 'image3.jpeg', '2024-04-25 13:21:18');

-- Listage de la structure de table barber2. message_contact
DROP TABLE IF EXISTS `message_contact`;
CREATE TABLE IF NOT EXISTS `message_contact` (
  `id_message` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categoryContact_id` int DEFAULT NULL,
  PRIMARY KEY (`id_message`),
  KEY `categoryContact_id` (`categoryContact_id`),
  CONSTRAINT `categoryContact` FOREIGN KEY (`categoryContact_id`) REFERENCES `category_contact` (`id_categoryContact`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber2.message_contact : ~4 rows (environ)
INSERT INTO `message_contact` (`id_message`, `name`, `email`, `message`, `dateCreation`, `categoryContact_id`) VALUES
	(1, 'gmail', 'B@b.fr', 'bonjour', '2024-05-29 16:54:23', 1),
	(2, 'bx', 'bv@g.fr', 'tien contact', '2024-05-29 16:57:28', 1),
	(3, 'bonjour', 'a@a.fr', 'oui', '2024-05-30 11:26:29', 2),
	(4, 'gg', 'gmail@gmail.fr', 'oui', '2024-05-31 11:26:20', 2);

-- Listage de la structure de table barber2. news
DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber2.news : ~2 rows (environ)
INSERT INTO `news` (`id`, `title`, `photo`, `text`, `date`) VALUES
	(1, 'Nouveau Programme de Fidélité : Économisez 15% chaque mois !', 'actu.jpeg', 'Découvrez notre tout nouveau programme de fidélité chez Jesuispassechezsouf ! À partir de maintenant, vous bénéficiez d\'une réduction de 15% sur chaque deuxième prestation réalisée dans le même mois. C\'est notre façon de récompenser votre fidélité et de vous offrir des économies régulières sur vos services de coiffure et de rasage. Lors de votre prochaine visite, informez simplement votre coiffeur que vous participez à notre programme de fidélité pour profiter de cette offre exclusive. Ne manquez pas cette occasion d\'économiser et de profiter des meilleurs soins capillaires et de rasage. Prenez rendez-vous dès aujourd\'hui pour commencer à bénéficier de notre programme de fidélité mensuel !', '2024-05-06 11:27:24'),
	(2, 'un titre', 'www', 'un texte', '2024-05-29 22:00:00');

-- Listage de la structure de table barber2. reservations
DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `client_id` int DEFAULT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `service_id` (`service_id`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`id_client`),
  CONSTRAINT `service_id` FOREIGN KEY (`service_id`) REFERENCES `service` (`id_service`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table barber2.reservations : ~54 rows (environ)
INSERT INTO `reservations` (`id_reservation`, `service_id`, `client_id`, `date`, `heure`) VALUES
	(1, 1, 4, '2024-07-02', '10:00:00'),
	(2, 1, 4, '2024-07-01', '09:00:00'),
	(3, 1, 3, '2024-07-01', '09:30:00'),
	(4, 1, 1, '2024-07-01', '10:30:00'),
	(5, 1, 6, '2024-07-01', '11:00:00'),
	(6, 1, 6, '2024-07-01', '11:30:00'),
	(7, 1, 6, '2024-07-01', '12:00:00'),
	(9, 1, 6, '2024-07-01', '13:30:00'),
	(10, 2, NULL, '2024-07-01', '14:00:00'),
	(11, 2, NULL, '2024-07-01', '14:30:00'),
	(13, 1, 6, '2024-07-01', '15:30:00'),
	(14, 1, 6, '2024-07-01', '16:00:00'),
	(15, 1, 6, '2024-07-01', '16:30:00'),
	(17, 1, 6, '2024-07-01', '17:30:00'),
	(18, 1, 6, '2024-08-01', '10:00:00'),
	(19, 1, 6, '2024-08-01', '09:00:00'),
	(20, 1, 6, '2024-08-01', '09:30:00'),
	(21, 1, NULL, '2024-08-01', '10:30:00'),
	(22, 1, NULL, '2024-08-01', '11:00:00'),
	(23, 1, NULL, '2024-08-01', '11:30:00'),
	(24, 1, NULL, '2024-08-01', '12:00:00'),
	(25, 1, NULL, '2024-08-01', '13:00:00'),
	(26, 1, NULL, '2024-08-01', '13:30:00'),
	(27, 1, NULL, '2024-08-01', '14:00:00'),
	(28, 1, NULL, '2024-08-01', '14:30:00'),
	(29, 1, NULL, '2024-08-01', '15:00:00'),
	(30, 1, NULL, '2024-08-01', '15:30:00'),
	(31, 1, NULL, '2024-08-01', '16:00:00'),
	(32, 1, NULL, '2024-08-01', '16:30:00'),
	(33, 1, 6, '2024-08-01', '17:00:00'),
	(34, 1, 6, '2024-08-01', '17:30:00'),
	(45, 5, NULL, '2024-06-04', '09:30:00'),
	(46, 5, NULL, '2024-06-04', '10:00:00'),
	(47, 5, NULL, '2024-06-04', '10:30:00'),
	(48, 5, NULL, '2024-06-04', '11:00:00'),
	(49, 10, NULL, '2024-05-31', '10:30:00'),
	(50, 10, NULL, '2024-05-31', '11:00:00'),
	(51, 10, NULL, '2024-05-31', '11:30:00'),
	(52, 10, NULL, '2024-06-05', '10:30:00'),
	(53, 10, NULL, '2024-06-05', '11:00:00'),
	(54, 10, NULL, '2024-06-05', '11:30:00'),
	(55, 10, NULL, '2024-06-10', '10:30:00'),
	(56, 10, NULL, '2024-06-10', '11:00:00'),
	(57, 10, NULL, '2024-06-10', '11:30:00'),
	(58, 6, NULL, '2024-05-31', '10:00:00'),
	(59, 6, NULL, '2024-05-31', '10:30:00'),
	(60, 6, NULL, '2024-06-05', '10:00:00'),
	(61, 6, NULL, '2024-06-05', '10:30:00'),
	(62, 6, NULL, '2024-06-10', '10:00:00'),
	(63, 6, NULL, '2024-06-10', '10:30:00'),
	(64, 1, NULL, '2024-06-10', '18:00:00'),
	(65, 1, NULL, '2024-06-10', '18:30:00'),
	(66, 1, NULL, '2024-06-11', '18:00:00'),
	(67, 1, NULL, '2024-06-11', '18:30:00');

-- Listage de la structure de table barber2. service
DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id_service` int NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `duration` datetime DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id_service`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber2.service : ~14 rows (environ)
INSERT INTO `service` (`id_service`, `name`, `price`, `duration`, `category_id`) VALUES
	(1, 'Coupe Homme', 30, '2024-03-27 00:30:00', 1),
	(2, 'Coupe Etudiant', 25, '2024-03-27 00:30:00', 1),
	(3, 'Coupe Enfant', 20, '2024-03-27 00:30:00', 1),
	(4, 'Coupe Premium', 50, '2024-03-27 00:30:00', 1),
	(5, 'Barbe', 20, '2024-03-27 00:30:00', 2),
	(6, 'Barbe Premium', 30, '2024-03-27 00:30:00', 2),
	(7, 'Coupe + Barbe Homme', 40, '2024-03-27 00:30:00', 3),
	(8, 'Coupe + Barbe Etudiant', 35, '2024-03-27 00:30:00', 3),
	(9, 'Coupe + Barbe Premium', 70, '2024-03-27 00:30:00', 3),
	(10, 'Soin du visage complet', 40, '2024-03-27 00:30:00', 4),
	(11, 'Couleur tête entière', 70, '2024-03-27 00:30:00', 5),
	(12, 'Mèches', 50, '2024-03-27 00:30:00', 5),
	(13, 'Coloration de la barbe', 30, '2024-03-27 00:30:00', 5),
	(14, 'Défrisage', 50, '2024-03-27 00:30:00', 6);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
