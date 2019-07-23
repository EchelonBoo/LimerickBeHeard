CREATE DATABASE  IF NOT EXISTS `limerickbeheard` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `limerickbeheard`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: limerickbeheard
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.38-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `AdminID` varchar(10) NOT NULL,
  `FirstName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Mobile` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('AD001','John','Smith','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','john.Smith@gmail.com','0891237859'),('AD002','Mary','Smith','4498adbcaf39ad91bb7a7e3b4882fc4f95874a2f','jane.smith@gmail.com','0871234567'),('AD003','Sam','Ryan','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','sam.ryan@outlook.com','1234678978'),('AD004','Bethany','Hanrahan','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','bethanyhanrahan123@gmail.com','123489687'),('AD005','Dylan','Snith','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','dylan.snith@gmail.com','0877894561'),('AD006','Keith','Allen','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','k.a@gmail.com','123456789'),('AD007','Naomi','Meara','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','n.m@gmail.com','156789645'),('AD008','Dylan','Cummins','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','dy.c@gmail.com','15687479'),('AD009','Shaun','Hanrahan','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','shaun.h@outlook.com','5296489778'),('AD010','Jocelyn','Cullen','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','j.c@gmail.com','148794756'),('TEST1','Test','Test','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','test@gmail.com','00000000');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `msgID` int(11) NOT NULL AUTO_INCREMENT,
  `senderID` varchar(15) DEFAULT NULL,
  `senderFirstName` varchar(45) DEFAULT NULL,
  `senderLastName` varchar(45) DEFAULT NULL,
  `message` varchar(128) DEFAULT 'empty message',
  `datetimestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`msgID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (1,'AD001','John','Smith','hi','2019-04-29 14:20:17'),(2,'AD001','John','Smith','123','2019-04-29 14:20:21'),(3,'AD001','John','Smith','Hey','2019-04-29 14:22:32'),(4,'AD001','John','Smith','Hey','2019-04-29 14:23:31'),(5,'AD001','John','Smith','27452','2019-04-29 14:23:34'),(6,'AD002','Jane','Smith','Test','2019-04-29 14:25:31'),(7,'AD002','Jane','Smith','Test','2019-04-29 14:32:54'),(8,'AD002','Jane','Smith','123','2019-04-29 14:32:58'),(9,'AD002','Jane','Smith','Hey','2019-04-29 14:38:21'),(10,'AD007','Naomi','Meara','Test5','2019-04-29 14:38:32'),(11,'MB001','John','Real','1234','2019-04-29 14:48:28'),(12,'AD001','John','Smith','hi how are you','2019-04-29 15:05:45'),(13,'AD004','Bethany','Hanrahan','Good you?\r\n','2019-04-29 15:05:53'),(14,'AD004','Bethany','Hanrahan','5667','2019-04-29 16:36:26'),(15,'MB001','John','Real','ghtht\r\n','2019-04-29 16:37:31'),(16,'MB001','John','Real','Test for word document.','2019-04-29 18:00:41'),(17,'AD002','Jane','Smith','This is adminTest message for word document','2019-04-29 18:21:35');
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `EventID` varchar(10) NOT NULL,
  `EventName` varchar(45) DEFAULT NULL,
  `EventDate` varchar(15) DEFAULT NULL,
  `EventDescription` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES ('EV001','Treasure Hunt','04-08-2019','Treasure hunt around Limerick City.'),('EV002','Dog Walking','03-08-2019','Dog walking in Peoples Park on the Bank Holiday Weekend.'),('EV003','Treasure Hunt','08-05-2019','Treasure hunt around Limerick City.'),('EV004','Fashion Show','19.794117647058','Fashion Show in aid of LYS.'),('EV005','Pub Quiz','12-07-2019','Pub Quiz in Bradshaws bar.'),('EV006','Treasure Hunt','06-06-2019','Treasure hunt around Limerick City.');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `MemberID` varchar(10) NOT NULL,
  `FirstName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Mobile` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`MemberID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES ('MB001','Joe','Real','4498adbcaf39ad91bb7a7e3b4882fc4f95874a2f','john.real@gmail.com','0838755065'),('MB002','Joe','Smith','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','joe.smith@gmail.com','0871234567'),('MB003','Dylan','Cummins','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','d.c@gmail.com','061597863'),('MB004','Joe','Smith','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','joe.smith@gmail.com','0891234567'),('MB005','Kathlyn','Coleman','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','k.c@gmail.com','0891234567'),('MB006','Ryan','Spade','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','r.s@gmail.com','0891234987'),('MB007','Thomas','Horan','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','tom.h@gmail.ocom','489756231'),('MB008','Jackie','Collins','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','jack.c@gmail.com','061548972'),('MB009','Alannah','Neil','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','a.n@gmail.com','061379863'),('MB010','Mike','Hanrahan','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','m.h@gmail.com','8974150264');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-29 19:58:47
