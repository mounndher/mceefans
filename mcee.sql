-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 24 sep. 2025 à 17:25
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mceefans`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonments`
--

CREATE TABLE `abonments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` text NOT NULL,
  `nbrmatch` text NOT NULL,
  `desgin_card` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','expired','supprimé','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `abonments`
--

INSERT INTO `abonments` (`id`, `nom`, `prix`, `nbrmatch`, `desgin_card`, `image`, `created_at`, `updated_at`, `status`) VALUES
(1, 'mondher', '2000', '14', 'uploads/abonments/1758443979.jpg', 'uploads/abonments/1758443979.jpg', '2025-09-21 07:39:39', '2025-09-21 09:02:43', 'expired'),
(2, 'mondher', '2000', '14', 'uploads/abonments/1758447498.jpg', 'uploads/abonments/1758447498.jpg', '2025-09-21 08:38:18', '2025-09-21 09:02:28', 'supprimé'),
(3, 'jh', '2000', '14', 'uploads/abonments/1758452250.jpg', 'uploads/abonments/1758452250.jpg', '2025-09-21 09:57:30', '2025-09-21 09:57:30', 'active'),
(4, 'jhjkhkh', '2000', '14', 'uploads/abonments/1758452364.jpg', 'uploads/abonments/1758452364.jpg', '2025-09-21 09:59:24', '2025-09-21 09:59:24', 'active');

-- --------------------------------------------------------

--
-- Structure de la table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_text` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `phase` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `title_text`, `subtitle`, `description`, `image`, `button_text`, `button_link`, `phase`, `created_at`, `updated_at`) VALUES
(1, 'UNIR LES COMMUNAUTÉS GRÂCE AU POUVOIR DU FOOTBALL', 'À propos de notre club', 'À propos de notre', 'Au sein de notre club, nous sommes convaincus que l\'avenir du football repose sur des fondations solides. C\'est pourquoi nous nous engageons à identifier et à développer les jeunes talents grâce à des programmes structurés.', 'uploads/about/1758706085.jpg', 'Soutien aux fans et avantages des membres', 'Expert en coaching professionnel et mentorat', 'Personnaliser le plan de formation pour améliorer les compétences', NULL, '2025-09-24 08:38:55');

-- --------------------------------------------------------

--
-- Structure de la table `appareils`
--

CREATE TABLE `appareils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_utilisateur` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appareils`
--

INSERT INTO `appareils` (`id`, `nom_utilisateur`, `created_at`, `updated_at`) VALUES
(1, 'ZOHIR', '2025-09-21 12:23:08', '2025-09-21 12:23:08'),
(2, 'mehdi', '2025-09-23 09:21:52', '2025-09-23 09:21:52'),
(3, 'mondher', '2025-09-23 09:22:00', '2025-09-23 09:22:00');

-- --------------------------------------------------------

--
-- Structure de la table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `id_event` bigint(20) UNSIGNED DEFAULT NULL,
  `idappareil` bigint(20) UNSIGNED DEFAULT NULL,
  `present` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `attendances`
--

INSERT INTO `attendances` (`id`, `fan_id`, `id_event`, `idappareil`, `present`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, 0, 'invalid_event', '2025-09-21 12:23:18', '2025-09-21 12:23:18'),
(2, 3, 2, 1, 0, 'checked_in', '2025-09-21 12:23:47', '2025-09-21 12:23:47'),
(3, 3, 2, 1, 0, 'scanned_twice', '2025-09-21 12:23:52', '2025-09-21 12:23:52'),
(4, 3, 2, 1, 0, 'scanned_twice', '2025-09-21 12:23:53', '2025-09-21 12:23:53'),
(5, 3, 2, 1, 0, 'scanned_twice', '2025-09-21 12:24:03', '2025-09-21 12:24:03'),
(6, 3, 2, 1, 0, 'scanned_twice', '2025-09-21 12:24:04', '2025-09-21 12:24:04'),
(7, 3, 2, 1, 0, 'scanned_twice', '2025-09-21 12:24:06', '2025-09-21 12:24:06'),
(8, 3, 3, 1, 0, 'expired', '2025-09-21 12:25:44', '2025-09-21 12:25:44'),
(9, 3, 3, 1, 0, 'expired', '2025-09-21 12:25:45', '2025-09-21 12:25:45'),
(10, 1, 2, NULL, 0, 'absent', '2025-09-23 09:22:20', '2025-09-23 09:22:20');

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `phone_text` varchar(255) DEFAULT NULL,
  `phone_icon` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_text` varchar(255) DEFAULT NULL,
  `email_icon` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `location_text` varchar(255) DEFAULT NULL,
  `location_icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `title`, `subtitle`, `phone`, `phone_text`, `phone_icon`, `email`, `email_text`, `email_icon`, `location`, `location_text`, `location_icon`, `created_at`, `updated_at`) VALUES
