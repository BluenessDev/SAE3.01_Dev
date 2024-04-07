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
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `salle` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`salle`) VALUES
('Aucune'),
('E46'),
('E47'),
('E49'),
('E50'),
('E51'),
('E52'),
('E53'),
('E54'),
('E57'),
('E58'),
('E59'),
('G21'),
('G22'),
('G23'),
('G24'),
('G25'),
('G26'),
('G31'),
('G32'),
('G33'),
('G34'),
('G35'),
('G51'),
('G52'),
('G53'),
('G54'),
('H11'),
('H21'),
('H22'),
('H23'),
('H24'),
('H31'),
('H32'),
('H33'),
('H41'),
('H42'),
('H44'),
('H45'),
('H61'),
('H62'),
('I03'),
('I21'),
('I22'),
('I23'),
('I24');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`salle`),
  ADD KEY `numero` (`salle`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
