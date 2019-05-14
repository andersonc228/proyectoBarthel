-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2019 a las 20:17:56
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(34, '2014_10_12_000000_create_users_table', 1),
(35, '2014_10_12_100000_create_password_resets_table', 1),
(36, '2019_05_10_170515_create_roles_table', 1),
(37, '2019_05_11_105915_create_role_user_table', 1),
(38, '2019_05_12_143939_create_reports_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `q1` mediumint(9) NOT NULL,
  `q2` mediumint(9) NOT NULL,
  `q3` mediumint(9) NOT NULL,
  `q4` mediumint(9) NOT NULL,
  `q5` mediumint(9) NOT NULL,
  `q6` mediumint(9) NOT NULL,
  `q7` mediumint(9) NOT NULL,
  `q8` mediumint(9) NOT NULL,
  `q9` mediumint(9) NOT NULL,
  `q10` mediumint(9) NOT NULL,
  `total` mediumint(9) NOT NULL,
  `dniPacient` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2019-05-13 11:33:38', '2019-05-13 11:33:38'),
(2, 'pacient', 'Pacient', '2019-05-13 11:33:38', '2019-05-13 11:33:38'),
(3, 'doctor', 'Doctor', '2019-05-13 11:33:38', '2019-05-13 11:33:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 14, '2019-05-13 15:00:41', '2019-05-13 15:00:41'),
(2, 2, 16, '2019-05-14 03:39:14', '2019-05-14 03:39:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dni` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bornDate` datetime NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profesion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `dni`, `name`, `surname`, `bornDate`, `email`, `password`, `profesion`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, '1231321a', 'Diego Carretero', 'pepito', '2019-06-08 00:00:00', 'anderson@gmail.com', '$2y$10$I5VuaZB6e32yQllDTZRGMegL480iElRUiZiX3i9lOAxiS9XaCYTYe', NULL, NULL, '2019-05-13 12:33:20', '2019-05-13 12:33:20'),
(4, '4560839w', 'admin', 'pepito', '2019-05-16 00:00:00', 'user@example.com', '$2y$10$5fAGiHAsqYKs4f2lxKY/T.bXIAY3MnWydbocWz0qt0BNEwvFjUlJm', NULL, NULL, '2019-05-13 12:34:56', '2019-05-13 12:34:56'),
(5, '45608392d', 'ssaaaaaa', 'pepito rojas', '2019-05-09 00:00:00', 'ooooo@oooo.com', '$2y$10$El11hT6/3/zVFsq4koqIuuij8AObyBYjEwfowRCxIzAXsQXO02/I.', NULL, NULL, '2019-05-13 12:37:58', '2019-05-13 12:37:58'),
(6, '4560839r', 'rojas', 'pepito', '2019-05-02 00:00:00', 'peter13@pepito.com', '$2y$10$/Rm.uX0E2Mj43SGviDgz1e5cja.x..dPXTB2mFPx306NE.jHCIv2e', NULL, NULL, '2019-05-13 12:38:50', '2019-05-13 12:38:50'),
(7, '1231321t', 'Anderson', 'jajajajajjaja', '2019-05-04 00:00:00', 'peters1@pepito.com', '$2y$10$0JvzTS/chymHf31kSOl7Lew1kV9a0XruQwoTuuw5h2TCFP0EqXCRu', NULL, NULL, '2019-05-13 12:42:39', '2019-05-13 12:42:39'),
(8, '1231321x', 'prueb', 'jajajajajjaja', '2019-05-09 00:00:00', 'userss@example.com', '$2y$10$Sj8H1Tyb2N42WbCLLDnzWuGE87CFEQLyJLO.4zwWwRVU.9.QPLmfi', NULL, NULL, '2019-05-13 12:44:46', '2019-05-13 12:44:46'),
(9, '1231321q', 'Anderson', 'pepito rojas', '2019-05-11 00:00:00', 'andersonwww@gmail.com', '$2y$10$bPcPl2fjT4UGx9qkzWN9cuBIDtgoS2lb6fwmSLZ6f1KndW1Z7f/EC', NULL, NULL, '2019-05-13 12:47:01', '2019-05-13 12:47:01'),
(10, '1231321y', 'Anderson', 'jajajajajjaja', '2019-05-02 00:00:00', 'peter144@pepito.com', '$2y$10$pHotER4b0x8EMq.sCVMFJuFfTL6mpobMfEYtUnmXPvxY2g9pE1LI2', NULL, NULL, '2019-05-13 13:01:50', '2019-05-13 13:01:50'),
(11, '1231321ee', 'prueb', 'pepito', '2019-05-08 00:00:00', 'peter133@pepito.com', '$2y$10$H6sMCr60LHCCzP476VNmJez1gC1bzXjttrOONTDwUcZ9vW3HNCtqC', NULL, NULL, '2019-05-13 13:02:40', '2019-05-13 13:02:40'),
(12, '1222ddd', 'aassss', 'asssss', '2019-05-09 00:00:00', 'peter333@pepito.com', '$2y$10$SvKEHZZkHcfez.g4/9xvdOm0zOcHvtaPBhwJSTRDfCeJVnVM.70.K', NULL, NULL, '2019-05-13 13:27:59', '2019-05-13 13:27:59'),
(14, 'anderson', 'anderson', 'anderson', '9222-02-09 00:00:00', 'andersonc228@gmail.com', '$2y$10$mB490iH6/Jzf1SV40gaKGuxmhOOVcbXAfZsXgQahSlBQdc7wfLMOG', NULL, NULL, '2019-05-13 15:00:41', '2019-05-13 15:00:41'),
(16, '12345', 'aasdas', 'dsada', '2019-05-15 00:00:00', 'andersonc@gmail.com', '$2y$10$MWLHU7b8E2J7XzAsSQGq8eT9VBSXREm5H/sXv0uPau./1gl/FgrGy', NULL, NULL, '2019-05-14 03:39:14', '2019-05-14 03:39:14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_dnipacient_foreign` (`dniPacient`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_dni_unique` (`dni`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_dnipacient_foreign` FOREIGN KEY (`dniPacient`) REFERENCES `users` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
