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

 Date: 26/11/2021 12:20:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for demo
-- ----------------------------
DROP TABLE IF EXISTS `demo`;
CREATE TABLE `demo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pwd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `test` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `1`(`user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_consume
-- ----------------------------
DROP TABLE IF EXISTS `shop_consume`;
CREATE TABLE `shop_consume`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品名字',
  `spmoney` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品价钱',
  `spnum` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '购买数量',
  `money` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '购买总余额',
  `buyname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '购买人',
  `create_time` datetime NULL DEFAULT CURRENT_TIMESTAMP COMMENT '购买时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_order
-- ----------------------------
DROP TABLE IF EXISTS `shop_order`;
CREATE TABLE `shop_order`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sp_uid` int(255) NOT NULL COMMENT '商品uid',
  `sp_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品名称',
  `sp_num` int(255) NOT NULL COMMENT '商品数量',
  `order_nameid` int(255) NOT NULL COMMENT '购买人id',
  `order_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '购买人',
  `oreder_addressname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '购买人地址',
  `order_sratic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '订单状态',
  `order_admin` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '订单操作人',
  `order_receiving` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户订单是否收到',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `收货状态`(`order_receiving`) USING BTREE,
  INDEX `发货状态`(`order_sratic`) USING BTREE,
  CONSTRAINT `发货状态` FOREIGN KEY (`order_sratic`) REFERENCES `shop_orderstatic` (`order_static`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `收货状态` FOREIGN KEY (`order_receiving`) REFERENCES `shop_receiving` (`receiving`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_orderstatic
-- ----------------------------
DROP TABLE IF EXISTS `shop_orderstatic`;
CREATE TABLE `shop_orderstatic`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_static` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '订单状态',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_static`(`order_static`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_receiving
-- ----------------------------
DROP TABLE IF EXISTS `shop_receiving`;
CREATE TABLE `shop_receiving`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiving` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收获状态',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `receiving`(`receiving`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_recharge
-- ----------------------------
DROP TABLE IF EXISTS `shop_recharge`;
CREATE TABLE `shop_recharge`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recharge_use` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '充值的账号',
  `recharge_money` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '充值的钱',
  `recharge_admin` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '充值操作员',
  `create_time` datetime NULL DEFAULT CURRENT_TIMESTAMP COMMENT '充值时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_record
-- ----------------------------
DROP TABLE IF EXISTS `shop_record`;
CREATE TABLE `shop_record`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sp_uid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品UID',
  `sp_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品名字',
  `sp_addnum` int(255) NULL DEFAULT NULL COMMENT '补货数量',
  `sp_reductnum` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '扣除数量',
  `sp_admin` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '操作者id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_shopcart
-- ----------------------------
DROP TABLE IF EXISTS `shop_shopcart`;
CREATE TABLE `shop_shopcart`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `car_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户的购物车',
  `sp_img1` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品主图',
  `sp_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品名字',
  `sp_price` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品价钱',
  `sp_num` int(255) NULL DEFAULT NULL COMMENT '商品数量',
  `sp_total` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '总金额',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_sort
-- ----------------------------
DROP TABLE IF EXISTS `shop_sort`;
CREATE TABLE `shop_sort`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品分类表',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sort_name`(`sort_name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_state
-- ----------------------------
DROP TABLE IF EXISTS `shop_state`;
CREATE TABLE `shop_state`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_state` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '权限表',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `type_state`(`type_state`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_user
-- ----------------------------
DROP TABLE IF EXISTS `shop_user`;
CREATE TABLE `shop_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户账号',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户密码',
  `type` int(255) NULL DEFAULT 2 COMMENT '用户权限{1管理员2是用户}默认注册是用户',
  `create_time` datetime NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `user`(`user`) USING BTREE COMMENT '账号唯一性'
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_userdate
-- ----------------------------
DROP TABLE IF EXISTS `shop_userdate`;
CREATE TABLE `shop_userdate`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `use_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `use_money` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户可用余额',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `账号`(`use_name`) USING BTREE,
  CONSTRAINT `账号` FOREIGN KEY (`use_name`) REFERENCES `shop_user` (`user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_wares
-- ----------------------------
DROP TABLE IF EXISTS `shop_wares`;
CREATE TABLE `shop_wares`  (
  `sp_uid` int(255) NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `sp_varieties` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品分类/标签',
  `sp_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品名字',
  `sp_price` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品价格',
  `sp_num` int(255) NOT NULL COMMENT '商品数量/剩余库存',
  `sp_state` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品状态',
  `sp_text` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品描述',
  `sp_imgpath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品主图1',
  `sp_hot` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '访问量/热门程度',
  `sp_collection` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0' COMMENT '商品被收藏数',
  `sp_sold` int(255) NULL DEFAULT 0 COMMENT '已售出',
  `sp_admin` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品创建者',
  `create_time` datetime NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`sp_uid`) USING BTREE,
  INDEX `状态`(`sp_state`) USING BTREE,
  INDEX `分类`(`sp_varieties`) USING BTREE,
  CONSTRAINT `分类` FOREIGN KEY (`sp_varieties`) REFERENCES `shop_sort` (`sort_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `状态` FOREIGN KEY (`sp_state`) REFERENCES `shop_state` (`type_state`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_waresimg
-- ----------------------------
DROP TABLE IF EXISTS `shop_waresimg`;
CREATE TABLE `shop_waresimg`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sp_uid` int(255) NOT NULL COMMENT '商品UID',
  `img_Path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品图片1',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `商品uid`(`sp_uid`) USING BTREE,
  CONSTRAINT `商品uid` FOREIGN KEY (`sp_uid`) REFERENCES `shop_wares` (`sp_uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_warestext
-- ----------------------------
DROP TABLE IF EXISTS `shop_warestext`;
CREATE TABLE `shop_warestext`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sp_uid` int(255) NOT NULL,
  `spuidtext` varchar(20000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `uid`(`sp_uid`) USING BTREE,
  CONSTRAINT `uid` FOREIGN KEY (`sp_uid`) REFERENCES `shop_wares` (`sp_uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
