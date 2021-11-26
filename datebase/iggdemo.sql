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

 Date: 26/11/2021 18:32:56
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
-- Records of demo
-- ----------------------------
INSERT INTO `demo` VALUES (1, '1', '1', '1');
INSERT INTO `demo` VALUES (2, '2', '2', '2');
INSERT INTO `demo` VALUES (3, '3', '3', '3');
INSERT INTO `demo` VALUES (4, '4', '4', '4');
INSERT INTO `demo` VALUES (5, '5', '5', '5');

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
-- Records of shop_consume
-- ----------------------------

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
-- Records of shop_order
-- ----------------------------

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
-- Records of shop_orderstatic
-- ----------------------------
INSERT INTO `shop_orderstatic` VALUES (1, '已付款');
INSERT INTO `shop_orderstatic` VALUES (2, '已发货');
INSERT INTO `shop_orderstatic` VALUES (3, '未付款');
INSERT INTO `shop_orderstatic` VALUES (4, '未发货');

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
-- Records of shop_receiving
-- ----------------------------
INSERT INTO `shop_receiving` VALUES (2, '已收货');
INSERT INTO `shop_receiving` VALUES (1, '未收获');

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
-- Records of shop_recharge
-- ----------------------------

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
-- Records of shop_record
-- ----------------------------

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
-- Records of shop_shopcart
-- ----------------------------

-- ----------------------------
-- Table structure for shop_sort
-- ----------------------------
DROP TABLE IF EXISTS `shop_sort`;
CREATE TABLE `shop_sort`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品分类表',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `sort_name`(`sort_name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_sort
-- ----------------------------
INSERT INTO `shop_sort` VALUES (6, 'ceshi');
INSERT INTO `shop_sort` VALUES (3, '数码产品');
INSERT INTO `shop_sort` VALUES (11, '是我');
INSERT INTO `shop_sort` VALUES (2, '玩具系列');
INSERT INTO `shop_sort` VALUES (1, '精品系列');

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
-- Records of shop_state
-- ----------------------------
INSERT INTO `shop_state` VALUES (1, '上架');
INSERT INTO `shop_state` VALUES (2, '下架');
INSERT INTO `shop_state` VALUES (4, '删除');
INSERT INTO `shop_state` VALUES (3, '待审核');

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
-- Records of shop_user
-- ----------------------------
INSERT INTO `shop_user` VALUES (1, 'admin', '123465', 1, '2021-11-15 10:18:13');
INSERT INTO `shop_user` VALUES (3, 'asd', 'pws', 2, '2021-11-15 15:59:00');
INSERT INTO `shop_user` VALUES (6, 'a1sd', 'pws', 2, '2021-11-15 15:59:37');

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
-- Records of shop_userdate
-- ----------------------------
INSERT INTO `shop_userdate` VALUES (1, 'admin', '666');

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
-- Records of shop_wares
-- ----------------------------
INSERT INTO `shop_wares` VALUES (2, '精品系列', '小猪佩奇', '18', 20, '上架', '我必须向你解释这一切谴责快乐和赞美痛苦的错误观念是如何产生的，我将给你一个完整的系统说明，并阐述伟大的真理探索者、人类幸福的主要建设者的实际教义。 .', '2.jpg', '10', '0', NULL, NULL, '2021-11-15 10:58:30');
INSERT INTO `shop_wares` VALUES (3, '数码产品', '小鲤鱼', '19', 10, '上架', '小鲤鱼，海底小纵队的成员，也是植物鱼的一员，她和其他的植物鱼管理着章鱼堡的后勤。', '3.jpg', '5', '0', NULL, NULL, '2021-11-15 15:12:49');
INSERT INTO `shop_wares` VALUES (5, '玩具系列', '蓝猫', '18', 20, '上架', '英国短毛猫是传统英国本地猫纯种版本，具有鲜明的矮胖的身体，密集的外衣和广阔的脸。早期中国人称之为英短蓝猫，学名应该称为英国蓝色短毛猫。', '4.jpg', '1', '0', NULL, NULL, '2021-11-16 16:37:03');
INSERT INTO `shop_wares` VALUES (6, '精品系列', '复古卡车', '18', 50, '上架', '皮卡是汽车市场的一个重要组成部分。皮卡(pick-up) 是一种采用轿车车头和驾驶室，同时带有敞开式货车车厢的车型。其特点是既有轿车般的舒适性，又不失动力强劲，而且比轿车的载货和适应不良路面的能力还强。最常见的皮卡车型是双排座皮卡。皮卡既可作为专用车、多用车、公务车、商务车，也可作为家用车，用于载货、旅游、出租等使用。', '5.jpg', '7', '0', NULL, NULL, '2021-11-16 16:38:16');
INSERT INTO `shop_wares` VALUES (7, '数码产品', '积木', '33', 50, '上架', '积木通常是立方的木头或塑料固体玩具，一般在每一表面装饰着字母或图画，容许进行不同的排列或进行建筑活动积木有各种样式，可开发儿童智力，可拼成房子，各种动物等。', '6.jpg', '4', '0', NULL, NULL, '2021-11-16 16:39:34');
INSERT INTO `shop_wares` VALUES (8, '玩具系列', '奥特曼', '20', 30, '上架', '奥特曼系列（日语：ウルトラマンシリーズ），是日本“特摄之神”的圆谷英二导演一手创办的“圆谷制作公司”（円谷プロダクション，原名：圆谷株式会社）自二十世纪六十年代起推出的空想特摄系列电视剧、电影、漫画、舞台剧等作品。', '7.jpg', '6', '0', 0, NULL, '2021-11-17 13:52:17');

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
-- Records of shop_waresimg
-- ----------------------------
INSERT INTO `shop_waresimg` VALUES (1, 3, 'a1.jpg');
INSERT INTO `shop_waresimg` VALUES (2, 3, 'a2.jpg');
INSERT INTO `shop_waresimg` VALUES (3, 3, 'a3.jpg');
INSERT INTO `shop_waresimg` VALUES (4, 3, 'a4.jpg');
INSERT INTO `shop_waresimg` VALUES (5, 6, 'a5.jpg');
INSERT INTO `shop_waresimg` VALUES (6, 6, 'a6.jpg');
INSERT INTO `shop_waresimg` VALUES (7, 2, 'a7.jpg');
INSERT INTO `shop_waresimg` VALUES (8, 2, 'a8.jpg');
INSERT INTO `shop_waresimg` VALUES (9, 2, 'a9.jpg');
INSERT INTO `shop_waresimg` VALUES (10, 8, 'a10.jpg');

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

