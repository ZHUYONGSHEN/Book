/*
Navicat MySQL Data Transfer

Source Server         : 139.199.8.42
Source Server Version : 50550
Source Host           : 139.199.8.42:3306
Source Database       : app_test_zf

Target Server Type    : MYSQL
Target Server Version : 50550
File Encoding         : 65001

Date: 2017-02-14 15:24:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pano_issue
-- ----------------------------
DROP TABLE IF EXISTS `pano_issue`;
CREATE TABLE `pano_issue` (
  `issue_id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_title` varchar(30) DEFAULT '' COMMENT '问题标题',
  `issue_content` text COMMENT '问题内容',
  `create_time` int(11) DEFAULT '0' COMMENT '创建时间',
  `status` enum('0','1') DEFAULT '1' COMMENT '启用状态',
  `issue_type` enum('common','hot') DEFAULT 'common' COMMENT '问题类型',
  `cat_id` int(11) NOT NULL COMMENT '问题分类ID',
  `priority` enum('1','2','3','4','5') DEFAULT '1' COMMENT '优先级',
  PRIMARY KEY (`issue_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='小Q全景帮助问题表';
