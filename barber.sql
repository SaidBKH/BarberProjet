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

-- Listage des données de la table barber.categorie : ~6 rows (environ)
INSERT INTO `categorie` (`id_categorie`, `nomCategorie`) VALUES
	(1, 'Coupe'),
	(2, 'Barbe'),
	(3, 'Coupe + Barbe'),
	(4, 'Soins'),
	(5, 'Coloration'),
	(6, 'Defrissage');

-- Listage des données de la table barber.service : ~14 rows (environ)
INSERT INTO `service` (`id_service`, `nom`, `prix`, `duree`, `categorie_id`) VALUES
	(1, 'Coupe Homme', 30, '00:30:00', 1),
	(2, 'Coupe Etudiant', 25, '00:30:00', 1),
	(3, 'Coupe Enfant', 20, '00:30:00', 1),
	(4, 'Coupe Premium', 50, '00:30:00', 1),
	(5, 'Barbe ', 20, '00:30:00', 2),
	(6, 'Barbe Premium', 30, '00:30:00', 2),
	(7, 'Coupe + Barbe Homme', 40, '00:30:00', 3),
	(8, 'Coupe + Barbe Etudiant', 35, '00:30:00', 3),
	(9, 'Coupe + Barbe Premium', 70, '00:30:00', 3),
	(10, 'Soin du visage complet', 40, '00:30:00', 4),
	(11, 'Couleur tête entière ', 70, '00:30:00', 5),
	(12, 'Mèches', 50, '00:30:00', 5),
	(13, 'Coloration de la barbe', 30, '00:30:00', 5),
	(14, 'Défrisage', 50, '00:30:00', 6);

-- Listage des données de la table barber.user_ : ~2 rows (environ)
INSERT INTO `user_` (`id_user`, `prenom`, `email`, `password`, `telephone`, `role`, `creationDate`) VALUES
	(1, 'said', 'said@said.fr', '$2y$10$QoqcloB/5FORzc3J9ulyM.ri5kaMK2.rvbqVJjou9gO0o7tx/h6.i', '0388218891', 'Utilisateur', '2024-03-22 00:00:00'),
	(2, 'MOMO', 'momo@gmail.com', '$2y$10$bn0U1Jha0C5FV1kV66RtKe7M25Z/mxQFzrrkqlqvvlI.KhtNLZRzC', '0388218895', 'Utilisateur', '2024-03-22 10:52:25');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
