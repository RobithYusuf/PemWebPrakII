/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.4.14-MariaDB-log : Database - pengiriman
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pengiriman` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `pengiriman`;

/*Table structure for table `tabel_panen` */

DROP TABLE IF EXISTS `tabel_panen`;

CREATE TABLE `tabel_panen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pengirim` varchar(32) NOT NULL,
  `berat_barang` varchar(11) NOT NULL,
  `perkiraan_sampai` int(11) NOT NULL,
  `tanggal_sampai` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1646750342 DEFAULT CHARSET=latin1;

/*Data for the table `tabel_panen` */

insert  into `tabel_panen`(`id`,`nama_pengirim`,`berat_barang`,`perkiraan_sampai`,`tanggal_sampai`) values 
(1646750304,'Robith Yusuf','Laptop ROG ',3,'2022-03-09'),
(1646750341,'Budiono','Iphone 10',2,'2022-03-09');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