-- ----------------------------
-- Records of shop_warestext
-- ----------------------------
INSERT INTO `shop_warestext` VALUES (1, 5, '时光公主 × 维也纳艺术史博物馆梦幻精致礼盒套装，维也纳艺术史博物馆，全世界第四大艺术博物馆。具有文艺复兴时期的壮丽外观，更巧妙使用各色大理石的庄严内部装饰，不仅以丰富的收藏品吸引群众，更以博物馆的外观与内部装饰驰名于世。');
INSERT INTO `shop_warestext` VALUES (2, 3, '英国短毛猫是传统英国本地猫纯种版本，具有鲜明的矮胖的身体，密集的外衣和广阔的脸。早期中国人称之为英短蓝猫，学名应该称为英国蓝色短毛猫。\r\n最熟悉的彩色变种是“英国蓝”，一个坚实的蓝灰色的外衣和铜颜色的眼睛，但该品种也已在范围广泛的其他颜色和图案。最典型的特征是此猫有五短，即：毛短、身材短、尾巴短、四肢短、耳朵短。');
INSERT INTO `shop_warestext` VALUES (3, 2, '这是一个测试文件！！！');
INSERT INTO `shop_warestext` VALUES (4, 6, '熔岩之翼龙蛋手办再上架，匠心打造，软萌可爱，陪你争霸城堡！购买即赠《城堡争霸》礼品卡一张，礼品丰厚，不容错过！');
INSERT INTO `shop_warestext` VALUES (5, 7, '游戏经典LOGO，金色与黑色金属线搭配，简洁百搭。\r\n\r\n所属游戏: 城堡争霸\r\n\r\n款式: 棒球帽\r\n\r\n材质: 30%羊毛，70%涤纶\r\n\r\n产品尺寸: 56-60 CM');

SET FOREIGN_KEY_CHECKS = 1;
