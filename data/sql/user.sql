/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : nigel

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-07-19 17:39:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `uniq` varchar(60) DEFAULT NULL,
  `active` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `user_ip` varchar(40) DEFAULT NULL,
  `login_count` smallint(5) unsigned DEFAULT NULL,
  `head_img` varchar(60) DEFAULT NULL,
  `person_info` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '18300093372', '123456', null, null, null, null, null, null, null, 'nigel.jpg', null);
INSERT INTO `user` VALUES ('4', 'nigel11', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('70', 'nigel_jack', '11', null, null, '1149828479@qq.com', '1149828479', null, null, null, null, '1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com');
INSERT INTO `user` VALUES ('71', 'ksks', '12', null, null, '1149828479@qq.com', '1149828479', null, null, null, null, '1149828479@qq.com1149828479@qq.com1149828479@qq.com1149828479@qq.com');
INSERT INTO `user` VALUES ('72', 'blackjack3', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('73', 'blackjack4', '13', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('74', 'blackjack5', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('75', 'blackjack6', '14', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('76', 'blackjack7', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('77', 'blackjack8', '15', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('78', 'blackjack9', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('79', 'blackjack10', '16', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('80', 'blackjack11', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('81', 'blackjack12', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('82', 'blackjack13', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('83', 'blackjack14', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('84', 'blackjack15', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('85', 'blackjack16', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('86', 'blackjack17', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('87', 'blackjack18', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('88', 'blackjack19', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('89', 'blackjack20', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('90', 'blackjack21', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('91', 'blackjack22', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('92', 'blackjack23', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('93', 'blackjack24', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('94', 'blackjack25', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('95', 'blackjack26', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('96', 'blackjack27', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('97', 'blackjack28', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('98', 'blackjack29', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('99', 'blackjack30', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('100', 'blackjack31', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('101', 'blackjack32', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('102', 'blackjack33', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('103', 'blackjack34', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('104', 'blackjack35', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('105', 'blackjack36', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('106', 'blackjack37', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('107', 'blackjack38', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('108', 'blackjack39', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('109', 'blackjack40', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('110', 'blackjack41', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('111', 'blackjack42', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('112', 'blackjack43', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('113', 'blackjack93', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('114', 'blackjack45', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('115', 'blackjack46', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('116', 'blackjack47', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('117', 'blackjack48', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('118', 'blackjack49', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('119', 'blackjack50', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('120', 'blackjack51', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('121', 'blackjack52', '11', null, null, null, null, null, null, null, 'e1112dbe1ae3f19008cc3576cf73bcf7.jpg', null);
INSERT INTO `user` VALUES ('122', 'blackjack53', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('123', 'blackjack54', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('124', 'blackjack55', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('125', 'blackjack56', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('126', 'blackjack57', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('127', 'blackjack58', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('128', 'blackjack59', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('129', 'blackjack60', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('130', 'blackjack61', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('131', 'blackjack62', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('132', 'blackjack63', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('133', 'blackjack64', '11', null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('134', 'nigel_blackjack1111', '11', '63079099190dd749df5bf9f4983c0180', '6719dbf212c1786905d8af312b571036', '1149828479@qq.com', '1149828479', '2017-07-10 14:17:25', 'localhost', '3', '874d4c6669cdd471f9976784d63f8e3e.jpg', '114982847911498284791149828479114982847911498284791149828479114982847911498284791149828479');
INSERT INTO `user` VALUES ('135', 'luoxianglian_nigel', '11', '4344904264b5b073e96d5a496440677c', '38a027db6b5c8717e0c665fa5076b663', '1149828479@qq.com', '1149828479', '2017-07-10 14:30:45', 'localhost', '13', '7fef8f4218dd3b4b48729252a275fbdd.jpg', 'modifySuccessModalmodifySuccessModalmodifySuccessModalmodifySuccessModalmodifySuccessModalmodifySuccessModalmodifySuccessModalmodifySuccessModalmodifySuccessModal');
