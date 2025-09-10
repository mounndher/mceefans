-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 10 sep. 2025 à 17:27
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `abonments`
--

INSERT INTO `abonments` (`id`, `nom`, `prix`, `nbrmatch`, `desgin_card`, `created_at`, `updated_at`) VALUES
(1, 'fan standar', '1450', '45', '1757496341.png', '2025-09-10 08:25:41', '2025-09-10 08:48:28'),
(3, 'fan vip', '5000', '50', '1757517573.png', '2025-09-10 14:19:33', '2025-09-10 14:19:33');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fan`
--

INSERT INTO `fan` (`id`, `id_qrcode`, `qr_img`, `nom`, `prenom`, `image`, `imagecart`, `nin`, `numero_tele`, `date_de_nai`, `card`, `created_at`, `updated_at`) VALUES
(19, 'mon-ARtcLs', '/uploads/mon-ARtcLs_qr.png', 'mon', 'mondher', '/uploads/68c1896120aa6_photo.png', '/uploads/68c1896120ced_101-QI.png', '123456789123454269', '0796790390', '2000-08-03', NULL, '2025-09-10 13:21:21', '2025-09-10 13:21:21');

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
(10, '2025_09_10_103436_create_transaction_paimnts_table', 5);

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
  `prix` decimal(11,4) NOT NULL,
  `nbrmatch` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transaction_paimnts`
--

INSERT INTO `transaction_paimnts` (`id`, `id_fan`, `id_abonment`, `date`, `prix`, `nbrmatch`, `created_at`, `updated_at`) VALUES
(8, 19, 1, '2025-09-10', 1450.0000, 45, '2025-09-10 13:21:21', '2025-09-10 13:21:21');

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
(2, 'mondher mondher', 'admin@gmail.com', NULL, '$2y$12$ASsTo9GAdAvkWhpMizslZ.TRcEUbk9OJLd43KTk8HydhLkqWoOxsq', NULL, '2025-09-09 12:39:53', '2025-09-09 12:39:53');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonments`
--
ALTER TABLE `abonments`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transaction_paimnts`
--
ALTER TABLE `transaction_paimnts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

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
