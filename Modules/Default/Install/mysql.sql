--
-- Structure de la table `portlet`
--

DROP TABLE IF EXISTS `portlet`;
CREATE TABLE IF NOT EXISTS `portlet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `callback` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Structure de la table `portlet_user`
--

DROP TABLE IF EXISTS `portlet_user`;
CREATE TABLE IF NOT EXISTS `portlet_user` (
  `portlet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `position` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'L',
  `sortid` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  KEY `portlet_id` (`portlet_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;