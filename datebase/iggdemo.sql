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

 Date: 02/12/2021 17:52:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for shop_sort
-- ----------------------------


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
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_goods
-- ----------------------------
INSERT INTO `tb_goods` VALUES (1, '小猪佩奇', 1, 30.00, 20, 1, 1, 0, '我必须向你解释这一切谴责快乐和赞美痛苦的错误观念是如何产生的，我将给你一个完整的系统说明，并阐述伟大的真理探索者、人类幸福的主要建设者的实际教义。', '1.jpg', '2021-12-02 14:43:52', '2021-12-02 17:34:48');
INSERT INTO `tb_goods` VALUES (2, '小鲤鱼', 1, 28.89, 20, 1, 1, 0, '小鲤鱼，海底小纵队的成员，也是植物鱼的一员，她和其他的植物鱼管理着章鱼堡的后勤。', '3.jpg', '2021-12-02 14:45:27', '2021-12-02 17:34:50');
INSERT INTO `tb_goods` VALUES (3, '蓝猫', 1, 18.88, 20, 1, 1, 1, '英国短毛猫是传统英国本地猫纯种版本，具有鲜明的矮胖的身体，密集的外衣和广阔的脸。早期中国人称之为英短蓝猫，学名应该称为英国蓝色短毛猫。', '4.jpg', '2021-12-02 14:46:38', '2021-12-02 15:34:05');
INSERT INTO `tb_goods` VALUES (4, '复古卡车', 2, 9.99, 20, 1, 1, 1, '皮卡是汽车市场的一个重要组成部分。皮卡(pick-up) 是一种采用轿车车头和驾驶室，同时带有敞开式货车车厢的车型。其特点是既有轿车般的舒适性，又不失动力强劲，而且比轿车的载货和适应不良路面的能力还强。最常见的皮卡车型是双排座皮卡。皮卡既可作为专用车、多用车、公务车、商务车，也可作为家用车，用于载货、旅游、出租等使用。', '5.jpg', '2021-12-02 14:47:58', '2021-12-02 15:34:05');
INSERT INTO `tb_goods` VALUES (5, '积木', 2, 19.99, 20, 1, 1, 1, '积木通常是立方的木头或塑料固体玩具，一般在每一表面装饰着字母或图画，容许进行不同的排列或进行建筑活动积木有各种样式，可开发儿童智力，可拼成房子，各种动物等。', '6.jpg', '2021-12-02 14:48:59', '2021-12-02 15:34:05');
INSERT INTO `tb_goods` VALUES (6, '奥特曼', 2, 59.99, 20, 1, 0, 1, '奥特曼系列（日语：ウルトラマンシリーズ），是日本“特摄之神”的圆谷英二导演一手创办的“圆谷制作公司”（円谷プロダクション，原名：圆谷株式会社）自二十世纪六十年代起推出的空想特摄系列电视剧、电影、漫画、舞台剧等作品。', '7.jpg', '2021-12-02 14:49:38', '2021-12-02 17:34:54');
INSERT INTO `tb_goods` VALUES (7, '恐龙模型', 2, 50.00, 20, 1, 0, 1, '矫健的四肢、长长的尾巴和庞大的身躯是部分非鸟恐龙的写照。它们主要栖息于湖岸平原（或海岸平原）上的森林地或开阔地带。', '8.jpg', '2021-12-02 14:50:33', '2021-12-02 17:34:52');

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
-- Records of tb_goods_category
-- ----------------------------

-- ----------------------------
-- Table structure for tb_goods_introduce
-- ----------------------------
DROP TABLE IF EXISTS `tb_goods_introduce`;
CREATE TABLE `tb_goods_introduce`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NULL DEFAULT NULL COMMENT '商品的id',
  `goods_introduce` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '具体描述',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_goods_introduce
-- ----------------------------

-- ----------------------------
-- Table structure for tb_goods_picture
-- ----------------------------
DROP TABLE IF EXISTS `tb_goods_picture`;
CREATE TABLE `tb_goods_picture`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL COMMENT '商品的id',
  `goods_picture_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品的图片',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_goods_picture
-- ----------------------------

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
-- Records of tb_manage
-- ----------------------------

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

-- ----------------------------
-- Records of tb_user
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
