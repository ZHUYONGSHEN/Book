/*
Navicat MySQL Data Transfer

Source Server         : 139.199.8.42
Source Server Version : 50550
Source Host           : 139.199.8.42:3306
Source Database       : app_test_zf

Target Server Type    : MYSQL
Target Server Version : 50550
File Encoding         : 65001

Date: 2017-02-14 15:29:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mobile_verify_code
-- ----------------------------
DROP TABLE IF EXISTS `mobile_verify_code`;
CREATE TABLE `mobile_verify_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) DEFAULT '0' COMMENT '验证码类型：1 小Q全景,............',
  `mobile` varchar(11) DEFAULT '0' COMMENT '手机号码',
  `verify_code` int(11) DEFAULT '0' COMMENT '验证码',
  `verify_time` int(11) DEFAULT '0' COMMENT '过期时间',
  `create_time` datetime DEFAULT NULL COMMENT '请求时间',
  `request_ip` varchar(20) DEFAULT '' COMMENT '客户端IP',
  PRIMARY KEY (`id`),
  KEY `mobile` (`mobile`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='手机验证码数据表';
