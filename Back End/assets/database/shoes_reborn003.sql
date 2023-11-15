-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: shoes_reborn002
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(120) NOT NULL,
  `client_address` text NOT NULL,
  `client_telephone_num` varchar(15) NOT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `client_telephone_num` (`client_telephone_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(120) NOT NULL,
  `employee_username` varchar(120) NOT NULL,
  `employee_password` varchar(50) NOT NULL,
  `employee_date_of_join` date NOT NULL,
  PRIMARY KEY (`employee_id`),
  UNIQUE KEY `employee_username` (`employee_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense`
--

DROP TABLE IF EXISTS `expense`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense` (
  `expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id_purchase` int(11) NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense`
--

LOCK TABLES `expense` WRITE;
/*!40000 ALTER TABLE `expense` DISABLE KEYS */;
/*!40000 ALTER TABLE `expense` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `history_status` varchar(150) NOT NULL,
  `history_id_production` int(11) NOT NULL,
  PRIMARY KEY (`history_id`),
  KEY `fk_history_id_production` (`history_id_production`),
  CONSTRAINT `fk_history_id_production` FOREIGN KEY (`history_id_production`) REFERENCES `production_detail` (`production_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `owner`
--

DROP TABLE IF EXISTS `owner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_name` varchar(120) NOT NULL,
  `owner_username` varchar(120) NOT NULL,
  `owner_password` varchar(50) NOT NULL,
  `owner_id_expense` int(11) NOT NULL,
  `owner_id_report` int(11) NOT NULL,
  `owner_id_profit` int(11) NOT NULL,
  PRIMARY KEY (`owner_id`),
  UNIQUE KEY `owner_username` (`owner_username`),
  KEY `fk_owner_id_expense` (`owner_id_expense`),
  KEY `fk_owner_id_report` (`owner_id_report`),
  KEY `fk_owner_id_profit` (`owner_id_profit`),
  CONSTRAINT `fk_owner_id_expense` FOREIGN KEY (`owner_id_expense`) REFERENCES `expense` (`expense_id`),
  CONSTRAINT `fk_owner_id_profit` FOREIGN KEY (`owner_id_profit`) REFERENCES `profit` (`profit_id`),
  CONSTRAINT `fk_owner_id_report` FOREIGN KEY (`owner_id_report`) REFERENCES `report` (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `owner`
--

LOCK TABLES `owner` WRITE;
/*!40000 ALTER TABLE `owner` DISABLE KEYS */;
/*!40000 ALTER TABLE `owner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `production_detail`
--

DROP TABLE IF EXISTS `production_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `production_detail` (
  `production_id` int(11) NOT NULL AUTO_INCREMENT,
  `production_nama` varchar(120) NOT NULL,
  `production_deadline` date NOT NULL,
  `production_detail` text NOT NULL,
  `production_id_employee` int(11) NOT NULL,
  `production_id_client` int(11) NOT NULL,
  `production_id_treatment_dtl` int(11) NOT NULL,
  PRIMARY KEY (`production_id`),
  KEY `fk_production_id_employee` (`production_id_employee`),
  KEY `fk_production_id_client` (`production_id_client`),
  KEY `fk_production_id_treatment_dtl` (`production_id_treatment_dtl`),
  CONSTRAINT `fk_production_id_client` FOREIGN KEY (`production_id_client`) REFERENCES `client` (`client_id`),
  CONSTRAINT `fk_production_id_employee` FOREIGN KEY (`production_id_employee`) REFERENCES `employee` (`employee_id`),
  CONSTRAINT `fk_production_id_treatment_dtl` FOREIGN KEY (`production_id_treatment_dtl`) REFERENCES `client` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `production_detail`
--

LOCK TABLES `production_detail` WRITE;
/*!40000 ALTER TABLE `production_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `production_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profit`
--

DROP TABLE IF EXISTS `profit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profit` (
  `profit_id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id_production` int(11) NOT NULL,
  PRIMARY KEY (`profit_id`),
  KEY `fk_expense_id_production` (`expense_id_production`),
  CONSTRAINT `fk_expense_id_production` FOREIGN KEY (`expense_id_production`) REFERENCES `report` (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profit`
--

LOCK TABLES `profit` WRITE;
/*!40000 ALTER TABLE `profit` DISABLE KEYS */;
/*!40000 ALTER TABLE `profit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchasing_item`
--

DROP TABLE IF EXISTS `purchasing_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchasing_item` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_item_name` varchar(120) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_total` int(11) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `purchase_id_employee` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `fk_purchase_id_employee` (`purchase_id_employee`),
  CONSTRAINT `fk_purchase_id_employee` FOREIGN KEY (`purchase_id_employee`) REFERENCES `employee` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchasing_item`
--

LOCK TABLES `purchasing_item` WRITE;
/*!40000 ALTER TABLE `purchasing_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchasing_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_title` varchar(150) NOT NULL,
  `report_date` date NOT NULL,
  `report_detail` text NOT NULL,
  `report_id_employee` int(11) NOT NULL,
  PRIMARY KEY (`report_id`),
  KEY `fk_report_id_employee` (`report_id_employee`),
  CONSTRAINT `fk_report_id_employee` FOREIGN KEY (`report_id_employee`) REFERENCES `employee` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `treatment_detail`
--

DROP TABLE IF EXISTS `treatment_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `treatment_detail` (
  `treatment_id` int(11) NOT NULL AUTO_INCREMENT,
  `treatment_name` varchar(120) NOT NULL,
  `treatment_price` int(11) NOT NULL,
  PRIMARY KEY (`treatment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `treatment_detail`
--

LOCK TABLES `treatment_detail` WRITE;
/*!40000 ALTER TABLE `treatment_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `treatment_detail` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-15 14:09:31