(1, 'CONNECTONS-NOUS ET LANCEONS LES CHOSES AVEC PASSION', 'Contactez-nous', '+(91) - 321 654 987 / +(91) - 123 456 789', 'Numéro de téléphone', 'dddfdf', 'demo@domainname.com / support@domainname.com', 'ADRESSE EMAIL', 'sdsdsds', '2972 Westheimer Road, Santa Ana City, Illinois, UK', 'LOCATION', 'ggh', NULL, '2025-09-24 09:43:11');

-- --------------------------------------------------------

--
-- Structure de la table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `nom`, `prenom`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(1, 'mondher', 'mondher', '0796790560', 'lmml', '2025-09-24 09:51:36', '2025-09-24 09:51:36');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` text NOT NULL,
  `subtitle` text NOT NULL,
  `image_post` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `stade` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `nom`, `subtitle`, `image_post`, `date`, `stade`, `status`, `created_at`, `updated_at`) VALUES
(1, 'jh', 'hjh', '1758447679.jpg', '2000-02-04', '8 mai 1945', 'terminated', '2025-09-21 08:41:19', '2025-09-21 08:41:22'),
(2, 'jh', 'hjh', '1758461020.jpg', '2000-02-04', '8 mai 1945', 'terminated', '2025-09-21 12:23:40', '2025-09-23 09:22:20'),
(3, 'jh', 'hjh', '1758461135.jpg', '2000-02-04', '8 mai 1945', 'active', '2025-09-21 12:25:35', '2025-09-21 12:25:35');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fan`
--

CREATE TABLE `fan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_abonment` bigint(20) UNSIGNED NOT NULL,
  `id_qrcode` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `imagecart` text NOT NULL,
  `nin` varchar(18) NOT NULL,
  `numero_tele` text NOT NULL,
  `date_de_nai` date NOT NULL,
  `card` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','expired','inactive') NOT NULL DEFAULT 'active',
  `qr_pdf_img` text DEFAULT NULL,
  `qr_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fan`
--

INSERT INTO `fan` (`id`, `id_abonment`, `id_qrcode`, `nom`, `prenom`, `image`, `imagecart`, `nin`, `numero_tele`, `date_de_nai`, `card`, `created_at`, `updated_at`, `status`, `qr_pdf_img`, `qr_img`) VALUES
(1, 1, 'ghffffffffff-7Gd3GQ', 'ghffffffffff', 'ghffggggggg', '/uploads/68cfbc6102bfc_a11.jpg', '/uploads/68cfbc6102e6d_a.jpg', '120700000012300200', '0796790390', '2000-08-03', '/uploads/ghffffffffff-7Gd3GQ_card.png', '2025-09-21 07:50:41', '2025-09-21 10:03:18', 'expired', '/uploads/ghffffffffff-7Gd3GQ_pdf_qr.png', '/uploads/ghffffffffff-7Gd3GQ_qr.png'),
(3, 3, 'ghffffffffff-CiAhIk', 'ghffffffffff', 'ghffggggggg', '/uploads/68cff9ac5888f_a11.jpg', '/uploads/68cff9ac58ac8_a.jpg', '120700000012300100', '0796790390', '2000-08-03', '/uploads/ghffffffffff-CiAhIk_card.png', '2025-09-21 12:12:12', '2025-09-23 09:15:10', 'active', '/uploads/ghffffffffff-CiAhIk_pdf_qr.png', '/uploads/ghffffffffff-CiAhIk_qr.png');

