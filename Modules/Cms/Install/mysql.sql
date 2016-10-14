SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données: `clean_braun`
--

-- --------------------------------------------------------

--
-- Structure de la table `cms`
--

DROP TABLE IF EXISTS `cms`;
CREATE TABLE IF NOT EXISTS `cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `title` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `internal_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `external_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `target` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `cms`
--

INSERT INTO `cms` (`id`, `name`, `position`, `title`, `keywords`, `desc`, `content`, `state`, `internal_url`, `external_url`, `target`) VALUES
(1, 'الصفحة الرئيسية', 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cms_block`
--

DROP TABLE IF EXISTS `cms_block`;
CREATE TABLE IF NOT EXISTS `cms_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `cms_box`
--

DROP TABLE IF EXISTS `cms_box`;
CREATE TABLE IF NOT EXISTS `cms_box` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `online` tinyint(1) DEFAULT '1',
  `border` tinyint(1) DEFAULT '0',
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `entrypoint` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `cms_box`
--

INSERT INTO `cms_box` (`id`, `file`, `online`, `border`, `link`, `entrypoint`) VALUES
(1, 'Modules/Cms/Frontend/Views/Boxes/mainmenu.box.tpl.html', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cms_box_lang`
--

DROP TABLE IF EXISTS `cms_box_lang`;
CREATE TABLE IF NOT EXISTS `cms_box_lang` (
  `cms_box_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `html` longtext COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `fk_cms_box_lang_cms_box1` (`cms_box_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `cms_box_lang`
--

INSERT INTO `cms_box_lang` (`cms_box_id`, `name`, `html`, `lang`, `image`) VALUES
(1, 'MainMenu Top', NULL, 'AR', NULL),
(1, 'MainMenu Top', NULL, 'EN', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cms_main_menu`
--

DROP TABLE IF EXISTS `cms_main_menu`;
CREATE TABLE IF NOT EXISTS `cms_main_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `cms_box_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cms_main_menu_cms_box1` (`cms_box_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `cms_main_menu`
--

INSERT INTO `cms_main_menu` (`id`, `name`, `state`, `cms_box_id`) VALUES
(1, 'Main Menu Top', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cms_main_menu_has_cms_site`
--

DROP TABLE IF EXISTS `cms_main_menu_has_cms_site`;
CREATE TABLE IF NOT EXISTS `cms_main_menu_has_cms_site` (
  `cms_main_menu_id` int(11) NOT NULL,
  `cms_site_id` int(11) NOT NULL,
  `defaultsite` BOOLEAN NULL DEFAULT  '0',
  PRIMARY KEY (`cms_main_menu_id`,`cms_site_id`),
  KEY `fk_cms_main_menu_has_cms_site_cms_site1` (`cms_site_id`),
  KEY `fk_cms_main_menu_has_cms_site_cms_main_menu1` (`cms_main_menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cms_menu_item`
--

DROP TABLE IF EXISTS `cms_menu_item`;
CREATE TABLE IF NOT EXISTS `cms_menu_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sortid` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `target` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `cms_main_menu_id` int(11) NOT NULL,
  `cms_page_id` int(11) DEFAULT NULL,
  `product_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cms_menu_cms_menu1` (`parent_id`),
  KEY `fk_cms_menu_item_cms_main_menu1` (`cms_main_menu_id`),
  KEY `fk_cms_menu_item_cms_page1` (`cms_page_id`),
  KEY `product_category_id` (`product_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `cms_menu_item`
--

INSERT INTO `cms_menu_item` (`id`, `title`, `alias`, `sortid`, `url`, `state`, `target`, `parent_id`, `cms_main_menu_id`, `cms_page_id`, `product_category_id`) VALUES
(1, NULL, NULL, NULL, NULL, 1, 'self', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cms_menu_item_lang`
--

DROP TABLE IF EXISTS `cms_menu_item_lang`;
CREATE TABLE IF NOT EXISTS `cms_menu_item_lang` (
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cms_menu_item_id` int(11) NOT NULL,
  KEY `fk_cms_menu_lang_cms_menu1` (`cms_menu_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cms_menu_item_lang`
--

INSERT INTO `cms_menu_item_lang` (`title`, `lang`, `cms_menu_item_id`) VALUES
('Home', 'en', 1),
('الرئيسية', 'AR', 1);

-- --------------------------------------------------------

--
-- Structure de la table `cms_page`
--

DROP TABLE IF EXISTS `cms_page`;
CREATE TABLE IF NOT EXISTS `cms_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(1) DEFAULT '1',
  `fixed` tinyint(1) DEFAULT '0',
  `border` tinyint(1) NOT NULL DEFAULT '1',
  `layout` int(11) DEFAULT NULL,
  `insertat` datetime DEFAULT NULL,
  `updateat` datetime DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_author_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cms_page_category_id` int(11) DEFAULT NULL,
  `cms_site_id` int(11) DEFAULT NULL,
  `inherit_design_from_site` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cms_page_cms_page_category1` (`cms_page_category_id`),
  KEY `fk_cms_page_cms_site1` (`cms_site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `cms_page`
--

INSERT INTO `cms_page` (`id`, `alias`, `state`, `fixed`, `border`, `layout`, `insertat`, `updateat`, `author_name`, `update_author_name`, `cms_page_category_id`, `cms_site_id`, `inherit_design_from_site`) VALUES
(1, 'homepage', 1, 1, 1, 1, '2013-03-20 13:09:49', '2013-03-20 13:09:52', NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cms_page_archive`
--

DROP TABLE IF EXISTS `cms_page_archive`;
CREATE TABLE IF NOT EXISTS `cms_page_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insertat` datetime DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cms_page_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cms_page_archive_cms_page1` (`cms_page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Structure de la table `cms_page_category`
--

DROP TABLE IF EXISTS `cms_page_category`;
CREATE TABLE IF NOT EXISTS `cms_page_category` (
  `id` int(11) NOT NULL,
  `sortid` int(11) DEFAULT NULL,
  `insertat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cms_page_category_cms_page_category1` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cms_page_category_lang`
--

DROP TABLE IF EXISTS `cms_page_category_lang`;
CREATE TABLE IF NOT EXISTS `cms_page_category_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cms_page_category_id` int(11) NOT NULL,
  KEY `fk_cms_page_category_lang_cms_page_category1` (`cms_page_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cms_page_has_cms_block`
--

DROP TABLE IF EXISTS `cms_page_has_cms_block`;
CREATE TABLE IF NOT EXISTS `cms_page_has_cms_block` (
  `cms_page_id` int(11) NOT NULL,
  `cms_block_id` int(11) NOT NULL,
  PRIMARY KEY (`cms_page_id`,`cms_block_id`),
  KEY `fk_cms_page_has_cms_block_cms_block1` (`cms_block_id`),
  KEY `fk_cms_page_has_cms_block_cms_page1` (`cms_page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cms_page_has_cms_box`
--

DROP TABLE IF EXISTS `cms_page_has_cms_box`;
CREATE TABLE IF NOT EXISTS `cms_page_has_cms_box` (
  `cms_page_id` int(11) NOT NULL,
  `cms_box_id` int(11) NOT NULL,
  `position` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sortid` int(2) DEFAULT NULL,
  PRIMARY KEY (`cms_page_id`,`cms_box_id`),
  KEY `fk_cms_page_has_cms_box_cms_box1` (`cms_box_id`),
  KEY `fk_cms_page_has_cms_box_cms_page1` (`cms_page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `cms_page_has_cms_box`
--

INSERT INTO `cms_page_has_cms_box` (`cms_page_id`, `cms_box_id`, `position`, `sortid`) VALUES
(1, 1, 'T', 0);

-- --------------------------------------------------------

--
-- Structure de la table `cms_page_lang`
--

DROP TABLE IF EXISTS `cms_page_lang`;
CREATE TABLE IF NOT EXISTS `cms_page_lang` (
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `cms_page_id` int(11) NOT NULL,
  KEY `fk_cms_page_lang_cms_page1` (`cms_page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `cms_page_lang`
--

INSERT INTO `cms_page_lang` (`title`, `keywords`, `description`, `content`, `lang`, `cms_page_id`) VALUES
('Home Page', NULL, NULL, NULL, 'EN', 1),
('Home Page', NULL, NULL, NULL, 'AR', 1);

-- --------------------------------------------------------

--
-- Structure de la table `cms_site`
--

DROP TABLE IF EXISTS `cms_site`;
CREATE TABLE IF NOT EXISTS `cms_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `width` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `require_login` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `root` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `homepage` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `cms_site`
--

INSERT INTO `cms_site` (`id`, `name`, `state`, `width`, `style`, `require_login`, `title`, `description`, `root`, `homepage`) VALUES
(1, 'Default Web Site', NULL, NULL, 'Default Web Site', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cms_site_has_cms_box`
--

DROP TABLE IF EXISTS `cms_site_has_cms_box`;
CREATE TABLE IF NOT EXISTS `cms_site_has_cms_box` (
  `cms_site_id` int(11) NOT NULL,
  `cms_box_id` int(11) NOT NULL,
  `position` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sortid` int(2) DEFAULT NULL,
  PRIMARY KEY (`cms_site_id`,`cms_box_id`),
  KEY `fk_cms_site_has_cms_box_cms_box1` (`cms_box_id`),
  KEY `fk_cms_site_has_cms_box_cms_site1` (`cms_site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `cms_site_has_cms_box`
--

INSERT INTO `cms_site_has_cms_box` (`cms_site_id`, `cms_box_id`, `position`, `sortid`) VALUES
(1, 1, 'T', 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cms_box_lang`
--
ALTER TABLE `cms_box_lang`
  ADD CONSTRAINT `fk_cms_box_lang_cms_box1` FOREIGN KEY (`cms_box_id`) REFERENCES `cms_box` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cms_main_menu`
--
ALTER TABLE `cms_main_menu`
  ADD CONSTRAINT `cms_main_menu_ibfk_1` FOREIGN KEY (`cms_box_id`) REFERENCES `cms_box` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cms_main_menu_has_cms_site`
--
ALTER TABLE `cms_main_menu_has_cms_site`
  ADD CONSTRAINT `fk_cms_main_menu_has_cms_site_cms_main_menu1` FOREIGN KEY (`cms_main_menu_id`) REFERENCES `cms_main_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cms_main_menu_has_cms_site_cms_site1` FOREIGN KEY (`cms_site_id`) REFERENCES `cms_site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cms_menu_item`
--
ALTER TABLE `cms_menu_item`
  ADD CONSTRAINT `cms_menu_item_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `cms_menu_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cms_menu_item_cms_main_menu1` FOREIGN KEY (`cms_main_menu_id`) REFERENCES `cms_main_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cms_menu_item_lang`
--
ALTER TABLE `cms_menu_item_lang`
  ADD CONSTRAINT `fk_cms_menu_lang_cms_menu1` FOREIGN KEY (`cms_menu_item_id`) REFERENCES `cms_menu_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cms_page`
--
ALTER TABLE `cms_page`
  ADD CONSTRAINT `fk_cms_page_cms_page_category1` FOREIGN KEY (`cms_page_category_id`) REFERENCES `cms_page_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cms_page_cms_site1` FOREIGN KEY (`cms_site_id`) REFERENCES `cms_site` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `cms_page_archive`
--
ALTER TABLE `cms_page_archive`
  ADD CONSTRAINT `fk_cms_page_archive_cms_page1` FOREIGN KEY (`cms_page_id`) REFERENCES `cms_page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cms_page_category`
--
ALTER TABLE `cms_page_category`
  ADD CONSTRAINT `fk_cms_page_category_cms_page_category1` FOREIGN KEY (`parent_id`) REFERENCES `cms_page_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cms_page_category_lang`
--
ALTER TABLE `cms_page_category_lang`
  ADD CONSTRAINT `fk_cms_page_category_lang_cms_page_category1` FOREIGN KEY (`cms_page_category_id`) REFERENCES `cms_page_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cms_page_has_cms_block`
--
ALTER TABLE `cms_page_has_cms_block`
  ADD CONSTRAINT `cms_page_has_cms_block_ibfk_1` FOREIGN KEY (`cms_page_id`) REFERENCES `cms_page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cms_page_has_cms_block_ibfk_2` FOREIGN KEY (`cms_block_id`) REFERENCES `cms_block` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cms_page_has_cms_box`
--
ALTER TABLE `cms_page_has_cms_box`
  ADD CONSTRAINT `fk_cms_page_has_cms_box_cms_box1` FOREIGN KEY (`cms_box_id`) REFERENCES `cms_box` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cms_page_has_cms_box_cms_page1` FOREIGN KEY (`cms_page_id`) REFERENCES `cms_page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cms_page_lang`
--
ALTER TABLE `cms_page_lang`
  ADD CONSTRAINT `fk_cms_page_lang_cms_page1` FOREIGN KEY (`cms_page_id`) REFERENCES `cms_page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cms_site_has_cms_box`
--
ALTER TABLE `cms_site_has_cms_box`
  ADD CONSTRAINT `fk_cms_site_has_cms_box_cms_box1` FOREIGN KEY (`cms_box_id`) REFERENCES `cms_box` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cms_site_has_cms_box_cms_site1` FOREIGN KEY (`cms_site_id`) REFERENCES `cms_site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
