/*
Navicat MySQL Data Transfer

Source Server         : 139.199.8.42
Source Server Version : 50550
Source Host           : 139.199.8.42:3306
Source Database       : app_test_zf

Target Server Type    : MYSQL
Target Server Version : 50550
File Encoding         : 65001

Date: 2017-02-14 15:23:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pano_user
-- ----------------------------
DROP TABLE IF EXISTS `pano_user`;
CREATE TABLE `pano_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `nick_name` varchar(50) NOT NULL COMMENT '昵称',
  `mobile` varchar(11) NOT NULL DEFAULT '0' COMMENT '手机号码',
  `password` varchar(50) NOT NULL COMMENT '登录密码',
  `head_img` varchar(100) NOT NULL COMMENT '头像',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `token` varchar(32) DEFAULT NULL COMMENT '会话标识',
  `token_expires` int(11) DEFAULT NULL COMMENT 'token过期时间',
  `login_time` datetime DEFAULT NULL COMMENT '登录时间',
  `is_login` tinyint(1) DEFAULT '0' COMMENT '是否登录(0-未登录,1-登录中)',
  `stop` tinyint(1) DEFAULT '0' COMMENT '是否禁用账号0否1是',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile` (`mobile`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='小Q全景用户表';
