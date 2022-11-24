-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2022 a las 18:56:30
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hms`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambio`
--

CREATE TABLE `cambio` (
  `id_cambio` int(10) NOT NULL,
  `cambio` varchar(90) NOT NULL,
  `tiempoCambio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cambio`
--

INSERT INTO `cambio` (`id_cambio`, `cambio`, `tiempoCambio`) VALUES
(1, 'Mañana', '5:00 AM - 10:00 AM'),
(2, 'Día', '10:00 AM - 4:00 PM'),
(3, 'Tarde', '4:00 PM - 10:00 PM'),
(4, 'Noche', '10:00 PM - 5:00 AM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `contacto` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_tipodocumento` int(10) NOT NULL,
  `n_tarjeta` varchar(20) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `contacto`, `email`, `id_tipodocumento`, `n_tarjeta`, `direccion`) VALUES
(10, 'Brian Lazo', 111111111111, 'admin@univo', 1, '0000070-6', 'La Unión'),
(11, 'Michelle Panameño', 79448955, 'michelle@gmail', 3, 'AO4444455', 'San Miguel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `id_habitacion` int(10) NOT NULL,
  `id_tipohabitacion` int(10) NOT NULL,
  `numeroHabitacion` varchar(10) NOT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `check_in_Estado` tinyint(1) NOT NULL,
  `check_out_Estado` tinyint(1) NOT NULL,
  `EliminarEstado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`id_habitacion`, `id_tipohabitacion`, `numeroHabitacion`, `estado`, `check_in_Estado`, `check_out_Estado`, `EliminarEstado`) VALUES
(1, 1, 'A-1', 1, 0, 0, 0),
(2, 2, 'A-2', 1, 0, 0, 0),
(3, 4, 'A-3', NULL, 0, 0, 0),
(4, 4, 'A-4', NULL, 0, 0, 0),
(5, 5, 'A-5', NULL, 0, 0, 0),
(6, 2, 'A-7', NULL, 0, 0, 1),
(7, 4, 'A-6', NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historiaempleado`
--

CREATE TABLE `historiaempleado` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_cambio` int(11) NOT NULL,
  `from_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `to_date` timestamp NULL DEFAULT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historiaempleado`
--

INSERT INTO `historiaempleado` (`id`, `id_empleado`, `id_cambio`, `from_date`, `to_date`, `creado`) VALUES
(22, 14, 1, '2022-11-23 05:52:35', NULL, '2022-11-23 05:52:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_tipopersonal` int(11) NOT NULL,
  `id_cambio` int(11) NOT NULL,
  `id_tipodocumento` int(11) NOT NULL,
  `numeroTarjeta` varchar(25) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `salario` bigint(20) NOT NULL,
  `diaIngreso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `actualizado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_empleado`, `nombre`, `id_tipopersonal`, `id_cambio`, `id_tipodocumento`, `numeroTarjeta`, `direccion`, `telefono`, `salario`, `diaIngreso`, `actualizado`) VALUES
(14, 'Brian Lazo', 3, 1, 1, '000000000', 'La Unión', '794916545', 450, '2022-11-23 05:52:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quejas`
--

CREATE TABLE `quejas` (
  `id` int(11) NOT NULL,
  `nombreQueja` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `tipoQueja` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Queja` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fechaQueja` timestamp NOT NULL DEFAULT current_timestamp(),
  `EstadoResolucion` tinyint(1) NOT NULL,
  `FechaResolucion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `presupuesto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `quejas`
--

INSERT INTO `quejas` (`id`, `nombreQueja`, `tipoQueja`, `Queja`, `fechaQueja`, `EstadoResolucion`, `FechaResolucion`, `presupuesto`) VALUES
(12, 'AC no funciona', 'Funcional', 'Aire acondicionado dejó de funcionar', '2022-11-23 07:34:48', 0, '2022-11-23 07:34:48', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservacion`
--

CREATE TABLE `reservacion` (
  `id_reservacion` int(10) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `id_habitacion` int(10) NOT NULL,
  `fecha_reserva` timestamp NOT NULL DEFAULT current_timestamp(),
  `check_in` varchar(100) DEFAULT NULL,
  `check_out` varchar(100) NOT NULL,
  `precioTotal` int(10) NOT NULL,
  `precioRestante` int(10) NOT NULL,
  `EstadoPago` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservacion`
--

INSERT INTO `reservacion` (`id_reservacion`, `id_cliente`, `id_habitacion`, `fecha_reserva`, `check_in`, `check_out`, `precioTotal`, `precioRestante`, `EstadoPago`) VALUES
(9, 10, 1, '2022-11-23 07:46:37', '25-11-2022', '26-11-2022', 100, 100, 0),
(10, 11, 2, '2022-11-23 07:58:51', '25-11-2022', '26-11-2022', 120, 120, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipohabitacion`
--

CREATE TABLE `tipohabitacion` (
  `id_tipohabitacion` int(10) NOT NULL,
  `tipohabitacion` varchar(100) NOT NULL,
  `precio` int(10) NOT NULL,
  `maximopersona` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipohabitacion`
--

INSERT INTO `tipohabitacion` (`id_tipohabitacion`, `tipohabitacion`, `precio`, `maximopersona`) VALUES
(1, 'Individual', 50, 1),
(2, 'Doble', 60, 2),
(3, 'Triple', 65, 3),
(4, 'Familiar', 70, 4),
(5, 'King', 73, 4),
(6, 'Suite Principal', 110, 6),
(7, 'Mini-Suite', 65, 3),
(8, 'Suite Presidencial', 130, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopersonal`
--

CREATE TABLE `tipopersonal` (
  `id_tipopersonal` int(10) NOT NULL,
  `tipopersonal` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipopersonal`
--

INSERT INTO `tipopersonal` (`id_tipopersonal`, `tipopersonal`) VALUES
(1, 'Manager'),
(2, 'Jefe de Limpieza'),
(3, 'Recepcionista'),
(4, 'Atención al Cuarto'),
(5, 'Concerje'),
(6, 'Matenimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipodocumento` int(10) NOT NULL,
  `tipotarjeta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipodocumento`, `tipotarjeta`) VALUES
(1, 'DUI'),
(2, 'NIT'),
(3, 'Pasaporte'),
(4, 'Licencia de conducir');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `creado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `username`, `email`, `password`, `creado`) VALUES
(1, 'Administrador', 'admin', '@admin', '21232f297a57a5a743894a0e4a801fc3', '2022-10-26 10:54:20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cambio`
--
ALTER TABLE `cambio`
  ADD PRIMARY KEY (`id_cambio`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_tipodocumento` (`id_tipodocumento`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`id_habitacion`) USING BTREE,
  ADD KEY `id_tipohabitacion` (`id_tipohabitacion`);

--
-- Indices de la tabla `historiaempleado`
--
ALTER TABLE `historiaempleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_cambio` (`id_cambio`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `id_tipodocumento` (`id_tipodocumento`),
  ADD KEY `id_cambio` (`id_cambio`),
  ADD KEY `id_tipopersonal` (`id_tipopersonal`);

--
-- Indices de la tabla `quejas`
--
ALTER TABLE `quejas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservacion`
--
ALTER TABLE `reservacion`
  ADD PRIMARY KEY (`id_reservacion`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_habitacion` (`id_habitacion`);

--
-- Indices de la tabla `tipohabitacion`
--
ALTER TABLE `tipohabitacion`
  ADD PRIMARY KEY (`id_tipohabitacion`);

--
-- Indices de la tabla `tipopersonal`
--
ALTER TABLE `tipopersonal`
  ADD PRIMARY KEY (`id_tipopersonal`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipodocumento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cambio`
--
ALTER TABLE `cambio`
  MODIFY `id_cambio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `id_habitacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `historiaempleado`
--
ALTER TABLE `historiaempleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `quejas`
--
ALTER TABLE `quejas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `reservacion`
--
ALTER TABLE `reservacion`
  MODIFY `id_reservacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipohabitacion`
--
ALTER TABLE `tipohabitacion`
  MODIFY `id_tipohabitacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipopersonal`
--
ALTER TABLE `tipopersonal`
  MODIFY `id_tipopersonal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipodocumento` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`id_tipodocumento`) REFERENCES `tipo_documento` (`id_tipodocumento`);

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`id_tipohabitacion`) REFERENCES `tipohabitacion` (`id_tipohabitacion`);

--
-- Filtros para la tabla `historiaempleado`
--
ALTER TABLE `historiaempleado`
  ADD CONSTRAINT `emp_history_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `personal` (`id_empleado`),
  ADD CONSTRAINT `emp_history_ibfk_2` FOREIGN KEY (`id_cambio`) REFERENCES `cambio` (`id_cambio`);

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`id_tipodocumento`) REFERENCES `tipo_documento` (`id_tipodocumento`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`id_cambio`) REFERENCES `cambio` (`id_cambio`),
  ADD CONSTRAINT `staff_ibfk_3` FOREIGN KEY (`id_tipopersonal`) REFERENCES `tipopersonal` (`id_tipopersonal`);

--
-- Filtros para la tabla `reservacion`
--
ALTER TABLE `reservacion`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id_habitacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
