-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2024 a las 20:23:08
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
-- Estructura de tabla para la tabla `cart`
--

CREATE TABLE `cart` (
  `ID_Cart` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `ID_HomeDrop` int(11) NOT NULL,
  `Upload_Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cart`
--

INSERT INTO `cart` (`ID_Cart`, `ID_User`, `ID_HomeDrop`, `Upload_Date`, `Quantity`) VALUES
(3, 97, 8, '2024-06-05 12:30:12', 1),
(4, 97, 19, '2024-06-05 12:30:18', 1),
(5, 97, 4, '2024-06-05 12:30:29', 2),
(6, 98, 7, '2024-06-05 13:26:31', 2),
(7, 98, 8, '2024-06-05 13:26:37', 1),
(8, 98, 19, '2024-06-05 13:26:43', 1);

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
(42, '2024-04-24 19:50:42', 12, 86),
(46, '2024-04-24 19:50:42', 17, 86),
(47, '2024-04-24 19:50:42', 18, 86),
(103, '2024-04-24 19:52:07', 22, 86),
(106, '2024-04-24 19:52:07', 26, 86),
(107, '2024-04-24 19:52:07', 22, 86),
(108, '2024-04-24 19:52:07', 24, 86),
(111, '2024-04-24 19:52:07', 10, 86),
(112, '2024-04-24 19:52:07', 3, 86),
(116, '2024-04-24 19:52:07', 7, 86),
(117, '2024-04-24 19:52:07', 8, 86),
(119, '2024-04-24 19:52:07', 19, 86),
(204, '2024-04-29 09:28:41', 19, 86),
(211, '2024-06-06 17:45:58', 15, 100),
(212, '2024-06-10 17:27:14', 5, 86);

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
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `ID_Order` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `Total_Amount` decimal(10,2) NOT NULL,
  `Order_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(50) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`ID_Order`, `ID_User`, `Total_Amount`, `Order_Date`, `Status`) VALUES
(7, 86, 590127.00, '2024-06-07 19:14:12', 'pending'),
(8, 86, 183860.00, '2024-06-07 19:15:24', 'pending'),
(9, 86, 220060.00, '2024-06-09 18:17:22', 'pending'),
(10, 86, 365000.00, '2024-06-10 19:08:53', 'pending'),
(11, 86, 675000.00, '2024-06-10 20:11:04', 'pending');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_items`
--

CREATE TABLE `order_items` (
  `ID_OrderItems` int(11) NOT NULL,
  `ID_Order` int(11) NOT NULL,
  `ID_HomeDrop` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order_items`
--

INSERT INTO `order_items` (`ID_OrderItems`, `ID_Order`, `ID_HomeDrop`, `Quantity`, `Price`) VALUES
(1, 7, 5, 2, 135050.00),
(2, 7, 7, 3, 75009.00),
(3, 7, 8, 1, 95000.00),
(4, 8, 4, 1, 85800.00),
(5, 8, 9, 1, 98060.00),
(7, 9, 6, 2, 110030.00),
(8, 10, 16, 1, 80000.00),
(9, 10, 8, 3, 95000.00),
(10, 11, 20, 9, 75000.00);

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
  `activate` tinyint(1) DEFAULT 0,
  `attempts` int(11) DEFAULT 0,
  `SL_github` varchar(255) DEFAULT NULL,
  `SL_google` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`ID_User`, `Username`, `Password`, `Email`, `UserType`, `Avatar`, `token_email`, `tiempo_generacion`, `activate`, `attempts`, `SL_github`, `SL_google`) VALUES
(86, 'Hakya', '$2y$10$3UJ9QCi8DUABlxWrajEhCuaQp7RnWQzfzX8qwGG1MimruutlFQY8e', 'javiertomas2003@gmail.com', 'admin', 'https://i.pravatar.cc/500?u=516afa276ca664f8c41d4d4fae15684e', '', 1716542449, 1, 0, NULL, 'Hakya_google'),
(87, 'Final_Test+', '$2y$10$nsNO3ItTH5nK4g6lXWRGdO8My/pUG1n.Pgu0OREtOGXS0l2fAc0ke', 'j0000Admin@gmail.com', 'client', 'https://i.pravatar.cc/500?u=9cf16a7d3dd1c37d74c8c839c61159d9', '', 1716384153, 1, 0, NULL, NULL),
(88, 'TestSingleton_Class', '$2y$12$Rb/pudh22sLrqiA0G1IBnOVaMbM/DxpYaBUA4Lwt26pWkOP32z4U2', 'tyhujl@kjhgfd.fd', 'client', 'https://i.pravatar.cc/500?u=15e90f1c1b86fbe5e772142a85200146', '', 1717692860, 1, 0, NULL, NULL),
(93, 'Hakyaadsf', '$2y$10$2PwEZVikSQl6.TYqeq42ZORdxpqg3M.UwRCc62iWNTsFDPKbvRChu', 'fadsgh@gmail.com', 'client', 'https://i.pravatar.cc/500?u=ab7602da8f40a6076c2b55fa99c2f490', '', 1716990023, 1, 0, NULL, NULL),
(95, 'Manoleisdfsafdafadshon', '$2y$10$IkJMWF7QoOm4XeyH9Nk50.E/wUHp0Sa1GT0cR80yVcQZmNBFZX1O.', 'javiertomdasdas@gmail.com', 'client', 'https://i.pravatar.cc/500?u=da0711fad1b26439e863130486643479', '', 1717004786, 1, 0, NULL, NULL),
(97, 'javtomtor', '', 'javtomtor@alu.edu.gva.es', 'client', 'https://avatars.githubusercontent.com/u/163329894?v=4', '', 0, 1, 0, '', ''),
(98, 'blakealbaida', '', 'blakealbaida@gmail.com', 'client', 'https://lh3.googleusercontent.com/a/ACg8ocK68I21shf_QNu5_Dgz7ZZozK2uJOGQKDyp1ytcU1fiAa7CXQ=s96-c', '', 0, 1, 0, '', ''),
(99, 'javiertomastormo', '', 'javiertomastormo@gmail.com', 'client', 'https://lh3.googleusercontent.com/a/ACg8ocLlo3PdQhqfN75ZyeZh27XMR4BfDyhlvHxwUpM3gG7dSpG_=s96-c', '', 0, 1, 0, '', ''),
(100, 'yomogan', '$2y$10$9bCWc7sFLt3joJ/kFpImzuz22ws9s2fV0WFkR0C6DHTwNWtvH7H36', 'yomogan@gmail.com', 'client', 'https://i.pravatar.cc/500?u=9154526c03ad3e327b28e3f1f7582e3a', '', 1717692783, 1, 0, NULL, NULL);

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
  `vivistas` int(11) DEFAULT 0,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viviendashomedrop`
--

INSERT INTO `viviendashomedrop` (`ID_HomeDrop`, `Precio`, `Calle`, `Superficie`, `ID_City`, `Fecha_Pub`, `lon`, `lat`, `vivistas`, `stock`) VALUES
(2, 120500.00, 'Calle Mayor 23', 150, 2, '2022-01-01', -3.65258032, 40.41878752, 19, 6),
(3, 95005.00, 'Avenida de la Constitución 56', 120, 2, '2022-01-02', -3.64752145, 40.49223018, 8, 2),
(4, 85800.00, 'Calle Gran Vía 12', 100, 3, '2022-01-03', -0.36798473, 39.48518580, 31, 7),
(5, 135050.00, 'Avenida de América 34', 180, 7, '2022-01-04', 2.22488321, 41.39665864, 79, 5),
(6, 110030.00, 'Calle del Prado 45', 140, 9, '2022-01-05', -0.47765642, 38.42724200, 17, 8),
(7, 75009.00, 'Calle Serrano 78', 90, 10, '2022-01-06', -0.52902076, 38.45017021, 16, 8),
(8, 95000.00, 'Calle de Alcalá 89', 110, 2, '2022-01-07', -3.63048668, 40.41905599, 12, 3),
(9, 98060.00, 'Calle de Velázquez 101', 125, 3, '2022-01-08', -0.28496001, 39.51983198, 13, 7),
(10, 115070.00, 'Calle Goya 14', 135, 7, '2022-01-09', 2.24903995, 41.41350378, 2, 3),
(11, 105000.00, 'Calle de Atocha 25', 130, 10, '2022-01-10', -0.51410092, 38.48568405, 1, 9),
(12, 125000.00, 'Calle de Bravo Murillo 67', 160, 2, '2024-03-06', -3.69767696, 40.47656302, 1, 4),
(13, 85000.00, 'Paseo de la Castellana 90', 110, 3, '2024-03-06', -0.29585400, 39.49284094, 0, 4),
(14, 95000.00, 'Calle de Hortaleza 32', 130, 7, '2024-03-06', 2.24676671, 41.48311073, 1, 1),
(15, 140000.00, 'Calle de Fuencarral 21', 180, 9, '2024-03-06', -0.41104648, 38.40093542, 19, 8),
(16, 80000.00, 'Calle de Raimundo Fernández Villaverde 43', 100, 10, '2024-03-06', -0.46038344, 38.47227652, 2, 9),
(17, 92000.00, 'Calle de Embajadores 76', 115, 2, '2024-03-06', -3.62586705, 40.47583518, 13, 9),
(18, 110000.00, 'Calle del General Perón 58', 140, 3, '2024-03-06', -0.31492295, 39.49967970, 1, 2),
(19, 128000.00, 'Calle de Arturo Soria 87', 155, 7, '2024-03-06', 2.23816737, 41.41959773, 56, 4),
(20, 75000.00, 'Calle de Orense 16', 95, 9, '2024-03-06', -0.40281345, 38.43263959, 3, 10),
(21, 105000.00, 'Calle de López de Hoyos 29', 120, 10, '2024-03-06', -0.52656173, 38.44627261, 1, 7),
(22, 100000.00, 'Calle de Juan Bravo 54', 130, 11, '2024-03-06', -8.42083300, 40.21149100, 6, 1),
(23, 90000.00, 'Calle de Jorge Juan 65', 110, 11, '2024-03-06', -8.41614100, 40.20331400, 3, 6),
(24, 110000.00, 'Calle de Alfonso XII 77', 140, 11, '2024-03-06', -8.40566100, 40.21192100, 1, 3),
(25, 95000.00, 'Calle del Doctor Esquerdo 38', 120, 11, '2024-03-06', -8.41489300, 40.20915700, 3, 4),
(26, 105000.00, 'Calle de Príncipe de Vergara 49', 125, 11, '2024-03-06', -8.41754800, 40.20756400, 1, 2),
(27, 85000.00, 'Calle Gran Vía 14', 115, 11, '2024-03-06', -8.42183600, 40.21464700, 4, NULL);

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
-- Indices de la tabla `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID_Cart`),
  ADD KEY `FK_Carrito_Usuario` (`ID_User`),
  ADD KEY `FK_Carrito_Vivienda` (`ID_HomeDrop`);

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
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID_Order`),
  ADD KEY `ID_User` (`ID_User`);

--
-- Indices de la tabla `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`ID_OrderItems`),
  ADD KEY `ID_Order` (`ID_Order`);

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
-- AUTO_INCREMENT de la tabla `cart`
--
ALTER TABLE `cart`
  MODIFY `ID_Cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `LikeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT de la tabla `operationhomedrop`
--
ALTER TABLE `operationhomedrop`
  MODIFY `ID_Operation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `ID_Order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `order_items`
--
ALTER TABLE `order_items`
  MODIFY `ID_OrderItems` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `ID_User` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `viviendashomedrop`
--
ALTER TABLE `viviendashomedrop`
  MODIFY `ID_HomeDrop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_Carrito_Usuario` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID_User`),
  ADD CONSTRAINT `FK_Carrito_Vivienda` FOREIGN KEY (`ID_HomeDrop`) REFERENCES `viviendashomedrop` (`ID_HomeDrop`);

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

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID_User`);

--
-- Filtros para la tabla `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`ID_Order`) REFERENCES `orders` (`ID_Order`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`ID_HomeDrop`) REFERENCES `viviendashomedrop` (`ID_HomeDrop`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
