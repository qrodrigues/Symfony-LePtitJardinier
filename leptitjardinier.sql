-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : mer. 30 mars 2022 à 09:22
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `leptitjardinier`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
(1, 'Persistant'),
(2, 'Caduque'),
(3, 'Monospécifiques'),
(4, 'Bocagères');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp` int(11) NOT NULL,
  `type_client` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

DROP TABLE IF EXISTS `devis`;
CREATE TABLE IF NOT EXISTS `devis` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  PRIMARY KEY (`no`),
  KEY `IDX_8B27C52BFB88E14F` (`utilisateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devis`
--

INSERT INTO `devis` (`no`, `utilisateur_id`, `date`, `montant`) VALUES
(5, 10, '2022-03-22', '219.60'),
(6, 9, '2022-03-22', '210.00');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220316100205', '2022-03-16 10:02:08', 754),
('DoctrineMigrations\\Version20220317124703', '2022-03-17 12:47:10', 77),
('DoctrineMigrations\\Version20220318192537', '2022-03-18 19:25:41', 391),
('DoctrineMigrations\\Version20220318192803', '2022-03-18 19:28:07', 183),
('DoctrineMigrations\\Version20220318193326', '2022-03-18 19:33:32', 280),
('DoctrineMigrations\\Version20220318193709', '2022-03-18 19:37:13', 325),
('DoctrineMigrations\\Version20220318194122', '2022-03-18 19:41:27', 309),
('DoctrineMigrations\\Version20220318194722', '2022-03-18 19:47:26', 269),
('DoctrineMigrations\\Version20220322140146', '2022-03-22 14:01:48', 232),
('DoctrineMigrations\\Version20220322140623', '2022-03-22 14:06:28', 183),
('DoctrineMigrations\\Version20220322142326', '2022-03-22 14:23:30', 165);

-- --------------------------------------------------------

--
-- Structure de la table `haie`
--

DROP TABLE IF EXISTS `haie`;
CREATE TABLE IF NOT EXISTS `haie` (
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`code`),
  KEY `IDX_1F24E4DEBCF5E72D` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `haie`
--

INSERT INTO `haie` (`code`, `categorie_id`, `nom`, `prix`) VALUES
('A1', 1, 'Abélia', '12.00'),
('F1', 2, 'Fusain', '14.00'),
('L1', 4, 'Laurier', '12.00'),
('T1', 3, 'Thuya', '8.00'),
('T2', 2, 'Troène', '14.00');

-- --------------------------------------------------------

--
-- Structure de la table `tailler`
--

DROP TABLE IF EXISTS `tailler`;
CREATE TABLE IF NOT EXISTS `tailler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_haie_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hauteur` decimal(10,2) NOT NULL,
  `longueur` decimal(10,2) NOT NULL,
  `devis_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_447D1788DFE04BB0` (`code_haie_id`),
  KEY `IDX_447D178841DEFADA` (`devis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tailler`
--

INSERT INTO `tailler` (`id`, `code_haie_id`, `hauteur`, `longueur`, `devis_id`) VALUES
(3, 'L1', '2.00', '10.00', 5),
(4, 'T1', '1.00', '8.00', 5),
(5, 'F1', '2.00', '10.00', 6);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp` int(11) NOT NULL,
  `type_client` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1D1C63B3F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `username`, `roles`, `password`, `nom`, `prenom`, `adresse`, `ville`, `cp`, `type_client`) VALUES
(1, 'admin', '[\"ROLE_ADMIN\"]', '$2y$13$l0BuD7zDynR3KDgJfWXMZOs5sj/zKLHdM.ssmxyq7bDsjlr/XjXnG', 'admin', 'admin', 'admin', 'admin', 11111, 'admin'),
(9, 'Quentin', '[]', '$2y$13$lcPOe5C1PrV8k97ccwUSMuDbqZUv/XIIXsk6MsjL37izb/AIpZHrm', 'Rodrigues', 'Quentin', '14 rue du sable', 'Limoges', 87000, 'particulier'),
(10, 'Sebastien', '[]', '$2y$13$e9oS0Lem4ZSH/4M8p0heruIFW7Wpc7fYezJwf9Rij.dp/7pp73zv6', 'Roche', 'Sebastien', '20 allée des ombres', 'Gueret', 23000, 'entreprise');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `devis`
--
ALTER TABLE `devis`
  ADD CONSTRAINT `FK_8B27C52BFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `haie`
--
ALTER TABLE `haie`
  ADD CONSTRAINT `FK_1F24E4DEBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `tailler`
--
ALTER TABLE `tailler`
  ADD CONSTRAINT `FK_447D178841DEFADA` FOREIGN KEY (`devis_id`) REFERENCES `devis` (`no`),
  ADD CONSTRAINT `FK_447D1788DFE04BB0` FOREIGN KEY (`code_haie_id`) REFERENCES `haie` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
