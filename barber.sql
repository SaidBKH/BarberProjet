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

-- Listage de la structure de table barber. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL,
  `categoryName` varchar(50) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.category : ~5 rows (environ)
INSERT INTO `category` (`id_category`, `categoryName`) VALUES
	(1, 'coupe'),
	(2, 'barbe'),
	(3, 'coupe + barbe'),
	(4, 'soin'),
	(5, 'couleur');

-- Listage de la structure de table barber. categorycontact
CREATE TABLE IF NOT EXISTS `categorycontact` (
  `id_categoryContact` int NOT NULL AUTO_INCREMENT,
  `nameCategory` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categoryContact`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.categorycontact : ~5 rows (environ)
INSERT INTO `categorycontact` (`id_categoryContact`, `nameCategory`) VALUES
	(1, 'Demande d\'informations\r\n'),
	(2, 'Réclamations'),
	(3, 'Problèmes techniques'),
	(4, 'Partenariats et collaborations'),
	(5, 'Autres demandes');

-- Listage de la structure de table barber. client
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.client : ~2 rows (environ)
INSERT INTO `client` (`id_client`, `prenom`, `telephone`, `email`, `password`, `role`, `creationDate`, `resetToken`) VALUES
	(1, 'administrateur', '605270495', 'admin@gmail.com', '$2y$10$ng.ZreuGhYNz8y/MHvBftuhkTEsevSVtwfsBDErX0hjyac5V/Yb/G', 'admin', '2024-06-09 18:23:33', NULL),
	(2, 'User', '605270495', 'user@user.com', '$2y$10$Nm5AyY7wpPN7juf4r9eZZOdYv1F5LCe3SKvL7q2F.dE48gt.Vh3V.', 'Utilisateur', '2024-07-14 19:42:04', NULL);

-- Listage de la structure de table barber. galerie
CREATE TABLE IF NOT EXISTS `galerie` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `imageUrl` varchar(500) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_image`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.galerie : ~4 rows (environ)
INSERT INTO `galerie` (`id_image`, `titre`, `imageUrl`, `date_creation`) VALUES
	(1, 'coupe', 'image1.webp', '2024-04-25 13:10:57'),
	(2, 'coupe de cheveux', 'image2.webp', '2024-04-25 13:10:57'),
	(3, 'soins du visage', 'image0.webp', '2024-04-23 11:39:21'),
	(4, 'coupe de cheveux', 'image3.webp', '2024-04-25 13:21:18');

-- Listage de la structure de table barber. messagecontact
CREATE TABLE IF NOT EXISTS `messagecontact` (
  `id_messageContact` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categoryContact_id` int DEFAULT NULL,
  PRIMARY KEY (`id_messageContact`) USING BTREE,
  KEY `categoryContact_id` (`categoryContact_id`),
  CONSTRAINT `categoryContact` FOREIGN KEY (`categoryContact_id`) REFERENCES `categorycontact` (`id_categoryContact`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.messagecontact : ~4 rows (environ)
INSERT INTO `messagecontact` (`id_messageContact`, `name`, `email`, `message`, `dateCreation`, `categoryContact_id`) VALUES
	(1, 'user', 'user@user.com', 'bonjour', '2024-05-29 16:54:23', 1),
	(2, 'userTest', 'user@user.com', 'message test', '2024-05-29 16:57:28', 1),
	(3, 'UserTest', 'user@user.com', 'message test ', '2024-05-30 11:26:29', 2),
	(4, 'user', 'user@user.com', 'message test ', '2024-05-31 11:26:20', 2);

-- Listage de la structure de table barber. news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.news : ~2 rows (environ)
INSERT INTO `news` (`id`, `title`, `photo`, `text`, `date`) VALUES
	(1, 'Nouveau Programme de Fidélité : Économisez 15% chaque mois !', 'actu.webp', 'Découvrez notre tout nouveau programme de fidélité chez Jesuispassechezsouf ! À partir de maintenant, vous bénéficiez d\'une réduction de 15% sur chaque deuxième prestation réalisée dans le même mois. C\'est notre façon de récompenser votre fidélité et de vous offrir des économies régulières sur vos services de coiffure et de rasage. Lors de votre prochaine visite, informez simplement votre coiffeur que vous participez à notre programme de fidélité pour profiter de cette offre exclusive. Ne manquez pas cette occasion d\'économiser et de profiter des meilleurs soins capillaires et de rasage. Prenez rendez-vous dès aujourd\'hui pour commencer à bénéficier de notre programme de fidélité mensuel !', '2024-05-06 11:27:24');

-- Listage de la structure de table barber. reservations
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
) ENGINE=InnoDB AUTO_INCREMENT=466 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table barber.reservations : ~176 rows (environ)
INSERT INTO `reservations` (`id_reservation`, `service_id`, `client_id`, `date`, `heure`) VALUES
	(274, 1, NULL, '2024-07-22', '09:00:00'),
	(275, 1, NULL, '2024-07-22', '09:30:00'),
	(276, 1, NULL, '2024-07-22', '10:00:00'),
	(277, 1, NULL, '2024-07-22', '10:30:00'),
	(278, 1, NULL, '2024-07-22', '11:00:00'),
	(279, 1, NULL, '2024-07-22', '11:30:00'),
	(280, 1, NULL, '2024-07-22', '13:00:00'),
	(281, 1, NULL, '2024-07-22', '13:30:00'),
	(282, 1, NULL, '2024-07-22', '14:00:00'),
	(283, 1, NULL, '2024-07-22', '14:30:00'),
	(284, 1, NULL, '2024-07-22', '15:00:00'),
	(285, 1, NULL, '2024-07-22', '15:30:00'),
	(286, 1, NULL, '2024-07-22', '16:00:00'),
	(287, 1, NULL, '2024-07-22', '16:30:00'),
	(288, 1, NULL, '2024-07-22', '17:00:00'),
	(289, 1, NULL, '2024-07-22', '17:30:00'),
	(290, 1, NULL, '2024-07-23', '09:00:00'),
	(291, 1, NULL, '2024-07-23', '09:30:00'),
	(292, 1, NULL, '2024-07-23', '10:00:00'),
	(293, 1, NULL, '2024-07-23', '10:30:00'),
	(294, 1, NULL, '2024-07-23', '11:00:00'),
	(295, 1, NULL, '2024-07-23', '11:30:00'),
	(296, 1, NULL, '2024-07-23', '13:00:00'),
	(297, 1, NULL, '2024-07-23', '13:30:00'),
	(298, 1, NULL, '2024-07-23', '14:00:00'),
	(299, 1, NULL, '2024-07-23', '14:30:00'),
	(300, 1, NULL, '2024-07-23', '15:00:00'),
	(301, 1, NULL, '2024-07-23', '15:30:00'),
	(302, 1, NULL, '2024-07-23', '16:00:00'),
	(303, 1, NULL, '2024-07-23', '16:30:00'),
	(304, 1, NULL, '2024-07-23', '17:00:00'),
	(305, 1, NULL, '2024-07-23', '17:30:00'),
	(306, 1, NULL, '2024-07-24', '09:00:00'),
	(307, 1, NULL, '2024-07-24', '09:30:00'),
	(308, 1, NULL, '2024-07-24', '10:00:00'),
	(309, 1, NULL, '2024-07-24', '10:30:00'),
	(310, 1, NULL, '2024-07-24', '11:00:00'),
	(311, 1, NULL, '2024-07-24', '11:30:00'),
	(312, 1, NULL, '2024-07-24', '13:00:00'),
	(313, 1, NULL, '2024-07-24', '13:30:00'),
	(314, 1, NULL, '2024-07-24', '14:00:00'),
	(315, 1, NULL, '2024-07-24', '14:30:00'),
	(316, 1, NULL, '2024-07-24', '15:00:00'),
	(317, 1, NULL, '2024-07-24', '15:30:00'),
	(318, 1, NULL, '2024-07-24', '16:00:00'),
	(319, 1, NULL, '2024-07-24', '16:30:00'),
	(320, 1, NULL, '2024-07-24', '17:00:00'),
	(321, 1, NULL, '2024-07-24', '17:30:00'),
	(322, 1, NULL, '2024-07-25', '09:00:00'),
	(323, 1, NULL, '2024-07-25', '09:30:00'),
	(324, 1, NULL, '2024-07-25', '10:00:00'),
	(325, 1, NULL, '2024-07-25', '10:30:00'),
	(326, 1, NULL, '2024-07-25', '11:00:00'),
	(327, 1, NULL, '2024-07-25', '11:30:00'),
	(328, 1, NULL, '2024-07-25', '13:00:00'),
	(329, 1, NULL, '2024-07-25', '13:30:00'),
	(330, 1, NULL, '2024-07-25', '14:00:00'),
	(331, 1, NULL, '2024-07-25', '14:30:00'),
	(332, 1, NULL, '2024-07-25', '15:00:00'),
	(333, 1, NULL, '2024-07-25', '15:30:00'),
	(334, 1, NULL, '2024-07-25', '16:00:00'),
	(335, 1, NULL, '2024-07-25', '16:30:00'),
	(336, 1, NULL, '2024-07-25', '17:00:00'),
	(337, 1, NULL, '2024-07-25', '17:30:00'),
	(338, 1, NULL, '2024-07-26', '09:00:00'),
	(339, 1, NULL, '2024-07-26', '09:30:00'),
	(340, 1, NULL, '2024-07-26', '10:00:00'),
	(341, 1, NULL, '2024-07-26', '10:30:00'),
	(342, 1, NULL, '2024-07-26', '11:00:00'),
	(343, 1, NULL, '2024-07-26', '11:30:00'),
	(344, 1, NULL, '2024-07-26', '13:00:00'),
	(345, 1, NULL, '2024-07-26', '13:30:00'),
	(346, 1, NULL, '2024-07-26', '14:00:00'),
	(347, 1, NULL, '2024-07-26', '14:30:00'),
	(348, 1, NULL, '2024-07-26', '15:00:00'),
	(349, 1, NULL, '2024-07-26', '15:30:00'),
	(350, 1, NULL, '2024-07-26', '16:00:00'),
	(351, 1, NULL, '2024-07-26', '16:30:00'),
	(352, 1, NULL, '2024-07-26', '17:00:00'),
	(353, 1, NULL, '2024-07-26', '17:30:00'),
	(370, 1, 2, '2024-07-15', '09:00:00'),
	(371, 1, 2, '2024-07-15', '09:30:00'),
	(372, 1, 2, '2024-07-15', '10:00:00'),
	(373, 1, 2, '2024-07-15', '10:30:00'),
	(374, 1, 2, '2024-07-15', '11:00:00'),
	(375, 1, 2, '2024-07-15', '11:30:00'),
	(376, 1, 2, '2024-07-15', '13:00:00'),
	(377, 1, 2, '2024-07-15', '13:30:00'),
	(378, 1, 2, '2024-07-15', '14:00:00'),
	(379, 1, 2, '2024-07-15', '14:30:00'),
	(380, 1, 2, '2024-07-15', '15:00:00'),
	(381, 1, 2, '2024-07-15', '15:30:00'),
	(382, 1, 2, '2024-07-15', '16:00:00'),
	(383, 1, 2, '2024-07-15', '16:30:00'),
	(386, 1, 2, '2024-07-16', '09:00:00'),
	(387, 1, 2, '2024-07-16', '09:30:00'),
	(388, 1, 2, '2024-07-16', '10:00:00'),
	(389, 1, 2, '2024-07-16', '10:30:00'),
	(390, 1, 2, '2024-07-16', '11:00:00'),
	(391, 1, 2, '2024-07-16', '11:30:00'),
	(392, 1, 2, '2024-07-16', '13:00:00'),
	(393, 1, 2, '2024-07-16', '13:30:00'),
	(394, 1, 2, '2024-07-16', '14:00:00'),
	(395, 1, 2, '2024-07-16', '14:30:00'),
	(396, 1, 2, '2024-07-16', '15:00:00'),
	(397, 1, 2, '2024-07-16', '15:30:00'),
	(398, 1, 2, '2024-07-16', '16:00:00'),
	(399, 1, 2, '2024-07-16', '16:30:00'),
	(400, 1, 2, '2024-07-16', '17:00:00'),
	(401, 1, 2, '2024-07-16', '17:30:00'),
	(402, 1, 2, '2024-07-17', '09:00:00'),
	(403, 1, 2, '2024-07-17', '09:30:00'),
	(404, 1, 2, '2024-07-17', '10:00:00'),
	(405, 1, 2, '2024-07-17', '10:30:00'),
	(406, 1, 2, '2024-07-17', '11:00:00'),
	(407, 1, 2, '2024-07-17', '11:30:00'),
	(408, 1, 2, '2024-07-17', '13:00:00'),
	(409, 1, 2, '2024-07-17', '13:30:00'),
	(410, 1, 2, '2024-07-17', '14:00:00'),
	(411, 1, 2, '2024-07-17', '14:30:00'),
	(412, 1, 2, '2024-07-17', '15:00:00'),
	(413, 1, 2, '2024-07-17', '15:30:00'),
	(414, 1, 2, '2024-07-17', '16:00:00'),
	(415, 1, 2, '2024-07-17', '16:30:00'),
	(416, 1, 2, '2024-07-17', '17:00:00'),
	(417, 1, 2, '2024-07-17', '17:30:00'),
	(418, 1, 2, '2024-07-18', '09:00:00'),
	(419, 1, 2, '2024-07-18', '09:30:00'),
	(420, 1, 2, '2024-07-18', '10:00:00'),
	(421, 1, 2, '2024-07-18', '10:30:00'),
	(422, 1, 2, '2024-07-18', '11:00:00'),
	(423, 1, 2, '2024-07-18', '11:30:00'),
	(424, 1, 2, '2024-07-18', '13:00:00'),
	(425, 1, 2, '2024-07-18', '13:30:00'),
	(426, 1, 2, '2024-07-18', '14:00:00'),
	(427, 1, 2, '2024-07-18', '14:30:00'),
	(428, 1, 2, '2024-07-18', '15:00:00'),
	(429, 1, 2, '2024-07-18', '15:30:00'),
	(430, 1, 2, '2024-07-18', '16:00:00'),
	(431, 1, 2, '2024-07-18', '16:30:00'),
	(432, 1, 2, '2024-07-18', '17:00:00'),
	(433, 1, 2, '2024-07-18', '17:30:00'),
	(434, 1, 2, '2024-07-19', '09:00:00'),
	(435, 1, 2, '2024-07-19', '09:30:00'),
	(436, 1, 2, '2024-07-19', '10:00:00'),
	(437, 1, 2, '2024-07-19', '10:30:00'),
	(438, 1, 2, '2024-07-19', '11:00:00'),
	(439, 1, 2, '2024-07-19', '11:30:00'),
	(440, 1, 2, '2024-07-19', '13:00:00'),
	(441, 1, 2, '2024-07-19', '13:30:00'),
	(442, 1, 2, '2024-07-19', '14:00:00'),
	(443, 1, 2, '2024-07-19', '14:30:00'),
	(444, 1, 2, '2024-07-19', '15:00:00'),
	(445, 1, 2, '2024-07-19', '15:30:00'),
	(446, 1, 2, '2024-07-19', '16:00:00'),
	(447, 1, 2, '2024-07-19', '16:30:00'),
	(448, 1, 2, '2024-07-19', '17:00:00'),
	(449, 1, 2, '2024-07-19', '17:30:00'),
	(450, 1, 2, '2024-07-20', '09:00:00'),
	(451, 1, 2, '2024-07-20', '09:30:00'),
	(452, 1, 2, '2024-07-20', '10:00:00'),
	(453, 1, 2, '2024-07-20', '10:30:00'),
	(454, 1, 2, '2024-07-20', '11:00:00'),
	(455, 1, 2, '2024-07-20', '11:30:00'),
	(456, 1, 2, '2024-07-20', '13:00:00'),
	(457, 1, 2, '2024-07-20', '13:30:00'),
	(458, 1, 2, '2024-07-20', '14:00:00'),
	(459, 1, 2, '2024-07-20', '14:30:00'),
	(460, 1, 2, '2024-07-20', '15:00:00'),
	(461, 1, 2, '2024-07-20', '15:30:00'),
	(462, 1, 2, '2024-07-20', '16:00:00'),
	(463, 1, 2, '2024-07-20', '16:30:00'),
	(464, 1, 2, '2024-07-20', '17:00:00'),
	(465, 1, 2, '2024-07-20', '17:30:00');

-- Listage de la structure de table barber. service
CREATE TABLE IF NOT EXISTS `service` (
  `id_service` int NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `duration` datetime DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id_service`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table barber.service : ~14 rows (environ)
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
