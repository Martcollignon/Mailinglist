-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Mar 12 Janvier 2016 à 17:16
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `mailinglist`
--

-- --------------------------------------------------------

--
-- Structure de la table `mailinglist`
--

CREATE TABLE `mailinglist` (
  `id` int(11) unsigned NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `inscription` datetime DEFAULT NULL,
  `isconfirmed` varchar(255) DEFAULT NULL,
  `uniqid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `mailinglist`
--

INSERT INTO `mailinglist` (`id`, `email`, `inscription`, `isconfirmed`, `uniqid`) VALUES
(14, 'marma@gmail.com', '2016-01-12 16:50:53', 'yes', '569520dda4bfb'),
(15, 'martincollignon@gmail.com', '2016-01-12 16:52:56', 'yes', '56952158e91ad');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `secret` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`, `hash`, `secret`) VALUES
(1, 'admin', '$2y$10$R.oTqhpji//smaAWbABry.zkzOYSAbtc02cYUfwjnDfkIDJbE/LYO', '5694bccc8c7f7');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `mailinglist`
--
ALTER TABLE `mailinglist`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `mailinglist`
--
ALTER TABLE `mailinglist`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;