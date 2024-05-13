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
CREATE DATABASE IF NOT EXISTS `barber` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `barber`;

-- Listage de la structure de table barber. actualites
CREATE TABLE IF NOT EXISTS `actualites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `texte` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.actualites : ~0 rows (environ)
INSERT INTO `actualites` (`id`, `titre`, `photo`, `texte`, `date`) VALUES
	(1, 'Nouveau Programme de Fidélité : Économisez 15% chaque mois !', 'http://localhost:8888/BarberProjet-3/public/img/actu.jpeg\n', 'Découvrez notre tout nouveau programme de fidélité chez Jesuispassechezsouf ! À partir de maintenant, vous bénéficiez d\'une réduction de 15% sur chaque deuxième prestation réalisée dans le même mois.\n\nC\'est notre façon de récompenser votre fidélité et de vous offrir des économies régulières sur vos services de coiffure et de rasage. Lors de votre prochaine visite, informez simplement votre coiffeur que vous participez à notre programme de fidélité pour profiter de cette offre exclusive.\n\nNe manquez pas cette occasion d\'économiser et de profiter des meilleurs soins capillaires et de rasage. Prenez rendez-vous dès aujourd\'hui pour commencer à bénéficier de notre programme de fidélité mensuel !', '2024-05-06 13:27:24');

-- Listage de la structure de table barber. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int NOT NULL,
  `nomCategorie` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.categorie : ~5 rows (environ)
INSERT INTO `categorie` (`id_categorie`, `nomCategorie`) VALUES
	(1, 'coupe'),
	(2, 'barbe'),
	(3, 'coupe + barbe'),
	(4, 'soin'),
	(5, 'couleur');

-- Listage de la structure de table barber. categories_message_contact
CREATE TABLE IF NOT EXISTS `categories_message_contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.categories_message_contact : ~3 rows (environ)
INSERT INTO `categories_message_contact` (`id`, `nom`) VALUES
	(1, 'Demande d\'Informations'),
	(2, 'Réclamations'),
	(3, 'Autre');

-- Listage de la structure de table barber. client
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(55) NOT NULL,
  `telephone` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(55) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_client`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.client : ~3 rows (environ)
INSERT INTO `client` (`id_client`, `prenom`, `telephone`, `email`, `password`, `role`, `creationDate`) VALUES
	(1, 'said', '0388218891', 'said@said.fr', '$2y$10$QoqcloB/5FORzc3J9ulyM.ri5kaMK2.rvbqVJjou9gO0o7tx/h6.i', 'Utilisateur', '2024-03-21 23:00:00'),
	(2, 'MOMO', '0388218895', 'momo@gmail.com', '$2y$10$bn0U1Jha0C5FV1kV66RtKe7M25Z/mxQFzrrkqlqvvlI.KhtNLZRzC', 'Utilisateur', '2024-03-22 09:52:25'),
	(3, 'sarah', '0303030303', 'sarah@sarah.fr', '$2y$10$QjJFgZg9hETmhJCs2p8eReDpZrWK5p0c5RK0WU4885W1mEhNFzAN.', 'Utilisateur', '2024-03-27 17:16:31'),
	(4, 'souf', '0388218891', 'gmail@gmail.com', '$2y$10$Bns14Giw6evUUn.49jY6gO/odImbgw4wW3BgP/KGghJjnn8q7yliy', 'Utilisateur', '2024-05-13 11:34:27');

-- Listage de la structure de table barber. galerie
CREATE TABLE IF NOT EXISTS `galerie` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `imageUrl` varchar(500) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_image`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.galerie : ~4 rows (environ)
INSERT INTO `galerie` (`id_image`, `titre`, `imageUrl`, `date_creation`) VALUES
	(1, 'coupe', 'http://localhost:8888/BarberProjet-3/public/img/image1.jpeg\n', '2024-04-25 15:10:57'),
	(2, 'coupe de cheveux', 'http://localhost:8888/BarberProjet-3/public/img/image2.jpeg\r\n', '2024-04-25 15:10:57'),
	(3, '', 'http://localhost:8888/BarberProjet-3/public/img/image0.jpeg\n', '2024-04-23 13:39:21'),
	(4, 'coupe de cheveux ', 'http://localhost:8888/BarberProjet-3/public/img/image3.jpeg\r\n', '2024-04-25 15:21:18');

-- Listage de la structure de table barber. messages_contact
CREATE TABLE IF NOT EXISTS `messages_contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categorie_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_categorie` (`categorie_id`),
  CONSTRAINT `fk_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categories_message_contact` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.messages_contact : ~0 rows (environ)

