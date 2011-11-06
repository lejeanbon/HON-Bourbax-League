-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 06 Novembre 2011 à 15:06
-- Version du serveur: 5.1.36
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `hon`
--

-- --------------------------------------------------------

--
-- Structure de la table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `aid` int(7) NOT NULL,
  `elo` int(4) NOT NULL,
  `user` int(11) NOT NULL,
  `kill` int(11) NOT NULL DEFAULT '0',
  `death` int(11) NOT NULL DEFAULT '0',
  `assist` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `account`
--

INSERT INTO `account` (`id`, `name`, `aid`, `elo`, `user`, `kill`, `death`, `assist`) VALUES
(1, 'Jeanbon', 786740, 1750, 1, 0, 0, 0),
(2, 'Zep76', 2338268, 1600, 1, 0, 0, 0),
(3, 'Abramus', 1487442, 1500, 1, 0, 0, 0),
(4, 'Jeanbono', 4798282, 1400, 1, 0, 0, 0),
(5, 'Abramus`', 3770893, 1500, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `gid` int(20) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `game`
--

INSERT INTO `game` (`id`, `gid`, `name`, `status`) VALUES
(1, 65206064, 'Test game', 2),
(3, 64817775, 'SoY vs Zeal', 2),
(4, 64285982, 'IH', 2),
(5, 64282399, 'IH 2', 2),
(6, 64314318, 'Une Loose :(', 2),
(8, NULL, 'Game d''inscription', 0);

-- --------------------------------------------------------

--
-- Structure de la table `game_result`
--

CREATE TABLE IF NOT EXISTS `game_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game` int(11) NOT NULL,
  `account` int(11) NOT NULL,
  `result` int(11) NOT NULL,
  `leave` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `game_2` (`game`),
  KEY `account` (`account`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `game_result`
--

INSERT INTO `game_result` (`id`, `game`, `account`, `result`, `leave`) VALUES
(1, 1, 1, 0, 0),
(2, 3, 1, 1, 0),
(3, 4, 1, 0, 0),
(4, 5, 1, 1, 0),
(5, 6, 1, 0, 0),
(6, 6, 5, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game` int(11) NOT NULL,
  `account` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `game` (`game`),
  KEY `account` (`account`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `registration`
--

INSERT INTO `registration` (`id`, `game`, `account`) VALUES
(1, 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `reporting`
--

CREATE TABLE IF NOT EXISTS `reporting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `reason` varchar(500) NOT NULL,
  `reporter_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `game` (`game`),
  KEY `user` (`user`),
  KEY `reporter_user` (`reporter_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `reporting`
--


-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `right` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `right`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `game_result`
--
ALTER TABLE `game_result`
  ADD CONSTRAINT `game_result_ibfk_1` FOREIGN KEY (`account`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `game_result_ibfk_2` FOREIGN KEY (`game`) REFERENCES `game` (`id`);

--
-- Contraintes pour la table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`account`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`game`) REFERENCES `game` (`id`);

--
-- Contraintes pour la table `reporting`
--
ALTER TABLE `reporting`
  ADD CONSTRAINT `reporting_ibfk_1` FOREIGN KEY (`game`) REFERENCES `game` (`id`),
  ADD CONSTRAINT `reporting_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `reporting_ibfk_3` FOREIGN KEY (`reporter_user`) REFERENCES `user` (`id`);
