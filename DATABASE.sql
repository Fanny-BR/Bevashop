/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.1.39-MariaDB : Database - proyek2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`proyek2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `proyek2`;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id` varchar(50) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kategori` (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

insert  into `barang`(`id`,`gambar`,`id_kategori`,`nama`,`deskripsi`) values 
('bdk002','1605574597Screenshot_6.png',1,'Bedak Mora','Bedak Berkualitas terbaik'),
('brg002','1587434500NekoDesz1.png',2,'Lipstick','Lipstik Berkualitas'),
('ks001','1605151983CNC.png',1,'Baju Kaos Kawaii','Baju Baju dengan tulisan Jepang Kawaii'),
('nbtck','1607322064WhatsApp Image 2020-12-06 at 11.28.00 AM (1).jpeg',3,'Redmi Note 8','Note 8 cari aja di google'),
('xn5p332','16051488381099190.png',3,'Xiaomi Note 5 Pro','HP xiaomi murah');

/*Table structure for table `detail_transaksi` */

DROP TABLE IF EXISTS `detail_transaksi`;

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_stok` varchar(50) DEFAULT NULL,
  `harga` int(50) DEFAULT NULL,
  `qty` int(50) DEFAULT NULL,
  `total` int(50) DEFAULT NULL,
  PRIMARY KEY (`id_detail_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `detail_transaksi` */

insert  into `detail_transaksi`(`id_detail_transaksi`,`id_transaksi`,`id_stok`,`harga`,`qty`,`total`) values 
(13,14,'2',40000,1,40000),
(14,15,'2',40000,1,40000),
(15,16,'2',40000,2,80000),
(16,17,'1',150000,1,150000),
(17,18,'2',40000,1,40000);

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

insert  into `kategori`(`id`,`nama_kategori`) values 
(1,'Fashion'),
(2,'Kosmetik'),
(3,'Handphone');

/*Table structure for table `level` */

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `level` */

insert  into `level`(`id`,`nama_level`) values 
(1,'Admin'),
(2,'Karyawan');

/*Table structure for table `stok` */

DROP TABLE IF EXISTS `stok`;

CREATE TABLE `stok` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `stok_masuk` int(11) DEFAULT NULL,
  `stok_sekarang` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `harga` int(50) DEFAULT NULL,
  `id_barang` varchar(50) DEFAULT NULL,
  `id_supplier` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `stok` */

insert  into `stok`(`id`,`stok_masuk`,`stok_sekarang`,`tanggal`,`harga`,`id_barang`,`id_supplier`) values 
(1,6,0,'2020-10-13',150000,'ks001','sup001'),
(2,20,13,'2020-11-05',40000,'brg002','sup001'),
(3,11,11,'2020-12-07',150000,'ks001','sup001'),
(4,40,40,'2020-12-07',15000,'bdk002','sup001'),
(5,4,4,'2020-12-09',1500000,'xn5p332','sup001');

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `id_supplier` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `supplier` */

insert  into `supplier`(`id_supplier`,`nama`,`telepon`,`alamat`) values 
('sup001','KzStore','08213231222','jl raya no 5 kediri');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_invoice` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `jam_transaksi` varchar(10) DEFAULT NULL,
  `total_bayar` int(50) DEFAULT NULL,
  `jumlah_bayar` int(50) DEFAULT NULL,
  `kembalian` int(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id`,`no_invoice`,`tgl_transaksi`,`jam_transaksi`,`total_bayar`,`jumlah_bayar`,`kembalian`,`id_user`) values 
(14,'INV00120201105','2020-10-30','07:20:29',40000,50000,10000,1),
(15,'INV00220201105','2020-11-05','08:41:50',40000,50000,10000,1),
(16,'INV00320201118','2020-11-18','06:37:02',80000,100000,20000,4),
(17,'INV00420201125','2020-11-25','23:30:51',150000,150000,0,4),
(18,'INV00520201203','2020-12-03','08:58:00',40000,50000,10000,4);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nomor` varchar(20) DEFAULT NULL,
  `alamat` text,
  `id_level` int(11) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`nama`,`nomor`,`alamat`,`id_level`,`gambar`) values 
(1,'admin','123','Admin','082338206740','Jl Tegalan Ds Ngasem - Ngasem Kediri ',1,'1587434500NekoDesz1.png'),
(2,'isna','isna','Isna','082123712631','Banyakan',2,'16051491800d57e342e7636aea4e0580a660874b0e_t.jpg'),
(3,'wildan','wildan','Wildan','0812231231241','Wates',2,'1604536168Day9 - Copy.png'),
(4,'fanny','123','Fanny','082338206740','Ngasem',2,'1605574554Screenshot_42.png');

/*Table structure for table `menipis` */

DROP TABLE IF EXISTS `menipis`;

/*!50001 DROP VIEW IF EXISTS `menipis` */;
/*!50001 DROP TABLE IF EXISTS `menipis` */;

/*!50001 CREATE TABLE  `menipis`(
 `stok_total` decimal(32,0) ,
 `nama` varchar(100) ,
 `supplier` varchar(30) ,
 `stok_masuk` int(11) ,
 `id` int(50) ,
 `stok_sekarang` int(11) ,
 `tanggal` date ,
 `harga` int(50) 
)*/;

/*View structure for view menipis */

/*!50001 DROP TABLE IF EXISTS `menipis` */;
/*!50001 DROP VIEW IF EXISTS `menipis` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `menipis` AS select sum(`stok`.`stok_sekarang`) AS `stok_total`,`barang`.`nama` AS `nama`,`supplier`.`nama` AS `supplier`,`stok`.`stok_masuk` AS `stok_masuk`,`stok`.`id` AS `id`,`stok`.`stok_sekarang` AS `stok_sekarang`,`stok`.`tanggal` AS `tanggal`,`stok`.`harga` AS `harga` from ((`stok` join `barang` on((`barang`.`id` = `stok`.`id_barang`))) join `supplier` on((`supplier`.`id_supplier` = `stok`.`id_supplier`))) group by `stok`.`id_barang` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
