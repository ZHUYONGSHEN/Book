/*
Navicat MySQL Data Transfer

Source Server         : 139.199.8.42
Source Server Version : 50550
Source Host           : 139.199.8.42:3306
Source Database       : app_test_zf

Target Server Type    : MYSQL
Target Server Version : 50550
File Encoding         : 65001

Date: 2017-02-14 15:24:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pano_issue_category
-- ----------------------------
DROP TABLE IF EXISTS `pano_issue_category`;
CREATE TABLE `pano_issue_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(30) DEFAULT '' COMMENT '分类标题',
  `cat_thumb` varchar(100) DEFAULT '' COMMENT '分类缩略图',
  `priority` enum('1','2','3','4','5') DEFAULT '1',
  `status` enum('0','1') DEFAULT '1' COMMENT '启用状态',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='小Q全景问题分类表';
