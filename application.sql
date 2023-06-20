-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2023 a las 23:47:01
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `application`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amistad`
--

CREATE TABLE `amistad` (
  `id` int(11) NOT NULL,
  `usuario1_id` int(11) DEFAULT NULL,
  `usuario2_id` int(11) DEFAULT NULL,
  `fecha_amistad` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `amistad`
--

INSERT INTO `amistad` (`id`, `usuario1_id`, `usuario2_id`, `fecha_amistad`) VALUES
(4, 3, 3, '2023-06-10 14:23:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deporte`
--

CREATE TABLE `deporte` (
  `id` int(3) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `imagen` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `deporte`
--

INSERT INTO `deporte` (`id`, `nombre`, `imagen`) VALUES
(1, 'Fútbol', 'futbol.jpg'),
(2, 'Baloncesto', 'baloncesto.png'),
(3, 'Ciclismo', 'ciclismo.jpg'),
(4, 'Hockey', 'hockey.jpg'),
(5, 'Padel', 'padel.jpg'),
(6, 'Senderismo', 'senderismo.jpg'),
(7, 'Tenis', 'tenis.jpg'),
(8, 'Voley', 'voley.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id` int(5) NOT NULL,
  `deporte` int(3) NOT NULL,
  `n_personas` int(2) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `deporte`, `n_personas`, `fecha`, `titulo`, `id_usuario`, `direccion`, `descripcion`) VALUES
(1, 1, 3, '2022-12-14', 'Pachanga futbol', 1, 'Granada', 'Necesitamos gente para un partido en granada'),
(2, 2, 3, '2022-12-16', 'Partido de basket', 2, 'Granada', 'Vente y juega con nosotros somos una peña'),
(3, 1, 11, '2023-05-26', 'Pruebaaa', 3, 'Calicasas', 'Pruebaprueba'),
(4, 6, 4, '2023-11-05', 'FIESTA GORDA', 3, 'CAMPO', 'FIESTAAAAAAAAA gorda la que se va a liar loco es iuna locura lo digo en seriooo wooo AJAJAJ cx'),
(5, 5, 3, '2023-11-05', 'prueba2', 5, 'Granada', 'Es un partido'),
(6, 1, 3, '2023-12-01', 'prueba333', 5, 'granada', 'Desc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `id_evento` int(5) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `id_evento`, `nombre`, `mensaje`, `fecha`) VALUES
(2, 1, 'prueba', 'hola', '2022-12-15 03:16:19'),
(3, 1, 'prueba', 'que tal', '2022-12-15 03:16:23'),
(4, 1, 'prueba', 'yo bien', '2022-12-15 03:16:27'),
(5, 1, 'prueba', 'y tu', '2022-12-15 03:16:29'),
(6, 1, 'prueba', '<zx', '2022-12-15 03:26:03'),
(7, 1, 'prueba', 'asdw', '2022-12-15 03:26:06'),
(8, 1, 'prueba', '<asd', '2022-12-15 03:26:09'),
(9, 1, 'prueba', 'asd213', '2022-12-15 03:26:28'),
(10, 1, 'prueba', '<>', '2022-12-15 03:26:33'),
(11, 1, 'prueba', '<', '2022-12-15 03:26:34'),
(12, 1, 'prueba', '<a', '2022-12-15 03:26:35'),
(13, 1, 'prueba', '<s', '2022-12-15 03:26:37'),
(14, 1, 'prueba', '<df', '2022-12-15 03:26:39'),
(15, 1, 'prueba', '<', '2022-12-15 03:26:41'),
(16, 1, 'prueba', 'asd', '2022-12-15 03:26:51'),
(17, 1, 'prueba', 'asd', '2022-12-15 03:26:51'),
(18, 1, 'prueba', 'asd', '2022-12-15 03:26:52'),
(19, 1, 'prueba', 'asd', '2022-12-15 03:26:52'),
(20, 1, 'prueba', 'sad', '2022-12-15 03:26:53'),
(21, 1, 'prueba', 'asd', '2022-12-15 03:29:36'),
(22, 1, 'prueba', 'asd', '2022-12-15 03:29:36'),
(23, 1, 'prueba', 'w', '2022-12-15 03:29:37'),
(24, 1, 'prueba', 'eqwe', '2022-12-15 03:29:38'),
(25, 1, 'prueba', 'asd', '2022-12-15 03:29:38'),
(26, 1, 'asd', 'hola', '2023-03-04 11:26:03'),
(27, 1, 'asd', 'que tall', '2023-03-04 11:26:08'),
(28, 1, 'asd', 'Hola +', '2023-03-04 11:42:33'),
(29, 2, 'asd', 'hola', '2023-03-04 11:42:43'),
(30, 1, 'jose', 'Holaaa que tal estais pr aqui chat', '2023-06-06 15:49:08'),
(31, 5, 'josett', 'Hola que tal', '2023-06-19 21:09:57'),
(32, 5, 'josett', 'Como estais', '2023-06-19 21:10:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peticiones_amistad`
--

CREATE TABLE `peticiones_amistad` (
  `id` int(11) NOT NULL,
  `remitente_id` int(11) DEFAULT NULL,
  `receptor_id` int(11) DEFAULT NULL,
  `fecha_peticion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peticiones_amistad`
--

INSERT INTO `peticiones_amistad` (`id`, `remitente_id`, `receptor_id`, `fecha_peticion`) VALUES
(11, 3, 1, '2023-06-10 13:49:33'),
(12, 3, 2, '2023-06-10 13:49:47'),
(15, 4, 3, '2023-06-19 18:52:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `pass` varchar(18) NOT NULL,
  `nom_us` varchar(25) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellidos` varchar(25) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'img_avatar.png',
  `tipo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `pass`, `nom_us`, `nombre`, `apellidos`, `descripcion`, `foto`, `tipo`) VALUES
(1, 'asd@gmail.com', 'asdfghjK1', 'asd', 'asd', 'asd', '', 'img_avatar.png', 0),
(2, 'prueba@gmail.com', 'asdfghjK1', 'prueba', 'Jose Antonio', 'Torres', '', 'img_avatar.png', 0),
(3, 'jose@gmail.com', '12345678Aj', 'jose', 'jose', 'torres', '', 'img_avatar.png', 0),
(4, 'Josee@gmail.com', 'Joseeselmejor1', 'josee', 'josee', 'josee', '', '20230619204803.jpg', 0),
(5, 'josett@gmail.com', 'Joseeselmejor1', 'josett', 'jose', 'torres', '', '20230619222521.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_apuntado`
--

CREATE TABLE `usuario_apuntado` (
  `id` int(5) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_evento` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_apuntado`
--

INSERT INTO `usuario_apuntado` (`id`, `id_usuario`, `id_evento`) VALUES
(32, 3, 2),
(39, 3, 1),
(42, 5, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amistad`
--
ALTER TABLE `amistad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario1_id` (`usuario1_id`),
  ADD KEY `usuario2_id` (`usuario2_id`);

--
-- Indices de la tabla `deporte`
--
ALTER TABLE `deporte`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `titulo` (`titulo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `evento_ibfk_2` (`deporte`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mens_ev_fk` (`id_evento`);

--
-- Indices de la tabla `peticiones_amistad`
--
ALTER TABLE `peticiones_amistad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `remitente_id` (`remitente_id`),
  ADD KEY `receptor_id` (`receptor_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `nom_us` (`nom_us`);

--
-- Indices de la tabla `usuario_apuntado`
--
ALTER TABLE `usuario_apuntado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_evap` (`id_evento`),
  ADD KEY `fk_usap` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amistad`
--
ALTER TABLE `amistad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `deporte`
--
ALTER TABLE `deporte`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `peticiones_amistad`
--
ALTER TABLE `peticiones_amistad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario_apuntado`
--
ALTER TABLE `usuario_apuntado`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amistad`
--
ALTER TABLE `amistad`
  ADD CONSTRAINT `amistad_ibfk_1` FOREIGN KEY (`usuario1_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `amistad_ibfk_2` FOREIGN KEY (`usuario2_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `evento_ibfk_2` FOREIGN KEY (`deporte`) REFERENCES `deporte` (`id`);

--
-- Filtros para la tabla `peticiones_amistad`
--
ALTER TABLE `peticiones_amistad`
  ADD CONSTRAINT `peticiones_amistad_ibfk_1` FOREIGN KEY (`remitente_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `peticiones_amistad_ibfk_2` FOREIGN KEY (`receptor_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuario_apuntado`
--
ALTER TABLE `usuario_apuntado`
  ADD CONSTRAINT `fk_evap` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`),
  ADD CONSTRAINT `fk_usap` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
