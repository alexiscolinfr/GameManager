-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 04 avr. 2018 à 21:49
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_jeu`
--

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `idHistorique` int(11) NOT NULL,
  `numTour` int(11) NOT NULL,
  `EtatJeu` varchar(4000) NOT NULL,
  `idPartie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`idHistorique`, `numTour`, `EtatJeu`, `idPartie`) VALUES
(1, 1, 'Le jeu commence', 2),
(2, 2, 'Alexis achète Paris', 2),
(3, 3, 'Benjmain est en prison', 2),
(4, 4, 'Luca vend New-York', 2),
(5, 5, 'Alexis tombe sur la case chance', 2),
(6, 6, 'Benjamin achète la gare Saint-Lazare ', 2),
(7, 15, 'Luca gagne la partie', 2),
(8, 1, 'Le jeu commence', 1),
(9, 2, 'Alexis pose son jeton', 1),
(10, 3, 'Luca pose son jeton', 1),
(11, 4, 'Alexis pose son deuxième jeton', 1),
(12, 5, 'Luca pose son deuxième jeton', 1),
(13, 6, 'Alexis pose son troisième jeton', 1),
(14, 7, 'Alexis gagne la partie', 1);

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

CREATE TABLE `jeux` (
  `nomJeu` varchar(100) NOT NULL,
  `nbJoueursMax` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`nomJeu`, `nbJoueursMax`, `description`) VALUES
('Civilization V', 10, 'Civilization V est un jeu vidéo de stratégie au tour par tour développé par Firaxis Games et édité par 2K Games. Il fait partie de la série Civilization.'),
('Monopoly', 6, 'Le Monopoly est un jeu de société américain édité par Hasbro. Le but du jeu consiste à ruiner ses concurrents par des opérations immobilières. Il symbolise les aspects apparents et spectaculaires du capitalisme, les fortunes se faisant et se défaisant au fil des coups de dés.'),
('Morpion', 2, 'Le tic-tac-toe, aussi appelé « morpion », est un jeu de réflexion se pratiquant à deux joueurs au tour par tour dont le but est de créer le premier un alignement.');

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

CREATE TABLE `joueurs` (
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `nbPartieJoue` int(11) NOT NULL,
  `nbPartieGagne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `joueurs`
--

INSERT INTO `joueurs` (`pseudo`, `mdp`, `nbPartieJoue`, `nbPartieGagne`) VALUES
('admin', 'admin', 0, 0),
('alexis', 'alexis', 0, 0),
('benjamin', 'benjamin', 0, 0),
('corentin', 'corentin', 0, 0),
('luca', 'luca', 0, 0),
('stan', 'stan', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `joueursparpartie`
--

CREATE TABLE `joueursparpartie` (
  `pseudo` varchar(50) NOT NULL,
  `idPartie` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `joueursparpartie`
--

INSERT INTO `joueursparpartie` (`pseudo`, `idPartie`, `score`) VALUES
('alexis', 1, 50),
('benjamin', 2, 3),
('luca', 1, 22),
('alexis', 2, 6),
('luca', 2, 24);

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

CREATE TABLE `partie` (
  `idPartie` int(11) NOT NULL,
  `nbJoueurs` int(11) NOT NULL,
  `nomJeu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `partie`
--

INSERT INTO `partie` (`idPartie`, `nbJoueurs`, `nomJeu`) VALUES
(1, 2, 'Morpion'),
(2, 3, 'Monopoly');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`idHistorique`);

--
-- Index pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD PRIMARY KEY (`nomJeu`);

--
-- Index pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD PRIMARY KEY (`pseudo`);

--
-- Index pour la table `partie`
--
ALTER TABLE `partie`
  ADD PRIMARY KEY (`idPartie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `idHistorique` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `partie`
--
ALTER TABLE `partie`
  MODIFY `idPartie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
