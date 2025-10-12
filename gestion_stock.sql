-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 07 juin 2024 à 19:47
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_stock`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomCategorie` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nomCategorie`, `created_at`, `updated_at`) VALUES
(9, 'Électronique', '2024-06-05 21:12:58', '2024-06-05 21:12:58'),
(10, 'PC', '2024-06-05 21:12:58', '2024-06-05 21:12:58'),
(11, 'Télé', '2024-06-05 21:12:58', '2024-06-05 21:12:58');

-- --------------------------------------------------------

--
-- Structure de la table `entrees`
--

CREATE TABLE `entrees` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `produits_id` int(10) UNSIGNED NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `dateEntree` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entrees`
--

INSERT INTO `entrees` (`id`, `user_id`, `produits_id`, `quantite`, `prix`, `dateEntree`, `created_at`, `updated_at`) VALUES
(12, 5, 27, 28, 570, '2024-05-15', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(13, 5, 22, 42, 960, '2024-05-09', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(14, 5, 26, 1, 43, '2024-05-30', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(15, 4, 19, 31, 218, '2024-05-14', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(16, 3, 23, 7, 620, '2024-05-23', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(17, 2, 21, 12, 229, '2024-05-10', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(18, 5, 21, 28, 514, '2024-06-01', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(19, 1, 21, 12, 856, '2024-05-12', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(20, 2, 26, 35, 540, '2024-05-10', '2024-06-05 21:12:59', '2024-06-05 21:12:59');

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
(41, '2014_10_12_000000_create_users_table', 1),
(42, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(43, '2014_10_12_100000_create_password_resets_table', 1),
(44, '2019_08_19_000000_create_failed_jobs_table', 1),
(45, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(46, '2022_06_09_221027_create_categories_table', 1),
(47, '2022_06_09_221050_create_produits_table', 1),
(48, '2022_06_09_221213_create_entrees_table', 1),
(49, '2022_06_09_221222_create_sorties_table', 1),
(50, '2024_05_07_080104_create_products_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `categories_id` int(10) UNSIGNED NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `user_id`, `categories_id`, `libelle`, `stock`, `created_at`, `updated_at`) VALUES
(19, 3, 10, 'Écouteurs sans fil', 12, '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(20, 4, 9, 'Téléviseur', 61, '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(21, 5, 10, 'Téléviseur', 39, '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(22, 3, 10, 'Téléviseur', 62, '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(23, 1, 10, 'Laptop', 79, '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(24, 5, 9, 'Casque sans fil', 48, '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(25, 1, 10, 'Casque sans fil', 49, '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(26, 1, 11, 'Enceinte Bluetooth', 27, '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(27, 3, 10, 'Casque sans fil', 57, '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(28, 3, 10, 'Console de jeu', 29, '2024-06-05 21:12:59', '2024-06-05 21:12:59');

-- --------------------------------------------------------

--
-- Structure de la table `sorties`
--

CREATE TABLE `sorties` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `produits_id` int(10) UNSIGNED NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `dateSortie` date NOT NULL,
  `nom_client` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sorties`
--

INSERT INTO `sorties` (`id`, `user_id`, `produits_id`, `quantite`, `prix`, `dateSortie`, `nom_client`, `created_at`, `updated_at`) VALUES
(11, 4, 20, 8, 398, '2024-05-29', 'Tablette', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(12, 3, 19, 10, 21, '2024-05-24', 'Imprimante', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(13, 5, 23, 18, 457, '2024-06-01', 'Casque sans fil', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(14, 2, 21, 20, 338, '2024-05-15', 'Imprimante', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(15, 4, 19, 16, 369, '2024-05-12', 'Laptop', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(16, 4, 24, 15, 147, '2024-05-29', 'Imprimante', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(17, 2, 26, 11, 330, '2024-05-22', 'Enceinte Bluetooth', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(18, 2, 24, 13, 58, '2024-05-30', 'Console de jeu', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(19, 3, 28, 11, 187, '2024-06-01', 'Enceinte Bluetooth', '2024-06-05 21:12:59', '2024-06-05 21:12:59'),
(20, 5, 21, 5, 144, '2024-06-02', 'Appareil photo', '2024-06-05 21:12:59', '2024-06-05 21:12:59');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','super_admin') NOT NULL DEFAULT 'admin',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'superAdmin@gmail.com', 'super_admin', '2024-06-05 19:07:53', '$2y$12$rWT27WMw9s8fsBMctemVOeD7i3eGRvXf/5XC/ofemo9ywFFFUiQDy', 'BegWwOCZJ2nZoDYePv936BAG7du1DrcWFrJ83EiP4gUUw3Ure9xPABl1YPez', '2024-06-05 19:07:53', '2024-06-05 19:07:53'),
(2, 'admin', 'admin@gmail.com', 'super_admin', '2024-06-05 19:07:53', '$2y$12$L9CV2rv/LBxE4X1ORykYienG/Cw9n6GMeUA2yEwWWJ4HX/SURmV4e', 'd91f59b19bcfb112d1d5b61265c8c0cae8ef6e1685500c69d827dd4783e025f4', '2024-06-05 19:07:53', '2024-06-05 19:07:53'),
(3, 'youssef', 'supeaaxxmin@gmail.com', 'super_admin', NULL, '$2y$12$KxvaFcCCFLNrmHMHgdRRseqTk9jiY2FXu7qx6TOKrbYeJX0VHFm5O', NULL, '2024-06-05 20:33:11', '2024-06-05 20:33:11'),
(4, 'super admin', 'superAdmin@gmail.com', 'super_admin', '2024-06-05 21:12:58', '$2y$12$ZB7ZB8cijJIPp55NlEQIFOgX8LCM4XsaeepBNwX4342Ca0QY6nDL2', 'a23caee19f1a0c5acc88b62290126ebcff63ac95d875ea0500233239c94f75a1', '2024-06-05 21:12:58', '2024-06-05 21:12:58'),
(5, 'admin', 'admin@gmail.com', 'admin', '2024-06-05 21:12:59', '$2y$12$EIA.aJtce4sQ4p6Ldp5OYO7T4CZRumhYlHcTJ9Xo2b2cHdrrORIrm', '15e22cb0b1f25e138a8632e02f617828ec8d03e4c7136fc838f9326063007dc7', '2024-06-05 21:12:59', '2024-06-05 21:12:59');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entrees`
--
ALTER TABLE `entrees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entrees_user_id_foreign` (`user_id`),
  ADD KEY `entrees_produits_id_foreign` (`produits_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produits_user_id_foreign` (`user_id`),
  ADD KEY `produits_categories_id_foreign` (`categories_id`);

--
-- Index pour la table `sorties`
--
ALTER TABLE `sorties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sorties_user_id_foreign` (`user_id`),
  ADD KEY `sorties_produits_id_foreign` (`produits_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `entrees`
--
ALTER TABLE `entrees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `sorties`
--
ALTER TABLE `sorties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `entrees`
--
ALTER TABLE `entrees`
  ADD CONSTRAINT `entrees_produits_id_foreign` FOREIGN KEY (`produits_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entrees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_categories_id_foreign` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `sorties`
--
ALTER TABLE `sorties`
  ADD CONSTRAINT `sorties_produits_id_foreign` FOREIGN KEY (`produits_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sorties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
