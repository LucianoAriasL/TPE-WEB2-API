-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2022 a las 23:36:15
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_de_zapatillas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_de_zapatillas`
--

CREATE TABLE `categoria_de_zapatillas` (
  `id_CategoriaDeZapatillas` int(11) NOT NULL,
  `categoria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria_de_zapatillas`
--

INSERT INTO `categoria_de_zapatillas` (`id_CategoriaDeZapatillas`, `categoria`) VALUES
(1, 'Principiante'),
(2, 'Experimentado'),
(3, 'Semi-maratonista'),
(4, 'Maratonista'),
(7, 'Trail'),
(8, 'Aficionado'),
(11, 'Profesional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `contraseña` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contraseña`) VALUES
(1, 'Luciano', '$2y$10$fj52BgeQuGi9ymJ.oWe16ebkMgO9h9r6CyEZgGlfxCJ29twqDQlBm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zapatillas`
--

CREATE TABLE `zapatillas` (
  `id_zapatilla` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `id_CategoriaDeZapatillas_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `zapatillas`
--

INSERT INTO `zapatillas` (`id_zapatilla`, `nombre`, `marca`, `precio`, `descripcion`, `id_CategoriaDeZapatillas_fk`) VALUES
(3, 'Adidas Runfalcon 2.0', 'Adidas', 19000, 'Ideales para personas que se estan iniciando en el mundo del running, comodidad en todo momento', 1),
(5, 'Fila Float Knit', 'Fila', 29990, 'Indicada para entrenamientos de larga distancia', 11),
(6, 'Nike Zoom', 'Nike', 35490, 'Ideales para correr mas ligero y rapido', 4),
(7, 'Asics GEL-NIM-BUS 22', 'Asics', 48990, 'Corre mas comodo las largas distancias', 4),
(8, 'Adidas EQ21', 'Adidas', 25999, 'Ideales para aficionados al running', 8),
(9, 'Adidas Ultraboost 5.0', 'Adidas', 53099, 'Corre tus media maraton con la mejor comodidad', 3),
(10, 'Under Armour HOVR Sonic 3', 'Under Armour', 23477, 'Ideales para sierra', 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_de_zapatillas`
--
ALTER TABLE `categoria_de_zapatillas`
  ADD PRIMARY KEY (`id_CategoriaDeZapatillas`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `zapatillas`
--
ALTER TABLE `zapatillas`
  ADD PRIMARY KEY (`id_zapatilla`),
  ADD KEY `id_restricted` (`id_CategoriaDeZapatillas_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_de_zapatillas`
--
ALTER TABLE `categoria_de_zapatillas`
  MODIFY `id_CategoriaDeZapatillas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `zapatillas`
--
ALTER TABLE `zapatillas`
  MODIFY `id_zapatilla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `zapatillas`
--
ALTER TABLE `zapatillas`
  ADD CONSTRAINT `id_restricted` FOREIGN KEY (`id_CategoriaDeZapatillas_fk`) REFERENCES `categoria_de_zapatillas` (`id_CategoriaDeZapatillas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
