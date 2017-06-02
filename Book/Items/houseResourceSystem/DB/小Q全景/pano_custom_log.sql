/*
Navicat MySQL Data Transfer

Source Server         : 139.199.8.42
Source Server Version : 50550
Source Host           : 139.199.8.42:3306
Source Database       : app_test_zf

Target Server Type    : MYSQL
Target Server Version : 50550
File Encoding         : 65001

Date: 2017-02-14 15:23:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pano_custom_log
-- ----------------------------
DROP TABLE IF EXISTS `pano_custom_log`;
CREATE TABLE `pano_custom_log` (
  `clid` int(11) NOT NULL AUTO_INCREMENT COMMENT '跟踪记录id',
  `custom_log` varchar(200) NOT NULL COMMENT '跟进信息',
  `cid` int(11) NOT NULL COMMENT '客户档案id',
  `user_id` int(11) NOT NULL COMMENT '添加人',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  PRIMARY KEY (`clid`),
  KEY `cid` (`cid`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='小Q全景客户档案跟进记录表';
