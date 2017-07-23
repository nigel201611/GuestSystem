/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : nigel

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-07-23 19:48:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `pub_title` varchar(255) DEFAULT NULL,
  `pub_date` datetime DEFAULT NULL,
  `pub_content` longtext,
  `pub_readCount` int(11) DEFAULT NULL,
  `pub_commentCount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', 'luoxianglian_nigeldsdsdsdsd', '我的第一个帖子', '2017-07-20 21:19:29', '<p>我的第一个帖子我的第一个帖子我的第一个帖子我的第一个帖子<br></p>', '7', '7');
INSERT INTO `article` VALUES ('2', 'luoxianglian_nigeldsdsdsdsd', '我的第二个帖子', '2017-07-20 21:23:21', '<p>我的第二个帖子我的第二个帖子我的第二个帖子我的第二个帖子我的第二个帖子<img class=\"fr-fin\" data-fr-image-preview=\"false\" alt=\"Image title\" src=\"http://i.froala.com/download/5057a8db859611477dd9f6b88acaa968992d4d69.jpg?1500557007\" width=\"300\">但是是的是的是的·1</p>', '0', '0');
INSERT INTO `article` VALUES ('3', 'luoxianglian_nigeldsdsdsdsd', '我的第三个帖子', '2017-07-20 21:25:54', '<p>我的第三个帖子我的第三个帖子我的第三个帖子我的第三个帖子我的第三个帖子我的第三个帖子<br></p>', '4', '1');
INSERT INTO `article` VALUES ('4', 'luoxianglian_nigeldsdsdsdsd', 'dsdsds', '2017-07-20 21:27:06', '', '0', '0');
INSERT INTO `article` VALUES ('5', 'luoxianglian_nigel', '的实施的快快上课上课2', '2017-07-20 21:32:32', '<p>的说法是是是212啥地方都是</p>', '38', '1');
INSERT INTO `article` VALUES ('6', 'luoxianglian_nigel', 'dssdfsd', '2017-07-20 21:32:43', '<p>sdffasdfsassds</p>', '0', '0');
INSERT INTO `article` VALUES ('7', 'luoxianglian_nigel', 'dsfssdf', '2017-07-20 21:32:52', '<p>dsfsfsdffsddfsdds</p>', '0', '0');
INSERT INTO `article` VALUES ('8', 'luoxianglian_nigel', 'dsdsdf', '2017-07-20 21:33:09', '<p>fdsfdsfssdd</p>', '0', '0');
INSERT INTO `article` VALUES ('9', 'luoxianglian_nigel', 'dsfssdsss', '2017-07-20 21:33:17', '<p>dsfsdsfsfdsdsdsdf</p>', '0', '0');
INSERT INTO `article` VALUES ('10', 'luoxianglian_nigel', 'dsfsfsdsd', '2017-07-20 21:33:23', '<p>sdssdssfsdss</p>', '0', '0');
INSERT INTO `article` VALUES ('11', 'luoxianglian_nigel', 'sdfsdsdd', '2017-07-20 21:33:31', '<p>fdssdfsfssfsd</p>', '0', '0');
INSERT INTO `article` VALUES ('12', 'luoxianglian_nigel', 'sdfsfsfsds', '2017-07-20 21:33:37', '<p>fdsfdsfssssdffss</p>', '0', '0');
INSERT INTO `article` VALUES ('13', 'luoxianglian_nigel', 'fdsfsfsdsd', '2017-07-20 21:34:01', '<p>fsfsdsdfsdfsf</p>', '0', '0');
INSERT INTO `article` VALUES ('14', 'luoxianglian_nigel', 'sfsfssffssfds', '2017-07-20 21:34:07', '<p>fsdfsdsdsfdsdf</p>', '0', '0');
INSERT INTO `article` VALUES ('15', 'luoxianglian_nigel', 'sdfsfsss', '2017-07-20 21:34:14', '<p>fdsfsdsffsssf</p>', '0', '0');
INSERT INTO `article` VALUES ('16', 'luoxianglian_nigel', 'sfsfssdsddfssd', '2017-07-20 21:34:20', '<p>ffsdfsfsdsd</p>', '16', '0');
INSERT INTO `article` VALUES ('17', 'luoxianglian_nigel', 'dsfsfsdf', '2017-07-20 21:34:25', '<p>fdsfsdfdsdss</p>', '32', '3');
INSERT INTO `article` VALUES ('18', 'luoxianglian_nigel', 'dsfsfdsssd', '2017-07-20 21:34:42', '<p>fsfsdsds</p>', '0', '0');
INSERT INTO `article` VALUES ('19', 'luoxianglian_nigel', 'sfsdfdsd', '2017-07-20 21:34:49', '<p>fdsfdsfdsffssds</p>', '0', '0');
INSERT INTO `article` VALUES ('20', 'luoxianglian_nigel', 'dsfsddsd', '2017-07-20 21:34:55', '<p>dsfsdfdsssdss</p>', '0', '0');
INSERT INTO `article` VALUES ('21', 'luoxianglian_nigel', 'fdsffdsdsd', '2017-07-20 21:35:02', '<p>fdsfsdfsdffsfdfddfsd</p>', '0', '0');
INSERT INTO `article` VALUES ('22', '18300093372', 'sdfsdfsd', '2017-07-21 10:39:49', '<p>dfsfsd</p>', '2', '0');
INSERT INTO `article` VALUES ('23', '18300093372', 'dsfsfsds发大幅度肥嘟嘟是地方得到的答复的方法的开发的开放的开发的可靠的放得开开始得到可靠的实施的看的是快速打开开始的看的是快快快的时刻都是开始上课时打开', '2017-07-21 11:29:03', '<p>的所得税的都是</p>', '16', '0');
