/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : internet

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-05-22 16:01:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('admin', '1', 'e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for courses
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of courses
-- ----------------------------
INSERT INTO `courses` VALUES ('1', '课程呦', '2016-05-22', '2016-05-31', '博文楼', '1', '50', '0');
INSERT INTO `courses` VALUES ('2', '人数测试', '2016-05-24', '2016-05-26', '阿萨德', '1', '50', '1');

-- ----------------------------
-- Table structure for student
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
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('1', 'student', 'e10adc3949ba59abbe56e057f20f883e', '1001');
INSERT INTO `student` VALUES ('2', 'student1', 'e10adc3949ba59abbe56e057f20f883e', '1001');
INSERT INTO `student` VALUES ('3', 'student2', 'e10adc3949ba59abbe56e057f20f883e', '1001');
INSERT INTO `student` VALUES ('4', 'student3', 'e10adc3949ba59abbe56e057f20f883e', '1001');
INSERT INTO `student` VALUES ('5', 'student4', 'e10adc3949ba59abbe56e057f20f883e', '1001');
INSERT INTO `student` VALUES ('6', 'student5', 'e10adc3949ba59abbe56e057f20f883e', '1001');
INSERT INTO `student` VALUES ('7', 'student6', 'e10adc3949ba59abbe56e057f20f883e', '1001');
INSERT INTO `student` VALUES ('8', 'student7', 'e10adc3949ba59abbe56e057f20f883e', '1001');
INSERT INTO `student` VALUES ('9', 'student8', 'e10adc3949ba59abbe56e057f20f883e', '1001');
INSERT INTO `student` VALUES ('10', 'student9', 'e10adc3949ba59abbe56e057f20f883e', '1001');
INSERT INTO `student` VALUES ('11', 'student10', 'e10adc3949ba59abbe56e057f20f883e', '1001');

-- ----------------------------
-- Table structure for student_courses
-- ----------------------------
DROP TABLE IF EXISTS `student_courses`;
CREATE TABLE `student_courses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `courses_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_courses
-- ----------------------------
INSERT INTO `student_courses` VALUES ('6', '2', '1', null);

-- ----------------------------
-- Table structure for teacher
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `job_number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES ('1', 'teacher', 'e10adc3949ba59abbe56e057f20f883e', '1001');
