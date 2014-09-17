/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : hha

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2014-09-17 18:57:28
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `author` int(11) NOT NULL,
  `body` mediumtext COLLATE utf8_unicode_ci,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `section_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  KEY `date` (`date`),
  KEY `section-id` (`section_id`),
  FULLTEXT KEY `title` (`title`),
  CONSTRAINT `article_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of article
-- ----------------------------

-- ----------------------------
-- Table structure for `auth-group`
-- ----------------------------
DROP TABLE IF EXISTS `auth-group`;
CREATE TABLE `auth-group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of auth-group
-- ----------------------------
INSERT INTO `auth-group` VALUES ('1', '管理员');
INSERT INTO `auth-group` VALUES ('2', '管理员');

-- ----------------------------
-- Table structure for `auth-map`
-- ----------------------------
DROP TABLE IF EXISTS `auth-map`;
CREATE TABLE `auth-map` (
  `group_id` int(10) unsigned NOT NULL,
  `auth_id` int(10) unsigned NOT NULL,
  KEY `group-id` (`group_id`),
  KEY `auth-id` (`auth_id`),
  CONSTRAINT `auth-map_ibfk_1` FOREIGN KEY (`auth_id`) REFERENCES `auth-name` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `group-map_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `auth-group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of auth-map
-- ----------------------------

-- ----------------------------
-- Table structure for `auth-name`
-- ----------------------------
DROP TABLE IF EXISTS `auth-name`;
CREATE TABLE `auth-name` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of auth-name
-- ----------------------------

-- ----------------------------
-- Table structure for `data`
-- ----------------------------
DROP TABLE IF EXISTS `data`;
CREATE TABLE `data` (
  `user_id` int(10) unsigned NOT NULL,
  `key` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`key`),
  CONSTRAINT `data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of data
-- ----------------------------
INSERT INTO `data` VALUES ('154', '姓', '孙', '2014-09-17 18:33:03');

-- ----------------------------
-- Table structure for `item`
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `unit` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `type` tinyint(1) DEFAULT '0',
  `user_group` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_group` (`user_group`),
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`user_group`) REFERENCES `user-group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of item
-- ----------------------------
INSERT INTO `item` VALUES ('3', '睡眠质量', '小时', '1', '8');
INSERT INTO `item` VALUES ('5', '睡眠时间', '小时', '1', '10');
INSERT INTO `item` VALUES ('7', '睡眠时间', '小时', '1', '12');
INSERT INTO `item` VALUES ('9', '睡眠时间', '小时', '1', '14');
INSERT INTO `item` VALUES ('11', '睡眠时间', '小时', '1', '16');
INSERT INTO `item` VALUES ('13', '睡眠时间', '小时', '1', '18');
INSERT INTO `item` VALUES ('15', '睡眠时间', '小时', '1', '20');
INSERT INTO `item` VALUES ('17', '睡眠时间', '小时', '1', '22');
INSERT INTO `item` VALUES ('19', '睡眠时间', '小时', '1', '24');
INSERT INTO `item` VALUES ('21', '睡眠时间', '小时', '1', '26');
INSERT INTO `item` VALUES ('23', '睡眠时间', '小时', '1', '28');
INSERT INTO `item` VALUES ('25', '睡眠时间', '小时', '1', '30');
INSERT INTO `item` VALUES ('27', '睡眠时间', '小时', '1', '32');
INSERT INTO `item` VALUES ('29', '睡眠时间', '小时', '1', '34');
INSERT INTO `item` VALUES ('31', '睡眠时间', '小时', '1', '36');
INSERT INTO `item` VALUES ('33', '睡眠时间', '小时', '1', '38');
INSERT INTO `item` VALUES ('35', '睡眠时间', '小时', '1', '40');
INSERT INTO `item` VALUES ('37', '睡眠时间', '小时', '1', '42');
INSERT INTO `item` VALUES ('39', '睡眠时间', '小时', '1', '44');
INSERT INTO `item` VALUES ('41', '睡眠时间', '小时', '1', '46');
INSERT INTO `item` VALUES ('43', '睡眠时间', '小时', '1', '48');
INSERT INTO `item` VALUES ('45', '睡眠时间', '小时', '1', '50');
INSERT INTO `item` VALUES ('47', '睡眠时间', '小时', '1', '52');
INSERT INTO `item` VALUES ('49', '睡眠时间', '小时', '1', '54');
INSERT INTO `item` VALUES ('51', '睡眠时间', '小时', '1', '56');
INSERT INTO `item` VALUES ('53', '睡眠时间', '小时', '1', '58');
INSERT INTO `item` VALUES ('55', '睡眠时间', '小时', '1', '60');

