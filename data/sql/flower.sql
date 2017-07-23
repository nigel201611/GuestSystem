/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : nigel

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-07-23 19:48:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for flower
-- ----------------------------
DROP TABLE IF EXISTS `flower`;
CREATE TABLE `flower` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user` varchar(100) DEFAULT NULL,
  `from_user` varchar(100) DEFAULT NULL,
  `flower_date` datetime DEFAULT NULL,
  `flower_content` text,
  `flower_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of flower
-- ----------------------------
INSERT INTO `flower` VALUES ('1', 'nigel11', '18300093372', '2017-07-19 17:38:20', 'dsdss', '3');
INSERT INTO `flower` VALUES ('2', 'nigel11', '18300093372sdsdffsd', '2017-07-21 12:00:41', 'sdfdssd', '8');
INSERT INTO `flower` VALUES ('3', 'nigel11', '18300093372sdsdffsd', '2017-07-21 16:55:43', 'dsfsdssd', '9');
INSERT INTO `flower` VALUES ('4', 'blackjack4', '18300093372sdsdffsd', '2017-07-21 16:56:09', 'sdfdsfd', '9');
INSERT INTO `flower` VALUES ('5', '18300093372sdsdffsdsd', '18300093372', '2017-07-22 12:40:06', 'dssd', '8');
