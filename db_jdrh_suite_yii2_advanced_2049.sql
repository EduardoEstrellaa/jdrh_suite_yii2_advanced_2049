-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 17-12-2025 a las 21:51:39
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_jdrh_suite_yii2_advanced_2049`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alergias`
--

DROP TABLE IF EXISTS `alergias`;
CREATE TABLE IF NOT EXISTS `alergias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alum_alergia_id` int NOT NULL,
  `catalogo_alergias_id` int NOT NULL,
  `tipo_gravedad_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alergias_alum_alergia1_idx` (`alum_alergia_id`),
  KEY `fk_alergias_catalogo_alergias1_idx` (`catalogo_alergias_id`),
  KEY `fk_alergias_tipo_gravedad1_idx` (`tipo_gravedad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE IF NOT EXISTS `alumno` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `matricula` varchar(45) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perfil_id` int NOT NULL,
  `matricula` varchar(10) NOT NULL,
  `plan_licenciaturas_id` int NOT NULL,
  `generaciones_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `matricula_UNIQUE` (`matricula`),
  KEY `fk_alumnos_perfil1_idx` (`perfil_id`),
  KEY `fk_alumnos_generaciones1_idx` (`generaciones_id`),
  KEY `fk_alumnos_plan_licenciaturas1_idx` (`plan_licenciaturas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `perfil_id`, `matricula`, `plan_licenciaturas_id`, `generaciones_id`) VALUES
