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

 Date: 14/01/2022 13:06:08
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
  `goods_status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '商品状态{默认1上架，2下架}',
  `goods_hot` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否热门(默认1是2否)',
  `goods_recommendation` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否推荐（默认1是，2否）',
  `goods_describe` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '简单商品描述',
  `goods_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '商品主图',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`goods_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_goods
-- ----------------------------
INSERT INTO `tb_goods` VALUES (1, '123', 1, 1.00, 1, 2, 1, 1, '1', '', '2021-12-06 16:28:59', '2022-01-10 15:54:54');
INSERT INTO `tb_goods` VALUES (2, '小猪佩奇', 1, 60.00, 50, 1, 1, 0, '我必须向你解释这一切谴责快乐和赞美痛苦的错误观念是如何产生的，我将给你一个完整的系统说明，并阐述伟大的真理探索者、人类幸福的主要建设者的实际教义。', '2.jpg', '2021-12-06 16:29:59', '2021-12-15 14:30:10');
INSERT INTO `tb_goods` VALUES (3, '小鲤鱼', 1, 19.99, 50, 1, 1, 1, '小鲤鱼，海底小纵队的成员，也是植物鱼的一员，她和其他的植物鱼管理着章鱼堡的后勤', '3.jpg', '2021-12-06 16:30:42', '2021-12-15 14:28:44');
INSERT INTO `tb_goods` VALUES (4, '蓝猫', 1, 25.96, 50, 1, 1, 2, '英国短毛猫是传统英国本地猫纯种版本，具有鲜明的矮胖的身体，密集的外衣和广阔的脸。早期中国人称之为英短蓝猫，学名应该称为英国蓝色短毛猫。', '4.jpg', '2021-12-06 16:31:15', '2021-12-27 16:22:55');
INSERT INTO `tb_goods` VALUES (5, '复古皮卡', 1, 99.99, 50, 1, 1, 1, '皮卡是汽车市场的一个重要组成部分。皮卡(pick-up) 是一种采用轿车车头和驾驶室，同时带有敞开式货车车厢的车型。其特点是既有轿车般的舒适性，又不失动力强劲，而且比轿车的载货和适应不良路面的能力还强。最常见的皮卡车型是双排座皮卡。皮卡既可作为专用车、多用车、公务车、商务车，也可作为家用车，用于载货、旅游、出租等使用。', '5.jpg', '2021-12-06 16:32:24', '2021-12-15 14:28:43');
INSERT INTO `tb_goods` VALUES (6, '积木', 2, 36.99, 50, 2, 1, 1, '积木通常是立方的木头或塑料固体玩具，一般在每一表面装饰着字母或图画，容许进行不同的排列或进行建筑活动积木有各种样式，可开发儿童智力，可拼成房子，各种动物等。', '6.jpg', '2021-12-06 16:33:10', '2021-12-29 10:00:31');
INSERT INTO `tb_goods` VALUES (7, '奥特曼', 2, 56.99, 50, 1, 2, 2, '奥特曼系列（日语：ウルトラマンシリーズ），是日本“特摄之神”的圆谷英二导演一手创办的“圆谷制作公司”（円谷プロダクション，原名：圆谷株式会社）自二十世纪六十年代起推出的空想特摄系列电视剧、电影、漫画、舞台剧等作品。', '7.jpg', '2021-12-06 16:33:52', '2021-12-27 16:22:52');
INSERT INTO `tb_goods` VALUES (8, '霸王龙模型', 2, 19.99, 50, 1, 2, 2, '矫健的四肢、长长的尾巴和庞大的身躯是部分非鸟恐龙的写照。它们主要栖息于湖岸平原（或海岸平原）上的森林地或开阔地带。', '8.jpg', '2021-12-06 16:34:36', '2021-12-27 16:22:51');
INSERT INTO `tb_goods` VALUES (9, '霸王龙', 2, 30.00, 30, 1, 1, 2, '霸王龙即雷克斯暴龙（Tyrannosaurus Rex） [1]  ，生存于白垩纪末期的马斯特里赫特期(MAA)距今约6850万年到6500万年的白垩纪最末期，是白垩纪-第三纪灭绝事件前最后的非鸟类的恐龙种类之一。化石分布于北美洲的美国与加拿大，是最晚灭绝的恐龙之一。', '9.jpg', '2021-12-06 16:35:13', '2021-12-27 16:22:50');
INSERT INTO `tb_goods` VALUES (10, '机车人', 3, 66.00, 30, 1, 2, 1, '小说（机动风暴）中，宇战玩家中，一位有实力的少将等级。后因被刀锋战士（李锋）打败，消去所有积分，并加入李锋创立的风神会，后加入了FFC公司（李峰、马卡创办）。绝招是：霹雳七连射，螳螂刀和霹雳连斩', '10.jpg', '2021-12-06 16:36:08', '2021-12-27 16:22:44');
INSERT INTO `tb_goods` VALUES (11, '美国队长', 3, 10.00, 30, 2, 2, 1, '美国队长（Captain America）是美国漫威漫画旗下超级英雄，初次登场于《美国队长》（Captain America Comics）第1期（1941年3月），由乔·西蒙和杰克·科比联合创造，被视为美国精神的象征。', '11.jpg', '2021-12-06 16:36:49', '2021-12-29 10:00:24');
INSERT INTO `tb_goods` VALUES (12, '小马宝莉', 3, 15.00, 30, 2, 2, 1, '小马宝莉：友谊是魔法（My Little Pony: Friendship is Magic）由美国玩具商孩之宝于2010年10月10日在美国探索家庭电视频道开始播出的卡通影集，共221集', '12.jpg', '2021-12-06 16:37:25', '2021-12-29 10:00:25');
INSERT INTO `tb_goods` VALUES (13, '汪汪队', 4, 100.00, 30, 1, 1, 2, '以莱德Ryder为队长，由斑点狗毛毛（Marshall）是擅长火中急救和德国牧羊犬阿奇（Chase）是超级特工与英国斗牛犬小砾(Rubble)精通工程机械和混血儿灰灰（Rocky）', '2.jpg', '2021-12-06 16:38:12', '2021-12-27 16:22:50');
INSERT INTO `tb_goods` VALUES (21, '汪汪队1', 2, 3.00, 4, 2, 6, 7, '8', '9.jpg', '2022-01-04 11:12:50', '2022-01-10 15:53:58');
INSERT INTO `tb_goods` VALUES (22, '测试save', 3, 15.69, 1, 2, 1, 1, '测试说明而已', '3.jpg', '2022-01-04 11:17:26', '2022-01-10 15:53:56');
INSERT INTO `tb_goods` VALUES (24, '我不是连载', 3, 1.00, 1, 2, 1, 2, '1', '1.jpg', '2022-01-04 13:28:12', '2022-01-04 14:17:13');
INSERT INTO `tb_goods` VALUES (25, '西游记', 2, 15.23, 30, 2, 1, 2, '简要说明', '', '2022-01-04 16:15:35', '2022-01-10 15:53:54');
INSERT INTO `tb_goods` VALUES (26, '乔治', 1, 16.99, 50, 2, 2, 2, '这是佩奇的弟弟', '', '2022-01-05 10:40:59', '2022-01-05 10:40:59');

-- ----------------------------
-- Table structure for tb_goods_category
-- ----------------------------
DROP TABLE IF EXISTS `tb_goods_category`;
CREATE TABLE `tb_goods_category`  (
  `goods_category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品分类ID',
  `goods_category_name` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '分类名称',
  PRIMARY KEY (`goods_category_id`) USING BTREE,
  UNIQUE INDEX `name`(`goods_category_name`) USING BTREE COMMENT '分类名称唯一性'
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_goods_category
-- ----------------------------
INSERT INTO `tb_goods_category` VALUES (4, '影视系列');
INSERT INTO `tb_goods_category` VALUES (1, '数码产品');
INSERT INTO `tb_goods_category` VALUES (2, '玩具系列');
INSERT INTO `tb_goods_category` VALUES (3, '电子配件');

