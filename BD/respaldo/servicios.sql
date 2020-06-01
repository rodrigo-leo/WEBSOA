-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2020 a las 12:14:50
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `servicios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_Carrito` int(6) NOT NULL,
  `id_user` int(6) NOT NULL,
  `id_servicio` int(6) NOT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_Cliente` int(6) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `numero_Tel` int(10) NOT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_Cliente`, `nombre`, `correo`, `clave`, `numero_Tel`, `estado`) VALUES
(1, 'palomo', 'jonathancggs@gmail.com', 'P@lomo53', 2147483647, 'disponible'),
(2, 'rodrigo', 'rodrigoiggtz@gmail.com', 'Celta_sarter12', 2147483647, 'disponible'),
(3, 'sandra', 'sandra@gmail.com', 'Celta_sarter12', 2147483647, 'disponible'),
(4, 'pedro', 'pedro@gmail.com', 'Celta_sarter12', 2147483647, 'disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_Servicio` int(6) NOT NULL,
  `codigo` int(6) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` varchar(12) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `descripción` varchar(100) NOT NULL,
  `imagen` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_Servicio`, `codigo`, `nombre`, `precio`, `estado`, `descripción`, `imagen`) VALUES
(1, 123456, 'paquete 1 gb/s', '1500', 'disponible', 'servicio 1', 0x433a2f78616d70702f6874646f63732f64617368626f6172642f6974714e65742f7265736f75726365732f696d6167656e65732f6e6f2d706963747572652d74616b696e672e706e67),
(2, 789102, 'paquete 2 gb/s', '1800', 'disponible', 'servicio 2', 0x433a2f78616d70702f6874646f63732f64617368626f6172642f6974714e65742f7265736f75726365732f696d6167656e65732f6e6f2d706963747572652d74616b696e672e706e67),
(3, 843106, 'paquete 3 gb/s', '2500', 'disponible', 'servicio 2', 0x433a2f78616d70702f6874646f63732f64617368626f6172642f6974714e65742f7265736f75726365732f696d6167656e65732f6e6f2d706963747572652d74616b696e672e706e67);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_Carrito`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_Cliente`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_Servicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_Carrito` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_Cliente` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_Servicio` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
