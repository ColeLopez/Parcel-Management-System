CREATE DATABASE  IF NOT EXISTS `parcel_sa1_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `parcel_sa1_db`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: parcel_sa1_db
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `admin_details`
--

DROP TABLE IF EXISTS `admin_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_details` (
  `login_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password_` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role_` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_details`
--

LOCK TABLES `admin_details` WRITE;
/*!40000 ALTER TABLE `admin_details` DISABLE KEYS */;
INSERT INTO `admin_details` VALUES (1,'Cole','Lopez','Myuser','SA1@123','admin');
/*!40000 ALTER TABLE `admin_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branch_details`
--

DROP TABLE IF EXISTS `branch_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `branch_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `street_building` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `province` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `zip_postal_code` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact_num` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch_details`
--

LOCK TABLES `branch_details` WRITE;
/*!40000 ALTER TABLE `branch_details` DISABLE KEYS */;
INSERT INTO `branch_details` VALUES (1,'Branch 1','Nigel','Gauteng','1490','South Africa','0123456789'),(2,'Branch 2','Kimberly','Northern Cape','1569','South Africa','9876543210'),(3,'Branch 78','City 29','Province 60','9876','South Africa','9876543210');
/*!40000 ALTER TABLE `branch_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branch_staff_details`
--

DROP TABLE IF EXISTS `branch_staff_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `branch_staff_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `first_name` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `branch` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password_` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `branch_staff_details_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch_details` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch_staff_details`
--

LOCK TABLES `branch_staff_details` WRITE;
/*!40000 ALTER TABLE `branch_staff_details` DISABLE KEYS */;
INSERT INTO `branch_staff_details` VALUES (1,1,'Cole','Lopez','test@test.com','1 | Branch 1, Nigel, Gauteng, 1490, South Africa','1234'),(2,3,'Coles','Lopes','cole@cole.com','3 | Branch 78, City 29, Province 60, 9876, South Africa','1234');
/*!40000 ALTER TABLE `branch_staff_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parcel_details`
--

DROP TABLE IF EXISTS `parcel_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parcel_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reference_number` int DEFAULT NULL,
  `sender_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sender_address` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sender_contact` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `recipient_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `recipient_address` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `recipient_contact` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `from_branch_id` int NOT NULL,
  `to_branch_id` int NOT NULL,
  `type_` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `weight_` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `height` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `length_` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `width` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `from_branch_id` (`from_branch_id`),
  KEY `to_branch_id` (`to_branch_id`),
  CONSTRAINT `parcel_details_ibfk_1` FOREIGN KEY (`from_branch_id`) REFERENCES `branch_details` (`id`),
  CONSTRAINT `parcel_details_ibfk_2` FOREIGN KEY (`to_branch_id`) REFERENCES `branch_details` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parcel_details`
--

LOCK TABLES `parcel_details` WRITE;
/*!40000 ALTER TABLE `parcel_details` DISABLE KEYS */;
INSERT INTO `parcel_details` VALUES (1,619821537,'Sender 1','Test Address','0123456789','Recipient 1','Test Address 2','9876543210',1,2,'Document','1kg','10mm','297mm','210mm','12','R120','Collected'),(3,275574825,'Sender 3','Address 3','0115598746','Recipient 3','Address 3','0115478963',1,2,'Container','1ton','3m','6m','3m','1','R100 000','In Transit'),(4,509054703,'Sender 5','Sender Address 4','0112347894','Recipient 5','Recipient Address 4','1202348789',1,3,'Box','10kg','12in','12in','12in','5','R250','Delivered'),(5,382827978,'Test Sender 123','Test Sender Address','5555555555','Test Reciever 456','Test Recipient Address','2222222222',1,2,'Container','1ton','3m','6m','3m','1','R100 000','Ready for Pickup');
/*!40000 ALTER TABLE `parcel_details` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-20  4:40:01