-- --------------------------------------------------------

--
-- Structure de la table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `bigtitle` text NOT NULL,
  `decription` text NOT NULL,
  `linge1` text NOT NULL,
  `subtitle1` text NOT NULL,
  `linge2` text NOT NULL,
  `subtitle2` text NOT NULL,
  `linge3` text NOT NULL,
  `subtitle3` text NOT NULL,
  `linge4` text NOT NULL,
  `subtitle4` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `features`
--

INSERT INTO `features` (`id`, `title`, `bigtitle`, `decription`, `linge1`, `subtitle1`, `linge2`, `subtitle2`, `linge3`, `subtitle3`, `linge4`, `subtitle4`, `created_at`, `updated_at`) VALUES
(1, 'nos fonctionnalités', 'Construire des champions sur et en dehors du terrain', 'Notre club est un lieu de rencontre pour tous les joueurs, des jeunes athlètes en herbe aux compétiteurs chevronnés. Il propose notamment des programmes axés sur le développement.', 'Personnel d\'entraîneurs d\'élite', 'Nos entraîneurs expérimentés et agréés offrent une formation de niveau professionnel aux joueurs de tous âges.', 'Des installations à la pointe de la technologie', 'Des terrains d\'entraînement de haute qualité aux vestiaires modernes et aux zones de récupération', 'Développement centré sur le joueur', 'Nous adaptons les programmes d\'entraînement aux forces et aux objectifs de chaque athlète, offrant un parcours à partir des niveaux jeunes', 'Exposition compétitive et tournois', 'Players regularly participate in local, regional, and international tournaments, gaining real matchexperience.', NULL, '2025-09-24 14:00:24');

-- --------------------------------------------------------

--
-- Structure de la table `heroes`
--

CREATE TABLE `heroes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` text NOT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `heroes`
--

INSERT INTO `heroes` (`id`, `title`, `subtitle`, `image`, `button_text`, `created_at`, `updated_at`) VALUES
(1, 'Là où les rêves de football prennent forme, des champions se forment chaque jour.', 'Rêvez grand. Priez plus grand.', 'uploads/hero/1758704960.jpg', 'save', '2025-09-22 07:24:46', '2025-09-24 08:09:20');

-- --------------------------------------------------------

--
-- Structure de la table `mails`
--

CREATE TABLE `mails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `MAIL_MAILER` text NOT NULL,
  `MAIL_HOST` text NOT NULL,
  `MAIL_PORT` text NOT NULL,
  `MAIL_USERNAME` text DEFAULT NULL,
  `MAIL_PASSWORD` text DEFAULT NULL,
  `MAIL_ENCRYPTION` text DEFAULT NULL,
  `MAIL_FROM_ADDRESS` text DEFAULT NULL,
  `MAIL_FROM_NAME` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mails`
--

INSERT INTO `mails` (`id`, `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_ENCRYPTION`, `MAIL_FROM_ADDRESS`, `MAIL_FROM_NAME`, `created_at`, `updated_at`) VALUES
(1, 'smtp', 'smtp.gmail.com', '587', 'nanou.riache19@gmail.com', 'zpxx uyxc vvrd bxix', 'tls', 'nanou.riache19@gmail.com', 'Mcee fans', NULL, '2025-09-22 11:36:53');

-- --------------------------------------------------------

--
-- Structure de la table `match_highlights`
--

CREATE TABLE `match_highlights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` text NOT NULL,
  `image` text NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_09_09_221917_create_fan_table', 1),
