/*
SQLyog Community v11.4 (64 bit)
MySQL - 5.6.16 : Database - golive_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`golive_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `golive_db`;

/*Table structure for table `cards_tbl` */

DROP TABLE IF EXISTS `cards_tbl`;

CREATE TABLE `cards_tbl` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `videoUrl` varchar(256) NOT NULL DEFAULT '',
  `categoryId` bigint(20) NOT NULL,
  `note` text,
  `deletedYN` varchar(1) NOT NULL DEFAULT 'N',
  `createdon` varchar(256) DEFAULT 'yyyy-mm-dd',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cards_tbl` */

/*Table structure for table `category_tbl` */

DROP TABLE IF EXISTS `category_tbl`;

CREATE TABLE `category_tbl` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `imagePath` varchar(256) NOT NULL DEFAULT '',
  `deletedYN` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `category_tbl` */

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ci_sessions` */

insert  into `ci_sessions`(`session_id`,`ip_address`,`user_agent`,`last_activity`,`user_data`) values ('a5944869901c7d95157f4bf26dab1807','175.100.72.131','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36',1407484884,'');

/*Table structure for table `groups_tbl` */

DROP TABLE IF EXISTS `groups_tbl`;

CREATE TABLE `groups_tbl` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `value` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `groups_tbl` */

/*Table structure for table `promo_tbl` */

DROP TABLE IF EXISTS `promo_tbl`;

CREATE TABLE `promo_tbl` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` varchar(1024) NOT NULL,
  `deletedYN` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `promo_tbl` */

/*Table structure for table `scusers_tbl` */

DROP TABLE IF EXISTS `scusers_tbl`;

CREATE TABLE `scusers_tbl` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `snsId` varchar(10) NOT NULL DEFAULT '',
  `username` varchar(100) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `createdon` varchar(50) NOT NULL DEFAULT 'yyyy-mm-dd hh:mm:ss',
  `deletedYN` varchar(1) NOT NULL DEFAULT 'N',
  `snsType` varchar(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `scusers_tbl` */

/*Table structure for table `userinfo_tbl` */

DROP TABLE IF EXISTS `userinfo_tbl`;

CREATE TABLE `userinfo_tbl` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(256) NOT NULL DEFAULT '',
  `email` varchar(256) NOT NULL DEFAULT 'example@mail.com',
  `birthday` varchar(50) NOT NULL DEFAULT 'YYYY-MM-DD',
  `securekey` varchar(256) NOT NULL DEFAULT '',
  `deletedYN` varchar(1) NOT NULL DEFAULT 'N',
  `createdon` varchar(50) NOT NULL DEFAULT 'YYYY-MM-DD',
  `activeYN` varchar(1) NOT NULL DEFAULT 'B',
  `address` varchar(256) NOT NULL DEFAULT '',
  `city` varchar(256) NOT NULL DEFAULT '',
  `state` varchar(256) NOT NULL DEFAULT '0',
  `postalCode` varchar(10) NOT NULL DEFAULT '0',
  `country` varchar(10) NOT NULL DEFAULT '',
  `salt` varchar(32) NOT NULL DEFAULT '',
  `snsId` bigint(10) NOT NULL DEFAULT '-1',
  `activateCode` varchar(32) NOT NULL DEFAULT '',
  `activatedon` varchar(50) NOT NULL DEFAULT '',
  `userGroup` varchar(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `userinfo_tbl` */

insert  into `userinfo_tbl`(`id`,`fullname`,`email`,`birthday`,`securekey`,`deletedYN`,`createdon`,`activeYN`,`address`,`city`,`state`,`postalCode`,`country`,`salt`,`snsId`,`activateCode`,`activatedon`,`userGroup`) values (25,'','example@mail.com','YYYY-MM-DD','','N','YYYY-MM-DD','B','','','0','0','','',-1,'','','1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
