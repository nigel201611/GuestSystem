/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : nigel

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-07-23 19:48:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_username` varchar(100) DEFAULT NULL,
  `comment_title` varchar(100) DEFAULT NULL,
  `comment_content` longtext,
  `comment_date` datetime DEFAULT NULL,
  `comment_count` int(11) DEFAULT '0',
  `article_id` int(11) DEFAULT NULL,
  `article_username` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('8', '18300093372', 'dsfsfsdf', 'sdds<img src=\"img/arclist/41.gif\" border=\"0\" />', '2017-07-23 17:50:46', '0', '17', 'luoxianglian_nigel');
INSERT INTO `comment` VALUES ('9', '18300093372', 'dsfsfsdf', 'sdsd<img src=\"img/arclist/29.gif\" border=\"0\" />', '2017-07-23 18:01:57', '0', '17', 'luoxianglian_nigel');
INSERT INTO `comment` VALUES ('10', '18300093372', 'dsfsfsdf', 'sdssd<img src=\"img/arclist/59.gif\" border=\"0\" />', '2017-07-23 18:02:17', '0', '17', 'luoxianglian_nigel');
INSERT INTO `comment` VALUES ('11', '18300093372', 'dsfsfsdf', 'sdds<img src=\"img/arclist/28.gif\" border=\"0\" />', '2017-07-23 18:18:05', '0', '17', 'luoxianglian_nigel');
INSERT INTO `comment` VALUES ('12', '18300093372', 'dsfsfsdf', 'dss<img src=\"img/arclist/29.gif\" border=\"0\" />', '2017-07-23 18:18:38', '0', '17', 'luoxianglian_nigel');
INSERT INTO `comment` VALUES ('13', '18300093372', 'dsfsfsdf', 'sds<img src=\"img/arclist/44.gif\" border=\"0\" />', '2017-07-23 18:23:45', '0', '17', 'luoxianglian_nigel');
INSERT INTO `comment` VALUES ('14', '18300093372', 'dsfsfsdf', 'dds<img src=\"img/arclist/28.gif\" border=\"0\" />', '2017-07-23 18:25:03', '0', '17', 'luoxianglian_nigel');
INSERT INTO `comment` VALUES ('15', '18300093372', '我的第一个帖子', 'dssdsdss<img src=\"img/arclist/29.gif\" border=\"0\" />', '2017-07-23 18:27:11', '0', '1', 'luoxianglian_nigeldsdsdsdsd');
INSERT INTO `comment` VALUES ('16', '18300093372', '我的第三个帖子', 'ds<img src=\"img/arclist/28.gif\" border=\"0\" />', '2017-07-23 19:10:24', '0', '3', 'luoxianglian_nigeldsdsdsdsd');
INSERT INTO `comment` VALUES ('17', '18300093372', 'dsfsfsdf', 'dssd<img src=\"img/arclist/41.gif\" border=\"0\" />', '2017-07-23 19:24:08', '0', '17', 'luoxianglian_nigel');
INSERT INTO `comment` VALUES ('18', '18300093372', 'dsfsfsdf', 'dssddsd<img src=\"img/arclist/29.gif\" border=\"0\" />', '2017-07-23 19:35:03', '0', '17', 'luoxianglian_nigel');
INSERT INTO `comment` VALUES ('19', '18300093372', '我的第一个帖子', 'sssd<img src=\"img/arclist/29.gif\" border=\"0\" />', '2017-07-23 19:35:43', '0', '1', 'luoxianglian_nigeldsdsdsdsd');
INSERT INTO `comment` VALUES ('20', '18300093372', '我的第一个帖子', 'sssd<img src=\"img/arclist/29.gif\" border=\"0\" /><img src=\"img/arclist/13.gif\" border=\"0\" />', '2017-07-23 19:35:54', '0', '1', 'luoxianglian_nigeldsdsdsdsd');
INSERT INTO `comment` VALUES ('21', '18300093372', '我的第一个帖子', 'sss<img src=\"img/arclist/14.gif\" border=\"0\" />', '2017-07-23 19:38:06', '0', '1', 'luoxianglian_nigeldsdsdsdsd');
INSERT INTO `comment` VALUES ('22', '18300093372', '我的第一个帖子', 'sdsd<img src=\"img/arclist/44.gif\" border=\"0\" /><img src=\"img/arclist/57.gif\" border=\"0\" />', '2017-07-23 19:42:39', '0', '1', 'luoxianglian_nigeldsdsdsdsd');
INSERT INTO `comment` VALUES ('23', '18300093372', '我的第一个帖子', '<img src=\"img/arclist/29.gif\" border=\"0\" /><img src=\"img/arclist/60.gif\" border=\"0\" />', '2017-07-23 19:42:51', '0', '1', 'luoxianglian_nigeldsdsdsdsd');
INSERT INTO `comment` VALUES ('24', '18300093372', '我的第一个帖子', 'sdsdssd<img src=\"img/arclist/13.gif\" border=\"0\" />', '2017-07-23 19:43:50', '0', '1', 'luoxianglian_nigeldsdsdsdsd');
