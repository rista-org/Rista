-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: Rista
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.24.04.2

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
-- Table structure for table `connected`
--

DROP TABLE IF EXISTS `connected`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `connected` (
  `ConnectionID` int NOT NULL AUTO_INCREMENT,
  `Contact` bigint NOT NULL,
  `Requested` text COLLATE utf8mb4_general_ci,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `RequestedTo` bigint DEFAULT NULL,
  PRIMARY KEY (`ConnectionID`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `connected`
--

LOCK TABLES `connected` WRITE;
/*!40000 ALTER TABLE `connected` DISABLE KEYS */;
INSERT INTO `connected` VALUES (53,9824682126,'You are connected with each other.','Connected',9807804645),(54,9807804645,'You are connected with each other.','Connected',9824682126),(55,9824682126,'You are connected with each other.','Connected',9844070204),(59,9844070204,'You sent the connection request to Sanskar Karki','pending',9807804645),(60,9844070204,'You sent the connection request to Darshan B.K','pending',9824682126),(61,9807804645,'You are connected with each other.','Connected',9844070204),(62,9844070204,'You are connected with each other.','Connected',9807804645);
/*!40000 ALTER TABLE `connected` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification` (
  `NotificationID` int NOT NULL AUTO_INCREMENT,
  `NotificationText` text COLLATE utf8mb4_general_ci NOT NULL,
  `Contact` bigint NOT NULL,
  `Sender` bigint DEFAULT NULL,
  PRIMARY KEY (`NotificationID`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (14,'Sudip Uraw sent you a connection request.',9847462263,9826378780),(15,'Sudip Uraw sent you a connection request.',9865909922,9826378780),(18,'Sanskar Karki sent you a connection request.',9847462263,9807804645),(31,'Sanskar Karki sent you a connection request.',9826378780,9807804645),(35,'Sanskar Karki sent you a connection request.',9826378780,9807804645),(37,'Sanskar Karki sent you a connection request.',9826378780,9807804645),(42,'Sanskar Karki sent you a connection request.',9826378780,9807804645),(46,'Roj Eet sent you a connection request.',9826378780,9844070204),(47,'Roj Eet sent you a connection request.',9847462263,9844070204),(48,'Roj Eet sent you a connection request.',9865909922,9844070204),(52,'Roj Eet sent you a connection request.',9824682126,9844070204);
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile` (
  `Name` varchar(255) NOT NULL,
  `Size` int NOT NULL,
  `Contact` bigint NOT NULL,
  `path_to` varchar(255) DEFAULT NULL,
  KEY `Contact` (`Contact`),
  CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`Contact`) REFERENCES `users` (`Contact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES ('face.png',1018,9807804645,'./Profile/face.png'),('rojit.jpg',70999,9844070204,'./Profile/rojit.jpg');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `Name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Contact` bigint NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Age` int NOT NULL,
  `Qualification` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'admin',
  PRIMARY KEY (`Contact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('Sanskar Karki',9807804645,'Sindhuli',19,'+2','admin'),('Darshan B.K',9824682126,'Kalanki',18,'+2','admin'),('Sudip Uraw',9826378780,'Biratnagar',18,'+2 science','admin'),('Roj Eet',9844070204,'Kathmandu',17,'+2 science','admin'),('Guddu Shrestha',9847462263,'Kathmandu',19,'+2','admin'),('Dimond Kiran Bhatta',9865909922,'Baitadi',19,'+2 science','admin');
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

-- Dump completed on 2024-09-03 21:58:37
