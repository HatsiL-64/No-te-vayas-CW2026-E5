/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: no_te_vayas
-- ------------------------------------------------------
-- Server version	11.8.6-MariaDB-0+deb13u1 from Debian

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_grupo1` varchar(7) NOT NULL,
  `id_grupo2` varchar(7) DEFAULT NULL,
  `desercion` tinyint(1) NOT NULL,
  `prom_he` tinyint(4) DEFAULT NULL,
  `prom_t` tinyint(4) DEFAULT NULL,
  `prom_aa` tinyint(4) DEFAULT NULL,
  `prom_ec` tinyint(4) DEFAULT NULL,
  `prom_mye` tinyint(4) DEFAULT NULL,
  `perfil` tinyint(4) DEFAULT NULL,
  `riesgo_desercion` float DEFAULT NULL,
  PRIMARY KEY (`id_alumno`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_grupo1` (`id_grupo1`),
  KEY `id_grupo2` (`id_grupo2`),
  CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`id_grupo1`) REFERENCES `grupos` (`id_grupo`),
  CONSTRAINT `alumnos_ibfk_3` FOREIGN KEY (`id_grupo2`) REFERENCES `grupos` (`id_grupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` VALUES
(33333331,133333331,'55611',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(33333332,133333332,'55611',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(33333333,133333333,'662B',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(33333334,133333334,'661D',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(33333335,133333335,'661D',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(121003379,1121003379,'662B',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(324082625,1324082625,'662B',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(325089878,1325089878,'661D',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(325123703,1325123703,'661D',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cuestionario`
--

DROP TABLE IF EXISTS `cuestionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cuestionario` (
  `id_cuestionario` int(11) NOT NULL AUTO_INCREMENT,
  `id_alumno` int(11) NOT NULL,
  `id_grupo` varchar(5) NOT NULL,
  `ea` varchar(1) NOT NULL,
  `he_1` tinyint(4) NOT NULL,
  `he_2` tinyint(4) NOT NULL,
  `he_3` tinyint(4) NOT NULL,
  `he_4` tinyint(4) NOT NULL,
  `he_5` tinyint(4) NOT NULL,
  `he_6` tinyint(4) NOT NULL,
  `he_7` tinyint(4) NOT NULL,
  `he_8` tinyint(4) NOT NULL,
  `he_9` tinyint(4) NOT NULL,
  `he_10` tinyint(4) NOT NULL,
  `he_11` tinyint(4) NOT NULL,
  `t_1` tinyint(4) NOT NULL,
  `t_2` tinyint(4) NOT NULL,
  `t_3` tinyint(4) NOT NULL,
  `t_4` tinyint(4) NOT NULL,
  `t_5` tinyint(4) NOT NULL,
  `t_6` tinyint(4) NOT NULL,
  `aa_1` tinyint(4) NOT NULL,
  `aa_2` tinyint(4) NOT NULL,
  `ec_1` tinyint(4) NOT NULL,
  `ec_2` tinyint(4) NOT NULL,
  `mye_1` tinyint(4) NOT NULL,
  `mye_2` tinyint(4) NOT NULL,
  `mye_3` tinyint(4) NOT NULL,
  `mye_4` tinyint(4) NOT NULL,
  `comentario` tinytext DEFAULT NULL,
  PRIMARY KEY (`id_cuestionario`),
  UNIQUE KEY `id_alumno` (`id_alumno`),
  CONSTRAINT `cuestionario_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuestionario`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cuestionario` WRITE;
/*!40000 ALTER TABLE `cuestionario` DISABLE KEYS */;
/*!40000 ALTER TABLE `cuestionario` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `ete`
--

DROP TABLE IF EXISTS `ete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ete` (
  `id_ete` varchar(10) NOT NULL,
  `nombre` char(45) DEFAULT NULL,
  PRIMARY KEY (`id_ete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ete`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `ete` WRITE;
/*!40000 ALTER TABLE `ete` DISABLE KEYS */;
INSERT INTO `ete` VALUES
('AV1','Agencia de Viajes y Hotelería 5to'),
('AV2','Agencia de Viajes y Hotelería 6to'),
('BN','Auxiliar Bancario'),
('CM1','Computación 5to'),
('CM2','Computación 6to'),
('CN','Auxiliar en Contabilidad'),
('DA','Auxiliar en Dibujo Arquitectónico'),
('EN','Enseñanza de Inglés'),
('FO','Auxiliar Fotógrafo, Laboratorista y Prensa'),
('HI','Histopatología'),
('LQ','Auxiliar Laboratorista Químico'),
('MR','Auxiliar Museógrafo Restaurador'),
('NT','Auxiliar Nutriólogo'),
('SEN','Superior en Enseñanza de Inglés');
/*!40000 ALTER TABLE `ete` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupos` (
  `id_grupo` varchar(7) NOT NULL,
  `nombre` varchar(5) NOT NULL,
  `id_ete` varchar(10) NOT NULL,
  `plantel` int(11) NOT NULL,
  PRIMARY KEY (`id_grupo`),
  KEY `id_ete` (`id_ete`),
  CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`id_ete`) REFERENCES `ete` (`id_ete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `grupos` WRITE;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` VALUES
('55611','5611','NT',5),
('661D','61D','CM1',6),
('662B','62B','CM2',6);
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `modulos` (
  `id_modulo` varchar(10) NOT NULL,
  `id_ete` varchar(10) NOT NULL,
  `numero` tinyint(4) NOT NULL,
  `nombre` char(80) DEFAULT NULL,
  PRIMARY KEY (`id_modulo`),
  KEY `id_ete` (`id_ete`),
  CONSTRAINT `modulos_ibfk_1` FOREIGN KEY (`id_ete`) REFERENCES `ete` (`id_ete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` VALUES
('AV01','AV1',1,'Sistema turístico'),
('AV02','AV1',2,'Hospedaje y transporte'),
('AV03','AV1',3,'Patrimonio turístico'),
('AV04','AV1',4,'Inglés técnico para el turismo I'),
('AV05','AV1',5,'TIC aplicadas al turismo'),
('AV06','AV2',6,'Fundamentos y técnicas en alimentos y bebidas'),
('AV07','AV2',7,'Introducción a la administración'),
('AV08','AV2',8,'Destinos turísticos'),
('AV09','AV2',9,'Marketing turístico'),
('AV10','AV2',10,'Proyectos de investigación turística'),
('AV11','AV2',11,'Inglés técnico para el turismo II'),
('BN01','BN',1,'Sistema económico financiero mexicano'),
('BN02','BN',2,'Comportamiento organizacional y humano'),
('BN03','BN',3,'Introducción a las matemáticas financieras y finanzas'),
('BN04','BN',4,'Procesamiento eléctrico'),
('BN05','BN',5,'Operaciones mercantiles y bancarias'),
('BN06','BN',6,'Contabilidad comercial y financiera'),
('CM01','CM1',1,'Introducción a la Computación'),
('CM02','CM1',2,'Sistemas Operativos'),
('CM03','CM1',3,'Aplicaciones de uso general'),
('CM04','CM1',4,'Solución de problemas y técnicas de programación'),
('CM05','CM1',5,'Programación estructurada'),
('CM06','CM2',6,'Programación orientada a eventos'),
('CM07','CM2',7,'Análisis y diseño de sistemas'),
('CM08','CM2',8,'Programación orientada a bases de datos'),
('CM09','CM2',9,'Redes de área local'),
('CM10','CM2',10,'Mantenimiento preventivo y correctivo menor para computadoras personales'),
('CN01','CN',1,'Contabilidad financiera'),
('CN02','CN',2,'Administración de las organizaciones'),
('CN03','CN',3,'Fundamentos mercantiles y fiscales de las organizaciones'),
('CN04','CN',4,'Habilidades básicas de emprendedores'),
('CN05','CN',5,'Procesamiento electrónico de información financiera'),
('DA01','DA',1,'Introducción al dibujo arquitectónico'),
('DA02','DA',2,'Planos arquitectónicos'),
('DA03','DA',3,'Perspectiva maquetas'),
('DA04','DA',4,'Planos de instalaciones'),
('DA05','DA',5,'Planos estructurales y de acabado'),
('DA06','DA',6,'Introducción al dibujo asistido por computadora'),
('EN01','EN',1,'Descripción de los sistemas y las habilidades del idioma de inglés'),
('EN02','EN',2,'El aprendizaje de una lengua'),
('EN03','EN',3,'Gestión del aula'),
('EN04','EN',4,'La práctica de la enseñanza de inglés'),
('EN05','EN',5,'Perfeccionamiento del manejo del inglés'),
('FO01','FO',1,'Fundamentos de la fotografía'),
('FO02','FO',2,'Laboratorio fotográfico'),
('FO03','FO',3,'Técnicas de iluminación y fotografía de acercamiento'),
('FO04','FO',4,'Post tratamiento de la imagen fotográfica'),
('FO05','FO',5,'Foto-acabado'),
('HI01','HI',1,'Sistemas de Autorregulación'),
('HI02','HI',2,'Sistemas de Absorción y Excreción'),
('HI03','HI',3,'Sistemas de Regulación Hormonal y Reproducción'),
('HI04','HI',4,'Sistemas de Intercambio'),
('HI05','HI',5,'Sistemas de Coordinación'),
('HI06','HI',6,'Sistemas Individuo-Ambiente'),
('LQ01','LQ',1,'Introducción al trabajo de laboratorio'),
('LQ02','LQ',2,'Métodos de separación y purificación de sustancias'),
('LQ03','LQ',3,'Introducción al análisis químico'),
('LQ04','LQ',4,'Introducción al análisis clínico'),
('LQ05','LQ',5,'Principios de calidad'),
('LQ06','LQ',6,'Introducción a la microbiología'),
('MR01','MR',1,'Gestión del Patrimonio Cultural'),
('MR02','MR',2,'Conservación de Textil, Cerámica y Papel'),
('MR03','MR',3,'Museología y Museografía'),
('MR04','MR',4,'Contexto Histórico del Textil, Cerámica y Papel en Mesoamérica y Nueva España'),
('NT01','NT',1,'Características generales de la célula'),
('NT02','NT',2,'Estadística básica'),
('NT03','NT',3,'Principios de anatomía y fisiología de la nutrición'),
('NT04','NT',4,'Química de los alimentos'),
('NT05','NT',5,'Nutriología'),
('NT06','NT',6,'Higiene y conservación de alimentos'),
('SEN01','SEN',1,'Introducción a la enseñanza del inglés'),
('SEN02','SEN',2,'Estudio del lenguaje'),
('SEN03','SEN',3,'Manejo del salón de clase'),
('SEN04','SEN',4,'Práctica docente'),
('SEN05','SEN',5,'Desarrollo y superación continua del docente');
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `profesores`
--

DROP TABLE IF EXISTS `profesores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `profesores` (
  `id_profesor` int(11) NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_profesor`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `profesores_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesores`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `profesores` WRITE;
/*!40000 ALTER TABLE `profesores` DISABLE KEYS */;
/*!40000 ALTER TABLE `profesores` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(10) unsigned NOT NULL,
  `nombre` char(20) NOT NULL,
  `apellido_p` varchar(15) NOT NULL,
  `apellido_m` varchar(15) DEFAULT NULL,
  `correo` varchar(35) NOT NULL,
  `password` varchar(65) NOT NULL,
  `tipo_usuario` varchar(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES
(2222221,'Profesor2','Apellido1','Apellido2','correo','a3a2ffe06503fffccb740ada5229619ed9f4607002d86f3eab959181b18caab8','2'),
(2222222,'Profesor1','Apellido1','Apellido2','correo','a3a2ffe06503fffccb740ada5229619ed9f4607002d86f3eab959181b18caab8','2'),
(2222223,'Profesor3','Apellido1','Apellido2','correo','a3a2ffe06503fffccb740ada5229619ed9f4607002d86f3eab959181b18caab8','2'),
(133333331,'Alumno1','Sánchez','Sánchez','correo','36fcac4a1fc684ad709eb8223149c934da6450e6cc90a88af2c8e5f9b8ef2fae','1'),
(133333332,'Alumno 2','García','García','correo','36fcac4a1fc684ad709eb8223149c934da6450e6cc90a88af2c8e5f9b8ef2fae','1'),
(133333333,'Alumnoo3','Martínez','Martínez','correo','36fcac4a1fc684ad709eb8223149c934da6450e6cc90a88af2c8e5f9b8ef2fae','1'),
(133333334,'Alumno4','Hernandez','Hernandez','correo','36fcac4a1fc684ad709eb8223149c934da6450e6cc90a88af2c8e5f9b8ef2fae','1'),
(133333335,'Alumno5','Magallón','Magallón','correo','36fcac4a1fc684ad709eb8223149c934da6450e6cc90a88af2c8e5f9b8ef2fae','1'),
(311111111,'Administrador','Apellido1','Apellido2','correo','19024b91ccc715eb7ef49065e97c4b8efb8589552681c55d421c6f63f156ceda','3'),
(1121003379,'Montserrat','García','Nuñez','121003379@alumno.enp.unam.mx','283e831e399b03c77c6425ddf701ce4374789e37f2e71c0ee90de9031ed73b8d','1'),
(1324082625,'Hatsi Iain','López','Rosas','324082625@alumno.enp.unam.mx','c871a8cc93993211b96d6b276ae16a761607eed0c3cd1692ccfb397fe15f905b','1'),
(1325089878,'María Inés','Solís','Orantes','325089878@alumno.enp.unam.mx','e6e282c89702bd3e2a4facf5e576562f17d44498f628a1ea222eb6f1fa031810','1'),
(1325123703,'Beni Axel','Castillo','Marquez','325123703@alumno.enp.unam.mx','54afcc13082af00c877fdd0a447012f8f6d772ecd7e2429aef9a32a30d6e5eab','1'),
(3121003379,'Montserrat','García','Nuñez','121003379@alumno.enp.unam.mx','283e831e399b03c77c6425ddf701ce4374789e37f2e71c0ee90de9031ed73b8d','3'),
(3324082625,'Hatsi Iain','López','Rosas','324082625@alumno.enp.unam.mx','c871a8cc93993211b96d6b276ae16a761607eed0c3cd1692ccfb397fe15f905b','3'),
(3325089878,'María Inés','Solís','Orantes','325089878@alumno.enp.unam.mx','e6e282c89702bd3e2a4facf5e576562f17d44498f628a1ea222eb6f1fa031810','3'),
(3325123703,'Beni Axel','Castillo','Marquez','325123703@alumno.enp.unam.mx','54afcc13082af00c877fdd0a447012f8f6d772ecd7e2429aef9a32a30d6e5eab','3');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-06-12 15:46:25
