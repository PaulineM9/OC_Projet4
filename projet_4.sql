-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 11 juil. 2019 à 18:58
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_4`
--

-- --------------------------------------------------------

--
-- Structure de la table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chapters`
--

INSERT INTO `chapters` (`id`, `title`, `content`) VALUES
(41, 'Chapitre 1: Oh l\'Alaska ', 'C\'est beau la neige.'),
(42, 'Chapitre 2: On part en luge', 'J\'ai pas de luge'),
(43, 'Chapitre 3: Oh des flocons!', 'En Alaska c\'est toujours l\'hiver. Et il fait froid.'),
(44, 'Chapitre 4: Voilà le grand froid.', '<p><em>J\'aime vraiment quand il fait <strong>froid</strong> et grand beau temps.</em></p>'),
(45, 'Chapitre 5: Des traces dans la neige ', '<h1>Je vois des traces de rennes dans la neige.</h1>'),
(46, 'Chapitre 6: Des pulls et des chaussons', '<p>Il fait vraiment tr&eacute;s <strong>froid</strong>. Je reste pr&eacute;s du <strong>feu. </strong></p>'),
(47, 'Chapitre 7: Des ours dans la forêt.', '<p><em>Je vois des ours dans la <strong>for&ecirc;t.</strong></em></p>'),
(48, 'Chapitre 8: Et des oiseaux sur mon balcon.', '<p><span style=\"text-decoration: line-through; color: #2fcc71;\"><span style=\"text-decoration: underline;\"><em><span style=\"font-family: terminal, monaco, monospace;\">Il y aussi des <strong>oiseaux</strong> sur mon <strong>balcon</strong>.</span></em></span></span></p>\r\n<p><span style=\"text-decoration: line-through; color: #2fcc71;\"><span style=\"text-decoration: underline;\"><em><span style=\"font-family: terminal, monaco, monospace;\">C\'est ok </span></em></span></span></p>');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_chapter` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `date_comment` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `signaled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `identifiant`, `email`, `password`) VALUES
(76, 'Jean_Forteroche', 'jean@gmail.com', '$2y$10$GAnUWygpKsycvfwEHob.LOn4MDpmfHLuIKHC9X6ym2R3rimcMlrHm');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