-- ----------------------------
-- Table structure for tb_goods_introduction
-- ----------------------------
DROP TABLE IF EXISTS `tb_goods_introduction`;
CREATE TABLE `tb_goods_introduction`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL COMMENT '商品的id',
  `goods_introduction` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '具体描述',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `goods_id`(`goods_id`) USING BTREE COMMENT '唯一'
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_goods_introduction
-- ----------------------------
INSERT INTO `tb_goods_introduction` VALUES (1, 5, '时光公主 × 维也纳艺术史博物馆梦幻精致礼盒套装，维也纳艺术史博物馆，全世界第四大艺术博物馆。具有文艺复兴时期的壮丽外观，更巧妙使用各色大理石的庄严内部装饰，不仅以丰富的收藏品吸引群众，更以博物馆的外观与内部装饰驰名于世。');
INSERT INTO `tb_goods_introduction` VALUES (2, 3, '英国短毛猫是传统英国本地猫纯种版本，具有鲜明的矮胖的身体，密集的外衣和广阔的脸。早期中国人称之为英短蓝猫，学名应该称为英国蓝色短毛猫。\\r\\n最熟悉的彩色变种是“英国蓝”，一个坚实的蓝灰色的外衣和铜颜色的眼睛，但该品种也已在范围广泛的其他颜色和图案。最典型的特征是此猫有五短，即：毛短、身材短、尾巴短、四肢短、耳朵短。');
INSERT INTO `tb_goods_introduction` VALUES (3, 6, '熔岩之翼龙蛋手办再上架，匠心打造，软萌可爱，陪你争霸城堡！购买即赠《城堡争霸》礼品卡一张，礼品丰厚，不容错过！');
INSERT INTO `tb_goods_introduction` VALUES (4, 7, '游戏经典LOGO，金色与黑色金属线搭配，简洁百搭。\\r\\n\\r\\n所属游戏: 城堡争霸\\r\\n\\r\\n款式: 棒球帽\\r\\n\\r\\n材质: 30%羊毛，70%涤纶\\r\\n\\r\\n产品尺寸: 56-60 CM');

