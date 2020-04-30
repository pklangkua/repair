/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : repair

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-04-30 15:34:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `CustomerID` varchar(4) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `CountryCode` varchar(2) NOT NULL,
  `Budget` double NOT NULL,
  `Used` double NOT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('C001', 'Win Weerachai', 'win.weerachai@thaicreate.com', 'TH', '1000000', '600000');
INSERT INTO `customer` VALUES ('C002', 'John  Smith', 'john.smith@thaicreate.com', 'EN', '2000000', '800000');
INSERT INTO `customer` VALUES ('C003', 'Jame Born', 'jame.born@thaicreate.com', 'US', '3000000', '600000');
INSERT INTO `customer` VALUES ('C004', 'Chalee Angel', 'chalee.angel@thaicreate.com', 'US', '4000000', '100000');

-- ----------------------------
-- Table structure for r_category
-- ----------------------------
DROP TABLE IF EXISTS `r_category`;
CREATE TABLE `r_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT 0,
  `topic` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of r_category
-- ----------------------------
INSERT INTO `r_category` VALUES ('1', 'repairstatus', '1', 'แจ้งซ่อม', '#660000', '1');
INSERT INTO `r_category` VALUES ('2', 'repairstatus', '2', 'กำลังดำเนินการ', '#120eeb', '1');
INSERT INTO `r_category` VALUES ('3', 'repairstatus', '3', 'รออะไหล่', '#d940ff', '1');
INSERT INTO `r_category` VALUES ('4', 'repairstatus', '4', 'ซ่อมสำเร็จ', '#06d628', '1');
INSERT INTO `r_category` VALUES ('5', 'repairstatus', '5', 'ซ่อมไม่สำเร็จ', '#FF0000', '1');
INSERT INTO `r_category` VALUES ('6', 'repairstatus', '6', 'ยกเลิกการซ่อม', '#FF6F00', '1');
INSERT INTO `r_category` VALUES ('7', 'repairstatus', '7', 'ส่งมอบเรียบร้อย', '#000000', '1');
INSERT INTO `r_category` VALUES ('8', 'model_id', '2', 'Asus', '', '1');
INSERT INTO `r_category` VALUES ('9', 'type_id', '3', 'โปรเจ็คเตอร์', '', '1');
INSERT INTO `r_category` VALUES ('10', 'type_id', '2', 'เครื่องพิมพ์', '', '1');
INSERT INTO `r_category` VALUES ('11', 'model_id', '3', 'Cannon', '', '1');
INSERT INTO `r_category` VALUES ('12', 'category_id', '1', 'เครื่องใช้ไฟฟ้า', '', '1');
INSERT INTO `r_category` VALUES ('13', 'category_id', '2', 'วัสดุสำนักงาน', '', '1');
INSERT INTO `r_category` VALUES ('14', 'model_id', '1', 'Apple', '', '1');
INSERT INTO `r_category` VALUES ('15', 'type_id', '1', 'เครื่องคอมพิวเตอร์', '', '1');
INSERT INTO `r_category` VALUES ('16', 'model_id', '4', 'ACER', '', '1');
INSERT INTO `r_category` VALUES ('17', 'type_id', '4', 'จอมอนิเตอร์', '', '1');

-- ----------------------------
-- Table structure for r_inventory
-- ----------------------------
DROP TABLE IF EXISTS `r_inventory`;
CREATE TABLE `r_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `serial` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `type_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of r_inventory
-- ----------------------------
INSERT INTO `r_inventory` VALUES ('1', 'จอมอนิเตอร์ ACER S220HQLEBD', '1108-365D', '0000-00-00 00:00:00', '4', '4', '1');
INSERT INTO `r_inventory` VALUES ('2', 'ASUS A550JX', '0000-0001', '0000-00-00 00:00:00', '1', '2', '1');
INSERT INTO `r_inventory` VALUES ('3', 'Crucial 4GB DDR3L&amp;1600 SODIMM', 'IF111/036/1', '2018-08-28 19:49:33', '1', '4', '3');

-- ----------------------------
-- Table structure for r_language
-- ----------------------------
DROP TABLE IF EXISTS `r_language`;
CREATE TABLE `r_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `owner` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `js` tinyint(1) NOT NULL,
  `th` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `en` text COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of r_language
