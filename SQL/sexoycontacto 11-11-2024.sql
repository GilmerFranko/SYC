-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 11-10-2024 a las 12:08:25
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sexoycontacto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity_log`
--

CREATE TABLE `activity_log` (
  `log_id` bigint(20) UNSIGNED NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `action_type` varchar(50) DEFAULT NULL,
  `action_description` text DEFAULT NULL,
  `timestamp` varchar(12) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auto_renueva_settings`
--

CREATE TABLE `auto_renueva_settings` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `is_enabled` tinyint(1) DEFAULT 0,
  `renewal_interval` int(11) DEFAULT 6
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auto_renueva_settings`
--

INSERT INTO `auto_renueva_settings` (`id`, `thread_id`, `is_enabled`, `renewal_interval`) VALUES
(13, 6, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `f_contacts`
--

CREATE TABLE `f_contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_url` varchar(64) DEFAULT NULL,
  `image` varchar(64) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `priority` int(11) DEFAULT 0,
  `visibility` tinyint(1) DEFAULT 1,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `f_contacts`
--

INSERT INTO `f_contacts` (`id`, `name`, `short_url`, `image`, `status`, `priority`, `visibility`, `created_at`, `updated_at`) VALUES
(8, 'CONTACTO HOMBRES', 'contacto-hombres', 'b2bec418d936b73cb7e6c019d039.png', 1, 0, 1, 1723930187, 1728417589),
(9, 'CONTACTO MUJERES', 'contactos-mujeres', '7272a124c2fc45510b7cb8c2fa88.png', 1, 0, 1, 1724265280, 1728419553),
(10, 'CONTACTO GAYS', 'contacto-gays', '74f9360d2f418d58af3ad0732c20.png', 1, 0, 1, 1726595336, 1728419674),
(11, 'CONTACTO LESBIANAS', 'contacto-lesbianas', '2551b77846c225785dbe1be0a477.png', 1, 0, 1, 1728419704, 1728419704),
(12, 'TRANSEXUALES Y TRAVESTIS', 'transexuales-y-travestis', 'b9edb12c1b0a2484a69121d3eb17.png', 1, 0, 1, 1728419758, 1728419758),
(13, 'PAREJAS LIBERALES', 'parejas-liberales', '0083c5853ccc8b1e26fc16fad03d.png', 1, 0, 1, 1728420832, 1728420832),
(14, 'HABITACIONES', 'habitaciones', 'f4ffa8a2f7d630e94bd66857db48.png', 1, 0, 1, 1728420858, 1728420858),
(15, 'LINEAS EROTICAS', 'lineas-eroticas', '51dd38469bf9da09a73984446d89.png', 1, 0, 1, 1728420925, 1728420925);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `f_locations`
--

CREATE TABLE `f_locations` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_url` varchar(64) NOT NULL,
  `description` text DEFAULT NULL,
  `topic_count` int(11) DEFAULT 0 COMMENT 'Number of topics in the forum.',
  `post_count` int(11) DEFAULT 0 COMMENT 'Numero de publicaciones en el foro',
  `last_post_id` int(11) DEFAULT NULL,
  `visibility` tinyint(1) DEFAULT 1,
  `status` tinyint(1) DEFAULT 1,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `f_locations`
--

