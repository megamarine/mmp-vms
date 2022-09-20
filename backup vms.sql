-- --------------------------------------------------------
-- Host:                         192.168.10.167
-- Server version:               10.1.31-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for vms
CREATE DATABASE IF NOT EXISTS `vms` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `vms`;

-- Dumping structure for table vms.m_card
CREATE TABLE IF NOT EXISTS `m_card` (
  `card_id` int(11) NOT NULL AUTO_INCREMENT,
  `card_no` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT '0' COMMENT '0=available, 1=not available',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`card_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.m_card: ~2 rows (approximately)
/*!40000 ALTER TABLE `m_card` DISABLE KEYS */;
INSERT INTO `m_card` (`card_id`, `card_no`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
	(1, '123456789', 1, '2022-05-25 09:21:55', '422915', NULL, NULL),
	(2, '12345', 1, '2022-06-14 11:25:18', '422915', NULL, NULL);
/*!40000 ALTER TABLE `m_card` ENABLE KEYS */;

-- Dumping structure for table vms.m_company
CREATE TABLE IF NOT EXISTS `m_company` (
  `company_id` varchar(10) NOT NULL,
  `company_name` varchar(50) DEFAULT NULL,
  `company_type` varchar(5) DEFAULT NULL,
  `company_address` text,
  `company_phone` varchar(50) DEFAULT NULL,
  `company_email` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1=aktif, 0=nonaktif',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.m_company: ~2 rows (approximately)
/*!40000 ALTER TABLE `m_company` DISABLE KEYS */;
INSERT INTO `m_company` (`company_id`, `company_name`, `company_type`, `company_address`, `company_phone`, `company_email`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
	('C-0001', 'PT Mega Marine Pride', 'CT-06', 'Gunung Gangsir, Beji, Pasuruan - Jawa Timur', '0343 1234 5678', 'megamarinepride@tes.com', 1, '2022-05-30 09:56:13', '422915', '2022-05-30 13:17:41', '422915'),
	('C-0002', 'PT Baramuda Bahari', 'CT-06', 'Gunung Gangsir, Beji, Pasuruan - Jawa Timur', '0343 9876 5432', 'baramudabahari@tes.com', 1, '2022-05-30 09:56:55', '422915', '2022-05-30 11:44:22', '422915');
/*!40000 ALTER TABLE `m_company` ENABLE KEYS */;

-- Dumping structure for table vms.m_companytype
CREATE TABLE IF NOT EXISTS `m_companytype` (
  `type_id` varchar(10) NOT NULL,
  `type_name` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1=aktif, 0=nonaktif',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.m_companytype: ~12 rows (approximately)
/*!40000 ALTER TABLE `m_companytype` DISABLE KEYS */;
INSERT INTO `m_companytype` (`type_id`, `type_name`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
	('CT-01', 'Agent', 1, '2022-05-30 09:43:53', '422915', '2022-05-30 13:23:08', '422915'),
	('CT-02', 'Buyer Bank', 1, '2022-05-30 09:44:08', '422915', NULL, NULL),
	('CT-03', 'Buyer Division', 1, '2022-05-30 09:44:22', '422915', NULL, NULL),
	('CT-04', 'Bank', 1, '2022-05-30 09:44:34', '422915', NULL, NULL),
	('CT-05', 'Buyer', 1, '2022-05-30 09:44:43', '422915', NULL, NULL),
	('CT-06', 'Company Group', 1, '2022-05-30 09:45:00', '422915', NULL, NULL),
	('CT-07', 'Company Unit', 1, '2022-05-30 09:45:15', '422915', NULL, NULL),
	('CT-08', 'Forwarder/Courier/EMKL', 1, '2022-05-30 09:45:35', '422915', NULL, NULL),
	('CT-09', 'Outsourching', 1, '2022-05-30 09:45:47', '422915', NULL, NULL),
	('CT-10', 'Supplier', 1, '2022-05-30 09:45:57', '422915', NULL, NULL),
	('CT-11', 'Vendor', 1, '2022-05-30 09:46:04', '422915', NULL, NULL),
	('CT-12', 'ASDFASD', 0, '2022-05-30 12:02:51', '422915', '2022-05-30 13:24:30', '422915');
/*!40000 ALTER TABLE `m_companytype` ENABLE KEYS */;

-- Dumping structure for table vms.m_department
CREATE TABLE IF NOT EXISTS `m_department` (
  `dept_id` varchar(50) NOT NULL,
  `dept_name` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1=aktif, 0=nonaktif',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.m_department: ~3 rows (approximately)
/*!40000 ALTER TABLE `m_department` DISABLE KEYS */;
INSERT INTO `m_department` (`dept_id`, `dept_name`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
	('1', 'IT', 1, '2022-05-25 11:12:50', '422915', '2022-05-30 13:48:42', '422915'),
	('2', 'Quality', 1, '2022-05-30 13:42:30', '422915', NULL, NULL),
	('3', 'Corporate', 1, '2022-05-30 13:43:05', '422915', '2022-05-30 13:51:12', '422915');
/*!40000 ALTER TABLE `m_department` ENABLE KEYS */;

-- Dumping structure for table vms.m_division
CREATE TABLE IF NOT EXISTS `m_division` (
  `dept_id` varchar(50) DEFAULT NULL,
  `div_id` varchar(50) NOT NULL,
  `div_name` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1=aktif, 0=nonaktif',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`div_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.m_division: ~3 rows (approximately)
/*!40000 ALTER TABLE `m_division` DISABLE KEYS */;
INSERT INTO `m_division` (`dept_id`, `div_id`, `div_name`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
	('1', '1.1', 'DIV IT', 1, '2022-05-25 11:13:10', '422915', '2022-05-30 15:02:44', '422915'),
	('1', '1.2', 'IT Div 2', 1, '2022-05-30 14:45:48', '422915', '2022-05-30 15:02:54', '422915'),
	('1', '1.3', 'IT Div 3', 1, '2022-05-30 14:46:55', '422915', '2022-05-30 14:58:10', '422915');
/*!40000 ALTER TABLE `m_division` ENABLE KEYS */;

-- Dumping structure for table vms.m_employees
CREATE TABLE IF NOT EXISTS `m_employees` (
  `employees_id` varchar(50) NOT NULL,
  `employees_name` varchar(200) DEFAULT NULL,
  `dept_id` varchar(50) DEFAULT NULL,
  `div_id` varchar(50) DEFAULT NULL,
  `level_id` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1=aktif, 0=nonaktif',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`employees_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.m_employees: ~2 rows (approximately)
/*!40000 ALTER TABLE `m_employees` DISABLE KEYS */;
INSERT INTO `m_employees` (`employees_id`, `employees_name`, `dept_id`, `div_id`, `level_id`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
	('123123', 'Saiful Jamil', '1', '1.3', 'lvl02', 0, '2022-05-30 16:58:52', '422915', '2022-05-31 09:13:28', '422915'),
	('422915', 'Robby Refta A', '1', '1.1', 'lvl01', 1, '2022-05-30 16:28:19', '422915', NULL, NULL);
/*!40000 ALTER TABLE `m_employees` ENABLE KEYS */;

-- Dumping structure for table vms.m_key
CREATE TABLE IF NOT EXISTS `m_key` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(200) DEFAULT NULL,
  `key_location` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '0' COMMENT '0=available, 1=not available',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.m_key: ~1 rows (approximately)
/*!40000 ALTER TABLE `m_key` DISABLE KEYS */;
INSERT INTO `m_key` (`key_id`, `nama_ruangan`, `key_location`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
	(1, 'Ruang IT Utama', 'Security', 0, '2022-05-31 10:46:02', '422915', '2022-05-31 11:24:57', '422915');
/*!40000 ALTER TABLE `m_key` ENABLE KEYS */;

-- Dumping structure for table vms.m_level
CREATE TABLE IF NOT EXISTS `m_level` (
  `level_id` varchar(50) NOT NULL,
  `level_name` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1=aktif, 0=nonaktif',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.m_level: ~2 rows (approximately)
/*!40000 ALTER TABLE `m_level` DISABLE KEYS */;
INSERT INTO `m_level` (`level_id`, `level_name`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
	('lvl01', 'Supervisor', 1, '2022-05-30 15:30:30', '422915', NULL, NULL),
	('lvl02', 'asdasdasd', 0, '2022-05-30 15:41:45', '422915', '2022-05-30 15:47:41', '422915');
/*!40000 ALTER TABLE `m_level` ENABLE KEYS */;

-- Dumping structure for table vms.m_module
CREATE TABLE IF NOT EXISTS `m_module` (
  `id_module` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_module`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.m_module: ~19 rows (approximately)
/*!40000 ALTER TABLE `m_module` DISABLE KEYS */;
INSERT INTO `m_module` (`id_module`, `module_name`) VALUES
	(1, 'Master User'),
	(2, 'Master Company'),
	(3, 'Master Company Type'),
	(4, 'Master Department'),
	(5, 'Master Divisi'),
	(6, 'Master Level'),
	(7, 'Master Employees'),
	(8, 'Master Card'),
	(9, 'Master Key'),
	(10, 'Master Unit Measurement'),
	(11, 'Master Vehicle'),
	(12, 'Master Visitor Type'),
	(13, 'Master Purpose'),
	(14, 'Visitor Management'),
	(15, 'Package Management'),
	(16, 'Key Management'),
	(17, 'Report Visitor Management'),
	(18, 'Report Package Management'),
	(19, 'Report Key Management');
/*!40000 ALTER TABLE `m_module` ENABLE KEYS */;

-- Dumping structure for table vms.m_purpose
CREATE TABLE IF NOT EXISTS `m_purpose` (
  `purpose_id` varchar(50) NOT NULL,
  `purpose_desc` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1=aktif, 0=nonaktif',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`purpose_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.m_purpose: ~3 rows (approximately)
/*!40000 ALTER TABLE `m_purpose` DISABLE KEYS */;
INSERT INTO `m_purpose` (`purpose_id`, `purpose_desc`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
	('PRP001', 'Audit', 1, '2022-05-31 15:14:55', '422915', NULL, NULL),
	('PRP002', 'Inspeksi', 1, '2022-05-31 15:15:09', '422915', NULL, NULL),
	('PRP003', 'Interview', 1, '2022-05-31 15:31:08', '422915', '2022-05-31 15:32:24', '422915');
/*!40000 ALTER TABLE `m_purpose` ENABLE KEYS */;

-- Dumping structure for table vms.m_um
CREATE TABLE IF NOT EXISTS `m_um` (
  `um_id` varchar(50) NOT NULL,
  `um_desc` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1=aktif, 0=nonaktif',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`um_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.m_um: ~3 rows (approximately)
/*!40000 ALTER TABLE `m_um` DISABLE KEYS */;
INSERT INTO `m_um` (`um_id`, `um_desc`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
	('UM001', 'Kilogram', 1, '2022-05-31 11:48:33', '422915', NULL, NULL),
	('UM002', 'Kwintal', 1, '2022-05-31 11:55:22', '422915', NULL, NULL),
	('UM003', 'Ton', 1, '2022-05-31 11:59:38', '422915', '2022-05-31 13:24:49', '422915');
/*!40000 ALTER TABLE `m_um` ENABLE KEYS */;

-- Dumping structure for table vms.m_user
CREATE TABLE IF NOT EXISTS `m_user` (
  `kode_user` varchar(50) NOT NULL,
  `nama_user` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `dept_id` varchar(100) DEFAULT NULL,
  `div_id` varchar(50) DEFAULT NULL,
  `akses` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '0=nonaktif, 1=aktif',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `status_delete` int(1) DEFAULT '0' COMMENT '0=available, 1=deleted',
  PRIMARY KEY (`kode_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.m_user: ~4 rows (approximately)
/*!40000 ALTER TABLE `m_user` DISABLE KEYS */;
INSERT INTO `m_user` (`kode_user`, `nama_user`, `password`, `dept_id`, `div_id`, `akses`, `email`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status_delete`) VALUES
	('422915', 'Robby Refta', '$2y$12$CGl4qFcGGUH453TkrPPTOOf9T/YNmmoJzlJ.DDCnncm2PAcQ0VUxq', '1', '1.1', 'administrator', 'robbyrefta@gmail.com', 1, '2022-05-24 15:02:50', '422915', '2022-05-30 08:47:23', '422915', 0),
	('admin', 'Administrator', '$2y$12$Ypt05GRSfU58bnl/ZFgEA.VwMJHcIjMcy9N44gLj6k/mLBGWZ0NpS', '1', '1.1', 'administrator', 'admin@tes.com', 1, '2022-05-25 13:36:32', '422915', NULL, NULL, 0),
	('tes', 'testing', '$2y$12$iamFmXuf/tZY.dXjNJR2A.zKGHfXtnpil8yOzWMI3Eu9uKkN8zIi2', '1', '1.1', 'security', 'email@email.com', 1, '2022-05-27 15:54:15', '422915', '2022-05-27 15:57:50', '422915', 0),
	('tes2', 'tessssss2', '$2y$12$c2T03MCMJCHXn6BYbd8DEOZbmmk0GlbxFWqQXdALUQlV6aEf/lg9y', '1', '1.1', 'administrator', 'tes2@tes.com', 1, '2022-05-25 14:15:42', '422915', '2022-05-25 14:29:00', '422915', 1);
/*!40000 ALTER TABLE `m_user` ENABLE KEYS */;

-- Dumping structure for table vms.m_usermodule
CREATE TABLE IF NOT EXISTS `m_usermodule` (
  `seq` int(11) NOT NULL AUTO_INCREMENT,
  `kode_user` varchar(50) DEFAULT NULL,
  `id_module` int(11) DEFAULT NULL,
  `xcreate` int(1) NOT NULL DEFAULT '0' COMMENT '1=yes, 0=no',
  `xread` int(1) NOT NULL DEFAULT '0' COMMENT '1=yes, 0=no',
  `xupdate` int(1) NOT NULL DEFAULT '0' COMMENT '1=yes, 0=no',
  `xdelete` int(1) NOT NULL DEFAULT '0' COMMENT '1=yes, 0=no',
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.m_usermodule: ~19 rows (approximately)
/*!40000 ALTER TABLE `m_usermodule` DISABLE KEYS */;
INSERT INTO `m_usermodule` (`seq`, `kode_user`, `id_module`, `xcreate`, `xread`, `xupdate`, `xdelete`) VALUES
	(1, '422915', 1, 1, 1, 1, 1),
	(2, '422915', 2, 1, 1, 1, 1),
	(3, '422915', 3, 1, 1, 1, 1),
	(4, '422915', 4, 1, 1, 1, 1),
	(5, '422915', 5, 1, 1, 1, 1),
	(6, '422915', 6, 1, 1, 1, 1),
	(7, '422915', 7, 1, 1, 1, 1),
	(8, '422915', 8, 1, 1, 1, 1),
	(9, '422915', 9, 1, 1, 1, 1),
	(10, '422915', 10, 1, 1, 1, 1),
	(11, '422915', 11, 1, 1, 1, 1),
	(12, '422915', 12, 1, 1, 1, 1),
	(13, '422915', 13, 1, 1, 1, 1),
	(14, '422915', 14, 1, 1, 1, 1),
	(15, '422915', 15, 1, 1, 1, 1),
	(16, '422915', 16, 1, 1, 1, 1),
	(17, '422915', 17, 1, 0, 0, 0),
	(18, '422915', 18, 1, 0, 0, 0),
	(19, '422915', 19, 1, 0, 0, 0);
/*!40000 ALTER TABLE `m_usermodule` ENABLE KEYS */;

-- Dumping structure for table vms.m_vehicle
CREATE TABLE IF NOT EXISTS `m_vehicle` (
  `vehicle_id` varchar(50) NOT NULL,
  `vehicle_name` varchar(200) DEFAULT NULL,
  `size` varchar(200) DEFAULT NULL,
  `um_id` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1=aktif, 0=nonaktif',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.m_vehicle: ~5 rows (approximately)
/*!40000 ALTER TABLE `m_vehicle` DISABLE KEYS */;
INSERT INTO `m_vehicle` (`vehicle_id`, `vehicle_name`, `size`, `um_id`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
	('VHC001', 'Container 20ft', '16', 'UM003', 1, '2022-05-31 13:18:55', '422915', NULL, NULL),
	('VHC002', 'Container 40ft', '25', 'UM003', 1, '2022-05-31 13:26:00', '422915', NULL, NULL),
	('VHC003', 'Truck', '2', 'UM003', 1, '2022-05-31 14:05:58', '422915', '2022-05-31 14:11:07', '422915'),
	('VHC004', 'Sepeda Motor', '', '', 1, '2022-06-14 11:21:41', '422915', NULL, NULL),
	('VHC005', 'Mobil', '', '', 1, '2022-06-14 11:22:08', '422915', NULL, NULL);
/*!40000 ALTER TABLE `m_vehicle` ENABLE KEYS */;

-- Dumping structure for table vms.m_visitortype
CREATE TABLE IF NOT EXISTS `m_visitortype` (
  `visitortype_id` varchar(50) NOT NULL,
  `visitortype_name` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1=aktif, 0=nonaktif',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`visitortype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.m_visitortype: ~2 rows (approximately)
/*!40000 ALTER TABLE `m_visitortype` DISABLE KEYS */;
INSERT INTO `m_visitortype` (`visitortype_id`, `visitortype_name`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
	('VIS001', 'Auditor', 1, '2022-05-31 14:55:10', '422915', '2022-05-31 15:13:17', '422915'),
	('VIS002', 'Bea Cukai', 1, '2022-05-31 15:09:21', '422915', NULL, NULL),
	('VIS003', 'Buyer', 0, '2022-05-31 15:10:00', '422915', '2022-05-31 15:13:11', '422915');
/*!40000 ALTER TABLE `m_visitortype` ENABLE KEYS */;

-- Dumping structure for table vms.temp_vms_doc
CREATE TABLE IF NOT EXISTS `temp_vms_doc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.temp_vms_doc: ~0 rows (approximately)
/*!40000 ALTER TABLE `temp_vms_doc` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_vms_doc` ENABLE KEYS */;

-- Dumping structure for table vms.temp_vms_pic
CREATE TABLE IF NOT EXISTS `temp_vms_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.temp_vms_pic: ~0 rows (approximately)
/*!40000 ALTER TABLE `temp_vms_pic` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_vms_pic` ENABLE KEYS */;

-- Dumping structure for table vms.t_key
CREATE TABLE IF NOT EXISTS `t_key` (
  `trans_id` varchar(100) NOT NULL,
  `key_id` int(11) DEFAULT NULL,
  `date_ambil` datetime DEFAULT NULL,
  `rfid_ambil` varchar(100) DEFAULT NULL,
  `nama_ambil` varchar(200) DEFAULT NULL,
  `remark_ambil` varchar(200) DEFAULT NULL,
  `date_kembali` datetime DEFAULT NULL,
  `rfid_kembali` varchar(100) DEFAULT NULL,
  `nama_kembali` varchar(200) DEFAULT NULL,
  `remark_kembali` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`trans_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.t_key: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_key` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_key` ENABLE KEYS */;

-- Dumping structure for table vms.t_package
CREATE TABLE IF NOT EXISTS `t_package` (
  `trans_id` varchar(100) NOT NULL,
  `date_datang` datetime DEFAULT NULL,
  `jenis_paket` varchar(50) DEFAULT NULL,
  `pengirim` varchar(200) DEFAULT NULL,
  `kepada` varchar(200) DEFAULT NULL,
  `date_diambil` datetime DEFAULT NULL,
  `penerima` varchar(200) DEFAULT NULL,
  `pengantar` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`trans_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.t_package: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_package` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_package` ENABLE KEYS */;

-- Dumping structure for table vms.t_vms
CREATE TABLE IF NOT EXISTS `t_vms` (
  `vms_id` varchar(50) NOT NULL,
  `vms_date` date DEFAULT NULL,
  `visitor_asal` varchar(50) DEFAULT NULL,
  `visitor_type` varchar(50) DEFAULT NULL,
  `pre_approval` varchar(50) DEFAULT NULL,
  `final_approval` varchar(50) DEFAULT NULL,
  `purpose_id` varchar(50) DEFAULT NULL,
  `pic` varchar(200) DEFAULT NULL,
  `kitas_type` varchar(50) DEFAULT NULL,
  `kitas_no` varchar(50) DEFAULT NULL,
  `visitor_name` varchar(200) DEFAULT NULL,
  `visitor_phone` varchar(50) DEFAULT NULL,
  `company_id` varchar(50) DEFAULT NULL,
  `vehicle_no` varchar(50) DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `vehicle_brand` varchar(200) DEFAULT NULL,
  `vehicle_qty` varchar(50) DEFAULT NULL,
  `um_id` varchar(50) DEFAULT NULL,
  `sim_type` varchar(50) DEFAULT NULL,
  `sim_no` varchar(50) DEFAULT NULL,
  `sim_exp` date DEFAULT NULL,
  `driver_pengganti` varchar(100) DEFAULT NULL,
  `cek_suhu` varchar(50) DEFAULT NULL,
  `mcu_type` varchar(50) DEFAULT NULL,
  `mcu_result` varchar(50) DEFAULT NULL,
  `mcu_date` date DEFAULT NULL,
  `mcu_exp_date` date DEFAULT NULL,
  `smell_test` varchar(50) DEFAULT NULL,
  `gejala_flu` varchar(50) DEFAULT NULL,
  `photo_path` varchar(200) DEFAULT NULL,
  `doc_path` varchar(200) DEFAULT NULL,
  `card_no` varchar(50) DEFAULT NULL,
  `checkin_date` datetime DEFAULT NULL,
  `checkout_date` datetime DEFAULT NULL,
  `card_no_hk` varchar(50) DEFAULT NULL,
  `checkin_hk_date` datetime DEFAULT NULL,
  `checkin_hk_by` varchar(100) DEFAULT NULL,
  `checkout_hk_date` datetime DEFAULT NULL,
  `checkout_hk_by` varchar(100) DEFAULT NULL,
  `state` int(1) DEFAULT NULL COMMENT '1=outside, 2=prod, 0=pulang',
  `status_visitor` int(1) DEFAULT NULL COMMENT '1=checkin, 0=checkout',
  `status_hapus` int(1) DEFAULT '0' COMMENT '1=deleted',
  `remark` varchar(200) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`vms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.t_vms: ~3 rows (approximately)
/*!40000 ALTER TABLE `t_vms` DISABLE KEYS */;
INSERT INTO `t_vms` (`vms_id`, `vms_date`, `visitor_asal`, `visitor_type`, `pre_approval`, `final_approval`, `purpose_id`, `pic`, `kitas_type`, `kitas_no`, `visitor_name`, `visitor_phone`, `company_id`, `vehicle_no`, `vehicle_type`, `vehicle_brand`, `vehicle_qty`, `um_id`, `sim_type`, `sim_no`, `sim_exp`, `driver_pengganti`, `cek_suhu`, `mcu_type`, `mcu_result`, `mcu_date`, `mcu_exp_date`, `smell_test`, `gejala_flu`, `photo_path`, `doc_path`, `card_no`, `checkin_date`, `checkout_date`, `card_no_hk`, `checkin_hk_date`, `checkin_hk_by`, `checkout_hk_date`, `checkout_hk_by`, `state`, `status_visitor`, `status_hapus`, `remark`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
	('aaaa', '2022-05-25', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
	('VMS-202206-0001', '2022-06-15', 'dalam negeri', 'VIS001', 'PRE/150622/0001', 'FIN/150622/0001', 'PRP001', 'Robby Refta A', 'KTP', '123912398147', 'Maruko', '08123456124', 'C-0002', 'N5311TM', 'VHC004', 'Honda CB', '4', 'UM001', 'SIM C', '1231312412321314', '2022-06-23', 'Pak D', '32', 'PCR', 'Non Reaktif / Negatif', '2022-06-06', '2022-06-12', 'OK', 'OK', 'vms_pic/VMS-202206-0001.jpg', 'vms_doc/VMS-202206-0001.jpg', '12345', '2022-06-15 15:55:45', NULL, '123456789', '2022-06-17 11:25:16', NULL, NULL, NULL, 2, 1, 0, NULL, '2022-06-15 15:55:45', '422915', '2022-06-17 14:02:29', '422915'),
	('VMS-202206-0002', '2022-06-15', 'dalam negeri', 'VIS001', 'PRE/150622/0001', 'FIN/150622/0001', 'PRP001', 'Robby Refta A', 'KTP', '123912398147', 'Kobo Chan', '08123456124', 'C-0002', 'N5311TM', 'VHC004', 'Honda CB', '4', 'UM001', 'SIM C', '1231312412321314', '2022-06-23', 'Pak D', '32', 'PCR', 'Non Reaktif / Negatif', '2022-06-06', '2022-06-12', 'OK', 'OK', 'vms_pic/VMS-202206-0001.jpg', 'vms_doc/VMS-202206-0001.jpg', '12345', '2022-06-15 15:55:45', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2022-06-15 15:55:45', '422915', '2022-06-17 13:53:52', '422915');
/*!40000 ALTER TABLE `t_vms` ENABLE KEYS */;

-- Dumping structure for table vms.users_log
CREATE TABLE IF NOT EXISTS `users_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `ip_adress` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `trans_type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vms.users_log: ~142 rows (approximately)
/*!40000 ALTER TABLE `users_log` DISABLE KEYS */;
INSERT INTO `users_log` (`log_id`, `description`, `ip_adress`, `user_id`, `created_date`, `created_by`, `module`, `trans_type`) VALUES
	(40, 'Edit Company - C-0001', '192.168.10.11', '422915', '2022-05-30 11:36:56', '422915', 'Master', 'Edit'),
	(42, 'Hapus Company - C-0002', '192.168.10.11', '422915', '2022-05-30 11:40:17', '422915', 'Master', 'Hapus'),
	(43, 'Hapus Company - C-0002', '192.168.10.11', '422915', '2022-05-30 11:40:41', '422915', 'Master', 'Hapus'),
	(44, 'Edit Company - C-0002', '192.168.10.11', '422915', '2022-05-30 11:40:46', '422915', 'Master', 'Edit'),
	(45, 'Hapus Company - C-0002', '192.168.10.11', '422915', '2022-05-30 11:40:51', '422915', 'Master', 'Hapus'),
	(46, 'Hapus Company - C-0002', '192.168.10.11', '422915', '2022-05-30 11:41:39', '422915', 'Master', 'Hapus'),
	(47, 'Edit Company - C-0001', '192.168.10.11', '422915', '2022-05-30 11:44:06', '422915', 'Master', 'Edit'),
	(48, 'Hapus Company - C-0002', '192.168.10.11', '422915', '2022-05-30 11:44:22', '422915', 'Master', 'Hapus'),
	(49, 'Edit Company - C-0001', '192.168.10.11', '422915', '2022-05-30 11:45:18', '422915', 'Master', 'Edit'),
	(50, 'Edit Company - C-0001', '192.168.10.11', '422915', '2022-05-30 11:45:24', '422915', 'Master', 'Edit'),
	(51, 'Tambah Company Type - ', '192.168.10.11', '422915', '2022-05-30 12:01:19', '422915', 'Master', 'Tambah'),
	(52, 'Tambah Company Type - ', '192.168.10.11', '422915', '2022-05-30 12:01:43', '422915', 'Master', 'Tambah'),
	(53, 'Tambah Company Type - CT-12', '192.168.10.11', '422915', '2022-05-30 12:02:17', '422915', 'Master', 'Tambah'),
	(54, 'Tambah Company Type - CT-12', '192.168.10.11', '422915', '2022-05-30 12:02:30', '422915', 'Master', 'Tambah'),
	(55, 'Tambah Company Type - CT-12', '192.168.10.11', '422915', '2022-05-30 12:02:51', '422915', 'Master', 'Tambah'),
	(56, 'Edit Company Type - CT-121212', '192.168.10.11', '422915', '2022-05-30 12:03:42', '422915', 'Master', 'Edit'),
	(57, 'Edit Company Type - CT-1212', '192.168.10.11', '422915', '2022-05-30 12:04:07', '422915', 'Master', 'Edit'),
	(58, 'Edit Company Type - CT-1212', '192.168.10.11', '422915', '2022-05-30 12:04:30', '422915', 'Master', 'Edit'),
	(59, 'Edit Company Type - CT-1212', '192.168.10.11', '422915', '2022-05-30 12:04:43', '422915', 'Master', 'Edit'),
	(60, 'Edit Company Type - CT-1212', '192.168.10.11', '422915', '2022-05-30 12:05:20', '422915', 'Master', 'Edit'),
	(61, 'Edit Company Type - CT-1212', '192.168.10.11', '422915', '2022-05-30 12:05:49', '422915', 'Master', 'Edit'),
	(62, 'Edit Company - C-00012', '192.168.10.11', '422915', '2022-05-30 13:12:33', '422915', 'Master', 'Edit'),
	(63, 'Edit Company - C-00012', '192.168.10.11', '422915', '2022-05-30 13:16:26', '422915', 'Master', 'Edit'),
	(64, 'Edit Company - C-0001', '192.168.10.11', '422915', '2022-05-30 13:17:41', '422915', 'Master', 'Edit'),
	(65, 'Edit Company Type - CT-12', '192.168.10.11', '422915', '2022-05-30 13:17:50', '422915', 'Master', 'Edit'),
	(66, 'Edit Company Type - CT-12', '192.168.10.11', '422915', '2022-05-30 13:18:44', '422915', 'Master', 'Edit'),
	(67, 'Edit Company Type - CT-12', '192.168.10.11', '422915', '2022-05-30 13:19:17', '422915', 'Master', 'Edit'),
	(68, 'Edit Company Type - CT-1234', '192.168.10.11', '422915', '2022-05-30 13:19:26', '422915', 'Master', 'Edit'),
	(69, 'Edit Company Type - CT-01', '192.168.10.11', '422915', '2022-05-30 13:23:03', '422915', 'Master', 'Edit'),
	(70, 'Edit Company Type - CT-01', '192.168.10.11', '422915', '2022-05-30 13:23:08', '422915', 'Master', 'Edit'),
	(71, 'Hapus Company Type - CT-1234', '192.168.10.11', '422915', '2022-05-30 13:24:08', '422915', 'Master', 'Hapus'),
	(72, 'Edit Company Type - CT-12', '192.168.10.11', '422915', '2022-05-30 13:24:24', '422915', 'Master', 'Edit'),
	(73, 'Hapus Company Type - CT-12', '192.168.10.11', '422915', '2022-05-30 13:24:30', '422915', 'Master', 'Hapus'),
	(74, 'Tambah Department - ', '192.168.10.11', '422915', '2022-05-30 13:42:30', '422915', 'Master', 'Tambah'),
	(75, 'Tambah Department - 3', '192.168.10.11', '422915', '2022-05-30 13:43:05', '422915', 'Master', 'Tambah'),
	(76, 'Edit Department - 12', '192.168.10.11', '422915', '2022-05-30 13:48:24', '422915', 'Master', 'Edit'),
	(77, 'Edit Department - 1', '192.168.10.11', '422915', '2022-05-30 13:48:42', '422915', 'Master', 'Edit'),
	(78, 'Hapus Department - 3', '192.168.10.11', '422915', '2022-05-30 13:50:08', '422915', 'Master', 'Hapus'),
	(79, 'Edit Department - 3', '192.168.10.11', '422915', '2022-05-30 13:51:12', '422915', 'Master', 'Edit'),
	(80, 'Tambah Division - 1.2', '192.168.10.11', '422915', '2022-05-30 14:45:48', '422915', 'Master', 'Tambah'),
	(81, 'Tambah Division - 1.3', '192.168.10.11', '422915', '2022-05-30 14:46:55', '422915', 'Master', 'Tambah'),
	(82, 'Edit Division - 1', '192.168.10.11', '422915', '2022-05-30 14:52:39', '422915', 'Master', 'Edit'),
	(83, 'Edit Division - IT Div', '192.168.10.11', '422915', '2022-05-30 14:54:25', '422915', 'Master', 'Edit'),
	(84, 'Edit Division - 1.1', '192.168.10.11', '422915', '2022-05-30 14:54:53', '422915', 'Master', 'Edit'),
	(85, 'Edit Division - 1.1', '192.168.10.11', '422915', '2022-05-30 14:55:04', '422915', 'Master', 'Edit'),
	(86, 'Hapus Division - 1.3', '192.168.10.11', '422915', '2022-05-30 14:58:10', '422915', 'Master', 'Hapus'),
	(87, 'Edit Division - 1.1', '192.168.10.11', '422915', '2022-05-30 14:58:17', '422915', 'Master', 'Edit'),
	(88, 'Hapus Division - 1.1', '192.168.10.11', '422915', '2022-05-30 15:02:18', '422915', 'Master', 'Hapus'),
	(89, 'Hapus Division - 1.1', '192.168.10.11', '422915', '2022-05-30 15:02:44', '422915', 'Master', 'Hapus'),
	(90, 'Hapus Division - 1.2', '192.168.10.11', '422915', '2022-05-30 15:02:54', '422915', 'Master', 'Hapus'),
	(91, 'Tambah Level - lvl02', '192.168.10.11', '422915', '2022-05-30 15:41:45', '422915', 'Master', 'Tambah'),
	(92, 'Edit Level - lvl022', '192.168.10.11', '422915', '2022-05-30 15:46:30', '422915', 'Master', 'Edit'),
	(93, 'Edit Level - lvl02', '192.168.10.11', '422915', '2022-05-30 15:46:41', '422915', 'Master', 'Edit'),
	(94, 'Hapus Level - lvl02', '192.168.10.11', '422915', '2022-05-30 15:47:41', '422915', 'Master', 'Hapus'),
	(95, 'Tambah Level - lvl01', '192.168.10.11', '422915', '2022-05-30 16:58:52', '422915', 'Master', 'Tambah'),
	(96, 'User login', '192.168.10.11', '422915', '2022-05-31 09:02:11', '422915', 'Login', 'Login'),
	(97, 'Edit Employees - lvl02', '192.168.10.11', '422915', '2022-05-31 09:09:04', '422915', 'Master', 'Edit'),
	(98, 'Edit Employees - lvl02', '192.168.10.11', '422915', '2022-05-31 09:10:10', '422915', 'Master', 'Edit'),
	(99, 'Edit Employees - 422123223', '192.168.10.11', '422915', '2022-05-31 09:10:42', '422915', 'Master', 'Edit'),
	(100, 'Edit Employees - 422123223', '192.168.10.11', '422915', '2022-05-31 09:13:19', '422915', 'Master', 'Edit'),
	(101, 'Hapus Employees - 422123223', '192.168.10.11', '422915', '2022-05-31 09:13:28', '422915', 'Master', 'Hapus'),
	(102, 'Tambah Card - 12345', '192.168.10.11', '422915', '2022-05-31 09:55:33', '422915', 'Master', 'Tambah'),
	(103, 'Tambah Card - 12345', '192.168.10.11', '422915', '2022-05-31 09:56:02', '422915', 'Master', 'Tambah'),
	(104, 'Edit Card - 2', '192.168.10.11', '422915', '2022-05-31 10:00:07', '422915', 'Master', 'Edit'),
	(105, 'Edit Card - 2', '192.168.10.11', '422915', '2022-05-31 10:01:11', '422915', 'Master', 'Edit'),
	(106, 'Edit Card - 2', '192.168.10.11', '422915', '2022-05-31 10:01:21', '422915', 'Master', 'Edit'),
	(107, 'Hapus Card - 2', '192.168.10.11', '422915', '2022-05-31 10:02:58', '422915', 'Master', 'Hapus'),
	(108, 'Tambah Key - Ruang IT Server', '192.168.10.11', '422915', '2022-05-31 11:11:06', '422915', 'Master', 'Tambah'),
	(109, 'Edit Key - 2', '192.168.10.11', '422915', '2022-05-31 11:15:07', '422915', 'Master', 'Edit'),
	(110, 'Edit Key - 1', '192.168.10.11', '422915', '2022-05-31 11:24:41', '422915', 'Master', 'Edit'),
	(111, 'Edit Key - 1', '192.168.10.11', '422915', '2022-05-31 11:24:57', '422915', 'Master', 'Edit'),
	(112, 'Hapus Key - 2', '192.168.10.11', '422915', '2022-05-31 11:26:51', '422915', 'Master', 'Hapus'),
	(113, 'Tambah Unit Measurement - ', '192.168.10.11', '422915', '2022-05-31 11:55:22', '422915', 'Master', 'Tambah'),
	(114, 'Edit Unit Measurement - UM002', '192.168.10.11', '422915', '2022-05-31 11:58:52', '422915', 'Master', 'Edit'),
	(115, 'Tambah Unit Measurement - UM003', '192.168.10.11', '422915', '2022-05-31 11:59:38', '422915', 'Master', 'Tambah'),
	(116, 'Edit Unit Measurement - UM003', '192.168.10.11', '422915', '2022-05-31 11:59:44', '422915', 'Master', 'Edit'),
	(117, 'Edit Unit Measurement - UM003', '192.168.10.11', '422915', '2022-05-31 11:59:50', '422915', 'Master', 'Edit'),
	(118, 'Edit Unit Measurement - UM0033', '192.168.10.11', '422915', '2022-05-31 12:02:10', '422915', 'Master', 'Edit'),
	(119, 'Hapus Unit Measurement - UM0033', '192.168.10.11', '422915', '2022-05-31 12:02:22', '422915', 'Master', 'Hapus'),
	(120, 'Hapus Unit Measurement - UM0033', '192.168.10.11', '422915', '2022-05-31 12:02:42', '422915', 'Master', 'Hapus'),
	(121, 'User login', '192.168.10.11', '422915', '2022-05-31 13:10:34', '422915', 'Login', 'Login'),
	(122, 'Edit Unit Measurement - UM003', '192.168.10.11', '422915', '2022-05-31 13:24:49', '422915', 'Master', 'Edit'),
	(123, 'Tambah Vehicle - UM003', '192.168.10.11', '422915', '2022-05-31 14:04:42', '422915', 'Master', 'Tambah'),
	(124, 'Tambah Vehicle - UM003', '192.168.10.11', '422915', '2022-05-31 14:05:58', '422915', 'Master', 'Tambah'),
	(125, 'Edit Vehicle - UM001', '192.168.10.11', '422915', '2022-05-31 14:10:15', '422915', 'Master', 'Edit'),
	(126, 'Edit Vehicle - UM003', '192.168.10.11', '422915', '2022-05-31 14:10:38', '422915', 'Master', 'Edit'),
	(127, 'Hapus Vehicle - VHC003', '192.168.10.11', '422915', '2022-05-31 14:10:58', '422915', 'Master', 'Hapus'),
	(128, 'Edit Vehicle - UM003', '192.168.10.11', '422915', '2022-05-31 14:11:07', '422915', 'Master', 'Edit'),
	(129, 'Tambah Visitor Type - ', '192.168.10.11', '422915', '2022-05-31 15:09:21', '422915', 'Master', 'Tambah'),
	(130, 'Tambah Visitor Type - VIS003', '192.168.10.11', '422915', '2022-05-31 15:10:00', '422915', 'Master', 'Tambah'),
	(131, 'Edit Visitor Type - ', '192.168.10.11', '422915', '2022-05-31 15:11:06', '422915', 'Master', 'Edit'),
	(132, 'Hapus Visitor Type - VIS003', '192.168.10.11', '422915', '2022-05-31 15:13:11', '422915', 'Master', 'Hapus'),
	(133, 'Edit Visitor Type - VIS001', '192.168.10.11', '422915', '2022-05-31 15:13:17', '422915', 'Master', 'Edit'),
	(134, 'Tambah Purpose - PRP003', '192.168.10.11', '422915', '2022-05-31 15:30:42', '422915', 'Master', 'Tambah'),
	(135, 'Tambah Purpose - PRP003', '192.168.10.11', '422915', '2022-05-31 15:31:08', '422915', 'Master', 'Tambah'),
	(136, 'Edit Purpose - PRP003', '192.168.10.11', '422915', '2022-05-31 15:31:50', '422915', 'Master', 'Edit'),
	(137, 'Edit Purpose - PRP003', '192.168.10.11', '422915', '2022-05-31 15:31:57', '422915', 'Master', 'Edit'),
	(138, 'Hapus Purpose - PRP003', '192.168.10.11', '422915', '2022-05-31 15:32:01', '422915', 'Master', 'Hapus'),
	(139, 'Edit Purpose - PRP003', '192.168.10.11', '422915', '2022-05-31 15:32:11', '422915', 'Master', 'Edit'),
	(140, 'Edit Purpose - PRP0033', '192.168.10.11', '422915', '2022-05-31 15:32:15', '422915', 'Master', 'Edit'),
	(141, 'Edit Purpose - PRP003', '192.168.10.11', '422915', '2022-05-31 15:32:24', '422915', 'Master', 'Edit'),
	(142, 'User login', '192.168.10.11', '422915', '2022-06-06 10:12:11', '422915', 'Login', 'Login'),
	(143, 'User login', '192.168.10.11', '422915', '2022-06-07 08:40:22', '422915', 'Login', 'Login'),
	(144, 'User login', '192.168.10.11', '422915', '2022-06-09 08:38:24', '422915', 'Login', 'Login'),
	(145, 'User login', '192.168.10.11', '422915', '2022-06-10 08:35:42', '422915', 'Login', 'Login'),
	(146, 'User login', '192.168.10.11', '422915', '2022-06-10 13:10:08', '422915', 'Login', 'Login'),
	(147, 'User login', '192.168.10.11', '422915', '2022-06-10 17:08:24', '422915', 'Login', 'Login'),
	(148, 'User login', '192.168.10.11', '422915', '2022-06-14 08:31:10', '422915', 'Login', 'Login'),
	(149, 'Tambah Vehicle - VHC004', '192.168.10.11', '422915', '2022-06-14 11:21:41', '422915', 'Master', 'Tambah'),
	(150, 'Tambah Vehicle - VHC005', '192.168.10.11', '422915', '2022-06-14 11:22:08', '422915', 'Master', 'Tambah'),
	(151, 'Tambah Card - 12345', '192.168.10.11', '422915', '2022-06-14 11:25:18', '422915', 'Master', 'Tambah'),
	(152, 'User login', '192.168.10.8', '422915', '2022-06-14 14:43:45', '422915', 'Login', 'Login'),
	(153, 'User logout', '192.168.10.11', 'Robby Refta', '2022-06-14 15:44:47', 'Robby Refta', 'VMS', 'Logout'),
	(154, 'User login', '192.168.10.11', '422915', '2022-06-14 15:44:54', '422915', 'Login', 'Login'),
	(155, 'User logout', '192.168.10.8', 'Robby Refta', '2022-06-14 15:53:54', 'Robby Refta', 'VMS', 'Logout'),
	(156, 'User login', '192.168.10.8', '422915', '2022-06-14 15:54:02', '422915', 'Login', 'Login'),
	(157, 'User login', '192.168.10.11', '422915', '2022-06-15 13:56:11', '422915', 'Login', 'Login'),
	(158, 'User login', '192.168.10.8', '422915', '2022-06-15 14:14:50', '422915', 'Login', 'Login'),
	(159, 'User login', '192.168.10.11', '422915', '2022-06-15 14:15:17', '422915', 'Login', 'Login'),
	(160, 'User login', '192.168.10.11', '422915', '2022-06-15 14:17:02', '422915', 'Login', 'Login'),
	(161, 'User login', '192.168.10.11', '422915', '2022-06-15 14:17:26', '422915', 'Login', 'Login'),
	(162, 'User login', '192.168.10.11', '422915', '2022-06-15 14:39:02', '422915', 'Login', 'Login'),
	(163, 'Kode = VMS-202206-0001', '192.168.10.11', 'Robby Refta', '2022-06-15 15:39:18', 'Robby Refta', 'VMS', 'Checkin Outside'),
	(164, 'Kode = VMS-202206-0001', '192.168.10.11', 'Robby Refta', '2022-06-15 15:44:35', 'Robby Refta', 'VMS', 'Checkin Outside'),
	(165, 'Kode = VMS-202206-0001', '192.168.10.11', 'Robby Refta', '2022-06-15 15:45:40', 'Robby Refta', 'VMS', 'Checkin Outside'),
	(166, 'Kode = VMS-202206-0001', '192.168.10.11', 'Robby Refta', '2022-06-15 15:48:16', 'Robby Refta', 'VMS', 'Checkin Outside'),
	(167, 'Kode = VMS-202206-0001', '192.168.10.11', 'Robby Refta', '2022-06-15 15:55:45', 'Robby Refta', 'VMS', 'Checkin Outside'),
	(168, 'User login', '192.168.10.11', '422915', '2022-06-16 08:36:41', '422915', 'Login', 'Login'),
	(169, 'User login', '192.168.10.11', '422915', '2022-06-16 11:06:23', '422915', 'Login', 'Login'),
	(170, 'User login', '192.168.10.11', '422915', '2022-06-16 11:06:27', '422915', 'Login', 'Login'),
	(171, 'User login', '192.168.10.11', '422915', '2022-06-16 13:17:55', '422915', 'Login', 'Login'),
	(172, 'User login', '192.168.10.11', '422915', '2022-06-16 13:31:47', '422915', 'Login', 'Login'),
	(173, 'Kode = VMS-202206-0001', '192.168.10.11', 'Robby Refta', '2022-06-16 16:04:17', '422915', 'VMS', 'Checkout Outside'),
	(174, 'Kode = VMS-202206-0001', '192.168.10.11', 'Robby Refta', '2022-06-16 16:04:44', '422915', 'VMS', 'Checkout Outside'),
	(175, 'Kode = VMS-202206-0001', '192.168.10.11', 'Robby Refta', '2022-06-16 16:06:13', '422915', 'VMS', 'Checkout Outside'),
	(176, 'Kode = VMS-202206-0001', '192.168.10.11', 'Robby Refta', '2022-06-16 16:07:27', '422915', 'VMS', 'Checkout Outside'),
	(177, 'User login', '192.168.10.11', '422915', '2022-06-17 08:46:17', '422915', 'Login', 'Login'),
	(178, 'User login', '192.168.10.11', '422915', '2022-06-17 13:17:04', '422915', 'Login', 'Login'),
	(179, 'Hapus Visitor Trans - VMS-202206-0002', '192.168.10.11', '422915', '2022-06-17 13:50:56', '422915', 'VMS', 'Hapus'),
	(180, 'Kode = VMS-202206-0002', '192.168.10.11', '422915', '2022-06-17 13:53:52', '422915', 'VMS', 'Hapus'),
	(181, 'Kode = VMS-202206-0001', '192.168.10.11', '422915', '2022-06-17 14:02:29', '422915', 'VMS', 'Hapus'),
	(182, 'User login', '192.168.10.11', '422915', '2022-06-17 14:23:13', '422915', 'Login', 'Login');
/*!40000 ALTER TABLE `users_log` ENABLE KEYS */;

-- Dumping structure for table vms.version
CREATE TABLE IF NOT EXISTS `version` (
  `seq` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `change_log` text,
  `req_by` varchar(200) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  KEY `Index 1` (`seq`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table vms.version: ~1 rows (approximately)
/*!40000 ALTER TABLE `version` DISABLE KEYS */;
INSERT INTO `version` (`seq`, `version`, `date`, `change_log`, `req_by`, `created_date`, `modified_date`) VALUES
	(1, 'v.1.0.0', '2022-05-25', 'First Development', 'Management', '2021-12-10 15:41:54', '2022-05-25 10:47:28');
/*!40000 ALTER TABLE `version` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
