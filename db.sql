-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 19 juil. 2024 à 11:51
-- Version du serveur : 8.0.30
-- Version de PHP : 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `api-store`
--

-- --------------------------------------------------------

--
-- Structure de la table `stores`
--

CREATE TABLE `stores` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `stores`
--

INSERT INTO stores (name, city) VALUES 
('Magasin Alpha', 'Paris'),
('Magasin Beta', 'Lyon'),
('Magasin Gamma', 'Marseille'),
('Magasin Delta', 'Paris'),
('Magasin Epsilon', 'Lyon'),
('Magasin Zeta', 'Marseille'),
('Magasin Eta', 'Nice'),
('Magasin Theta', 'Bordeaux'),
('Magasin Iota', 'Nantes'),
('Magasin Kappa', 'Strasbourg'),
('Alpha Shop', 'Paris'),
('Beta Shop', 'Lyon'),
('Gamma Store', 'Marseille'),
('Delta Mart', 'Paris'),
('Epsilon Store', 'Lyon'),
('Zeta Shop', 'Marseille'),
('Eta Mart', 'Nice'),
('Theta Shop', 'Bordeaux'),
('Iota Mart', 'Nantes'),
('Kappa Shop', 'Strasbourg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
