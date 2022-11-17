-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 17 nov. 2022 à 19:47
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `controle_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

CREATE TABLE `auteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`id`, `nom`) VALUES
(1, 'Jules Verne'),
(2, 'George Orwell'),
(3, 'Andy Weir'),
(4, 'Suzanne Collins'),
(5, 'Stendhal'),
(6, 'James Dashner'),
(7, 'Alex Scarrow'),
(8, 'J.K Rowling');

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

CREATE TABLE `livres` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `synopsis` text NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `date_parution` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`id`, `titre`, `synopsis`, `id_auteur`, `date_parution`) VALUES
(1, 'Vingt Mille Lieues sous les Mers', 'Un scientifique et ses amis se retrouvent dans un sous-marin qui les emmènera dans une aventure tout autour du monde.', 1, '1869-03-20'),
(2, '1984', 'Dans une société totalitaire, un homme va essayer de résister au régime de son pays (et va lamentablement échouer).', 2, '1949-06-08'),
(3, 'Seul sur Mars', 'Suite à une tempête et au départ de son équipage, Mark Watney se retrouve tout seul sur la planète Mars et va devoir se battre pour survivre.', 3, '2014-09-17'),
(4, 'Hunger Games', 'Dans une société futuriste et totalitaire, une jeune femme est contrainte de participer à un jeu mortel où seul une personne pourra survivre.', 4, '2008-09-14'),
(5, 'Le Rouge et le Noir', 'Les aventures de Julien Sorel, fils de charpentier, qui va réussir à grimper l\'échelle sociale.', 5, '1830-11-13'),
(6, 'Le Labyrinthe', 'Thomas se réveille amnésique au milieu d\'un labyrinthe avec un groupe de jeunes. Il devra se battre pour survivre et sortir de là.', 6, '2009-10-21'),
(9, 'Time Riders', 'Trois jeunes doivent sauver notre réalité grâce à leur machine à voyager dans le temps.', 7, '2010-10-10');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_auteur` (`id_auteur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `auteur`
--
ALTER TABLE `auteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `livres`
--
ALTER TABLE `livres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `livres`
--
ALTER TABLE `livres`
  ADD CONSTRAINT `livres_ibfk_1` FOREIGN KEY (`id_auteur`) REFERENCES `auteur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
