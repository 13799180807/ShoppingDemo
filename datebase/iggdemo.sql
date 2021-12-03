/*
 Navicat Premium Data Transfer

 Source Server         : localhost3306
 Source Server Type    : MySQL
 Source Server Version : 80017
 Source Host           : localhost:3306
 Source Schema         : iggdemo

 Target Server Type    : MySQL
 Target Server Version : 80017
 File Encoding         : 65001

 Date: 03/12/2021 16:25:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_goods
-- ----------------------------
DROP TABLE IF EXISTS `tb_goods`;
CREATE TABLE `tb_goods`  (
  `goods_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品的ID',
  `goods_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品名称',
  `goods_category_id` int(11) NOT NULL COMMENT '商品的分类',
  `goods_price` decimal(10, 2) NOT NULL COMMENT '商品价格',
  `goods_stock` int(11) NOT NULL DEFAULT 0 COMMENT '商品库存',
  `goods_status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '商品状态{默认1上架，0下架}',
  `goods_hot` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否热门(默认0否，1是)',
  `goods_recommend` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否推荐（默认0否，1是）',
  `goods_describe` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '简单商品描述',
  `goods_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品主图',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`goods_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_goods_category
-- ----------------------------
DROP TABLE IF EXISTS `tb_goods_category`;
CREATE TABLE `tb_goods_category`  (
  `goods_category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品分类ID',
  `goods_category_name` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '分类名称',
  PRIMARY KEY (`goods_category_id`) USING BTREE,
  UNIQUE INDEX `name`(`goods_category_name`) USING BTREE COMMENT '分类名称唯一性'
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_goods_introduce
-- ----------------------------
DROP TABLE IF EXISTS `tb_goods_introduce`;
CREATE TABLE `tb_goods_introduce`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NULL DEFAULT NULL COMMENT '商品的id',
  `goods_introduce` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '具体描述',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_goods_picture
-- ----------------------------
DROP TABLE IF EXISTS `tb_goods_picture`;
CREATE TABLE `tb_goods_picture`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL COMMENT '商品的id',
  `goods_picture_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品的图片',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_manage
-- ----------------------------
DROP TABLE IF EXISTS `tb_manage`;
CREATE TABLE `tb_manage`  (
  `manage_id` int(16) NOT NULL COMMENT '管理员账号',
  `manage_pwd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '管理员密码',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`manage_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user`  (
  `user_id` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户账号',
  `user_pwd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户密码',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
