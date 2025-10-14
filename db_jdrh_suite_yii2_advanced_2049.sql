-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-10-2025 a las 03:18:16
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.2.26

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
  `id` int NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `id` int NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_inscripciones`
--

DROP TABLE IF EXISTS `alum_inscripciones`;
CREATE TABLE IF NOT EXISTS `alum_inscripciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `tipos_inscripciones_id` int NOT NULL,
  `semestre_id` int NOT NULL,
  `ciclos_escolares_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inscripciones_alumnos_semestre1_idx` (`semestre_id`),
  KEY `fk_alumnos_inscripciones_alumnos1_idx` (`alumnos_id`),
  KEY `fk_alumnos_inscripciones_tipos_inscripciones1_idx` (`tipos_inscripciones_id`),
  KEY `fk_alumnos_inscripciones_ciclos_escolares1_idx` (`ciclos_escolares_id`)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_vienes_personales`
--

DROP TABLE IF EXISTS `alum_vienes_personales`;
CREATE TABLE IF NOT EXISTS `alum_vienes_personales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumnos_id` int NOT NULL,
  `catalogo_vienes_personales_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alum_vienes_personales_catalogo_vienes_personales1_idx` (`catalogo_vienes_personales_id`),
  KEY `fk_alum_vienes_personales_alumnos1_idx` (`alumnos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `semestres_id` int NOT NULL,
  `ciclos_escolares_id` int NOT NULL,
  `grupos_id` int NOT NULL,
  `asignaciones_tutores_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_asignacioes_grupos_grupos1_idx` (`grupos_id`),
  KEY `fk_asignacioes_grupos_asignaciones_tutores1_idx` (`asignaciones_tutores_id`),
  KEY `fk_asignacioes_grupos_ciclos_escolares1_idx` (`ciclos_escolares_id`),
  KEY `fk_asignaciones_grupos_semestres1_idx` (`semestres_id`)
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
-- Estructura de tabla para la tabla `catalogo_bienes_vivienda`
--

DROP TABLE IF EXISTS `catalogo_bienes_vivienda`;
CREATE TABLE IF NOT EXISTS `catalogo_bienes_vivienda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_transportes`
--

DROP TABLE IF EXISTS `catalogo_transportes`;
CREATE TABLE IF NOT EXISTS `catalogo_transportes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_tratamientos`
--

