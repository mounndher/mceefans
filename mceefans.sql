-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 15 sep. 2025 à 16:33
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','expired') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `abonments`
--

INSERT INTO `abonments` (`id`, `nom`, `prix`, `nbrmatch`, `desgin_card`, `created_at`, `updated_at`, `status`) VALUES
(3, 'fan vip', '5000', '50', 'uploads/abonments/1757588331.jpg', '2025-09-10 14:19:33', '2025-09-15 11:56:06', 'expired'),
(4, 'sta', '5000', '50', 'uploads/abonments/1757588397.png', '2025-09-11 09:59:57', '2025-09-15 11:56:06', 'expired'),
(5, 'standar', '5000', '12', 'uploads/abonments/1757933754.png', '2025-09-15 09:55:54', '2025-09-15 11:56:07', 'expired'),
(7, 'test', '145', '2', 'uploads/abonments/1757938495.png', '2025-09-15 11:14:55', '2025-09-15 13:12:22', 'active');

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
(1, 'ZOHIR4', '2025-09-14 06:31:59', '2025-09-15 12:02:59'),
(3, 'ZOHIRJJ', '2025-09-14 06:32:12', '2025-09-14 06:32:12');

-- --------------------------------------------------------

--
-- Structure de la table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `id_event` bigint(20) UNSIGNED NOT NULL,
  `idappareil` bigint(20) UNSIGNED DEFAULT NULL,
  `present` tinyint(1) DEFAULT 0,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `attendances`
--

INSERT INTO `attendances` (`id`, `fan_id`, `id_event`, `idappareil`, `present`, `status`, `created_at`, `updated_at`) VALUES
(36, 35, 4, 3, 0, 'checked_in', '2025-09-14 13:26:58', '2025-09-14 13:26:58'),
(37, 36, 4, NULL, 0, 'absent', '2025-09-14 13:33:43', '2025-09-14 13:33:43'),
(38, 35, 5, 3, 0, 'checked_in', '2025-09-14 13:42:16', '2025-09-14 13:42:16'),
(39, 36, 5, 3, 0, 'checked_in', '2025-09-14 13:43:38', '2025-09-14 13:43:38'),
(40, 36, 6, 3, 0, 'checked_in', '2025-09-14 13:44:30', '2025-09-14 13:44:30'),
(41, 36, 7, 3, 0, 'checked_in', '2025-09-14 13:48:15', '2025-09-14 13:48:15'),
(42, 35, 7, NULL, 0, 'absent', '2025-09-14 14:18:52', '2025-09-14 14:18:52'),
(43, 36, 7, 3, 0, 'invalid_event', '2025-09-14 14:18:58', '2025-09-14 14:18:58'),
(44, 36, 7, 3, 0, 'invalid_event', '2025-09-14 14:19:00', '2025-09-14 14:19:00'),
(45, 36, 6, 3, 0, 'scanned_twice', '2025-09-14 14:19:12', '2025-09-14 14:19:12'),
(46, 36, 6, 3, 0, 'scanned_twice', '2025-09-14 14:19:13', '2025-09-14 14:19:13'),
(47, 36, 6, 3, 0, 'scanned_twice', '2025-09-14 14:19:15', '2025-09-14 14:19:15'),
(48, 36, 6, 3, 0, 'scanned_twice', '2025-09-14 14:19:15', '2025-09-14 14:19:15'),
(49, 35, 6, NULL, 0, 'absent', '2025-09-14 14:19:19', '2025-09-14 14:19:19'),
(50, 36, 7, 3, 0, 'invalid_event', '2025-09-15 11:41:33', '2025-09-15 11:41:33'),
(51, 36, 8, 3, 0, 'checked_in', '2025-09-15 11:42:00', '2025-09-15 11:42:00'),
(52, 36, 8, 3, 0, 'scanned_twice', '2025-09-15 11:45:17', '2025-09-15 11:45:17');

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
(2, 'mondher', 'Sac à dos élégant et résistant', '1757576920.png', '2000-03-02', '8 mai 1945', 'terminated', '2025-09-11 06:48:40', '2025-09-14 06:28:46'),
(3, 'event', 'Sac à dos élégant et résistant', '1757854369.png', '2000-03-02', '8 mai 1945', 'active', '2025-09-14 11:52:49', '2025-09-14 11:52:49'),
(4, 'event4', 'Sac à dos élégant et résistant', '1757859069.png', '2000-03-02', '8 mai 1945', 'terminated', '2025-09-14 13:11:09', '2025-09-14 13:33:43'),
(5, 'event5', 'Sac à dos élégant et résistant', '1757860928.png', '2000-03-02', '8 mai 1945', 'terminated', '2025-09-14 13:42:08', '2025-09-15 12:02:46'),
(6, 'event6', 'Sac à dos élégant et résistant', '1757861064.png', '2000-03-02', '8 mai 1945', 'terminated', '2025-09-14 13:44:24', '2025-09-14 14:19:19'),
(7, 'event7', 'Sac à dos élégant et résistant', '1757861267.png', '2000-03-02', '8 mai 1945', 'terminated', '2025-09-14 13:47:47', '2025-09-14 14:18:52'),
(8, 'jh', 'hjh', '1757940114.png', '2000-02-04', '8 mai 1945', 'active', '2025-09-15 11:41:54', '2025-09-15 11:41:54');

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
  `id_qrcode` varchar(255) NOT NULL,
  `qr_img` text NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `imagecart` text DEFAULT NULL,
  `nin` varchar(18) NOT NULL,
  `numero_tele` text NOT NULL,
  `date_de_nai` date NOT NULL,
  `card` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','expired') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fan`