(9, 26, '21070053', 1, 1),
(12, 29, '21070031', 1, 2),
(15, 31, '21070014', 1, 2),
(16, 32, '21070016', 1, 1),
(17, 33, '21070011', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_alergia`
--

DROP TABLE IF EXISTS `alum_alergia`;
CREATE TABLE IF NOT EXISTS `alum_alergia` (
  `id` int NOT NULL,
  `alumnos_id` int NOT NULL,
  `padeces_alergias` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_alergia_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_asiste_dentista`
--

DROP TABLE IF EXISTS `alum_asiste_dentista`;
CREATE TABLE IF NOT EXISTS `alum_asiste_dentista` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `frecuencia_tiempo_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_asiste_dentista_frecuencia_tiempo1_idx` (`frecuencia_tiempo_id`),
  KEY `fk_alum_asiste_dentista_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alum_asiste_dentista`
--

INSERT INTO `alum_asiste_dentista` (`id`, `alumnos_id`, `frecuencia_tiempo_id`) VALUES
(1, 17, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_asiste_medico`
--

DROP TABLE IF EXISTS `alum_asiste_medico`;
CREATE TABLE IF NOT EXISTS `alum_asiste_medico` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `frecuencia_tiempo_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_asiste_medico_frecuencia_tiempo1_idx` (`frecuencia_tiempo_id`),
  KEY `fk_alum_asiste_medico_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alum_asiste_medico`
--

INSERT INTO `alum_asiste_medico` (`id`, `alumnos_id`, `frecuencia_tiempo_id`) VALUES
(1, 17, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_becas`
--

DROP TABLE IF EXISTS `alum_becas`;
CREATE TABLE IF NOT EXISTS `alum_becas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `tiene_beca` tinyint(1) NOT NULL,
  `tipos_becas_id` int DEFAULT NULL,
  `otro_especificar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alumnos_becas_tipos_becas1_idx` (`tipos_becas_id`),
  KEY `fk_alumnos_becas_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alum_becas`
--

INSERT INTO `alum_becas` (`id`, `alumnos_id`, `tiene_beca`, `tipos_becas_id`, `otro_especificar`) VALUES
(7, 15, 1, 5, NULL),
(8, 16, 1, 1, 'Rita Cetina'),
(9, 17, 1, 6, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_bienes_personales`
--

DROP TABLE IF EXISTS `alum_bienes_personales`;
CREATE TABLE IF NOT EXISTS `alum_bienes_personales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `catalogo_bienes_personales_id` int NOT NULL,
  `alumnos_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_bienes_personales_catalogo_bienes_personales1_idx` (`catalogo_bienes_personales_id`),
  KEY `fk_alum_bienes_personales_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alum_bienes_personales`
--

INSERT INTO `alum_bienes_personales` (`id`, `catalogo_bienes_personales_id`, `alumnos_id`) VALUES
(19, 4, 15),
(20, 5, 15),
(21, 1, 15),
(22, 2, 15),
(23, 3, 15),
(24, 6, 15),
(53, 1, 16),
(54, 3, 16),
(133, 4, 17),
(134, 5, 17),
(135, 1, 17),
(136, 2, 17),
(137, 3, 17),
(138, 6, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_consumo_alimentos`
--

DROP TABLE IF EXISTS `alum_consumo_alimentos`;
CREATE TABLE IF NOT EXISTS `alum_consumo_alimentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `catalogo_alimentos_id` int NOT NULL,
  `frecuencia_veces_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_consumo_alimentos_catalogo_alimentos1_idx` (`catalogo_alimentos_id`),
  KEY `fk_alum_consumo_alimentos_frecuencia_veces1_idx` (`frecuencia_veces_id`),
  KEY `fk_alum_consumo_alimentos_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_datos_familiares`
--

DROP TABLE IF EXISTS `alum_datos_familiares`;
CREATE TABLE IF NOT EXISTS `alum_datos_familiares` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `padre_nombre` varchar(150) NOT NULL,
  `padre_apellido_paterno` varchar(150) NOT NULL,
  `padre_apellido_materno` varchar(150) NOT NULL,
  `padre_ocupacion` varchar(150) NOT NULL,
  `padre_mayahablante` tinyint(1) NOT NULL,
  `madre_nombre` varchar(150) NOT NULL,
  `madre_apellido_paterno` varchar(150) NOT NULL,
  `madre_apellido_materno` varchar(150) NOT NULL,
  `madre_ocupacion` varchar(150) NOT NULL,
  `madre_mayahablante` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_datos_familiares_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alum_datos_familiares`
--

INSERT INTO `alum_datos_familiares` (`id`, `alumnos_id`, `padre_nombre`, `padre_apellido_paterno`, `padre_apellido_materno`, `padre_ocupacion`, `padre_mayahablante`, `madre_nombre`, `madre_apellido_paterno`, `madre_apellido_materno`, `madre_ocupacion`, `madre_mayahablante`) VALUES
(4, 15, 'Ali', 'Cuevas', 'Jimenez', 'Guia de Turista', 0, 'Eiffy Zulay Del Carmen ', 'Escobedo ', 'Nuñez', 'Emprendedora', 0),
(6, 15, 'Ali', 'Cuevas', 'Jimenez', 'Guia de Turista', 0, 'Eiffy Zulay Del Carmen ', 'Escobedo ', 'Nuñez', 'Emprendedora', 0),
(7, 16, 'Marco Antonio ', 'Olivo ', 'Arguello', 'Delivery', 0, 'Lidy Maribel', 'Esocbedo', 'Nunez', 'Emprendedora', 0),
(8, 17, 'Jorge Gabriel ', 'Estrella ', 'Pomol', 'Taxista', 0, 'Eiffy Zulay Del Carmen ', 'Escobedo ', 'Nuñez', 'Emprendedora', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_dependen_economica`
--

DROP TABLE IF EXISTS `alum_dependen_economica`;
CREATE TABLE IF NOT EXISTS `alum_dependen_economica` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `tiene_dependientes` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_dependen_economica_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alum_dependen_economica`
--

INSERT INTO `alum_dependen_economica` (`id`, `alumnos_id`, `tiene_dependientes`) VALUES
(1, 15, 1),
(2, 16, 1),
(3, 17, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_depende_economicamente`
--

DROP TABLE IF EXISTS `alum_depende_economicamente`;
CREATE TABLE IF NOT EXISTS `alum_depende_economicamente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `catalogo_dependencias_economicas_id` int NOT NULL,
  `otro_especificar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_depende_economicamente_catalogo_dependencias_econom_idx` (`catalogo_dependencias_economicas_id`),
  KEY `fk_alum_depende_economicamente_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alum_depende_economicamente`
--

INSERT INTO `alum_depende_economicamente` (`id`, `alumnos_id`, `catalogo_dependencias_economicas_id`, `otro_especificar`) VALUES
(2, 15, 7, NULL),
(3, 16, 8, NULL),
(4, 17, 13, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_deportes`
--

DROP TABLE IF EXISTS `alum_deportes`;
CREATE TABLE IF NOT EXISTS `alum_deportes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `practicas_algun_deporte` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_deportes_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_ejercicio`
--

DROP TABLE IF EXISTS `alum_ejercicio`;
CREATE TABLE IF NOT EXISTS `alum_ejercicio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `haces_ejercicio_fisico` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_ejercicio_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_enfermedades_cronicas`
--

DROP TABLE IF EXISTS `alum_enfermedades_cronicas`;
CREATE TABLE IF NOT EXISTS `alum_enfermedades_cronicas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `padece_enfermedades_cronicas` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_enfermedades_cronicas_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_estado_salud`
--

DROP TABLE IF EXISTS `alum_estado_salud`;
CREATE TABLE IF NOT EXISTS `alum_estado_salud` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `tuvo_problema_salud` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_estado_salud_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alum_estado_salud`
--

INSERT INTO `alum_estado_salud` (`id`, `alumnos_id`, `tuvo_problema_salud`) VALUES
(1, 16, 1),
(2, 17, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_habitos_consumo`
--

DROP TABLE IF EXISTS `alum_habitos_consumo`;
CREATE TABLE IF NOT EXISTS `alum_habitos_consumo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `fumas` tinyint(1) NOT NULL,
  `catalogo_cigarros_dia_id` int NOT NULL,
  `tomas_alcohol` tinyint(1) NOT NULL,
  `frecuencia_veces_semana_id` int NOT NULL,
  `tienes_adicciones` tinyint(1) NOT NULL,
  `especificiar_adiccion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_habitos_consumo_catalogo_cigarros_dia1_idx` (`catalogo_cigarros_dia_id`),
  KEY `fk_alum_habitos_consumo_frecuencia_veces_semana1_idx` (`frecuencia_veces_semana_id`),
  KEY `fk_alum_habitos_consumo_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_info_hijos`
--

DROP TABLE IF EXISTS `alum_info_hijos`;
CREATE TABLE IF NOT EXISTS `alum_info_hijos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `tiene_hijos` tinyint(1) NOT NULL,
  `cantidad_hijos` smallint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alumnos_info_hijos_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alum_info_hijos`
--

INSERT INTO `alum_info_hijos` (`id`, `alumnos_id`, `tiene_hijos`, `cantidad_hijos`) VALUES
(15, 15, 1, 1),
(16, 16, 1, 1),
(17, 17, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_inscripciones`
--

DROP TABLE IF EXISTS `alum_inscripciones`;
CREATE TABLE IF NOT EXISTS `alum_inscripciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `ciclos_semestres_id` int NOT NULL,
  `tipos_inscripciones_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alumnos_inscripciones_alumnos1_idx` (`alumnos_id`),
  KEY `fk_alumnos_inscripciones_tipos_inscripciones1_idx` (`tipos_inscripciones_id`),
  KEY `fk_alum_inscripciones_ciclos_semestres1_idx` (`ciclos_semestres_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_lugares_comer`
--

DROP TABLE IF EXISTS `alum_lugares_comer`;
CREATE TABLE IF NOT EXISTS `alum_lugares_comer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `catalogo_lugares_comer_id` int NOT NULL,
  `otro_especificar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_lugares_comer_catalogo_lugares_comer1_idx` (`catalogo_lugares_comer_id`),
  KEY `fk_alum_lugares_comer_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_organizacion`
--

DROP TABLE IF EXISTS `alum_organizacion`;
CREATE TABLE IF NOT EXISTS `alum_organizacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `participas_organizacion` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_organizacion_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_recreacion_tiempo`
--

DROP TABLE IF EXISTS `alum_recreacion_tiempo`;
CREATE TABLE IF NOT EXISTS `alum_recreacion_tiempo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `sabes_usar_internet` tinyint(1) NOT NULL,
  `tienes_acceso_internet` tinyint(1) NOT NULL,
  `catalogo_lugares_acceso_principal_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_recreacion_tiempo_catalogo_lugares_acceso_principal_idx` (`catalogo_lugares_acceso_principal_id`),
  KEY `fk_alum_recreacion_tiempo_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_servicios_salud`
--

DROP TABLE IF EXISTS `alum_servicios_salud`;
CREATE TABLE IF NOT EXISTS `alum_servicios_salud` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `tiene_servicios_salud` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_servicios_salud_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alum_servicios_salud`
--

INSERT INTO `alum_servicios_salud` (`id`, `alumnos_id`, `tiene_servicios_salud`) VALUES
(2, 17, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_trabajo`
--

DROP TABLE IF EXISTS `alum_trabajo`;
CREATE TABLE IF NOT EXISTS `alum_trabajo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `tiene_trabajo` tinyint(1) NOT NULL,
  `nombre_empresa` varchar(150) DEFAULT NULL,
  `puesto_ocupacion` varchar(150) DEFAULT NULL,
  `horario_entrada` time DEFAULT NULL,
  `horario_salida` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alumnos_trabaja_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alum_trabajo`
--

INSERT INTO `alum_trabajo` (`id`, `alumnos_id`, `tiene_trabajo`, `nombre_empresa`, `puesto_ocupacion`, `horario_entrada`, `horario_salida`) VALUES
(1, 15, 0, NULL, NULL, NULL, NULL),
(2, 16, 1, 'Startech Studios', 'Jefe ', '07:00:00', '12:00:00'),
(3, 17, 1, 'PSI EXTINTORES', 'Desarrollador de Software', '12:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_transportes`
--

DROP TABLE IF EXISTS `alum_transportes`;
CREATE TABLE IF NOT EXISTS `alum_transportes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `catalogo_transportes_id` int NOT NULL,
  `tiempo_recorrido_transporte_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_transportes_catalogo_transportes1_idx` (`catalogo_transportes_id`),
  KEY `fk_alum_transportes_tiempo_recorrido_transporte1_idx` (`tiempo_recorrido_transporte_id`),
  KEY `fk_alum_transportes_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alum_transportes`
--

INSERT INTO `alum_transportes` (`id`, `alumnos_id`, `catalogo_transportes_id`, `tiempo_recorrido_transporte_id`) VALUES
(1, 15, 5, 5),
(2, 16, 3, 1),
(3, 17, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_tratamientos`
--

DROP TABLE IF EXISTS `alum_tratamientos`;
CREATE TABLE IF NOT EXISTS `alum_tratamientos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `esta_en_tratamiento` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_tratamientos_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alum_tratamientos`
--

INSERT INTO `alum_tratamientos` (`id`, `alumnos_id`, `esta_en_tratamiento`) VALUES
(3, 17, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_uso_anteojos`
--

DROP TABLE IF EXISTS `alum_uso_anteojos`;
CREATE TABLE IF NOT EXISTS `alum_uso_anteojos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `utilizas_anteojos` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_uso_anteojos_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alum_uso_anteojos`
--

INSERT INTO `alum_uso_anteojos` (`id`, `alumnos_id`, `utilizas_anteojos`) VALUES
(1, 17, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_vivienda`
--

DROP TABLE IF EXISTS `alum_vivienda`;
CREATE TABLE IF NOT EXISTS `alum_vivienda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `vives_casa_padres` tinyint(1) NOT NULL,
  `otro_especificar` varchar(250) DEFAULT NULL,
  `tipos_viviendas_id` int NOT NULL,
  `otro_tipo_especificar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_vivienda_tipos_viviendas1_idx` (`tipos_viviendas_id`),
  KEY `fk_alum_vivienda_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alum_vivienda`
--

INSERT INTO `alum_vivienda` (`id`, `alumnos_id`, `vives_casa_padres`, `otro_especificar`, `tipos_viviendas_id`, `otro_tipo_especificar`) VALUES
(2, 15, 1, NULL, 2, NULL),
(3, 16, 0, '', 3, NULL),
(4, 17, 1, NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

DROP TABLE IF EXISTS `asignacion`;
CREATE TABLE IF NOT EXISTS `asignacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `equipos_id` int NOT NULL,
  `observaciones` text,
  `fecha_asignacion` datetime NOT NULL,
  `departamentos_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_asignacion_departamentos1_idx` (`departamentos_id`),
  KEY `fk_asignacion_equipos1_idx` (`equipos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones_alumnos_grupos`
--

DROP TABLE IF EXISTS `asignaciones_alumnos_grupos`;
CREATE TABLE IF NOT EXISTS `asignaciones_alumnos_grupos` (
  `id` int NOT NULL,
  `asignaciones_grupos_id` int NOT NULL,
  `alum_inscripciones_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_asignaciones_alumnos_grupos_asignaciones_grupos1_idx` (`asignaciones_grupos_id`),
  KEY `fk_asignaciones_alumnos_grupos_alum_inscripciones1_idx` (`alum_inscripciones_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones_grupos`
--

DROP TABLE IF EXISTS `asignaciones_grupos`;
CREATE TABLE IF NOT EXISTS `asignaciones_grupos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ciclos_semestres_id` int NOT NULL,
  `grupos_id` int NOT NULL,
  `asignaciones_tutores_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_asignacioes_grupos_grupos1_idx` (`grupos_id`),
  KEY `fk_asignacioes_grupos_asignaciones_tutores1_idx` (`asignaciones_tutores_id`),
  KEY `fk_asignaciones_grupos_ciclos_semestres1_idx` (`ciclos_semestres_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones_tutores`
--

DROP TABLE IF EXISTS `asignaciones_tutores`;
CREATE TABLE IF NOT EXISTS `asignaciones_tutores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perfil_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_asignaciones_tutores_perfil1_idx` (`perfil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `baja_equipo`
--

DROP TABLE IF EXISTS `baja_equipo`;
CREATE TABLE IF NOT EXISTS `baja_equipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `equipos_id` int NOT NULL,
  `observaciones` text NOT NULL,
  `tipo_baja_id` int NOT NULL,
  `fecha_baja` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_baja_equipo_equipos1_idx` (`equipos_id`),
  KEY `fk_baja_equipo_tipo_baja1_idx` (`tipo_baja_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_actividad_ejercicio`
--

DROP TABLE IF EXISTS `catalogo_actividad_ejercicio`;
CREATE TABLE IF NOT EXISTS `catalogo_actividad_ejercicio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_alergias`
--

DROP TABLE IF EXISTS `catalogo_alergias`;
CREATE TABLE IF NOT EXISTS `catalogo_alergias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `tipo_alergias_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_catalogo_alergias_tipo_alergias1_idx` (`tipo_alergias_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_alimentos`
--

DROP TABLE IF EXISTS `catalogo_alimentos`;
CREATE TABLE IF NOT EXISTS `catalogo_alimentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `categorias_catalogo_alimentos_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_catalogo_alimentos_categorias_catalogo_alimentos1_idx` (`categorias_catalogo_alimentos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_bienes_personales`
--

DROP TABLE IF EXISTS `catalogo_bienes_personales`;
CREATE TABLE IF NOT EXISTS `catalogo_bienes_personales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_bienes_personales`
--

INSERT INTO `catalogo_bienes_personales` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Laptop', 'Computadora portátil utilizada para estudio, trabajo o actividades personales.'),
(2, 'PC de escritorio', 'Computadora de escritorio utilizada para tareas académicas, laborales o recreativas.'),
(3, 'Tableta', 'Dispositivo móvil con pantalla táctil para estudio, trabajo, entretenimiento o comunicación.'),
(4, 'Celular / Smartphone', 'Teléfono móvil utilizado para comunicación, acceso a internet, aplicaciones y entretenimiento.'),
(5, 'Consola de videojuegos', 'Dispositivo electrónico destinado a juegos interactivos para entretenimiento.'),
(6, 'Televisor', 'Equipo de visualización audiovisual para entretenimiento, información o educación.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_bienes_vivienda`
--

DROP TABLE IF EXISTS `catalogo_bienes_vivienda`;
CREATE TABLE IF NOT EXISTS `catalogo_bienes_vivienda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_bienes_vivienda`
--

INSERT INTO `catalogo_bienes_vivienda` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Refrigerador', 'Electrodoméstico utilizado para conservar alimentos y bebidas en frío.'),
(2, 'Estufa', 'Aparato doméstico empleado para cocinar alimentos, ya sea de gas o eléctrica.'),
(3, 'Horno de microondas', 'Electrodoméstico utilizado para calentar o cocinar alimentos de manera rápida.'),
(4, 'Lavadora', 'Máquina utilizada para el lavado automático de ropa doméstica.'),
(5, 'Televisor/pantalla', 'Dispositivo de entretenimiento para visualizar contenido audiovisual.'),
(6, 'Aire acondicionado', 'Sistema para enfriar o climatizar el ambiente interior.'),
(7, 'Calentador de agua (boiler)', 'Equipo utilizado para calentar agua destinada a uso doméstico.'),
(8, 'Ventilador', 'Aparato que genera corriente de aire para ventilación y confort térmico.'),
(9, 'Muebles básicos', 'Conjunto de muebles esenciales del hogar como cama, mesa, sillas o sofá.'),
(10, 'Equipo de sonido', 'Sistema de audio para reproducción de música o contenido multimedia.'),
(11, 'Otro', 'Cualquier otro bien doméstico no incluido anteriormente, como licuadora, aspiradora o plancha.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_cigarros_dia`
--

DROP TABLE IF EXISTS `catalogo_cigarros_dia`;
CREATE TABLE IF NOT EXISTS `catalogo_cigarros_dia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_dependencias_economicas`
--

DROP TABLE IF EXISTS `catalogo_dependencias_economicas`;
CREATE TABLE IF NOT EXISTS `catalogo_dependencias_economicas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `categorias_dependencias_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_catalogo_dependencias_economicas_categorias_dependencias_idx` (`categorias_dependencias_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_dependencias_economicas`
--

INSERT INTO `catalogo_dependencias_economicas` (`id`, `nombre`, `descripcion`, `categorias_dependencias_id`) VALUES
(1, 'Padre', 'Progenitor masculino que provee o recibe apoyo económico directo.', 1),
(2, 'Madre', 'Progenitora femenina que provee o recibe apoyo económico directo.', 1),
(3, 'Hermano(a)', 'Familiar directo del alumno que puede contribuir o depender del ingreso familiar.', 1),
(4, 'Cónyuge o pareja', 'Persona con vínculo marital o de convivencia que comparte responsabilidades económicas.', 1),
(5, 'Abuelo(a)', 'Familiar indirecto que puede proporcionar o requerir apoyo económico.', 2),
(6, 'Tío(a)', 'Familiar indirecto que ofrece o recibe ayuda económica del alumno.', 2),
(7, 'Primo(a)', 'Pariente colateral que mantiene relación económica ocasional o parcial con el alumno.', 2),
(8, 'Tutor o responsable legal', 'Persona encargada legalmente del cuidado y sustento del alumno.', 3),
(9, 'Amigo(a) o conocido(a)', 'Persona no familiar que brinda o recibe apoyo económico voluntario.', 3),
(10, 'Institución educativa', 'Entidad académica que ofrece apoyo económico mediante becas o programas.', 4),
(11, 'Programa social o gubernamental', 'Ayuda económica otorgada por el gobierno o programas sociales institucionales.', 4),
(12, 'Organización privada o fundación', 'Entidad civil o privada que proporciona apoyos económicos o en especie.', 4),
(13, 'Otro', 'Persona o entidad no especificada en el catálogo anterior, aplicable a casos particulares.', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_deportes`
--

DROP TABLE IF EXISTS `catalogo_deportes`;
CREATE TABLE IF NOT EXISTS `catalogo_deportes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_enferm_cronicas`
--

DROP TABLE IF EXISTS `catalogo_enferm_cronicas`;
CREATE TABLE IF NOT EXISTS `catalogo_enferm_cronicas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_lugares_acceso_principal`
--

DROP TABLE IF EXISTS `catalogo_lugares_acceso_principal`;
CREATE TABLE IF NOT EXISTS `catalogo_lugares_acceso_principal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_lugares_comer`
--

DROP TABLE IF EXISTS `catalogo_lugares_comer`;
CREATE TABLE IF NOT EXISTS `catalogo_lugares_comer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_organizaciones`
--

DROP TABLE IF EXISTS `catalogo_organizaciones`;
CREATE TABLE IF NOT EXISTS `catalogo_organizaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `tipo_organizacion_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_catalogo_organizaciones_tipo_organizacion1_idx` (`tipo_organizacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_problemas_salud`
--

DROP TABLE IF EXISTS `catalogo_problemas_salud`;
CREATE TABLE IF NOT EXISTS `catalogo_problemas_salud` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_problemas_salud`
--

INSERT INTO `catalogo_problemas_salud` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Hipertensión', 'Elevación persistente de la presión arterial que puede aumentar el riesgo de enfermedades cardiovasculares y requiere seguimiento médico.'),
(2, 'Diabetes', 'Enfermedad crónica que afecta la regulación de la glucosa en sangre y requiere control médico y manejo de estilo de vida.'),
(3, 'Asma', 'Enfermedad respiratoria caracterizada por inflamación y obstrucción de las vías aéreas, con episodios de dificultad para respirar.'),
(4, 'Obesidad', 'Acumulación excesiva de grasa corporal que puede afectar la salud general y aumentar el riesgo de enfermedades crónicas.'),
(5, 'Enfermedades cardíacas', 'Trastornos que afectan el corazón y el sistema circulatorio, incluyendo insuficiencia cardíaca, arritmias y cardiopatías isquémicas.'),
(6, 'Enfermedades respiratorias crónicas', 'Afecciones prolongadas de los pulmones y vías respiratorias, como bronquitis crónica y enfermedad pulmonar obstructiva crónica (EPOC).'),
(7, 'Trastornos digestivos', 'Afecciones que afectan el sistema gastrointestinal, incluyendo gastritis, reflujo gastroesofágico y úlceras.'),
(8, 'Trastornos renales', 'Enfermedades que afectan la función de los riñones, incluyendo insuficiencia renal crónica y cálculos renales.'),
(9, 'Trastornos hepáticos', 'Enfermedades del hígado, como hepatitis, cirrosis o esteatosis hepática.'),
(10, 'Trastornos endocrinos', 'Afecciones que afectan las glándulas endocrinas y la regulación hormonal, incluyendo hipotiroidismo e hipertiroidismo'),
(11, 'Trastornos neurológicos', 'Enfermedades que afectan el sistema nervioso, como epilepsia, migraña o esclerosis múltiple'),
(12, 'Enfermedades crónicas de la piel', 'Afecciones cutáneas prolongadas como psoriasis, eczema o dermatitis atópica.'),
(13, 'Problemas de visión', 'Alteraciones visuales que requieren corrección o tratamiento, incluyendo miopía, hipermetropía y cataratas.'),
(14, 'Problemas de audición', 'Alteraciones auditivas como hipoacusia o tinnitus, que pueden afectar la comunicación y la calidad de vida.'),
(15, 'Otro (especificar)', 'Cualquier otra condición de salud no listada anteriormente que requiera atención médica o seguimiento.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_reacciones_alergicas`
--

DROP TABLE IF EXISTS `catalogo_reacciones_alergicas`;
CREATE TABLE IF NOT EXISTS `catalogo_reacciones_alergicas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_servicios_salud`
--

DROP TABLE IF EXISTS `catalogo_servicios_salud`;
CREATE TABLE IF NOT EXISTS `catalogo_servicios_salud` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_servicios_salud`
--

INSERT INTO `catalogo_servicios_salud` (`id`, `nombre`, `descripcion`) VALUES
(1, 'IMSS (Instituto Mexicano del Seguro Social)', 'Servicio de salud pública que brinda atención médica, hospitalaria y preventiva a trabajadores afiliados y sus familias.'),
(2, 'ISSSTE (Instituto de Seguridad y Servicios Sociales de los Trabajadores del Estado)', 'Proporciona servicios médicos, hospitalarios y preventivos a los empleados del sector público federal y sus beneficiarios.'),
(3, 'Secretaría de Salud (Centros de Salud / IMSS Bienestar / INSABI)', 'Servicios de atención primaria, preventiva y de promoción de la salud disponibles para toda la población, incluyendo personas sin seguridad social.'),
(4, 'Hospitales y clínicas privadas', 'Atención médica integral proporcionada por instituciones privadas, incluyendo consultas, diagnósticos, tratamientos y procedimientos especializados bajo pago directo o seguros privados.'),
(5, 'Farmacias con servicio médico', 'Consultas básicas y atención de problemas de salud comunes ofrecidas en farmacias que cuentan con personal capacitado y servicios limitados.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_servicios_vivienda`
--

DROP TABLE IF EXISTS `catalogo_servicios_vivienda`;
CREATE TABLE IF NOT EXISTS `catalogo_servicios_vivienda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_servicios_vivienda`
--

INSERT INTO `catalogo_servicios_vivienda` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Agua potable', 'Servicio que proporciona acceso al suministro de agua limpia para consumo doméstico.'),
(2, 'Electricidad', 'Servicio de energía eléctrica disponible en la vivienda para iluminación y uso de aparatos eléctricos.'),
(3, 'Internet', 'Conexión de red que permite el acceso a servicios digitales y comunicación en línea.'),
(4, 'Otro', 'Cualquier otro servicio doméstico no especificado anteriormente, como gas natural u otros.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_transportes`
--

DROP TABLE IF EXISTS `catalogo_transportes`;
CREATE TABLE IF NOT EXISTS `catalogo_transportes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_transportes`
--

INSERT INTO `catalogo_transportes` (`id`, `nombre`) VALUES
(1, 'Caminando'),
(2, 'Bicicleta'),
(3, 'Motocicleta'),
(4, 'Automóvil particular'),
(5, 'Transporte público colectivo (camión, combi, microbús)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_tratamientos`
--

DROP TABLE IF EXISTS `catalogo_tratamientos`;
CREATE TABLE IF NOT EXISTS `catalogo_tratamientos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `tipos_tratamientos_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_catalogo_tratamientos_tipos_tratamientos1_idx` (`tipos_tratamientos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_tratamientos`
--

INSERT INTO `catalogo_tratamientos` (`id`, `nombre`, `descripcion`, `tipos_tratamientos_id`) VALUES
(1, 'Medicación antihistamínica', 'Uso de medicamentos para controlar reacciones alérgicas como urticaria, rinitis o conjuntivitis.', 1),
(2, 'Terapia antibiótica', 'Administración de antibióticos para tratar infecciones bacterianas según diagnóstico médico.', 1),
(3, 'Control de hipertensión', 'Tratamiento con medicación y seguimiento médico para mantener la presión arterial dentro de rangos saludables.', 1),
(4, 'Control de diabetes', 'Tratamiento mediante medicación, insulina y seguimiento clínico para mantener niveles de glucosa adecuados.', 1),
(5, 'Terapia antiinflamatoria', 'Uso de fármacos antiinflamatorios para controlar dolor, inflamación o molestias musculoesqueléticas.', 1),
(6, 'Terapia cognitivo-conductual', 'Sesiones terapéuticas enfocadas en modificar patrones de pensamiento y conducta.', 2),
(7, 'Psicoterapia de apoyo', 'Intervenciones para manejo de estrés, ansiedad o depresión mediante técnicas de acompañamiento profesional.', 2),
(8, 'Terapia familiar', 'Sesiones que involucran a la familia para mejorar la comunicación y resolver conflictos.', 2),
(9, 'Terapia de relajación y manejo del estrés', 'Técnicas y ejercicios guiados para reducir ansiedad y mejorar bienestar emocional.', 2),
(10, 'Evaluación psiquiátrica', 'Diagnóstico integral de trastornos mentales con plan de tratamiento personalizado.', 3),
(11, 'Terapia farmacológica psiquiátrica', 'Administración de medicamentos para el tratamiento de trastornos mentales bajo supervisión profesional.', 3),
(12, 'Terapia electroconvulsiva (TEC)', 'Tratamiento psiquiátrico que utiliza estímulos eléctricos controlados para casos graves de depresión o trastornos resistentes.', 3),
(13, 'Rehabilitación física', 'Ejercicios y terapias físicas diseñadas para recuperar movilidad y fuerza tras lesiones o cirugías.', 4),
(14, 'Terapia ocupacional', 'Intervenciones que buscan mejorar habilidades de la vida diaria y laboral.', 4),
(15, 'Rehabilitación cognitiva', 'Actividades terapéuticas para recuperar funciones cognitivas afectadas por enfermedades o accidentes.', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_usos_internet`
--

DROP TABLE IF EXISTS `catalogo_usos_internet`;
CREATE TABLE IF NOT EXISTS `catalogo_usos_internet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_uso_anteojos`
--

DROP TABLE IF EXISTS `catalogo_uso_anteojos`;
CREATE TABLE IF NOT EXISTS `catalogo_uso_anteojos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_uso_anteojos`
--

INSERT INTO `catalogo_uso_anteojos` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Solo para lectura', 'Utilizo anteojos únicamente para actividades de lectura o tareas que requieren visión cercana.'),
(2, 'Uso irregular/ocasional', 'Hago uso constante de anteojos según recomendación médica para mejorar la visión en diversas actividades diarias.'),
(3, 'Para todas las actividades', 'Utilizo anteojos de manera habitual para la mayoría de mis actividades diarias, tanto de cerca como de lejos.'),
(4, 'Necesito, pero no tengo', 'Requiere el uso de anteojos según indicación médica, pero actualmente no los utilizo de manera regular.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_catalogo_alimentos`
--

DROP TABLE IF EXISTS `categorias_catalogo_alimentos`;
CREATE TABLE IF NOT EXISTS `categorias_catalogo_alimentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_dependencias`
--

DROP TABLE IF EXISTS `categorias_dependencias`;
CREATE TABLE IF NOT EXISTS `categorias_dependencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias_dependencias`
--

INSERT INTO `categorias_dependencias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Familiar directo', 'Personas con vínculo de parentesco inmediato con el alumno, como padres, hijos o cónyuge.'),
(2, 'Familiar indirecto', 'Parientes no directos que pueden participar en el sustento económico, como tíos, primos o abuelos.'),
(3, 'No familiar', 'Personas sin lazo de parentesco que contribuyen o dependen económicamente del alumno, como tutores, padrinos o amigos.'),
(4, 'Institucional / Gubernamental', 'Entidades públicas o privadas que proporcionan apoyo económico, como becas, programas sociales o fundaciones.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclos_escolares`
--

DROP TABLE IF EXISTS `ciclos_escolares`;
CREATE TABLE IF NOT EXISTS `ciclos_escolares` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `periodo_texto` varchar(250) NOT NULL,
  `estados_ciclos_escolares_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ciclos_escolares_estados_ciclos_escolares1_idx` (`estados_ciclos_escolares_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclos_semestres`
--

DROP TABLE IF EXISTS `ciclos_semestres`;
CREATE TABLE IF NOT EXISTS `ciclos_semestres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ciclos_escolares_id` int NOT NULL,
  `semestres_id` int NOT NULL,
  `fecha_inicio_semestre` datetime NOT NULL,
  `fecha_fin_semestre` datetime NOT NULL,
  `periodo_texto_semestre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ciclos_semestres_semestres1_idx` (`semestres_id`),
  KEY `fk_ciclos_semestres_ciclos_escolares1_idx` (`ciclos_escolares_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_generales`
--

DROP TABLE IF EXISTS `datos_generales`;
CREATE TABLE IF NOT EXISTS `datos_generales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perfil_id` int NOT NULL,
  `tlf_personal` varchar(13) DEFAULT NULL,
  `tlf_emergencia` varchar(13) DEFAULT NULL,
  `email_personal` varchar(250) DEFAULT NULL,
  `maya_hablante` tinyint(1) DEFAULT NULL,
  `estados_civiles_id` int NOT NULL,
  `nacionalidades_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_datos_generales_estados_civiles1_idx` (`estados_civiles_id`),
  KEY `fk_datos_generales_nacionalidades1_idx` (`nacionalidades_id`),
  KEY `fk_datos_generales_perfil1_idx` (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `datos_generales`
--

INSERT INTO `datos_generales` (`id`, `perfil_id`, `tlf_personal`, `tlf_emergencia`, `email_personal`, `maya_hablante`, `estados_civiles_id`, `nacionalidades_id`) VALUES
(4, 31, '9851028414', '8130872198', 'carlos.ace@gmail.com', 1, 2, 1),
(6, 31, '9851028414', '8130872198', 'carlos.ace@gmail.com', 0, 1, 1),
(7, 32, '9851240538', '9851294850', 'marco.aoe@gmail.com', 0, 1, 1),
(8, 33, '9994212407', '9851028414', 'lalo.eaee@gmail.com', 0, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

DROP TABLE IF EXISTS `datos_personales`;
CREATE TABLE IF NOT EXISTS `datos_personales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perfil_id` int NOT NULL,
  `curp` varchar(18) NOT NULL,
  `nss` varchar(11) DEFAULT NULL,
  `rfc` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_datos_personales_perfil1_idx` (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `datos_personales`
--

INSERT INTO `datos_personales` (`id`, `perfil_id`, `curp`, `nss`, `rfc`) VALUES
(6, 31, 'CARLOS112HQTYTK65', '12345678901', ''),
(8, 31, 'CARLOS112HQTYTK65', '', ''),
(9, 32, 'MARCOOLIVO12345', '12345678901', ''),
(10, 33, 'EDUVGMU970311MNTPT', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `edificios_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_departamentos_edificios1_idx` (`edificios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependientes`
--

DROP TABLE IF EXISTS `dependientes`;
CREATE TABLE IF NOT EXISTS `dependientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alum_dependen_economica_id` int NOT NULL,
  `catalogo_dependencias_economicas_id` int NOT NULL,
  `otro_especificar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dependen_alumno_alum_dependen_economica1_idx` (`alum_dependen_economica_id`),
  KEY `fk_dependen_alumno_catalogo_dependencias_economicas1_idx` (`catalogo_dependencias_economicas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `dependientes`
--

INSERT INTO `dependientes` (`id`, `alum_dependen_economica_id`, `catalogo_dependencias_economicas_id`, `otro_especificar`) VALUES
(153, 1, 5, NULL),
(154, 1, 3, NULL),
(155, 1, 12, NULL),
(234, 2, 9, NULL),
(235, 2, 2, NULL),
(236, 2, 13, 'Hijos'),
(252, 3, 4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportes`
--

DROP TABLE IF EXISTS `deportes`;
CREATE TABLE IF NOT EXISTS `deportes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alum_deportes_id` int NOT NULL,
  `catalogo_deportes_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_deportes_catalogo_deportes1_idx` (`catalogo_deportes_id`),
  KEY `fk_deportes_alum_deportes1_idx` (`alum_deportes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilios_actuales`
--

DROP TABLE IF EXISTS `domicilios_actuales`;
CREATE TABLE IF NOT EXISTS `domicilios_actuales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perfil_id` int NOT NULL,
  `entidades_federativas_id` int NOT NULL,
  `municipios_id` int NOT NULL,
  `localidad` varchar(45) DEFAULT NULL,
  `calle` varchar(150) NOT NULL,
  `numero_exterior` varchar(15) NOT NULL,
  `numero_interior` varchar(15) DEFAULT NULL,
  `colonia` varchar(150) NOT NULL,
  `codigo_postal` varchar(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_domicilios_actuales_entidades_federativas1_idx` (`entidades_federativas_id`),
  KEY `fk_domicilios_actuales_municipios1_idx` (`municipios_id`),
  KEY `fk_domicilios_actuales_perfil1_idx` (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `domicilios_actuales`
--

INSERT INTO `domicilios_actuales` (`id`, `perfil_id`, `entidades_federativas_id`, `municipios_id`, `localidad`, `calle`, `numero_exterior`, `numero_interior`, `colonia`, `codigo_postal`) VALUES
(6, 31, 1, 2, 'Valladolid', '42', '213F', '', 'San Juan', '97783'),
(8, 31, 1, 2, 'Valladolid', '42', '213F', '', 'San Juan', '97783'),
(9, 32, 1, 2, 'Valladolid', '42', '213F', '', 'San Juan', '97783'),
(10, 33, 1, 2, 'Valladolid', '42', '213F', '', 'San Juan', '97783');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edades_hijos`
--

DROP TABLE IF EXISTS `edades_hijos`;
CREATE TABLE IF NOT EXISTS `edades_hijos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alum_info_hijos_id` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido_paterno` varchar(150) NOT NULL,
  `apellido_materno` varchar(150) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alumnos_edades_hijos_alum_info_hijos1_idx` (`alum_info_hijos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `edades_hijos`
--

INSERT INTO `edades_hijos` (`id`, `alum_info_hijos_id`, `nombre`, `apellido_paterno`, `apellido_materno`, `fecha_nacimiento`) VALUES
(83, 15, 'Johana', 'Olivo', 'Escobedo', '2000-08-21'),
(84, 16, 'Eduardo', 'Estrella', 'Olivo', '2027-07-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificios`
--

DROP TABLE IF EXISTS `edificios`;
CREATE TABLE IF NOT EXISTS `edificios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio_fisico`
--

DROP TABLE IF EXISTS `ejercicio_fisico`;
CREATE TABLE IF NOT EXISTS `ejercicio_fisico` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alum_ejercicio_id` int NOT NULL,
  `catalogo_actividad_ejercicio_id` int NOT NULL,
  `frecuencia_veces_semana_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ejercicio_fisico_alum_ejercicio1_idx` (`alum_ejercicio_id`),
  KEY `fk_ejercicio_fisico_catalogo_actividad_ejercicio1_idx` (`catalogo_actividad_ejercicio_id`),
  KEY `fk_ejercicio_fisico_frecuencia_veces_semana1_idx` (`frecuencia_veces_semana_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedades_cronicas`
--

DROP TABLE IF EXISTS `enfermedades_cronicas`;
CREATE TABLE IF NOT EXISTS `enfermedades_cronicas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alum_enfermedades_cronicas_id` int NOT NULL,
  `catalogo_enferm_cronicas_id` int NOT NULL,
  `otro_especificar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_enferm_cronica_catalogo_enferm_cronicas1_idx` (`catalogo_enferm_cronicas_id`),
  KEY `fk_enferm_cronica_alum_enfermedades_cronicas1_idx` (`alum_enfermedades_cronicas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidades_federativas`
--

DROP TABLE IF EXISTS `entidades_federativas`;
CREATE TABLE IF NOT EXISTS `entidades_federativas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `entidades_federativas`
--

INSERT INTO `entidades_federativas` (`id`, `nombre`) VALUES
(1, 'Yucatán'),
(2, 'Campeche'),
(3, 'Quintana Roo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

DROP TABLE IF EXISTS `equipos`;
CREATE TABLE IF NOT EXISTS `equipos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha_alta` datetime NOT NULL,
  `numero_inventario` varchar(50) NOT NULL,
  `numero_serie` varchar(100) DEFAULT NULL,
  `foto_equipo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `foto_numero_inventario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `foto_numero_serie` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `observaciones` text,
  `especificaciones` text,
  `modelos_id` int NOT NULL,
  `tipo_equipo_id` int NOT NULL,
  `tipo_alta_id` int NOT NULL,
  `estado_equipo_id` int NOT NULL,
  `marca_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_equipos_modelos1_idx` (`modelos_id`),
  KEY `fk_equipos_tipo_equipo1_idx` (`tipo_equipo_id`),
  KEY `fk_equipos_tipo_alta1_idx` (`tipo_alta_id`),
  KEY `fk_equipos_estado_equipo1_idx` (`estado_equipo_id`),
  KEY `fk_equipos_marcas` (`marca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `fecha_alta`, `numero_inventario`, `numero_serie`, `foto_equipo`, `foto_numero_inventario`, `foto_numero_serie`, `observaciones`, `especificaciones`, `modelos_id`, `tipo_equipo_id`, `tipo_alta_id`, `estado_equipo_id`, `marca_id`) VALUES
(10, '2025-12-08 00:42:37', '32432141234', '6874658657', '69361efdcca71_53613f1cfd140abdd42b01ca5a42024e.jpg', '69361efdccf85_il_fullxfull.3671126133_doj1.jpg', '69361efdcd4a9_Robin.jpg', 'NAI', 'Nai', 1, 1, 1, 2, 1),
(12, '2025-12-08 01:33:39', '34524325', '23454325', '69362af34dcc6_8d2c550b-39d6-4a3f-bcb2-9d51ca544f94.jpg', '69362af34e113_648658124-LEGO-NINJAGO---Minifigur-Kai.jpg', '69362af34e707_c0fbf45fcbeca248a44cfbdfc4e9e2b5.jpg', 'qweqwe', 'wqqwewq', 7, 2, 1, 2, 3),
(13, '2025-12-17 20:01:25', '10203040506070', '9879879786', '69430c158cea8_8d2c550b-39d6-4a3f-bcb2-9d51ca544f94.jpg', '69430c158d30e_c0fbf45fcbeca248a44cfbdfc4e9e2b5.jpg', '69430c158d88b_cr71.jpg', 'Ninguna observacion', 'Especificaciones ......', 4, 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `id` smallint NOT NULL AUTO_INCREMENT,
  `estado_nombre` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `estado_valor` smallint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `estado_nombre`, `estado_valor`) VALUES
(1, 'Activo', 10),
(2, 'Pendiente', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_ciclos_escolares`
--

DROP TABLE IF EXISTS `estados_ciclos_escolares`;
CREATE TABLE IF NOT EXISTS `estados_ciclos_escolares` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_civiles`
--

DROP TABLE IF EXISTS `estados_civiles`;
CREATE TABLE IF NOT EXISTS `estados_civiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estados_civiles`
--

INSERT INTO `estados_civiles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Soltero(a)', 'Persona que no ha contraído matrimonio legalmente.'),
(2, 'Casado(a)', 'Persona unida legalmente en matrimonio.'),
(3, 'Divorciado(a)', 'Persona cuyo vínculo matrimonial ha sido disuelto legalmente.'),
(4, 'Viudo(a)', 'Persona cuyo cónyuge ha fallecido.'),
(5, 'Unión libre', 'Persona que convive con otra en una relación estable sin matrimonio legal.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_equipo`
--

DROP TABLE IF EXISTS `estado_equipo`;
CREATE TABLE IF NOT EXISTS `estado_equipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estado_equipo`
--

INSERT INTO `estado_equipo` (`id`, `descripcion`) VALUES
(1, 'Funciona'),
(2, 'No Funciona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frecuencia_tiempo`
--

DROP TABLE IF EXISTS `frecuencia_tiempo`;
CREATE TABLE IF NOT EXISTS `frecuencia_tiempo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `frecuencia_tiempo`
--

INSERT INTO `frecuencia_tiempo` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Cada mes', 'Asisto al profesional de manera mensual para seguimiento o control de salud.'),
(2, 'Cada 3 meses', 'Realizo visitas trimestrales para revisiones periódicas o seguimiento de tratamientos específicos.'),
(3, 'Cada 6 meses', 'Realizo visitas semestrales para revisiones preventivas o seguimiento de tratamientos.'),
(4, 'Cada año', 'Acudo anualmente para chequeos rutinarios, control general o prevención de enfermedades.'),
(5, 'Solo cuando es necesario', 'Acudo únicamente ante la aparición de síntomas, malestar o necesidad específica de atención médica o dental.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frecuencia_veces`
--

DROP TABLE IF EXISTS `frecuencia_veces`;
CREATE TABLE IF NOT EXISTS `frecuencia_veces` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frecuencia_veces_semana`
--

DROP TABLE IF EXISTS `frecuencia_veces_semana`;
CREATE TABLE IF NOT EXISTS `frecuencia_veces_semana` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generaciones`
--

DROP TABLE IF EXISTS `generaciones`;
CREATE TABLE IF NOT EXISTS `generaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `anio_inicio` datetime NOT NULL,
  `anio_fin` datetime NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `generaciones`
--

INSERT INTO `generaciones` (`id`, `nombre`, `anio_inicio`, `anio_fin`, `descripcion`) VALUES
(1, 'Generacion 2025 - 2029', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Esta generación corresponde a los estudiantes que iniciaron sus estudios en el año 2025 y culminarán en el 2029'),
(2, 'Generacion 2026 - 2030', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Esta generación agrupa a los alumnos que comienzan su trayectoria académica en 2026 y concluirán en 2030');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `id` smallint NOT NULL AUTO_INCREMENT,
  `genero_nombre` varchar(45) COLLATE utf8mb3_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id`, `genero_nombre`) VALUES
(1, 'Masculino'),
(2, 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_traslado`
--

DROP TABLE IF EXISTS `historial_traslado`;
CREATE TABLE IF NOT EXISTS `historial_traslado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `equipos_id` int NOT NULL,
  `motivo_traslado` varchar(250) DEFAULT NULL,
  `departamento_origen_id` int DEFAULT NULL,
  `departamento_destino_id` int NOT NULL,
  `usuario_responsable` int DEFAULT NULL,
  `fecha_traslado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_historial_traslado_equipos1_idx` (`equipos_id`),
  KEY `fk_historial_traslado_departamentos1_idx` (`departamento_origen_id`),
  KEY `fk_historial_traslado_departamentos2_idx` (`departamento_destino_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licenciaturas`
--

DROP TABLE IF EXISTS `licenciaturas`;
CREATE TABLE IF NOT EXISTS `licenciaturas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `descripcion` varchar(800) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `licenciaturas`
--

INSERT INTO `licenciaturas` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Licenciatura en Educación Primaria Intercultural, Plurilingüe y Comunitaria', 'El Plan de Estudio es el documento base que enmarca el proceso de formación de maestras y maestros de educación preescolar para contextos indígenas, interculturales y plurilingües del Sistema Educativo Nacional. Describe las orientaciones fundamentales que permiten el mejor desarrollo de los contenidos curriculares en los contextos de la escuela normal y las escuelas de práctica, los elementos generales y específicos que lo conforman de acuerdo con los aportes de las teorías curriculares, ciencias de la educación y otras áreas del conocimiento, y con los enfoques y fundamentos del plan de estudios de educación básica enmarcados en la Nueva Escuela Mexicana.'),
(2, 'Licenciatura en Educación Primaria', 'El Plan de Estudio es el documento base que enmarca el proceso de formación de maestras y maestros de educación primaria del Sistema Educativo Nacional. Describe las orientaciones fundamentales que permiten el mejor desarrollo de los contenidos curriculares en los contextos de la escuela normal y las escuelas de práctica, los elementos generales y específicos que lo conforman de acuerdo con los aportes de las teorías curriculares, ciencias de la educación y otras áreas del conocimiento, y con los enfoques y fundamentos del plan de estudios de educación básica enmarcados en la Nueva Escuela Mexicana.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares_nacimiento`
--

DROP TABLE IF EXISTS `lugares_nacimiento`;
CREATE TABLE IF NOT EXISTS `lugares_nacimiento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perfil_id` int NOT NULL,
  `entidades_federativas_id` int NOT NULL,
  `municipios_id` int NOT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lugares_nacimiento_entidades_federativas1_idx` (`entidades_federativas_id`),
  KEY `fk_lugares_nacimiento_municipios1_idx` (`municipios_id`),
  KEY `fk_lugares_nacimiento_perfil1_idx` (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `lugares_nacimiento`
--

INSERT INTO `lugares_nacimiento` (`id`, `perfil_id`, `entidades_federativas_id`, `municipios_id`, `localidad`) VALUES
(6, 31, 2, 4, 'Campeche'),
(8, 31, 2, 6, 'Campeche'),
(9, 32, 1, 3, 'Tizimin'),
(10, 33, 1, 1, 'Mérida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `descripcion`) VALUES
(1, 'HP'),
(2, 'DELL'),
(3, 'LENOVO'),
(4, 'ACER'),
(5, 'Samsung');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1693618984),
('m130524_201442_init', 1693619006),
('m190124_110200_add_verification_token_column_to_user_table', 1693619007);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

DROP TABLE IF EXISTS `modelos`;
CREATE TABLE IF NOT EXISTS `modelos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `marcas_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_modelos_marcas1_idx` (`marcas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`id`, `descripcion`, `marcas_id`) VALUES
(1, 'Modelo 1', 1),
(4, 'Modelo 2', 1),
(5, 'Modelo 1', 3),
(7, 'Modelo 2', 3),
(8, 'Modelo 1', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

DROP TABLE IF EXISTS `municipios`;
CREATE TABLE IF NOT EXISTS `municipios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `entidades_federativas_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_municipios_entidades_federativas1_idx` (`entidades_federativas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `nombre`, `entidades_federativas_id`) VALUES
(1, 'Mérida', 1),
(2, 'Valladolid', 1),
(3, 'Tizimín', 1),
(4, 'Campeche', 2),
(5, 'Carmen', 2),
(6, 'Escárcega', 2),
(7, 'Chetumal', 3),
(8, 'Cancún', 3),
(9, 'Playa del Carmen', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalidades`
--

DROP TABLE IF EXISTS `nacionalidades`;
CREATE TABLE IF NOT EXISTS `nacionalidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `nacionalidades`
--

INSERT INTO `nacionalidades` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Mexicana', 'Personas originarias de México.'),
(2, 'Estadounidense', 'Personas originarias de Estados Unidos.'),
(3, 'Colombiana', 'Personas originarias de Colombia.'),
(4, 'Argentina', 'Personas originarias de Argentina.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organizaciones`
--

DROP TABLE IF EXISTS `organizaciones`;
CREATE TABLE IF NOT EXISTS `organizaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alum_organizacion_id` int NOT NULL,
  `catalogo_organizaciones_id` int NOT NULL,
  `otra_organizacion_especificar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_organizaciones_catalogo_organizaciones1_idx` (`catalogo_organizaciones_id`),
  KEY `fk_organizaciones_alum_organizacion1_idx` (`alum_organizacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `nombre` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `apellido` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero_id` smallint NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `genero_id_2` (`genero_id`),
  KEY `fk_perfil_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `user_id`, `nombre`, `apellido`, `fecha_nacimiento`, `genero_id`, `created_at`, `updated_at`) VALUES
(26, 26, 'Johana Yanet', 'Olivo Escobedo', '2000-09-11', 2, '2025-10-29 12:00:43', '2025-10-29 12:00:43'),
(29, 1, 'Eduardo Alexander', 'Estrella Escobedo', '2000-09-11', 1, '2025-12-09 17:49:54', '2025-12-09 17:49:54'),
(31, 29, 'Carlos Ali', 'Cuevas Escobedo', '2010-12-14', 1, '2025-12-09 23:56:30', '2025-12-10 02:01:44'),
(32, 30, 'Marco Antonio', 'Olivo Escobedo', '1996-08-15', 1, '2025-12-13 17:49:48', '2025-12-13 17:49:48'),
(33, 31, 'Eduardo Alexander', 'Estrella Escobedo', '2000-09-11', 1, '2025-12-16 13:47:00', '2025-12-16 13:47:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_estudios`
--

DROP TABLE IF EXISTS `plan_estudios`;
CREATE TABLE IF NOT EXISTS `plan_estudios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `anio` int NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `plan_estudios`
--

INSERT INTO `plan_estudios` (`id`, `nombre`, `anio`, `descripcion`) VALUES
(1, 'Planes de Estudio 2022', 2022, 'Este plan de estudios establece la estructura académica, los objetivos formativos y las líneas curriculares que guían la formación profesional de los futuros docentes conforme a los lineamientos educativos vigentes.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_licenciaturas`
--

DROP TABLE IF EXISTS `plan_licenciaturas`;
CREATE TABLE IF NOT EXISTS `plan_licenciaturas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plan_estudios_id` int NOT NULL,
  `licenciaturas_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_plan_licenciatura_plan_estudios1_idx` (`plan_estudios_id`),
  KEY `fk_plan_licenciatura_licenciaturas1_idx` (`licenciaturas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `plan_licenciaturas`
--

INSERT INTO `plan_licenciaturas` (`id`, `plan_estudios_id`, `licenciaturas_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_semestres`
--

DROP TABLE IF EXISTS `plan_semestres`;
CREATE TABLE IF NOT EXISTS `plan_semestres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plan_licenciatura_id` int NOT NULL,
  `semestres_id` int NOT NULL,
  `unidades_estudio_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_plan_semestres_unidades_estudio1_idx` (`unidades_estudio_id`),
  KEY `fk_plan_semestres_plan_licenciatura1_idx` (`plan_licenciatura_id`),
  KEY `fk_plan_semestres_semestres1_idx` (`semestres_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `problemas_salud`
--

DROP TABLE IF EXISTS `problemas_salud`;
CREATE TABLE IF NOT EXISTS `problemas_salud` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alum_estado_salud_id` int NOT NULL,
  `catalogo_problemas_salud_id` int NOT NULL,
  `otro_especificar` varchar(150) DEFAULT NULL,
  `tipo_gravedad_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_problemas_salud_alum_estado_salud1_idx` (`alum_estado_salud_id`),
  KEY `fk_problemas_salud_catalogo_problemas_salud1_idx` (`catalogo_problemas_salud_id`),
  KEY `fk_problemas_salud_tipo_gravedad1_idx` (`tipo_gravedad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `problemas_salud`
--

INSERT INTO `problemas_salud` (`id`, `alum_estado_salud_id`, `catalogo_problemas_salud_id`, `otro_especificar`, `tipo_gravedad_id`) VALUES
(52, 1, 3, NULL, 3),
(53, 1, 13, NULL, 1),
(72, 2, 3, NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id` smallint NOT NULL AUTO_INCREMENT,
  `rol_nombre` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `rol_valor` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol_nombre`, `rol_valor`) VALUES
(1, 'Usuario', 10),
(2, 'Admin', 20),
(7, 'SuperUsuario', 30),
(8, 'Alumno', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestres`
--

DROP TABLE IF EXISTS `semestres`;
CREATE TABLE IF NOT EXISTS `semestres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `tipo_semestres_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_semestres_tipo_semestres1_idx` (`tipo_semestres_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_salud`
--

DROP TABLE IF EXISTS `servicios_salud`;
CREATE TABLE IF NOT EXISTS `servicios_salud` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alum_servicios_salud_id` int NOT NULL,
  `catalogo_servicios_salud_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_servicios_salud_alum_servicios_salud1_idx` (`alum_servicios_salud_id`),
  KEY `fk_servicios_salud_catalogo_servicios_salud1_idx` (`catalogo_servicios_salud_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiempo_recorrido_transporte`
--

DROP TABLE IF EXISTS `tiempo_recorrido_transporte`;
CREATE TABLE IF NOT EXISTS `tiempo_recorrido_transporte` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rango_tiempo` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tiempo_recorrido_transporte`
--

INSERT INTO `tiempo_recorrido_transporte` (`id`, `rango_tiempo`, `descripcion`) VALUES
(1, '10–30 minutos', 'Traslado estimado entre 10 y 30 minutos desde el hogar hasta el destino.'),
(2, '31–60 minutos', 'Traslado estimado entre 31 minutos y 1 hora desde el hogar hasta el destino.'),
(3, '61–90 minutos', 'Traslado estimado entre 1 hora y 1 hora 30 minutos desde el hogar hasta el destino.'),
(4, '91–120 minutos', 'Traslado estimado entre 1 hora 31 minutos y 2 horas desde el hogar hasta el destino.'),
(5, 'Más de 120 minutos', 'Traslado estimado superior a 2 horas desde el hogar hasta el destino.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_becas`
--

DROP TABLE IF EXISTS `tipos_becas`;
CREATE TABLE IF NOT EXISTS `tipos_becas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipos_becas`
--

INSERT INTO `tipos_becas` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Otro (especificar)', 'Espacio para registrar becas adicionales, federales, estatales o institucionales no contempladas en el catálogo principal.'),
(2, 'Beca de Excelencia (Gobierno del Estado de Yucatán)', 'Apoyo estatal de hasta $1,200 pesos mensuales otorgado a estudiantes destacados en los ámbitos académico, artístico o deportivo. Las reglas de operación se publican en el Diario Oficial del Estado.'),
(3, 'Programa de Becas para Estudiantes Foráneos (Gobierno del Estado de Yucatán)', 'Apoyo estatal para estudiantes provenientes de municipios foráneos con promedio mínimo de 8.5 y condiciones económicas limitadas. Cubre manutención y gastos de transporte.'),
(4, 'Beca Juventud de Renacimiento – UADY', 'Programa institucional de la Universidad Autónoma de Yucatán que otorga $3,000 pesos bimestrales a estudiantes de licenciatura con alto rendimiento académico.'),
(5, 'Beca de Movilidad Internacional Yucatán', 'Apoyo estatal para estudiantes de nivel superior que realicen estancias académicas en el extranjero. Incluye gastos de transporte, seguro médico, hospedaje y apoyo para idiomas.'),
(6, 'Beca “Jóvenes Escribiendo el Futuro”', 'Apoyo federal de $5,800 pesos bimestrales dirigido a estudiantes de licenciatura o técnico superior universitario en universidades públicas prioritarias. Se gestiona a través de la plataforma SUBES.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_inscripciones`
--

DROP TABLE IF EXISTS `tipos_inscripciones`;
CREATE TABLE IF NOT EXISTS `tipos_inscripciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_tratamientos`
--

DROP TABLE IF EXISTS `tipos_tratamientos`;
CREATE TABLE IF NOT EXISTS `tipos_tratamientos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipos_tratamientos`
--

INSERT INTO `tipos_tratamientos` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Médico', 'Tratamientos realizados por profesionales de la salud con intervención clínica directa, incluyendo farmacología, procedimientos médicos y monitoreo de signos vitales.'),
(2, 'Psicológico', 'Intervenciones terapéuticas orientadas a la modificación de conductas, manejo emocional y desarrollo de habilidades cognitivas y sociales, mediante técnicas psicoterapéuticas individuales o grupales.'),
(3, 'Psiquiátrico', 'Tratamientos que incluyen diagnóstico, medicación y seguimiento de trastornos mentales por profesionales de psiquiatría, con enfoque integral en la salud mental del paciente.'),
(4, 'Rehabilitación', 'Intervenciones dirigidas a la recuperación funcional y mejora de la calidad de vida, incluyendo terapia física, ocupacional y cognitiva, tras enfermedades, lesiones o cirugías.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_viviendas`
--

DROP TABLE IF EXISTS `tipos_viviendas`;
CREATE TABLE IF NOT EXISTS `tipos_viviendas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipos_viviendas`
--

INSERT INTO `tipos_viviendas` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Propia', 'Vivienda que pertenece a la persona o a algún integrante de su familia, ya sea totalmente pagada o en proceso de pago.'),
(2, 'Rentada', 'Vivienda ocupada mediante el pago periódico de una renta o alquiler a un propietario.'),
(3, 'Prestada', 'Vivienda cedida temporalmente por familiares, amigos o terceros sin pago de renta.'),
(4, 'Otro', 'Tipo de vivienda que no encaja en las categorías anteriores, como vivienda institucional o en comodato especial.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_alergias`
--

DROP TABLE IF EXISTS `tipo_alergias`;
CREATE TABLE IF NOT EXISTS `tipo_alergias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_alergias`
--

INSERT INTO `tipo_alergias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Alergia alimentaria', 'Reacción del sistema inmunitario ante el consumo de ciertos alimentos o componentes alimenticios.'),
(2, 'Alergia farmacológica', 'Respuesta inmunitaria adversa al uso de medicamentos o fármacos específicos.'),
(3, 'Alergia ambiental', 'Sensibilidad a partículas o sustancias presentes en el ambiente como polvo, polen o moho.'),
(4, 'Alergia por picadura de insecto', 'Reacción local o sistémica al veneno de abejas, avispas u otros insectos.'),
(5, 'Alergia por contacto', 'Inflamación o irritación de la piel causada por contacto directo con materiales o productos químicos.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_alta`
--

DROP TABLE IF EXISTS `tipo_alta`;
CREATE TABLE IF NOT EXISTS `tipo_alta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_alta`
--

INSERT INTO `tipo_alta` (`id`, `descripcion`) VALUES
(1, 'Compra'),
(2, 'Donacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_baja`
--

DROP TABLE IF EXISTS `tipo_baja`;
CREATE TABLE IF NOT EXISTS `tipo_baja` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_equipo`
--

DROP TABLE IF EXISTS `tipo_equipo`;
CREATE TABLE IF NOT EXISTS `tipo_equipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_equipo`
--

INSERT INTO `tipo_equipo` (`id`, `descripcion`) VALUES
(1, 'Laptop'),
(2, 'Pc Escritorio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_gravedad`
--

DROP TABLE IF EXISTS `tipo_gravedad`;
CREATE TABLE IF NOT EXISTS `tipo_gravedad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_gravedad`
--

INSERT INTO `tipo_gravedad` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Leve', 'La condición o alergia presenta síntomas mínimos que no interfieren significativamente con las actividades diarias y no requieren intervención urgente.'),
(2, 'Moderada', 'La condición o alergia causa síntomas evidentes que afectan algunas actividades diarias y puede requerir tratamiento o seguimiento médico.'),
(3, 'Grave', 'La condición o alergia provoca síntomas intensos que limitan actividades diarias y requieren atención médica inmediata o tratamiento especializado.'),
(4, 'Crítica / potencialmente peligrosa', 'La condición o alergia presenta riesgo alto para la salud, pudiendo poner en peligro la vida, y requiere intervención médica urgente o continua.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_organizacion`
--

DROP TABLE IF EXISTS `tipo_organizacion`;
CREATE TABLE IF NOT EXISTS `tipo_organizacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_semestres`
--

DROP TABLE IF EXISTS `tipo_semestres`;
CREATE TABLE IF NOT EXISTS `tipo_semestres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id` smallint NOT NULL AUTO_INCREMENT,
  `tipo_usuario_nombre` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tipo_usuario_valor` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `tipo_usuario_nombre`, `tipo_usuario_valor`) VALUES
(1, 'Gratuito', 10),
(2, 'Pago', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

DROP TABLE IF EXISTS `tratamientos`;
CREATE TABLE IF NOT EXISTS `tratamientos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alum_tratamientos_id` int NOT NULL,
  `catalogo_tratamientos_id` int NOT NULL,
  `frecuencia_tiempo_id` int NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tratamientos_frecuencia_tiempo1_idx` (`frecuencia_tiempo_id`),
  KEY `fk_tratamientos_alum_tratamientos1_idx` (`alum_tratamientos_id`),
  KEY `fk_tratamientos_catalogo_tratamientos1_idx` (`catalogo_tratamientos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tratamientos`
--

INSERT INTO `tratamientos` (`id`, `alum_tratamientos_id`, `catalogo_tratamientos_id`, `frecuencia_tiempo_id`, `fecha_inicio`, `fecha_fin`) VALUES
(6, 3, 4, 2, '0000-00-00', '2025-12-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades_estudio`
--

DROP TABLE IF EXISTS `unidades_estudio`;
CREATE TABLE IF NOT EXISTS `unidades_estudio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `semestres_id` int NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion_general` varchar(1000) NOT NULL,
  `creditos` double NOT NULL,
  `horas_semana` int NOT NULL,
  `horas_semestre` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_unidades_estudio_semestres1_idx` (`semestres_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `rol_id` smallint NOT NULL DEFAULT '8',
  `estado_id` smallint NOT NULL DEFAULT '2',
  `tipo_usuario_id` smallint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `id` (`id`),
  KEY `fk_user_rol1_idx` (`rol_id`),
  KEY `fk_user_estado1_idx` (`estado_id`),
  KEY `fk_user_tipo_usuario1_idx` (`tipo_usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `rol_id`, `estado_id`, `tipo_usuario_id`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'root', 'pQeZefuxsI0kiGxn_OKI6IXdBznTmWF9', '$2y$13$M0AvNyw666uh452dv5sdJOLimBesSgRNjdFTGZFCXEEf0rsnEVohm', NULL, 'root@root.com', 7, 1, 2, '2025-08-30 14:25:57', '2025-08-30 14:25:57', 'WnDqUcudrydqtx7rhS8QrZ5P8m-a8mMn_1756585557'),
(26, 'johana.yoe', 'PzTemzgTZKveVWSHE6UTzF8lJqMbHWZ7', '$2y$13$axpISi3AcdTxLk1BuNc/H.tGKKoRdZ673ZjBLUiBQYfI.zbmOnYi.', NULL, 'johana.yoe@gmail.com', 8, 1, 1, '2025-10-29 12:00:43', '2025-10-29 12:00:43', 'XwGy3jBkvTHNEsy97WRRGLZVWZWmd1qp_1761760843'),
(29, 'carlos.ace', 'h2SRbOVdxnd0eL3ngqOW8yxUS1qCOcFU', '$2y$13$VWscFcX3qxJwd.wKWC1uhOyJKFaONycb4R3LH3WKwBcPWn96TE5yS', NULL, 'carlos.ace@gmail.com', 8, 1, 2, '2025-12-09 23:52:33', '2025-12-09 23:53:09', 'yLmFc_9bCE4hH04uDIUrg7SeptenoK9e_1765345953'),
(30, 'marco.aoe', 'JLZ4iNYFf0zQg_1hSDyBdIODXveH5r4_', '$2y$13$mbJUUM8f849ZiWelWCKe9uH.wz9WuGvX4Pft2j/mnEnPiIsJQgxoO', NULL, 'marco.aoe@gmail.com', 8, 1, 1, '2025-12-13 17:49:48', '2025-12-13 17:49:56', 'Ej6npuLB9UUm3Q5KgQUlFBTngZYtxDfu_1765669788'),
(31, 'Eduardo.aee', 'lphxkbEX2_Vut6jp6wNjjXHWObAASIKq', '$2y$13$CaCag859DGO9wYNhKl5cmujEOzVXZ9Y5T6WHWsaUmDsGho/bkieKi', NULL, 'Eduardo.aee@gmail.com', 8, 1, 2, '2025-12-16 13:46:59', '2025-12-16 14:28:36', 'Hg51pBb0sjMfvbNOCJhXw-UcpGHMm-Op_1765914419');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usos_internet`
--

DROP TABLE IF EXISTS `usos_internet`;
CREATE TABLE IF NOT EXISTS `usos_internet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alum_recreacion_tiempo_id` int NOT NULL,
  `catalogo_usos_internet_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usos_internet_alum_recreacion_tiempo1_idx` (`alum_recreacion_tiempo_id`),
  KEY `fk_usos_internet_catalogo_usos_internet1_idx` (`catalogo_usos_internet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uso_anteojos`
--

DROP TABLE IF EXISTS `uso_anteojos`;
CREATE TABLE IF NOT EXISTS `uso_anteojos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alum_uso_anteojos_id` int NOT NULL,
  `catalogo_uso_anteojos_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_uso_anteojos_catalogo_uso_anteojos1_idx` (`catalogo_uso_anteojos_id`),
  KEY `fk_uso_anteojos_alum_uso_anteojos1_idx` (`alum_uso_anteojos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `uso_anteojos`
--

INSERT INTO `uso_anteojos` (`id`, `alum_uso_anteojos_id`, `catalogo_uso_anteojos_id`) VALUES
(14, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `varias_reacciones_alergicas`
--

DROP TABLE IF EXISTS `varias_reacciones_alergicas`;
CREATE TABLE IF NOT EXISTS `varias_reacciones_alergicas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alergias_id` int NOT NULL,
  `catalogo_reacciones_alergicas_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_varias_reacciones_alergicas_alergias1_idx` (`alergias_id`),
  KEY `fk_varias_reacciones_alergicas_catalogo_reacciones_alergica_idx` (`catalogo_reacciones_alergicas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vivienda_bienes`
--

DROP TABLE IF EXISTS `vivienda_bienes`;
CREATE TABLE IF NOT EXISTS `vivienda_bienes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alum_vivienda_id` int NOT NULL,
  `catalogo_bienes_vivienda_id` int NOT NULL,
  `otro_especificar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vivienda_bienes_alum_vivienda1_idx` (`alum_vivienda_id`),
  KEY `fk_vivienda_bienes_catalogo_bienes_vivienda1_idx` (`catalogo_bienes_vivienda_id`)
) ENGINE=InnoDB AUTO_INCREMENT=302 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `vivienda_bienes`
--

INSERT INTO `vivienda_bienes` (`id`, `alum_vivienda_id`, `catalogo_bienes_vivienda_id`, `otro_especificar`) VALUES
(41, 2, 6, NULL),
(42, 2, 2, NULL),
(43, 2, 9, NULL),
(44, 2, 5, NULL),
(153, 3, 6, NULL),
(154, 3, 2, NULL),
(155, 3, 9, NULL),
(156, 3, 11, 'Licuadora'),
(157, 3, 1, NULL),
(158, 3, 8, NULL),
(291, 4, 6, NULL),
(292, 4, 7, NULL),
(293, 4, 10, NULL),
(294, 4, 2, NULL),
(295, 4, 3, NULL),
(296, 4, 4, NULL),
(297, 4, 9, NULL),
(298, 4, 11, 'OTRO BIEN'),
(299, 4, 1, NULL),
(300, 4, 5, NULL),
(301, 4, 8, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vivienda_servicios`
--

DROP TABLE IF EXISTS `vivienda_servicios`;
CREATE TABLE IF NOT EXISTS `vivienda_servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alum_vivienda_id` int NOT NULL,
  `catalogo_servicios_vivienda_id` int NOT NULL,
  `otro_especificar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vivienda_servicios_catalogo_servicios_vivienda1_idx` (`catalogo_servicios_vivienda_id`),
  KEY `fk_vivienda_servicios_alum_vivienda1_idx` (`alum_vivienda_id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `vivienda_servicios`
--

INSERT INTO `vivienda_servicios` (`id`, `alum_vivienda_id`, `catalogo_servicios_vivienda_id`, `otro_especificar`) VALUES
(61, 3, 1, NULL),
(62, 3, 2, NULL),
(63, 3, 3, NULL),
(64, 3, 4, 'Cablevision'),
(113, 4, 1, NULL),
(114, 4, 2, NULL),
(115, 4, 3, NULL),
(116, 4, 4, 'OTRO SERVICIO');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alergias`
--
ALTER TABLE `alergias`
  ADD CONSTRAINT `fk_alergias_alum_alergia1` FOREIGN KEY (`alum_alergia_id`) REFERENCES `alum_alergia` (`id`),
  ADD CONSTRAINT `fk_alergias_catalogo_alergias1` FOREIGN KEY (`catalogo_alergias_id`) REFERENCES `catalogo_alergias` (`id`),
  ADD CONSTRAINT `fk_alergias_tipo_gravedad1` FOREIGN KEY (`tipo_gravedad_id`) REFERENCES `tipo_gravedad` (`id`);

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `fk_alumnos_generaciones1` FOREIGN KEY (`generaciones_id`) REFERENCES `generaciones` (`id`),
  ADD CONSTRAINT `fk_alumnos_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_alumnos_plan_licenciaturas1` FOREIGN KEY (`plan_licenciaturas_id`) REFERENCES `plan_licenciaturas` (`id`);

--
-- Filtros para la tabla `alum_alergia`
--
ALTER TABLE `alum_alergia`
  ADD CONSTRAINT `fk_alum_alergia_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `alum_asiste_dentista`
--
ALTER TABLE `alum_asiste_dentista`
  ADD CONSTRAINT `fk_alum_asiste_dentista_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `fk_alum_asiste_dentista_frecuencia_tiempo1` FOREIGN KEY (`frecuencia_tiempo_id`) REFERENCES `frecuencia_tiempo` (`id`);

--
-- Filtros para la tabla `alum_asiste_medico`
--
ALTER TABLE `alum_asiste_medico`
  ADD CONSTRAINT `fk_alum_asiste_medico_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `fk_alum_asiste_medico_frecuencia_tiempo1` FOREIGN KEY (`frecuencia_tiempo_id`) REFERENCES `frecuencia_tiempo` (`id`);

--
-- Filtros para la tabla `alum_becas`
--
ALTER TABLE `alum_becas`
  ADD CONSTRAINT `fk_alumnos_becas_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `fk_alumnos_becas_tipos_becas1` FOREIGN KEY (`tipos_becas_id`) REFERENCES `tipos_becas` (`id`);

--
-- Filtros para la tabla `alum_bienes_personales`
--
ALTER TABLE `alum_bienes_personales`
  ADD CONSTRAINT `fk_alum_bienes_personales_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `fk_alum_bienes_personales_catalogo_bienes_personales1` FOREIGN KEY (`catalogo_bienes_personales_id`) REFERENCES `catalogo_bienes_personales` (`id`);

--
-- Filtros para la tabla `alum_consumo_alimentos`
--
ALTER TABLE `alum_consumo_alimentos`
  ADD CONSTRAINT `fk_alum_consumo_alimentos_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `fk_alum_consumo_alimentos_catalogo_alimentos1` FOREIGN KEY (`catalogo_alimentos_id`) REFERENCES `catalogo_alimentos` (`id`),
  ADD CONSTRAINT `fk_alum_consumo_alimentos_frecuencia_veces1` FOREIGN KEY (`frecuencia_veces_id`) REFERENCES `frecuencia_veces` (`id`);

--
-- Filtros para la tabla `alum_datos_familiares`
--
ALTER TABLE `alum_datos_familiares`
  ADD CONSTRAINT `fk_alum_datos_familiares_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `alum_dependen_economica`
--
ALTER TABLE `alum_dependen_economica`
  ADD CONSTRAINT `fk_alum_dependen_economica_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `alum_depende_economicamente`
--
ALTER TABLE `alum_depende_economicamente`
  ADD CONSTRAINT `fk_alum_depende_economicamente_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `fk_alum_depende_economicamente_catalogo_dependencias_economic1` FOREIGN KEY (`catalogo_dependencias_economicas_id`) REFERENCES `catalogo_dependencias_economicas` (`id`);

--
-- Filtros para la tabla `alum_deportes`
--
ALTER TABLE `alum_deportes`
  ADD CONSTRAINT `fk_alum_deportes_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `alum_ejercicio`
--
ALTER TABLE `alum_ejercicio`
  ADD CONSTRAINT `fk_alum_ejercicio_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `alum_enfermedades_cronicas`
--
ALTER TABLE `alum_enfermedades_cronicas`
  ADD CONSTRAINT `fk_alum_enfermedades_cronicas_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `alum_estado_salud`
--
ALTER TABLE `alum_estado_salud`
  ADD CONSTRAINT `fk_alum_estado_salud_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `alum_habitos_consumo`
--
ALTER TABLE `alum_habitos_consumo`
  ADD CONSTRAINT `fk_alum_habitos_consumo_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `fk_alum_habitos_consumo_catalogo_cigarros_dia1` FOREIGN KEY (`catalogo_cigarros_dia_id`) REFERENCES `catalogo_cigarros_dia` (`id`),
  ADD CONSTRAINT `fk_alum_habitos_consumo_frecuencia_veces_semana1` FOREIGN KEY (`frecuencia_veces_semana_id`) REFERENCES `frecuencia_veces_semana` (`id`);

--
-- Filtros para la tabla `alum_info_hijos`
--
ALTER TABLE `alum_info_hijos`
  ADD CONSTRAINT `fk_alumnos_info_hijos_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `alum_inscripciones`
--
ALTER TABLE `alum_inscripciones`
  ADD CONSTRAINT `fk_alum_inscripciones_ciclos_semestres1` FOREIGN KEY (`ciclos_semestres_id`) REFERENCES `ciclos_semestres` (`id`),
  ADD CONSTRAINT `fk_alumnos_inscripciones_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `fk_alumnos_inscripciones_tipos_inscripciones1` FOREIGN KEY (`tipos_inscripciones_id`) REFERENCES `tipos_inscripciones` (`id`);

--
-- Filtros para la tabla `alum_lugares_comer`
--
ALTER TABLE `alum_lugares_comer`
  ADD CONSTRAINT `fk_alum_lugares_comer_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `fk_alum_lugares_comer_catalogo_lugares_comer1` FOREIGN KEY (`catalogo_lugares_comer_id`) REFERENCES `catalogo_lugares_comer` (`id`);

--
-- Filtros para la tabla `alum_organizacion`
--
ALTER TABLE `alum_organizacion`
  ADD CONSTRAINT `fk_alum_organizacion_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `alum_recreacion_tiempo`
--
ALTER TABLE `alum_recreacion_tiempo`
  ADD CONSTRAINT `fk_alum_recreacion_tiempo_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `fk_alum_recreacion_tiempo_catalogo_lugares_acceso_principal1` FOREIGN KEY (`catalogo_lugares_acceso_principal_id`) REFERENCES `catalogo_lugares_acceso_principal` (`id`);

--
-- Filtros para la tabla `alum_servicios_salud`
--
ALTER TABLE `alum_servicios_salud`
  ADD CONSTRAINT `fk_alum_servicios_salud_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `alum_trabajo`
--
ALTER TABLE `alum_trabajo`
  ADD CONSTRAINT `fk_alumnos_trabaja_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `alum_transportes`
--
ALTER TABLE `alum_transportes`
  ADD CONSTRAINT `fk_alum_transportes_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `fk_alum_transportes_catalogo_transportes1` FOREIGN KEY (`catalogo_transportes_id`) REFERENCES `catalogo_transportes` (`id`),
  ADD CONSTRAINT `fk_alum_transportes_tiempo_recorrido_transporte1` FOREIGN KEY (`tiempo_recorrido_transporte_id`) REFERENCES `tiempo_recorrido_transporte` (`id`);

--
-- Filtros para la tabla `alum_tratamientos`
--
ALTER TABLE `alum_tratamientos`
  ADD CONSTRAINT `fk_alum_tratamientos_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `alum_uso_anteojos`
--
ALTER TABLE `alum_uso_anteojos`
  ADD CONSTRAINT `fk_alum_uso_anteojos_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `alum_vivienda`
--
ALTER TABLE `alum_vivienda`
  ADD CONSTRAINT `fk_alum_vivienda_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `fk_alum_vivienda_tipos_viviendas1` FOREIGN KEY (`tipos_viviendas_id`) REFERENCES `tipos_viviendas` (`id`);

--
-- Filtros para la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD CONSTRAINT `fk_asignacion_departamentos1` FOREIGN KEY (`departamentos_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `fk_asignacion_equipos1` FOREIGN KEY (`equipos_id`) REFERENCES `equipos` (`id`);

--
-- Filtros para la tabla `asignaciones_alumnos_grupos`
--
ALTER TABLE `asignaciones_alumnos_grupos`
  ADD CONSTRAINT `fk_asignaciones_alumnos_grupos_alum_inscripciones1` FOREIGN KEY (`alum_inscripciones_id`) REFERENCES `alum_inscripciones` (`id`),
  ADD CONSTRAINT `fk_asignaciones_alumnos_grupos_asignaciones_grupos1` FOREIGN KEY (`asignaciones_grupos_id`) REFERENCES `asignaciones_grupos` (`id`);

--
-- Filtros para la tabla `asignaciones_grupos`
--
ALTER TABLE `asignaciones_grupos`
  ADD CONSTRAINT `fk_asignacioes_grupos_asignaciones_tutores1` FOREIGN KEY (`asignaciones_tutores_id`) REFERENCES `asignaciones_tutores` (`id`),
  ADD CONSTRAINT `fk_asignacioes_grupos_grupos1` FOREIGN KEY (`grupos_id`) REFERENCES `grupos` (`id`),
  ADD CONSTRAINT `fk_asignaciones_grupos_ciclos_semestres1` FOREIGN KEY (`ciclos_semestres_id`) REFERENCES `ciclos_semestres` (`id`);

--
-- Filtros para la tabla `asignaciones_tutores`
--
ALTER TABLE `asignaciones_tutores`
  ADD CONSTRAINT `fk_asignaciones_tutores_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`);

--
-- Filtros para la tabla `baja_equipo`
--
ALTER TABLE `baja_equipo`
  ADD CONSTRAINT `fk_baja_equipo_equipos1` FOREIGN KEY (`equipos_id`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `fk_baja_equipo_tipo_baja1` FOREIGN KEY (`tipo_baja_id`) REFERENCES `tipo_baja` (`id`);

--
-- Filtros para la tabla `catalogo_alergias`
--
ALTER TABLE `catalogo_alergias`
  ADD CONSTRAINT `fk_catalogo_alergias_tipo_alergias1` FOREIGN KEY (`tipo_alergias_id`) REFERENCES `tipo_alergias` (`id`);

--
-- Filtros para la tabla `catalogo_alimentos`
--
ALTER TABLE `catalogo_alimentos`
  ADD CONSTRAINT `fk_catalogo_alimentos_categorias_catalogo_alimentos1` FOREIGN KEY (`categorias_catalogo_alimentos_id`) REFERENCES `categorias_catalogo_alimentos` (`id`);

--
-- Filtros para la tabla `catalogo_dependencias_economicas`
--
ALTER TABLE `catalogo_dependencias_economicas`
  ADD CONSTRAINT `fk_catalogo_dependencias_economicas_categorias_dependencias1` FOREIGN KEY (`categorias_dependencias_id`) REFERENCES `categorias_dependencias` (`id`);

--
-- Filtros para la tabla `catalogo_organizaciones`
--
ALTER TABLE `catalogo_organizaciones`
  ADD CONSTRAINT `fk_catalogo_organizaciones_tipo_organizacion1` FOREIGN KEY (`tipo_organizacion_id`) REFERENCES `tipo_organizacion` (`id`);

--
-- Filtros para la tabla `catalogo_tratamientos`
--
ALTER TABLE `catalogo_tratamientos`
  ADD CONSTRAINT `fk_catalogo_tratamientos_tipos_tratamientos1` FOREIGN KEY (`tipos_tratamientos_id`) REFERENCES `tipos_tratamientos` (`id`);

--
-- Filtros para la tabla `ciclos_escolares`
--
ALTER TABLE `ciclos_escolares`
  ADD CONSTRAINT `fk_ciclos_escolares_estados_ciclos_escolares1` FOREIGN KEY (`estados_ciclos_escolares_id`) REFERENCES `estados_ciclos_escolares` (`id`);

--
-- Filtros para la tabla `ciclos_semestres`
--
ALTER TABLE `ciclos_semestres`
  ADD CONSTRAINT `fk_ciclos_semestres_ciclos_escolares1` FOREIGN KEY (`ciclos_escolares_id`) REFERENCES `ciclos_escolares` (`id`),
  ADD CONSTRAINT `fk_ciclos_semestres_semestres1` FOREIGN KEY (`semestres_id`) REFERENCES `semestres` (`id`);

--
-- Filtros para la tabla `datos_generales`
--
ALTER TABLE `datos_generales`
  ADD CONSTRAINT `fk_datos_generales_estados_civiles1` FOREIGN KEY (`estados_civiles_id`) REFERENCES `estados_civiles` (`id`),
  ADD CONSTRAINT `fk_datos_generales_nacionalidades1` FOREIGN KEY (`nacionalidades_id`) REFERENCES `nacionalidades` (`id`),
  ADD CONSTRAINT `fk_datos_generales_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`);

--
-- Filtros para la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD CONSTRAINT `fk_datos_personales_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `fk_departamentos_edificios1` FOREIGN KEY (`edificios_id`) REFERENCES `edificios` (`id`);

--
-- Filtros para la tabla `dependientes`
--
ALTER TABLE `dependientes`
  ADD CONSTRAINT `fk_dependen_alumno_alum_dependen_economica1` FOREIGN KEY (`alum_dependen_economica_id`) REFERENCES `alum_dependen_economica` (`id`),
  ADD CONSTRAINT `fk_dependen_alumno_catalogo_dependencias_economicas1` FOREIGN KEY (`catalogo_dependencias_economicas_id`) REFERENCES `catalogo_dependencias_economicas` (`id`);

--
-- Filtros para la tabla `deportes`
--
ALTER TABLE `deportes`
  ADD CONSTRAINT `fk_deportes_alum_deportes1` FOREIGN KEY (`alum_deportes_id`) REFERENCES `alum_deportes` (`id`),
  ADD CONSTRAINT `fk_deportes_catalogo_deportes1` FOREIGN KEY (`catalogo_deportes_id`) REFERENCES `catalogo_deportes` (`id`);

--
-- Filtros para la tabla `domicilios_actuales`
--
ALTER TABLE `domicilios_actuales`
  ADD CONSTRAINT `fk_domicilios_actuales_entidades_federativas1` FOREIGN KEY (`entidades_federativas_id`) REFERENCES `entidades_federativas` (`id`),
  ADD CONSTRAINT `fk_domicilios_actuales_municipios1` FOREIGN KEY (`municipios_id`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `fk_domicilios_actuales_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `edades_hijos`
--
ALTER TABLE `edades_hijos`
  ADD CONSTRAINT `fk_alumnos_edades_hijos_alum_info_hijos1` FOREIGN KEY (`alum_info_hijos_id`) REFERENCES `alum_info_hijos` (`id`);

--
-- Filtros para la tabla `ejercicio_fisico`
--
ALTER TABLE `ejercicio_fisico`
  ADD CONSTRAINT `fk_ejercicio_fisico_alum_ejercicio1` FOREIGN KEY (`alum_ejercicio_id`) REFERENCES `alum_ejercicio` (`id`),
  ADD CONSTRAINT `fk_ejercicio_fisico_catalogo_actividad_ejercicio1` FOREIGN KEY (`catalogo_actividad_ejercicio_id`) REFERENCES `catalogo_actividad_ejercicio` (`id`),
  ADD CONSTRAINT `fk_ejercicio_fisico_frecuencia_veces_semana1` FOREIGN KEY (`frecuencia_veces_semana_id`) REFERENCES `frecuencia_veces_semana` (`id`);

--
-- Filtros para la tabla `enfermedades_cronicas`
--
ALTER TABLE `enfermedades_cronicas`
  ADD CONSTRAINT `fk_enferm_cronica_alum_enfermedades_cronicas1` FOREIGN KEY (`alum_enfermedades_cronicas_id`) REFERENCES `alum_enfermedades_cronicas` (`id`),
  ADD CONSTRAINT `fk_enferm_cronica_catalogo_enferm_cronicas1` FOREIGN KEY (`catalogo_enferm_cronicas_id`) REFERENCES `catalogo_enferm_cronicas` (`id`);

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `fk_equipos_estado_equipo1` FOREIGN KEY (`estado_equipo_id`) REFERENCES `estado_equipo` (`id`),
  ADD CONSTRAINT `fk_equipos_marcas` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`),
  ADD CONSTRAINT `fk_equipos_modelos1` FOREIGN KEY (`modelos_id`) REFERENCES `modelos` (`id`),
  ADD CONSTRAINT `fk_equipos_tipo_alta1` FOREIGN KEY (`tipo_alta_id`) REFERENCES `tipo_alta` (`id`),
  ADD CONSTRAINT `fk_equipos_tipo_equipo1` FOREIGN KEY (`tipo_equipo_id`) REFERENCES `tipo_equipo` (`id`);

--
-- Filtros para la tabla `historial_traslado`
--
ALTER TABLE `historial_traslado`
  ADD CONSTRAINT `fk_historial_traslado_departamentos1` FOREIGN KEY (`departamento_origen_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `fk_historial_traslado_departamentos2` FOREIGN KEY (`departamento_destino_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `fk_historial_traslado_equipos1` FOREIGN KEY (`equipos_id`) REFERENCES `equipos` (`id`);

--
-- Filtros para la tabla `lugares_nacimiento`
--
ALTER TABLE `lugares_nacimiento`
  ADD CONSTRAINT `fk_lugares_nacimiento_entidades_federativas1` FOREIGN KEY (`entidades_federativas_id`) REFERENCES `entidades_federativas` (`id`),
  ADD CONSTRAINT `fk_lugares_nacimiento_municipios1` FOREIGN KEY (`municipios_id`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `fk_lugares_nacimiento_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `fk_modelos_marcas1` FOREIGN KEY (`marcas_id`) REFERENCES `marcas` (`id`);

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `fk_municipios_entidades_federativas1` FOREIGN KEY (`entidades_federativas_id`) REFERENCES `entidades_federativas` (`id`);

--
-- Filtros para la tabla `organizaciones`
--
ALTER TABLE `organizaciones`
  ADD CONSTRAINT `fk_organizaciones_alum_organizacion1` FOREIGN KEY (`alum_organizacion_id`) REFERENCES `alum_organizacion` (`id`),
  ADD CONSTRAINT `fk_organizaciones_catalogo_organizaciones1` FOREIGN KEY (`catalogo_organizaciones_id`) REFERENCES `catalogo_organizaciones` (`id`);

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `fk_perfil_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `plan_licenciaturas`
--
ALTER TABLE `plan_licenciaturas`
  ADD CONSTRAINT `fk_plan_licenciatura_licenciaturas1` FOREIGN KEY (`licenciaturas_id`) REFERENCES `licenciaturas` (`id`),
  ADD CONSTRAINT `fk_plan_licenciatura_plan_estudios1` FOREIGN KEY (`plan_estudios_id`) REFERENCES `plan_estudios` (`id`);

--
-- Filtros para la tabla `plan_semestres`
--
ALTER TABLE `plan_semestres`
  ADD CONSTRAINT `fk_plan_semestres_plan_licenciatura1` FOREIGN KEY (`plan_licenciatura_id`) REFERENCES `plan_licenciaturas` (`id`),
  ADD CONSTRAINT `fk_plan_semestres_semestres1` FOREIGN KEY (`semestres_id`) REFERENCES `semestres` (`id`),
  ADD CONSTRAINT `fk_plan_semestres_unidades_estudio1` FOREIGN KEY (`unidades_estudio_id`) REFERENCES `unidades_estudio` (`id`);

--
-- Filtros para la tabla `problemas_salud`
--
ALTER TABLE `problemas_salud`
  ADD CONSTRAINT `fk_problemas_salud_alum_estado_salud1` FOREIGN KEY (`alum_estado_salud_id`) REFERENCES `alum_estado_salud` (`id`),
  ADD CONSTRAINT `fk_problemas_salud_catalogo_problemas_salud1` FOREIGN KEY (`catalogo_problemas_salud_id`) REFERENCES `catalogo_problemas_salud` (`id`),
  ADD CONSTRAINT `fk_problemas_salud_tipo_gravedad1` FOREIGN KEY (`tipo_gravedad_id`) REFERENCES `tipo_gravedad` (`id`);

--
-- Filtros para la tabla `semestres`
--
ALTER TABLE `semestres`
  ADD CONSTRAINT `fk_semestres_tipo_semestres1` FOREIGN KEY (`tipo_semestres_id`) REFERENCES `tipo_semestres` (`id`);

--
-- Filtros para la tabla `servicios_salud`
--
ALTER TABLE `servicios_salud`
  ADD CONSTRAINT `fk_servicios_salud_alum_servicios_salud1` FOREIGN KEY (`alum_servicios_salud_id`) REFERENCES `alum_servicios_salud` (`id`),
  ADD CONSTRAINT `fk_servicios_salud_catalogo_servicios_salud1` FOREIGN KEY (`catalogo_servicios_salud_id`) REFERENCES `catalogo_servicios_salud` (`id`);

--
-- Filtros para la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD CONSTRAINT `fk_tratamientos_alum_tratamientos1` FOREIGN KEY (`alum_tratamientos_id`) REFERENCES `alum_tratamientos` (`id`),
  ADD CONSTRAINT `fk_tratamientos_catalogo_tratamientos1` FOREIGN KEY (`catalogo_tratamientos_id`) REFERENCES `catalogo_tratamientos` (`id`),
  ADD CONSTRAINT `fk_tratamientos_frecuencia_tiempo1` FOREIGN KEY (`frecuencia_tiempo_id`) REFERENCES `frecuencia_tiempo` (`id`);

--
-- Filtros para la tabla `unidades_estudio`
--
ALTER TABLE `unidades_estudio`
  ADD CONSTRAINT `fk_unidades_estudio_semestres1` FOREIGN KEY (`semestres_id`) REFERENCES `semestres` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `fk_user_rol1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `fk_user_tipo_usuario1` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipo_usuario` (`id`);

--
-- Filtros para la tabla `usos_internet`
--
ALTER TABLE `usos_internet`
  ADD CONSTRAINT `fk_usos_internet_alum_recreacion_tiempo1` FOREIGN KEY (`alum_recreacion_tiempo_id`) REFERENCES `alum_recreacion_tiempo` (`id`),
  ADD CONSTRAINT `fk_usos_internet_catalogo_usos_internet1` FOREIGN KEY (`catalogo_usos_internet_id`) REFERENCES `catalogo_usos_internet` (`id`);

--
-- Filtros para la tabla `uso_anteojos`
--
ALTER TABLE `uso_anteojos`
  ADD CONSTRAINT `fk_uso_anteojos_alum_uso_anteojos1` FOREIGN KEY (`alum_uso_anteojos_id`) REFERENCES `alum_uso_anteojos` (`id`),
  ADD CONSTRAINT `fk_uso_anteojos_catalogo_uso_anteojos1` FOREIGN KEY (`catalogo_uso_anteojos_id`) REFERENCES `catalogo_uso_anteojos` (`id`);

--
-- Filtros para la tabla `varias_reacciones_alergicas`
--
ALTER TABLE `varias_reacciones_alergicas`
  ADD CONSTRAINT `fk_varias_reacciones_alergicas_alergias1` FOREIGN KEY (`alergias_id`) REFERENCES `alergias` (`id`),
  ADD CONSTRAINT `fk_varias_reacciones_alergicas_catalogo_reacciones_alergicas1` FOREIGN KEY (`catalogo_reacciones_alergicas_id`) REFERENCES `catalogo_reacciones_alergicas` (`id`);

--
-- Filtros para la tabla `vivienda_bienes`
--
ALTER TABLE `vivienda_bienes`
  ADD CONSTRAINT `fk_vivienda_bienes_alum_vivienda1` FOREIGN KEY (`alum_vivienda_id`) REFERENCES `alum_vivienda` (`id`),
  ADD CONSTRAINT `fk_vivienda_bienes_catalogo_bienes_vivienda1` FOREIGN KEY (`catalogo_bienes_vivienda_id`) REFERENCES `catalogo_bienes_vivienda` (`id`);

--
-- Filtros para la tabla `vivienda_servicios`
--
ALTER TABLE `vivienda_servicios`
  ADD CONSTRAINT `fk_vivienda_servicios_alum_vivienda1` FOREIGN KEY (`alum_vivienda_id`) REFERENCES `alum_vivienda` (`id`),
  ADD CONSTRAINT `fk_vivienda_servicios_catalogo_servicios_vivienda1` FOREIGN KEY (`catalogo_servicios_vivienda_id`) REFERENCES `catalogo_servicios_vivienda` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
