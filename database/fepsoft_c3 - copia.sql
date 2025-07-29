-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2022 a las 03:10:23
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fepsoft_c3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcalificaciones`
--

CREATE TABLE `tblcalificaciones` (
  `id` int(11) NOT NULL,
  `inscripcion_matricula_id` int(11) NOT NULL,
  `clase_asignacion_id` int(11) NOT NULL,
  `primer_corte` decimal(4,2) NOT NULL,
  `segundo_corte` decimal(4,2) NOT NULL,
  `tercer_corte` decimal(4,2) NOT NULL,
  `cuarta_corte` decimal(4,2) NOT NULL,
  `nota_final` decimal(4,2) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblcalificaciones`
--

INSERT INTO `tblcalificaciones` (`id`, `inscripcion_matricula_id`, `clase_asignacion_id`, `primer_corte`, `segundo_corte`, `tercer_corte`, `cuarta_corte`, `nota_final`, `estado`) VALUES
(5, 1, 6, '4.00', '4.00', '5.00', '4.33', 2),
(6, 1, 8, '2.00', '3.00', '3.00', '2.67', 2),
(11, 5, 7, '0.00', '0.00', '5.00', '1.67', 2),
(12, 5, 8, '5.00', '5.00', '5.00', '5.00', 2),
(13, 5, 10, '0.00', '0.00', '0.00', '0.00', 1),
(15, 5, 12, '0.00', '0.00', '0.00', '0.00', 1),
(16, 5, 13, '0.00', '0.00', '0.00', '0.00', 1),
(17, 5, 4, '0.00', '0.00', '0.00', '0.00', 1),
(18, 7, 12, '3.00', '4.00', '5.00', '4.00', 2),
(19, 7, 10, '5.00', '5.00', '5.00', '5.00', 2),
(20, 7, 13, '5.00', '5.00', '5.00', '5.00', 2),
(21, 7, 6, '5.00', '5.00', '5.00', '5.00', 2),
(22, 7, 1, '0.00', '5.00', '3.00', '2.67', 2),
(23, 7, 8, '5.00', '5.00', '5.00', '5.00', 2),
(24, 7, 16, '5.00', '5.00', '5.00', '5.00', 2),
(25, 8, 3, '0.00', '0.00', '0.00', '0.00', 1),
(26, 8, 11, '0.00', '0.00', '0.00', '0.00', 1),
(27, 9, 12, '3.00', '0.00', '5.00', '2.67', 2),
(28, 9, 16, '4.00', '4.00', '4.00', '4.00', 2),
(29, 9, 13, '0.00', '0.00', '5.00', '1.67', 2),
(30, 9, 15, '0.00', '0.00', '5.00', '1.67', 2),
(31, 9, 8, '0.00', '4.00', '5.00', '3.00', 2),
(32, 9, 14, '0.00', '0.00', '5.00', '1.67', 2),
(33, 10, 1, '0.00', '3.00', '0.00', '0.00', 1),
(34, 10, 8, '0.00', '0.00', '0.00', '0.00', 1),
(35, 10, 13, '0.00', '0.00', '0.00', '0.00', 1),
(36, 10, 12, '0.00', '0.00', '0.00', '0.00', 1),
(37, 10, 16, '0.00', '0.00', '0.00', '0.00', 1),
(38, 10, 2, '0.00', '0.00', '0.00', '0.00', 1),
(39, 10, 6, '2.00', '0.00', '0.00', '0.00', 1),
(40, 11, 17, '4.00', '4.00', '0.00', '0.00', 1),
(41, 11, 6, '0.00', '0.00', '0.00', '0.00', 1),
(42, 11, 2, '0.00', '0.00', '0.00', '0.00', 1),
(43, 11, 16, '0.00', '0.00', '0.00', '0.00', 1),
(44, 11, 13, '0.00', '0.00', '0.00', '0.00', 1),
(45, 11, 15, '0.00', '0.00', '0.00', '0.00', 1),
(46, 11, 12, '0.00', '0.00', '0.00', '0.00', 1),
(47, 12, 17, '4.00', '4.00', '5.00', '4.33', 2),
(48, 12, 15, '4.00', '4.00', '0.00', '0.00', 1),
(49, 12, 10, '0.00', '0.00', '0.00', '0.00', 1),
(50, 12, 13, '0.00', '0.00', '0.00', '0.00', 1),
(51, 12, 16, '0.00', '4.00', '4.00', '2.67', 2),
(52, 12, 12, '0.00', '0.00', '0.00', '0.00', 1),
(53, 12, 6, '0.00', '0.00', '0.00', '0.00', 1);

--
-- Disparadores `tblcalificaciones`
--
DELIMITER $$
CREATE TRIGGER `ActualizarCreditoyCosto` AFTER INSERT ON `tblcalificaciones` FOR EACH ROW UPDATE tblinscripcion_matricula a 
SET a.credito_usado = ( a.credito_usado +(SELECT x.Creditos FROM tblsubjects x inner join tblclasses_asignacion y on x.id = y.subject_id WHERE y.idClassAsig = new.clase_asignacion_id)),
a.costo_pagar = (a.costo_pagar + (SELECT x.Costo FROM tblsubjects x inner join tblclasses_asignacion y on x.id = y.subject_id WHERE y.idClassAsig = new.clase_asignacion_id))
WHERE a.id = new.inscripcion_matricula_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `DeleteCreditoCosto` AFTER DELETE ON `tblcalificaciones` FOR EACH ROW UPDATE tblinscripcion_matricula a 
SET a.credito_usado = ( a.credito_usado -(SELECT x.Creditos FROM tblsubjects x inner join tblclasses_asignacion y on x.id = y.subject_id WHERE y.idClassAsig = old.clase_asignacion_id)),
a.costo_pagar = (a.costo_pagar - (SELECT x.Costo FROM tblsubjects x inner join tblclasses_asignacion y on x.id = y.subject_id WHERE y.idClassAsig = old.clase_asignacion_id))
WHERE a.id = old.inscripcion_matricula_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblclasses`
--

CREATE TABLE `tblclasses` (
  `id` int(11) NOT NULL,
  `ClassName` varchar(80) DEFAULT NULL,
  `ClassNameNumeric` int(11) NOT NULL,
  `Section` varchar(5) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblclasses`
--

