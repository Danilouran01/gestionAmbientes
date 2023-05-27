-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2023 a las 03:39:16
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_ambientes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambientes`
--

CREATE TABLE `ambientes` (
  `id_numero_ambiente` int(15) NOT NULL,
  `piso` varchar(50) NOT NULL,
  `linea_formacion` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `cantidad_sillas` int(3) NOT NULL,
  `mesas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ambientes`
--

INSERT INTO `ambientes` (`id_numero_ambiente`, `piso`, `linea_formacion`, `estado`, `cantidad_sillas`, `mesas`) VALUES
(201, '2', 1, 1, 39, 3),
(300, '3', 2, 1, 23, 4),
(401, '4', 3, 1, 34, 5),
(406, '4', 4, 1, 45, 32),
(503, '5', 5, 1, 5, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambiente_elemento`
--

CREATE TABLE `ambiente_elemento` (
  `id_ambiente_elemento` int(11) NOT NULL,
  `id_numero_ambiente` int(15) NOT NULL,
  `id_elemento_estatico` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_elemento`
--

CREATE TABLE `categoria_elemento` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_elemento`
--

INSERT INTO `categoria_elemento` (`id_categoria`, `nombre_categoria`) VALUES
(1, 'Portatil'),
(2, 'Equipo de mesa'),
(3, 'Tablero'),
(4, 'Pantalla'),
(5, 'Televisor'),
(6, 'Monitor'),
(7, 'Cables');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_prestamo`
--

CREATE TABLE `detalle_prestamo` (
  `detalle_prestamo` int(15) NOT NULL,
  `cantidad` varchar(5) DEFAULT NULL,
  `id_prestamo` int(11) NOT NULL,
  `serial` varchar(35) NOT NULL,
  `cargador` varchar(2) NOT NULL,
  `mouse` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementos`
--

CREATE TABLE `elementos` (
  `serial` varchar(35) NOT NULL,
  `tipo_dispositivo` int(11) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `placa` varchar(50) DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `elementos`
--

INSERT INTO `elementos` (`serial`, `tipo_dispositivo`, `marca`, `modelo`, `placa`, `estado`) VALUES
('a9FGH05', 6, 'NULL', 'NULL', 'NULL', 1),
('AHD04', 5, 'NULL', 'NULL', 'NULL', 1),
('B901', 1, 'hp', 'CDF3456-ls', '290', 1),
('BC902', 2, 'sony', 'NULL', 'NULL', 1),
('DFG903', 4, 'VGA', ' DDC2', 'NULL', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementos_estaticos_ambiente`
--

CREATE TABLE `elementos_estaticos_ambiente` (
  `id_elemento_estatico` varchar(30) NOT NULL,
  `categoria_elemento` int(11) NOT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `placa` varchar(10) DEFAULT NULL,
  `estado` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `elementos_estaticos_ambiente`
--

INSERT INTO `elementos_estaticos_ambiente` (`id_elemento_estatico`, `categoria_elemento`, `marca`, `modelo`, `placa`, `estado`) VALUES
('901', 1, 'hp', 'bls-0064l', '597', 1),
('902', 2, 'mac', 'a1989', '596', 1),
('903', 5, 'hp', '34rs', 'NULL', 1),
('904', 3, 'NULL', 'NULL', 'NULL', 1),
('905', 1, 'hp', 'bsx-1567', '890', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_ambiente`
--

CREATE TABLE `estado_ambiente` (
  `id_estado_ambiente` int(11) NOT NULL,
  `estado_ambiente` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_ambiente`
--

INSERT INTO `estado_ambiente` (`id_estado_ambiente`, `estado_ambiente`) VALUES
(1, 'disponible'),
(2, 'ocupado'),
(3, 'mantenimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_elementos`
--

CREATE TABLE `estado_elementos` (
  `id_estado_elemento` int(11) NOT NULL,
  `estado_elemento` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_elementos`
--

INSERT INTO `estado_elementos` (`id_estado_elemento`, `estado_elemento`) VALUES
(1, 'disponible'),
(2, 'ocupado'),
(3, 'Mantenimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_elemento_estatico`
--

CREATE TABLE `estado_elemento_estatico` (
  `id_estado_estatico` int(15) NOT NULL,
  `nombre_estado_estatico` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_elemento_estatico`
--

INSERT INTO `estado_elemento_estatico` (`id_estado_estatico`, `nombre_estado_estatico`) VALUES
(1, 'Disponible'),
(2, 'Ocupado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_formacion`
--

CREATE TABLE `linea_formacion` (
  `id_linea` int(11) NOT NULL,
  `nombre_linea` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `linea_formacion`
--

INSERT INTO `linea_formacion` (`id_linea`, `nombre_linea`) VALUES
(1, 'ADSI - ADSO'),
(2, 'Gafime'),
(3, 'Multimedia'),
(4, 'Transversales'),
(5, 'Logistica y produccion'),
(6, 'SST');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones_ambientes`
--

CREATE TABLE `observaciones_ambientes` (
  `id_observacion` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `fecha_observacion` date NOT NULL,
  `hora_observacion` time NOT NULL,
  `id_numero_ambiente` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `id_prestamo` int(11) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `hora_prestamo` time NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `id_numero_ambiente` int(15) DEFAULT NULL,
  `numero_documento` int(15) NOT NULL,
  `estado_prestamo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`id_prestamo`, `fecha_prestamo`, `hora_prestamo`, `fecha_entrega`, `hora_entrega`, `observaciones`, `id_numero_ambiente`, `numero_documento`, `estado_prestamo`) VALUES
(53, '2023-04-17', '08:43:37', '2023-04-17', '08:43:58', NULL, NULL, 212121, 'inactivo'),
(74, '2023-04-22', '01:15:30', '2023-04-22', '01:18:04', NULL, NULL, 212121, 'inactivo'),
(75, '2023-04-22', '01:16:10', '2023-04-22', '01:16:29', NULL, NULL, 212121, 'inactivo'),
(76, '2023-04-22', '01:30:15', NULL, NULL, NULL, NULL, 212121, 'activo'),
(77, '2023-04-22', '01:30:32', '2023-04-22', '01:31:07', NULL, NULL, 212121, 'inactivo'),
(78, '2023-04-22', '01:34:59', '2023-04-24', '02:27:28', NULL, NULL, 212121, 'inactivo'),
(81, '2023-04-24', '07:28:36', '2023-04-24', '02:51:01', NULL, NULL, 212121, 'inactivo'),
(85, '2023-04-24', '09:46:13', NULL, NULL, NULL, NULL, 212121, 'activo'),
(86, '2023-04-24', '03:40:50', NULL, NULL, NULL, NULL, 212121, 'activo'),
(87, '2023-04-24', '03:41:11', NULL, NULL, NULL, NULL, 212121, 'activo'),
(88, '2023-04-24', '03:42:21', '2023-04-24', '11:06:18', NULL, NULL, 212121, 'inactivo'),
(93, '2023-04-24', '04:34:20', '2023-04-24', '11:40:04', NULL, NULL, 212121, 'inactivo'),
(94, '2023-04-24', '04:40:59', '2023-04-25', '12:24:02', NULL, NULL, 212121, 'inactivo'),
(95, '2023-04-24', '05:24:34', '2023-04-25', '12:24:51', NULL, NULL, 212121, 'inactivo'),
(96, '2023-04-24', '05:25:27', NULL, NULL, NULL, NULL, 212121, 'activo'),
(97, '2023-04-24', '05:25:58', '2023-04-25', '12:26:30', NULL, NULL, 212121, 'inactivo'),
(98, '2023-04-24', '06:58:48', '2023-04-25', '01:59:01', NULL, NULL, 212121, 'inactivo'),
(99, '2023-04-25', '08:42:36', '2023-04-25', '03:42:53', NULL, NULL, 212121, 'inactivo'),
(100, '2023-04-25', '08:48:22', '2023-04-25', '03:49:16', NULL, NULL, 212121, 'inactivo'),
(101, '2023-04-25', '08:49:30', '2023-04-25', '03:49:52', NULL, NULL, 212121, 'inactivo'),
(102, '2023-04-25', '09:41:12', '2023-04-25', '04:55:38', 'observacion de prueba', NULL, 212121, 'inactivo'),
(103, '2023-04-25', '10:12:09', '2023-04-25', '05:23:14', NULL, NULL, 212121, 'inactivo'),
(106, '2023-04-25', '10:23:24', '2023-04-28', '09:40:48', NULL, NULL, 212121, 'inactivo'),
(107, '2023-04-28', '04:14:38', '2023-04-28', '11:33:55', NULL, NULL, 212121, 'inactivo'),
(108, '2023-04-28', '05:28:36', '2023-04-29', '12:28:46', NULL, NULL, 212121, 'inactivo'),
(109, '2023-05-01', '12:07:14', '2023-05-01', '07:07:57', NULL, NULL, 212121, 'inactivo'),
(111, '2023-05-01', '12:36:05', '2023-05-01', '07:41:04', NULL, NULL, 212121, 'inactivo'),
(112, '2023-05-01', '12:41:36', '2023-05-01', '07:42:39', NULL, NULL, 212121, 'inactivo'),
(113, '2023-05-01', '12:42:53', '2023-05-01', '07:43:08', NULL, NULL, 212121, 'inactivo'),
(114, '2023-05-01', '12:45:54', NULL, NULL, 'observación prueba\r\n', NULL, 212121, 'activo'),
(115, '2023-05-04', '04:26:55', '2023-05-08', '06:03:17', NULL, NULL, 212121, 'inactivo'),
(116, '2023-05-08', '11:03:49', NULL, NULL, NULL, NULL, 212121, 'activo'),
(117, '2023-05-09', '02:45:42', '2023-05-09', '09:46:19', NULL, NULL, 212121, 'inactivo'),
(121, '2023-05-10', '09:02:57', NULL, NULL, NULL, NULL, 212121, 'activo'),
(122, '2023-05-10', '09:03:17', '2023-05-12', '08:08:24', 'hola hola', NULL, 212121, 'inactivo'),
(123, '2023-05-12', '01:11:25', '2023-05-12', '08:22:28', NULL, NULL, 212121, 'inactivo'),
(125, '2023-05-12', '01:25:55', NULL, NULL, 'hola a,,s ,mka', NULL, 212121, 'activo'),
(129, '2023-05-16', '07:56:24', NULL, NULL, NULL, NULL, 123456, 'activo'),
(131, '2023-05-16', '08:35:06', NULL, NULL, 'hola', NULL, 212121, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resetpasswords`
--

CREATE TABLE `resetpasswords` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resetpasswords`
--

INSERT INTO `resetpasswords` (`id`, `code`, `email`) VALUES
(1, '163fcd214b489e', 'kevinrasanchez31@gmail.com'),
(2, '163fcd3cc70868', 'kevinrasanchez31@gmail.com'),
(3, '163fcd8bd93ba0', 'kevinrasanchez31@gmail.com'),
(5, '1646272e17a1d2', 'kevinrasanchez31@gmail.com'),
(6, '16467d1c65c873', 'alvarezajairo@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(15) NOT NULL,
  `nombre_rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Instructor'),
(3, 'Invitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_dispositivo`
--

CREATE TABLE `tipo_dispositivo` (
  `id_tipo_dispositivo` int(11) NOT NULL,
  `tipo_dispositivo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_dispositivo`
--

INSERT INTO `tipo_dispositivo` (`id_tipo_dispositivo`, `tipo_dispositivo`) VALUES
(1, 'Portatil'),
(2, 'Microfono'),
(3, 'Video beam'),
(4, 'Cable VGA'),
(5, 'Cable HDMI'),
(6, 'Extensión ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `idDocumento` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`idDocumento`, `tipo`) VALUES
(1, 'Cédula de ciudadanía'),
(2, 'Cédula de extranjería'),
(3, 'Tarjeta de identidad'),
(4, 'Permiso especial de permanencia '),
(5, 'Permiso por protección  temporal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `numero_documento` int(15) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `tipo_documento` int(11) NOT NULL,
  `numero_ficha` int(50) DEFAULT NULL,
  `centro` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `id_rol` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`numero_documento`, `nombre`, `apellido`, `tipo_documento`, `numero_ficha`, `centro`, `telefono`, `correo`, `contrasena`, `id_rol`) VALUES
(1, '1', '1', 1, NULL, 'NULL', '1', '1@correo.com', NULL, 2),
(2, '2', '3', 1, NULL, NULL, '34234', 'ceo22@correo.com', NULL, 2),
(3, '31', 'ura', 1, NULL, NULL, '124324234', 'alvarezajairo@gmail.com', NULL, 2),
(556, 'andrea', 'ja', 1, NULL, NULL, '321213212', 'alvarezajairo@gmail.com', NULL, 2),
(123456, 'luis a', 'archila admin', 2, NULL, NULL, '33212', 'alvarezajairo@gmail.com', '123456', 1),
(212121, 'jairo', 'alvarez', 1, NULL, NULL, '343223234', 'mau@correo.com', NULL, 2),
(43727899, 'Andres', 'Velez', 3, NULL, 'NULL', '3105673452', 'andresvelez@gmail.com', NULL, 3),
(71054456, 'Giovanni', 'Hernandez', 2, NULL, 'NULL', '3145634231', 'hernandez@sena.edu.co', NULL, 2),
(1007568345, 'Maria', 'Urrego', 1, NULL, 'NULL', '3216783456', 'urregou45@misena.edu.co', NULL, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ambientes`
--
ALTER TABLE `ambientes`
  ADD PRIMARY KEY (`id_numero_ambiente`),
  ADD KEY `estado` (`estado`),
  ADD KEY `linea_formacion` (`linea_formacion`);

--
-- Indices de la tabla `ambiente_elemento`
--
ALTER TABLE `ambiente_elemento`
  ADD PRIMARY KEY (`id_ambiente_elemento`),
  ADD KEY `id_ambiente` (`id_numero_ambiente`),
  ADD KEY `id_elemento_estatico` (`id_elemento_estatico`);

--
-- Indices de la tabla `categoria_elemento`
--
ALTER TABLE `categoria_elemento`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detalle_prestamo`
--
ALTER TABLE `detalle_prestamo`
  ADD PRIMARY KEY (`detalle_prestamo`),
  ADD KEY `id_elemento` (`serial`),
  ADD KEY `id_prestamo` (`id_prestamo`);

--
-- Indices de la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD PRIMARY KEY (`serial`),
  ADD KEY `estado` (`estado`),
  ADD KEY `tipo_dispositivo` (`tipo_dispositivo`);

--
-- Indices de la tabla `elementos_estaticos_ambiente`
--
ALTER TABLE `elementos_estaticos_ambiente`
  ADD PRIMARY KEY (`id_elemento_estatico`),
  ADD KEY `categoria_elemento` (`categoria_elemento`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `estado_ambiente`
--
ALTER TABLE `estado_ambiente`
  ADD PRIMARY KEY (`id_estado_ambiente`);

--
-- Indices de la tabla `estado_elementos`
--
ALTER TABLE `estado_elementos`
  ADD PRIMARY KEY (`id_estado_elemento`);

--
-- Indices de la tabla `estado_elemento_estatico`
--
ALTER TABLE `estado_elemento_estatico`
  ADD PRIMARY KEY (`id_estado_estatico`);

--
-- Indices de la tabla `linea_formacion`
--
ALTER TABLE `linea_formacion`
  ADD PRIMARY KEY (`id_linea`);

--
-- Indices de la tabla `observaciones_ambientes`
--
ALTER TABLE `observaciones_ambientes`
  ADD PRIMARY KEY (`id_observacion`),
  ADD KEY `id_numero_ambiente` (`id_numero_ambiente`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `id_ambientes` (`id_numero_ambiente`),
  ADD KEY `id_usuarios` (`numero_documento`);

--
-- Indices de la tabla `resetpasswords`
--
ALTER TABLE `resetpasswords`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipo_dispositivo`
--
ALTER TABLE `tipo_dispositivo`
  ADD PRIMARY KEY (`id_tipo_dispositivo`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`idDocumento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`numero_documento`),
  ADD UNIQUE KEY `telefono` (`telefono`,`correo`),
  ADD UNIQUE KEY `telefono_2` (`telefono`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `tipo_documento` (`tipo_documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ambiente_elemento`
--
ALTER TABLE `ambiente_elemento`
  MODIFY `id_ambiente_elemento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT de la tabla `categoria_elemento`
--
ALTER TABLE `categoria_elemento`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_prestamo`
--
ALTER TABLE `detalle_prestamo`
  MODIFY `detalle_prestamo` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de la tabla `estado_ambiente`
--
ALTER TABLE `estado_ambiente`
  MODIFY `id_estado_ambiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estado_elementos`
--
ALTER TABLE `estado_elementos`
  MODIFY `id_estado_elemento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado_elemento_estatico`
--
ALTER TABLE `estado_elemento_estatico`
  MODIFY `id_estado_estatico` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `linea_formacion`
--
ALTER TABLE `linea_formacion`
  MODIFY `id_linea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `observaciones_ambientes`
--
ALTER TABLE `observaciones_ambientes`
  MODIFY `id_observacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT de la tabla `resetpasswords`
--
ALTER TABLE `resetpasswords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_dispositivo`
--
ALTER TABLE `tipo_dispositivo`
  MODIFY `id_tipo_dispositivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `numero_documento` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008675349;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ambientes`
--
ALTER TABLE `ambientes`
  ADD CONSTRAINT `ambientes_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estado_ambiente` (`id_estado_ambiente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ambientes_ibfk_2` FOREIGN KEY (`linea_formacion`) REFERENCES `linea_formacion` (`id_linea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ambiente_elemento`
--
ALTER TABLE `ambiente_elemento`
  ADD CONSTRAINT `ambiente_elemento_ibfk_1` FOREIGN KEY (`id_numero_ambiente`) REFERENCES `ambientes` (`id_numero_ambiente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ambiente_elemento_ibfk_2` FOREIGN KEY (`id_elemento_estatico`) REFERENCES `elementos_estaticos_ambiente` (`id_elemento_estatico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_prestamo`
--
ALTER TABLE `detalle_prestamo`
  ADD CONSTRAINT `detalle_prestamo_ibfk_3` FOREIGN KEY (`id_prestamo`) REFERENCES `prestamo` (`id_prestamo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_prestamo_ibfk_4` FOREIGN KEY (`serial`) REFERENCES `elementos` (`serial`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD CONSTRAINT `elementos_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estado_elementos` (`id_estado_elemento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `elementos_ibfk_2` FOREIGN KEY (`tipo_dispositivo`) REFERENCES `tipo_dispositivo` (`id_tipo_dispositivo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `elementos_estaticos_ambiente`
--
ALTER TABLE `elementos_estaticos_ambiente`
  ADD CONSTRAINT `elementos_estaticos_ambiente_ibfk_1` FOREIGN KEY (`categoria_elemento`) REFERENCES `categoria_elemento` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `elementos_estaticos_ambiente_ibfk_2` FOREIGN KEY (`estado`) REFERENCES `estado_elemento_estatico` (`id_estado_estatico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `observaciones_ambientes`
--
ALTER TABLE `observaciones_ambientes`
  ADD CONSTRAINT `observaciones_ambientes_ibfk_1` FOREIGN KEY (`id_numero_ambiente`) REFERENCES `ambientes` (`id_numero_ambiente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`id_numero_ambiente`) REFERENCES `ambientes` (`id_numero_ambiente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`numero_documento`) REFERENCES `usuario` (`numero_documento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`tipo_documento`) REFERENCES `tipo_documento` (`idDocumento`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