INSERT INTO `f_locations` (`id`, `contact_id`, `name`, `short_url`, `description`, `topic_count`, `post_count`, `last_post_id`, `visibility`, `status`, `created_at`, `updated_at`) VALUES
(161, 8, 'Álava', 'c-hombres-alava', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(162, 8, 'Albacete', 'c-hombres-albacete', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(163, 8, 'Alicante', 'c-hombres-alicante', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(164, 8, 'Almería', 'c-hombres-almeria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(165, 8, 'Asturias', 'c-hombres-asturias', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(166, 8, 'Ávila', 'c-hombres-avila', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(167, 8, 'Badajoz', 'c-hombres-badajoz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(168, 8, 'Baleares', 'c-hombres-baleares', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(169, 8, 'Barcelona', 'c-hombres-barcelona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(170, 8, 'Burgos', 'c-hombres-burgos', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(171, 8, 'Cáceres', 'c-hombres-caceres', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(172, 8, 'Cádiz', 'c-hombres-cadiz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(173, 8, 'Cantabria', 'c-hombres-cantabria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(174, 8, 'Castellón', 'c-hombres-castellon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(175, 8, 'Ceuta', 'c-hombres-ceuta', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(176, 8, 'Ciudad Real', 'c-hombres-ciudad-real', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(177, 8, 'Córdoba', 'c-hombres-cordoba', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(178, 8, 'Cuenca', 'c-hombres-cuenca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(179, 8, 'Girona', 'c-hombres-girona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(180, 8, 'Granada', 'c-hombres-granada', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(181, 8, 'Guadalajara', 'c-hombres-guadalajara', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(182, 8, 'Guipúzcoa', 'c-hombres-guipuzcoa', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(183, 8, 'Huelva', 'c-hombres-huelva', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(184, 8, 'Huesca', 'c-hombres-huesca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(185, 8, 'Jaén', 'c-hombres-jaen', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(186, 8, 'A Coruña', 'c-hombres-a-coruna', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(187, 8, 'La Rioja', 'c-hombres-la-rioja', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(188, 8, 'Las Palmas', 'c-hombres-las-palmas', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(189, 8, 'León', 'c-hombres-leon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(190, 8, 'Lleida', 'c-hombres-lleida', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(191, 8, 'Lugo', 'c-hombres-lugo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(192, 8, 'Madrid', 'c-hombres-madrid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(193, 8, 'Málaga', 'c-hombres-malaga', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(194, 8, 'Melilla', 'c-hombres-melilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(195, 8, 'Murcia', 'c-hombres-murcia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(196, 8, 'Navarra', 'c-hombres-navarra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(197, 8, 'Ourense', 'c-hombres-ourense', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(198, 8, 'Palencia', 'c-hombres-palencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(199, 8, 'Pontevedra', 'c-hombres-pontevedra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(200, 8, 'Salamanca', 'c-hombres-salamanca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(201, 8, 'Segovia', 'c-hombres-segovia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(202, 8, 'Sevilla', 'c-hombres-sevilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(203, 8, 'Soria', 'c-hombres-soria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(204, 8, 'Tarragona', 'c-hombres-tarragona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(205, 8, 'Santa Cruz de Tenerife', 'c-hombres-santa-cruz-de-tenerife', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(206, 8, 'Teruel', 'c-hombres-teruel', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(207, 8, 'Toledo', 'c-hombres-toledo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(208, 8, 'Valencia', 'c-hombres-valencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(209, 8, 'Valladolid', 'c-hombres-valladolid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(210, 8, 'Vizcaya', 'c-hombres-vizcaya', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(211, 8, 'Zamora', 'c-hombres-zamora', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(212, 8, 'Zaragoza', 'c-hombres-zaragoza', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(213, 9, 'Álava', 'c-mujeres-c-gays-c-mujeres-alava', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(214, 9, 'Albacete', 'c-mujeres-c-gays-c-mujeres-albacete', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(215, 9, 'Alicante', 'c-mujeres-c-gays-c-mujeres-alicante', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(216, 9, 'Almería', 'c-mujeres-c-gays-c-mujeres-almeria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(217, 9, 'Asturias', 'c-mujeres-c-gays-c-mujeres-asturias', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(218, 9, 'Ávila', 'c-mujeres-c-gays-c-mujeres-avila', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(219, 9, 'Badajoz', 'c-mujeres-c-gays-c-mujeres-badajoz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(220, 9, 'Baleares', 'c-mujeres-c-gays-c-mujeres-baleares', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(221, 9, 'Barcelona', 'c-mujeres-c-gays-c-mujeres-barcelona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(222, 9, 'Burgos', 'c-mujeres-c-gays-c-mujeres-burgos', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(223, 9, 'Cáceres', 'c-mujeres-c-gays-c-mujeres-caceres', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(224, 9, 'Cádiz', 'c-mujeres-c-gays-c-mujeres-cadiz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(225, 9, 'Cantabria', 'c-mujeres-c-gays-c-mujeres-cantabria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(226, 9, 'Castellón', 'c-mujeres-c-gays-c-mujeres-castellon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(227, 9, 'Ceuta', 'c-mujeres-c-gays-c-mujeres-ceuta', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(228, 9, 'Ciudad Real', 'c-mujeres-c-gays-c-mujeres-ciudad-real', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(229, 9, 'Córdoba', 'c-mujeres-c-gays-c-mujeres-cordoba', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(230, 9, 'Cuenca', 'c-mujeres-c-gays-c-mujeres-cuenca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(231, 9, 'Girona', 'c-mujeres-c-gays-c-mujeres-girona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(232, 9, 'Granada', 'c-mujeres-c-gays-c-mujeres-granada', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(233, 9, 'Guadalajara', 'c-mujeres-c-gays-c-mujeres-guadalajara', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(234, 9, 'Guipúzcoa', 'c-mujeres-c-gays-c-mujeres-guipuzcoa', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(235, 9, 'Huelva', 'c-mujeres-c-gays-c-mujeres-huelva', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(236, 9, 'Huesca', 'c-mujeres-c-gays-c-mujeres-huesca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(237, 9, 'Jaén', 'c-mujeres-c-gays-c-mujeres-jaen', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(238, 9, 'A Coruña', 'c-mujeres-c-gays-c-mujeres-a-coruna', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(239, 9, 'La Rioja', 'c-mujeres-c-gays-c-mujeres-la-rioja', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(240, 9, 'Las Palmas', 'c-mujeres-c-gays-c-mujeres-las-palmas', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(241, 9, 'León', 'c-mujeres-c-gays-c-mujeres-leon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(242, 9, 'Lleida', 'c-mujeres-c-gays-c-mujeres-lleida', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(243, 9, 'Lugo', 'c-mujeres-c-gays-c-mujeres-lugo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(244, 9, 'Madrid', 'c-mujeres-c-gays-c-mujeres-madrid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(245, 9, 'Málaga', 'c-mujeres-c-gays-c-mujeres-malaga', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(246, 9, 'Melilla', 'c-mujeres-c-gays-c-mujeres-melilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(247, 9, 'Murcia', 'c-mujeres-c-gays-c-mujeres-murcia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(248, 9, 'Navarra', 'c-mujeres-c-gays-c-mujeres-navarra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(249, 9, 'Ourense', 'c-mujeres-c-gays-c-mujeres-ourense', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(250, 9, 'Palencia', 'c-mujeres-c-gays-c-mujeres-palencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(251, 9, 'Pontevedra', 'c-mujeres-c-gays-c-mujeres-pontevedra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(252, 9, 'Salamanca', 'c-mujeres-c-gays-c-mujeres-salamanca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(253, 9, 'Segovia', 'c-mujeres-c-gays-c-mujeres-segovia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(254, 9, 'Sevilla', 'c-mujeres-c-gays-c-mujeres-sevilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(255, 9, 'Soria', 'c-mujeres-c-gays-c-mujeres-soria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(256, 9, 'Tarragona', 'c-mujeres-c-gays-c-mujeres-tarragona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(257, 9, 'Santa Cruz de Tenerife', 'c-mujeres-c-gays-c-mujeres-santa-cruz-de-tenerife', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(258, 9, 'Teruel', 'c-mujeres-c-gays-c-mujeres-teruel', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(259, 9, 'Toledo', 'c-mujeres-c-gays-c-mujeres-toledo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(260, 9, 'Valencia', 'c-mujeres-c-gays-c-mujeres-valencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(261, 9, 'Valladolid', 'c-mujeres-c-gays-c-mujeres-valladolid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(262, 9, 'Vizcaya', 'c-mujeres-c-gays-c-mujeres-vizcaya', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(263, 9, 'Zamora', 'c-mujeres-c-gays-c-mujeres-zamora', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(264, 9, 'Zaragoza', 'c-mujeres-c-gays-c-mujeres-zaragoza', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(265, 10, 'Álava', 'c-gays-c-gays-c-lesbianas-alava', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(266, 10, 'Albacete', 'c-gays-c-gays-c-lesbianas-albacete', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(267, 10, 'Alicante', 'c-gays-c-gays-c-lesbianas-alicante', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(268, 10, 'Almería', 'c-gays-c-gays-c-lesbianas-almeria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(269, 10, 'Asturias', 'c-gays-c-gays-c-lesbianas-asturias', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(270, 10, 'Ávila', 'c-gays-c-gays-c-lesbianas-avila', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(271, 10, 'Badajoz', 'c-gays-c-gays-c-lesbianas-badajoz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(272, 10, 'Baleares', 'c-gays-c-gays-c-lesbianas-baleares', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(273, 10, 'Barcelona', 'c-gays-c-gays-c-lesbianas-barcelona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(274, 10, 'Burgos', 'c-gays-c-gays-c-lesbianas-burgos', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(275, 10, 'Cáceres', 'c-gays-c-gays-c-lesbianas-caceres', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(276, 10, 'Cádiz', 'c-gays-c-gays-c-lesbianas-cadiz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(277, 10, 'Cantabria', 'c-gays-c-gays-c-lesbianas-cantabria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(278, 10, 'Castellón', 'c-gays-c-gays-c-lesbianas-castellon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(279, 10, 'Ceuta', 'c-gays-c-gays-c-lesbianas-ceuta', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(280, 10, 'Ciudad Real', 'c-gays-c-gays-c-lesbianas-ciudad-real', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(281, 10, 'Córdoba', 'c-gays-c-gays-c-lesbianas-cordoba', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(282, 10, 'Cuenca', 'c-gays-c-gays-c-lesbianas-cuenca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(283, 10, 'Girona', 'c-gays-c-gays-c-lesbianas-girona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(284, 10, 'Granada', 'c-gays-c-gays-c-lesbianas-granada', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(285, 10, 'Guadalajara', 'c-gays-c-gays-c-lesbianas-guadalajara', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(286, 10, 'Guipúzcoa', 'c-gays-c-gays-c-lesbianas-guipuzcoa', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(287, 10, 'Huelva', 'c-gays-c-gays-c-lesbianas-huelva', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(288, 10, 'Huesca', 'c-gays-c-gays-c-lesbianas-huesca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(289, 10, 'Jaén', 'c-gays-c-gays-c-lesbianas-jaen', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(290, 10, 'A Coruña', 'c-gays-c-gays-c-lesbianas-a-coruna', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(291, 10, 'La Rioja', 'c-gays-c-gays-c-lesbianas-la-rioja', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(292, 10, 'Las Palmas', 'c-gays-c-gays-c-lesbianas-las-palmas', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(293, 10, 'León', 'c-gays-c-gays-c-lesbianas-leon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(294, 10, 'Lleida', 'c-gays-c-gays-c-lesbianas-lleida', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(295, 10, 'Lugo', 'c-gays-c-gays-c-lesbianas-lugo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(296, 10, 'Madrid', 'c-gays-c-gays-c-lesbianas-madrid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(297, 10, 'Málaga', 'c-gays-c-gays-c-lesbianas-malaga', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(298, 10, 'Melilla', 'c-gays-c-gays-c-lesbianas-melilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(299, 10, 'Murcia', 'c-gays-c-gays-c-lesbianas-murcia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(300, 10, 'Navarra', 'c-gays-c-gays-c-lesbianas-navarra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(301, 10, 'Ourense', 'c-gays-c-gays-c-lesbianas-ourense', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(302, 10, 'Palencia', 'c-gays-c-gays-c-lesbianas-palencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(303, 10, 'Pontevedra', 'c-gays-c-gays-c-lesbianas-pontevedra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(304, 10, 'Salamanca', 'c-gays-c-gays-c-lesbianas-salamanca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(305, 10, 'Segovia', 'c-gays-c-gays-c-lesbianas-segovia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(306, 10, 'Sevilla', 'c-gays-c-gays-c-lesbianas-sevilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(307, 10, 'Soria', 'c-gays-c-gays-c-lesbianas-soria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(308, 10, 'Tarragona', 'c-gays-c-gays-c-lesbianas-tarragona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(309, 10, 'Santa Cruz de Tenerife', 'c-gays-c-gays-c-lesbianas-santa-cruz-de-tenerife', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(310, 10, 'Teruel', 'c-gays-c-gays-c-lesbianas-teruel', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(311, 10, 'Toledo', 'c-gays-c-gays-c-lesbianas-toledo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(312, 10, 'Valencia', 'c-gays-c-gays-c-lesbianas-valencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(313, 10, 'Valladolid', 'c-gays-c-gays-c-lesbianas-valladolid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(314, 10, 'Vizcaya', 'c-gays-c-gays-c-lesbianas-vizcaya', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(315, 10, 'Zamora', 'c-gays-c-gays-c-lesbianas-zamora', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(316, 10, 'Zaragoza', 'c-gays-c-gays-c-lesbianas-zaragoza', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(317, 11, 'Álava', 'c-lesbianas-alava', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(318, 11, 'Albacete', 'c-lesbianas-albacete', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(319, 11, 'Alicante', 'c-lesbianas-alicante', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(320, 11, 'Almería', 'c-lesbianas-almeria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(321, 11, 'Asturias', 'c-lesbianas-asturias', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(322, 11, 'Ávila', 'c-lesbianas-avila', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(323, 11, 'Badajoz', 'c-lesbianas-badajoz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(324, 11, 'Baleares', 'c-lesbianas-baleares', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(325, 11, 'Barcelona', 'c-lesbianas-barcelona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(326, 11, 'Burgos', 'c-lesbianas-burgos', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(327, 11, 'Cáceres', 'c-lesbianas-caceres', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(328, 11, 'Cádiz', 'c-lesbianas-cadiz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(329, 11, 'Cantabria', 'c-lesbianas-cantabria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(330, 11, 'Castellón', 'c-lesbianas-castellon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(331, 11, 'Ceuta', 'c-lesbianas-ceuta', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(332, 11, 'Ciudad Real', 'c-lesbianas-ciudad-real', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(333, 11, 'Córdoba', 'c-lesbianas-cordoba', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(334, 11, 'Cuenca', 'c-lesbianas-cuenca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(335, 11, 'Girona', 'c-lesbianas-girona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(336, 11, 'Granada', 'c-lesbianas-granada', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(337, 11, 'Guadalajara', 'c-lesbianas-guadalajara', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(338, 11, 'Guipúzcoa', 'c-lesbianas-guipuzcoa', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(339, 11, 'Huelva', 'c-lesbianas-huelva', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(340, 11, 'Huesca', 'c-lesbianas-huesca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(341, 11, 'Jaén', 'c-lesbianas-jaen', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(342, 11, 'A Coruña', 'c-lesbianas-a-coruna', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(343, 11, 'La Rioja', 'c-lesbianas-la-rioja', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(344, 11, 'Las Palmas', 'c-lesbianas-las-palmas', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(345, 11, 'León', 'c-lesbianas-leon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(346, 11, 'Lleida', 'c-lesbianas-lleida', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(347, 11, 'Lugo', 'c-lesbianas-lugo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(348, 11, 'Madrid', 'c-lesbianas-madrid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(349, 11, 'Málaga', 'c-lesbianas-malaga', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(350, 11, 'Melilla', 'c-lesbianas-melilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(351, 11, 'Murcia', 'c-lesbianas-murcia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(352, 11, 'Navarra', 'c-lesbianas-navarra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(353, 11, 'Ourense', 'c-lesbianas-ourense', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(354, 11, 'Palencia', 'c-lesbianas-palencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(355, 11, 'Pontevedra', 'c-lesbianas-pontevedra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(356, 11, 'Salamanca', 'c-lesbianas-salamanca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(357, 11, 'Segovia', 'c-lesbianas-segovia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(358, 11, 'Sevilla', 'c-lesbianas-sevilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(359, 11, 'Soria', 'c-lesbianas-soria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(360, 11, 'Tarragona', 'c-lesbianas-tarragona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(361, 11, 'Santa Cruz de Tenerife', 'c-lesbianas-santa-cruz-de-tenerife', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(362, 11, 'Teruel', 'c-lesbianas-teruel', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(363, 11, 'Toledo', 'c-lesbianas-toledo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(364, 11, 'Valencia', 'c-lesbianas-valencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(365, 11, 'Valladolid', 'c-lesbianas-valladolid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(366, 11, 'Vizcaya', 'c-lesbianas-vizcaya', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(367, 11, 'Zamora', 'c-lesbianas-zamora', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(368, 11, 'Zaragoza', 'c-lesbianas-zaragoza', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(369, 12, 'Álava', 'c-trans-alava', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(370, 12, 'Albacete', 'c-trans-albacete', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(371, 12, 'Alicante', 'c-trans-alicante', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(372, 12, 'Almería', 'c-trans-almeria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(373, 12, 'Asturias', 'c-trans-asturias', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(374, 12, 'Ávila', 'c-trans-avila', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(375, 12, 'Badajoz', 'c-trans-badajoz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(376, 12, 'Baleares', 'c-trans-baleares', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(377, 12, 'Barcelona', 'c-trans-barcelona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(378, 12, 'Burgos', 'c-trans-burgos', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(379, 12, 'Cáceres', 'c-trans-caceres', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(380, 12, 'Cádiz', 'c-trans-cadiz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(381, 12, 'Cantabria', 'c-trans-cantabria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(382, 12, 'Castellón', 'c-trans-castellon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(383, 12, 'Ceuta', 'c-trans-ceuta', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(384, 12, 'Ciudad Real', 'c-trans-ciudad-real', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(385, 12, 'Córdoba', 'c-trans-cordoba', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(386, 12, 'Cuenca', 'c-trans-cuenca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(387, 12, 'Girona', 'c-trans-girona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(388, 12, 'Granada', 'c-trans-granada', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(389, 12, 'Guadalajara', 'c-trans-guadalajara', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(390, 12, 'Guipúzcoa', 'c-trans-guipuzcoa', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(391, 12, 'Huelva', 'c-trans-huelva', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(392, 12, 'Huesca', 'c-trans-huesca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(393, 12, 'Jaén', 'c-trans-jaen', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(394, 12, 'A Coruña', 'c-trans-a-coruna', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(395, 12, 'La Rioja', 'c-trans-la-rioja', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(396, 12, 'Las Palmas', 'c-trans-las-palmas', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(397, 12, 'León', 'c-trans-leon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(398, 12, 'Lleida', 'c-trans-lleida', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(399, 12, 'Lugo', 'c-trans-lugo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(400, 12, 'Madrid', 'c-trans-madrid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(401, 12, 'Málaga', 'c-trans-malaga', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(402, 12, 'Melilla', 'c-trans-melilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(403, 12, 'Murcia', 'c-trans-murcia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(404, 12, 'Navarra', 'c-trans-navarra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(405, 12, 'Ourense', 'c-trans-ourense', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(406, 12, 'Palencia', 'c-trans-palencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(407, 12, 'Pontevedra', 'c-trans-pontevedra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(408, 12, 'Salamanca', 'c-trans-salamanca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(409, 12, 'Segovia', 'c-trans-segovia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(410, 12, 'Sevilla', 'c-trans-sevilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(411, 12, 'Soria', 'c-trans-soria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(412, 12, 'Tarragona', 'c-trans-tarragona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(413, 12, 'Santa Cruz de Tenerife', 'c-trans-santa-cruz-de-tenerife', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(414, 12, 'Teruel', 'c-trans-teruel', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(415, 12, 'Toledo', 'c-trans-toledo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(416, 12, 'Valencia', 'c-trans-valencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(417, 12, 'Valladolid', 'c-trans-valladolid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(418, 12, 'Vizcaya', 'c-trans-vizcaya', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(419, 12, 'Zamora', 'c-trans-zamora', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(420, 12, 'Zaragoza', 'c-trans-zaragoza', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(421, 13, 'Álava', 'c-liberales-alava', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(422, 13, 'Albacete', 'c-liberales-albacete', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(423, 13, 'Alicante', 'c-liberales-alicante', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(424, 13, 'Almería', 'c-liberales-almeria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(425, 13, 'Asturias', 'c-liberales-asturias', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(426, 13, 'Ávila', 'c-liberales-avila', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(427, 13, 'Badajoz', 'c-liberales-badajoz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(428, 13, 'Baleares', 'c-liberales-baleares', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(429, 13, 'Barcelona', 'c-liberales-barcelona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(430, 13, 'Burgos', 'c-liberales-burgos', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(431, 13, 'Cáceres', 'c-liberales-caceres', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(432, 13, 'Cádiz', 'c-liberales-cadiz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(433, 13, 'Cantabria', 'c-liberales-cantabria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(434, 13, 'Castellón', 'c-liberales-castellon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(435, 13, 'Ceuta', 'c-liberales-ceuta', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(436, 13, 'Ciudad Real', 'c-liberales-ciudad-real', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(437, 13, 'Córdoba', 'c-liberales-cordoba', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(438, 13, 'Cuenca', 'c-liberales-cuenca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(439, 13, 'Girona', 'c-liberales-girona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(440, 13, 'Granada', 'c-liberales-granada', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(441, 13, 'Guadalajara', 'c-liberales-guadalajara', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(442, 13, 'Guipúzcoa', 'c-liberales-guipuzcoa', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(443, 13, 'Huelva', 'c-liberales-huelva', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(444, 13, 'Huesca', 'c-liberales-huesca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(445, 13, 'Jaén', 'c-liberales-jaen', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(446, 13, 'A Coruña', 'c-liberales-a-coruna', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(447, 13, 'La Rioja', 'c-liberales-la-rioja', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(448, 13, 'Las Palmas', 'c-liberales-las-palmas', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(449, 13, 'León', 'c-liberales-leon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(450, 13, 'Lleida', 'c-liberales-lleida', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(451, 13, 'Lugo', 'c-liberales-lugo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(452, 13, 'Madrid', 'c-liberales-madrid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(453, 13, 'Málaga', 'c-liberales-malaga', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(454, 13, 'Melilla', 'c-liberales-melilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(455, 13, 'Murcia', 'c-liberales-murcia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(456, 13, 'Navarra', 'c-liberales-navarra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(457, 13, 'Ourense', 'c-liberales-ourense', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(458, 13, 'Palencia', 'c-liberales-palencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(459, 13, 'Pontevedra', 'c-liberales-pontevedra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(460, 13, 'Salamanca', 'c-liberales-salamanca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(461, 13, 'Segovia', 'c-liberales-segovia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(462, 13, 'Sevilla', 'c-liberales-sevilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(463, 13, 'Soria', 'c-liberales-soria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(464, 13, 'Tarragona', 'c-liberales-tarragona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(465, 13, 'Santa Cruz de Tenerife', 'c-liberales-santa-cruz-de-tenerife', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(466, 13, 'Teruel', 'c-liberales-teruel', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(467, 13, 'Toledo', 'c-liberales-toledo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(468, 13, 'Valencia', 'c-liberales-valencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(469, 13, 'Valladolid', 'c-liberales-valladolid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(470, 13, 'Vizcaya', 'c-liberales-vizcaya', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(471, 13, 'Zamora', 'c-liberales-zamora', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(472, 13, 'Zaragoza', 'c-liberales-zaragoza', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(473, 14, 'Álava', 'c-habitaciones-alava', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(474, 14, 'Albacete', 'c-habitaciones-albacete', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(475, 14, 'Alicante', 'c-habitaciones-alicante', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(476, 14, 'Almería', 'c-habitaciones-almeria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(477, 14, 'Asturias', 'c-habitaciones-asturias', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(478, 14, 'Ávila', 'c-habitaciones-avila', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(479, 14, 'Badajoz', 'c-habitaciones-badajoz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(480, 14, 'Baleares', 'c-habitaciones-baleares', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(481, 14, 'Barcelona', 'c-habitaciones-barcelona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(482, 14, 'Burgos', 'c-habitaciones-burgos', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(483, 14, 'Cáceres', 'c-habitaciones-caceres', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(484, 14, 'Cádiz', 'c-habitaciones-cadiz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(485, 14, 'Cantabria', 'c-habitaciones-cantabria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(486, 14, 'Castellón', 'c-habitaciones-castellon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(487, 14, 'Ceuta', 'c-habitaciones-ceuta', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(488, 14, 'Ciudad Real', 'c-habitaciones-ciudad-real', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(489, 14, 'Córdoba', 'c-habitaciones-cordoba', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(490, 14, 'Cuenca', 'c-habitaciones-cuenca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(491, 14, 'Girona', 'c-habitaciones-girona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(492, 14, 'Granada', 'c-habitaciones-granada', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(493, 14, 'Guadalajara', 'c-habitaciones-guadalajara', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(494, 14, 'Guipúzcoa', 'c-habitaciones-guipuzcoa', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(495, 14, 'Huelva', 'c-habitaciones-huelva', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(496, 14, 'Huesca', 'c-habitaciones-huesca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(497, 14, 'Jaén', 'c-habitaciones-jaen', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(498, 14, 'A Coruña', 'c-habitaciones-a-coruna', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(499, 14, 'La Rioja', 'c-habitaciones-la-rioja', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(500, 14, 'Las Palmas', 'c-habitaciones-las-palmas', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(501, 14, 'León', 'c-habitaciones-leon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(502, 14, 'Lleida', 'c-habitaciones-lleida', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(503, 14, 'Lugo', 'c-habitaciones-lugo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(504, 14, 'Madrid', 'c-habitaciones-madrid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(505, 14, 'Málaga', 'c-habitaciones-malaga', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(506, 14, 'Melilla', 'c-habitaciones-melilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(507, 14, 'Murcia', 'c-habitaciones-murcia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(508, 14, 'Navarra', 'c-habitaciones-navarra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(509, 14, 'Ourense', 'c-habitaciones-ourense', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(510, 14, 'Palencia', 'c-habitaciones-palencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(511, 14, 'Pontevedra', 'c-habitaciones-pontevedra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(512, 14, 'Salamanca', 'c-habitaciones-salamanca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(513, 14, 'Segovia', 'c-habitaciones-segovia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(514, 14, 'Sevilla', 'c-habitaciones-sevilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(515, 14, 'Soria', 'c-habitaciones-soria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(516, 14, 'Tarragona', 'c-habitaciones-tarragona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(517, 14, 'Santa Cruz de Tenerife', 'c-habitaciones-santa-cruz-de-tenerife', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(518, 14, 'Teruel', 'c-habitaciones-teruel', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(519, 14, 'Toledo', 'c-habitaciones-toledo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(520, 14, 'Valencia', 'c-habitaciones-valencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(521, 14, 'Valladolid', 'c-habitaciones-valladolid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(522, 14, 'Vizcaya', 'c-habitaciones-vizcaya', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(523, 14, 'Zamora', 'c-habitaciones-zamora', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(524, 14, 'Zaragoza', 'c-habitaciones-zaragoza', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(525, 15, 'Álava', 'c-lineas-alava', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(526, 15, 'Albacete', 'c-lineas-albacete', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(527, 15, 'Alicante', 'c-lineas-alicante', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(528, 15, 'Almería', 'c-lineas-almeria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(529, 15, 'Asturias', 'c-lineas-asturias', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(530, 15, 'Ávila', 'c-lineas-avila', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(531, 15, 'Badajoz', 'c-lineas-badajoz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(532, 15, 'Baleares', 'c-lineas-baleares', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(533, 15, 'Barcelona', 'c-lineas-barcelona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(534, 15, 'Burgos', 'c-lineas-burgos', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(535, 15, 'Cáceres', 'c-lineas-caceres', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(536, 15, 'Cádiz', 'c-lineas-cadiz', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(537, 15, 'Cantabria', 'c-lineas-cantabria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(538, 15, 'Castellón', 'c-lineas-castellon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(539, 15, 'Ceuta', 'c-lineas-ceuta', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(540, 15, 'Ciudad Real', 'c-lineas-ciudad-real', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(541, 15, 'Córdoba', 'c-lineas-cordoba', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(542, 15, 'Cuenca', 'c-lineas-cuenca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(543, 15, 'Girona', 'c-lineas-girona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(544, 15, 'Granada', 'c-lineas-granada', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(545, 15, 'Guadalajara', 'c-lineas-guadalajara', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(546, 15, 'Guipúzcoa', 'c-lineas-guipuzcoa', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(547, 15, 'Huelva', 'c-lineas-huelva', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(548, 15, 'Huesca', 'c-lineas-huesca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(549, 15, 'Jaén', 'c-lineas-jaen', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(550, 15, 'A Coruña', 'c-lineas-a-coruna', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(551, 15, 'La Rioja', 'c-lineas-la-rioja', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(552, 15, 'Las Palmas', 'c-lineas-las-palmas', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(553, 15, 'León', 'c-lineas-leon', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(554, 15, 'Lleida', 'c-lineas-lleida', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(555, 15, 'Lugo', 'c-lineas-lugo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(556, 15, 'Madrid', 'c-lineas-madrid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(557, 15, 'Málaga', 'c-lineas-malaga', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(558, 15, 'Melilla', 'c-lineas-melilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(559, 15, 'Murcia', 'c-lineas-murcia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(560, 15, 'Navarra', 'c-lineas-navarra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(561, 15, 'Ourense', 'c-lineas-ourense', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(562, 15, 'Palencia', 'c-lineas-palencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(563, 15, 'Pontevedra', 'c-lineas-pontevedra', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(564, 15, 'Salamanca', 'c-lineas-salamanca', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(565, 15, 'Segovia', 'c-lineas-segovia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(566, 15, 'Sevilla', 'c-lineas-sevilla', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(567, 15, 'Soria', 'c-lineas-soria', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(568, 15, 'Tarragona', 'c-lineas-tarragona', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(569, 15, 'Santa Cruz de Tenerife', 'c-lineas-santa-cruz-de-tenerife', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(570, 15, 'Teruel', 'c-lineas-teruel', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(571, 15, 'Toledo', 'c-lineas-toledo', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(572, 15, 'Valencia', 'c-lineas-valencia', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(573, 15, 'Valladolid', 'c-lineas-valladolid', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(574, 15, 'Vizcaya', 'c-lineas-vizcaya', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(575, 15, 'Zamora', 'c-lineas-zamora', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL),
(576, 15, 'Zaragoza', 'c-lineas-zaragoza', NULL, NULL, NULL, NULL, NULL, 1, 1728421683, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `f_locations_visits`
--

CREATE TABLE `f_locations_visits` (
  `id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `ipaddress` varchar(16) DEFAULT NULL,
  `visit_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `f_locations_visits`
--

INSERT INTO `f_locations_visits` (`id`, `location_id`, `member_id`, `ipaddress`, `visit_date`) VALUES
(22, 290, 2131664161, '::1', '2024-10-08 18:57:47'),
(23, 164, 2131664161, '::1', '2024-10-08 18:57:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `f_threads`
--

CREATE TABLE `f_threads` (
  `id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `slug` varchar(64) NOT NULL,
  `title` varchar(255) NOT NULL,
  `email` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `phone` varchar(12) DEFAULT NULL COMMENT 'Telefono',
  `age` int(3) NOT NULL COMMENT 'Edad',
  `fee` int(11) NOT NULL COMMENT 'Tarifa',
  `status` tinyint(1) DEFAULT 1,
  `position` int(11) NOT NULL COMMENT 'Controla la posicion del hilo en el foro, almacena un tiempo unix',
  `count_renewals` int(11) NOT NULL DEFAULT 0 COMMENT 'Cantidad de renovaciones efectuadas',
  `views_count` int(11) DEFAULT 0,
  `replies_count` int(11) DEFAULT 0,
  `likes_count` int(11) DEFAULT 0,
  `count_favorites` int(11) NOT NULL DEFAULT 0 COMMENT 'Veces que se ha guardado a favoritos',
  `ip_address` varchar(45) DEFAULT NULL,
  `report_count` int(11) DEFAULT 0 COMMENT 'Veces que se ha reportado este post',
  `created_at` varchar(12) NOT NULL,
  `updated_at` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `f_threads`
--

INSERT INTO `f_threads` (`id`, `location_id`, `member_id`, `slug`, `title`, `email`, `content`, `phone`, `age`, `fee`, `status`, `position`, `count_renewals`, `views_count`, `replies_count`, `likes_count`, `count_favorites`, `ip_address`, `report_count`, `created_at`, `updated_at`) VALUES
(1, 192, 2, 't-tulo-de-prueba.6705a7f9a1434', 'Título de prueba', 'example@example.com', '[b]Texto en negrita[/b], [i]Texto en cursiva[/i], [url=http://example.com]http://example.com[/url]', '666 666 666', 25, 10, 1, 1728423929, 0, 48, 0, 0, 0, '::1', 0, '1728423929', '0'),
(6, 248, 2131664161, 't-tulo-de-prueba.67075148e50b3', 'Título de prueba', 'example@example.com', '[b]Texto en negrita[/b], [i]Texto en cursiva[/i], [url=http://example.com]http://example.com[/url]', '666 666 666', 25, 10, 1, 1728532862, 0, 1, 0, 0, 1, '::1', 0, '1728532808', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `f_threads_images`
--

CREATE TABLE `f_threads_images` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` varchar(12) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `f_threads_images`
--

INSERT INTO `f_threads_images` (`id`, `thread_id`, `image_url`, `created_at`) VALUES
(1, 1, 'd4b5519e13c064df6f5a42147ddd.png', '1728423929'),
(6, 6, '229e12644beeedcd9669deb7e8ea.png', '1728532808');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `f_threads_reports`
--

CREATE TABLE `f_threads_reports` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `reported_by_member_id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `additional_comments` text DEFAULT NULL,
  `reported_at` varchar(12) NOT NULL,
  `status` enum('pending','reviewed','closed') DEFAULT 'pending',
  `resolved_by_member_id` int(11) DEFAULT NULL,
  `resolved_at` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `f_threads_reports`
--

INSERT INTO `f_threads_reports` (`id`, `thread_id`, `reported_by_member_id`, `reason`, `additional_comments`, `reported_at`, `status`, `resolved_by_member_id`, `resolved_at`) VALUES
(1, 6, 2131664161, 'Contenido inapropiado', NULL, '1728532870', 'pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `f_threads_visits`
--

CREATE TABLE `f_threads_visits` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `ipaddress` varchar(16) DEFAULT NULL,
  `visit_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `f_threads_visits`
--

INSERT INTO `f_threads_visits` (`id`, `thread_id`, `member_id`, `ipaddress`, `visit_date`) VALUES
(3, 1, 2, '::1', '2024-10-08 17:46:06'),
(47, 1, 2, '::1', '2024-10-05 17:46:06'),
(48, 1, 2, '::1', '2024-10-05 17:46:06'),
(49, 1, 2, '::1', '2024-10-05 17:46:06'),
(52, 1, 2131664161, '::1', '2024-10-08 18:58:15'),
(54, 6, 2131664161, '::1', '2024-10-10 00:00:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `globals_messages`
--

CREATE TABLE `globals_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(11) UNSIGNED NOT NULL,
  `channel_id` int(11) UNSIGNED NOT NULL COMMENT 'ID del canal',
  `content` text DEFAULT NULL,
  `image_url` varchar(265) DEFAULT NULL,
  `sent_at` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `globals_messages_channels`
--

CREATE TABLE `globals_messages_channels` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_update` int(11) NOT NULL COMMENT 'Timestamp de ultimo mensaje enviado',
  `status` tinyint(1) DEFAULT 1,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL,
  `group_id` tinyint(2) UNSIGNED NOT NULL DEFAULT 3,
  `email` varchar(150) NOT NULL DEFAULT '',
  `birthday` date NOT NULL DEFAULT '2000-01-01',
  `ip_address` varchar(46) NOT NULL DEFAULT '',
  `banned` int(10) NOT NULL DEFAULT 0 COMMENT 'Fecha de suspensión',
  `banned_reason` varchar(64) DEFAULT NULL COMMENT 'Razon de baneado',
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `last_login` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Último login',
  `notifications` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `session` varchar(32) DEFAULT NULL,
  `pp_timezone` varchar(55) NOT NULL DEFAULT 'Europe/Madrid' COMMENT 'Zona horaria del Usuario',
  `pp_full_name` varchar(255) NOT NULL,
  `pp_main_photo` varchar(255) NOT NULL DEFAULT '',
  `pp_thumb_photo` varchar(255) NOT NULL,
  `pp_photo_type` tinyint(1) NOT NULL DEFAULT 2,
  `pp_setting_preferences` mediumtext DEFAULT NULL,
  `pp_gender` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT 'Sexo (0 hombre, 1 mujer)',
  `pp_joined` int(10) NOT NULL DEFAULT 0 COMMENT 'Fecha de registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `members`
--

INSERT INTO `members` (`member_id`, `name`, `password`, `group_id`, `email`, `birthday`, `ip_address`, `banned`, `banned_reason`, `last_activity`, `last_login`, `notifications`, `session`, `pp_timezone`, `pp_full_name`, `pp_main_photo`, `pp_thumb_photo`, `pp_photo_type`, `pp_setting_preferences`, `pp_gender`, `pp_joined`) VALUES
(1, 'Mike', '$2y$10$3yjHnhGFkq.ewxSIzhMCCuDkZpNjH6Jh4YM2q9Gm6z3BymcakJqja', 1, 'mike@kingsbeet.com', '2000-01-01', '38.51.239.161', 0, NULL, 1720078064, 1720077848, 1, '13c484a68a41df2565b340bfc05b', 'America/Los_Angeles', 'Mike', '1.jpg?_r=1716926738', '1_thumb.jpg?_r=1716926738', 0, NULL, '0', 1716926663),
(2, 'admin', '$2y$10$v.eQOyz3x08w5J2m8xsowuWKyuA8GUBuwmiZNxJurHUwYU94kM4DS', 1, 'gilmerfranko@hotmail.com', '2000-01-01', '::1', 0, 'effe', 1728423969, 1727387692, 0, '4e992c6d03871c8a6f475fce9713', 'Europe/Madrid', 'Administrador', '2.jpg?_r=1719905113', '2_thumb.jpg?_r=1719905113', 0, NULL, '0', 1712838060),
(5, 'Gilmer', '$2y$10$PDS514oAoENTklgQa.PZmezPh84Ucr3WS.LAmSApqk86FaIfQ6l4y', 3, 'gil2017.com@gmail.com', '2000-01-01', '38.51.239.161', 0, '', 1725472500, 1725462286, 0, 'dd65a0923f3db26b890513e029db', 'Asia/Magadan', 'Gilmer', 'default-male-avatar-profile.png', 'default-male-avatar-profile.png', 2, NULL, '0', 1712848899),
(6, 'Miguel Barreto', '$2y$10$gwZoKRfMv4T1JkzHotoOke3wPKgZzrR8w9v9G6g/9g7mNIHhDQ37O', 3, 'barreto_ayala@hotmail.com', '2000-01-01', '201.170.9.134', 0, NULL, 1717712527, 1717711678, 7, 'eeabb235c745cae55180467f4535', 'America/Los_Angeles', 'Miguel Barreto', 'default-male-avatar-profile.png', 'default-male-avatar-profile.png', 2, NULL, '0', 1716007859),
(8, 'Karina', '$2y$10$U2dDnVH/g0JiO6RurOMueu9PcJSFu09DE/eyHkpEy8jetPu/j28t.', 0, 'karina@gmail.com', '2000-01-01', '201.142.172.184', 0, NULL, 0, 0, 0, NULL, 'America/Los_Angeles', 'Karina', 'default-female-avatar-profile.png', 'default-female-avatar-profile.png', 2, NULL, '1', 1716929084),
(9, 'KarinaPastrana', '$2y$10$gWuRAu9mUaPQA8cPK86Z4e8tiN2DkdwMxGzOcbDrWCv6U.r0.Vr86', 3, 'karylebelle10@gmail.com', '2000-01-01', '201.142.172.184', 0, NULL, 1716929628, 1716929396, 3, 'c36098dcdc1ba82ff1ca1e0d8b4f', 'America/Los_Angeles', 'KarinaPastrana', 'default-female-avatar-profile.png', 'default-female-avatar-profile.png', 2, NULL, '1', 1716929181),
(10, 'Jose Gonzalez', '$2y$10$8up9HRkvNkVeg3eQj2n3eODzEO2IWy5s8NclCEZkmZFkxpPVqHSfK', 3, 'jamesroot407@gmail.com', '1999-07-04', '189.202.79.36', 0, NULL, 1717713815, 1717711702, 4, 'f41e6ded0002c304b93fdcfaa8c4', 'America/Los_Angeles', 'Jose Gonzalez', 'default-male-avatar-profile.png', 'default-male-avatar-profile.png', 2, NULL, '0', 1717710684),
(11, 'franco', '$2y$10$v.eQOyz3x08w5J2m8xsowuWKyuA8GUBuwmiZNxJurHUwYU94kM4DS', 2, 'franco@gmail.com', '2024-07-24', '::1', 1725400390, NULL, 1720562836, 1720562069, 0, 'e7ff2f045e3b6e51f0737cc1e8d9', 'America/Los_Angeles', 'franco', 'default-male-avatar-profile.png', 'default-male-avatar-profile.png', 2, NULL, '0', 1720562069),
(14804152, 'Loren', 'uQ7*YMslTH=(C', 105, 'lrubinowiczf@google.nl', '1945-02-05', '84.171.237.62', 11104049, NULL, 21543719, 9388501, 3611, NULL, 'America/Los_Angeles', 'Loren Rubinowicz', 'default-male-avatar-profile.png', 'VolutpatEleifend.ppt', 1, NULL, '1', 1060141),
(43620146, 'Gertie', 'mU0$blZ%', 108, 'gflieg7@scribd.com', '1950-07-13', '119.238.223.11', 954485063, NULL, 3393418953, 1631671629, 22703, NULL, 'America/Los_Angeles', 'Gertie Flieg', 'default-male-avatar-profile.png', 'Amet.pdf', 0, NULL, '1', 1691192542),
(79146946, 'Dorice', 'pF9\raKK', 19, 'dpiddletowni@ning.com', '2003-05-14', '154.189.207.37', 462901473, NULL, 140859601, 1816958072, 47046, NULL, 'America/Los_Angeles', 'Dorice Piddletown', 'default-male-avatar-profile.png', 'MagnaVestibulum.mp3', 0, NULL, '1', 832698159),
(92878986, 'Tildy', 'xO7!cG}|', 80, 'tdinnegesd@nymag.com', '1967-01-06', '187.86.131.20', 21104026, NULL, 24821005, 31776338, 25064, NULL, 'America/Los_Angeles', 'Tildy Dinneges', 'default-male-avatar-profile.png', 'LeoPellentesqueUltrices.ppt', 0, NULL, '1', 4136331),
(109068565, 'Gaspar', 'zZ0\"R4JC.', 146, 'gmcewan17@ihg.com', '1974-05-21', '219.242.75.53', 19897081, NULL, 7931149, 26825370, 47274, NULL, 'America/Los_Angeles', 'Gaspar McEwan', 'default-male-avatar-profile.png', 'SuscipitLigulaIn.pdf', 0, NULL, '0', 2262875),
(131540833, 'Emylee', 'rC2?z=X&', 20, 'egommeso@upenn.edu', '2020-01-05', '30.13.170.178', 1281766271, NULL, 29140044, 3959313483, 16717, NULL, 'America/Los_Angeles', 'Emylee Gommes', 'default-male-avatar-profile.png', 'VulputateUtUltrices.ppt', 1, NULL, '0', 1856826730),
(184895035, 'Duffy', 'tW9{SlSW?tC={=5O', 200, 'dgalland1c@yale.edu', '1961-12-12', '236.144.76.83', 9861482, NULL, 28034550, 16008643, 56746, NULL, 'America/Los_Angeles', 'Duffy Galland', 'default-male-avatar-profile.png', 'LaciniaNisi.mov', 1, NULL, '1', 880382),
(255522993, 'Hatti', 'lP0)>4yKGm{xzL', 243, 'hscoggin8@ucsd.edu', '1976-01-25', '223.176.197.165', 1170509785, NULL, 1528843783, 3199327804, 39266, NULL, 'America/Los_Angeles', 'Hatti Scoggin', 'default-male-avatar-profile.png', 'In.tiff', 0, NULL, '1', 1084878743),
(336882879, 'Herta', 'yJ3<9C.M.<', 171, 'hshiptonp@vk.com', '1913-03-18', '200.127.118.35', 400822, NULL, 412763, 16613672, 52074, NULL, 'America/Los_Angeles', 'Herta Shipton', 'default-male-avatar-profile.png', 'EgetCongue.ppt', 0, NULL, '0', 3627736),
(338437862, 'Loria', 'lT3Pn8qq!U', 254, 'lmattheusk@w3.org', '1954-03-04', '67.138.160.48', 1171618424, NULL, 3267053838, 3932519327, 6068, NULL, 'America/Los_Angeles', 'Loria Mattheus', 'default-male-avatar-profile.png', 'DuisFaucibusAccumsan.xls', 1, NULL, '1', 550480901),
(372722329, 'Elvina', 'wY7+mx5z', 75, 'estudartx@flickr.com', '2001-06-12', '90.126.222.130', 1161024390, NULL, 2196406686, 2447817176, 39044, NULL, 'America/Los_Angeles', 'Elvina Studart', 'default-male-avatar-profile.png', 'NasceturRidiculusMus.mp3', 0, NULL, '1', 395811950),
(434134309, 'Billye', 'zZ0~5Iwj<s}', 35, 'bmitcham2@yellowbook.com', '1907-05-30', '5.56.122.207', 751912884, NULL, 1728405912, 1590566987, 22709, NULL, 'America/Los_Angeles', 'Billye Mitcham', 'default-male-avatar-profile.png', 'Nisl.avi', 1, NULL, '0', 387976996),
(443861550, 'Trumann', 'mD8_\"QTVs8$', 86, 'tmaiort@pinterest.com', '1996-09-11', '9.230.239.148', 20273743, NULL, 28091808, 30216271, 46858, NULL, 'America/Los_Angeles', 'Trumann Maior', 'default-male-avatar-profile.png', 'Enim.tiff', 0, NULL, '1', 272874),
(514469803, 'Yuma', 'qO4$Sm*v$D.e$|', 194, 'ygrogan1e@marketwatch.com', '1997-01-18', '171.123.11.202', 12081987, NULL, 30953157, 39104042, 29163, NULL, 'America/Los_Angeles', 'Yuma Grogan', 'default-male-avatar-profile.png', 'EnimLeoRhoncus.mov', 0, NULL, '0', 4165155),
(539818541, 'Bendix', 'wP0&MA*iv', 173, 'bcoffeer@wired.com', '1981-01-28', '142.128.129.28', 1076201893, NULL, 614166080, 3058405020, 11642, NULL, 'America/Los_Angeles', 'Bendix Coffee', 'default-male-avatar-profile.png', 'AmetSapien.mpeg', 0, NULL, '0', 233663120),
(576150003, 'Arvy', 'mS9+9,Ba~VWK%T', 152, 'astn@nydailynews.com', '1904-04-19', '98.228.208.160', 1668991299, NULL, 238977082, 2283916025, 14448, NULL, 'America/Los_Angeles', 'Arvy St. Louis', 'default-male-avatar-profile.png', 'Erat.tiff', 0, NULL, '1', 502474201),
(647360876, 'Harrietta', 'dB1*=F4IUr', 216, 'hcambling10@edublogs.org', '1981-11-20', '58.15.52.241', 352438322, NULL, 133772496, 998728407, 42567, NULL, 'America/Los_Angeles', 'Harrietta Cambling', 'default-male-avatar-profile.png', 'EuismodScelerisque.jpeg', 1, NULL, '0', 1871078799),
(721721344, 'Karney', 'sQ6~0P&DfH`', 113, 'kstrutley0@freewebs.com', '1972-08-13', '73.226.106.205', 466151426, NULL, 2420147192, 1927977596, 8829, NULL, 'America/Los_Angeles', 'Karney Strutley', 'default-male-avatar-profile.png', 'CongueEgetSemper.png', 1, NULL, '0', 2121212021),
(805547552, 'Geoffry', 'hH1}Kh<En5m,', 20, 'ggartside18@tinypic.com', '1901-05-05', '252.245.165.217', 217289810, NULL, 2485686254, 1262176641, 15083, NULL, 'America/Los_Angeles', 'Geoffry Gartside', 'default-male-avatar-profile.png', 'NequeDuisBibendum.txt', 0, NULL, '0', 667871588),
(836951797, 'Birgit', 'mL4+2(s>O', 231, 'bdumphy15@google.ru', '1936-06-16', '121.124.224.101', 871774002, NULL, 4247151691, 3190938975, 11775, NULL, 'America/Los_Angeles', 'Birgit Dumphy', 'default-male-avatar-profile.png', 'SemperInterdumMauris.xls', 0, NULL, '0', 1785194764),
(909565579, 'Susanetta', 'aG7<\"2,zJ\'a~', 56, 'sstrikex@last.fm', '1955-10-31', '211.55.52.192', 18828431, NULL, 28915636, 14929018, 25376, NULL, 'America/Los_Angeles', 'Susanetta Strike', 'default-male-avatar-profile.png', 'SitAmetSem.ppt', 1, NULL, '0', 2103171),
(933659373, 'Fernando', 'lX1\"cL0{', 47, 'femsonw@pen.io', '1958-03-01', '230.146.35.89', 3186435, NULL, 14293628, 4995497, 61967, NULL, 'America/Los_Angeles', 'Fernando Emson', 'default-male-avatar-profile.png', 'IdOrnare.ppt', 1, NULL, '0', 2852721),
(965763988, 'Torre', 'kX1\"61fOec#', 164, 'tkestevenf@1und1.de', '1955-06-14', '96.178.236.194', 1675550676, NULL, 2320171696, 1022943680, 13918, NULL, 'America/Los_Angeles', 'Torre Kesteven', 'default-male-avatar-profile.png', 'UltricesPosuere.avi', 1, NULL, '1', 1830882361),
(968006853, 'Harli', 'jU8#v7!dp2aXQz', 252, 'hblakeney13@buzzfeed.com', '2006-09-24', '62.2.195.192', 1165103448, NULL, 3136694487, 923113985, 2932, NULL, 'America/Los_Angeles', 'Harli Blakeney', 'default-male-avatar-profile.png', 'Nec.mp3', 0, NULL, '0', 127145861),
(977370467, 'Abel', 'tI8(Y#mK`F%', 60, 'ahubbert0@cnbc.com', '1988-10-02', '65.31.166.105', 19565076, NULL, 37310562, 40553558, 21220, NULL, 'America/Los_Angeles', 'Abel Hubbert', 'default-male-avatar-profile.png', 'EuMiNulla.mpeg', 1, NULL, '0', 2532691),
(980399796, 'Sibbie', 'rF4!>i0*)', 134, 'slavaller@ow.ly', '1908-09-15', '244.132.237.158', 6153351, NULL, 34353621, 34570692, 43792, NULL, 'America/Los_Angeles', 'Sibbie Lavalle', 'default-male-avatar-profile.png', 'In.mp3', 0, NULL, '1', 3072711),
(984442960, 'Issie', 'vN2/Z6MkT\"R', 248, 'iterrington19@umn.edu', '1926-05-05', '203.89.13.138', 11783957, NULL, 30518859, 19718417, 7701, NULL, 'America/Los_Angeles', 'Issie Terrington', 'default-male-avatar-profile.png', 'Lectus.avi', 0, NULL, '1', 4035101),
(995535579, 'Steffi', 'kW4+hg3oh=Kb\'L', 187, 'sdui@bbb.org', '1992-02-27', '230.180.187.142', 3482876, NULL, 22921430, 17702910, 35965, NULL, 'America/Los_Angeles', 'Steffi Du Barry', 'default-male-avatar-profile.png', 'Vestibulum.jpeg', 1, NULL, '1', 2192189),
(999688580, 'Jeniece', 'jP7}N7p?3C', 62, 'jlongden9@unc.edu', '1954-03-25', '130.207.197.128', 16148477, NULL, 25235899, 19995368, 21413, NULL, 'America/Los_Angeles', 'Jeniece Longden', 'default-male-avatar-profile.png', 'DonecSemperSapien.png', 0, NULL, '0', 3282082),
(1017970696, 'Gabie', 'mA2#NjfQsl', 166, 'gamiabley@java.com', '1919-08-16', '6.125.193.53', 11410317, NULL, 5346093, 10940777, 16496, NULL, 'America/Los_Angeles', 'Gabie Amiable', 'default-male-avatar-profile.png', 'Maecenas.mov', 0, NULL, '0', 2799322),
(1051930149, 'Janot', 'lB7?udd9#co8\")1', 47, 'jlindhen@cloudflare.com', '1949-10-05', '190.233.178.134', 747368892, NULL, 1893197958, 1339154970, 16786, NULL, 'America/Los_Angeles', 'Janot Lindhe', 'default-male-avatar-profile.png', 'MagnaVulputate.ppt', 0, NULL, '1', 1294103902),
(1054030073, 'Venus', 'bJ8)Su6p4N5hd', 216, 'vminersc@google.com.br', '2016-03-27', '20.201.120.116', 5074126, NULL, 8491996, 28133018, 18924, NULL, 'America/Los_Angeles', 'Venus Miners', 'default-male-avatar-profile.png', 'VariusNulla.avi', 0, NULL, '0', 1809315),
(1069442328, 'Nollie', 'bF7!ij=1D,`h', 14, 'nearsmann@slashdot.org', '1949-10-08', '156.189.71.91', 20697353, NULL, 3342512, 9714366, 31080, NULL, 'America/Los_Angeles', 'Nollie Earsman', 'default-male-avatar-profile.png', 'DuisBibendum.mp3', 1, NULL, '1', 3388652),
(1084235441, 'Constantin', 'bW3+naeIz},M{y0', 140, 'crangell1@wix.com', '2017-06-02', '189.47.209.46', 1723442924, NULL, 3254689753, 1956349671, 204, NULL, 'America/Los_Angeles', 'Constantin Rangell', 'default-male-avatar-profile.png', 'Libero.ppt', 1, NULL, '1', 1713054131),
(1084508279, 'Fleurette', 'cG5@>%5HxI9d', 117, 'fantuoni5@walmart.com', '1986-11-15', '8.244.133.213', 1048940169, NULL, 1437037232, 4134182844, 32341, NULL, 'America/Los_Angeles', 'Fleurette Antuoni', 'default-male-avatar-profile.png', 'Dapibus.png', 0, NULL, '0', 1364931303),
(1087462424, 'Thelma', 'wH9{.E%b~', 241, 'tdensief@microsoft.com', '1960-10-27', '81.186.127.124', 545709197, NULL, 3037068278, 4237043953, 63864, NULL, 'America/Los_Angeles', 'Thelma Densie', 'default-male-avatar-profile.png', 'TinciduntNulla.ppt', 0, NULL, '1', 1051556922),
(1097692780, 'Galen', 'qP3Th)O\"\"Yh|&2', 117, 'gdeknevets@wired.com', '1988-03-02', '165.181.200.133', 12072732, NULL, 14000141, 15737692, 29654, NULL, 'America/Los_Angeles', 'Galen deKnevet', 'default-male-avatar-profile.png', 'Lectus.ppt', 1, NULL, '1', 1595530),
(1119616607, 'Noby', 'vU8+Z*U6=&/V7', 119, 'nwawerb@wisc.edu', '1980-04-05', '56.209.164.152', 17845145, NULL, 11521278, 24417273, 46303, NULL, 'America/Los_Angeles', 'Noby Wawer', 'default-male-avatar-profile.png', 'Mauris.avi', 0, NULL, '0', 1999713),
(1134897781, 'Siward', 'tP0{LJ?bM', 86, 'sglaviasw@tinypic.com', '1995-04-29', '162.84.249.85', 2040525926, NULL, 2794543918, 2467630313, 61507, NULL, 'America/Los_Angeles', 'Siward Glavias', 'default-male-avatar-profile.png', 'VolutpatEleifendDonec.xls', 1, NULL, '1', 1217434738),
(1180852184, 'George', 'qI8{rn.whsZ?K9', 123, 'gservisa@github.com', '1911-07-08', '21.50.49.156', 1090051166, NULL, 842149, 1553420561, 25992, NULL, 'America/Los_Angeles', 'George Servis', 'default-male-avatar-profile.png', 'AugueVestibulumRutrum.xls', 1, NULL, '0', 757415514),
(1258512939, 'Denna', 'jR5,wf/+FG\"i>e', 197, 'dwoollends1e@yale.edu', '1924-04-07', '16.132.45.137', 1604820362, NULL, 4184202422, 992848675, 29843, NULL, 'America/Los_Angeles', 'Denna Woollends', 'default-male-avatar-profile.png', 'Elementum.xls', 0, NULL, '0', 623182186),
(1262143451, 'Joni', 'mX2(tQ9*W=2)m', 240, 'jphilipsona@123-reg.co.uk', '1986-11-15', '127.201.173.183', 5763726, NULL, 22874494, 11245054, 54920, NULL, 'America/Los_Angeles', 'Joni Philipson', 'default-male-avatar-profile.png', 'EgetTempus.avi', 0, NULL, '1', 3653221),
(1267906687, 'Kendra', 'fF9)qW{at\"q!r}L', 170, 'kgoldup16@yolasite.com', '1960-10-31', '12.216.43.122', 13071598, NULL, 3539646, 16162720, 5055, NULL, 'America/Los_Angeles', 'Kendra Goldup', 'default-male-avatar-profile.png', 'Ante.doc', 0, NULL, '0', 3273869),
(1391672620, 'Auberta', 'pS9)=Q4M/D', 200, 'arubinovitsch18@dion.ne.jp', '1931-12-10', '208.235.95.217', 10072350, NULL, 36219753, 894021, 27578, NULL, 'America/Los_Angeles', 'Auberta Rubinovitsch', 'default-male-avatar-profile.png', 'ErosSuspendisseAccumsan.avi', 1, NULL, '0', 1707774),
(1392062742, 'Aviva', 'lG8(Hi?QLct1', 0, 'ahasell5@yelp.com', '2010-05-21', '158.139.39.201', 18958880, NULL, 14213283, 4619771, 43347, NULL, 'America/Los_Angeles', 'Aviva Hasell', 'default-male-avatar-profile.png', 'CrasMi.gif', 0, NULL, '0', 2042638),
(1440743677, 'Trixi', 'hX3(9}2vu)8$MoH', 242, 'tfearnallz@seesaa.net', '1907-05-28', '132.247.27.229', 11996414, NULL, 24823266, 23581275, 3541, NULL, 'America/Los_Angeles', 'Trixi Fearnall', 'default-male-avatar-profile.png', 'A.ppt', 1, NULL, '0', 4181779),
(1457320535, 'Wittie', 'oF8*~nS=(_%', 94, 'wmatson9@mail.ru', '1962-05-04', '235.75.34.31', 1605052347, NULL, 2414991092, 2097580215, 56583, NULL, 'America/Los_Angeles', 'Wittie Matson', 'default-male-avatar-profile.png', 'NullaSuspendissePotenti.avi', 1, NULL, '1', 577244746),
(1516608920, 'Anita', 'jB0`GJjykHd5O`', 41, 'acrutchleyu@google.co.uk', '1906-07-23', '92.91.30.7', 4024365, NULL, 19450946, 36169063, 1699, NULL, 'America/Los_Angeles', 'Anita Crutchley', 'default-male-avatar-profile.png', 'UtErat.gif', 1, NULL, '0', 1024743),
(1533623026, 'Talyah', 'rF1?gu<BD2VN', 253, 'tsalest@sourceforge.net', '1923-05-20', '133.220.30.222', 1204949977, NULL, 3091878092, 2097300382, 48670, NULL, 'America/Los_Angeles', 'Talyah Sales', 'default-male-avatar-profile.png', 'InterdumMaurisNon.mov', 1, NULL, '0', 17035190),
(1540696944, 'Jasmine', 'sF5>c4KX', 178, 'jbogue1f@bizjournals.com', '2012-11-25', '100.229.159.69', 310907833, NULL, 1071487729, 1577497911, 53970, NULL, 'America/Los_Angeles', 'Jasmine Bogue', 'default-male-avatar-profile.png', 'VestibulumProin.xls', 0, NULL, '1', 1008949744),
(1578023641, 'Ollie', 'bO6\"yxmfr\"', 76, 'oguerreu@ocn.ne.jp', '1962-02-26', '239.16.116.224', 1645639243, NULL, 2322521398, 968230605, 39322, NULL, 'America/Los_Angeles', 'Ollie Guerre', 'default-male-avatar-profile.png', 'NibhQuisqueId.avi', 1, NULL, '0', 583482215),
(1608200306, 'Corrie', 'qM8%Kcd8X', 71, 'cprince3@github.io', '1995-11-08', '73.28.145.58', 13768160, NULL, 39675095, 1662571, 7715, NULL, 'America/Los_Angeles', 'Corrie Prince', 'default-male-avatar-profile.png', 'NamUltrices.ppt', 0, NULL, '1', 1467257),
(1624335317, 'Karlie', 'kW0>`9kw~9', 93, 'kbrowning8@issuu.com', '1971-11-10', '10.15.97.203', 7601643, NULL, 19333797, 24001631, 49080, NULL, 'America/Los_Angeles', 'Karlie Browning', 'default-male-avatar-profile.png', 'VolutpatSapien.xls', 1, NULL, '0', 361612),
(1655969910, 'Electra', 'uM8?NWEA2YD?`Yg/', 32, 'ericartb@netscape.com', '1980-07-25', '114.230.224.203', 2092859293, NULL, 2646446102, 2133760992, 54194, NULL, 'America/Los_Angeles', 'Electra Ricart', 'default-male-avatar-profile.png', 'NonLigula.ppt', 0, NULL, '0', 579781287),
(1686833539, 'Gwenni', 'fZ1&J.5D}&jn', 66, 'gpeddowe10@digg.com', '1904-10-19', '172.191.17.237', 1535622416, NULL, 532119296, 1730741000, 52192, NULL, 'America/Los_Angeles', 'Gwenni Peddowe', 'default-male-avatar-profile.png', 'Molestie.tiff', 0, NULL, '1', 404303535),
(1732332393, 'Wald', 'kD1\'=v/kKOFM0.', 243, 'wreaman2@cbsnews.com', '1953-05-22', '203.121.63.239', 1289114431, NULL, 771213886, 398681871, 2855, NULL, 'America/Los_Angeles', 'Wald Reaman', 'default-male-avatar-profile.png', 'VelitIdPretium.ppt', 0, NULL, '0', 864507506),
(1747511290, 'Imogen', 'vI2{N9W,', 115, 'iquinton1d@slashdot.org', '2006-12-11', '170.110.202.230', 3746878, NULL, 40651733, 4243527, 56949, NULL, 'America/Los_Angeles', 'Imogen Quinton', 'default-male-avatar-profile.png', 'Ligula.pdf', 1, NULL, '0', 3330765),
(1780449625, 'Bunnie', 'uV4<Eh4/B{.%%\"b', 131, 'bhellisv@wikipedia.org', '1913-09-09', '120.146.188.28', 18088881, NULL, 24341411, 32586138, 10310, NULL, 'America/Los_Angeles', 'Bunnie Hellis', 'default-male-avatar-profile.png', 'NuncViverra.gif', 0, NULL, '1', 2272940),
(1801532874, 'Sapphira', 'dA6=gwSKruDJ>', 75, 'spybus1a@desdev.cn', '1903-12-23', '133.162.150.7', 7241011, NULL, 41590509, 13342920, 32890, NULL, 'America/Los_Angeles', 'Sapphira Pybus', 'default-male-avatar-profile.png', 'Sapien.xls', 0, NULL, '0', 675922),
(1811921091, 'Tori', 'kQ2+r3cL0x}e', 227, 'tfones1i@usnews.com', '2016-05-25', '234.112.22.211', 1570744983, NULL, 4233615903, 947338288, 10478, NULL, 'America/Los_Angeles', 'Tori Fones', 'default-male-avatar-profile.png', 'Nulla.xls', 1, NULL, '1', 1749828491),
(1823058538, 'Bowie', 'yU9<SxvLuo#{p+B', 84, 'bwaghorne1b@va.gov', '1911-07-01', '161.109.31.43', 873014967, NULL, 1952437760, 2264042357, 30620, NULL, 'America/Los_Angeles', 'Bowie Waghorne', 'default-male-avatar-profile.png', 'EstPhasellus.ppt', 1, NULL, '1', 1071819989),
(1837235353, 'Yard', 'zR3}R2DOE(S7OA', 59, 'ybarffm@mail.ru', '1960-07-15', '180.138.110.207', 20121664, NULL, 30476166, 20141796, 15196, NULL, 'America/Los_Angeles', 'Yard Barff', 'default-male-avatar-profile.png', 'Viverra.mp3', 0, NULL, '1', 3210058),
(1854076521, 'Bucky', 'vA9!,e+4)ZB`_~\"', 207, 'bironsh@deviantart.com', '1912-01-29', '201.43.125.193', 1566378452, NULL, 957067317, 1800690786, 16883, NULL, 'America/Los_Angeles', 'Bucky Irons', 'default-male-avatar-profile.png', 'QuisTurpis.avi', 1, NULL, '1', 1560174883),
(1923510939, 'Donal', 'wJ3.xi{x~@', 150, 'dstobbartu@addtoany.com', '1990-08-01', '25.108.217.181', 1607100292, NULL, 3093801696, 3704399873, 7336, NULL, 'America/Los_Angeles', 'Donal Stobbart', 'default-male-avatar-profile.png', 'NullaQuisqueArcu.ppt', 1, NULL, '1', 1101671427),
(1947784980, 'Hilda', 'qP34s=m', 155, 'hwallworke@cnet.com', '1984-07-14', '39.134.15.150', 1745544375, NULL, 518926723, 2437904833, 25357, NULL, 'America/Los_Angeles', 'Hilda Wallwork', 'default-male-avatar-profile.png', 'Hac.doc', 0, NULL, '1', 639885445),
(2025774690, 'Patti', 'rQ6\"<zWAqCzXmDpU', 197, 'pscholer1a@salon.com', '1967-05-17', '8.27.222.114', 387643787, NULL, 1800146429, 2718844754, 3705, NULL, 'America/Los_Angeles', 'Patti Scholer', 'default-male-avatar-profile.png', 'Ultrices.mp3', 1, NULL, '0', 223595529),
(2071044739, 'Hewie', 'aF6<86qv`%8}H8r', 202, 'hblanch11@imdb.com', '1958-02-03', '63.17.11.90', 8343711, NULL, 28595384, 20809480, 53740, NULL, 'America/Los_Angeles', 'Hewie Blanch', 'default-male-avatar-profile.png', 'InMagnaBibendum.avi', 1, NULL, '1', 1794106),
(2104715049, 'Sari', 'xL4\"oy!$\0noBX', 255, 'spateselq@ft.com', '1928-08-11', '85.19.41.91', 16939409, NULL, 28581986, 20781157, 45941, NULL, 'America/Los_Angeles', 'Sari Patesel', 'default-male-avatar-profile.png', 'TellusSemper.jpeg', 0, NULL, '1', 2617085),
(2116257950, 'Terrye', 'uK8|J0@Nru~?', 198, 'tpetheridge1c@bloglovin.com', '1931-04-14', '0.205.213.145', 1868084338, NULL, 607854802, 1188096875, 42383, NULL, 'America/Los_Angeles', 'Terrye Petheridge', 'default-male-avatar-profile.png', 'CondimentumCurabiturIn.png', 1, NULL, '1', 1951385347),
(2131664157, 'Georgianne', 'wL5,_Y&K7vc', 226, 'gsapauton1d@canalblog.com', '1998-02-06', '85.122.110.101', 1796458701, NULL, 1695098480, 1295557359, 17118, NULL, 'America/Los_Angeles', 'Georgianne Sapauton', 'default-male-avatar-profile.png', 'Arcu.mp3', 0, NULL, '0', 1860665499),
(2131664161, 'Gilmer Franko', '$2y$10$oHHnX0YDGvFDRxNu651w/eXvTAJzjmbk6NxOaFZ5f8gCFfZz2pgZW', 3, 'gil20017.com@gmail.com', '2024-09-21', '::1', 0, NULL, 1728584336, 1728428264, 0, '160f43efcfa1b10b62247e471d64', 'America/Los_Angeles', 'Gilmer Franko', 'default-male-avatar-profile.png', 'default-male-avatar-profile.png', 2, NULL, '0', 1726871880);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members_blocks`
--

CREATE TABLE `members_blocks` (
  `block_id` int(11) NOT NULL,
  `block_from` int(11) NOT NULL,
  `block_to` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members_favorites`
--

CREATE TABLE `members_favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `created_at` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `members_favorites`
--

INSERT INTO `members_favorites` (`id`, `member_id`, `thread_id`, `created_at`) VALUES
(1, 2131664161, 6, '1728532864');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members_groups`
--

CREATE TABLE `members_groups` (
  `g_id` int(3) UNSIGNED NOT NULL,
  `g_title` varchar(32) NOT NULL DEFAULT '',
  `g_colour` varchar(20) NOT NULL,
  `g_permissions` mediumtext DEFAULT NULL,
  `g_max_messages` int(5) UNSIGNED DEFAULT 50,
  `g_max_shout_images` tinyint(2) UNSIGNED NOT NULL,
  `g_count_permissions` varchar(15) NOT NULL,
  `g_count_members` mediumint(8) UNSIGNED NOT NULL,
  `g_updated` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members_messages`
--

CREATE TABLE `members_messages` (
  `id` int(11) UNSIGNED NOT NULL,
  `from_member_id` int(11) UNSIGNED NOT NULL,
  `to_member_id` int(11) UNSIGNED NOT NULL,
  `content` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `sent_at` varchar(12) NOT NULL,
  `is_read` tinyint(1) DEFAULT 0 COMMENT '0: No leído, 1: Leído'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `members_messages`
--

INSERT INTO `members_messages` (`id`, `from_member_id`, `to_member_id`, `content`, `image_url`, `sent_at`, `is_read`) VALUES
(1, 2131664161, 5, 'Hola', '', '1728582823', 0),
(2, 2131664161, 5, 'd', '', '1728583058', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members_notes`
--

CREATE TABLE `members_notes` (
  `id` int(11) NOT NULL,
  `member` int(11) NOT NULL COMMENT 'ID del miembro',
  `title` varchar(64) NOT NULL COMMENT 'Titulo',
  `subject` int(64) DEFAULT NULL COMMENT 'Asunto (opcional)',
  `content` text NOT NULL COMMENT 'Contenido',
  `category` varchar(24) NOT NULL COMMENT 'Categoria',
  `time` varchar(16) NOT NULL COMMENT 'Fecha de Guardado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members_notifications`
--

CREATE TABLE `members_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'ID de notificación',
  `to_member` mediumint(8) UNSIGNED NOT NULL COMMENT 'Usuario que recibe la notificación',
  `from_member` mediumint(8) UNSIGNED NOT NULL COMMENT 'Usuario que envía la notificación',
  `not_key` varchar(32) NOT NULL COMMENT 'Tipo de notificación',
  `item_id` varchar(8) DEFAULT '0',
  `subitem_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `content` text NOT NULL,
  `sent_time` int(11) UNSIGNED NOT NULL,
  `read_time` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Notificaciones de usuario';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members_transactions`
--

CREATE TABLE `members_transactions` (
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `amount` decimal(20,2) NOT NULL,
  `transaction_type` varchar(1) NOT NULL COMMENT '+ Si es un ingreso, - si es un egreso',
  `reason` text DEFAULT NULL,
  `timestamp` varchar(12) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `members_transactions`
--

INSERT INTO `members_transactions` (`transaction_id`, `member_id`, `amount`, `transaction_type`, `reason`, `timestamp`) VALUES
(1, 2131664161, '0.20', '-', 'autoRenewal', '1728531014'),
(2, 2131664161, '0.20', '-', 'autoRenewal', '1728531036'),
(3, 2131664161, '0.20', '-', 'autoRenewal', '1728531115'),
(4, 2131664161, '0.20', '-', 'autoRenewal', '1728532862');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `member_balance`
--

CREATE TABLE `member_balance` (
  `member_id` int(11) NOT NULL,
  `balance` decimal(20,2) NOT NULL DEFAULT 0.00,
  `last_updated` varchar(12) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `member_balance`
--

INSERT INTO `member_balance` (`member_id`, `balance`, `last_updated`) VALUES
(1, '100.00', '1712838060'),
(2, '46.40', '1726866766'),
(3, '100.00', '1712848523'),
(4, '100.00', '1712848848'),
(5, '82.80', '1712848899'),
(6, '100.00', '1716007859'),
(8, '100.00', '1716929084'),
(9, '100.00', '1716929181'),
(10, '100.00', '1717710684'),
(11, '0.00', '1720562069'),
(2131664158, '0.00', '1726871358'),
(2131664159, '0.00', '1726871400'),
(2131664160, '0.00', '1726871798'),
(2131664161, '99.20', '1726871880');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `site_configuration`
--

CREATE TABLE `site_configuration` (
  `id` int(11) NOT NULL,
  `script_name` text NOT NULL,
  `script_abbreviation` varchar(4) DEFAULT NULL COMMENT 'Abreviación del nombre del script',
  `ad_300x250` text NOT NULL,
  `num_phone` varchar(15) NOT NULL,
  `cookie_name` text NOT NULL,
  `cookie_time` smallint(5) NOT NULL,
  `enable_email_on_message` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 para habilitar, 0 para deshabilitar el envío de correos cuando se recibe un mensaje',
  `commission_per_bet` decimal(20,2) NOT NULL DEFAULT 0.50 COMMENT 'Comision cobrada a cada usuario por \r\napuesta',
  `limit_globals_messages` int(11) NOT NULL DEFAULT 100 COMMENT 'Limite de mensajes que se mostraran en un canal',
  `reg_group` int(11) NOT NULL DEFAULT 3,
  `reg_validate` enum('0','1') NOT NULL DEFAULT '1',
  `maintenance` enum('0','1') NOT NULL,
  `debug_mode` enum('0','1') NOT NULL,
  `save_user` mediumint(8) NOT NULL,
  `save_ip` text NOT NULL,
  `save_date` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `site_configuration`
--

INSERT INTO `site_configuration` (`id`, `script_name`, `script_abbreviation`, `ad_300x250`, `num_phone`, `cookie_name`, `cookie_time`, `enable_email_on_message`, `commission_per_bet`, `limit_globals_messages`, `reg_group`, `reg_validate`, `maintenance`, `debug_mode`, `save_user`, `save_ip`, `save_date`) VALUES
(295, 'Sexo y contacto', 'SYC', '', '+', 'syc', 360, 1, '0.50', 100, 3, '1', '0', '1', 2, '::1', 1725456784),
(294, 'Sexo y contacto', NULL, '', '+', 'syc', 360, 1, '0.50', 100, 3, '0', '0', '1', 2, '::1', 1723908615),
(293, 'Sexo y contacto', NULL, '', '+', 'session', 360, 1, '0.50', 100, 3, '0', '0', '1', 2, '::1', 1723908607),
(292, 'Sexo y contacto', NULL, '', '+', 'session', 360, 1, '0.50', 100, 3, '0', '0', '0', 2, '::1', 1723908604),
(291, 'Sexo y contacto', NULL, '', '+', 'session', 360, 1, '0.05', 20, 3, '0', '0', '1', 2, '::1', 1720562030),
(296, 'Sexo y contacto', 'SYC', '', '+', 'syc', 360, 1, '0.50', 100, 3, '0', '0', '1', 2, '::1', 1727386980),
(297, 'Sexo y contacto', 'SYC', '', '+', 'syc', 360, 1, '0.50', 100, 3, '0', '0', '1', 2, '::1', 1727387337),
(298, 'Sexo y contacto', 'SYC', '', '+', 'syc', 360, 1, '0.50', 100, 3, '1', '0', '1', 2, '::1', 1727387340),
(299, 'Sexo y contacto', 'SYC', '', '+', 'sycsd', 360, 1, '0.50', 100, 3, '1', '0', '1', 2, '::1', 1727387348),
(300, 'Sexo y contacto', 'SYC', '', '+', 'sycs', 360, 1, '0.50', 100, 3, '1', '0', '1', 2, '::1', 1727387446),
(301, 'Sexo y contacto', 'SYC', '', '+', 'sycs', 360, 1, '0.50', 100, 3, '1', '0', '1', 2, '::1', 1727387531),
(302, 'Sexo y contacto', 'SYC', '', '+', 'sycs', 360, 1, '0.50', 100, 3, '1', '0', '1', 2, '::1', 1727387532),
(303, 'Sexo y contacto', 'SYC', '', '+', 'sycsw', 360, 1, '0.50', 100, 3, '1', '0', '1', 2, '::1', 1727387535),
(304, 'Sexo y contacto', 'SYC', '', '+', 'sycsw', 360, 1, '0.50', 100, 3, '1', '0', '1', 2, '::1', 1727387635),
(305, 'Sexo y contacto', 'SYC', '', '+', 'sycsw', 3600, 1, '0.50', 100, 3, '1', '0', '1', 2, '::1', 1727387639),
(306, 'Sexo y contacto', 'SYC', '', '+', 'sycs', 3600, 1, '0.50', 100, 3, '1', '0', '1', 2, '::1', 1727387644),
(307, 'Sexo y contacto', 'SYC', '', '+', 'syc', 3600, 1, '0.50', 100, 3, '1', '0', '1', 2, '::1', 1727387647),
(308, 'Sexo y contacto', 'SYC', '', '+', 'sycd', 3600, 1, '0.50', 100, 3, '1', '0', '1', 2, '::1', 1727387650),
(309, 'Sexo y contacto', 'SYC', '', '+', 'syc', 3600, 1, '0.50', 100, 3, '1', '0', '1', 2, '::1', 1727387702);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `site_contacts`
--

CREATE TABLE `site_contacts` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `member_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(16) NOT NULL,
  `email` varchar(55) NOT NULL,
  `title` varchar(55) NOT NULL,
  `content` text NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `ip` varchar(46) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `site_contacts`
--

INSERT INTO `site_contacts` (`id`, `member_id`, `name`, `email`, `title`, `content`, `date`, `ip`) VALUES
(1, 0, 'Prueba1', 'gil2017.com@gmail.com', 'Prueba2', 'Prueba3', 1712846505, '38.51.239.161'),
(2, 2131664161, 'Gilmer Franko', 'gil2017.com@gmail.com', 'Hola', 'qsqs', 1727384520, '::1'),
(3, 2131664161, 'Gilmer Franko', 'gil2017.com@gmail.com', 'Hola', 'qsqswqwd', 1727384547, '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `site_deposits`
--

CREATE TABLE `site_deposits` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `binance_email` varchar(255) DEFAULT NULL,
  `binance_id` varchar(64) DEFAULT NULL,
  `binance_fullname` varchar(64) NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` varchar(12) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `site_homepage_games`
--

CREATE TABLE `site_homepage_games` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `site_recovers`
--

CREATE TABLE `site_recovers` (
  `id` varchar(60) NOT NULL,
  `member_id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL DEFAULT '',
  `date` int(11) NOT NULL DEFAULT 0,
  `type` int(1) NOT NULL DEFAULT 0 COMMENT '2 validación, 1 contraseña',
  `ip_address` varchar(46) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `site_withdrawals`
--

CREATE TABLE `site_withdrawals` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `binance_id` varchar(64) NOT NULL,
  `binance_email` varchar(255) DEFAULT NULL,
  `binance_fullname` varchar(128) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` varchar(12) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indices de la tabla `auto_renueva_settings`
--
ALTER TABLE `auto_renueva_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thread_id` (`thread_id`);

--
-- Indices de la tabla `f_contacts`
--
ALTER TABLE `f_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `f_locations`
--
ALTER TABLE `f_locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact_id` (`contact_id`,`name`),
  ADD UNIQUE KEY `short_url` (`short_url`);

--
-- Indices de la tabla `f_locations_visits`
--
ALTER TABLE `f_locations_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indices de la tabla `f_threads`
--
ALTER TABLE `f_threads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD UNIQUE KEY `slug_2` (`slug`),
  ADD KEY `location_id` (`location_id`);

--
-- Indices de la tabla `f_threads_images`
--
ALTER TABLE `f_threads_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thread_id` (`thread_id`);

--
-- Indices de la tabla `f_threads_reports`
--
ALTER TABLE `f_threads_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `reported_by_member_id` (`reported_by_member_id`),
  ADD KEY `resolved_by_member_id` (`resolved_by_member_id`);

--
-- Indices de la tabla `f_threads_visits`
--
ALTER TABLE `f_threads_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indices de la tabla `globals_messages`
--
ALTER TABLE `globals_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `globals_messages_channels`
--
ALTER TABLE `globals_messages_channels`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `name` (`name`),
  ADD KEY `mgroup` (`group_id`,`member_id`),
  ADD KEY `member_banned` (`banned`),
  ADD KEY `ip_address` (`ip_address`),
  ADD KEY `session` (`session`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `email` (`email`);

--
-- Indices de la tabla `members_blocks`
--
ALTER TABLE `members_blocks`
  ADD PRIMARY KEY (`block_id`),
  ADD UNIQUE KEY `unique_block` (`block_from`,`block_to`);

--
-- Indices de la tabla `members_favorites`
--
ALTER TABLE `members_favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `thread_id` (`thread_id`);

--
-- Indices de la tabla `members_groups`
--
ALTER TABLE `members_groups`
  ADD PRIMARY KEY (`g_id`),
  ADD KEY `g_id` (`g_id`);

--
-- Indices de la tabla `members_messages`
--
ALTER TABLE `members_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_member_id` (`from_member_id`),
  ADD KEY `to_member_id` (`to_member_id`);

--
-- Indices de la tabla `members_notes`
--
ALTER TABLE `members_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `members_notifications`
--
ALTER TABLE `members_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `not_key` (`not_key`),
  ADD KEY `from_member` (`from_member`),
  ADD KEY `to_member` (`to_member`),
  ADD KEY `sent_time` (`sent_time`,`read_time`);

--
-- Indices de la tabla `members_transactions`
--
ALTER TABLE `members_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indices de la tabla `member_balance`
--
ALTER TABLE `member_balance`
  ADD PRIMARY KEY (`member_id`);

--
-- Indices de la tabla `site_configuration`
--
ALTER TABLE `site_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `site_contacts`
--
ALTER TABLE `site_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `site_deposits`
--
ALTER TABLE `site_deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `site_homepage_games`
--
ALTER TABLE `site_homepage_games`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `site_recovers`
--
ALTER TABLE `site_recovers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `email` (`email`),
  ADD KEY `type` (`type`);

--
-- Indices de la tabla `site_withdrawals`
--
ALTER TABLE `site_withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `log_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `auto_renueva_settings`
--
ALTER TABLE `auto_renueva_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `f_contacts`
--
ALTER TABLE `f_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `f_locations`
--
ALTER TABLE `f_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=577;

--
-- AUTO_INCREMENT de la tabla `f_locations_visits`
--
ALTER TABLE `f_locations_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `f_threads`
--
ALTER TABLE `f_threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `f_threads_images`
--
ALTER TABLE `f_threads_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `f_threads_reports`
--
ALTER TABLE `f_threads_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `f_threads_visits`
--
ALTER TABLE `f_threads_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `globals_messages`
--
ALTER TABLE `globals_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `globals_messages_channels`
--
ALTER TABLE `globals_messages_channels`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2131664162;

--
-- AUTO_INCREMENT de la tabla `members_blocks`
--
ALTER TABLE `members_blocks`
  MODIFY `block_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `members_favorites`
--
ALTER TABLE `members_favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `members_groups`
--
ALTER TABLE `members_groups`
  MODIFY `g_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `members_messages`
--
ALTER TABLE `members_messages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `members_notes`
--
ALTER TABLE `members_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `members_notifications`
--
ALTER TABLE `members_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID de notificación';

--
-- AUTO_INCREMENT de la tabla `members_transactions`
--
ALTER TABLE `members_transactions`
  MODIFY `transaction_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `site_configuration`
--
ALTER TABLE `site_configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT de la tabla `site_contacts`
--
ALTER TABLE `site_contacts`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `site_deposits`
--
ALTER TABLE `site_deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `site_homepage_games`
--
ALTER TABLE `site_homepage_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `site_withdrawals`
--
ALTER TABLE `site_withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auto_renueva_settings`
--
ALTER TABLE `auto_renueva_settings`
  ADD CONSTRAINT `auto_renueva_settings_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `f_threads` (`id`);

--
-- Filtros para la tabla `f_locations`
--
ALTER TABLE `f_locations`
  ADD CONSTRAINT `f_locations_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `f_contacts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `f_locations_visits`
--
ALTER TABLE `f_locations_visits`
  ADD CONSTRAINT `f_locations_visits_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `f_locations` (`id`),
  ADD CONSTRAINT `f_locations_visits_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`);

--
-- Filtros para la tabla `f_threads`
--
ALTER TABLE `f_threads`
  ADD CONSTRAINT `f_threads_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `f_locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `f_threads_images`
--
ALTER TABLE `f_threads_images`
  ADD CONSTRAINT `f_threads_images_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `f_threads` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `f_threads_reports`
--
ALTER TABLE `f_threads_reports`
  ADD CONSTRAINT `f_threads_reports_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `f_threads` (`id`),
  ADD CONSTRAINT `f_threads_reports_ibfk_2` FOREIGN KEY (`reported_by_member_id`) REFERENCES `members` (`member_id`),
  ADD CONSTRAINT `f_threads_reports_ibfk_3` FOREIGN KEY (`resolved_by_member_id`) REFERENCES `members` (`member_id`);

--
-- Filtros para la tabla `f_threads_visits`
--
ALTER TABLE `f_threads_visits`
  ADD CONSTRAINT `f_threads_visits_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `f_threads` (`id`),
  ADD CONSTRAINT `f_threads_visits_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`);

--
-- Filtros para la tabla `members_favorites`
--
ALTER TABLE `members_favorites`
  ADD CONSTRAINT `fk_favorite_thread` FOREIGN KEY (`thread_id`) REFERENCES `f_threads` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
