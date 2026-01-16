-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-01-2026 a las 03:41:09
-- Versión del servidor: 8.4.7
-- Versión de PHP: 8.3.28

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
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `perfil_id`, `matricula`, `plan_licenciaturas_id`, `generaciones_id`) VALUES
(12, 29, '21070031', 1, 2),
(21, 37, '21070021', 1, 1),
(22, 38, '21070011', 1, 1),
(23, 39, '21070014', 1, 2),
(24, 40, '21070028', 1, 2),
(25, 41, '21070073', 1, 1),
(26, 42, '21070074', 1, 1),
(27, 43, '21070010', 1, 2),
(28, 44, '21070032', 1, 2),
(29, 45, '21070016', 1, 1),
(30, 46, '21070023', 1, 1),
(31, 47, '21070064', 1, 1),
(32, 48, '21070090', 1, 2),
(33, 49, '21070007', 1, 2),
(34, 50, '21070024', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_alergia`
--

DROP TABLE IF EXISTS `alum_alergia`;
CREATE TABLE IF NOT EXISTS `alum_alergia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `padeces_alergias` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_alergia_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=838 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2329 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=283 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `catalogo_lugares_acceso_principal_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_recreacion_tiempo_catalogo_lugares_acceso_principal_idx` (`catalogo_lugares_acceso_principal_id`),
  KEY `fk_alum_recreacion_tiempo_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `id` int NOT NULL AUTO_INCREMENT,
  `asignaciones_grupos_id` int NOT NULL,
  `alum_inscripciones_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_asignaciones_alumnos_grupos_asignaciones_grupos1_idx` (`asignaciones_grupos_id`),
  KEY `fk_asignaciones_alumnos_grupos_alum_inscripciones1_idx` (`alum_inscripciones_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_actividad_ejercicio`
--

INSERT INTO `catalogo_actividad_ejercicio` (`id`, `nombre`) VALUES
(1, 'Caminata'),
(2, 'Trote o running'),
(3, 'Bicicleta estática o paseo en bici'),
(4, 'Yoga'),
(5, 'Pilates'),
(6, 'Ejercicios de fuerza (pesas, bandas elásticas)'),
(7, 'Flexibilidad o estiramientos'),
(8, 'Zumba o clases de cardio'),
(9, 'Natación recreativa');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_alergias`
--

INSERT INTO `catalogo_alergias` (`id`, `nombre`, `descripcion`, `tipo_alergias_id`) VALUES
(1, 'Polvo doméstico', 'Alergia causada por ácaros presentes en el polvo del hogar.', 3),
(2, 'Polen', 'Reacción estacional provocada por el polen de árboles, flores o pastos.', 3),
(3, 'Moho', 'Sensibilidad a esporas de hongos presentes en ambientes húmedos.', 3),
(4, 'Pelo de gato', 'Reacción inmunitaria al contacto con proteínas presentes en la piel o saliva del gato.', 3),
(5, 'Pelo de perro', 'Alergia causada por exposición a proteínas de la piel o saliva del perro.', 3),
(6, 'Mariscos', 'Reacción severa tras el consumo de camarón, cangrejo o langosta.', 1),
(7, 'Pescado', 'Alergia alimentaria al consumo de pescado blanco o azul.', 1),
(8, 'Leche', 'Reacción inmunitaria a las proteínas de la leche de vaca.', 1),
(9, 'Huevo', 'Alergia a las proteínas contenidas en la clara o yema del huevo.', 1),
(10, 'Cacahuate', 'Alergia alimentaria grave que puede causar anafilaxia.', 1),
(11, 'Nueces', 'Reacción inmunitaria ante frutos secos como almendra, nuez o pistache.', 1),
(12, 'Penicilina', 'Respuesta adversa al antibiótico penicilina o a sus derivados.', 2),
(13, 'Sulfas', 'Hipersensibilidad a medicamentos que contienen compuestos de sulfonamida.', 2),
(14, 'Medicamentos antiinflamatorios (AINEs)', 'Reacción adversa a fármacos como ibuprofeno o naproxeno.', 2),
(15, 'Picadura de abeja', 'Reacción alérgica causada por el veneno de abeja.', 4),
(16, 'Picadura de avispa', 'Reacción inflamatoria o anafiláctica tras la picadura de una avispa.', 4),
(17, 'Látex', 'Reacción cutánea o respiratoria ante el contacto con productos de caucho natural.', 5),
(18, 'Níquel', 'Irritación cutánea o dermatitis por contacto con metales o joyería que contienen níquel.', 5),
(19, 'Perfumes o fragancias', 'Alergia cutánea o respiratoria provocada por compuestos aromáticos.', 5),
(20, 'Detergentes o productos químicos', 'Reacción cutánea por contacto con productos de limpieza o cosméticos.', 5);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_alimentos`
--

INSERT INTO `catalogo_alimentos` (`id`, `nombre`, `categorias_catalogo_alimentos_id`) VALUES
(1, 'Frutas', 1),
(2, 'Verduras', 1),
(3, 'Cereales', 2),
(4, 'Pan blanco / Tortillas', 2),
(5, 'Lácteos', 3),
(6, 'Carnes rojas', 4),
(7, 'Carnes blancas', 4),
(8, 'Refrescos embotellados', 5),
(9, 'Jugos naturales', 5),
(10, 'Golosinas dulces/saladas', 6),
(11, 'Comida rápida', 6),
(12, 'Pan dulce', 6);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_cigarros_dia`
--

INSERT INTO `catalogo_cigarros_dia` (`id`, `nombre`) VALUES
(1, 'Bajo consumo (1–5 cigarros/día)'),
(2, 'Consumo moderado (6–10 cigarros/día)'),
(3, 'Consumo alto (11 o más cigarros/día)');

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
(13, 'Otro (especificar)', 'Persona o entidad no especificada en el catálogo anterior, aplicable a casos particulares.', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_deportes`
--

DROP TABLE IF EXISTS `catalogo_deportes`;
CREATE TABLE IF NOT EXISTS `catalogo_deportes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_deportes`
--

INSERT INTO `catalogo_deportes` (`id`, `nombre`) VALUES
(1, 'Fútbol'),
(2, 'Baloncesto'),
(3, 'Voleibol'),
(4, 'Tenis'),
(5, 'Natación (competitiva)'),
(6, 'Atletismo'),
(7, 'Béisbol'),
(8, 'Gimnasia deportiva'),
(9, 'Ciclismo (competitivo)'),
(10, 'Boxeo'),
(11, 'Artes marciales');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_enferm_cronicas`
--

INSERT INTO `catalogo_enferm_cronicas` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Diabetes tipo 1', 'Enfermedad crónica en la que el páncreas no produce suficiente insulina, afectando los niveles de glucosa en sangre.'),
(2, 'Diabetes tipo 2', 'Enfermedad crónica caracterizada por resistencia a la insulina y alteración del metabolismo de la glucosa.'),
(3, 'Hipertensión arterial', 'Elevación sostenida de la presión arterial que puede dañar órganos como el corazón, los riñones y el cerebro.'),
(4, 'Enfermedad cardíaca', 'Trastornos que afectan el corazón y su funcionamiento, incluyendo insuficiencia cardíaca y cardiopatías coronarias.'),
(5, 'Asma', 'Enfermedad respiratoria crónica que provoca inflamación de las vías respiratorias y dificultad para respirar.'),
(6, 'Enfermedad pulmonar obstructiva crónica (EPOC)', 'Enfermedad progresiva que obstruye el flujo de aire en los pulmones, dificultando la respiración.'),
(7, 'Cáncer', 'Grupo de enfermedades caracterizadas por el crecimiento descontrolado de células que puede afectar distintos órganos.'),
(8, 'Enfermedad renal crónica', 'Pérdida progresiva de la función renal, afectando la filtración de toxinas y líquidos del cuerpo.'),
(9, 'Hipotiroidismo', 'Deficiencia de hormonas tiroideas que ralentiza el metabolismo y puede causar fatiga, aumento de peso y problemas de piel.'),
(10, 'Hipertiroidismo', 'Exceso de hormonas tiroideas que acelera el metabolismo, causando pérdida de peso, nerviosismo y palpitaciones.'),
(11, 'Artritis reumatoide', 'Enfermedad autoinmune que provoca inflamación, dolor y rigidez en las articulaciones.'),
(12, 'Osteoporosis', 'Disminución de la densidad ósea que incrementa el riesgo de fracturas, especialmente en caderas, columna y muñecas.'),
(13, 'Lupus eritematoso sistémico', 'Enfermedad autoinmune que puede afectar la piel, las articulaciones y los órganos internos.'),
(14, 'Enfermedad de Parkinson', 'Trastorno neurodegenerativo que afecta el control del movimiento y puede causar temblores, rigidez y dificultad para caminar.'),
(15, 'Esclerosis múltiple', 'Enfermedad autoinmune del sistema nervioso central que provoca daño en la mielina y afecta la comunicación entre el cerebro y el cuerpo.'),
(16, 'Otro', 'Permite registrar una enfermedad crónica que no se encuentra en el catálogo.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_lugares_acceso_principal`
--

DROP TABLE IF EXISTS `catalogo_lugares_acceso_principal`;
CREATE TABLE IF NOT EXISTS `catalogo_lugares_acceso_principal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_lugares_acceso_principal`
--

INSERT INTO `catalogo_lugares_acceso_principal` (`id`, `nombre`) VALUES
(1, 'Casa'),
(2, 'Escuela'),
(3, 'Trabajo'),
(4, 'Café internet'),
(5, 'Casa de un amigo o familiar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_lugares_comer`
--

DROP TABLE IF EXISTS `catalogo_lugares_comer`;
CREATE TABLE IF NOT EXISTS `catalogo_lugares_comer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_lugares_comer`
--

INSERT INTO `catalogo_lugares_comer` (`id`, `nombre`) VALUES
(1, 'En casa'),
(2, 'En la escuela / cafetería escolar'),
(3, 'En el trabajo / comedor'),
(4, 'Restaurante'),
(5, 'Comida rápida / comida para llevar'),
(6, 'Cafetería / café internet'),
(7, 'Otro (especificar)');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_organizaciones`
--

INSERT INTO `catalogo_organizaciones` (`id`, `nombre`, `descripcion`, `tipo_organizacion_id`) VALUES
(1, 'Cruz Roja', 'Organización humanitaria internacional que brinda asistencia médica, apoyo en desastres y promueve los derechos humanos.', 1),
(2, 'UNICEF', 'Fondo de las Naciones Unidas para la Infancia que trabaja en la protección de los derechos de los niños y en garantizar su bienestar y desarrollo integral.', 1),
(3, 'Fundación Teletón', 'Institución mexicana dedicada a la rehabilitación de personas con discapacidad, cáncer y autismo, mediante centros de atención especializados.', 1),
(4, 'Grupo Scout', 'Organización juvenil que fomenta valores de liderazgo, trabajo en equipo, respeto y servicio a la comunidad a través de actividades educativas al aire libre.', 1),
(5, 'Iglesia Católica', 'Institución religiosa cristiana que promueve la fe católica, la enseñanza del evangelio y la formación espiritual de sus creyentes.', 2),
(6, 'Iglesia de Jesucristo de los Santos de los Últimos Días', 'Comunidad religiosa cristiana conocida como “mormones”, centrada en la fe en Jesucristo, el servicio y los valores familiares.', 2),
(7, 'Testigos de Jehová', 'Organización religiosa cristiana que difunde sus creencias mediante la enseñanza bíblica y la labor misionera.', 2),
(8, 'Partido Revolucionario Institucional (PRI)', 'Organización política mexicana que busca participar en la vida democrática del país, promoviendo políticas públicas y programas de desarrollo social y económico.', 3),
(9, 'Partido Acción Nacional (PAN)', 'Partido político mexicano que promueve los valores democráticos, la libertad y la participación ciudadana bajo principios humanistas.', 3),
(10, 'Movimiento Regeneración Nacional (MORENA)', 'Partido político mexicano enfocado en la transformación social y política del país, con énfasis en la justicia social y la lucha contra la corrupción.', 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_reacciones_alergicas`
--

INSERT INTO `catalogo_reacciones_alergicas` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Urticaria', 'Aparición de ronchas rojizas y elevadas en la piel, generalmente acompañadas de picazón.'),
(2, 'Angioedema', 'Hinchazón profunda de la piel, mucosas o tejidos subcutáneos, frecuentemente en labios, párpados o garganta.'),
(3, 'Rinitis alérgica', 'Inflamación de la mucosa nasal que provoca estornudos, congestión, secreción y picazón nasal.'),
(4, 'Conjuntivitis alérgica', 'Inflamación de la conjuntiva del ojo causada por alérgenos, con enrojecimiento, lagrimeo y picazón.'),
(5, 'Dificultad respiratoria', 'Sensación de falta de aire, opresión en el pecho o respiración sibilante como resultado de una reacción alérgica.'),
(6, 'Anafilaxia', 'Reacción alérgica grave y potencialmente mortal que afecta múltiples órganos y puede provocar colapso circulatorio.'),
(7, 'Prurito', 'Picazón localizada en la piel, frecuentemente acompañada de enrojecimiento o irritación.'),
(8, 'Eczema o dermatitis atópica', 'Inflamación crónica de la piel caracterizada por sequedad, enrojecimiento, descamación y picazón intensa.'),
(9, 'Náuseas o vómitos', 'Reacción gastrointestinal provocada por la ingestión de un alérgeno.'),
(10, 'Diarrea', 'Evacuaciones frecuentes y líquidas como manifestación de una reacción alérgica digestiva.'),
(11, 'Mareo o desmayo', 'Sensación de inestabilidad o pérdida de conciencia temporal causada por una reacción sistémica.'),
(12, 'Palpitaciones', 'Latidos rápidos, irregulares o fuertes del corazón como consecuencia de una reacción alérgica.'),
(13, 'Tos', 'Expulsión de aire de los pulmones provocada por irritación de las vías respiratorias durante una reacción alérgica.'),
(14, 'Congestión facial o labial', 'Inflamación localizada en rostro o labios, asociada a reacciones alérgicas leves o moderadas.');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_usos_internet`
--

INSERT INTO `catalogo_usos_internet` (`id`, `nombre`) VALUES
(1, 'Navegar en redes sociales'),
(2, 'Realizar tareas o trabajos escolares'),
(3, 'Jugar videojuegos en línea'),
(4, 'Ver videos o streaming'),
(5, 'Aprender cursos en línea');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias_catalogo_alimentos`
--

INSERT INTO `categorias_catalogo_alimentos` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Frutas y verduras', 'Incluye frutas y verduras frescas o procesadas, fuente de vitaminas y fibra.'),
(2, 'Cereales y leguminosas', 'Incluye cereales, pan, tortillas y leguminosas, fuente de carbohidratos y proteínas.'),
(3, 'Lácteos', 'Incluye leche, yogur y quesos, fuente de calcio y proteínas.'),
(4, 'Carnes y proteínas', 'Incluye carnes rojas, carnes blancas y otras fuentes de proteínas animales.'),
(5, 'Bebidas azucaradas', 'Incluye refrescos, jugos procesados y aguas de sabor, altos en azúcar.'),
(6, 'Snacks y comida rápida', 'Incluye golosinas dulces o saladas, pan dulce y comida rápida.');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ciclos_escolares`
--

INSERT INTO `ciclos_escolares` (`id`, `nombre`, `fecha_inicio`, `fecha_fin`, `periodo_texto`, `estados_ciclos_escolares_id`) VALUES
(2, '2025 - 2026', '2025-09-01 05:51:25', '2026-07-15 05:51:25', 'Septiembre 2025 – Julio 2026', 1),
(3, '2024 - 2025', '2024-08-26 05:56:01', '2025-07-16 05:56:01', 'Agosto 2024 – Julio 2025', 2),
(4, '2026 - 2027', '2026-09-01 05:56:54', '2027-07-15 05:56:54', 'Septiembre 2026 – Julio 2027', 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ciclos_semestres`
--

INSERT INTO `ciclos_semestres` (`id`, `ciclos_escolares_id`, `semestres_id`, `fecha_inicio_semestre`, `fecha_fin_semestre`, `periodo_texto_semestre`) VALUES
(1, 2, 1, '2025-09-01 00:00:00', '2026-01-23 00:00:00', 'Primer Semestre impar 2025 - 2026'),
(2, 2, 2, '2026-02-02 00:00:00', '2026-07-15 00:00:00', 'Primer Semestre Par 2026');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=759 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=313 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(12, '2025-12-08 01:33:39', '34524325', '23454325', '69362af34dcc6_8d2c550b-39d6-4a3f-bcb2-9d51ca544f94.jpg', '69362af34e113_648658124-LEGO-NINJAGO---Minifigur-Kai.jpg', '69362af34e707_c0fbf45fcbeca248a44cfbdfc4e9e2b5.jpg', 'qweqwe', 'wqqwewq', 7, 2, 1, 2, 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `estado_nombre`, `estado_valor`) VALUES
(1, 'Activo', 10),
(2, 'Pendiente', 5),
(3, 'Inactivo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_ciclos_escolares`
--

DROP TABLE IF EXISTS `estados_ciclos_escolares`;
CREATE TABLE IF NOT EXISTS `estados_ciclos_escolares` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estados_ciclos_escolares`
--

INSERT INTO `estados_ciclos_escolares` (`id`, `nombre`) VALUES
(1, 'Activo'),
(2, 'Cerrado'),
(3, 'Planeado');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `frecuencia_veces`
--

INSERT INTO `frecuencia_veces` (`id`, `nombre`) VALUES
(1, 'Siempre (3)'),
(2, 'Muchas veces (2)'),
(3, 'Pocas veces (1)'),
(4, 'Nunca (0)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frecuencia_veces_semana`
--

DROP TABLE IF EXISTS `frecuencia_veces_semana`;
CREATE TABLE IF NOT EXISTS `frecuencia_veces_semana` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `frecuencia_veces_semana`
--

INSERT INTO `frecuencia_veces_semana` (`id`, `nombre`) VALUES
(1, '1 – 2 veces por semana'),
(2, '3 – 4 veces por semana'),
(3, '5 – 7 veces por semana'),
(4, 'Nunca');

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
(1, 'Generacion 2025 - 2029', '2025-01-01 00:00:00', '2029-01-01 00:00:00', 'Esta generación corresponde a los estudiantes que iniciaron sus estudios en el año 2025 y culminarán en el 2029'),
(2, 'Generacion 2026 - 2030', '2026-01-01 00:00:00', '2030-01-01 00:00:00', 'Esta generación agrupa a los alumnos que comienzan su trayectoria académica en 2026 y concluirán en 2030');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Grupo A', 'Grupo de estudiantes del mismo curso.'),
(2, 'Grupo B', 'Grupo de estudiantes del mismo curso.'),
(3, 'Grupo C', 'Grupo de estudiantes del mismo curso.');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=280 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `user_id`, `nombre`, `apellido`, `fecha_nacimiento`, `genero_id`, `created_at`, `updated_at`) VALUES
(29, 1, 'Eduardo Alexander', 'Estrella Escobedo', '2000-09-11', 1, '2025-12-09 17:49:54', '2025-12-09 17:49:54'),
(37, 35, 'Johana Yanet', 'Olivo Escobedo', '2000-08-21', 2, '2026-01-15 18:57:22', '2026-01-15 18:57:22'),
(38, 36, 'Eduardo Alexander', 'Estrella Escobedo', '2000-09-11', 1, '2026-01-15 19:01:33', '2026-01-15 19:01:33'),
(39, 37, 'Carlos Ali', 'Cuevas Escobedo', '2010-12-14', 1, '2026-01-15 19:02:28', '2026-01-15 19:02:28'),
(40, 38, 'Geffy Jorei', 'Estrella Escobedo', '1995-12-28', 2, '2026-01-15 19:03:22', '2026-01-15 19:03:22'),
(41, 39, 'Jorge Gabriel', 'Estrella Pomol', '1973-11-20', 1, '2026-01-15 19:04:45', '2026-01-15 19:04:45'),
(42, 40, 'Eiffy Zulay del Carmen', 'Escobedo Nuñez', '1974-06-11', 2, '2026-01-15 19:10:03', '2026-01-15 19:10:03'),
(43, 41, 'Maria Magdalena', 'Nuñez Guitierrez', '1964-08-07', 2, '2026-01-15 19:11:01', '2026-01-15 19:11:01'),
(44, 42, 'Jorge Humberto', 'Escobedo Esquivel', '1973-03-29', 1, '2026-01-15 19:11:47', '2026-01-15 19:11:47'),
(45, 43, 'Lidy Maribel', 'Escobedo Nuñez', '1974-06-16', 2, '2026-01-15 19:12:42', '2026-01-15 19:12:42'),
(46, 44, 'Jorge Manuel', 'Escobedo Nuñez', '1976-05-23', 1, '2026-01-15 19:13:38', '2026-01-15 19:13:38'),
(47, 45, 'Marco Antonio', 'Olivo Escobedo', '1994-07-16', 1, '2026-01-15 19:14:53', '2026-01-15 19:14:53'),
(48, 46, 'Jesus Antonio', 'Olivo Escobedo', '1990-05-04', 1, '2026-01-15 19:15:49', '2026-01-15 19:15:49'),
(49, 47, 'Irina', 'Olivo Escobedo', '2024-06-11', 2, '2026-01-15 19:16:39', '2026-01-15 19:16:39'),
(50, 48, 'Milan', 'Lopez Estrella', '2024-06-16', 1, '2026-01-15 19:17:32', '2026-01-15 19:17:32');

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
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `plan_semestres`
--

INSERT INTO `plan_semestres` (`id`, `plan_licenciatura_id`, `semestres_id`, `unidades_estudio_id`) VALUES
(1, 1, 1, 2),
(2, 1, 1, 3),
(3, 1, 1, 4),
(4, 1, 1, 5),
(5, 1, 1, 6),
(6, 1, 1, 7),
(7, 1, 1, 8),
(8, 1, 1, 9),
(9, 1, 1, 55),
(10, 1, 1, 56),
(11, 1, 1, 57),
(12, 1, 1, 58),
(13, 1, 1, 59),
(14, 1, 1, 60),
(15, 1, 1, 61),
(16, 1, 2, 10),
(17, 1, 2, 11),
(18, 1, 2, 12),
(19, 1, 2, 13),
(20, 1, 2, 14),
(21, 1, 2, 15),
(22, 1, 2, 16),
(23, 1, 2, 17),
(24, 1, 2, 62),
(25, 1, 2, 63),
(26, 1, 2, 64),
(27, 1, 2, 65),
(28, 1, 2, 66),
(29, 1, 2, 67),
(30, 1, 2, 68),
(31, 1, 3, 18),
(32, 1, 3, 19),
(33, 1, 3, 20),
(34, 1, 3, 21),
(35, 1, 3, 22),
(36, 1, 3, 23),
(37, 1, 3, 24),
(38, 1, 3, 25),
(39, 1, 3, 69),
(40, 1, 3, 70),
(41, 1, 3, 71),
(42, 1, 3, 72),
(43, 1, 3, 73),
(44, 1, 3, 74),
(45, 1, 3, 75),
(46, 1, 4, 26),
(47, 1, 4, 27),
(48, 1, 4, 28),
(49, 1, 4, 29),
(50, 1, 4, 30),
(51, 1, 4, 31),
(52, 1, 4, 32),
(53, 1, 4, 33),
(54, 1, 4, 76),
(55, 1, 4, 77),
(56, 1, 4, 78),
(57, 1, 4, 79),
(58, 1, 4, 80),
(59, 1, 4, 81),
(60, 1, 4, 82),
(61, 1, 5, 34),
(62, 1, 5, 35),
(63, 1, 5, 36),
(64, 1, 5, 37),
(65, 1, 5, 38),
(66, 1, 5, 39),
(67, 1, 5, 40),
(68, 1, 5, 41),
(69, 1, 5, 83),
(70, 1, 5, 84),
(71, 1, 5, 85),
(72, 1, 5, 86),
(73, 1, 5, 87),
(74, 1, 5, 88),
(75, 1, 5, 89),
(76, 1, 6, 42),
(77, 1, 6, 43),
(78, 1, 6, 44),
(79, 1, 6, 45),
(80, 1, 6, 46),
(81, 1, 6, 47),
(82, 1, 6, 48),
(83, 1, 6, 49),
(84, 1, 6, 90),
(85, 1, 6, 91),
(86, 1, 6, 92),
(87, 1, 6, 93),
(88, 1, 6, 94),
(89, 1, 6, 95),
(90, 1, 6, 96),
(91, 1, 7, 50),
(92, 1, 7, 51),
(93, 1, 7, 52),
(94, 1, 7, 97),
(95, 1, 7, 98),
(96, 1, 8, 53),
(97, 1, 8, 54),
(98, 1, 8, 99),
(99, 1, 8, 100);

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
) ENGINE=InnoDB AUTO_INCREMENT=271 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `semestres`
--

INSERT INTO `semestres` (`id`, `nombre`, `descripcion`, `tipo_semestres_id`) VALUES
(1, 'Primer Semestre', 'Introduce al estudiante en los fundamentos teóricos y prácticos de la formación profesional, brindando las bases para el desarrollo académico.', 1),
(2, 'Segundo Semestre', 'Profundiza en los conocimientos adquiridos, fortaleciendo las competencias básicas y el razonamiento crítico en el ámbito formativo.', 2),
(3, 'Tercer Semestre', 'Consolida los aprendizajes previos mediante la aplicación de conceptos en situaciones prácticas y el desarrollo de habilidades analíticas.', 1),
(4, 'Cuarto Semestre', 'Amplía los saberes disciplinares y promueve la integración de contenidos teóricos y prácticos dentro del proceso de formación profesional.', 2),
(5, 'Quinto Semestre', 'Fomenta la autonomía del estudiante y la aplicación del conocimiento en proyectos o prácticas de carácter profesional.', 1),
(6, 'Sexto Semestre', 'Profundiza en la práctica profesional y en la resolución de problemas complejos, fortaleciendo la capacidad de análisis y toma de decisiones.', 2),
(7, 'Séptimo Semestre', 'Enfocado en el desarrollo de proyectos integradores y la consolidación de la experiencia profesional adquirida durante la carrera.', 1),
(8, 'Octavo Semestre', 'Culmina el proceso formativo con actividades de práctica profesional, investigación o titulación, integrando los conocimientos adquiridos a lo largo del programa.', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipos_inscripciones`
--

INSERT INTO `tipos_inscripciones` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Inscripcion', 'Proceso mediante el cual un estudiante se registra por primera vez en la institución educativa.'),
(2, 'Reinscripcion', 'Proceso mediante el cual un estudiante que ya pertenece a la institución renueva su registro para continuar sus estudios.');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_organizacion`
--

INSERT INTO `tipo_organizacion` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Social', 'Organización dedicada a actividades comunitarias o de apoyo social.'),
(2, 'Religiosa', 'Organización basada en creencias y prácticas religiosas.'),
(3, 'Política', 'Organización vinculada a partidos, movimientos o actividades políticas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_semestres`
--

DROP TABLE IF EXISTS `tipo_semestres`;
CREATE TABLE IF NOT EXISTS `tipo_semestres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_semestres`
--

INSERT INTO `tipo_semestres` (`id`, `nombre`) VALUES
(1, 'Impar'),
(2, 'Par');

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
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `unidades_estudio`
--

INSERT INTO `unidades_estudio` (`id`, `semestres_id`, `nombre`, `descripcion_general`, `creditos`, `horas_semana`, `horas_semestre`) VALUES
(2, 1, 'Unidad 1 - El sujeto y su formación profesional', 'Recuperar los testimonios de vida de las y los estudiantes, así como de diferentes actores involucrados en las prácticas educativas y comunitarias a través de las narrativas pedagógicas, es un ejercicio fundamental que favorece la reflexión, análisis y comprensión de las razones, motivos, intereses, sentidos y condiciones que mediaron en la elección profesional de las y los alumnos que recién ingresan a la escuela normal.', 4.5, 4, 72),
(3, 1, 'Unidad 2 - Bases filosóficas, legales y organizativas del sistema educativo mexicano', 'Con este curso se pretende que los estudiantes normalistas adquieran un conocimiento inicial y sistemático de los principios filosóficos que orientan al Sistema Educativo Mexicano, comprendan sus fundamentos y reconozcan sus implicaciones en la organización de los servicios y en la práctica educativa, al mismo tiempo que analicen las bases legales que regulan su funcionamiento como expresión jurídica; en particular se busca, que identifiquen los niveles que lo integran, la distribución de facultades entre los órganos de autoridad y los derechos y responsabilidades de los sujetos que intervienen en el servicio educativo. En este contexto, podrán valorar a la educación básica como un servicio de orden público e interés social y, con base en la reflexión y el análisis, puedan asumir y promover el carácter nacional, democrático, gratuito, laico y humanista de la educación pública.', 4.5, 4, 72),
(4, 1, 'Unidad 3 - Teorías del desarrollo y aprendizaje', 'Que el estudiante conozca cómo se ha estudiado el desarrollo y el aprendizaje humano desde diversas perspectivas, para que comprenda la relevancia de la evolución de la infancia y la forma en que se vincula con las teorías actuales, a través de la aplicación de diferentes estrategias como: la investigación documental, el estudio de caso, la narrativa pedagógica y la observación de los fenómenos en diversos entornos, para que logren interpretarlos desde una visión intercultural e identifiquen cómo aprenden sus futuros estudiantes en sus contextos de desarrollo.', 4.5, 4, 72),
(5, 1, 'Unidad 4 - Acercamiento a prácticas educativas y comunitarias', 'El curso Acercamiento a Prácticas educativas y comunitarias es un espacio que inicia al estudiante en el trayecto de práctica profesional y saberes pedagógicos. Es un lugar reservado para acercar, de manera gradual, al docente en formación a la complejidad de la docencia. Desarrolla habilidades, capacidades, saberes y actitudes para reflexionar.', 6.75, 6, 108),
(6, 1, 'Unidad 5 - Aritmética. Su aprendizaje y su enseñanza', 'El curso “Aritmética. Su aprendizaje y enseñanza” pertenece al primer ciclo del trayecto “Formación Pedagógica, didáctica e Interdisciplinar”. En cada unidad de aprendizaje pueden distinguirse dos tipos de contenidos: los orientados al estudio de las matemáticas y los que favorecen la enseñanza de los mismos en la escuela primaria. Para el tratamiento de ambos tipos de contenidos, las y los estudiantes contarán con material básico para el estudio de esta disciplina; de aquellos materiales que los lleven al análisis de los contenidos que se estudian en la escuela primaria; en los que observen los procesos que siguen las niñas y los niños en su aprendizaje; así como de los que les orienten a la construcción y uso de recursos didácticos.', 4.5, 4, 72),
(7, 1, 'Unidad 6 - Lenguaje y comunicación', 'Comprender el lenguaje como una herramienta superior del pensamiento que permite al ser humano aprehender el mundo y simbolizarlo, así como expresar sus pensamientos y emociones, a través de interacciones sociales y culturales, es decir desde un enfoque sociocultural. Su conocimiento será la base para formar usuarios plenos del lenguaje que utilizan sus habilidades comunicativas (hablar, leer, escribir y escuchar) en prácticas sociales del lenguaje para participar activamente y con conocimiento del mundo y de la sociedad de la que forman parte.', 4.5, 4, 72),
(8, 1, 'Unidad 7 - Ciencias Naturales. Su aprendizaje y su enseñanza', 'El curso Ciencias Naturales. Su Aprendizaje y su Enseñanza, pertenece al trayecto formativo denominado “Formación Pedagógica, Didáctica e Interdisciplinar”, el cual tiene gran relevancia por su importancia en la formación docente, en él se trata de recuperar la naturaleza de la ciencia porque esta nos induce a comprender las bases que sustentan las explicaciones de los fenómenos naturales y su didáctica en educación primaria donde se formalizan las base del saber plasmado en el currículum vigente y la localidad en donde se despliega. En ese sentido es importante fortalecer y potenciar en el estudiantado de la licenciatura en educación primaria el pensamiento científico crítico, a efecto de que pueda orientar la educación primaria con referencia al campo formativo de conocimiento del mundo natural y social, fortaleciendo las prácticas de cuidado de la vida y el medio ambiente.', 4.5, 4, 72),
(9, 1, 'Unidad 8 - Tecnologías digitales para el aprendizaje y la enseñanza', 'El propósito general del curso es que el estudiantado, desde un enfoque de aprendizaje permanente, inclusivo y crítico, desarrolle algunos dominios de saber, hacer, ser y estar que le permitan consolidarse como prosumidor del conocimiento desde una ciudadanía digital, a partir de la conceptualización, uso y manejo de las tecnologías digitales, con la intención de sentar los referentes para su uso didáctico en ambientes de aprendizaje presenciales, híbridos o virtuales donde se desarrolla la educación básica.', 4.5, 4, 72),
(10, 2, 'Unidad 1 - Filosofía y sociología de la educación', 'Que las y los estudiantes normalistas, desarrollen saberes filosóficos y sociológicos sobre la educación bajo una perspectiva de interculturalidad crítica para repensar la función social de la educación, el ser docente y las fundamentos e ideologías que favorecen la desigualdad social, y de esta manera oriente su praxis educativa en la educación primaria, con valores de justicia social, vida digna y bien común.', 4.5, 4, 72),
(11, 2, 'Unidad 2 - Desarrollo socioemocional y aprendizaje', 'Que las y los estudiantes normalistas, reconozcan los procesos implicados en el desarrollo socioemocional y su relación con el aprendizaje, con la finalidad de construir marcos explicativos cimentados en las teorías científicas existentes sobre las emociones y de esta manera puedan propiciar la gestión de sus capacidades emocionales; para hacer transferencias y transposiciones didácticas que les permita construir ambientes de aprendizaje incluyentes, además de diseñar estrategias que favorezcan la formación integral de las niñas y los niños de educación básica.', 4.5, 4, 72),
(12, 2, 'Unidad 3 - Planeación para la enseñanza y evaluación de los aprendizajes', 'Concebir al binomio de la planeación y la evaluación como una herramienta metodológica para la enseñanza y el aprendizaje a partir del análisis del conocimiento teórico-metodológico adquirido por las y los estudiante normalistas, el currículum y el contexto comunitario como insumos vitales para la gestión de la práctica docente en escenarios reales de la educación primaria. Para el desarrollo de este curso, se considera que la planeación y la evaluación son inseparables, toda vez que desde las diferentes herramientas de la evaluación es posible identificar oportunidades para contribuir a los aprendizajes desde una intervención pertinente. Esta idea constituye una premisa durante el desarrollo del curso. Aunque cada una tiene elementos específicos, son complementarias y ambas conforman una herramienta importante con la que cuenta un docente en su labor diaria.', 4.5, 4, 72),
(13, 2, 'Unidad 4 - Análisis de prácticas y contextos escolares', 'El curso Análisis de prácticas y contextos escolares se enfoca en el conocimiento y análisis de las prácticas de los profesores, la escuela, la cultura, formas de organización, funcionamiento, políticas, representaciones e imaginarios relacionados con el trabajo docente, así como las formas en que éstos participan en la institución, conocen a sus alumnos, enseñan, evalúan, garantizan el aprendizaje y la participación de todos. Busca que los estudiantes recaben información a partir del uso de diferentes técnicas asociadas con los enfoques cualitativos de investigación, desarrollen habilidades para formular preguntas contextualizadas y mediante el uso de técnicas e instrumentos de observación, entrevista, cuestionario, encuesta y otros medios, recabe información para construir retatos que representen lo relevante del aula, el contexto escolar y su interacción.', 6.75, 6, 108),
(14, 2, 'Unidad 5 - Álgebra. Su aprendizaje y su enseñanza', 'El pensamiento matemático hace referencia a todas las prácticas que se realizan en una cultura relacionada con las matemáticas, como las actividades de contar, medir, representar, inferir y modelar; que realiza una comunidad y por tanto hacen parte de las representaciones culturales de la misma. Estas prácticas son entonces prácticas sociales, por lo tanto, el pensamiento matemático no se refiere exclusivamente a “las matemáticas como saber disciplinario” sino que incluye las prácticas sociales con matemáticas (Chevallard, 1997). Vista desde este constructo se destaca la importancia de que los futuros docentes desarrollen conocimientos y destrezas para analizar y proponer prácticas matemáticas idóneas, favoreciendo en las y los estudiantes de primaria un pensamiento matemático.', 4.5, 4, 72),
(15, 2, 'Unidad 6 - Literatura y mediación lectora', 'Que las y los estudiantes normalistas se formen como docentes, en tanto lectores y mediadores de lectura, a través del conocimiento y valoración de la literatura en sus diversos géneros y en específico de literatura infantil y juvenil, así como desarrollar estrategias de mediación lectora, con la finalidad de diseñar proyectos con las y los estudiantes de educación primaria desde un enfoque de interculturalidad crítica. El aprecio por su contexto y la toma de decisiones, a partir de la interculturalidad crítica serán el fundamento para optar por textos literarios que les permitan conocer e interactuar con la otredad a partir de la oralidad, la lectura y la escritura.', 4.5, 4, 72),
(16, 2, 'Unidad 7 - Geografía. Su aprendizaje y su enseñanza', 'La geografía es una ciencia natural y social, una categoría fundamental, que orienta la comprensión de las distintas temáticas que en la actualidad estudian a mayor detalle la noción de espacio y sus consecuentes concepciones. El curso de Geografía. Su aprendizaje y su enseñanza, es un espacio de reflexión donde se abordan temas contemporáneos para que las y los estudiantes adquieran un acercamiento a una educación geográfica y ciudadana, orientados al desarrollo profesional sostenible, promoviendo valores y actitudes vinculadas a los derechos humanos, a la igualdad de género, a la cultura de paz, no violencia y convivencia, la protección del medio ambiente y la vida, para enfrentar los desafíos del cambio climático y la valoración de la diversidad cultural.', 4.5, 4, 72),
(17, 2, 'Unidad 8 - Entornos virtuales de aprendizaje para la educación híbrida. Su pedagogía y didáctica', 'El curso Entornos virtuales de aprendizaje para la educación híbrida. Su pedagogía y didáctica, desde una orientación de aprendizaje permanente, inclusivo y crítico, tiene como propósito que las y los estudiantes normalistas se consoliden como prosumidores del conocimiento al conocer y promover en las aulas, el análisis, diseño y uso de entornos virtuales contextualizados desde un enfoque pedagógico constructivista que favorezcan la formación integral de los alumnos de educación primaria a partir del conocimiento de algunos modelos de diseño instruccional, la curación de contenidos, redes de colaboración, comunidades virtuales y el aprovechamiento adecuado de los recursos educativos abiertos, para con ello, favorecer escenarios y experiencias de aprendizaje híbridos, desde un enfoque de ciudadanía digital humanista para la sostenibilidad.', 4.5, 4, 72),
(18, 3, 'Unidad 1 - Flexibilidad curricular', 'Pendiente de captura.', 6.75, 6, 108),
(19, 3, 'Unidad 2 - Pedagogías situadas globalizadoras', 'Que las y los estudiantes normalistas comprendan los principios de la pedagogía situada y los apliquen en propuestas de enseñanza globalizadoras en favor de la construcción de aprendizajes significativos a partir del análisis de los saberes experienciales y los fundamentos teóricos y curriculares en la aplicación de métodos activos que den respuesta a las problemáticas inmediatas de los diversos contextos en educación primaria.', 4.5, 4, 72),
(20, 3, 'Unidad 3 - Intervención didáctico-pedagógica y trabajo docente', 'El curso Intervención didáctico-pedagógica y trabajo docente parte de la premisa de que las experiencias de aprendizajes acumuladas en los dos primeros semestres, sentaron las bases que permitieron a los estudiantes comprender los contextos comunitarios y escolares donde los docentes realizan su práctica profesional.', 6.75, 6, 108),
(21, 3, 'Unidad 4 - Geometría. Su aprendizaje y su enseñanza', 'El curso de Geometría. Su aprendizaje y su enseñanza pertenece al segundo ciclo del trayecto Formación Pedagógica, didáctica e interdisciplinar. Su carácter es Nacional, por lo que es parte del Currículo Nacional. Se ubica en la fase de Profundización en el tercer semestre. Tiene una carga horaria de 4 horas/semana por semestre.', 4.5, 4, 72),
(22, 3, 'Unidad 5 - Desarrollo de la literacidad', 'Se pretende que las y los estudiantes fortalezcan su formación personal y profesional, a partir de la reflexión y la problematización de las prácticas de lectura y escritura –las cuales se inscriben en géneros discursivos y en contextos sociales y culturales específicos–, para que sean capaces de desarrollar la literacidad en las niñas y los niños de educación primaria, conforme a los requerimientos actuales de la cultura escrita, a fin de resignificar el mundo desde la interculturalidad crítica.', 4.5, 4, 72),
(23, 3, 'Unidad 6 - Historia. Su aprendizaje y su enseñanza', 'El propósito del curso Historia. Su aprendizaje y su enseñanza es proveer a las y los estudiantes normalistas de recursos teórico-metodológicos sobre el aprendizaje y la enseñanza de la historia en la escuela primaria mediante el análisis de los debates más recientes como disciplina científica y como campo de investigación, a partir de situaciones problematizadoras derivadas del contexto comunitario para diseñar y desarrollar planeaciones didácticas situadas que posibiliten a los niños y niñas reconocerse como seres sociales e históricos con una conciencia crítica en un plano de complementariedad glocal.', 4.5, 4, 72),
(24, 3, 'Unidad 7 - Lengua de señas mexicana', 'Reconocer que las personas sordas tienen derecho a una atención educativa en su propia lengua, así como sensibilizarse sobre la historia de su atención a nivel educativo; conocer algunas características de la cultura de la comunidad sorda y su dominio, para contribuir a establecer vínculos de comunicación afectiva de tal manera que se generen las condiciones de aprendizaje que responda a las exigencias y propósitos de la Educación Básica. Desde este marco, se busca que el estudiantado normalista logré un acercamiento a la Lengua de Señas Mexicana (LSM), que le permitirá desarrollar recursos y herramientas básicas de comunicación con la Comunidad Sorda desde una práctica incluyente, como docente de Educación Primaria.', 4.5, 4, 72),
(25, 3, 'Unidad 8 - Inglés. Inicio de la comunicación básica', 'El curso Inglés. Inicio de la comunicación básica tiene como propósito que las y los estudiantes normalistas desarrollen saberes iniciales del idioma inglés. Se pretende que el desarrollo de los mismos, correspondientes al nivel A1 establecido dentro del Marco Común Europeo de Referencia para las lenguas (MCER), se alcance desde un enfoque comunicativo, de tal manera que comprendan expresiones cotidianas y generen e intercambien información, tanto de forma oral como escrita, sobre situaciones habituales de su vida diaria, además de particularidades en su práctica profesional. De esta manera, el curso pretende fomentar destrezas y capacidades interculturales que favorezcan su formación en el proceso de enseñanza y aprendizaje.', 4.5, 4, 72),
(26, 4, 'Unidad 1 - Flexibilidad curricular', 'Pendiente de captura.', 6.75, 6, 108),
(27, 4, 'Unidad 2 - Pedagogía y didáctica del aula multigrado', 'Que las y los futuros docentes fortalezcan el desarrollo de capacidades, saberes, actitudes, al conocer y valorar el origen, aportes y retos de la escuela multigrado, a partir de analizar, aplicar e interpretar el enfoque, los recursos y herramientas relacionadas con las didácticas para la atención del aula diversificada desde la necesidad y responsabilidad que ejercerá en su práctica profesional, sea ésta en un contexto multigrado o unigrado, a través de un aprendizaje situado e inclusivo.', 4.5, 4, 72),
(28, 4, 'Unidad 3 - Interculturalidad crítica e inclusión', 'El propósito de este curso es aportar elementos conceptuales y metodológicos para desarrollar la sensibilidad y valoración de la diversidad cultural y lingüística que caracteriza a México, así como de las singularidades biopsicosociales que es necesario atender, tensionadas desde la interseccionalidad de las exclusiones, y proporcionando un marco de referencia para el diseño de dispositivos pedagógicos teniendo como punto de partida la interculturalidad crítica y la atención de la diversidad y las singularidades.', 4.5, 4, 72),
(29, 4, 'Unidad 4 - Estrategias de trabajo docente y saberes pedagógicos', 'El curso Estrategias de trabajo docente y saberes pedagógicos precisa que el estudiante continúe con sus intervenciones educativas. Diseñe, aplique y sistematice sus propuestas de enseñanza, aprendizaje y evaluación haciendo uso de sus saberes, pedagógicos, metodológicos, disciplinares y experienciales. De este modo, ofrece herramientas teórico-metodológicas, didácticas y técnicas que favorezcan el diseño de propuestas de enseñanza situadas y reflexionadas acordes con los enfoques de los planes y programas de educación primaria vigentes. Busca que el estudiante materialice sus ideas, intenciones y análisis asumiendo una postura filosófica, pedagógica, intercultural y didáctica en torno a lo que significa educar y potenciar los aprendizajes de las niñas y niños de educación primaria.', 6.75, 6, 108),
(30, 4, 'Unidad 5 - Música, expresión corporal y danza', 'El curso tiene como propósito que el estudiantado utilice los lenguajes artísticos: la música, la expresión corporal y la danza para contextualizar, apreciar y expresarse desde estos lenguajes. De esta manera contribuye a la formación inicial del normalista para que a su vez promueva y favorezca ambientes en donde niñas y los niños de la escuela primaria se expresen, aprecien y valoren estos lenguajes como parte de su desarrollo personal, social y comunitario generando con esto un sentido estético, solidario e identitario con su contexto.', 4.5, 4, 72),
(31, 4, 'Unidad 6 - Educación física y salud', 'Que los y las estudiantes normalista reconozcan y comprendan el valor de la educación física y el vínculo que tiene con el desarrollo de una vida saludable, desde el estudio de referentes teóricos y metodológicos como son la corporeidad y motricidad en sus distintas manifestaciones y el desarrollo de hábitos de vida saludable que implican el cuidado personal, la conservación de la salud y la prevención de enfermedades, desde un enfoque de atención a la diversidad y de inclusión de grupos vulnerables en su futuro trabajo docente. Así mismo, en este curso las y los estudiantes normalistas identificarán el valor que tiene el juego, el deporte y la recreación como componentes de un desarrollo físico y emocional que tiene como fin una vida de bienestar y de prevención de enfermedades desde un sentido personal y comunitario.', 4.5, 4, 72),
(32, 4, 'Unidad 7 - Formación cívica y ética. Su aprendizaje y su enseñanza', 'El curso Formación Cívica y Ética. Su aprendizaje y su enseñanza tiene como propósito general que las y los estudiantes normalistas co-construyan un marco de referencia teórico de ciudadanía que les permita actuar en su vida personal y profesional a partir del pensamiento reflexivo, crítico, creativo y sistémico para que actúen dentro de una cultura del bien común, resuelvan en forma pacífica los conflictos, tomen consciencia y transformen su desempeño cívico y ético en las escuelas primarias conforme a los valores, principios filosóficos y legales del Sistema Educativo Mexicano. De esta manera se espera que diseñen e implementen experiencias de aprendizaje situado desde un marco humanista donde las niñas y los niños aprendan a complejizar el ejercicio de los derechos humanos, a reconocer los de otros, así como a vivir desde la infancia con dignidad en la democracia, en la justicia, en la igualdad, en la equidad de género y en la diversidad cultural.', 4.5, 4, 72),
(33, 4, 'Unidad 8 - Inglés. Desarrollo de conversaciones elementales', 'El curso Inglés. Desarrollo de conversaciones elementales tiene como propósito que las y los estudiantes normalistas continúen el desarrollo de saberes iniciales, correspondientes al nivel A1 según el Marco Común Europeo de Referencia para las lenguas (MCER). Estos conocimientos les permitirán expresar de manera básica la conformación y las rutinas de sus familias, algunas actividades propias y ajenas de la vida diaria, así como proporcionar instrucciones generales para llevar a cabo la conducción de una clase, especialmente lo relacionado con la observación y la preplaneación de su práctica docente. Así mismo, se abordan temas relacionados con los principios de la enseñanza y elaboración de material didáctico. Para tal efecto se propone utilizar un enfoque comunicativo que desarrolle las cuatro habilidades (leer, escribir, escuchar y hablar) en un marco intercultural.', 4.5, 4, 72),
(34, 5, 'Unidad 1 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(35, 5, 'Unidad 2 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(36, 5, 'Unidad 3 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(37, 5, 'Unidad 4 - Investigación e innovación de la práctica docente', 'El curso Investigación e innovación de la práctica docente tiene como propósito fortalecer los capacidades, dominios y desempeños de las y los estudiantes a través del uso de métodos, técnicas e instrumentos de la investigación que permitan la configuración y reconfiguración innovadora de sus saberes docentes, propiciando el uso crítico de la teoría, los procesos de análisis, reflexión, así como el seguimiento y evaluación de su práctica. Fomentar la elaboración de diagnósticos, el diseño de proyectos, su seguimiento, implementación y evaluación, con el fin de robustecer los procesos y prácticas relacionadas en la planificación, así como las propuestas de enseñanza-aprendizaje y evaluación, en función de los enfoques que proponen los planes y programas de estudios vigente.', 6.75, 6, 108),
(38, 5, 'Unidad 5 - Flexibilidad curricular', 'Pendiente de captura.', 6.75, 6, 108),
(39, 5, 'Unidad 6 - Flexibilidad curricular', 'Pendiente de captura.', 6.75, 6, 108),
(40, 5, 'Unidad 7 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(41, 5, 'Unidad 8 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(42, 6, 'Unidad 1 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(43, 6, 'Unidad 2 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(44, 6, 'Unidad 3 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(45, 6, 'Unidad 4 - Práctica docente y proyectos de mejora escolar y comunitaria', 'Que el estudiantado normalista potencie el uso de herramientas propias de la investigación cualitativa, en particular de la investigación-acción, articule y movilice saberes disciplinares, teórico metodológicos, técnicos y didácticos para el desarrollo de proyectos de mejora que tengan impacto en el aula, la escuela y la comunidad; diseñe propuestas educativas y didácticas con base en los enfoques de los planes y programas de estudio vigentes y fortalezca sus capacidades, niveles de dominio y desempeños que le permitan tomar decisiones reflexivas y críticas en los diversos contextos donde interviene.', 6.75, 6, 108),
(46, 6, 'Unidad 5 - Flexibilidad curricular', 'Pendiente de captura.', 6.75, 6, 108),
(47, 6, 'Unidad 6 - Flexibilidad curricular', 'Pendiente de captura.', 6.75, 6, 108),
(48, 6, 'Unidad 7 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(49, 6, 'Unidad 8 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(50, 7, 'Unidad 1 - Flexibilidad curricular', 'Pendiente de captura.', 6.75, 6, 108),
(51, 7, 'Unidad 2 - Flexibilidad curricular', 'Pendiente de captura.', 15.75, 14, 252),
(52, 7, 'Unidad 3 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(53, 8, 'Unidad 1 - Flexibilidad curricular', 'Pendiente de captura.', 9, 8, 144),
(54, 8, 'Unidad 2 - Flexibilidad curricular', 'Pendiente de captura.', 22.5, 20, 360),
(55, 1, 'Unidad 1 - Saberes del contexto sociocultural y escolar', 'El aporte de esta Unidad se centra en dos elementos de estudio, los saberes culturales del contexto comunitario y los contenidos escolares planteados en los programas de educación preescolar y primaria vigentes, la aproximación analítica a dichos componentes, permite que se reflexione acerca de las implicaciones de aprender a generar procesos de construcción de saberes, como parte de la complejidad del trabajo docente en la interculturalidad y el plurilingüismo.', 6.75, 6, 108),
(56, 1, 'Unidad 2 - Lenguas y lenguajes, usos y funciones culturales en los procesos educativos', 'En esta unidad de estudio, las y los estudiantes adquieren nociones acerca de distintas expresiones del lenguaje, habilidades y códigos lingüísticos, como el verbal, simbólico, corporal, artístico, escrito, entre otros, que en conjunto conforman procesos de comunicación y manifestaciones de sentir y pensar, generados de acuerdo a la cosmovisión y saberes. El acercamiento a estos elementos da la posibilidad de explorar y analizar sus usos, funciones y conceptualizaciones en idiomas maternos, segundas o terceras lenguas, con base en las características culturales, lingüísticas y humanas del contexto comunitario; a su vez, permite reflexionar su potencial como recursos de aprendizaje, es decir, plantearlos como contenidos para el desarrollo, fortalecimiento y mantenimiento de lenguas y culturas en cada contexto social y escolar en situaciones reales.', 6.75, 6, 108),
(57, 1, 'Unidad 3 - El docente, su identidad sociocultural y profesional', 'En esta Unidad de Estudio los estudiantes desarrollan actividades que les permitan analizar los elementos que conforman su identidad sociocultural y profesional, a partir de diversas temáticas relacionadas con el contexto social y comunitario, esenciales en los ámbitos del trabajo docente desde lo plurilingüe y lo intercultural. En este sentido, el análisis crítico de la realidad comunitaria y escolar, exige un conjunto de miradas, observaciones, diálogos y percepciones que pongan en primer plano la interrelación de significados de los saberes individuales, familiares, escolares, comunitarios, regionales, nacionales y mundiales, para abordar las características inmanentes del ser docente como profesional de la educación.', 6.75, 6, 108),
(58, 1, 'Unidad 4 - El trabajo docente y las perspectivas de la investigación en educación', 'En esta Unidad de Estudio, los estudiantes desarrollan la integración pedagógica y metodológica de los primeros procesos de observación - conversación - indagación - problematización - sistematización e investigación de la complejidad del mundo de la docencia y el quehacer escolar en el aula, las funciones de organización, administración y gestión escolar, las estrategias de trabajo docente para la enseñanza y el aprendizaje de las niñas y niños, la creación de ambientes en la construcción de saberes, y los estilos de acercamientos interculturales que hacen expresar las emociones del sentir y pensar de la escuela, con el contexto social, lingüístico, económico, político y cultural.', 4.5, 4, 72),
(59, 1, 'Unidad 5 - Infancias y prácticas de crianza comunitarias desde la cultura de pertenencia', 'En esta Unidad de Estudio se parte de dos concepciones, la primera se relaciona con las infancias y la segunda con las prácticas de crianza, ambas constituyen los pilares sobre los cuales se construyen los saberes culturales de los pueblos, que aportan valor simbólico a la educación infantil, desde las creencias de las culturas que se encuentran en la comunidad.', 6.75, 6, 108),
(60, 1, 'Unidad 6 - La diversidad cultural y lingüística en la historia de la educación básica en México', 'Esta Unidad de Estudio contribuye al análisis crítico de la atención a la diversidad cultural y lingüística con base en los modelos, enfoques y propuestas pedagógicas que han prevalecido en la educación básica en México, en específico en la educación indígena, así como en la identificación de programas y proyectos educativos impulsados por las propias comunidades y organismos civiles, alternos a normas y leyes establecidas en las políticas educativas.', 4.5, 4, 72),
(61, 1, 'Unidad 7 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(62, 2, 'Unidad 1 - Diálogo de saberes en la educación intercultural', 'Esta unidad de estudio, aporta elementos de análisis y comprensión acerca de las implicaciones del diálogo de saberes, como una posibilidad metodológica que orienta procesos de aprendizaje intercultural, siendo necesario reconocer saberes del contexto social, cultural, lingüístico y humano en que se desarrolla el trabajo docente; de esta manera, el planteamiento recupera contenidos culturales y escolares, abordados en la unidad de estudio Saberes del contexto sociocultural y escolar del primer semestre.', 6.75, 6, 108),
(63, 2, 'Unidad 2 - Las habilidades lingüísticas en contexto', 'Esta unidad de estudio promueve el aprendizaje relacionado con el desarrollo de las habilidades comunicativas y lingüísticas en lenguas maternas, segundas o terceras lenguas (lenguaje oral, textual, gestual, transcripto, virtual, articulado, visual, escrito), pueden ser indígenas, español o algún idioma extranjero, pone en el centro al lenguaje que caracteriza al plurilingüismo y la interculturalidad en educación como propósito formativo. Lo que implica que el estudiantado en proceso de formación profesional docente, profundice en la revisión conceptual en relación con los contenidos fundamentales de aprendizaje, los sistemas de comunicación y habilidades lingüísticas, para aprender a producir y comprender textos en varias lenguas y desde el sentido de la cosmovisión cultural y escolar.', 6.75, 6, 108),
(64, 2, 'Unidad 3 - Docencia intercultural, plurilingüe y comunitaria', 'En esta Unidad de Estudio, el estudiantado amplía sus procesos de identidad docente y formación profesional, al considerar las características y condiciones sociales, culturales, lingüísticas y comunitarias que se presentan en los contextos local, regional y nacional. Reconocen cómo lo expuesto, influye y aproxima la diversidad de saberes y conocimientos que se vinculan directamente con el ejercicio del trabajo docente, les permiten identificar la construcción de las experiencias y estrategias de enseñanza, los niveles de concreción metodológica y didáctica, reconocen múltiples formas de estructurar, articular la organización y dinamismo del proceso de aprendizaje, además, la motiva la búsqueda de distintas formas nativas epistémicas que agencian los saberes en la niñez emanados de la convivencia social, familiar y de vida comunitaria.', 6.75, 6, 108),
(65, 2, 'Unidad 4 - La indagación del contexto comunitario y educativo', 'En esta Unidad de Estudio se indaga con mayor profundidad las condiciones naturales, físico-geográficas, económico-productivas, histórico-sociales, familiares, culturales y lingüísticas de la comunidad/territorio que influyen y condicionan: las formas de organización escolar y comunitaria; las diversas relaciones entre director/a, docentes y estudiantes; los vínculos afectivos, de respeto, responsabilidad, disciplina y valores que se promueven en la niñez; el diálogo de saberes, de conocimientos y experiencias vividas en el aula; las estrategias de enseñanza y aprendizaje que docentes y estudiantes recrean y desarrollan en los espacios escolares, y todos los procesos pedagógicos que conforman el trabajo docente plurilingüe e intercultural.', 4.5, 4, 72),
(66, 2, 'Unidad 5 - Infancias en México. Consideraciones básicas en la escolarización', 'La unidad de estudio Infancias en México. Consideraciones básicas en la escolarización, aporta elementos para enriquecer la reflexión, el análisis y la explicación del desarrollo infantil; partiendo de la premisa que puede ser explicado desde el contexto sociocultural en que sucede, considerando diversos factores que permean la vida de la niñez e infancias que, de no atenderse, pueden constituir barreras para el aprendizaje y el desarrollo que impidan el pleno cumplimiento de sus derechos.', 6.75, 6, 108),
(67, 2, 'Unidad 6 - Pedagogías y perspectiva decolonial', 'La unidad de estudio se centra en la revisión de algunas tendencias pedagógicas que han incidido en el quehacer docente en nuestro país, privilegiando históricamente la homogeneización sociocultural desde la acción educativa, imponiéndose políticas colonizadoras en las escuelas. De igual manera, se plantea la revisión de otras pedagogías que en los últimos tiempos han surgido como alternativas para reorientar los propósitos educativos hacia procesos críticos, de reivindicación de pensamientos y conocimientos que permitan a los destinatarios fortalecer su identidad como propietarios y usuarios de una cultura igual de valiosa que las demás.', 4.5, 4, 72),
(68, 2, 'Unidad 7 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(69, 3, 'Unidad 1 - Modos de aprender saberes del mundo natural y comunitario en la escuela', 'El aprendizaje escolarizado de la formación infantil en nuestro país, aún se caracteriza por enseñar conocimientos provenientes de otros lugares del mundo, privilegiando la monopolización de conocimientos científicos y disciplinares, como la matemática, ciencias naturales, ciencias sociales, artes, entre otros, y el español como lengua “oficial”, con los que se ha conformado el contenido de aprendizaje infantil en el currículum formal de educación primaria; estas decisiones y políticas educativas dejan al margen los saberes culturales y lenguas nativas de los pueblos indígenas, afromexicanos y comunidades en situaciones de migración, a pesar de diversos planteamientos de acciones pedagógicas y educativas de persistencia y reivindicación de sus cosmovisiones de vida cotidiana.', 6.75, 6, 108),
(70, 3, 'Unidad 2 - Planeación didáctica y evaluación formativa', 'En esta unidad de Estudio, las y los estudiantes retoman sus saberes comunitarios para construir sus referentes conceptuales teóricos y metodológicos relacionados con la planeación didáctica y la evaluación formativa; a través de la apropiación de los fundamentos en los que se sustenta el aprendizaje y la enseñanza colaborativa, en una permanente reflexión crítica a partir de la investigación de su propio trabajo docente en contextos comunitario y escolar como contenidos fundamentales de aprendizaje.', 4.5, 4, 72),
(71, 3, 'Unidad 3 - Iniciación del trabajo docente y narración del saber intercultural', 'Esta Unidad de Estudio aborda el significado del trabajo docente, refiere a las acciones que desempeña el y la docente con las niñas y niños en el aula, la escuela y la comunidad; es un proceso que incorpora la experiencia de los diferentes actores familiares, productivos y sociales del contexto. Se sugiere que el estudiantado prepare su inmersión directa en escuelas primarias de organización completa; considere problematizar y documentar las experiencias de una nueva relación pedagógica basada en el “Encuentro”, haciendo uso de la investigación educativa y comunitaria.', 6.75, 6, 108),
(72, 3, 'Unidad 4 - Prácticas socioculturales y escolares del lenguaje', 'Esta Unidad de Estudio está diseñada con el afán de que las y los estudiantes normalistas, diseñen estrategias metodológicas para preparar e iniciar el trabajo docente haciendo uso de la tradición oral de las prácticas socioculturales del contexto, que les permita promover el aprendizaje de las lenguas y el análisis morfológico de primeras, segundas, terceras lenguas, lengua de señas mexicana y escritura Braille, con un sentido de pertenencia y no sólo concebirlo como los elementos que constituyen una serie de información obtenida durante la jornada de investigación.', 6.75, 6, 108),
(73, 3, 'Unidad 5 - Desarrollo socioafectivo y motriz de las infancias', 'El desarrollo socioafectivo y motriz es un aspecto fundamental que afecta la vida de todos los seres humanos, sin importar el entorno en el que nazcan o las condiciones económicas, afectivas, culturales y sociales en las que se encuentren. Es importante reconocer que las cargas emocionales y afectivas que experimentamos influyen en el tipo de persona en que nos convertiremos en el futuro.', 6.75, 6, 108),
(74, 3, 'Unidad 6 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(75, 3, 'Unidad 7 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(76, 4, 'Unidad 1 - Articulación epistémica: naturaleza, ser humano y territorio', 'La unidad de estudio Articulación epistémica: naturaleza, ser humano y territorio, gira en torno a la continuidad del proceso de aprendizaje intercultural en la formación de las y los estudiantes normalistas, a partir de la identificación, estudio y articulación de la diversidad de saberes nativos, del medio natural, sociocultural y comunitario con los disciplinares, inherentes al ser humano (ser social) que se forma y a su vez transforma la naturaleza y el territorio comunidad, con la intención de erradicar la enseñanza monocultural, la lógica racista y etnocida, así como, promover el entendimiento de los procesos formativos asentados desde y con el territorio para que surjan y respondan a intereses y necesidades locales.', 6.75, 6, 108),
(77, 4, 'Unidad 2 - Formas de contar y medir en la comunidad y en la escuela', 'En esta unidad de estudio, las y los estudiantes normalistas exploran las diversas formas de contar y medir que usan en las comunidades originarias donde hacen su inmersión a partir de las experiencias de vida cotidiana, generando situaciones de intervención en el aprendizaje y la enseñanza intercultural, para ello indagan cómo se cuentan y se miden aspectos relacionados con la pesca, los bordados, el telar, la siembra y otras actividades que se practican.', 6.75, 6, 108),
(78, 4, 'Unidad 3 - El quehacer pedagógico y didáctico en grupos multigrado', 'Esta unidad pretende que se preparan para asumir los retos del trabajo docente en estos contextos, promueven el encuentro pedagógico mediante la vinculación de los proyectos de aula, escuela y comunidad en sus jornadas pedagógicas, de igual manera, desde la perspectiva sociolingüística y cultural de las escuelas, reconocen las dificultades y potencialidades y toman decisiones considerando las bases epistémicas teórico/conceptuales y pedagógicas desde procesos didácticos que favorezcan la integración de conocimientos disciplinares, saberes y experiencias educativas. Haciendo uso de la investigación educativa, exploran los antecedentes culturales, históricos, de esta modalidad escolar, y los relacionan con las condiciones económicas, sociales, políticas, organizacionales y de dispersión territorial en zonas vulneradas.', 6.75, 6, 108),
(79, 4, 'Unidad 4 - Procesos metodológicos de lectura y escritura', 'En esta unidad de estudio se revisan, analizan, diseñan e implementan procesos metodológicos de lectura y escritura partiendo de narrativas situadas que visibilizan las otras formas de leer y escribir del mundo: logográficas (jeroglíficos, ideogramas, glifos e imágenes de los códices), silábicas (los silabarios japoneses o la escritura hangul coreana) y alfabéticas (alfabetos como el latín o el castellano moderno). De la misma manera, se realiza la reflexión sobre la lengua vinculada con los usos y las funciones en los sistemas de comunicación a través de producciones escritas de modo que reconozcan las estructuras morfosintácticas de las diversas lenguas y/o formas de comunicación. Esto requiere que las y los estudiantes conozcan los sistemas de lectura y escritura que distintas sociedades humanas han producido a lo largo de la historia para después reconocer aquellos que coexistieron entre las culturas originarias de México y los de sus contextos, previo a la llegada de la escritura ', 6.75, 6, 108),
(80, 4, 'Unidad 5 - Promoción del deporte y cuidados de la salud infantil', 'Esta Unidad de estudio tiene como propósito que la comunidad normalista se identifique como promotora del deporte y la salud a través del reconocimiento de los beneficios que brinda la actividad física, así como la seguridad alimentaria, recuperando las prácticas ancestrales comunitarias con el objeto de fortalecer el deporte escolar mediante la promoción de una cultura que coadyuve en el mejoramiento de la salud infantil.', 4.5, 4, 72),
(81, 4, 'Unidad 6 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(82, 4, 'Unidad 7 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(83, 5, 'Unidad 1 - Complementariedad, diálogo de saberes y cosmovisiones culturales diversas', 'La unidad de estudio Complementariedad, diálogo de saberes y cosmovisiones culturales diversas, posibilita la recuperación de experiencias pedagógicas y didácticas que las y los estudiantes vienen aprehendiendo de semestres anteriores de contextos comunitarios, escolares vinculados a conocimientos teóricos, convirtiéndose así, en un espacio de análisis crítico en la formación del docente intercultural y plurilingüe.', 6.75, 6, 108),
(84, 5, 'Unidad 2 - Trabajo docente en grupos multigrado y la práctica intercultural', 'En esta unidad de estudio, las y los estudiantes de la escuela normal, analizan y reflexionan sus experiencias pedagógicas adquiridas en la atención de los grupos multigrado del semestre anterior. Destacan los saberes, sentires y pensares que dejaron sus encuentros con las niñas y niños. El conocimiento de la diversidad natural, lingüística y cultural como forma de vida familiar, escolar y territorial, elementos que dan fundamento al enfoque formativo de esta licenciatura como un punto de partida para generar aprendizajes. De igual modo, valoran sus alcances aprendidos al promover una mayor apertura a la inclusión de saberes de la niñez y la participación social de madres y padres de familia.', 6.75, 6, 108),
(85, 5, 'Unidad 3 - La interpretación de fenómenos sociales y educativos a través de la estadística', 'La estadística juega un papel decisivo en el análisis de fenómenos sociales y educativos, especialmente en contextos plurilingües y comunitarios. Proporciona a las y los estudiantes una base sólida para la interpretación de datos cuantitativos y cualitativos, y puedan comprender las complejidades y matices de estos fenómenos. Al dotarlos con habilidades estadísticas, se empoderan para que aprendan a analizar, interpretar y tomen decisiones informadas basadas en evidencia que pueden tener un impacto significativo en sus comunidades de inmersión.', 6.75, 6, 108),
(86, 5, 'Unidad 4 - Desarrollo de habilidades lingüísticas en situaciones de diversidad', 'Las y los estudiantes normalistas diseñan y aplican estrategias didácticas mediante propuestas de intervención pedagógica para el desarrollo de las habilidades lingüísticas en contextos diversos, en atención de primeras, segundas y terceras lenguas con el fin de fortalecer, revitalizar y/o reivindicarlas. Toman en cuenta los tipos de escuelas y territorios, las lenguas que se hablan en los pueblos originarios y las otras identidades culturales y comunitarias que existen en ellos.', 6.75, 6, 108),
(87, 5, 'Unidad 5 - Expresión estética en la producción cultural', 'La presente unidad de estudio reconoce la expresión estética en la producción cultural, promoviendo un enfoque integral para abarcar las diversas formas de expresiones orales, visuales, dancísticas y auditivas en los pueblos originarios. Se fomenta la apropiación cultural partiendo de lo intercultural y plurilingüe en la construcción de conocimientos identitarios fortaleciendo de esta manera las experiencias formativas a partir de la realidad comunitaria.', 4.5, 4, 72),
(88, 5, 'Unidad 6 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(89, 5, 'Unidad 7 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(90, 6, 'Unidad 1 - Diseño de propuestas pedagógicas desde la diversidad y la interculturalidad', 'Esta unidad de estudio se centra en promover el desarrollo de conocimientos, habilidades y actitudes docentes que posibiliten en las y los estudiantes normalistas, diseñar y aplicar propuestas pedagógicas que planteen como punto de partida, la realidad contextual de las y los niños de primaria, identificando situaciones de vida cotidiana que puedan retomarse como elemento sustancial y de pauta al diálogo de saberes desde lo metodológico y lo pedagógico, identificando con ello, las estrategias y formas didácticas de atención, según el contexto que se está atendiendo.', 6.75, 6, 108),
(91, 6, 'Unidad 2 - Proyecto de intervención e innovación pedagógica en la escuela y la comunidad', 'Las y los estudiantes, realizan la transición gradual y progresiva de la fase intermedia hacia la profesional mediante el diseño y aplicación del proyecto de intervención e innovación pedagógica en la escuela y la comunidad. Abordan una nueva relación educativa de encuentro horizontal y colaborativo con las niñas, niños, madres, padres de familia y demás actores sociales. Aprenden a intervenir de otros modos, es decir, a hacer comunidad en la interculturalidad y el plurilingüismo con la contribución de saberes, experiencias y conocimientos de todos; con responsabilidad compartida y trato de igualdad, intervención que no viene de fuera ni es esperada como algo dado, sino se construye comunitariamente.', 6.75, 6, 108),
(92, 6, 'Unidad 3 - Bases legales y organizativas del Sistema educativo mexicano y derechos culturales', 'Esta unidad de estudio cierra la fase intermedia del tejido curricular, la cual se considera como un espacio de transición, lo que significa que las y los estudiantes tendrán posibilidades para realizar un recuento de toda la trayectoria de formación profesional logrado hasta ahora; esto implica que el análisis y la reflexión se enfoca al contexto comunitario y escolar, ámbitos en que se sitúa la realización del trabajo docente por inmersión; donde pondrán de manifiesto diversas situaciones que enfrenta la educación de la niñez indígena, afromexicana, en situación de migración, mestiza o de otro carácter muchas veces caracterizada por la inequidad y la desigualdad en las oportunidades de acceso a la educación pública o con resultados del aprendizaje que poco favorecen el trabajo académico de niñas y niños, afectando su desarrollo y fortalecimiento cultural y lingüístico del contexto en que se da el aprendizaje, y en general, las bases y condiciones que quedan de fuera en el sistema edu', 4.5, 4, 72),
(93, 6, 'Unidad 4 - Gestión comunitaria, institucional y escolar', 'La gestión en la acción educativa requiere, en los tiempos actuales, el involucramiento de los diversos agentes que se encargan de coadyuvar en el aprendizaje de la niñez en la escuela como institución, poniendo en el centro las condiciones reales de la sociedad como comunidad, con su identidad cultural, lingüístico y territorial. Con esta idea, es fundamental que las y los estudiantes normalistas, cuenten con habilidades y herramientas necesarias para liderar, de manera efectiva, en la gestión educativa mediante procedimientos de planeación estratégica en los ámbitos de lo comunitario, institucional y escolar, en los lugares de inmersión del trabajo docente.', 6.75, 6, 108),
(94, 6, 'Unidad 5 - Estrategias de inclusión educativa e interculturalidad con todos', 'En esta unidad de estudio, las y los estudiantes emprenden un viaje de descubrimiento a través de un acto de autorreflexión para tomar conciencia y reconocer las experiencias de exclusión, discriminación, marginación en las que la percepción de la docencia y los que están en formación -sin generalizar en absoluto- directa o indirectamente han participado; identifican las fisuras en el Sistema Educativo Mexicano, así como la ausencia de una educación inclusiva y la prevalencia de la inequidad social.', 6.75, 6, 108),
(95, 6, 'Unidad 6 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(96, 6, 'Unidad 7 - Flexibilidad curricular', 'Pendiente de captura.', 4.5, 4, 72),
(97, 7, 'Unidad 1 - Trabajo profesional docente sociocultural y educativo', 'La fase profesional de la Licenciatura en Educación Primaria Intercultural Plurilingüe y Comunitaria, se caracteriza por la concreción y profundización de acciones pedagógicas y didácticas que las y los estudiantes normalistas realizan de su trabajo docente, situado en contextos de diversidad social, cultural, lingüística y escolar. El séptimo y octavo semestres, es un periodo de cierre de la experiencia formativa, en el que se asumen como profesionales de la educación, al consolidar propuestas de práctica con enfoque intercultural y plurilingüe para la atención educativa de niños y niñas de educación primaria.', 22.5, 20, 360);
INSERT INTO `unidades_estudio` (`id`, `semestres_id`, `nombre`, `descripcion_general`, `creditos`, `horas_semana`, `horas_semestre`) VALUES
(98, 7, 'Unidad 2 - Análisis sistemático del trabajo docente y proceso de titulación', 'La fase profesional de la Licenciatura en Educación Primaria Intercultural Plurilingüe y Comunitaria, se caracteriza por la concreción y profundización de acciones pedagógicas y didácticas que las y los estudiantes normalistas realizan de su trabajo docente, situado en contextos de diversidad social, cultural, lingüística y escolar. El séptimo y octavo semestres, es un periodo de cierre de la experiencia formativa, en el que se asumen como profesionales de la educación, al consolidar propuestas de práctica con enfoque intercultural y plurilingüe para la atención educativa de niños y niñas de educación primaria.', 18, 16, 288),
(99, 8, 'Unidad 1 - Trabajo profesional docente sociocultural y educativo', 'La fase profesional de la Licenciatura en Educación Primaria Intercultural Plurilingüe y Comunitaria, se caracteriza por la concreción y profundización de acciones pedagógicas y didácticas que las y los estudiantes normalistas realizan de su trabajo docente, situado en contextos de diversidad social, cultural, lingüística y escolar. El séptimo y octavo semestres, es un periodo de cierre de la experiencia formativa, en el que se asumen como profesionales de la educación, al consolidar propuestas de práctica con enfoque intercultural y plurilingüe para la atención educativa de niños y niñas de educación primaria.', 22.5, 20, 360),
(100, 8, 'Unidad 2 - Análisis sistemático del trabajo docente y proceso de titulación', 'La fase profesional de la Licenciatura en Educación Primaria Intercultural Plurilingüe y Comunitaria, se caracteriza por la concreción y profundización de acciones pedagógicas y didácticas que las y los estudiantes normalistas realizan de su trabajo docente, situado en contextos de diversidad social, cultural, lingüística y escolar. El séptimo y octavo semestres, es un periodo de cierre de la experiencia formativa, en el que se asumen como profesionales de la educación, al consolidar propuestas de práctica con enfoque intercultural y plurilingüe para la atención educativa de niños y niñas de educación primaria.', 18, 16, 288);

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `rol_id`, `estado_id`, `tipo_usuario_id`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'root', 'pQeZefuxsI0kiGxn_OKI6IXdBznTmWF9', '$2y$13$M0AvNyw666uh452dv5sdJOLimBesSgRNjdFTGZFCXEEf0rsnEVohm', NULL, 'root@root.com', 7, 1, 2, '2025-08-30 14:25:57', '2025-08-30 14:25:57', 'WnDqUcudrydqtx7rhS8QrZ5P8m-a8mMn_1756585557'),
(35, 'johana.yoe', '-Rj_DK_UVuQ0wjAH5fNdTi5tz4xRFYVQ', '$2y$13$7fl5DdkiPTCbPs.F5MCGoeCffdtxi43xbtRuONnHCt6XfKrAkTwPW', NULL, 'johana.yoe@gmail.com', 8, 1, 1, '2026-01-15 18:57:22', '2026-01-15 19:07:28', 'uR7QEr_lbvZXDgzDfSstNVGBzypgpR-W_1768525042'),
(36, 'eduardo.aee', 'ZD8SobvYHrqW6MK1cVbL1rEGU9r0HGGa', '$2y$13$6R4u.nNJ0xKVl6XYkUWap.l8lmmL6ybx2lgCosMyb1lVnf0iXr0zW', NULL, 'eduardo.aee@gmail.com', 8, 1, 1, '2026-01-15 19:01:33', '2026-01-15 19:01:33', 'Rz3g8eFINTf49g97ZfWHv6pf2EMAdtDw_1768525293'),
(37, 'carlos.ace', 'lEQV1cOevunVFFhEukl1s4YZgvJ7aC73', '$2y$13$VidWSmN4N95FAhwnAZJ7j.qC4LFsLHfAejhwuYb7QwKG.KSJ0.4Ma', NULL, 'carlos.ace@gmail.com', 8, 2, 1, '2026-01-15 19:02:28', '2026-01-15 19:02:28', 'LEQPynrDcC-nlX9J0qXK7szJRAxh13W9_1768525348'),
(38, 'geffy.jee', 'uoUB3O42I7n4lLvfmbx1qnPxPYIf3bAd', '$2y$13$ymi2gBdYDvNbcts6oGvcz.4XA32fUI56WPz9mNosaAWWAwBw0Ceka', NULL, 'geffy.jee@gmail.com', 8, 3, 1, '2026-01-15 19:03:22', '2026-01-15 19:03:22', 'Jqv1LtMQI7xKsE5knerFe9vdXm34GNjG_1768525402'),
(39, 'jorge.gep', 'SDzPzZz5DA-TUNbENb0RGFQqyNZb-Il4', '$2y$13$.aCk2nRjUptEfvNKHSNmQ.MHqh44c3m.cfpFBit2TGfbXAxNPjLn.', NULL, 'jorge.gep@gmail.com', 8, 2, 1, '2026-01-15 19:04:45', '2026-01-15 19:04:45', 'hed7gTxvpIklk0NmUyvWE-L8nHG_M_Gr_1768525485'),
(40, 'eiffy.zen', 'mz0vNYRrzySw16Q7LJYYJFfLFj72K7bP', '$2y$13$hhTscweNbJc1dxBUsRhYH.cR8suAtjmlaKSQWTZHoUbQ3PPsvfsOe', NULL, 'eiffy.zen@gmail.com', 8, 2, 1, '2026-01-15 19:10:03', '2026-01-15 19:10:03', '9K6rNElH-kdn-eroajMcZC4iBO0ZJ-j5_1768525803'),
(41, 'maria.mng', 'UzdEbvLifSQK8l_6kUW8YRJrfPC5gNXs', '$2y$13$6Gv7O7rYl2dDa1FnmVOAdeXAlXLISSw66X83mkf8gIRzd/gulgSG2', NULL, 'maria.mng@gmail.com', 8, 1, 1, '2026-01-15 19:11:01', '2026-01-15 19:11:01', 'nlFZ0tbEVnQy8FzhwXcMUycbsuP8uEAN_1768525861'),
(42, 'jorge.hee', 'dYSv5lMOb0uthXeXxqydri02t_uigaU4', '$2y$13$YIGtwqe.qeikviUYmHeDRuOdLgg9QsUz3/gSRXJlBSooaBFSuOn4i', NULL, 'jorge.hee@gmail.com', 8, 1, 1, '2026-01-15 19:11:47', '2026-01-15 19:11:47', 'eDIPw92kM4M_4D7W_7dqYffnUu4jauty_1768525907'),
(43, 'lidy.men', 'ugLOyMpP_pgB87cXZatDenSIrzZTUVA0', '$2y$13$FPkWNyQ5XBZVjPrTzeFl6ecOtwZzDwZAO.FvfJChlW3hkuVxNTuTm', NULL, 'lidy.men@gmail.com', 8, 2, 1, '2026-01-15 19:12:42', '2026-01-15 19:12:42', 'EpMYbp5k0_j-qWjMCoii2YNXHqo1deRG_1768525962'),
(44, 'jorge.men', '7XKk0CX208C3SPojevk4kMvByE1_whlN', '$2y$13$brw65QNNXbPLvdDCTgbUs.f/JpxGM7IJoJ/78wQQAzGUhwifpjNc2', NULL, 'jorge.men@gmail.com', 8, 2, 1, '2026-01-15 19:13:38', '2026-01-15 19:13:38', 'TVsFJjk429w5dURYduQXb-zqiESN5yFb_1768526017'),
(45, 'marco.aoe', 'rahlgwSCf0gen9OxN2-jcJom37RSmNlT', '$2y$13$0MHUNw9B582F.S/qcxrjpOphZLPbB.4D.FDxE7un9Q.tcNP.B71ee', NULL, 'marco.aoe@gmail.com', 8, 3, 1, '2026-01-15 19:14:53', '2026-01-15 19:14:53', '9Ul6lnAlTmygT9N1uL6YAO6Q8UZksHgN_1768526093'),
(46, 'jesus.aoe', '-Pb8AAEESGvQ-ahEHhIwfgFmMrQdBrQp', '$2y$13$/iCatAk0OZYmA5ORbmn0ouQFXRCzgy/I1RIX2o2Y.dEM8thbGNSo2', NULL, 'jesus.aoe@gmail.com', 8, 1, 1, '2026-01-15 19:15:49', '2026-01-15 19:15:49', 'Rlma9Ry6i2iZRsfGwFFiVmzmVRpLSI9l_1768526149'),
(47, 'irina.oe', 'mjL5G4_zQTmZIwAtqq6Q_TjZMx-lbDeb', '$2y$13$4kA17uRyBaPjhjvqi8vGCe9jOJmk0bFx.lb0iI/OTiEhFKe4icr7a', NULL, 'irina.oe@gmail.com', 8, 1, 1, '2026-01-15 19:16:39', '2026-01-15 19:16:39', 'aFkTheTD0MDAghb-Cwdg2oGINfOAi9Od_1768526199'),
(48, 'milan.le', 'ynL9-rQV9_FobCz0jE9ZFw0fsPTht33s', '$2y$13$UNDqL7R61fDDbjd4PV00x.YgtzJc4GhL2iTRpRY5n7/LwQ7Nxjq4i', NULL, 'milan.le@gmail.com', 8, 2, 1, '2026-01-15 19:17:32', '2026-01-15 19:17:32', 'YRV6z0SEtuK7KSllJ6PovozhXB2czcCJ_1768526252');

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
) ENGINE=InnoDB AUTO_INCREMENT=387 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=421 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=1050 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=544 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alergias`
--
ALTER TABLE `alergias`
  ADD CONSTRAINT `fk_alergias_alum_alergia1` FOREIGN KEY (`alum_alergia_id`) REFERENCES `alum_alergia` (`id`) ON DELETE CASCADE,
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
  ADD CONSTRAINT `fk_alum_alergia_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alum_asiste_dentista`
--
ALTER TABLE `alum_asiste_dentista`
  ADD CONSTRAINT `fk_alum_asiste_dentista_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_alum_asiste_dentista_frecuencia_tiempo1` FOREIGN KEY (`frecuencia_tiempo_id`) REFERENCES `frecuencia_tiempo` (`id`);

--
-- Filtros para la tabla `alum_asiste_medico`
--
ALTER TABLE `alum_asiste_medico`
  ADD CONSTRAINT `fk_alum_asiste_medico_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_alum_asiste_medico_frecuencia_tiempo1` FOREIGN KEY (`frecuencia_tiempo_id`) REFERENCES `frecuencia_tiempo` (`id`);

--
-- Filtros para la tabla `alum_becas`
--
ALTER TABLE `alum_becas`
  ADD CONSTRAINT `fk_alumnos_becas_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_alumnos_becas_tipos_becas1` FOREIGN KEY (`tipos_becas_id`) REFERENCES `tipos_becas` (`id`);

--
-- Filtros para la tabla `alum_bienes_personales`
--
ALTER TABLE `alum_bienes_personales`
  ADD CONSTRAINT `fk_alum_bienes_personales_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_alum_bienes_personales_catalogo_bienes_personales1` FOREIGN KEY (`catalogo_bienes_personales_id`) REFERENCES `catalogo_bienes_personales` (`id`);

--
-- Filtros para la tabla `alum_consumo_alimentos`
--
ALTER TABLE `alum_consumo_alimentos`
  ADD CONSTRAINT `fk_alum_consumo_alimentos_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_alum_consumo_alimentos_catalogo_alimentos1` FOREIGN KEY (`catalogo_alimentos_id`) REFERENCES `catalogo_alimentos` (`id`),
  ADD CONSTRAINT `fk_alum_consumo_alimentos_frecuencia_veces1` FOREIGN KEY (`frecuencia_veces_id`) REFERENCES `frecuencia_veces` (`id`);

--
-- Filtros para la tabla `alum_datos_familiares`
--
ALTER TABLE `alum_datos_familiares`
  ADD CONSTRAINT `fk_alum_datos_familiares_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alum_dependen_economica`
--
ALTER TABLE `alum_dependen_economica`
  ADD CONSTRAINT `fk_alum_dependen_economica_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alum_depende_economicamente`
--
ALTER TABLE `alum_depende_economicamente`
  ADD CONSTRAINT `fk_alum_depende_economicamente_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_alum_depende_economicamente_catalogo_dependencias_economic1` FOREIGN KEY (`catalogo_dependencias_economicas_id`) REFERENCES `catalogo_dependencias_economicas` (`id`);

--
-- Filtros para la tabla `alum_deportes`
--
ALTER TABLE `alum_deportes`
  ADD CONSTRAINT `fk_alum_deportes_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alum_ejercicio`
--
ALTER TABLE `alum_ejercicio`
  ADD CONSTRAINT `fk_alum_ejercicio_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alum_enfermedades_cronicas`
--
ALTER TABLE `alum_enfermedades_cronicas`
  ADD CONSTRAINT `fk_alum_enfermedades_cronicas_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alum_estado_salud`
--
ALTER TABLE `alum_estado_salud`
  ADD CONSTRAINT `fk_alum_estado_salud_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alum_habitos_consumo`
--
ALTER TABLE `alum_habitos_consumo`
  ADD CONSTRAINT `fk_alum_habitos_consumo_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_alum_habitos_consumo_catalogo_cigarros_dia1` FOREIGN KEY (`catalogo_cigarros_dia_id`) REFERENCES `catalogo_cigarros_dia` (`id`),
  ADD CONSTRAINT `fk_alum_habitos_consumo_frecuencia_veces_semana1` FOREIGN KEY (`frecuencia_veces_semana_id`) REFERENCES `frecuencia_veces_semana` (`id`);

--
-- Filtros para la tabla `alum_info_hijos`
--
ALTER TABLE `alum_info_hijos`
  ADD CONSTRAINT `fk_alumnos_info_hijos_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alum_inscripciones`
--
ALTER TABLE `alum_inscripciones`
  ADD CONSTRAINT `fk_alum_inscripciones_ciclos_semestres1` FOREIGN KEY (`ciclos_semestres_id`) REFERENCES `ciclos_semestres` (`id`),
  ADD CONSTRAINT `fk_alumnos_inscripciones_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_alumnos_inscripciones_tipos_inscripciones1` FOREIGN KEY (`tipos_inscripciones_id`) REFERENCES `tipos_inscripciones` (`id`);

--
-- Filtros para la tabla `alum_lugares_comer`
--
ALTER TABLE `alum_lugares_comer`
  ADD CONSTRAINT `fk_alum_lugares_comer_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_alum_lugares_comer_catalogo_lugares_comer1` FOREIGN KEY (`catalogo_lugares_comer_id`) REFERENCES `catalogo_lugares_comer` (`id`);

--
-- Filtros para la tabla `alum_organizacion`
--
ALTER TABLE `alum_organizacion`
  ADD CONSTRAINT `fk_alum_organizacion_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alum_recreacion_tiempo`
--
ALTER TABLE `alum_recreacion_tiempo`
  ADD CONSTRAINT `fk_alum_recreacion_tiempo_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_alum_recreacion_tiempo_catalogo_lugares_acceso_principal1` FOREIGN KEY (`catalogo_lugares_acceso_principal_id`) REFERENCES `catalogo_lugares_acceso_principal` (`id`);

--
-- Filtros para la tabla `alum_servicios_salud`
--
ALTER TABLE `alum_servicios_salud`
  ADD CONSTRAINT `fk_alum_servicios_salud_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alum_trabajo`
--
ALTER TABLE `alum_trabajo`
  ADD CONSTRAINT `fk_alumnos_trabaja_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alum_transportes`
--
ALTER TABLE `alum_transportes`
  ADD CONSTRAINT `fk_alum_transportes_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_alum_transportes_catalogo_transportes1` FOREIGN KEY (`catalogo_transportes_id`) REFERENCES `catalogo_transportes` (`id`),
  ADD CONSTRAINT `fk_alum_transportes_tiempo_recorrido_transporte1` FOREIGN KEY (`tiempo_recorrido_transporte_id`) REFERENCES `tiempo_recorrido_transporte` (`id`);

--
-- Filtros para la tabla `alum_tratamientos`
--
ALTER TABLE `alum_tratamientos`
  ADD CONSTRAINT `fk_alum_tratamientos_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alum_uso_anteojos`
--
ALTER TABLE `alum_uso_anteojos`
  ADD CONSTRAINT `fk_alum_uso_anteojos_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alum_vivienda`
--
ALTER TABLE `alum_vivienda`
  ADD CONSTRAINT `fk_alum_vivienda_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
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
  ADD CONSTRAINT `fk_asignaciones_alumnos_grupos_asignaciones_grupos1` FOREIGN KEY (`asignaciones_grupos_id`) REFERENCES `asignaciones_grupos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asignaciones_grupos`
--
ALTER TABLE `asignaciones_grupos`
  ADD CONSTRAINT `fk_asignacioes_grupos_asignaciones_tutores1` FOREIGN KEY (`asignaciones_tutores_id`) REFERENCES `asignaciones_tutores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_asignacioes_grupos_grupos1` FOREIGN KEY (`grupos_id`) REFERENCES `grupos` (`id`),
  ADD CONSTRAINT `fk_asignaciones_grupos_ciclos_semestres1` FOREIGN KEY (`ciclos_semestres_id`) REFERENCES `ciclos_semestres` (`id`);

--
-- Filtros para la tabla `asignaciones_tutores`
--
ALTER TABLE `asignaciones_tutores`
  ADD CONSTRAINT `fk_asignaciones_tutores_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `fk_datos_generales_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `fk_dependen_alumno_alum_dependen_economica1` FOREIGN KEY (`alum_dependen_economica_id`) REFERENCES `alum_dependen_economica` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_dependen_alumno_catalogo_dependencias_economicas1` FOREIGN KEY (`catalogo_dependencias_economicas_id`) REFERENCES `catalogo_dependencias_economicas` (`id`);

--
-- Filtros para la tabla `deportes`
--
ALTER TABLE `deportes`
  ADD CONSTRAINT `fk_deportes_alum_deportes1` FOREIGN KEY (`alum_deportes_id`) REFERENCES `alum_deportes` (`id`) ON DELETE CASCADE,
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
  ADD CONSTRAINT `fk_alumnos_edades_hijos_alum_info_hijos1` FOREIGN KEY (`alum_info_hijos_id`) REFERENCES `alum_info_hijos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ejercicio_fisico`
--
ALTER TABLE `ejercicio_fisico`
  ADD CONSTRAINT `fk_ejercicio_fisico_alum_ejercicio1` FOREIGN KEY (`alum_ejercicio_id`) REFERENCES `alum_ejercicio` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ejercicio_fisico_catalogo_actividad_ejercicio1` FOREIGN KEY (`catalogo_actividad_ejercicio_id`) REFERENCES `catalogo_actividad_ejercicio` (`id`),
  ADD CONSTRAINT `fk_ejercicio_fisico_frecuencia_veces_semana1` FOREIGN KEY (`frecuencia_veces_semana_id`) REFERENCES `frecuencia_veces_semana` (`id`);

--
-- Filtros para la tabla `enfermedades_cronicas`
--
ALTER TABLE `enfermedades_cronicas`
  ADD CONSTRAINT `fk_enferm_cronica_alum_enfermedades_cronicas1` FOREIGN KEY (`alum_enfermedades_cronicas_id`) REFERENCES `alum_enfermedades_cronicas` (`id`) ON DELETE CASCADE,
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
  ADD CONSTRAINT `fk_organizaciones_alum_organizacion1` FOREIGN KEY (`alum_organizacion_id`) REFERENCES `alum_organizacion` (`id`) ON DELETE CASCADE,
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
  ADD CONSTRAINT `fk_problemas_salud_alum_estado_salud1` FOREIGN KEY (`alum_estado_salud_id`) REFERENCES `alum_estado_salud` (`id`) ON DELETE CASCADE,
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
  ADD CONSTRAINT `fk_servicios_salud_alum_servicios_salud1` FOREIGN KEY (`alum_servicios_salud_id`) REFERENCES `alum_servicios_salud` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_servicios_salud_catalogo_servicios_salud1` FOREIGN KEY (`catalogo_servicios_salud_id`) REFERENCES `catalogo_servicios_salud` (`id`);

--
-- Filtros para la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD CONSTRAINT `fk_tratamientos_alum_tratamientos1` FOREIGN KEY (`alum_tratamientos_id`) REFERENCES `alum_tratamientos` (`id`) ON DELETE CASCADE,
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
  ADD CONSTRAINT `fk_usos_internet_alum_recreacion_tiempo1` FOREIGN KEY (`alum_recreacion_tiempo_id`) REFERENCES `alum_recreacion_tiempo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_usos_internet_catalogo_usos_internet1` FOREIGN KEY (`catalogo_usos_internet_id`) REFERENCES `catalogo_usos_internet` (`id`);

--
-- Filtros para la tabla `uso_anteojos`
--
ALTER TABLE `uso_anteojos`
  ADD CONSTRAINT `fk_uso_anteojos_alum_uso_anteojos1` FOREIGN KEY (`alum_uso_anteojos_id`) REFERENCES `alum_uso_anteojos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_uso_anteojos_catalogo_uso_anteojos1` FOREIGN KEY (`catalogo_uso_anteojos_id`) REFERENCES `catalogo_uso_anteojos` (`id`);

--
-- Filtros para la tabla `varias_reacciones_alergicas`
--
ALTER TABLE `varias_reacciones_alergicas`
  ADD CONSTRAINT `fk_varias_reacciones_alergicas_alergias1` FOREIGN KEY (`alergias_id`) REFERENCES `alergias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_varias_reacciones_alergicas_catalogo_reacciones_alergicas1` FOREIGN KEY (`catalogo_reacciones_alergicas_id`) REFERENCES `catalogo_reacciones_alergicas` (`id`);

--
-- Filtros para la tabla `vivienda_bienes`
--
ALTER TABLE `vivienda_bienes`
  ADD CONSTRAINT `fk_vivienda_bienes_alum_vivienda1` FOREIGN KEY (`alum_vivienda_id`) REFERENCES `alum_vivienda` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_vivienda_bienes_catalogo_bienes_vivienda1` FOREIGN KEY (`catalogo_bienes_vivienda_id`) REFERENCES `catalogo_bienes_vivienda` (`id`);

--
-- Filtros para la tabla `vivienda_servicios`
--
ALTER TABLE `vivienda_servicios`
  ADD CONSTRAINT `fk_vivienda_servicios_alum_vivienda1` FOREIGN KEY (`alum_vivienda_id`) REFERENCES `alum_vivienda` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_vivienda_servicios_catalogo_servicios_vivienda1` FOREIGN KEY (`catalogo_servicios_vivienda_id`) REFERENCES `catalogo_servicios_vivienda` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
