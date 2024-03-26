-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 26 mars 2024 à 13:56
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae`
--

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `nature` varchar(100) NOT NULL,
  `niveau` int(1) NOT NULL,
  `salle` varchar(6) NOT NULL,
  `demandeur` varchar(100) NOT NULL,
  `concerne` varchar(100) NOT NULL,
  `description` varchar(400) NOT NULL,
  `etat` varchar(50) NOT NULL DEFAULT 'ouvert',
  `login` varchar(15) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `technicien_login` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tickets`
--

INSERT INTO `tickets` (`id`, `nature`, `niveau`, `salle`, `demandeur`, `concerne`, `description`, `etat`, `login`, `date`, `technicien_login`) VALUES
(18, 'Problèmes de périphériques', 1, 'I22', 'hug', 'hg', 'test', 'ouvert', 'Maxime', '2024-03-26 12:55:03', NULL),
(20, 'Problèmes de périphériques', 1, 'Aucune', 'hug', 'hg', 'test', 'ouvert', 'Maxime', '2024-03-26 13:53:36', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `technicien_login` (`technicien_login`),
  ADD KEY `salle` (`salle`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_technicien_login` FOREIGN KEY (`technicien_login`) REFERENCES `users` (`login`),
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`salle`) REFERENCES `salle` (`salle`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
