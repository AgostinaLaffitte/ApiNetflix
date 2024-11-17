-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2024 a las 05:55:26
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
-- Base de datos: `netflix`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id_peliculas` int(11) NOT NULL,
  `Nombre_pelicula` varchar(50) NOT NULL,
  `Lanzamiento` date NOT NULL,
  `director` varchar(50) NOT NULL,
  `Idioma` varchar(50) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `id_productora` int(11) NOT NULL,
  `imagen_pelicula` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id_peliculas`, `Nombre_pelicula`, `Lanzamiento`, `director`, `Idioma`, `genero`, `id_productora`, `imagen_pelicula`) VALUES
(1, 'Buscando a Nemo ', '2003-05-30', 'Andrew Stanton', 'Ingles', 'Animacion infantil', 18, 'img/task/67158d9140415.jpg'),
(2, 'One day', '2011-08-08', 'Lone Scherfig', 'Ingles', 'cine romantico ', 4, 'img/task/6713cb110fc19.jpg'),
(9, 'Scary Movie', '2000-10-26', 'Kennen ivory Wayans', 'Ingles', 'Comedia,terror', 4, 'img/task/6713cb310d050.jpg'),
(29, 'Scary Movie', '2000-10-26', 'Kennen ivory Wayans', 'Ingles', 'Comedia', 4, NULL),
(30, 'Buscando a Nemo ', '2003-05-30', 'Andrew Stanton', 'Ingles', 'Animacion infantil', 18, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productoras`
--

CREATE TABLE `productoras` (
  `id_productora` int(11) NOT NULL,
  `nombre_productora` varchar(50) NOT NULL,
  `año_fundacion` date NOT NULL,
  `fundador_es` varchar(100) NOT NULL,
  `pais_origen` varchar(50) NOT NULL,
  `imagen_productora` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productoras`
--

INSERT INTO `productoras` (`id_productora`, `nombre_productora`, `año_fundacion`, `fundador_es`, `pais_origen`, `imagen_productora`) VALUES
(3, '20th century studios', '1935-05-31', 'Joseph M. Schenck, Darryl F. Zanuck', 'Estados Unidos', 'img/task/6713cc9d33bad.jpg'),
(4, 'MiraMax', '1979-02-13', 'Harvey Weinstein, Bob Weinstein', 'Estados Unidos', 'img/task/6713cca6a7f1c.jpg'),
(5, 'Warner Bros', '1923-04-04', ' Sam Warner, Jack Warner, Harry Warner, Albert Warner', 'Estados Unidos', 'img/task/6713ccafeb47d.jpg'),
(18, 'pixar', '1986-02-03', 'Steve Jobs, John Lasseter, George Lucas, Edwin Catmull, Alvy Ray Smith, Alexandre Schure', 'Estados Unidos', '\r\nimg/task/6713cc86a3e06.jpg'),
(20, 'blabla bla', '1935-05-31', 'Joseph M. Schenck, Darryl F. Zanuck', 'Estados unidos', NULL),
(21, '20th century studios', '1935-05-31', 'Joseph M. Schenck, Darryl F. Zanuck', 'Estados Unidos', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reseña`
--

CREATE TABLE `reseña` (
  `id_reseña` int(11) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `opinion` text NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `id_pelicula` int(11) NOT NULL,
  `fecha_publicado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reseña`
--

INSERT INTO `reseña` (`id_reseña`, `usuario`, `opinion`, `puntuacion`, `id_pelicula`, `fecha_publicado`) VALUES
(1, '', 'la pelicula no es de terror pero si que causa mucha gracia ', 8, 9, '2024-11-16'),
(2, '', 'wegvrwehstbgthw', 3, 1, '2024-11-15'),
(3, '', 'scqerqwefqefqawef', 9, 2, '2024-11-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `password`) VALUES
(1, 'usuario@gmail.com', '$2y$10$Psf9MsKXoMCnN9pzAZF4eu8Clqm4jUYP9fYJbXJaPpzXRz2Yqt1g.'),
(3, 'webadmin@gmail.com', '$2y$10$1Hss2VmTtwNZzC8o/ByDOO44KBG7scaKV99a8Wwu/V36gTb1ZSlvy');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id_peliculas`),
  ADD KEY `id_productoras` (`id_productora`);

--
-- Indices de la tabla `productoras`
--
ALTER TABLE `productoras`
  ADD PRIMARY KEY (`id_productora`);

--
-- Indices de la tabla `reseña`
--
ALTER TABLE `reseña`
  ADD PRIMARY KEY (`id_reseña`),
  ADD UNIQUE KEY `id_pelicula` (`id_pelicula`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id_peliculas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `productoras`
--
ALTER TABLE `productoras`
  MODIFY `id_productora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `reseña`
--
ALTER TABLE `reseña`
  MODIFY `id_reseña` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `peliculas_ibfk_1` FOREIGN KEY (`id_productora`) REFERENCES `productoras` (`id_productora`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `reseña`
--
ALTER TABLE `reseña`
  ADD CONSTRAINT `reseña_ibfk_1` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_peliculas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
