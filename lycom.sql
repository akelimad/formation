-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 18 Décembre 2017 à 19:00
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `lycom`
--

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE IF NOT EXISTS `cours` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `devise` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prix` double DEFAULT NULL,
  `duree` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cours_user_id_foreign` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`id`, `titre`, `description`, `devise`, `prix`, `duree`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 'cours de css', 'testss', 'MAD', 230, '10', 1, '2017-12-18 17:01:15', '2017-12-18 17:01:15');

-- --------------------------------------------------------

--
-- Structure de la table `evaluations`
--

CREATE TABLE IF NOT EXISTS `evaluations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `session_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evaluations_session_id_foreign` (`session_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `formateurs`
--

CREATE TABLE IF NOT EXISTS `formateurs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qualification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expertise` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `autres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `formateurs`
--

INSERT INTO `formateurs` (`id`, `nom`, `type`, `email`, `tel`, `qualification`, `created_at`, `updated_at`, `expertise`, `autres`) VALUES
(1, 'Mr karim', 'Interne', 'karim@lycom.ma', '06 55 61 31 23', '', '2017-12-14 11:27:23', '2017-12-14 11:27:23', '', ''),
(2, 'Mr Hamza', 'Interne', 'aaa@mail.com', '0537516050', '', '2017-12-14 11:39:17', '2017-12-14 11:39:17', '', ''),
(3, 'Mr Idbrahim', 'Interne', 'mourad@mourad.com', '0537516050', '', '2017-12-14 15:41:05', '2017-12-14 15:41:05', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `specialite` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personne_contacter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_entreprise` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qualification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commentaire` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom`, `type`, `code`, `specialite`, `tel`, `email`, `fax`, `personne_contacter`, `type_entreprise`, `qualification`, `commentaire`, `created_at`, `updated_at`) VALUES
(1, 'morad', 'Gouverement', '26300', 'PFP', '0537516050', 'mourad@mourad.com', '537516050', 'contact', '', '', '', '2017-12-13 18:03:55', '2017-12-13 18:03:55'),
(2, 'morad', 'Cabinet', 'i5tyu', 'RH', '0537516050', 'mourad@mourad.com', '0537516050', 'Sabah', '', '', 'commennnnnnnnnnnnnnntaire', '2017-12-14 12:08:01', '2017-12-14 12:08:01'),
(3, 'prestataire 1', 'Cabinet', '23ffes', 'RH', '06 55 61 31 23', 'mail@mail.com', 'sarl', 'qua', '', '', 'com', '2017-12-18 17:49:24', '2017-12-18 17:49:24'),
(4, 'morad', 'Cabinet', 'er4', 'RH', '0537516050', 'mourad@mourad.com', '0537516050', 'contact', 'sarl', 'qia', 'com', '2017-12-18 17:56:43', '2017-12-18 17:56:43');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_12_13_113647_create_cours_table', 2),
('2017_12_13_153745_create_sessions_table', 3),
('2017_12_13_171419_create_fournisseurs_table', 4),
('2017_12_14_094004_add_statut_session_table', 5),
('2017_12_14_104939_create_formateurs_table', 6),
('2017_12_14_105243_create_participants_table', 7),
('2017_12_14_163109_add_formateur_session_table', 8),
('2017_12_15_093107_create_session_participants_table', 9),
('2017_12_15_161727_create_salles_table', 10),
('2017_12_18_090305_adds_column_salle_to_session_table', 11),
('2017_12_18_110105_add_evaluation_table', 12),
('2017_12_18_122403_add_question_table', 13),
('2017_12_18_124113_add_column_evaluation_question_table', 14),
('2017_12_18_165031_add_column_user_to_cours', 15),
('2017_12_18_171149_add_column_to_formateur', 16),
('2017_12_18_173049_add_column_to_fournisseurs', 17);

-- --------------------------------------------------------

--
-- Structure de la table `participants`
--

