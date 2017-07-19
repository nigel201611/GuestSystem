/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : nigel

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-07-19 17:39:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for friend
-- ----------------------------
DROP TABLE IF EXISTS `friend`;
CREATE TABLE `friend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user` varchar(100) DEFAULT NULL,
  `from_user` varchar(100) DEFAULT NULL,
  `friend_date` datetime DEFAULT NULL,
  `friend_content` text,
  `friend_state` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of friend
-- ----------------------------
INSERT INTO `friend` VALUES ('4', 'nigel11', 'blackjack15', '2017-07-16 17:14:35', 'dssd', '0');
INSERT INTO `friend` VALUES ('5', 'nigel11', 'luoxianglian_nigel', '2017-07-17 10:12:28', 'hello', '0');
INSERT INTO `friend` VALUES ('6', '18300093372', 'luoxianglian_nigel', '2017-07-17 10:13:22', 'HELLO', '1');
INSERT INTO `friend` VALUES ('9', '18300093372', 'luoxianglian_nigel', '2017-07-17 10:24:36', 'dsd', '1');