--

INSERT INTO `fan` (`id`, `id_qrcode`, `qr_img`, `nom`, `prenom`, `image`, `imagecart`, `nin`, `numero_tele`, `date_de_nai`, `card`, `created_at`, `updated_at`, `status`) VALUES
(35, 'admin-eOfpoD', '/uploads/admin-eOfpoD_qr.png', 'halim', 'ben', '/uploads/68c2ac2abd01f_y1k80ya5pgbkfxgpk52t.png', '/uploads/68c2ac2abd2bf_card_template.png', '123476789721853159', '0796790390', '2000-08-03', '/uploads/admin-eOfpoD_card.png', '2025-09-11 10:02:02', '2025-09-15 07:23:03', 'active'),
(36, 'admin-Ltcar5', '/uploads/admin-Ltcar5_qr.png', 'bilal', 'ben', '/uploads/68c7cd4ff2c77_télécharger (1).jpeg', '/uploads/68c7cd4ff305b_télécharger.jpeg', '123476789721853154', '0796790390', '2000-08-03', '/uploads/admin-Ltcar5_card.png', '2025-09-14 13:27:26', '2025-09-15 12:26:44', 'expired');

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
(5, '2025_09_07_194709_create_fans_table', 1),
(6, '2025_09_09_094926_create_fans_table', 2),
(7, '2025_09_09_221917_create_fan_table', 3),
(8, '2025_09_09_222917_create_abonments_table', 3),
(9, '2025_09_10_095101_create_transaction_paimnts_table', 4),
(10, '2025_09_10_103436_create_transaction_paimnts_table', 5),
(11, '2025_09_10_203946_create_events_table', 6),
(12, '2025_09_13_095957_create_appareils_table', 7),
(13, '2025_09_13_154957_create_attendances_table', 7),
(14, '2025_09_15_123015_add_status_to_abonments_table', 8),
(15, '2025_09_15_131054_add_status_to_abonments_table', 9),
(16, '2025_09_15_131639_update_foreign_keys_on_transaction_and_attendances', 10);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transaction_paimnts`
--

INSERT INTO `transaction_paimnts` (`id`, `id_fan`, `id_abonment`, `date`, `prix`, `nbrmatch`, `created_at`, `updated_at`) VALUES
(24, 35, 4, '2025-09-11', '5000.0000', 50, '2025-09-11 10:02:02', '2025-09-11 10:02:02'),
(25, 36, 4, '2025-09-14', '5000.0000', 50, '2025-09-14 13:27:26', '2025-09-14 13:27:26'),
(26, 35, 5, '2025-09-15', '5000.0000', 12, '2025-09-15 09:57:59', '2025-09-15 09:57:59'),
(27, 35, 5, '2025-09-15', '5000.0000', 12, '2025-09-15 09:58:03', '2025-09-15 09:58:03'),
(28, 35, 5, '2025-09-15', '5000.0000', 12, '2025-09-15 11:12:38', '2025-09-15 11:12:38'),
(30, 36, 7, '2025-09-15', '145', 2, '2025-09-15 11:21:50', '2025-09-15 11:21:50'),
(31, 35, 7, '2025-09-15', '145', 2, '2025-09-15 12:01:57', '2025-09-15 12:01:57');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'mondher mondher', 'nanou.riache19@gmail.com', NULL, '$2y$12$pTGEMCI1Eq9NyjaHDBu4WulYhM8AqnulkmjH/tTyuvIPI5.ML36dm', 'P92QkJVFQZDnMIzkFZwZWtVBgLBrnxwjWaXYALB9AueGKz4aYH5T8GWwaZaR', '2025-09-09 12:30:28', '2025-09-09 12:30:28'),
(2, 'mondher mondher', 'admin@gmail.com', NULL, '$2y$12$ASsTo9GAdAvkWhpMizslZ.TRcEUbk9OJLd43KTk8HydhLkqWoOxsq', NULL, '2025-09-09 12:39:53', '2025-09-09 12:39:53'),
(3, 'admin', 'adminf@admin.com', NULL, '$2y$12$YA3GzPekulLZ83LJnd3Ve.i1NoBOZyj/K/zMygf4RuNp3I6uocJ82', NULL, '2025-09-11 08:50:48', '2025-09-11 08:50:48');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonments`
--
ALTER TABLE `abonments`
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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonments`
--
ALTER TABLE `abonments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `appareils`
--
ALTER TABLE `appareils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fan`
--
ALTER TABLE `fan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transaction_paimnts`
--
ALTER TABLE `transaction_paimnts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_fan_id_foreign` FOREIGN KEY (`fan_id`) REFERENCES `fan` (`id`),
  ADD CONSTRAINT `attendances_id_event_foreign` FOREIGN KEY (`id_event`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `attendances_idappareil_foreign` FOREIGN KEY (`idappareil`) REFERENCES `appareils` (`id`);

--
-- Contraintes pour la table `transaction_paimnts`
--
ALTER TABLE `transaction_paimnts`
  ADD CONSTRAINT `transaction_paimnts_id_abonment_foreign` FOREIGN KEY (`id_abonment`) REFERENCES `abonments` (`id`),
  ADD CONSTRAINT `transaction_paimnts_id_fan_foreign` FOREIGN KEY (`id_fan`) REFERENCES `fan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