-- ----------------------------
-- Table structure for tb_goods_picture
-- ----------------------------
DROP TABLE IF EXISTS `tb_goods_picture`;
CREATE TABLE `tb_goods_picture`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL COMMENT '商品的id',
  `goods_picture_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品的图片',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_goods_picture
-- ----------------------------
INSERT INTO `tb_goods_picture` VALUES (1, 3, 'a1.jpg');
INSERT INTO `tb_goods_picture` VALUES (2, 3, 'a2.jpg');
INSERT INTO `tb_goods_picture` VALUES (3, 3, 'a3.jpg');
INSERT INTO `tb_goods_picture` VALUES (4, 3, 'a4.jpg');
INSERT INTO `tb_goods_picture` VALUES (5, 6, 'a5.jpg');
INSERT INTO `tb_goods_picture` VALUES (6, 6, 'a6.jpg');
INSERT INTO `tb_goods_picture` VALUES (7, 5, 'a7.jpg');
INSERT INTO `tb_goods_picture` VALUES (8, 5, 'a8.jpg');

-- ----------------------------
-- Table structure for tb_session
-- ----------------------------
DROP TABLE IF EXISTS `tb_session`;
CREATE TABLE `tb_session`  (
  `account` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '账号',
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'token值',
  `lifetime` int(11) NULL DEFAULT NULL COMMENT '有效期',
  PRIMARY KEY (`account`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_session
-- ----------------------------
INSERT INTO `tb_session` VALUES ('abc123', 'db7f8e21b54b3ee7925653eb480260fe', 1641897463);
INSERT INTO `tb_session` VALUES ('dexian', 'edbc3eaf49f09a6e5b24b156bf7aadc8', 1641959459);

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
INSERT INTO `tb_user` VALUES ('123456', '56a8afadc3949ba59abbe5bbe56e057f', '2022-01-10 15:13:39');
INSERT INTO `tb_user` VALUES ('abc123', '419082a18c428cb38d5f265f26085367', '2022-01-10 15:13:39');
INSERT INTO `tb_user` VALUES ('abc1234', '878792adc3949ba59abbe52d1fb6d336', '2022-01-11 17:54:03');
INSERT INTO `tb_user` VALUES ('dexian', 'f1ca15adc3949ba59abbe56961a5d512', '2022-01-11 17:00:01');

SET FOREIGN_KEY_CHECKS = 1;