-- ----------------------------

-- ----------------------------
-- Table structure for r_office
-- ----------------------------
DROP TABLE IF EXISTS `r_office`;
CREATE TABLE `r_office` (
  `OfficeID` int(11) NOT NULL,
  `OfficeCode` varchar(255) DEFAULT NULL,
  `OrganizationID` int(11) DEFAULT NULL,
  `OfficeName` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `ProvinceID` int(11) DEFAULT NULL,
  `DistrictID` int(11) DEFAULT NULL,
  `TambonID` int(11) DEFAULT NULL,
  `Latitude` varchar(255) DEFAULT NULL,
  `Longitude` varchar(255) DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL,
  `IsApproved` char(2) DEFAULT NULL,
  PRIMARY KEY (`OfficeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of r_office
-- ----------------------------
INSERT INTO `r_office` VALUES ('1', 'C001', '1', 'กองยุทธศาสตร์และแผนงาน', null, null, null, null, '13.848230', '100.530110', 'https://www.plan.dmh.go.th', '1');
INSERT INTO `r_office` VALUES ('2', 'C002', '1', 'กองส่งเสริมและพัฒนาสุขภาพจิต', null, null, null, null, '13.848230', '100.530221', 'https://www.sorporsor.com', '1');
INSERT INTO `r_office` VALUES ('3', 'C003', '1', 'กองบริหารระบบบริการสุขภาพจิต', null, null, null, null, '13.848230', '100.530332', 'https://www.prdmh.com', '1');
INSERT INTO `r_office` VALUES ('4', 'C004', '1', 'กองบริหารทรัพยากรบุคคล', null, null, null, null, '13.848230', '100.530443', 'https://www.hr.dmh.go.th', '1');
INSERT INTO `r_office` VALUES ('5', 'C005', '1', 'สำนักงานเลขานุการกรม', null, null, null, null, '13.848230', '100.530554', 'http://www.secret.dmh.go.th', '1');
INSERT INTO `r_office` VALUES ('6', 'C006', '1', 'กองบริหารการคลัง', null, null, null, null, '13.848230', '100.530665', 'https://www.finance.dmh.go.th', '1');
INSERT INTO `r_office` VALUES ('7', 'C007', '1', 'กลุ่มพัฒนาระบบบริหาร', null, null, null, null, '13.848230', '100.530776', 'https://www.psdg.dmh.go.th', '1');
INSERT INTO `r_office` VALUES ('8', 'C008', '1', 'กลุ่มตรวจสอบภายใน', null, null, null, null, '13.848230', '100.530887', 'https://www.audit.dmh.go.th', '1');
INSERT INTO `r_office` VALUES ('9', 'C009', '1', 'สำนักงานโครงการ TO BE NUMBER ONE', null, null, null, null, '13.848230', '100.530998', 'https://www.tobenumber1.net', '1');
INSERT INTO `r_office` VALUES ('10', 'C010', '1', 'กลุ่มคุ้มครองจริยธรรม', null, null, null, null, '13.848230', '100.530109', 'https://www.ethicsdmh.com', '1');
INSERT INTO `r_office` VALUES ('11', 'C011', '1', 'สำนักงานจริยธรรมการวิจัยในคนด้านสุขภาพจิตและจิตเวช', null, null, null, null, '13.848230', '100.530211', 'http://www.ethicsdmh.com/', '1');
INSERT INTO `r_office` VALUES ('12', 'C012', '1', 'สำนักงานวิเทศสัมพันธ์', null, null, null, null, '13.848230', '100.530322', 'http://www.oia.dmh.go.th', '1');
INSERT INTO `r_office` VALUES ('13', 'C013', '1', 'สำนักเทคโนโลยีสารสนเทศ', null, null, null, null, '13.848230', '100.530433', 'http://www.ict.dmh.go.th', '1');
INSERT INTO `r_office` VALUES ('14', 'C014', '1', 'สำนักวิชาการสุขภาพจิต', null, null, null, null, '13.848230', '100.530544', 'http://www.dmh.go.th', '1');
INSERT INTO `r_office` VALUES ('15', 'H001', '2', 'โรงพยาบาลศรีธัญญา', null, null, null, null, '13.845552', '100.517221', 'http://www.srithanya.go.th', '1');
INSERT INTO `r_office` VALUES ('16', 'H002', '2', 'โรงพยาบาลสวนสราญรมย์', null, null, null, null, '9.108707', '99.239851', 'http://www.suansaranrom.go.th', '1');
INSERT INTO `r_office` VALUES ('17', 'H003', '2', 'สถาบันจิตเวชศาสตร์สมเด็จเจ้าพระยา', null, null, null, null, '13.730860', '100.505253', 'http://www.somdet.go.th', '1');
INSERT INTO `r_office` VALUES ('18', 'H004', '2', 'โรงพยาบาลพระศรีมหาโพธิ์', null, null, null, null, '15.251125', '104.841349', 'http://www.prasri.go.th', '1');
INSERT INTO `r_office` VALUES ('19', 'H005', '2', 'โรงพยาบาลสวนปรุง', null, null, null, null, '18.781038', '98.979199', 'http://www.suanprung.go.th', '1');
INSERT INTO `r_office` VALUES ('20', 'H006', '2', 'สถาบันราชานุกูล', null, null, null, null, '13.761220', '100.554307', 'http://www.rajanukul.go.th', '1');
INSERT INTO `r_office` VALUES ('21', 'H007', '2', 'โรงพยาบาลจิตเวชสงขลาราชนครินทร์', null, null, null, null, '7.178595', '100.613521', 'http://www.skph.go.th', '1');
INSERT INTO `r_office` VALUES ('22', 'H008', '2', 'สถาบันกัลยาณ์ราชนครินทร์', null, null, null, null, '13.763074', '100.330901', 'http://www.galya.go.th', '1');
INSERT INTO `r_office` VALUES ('23', 'H009', '2', 'โรงพยาบาลจิตเวชนครราชสีมาราชนครินทร์', null, null, null, null, '14.984362', '102.104975', 'http://www.jvkorat.go.th', '1');
INSERT INTO `r_office` VALUES ('24', 'H010', '2', 'โรงพยาบาลจิตเวชนครสวรรค์ราชนครินทร์', null, null, null, null, '14.984455', '102.104911', 'http://www.nph.go.th', '1');
INSERT INTO `r_office` VALUES ('25', 'H011', '2', 'โรงพยาบาลยุวประสาทไวทโยปถัมภ์', null, null, null, null, '13.614648', '100.593629', 'http://www.ycap.go.th/th', '1');
INSERT INTO `r_office` VALUES ('26', 'H012', '2', 'โรงพยาบาลจิตเวชเลยราชนครินทร์', null, null, null, null, '17.458691', '101.710189', 'http://www.rploei.go.th', '1');
INSERT INTO `r_office` VALUES ('27', 'H013', '2', 'สถาบันพัฒนาการเด็กราชนครินทร์', null, null, null, null, '18.850262', '98.961721', 'http://www.ricd.go.th', '1');
INSERT INTO `r_office` VALUES ('28', 'H014', '2', 'สถาบันสุขภาพจิตเด็กและวัยรุ่นภาคตะวันออกเฉียงเหนือ', null, null, null, null, '16.403784', '102.858976', 'http://www.necam.go.th', '1');
INSERT INTO `r_office` VALUES ('29', 'H015', '2', 'สถาบันสุขภาพจิตเด็กและวัยรุ่นภาคใต้', null, null, null, null, '9.109618', '99.239357', 'http://www.sicam.go.th', '1');
INSERT INTO `r_office` VALUES ('30', 'H016', '2', 'โรงพยาบาลจิตเวชพิษณุโลก', null, null, null, null, '16.869803', '100.670323', 'http://www.pph.go.th', '1');
INSERT INTO `r_office` VALUES ('31', 'H017', '2', 'โรงพยาบาลจิตเวชขอนแก่นราชนครินทร์', null, null, null, null, '16.424226', '102.848459', 'http://www.jvkk.go.th', '1');
INSERT INTO `r_office` VALUES ('32', 'H018', '2', 'โรงพยาบาลจิตเวชสระแก้วราชนครินทร์', null, null, null, null, '13.836548', '102.372096', 'http://www.jvsakaeo.go.th', '1');
INSERT INTO `r_office` VALUES ('33', 'H019', '2', 'โรงพยาบาลจิตเวชนครพนมราชนครินทร์', null, null, null, null, '17.484869', '104.718918', 'http://www.aec.jvnkp.net', '1');
INSERT INTO `r_office` VALUES ('34', 'H020', '2', 'สถาบันสุขภาพจิตเด็กและวัยรุ่นราชนครินทร์ ', null, null, null, null, '13.766225', '100.527761', 'http://www.smartteen.net', '1');
INSERT INTO `r_office` VALUES ('35', 'Z001', '3', 'ศูนย์สุขภาพจิตที่ 1', null, null, null, null, '13.846759', '100.516882', 'http://www.mhc01.net', '1');
INSERT INTO `r_office` VALUES ('36', 'Z002', '3', 'ศูนย์สุขภาพจิตที่ 2', null, null, null, null, '16.866566', '100.669779', 'http://www.mhc2.go.th', '1');
INSERT INTO `r_office` VALUES ('37', 'Z003', '3', 'ศูนย์สุขภาพจิตที่ 3', null, null, null, null, '15.423617', '100.146507', 'http://www.mhc03.go.th', '1');
INSERT INTO `r_office` VALUES ('38', 'Z004', '3', 'ศูนย์สุขภาพจิตที่ 4', null, null, null, null, '13.993899', '100.578894', 'http://www.mhcr4.go.th', '1');
INSERT INTO `r_office` VALUES ('39', 'Z005', '3', 'ศูนย์สุขภาพจิตที่ 5', null, null, null, null, '13.531727', '99.823474', 'http://www.mhc5.net', '1');
INSERT INTO `r_office` VALUES ('40', 'Z006', '3', 'ศูนย์สุขภาพจิตที่ 6', null, null, null, null, '13.328895', '13.328895', 'http://www.mhc06.org', '1');
INSERT INTO `r_office` VALUES ('41', 'Z007', '3', 'ศูนย์สุขภาพจิตที่ 7', null, null, null, null, '16.425990', '102.848071', 'http://www.mhc7.go.th', '1');
INSERT INTO `r_office` VALUES ('42', 'Z008', '3', 'ศูนย์สุขภาพจิตที่ 8', null, null, null, null, '17.268975', '102.880033', 'http://www.mhc8.go.th', '1');
INSERT INTO `r_office` VALUES ('43', 'Z009', '3', 'ศูนย์สุขภาพจิตที่ 9', null, null, null, null, '14.983434', '102.104872', 'http://www.mhc9dmh.com', '1');
INSERT INTO `r_office` VALUES ('44', 'Z010', '3', 'ศูนย์สุขภาพจิตที่ 10', null, null, null, null, '18.776204', '98.978015', 'http://www.mhc10.go.th', '1');
INSERT INTO `r_office` VALUES ('45', 'Z011', '3', 'ศูนย์สุขภาพจิตที่ 11', null, null, null, null, '9.110452', '99.238940', 'http://www.mhc011dmh.com', '1');
INSERT INTO `r_office` VALUES ('46', 'Z012', '3', 'ศูนย์สุขภาพจิตที่ 12', null, null, null, null, '7.180751', '100.613428', 'http://www.mhc12.go.th', '1');
INSERT INTO `r_office` VALUES ('47', 'Z013', '3', 'ศูนย์สุขภาพจิตที่ 13', null, null, null, null, '13.726216', '100.515811', 'http://www.sites.google.com/view/newmhc13-dmh', '1');

-- ----------------------------
-- Table structure for r_repair
-- ----------------------------
DROP TABLE IF EXISTS `r_repair`;
CREATE TABLE `r_repair` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `job_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `job_description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  `appointment_date` date DEFAULT NULL,
  `appraiser` decimal(10,2) NOT NULL DEFAULT 0.00,
  `repair_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `job_id` (`job_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of r_repair
-- ----------------------------
INSERT INTO `r_repair` VALUES ('1', '1', '2', '5e8c1bc647cc1', 'tsttttt', '2020-04-07 13:20:54', null, '0.00', null);

-- ----------------------------
-- Table structure for r_repair_status
-- ----------------------------
DROP TABLE IF EXISTS `r_repair_status`;
CREATE TABLE `r_repair_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `repair_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `member_id` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`),
  KEY `repair_id` (`repair_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of r_repair_status
-- ----------------------------
INSERT INTO `r_repair_status` VALUES ('1', '1', '1', '0', 'ttt', '1', '2020-04-07 13:20:54', '0.00');
INSERT INTO `r_repair_status` VALUES ('3', '1', '2', '1', '', '1', '2020-04-08 12:23:51', '0.00');
INSERT INTO `r_repair_status` VALUES ('4', '1', '1', '3', '', '3', '2020-04-08 12:48:44', '0.00');
INSERT INTO `r_repair_status` VALUES ('5', '1', '3', '3', '', '3', '2020-04-08 12:49:17', '0.00');

-- ----------------------------
-- Table structure for r_status
-- ----------------------------
DROP TABLE IF EXISTS `r_status`;
CREATE TABLE `r_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of r_status
-- ----------------------------
INSERT INTO `r_status` VALUES ('1', 'ผู้ดูแลระบบ');
INSERT INTO `r_status` VALUES ('2', 'ช่างซ่อม');
INSERT INTO `r_status` VALUES ('3', 'ผู้ใช้งาน');

-- ----------------------------
-- Table structure for r_user
-- ----------------------------
DROP TABLE IF EXISTS `r_user`;
CREATE TABLE `r_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `OfficeID` int(50) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT 3,
  `permission` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `sex` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_card` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provinceID` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visited` int(11) DEFAULT 0,
  `lastvisit_login` datetime DEFAULT NULL,
  `session_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `social` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of r_user
-- ----------------------------
INSERT INTO `r_user` VALUES ('10', 'pradit_k', null, 'สำนักเทคโนโลยีสารสนเทศ', '13', '1', null, 'ประดิษฐ์ เกลี้ยงเกื้อ', null, null, null, null, null, null, null, null, '0', '2020-04-30 12:26:04', null, null, '2020-04-22 10:22:29', '1', '0');
INSERT INTO `r_user` VALUES ('21', 'guest30', null, 'สำรองใช้งาน', '5', '3', null, 'guest30', null, null, null, null, null, null, null, null, '0', '2020-04-30 09:27:40', null, null, '2020-04-24 09:52:16', '1', '0');
INSERT INTO `r_user` VALUES ('22', 'elham36', null, 'สำนักเทคโนโลยีสารสนเทศ', '13', '1', null, 'อิลฮัม มุสะอะรง', null, null, null, null, null, null, null, null, '0', '2020-04-30 11:08:15', null, null, '2020-04-30 10:21:11', '1', '0');