DROP TABLE IF EXISTS `catalogo_tratamientos`;
CREATE TABLE IF NOT EXISTS `catalogo_tratamientos` (
  `id` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `tipos_tratamientos_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_catalogo_tratamientos_tipos_tratamientos1_idx` (`tipos_tratamientos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `id` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_vienes_personales`
--

DROP TABLE IF EXISTS `catalogo_vienes_personales`;
CREATE TABLE IF NOT EXISTS `catalogo_vienes_personales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`id`)
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
  `maya_hablante` tinyint DEFAULT NULL,
  `estados_civiles_id` int NOT NULL,
  `nacionalidades_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_datos_generales_estados_civiles1_idx` (`estados_civiles_id`),
  KEY `fk_datos_generales_nacionalidades1_idx` (`nacionalidades_id`),
  KEY `fk_datos_generales_perfil1_idx` (`perfil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependientes`
--

DROP TABLE IF EXISTS `dependientes`;
CREATE TABLE IF NOT EXISTS `dependientes` (
  `id` int NOT NULL,
  `alum_dependen_economica_id` int NOT NULL,
  `catalogo_dependencias_economicas_id` int NOT NULL,
  `otro_especificar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dependen_alumno_alum_dependen_economica1_idx` (`alum_dependen_economica_id`),
  KEY `fk_dependen_alumno_catalogo_dependencias_economicas1_idx` (`catalogo_dependencias_economicas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `localidades_id` int NOT NULL,
  `calle` varchar(150) NOT NULL,
  `numero_exterior` varchar(15) NOT NULL,
  `numero_interior` varchar(15) DEFAULT NULL,
  `colonia` varchar(150) NOT NULL,
  `codigo_postal` varchar(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_domicilios_actuales_entidades_federativas1_idx` (`entidades_federativas_id`),
  KEY `fk_domicilios_actuales_municipios1_idx` (`municipios_id`),
  KEY `fk_domicilios_actuales_localidades1_idx` (`localidades_id`),
  KEY `fk_domicilios_actuales_perfil1_idx` (`perfil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `fecha_nacimiento` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alumnos_edades_hijos_alum_info_hijos1_idx` (`alum_info_hijos_id`)
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
  `catalogo_enferm_cronicas_id` int NOT NULL,
  `alum_enfermedades_cronicas_id` int NOT NULL,
  `otro_especificas` varchar(250) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Estructura de tabla para la tabla `estados_civiles`
--

DROP TABLE IF EXISTS `estados_civiles`;
CREATE TABLE IF NOT EXISTS `estados_civiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `id` smallint NOT NULL AUTO_INCREMENT,
  `genero_nombre` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id`, `genero_nombre`) VALUES
(1, 'masculino'),
(2, 'femenino');

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
-- Estructura de tabla para la tabla `licenciaturas`
--

DROP TABLE IF EXISTS `licenciaturas`;
CREATE TABLE IF NOT EXISTS `licenciaturas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `descripcion` varchar(800) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

DROP TABLE IF EXISTS `localidades`;
CREATE TABLE IF NOT EXISTS `localidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares_nacimiento`
--

DROP TABLE IF EXISTS `lugares_nacimiento`;
CREATE TABLE IF NOT EXISTS `lugares_nacimiento` (
  `id` int NOT NULL,
  `perfil_id` int NOT NULL,
  `entidades_federativas_id` int NOT NULL,
  `municipios_id` int NOT NULL,
  `localidades_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lugares_nacimiento_entidades_federativas1_idx` (`entidades_federativas_id`),
  KEY `fk_lugares_nacimiento_municipios1_idx` (`municipios_id`),
  KEY `fk_lugares_nacimiento_localidades1_idx` (`localidades_id`),
  KEY `fk_lugares_nacimiento_perfil1_idx` (`perfil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Estructura de tabla para la tabla `municipios`
--

DROP TABLE IF EXISTS `municipios`;
CREATE TABLE IF NOT EXISTS `municipios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalidades`
--

DROP TABLE IF EXISTS `nacionalidades`;
CREATE TABLE IF NOT EXISTS `nacionalidades` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `fecha_nacimiento` datetime NOT NULL,
  `genero_id` smallint NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `genero_id_2` (`genero_id`),
  KEY `fk_perfil_user1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol_nombre`, `rol_valor`) VALUES
(1, 'Usuario', 10),
(2, 'Admin', 20),
(7, 'SuperUsuario', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestres`
--

DROP TABLE IF EXISTS `semestres`;
CREATE TABLE IF NOT EXISTS `semestres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiempo_recorrido_transporte`
--

DROP TABLE IF EXISTS `tiempo_recorrido_transporte`;
CREATE TABLE IF NOT EXISTS `tiempo_recorrido_transporte` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rango_tiempo` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_organizacion`
--

DROP TABLE IF EXISTS `tipo_organizacion`;
CREATE TABLE IF NOT EXISTS `tipo_organizacion` (
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
  `id` int NOT NULL,
  `alum_tratamientos_id` int NOT NULL,
  `catalogo_tratamientos_id` int NOT NULL,
  `frecuencia_tiempo_id` int NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tratamientos_frecuencia_tiempo1_idx` (`frecuencia_tiempo_id`),
  KEY `fk_tratamientos_alum_tratamientos1_idx` (`alum_tratamientos_id`),
  KEY `fk_tratamientos_catalogo_tratamientos1_idx` (`catalogo_tratamientos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `rol_id` smallint NOT NULL DEFAULT '1',
  `estado_id` smallint NOT NULL DEFAULT '1',
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `rol_id`, `estado_id`, `tipo_usuario_id`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'root', 'pQeZefuxsI0kiGxn_OKI6IXdBznTmWF9', '$2y$13$M0AvNyw666uh452dv5sdJOLimBesSgRNjdFTGZFCXEEf0rsnEVohm', NULL, 'root@root.com', 7, 1, 2, '2025-08-30 14:25:57', '2025-08-30 14:25:57', 'WnDqUcudrydqtx7rhS8QrZ5P8m-a8mMn_1756585557');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  ADD CONSTRAINT `fk_alumnos_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`),
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
  ADD CONSTRAINT `fk_alumnos_inscripciones_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `fk_alumnos_inscripciones_ciclos_escolares1` FOREIGN KEY (`ciclos_escolares_id`) REFERENCES `ciclos_escolares` (`id`),
  ADD CONSTRAINT `fk_alumnos_inscripciones_tipos_inscripciones1` FOREIGN KEY (`tipos_inscripciones_id`) REFERENCES `tipos_inscripciones` (`id`),
  ADD CONSTRAINT `fk_inscripciones_alumnos_semestre1` FOREIGN KEY (`semestre_id`) REFERENCES `semestres` (`id`);

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
-- Filtros para la tabla `alum_vienes_personales`
--
ALTER TABLE `alum_vienes_personales`
  ADD CONSTRAINT `fk_alum_vienes_personales_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `fk_alum_vienes_personales_catalogo_vienes_personales1` FOREIGN KEY (`catalogo_vienes_personales_id`) REFERENCES `catalogo_vienes_personales` (`id`);

--
-- Filtros para la tabla `alum_vivienda`
--
ALTER TABLE `alum_vivienda`
  ADD CONSTRAINT `fk_alum_vivienda_alumnos1` FOREIGN KEY (`alumnos_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `fk_alum_vivienda_tipos_viviendas1` FOREIGN KEY (`tipos_viviendas_id`) REFERENCES `tipos_viviendas` (`id`);

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
  ADD CONSTRAINT `fk_asignacioes_grupos_ciclos_escolares1` FOREIGN KEY (`ciclos_escolares_id`) REFERENCES `ciclos_escolares` (`id`),
  ADD CONSTRAINT `fk_asignacioes_grupos_grupos1` FOREIGN KEY (`grupos_id`) REFERENCES `grupos` (`id`),
  ADD CONSTRAINT `fk_asignaciones_grupos_semestres1` FOREIGN KEY (`semestres_id`) REFERENCES `semestres` (`id`);

--
-- Filtros para la tabla `asignaciones_tutores`
--
ALTER TABLE `asignaciones_tutores`
  ADD CONSTRAINT `fk_asignaciones_tutores_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`);

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
  ADD CONSTRAINT `fk_datos_personales_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`);

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
  ADD CONSTRAINT `fk_domicilios_actuales_localidades1` FOREIGN KEY (`localidades_id`) REFERENCES `localidades` (`id`),
  ADD CONSTRAINT `fk_domicilios_actuales_municipios1` FOREIGN KEY (`municipios_id`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `fk_domicilios_actuales_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`);

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
-- Filtros para la tabla `lugares_nacimiento`
--
ALTER TABLE `lugares_nacimiento`
  ADD CONSTRAINT `fk_lugares_nacimiento_entidades_federativas1` FOREIGN KEY (`entidades_federativas_id`) REFERENCES `entidades_federativas` (`id`),
  ADD CONSTRAINT `fk_lugares_nacimiento_localidades1` FOREIGN KEY (`localidades_id`) REFERENCES `localidades` (`id`),
  ADD CONSTRAINT `fk_lugares_nacimiento_municipios1` FOREIGN KEY (`municipios_id`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `fk_lugares_nacimiento_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`);

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
  ADD CONSTRAINT `fk_perfil_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
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
