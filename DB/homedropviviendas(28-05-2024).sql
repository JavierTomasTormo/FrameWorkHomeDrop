-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2024 a las 19:30:27
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `homedropviviendas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoryhomedrop`
--

CREATE TABLE `categoryhomedrop` (
  `ID_Category` int(11) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoryhomedrop`
--

INSERT INTO `categoryhomedrop` (`ID_Category`, `Category`, `Img`) VALUES
(2, 'Garaje', '/FrameWorkHomeDrop/view/IMG/Homes/CategoryCarousel/CategoryGaraje.jpg'),
(3, 'Trastero', '/FrameWorkHomeDrop/view/IMG/Homes/CategoryCarousel/CategoryTrastero.jpg'),
(4, 'Calefacción', '/FrameWorkHomeDrop/view/IMG/Homes/CategoryCarousel/CategoryCalefaccion.jpeg'),
(5, 'Aire Acondicionado', '/FrameWorkHomeDrop/view/IMG/Homes/CategoryCarousel/CategoryAire_Acondicionado.jpg'),
(6, 'Ascensor', '/FrameWorkHomeDrop/view/IMG/Homes/CategoryCarousel/CategoryAscensor.jpg'),
(7, 'Terraza', '/FrameWorkHomeDrop/view/IMG/Homes/CategoryCarousel/CategoryTerraza.jpg'),
(8, 'Piscina', '/FrameWorkHomeDrop/view/IMG/Homes/CategoryCarousel/CategoryPiscina.jpg'),
(9, 'Amueblado', '/FrameWorkHomeDrop/view/IMG/Homes/CategoryCarousel/CategoryAmueblado.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cityhomedrop`
--

CREATE TABLE `cityhomedrop` (
  `ID_City` int(11) NOT NULL,
  `Ciudad` varchar(100) NOT NULL,
  `Img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cityhomedrop`
--

INSERT INTO `cityhomedrop` (`ID_City`, `Ciudad`, `Img`) VALUES
(2, 'Madrid', '/FrameWorkHomeDrop/view/IMG/Homes/CityCarousel/CityMadrid.jpg'),
(3, 'Valencia', '/FrameWorkHomeDrop/view/IMG/Homes/CityCarousel/CityValencia.jpg'),
(7, 'Barcelona', '/FrameWorkHomeDrop/view/IMG/Homes/CityCarousel/CityBarcelona.jpg'),
(9, 'Alicante', '/FrameWorkHomeDrop/view\\IMG\\Homes\\CityCarousel\\CityAlicante.jpg'),
(10, 'San Juan de Alicante', '/FrameWorkHomeDrop/view\\IMG\\Homes\\CityCarousel\\CitySanJuandeAlicante.jpg'),
(11, 'Coimbra', '/FrameWorkHomeDrop/view/IMG/Homes/CityCarousel/CityCoimbra.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exceptionlogs`
--

CREATE TABLE `exceptionlogs` (
  `ID_Exception` int(11) NOT NULL,
  `ID_HomeDrop` int(11) NOT NULL,
  `ErrorType` int(10) NOT NULL,
  `Spots` varchar(100) NOT NULL,
  `Exception_Date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `exceptionlogs`
--

INSERT INTO `exceptionlogs` (`ID_Exception`, `ID_HomeDrop`, `ErrorType`, `Spots`, `Exception_Date`) VALUES
(3, 3, 503, 'Carrusel_Brands HOME', '2022-03-18 23:54:39'),
(5, 5, 503, 'Carrusel_Brands HOME', '2022-03-18 23:54:41'),
(6, 6, 503, 'Carrusel_Brands HOME', '2022-03-18 23:57:46'),
(7, 7, 503, 'Function load_like_user SHOP', '2022-04-01 11:37:16'),
(8, 8, 503, 'Function load_like_user SHOP', '2022-04-01 11:37:16'),
(9, 9, 503, 'Function load_like_user SHOP', '2022-04-01 11:37:16'),
(10, 10, 503, 'Function load_like_user SHOP', '2022-04-01 11:37:16'),
(11, 7, 503, 'Function load_like_user SHOP', '2022-04-01 11:37:31'),
(12, 22, 503, 'Carrusel_Brands HOME', '2024-03-26 00:00:00'),
(13, 23, 503, 'Carrusel_Brands HOME', '2024-03-26 00:00:00'),
(14, 24, 503, 'Carrusel_Brands HOME', '2024-03-26 00:00:00'),
(15, 25, 503, 'Carrusel_Brands HOME', '2024-03-26 00:00:00'),
(16, 26, 503, 'Carrusel_Brands HOME', '2024-03-26 00:00:00'),
(17, 27, 503, 'Carrusel_Brands HOME', '2024-03-26 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imageneshomedrop`
--

CREATE TABLE `imageneshomedrop` (
  `ID_Imagen` int(11) NOT NULL,
  `ID_HomeDrop` int(11) NOT NULL,
  `Img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imageneshomedrop`
--

INSERT INTO `imageneshomedrop` (`ID_Imagen`, `ID_HomeDrop`, `Img`) VALUES
(1, 2, '/FrameWorkHomeDrop/view\\IMG\\Homes\\Shop\\1.jpg'),
(2, 2, '/FrameWorkHomeDrop/views/img/viviendas/vivienda2.2.jpg'),
(3, 3, '/FrameWorkHomeDrop/view\\IMG\\Homes\\Shop\\2.jpg'),
(4, 3, '/FrameWorkHomeDrop/view\\IMG\\Homes\\Shop\\2.2.jpg'),
(5, 4, '/FrameWorkHomeDrop/view\\IMG\\Homes\\Shop\\3.jpg'),
(6, 4, '/FrameWorkHomeDrop/views/img/viviendas/vivienda4.2.jpg'),
(7, 5, '/FrameWorkHomeDrop/view\\IMG\\Homes\\Shop\\4.jpg'),
(8, 5, '/FrameWorkHomeDrop/views/img/viviendas/vivienda5.2.jpg'),
(9, 6, '/FrameWorkHomeDrop/view\\IMG\\Homes\\Shop\\5.jpg'),
(10, 6, '/FrameWorkHomeDrop/views/img/viviendas/vivienda6.2.jpg'),
(11, 7, '/FrameWorkHomeDrop/view\\IMG\\Homes\\Shop\\6.jpg'),
(12, 7, '/FrameWorkHomeDrop/views/img/viviendas/vivienda7.2.jpg'),
(13, 8, '/FrameWorkHomeDrop/view\\IMG\\Homes\\Shop\\7.jpg'),
(14, 8, '/FrameWorkHomeDrop/views/img/viviendas/vivienda8.2.jpg'),
(15, 9, '/FrameWorkHomeDrop/view\\IMG\\Homes\\Shop\\8.jpg'),
(16, 9, '/FrameWorkHomeDrop/views/img/viviendas/vivienda9.2.jpg'),
(17, 10, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(18, 10, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(19, 11, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(20, 12, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(21, 12, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(22, 13, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(23, 13, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(24, 14, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(25, 14, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(26, 15, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(27, 15, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(28, 16, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(29, 16, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(30, 17, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(31, 17, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(32, 18, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(33, 18, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(34, 19, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(35, 19, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(36, 20, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(37, 20, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(38, 21, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(39, 21, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(40, 22, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(41, 23, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(42, 24, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(43, 25, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(44, 26, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg'),
(45, 27, '/FrameWorkHomeDrop/view\\IMG\\Homes\\TypeCarousel\\Stock.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likeshomedrop`
--

CREATE TABLE `likeshomedrop` (
  `LikeID` int(11) NOT NULL,
  `FechaInsert` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_HomeDrop` int(11) DEFAULT NULL,
  `ID_User` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `likeshomedrop`
--

INSERT INTO `likeshomedrop` (`LikeID`, `FechaInsert`, `ID_HomeDrop`, `ID_User`) VALUES
(33, '2024-04-24 19:50:42', 2, 86),
(34, '2024-04-24 19:50:42', 3, 86),
(35, '2024-04-24 19:50:42', 4, 86),
(37, '2024-04-24 19:50:42', 6, 86),
(38, '2024-04-24 19:50:42', 7, 59),
(39, '2024-04-24 19:50:42', 9, 61),
(41, '2024-04-24 19:50:42', 11, 55),
(42, '2024-04-24 19:50:42', 12, 86),
(43, '2024-04-24 19:50:42', 13, 57),
(44, '2024-04-24 19:50:42', 14, 58),
(46, '2024-04-24 19:50:42', 17, 86),
(47, '2024-04-24 19:50:42', 18, 86),
(48, '2024-04-24 19:50:42', 19, 55),
(49, '2024-04-24 19:50:42', 20, 56),
(50, '2024-04-24 19:50:42', 21, 57),
(103, '2024-04-24 19:52:07', 22, 86),
(104, '2024-04-24 19:52:07', 23, 59),
(105, '2024-04-24 19:52:07', 25, 61),
(106, '2024-04-24 19:52:07', 26, 86),
(107, '2024-04-24 19:52:07', 22, 86),
(108, '2024-04-24 19:52:07', 24, 86),
(109, '2024-04-24 19:52:07', 2, 57),
(110, '2024-04-24 19:52:07', 3, 58),
(111, '2024-04-24 19:52:07', 10, 86),
(112, '2024-04-24 19:52:07', 3, 86),
(113, '2024-04-24 19:52:07', 4, 54),
(114, '2024-04-24 19:52:07', 5, 55),
(115, '2024-04-24 19:52:07', 6, 56),
(116, '2024-04-24 19:52:07', 7, 86),
(117, '2024-04-24 19:52:07', 8, 86),
(118, '2024-04-24 19:52:07', 19, 59),
(119, '2024-04-24 19:52:07', 19, 86),
(204, '2024-04-29 09:28:41', 19, 86),
(206, '2024-04-29 09:31:35', 17, 54),
(207, '2024-04-29 13:27:45', 5, 54),
(209, '2024-05-27 11:53:58', 5, 86);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operationhomedrop`
--

CREATE TABLE `operationhomedrop` (
  `ID_Operation` int(11) NOT NULL,
  `Operation` varchar(255) NOT NULL,
  `Img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `operationhomedrop`
--

INSERT INTO `operationhomedrop` (`ID_Operation`, `Operation`, `Img`) VALUES
(2, 'Compra', '/FrameWorkHomeDrop/view\\IMG\\Homes\\OperationHomeDrop\\OperationCompra.jpg'),
(3, 'Alquiler', '/FrameWorkHomeDrop/view\\IMG\\Homes\\OperationHomeDrop\\OperationAlquiler.png'),
(4, 'Opción a Compra', '/FrameWorkHomeDrop/view\\IMG\\Homes\\OperationHomeDrop\\OperationOpcionACompra.jpg'),
(5, 'Compartir', '/FrameWorkHomeDrop/view\\IMG\\Homes\\OperationHomeDrop\\OperationCompartir.jpg'),
(6, 'Obra Nueva', '/FrameWorkHomeDrop/view\\IMG\\Homes\\OperationHomeDrop\\OperationObraNueva.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `typehomedrop`
--

CREATE TABLE `typehomedrop` (
  `ID_Type` int(11) NOT NULL,
  `Img` varchar(255) DEFAULT NULL,
  `Type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `typehomedrop`
--

INSERT INTO `typehomedrop` (`ID_Type`, `Img`, `Type`) VALUES
(1, '/FrameWorkHomeDrop/view/IMG/Homes/TypeCarousel/EstudioCarousel.jpg', 'Estudio'),
(2, '/FrameWorkHomeDrop/view/IMG/Homes/TypeCarousel/ApartamentoCarousel.jpg', 'Apartamento'),
(3, '/FrameWorkHomeDrop/view/IMG/Homes/TypeCarousel/PisoCarousel.jpg', 'Piso'),
(4, '/FrameWorkHomeDrop/view/IMG/Homes/TypeCarousel/AticoCarousel.jpg', 'Ático'),
(5, '/FrameWorkHomeDrop/view/IMG/Homes/TypeCarousel/BajoCarousel.jpg', 'Bajo'),
(6, '/FrameWorkHomeDrop/view/IMG/Homes/TypeCarousel/BuhardillaCarousel.jpg', 'Buhardilla'),
(7, '/FrameWorkHomeDrop/view/IMG/Homes/TypeCarousel/BajoConJardinCarousel.jpg', 'Bajo con Jardín'),
(8, '/FrameWorkHomeDrop/view/IMG/Homes/TypeCarousel/LoftCarousel.jpg', 'Loft'),
(9, '/FrameWorkHomeDrop/view/IMG/Homes/TypeCarousel/ChaletCarousel.jpg', 'Chalet'),
(10, '/FrameWorkHomeDrop/view/IMG/Homes/TypeCarousel/CasaCarousel.jpg', 'Casa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `ID_User` int(30) NOT NULL,
  `Username` varchar(25) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `UserType` varchar(50) DEFAULT NULL,
  `Avatar` varchar(100) DEFAULT NULL,
  `token_email` varchar(255) DEFAULT NULL,
  `tiempo_generacion` bigint(20) DEFAULT NULL,
  `activate` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`ID_User`, `Username`, `Password`, `Email`, `UserType`, `Avatar`, `token_email`, `tiempo_generacion`, `activate`) VALUES
(54, 'Hakvenger', '$2y$12$Ejsb7DlW9f7.Mh8K7GzYaO6YgAQerRrY9tlkHxgT7Gk54.9ldr3Uu', 'jts2003@gmail.com', 'client', 'https://i.pravatar.cc/500?u=516afa276ca664f8c41d4d4fae15684e', '', 1716917267, 1),
(55, 'GYMaster', '$2y$12$ooHVnRZdV3/xKKZXRLqm6.Bdv16CMdPdtvp9TV6wn9qd1CK/i2qcC', 'gymaster69@gmail.com', 'client', 'https://i.pravatar.cc/500?u=edabb60e60a59298a46c9b8ab76ca545', NULL, NULL, 0),
(56, 'Jimaster', '$2y$12$hSvwLbpBwW3vfviQ92lq7Ou9/hAGKCasDiv6QM3Kfv.qe8a4le.VG', 'jimaster@gmail.com', 'client', 'https://i.pravatar.cc/500?u=cf3328b5372ff0967c490aa90b2a7e6e', NULL, NULL, 0),
(57, 'Gabotto', '$2y$12$lGapVK/a1Cmpwi85AxoT6OrBL6CCIYCRYsruuwHE9WbNWhjLFOQUu', 'gabotto@gmai.com', 'client', 'https://i.pravatar.cc/500?u=aaef94f16c77b0e62a973be625d6656d', NULL, NULL, 0),
(58, 'Gabotto2', '$2y$12$jKXYehZcavlVMhgUdarUwuhMSJj.QW5ofsqIsYv/S35k.gc9BPSSW', 'gabotto2@gmail.com', 'client', 'https://i.pravatar.cc/500?u=cb094041b74f7f2ccfc8430050ee928f', NULL, NULL, 0),
(59, 'Gabotto3', '$2y$12$jgnWwwJ6H7lgZu3kvxPFfOwODJIq0KQUceu24IIb.2X9BrmUuhvYi', 'gabotto3@gmail.com', 'client', 'https://i.pravatar.cc/500?u=44676d5d1a66ed78a8e7f4b4039745c7', NULL, NULL, 0),
(61, 'H5a', '$2y$12$sFfmaJoGeWZRaqvITeCxY.c0hAUJ70vV.GgrvOlVyRgyORv3/OPe2', 'jartost@gmail.com', 'client', 'https://i.pravatar.cc/500?u=6348b9cd9c83fc5e59103cbb7307c884', NULL, NULL, 0),
(67, 'TestFinal', '$2y$12$.OaT24fbHBpjrMUdVi64OOt9X780OBdT1WFON0oytJmclEg4G0Vje', 'TestFinal@gmail.com', 'client', 'https://i.pravatar.cc/500?u=b8b3d98b6696cf7cbf6831d4612a3cad', NULL, NULL, 0),
(68, 'TestFinal2', '$2y$12$MkB9w/5NywgZZcQlLY9uou9JVmdaVanbE0/2MOa.tng.O.svtuP36', 'TestFinal2@gmail.com', 'client', 'https://i.pravatar.cc/500?u=2627158fe1d09e7b70a8929efd3f1568', NULL, NULL, 0),
(70, 'Manoleishon', '$2y$12$WF4DZKTcIgKlpI7mXC6QceEsIb3BeaOPVzI15zR0nkHy.AlcFWgyy', 'manoleishon@gmail.com', 'client', 'https://i.pravatar.cc/500?u=21f62174421f8a16f329da58c5941994', NULL, NULL, 0),
(71, 'Pichoncito', '$2y$12$xOh7m32ChUcBL4N2/6jPXuTzogAoTqW/fir7ZLq4TWogSSIgTFtoq', 'pichoncito@gmail.com', 'client', 'https://i.pravatar.cc/500?u=0723041590955737a96cb42ba4c846fe', NULL, NULL, 0),
(74, 'Manoleishon0000Admin', '$2y$10$bQKmSZngDmX.xmh3qHRNpeX8O1Phi85S1vrkalXlKKuM9jm4fDMui', 'jimaster0000Admin@gmail.com', 'client', 'https://i.pravatar.cc/500?u=d3e5d7bb7ef11e0363af1f334a5659f2', '', 1716380438, 1),
(86, 'Hakya', '$2y$10$3UJ9QCi8DUABlxWrajEhCuaQp7RnWQzfzX8qwGG1MimruutlFQY8e', 'javiertomas2003@gmail.com', 'admin', 'https://i.pravatar.cc/500?u=516afa276ca664f8c41d4d4fae15684e', '', 1716542449, 1),
(87, 'Final_Test+', '$2y$10$nsNO3ItTH5nK4g6lXWRGdO8My/pUG1n.Pgu0OREtOGXS0l2fAc0ke', 'j0000Admin@gmail.com', 'client', 'https://i.pravatar.cc/500?u=9cf16a7d3dd1c37d74c8c839c61159d9', '', 1716384153, 1),
(88, 'TestSingleton_Class', '$2y$12$iN/QQDOZ4FSCe9KWKb1T6eFxu3HzIh73NpwkQq1zzlGFI96HL6LPK', 'tyhujl@kjhgfd.fd', 'client', 'https://i.pravatar.cc/500?u=15e90f1c1b86fbe5e772142a85200146', '', 1716916019, 1),
(92, 'CaducarTokenAProposito', '$2y$10$8rx91iaPTgcejHr1sZnHReTBIxxaoXzSlp1RkDUp8rli4OPY6./sm', 'sdfghjkdsf@gmail.com', 'client', 'https://i.pravatar.cc/500?u=8289845c4ddb3b13c697b3369598e284', '5cee6e9846ab179fda29', 1716564456, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viviendascategory`
--

CREATE TABLE `viviendascategory` (
  `ID_Category` int(11) NOT NULL,
  `ID_HomeDrop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viviendascategory`
--

INSERT INTO `viviendascategory` (`ID_Category`, `ID_HomeDrop`) VALUES
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(3, 10),
(5, 11),
(2, 12),
(3, 13),
(4, 14),
(5, 15),
(6, 16),
(7, 17),
(8, 18),
(9, 19),
(3, 20),
(5, 21),
(3, 12),
(4, 13),
(5, 14),
(6, 15),
(7, 16),
(8, 17),
(9, 18),
(3, 19),
(5, 20),
(3, 10),
(4, 11),
(5, 20),
(6, 21),
(2, 22),
(3, 23),
(4, 24),
(5, 25),
(6, 26),
(7, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viviendashomedrop`
--

CREATE TABLE `viviendashomedrop` (
  `ID_HomeDrop` int(11) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Calle` varchar(255) NOT NULL,
  `Superficie` int(11) NOT NULL,
  `ID_City` int(11) NOT NULL,
  `Fecha_Pub` date DEFAULT NULL,
  `lon` decimal(10,8) DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `vivistas` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viviendashomedrop`
--

INSERT INTO `viviendashomedrop` (`ID_HomeDrop`, `Precio`, `Calle`, `Superficie`, `ID_City`, `Fecha_Pub`, `lon`, `lat`, `vivistas`) VALUES
(2, 120500.00, 'Nombre de la Calle 1', 150, 2, '2022-01-01', -3.65258032, 40.41878752, 19),
(3, 95005.00, 'Nombre de la Calle 2', 120, 2, '2022-01-02', -3.64752145, 40.49223018, 8),
(4, 85800.00, 'Nombre de la Calle 3', 100, 3, '2022-01-03', -0.36798473, 39.48518580, 28),
(5, 135050.00, 'Nombre de la Calle 4', 180, 7, '2022-01-04', 2.22488321, 41.39665864, 72),
(6, 110030.00, 'Nombre de la Calle 5', 140, 9, '2022-01-05', -0.47765642, 38.42724200, 16),
(7, 75009.00, 'Nombre de la Calle 6', 90, 10, '2022-01-06', -0.52902076, 38.45017021, 12),
(8, 95000.00, 'Nombre de la Calle 7', 110, 2, '2022-01-07', -3.63048668, 40.41905599, 6),
(9, 98060.00, 'Nombre de la Calle 8', 125, 3, '2022-01-08', -0.28496001, 39.51983198, 12),
(10, 115070.00, 'Nombre de la Calle 9', 135, 7, '2022-01-09', 2.24903995, 41.41350378, 2),
(11, 105000.00, 'Nombre de la Calle 10', 130, 10, '2022-01-10', -0.51410092, 38.48568405, 1),
(12, 125000.00, 'Nombre de la Calle 11', 160, 2, '2024-03-06', -3.69767696, 40.47656302, 1),
(13, 85000.00, 'Nombre de la Calle 12', 110, 3, '2024-03-06', -0.29585400, 39.49284094, 0),
(14, 95000.00, 'Nombre de la Calle 13', 130, 7, '2024-03-06', 2.24676671, 41.48311073, 1),
(15, 140000.00, 'Nombre de la Calle 14', 180, 9, '2024-03-06', -0.41104648, 38.40093542, 15),
(16, 80000.00, 'Nombre de la Calle 15', 100, 10, '2024-03-06', -0.46038344, 38.47227652, 1),
(17, 92000.00, 'Nombre de la Calle 16', 115, 2, '2024-03-06', -3.62586705, 40.47583518, 12),
(18, 110000.00, 'Nombre de la Calle 17', 140, 3, '2024-03-06', -0.31492295, 39.49967970, 1),
(19, 128000.00, 'Nombre de la Calle 18', 155, 7, '2024-03-06', 2.23816737, 41.41959773, 31),
(20, 75000.00, 'Nombre de la Calle 19', 95, 9, '2024-03-06', -0.40281345, 38.43263959, 2),
(21, 105000.00, 'Nombre de la Calle 20', 120, 10, '2024-03-06', -0.52656173, 38.44627261, 1),
(22, 100000.00, 'Nombre de la Calle 21', 130, 11, '2024-03-06', -8.42083300, 40.21149100, 6),
(23, 90000.00, 'Nombre de la Calle 22', 110, 11, '2024-03-06', -8.41614100, 40.20331400, 3),
(24, 110000.00, 'Nombre de la Calle 23', 140, 11, '2024-03-06', -8.40566100, 40.21192100, 1),
(25, 95000.00, 'Nombre de la Calle 24', 120, 11, '2024-03-06', -8.41489300, 40.20915700, 2),
(26, 105000.00, 'Nombre de la Calle 25', 125, 11, '2024-03-06', -8.41754800, 40.20756400, 1),
(27, 85000.00, 'Nombre de la Calle 26', 115, 11, '2024-03-06', -8.42183600, 40.21464700, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viviendasoperation`
--

CREATE TABLE `viviendasoperation` (
  `ID_Operation` int(11) NOT NULL,
  `ID_HomeDrop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viviendasoperation`
--

INSERT INTO `viviendasoperation` (`ID_Operation`, `ID_HomeDrop`) VALUES
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(2, 7),
(3, 8),
(4, 9),
(5, 10),
(6, 11),
(2, 12),
(3, 13),
(4, 14),
(5, 15),
(6, 16),
(2, 17),
(3, 18),
(4, 19),
(5, 20),
(6, 21),
(2, 22),
(3, 23),
(4, 24),
(5, 25),
(6, 26),
(2, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viviendastype`
--

CREATE TABLE `viviendastype` (
  `ID_Type` int(11) NOT NULL,
  `ID_HomeDrop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viviendastype`
--

INSERT INTO `viviendastype` (`ID_Type`, `ID_HomeDrop`) VALUES
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(1, 11),
(2, 12),
(3, 13),
(4, 14),
(5, 15),
(6, 16),
(7, 17),
(8, 18),
(9, 19),
(10, 20),
(1, 21),
(2, 22),
(3, 23),
(4, 24),
(5, 25),
(6, 26),
(7, 27);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoryhomedrop`
--
ALTER TABLE `categoryhomedrop`
  ADD PRIMARY KEY (`ID_Category`);

--
-- Indices de la tabla `cityhomedrop`
--
ALTER TABLE `cityhomedrop`
  ADD PRIMARY KEY (`ID_City`);

--
-- Indices de la tabla `exceptionlogs`
--
ALTER TABLE `exceptionlogs`
  ADD PRIMARY KEY (`ID_Exception`),
  ADD KEY `ID_HomeDrop` (`ID_HomeDrop`);

--
-- Indices de la tabla `imageneshomedrop`
--
ALTER TABLE `imageneshomedrop`
  ADD PRIMARY KEY (`ID_Imagen`);

--
-- Indices de la tabla `likeshomedrop`
--
ALTER TABLE `likeshomedrop`
  ADD PRIMARY KEY (`LikeID`),
  ADD KEY `ID_HomeDrop` (`ID_HomeDrop`),
  ADD KEY `ID_User` (`ID_User`);

--
-- Indices de la tabla `operationhomedrop`
--
ALTER TABLE `operationhomedrop`
  ADD PRIMARY KEY (`ID_Operation`);

--
-- Indices de la tabla `typehomedrop`
--
ALTER TABLE `typehomedrop`
  ADD PRIMARY KEY (`ID_Type`),
  ADD UNIQUE KEY `ID_Type` (`ID_Type`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_User`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indices de la tabla `viviendascategory`
--
ALTER TABLE `viviendascategory`
  ADD KEY `ID_Category` (`ID_Category`) USING BTREE,
  ADD KEY `ID_HomeDrop` (`ID_HomeDrop`);

--
-- Indices de la tabla `viviendashomedrop`
--
ALTER TABLE `viviendashomedrop`
  ADD PRIMARY KEY (`ID_HomeDrop`),
  ADD KEY `ID_City` (`ID_City`);

--
-- Indices de la tabla `viviendasoperation`
--
ALTER TABLE `viviendasoperation`
  ADD KEY `ID_HomeDrop` (`ID_HomeDrop`) USING BTREE,
  ADD KEY `ID_Operation` (`ID_Operation`) USING BTREE;

--
-- Indices de la tabla `viviendastype`
--
ALTER TABLE `viviendastype`
  ADD KEY `ID_HomeDrop` (`ID_HomeDrop`),
  ADD KEY `ID_Type` (`ID_Type`) USING BTREE,
  ADD KEY `ID_HomeDrop_2` (`ID_HomeDrop`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoryhomedrop`
--
ALTER TABLE `categoryhomedrop`
  MODIFY `ID_Category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `cityhomedrop`
--
ALTER TABLE `cityhomedrop`
  MODIFY `ID_City` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `exceptionlogs`
--
ALTER TABLE `exceptionlogs`
  MODIFY `ID_Exception` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `imageneshomedrop`
--
ALTER TABLE `imageneshomedrop`
  MODIFY `ID_Imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `likeshomedrop`
--
ALTER TABLE `likeshomedrop`
  MODIFY `LikeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT de la tabla `operationhomedrop`
--
ALTER TABLE `operationhomedrop`
  MODIFY `ID_Operation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `ID_User` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `viviendashomedrop`
--
ALTER TABLE `viviendashomedrop`
  MODIFY `ID_HomeDrop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `exceptionlogs`
--
ALTER TABLE `exceptionlogs`
  ADD CONSTRAINT `fk_home_drop` FOREIGN KEY (`ID_HomeDrop`) REFERENCES `viviendashomedrop` (`ID_HomeDrop`);

--
-- Filtros para la tabla `likeshomedrop`
--
ALTER TABLE `likeshomedrop`
  ADD CONSTRAINT `likeshomedrop_ibfk_1` FOREIGN KEY (`ID_HomeDrop`) REFERENCES `viviendashomedrop` (`ID_HomeDrop`),
  ADD CONSTRAINT `likeshomedrop_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID_User`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