INSERT INTO `tblclasses` (`id`, `ClassName`, `ClassNameNumeric`, `Section`, `rol_id`, `Status`) VALUES
(1, 'Primero', 1, 'A', 7, 1),
(2, 'Segundo', 2, 'A', 7, 1),
(3, 'Tercero', 3, 'A', 7, 1),
(4, 'Cuarto', 4, 'A', 7, 1),
(5, 'Quinto', 5, 'A', 7, 1),
(6, 'Sexto', 6, 'A', 7, 1),
(7, 'Septimo', 7, 'A', 7, 1),
(8, 'Octavo', 8, 'A', 7, 1),
(12, 'segundo', 2, 'B', 7, 1),
(13, 'Primero', 1, 'B', 7, 1),
(14, 'Cuatrimestres', 1, 'A', 7, 1),
(15, 'Cuatrimestres', 2, 'B', 7, 1),
(16, 'Cuatrimestres', 3, 'C', 7, 1),
(17, 'CUATRIMESTRE', 1, 'A', 7, 1);

--
-- Disparadores `tblclasses`
--
DELIMITER $$
CREATE TRIGGER `insert_actualizar_fecha_classes` AFTER INSERT ON `tblclasses` FOR EACH ROW INSERT INTO tblclasses_log (classes_id, reg_date, upd_date) VALUES (new.id, CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_fecha_classes` AFTER UPDATE ON `tblclasses` FOR EACH ROW IF (SELECT COUNT(clg.idlog) FROM tblclasses_log as clg WHERE clg.classes_id = new.id) > 0
THEN
UPDATE tblclasses_log as cl SET cl.upd_date=CURRENT_TIMESTAMP
WHERE new.id = cl.classes_id;
ELSE
INSERT INTO tblclasses_log (classes_id, reg_date, upd_date) VALUES (new.id, CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblclasses_asignacion`
--

CREATE TABLE `tblclasses_asignacion` (
  `idClassAsig` int(11) NOT NULL,
  `classes_id` int(11) NOT NULL,
  `horario_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblclasses_asignacion`
--

INSERT INTO `tblclasses_asignacion` (`idClassAsig`, `classes_id`, `horario_id`, `subject_id`, `teacher_id`, `Status`) VALUES
(1, 1, 1, 1, 1, 1),
(2, 1, 2, 6, 3, 1),
(3, 2, 2, 6, 1, 1),
(4, 1, 1, 10, 3, 1),
(6, 14, 4, 28, 9, 1),
(7, 14, 4, 30, 2, 1),
(8, 14, 5, 30, 4, 1),
(10, 14, 2, 30, 7, 1),
(11, 15, 6, 33, 2, 1),
(12, 15, 6, 32, 1, 1),
(13, 16, 7, 34, 5, 1),
(14, 15, 2, 12, 7, 1),
(15, 16, 1, 9, 16, 1),
(16, 15, 8, 35, 16, 1),
(17, 17, 5, 11, 16, 1),
(18, 17, 5, 35, 16, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblclasses_log`
--

CREATE TABLE `tblclasses_log` (
  `idlog` int(11) NOT NULL,
  `classes_id` int(11) NOT NULL,
  `reg_date` datetime NOT NULL,
  `upd_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblclasses_log`
--

INSERT INTO `tblclasses_log` (`idlog`, `classes_id`, `reg_date`, `upd_date`) VALUES
(1, 1, '2021-09-03 08:38:37', '2021-09-13 09:47:45'),
(2, 2, '2021-09-03 08:38:48', '2021-09-13 09:47:45'),
(3, 3, '2021-09-13 09:47:45', '2021-09-13 09:47:45'),
(4, 4, '2021-09-13 09:47:45', '2021-09-13 09:47:45'),
(5, 5, '2021-09-13 09:47:45', '2021-09-13 09:47:45'),
(6, 6, '2021-09-13 09:47:45', '2021-09-13 09:47:45'),
(7, 7, '2021-09-13 09:47:45', '2021-09-13 09:47:45'),
(8, 8, '2021-09-13 09:47:45', '2021-09-13 09:47:45'),
(9, 12, '2021-09-13 10:00:52', '2021-09-13 10:04:47'),
(10, 13, '2021-09-13 10:06:29', '2021-09-13 10:06:29'),
(11, 14, '2021-12-07 12:46:35', '2021-12-07 12:46:35'),
(12, 15, '2021-12-07 12:46:47', '2021-12-07 12:46:47'),
(13, 16, '2021-12-07 12:46:59', '2021-12-07 12:46:59'),
(14, 17, '2022-02-02 17:00:26', '2022-02-02 17:00:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblhorario`
--

CREATE TABLE `tblhorario` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblhorario`
--

INSERT INTO `tblhorario` (`id`, `descripcion`, `rol_id`) VALUES
(1, 'lunes a viernes - 8:00 am a 10:00 am', 7),
(2, 'lunes a viernes - 1:00 pm a 5:00 pm', 7),
(3, 'Lunes de 8:00 am a 9:30 am', 8),
(4, '1:00 PM a 2:40 PM', 7),
(5, '8:00 am - 9:40 am', 7),
(6, '3:00 pm a 5:00 pm', 7),
(7, '5 pm a 6 pm', 7),
(8, '3 a 5', 7),
(9, 'Martes 08:00 a 10:00', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblinscripcion_matricula`
--

CREATE TABLE `tblinscripcion_matricula` (
  `id` int(11) NOT NULL,
  `credito_usado` int(11) DEFAULT NULL,
  `costo_pagar` double DEFAULT NULL,
  `costo_pagado` double DEFAULT NULL,
  `Estado` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp(),
  `upd_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblinscripcion_matricula`
--

INSERT INTO `tblinscripcion_matricula` (`id`, `credito_usado`, `costo_pagar`, `costo_pagado`, `Estado`, `student_id`, `reg_date`, `upd_date`) VALUES
(1, 20, 120, 120, 2, 27, '2021-12-08 13:21:04', '2021-12-08 13:21:04'),
(5, 15, 100, 0, 1, 26, '2021-12-23 16:32:28', '2021-12-23 16:32:28'),
(7, 16, 120, 120, 2, 2, '2021-12-23 17:37:18', '2021-12-23 17:37:18'),
(8, 3, 40, 20, 1, 2, '2021-12-23 18:06:46', '2021-12-23 18:06:46'),
(9, 15, 120, 0, 2, 27, '2021-12-27 13:54:47', '2021-12-27 13:54:47'),
(10, 14, 120, 2, 1, 41, '2022-02-02 17:05:44', '2022-02-02 17:05:44'),
(11, 13, 130, 0, 1, 42, '2022-02-02 17:13:36', '2022-02-02 17:13:36'),
(12, 15, 130, 80, 1, 43, '2022-02-02 17:43:17', '2022-02-02 17:43:17'),
(13, 0, 0, 0, 1, 27, '2022-03-14 19:40:11', '2022-03-14 19:40:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmatricula`
--

CREATE TABLE `tblmatricula` (
  `idMatricula` int(11) NOT NULL,
  `StudentId` int(11) NOT NULL,
  `MontoMatricula` decimal(10,0) NOT NULL,
  `Status` int(11) NOT NULL,
  `FechaMatricula` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblmatricula`
--

INSERT INTO `tblmatricula` (`idMatricula`, `StudentId`, `MontoMatricula`, `Status`, `FechaMatricula`) VALUES
(1, 4, '1000', 1, ''),
(3, 3, '2000', 1, ''),
(4, 2, '2500', 1, ''),
(6, 13, '430', 1, ''),
(7, 22, '500', 1, '2021-09-21 17:00:54'),
(9, 40, '350', 1, '2021-09-22 20:04:42'),
(10, 27, '100', 1, '2021-09-22 20:04:42'),
(11, 26, '100', 1, '2021-12-23 16:30:06'),
(12, 41, '40000', 1, '2022-02-02 17:20:05'),
(13, 42, '34555', 1, '2022-02-02 17:39:45'),
(14, 43, '130', 1, '2022-02-02 17:48:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblpensiones`
--

CREATE TABLE `tblpensiones` (
  `idPension` int(11) NOT NULL,
  `StudentId` int(11) NOT NULL,
  `MontoPension` decimal(10,0) NOT NULL,
  `Status` int(11) NOT NULL,
  `FechaPension` varchar(25) DEFAULT NULL,
  `inscripcion_matricula_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblpensiones`
--

INSERT INTO `tblpensiones` (`idPension`, `StudentId`, `MontoPension`, `Status`, `FechaPension`, `inscripcion_matricula_id`) VALUES
(1, 3, '350', 1, '2021-09-20 16:51:54', 0),
(2, 3, '450', 1, '2021-09-20 16:51:54', 0),
(3, 2, '300', 1, '2021-09-20 16:51:54', 0),
(4, 2, '350', 1, '2021-09-20 17:51:54', 0),
(5, 40, '100', 1, '2021-09-22 20:06:03', 0),
(7, 27, '100', 1, '2021-12-08 17:13:20', 1),
(9, 27, '20', 1, '2021-12-08 18:44:57', 1),
(10, 2, '40', 1, '2021-12-23 17:44:12', 7),
(11, 2, '40', 1, '2021-12-23 17:44:18', 7),
(12, 2, '40', 1, '2021-12-23 17:44:24', 7),
(13, 41, '2', 1, '2022-02-02 17:21:00', 10),
(14, 43, '80', 1, '2022-02-02 17:48:43', 12),
(15, 2, '20', 1, '2022-02-03 20:38:19', 8);

--
-- Disparadores `tblpensiones`
--
DELIMITER $$
CREATE TRIGGER `ActualizarPagoInscripcion` AFTER INSERT ON `tblpensiones` FOR EACH ROW UPDATE tblinscripcion_matricula a 
SET a.costo_pagado = (SELECT SUM(x.MontoPension) from tblpensiones x WHERE x.inscripcion_matricula_id = new.inscripcion_matricula_id)
WHERE a.id = new.inscripcion_matricula_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblresult`
--

CREATE TABLE `tblresult` (
  `id` int(11) NOT NULL,
  `StudentId` int(11) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `SubjectId` int(11) NOT NULL,
  `ciclo1` int(11) DEFAULT NULL,
  `ciclo2` int(11) DEFAULT NULL,
  `ciclo3` int(11) DEFAULT NULL,
  `ciclo4` int(11) DEFAULT NULL,
  `comentario` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `ausencias` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblresult`
--

INSERT INTO `tblresult` (`id`, `StudentId`, `ClassId`, `SubjectId`, `ciclo1`, `ciclo2`, `ciclo3`, `ciclo4`, `comentario`, `ausencias`) VALUES
(6, 2, 4, 2, 85, NULL, NULL, NULL, NULL, 0),
(7, 2, 4, 1, 75, NULL, NULL, NULL, NULL, 0),
(8, 2, 4, 5, 80, NULL, NULL, NULL, NULL, 0),
(9, 2, 4, 4, 96, NULL, NULL, NULL, NULL, 0),
(10, 4, 7, 2, 54, 100, 0, 0, 'ok', 0),
(11, 4, 7, 1, 85, NULL, NULL, NULL, 'ok', 0),
(12, 4, 7, 5, 55, NULL, NULL, NULL, 'ok', 0),
(13, 4, 7, 7, 65, NULL, NULL, NULL, 'ok', 0),
(14, 5, 8, 2, 75, NULL, NULL, NULL, NULL, 0),
(15, 5, 8, 1, 56, NULL, NULL, NULL, NULL, 0),
(16, 5, 8, 5, 52, NULL, NULL, NULL, NULL, 0),
(17, 5, 8, 4, 80, NULL, NULL, NULL, NULL, 0),
(30, 14, 2, 5, 85, NULL, NULL, NULL, NULL, 0),
(31, 15, 3, 4, 20, NULL, NULL, NULL, NULL, 0),
(32, 15, 3, 1, 75, NULL, NULL, NULL, NULL, 0),
(34, 18, 1, 4, 85, NULL, NULL, NULL, NULL, 0),
(35, 18, 1, 13, 75, NULL, NULL, NULL, NULL, 0),
(36, 18, 1, 14, 89, NULL, NULL, NULL, NULL, 0),
(37, 18, 1, 15, 95, NULL, NULL, NULL, NULL, 0),
(38, 18, 1, 10, 88, 66, NULL, NULL, 'nice', 4),
(39, 18, 1, 12, 81, NULL, NULL, NULL, NULL, 0),
(40, 13, 1, 4, 100, 90, 70, 95, 'excelente', 0),
(41, 13, 1, 4, 100, 90, 70, 90, 'excelente', 0),
(42, 13, 1, 13, 100, 90, 90, 90, 'excelente', 0),
(43, 13, 1, 14, 100, 90, 78, 90, 'excelente', 0),
(44, 13, 1, 15, 100, 90, 88, 90, 'excelente', 0),
(45, 13, 1, 10, 100, 90, 70, 90, 'excelente', 0),
(46, 13, 1, 12, 100, 90, 60, 90, 'excelente', 0),
(47, 13, 1, 2, 100, 90, 88, 90, 'excelente', 0),
(48, 13, 1, 1, 100, 90, 100, 90, 'excelente', 0),
(49, 13, 1, 1, 100, 90, 100, 90, 'excelente', 0),
(60, 26, 5, 15, 80, NULL, NULL, NULL, 'bien', 0),
(61, 26, 5, 10, 75, NULL, NULL, NULL, 'muy bien', 0),
(62, 26, 5, 1, 90, NULL, NULL, NULL, 'muy bien', 0),
(63, 27, 1, 10, 100, 90, NULL, NULL, 'ok', 2),
(64, 27, 1, 1, 100, 90, NULL, NULL, 'ok', 2),
(65, 27, 1, 6, 100, 90, NULL, NULL, 'ok', 2),
(66, 27, 1, 10, 66, 90, NULL, NULL, 'ok', 2),
(67, 27, 1, 1, 66, 90, NULL, NULL, 'ok', 2),
(68, 27, 1, 6, 66, 90, NULL, NULL, 'ok', 2);

--
-- Disparadores `tblresult`
--
DELIMITER $$
CREATE TRIGGER `insert_actualizar_fecha_result` AFTER INSERT ON `tblresult` FOR EACH ROW INSERT INTO tblresult_log (result_id, reg_date, upd_date) VALUES (new.id, CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_fecha_result` AFTER UPDATE ON `tblresult` FOR EACH ROW IF (SELECT COUNT(rlg.idlog) FROM tblresult_log as rlg WHERE rlg.result_id = new.id) > 0
THEN
UPDATE tblresult_log as rl SET rl.upd_date=CURRENT_TIMESTAMP
WHERE new.id = rl.result_id;
ELSE
INSERT INTO tblresult_log (result_id, reg_date, upd_date) VALUES (new.id, CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblresult_log`
--

CREATE TABLE `tblresult_log` (
  `idlog` int(11) NOT NULL,
  `result_id` int(11) NOT NULL,
  `reg_date` datetime NOT NULL,
  `upd_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblresult_log`
--

INSERT INTO `tblresult_log` (`idlog`, `result_id`, `reg_date`, `upd_date`) VALUES
(1, 60, '2021-09-03 08:32:15', '2021-11-30 10:15:37'),
(2, 6, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(3, 7, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(4, 8, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(5, 9, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(6, 10, '2021-11-30 10:15:37', '2021-11-30 10:20:21'),
(7, 11, '2021-11-30 10:15:37', '2021-11-30 10:20:21'),
(8, 12, '2021-11-30 10:15:37', '2021-11-30 10:20:21'),
(9, 13, '2021-11-30 10:15:37', '2021-11-30 10:20:21'),
(10, 14, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(11, 15, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(12, 16, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(13, 17, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(14, 30, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(15, 31, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(16, 32, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(17, 34, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(18, 35, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(19, 36, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(20, 37, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(21, 38, '2021-11-30 10:15:37', '2021-11-30 11:01:20'),
(22, 39, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(23, 40, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(24, 41, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(25, 42, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(26, 43, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(27, 44, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(28, 45, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(29, 46, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(30, 47, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(31, 48, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(32, 49, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(33, 61, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(34, 62, '2021-11-30 10:15:37', '2021-11-30 10:15:37'),
(35, 63, '2021-11-30 10:54:38', '2021-11-30 11:08:57'),
(36, 64, '2021-11-30 10:54:38', '2021-11-30 11:08:57'),
(37, 65, '2021-11-30 10:54:38', '2021-11-30 11:08:57'),
(38, 66, '2021-11-30 10:56:38', '2021-11-30 11:08:57'),
(39, 67, '2021-11-30 10:56:38', '2021-11-30 11:08:57'),
(40, 68, '2021-11-30 10:56:39', '2021-11-30 11:08:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblroles`
--

CREATE TABLE `tblroles` (
  `idroles` int(11) NOT NULL,
  `descripcion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblroles`
--

INSERT INTO `tblroles` (`idroles`, `descripcion`) VALUES
(1, 'Administrador Escuela'),
(2, 'Docente Escuela'),
(3, 'Estudiante Escuela'),
(4, 'Administrador Colegio'),
(5, 'Docente Colegio'),
(6, 'Estudiante Colegio'),
(7, 'Escuela'),
(8, 'Colegio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblstudents`
--

CREATE TABLE `tblstudents` (
  `StudentId` int(11) NOT NULL,
  `StudentName` varchar(100) NOT NULL,
  `cedula` varchar(100) NOT NULL,
  `Domicilio` varchar(50) DEFAULT NULL,
  `Telefono1` varchar(30) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Nacionalidad` varchar(50) DEFAULT NULL,
  `Comentarios` varchar(100) DEFAULT NULL,
  `ClassId` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `PassStu` varchar(150) DEFAULT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblstudents`
--

INSERT INTO `tblstudents` (`StudentId`, `StudentName`, `cedula`, `Domicilio`, `Telefono1`, `Gender`, `DOB`, `Edad`, `Nacionalidad`, `Comentarios`, `ClassId`, `Status`, `usuario`, `PassStu`, `rol_id`) VALUES
(2, 'Rafael García', '000-000-001', 'hils', '12345678', 'Masculino', '2013-08-08', 8, 'other', 'colegio', 1, 1, 'r.garcia', 'contrasena', 3),
(3, 'Juan Escobar', '000-000-000', NULL, NULL, 'Masculino', '2014-08-06', NULL, NULL, NULL, 6, 1, 'j.escobar', 'contrasena', 3),
(4, 'Rafael Pérez', '000-000-000', NULL, NULL, 'Masculino', '2001-02-03', NULL, NULL, NULL, 7, 1, 'r.perez', 'contrasena', 3),
(5, 'Enrique Flórez', '000-000-000', NULL, NULL, 'Masculino', '2014-05-12', NULL, NULL, NULL, 8, 1, 'e.florez', 'contrasena', 3),
(13, 'Manuel Lopez Martinez', '000-000-000', NULL, NULL, '', '2016-04-12', NULL, NULL, NULL, 1, 1, 'm.lopez', 'contrasena', 3),
(14, 'Carlos Mesa ', '000-000-000', NULL, NULL, 'Male', '2021-07-02', NULL, NULL, NULL, 2, 1, 'c.mesa ', 'contrasena', 3),
(15, 'Manuel Alvarez', '000-000-000', NULL, NULL, 'Male', '2001-02-15', NULL, NULL, NULL, 3, 1, 'm.alvarez', 'contrasena', 3),
(18, 'Luis Mendez', '000-000-000', NULL, NULL, '', '2016-06-14', NULL, NULL, NULL, 1, 0, 'l.mendez', 'contrasena', 3),
(22, 'Mario Lopez', '000-000-000', NULL, NULL, 'Male', '2004-06-16', NULL, NULL, NULL, 1, 1, 'm_lopez', 'contrasena', 3),
(23, 'Adanna Mesa ', '000-000-000', NULL, NULL, 'Female', '2016-08-16', NULL, NULL, NULL, 8, 1, 'A.mesa ', 'contrasena', 3),
(25, 'Pedro Ruiz', '000-000-000', NULL, NULL, 'Male', '2021-08-07', NULL, NULL, NULL, 1, 1, 'p_ruiz', 'contrasena', 3),
(26, 'Ivan Valdez', '000-000-000', NULL, NULL, 'Male', '2015-02-02', NULL, NULL, NULL, 5, 1, 'IValdez', 'contrasena', 3),
(27, 'Fernando', '000-000-000', 'managua', '00000000', '', '1998-12-09', 23, 'Nicaraguense', 'Curso de 7 meses', 14, 1, 'fer.flores', 'contrasena', 3),
(37, 'prueba ingreso estud colegio', '000-000-000', 'ni', '12121212', 'Male', '2021-09-02', 22, 'ni', 'prueba', 1, 1, 'pru.v', 'contrasena', 6),
(38, 'prueba', '000-000-000', 'prueba', 'prueba', '', '2021-09-16', 12, 'prueba', 'prueba', 1, 1, 'prueba', 'prueba', 3),
(39, 'prueba', '000-000-000', 'dw', 'wqw', 'Male', '1998-06-16', 23, 'df', 'fr', 1, 1, 'fr', 'fr', 3),
(40, 'prueba estudiante', '000-000-000', 's', '2', 'Male', '2021-09-10', 23, 'f', 'prueba', 1, 1, 'pv', 'pv', 3),
(41, 'JOSE JORGE', '000-000-000', 'ESTE', '3003272609', 'Male', '2001-01-02', 23, 'COLOMBIANO', 'ew', 17, 1, '123', '123', 3),
(42, 'PEDRO', '000-000-000', 'WE', 'WE', 'Male', '2022-01-31', 34, 'SD', 'SD', 17, 1, '321', '321', 3),
(43, 'ISABEL RUEDA', '000-000-000', '23', '23', 'Female', '2022-01-31', 23, 'COLOMBIANA', '23', 17, 1, '2', '2', 3),
(44, 'jsdj', '000-000-000', 'sjjsd', '8382', 'Female', '2022-02-04', 32, 'sdsd', 'wcdds', 3, 1, 'jjjjaa', 'ssdsd', 3);

--
-- Disparadores `tblstudents`
--
DELIMITER $$
CREATE TRIGGER `insert_actualizar_fecha_student` AFTER INSERT ON `tblstudents` FOR EACH ROW INSERT INTO tblstudents_log (student_id, reg_date, upd_date) VALUES (new.StudentId, CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_fecha_student` AFTER UPDATE ON `tblstudents` FOR EACH ROW IF (SELECT COUNT(slg.idlog) FROM tblstudents_log as slg WHERE slg.student_id = new.StudentId) > 0
THEN
UPDATE tblstudents_log as sl SET sl.upd_date=CURRENT_TIMESTAMP
WHERE new.StudentId = sl.student_id;
ELSE
INSERT INTO tblstudents_log (student_id, reg_date, upd_date) VALUES (new.StudentId, CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblstudents_log`
--

CREATE TABLE `tblstudents_log` (
  `idlog` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `reg_date` datetime DEFAULT NULL,
  `upd_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblstudents_log`
--

INSERT INTO `tblstudents_log` (`idlog`, `student_id`, `reg_date`, `upd_date`) VALUES
(3, 27, '2021-09-01 16:36:15', '2022-03-14 15:34:08'),
(4, 2, '2021-09-11 14:25:04', '2022-03-14 15:36:44'),
(5, 3, '2021-09-11 14:25:04', '2022-03-14 15:34:08'),
(6, 4, '2021-09-11 14:25:04', '2022-03-14 15:34:08'),
(7, 5, '2021-09-11 14:25:04', '2022-03-14 15:34:08'),
(8, 13, '2021-09-11 14:25:04', '2022-03-14 15:34:08'),
(9, 14, '2021-09-11 14:25:04', '2022-03-14 15:34:08'),
(10, 15, '2021-09-11 14:25:04', '2022-03-14 15:34:08'),
(11, 18, '2021-09-11 14:25:04', '2022-03-14 15:34:08'),
(12, 22, '2021-09-11 14:25:04', '2022-03-14 15:34:08'),
(13, 23, '2021-09-11 14:25:04', '2022-03-14 15:34:08'),
(14, 25, '2021-09-11 14:25:04', '2022-03-14 15:34:08'),
(15, 26, '2021-09-11 14:25:04', '2022-03-14 15:34:08'),
(16, 37, '2021-09-11 16:22:38', '2022-03-14 15:34:08'),
(17, 38, '2021-09-12 20:39:12', '2022-03-14 15:34:08'),
(18, 39, '2021-09-22 09:30:12', '2022-03-14 15:34:08'),
(19, 40, '2021-09-22 19:46:15', '2022-03-14 15:34:08'),
(20, 41, '2022-02-02 17:05:21', '2022-03-14 15:34:08'),
(21, 42, '2022-02-02 17:13:20', '2022-03-14 15:34:08'),
(22, 43, '2022-02-02 17:43:00', '2022-03-14 15:34:08'),
(23, 44, '2022-02-03 21:53:17', '2022-03-14 15:34:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblsubjectcombination`
--

CREATE TABLE `tblsubjectcombination` (
  `id` int(11) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `SubjectId` int(11) NOT NULL,
  `idTeacher` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblsubjectcombination`
--

INSERT INTO `tblsubjectcombination` (`id`, `ClassId`, `SubjectId`, `idTeacher`, `status`) VALUES
(1, 2, 22, 5, 0),
(2, 2, 28, 14, 1);

--
-- Disparadores `tblsubjectcombination`
--
DELIMITER $$
CREATE TRIGGER `insert_actualizar_fecha_subjectcombination` AFTER INSERT ON `tblsubjectcombination` FOR EACH ROW INSERT INTO tblsubjectcombination_log ( subjectcombination_id , reg_date, upd_date) VALUES (new.id, CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_fecha_subjectcombination` AFTER UPDATE ON `tblsubjectcombination` FOR EACH ROW IF (SELECT COUNT(sclg.idlog) FROM tblsubjectcombination_log as sclg WHERE sclg.subjectcombination_id = new.id) > 0
THEN
UPDATE tblsubjectcombination_log as scl SET scl.upd_date=CURRENT_TIMESTAMP
WHERE new.id = scl.subjectcombination_id;
ELSE
INSERT INTO tblsubjectcombination_log ( subjectcombination_id , reg_date, upd_date) VALUES (new.id, CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblsubjectcombination_log`
--

CREATE TABLE `tblsubjectcombination_log` (
  `idlog` int(11) NOT NULL,
  `subjectcombination_id` int(11) NOT NULL,
  `reg_date` datetime NOT NULL,
  `upd_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblsubjectcombination_log`
--

INSERT INTO `tblsubjectcombination_log` (`idlog`, `subjectcombination_id`, `reg_date`, `upd_date`) VALUES
(1, 1, '2021-09-03 08:11:56', '2021-09-22 09:23:04'),
(2, 2, '2021-12-08 20:24:07', '2021-12-08 20:24:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `id` int(11) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) NOT NULL,
  `Creditos` int(11) NOT NULL,
  `Costo` decimal(8,2) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblsubjects`
--

INSERT INTO `tblsubjects` (`id`, `SubjectName`, `SubjectCode`, `Creditos`, `Costo`, `teacher_id`, `rol_id`, `Status`) VALUES
(1, 'Matemáticas', 'MAT-01', 1, '10.00', 1, 7, 1),
(2, 'Inglés 2', 'ING-02', 1, '10.00', 1, 7, 1),
(4, 'Biologia', 'Bio-01', 1, '10.00', 1, 7, 1),
(5, 'Música', 'MUS04', 1, '10.00', 1, 7, 1),
(6, 'Orientacion ', 'Ori-01', 1, '10.00', 1, 7, 1),
(7, 'Física', 'Fis-01', 1, '10.00', 1, 7, 1),
(8, 'Química', 'QUI11', 1, '10.00', 1, 7, 1),
(9, 'Frances', 'Fra-01', 2, '20.00', 1, 7, 1),
(10, 'Español', 'ESP-03', 1, '10.00', 1, 7, 1),
(11, 'SCI I', 'SCI-01', 1, '10.00', 1, 7, 1),
(12, 'Historia   ', 'HIS-01', 2, '10.00', 1, 7, 1),
(13, 'Ciencias Naturales', 'CNAT-01', 1, '10.00', 1, 7, 1),
(14, 'Educacion Artistica ', 'EART-01', 1, '10.00', 1, 7, 1),
(15, 'Educacion Fisica', 'EFIS-01', 1, '10.00', 1, 7, 1),
(18, 'pruebas de eliminacionES', 'elimi', 1, '10.00', 1, 7, 1),
(20, 'materia de prueba', 'pruebaD', 1, '10.00', 1, 7, 1),
(21, 'FISICAs-V', 'FIS-V', 1, '10.00', 1, 7, 1),
(22, 'FISICA-6', 'FSC-6', 1, '10.00', 1, 7, 1),
(23, 'FISICA-7', 'FIS7', 1, '10.00', 1, 7, 1),
(24, 'FISICAs-8', 'FIS-8', 1, '10.00', 1, 7, 1),
(25, 'Fisca 2', 'FIS-02', 1, '10.00', 1, 8, 1),
(27, 'prueba2', 'prueba2', 1, '10.00', 1, 7, 1),
(28, 'Aritmetica', 'AE', 1, '10.00', 9, 7, 1),
(30, 'Ingles III', 'EN-3', 3, '10.00', 16, 7, 1),
(31, 'Español', 'Esp', 16, '100.00', 4, 7, 0),
(32, 'Trigonometria', 'TM', 2, '20.00', 2, 7, 0),
(33, 'Algebra', 'ALG', 2, '30.00', 2, 7, 0),
(34, 'Oficce', 'Of', 3, '40.00', 5, 7, 0),
(35, 'Lengua', 'Lng', 3, '20.00', 6, 7, 0);

--
-- Disparadores `tblsubjects`
--
DELIMITER $$
CREATE TRIGGER `insert_actualizar_fecha_subjects` AFTER INSERT ON `tblsubjects` FOR EACH ROW INSERT INTO tblsubjects_log (subject_id, reg_date, upd_date) VALUES (new.id, CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_fecha_subjects` AFTER UPDATE ON `tblsubjects` FOR EACH ROW IF (SELECT COUNT(slg.idsubject_log) FROM tblsubjects_log as slg WHERE slg.subject_id = new.id) > 0
THEN
UPDATE tblsubjects_log as sl SET sl.upd_date=CURRENT_TIMESTAMP
WHERE new.id = sl.subject_id;
ELSE
INSERT INTO tblsubjects_log (subject_id, reg_date, upd_date) VALUES (new.id, CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblsubjects_log`
--

CREATE TABLE `tblsubjects_log` (
  `idsubject_log` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `reg_date` datetime NOT NULL,
  `upd_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblsubjects_log`
--

INSERT INTO `tblsubjects_log` (`idsubject_log`, `subject_id`, `reg_date`, `upd_date`) VALUES
(1, 1, '2021-09-03 07:59:05', '2021-12-07 15:19:18'),
(2, 2, '2021-09-03 07:59:28', '2021-12-07 15:19:18'),
(3, 4, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(4, 5, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(5, 6, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(6, 7, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(7, 8, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(8, 9, '2021-09-12 15:37:50', '2021-12-23 17:39:24'),
(9, 10, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(10, 11, '2021-09-12 15:37:50', '2022-02-02 17:09:22'),
(11, 12, '2021-09-12 15:37:50', '2021-12-27 15:48:30'),
(12, 13, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(13, 14, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(14, 15, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(15, 18, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(16, 20, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(17, 21, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(18, 22, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(19, 23, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(20, 24, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(21, 25, '2021-09-12 15:37:50', '2021-12-07 15:19:18'),
(22, 27, '2021-09-12 20:06:37', '2021-12-07 15:19:18'),
(23, 28, '2021-12-07 12:55:29', '2021-12-07 15:19:18'),
(25, 30, '2021-12-07 13:42:58', '2021-12-07 15:19:18'),
(26, 31, '2021-12-08 14:24:20', '2021-12-08 14:24:20'),
(27, 32, '2021-12-23 16:56:54', '2021-12-23 16:56:54'),
(28, 33, '2021-12-23 16:57:17', '2021-12-23 16:57:17'),
(29, 34, '2021-12-23 17:04:29', '2021-12-23 17:04:29'),
(30, 35, '2021-12-23 17:40:25', '2021-12-23 17:40:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblteacher`
--

CREATE TABLE `tblteacher` (
  `idTeacher` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `User` varchar(50) DEFAULT NULL,
  `Pass` varchar(150) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblteacher`
--

INSERT INTO `tblteacher` (`idTeacher`, `Name`, `ClassId`, `Status`, `User`, `Pass`, `rol_id`) VALUES
(1, 'Juan Lara Garcia', 1, 1, 'juan', 'juan', 2),
(2, 'Ana Perez', 1, 1, 'ana', 'ana', 2),
(3, 'Fior lorenzo', 3, 1, NULL, NULL, 2),
(4, 'Libares Reinoso', 4, 1, NULL, NULL, 2),
(5, 'Alba Ramos ', 5, 1, NULL, NULL, 2),
(6, 'Ramon Vazquez', 6, 1, NULL, NULL, 2),
(7, 'Carmen de la cruz', 4, 1, NULL, NULL, 2),
(8, 'Ana Perez', 8, 1, NULL, NULL, 2),
(9, 'Juan Garabito', 4, 1, NULL, NULL, 2),
(12, 'Angel', 1, 1, 'admin1', 'admin1', 1),
(13, 'Miguel', 2, 1, 'admin2', 'admin2', 4),
(14, 'Antonio', 3, 1, 'admincolegio', 'admincolegio', 4),
(15, 'prueba docente admin', 13, 1, 'adocescuela', 'adocescuela', 1),
(16, 'jorge', 4, 1, 'jorge', 'jorge', 2),
(17, 'pablo', 2, 1, 'pablo', 'pablo', 1),
(18, 'SERRANO JORGE', 17, 1, '1', '1', 2);

--
-- Disparadores `tblteacher`
--
DELIMITER $$
CREATE TRIGGER `insert_actualizar_fecha_teacher` AFTER INSERT ON `tblteacher` FOR EACH ROW INSERT INTO tblteacher_log (teacher_id, reg_date, upd_date) VALUES (new.idTeacher, CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_fecha_teacher` AFTER UPDATE ON `tblteacher` FOR EACH ROW IF (SELECT COUNT(tlg.idteacher_log) FROM tblteacher_log as tlg WHERE tlg.teacher_id = new.idTeacher) > 0
THEN
UPDATE tblteacher_log as tl SET tl.upd_date=CURRENT_TIMESTAMP
WHERE new.idTeacher = tl.teacher_id;
ELSE
INSERT INTO tblteacher_log (teacher_id, reg_date, upd_date) VALUES (new.idTeacher, CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblteacher_log`
--

CREATE TABLE `tblteacher_log` (
  `idteacher_log` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `reg_date` datetime NOT NULL,
  `upd_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblteacher_log`
--

INSERT INTO `tblteacher_log` (`idteacher_log`, `teacher_id`, `reg_date`, `upd_date`) VALUES
(1, 1, '2021-09-03 07:24:37', '2021-12-08 20:26:42'),
(2, 2, '2021-09-03 07:25:38', '2021-12-08 19:02:05'),
(3, 12, '2021-09-11 13:10:45', '2022-01-21 05:03:55'),
(4, 13, '2021-09-11 14:32:20', '2022-01-21 05:04:17'),
(5, 14, '2021-09-11 14:33:15', '2021-09-22 08:56:59'),
(6, 3, '2021-09-12 16:06:21', '2021-09-12 16:06:21'),
(7, 4, '2021-09-12 16:06:35', '2021-09-12 16:06:35'),
(8, 5, '2021-09-12 16:06:51', '2021-09-12 16:06:51'),
(9, 6, '2021-09-12 16:09:06', '2021-09-12 16:09:06'),
(10, 7, '2021-09-12 16:09:18', '2021-09-12 16:09:18'),
(11, 8, '2021-09-12 16:09:29', '2021-09-12 16:09:29'),
(12, 9, '2021-09-12 16:09:40', '2021-09-12 16:09:40'),
(13, 15, '2021-09-22 18:47:30', '2021-09-22 18:47:30'),
(14, 16, '2021-09-22 20:08:21', '2021-09-22 20:08:21'),
(15, 17, '2021-09-22 20:09:16', '2021-09-22 20:09:16'),
(16, 18, '2022-02-02 17:42:06', '2022-02-02 17:42:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuario`
--

CREATE TABLE `tblusuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(150) NOT NULL,
  `idroles` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblusuario`
--

INSERT INTO `tblusuario` (`id`, `usuario`, `contrasena`, `idroles`, `nombre`) VALUES
(1, 'c.mesa', '12345678', 1, 'Carlos Mesa '),
(2, 'e.cabrera', '12345678', 2, 'Edgar Cabrera'),
(3, 'a.mesa ', '12345678', 3, 'Adanna Mesa ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblcalificaciones`
--
ALTER TABLE `tblcalificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tblclasses`
--
ALTER TABLE `tblclasses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `tblclasses_asignacion`
--
ALTER TABLE `tblclasses_asignacion`
  ADD PRIMARY KEY (`idClassAsig`),
  ADD KEY `classes_id` (`classes_id`),
  ADD KEY `horario_id` (`horario_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indices de la tabla `tblclasses_log`
--
ALTER TABLE `tblclasses_log`
  ADD PRIMARY KEY (`idlog`);

--
-- Indices de la tabla `tblhorario`
--
ALTER TABLE `tblhorario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `tblinscripcion_matricula`
--
ALTER TABLE `tblinscripcion_matricula`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tblmatricula`
--
ALTER TABLE `tblmatricula`
  ADD PRIMARY KEY (`idMatricula`),
  ADD KEY `StudentId` (`StudentId`);

--
-- Indices de la tabla `tblpensiones`
--
ALTER TABLE `tblpensiones`
  ADD PRIMARY KEY (`idPension`),
  ADD KEY `StudentId` (`StudentId`);

--
-- Indices de la tabla `tblresult`
--
ALTER TABLE `tblresult`
  ADD PRIMARY KEY (`id`),
  ADD KEY `StudentId` (`StudentId`),
  ADD KEY `ClassId` (`ClassId`),
  ADD KEY `SubjectId` (`SubjectId`);

--
-- Indices de la tabla `tblresult_log`
--
ALTER TABLE `tblresult_log`
  ADD PRIMARY KEY (`idlog`),
  ADD KEY `result_id` (`result_id`);

--
-- Indices de la tabla `tblroles`
--
ALTER TABLE `tblroles`
  ADD PRIMARY KEY (`idroles`);

--
-- Indices de la tabla `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`StudentId`),
  ADD KEY `ClassId` (`ClassId`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `tblstudents_log`
--
ALTER TABLE `tblstudents_log`
  ADD PRIMARY KEY (`idlog`),
  ADD KEY `student_id` (`student_id`);

--
-- Indices de la tabla `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ClassId` (`ClassId`),
  ADD KEY `SubjectId` (`SubjectId`),
  ADD KEY `idTeacher` (`idTeacher`);

--
-- Indices de la tabla `tblsubjectcombination_log`
--
ALTER TABLE `tblsubjectcombination_log`
  ADD PRIMARY KEY (`idlog`),
  ADD KEY `subjectcombination_id` (`subjectcombination_id`);

--
-- Indices de la tabla `tblsubjects`
--
ALTER TABLE `tblsubjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `tblsubjects_log`
--
ALTER TABLE `tblsubjects_log`
  ADD PRIMARY KEY (`idsubject_log`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indices de la tabla `tblteacher`
--
ALTER TABLE `tblteacher`
  ADD PRIMARY KEY (`idTeacher`),
  ADD KEY `tblteacher_ibfk_1` (`ClassId`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `tblteacher_log`
--
ALTER TABLE `tblteacher_log`
  ADD PRIMARY KEY (`idteacher_log`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indices de la tabla `tblusuario`
--
ALTER TABLE `tblusuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idroles` (`idroles`),
  ADD KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblcalificaciones`
--
ALTER TABLE `tblcalificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `tblclasses`
--
ALTER TABLE `tblclasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tblclasses_asignacion`
--
ALTER TABLE `tblclasses_asignacion`
  MODIFY `idClassAsig` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tblclasses_log`
--
ALTER TABLE `tblclasses_log`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tblhorario`
--
ALTER TABLE `tblhorario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tblinscripcion_matricula`
--
ALTER TABLE `tblinscripcion_matricula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tblmatricula`
--
ALTER TABLE `tblmatricula`
  MODIFY `idMatricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tblpensiones`
--
ALTER TABLE `tblpensiones`
  MODIFY `idPension` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tblresult`
--
ALTER TABLE `tblresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `tblresult_log`
--
ALTER TABLE `tblresult_log`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `tblroles`
--
ALTER TABLE `tblroles`
  MODIFY `idroles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `StudentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `tblstudents_log`
--
ALTER TABLE `tblstudents_log`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tblsubjectcombination_log`
--
ALTER TABLE `tblsubjectcombination_log`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tblsubjects`
--
ALTER TABLE `tblsubjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `tblsubjects_log`
--
ALTER TABLE `tblsubjects_log`
  MODIFY `idsubject_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `tblteacher`
--
ALTER TABLE `tblteacher`
  MODIFY `idTeacher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tblteacher_log`
--
ALTER TABLE `tblteacher_log`
  MODIFY `idteacher_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tblusuario`
--
ALTER TABLE `tblusuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tblclasses`
--
ALTER TABLE `tblclasses`
  ADD CONSTRAINT `tblclasses_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `tblroles` (`idroles`);

--
-- Filtros para la tabla `tblclasses_asignacion`
--
ALTER TABLE `tblclasses_asignacion`
  ADD CONSTRAINT `tblclasses_asignacion_ibfk_1` FOREIGN KEY (`classes_id`) REFERENCES `tblclasses` (`id`),
  ADD CONSTRAINT `tblclasses_asignacion_ibfk_2` FOREIGN KEY (`horario_id`) REFERENCES `tblhorario` (`id`),
  ADD CONSTRAINT `tblclasses_asignacion_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `tblsubjects` (`id`),
  ADD CONSTRAINT `tblclasses_asignacion_ibfk_4` FOREIGN KEY (`teacher_id`) REFERENCES `tblteacher` (`idTeacher`);

--
-- Filtros para la tabla `tblhorario`
--
ALTER TABLE `tblhorario`
  ADD CONSTRAINT `tblhorario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `tblroles` (`idroles`);

--
-- Filtros para la tabla `tblmatricula`
--
ALTER TABLE `tblmatricula`
  ADD CONSTRAINT `tblmatricula_ibfk_1` FOREIGN KEY (`StudentId`) REFERENCES `tblstudents` (`StudentId`);

--
-- Filtros para la tabla `tblpensiones`
--
ALTER TABLE `tblpensiones`
  ADD CONSTRAINT `tblpensiones_ibfk_1` FOREIGN KEY (`StudentId`) REFERENCES `tblstudents` (`StudentId`);

--
-- Filtros para la tabla `tblresult`
--
ALTER TABLE `tblresult`
  ADD CONSTRAINT `tblresult_ibfk_1` FOREIGN KEY (`SubjectId`) REFERENCES `tblsubjects` (`id`),
  ADD CONSTRAINT `tblresult_ibfk_2` FOREIGN KEY (`ClassId`) REFERENCES `tblclasses` (`id`),
  ADD CONSTRAINT `tblresult_ibfk_3` FOREIGN KEY (`StudentId`) REFERENCES `tblstudents` (`StudentId`);

--
-- Filtros para la tabla `tblresult_log`
--
ALTER TABLE `tblresult_log`
  ADD CONSTRAINT `tblresult_log_ibfk_1` FOREIGN KEY (`result_id`) REFERENCES `tblresult` (`id`);

--
-- Filtros para la tabla `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD CONSTRAINT `tblstudents_ibfk_1` FOREIGN KEY (`ClassId`) REFERENCES `tblclasses` (`id`),
  ADD CONSTRAINT `tblstudents_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `tblroles` (`idroles`);

--
-- Filtros para la tabla `tblstudents_log`
--
ALTER TABLE `tblstudents_log`
  ADD CONSTRAINT `tblstudents_log_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `tblstudents` (`StudentId`);

--
-- Filtros para la tabla `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  ADD CONSTRAINT `tblsubjectcombination_ibfk_1` FOREIGN KEY (`SubjectId`) REFERENCES `tblsubjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblsubjectcombination_ibfk_2` FOREIGN KEY (`ClassId`) REFERENCES `tblclasses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblsubjectcombination_ibfk_3` FOREIGN KEY (`idTeacher`) REFERENCES `tblteacher` (`idTeacher`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tblsubjectcombination_log`
--
ALTER TABLE `tblsubjectcombination_log`
  ADD CONSTRAINT `tblsubjectcombination_log_ibfk_1` FOREIGN KEY (`subjectcombination_id`) REFERENCES `tblsubjectcombination` (`id`);

--
-- Filtros para la tabla `tblsubjects`
--
ALTER TABLE `tblsubjects`
  ADD CONSTRAINT `tblsubjects_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `tblroles` (`idroles`);

--
-- Filtros para la tabla `tblsubjects_log`
--
ALTER TABLE `tblsubjects_log`
  ADD CONSTRAINT `tblsubjects_log_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `tblsubjects` (`id`);

--
-- Filtros para la tabla `tblteacher`
--
ALTER TABLE `tblteacher`
  ADD CONSTRAINT `tblteacher_ibfk_1` FOREIGN KEY (`ClassId`) REFERENCES `tblclasses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblteacher_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `tblroles` (`idroles`);

--
-- Filtros para la tabla `tblteacher_log`
--
ALTER TABLE `tblteacher_log`
  ADD CONSTRAINT `tblteacher_log_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `tblteacher` (`idTeacher`);

--
-- Filtros para la tabla `tblusuario`
--
ALTER TABLE `tblusuario`
  ADD CONSTRAINT `tblusuario_ibfk_1` FOREIGN KEY (`idroles`) REFERENCES `tblroles` (`idroles`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
