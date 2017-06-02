/*
Navicat MySQL Data Transfer

Source Server         : 139.199.8.42
Source Server Version : 50550
Source Host           : 139.199.8.42:3306
Source Database       : app_test_zf

Target Server Type    : MYSQL
Target Server Version : 50550
File Encoding         : 65001

Date: 2017-02-23 18:47:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pano_custom
-- ----------------------------
DROP TABLE IF EXISTS `pano_custom`;
CREATE TABLE `pano_custom` (
  `cid` int(11) NOT NULL AUTO_INCREMENT COMMENT '客户档案id',
  `custom_name` varchar(100) NOT NULL COMMENT '客户姓名',
  `custom_mobile` varchar(11) NOT NULL COMMENT '客户电话',
  `house_name` varchar(150) NOT NULL COMMENT '楼盘名称',
  `house_building` varchar(50) NOT NULL COMMENT '栋座',
  `house_cell` varchar(50) NOT NULL COMMENT '单元',
  `floor` varchar(50) NOT NULL COMMENT '楼层',
  `room_no` varchar(50) NOT NULL COMMENT '房间号',
  `user_id` int(11) NOT NULL COMMENT '创建人',
  `add_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  PRIMARY KEY (`cid`),
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='小Q全景客户档案信息表';
