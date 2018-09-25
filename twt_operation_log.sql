/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : party

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-09-25 16:41:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for twt_operation_log
-- ----------------------------
DROP TABLE IF EXISTS `twt_operation_log`;
CREATE TABLE `twt_operation_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL COMMENT '用户id',
  `path` varchar(255) NOT NULL COMMENT '路由',
  `method` varchar(255) NOT NULL COMMENT '方法',
  `ip` varchar(255) NOT NULL COMMENT 'ip地址',
  `created_at` datetime DEFAULT NULL COMMENT '时间',
  `updated_at` datetime DEFAULT NULL,
  `input` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
