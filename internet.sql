/*
 Navicat Premium Data Transfer

 Source Server         : internet
 Source Server Type    : MariaDB
 Source Server Version : 100023
 Source Host           : 127.0.0.1
 Source Database       : internet

 Target Server Type    : MariaDB
 Target Server Version : 100023
 File Encoding         : utf-8

 Date: 05/22/2016 21:32:08 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `admin`
-- ----------------------------
BEGIN;
INSERT INTO `admin` VALUES ('admin', '1', 'e10adc3949ba59abbe56e057f20f883e');
COMMIT;

-- ----------------------------
--  Table structure for `courses`
-- ----------------------------
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `begintime` date NOT NULL,
  `endtime` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '可选数量',
  `has_num` int(11) NOT NULL DEFAULT '0' COMMENT '已选人数',
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `courses`
-- ----------------------------
BEGIN;
INSERT INTO `courses` VALUES ('1', '这个不是课程', '2016-05-22', '2016-05-31', '博文楼', '1', '50', '2', '星期二 上午 1 2 节'), ('2', '人数测试', '2016-05-24', '2016-05-26', '阿萨德', '1', '50', '1', '星期三 上午 1 2 节'), ('3', '双节棍', '2016-05-22', '2016-05-28', '精武馆', '2', '50', '0', '星期四 上午 1 2 节');
COMMIT;

-- ----------------------------
--  Table structure for `student`
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '姓名',
  `password` varchar(64) NOT NULL COMMENT '密码',
  `student_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `student`
-- ----------------------------
BEGIN;
INSERT INTO `student` VALUES ('1', 'student', 'e10adc3949ba59abbe56e057f20f883e', '1001'), ('2', 'student1', 'e10adc3949ba59abbe56e057f20f883e', '1001'), ('3', 'student2', 'e10adc3949ba59abbe56e057f20f883e', '1001'), ('4', 'student3', 'e10adc3949ba59abbe56e057f20f883e', '1001'), ('5', 'student4', 'e10adc3949ba59abbe56e057f20f883e', '1001'), ('6', 'student5', 'e10adc3949ba59abbe56e057f20f883e', '1001'), ('7', 'student6', 'e10adc3949ba59abbe56e057f20f883e', '1001'), ('8', 'student7', 'e10adc3949ba59abbe56e057f20f883e', '1001'), ('9', 'student8', 'e10adc3949ba59abbe56e057f20f883e', '1001'), ('10', 'student9', 'e10adc3949ba59abbe56e057f20f883e', '1001'), ('11', 'student10', 'e10adc3949ba59abbe56e057f20f883e', '1001');
COMMIT;

-- ----------------------------
--  Table structure for `student_courses`
-- ----------------------------
DROP TABLE IF EXISTS `student_courses`;
CREATE TABLE `student_courses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `courses_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `student_courses`
-- ----------------------------
BEGIN;
INSERT INTO `student_courses` VALUES ('6', '2', '1', null), ('7', '1', '3', null), ('8', '1', '3', null);
COMMIT;

-- ----------------------------
--  Table structure for `teacher`
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `job_number` int(11) NOT NULL,
  `introduction` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `teacher`
-- ----------------------------
BEGIN;
INSERT INTO `teacher` VALUES ('1', 'teacher', 'e10adc3949ba59abbe56e057f20f883e', '1001', '无名教师'), ('2', '霍元甲', 'e10adc3949ba59abbe56e057f20f883e', '89757', '一代武林宗师，天下无敌手'), ('3', '迪迦奥特曼', 'e10adc3949ba59abbe56e057f20f883e', '89756', '奥特之星的守护者，为了人类而战');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