(6, '2025_09_09_222917_create_abonments_table', 1),
(7, '2025_09_10_103436_create_transaction_paimnts_table', 1),
(8, '2025_09_10_203946_create_events_table', 1),
(9, '2025_09_13_095957_create_appareils_table', 1),
(10, '2025_09_13_154957_create_attendances_table', 1),
(11, '2025_09_15_123015_add_status_to_abonments_table', 1),
(12, '2025_09_15_131054_add_status_to_abonments_table', 1),
(13, '2025_09_15_185544_add_status_to_transaction_paimnts_table', 1),
(14, '2025_09_19_225130_add_image_to_abonments_table', 1),
(15, '2025_09_19_231356_add_qr_pdf_img_to_fans_table', 1),
(16, '2025_09_20_145433_add_abonment_id_to_fans_table', 1),
(17, '2025_09_21_135007_add_status_to_users_table', 2),
(18, '2025_09_22_080742_create_heroes_table', 3),
(19, '2025_09_22_082953_create_contacts_table', 4),
(20, '2025_09_22_084930_create_abouts_table', 5),
(21, '2025_09_22_090306_create_contact_messages_table', 6),
(22, '2025_09_22_092903_create_settings_table', 7),
(23, '2025_09_22_102729_create_mails_table', 8),
(24, '2025_09_24_123125_create_services_table', 9),
(25, '2025_09_24_130302_create_whatwedos_table', 10),
(26, '2025_09_24_143555_create_features_table', 11),
(27, '2025_09_24_151200_create_match_highlights_table', 12);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('nanou.riache19@gmail.com', '$2y$12$TWGuU1zPbhuIPI9nDwJFg.qZYoNYGnnXBNvaNjiVdtYdSjkkci9t.', '2025-09-22 09:19:57');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` text NOT NULL,
  `iamge` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `title`, `subtitle`, `iamge`, `created_at`, `updated_at`) VALUES
(1, 'Terrains d\'entraînement professionnels', 'Notre arène d\'entraînement intérieure à la pointe de la technologie offre un environnement contrôlé pour une pratique toute l\'année, un éclairage de pointe et un équipement moderne pour améliorer les performances et le développement des joueurs.', 'uploads/hero/1758718130.jpg', '2025-09-24 11:48:50', '2025-09-24 11:48:50'),
(2, 'Arène d\'entraînement intérieure', 'Notre arène d\'entraînement intérieure à la pointe de la technologie offre un environnement contrôlé pour une pratique toute l\'année, un éclairage de pointe et un équipement moderne pour améliorer les performances et le développement des joueurs.', 'uploads/hero/1758718172.jpg', '2025-09-24 11:49:32', '2025-09-24 11:49:32'),
(3, 'Centre de conditionnement physique et de conditionnement physique', 'Notre arène d\'entraînement intérieure à la pointe de la technologie offre un environnement contrôlé pour une pratique toute l\'année, un éclairage de pointe et un équipement moderne pour améliorer les performances et le développement des joueurs.', 'uploads/hero/1758718205.jpg', '2025-09-24 11:50:05', '2025-09-24 11:50:05'),
(4, 'Salle d\'analyse vidéo', 'Our state-of-the-art indoor training arena controlled environment for year-round practice, grade advanced lighting, and modern equipment to enhance player performance and development.', 'uploads/hero/1758718269.jpg', '2025-09-24 11:51:09', '2025-09-24 11:51:22');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `site_logo` varchar(255) DEFAULT NULL,
  `site_favicon` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_logo`, `site_favicon`, `description`, `created_at`, `updated_at`) VALUES
(1, 'mccefans', 'uploads/settings/1758534363_logo.svg', NULL, 'Footable Club – Connecter les passionnés de football grâce à la passion, la communauté et l’amour du jeu. Rejoignez-nous pour rester informé des événements, matchs et actualités du club.', NULL, '2025-09-22 08:47:49');

-- --------------------------------------------------------

--
-- Structure de la table `transaction_paimnts`
--

CREATE TABLE `transaction_paimnts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_fan` bigint(20) UNSIGNED NOT NULL,
  `id_abonment` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `prix` text NOT NULL,
  `nbrmatch` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','historique','annuler','supprime') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transaction_paimnts`
--

