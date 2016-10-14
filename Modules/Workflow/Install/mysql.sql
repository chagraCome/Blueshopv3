-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Mar 26 Janvier 2016 à 17:54
-- Version du serveur :  5.5.44-0ubuntu0.14.04.1
-- Version de PHP :  5.5.30

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données :  `motorssouq_com_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `workflow`
--

DROP TABLE IF EXISTS `workflow`;
CREATE TABLE `workflow` (
  `id` int(11) NOT NULL,
  `eventname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `modelname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trigger_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `workflow_action`
--

DROP TABLE IF EXISTS `workflow_action`;
CREATE TABLE `workflow_action` (
  `id` int(11) NOT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template_id` int(11) NOT NULL,
  `workflow_id` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Structure de la table `workflow_condition`
--

DROP TABLE IF EXISTS `workflow_condition`;
CREATE TABLE `workflow_condition` (
  `id` int(11) NOT NULL,
  `condition_left` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `condition_right` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `condition_op` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `workflow_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Structure de la table `workflow_lang`
--

DROP TABLE IF EXISTS `workflow_lang`;
CREATE TABLE `workflow_lang` (
  `workflow_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Structure de la table `workflow_mail_action`
--

DROP TABLE IF EXISTS `workflow_mail_action`;
CREATE TABLE `workflow_mail_action` (
  `id` int(11) NOT NULL,
  `from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bcc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `workflow_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `workflow_mail_action_lang`
--

DROP TABLE IF EXISTS `workflow_mail_action_lang`;
CREATE TABLE `workflow_mail_action_lang` (
  `workflow_mail_action_id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8_unicode_ci,
  `lang` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Structure de la table `workflow_sms_action`
--

DROP TABLE IF EXISTS `workflow_sms_action`;
CREATE TABLE `workflow_sms_action` (
  `id` int(11) NOT NULL,
  `from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `workflow_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `workflow_sms_action_lang`
--

DROP TABLE IF EXISTS `workflow_sms_action_lang`;
CREATE TABLE `workflow_sms_action_lang` (
  `workflow_sms_action_id` int(11) NOT NULL,
  `body` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `workflow`
--
ALTER TABLE `workflow`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `workflow_action`
--
ALTER TABLE `workflow_action`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `workflow_condition`
--
ALTER TABLE `workflow_condition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_workflow_condition_workflow1` (`workflow_id`);

--
-- Index pour la table `workflow_lang`
--
ALTER TABLE `workflow_lang`
  ADD KEY `fk_workflow_lang_workflow1` (`workflow_id`);

--
-- Index pour la table `workflow_mail_action`
--
ALTER TABLE `workflow_mail_action`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_workflow_mail_action_workflow1` (`workflow_id`);

--
-- Index pour la table `workflow_mail_action_lang`
--
ALTER TABLE `workflow_mail_action_lang`
  ADD KEY `fk_workflow_mail_action_lang_workflow_mail_action1` (`workflow_mail_action_id`);

--
-- Index pour la table `workflow_sms_action`
--
ALTER TABLE `workflow_sms_action`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_workflow_sms_action_workflow1` (`workflow_id`);

--
-- Index pour la table `workflow_sms_action_lang`
--
ALTER TABLE `workflow_sms_action_lang`
  ADD KEY `fk_workflow_sms_action_lang_workflow_sms_action1` (`workflow_sms_action_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `workflow`
--
ALTER TABLE `workflow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `workflow_action`
--
ALTER TABLE `workflow_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `workflow_condition`
--
ALTER TABLE `workflow_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `workflow_mail_action`
--
ALTER TABLE `workflow_mail_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `workflow_sms_action`
--
ALTER TABLE `workflow_sms_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `workflow_condition`
--
ALTER TABLE `workflow_condition`
  ADD CONSTRAINT `fk_workflow_condition_workflow1` FOREIGN KEY (`workflow_id`) REFERENCES `workflow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `workflow_lang`
--
ALTER TABLE `workflow_lang`
  ADD CONSTRAINT `fk_workflow_lang_workflow1` FOREIGN KEY (`workflow_id`) REFERENCES `workflow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `workflow_mail_action`
--
ALTER TABLE `workflow_mail_action`
  ADD CONSTRAINT `fk_workflow_mail_action_workflow1` FOREIGN KEY (`workflow_id`) REFERENCES `workflow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `workflow_mail_action_lang`
--
ALTER TABLE `workflow_mail_action_lang`
  ADD CONSTRAINT `fk_workflow_mail_action_lang_workflow_mail_action1` FOREIGN KEY (`workflow_mail_action_id`) REFERENCES `workflow_mail_action` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `workflow_sms_action`
--
ALTER TABLE `workflow_sms_action`
  ADD CONSTRAINT `fk_workflow_sms_action_workflow1` FOREIGN KEY (`workflow_id`) REFERENCES `workflow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `workflow_sms_action_lang`
--
ALTER TABLE `workflow_sms_action_lang`
  ADD CONSTRAINT `fk_workflow_sms_action_lang_workflow_sms_action1` FOREIGN KEY (`workflow_sms_action_id`) REFERENCES `workflow_sms_action` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
