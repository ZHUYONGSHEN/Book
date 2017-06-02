/*
Navicat MySQL Data Transfer

Source Server         : 139.199.8.42
Source Server Version : 50550
Source Host           : 139.199.8.42:3306
Source Database       : app_test_zf

Target Server Type    : MYSQL
Target Server Version : 50550
File Encoding         : 65001

Date: 2017-02-14 15:24:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pano_feedback
-- ----------------------------
DROP TABLE IF EXISTS `pano_feedback`;
CREATE TABLE `pano_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(500) DEFAULT '' COMMENT '反馈内容',
  `qqaccount` varchar(13) DEFAULT '' COMMENT 'qq账号(联系方式,可选填)',
  `create_time` int(11) DEFAULT '0' COMMENT '反馈时间(时间戳)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='小Q全景用户反馈表';
