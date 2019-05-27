-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2019 a las 21:52:20
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
-- Estructura de tabla para la tabla `appointments`
--

CREATE TABLE `appointments` (
  `id` int(10) UNSIGNED NOT NULL,
  `dateAppointment` date NOT NULL,
  `dniPacient` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `appointments`
--

INSERT INTO `appointments` (`id`, `dateAppointment`, `dniPacient`) VALUES
(1, '2019-05-19', '123'),
(3, '2019-05-12', '123'),
(4, '2019-05-24', '123'),
(7, '2019-05-05', '123'),
(8, '2019-05-05', '123'),
(10, '2019-05-05', '123'),
(11, '2019-05-25', '123'),
(12, '2019-05-25', '11111111H');

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

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ssss@gmail.com', '$2y$10$qpBy9SVXlo0krkHQwNMFTuJh1OVzk0pK6haLY9WawD/h34Gi9GJ.G', '2019-05-15 12:54:26');

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

--
-- Volcado de datos para la tabla `reports`
--

INSERT INTO `reports` (`id`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `total`, `dniPacient`, `created_at`, `updated_at`) VALUES
(2, 0, 5, 5, 12, 22, 0, 5, 52, 52, 52, 100222, '11111111H', '2019-05-22 11:51:22', '2019-05-22 11:51:22'),
(7, 0, 5, 5, 5, 5, 0, 5, 5, 5, 5, 100, '11111111H', '2019-05-22 11:51:22', '2019-05-22 11:51:22');

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
(1, 'admin', 'Administrator', '2019-05-13 09:33:38', '2019-05-13 09:33:38'),
(2, 'pacient', 'Pacient', '2019-05-13 09:33:38', '2019-05-13 09:33:38'),
(3, 'doctor', 'Doctor', '2019-05-13 09:33:38', '2019-05-13 09:33:38');

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
(1, 1, 19, '2019-05-13 13:00:41', '2019-05-13 13:00:41'),
(2, 2, 16, '2019-05-14 01:39:14', '2019-05-14 01:39:14'),
(3, 2, 20, '2019-05-15 11:41:34', '2019-05-15 11:41:34'),
(4, 3, 17, '2019-05-15 11:45:22', '2019-05-15 11:45:22'),
(18, 2, 43, '2019-05-21 14:22:32', '2019-05-21 14:22:32'),
(19, 2, 47, '2019-05-22 01:35:33', '2019-05-22 01:35:33'),
(20, 2, 37, '2019-05-17 10:13:06', '2019-05-17 10:13:06');

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
  `phone` int(9) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profesion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `dni`, `name`, `surname`, `bornDate`, `email`, `phone`, `password`, `profesion`, `remember_token`, `created_at`, `updated_at`) VALUES
(17, '4560839e', 'coronado', 'rojas', '2900-09-29 00:00:00', 'andersonco@hotmail.com', 0, '$2y$10$EYP.HaO8L.oR7jOLJy/OHehoFBjN9kP1BT/aVR2o8KIBwaXFqyTfG', NULL, NULL, '2019-05-15 11:41:34', '2019-05-15 11:41:34'),
(19, 'y4560839e', 'anderson', 'coronado', '1992-09-28 00:00:00', 'rojas@gmail.com', 0, '$2y$10$EYP.HaO8L.oR7jOLJy/OHehoFBjN9kP1BT/aVR2o8KIBwaXFqyTfG', NULL, NULL, '2019-05-15 11:45:22', '2019-05-21 12:05:02'),
(20, '123', 'ssss', 'ssss', '2029-09-28 00:00:00', 'ssss@gmail.com', 9000000, '$2y$10$1peIsWI6lNfbaGBmf5bh1eXf8fIihAgJgGxxvPB76TvjNTtjwrk46', NULL, NULL, '2019-05-15 11:46:19', '2019-05-15 11:46:19'),
(37, '4560839ea', '27', 'pepito', '2019-05-31 00:00:00', 'peter1@pepito.com', 0, '$2y$10$1peIsWI6lNfbaGBmf5bh1eXf8fIihAgJgGxxvPB76TvjNTtjwrk46', NULL, NULL, '2019-05-17 10:13:06', '2019-05-17 10:13:06'),
(43, '11111111H', 'Anderson', 'coronado', '1992-06-28 00:00:00', 'coronado@gmail.com', 635867128, '$2y$10$gpykYCP4Or5dujBLVrKFy.aoMIbRNtf6ZqoT.dcCXjKxzdL6WCrKa', NULL, NULL, '2019-05-21 14:22:32', '2019-05-21 14:23:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_dnipacient_foreign` (`dniPacient`);

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
-- AUTO_INCREMENT de la tabla `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_dnipacient_foreign` FOREIGN KEY (`dniPacient`) REFERENCES `users` (`dni`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_dnipacient_foreign` FOREIGN KEY (`dniPacient`) REFERENCES `users` (`dni`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
