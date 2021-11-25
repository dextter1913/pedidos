-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2021 a las 13:08:25
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10
CREATE DATABASE IF NOT EXISTS cursophp;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cursophp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblclientes`
--

CREATE TABLE `tblclientes` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `estado` int(1) NOT NULL COMMENT '1=activo; 2=inactivo',
  `telefono` varchar(20) NOT NULL,
  `fecharegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechamodificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='almacenador los clientes';

--
-- Volcado de datos para la tabla `tblclientes`
--

INSERT INTO `tblclientes` (`id`, `nombre`, `correo`, `direccion`, `estado`, `telefono`, `fecharegistro`, `fechamodificacion`) VALUES
(1, 'juan destino m', 'juanff@gmail.com', 'juanff@gmail.com', 1, '2526532', '2021-11-14 13:07:01', '2021-11-14 13:07:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblpedidosd`
--

CREATE TABLE `tblpedidosd` (
  `id` bigint(20) NOT NULL,
  `pedido` bigint(20) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `cantidad` int(4) NOT NULL,
  `preciounitario` double NOT NULL,
  `subtotal` double NOT NULL,
  `subtotaliva` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='almacena el detalle del pedido';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblpedidose`
--

CREATE TABLE `tblpedidose` (
  `id` bigint(20) NOT NULL,
  `nombrecliente` varchar(100) NOT NULL,
  `telefonocliente` varchar(20) NOT NULL,
  `direccioncliente` varchar(150) NOT NULL,
  `identificacioncliente` bigint(20) NOT NULL,
  `totalunidades` int(4) NOT NULL,
  `subtotal` double NOT NULL,
  `subtotaliva` double NOT NULL,
  `totalvalor` double NOT NULL,
  `fecharegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='almacena encabezado pedido';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblproductos`
--

CREATE TABLE `tblproductos` (
  `id` bigint(20) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `valorbase` double NOT NULL,
  `iva` int(2) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `estado` int(1) NOT NULL,
  `usuario` bigint(20) NOT NULL,
  `fecharegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechamodificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='almacena los productos';

--
-- Volcado de datos para la tabla `tblproductos`
--

INSERT INTO `tblproductos` (`id`, `referencia`, `nombre`, `valorbase`, `iva`, `descripcion`, `imagen`, `estado`, `usuario`, `fecharegistro`, `fechamodificacion`) VALUES
(1, '0001', 'm', 250000, 10, 'mmmmm ddfdd', '20211117020857LOGO AVE.png', 1, 0, '2021-11-15 00:35:59', '2021-11-17 01:08:57'),
(3, 'ref444556', 'nombreprod', 222222, 16, '222222', '', 1, 0, '2021-11-17 01:15:55', '2021-11-17 01:15:55'),
(4, 'ffgthh', '666633', 6666, 666, '5555', '20211117021615LOGO OLA SAS.pdf', 1, 0, '2021-11-17 01:16:15', '2021-11-17 01:16:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuarios`
--

CREATE TABLE `tblusuarios` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `estado` int(1) NOT NULL COMMENT '1=activo; 2=inactivo',
  `telefono` varchar(20) NOT NULL,
  `fecharegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechamodificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='almacenador de los usuarios';

--
-- Volcado de datos para la tabla `tblusuarios`
--

INSERT INTO `tblusuarios` (`id`, `nombre`, `correo`, `clave`, `estado`, `telefono`, `fecharegistro`, `fechamodificacion`) VALUES
(1, 'JUAN FERNANDO FERNANDEZ ALVA¿REZ', 'juanff@gmail.com', '$2y$10$rK/5go8DXu/bx.hMcyMHAO5lcfGNkI0550lOPH9UOrsS2qxikjMB6', 1, '3102027163', '2021-11-04 00:39:44', '2021-11-14 12:56:51'),
(25, 'nombrew 2', 'juanff1@gmail.com', '$2y$10$s6QlJYPsNM6dr8MWjejTSestCtR4qQHO2syR5nROtLBFYkItkBQKq', 1, '2520000', '2021-11-10 23:51:11', '2021-11-10 23:51:11'),
(26, 'nombre 4', 'juanff3@gmail.com', '$2y$10$aMSNid3BWeFG.hG1oR5SW.M74616A6jTj4zGXbHd61kzEP0Ec6enm', 1, '5620000', '2021-11-10 23:51:20', '2021-11-10 23:51:20'),
(27, 'nombre 6', 'juanff6@gmail.com', '$2y$10$5R7h71I7VVYA.QPeJZ4SzurLRKnu4Wyb3NgQ/U.O8sbhBdKZkZfYO', 1, '6520000', '2021-11-10 23:51:30', '2021-11-10 23:51:30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblclientes`
--
ALTER TABLE `tblclientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `claveunicausuario` (`correo`),
  ADD KEY `bucarpor_correo_estado` (`correo`,`estado`);

--
-- Indices de la tabla `tblpedidosd`
--
ALTER TABLE `tblpedidosd`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tblpedidose`
--
ALTER TABLE `tblpedidose`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tblproductos`
--
ALTER TABLE `tblproductos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ref_unica` (`referencia`);

--
-- Indices de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `claveunicausuario` (`correo`),
  ADD KEY `bucarpor_correo_estado` (`correo`,`estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblclientes`
--
ALTER TABLE `tblclientes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tblpedidosd`
--
ALTER TABLE `tblpedidosd`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblpedidose`
--
ALTER TABLE `tblpedidose`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblproductos`
--
ALTER TABLE `tblproductos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