CREATE TABLE IF NOT EXISTS `participants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `participants`
--

INSERT INTO `participants` (`id`, `nom`, `email`, `created_at`, `updated_at`) VALUES
(1, 'imad', 'akel.dev@gmail.com', '2017-12-14 16:18:19', '2017-12-14 16:18:19'),
(2, 'ahmed', 'ahmed@gmail.com', '2017-12-15 14:23:13', '2017-12-15 14:23:13'),
(4, 'hamza', 'hamzamessour@gmail.com', '2017-12-15 14:24:00', '2017-12-15 14:24:00'),
(5, 'akel imad', 'akel.dev@gmail.com', '2017-12-18 17:37:47', '2017-12-18 17:37:47');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titre` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `evaluation_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_evaluation_id_foreign` (`evaluation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `salles`
--

CREATE TABLE IF NOT EXISTS `salles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `capacite` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `equipements` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `salles`
--

INSERT INTO `salles` (`id`, `numero`, `capacite`, `equipements`, `photo`, `created_at`, `updated_at`) VALUES
(1, '1', '30', 'wifi', NULL, '2017-12-18 09:14:41', '2017-12-18 09:14:41');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `methode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cour_id` int(10) unsigned NOT NULL,
  `salle_id` int(10) unsigned NOT NULL,
  `formateur_id` int(10) unsigned NOT NULL,
  `statut` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_cour_id_foreign` (`cour_id`),
  KEY `sessions_formateur_id_foreign` (`formateur_id`),
  KEY `sessions_salle_id_foreign` (`salle_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `sessions`
--

INSERT INTO `sessions` (`id`, `nom`, `description`, `start`, `end`, `lieu`, `methode`, `cour_id`, `salle_id`, `formateur_id`, `statut`, `created_at`, `updated_at`) VALUES
(15, 'session 1', 'tzest', '18/12/2017', '23/12/2017', 'rabat', 'Salle de classe', 5, 1, 3, 'Programmé', '2017-12-18 17:40:15', '2017-12-18 17:40:15');

-- --------------------------------------------------------

--
-- Structure de la table `session_participants`
--

CREATE TABLE IF NOT EXISTS `session_participants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` int(10) unsigned NOT NULL,
  `participant_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `session_participants_session_id_foreign` (`session_id`),
  KEY `session_participants_participant_id_foreign` (`participant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Contenu de la table `session_participants`
--

INSERT INTO `session_participants` (`id`, `session_id`, `participant_id`, `created_at`, `updated_at`) VALUES
(12, 15, 1, '2017-12-18 17:40:15', '2017-12-18 17:40:15'),
(13, 15, 2, '2017-12-18 17:40:15', '2017-12-18 17:40:15');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'akel imad', 'akel.dev@gmail.com', '$2y$10$4Jy4s./0MQDkFmBKW/rlp.FXeX9Qr0jWH9ay9wf8eqZUg01TJ/gJS', 'wbSC5VlwukZd2toxGm3p5dKh92JTIEV5pppPrBwQhOkllt1OpUjvOH0QeW4A', '2017-12-13 11:01:35', '2017-12-18 16:47:29'),
(2, 'admin', 'admin@admin.com', '$2y$10$ytMxIP4l09.CFwJ1pbHFsOmRpMjvWrIOUIbAB19uNlt7PfbcpME5S', 'ki3Wi7U8ECxpkiVFWNKmxD7K8gRY5MaQdKTl0k7nQKucuZm17ZYVrErwJdbt', '2017-12-15 17:17:55', '2017-12-18 15:49:35'),
(3, 'hamza idrissi', 'hamza@lycom.ma', '$2y$10$MQRNC.tHMuKChz9ywJWW/Oo8Lo9GwU5suVobQvxLViwDXgwPwj1cO', '3HZ6VrwExLtbDzXe6SSCEPSaCCuP9BK9Z1eczuADvP40IsSagHIfycIuOp4H', '2017-12-18 16:32:53', '2017-12-18 16:45:12'),
(4, 'Karim idrissi', 'karim@lycom.ma', '$2y$10$IySCcXLdGpA4JIMcQrzHZO71OiWEBSDjSd5UJY8ovExTL1OsHrndC', NULL, '2017-12-18 16:48:11', '2017-12-18 16:48:11');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`);

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_evaluation_id_foreign` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`id`);

--
-- Contraintes pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_cour_id_foreign` FOREIGN KEY (`cour_id`) REFERENCES `cours` (`id`),
  ADD CONSTRAINT `sessions_formateur_id_foreign` FOREIGN KEY (`formateur_id`) REFERENCES `formateurs` (`id`),
  ADD CONSTRAINT `sessions_salle_id_foreign` FOREIGN KEY (`salle_id`) REFERENCES `salles` (`id`);

--
-- Contraintes pour la table `session_participants`
--
ALTER TABLE `session_participants`
  ADD CONSTRAINT `session_participants_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`),
  ADD CONSTRAINT `session_participants_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
