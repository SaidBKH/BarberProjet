-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 12 mai 2024 à 20:40
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `barber`
--

-- --------------------------------------------------------

--
-- Structure de la table `actualites`
--

CREATE TABLE `actualites` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `texte` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `actualites`
--

INSERT INTO `actualites` (`id`, `titre`, `photo`, `texte`, `date`) VALUES
(1, 'Nouveau Programme de Fidélité : Économisez 15% chaque mois !', 'http://localhost:8888/BarberProjet-3/public/img/actu.jpeg\n', 'Découvrez notre tout nouveau programme de fidélité chez Jesuispassechezsouf ! À partir de maintenant, vous bénéficiez d\'une réduction de 15% sur chaque deuxième prestation réalisée dans le même mois.\n\nC\'est notre façon de récompenser votre fidélité et de vous offrir des économies régulières sur vos services de coiffure et de rasage. Lors de votre prochaine visite, informez simplement votre coiffeur que vous participez à notre programme de fidélité pour profiter de cette offre exclusive.\n\nNe manquez pas cette occasion d\'économiser et de profiter des meilleurs soins capillaires et de rasage. Prenez rendez-vous dès aujourd\'hui pour commencer à bénéficier de notre programme de fidélité mensuel !', '2024-05-06 13:27:24');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `nomCategorie` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nomCategorie`) VALUES
(1, 'coupe'),
(2, 'barbe'),
(3, 'coupe + barbe'),
(4, 'soin'),
(5, 'couleur');

-- --------------------------------------------------------

--
-- Structure de la table `categories_message_contact`
--

CREATE TABLE `categories_message_contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories_message_contact`
--

INSERT INTO `categories_message_contact` (`id`, `nom`) VALUES
(1, 'Demande d\'Informations'),
(2, 'Réclamations'),
(3, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `galerie`
--

CREATE TABLE `galerie` (
  `id_image` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `imageUrl` varchar(500) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `galerie`
--

INSERT INTO `galerie` (`id_image`, `titre`, `imageUrl`, `date_creation`) VALUES
(1, 'coupe', 'http://localhost:8888/BarberProjet-3/public/img/image1.jpeg\n', '2024-04-25 15:10:57'),
(2, 'coupe de cheveux', 'http://localhost:8888/BarberProjet-3/public/img/image2.jpeg\r\n', '2024-04-25 15:10:57'),
(3, '', 'http://localhost:8888/BarberProjet-3/public/img/image0.jpeg\n', '2024-04-23 13:39:21'),
(4, 'coupe de cheveux ', 'http://localhost:8888/BarberProjet-3/public/img/image3.jpeg\r\n', '2024-04-25 15:21:18');

-- --------------------------------------------------------

--
-- Structure de la table `messages_contact`
--

CREATE TABLE `messages_contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE `planning` (
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `id_reservation` int(11) DEFAULT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

CREATE TABLE `rdv` (
  `id_rdv` int(11) NOT NULL,
  `rdv_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rdv_disponible`
--

CREATE TABLE `rdv_disponible` (
  `id_reservation` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL DEFAULT '0',
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `duree` datetime DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `service`
--

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

-- --------------------------------------------------------

--
-- Structure de la table `user_`
--

CREATE TABLE `user_` (
  `id_user` int(55) NOT NULL,
  `prenom` varchar(55) NOT NULL,
  `telephone` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(55) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_`
--

INSERT INTO `user_` (`id_user`, `prenom`, `telephone`, `email`, `password`, `role`, `creationDate`) VALUES
(1, 'said', '0388218891', 'said@said.fr', '$2y$10$QoqcloB/5FORzc3J9ulyM.ri5kaMK2.rvbqVJjou9gO0o7tx/h6.i', 'Utilisateur', '2024-03-21 23:00:00'),
(2, 'MOMO', '0388218895', 'momo@gmail.com', '$2y$10$bn0U1Jha0C5FV1kV66RtKe7M25Z/mxQFzrrkqlqvvlI.KhtNLZRzC', 'Utilisateur', '2024-03-22 09:52:25'),
(3, 'sarah', '0303030303', 'sarah@sarah.fr', '$2y$10$QjJFgZg9hETmhJCs2p8eReDpZrWK5p0c5RK0WU4885W1mEhNFzAN.', 'Utilisateur', '2024-03-27 17:16:31');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actualites`
--
ALTER TABLE `actualites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `categories_message_contact`
--
ALTER TABLE `categories_message_contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `galerie`
--
ALTER TABLE `galerie`
  ADD PRIMARY KEY (`id_image`);

--
-- Index pour la table `messages_contact`
--
ALTER TABLE `messages_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categorie` (`categorie_id`);

--
-- Index pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD PRIMARY KEY (`id_rdv`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- Index pour la table `user_`
--
ALTER TABLE `user_`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actualites`
--
ALTER TABLE `actualites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categories_message_contact`
--
ALTER TABLE `categories_message_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `galerie`
--
ALTER TABLE `galerie`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `messages_contact`
--
ALTER TABLE `messages_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user_`
--
ALTER TABLE `user_`
  MODIFY `id_user` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `messages_contact`
--
ALTER TABLE `messages_contact`
  ADD CONSTRAINT `fk_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categories_message_contact` (`id`);

--
-- Contraintes pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `rdv_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`id_service`),
  ADD CONSTRAINT `rdv_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