-- Listage de la structure de table barber. rdv
CREATE TABLE IF NOT EXISTS `rdv` (
  `id_rdv` int NOT NULL,
  `rdv_date` datetime NOT NULL,
  `user_id` int NOT NULL,
  `service_id` int NOT NULL,
  PRIMARY KEY (`id_rdv`),
  KEY `service_id` (`service_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `rdv_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`id_service`),
  CONSTRAINT `rdv_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `client` (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.rdv : ~0 rows (environ)

-- Listage de la structure de table barber. rdv_disponible
CREATE TABLE IF NOT EXISTS `rdv_disponible` (
  `id_reservation` int DEFAULT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.rdv_disponible : ~0 rows (environ)

-- Listage de la structure de table barber. reservations
CREATE TABLE IF NOT EXISTS `reservations` (
  `id_reservation` int NOT NULL,
  `service_id` int NOT NULL,
  `client_id` int DEFAULT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `service_id` (`service_id`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `FK_reservations_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`id_client`),
  CONSTRAINT `FK_reservations_service` FOREIGN KEY (`service_id`) REFERENCES `service` (`id_service`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table barber.reservations : ~0 rows (environ)
INSERT INTO `reservations` (`id_reservation`, `service_id`, `client_id`, `date`, `heure`) VALUES
	(1, 1, NULL, '2024-07-01', '10:00:00'),
	(2, 1, NULL, '2024-07-01', '09:00:00'),
	(3, 1, NULL, '2024-07-01', '09:30:00'),
	(4, 1, NULL, '2024-07-01', '10:30:00'),
	(5, 1, NULL, '2024-07-01', '11:00:00'),
	(6, 1, NULL, '2024-07-01', '11:30:00'),
	(7, 1, NULL, '2024-07-01', '12:00:00'),
	(8, 1, NULL, '2024-07-01', '13:00:00'),
	(9, 1, NULL, '2024-07-01', '13:30:00'),
	(10, 2, NULL, '2024-07-01', '14:00:00'),
	(11, 2, NULL, '2024-07-01', '14:30:00'),
	(12, 1, NULL, '2024-07-01', '15:00:00'),
	(13, 1, NULL, '2024-07-01', '15:30:00'),
	(14, 1, NULL, '2024-07-01', '16:00:00'),
	(15, 1, NULL, '2024-07-01', '16:30:00'),
	(16, 1, NULL, '2024-07-01', '17:00:00'),
	(17, 1, NULL, '2024-07-01', '17:30:00'),
	(18, 1, NULL, '2024-08-01', '10:00:00'),
	(19, 1, NULL, '2024-08-01', '09:00:00'),
	(20, 1, NULL, '2024-08-01', '09:30:00'),
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
	(33, 1, NULL, '2024-08-01', '17:00:00'),
	(34, 1, NULL, '2024-08-01', '17:30:00');

-- Listage de la structure de table barber. service
CREATE TABLE IF NOT EXISTS `service` (
  `id_service` int NOT NULL DEFAULT '0',
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `duree` datetime DEFAULT NULL,
  `categorie_id` int DEFAULT NULL,
  PRIMARY KEY (`id_service`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.service : ~14 rows (environ)
INSERT INTO `service` (`id_service`, `nom`, `prix`, `duree`, `categorie_id`) VALUES
	(1, 'Coupe Homme', 30, '2024-03-27 00:30:00', 1),
	(2, 'Coupe Etudiant', 25, '2024-03-27 00:30:00', 1),
	(3, 'Coupe Enfant', 20, '2024-03-27 00:30:00', 1),
	(4, 'Coupe Premium', 50, '2024-03-27 00:30:00', 1),
	(5, 'Barbe ', 20, '2024-03-27 00:30:00', 2),
	(6, 'Barbe Premium', 30, '2024-03-27 00:30:00', 2),
	(7, 'Coupe + Barbe Homme', 40, '2024-03-27 00:30:00', 3),
	(8, 'Coupe + Barbe Etudiant', 35, '2024-03-27 00:30:00', 3),
	(9, 'Coupe + Barbe Premium', 70, '2024-03-27 00:30:00', 3),
	(10, 'Soin du visage complet', 40, '2024-03-27 00:30:00', 4),
	(11, 'Couleur tête entière ', 70, '2024-03-27 00:30:00', 5),
	(12, 'Mèches', 50, '2024-03-27 00:30:00', 5),
	(13, 'Coloration de la barbe', 30, '2024-03-27 00:30:00', 5),
	(14, 'Défrisage', 50, '2024-03-27 00:30:00', 6);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
