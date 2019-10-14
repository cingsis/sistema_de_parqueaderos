-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2019 a las 22:33:58
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `parkingsystem`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_actualizarContrasenia` (IN `_pass` VARCHAR(255) CHARSET utf8, IN `_id` INT)  NO SQL
UPDATE usuarios
SET password = _pass
WHERE id = _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_actualizarTarifas` (IN `_tipo` VARCHAR(30) CHARSET utf8, IN `_hora` VARCHAR(30) CHARSET utf8, IN `_horaAdicional` VARCHAR(30) CHARSET utf8, IN `_hora2` VARCHAR(30) CHARSET utf8, IN `_dia` VARCHAR(30) CHARSET utf8, IN `_mes` VARCHAR(30) CHARSET utf8, IN `_id` INT)  NO SQL
UPDATE tarifas
SET tipo = _tipo,
valor_hora = _hora,
valor_adicional = _horaAdicional,
valor_2 = _hora2,
valor_dia = _dia,
valor_mensualidad = _mes
WHERE id = _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_actualizarUsuario` (IN `_login` VARCHAR(30) CHARSET utf16le, IN `_nombres` VARCHAR(255) CHARSET utf8, IN `_id` INT)  NO SQL
UPDATE usuarios
SET login = _login,
nombres = _nombres
WHERE id = _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_buscarPlaca` (IN `_placa` VARCHAR(30) CHARSET utf8)  NO SQL
SELECT
id,
placa,
tipo,
fecha_llegada,
hora_llegada
FROM movimientos
WHERE placa = _placa
AND estado_salida = 0
ORDER BY placa ASC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_buscarTodos` ()  NO SQL
SELECT
placa, 
tipo,
fecha_llegada,
hora_llegada
FROM movimientos
ORDER BY placa ASC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_cambiarEstadoUsuario` (IN `_id` INT)  NO SQL
BEGIN
	UPDATE usuarios 
	SET estado = (CASE WHEN estado = "Activo" THEN "Inactivo" ELSE "Activo" END) 
	WHERE id = _id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarInfoUsuario` (IN `_id` INT)  NO SQL
SELECT
id,
login,
nombres,
tipo,
estado
FROM usuarios
WHERE id = _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarUsuarios` (IN `_login` VARCHAR(50) CHARSET utf8, IN `_pass` VARCHAR(255) CHARSET utf8)  NO SQL
BEGIN
    SELECT
    id,
    login,
    password,
    nombres,
    tipo,
    estado
    FROM usuarios
    WHERE login = _login
    AND password = _pass
    AND estado = "Activo";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_guardarIngreso` (IN `_placa` VARCHAR(10) CHARSET utf8, IN `_tipo` VARCHAR(30) CHARSET utf8, IN `_fechaLlegada` VARCHAR(30) CHARSET utf8, IN `_horaLlegada` VARCHAR(30) CHARSET utf8, IN `_usuarioLlegada` VARCHAR(30) CHARSET utf8, IN `_tipoCobro` VARCHAR(30) CHARSET utf8, IN `_tieneCasco` VARCHAR(30) CHARSET utf8)  NO SQL
BEGIN
	INSERT INTO movimientos (placa, tipo, fecha_llegada, hora_llegada, usuario_llegada, tipo_cobro, tiene_casco, estado_salida)
	VALUES
	(
    	_placa,
        _tipo,
        _fechaLlegada,
        _horaLlegada,
        _usuarioLlegada,
        _tipoCobro,
        _tieneCasco,
        0
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_guardarUsuario` (IN `_login` VARCHAR(100) CHARSET utf8, IN `_pass` VARCHAR(255) CHARSET utf8, IN `_nombres` VARCHAR(255) CHARSET utf8, IN `_tipo` INT, IN `_estado` VARCHAR(50) CHARSET utf8)  NO SQL
BEGIN
	INSERT INTO usuarios (id, login, password, nombres, tipo, estado, fecha_creacion)
    VALUES
    (
    	NULL,
        _login,
        _pass,
        _nombres,
        _tipo,
        _estado,
        NULL
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_listarIngresosAnuales` (IN `_principioAnio` VARCHAR(30) CHARSET utf8)  NO SQL
SELECT
id,
placa,
tipo,
fecha_llegada,
hora_llegada,
usuario_llegada,
fecha_salida,
hora_salida,
usuario_salida,
transcurrido,
valor_cobro,
tipo_cobro,
cliente,
tiene_casco,
estado_salida,
fecha_registro
FROM movimientos 
WHERE fecha_llegada BETWEEN _principioAnio AND now()$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_listarIngresosDiarios` (IN `_hoy` VARCHAR(30) CHARSET utf8)  NO SQL
SELECT
id,
placa,
tipo,
fecha_llegada,
hora_llegada,
usuario_llegada,
fecha_salida,
hora_salida,
usuario_salida,
transcurrido,
valor_cobro,
tipo_cobro,
cliente,
tiene_casco,
estado_salida,
fecha_registro
FROM movimientos
WHERE fecha_llegada = _hoy$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_listarIngresosMensuales` (IN `_primer_dia_mes` VARCHAR(30) CHARSET utf8)  NO SQL
SELECT
id,
placa,
tipo,
fecha_llegada,
hora_llegada,
usuario_llegada,
fecha_salida,
hora_salida,
usuario_salida,
transcurrido,
valor_cobro,
tipo_cobro,
cliente,
tiene_casco,
estado_salida,
fecha_registro
FROM movimientos 
WHERE fecha_llegada BETWEEN _primer_dia_mes AND now()$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_listarIngresosSemanales` (IN `_primer_dia` VARCHAR(30) CHARSET utf8)  NO SQL
SELECT 
id,
placa,
tipo,
fecha_llegada,
hora_llegada,
usuario_llegada,
fecha_salida,
hora_salida,
usuario_salida,
transcurrido,
valor_cobro,
tipo_cobro,
cliente,
tiene_casco,
estado_salida,
fecha_registro
FROM movimientos
WHERE fecha_llegada  BETWEEN _primer_dia AND now()$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_listarTarifas` ()  NO SQL
SELECT
id,
tipo,
tiempo,
valor_hora,
valor_adicional,
valor_2,
valor_dia,
valor_mensualidad,
descuento,
aplica_descuento
FROM tarifas$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_listarUsuarios` ()  NO SQL
BEGIN
	SELECT
    id,
    login,
    nombres,
    tipo,
    estado,
    fecha_creacion
    FROM usuarios;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_registrarSalida` (IN `_tipo` VARCHAR(30) CHARSET utf8, IN `_fechaSalida` VARCHAR(30) CHARSET utf8, IN `_horaSalida` VARCHAR(30) CHARSET utf8, IN `_transcurrido` VARCHAR(30) CHARSET utf8, IN `_valorCobro` VARCHAR(30) CHARSET utf8, IN `_usuario` VARCHAR(30) CHARSET utf8, IN `_estado` INT, IN `_id` INT)  NO SQL
UPDATE movimientos
SET tipo = _tipo,
fecha_salida = _fechaSalida,
hora_salida = _horaSalida,
transcurrido = _transcurrido,
valor_cobro = _valorCobro,
usuario_salida = _usuario,
estado_salida = _estado
WHERE id = _id
AND estado_salida = 0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_traerDetalleRegistroEntrada` (IN `_id` INT)  NO SQL
SELECT
id,
placa, 
fecha_llegada,
hora_llegada,
usuario_llegada,
tiene_casco,
tipo_cobro
FROM movimientos
WHERE id = _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_traerDetalleRegistroSalida` (IN `_id` INT)  NO SQL
SELECT
id,
placa,
tipo,
fecha_llegada,
hora_llegada,
usuario_llegada,
fecha_salida,
hora_salida,
usuario_salida,
transcurrido,
valor_cobro,
tipo_cobro,
cliente,
tiene_casco,
estado_salida,
fecha_registro
FROM movimientos
WHERE id = _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ultimoId` ()  NO SQL
SELECT MAX(id) AS ultimoId
FROM movimientos$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cedula` int(10) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int(8) NOT NULL,
  `placa` varchar(10) CHARACTER SET utf8 NOT NULL,
  `tipo` varchar(30) CHARACTER SET utf8 NOT NULL,
  `fecha_llegada` varchar(30) CHARACTER SET utf8 NOT NULL,
  `hora_llegada` varchar(30) CHARACTER SET utf8 NOT NULL,
  `usuario_llegada` varchar(30) CHARACTER SET utf8 NOT NULL,
  `fecha_salida` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `hora_salida` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `usuario_salida` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `transcurrido` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `valor_cobro` double DEFAULT NULL,
  `tipo_cobro` varchar(30) CHARACTER SET utf8 NOT NULL,
  `cliente` int(10) DEFAULT NULL,
  `tiene_casco` varchar(10) CHARACTER SET utf8 NOT NULL,
  `estado_salida` int(1) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `placa`, `tipo`, `fecha_llegada`, `hora_llegada`, `usuario_llegada`, `fecha_salida`, `hora_salida`, `usuario_salida`, `transcurrido`, `valor_cobro`, `tipo_cobro`, `cliente`, `tiene_casco`, `estado_salida`, `fecha_registro`) VALUES
(1, 'abc123', 'moto', '2019-10-10', '11:59:20', 'demo', ' 2019-10-04', '16:18:48', 'demo', '22:03:13', 238000, 'horas', NULL, '', 0, '2019-09-29 20:44:19'),
(2, 'abc456', 'moto', '2019-10-02', '11:59:54', 'demo', ' 2019-10-04', '16:18:48', 'demo', '22:03:13', 238000, 'horas', NULL, '', 0, '2019-09-29 20:44:19'),
(3, 'abc789', 'moto', '2019-10-01', '18:15:35', 'demo', ' 2019-10-04', '16:18:48', 'demo', '22:03:13', 238000, 'horas', NULL, '', 0, '2019-09-29 20:44:19'),
(4, 'qwerty', 'Moto', '2019-10-13', '10:38:53', 'juan', '2019-10-13', '15:56:58', 'juan', '0 días / 05 horas', 5000, 'horas', NULL, 'no', 1, '2019-10-13 15:39:10'),
(5, 'ASD-12R', 'Moto', '2019-10-13', '11:36:09', 'Juan', '2019-10-13', '12:56:58', 'juan', '0 días / 01 horas', 1000, 'Horas', NULL, 'si', 0, '2019-10-13 16:36:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `cedula` int(10) NOT NULL,
  `fecha_pago` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `hora_pago` time NOT NULL,
  `tiempo` varchar(6) NOT NULL,
  `usuario_pago` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE `tarifas` (
  `id` int(11) NOT NULL,
  `tipo` varchar(30) CHARACTER SET utf8 NOT NULL,
  `tiempo` varchar(30) CHARACTER SET utf8 NOT NULL,
  `valor_hora` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '1000',
  `valor_adicional` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '500',
  `valor_2` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '1800',
  `valor_dia` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '4000',
  `valor_mensualidad` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '20000',
  `descuento` int(5) DEFAULT NULL,
  `aplica_descuento` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`id`, `tipo`, `tiempo`, `valor_hora`, `valor_adicional`, `valor_2`, `valor_dia`, `valor_mensualidad`, `descuento`, `aplica_descuento`, `fecha_actualizacion`) VALUES
(1, 'Tarifas', '', '1000', '500', '1800', '4000', '20000', 0, '0', '2019-10-14 17:50:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(2) NOT NULL,
  `login` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nombres` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tipo` int(11) NOT NULL,
  `estado` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `password`, `nombres`, `tipo`, `estado`, `fecha_creacion`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrador', 1, 'Activo', '2019-09-28 18:45:53'),
(2, 'demo', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', 'Usuario Regular', 2, 'Activo', '2019-09-28 18:45:53'),
(3, 'juan', 'a4cbb2f3933c5016da7e83fd135ab8a48b67bf61', 'Juan David', 1, 'Activo', '2019-09-28 18:45:53'),
(4, 'test', '6e45a996ca8c1c3bb0a7807c039dfffb02c0cad2', 'Test', 2, 'Inactivo', '2019-09-28 18:45:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(8) NOT NULL,
  `placa` varchar(6) NOT NULL,
  `tipo` varchar(6) NOT NULL,
  `marca` varchar(12) NOT NULL,
  `modelo` int(4) NOT NULL,
  `color` varchar(10) NOT NULL,
  `cliente` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista1`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista1` (
`placa` varchar(10)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista1`
--
DROP TABLE IF EXISTS `vista1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista1`  AS  select `movimientos`.`placa` AS `placa` from (`movimientos` join `vehiculos`) where ((`vehiculos`.`tipo` = 'moto') and (`movimientos`.`placa` = convert(`vehiculos`.`placa` using utf8))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `placa` (`placa`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente` (`cedula`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`placa`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
