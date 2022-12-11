-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: subjig_report
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `hanger_types`
--

DROP TABLE IF EXISTS `hanger_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hanger_types` (
                                `id` varchar(55) NOT NULL,
                                `qty` int NOT NULL,
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hanger_types`
--

LOCK TABLES `hanger_types` WRITE;
/*!40000 ALTER TABLE `hanger_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `hanger_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hangers`
--

DROP TABLE IF EXISTS `hangers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hangers` (
                           `id` varchar(55) NOT NULL,
                           `hanger_type_id` varchar(55) NOT NULL,
                           `order_number` int NOT NULL,
                           `name` varchar(55) NOT NULL,
                           `qty` int NOT NULL,
                           PRIMARY KEY (`id`),
                           KEY `subjigs_types_null_fk` (`hanger_type_id`),
                           CONSTRAINT `subjigs_types_null_fk` FOREIGN KEY (`hanger_type_id`) REFERENCES `hanger_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hangers`
--

LOCK TABLES `hangers` WRITE;
/*!40000 ALTER TABLE `hangers` DISABLE KEYS */;
/*!40000 ALTER TABLE `hangers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periods`
--

DROP TABLE IF EXISTS `periods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periods` (
                           `id` varchar(11) NOT NULL,
                           `created_at` timestamp NOT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periods`
--

LOCK TABLES `periods` WRITE;
/*!40000 ALTER TABLE `periods` DISABLE KEYS */;
INSERT INTO `periods` VALUES ('2022','2022-12-01 13:39:32');
/*!40000 ALTER TABLE `periods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_m_categories`
--

DROP TABLE IF EXISTS `schedule_m_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedule_m_categories` (
                                         `id` varchar(3) NOT NULL,
                                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_m_categories`
--

LOCK TABLES `schedule_m_categories` WRITE;
/*!40000 ALTER TABLE `schedule_m_categories` DISABLE KEYS */;
INSERT INTO `schedule_m_categories` VALUES ('M1'),('M2'),('M3'),('M4'),('M5');
/*!40000 ALTER TABLE `schedule_m_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_weeks`
--

DROP TABLE IF EXISTS `schedule_weeks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedule_weeks` (
                                  `id` varchar(55) NOT NULL,
                                  `supply_schedules_id` varchar(55) NOT NULL,
                                  `is_done` tinyint NOT NULL,
                                  `date` date NOT NULL,
                                  `m_id` varchar(3) NOT NULL,
                                  PRIMARY KEY (`id`),
                                  KEY `schedules_schedules_subjig_null_fk` (`supply_schedules_id`),
                                  KEY `schedule_weeks_schedule_m_categories_null_fk` (`m_id`),
                                  CONSTRAINT `schedule_weeks_schedule_m_categories_null_fk` FOREIGN KEY (`m_id`) REFERENCES `schedule_m_categories` (`id`),
                                  CONSTRAINT `schedules_schedules_subjig_null_fk` FOREIGN KEY (`supply_schedules_id`) REFERENCES `supply_schedules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_weeks`
--

LOCK TABLES `schedule_weeks` WRITE;
/*!40000 ALTER TABLE `schedule_weeks` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule_weeks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
                            `id` varchar(55) NOT NULL,
                            `username` varchar(120) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `fk_sessions_user` (`username`),
                            CONSTRAINT `fk_sessions_user` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('6395e5f269d8b','marlioffice');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplies`
--

DROP TABLE IF EXISTS `supplies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supplies` (
                            `id` varchar(55) NOT NULL,
                            `target_set` int NOT NULL,
                            `hanger_type_id` varchar(55) DEFAULT NULL,
                            `schedule_week_id` varchar(55) NOT NULL,
                            PRIMARY KEY (`id`),
                            UNIQUE KEY `supplies_pk` (`schedule_week_id`),
                            KEY `supplies_types_null_fk` (`hanger_type_id`),
                            CONSTRAINT `supplies_schedule_weeks_null_fk` FOREIGN KEY (`schedule_week_id`) REFERENCES `schedule_weeks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                            CONSTRAINT `supplies_types_null_fk` FOREIGN KEY (`hanger_type_id`) REFERENCES `hanger_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplies`
--

LOCK TABLES `supplies` WRITE;
/*!40000 ALTER TABLE `supplies` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supply_lines`
--

DROP TABLE IF EXISTS `supply_lines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supply_lines` (
                                `id` int NOT NULL AUTO_INCREMENT,
                                `supply_id` varchar(55) NOT NULL,
                                `hanger_id` varchar(55) DEFAULT NULL,
                                `line_a` int DEFAULT NULL,
                                `line_b` int DEFAULT NULL,
                                `line_c` int DEFAULT NULL,
                                `total` int DEFAULT NULL,
                                PRIMARY KEY (`id`),
                                KEY `supply_lines_subjigs_null_fk` (`hanger_id`),
                                KEY `supply_lines_supplies_null_fk` (`supply_id`),
                                CONSTRAINT `supply_lines_subjigs_null_fk` FOREIGN KEY (`hanger_id`) REFERENCES `hangers` (`id`) ON UPDATE CASCADE,
                                CONSTRAINT `supply_lines_supplies_null_fk` FOREIGN KEY (`supply_id`) REFERENCES `supplies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=94272 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supply_lines`
--

LOCK TABLES `supply_lines` WRITE;
/*!40000 ALTER TABLE `supply_lines` DISABLE KEYS */;
/*!40000 ALTER TABLE `supply_lines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supply_schedules`
--

DROP TABLE IF EXISTS `supply_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supply_schedules` (
                                    `id` varchar(55) NOT NULL,
                                    `hanger_type_id` varchar(55) NOT NULL,
                                    `period_id` varchar(11) NOT NULL,
                                    `month` int NOT NULL,
                                    `is_done` tinyint NOT NULL,
                                    PRIMARY KEY (`id`),
                                    KEY `supply_schedules_hanger_types_null_fk` (`hanger_type_id`),
                                    KEY `supply_schedules_periods_null_fk` (`period_id`),
                                    CONSTRAINT `supply_schedules_hanger_types_null_fk` FOREIGN KEY (`hanger_type_id`) REFERENCES `hanger_types` (`id`) ON UPDATE CASCADE,
                                    CONSTRAINT `supply_schedules_periods_null_fk` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supply_schedules`
--

LOCK TABLES `supply_schedules` WRITE;
/*!40000 ALTER TABLE `supply_schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `supply_schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
                              `id` int NOT NULL,
                              `role_name` varchar(55) NOT NULL,
                              PRIMARY KEY (`id`),
                              UNIQUE KEY `karyawan_bagians_pk` (`role_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,'Admin'),(3,'Karyawan'),(2,'Leader');
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
                         `username` varchar(55) NOT NULL,
                         `password` varchar(255) NOT NULL,
                         `full_name` varchar(125) NOT NULL,
                         `role_id` int NOT NULL,
                         `last_login` timestamp NULL DEFAULT NULL,
                         PRIMARY KEY (`username`),
                         KEY `users_user_roles_null_fk` (`role_id`),
                         CONSTRAINT `users_user_roles_null_fk` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('marlioffice','$2y$10$EtwiVHXaz/B/U8XpSUvxaebDj6IthKGPINCFFGgssNsRpDxSkfEMO','Marli',1,'2022-12-11 14:15:14');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-11 21:24:44
