/*
 Navicat Premium Data Transfer

 Source Server         : ProjectParis
 Source Server Type    : MySQL
 Source Server Version : 100233
 Source Host           : mysql.ferafox.com:3306
 Source Schema         : ferafox62

 Target Server Type    : MySQL
 Target Server Version : 100233
 File Encoding         : 65001

 Date: 03/08/2021 06:35:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `level` int NOT NULL DEFAULT 1,
  `forget` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `genre` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `datebirth` date NULL DEFAULT NULL,
  `document` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'registered' COMMENT 'registered, confirmed',
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  FULLTEXT INDEX `full_text`(`first_name`, `last_name`, `email`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Jhonatan', 'Martimiano', 'jhonatan@geracaobr.com.br', '$2y$10$B5zHSK0SlqWeOnX7Tr69BuKEKyurK5C4uO0J0tHq1uj8YJTNdw6g.', 5, NULL, 'male', '1995-02-21', '00000000000', 'images/2021/08/jhonatan-martimiano.jpg', 'registered', '11910584136', '2021-08-03 06:01:09', '2021-08-03 06:25:18');

SET FOREIGN_KEY_CHECKS = 1;
