/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : nigel

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-07-19 17:39:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user` varchar(100) DEFAULT NULL,
  `from_user` varchar(100) DEFAULT NULL,
  `message_date` datetime DEFAULT NULL,
  `message_content` text,
  `message_state` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('5', '18300093372', 'luoxianglian_nigel', '2017-07-12 22:13:46', 'ssdsdsd', '1');
INSERT INTO `message` VALUES ('6', 'nigel11', 'luoxianglian_nigel', '2017-07-13 09:36:10', 'hello world', '0');
INSERT INTO `message` VALUES ('7', '18300093372', 'luoxianglian_nigel', '2017-07-14 14:31:48', 'dssdsd', '1');
INSERT INTO `message` VALUES ('9', 'luoxianglian_nigel', 'blackjack52', '2017-07-14 16:21:50', 'friends with you', '0');
INSERT INTO `message` VALUES ('10', 'luoxianglian_nigel', 'blackjack52', '2017-07-14 16:21:51', 'friends with you', '0');
INSERT INTO `message` VALUES ('14', 'luoxianglian_nigel', 'blackjack52', '2017-07-14 16:22:14', 'friends with youdsdsss', '0');
INSERT INTO `message` VALUES ('15', 'luoxianglian_nigel', 'blackjack52', '2017-07-14 16:22:15', 'friends with youdsdsss', '0');
INSERT INTO `message` VALUES ('16', 'luoxianglian_nigel', 'blackjack52', '2017-07-14 16:22:16', 'friends with youdsdsss', '0');
INSERT INTO `message` VALUES ('17', 'luoxianglian_nigel', 'blackjack52', '2017-07-14 16:22:17', 'friends with youdsdsss', '0');
INSERT INTO `message` VALUES ('20', 'nigel_blackjack1111', 'luoxianglian_nigel', '2017-07-15 16:44:51', 'test', '0');
INSERT INTO `message` VALUES ('21', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 09:49:53', 'dsfsds', '0');
INSERT INTO `message` VALUES ('22', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 09:57:08', 'dsdsds', '0');
INSERT INTO `message` VALUES ('23', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 09:57:10', 'dsdsds', '0');
INSERT INTO `message` VALUES ('24', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 09:57:11', 'dsdsds', '0');
INSERT INTO `message` VALUES ('25', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 10:05:09', 'sdfdss', '0');
INSERT INTO `message` VALUES ('26', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 10:05:10', 'sdfdss', '0');
INSERT INTO `message` VALUES ('27', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 10:05:11', 'sdfdss', '0');
INSERT INTO `message` VALUES ('28', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 10:05:12', 'sdfdss', '0');
INSERT INTO `message` VALUES ('29', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 10:11:44', 'sddds', '0');
INSERT INTO `message` VALUES ('30', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 11:37:15', 'sds', '0');
INSERT INTO `message` VALUES ('31', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 11:37:39', 'sdss', '0');
INSERT INTO `message` VALUES ('32', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 11:37:40', 'sdss', '0');
INSERT INTO `message` VALUES ('33', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 11:47:00', 'dsdds', '0');
INSERT INTO `message` VALUES ('34', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 11:47:12', 'dsss', '0');
INSERT INTO `message` VALUES ('35', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 11:47:13', 'dsss', '0');
INSERT INTO `message` VALUES ('36', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 11:55:48', 'dsddsds', '0');
INSERT INTO `message` VALUES ('37', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 11:55:58', 'dfsfd', '0');
INSERT INTO `message` VALUES ('38', 'luoxianglian_nigel', 'blackjack15', '2017-07-16 15:08:26', 'dssds', '0');
INSERT INTO `message` VALUES ('39', '18300093372', 'nigel_blackjack1111', '2017-07-18 15:18:16', 'dsfsdfsdfssdfffffffffffffffffffffffffsdfsdfssffssdsdfssfsdsdffsdsdsfsdfsdfssdfffffffffffffffffffffffffsdfsdfssffssdsdfssfsdsdffsdsdffdfssdsfdsdsdfdsfdsfdssdfsfsdfdffdfssdsfdsdsdfdsfdsfdssdfsfsdfdsfsdfsdfssdfffffffffffffffffffffffffsdfsdfssffssdsdfssfsdsdffsdsdffdfssdsfdsdsdfdsfdsfdssdfsfsdfdsfsdfsdfssdfffffffffffffffffffffffffsdfsdfssffssdsdfssfsdsdffsdsdffdfssdsfdsdsdfdsfdsfdssdfsfsdfdsfsdfsdfssdfffffffffffffffffffffffffsdfsdfssffssdsdfssfsdsdffsdsdffdfssdsfdsdsdfdsfdsfdssdfsfsdfdsfsdfsdfssdfffffffffffffffffffffffffsdfsdfssffssdsdfssfsdsdffsdsdffdfssdsfdsdsdfdsfdsfdssdfsfsdfdsfsdfsdfssdfffffffffffffffffffffffffsdfsdfssffssdsdfssfsdsdffsdsdffdfssdsfdsdsdfdsfdsfdssdfsfsdfdsfsdfsdfssdfffffffffffffffffffffffffsdfsdfssffssdsdfssfsdsdffsdsdffdfssdsfdsdsdfdsfdsfdssdfsfsdfdsfsdfsdfssdfffffffffffffffffffffffffsdfsdfssffssdsdfssfsdsdffsdsdffdfssdsfdsdsdfdsfdsfdssdfsfsdf', '1');
