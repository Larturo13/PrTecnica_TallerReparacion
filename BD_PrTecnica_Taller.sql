CREATE DATABASE  IF NOT EXISTS `taller_reparacion` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `taller_reparacion`;
-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: taller_reparacion
-- ------------------------------------------------------
-- Server version	8.0.43

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (3,'Carlos','Ramírez','Zona 1, Ciudad de Guatemala','5555-1111','carlos.ramirez@mail.com',1,'2025-09-29 14:26:15',NULL),(4,'María','López','Mixco, Guatemala','5555-2222','maria.lopez@mail.com',1,'2025-09-29 14:26:15',NULL),(5,'José','Martínez','Villa Nueva, Guatemala','5555-3333','jose.martinez@mail.com',1,'2025-09-29 14:26:15',NULL),(6,'Ana','Gómez','Antigua Guatemala','5555-4444','ana.gomez@mail.com',1,'2025-09-29 14:26:15',NULL),(7,'Luis','Hernández','Amatitlán','5555-5555','luis.hernandez@mail.com',1,'2025-09-29 14:26:15',NULL);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipos`
--

DROP TABLE IF EXISTS `equipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `marca_id` int NOT NULL,
  `cliente_id` int NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `numero_serie` varchar(50) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero_serie` (`numero_serie`),
  KEY `cliente_id` (`cliente_id`),
  KEY `marca_id` (`marca_id`),
  CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `equipos_ibfk_2` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipos`
--

LOCK TABLES `equipos` WRITE;
/*!40000 ALTER TABLE `equipos` DISABLE KEYS */;
INSERT INTO `equipos` VALUES (12,3,3,'1','Inspiron 15','D12345',1,'2025-09-29 14:27:53',NULL),(13,4,4,'1','Pavilion 14','HP67890',1,'2025-09-29 14:27:53',NULL),(14,5,5,'1','ThinkCentre M720','L11223',1,'2025-09-29 14:27:53',NULL),(15,6,6,'1','MacBook Air','A44556',1,'2025-09-29 14:27:53',NULL),(16,7,7,'1','VivoBook 15','AS99887',1,'2025-09-29 14:27:53',NULL);
/*!40000 ALTER TABLE `equipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marcas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_marca` varchar(50) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (3,'Dell',1,'2025-09-29 14:26:49',NULL),(4,'HP',1,'2025-09-29 14:26:49',NULL),(5,'Lenovo',1,'2025-09-29 14:26:49',NULL),(6,'Apple',1,'2025-09-29 14:26:49',NULL),(7,'Asus',1,'2025-09-29 14:26:49',NULL);
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `equipo_id` int NOT NULL,
  `cliente_id` int NOT NULL,
  `tecnico_id` int NOT NULL,
  `fecha_recepcion` datetime NOT NULL,
  `problema_reportado` varchar(250) NOT NULL,
  `estado_servicio` int NOT NULL,
  `diagnostico` varchar(250) DEFAULT NULL,
  `solucion` varchar(250) DEFAULT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `equipo_id` (`equipo_id`),
  KEY `tecnico_id` (`tecnico_id`),
  CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `servicios_ibfk_2` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`),
  CONSTRAINT `servicios_ibfk_3` FOREIGN KEY (`tecnico_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (10,12,3,8,'2025-09-20 10:00:00','No enciende la laptop',1,'Fuente de poder dañada','Cambio de cargador','2025-09-22 15:00:00',1,'2025-09-29 14:29:07',NULL),(11,13,4,9,'2025-09-21 11:00:00','Pantalla con líneas',2,'Pantalla dañada','Reemplazo de pantalla','2025-09-23 16:00:00',1,'2025-09-29 14:29:07',NULL),(12,14,5,10,'2025-09-22 09:30:00','Ruidos en ventilador',2,'Ventilador desgastado','Cambio de ventilador','2025-09-25 14:00:00',1,'2025-09-29 14:29:07',NULL),(13,15,6,11,'2025-09-23 13:15:00','Batería no carga',3,'Batería agotada','Reemplazo de batería','2025-09-26 17:00:00',1,'2025-09-29 14:29:07',NULL),(14,16,7,12,'2025-09-24 08:45:00','Se apaga repentinamente',1,'Sobrecalentamiento','Cambio de pasta térmica','2025-09-28 12:00:00',1,'2025-09-29 14:29:07',NULL);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (8,'Pedro Sánchez','psanchez','123456','pedro@mail.com','4444-1111',1,'2025-09-29 14:26:56',NULL),(9,'Laura Morales','lmorales','123456','laura@mail.com','4444-2222',1,'2025-09-29 14:26:56',NULL),(10,'Jorge Castillo','jcastillo','123456','jorge@mail.com','4444-3333',1,'2025-09-29 14:26:56',NULL),(11,'Sofía Pérez','sperez','123456','sofia@mail.com','4444-4444',1,'2025-09-29 14:26:56',NULL),(12,'Miguel Torres','mtorres','123456','miguel@mail.com','4444-5555',1,'2025-09-29 14:26:56',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-29  8:29:50
