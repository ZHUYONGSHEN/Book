/*
Navicat MySQL Data Transfer

Source Server         : 139.199.8.42
Source Server Version : 50550
Source Host           : 139.199.8.42:3306
Source Database       : app_test_zf

Target Server Type    : MYSQL
Target Server Version : 50550
File Encoding         : 65001

Date: 2017-02-14 15:29:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mobile_ip_record
-- ----------------------------
DROP TABLE IF EXISTS `mobile_ip_record`;
CREATE TABLE `mobile_ip_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) DEFAULT '0' COMMENT '手机验证码平台请求类型： 1:小Q全景',
  `request_ip` varchar(20) DEFAULT '' COMMENT '客户端IP',
  `create_time` datetime DEFAULT NULL COMMENT '请求开始',
  PRIMARY KEY (`id`),
  KEY `request_ip` (`request_ip`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='手机验证码ip请求记录表';