INSERT INTO `transaction_paimnts` (`id`, `id_fan`, `id_abonment`, `date`, `prix`, `nbrmatch`, `created_at`, `updated_at`, `status`) VALUES
(4, 1, 3, '2025-09-21', '2000', 14, '2025-09-21 09:59:06', '2025-09-21 10:03:18', 'supprime'),
(6, 3, 3, '2025-09-21', '2000', 14, '2025-09-21 12:12:12', '2025-09-21 12:12:12', 'active'),
(7, 3, 4, '2025-09-21', '2000', 14, '2025-09-21 12:38:19', '2025-09-21 12:38:19', 'active');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin1', 'nanou.riache19@gmail.com', NULL, '$2y$12$.X.dO2yJhOAE14v/7cCE2eou0LOK4pdejBTFMdbkdDvU5yFX0FTSi', 'admin', NULL, '2025-09-21 07:39:16', '2025-09-21 13:10:59'),
(2, 'mondher', 'admin@gmail.com', NULL, '$2y$12$2OEUd2H4mbxltiD1wu2AoeFTgDbLurhEVa1TdXwm70vxpbhN8H3tC', 'user', NULL, '2025-09-21 13:09:51', '2025-09-21 13:09:51'),
(4, 'mondher', 'riacheelmoundher@gmail.com', NULL, '$2y$12$5IHJWhjGlzrJGixBNLT2n.mtav6/EKLfT3402VlwIaFs.R0dOuMj.', 'admin', '73CP3p9JBKFMl9qDVSGv5xvEehAtAgQMLETvx9fbZe9XLnsEG8QwosB0WBuz', '2025-09-22 11:22:54', '2025-09-22 11:47:47');

-- --------------------------------------------------------

--
-- Structure de la table `whatwedos`
--

CREATE TABLE `whatwedos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `image1` text NOT NULL,
  `image2` text NOT NULL,
  `image3` text NOT NULL,
  `pharse1` text NOT NULL,
  `pharse2` text NOT NULL,
  `pharse3` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `whatwedos`
--

INSERT INTO `whatwedos` (`id`, `title`, `subtitle`, `image1`, `image2`, `image3`, `pharse1`, `pharse2`, `pharse3`, `created_at`, `updated_at`) VALUES
(1, 'Ce que nous faisons', 'Une expérience de football complète pour chaque joueur', 'uploads/whatwedo/1758720141_1.jpg', 'uploads/whatwedo/1758720141_2.jpg', 'uploads/whatwedo/1758720141_3.jpg', 'Travail d\'équipe et développement communautaire', 'Competitive Play and Tournaments', 'Expert Coaching And Development', '2025-09-24 12:22:21', '2025-09-24 12:31:08');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonments`
--
ALTER TABLE `abonments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `appareils`
--
ALTER TABLE `appareils`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_fan_id_foreign` (`fan_id`),
  ADD KEY `attendances_id_event_foreign` (`id_event`),
  ADD KEY `attendances_idappareil_foreign` (`idappareil`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `fan`
--
ALTER TABLE `fan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fan_id_qrcode_unique` (`id_qrcode`),
  ADD UNIQUE KEY `fan_nin_unique` (`nin`);

--
-- Index pour la table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `heroes`
--
ALTER TABLE `heroes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `match_highlights`
--
ALTER TABLE `match_highlights`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transaction_paimnts`
--
ALTER TABLE `transaction_paimnts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_paimnts_id_fan_foreign` (`id_fan`),
  ADD KEY `transaction_paimnts_id_abonment_foreign` (`id_abonment`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `whatwedos`
--
ALTER TABLE `whatwedos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonments`
--
ALTER TABLE `abonments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `appareils`
--
ALTER TABLE `appareils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fan`
--
ALTER TABLE `fan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `heroes`
--
ALTER TABLE `heroes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `mails`
--
ALTER TABLE `mails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `match_highlights`
--
ALTER TABLE `match_highlights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `transaction_paimnts`
--
ALTER TABLE `transaction_paimnts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `whatwedos`
--
ALTER TABLE `whatwedos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_fan_id_foreign` FOREIGN KEY (`fan_id`) REFERENCES `fan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendances_id_event_foreign` FOREIGN KEY (`id_event`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendances_idappareil_foreign` FOREIGN KEY (`idappareil`) REFERENCES `appareils` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `transaction_paimnts`
--
ALTER TABLE `transaction_paimnts`
  ADD CONSTRAINT `transaction_paimnts_id_abonment_foreign` FOREIGN KEY (`id_abonment`) REFERENCES `abonments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_paimnts_id_fan_foreign` FOREIGN KEY (`id_fan`) REFERENCES `fan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
