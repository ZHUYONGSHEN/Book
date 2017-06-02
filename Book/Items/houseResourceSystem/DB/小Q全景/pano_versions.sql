/*
Navicat MySQL Data Transfer

Source Server         : 139.199.8.42
Source Server Version : 50550
Source Host           : 139.199.8.42:3306
Source Database       : app_test_zf

Target Server Type    : MYSQL
Target Server Version : 50550
File Encoding         : 65001

Date: 2017-02-23 18:50:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pano_versions
-- ----------------------------
DROP TABLE IF EXISTS `pano_versions`;
CREATE TABLE `pano_versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version_code` int(11) DEFAULT '0' COMMENT '版本码',
  `version` varchar(11) DEFAULT '' COMMENT '版本号',
  `type` tinyint(1) DEFAULT '1' COMMENT 'app类型:1-安卓  2-苹果',
  `create_time` int(11) DEFAULT NULL,
  `url` varchar(100) DEFAULT '' COMMENT '下载链接',
  `version_content` varchar(500) NOT NULL COMMENT '更新内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='小Q全景版本管理';
