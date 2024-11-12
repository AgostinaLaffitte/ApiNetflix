-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2024 a las 00:41:53
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
(7, 'Duro de matar 1', '1988-12-15', 'John MCTiernan', 'Ingles', 'Accion', 1, 'img/task/6713cb22874a9.jpg'),
(9, 'Scary Movie', '2000-10-26', 'Kennen ivory Wayans', 'Ingles', 'Comedia', 5, 'img/task/6713cb310d050.jpg'),
(17, 'harry potter', '2001-11-29', 'Chris Columbus', 'Ingles', 'Fantasia', 5, 'img/task/6713cb40dd2da.jpg');

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
  `imagen_productora` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productoras`
--

INSERT INTO `productoras` (`id_productora`, `nombre_productora`, `año_fundacion`, `fundador_es`, `pais_origen`, `imagen_productora`) VALUES
(1, 'juan pedroo', '0000-00-00', 'hihihihihi', 'rusia', 'img/task/67150fbdadca0.jpg'),
(3, '20th century studios', '1935-05-31', 'Joseph M. Schenck, Darryl F. Zanuck', 'Estados Unidos', 'img/task/6713cc9d33bad.jpg'),
(4, 'MiraMax', '1979-02-13', 'Harvey Weinstein, Bob Weinstein', 'Estados Unidos', 'img/task/6713cca6a7f1c.jpg'),
(5, 'Warner Bros', '1923-04-04', ' Sam Warner, Jack Warner, Harry Warner, Albert Warner', 'Estados Unidos', 'img/task/6713ccafeb47d.jpg'),
(18, 'pixar', '1986-02-03', 'Steve Jobs, John Lasseter, George Lucas, Edwin Catmull, Alvy Ray Smith, Alexandre Schure', 'Estados Unidos', '\r\nimg/task/6713cc86a3e06.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
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
  MODIFY `id_peliculas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `productoras`
--
ALTER TABLE `productoras`
  MODIFY `id_productora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
