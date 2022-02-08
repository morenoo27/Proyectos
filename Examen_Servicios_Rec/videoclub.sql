-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2018 a las 18:11:26
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `videoclub`
--

CREATE DATABASE `videoclub`;
USE `videoclub`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `idPelicula` int(11) NOT NULL,
  `titulo` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `director` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `sinopsis` text COLLATE utf8_spanish2_ci NOT NULL,
  `tematica` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `caratula` varchar(30) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'no_foto.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`idPelicula`, `titulo`, `director`, `sinopsis`, `tematica`, `caratula`) VALUES
(1, 'Gran Torino', 'Clint Easwood', 'Walt Kowalski (Clint Eastwood) es un anciano veterano de la guerra de Corea, jubilado y que acaba de enviudar. Walt vive solo con su perra Daisy en Highland Park (Míchigan) un barrio antes poblado por familias blancas y trabajadoras, pero "invadido" en los últimos años por inmigrantes de procedencia asiática (comunidad hmong), lo cual desagrada enormemente a Walt que se muestra frío y malhumorado con sus nuevos vecinos. Sin embargo, todo cambia cuando descubre a un joven hmong llamado Thao Vang Lor (Bee Vang) intentando robar su Gran Torino para poder pertenecer a una banda callejera y que tanto él como su hermana Sue (Ahney Her) están siendo presionados por la misma. Sorprendiéndose a sí mismo, decidirá ayudar a los dos jóvenes.', 'Drama', 'img1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `DNI` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(15) NOT NULL,
  `email` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`DNI`, `usuario`, `clave`, `telefono`, `email`) VALUES
('27347173N', 'usuario1', 'e10adc3949ba59abbe56e057f20f883e', 952869740, 'khsd@klsjdf.es');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`idPelicula`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`DNI`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `idPelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
