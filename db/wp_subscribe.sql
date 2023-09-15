-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 18 juin 2023 à 23:53
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wordpress`
--

-- --------------------------------------------------------

--
-- Structure de la table `wp_subscribe`
--

CREATE TABLE `wp_subscribe` (
  `id` int(11) NOT NULL,
  `master_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_bac` varchar(100) NOT NULL,
  `sub_high_school` varchar(100) NOT NULL,
  `sub_mention` varchar(50) NOT NULL,
  `sub_university` varchar(100) NOT NULL,
  `sub_licence` varchar(100) NOT NULL,
  `sub_mention_licence` varchar(100) NOT NULL,
  `sub_bac_file` varchar(50) NOT NULL,
  `sub_licence_file` text NOT NULL,
  `sub_inserted_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `wp_subscribe`
--
ALTER TABLE `wp_subscribe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscribe_user` (`user_id`),
  ADD KEY `subscribe_master` (`master_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `wp_subscribe`
--
ALTER TABLE `wp_subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `wp_subscribe`
--
ALTER TABLE `wp_subscribe`
  ADD CONSTRAINT `subscribe_master` FOREIGN KEY (`master_id`) REFERENCES `wp_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscribe_user` FOREIGN KEY (`user_id`) REFERENCES `wp_visitors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
