/*
SQLyog Ultimate
MySQL - 10.4.10-MariaDB : Database - kofi_test_project
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `book_collections` */

DROP TABLE IF EXISTS `book_collections`;

CREATE TABLE `book_collections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lib_collection_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `lib_collection_id` (`lib_collection_id`),
  CONSTRAINT `book_collections_ibfk_1` FOREIGN KEY (`lib_collection_id`) REFERENCES `lib_collections` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `book_collections` */

insert  into `book_collections`(`id`,`name`,`lib_collection_id`,`start_date`,`end_date`,`created_at`,`updated_at`) values (1,'Cakephp',1,'2023-06-30','2023-07-07','2023-07-25 04:06:15','2023-07-25 04:06:15'),(2,'Laravel',2,'2023-06-29','2023-07-17','2023-07-25 04:06:15','2023-07-25 04:06:15'),(3,'PHP',3,'2023-06-29','2023-07-17','2023-07-25 04:06:15','2023-07-25 04:06:15'),(4,'Yii',4,'2023-06-29','2023-07-17','2023-07-25 04:06:15','2023-07-25 04:06:15'),(5,'Science F',3,'2023-07-25','2023-07-25','2023-07-25 10:06:49','2023-07-25 10:06:49');

/*Table structure for table `book_collections_books` */

DROP TABLE IF EXISTS `book_collections_books`;

CREATE TABLE `book_collections_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_collection_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `book_collection_id` (`book_collection_id`),
  KEY `book_id` (`book_id`),
  CONSTRAINT `book_collections_books_ibfk_1` FOREIGN KEY (`book_collection_id`) REFERENCES `book_collections` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `book_collections_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `book_collections_books` */

insert  into `book_collections_books`(`id`,`book_collection_id`,`book_id`,`created_at`,`updated_at`) values (1,1,1,'2023-07-25 04:06:15','2023-07-25 04:06:15'),(2,2,2,'2023-07-25 04:06:15','2023-07-25 04:06:15'),(3,2,3,'2023-07-25 04:06:15','2023-07-25 04:06:15'),(4,3,3,'2023-07-25 04:06:15','2023-07-25 04:06:15'),(5,3,2,'2023-07-25 04:06:15','2023-07-25 04:06:15'),(6,3,4,'2023-07-25 04:06:15','2023-07-25 04:06:15'),(7,4,3,'2023-07-25 04:06:15','2023-07-25 04:06:15'),(8,4,1,'2023-07-25 04:06:15','2023-07-25 04:06:15'),(9,4,2,'2023-07-25 04:06:15','2023-07-25 04:06:15'),(10,4,4,'2023-07-25 04:06:15','2023-07-25 04:06:15'),(11,5,5,'2023-07-25 10:06:49','2023-07-25 10:06:49'),(12,5,6,'2023-07-25 10:06:49','2023-07-25 10:06:49'),(13,5,7,'2023-07-25 10:06:50','2023-07-25 10:06:50');

/*Table structure for table `book_images` */

DROP TABLE IF EXISTS `book_images`;

CREATE TABLE `book_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `book_id` (`book_id`),
  CONSTRAINT `book_images_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `book_images` */

insert  into `book_images`(`id`,`book_id`,`filename`,`created_at`,`updated_at`) values (1,1,'ckae_image.jpg','2023-07-25 04:06:15','2023-07-25 04:06:15'),(2,2,'java.jpg','2023-07-25 04:06:15','2023-07-25 04:06:15'),(3,3,'java_script.jpg','2023-07-25 04:06:15','2023-07-25 04:06:15'),(4,4,'laravel.jpg','2023-07-25 04:06:15','2023-07-25 04:06:15'),(5,5,'Life Science_1690258009.jpg','2023-07-25 10:06:49','2023-07-25 10:06:49'),(6,6,'Space Science_1690258009.jpg','2023-07-25 10:06:49','2023-07-25 10:06:49'),(7,7,'Water Engineering_1690258010.jpg','2023-07-25 10:06:50','2023-07-25 10:06:50');

/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `books` */

insert  into `books`(`id`,`name`,`created_at`,`updated_at`,`video`) values (1,'Cakephp','2023-07-25 04:06:15','2023-07-25 04:06:15',''),(2,'Java','2023-07-25 04:06:15','2023-07-25 04:06:15',''),(3,'Java Script','2023-07-25 04:06:15','2023-07-25 04:06:15',''),(4,'Laravel','2023-07-25 04:06:15','2023-07-25 04:06:15',''),(5,'Life Science','2023-07-25 10:06:49','2023-07-25 10:06:49','Life Science_1690258009.mp4'),(6,'Space Science','2023-07-25 10:06:49','2023-07-25 10:06:49','Space Science_1690258009.mp4'),(7,'Water Engineering','2023-07-25 10:06:50','2023-07-25 10:06:50','Water Engineering_1690258010.mp4');

/*Table structure for table `lib_collections` */

DROP TABLE IF EXISTS `lib_collections`;

CREATE TABLE `lib_collections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lib_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `lib_collections` */

insert  into `lib_collections`(`id`,`name`,`lib_count`,`created_at`,`updated_at`) values (1,'Lib',1,'2023-07-25 04:06:15','2023-07-25 04:06:15'),(2,'Lib',2,'2023-07-25 04:06:15','2023-07-25 04:06:15'),(3,'Lib',3,'2023-07-25 04:06:15','2023-07-25 04:06:15'),(4,'Lib',4,'2023-07-25 04:06:15','2023-07-25 04:06:15');

/*Table structure for table `phinxlog` */

DROP TABLE IF EXISTS `phinxlog`;

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `phinxlog` */

insert  into `phinxlog`(`version`,`migration_name`,`start_time`,`end_time`,`breakpoint`) values (20230701092649,'CreateBooks','2023-07-25 04:05:56','2023-07-25 04:05:56',0),(20230701110846,'CreateBookImages','2023-07-25 04:05:56','2023-07-25 04:05:57',0),(20230701111449,'CreateLibCollections','2023-07-25 04:05:57','2023-07-25 04:05:58',0),(20230701111652,'CreateBookCollections','2023-07-25 04:05:58','2023-07-25 04:05:59',0),(20230701112247,'CreateBookCollectionsBooks','2023-07-25 04:05:59','2023-07-25 04:06:00',0),(20230720213633,'ChangeBooksTable','2023-07-25 04:06:00','2023-07-25 04:06:00',0),(20230721193652,'ChangeBooksTableVideoColumn','2023-07-25 04:06:00','2023-07-25 04:06:00',0),(20230721193915,'ChangeBooksTableVideoColumn1','2023-07-25 04:06:00','2023-07-25 04:06:01',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