-- ----------------------------
-- Table structure for `message`
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int(10) unsigned NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `from_id` (`from_id`),
  CONSTRAINT `message_ibfk_2` FOREIGN KEY (`from_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of message
-- ----------------------------

-- ----------------------------
-- Table structure for `message-map`
-- ----------------------------
DROP TABLE IF EXISTS `message-map`;
CREATE TABLE `message-map` (
  `m_id` int(10) unsigned NOT NULL,
  `to_id` int(10) unsigned NOT NULL,
  `read` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`m_id`,`to_id`),
  KEY `message_to_sp` (`to_id`),
  CONSTRAINT `message-map_ibfk_1` FOREIGN KEY (`m_id`) REFERENCES `message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `message_to_sp` FOREIGN KEY (`to_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of message-map
-- ----------------------------

-- ----------------------------
-- Table structure for `relationship`
-- ----------------------------
DROP TABLE IF EXISTS `relationship`;
CREATE TABLE `relationship` (
  `id1` int(10) unsigned NOT NULL,
  `id2` int(10) unsigned NOT NULL,
  `relation` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  KEY `id2` (`id2`),
  KEY `id1` (`id1`),
  CONSTRAINT `relationship_ibfk_1` FOREIGN KEY (`id1`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `relationship_ibfk_2` FOREIGN KEY (`id2`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of relationship
-- ----------------------------

-- ----------------------------
-- Table structure for `section`
-- ----------------------------
DROP TABLE IF EXISTS `section`;
CREATE TABLE `section` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of section
-- ----------------------------

-- ----------------------------
-- Table structure for `survey`
-- ----------------------------
DROP TABLE IF EXISTS `survey`;
CREATE TABLE `survey` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `item` int(10) unsigned NOT NULL,
  `value` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user-id` (`user_id`),
  KEY `item` (`item`),
  KEY `date` (`date`),
  CONSTRAINT `survey_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_ibfk_3` FOREIGN KEY (`item`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of survey
-- ----------------------------
INSERT INTO `survey` VALUES ('1', '154', '49', '哈哈', '2014-09-03 17:18:03');
INSERT INTO `survey` VALUES ('2', '154', '49', '哈哈', '2014-09-03 20:41:01');
INSERT INTO `survey` VALUES ('3', '154', '49', '哈哈', '2014-09-03 20:42:28');
INSERT INTO `survey` VALUES ('4', '154', '49', '哈哈', '2014-09-03 21:06:02');
INSERT INTO `survey` VALUES ('5', '154', '49', '哈哈', '2014-09-03 21:13:44');
INSERT INTO `survey` VALUES ('6', '154', '49', '哈哈', '2014-09-03 21:38:58');
INSERT INTO `survey` VALUES ('7', '154', '49', '哈哈', '2014-09-03 21:59:07');
INSERT INTO `survey` VALUES ('8', '154', '49', '哈哈', '2014-09-03 21:59:26');
INSERT INTO `survey` VALUES ('9', '154', '49', '哈哈', '2014-09-03 22:00:13');
INSERT INTO `survey` VALUES ('10', '154', '49', '哈哈', '2014-09-03 22:00:42');
INSERT INTO `survey` VALUES ('11', '154', '49', '哈哈', '2014-09-03 22:01:51');
INSERT INTO `survey` VALUES ('12', '154', '49', '哈哈', '2014-09-03 22:02:00');
INSERT INTO `survey` VALUES ('13', '154', '49', '哈哈', '2014-09-03 22:02:31');
INSERT INTO `survey` VALUES ('14', '154', '49', '哈哈', '2014-09-03 22:03:00');
INSERT INTO `survey` VALUES ('15', '154', '49', '哈哈', '2014-09-03 22:04:19');
INSERT INTO `survey` VALUES ('16', '154', '49', '哈哈', '2014-09-03 22:04:29');
INSERT INTO `survey` VALUES ('17', '154', '49', '哈哈', '2014-09-03 22:05:19');
INSERT INTO `survey` VALUES ('18', '154', '49', '哈哈', '2014-09-03 22:07:28');

-- ----------------------------
-- Table structure for `survey-simple`
-- ----------------------------
DROP TABLE IF EXISTS `survey-simple`;
CREATE TABLE `survey-simple` (
  `user_id` int(10) unsigned NOT NULL,
  `item` int(10) unsigned NOT NULL,
  `value` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`item`),
  KEY `date` (`date`),
  KEY `item` (`item`),
  CONSTRAINT `survey-simple_ibfk_1` FOREIGN KEY (`item`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey-simple
-- ----------------------------
INSERT INTO `survey-simple` VALUES ('154', '49', '呵呵', '2014-09-03 22:07:28');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_group` int(10) unsigned DEFAULT '1',
  `showname` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '游客',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `auth-group` (`auth_group`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`auth_group`) REFERENCES `auth-group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('50', 'sun_test', '', null, 'sun_test');
INSERT INTO `user` VALUES ('53', 'sun_test28512', '', null, 'sun_test28512');
INSERT INTO `user` VALUES ('60', 'sun_test29240', '', null, 'sun_test29240');
INSERT INTO `user` VALUES ('61', 'sun_test5622', '', null, 'sun_test5622');
INSERT INTO `user` VALUES ('62', 'sun_test5453', '', null, 'sun_test5453');
INSERT INTO `user` VALUES ('63', 'sun_test31410', '', null, 'sun_test31410');
INSERT INTO `user` VALUES ('64', 'sxf', '$2a$12$BIgyndxh3YDMmCynM0niFuodXeCP1y1h1QoqwY1AQkmzL12/xcnGO', null, 'sxf');
INSERT INTO `user` VALUES ('65', 'sun_test22282', '', null, 'sun_test22282');
INSERT INTO `user` VALUES ('66', 'sxfa', '', null, 'sxfa');
INSERT INTO `user` VALUES ('68', 'sxfyy', '$2a$12$O.hnU1du0Xrl5di1m7MqLeLqqynGhS11T3rZPLF1K7Wx5DXToJl6O', null, 'sxfyy');
INSERT INTO `user` VALUES ('69', 'sun_test543', '', null, 'sun_test543');
INSERT INTO `user` VALUES ('70', 'sun_test20040', '', null, 'sun_test20040');
INSERT INTO `user` VALUES ('71', 'sun_test21992', '', null, 'sun_test21992');
INSERT INTO `user` VALUES ('72', 'sun_test23388', '', null, 'sun_test23388');
INSERT INTO `user` VALUES ('73', 'sun_test478', '', null, 'sun_test478');
INSERT INTO `user` VALUES ('74', 'sun_test14299', '', null, 'sun_test14299');
INSERT INTO `user` VALUES ('75', 'sun_test4140', '', null, 'sun_test4140');
INSERT INTO `user` VALUES ('76', 'sun_test14331', '', null, 'sun_test14331');
INSERT INTO `user` VALUES ('77', 'sxfppfa', '', null, 'sxfppfa');
INSERT INTO `user` VALUES ('79', 'sun_test1644', '$2a$12$CQWo9ExYQH70Q2YI7R6ZT..lPp5CRVQ1jmfllwxHkHz4QgPjVK2lq', null, 'sun_test1644');
INSERT INTO `user` VALUES ('80', 'sun_test24723', '', null, 'sun_test24723');
INSERT INTO `user` VALUES ('81', 'sun_test15219', '', null, 'sun_test15219');
INSERT INTO `user` VALUES ('82', 'sun_test28271', '', null, 'sun_test28271');
INSERT INTO `user` VALUES ('83', 'sxfppfar', '$2a$12$6uhduxoqjcGgBDMdhfIwvuRZO1Kb2G.oPLmoizSSa7P7VaRjVCpLC', null, 'sxfppfar');
INSERT INTO `user` VALUES ('84', 'sxfppfarsdssd', '', null, 'sxfppfarsdssd');
INSERT INTO `user` VALUES ('86', 'sxfppfarsds', '', null, 'sxfppfarsds');
INSERT INTO `user` VALUES ('87', 'sxfppfaf', '', null, 'sxfppfaf');
INSERT INTO `user` VALUES ('88', 'faeawef', '', null, 'faeawef');
INSERT INTO `user` VALUES ('89', 'faeww', '', null, 'faeww');
INSERT INTO `user` VALUES ('90', 'faefewaef', '', null, 'faefewaef');
INSERT INTO `user` VALUES ('92', 'abs', '', null, 'abs');
INSERT INTO `user` VALUES ('93', 'abss', '', null, 'abss');
INSERT INTO `user` VALUES ('94', 'absss', '', null, 'absss');
INSERT INTO `user` VALUES ('95', 'asbsss', '$2a$12$YmU0Ej/.B9X8v7wYBB0e1ebxa98D3jDPARicKB2FK1BfUHYV11VNe', null, 'asbsss');
INSERT INTO `user` VALUES ('96', 'ascbsss', '$2a$12$WtQr65N.rwESzsxU2nrz2.VrJAl31fHIltgYmIS1BOfQehstQIEK2', null, 'ascbsss');
INSERT INTO `user` VALUES ('97', 'acscbsss', '', null, 'acscbsss');
INSERT INTO `user` VALUES ('98', 'bbbb', '$2a$12$I.Qy4O5eqLmvqUIDKNYy3.Kz8OX0ktsRfC1m.nBF2NaNovzKwAr/a', null, 'bbbb');
INSERT INTO `user` VALUES ('99', 'bcbbb', '', null, 'bcbbb');
INSERT INTO `user` VALUES ('100', 'bcbbbc', '$2a$12$yF5v95jCjcF89XlOXsBDnOytQxwoCktzQ/Q1ulKHYXr0I42wlFCTW', null, 'bcbbbc');
INSERT INTO `user` VALUES ('101', 'bccbbbc', '', null, 'bccbbbc');
INSERT INTO `user` VALUES ('102', 'bccbppp', '', null, 'bccbppp');
INSERT INTO `user` VALUES ('103', 'bccbpppe', '', null, 'bccbpppe');
INSERT INTO `user` VALUES ('104', 'bcppp', '$2a$12$vIs5yr08MckNyYl85V/qHeCbSNjD8.oeX/gvMOpSOvbH4JodeiHlG', null, 'bcppp');
INSERT INTO `user` VALUES ('105', 'xdef', '', null, 'xdef');
INSERT INTO `user` VALUES ('107', 'cdef', 'asb', null, 'cdef');
INSERT INTO `user` VALUES ('108', 'sun_test22862', '123456', null, 'sun_test22862');
INSERT INTO `user` VALUES ('109', 'sun_test32404', '123456', null, 'sun_test32404');
INSERT INTO `user` VALUES ('110', 'sun_test2807', '123456', null, 'sun_test2807');
INSERT INTO `user` VALUES ('112', 'sun_test27192', '123456', null, 'sun_test27192');
INSERT INTO `user` VALUES ('114', 'sun_test16517', '123456', null, 'sun_test16517');
INSERT INTO `user` VALUES ('116', 'sun_test7745', '123456', null, 'sun_test7745');
INSERT INTO `user` VALUES ('118', 'sun_test18190', '123456', null, 'sun_test18190');
INSERT INTO `user` VALUES ('120', 'sun_test4464', '123456', null, 'sun_test4464');
INSERT INTO `user` VALUES ('122', 'sun_test16849', '123456', null, 'sun_test16849');
INSERT INTO `user` VALUES ('124', 'sun_test7830', '123456', null, 'sun_test7830');
INSERT INTO `user` VALUES ('126', 'sun_test12662', '123456', null, 'sun_test12662');
INSERT INTO `user` VALUES ('128', 'sun_test27098', '123456', null, 'sun_test27098');
INSERT INTO `user` VALUES ('130', 'sun_test20524', '123456', null, 'sun_test20524');
INSERT INTO `user` VALUES ('132', 'sun_test6500', '123456', null, 'sun_test6500');
INSERT INTO `user` VALUES ('134', 'sun_test19528', '123456', null, 'sun_test19528');
INSERT INTO `user` VALUES ('136', 'sun_test17946', '123456', null, 'sun_test17946');
INSERT INTO `user` VALUES ('138', 'sun_test31467', '123456', null, 'sun_test31467');
INSERT INTO `user` VALUES ('140', 'sun_test13029', '123456', null, 'sun_test13029');
INSERT INTO `user` VALUES ('142', 'sun_test14355', '123456', null, 'sun_test14355');
INSERT INTO `user` VALUES ('144', 'sun_test1343', '123456', null, 'sun_test1343');
INSERT INTO `user` VALUES ('146', 'sun_test12946', '123456', null, 'sun_test12946');
INSERT INTO `user` VALUES ('148', 'sun_test19827', '123456', null, 'sun_test19827');
INSERT INTO `user` VALUES ('150', 'sun_test11722', '123456', null, 'sun_test11722');
INSERT INTO `user` VALUES ('152', 'sun_test373', '123456', null, 'sun_test373');
INSERT INTO `user` VALUES ('154', 'test_sun', '123456', null, 'test_sun');
INSERT INTO `user` VALUES ('155', 'test_sun2', '', null, 'test_sun2');

-- ----------------------------
-- Table structure for `user-ext`
-- ----------------------------
DROP TABLE IF EXISTS `user-ext`;
CREATE TABLE `user-ext` (
  `id` int(10) unsigned NOT NULL,
  `realname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user-ext
-- ----------------------------
INSERT INTO `user-ext` VALUES ('154', '孙笑凡', 'sunxfancy@gmail.com', '13141455874', '1', '1993-08-30');

-- ----------------------------
-- Table structure for `user-group`
-- ----------------------------
DROP TABLE IF EXISTS `user-group`;
CREATE TABLE `user-group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of user-group
-- ----------------------------
INSERT INTO `user-group` VALUES ('2', '老年人');
INSERT INTO `user-group` VALUES ('4', '老年人');
INSERT INTO `user-group` VALUES ('6', '老年人');
INSERT INTO `user-group` VALUES ('8', '老年人');
INSERT INTO `user-group` VALUES ('10', '老年人');
INSERT INTO `user-group` VALUES ('12', '老年人');
INSERT INTO `user-group` VALUES ('14', '老年人');
INSERT INTO `user-group` VALUES ('16', '老年人');
INSERT INTO `user-group` VALUES ('18', '老年人');
INSERT INTO `user-group` VALUES ('20', '老年人');
INSERT INTO `user-group` VALUES ('22', '老年人');
INSERT INTO `user-group` VALUES ('24', '老年人');
INSERT INTO `user-group` VALUES ('26', '老年人');
INSERT INTO `user-group` VALUES ('28', '老年人');
INSERT INTO `user-group` VALUES ('30', '老年人');
INSERT INTO `user-group` VALUES ('32', '老年人');
INSERT INTO `user-group` VALUES ('34', '老年人');
INSERT INTO `user-group` VALUES ('36', '老年人');
INSERT INTO `user-group` VALUES ('38', '老年人');
INSERT INTO `user-group` VALUES ('40', '老年人');
INSERT INTO `user-group` VALUES ('42', '老年人');
INSERT INTO `user-group` VALUES ('44', '老年人');
INSERT INTO `user-group` VALUES ('46', '老年人');
INSERT INTO `user-group` VALUES ('48', '老年人');
INSERT INTO `user-group` VALUES ('50', '老年人');
INSERT INTO `user-group` VALUES ('52', '老年人');
INSERT INTO `user-group` VALUES ('54', '老年人');
INSERT INTO `user-group` VALUES ('56', '老年人');
INSERT INTO `user-group` VALUES ('58', '老年人');
INSERT INTO `user-group` VALUES ('60', '老年人');

-- ----------------------------
-- Table structure for `user-map`
-- ----------------------------
DROP TABLE IF EXISTS `user-map`;
CREATE TABLE `user-map` (
  `user_id` int(10) unsigned NOT NULL,
  `user_group_id` int(10) unsigned NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `user_group_id` (`user_group_id`),
  CONSTRAINT `user-map_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user-map_ibfk_2` FOREIGN KEY (`user_group_id`) REFERENCES `user-group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user-map
-- ----------------------------
INSERT INTO `user-map` VALUES ('154', '54');
