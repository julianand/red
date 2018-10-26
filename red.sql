-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2018 a las 00:48:17
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `red`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conversaciones`
--

CREATE TABLE `conversaciones` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `conversaciones`
--

INSERT INTO `conversaciones` (`id`) VALUES
(19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conversaciones_usuarios`
--

CREATE TABLE `conversaciones_usuarios` (
  `usuario_id` int(11) NOT NULL,
  `conversacion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `conversaciones_usuarios`
--

INSERT INTO `conversaciones_usuarios` (`usuario_id`, `conversacion_id`) VALUES
(3, 19),
(4, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `mensaje` varchar(1000) NOT NULL,
  `hora` datetime NOT NULL,
  `conversacion_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `mensaje`, `hora`, `conversacion_id`, `usuario_id`) VALUES
(15, 'monda', '2018-10-26 16:41:00', 19, 3),
(16, 'asd', '2018-10-26 16:42:45', 19, 3),
(17, 'Hola', '2018-10-26 16:54:55', 19, 3),
(18, 'cas', '2018-10-26 16:58:46', 19, 3),
(19, 'camilo', '2018-10-26 17:02:19', 19, 3),
(20, 'hola', '2018-10-26 17:02:45', 19, 3),
(22, 'hola xd', '2018-10-26 17:43:12', 19, 3),
(23, 'hola prro', '2018-10-26 17:45:46', 19, 3),
(24, 'visto :\'v', '2018-10-26 17:45:51', 19, 3),
(25, 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T.', '2018-10-26 17:46:45', 19, 3),
(26, 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', '2018-10-26 17:47:28', 19, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `username`, `password`, `remember_token`) VALUES
(3, 'Julian Pitre', 'skr', '$2y$10$ToMpkQ/RcIj0uQjSl3tfDuffuBLEBJAg0FCCqVuqzj.JwSOHoLh5m', '2RyE2m3JGYnsvxRAKeo0uJcAFdf1kadu2DAGEBnQk4A1ZbP4qEtgNii3PPLF'),
(4, 'Camilo', 'kama', '$2y$10$GF9YPSyaxr0zjN0gqPX50e4uC9EIxkBIfF1s2X7.BGmCJshyQTV2O', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conversaciones`
--
ALTER TABLE `conversaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `conversaciones_usuarios`
--
ALTER TABLE `conversaciones_usuarios`
  ADD PRIMARY KEY (`usuario_id`,`conversacion_id`),
  ADD KEY `conversaciones_usuarios_ibfk_2` (`conversacion_id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversacion_id` (`conversacion_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `conversaciones`
--
ALTER TABLE `conversaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `conversaciones_usuarios`
--
ALTER TABLE `conversaciones_usuarios`
  ADD CONSTRAINT `conversaciones_usuarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversaciones_usuarios_ibfk_2` FOREIGN KEY (`conversacion_id`) REFERENCES `conversaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`conversacion_id`) REFERENCES `conversaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
