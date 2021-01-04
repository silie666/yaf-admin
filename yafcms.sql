/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 80021
 Source Host           : 127.0.0.1:3306
 Source Schema         : yafcms

 Target Server Type    : MySQL
 Target Server Version : 80021
 File Encoding         : 65001

 Date: 04/01/2021 18:02:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sl_admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `sl_admin_menu`;
CREATE TABLE `sl_admin_menu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int unsigned NOT NULL DEFAULT '0' COMMENT '父菜单id',
  `type` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '菜单类型;1:有界面可访问菜单,2:无界面可访问菜单,0:只作为菜单',
  `status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '状态;1:显示,0:不显示',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `app` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '应用名',
  `controller` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '控制器名',
  `action` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '操作名称',
  `param` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '额外参数',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `icon` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '菜单图标',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `parent_id` (`parent_id`) USING BTREE,
  KEY `controller` (`controller`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='后台菜单表';

-- ----------------------------
-- Records of sl_admin_menu
-- ----------------------------
BEGIN;
INSERT INTO `sl_admin_menu` VALUES (6, 0, 0, 1, 0, 'admin', 'Setting', 'default', '', '设置', '&#xe614;', '系统设置入口');
INSERT INTO `sl_admin_menu` VALUES (20, 6, 1, 1, 10000, 'admin', 'Menu', 'index', '', '后台菜单', '&#xe60f;', '后台菜单管理');
INSERT INTO `sl_admin_menu` VALUES (22, 20, 1, 0, 10000, 'admin', 'Menu', 'add', '', '后台菜单添加', '', '后台菜单添加');
INSERT INTO `sl_admin_menu` VALUES (23, 20, 2, 0, 10000, 'admin', 'Menu', 'add_post', '', '后台菜单添加提交保存', '', '后台菜单添加提交保存');
INSERT INTO `sl_admin_menu` VALUES (24, 20, 1, 0, 10000, 'admin', 'Menu', 'edit', '', '后台菜单编辑', '', '后台菜单编辑');
INSERT INTO `sl_admin_menu` VALUES (25, 20, 2, 0, 10000, 'admin', 'Menu', 'edit_post', '', '后台菜单编辑提交保存', '', '后台菜单编辑提交保存');
INSERT INTO `sl_admin_menu` VALUES (26, 20, 2, 0, 10000, 'admin', 'Menu', 'delete', '', '后台菜单删除', '', '后台菜单删除');
INSERT INTO `sl_admin_menu` VALUES (27, 20, 2, 0, 10000, 'admin', 'Menu', 'list_order', '', '后台菜单排序', '', '后台菜单排序');
INSERT INTO `sl_admin_menu` VALUES (49, 110, 0, 1, 10000, 'admin', 'User', 'default', '', '管理组', '&#xe613;', '管理组');
INSERT INTO `sl_admin_menu` VALUES (71, 6, 1, 1, 0, 'admin', 'Setting', 'site', '', '网站信息', '&#xe642;', '网站信息');
INSERT INTO `sl_admin_menu` VALUES (72, 71, 2, 0, 10000, 'admin', 'Setting', 'site_post', '', '网站信息设置提交', '', '网站信息设置提交');
INSERT INTO `sl_admin_menu` VALUES (73, 6, 1, 1, 10000, 'admin', 'Setting', 'password', '', '密码修改', '&#xe642;', '密码修改');
INSERT INTO `sl_admin_menu` VALUES (74, 73, 2, 0, 10000, 'admin', 'Setting', 'password_post', '', '密码修改提交', '', '密码修改提交');
INSERT INTO `sl_admin_menu` VALUES (77, 6, 2, 0, 10000, 'admin', 'Setting', 'clear_cache', '', '清除缓存', '&#xe640;', '清除缓存');
INSERT INTO `sl_admin_menu` VALUES (110, 0, 0, 1, 10, 'admin', 'User', 'member_default', '', '用户管理', '&#xe66f;', '用户管理');
INSERT INTO `sl_admin_menu` VALUES (111, 49, 1, 1, 10000, 'admin', 'User', 'admin_user', '', '管理员', '&#xe612;', '管理员管理');
INSERT INTO `sl_admin_menu` VALUES (114, 111, 1, 0, 10000, 'admin', 'User', 'admin_user_edit', '', '管理员编辑', '&#xe6ca;', '管理员编辑');
INSERT INTO `sl_admin_menu` VALUES (116, 6, 1, 1, 10000, 'admin', 'User', 'user_info', '', '修改个人信息', '&#xe642;', '管理员个人信息修改');
INSERT INTO `sl_admin_menu` VALUES (118, 111, 2, 0, 10000, 'admin', 'User', 'admin_user_delete', '', '管理员删除', '', '管理员删除');
INSERT INTO `sl_admin_menu` VALUES (119, 111, 2, 0, 10000, 'admin', 'User', 'admin_user_status', '', '启用停用管理员', '', '停用管理员');
INSERT INTO `sl_admin_menu` VALUES (123, 110, 0, 1, 10000, 'admin', 'User', 'default1', '', '用户组', '&#xe613;', '用户组');
INSERT INTO `sl_admin_menu` VALUES (124, 123, 1, 1, 10000, 'admin', 'User', 'member', '', '本站用户', '&#xe770;', '本站用户');
INSERT INTO `sl_admin_menu` VALUES (125, 124, 2, 0, 10000, 'admin', 'User', 'member_status', '', '本站用户拉黑', '', '本站用户拉黑');
INSERT INTO `sl_admin_menu` VALUES (128, 124, 2, 0, 10000, 'admin', 'User', 'member_del', '', '删除用户', '', '删除用户');
INSERT INTO `sl_admin_menu` VALUES (131, 6, 1, 1, 10000, 'admin', 'setting', 'edit_wechat_xcx', '', '小程序配置', '&#xe614;', '0');
INSERT INTO `sl_admin_menu` VALUES (132, 49, 0, 1, 100, 'admin', 'rbac', 'index', '', '角色管理', '&#xe66f;', '3');
INSERT INTO `sl_admin_menu` VALUES (133, 132, 2, 0, 10000, 'admin', 'rbac', 'role_add_post', '', '添加角色提交', '', '0');
INSERT INTO `sl_admin_menu` VALUES (134, 132, 1, 0, 10000, 'admin', 'rbac', 'role_edit', '', '角色编辑', '&#xe6ca;', '0');
INSERT INTO `sl_admin_menu` VALUES (135, 132, 2, 0, 10000, 'admin', 'rbac', 'role_edit_post', '', '角色编辑提交', '', '0');
INSERT INTO `sl_admin_menu` VALUES (136, 132, 2, 0, 10000, 'admin', 'rbac', 'role_delete', '', '删除角色', '', '0');
INSERT INTO `sl_admin_menu` VALUES (223, 110, 1, 1, 10000, 'admin', 'User', 'robot_index', '', '马甲组', '&#xe613;', '');
INSERT INTO `sl_admin_menu` VALUES (224, 223, 1, 0, 10000, 'admin', 'User', 'robot_edit', '', '马甲编辑/添加', '&#xe6c9;', '');
INSERT INTO `sl_admin_menu` VALUES (225, 223, 2, 0, 10000, 'admin', 'User', 'robot_del', '', '马甲删除', '', '');
INSERT INTO `sl_admin_menu` VALUES (235, 6, 1, 0, 10000, 'admin', 'setting', 'edit_wechat_gzh', '', '公众号配置', '&#xe614;', '0');
INSERT INTO `sl_admin_menu` VALUES (236, 111, 2, 0, 10000, 'admin', 'User', 'admin_user_data', '', '管理员列表数据', '&#xe612;', '管理员管理');
INSERT INTO `sl_admin_menu` VALUES (237, 123, 2, 0, 10000, 'admin', 'User', 'member_data', '', '本站用户数据', '&#xe770;', '本站用户');
INSERT INTO `sl_admin_menu` VALUES (238, 223, 2, 0, 10000, 'admin', 'User', 'robot_data', '', '马甲数据', '&#xe770;', '马甲数据');
COMMIT;

-- ----------------------------
-- Table structure for sl_auth_access
-- ----------------------------
DROP TABLE IF EXISTS `sl_auth_access`;
CREATE TABLE `sl_auth_access` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL COMMENT '角色',
  `rule_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '规则唯一英文标识,全小写',
  `type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '权限规则分类,请加应用前缀,如admin_',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `rule_name` (`rule_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='权限授权表';

-- ----------------------------
-- Records of sl_auth_access
-- ----------------------------
BEGIN;
INSERT INTO `sl_auth_access` VALUES (193, 3, 'admin/setting/default', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (194, 3, 'admin/user/user_info', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (195, 3, 'admin/setting/edit_wechat_xcx', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (196, 3, 'admin/user/member_default', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (197, 3, 'admin/user/default', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (198, 3, 'admin/user/admin_user', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (199, 3, 'admin/user/admin_user_edit', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (200, 3, 'admin/user/admin_user_delete', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (201, 3, 'admin/user/admin_user_status', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (202, 3, 'admin/user/admin_user_data', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (203, 3, 'admin/rbac/index', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (204, 3, 'admin/rbac/role_add_post', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (205, 3, 'admin/rbac/role_edit', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (206, 3, 'admin/rbac/role_edit_post', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (207, 3, 'admin/rbac/role_delete', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (208, 3, 'admin/user/default1', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (209, 3, 'admin/user/member', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (210, 3, 'admin/user/member_status', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (211, 3, 'admin/user/member_del', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (212, 3, 'admin/user/member_data', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (213, 3, 'admin/user/robot_index', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (214, 3, 'admin/user/robot_edit', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (215, 3, 'admin/user/robot_del', 'admin_url');
INSERT INTO `sl_auth_access` VALUES (216, 3, 'admin/user/robot_data', 'admin_url');
COMMIT;

-- ----------------------------
-- Table structure for sl_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `sl_auth_rule`;
CREATE TABLE `sl_auth_rule` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `status` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `app` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '规则所属app',
  `type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '权限规则分类，请加应用前缀,如admin_',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '规则唯一英文标识,全小写',
  `param` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '额外url参数',
  `title` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '规则描述',
  `condition` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '规则附加条件',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name` (`name`) USING BTREE,
  KEY `module` (`app`,`status`,`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=282 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='权限规则表';

-- ----------------------------
-- Records of sl_auth_rule
-- ----------------------------
BEGIN;
INSERT INTO `sl_auth_rule` VALUES (18, 1, 'admin', 'admin_url', 'admin/Menu/index', '', '后台菜单', '');
INSERT INTO `sl_auth_rule` VALUES (19, 1, 'admin', 'admin_url', 'admin/Menu/lists', '', '所有菜单', '');
INSERT INTO `sl_auth_rule` VALUES (20, 1, 'admin', 'admin_url', 'admin/Menu/add', '', '后台菜单添加', '');
INSERT INTO `sl_auth_rule` VALUES (21, 1, 'admin', 'admin_url', 'admin/Menu/addPost', '', '后台菜单添加提交保存', '');
INSERT INTO `sl_auth_rule` VALUES (22, 1, 'admin', 'admin_url', 'admin/Menu/edit', '', '后台菜单编辑', '');
INSERT INTO `sl_auth_rule` VALUES (23, 1, 'admin', 'admin_url', 'admin/Menu/editPost', '', '后台菜单编辑提交保存', '');
INSERT INTO `sl_auth_rule` VALUES (24, 1, 'admin', 'admin_url', 'admin/Menu/delete', '', '后台菜单删除', '');
INSERT INTO `sl_auth_rule` VALUES (25, 1, 'admin', 'admin_url', 'admin/Menu/listOrder', '', '后台菜单排序', '');
INSERT INTO `sl_auth_rule` VALUES (26, 1, 'admin', 'admin_url', 'admin/Menu/getActions', '', '导入新后台菜单', '');
INSERT INTO `sl_auth_rule` VALUES (48, 1, 'admin', 'admin_url', 'admin/Rbac/index', '', '角色管理', '');
INSERT INTO `sl_auth_rule` VALUES (49, 1, 'admin', 'admin_url', 'admin/Rbac/roleAdd', '', '添加角色', '');
INSERT INTO `sl_auth_rule` VALUES (50, 1, 'admin', 'admin_url', 'admin/Rbac/roleAddPost', '', '添加角色提交', '');
INSERT INTO `sl_auth_rule` VALUES (51, 1, 'admin', 'admin_url', 'admin/Rbac/roleEdit', '', '编辑角色', '');
INSERT INTO `sl_auth_rule` VALUES (52, 1, 'admin', 'admin_url', 'admin/Rbac/roleEditPost', '', '编辑角色提交', '');
INSERT INTO `sl_auth_rule` VALUES (53, 1, 'admin', 'admin_url', 'admin/Rbac/roleDelete', '', '删除角色', '');
INSERT INTO `sl_auth_rule` VALUES (69, 1, 'admin', 'admin_url', 'admin/Setting/default', '', '设置', '');
INSERT INTO `sl_auth_rule` VALUES (70, 1, 'admin', 'admin_url', 'admin/Setting/site', '', '网站信息', '');
INSERT INTO `sl_auth_rule` VALUES (71, 1, 'admin', 'admin_url', 'admin/Setting/sitePost', '', '网站信息设置提交', '');
INSERT INTO `sl_auth_rule` VALUES (72, 1, 'admin', 'admin_url', 'admin/Setting/password', '', '密码修改', '');
INSERT INTO `sl_auth_rule` VALUES (73, 1, 'admin', 'admin_url', 'admin/Setting/passwordPost', '', '密码修改提交', '');
INSERT INTO `sl_auth_rule` VALUES (74, 1, 'admin', 'admin_url', 'admin/Setting/upload', '', '上传设置', '');
INSERT INTO `sl_auth_rule` VALUES (75, 1, 'admin', 'admin_url', 'admin/Setting/uploadPost', '', '上传设置提交', '');
INSERT INTO `sl_auth_rule` VALUES (76, 1, 'admin', 'admin_url', 'admin/Setting/clearCache', '', '清除缓存', '');
INSERT INTO `sl_auth_rule` VALUES (109, 1, 'admin', 'admin_url', 'admin/User/default', '', '管理组', '');
INSERT INTO `sl_auth_rule` VALUES (110, 1, 'admin', 'admin_url', 'admin/User/index', '', '管理员', '');
INSERT INTO `sl_auth_rule` VALUES (111, 1, 'admin', 'admin_url', 'admin/User/add', '', '管理员添加', '');
INSERT INTO `sl_auth_rule` VALUES (112, 1, 'admin', 'admin_url', 'admin/User/addPost', '', '管理员添加提交', '');
INSERT INTO `sl_auth_rule` VALUES (113, 1, 'admin', 'admin_url', 'admin/User/edit', '', '管理员编辑', '');
INSERT INTO `sl_auth_rule` VALUES (114, 1, 'admin', 'admin_url', 'admin/User/editPost', '', '管理员编辑提交', '');
INSERT INTO `sl_auth_rule` VALUES (115, 1, 'admin', 'admin_url', 'admin/User/userInfo', '', '修改个人信息', '');
INSERT INTO `sl_auth_rule` VALUES (116, 1, 'admin', 'admin_url', 'admin/User/userInfoPost', '', '管理员个人信息修改提交', '');
INSERT INTO `sl_auth_rule` VALUES (117, 1, 'admin', 'admin_url', 'admin/User/delete', '', '管理员删除', '');
INSERT INTO `sl_auth_rule` VALUES (118, 1, 'admin', 'admin_url', 'admin/User/admin_user_status', '', '管理员停用/启用', '');
INSERT INTO `sl_auth_rule` VALUES (122, 1, 'user', 'admin_url', 'admin/User/member_default', '', '用户管理', '');
INSERT INTO `sl_auth_rule` VALUES (123, 1, 'user', 'admin_url', 'admin/User/member_default1', '', '用户组', '');
INSERT INTO `sl_auth_rule` VALUES (124, 1, 'user', 'admin_url', 'admin/User/member', '', '本站用户', '');
INSERT INTO `sl_auth_rule` VALUES (125, 1, 'user', 'admin_url', 'admin/User/member_status', '', '本站用户拉黑', '');
INSERT INTO `sl_auth_rule` VALUES (126, 1, 'user', 'admin_url', 'admin/User/member_data', '', '本站用户数据', '');
INSERT INTO `sl_auth_rule` VALUES (270, 1, 'admin', 'admin_url', 'admin/User/robot_index', '', '马甲组', '');
INSERT INTO `sl_auth_rule` VALUES (271, 1, 'admin', 'admin_url', 'admin/User/robot_edit', '', '马甲编辑/添加', '');
INSERT INTO `sl_auth_rule` VALUES (272, 1, 'admin', 'admin_url', 'admin/User/robot_del', '', '马甲删除', '');
INSERT INTO `sl_auth_rule` VALUES (278, 1, 'Admin', 'admin_url', 'admin/subscribe_template/index', '', '订阅消息模板', '');
INSERT INTO `sl_auth_rule` VALUES (279, 1, 'admin', 'admin_url', 'admin/setting/edit_wechat_gzh', '', '公众号配置', '');
INSERT INTO `sl_auth_rule` VALUES (281, 1, 'admin', 'admin_url', 'admin/Setting/clear_cache', '', '清除缓存', '');
COMMIT;

-- ----------------------------
-- Table structure for sl_option
-- ----------------------------
DROP TABLE IF EXISTS `sl_option`;
CREATE TABLE `sl_option` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `autoload` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '是否自动加载;1:自动加载;0:不自动加载',
  `option_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '配置名',
  `option_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT '配置值',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `option_name` (`option_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='全站配置表';

-- ----------------------------
-- Records of sl_option
-- ----------------------------
BEGIN;
INSERT INTO `sl_option` VALUES (1, 1, 'site_info', '{\"site_name\":\"小小网站\",\"site_seo_title\":\"小小网站\",\"site_seo_keywords\":\"小小网站\",\"site_seo_description\":\"小小网站\",\"site_icp\":\"\",\"site_gwa\":\"\",\"site_admin_email\":\"\",\"site_analytics\":\"\"}');
INSERT INTO `sl_option` VALUES (3, 1, 'seo_settings', '{\"open_registration\":\"0\",\"banned_usernames\":\"\"}');
INSERT INTO `sl_option` VALUES (4, 1, 'cdn_settings', '{\"cdn_static_root\":\"http://a.test.com\"}');
INSERT INTO `sl_option` VALUES (6, 1, 'wxapp_settings', '{\"wxapps\":{\"app_name\":\"\",\"app_id\":\"\",\"app_secret\":\"\"}}');
INSERT INTO `sl_option` VALUES (10, 1, 'wxgzh_settings', '{\"wxapps\":{\"app_name\":\"\",\"app_id\":\"\",\"app_secret\":\"\"}}');
COMMIT;

-- ----------------------------
-- Table structure for sl_role
-- ----------------------------
DROP TABLE IF EXISTS `sl_role`;
CREATE TABLE `sl_role` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int unsigned NOT NULL DEFAULT '0' COMMENT '父角色ID',
  `status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '状态;0:禁用;1:正常',
  `create_time` int unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `list_order` float NOT NULL DEFAULT '0' COMMENT '排序',
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `parent_id` (`parent_id`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='角色表';

-- ----------------------------
-- Records of sl_role
-- ----------------------------
BEGIN;
INSERT INTO `sl_role` VALUES (1, 0, 1, 1329633709, 1329633709, 0, '超级管理员', '拥有网站最高管理员权限！');
INSERT INTO `sl_role` VALUES (2, 0, 1, 1329633709, 1329633709, 0, '普通管理员', '权限由最高管理员分配！');
INSERT INTO `sl_role` VALUES (3, 0, 1, 0, 0, 0, '运营', '');
COMMIT;

-- ----------------------------
-- Table structure for sl_role_user
-- ----------------------------
DROP TABLE IF EXISTS `sl_role_user`;
CREATE TABLE `sl_role_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL DEFAULT '0' COMMENT '角色 id',
  `user_id` bigint unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='用户角色对应表';

-- ----------------------------
-- Records of sl_role_user
-- ----------------------------
BEGIN;
INSERT INTO `sl_role_user` VALUES (1, 1, 1);
INSERT INTO `sl_role_user` VALUES (10, 3, 3);
COMMIT;

-- ----------------------------
-- Table structure for sl_third_party_user
-- ----------------------------
DROP TABLE IF EXISTS `sl_third_party_user`;
CREATE TABLE `sl_third_party_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `from` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '用户来源key',
  `weixin` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '来自哪个微信号',
  `user_id` int NOT NULL COMMENT '关联的本站用户id',
  `openid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '第三方用户id',
  `union_id` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '微信unionid',
  `app_id` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'app_id',
  `session_key` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'session_key',
  `third_party` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '第三方用户名称',
  `status` tinyint NOT NULL DEFAULT '1',
  `login_times` int NOT NULL DEFAULT '1' COMMENT '登陆次数',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '绑定时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `last_login_ip` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` datetime NOT NULL COMMENT '最后登录时间',
  `more` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '' COMMENT '微信小程序返回的数据',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `weixin_openid` (`weixin`,`openid`) USING BTREE,
  KEY `uid` (`user_id`) USING BTREE,
  KEY `from_openid` (`from`,`openid`) USING BTREE,
  KEY `unionid` (`union_id`) USING BTREE,
  KEY `openid` (`openid`) USING BTREE,
  KEY `from` (`from`) USING BTREE,
  KEY `weixin` (`weixin`) USING BTREE,
  KEY `from_weixin` (`from`,`weixin`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE,
  KEY `last_login_time` (`last_login_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='第三方用户表';

-- ----------------------------
-- Records of sl_third_party_user
-- ----------------------------
BEGIN;
INSERT INTO `sl_third_party_user` VALUES (102, 'wxapp', 'wx-sl', 121, 'ol4UG5mnTM4-citBIUxHda9DFh80', '', 'wx554c65f0caceeaf0', 'ZIyxAXQAP8YG+6uSMXaCCg==', 'wxapp', 1, 3, '2020-08-19 18:39:18', '2021-01-04 07:23:55', '113.111.88.128', '2020-11-19 17:29:19', '');
INSERT INTO `sl_third_party_user` VALUES (113, 'wxapp', 'wx-sl', 132, 'ol4UG5s23vw8nSC6ZFKAB8joEgmE', '', 'wx554c65f0caceeaf0', 'TnJAge+8HgKn7JqmB63gxQ==', 'wxapp', 1, 1, '2020-08-27 01:41:24', '2021-01-04 07:23:55', '119.130.230.144', '2020-08-27 01:41:24', '');
COMMIT;

-- ----------------------------
-- Table structure for sl_user
-- ----------------------------
DROP TABLE IF EXISTS `sl_user`;
CREATE TABLE `sl_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_type` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '用户类型;1:admin;2:会员;3货主;4机器人;5小程序管理员',
  `sex` tinyint NOT NULL DEFAULT '0' COMMENT '性别;0:保密,1:男,2:女',
  `birthday` datetime DEFAULT NULL COMMENT '生日',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `create_time` datetime DEFAULT NULL COMMENT '注册时间',
  `user_status` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '用户状态;0:禁用,1:正常',
  `user_login` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `user_pass` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '' COMMENT '登录密码;password加密',
  `user_nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `user_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '' COMMENT '用户登录邮箱',
  `user_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '' COMMENT '用户个人网址',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '用户头像',
  `signature` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '' COMMENT '个性签名',
  `last_login_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `wx_phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '' COMMENT '中国手机不带国家代码，国际手机号格式为：国家代码-手机号',
  `more` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT '扩展属性',
  `user_realpass` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '' COMMENT '明文密码',
  `accept_notify` tinyint(1) DEFAULT '1' COMMENT '是否接受微信消息',
  `mina_notify` tinyint(1) DEFAULT '0' COMMENT '是否接收微信模版消息，默认0不接收，1接收',
  `register_device` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '' COMMENT '注册来源',
  `use_device` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '' COMMENT '登录来源',
  `inviter_id` int DEFAULT '0' COMMENT '推荐人id',
  `forbid_publish` tinyint(1) DEFAULT '0' COMMENT '是否全平台禁言，0不是，1是',
  `thread_num` int DEFAULT '0' COMMENT '个人动态数',
  `release_datetime` datetime DEFAULT NULL COMMENT '解除禁言时间',
  `forbid_excuse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '' COMMENT '禁言理由',
  `activity_baned` tinyint(1) DEFAULT '0' COMMENT '活动黑名单，1是黑名单用户，0不是黑名单用户',
  `forbid_time` datetime DEFAULT NULL COMMENT '禁言开始时间',
  `like_num` int DEFAULT '0' COMMENT '点赞数量',
  `follow_num` int DEFAULT '0' COMMENT '关注数量',
  `tag_num` int DEFAULT '0' COMMENT '标签数量',
  `fans_num` int DEFAULT '0' COMMENT '粉丝数量',
  `favorable_num` int DEFAULT '0' COMMENT '好评率',
  `city` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '城市',
  `province` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '省份',
  `country` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '国家',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间三',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_login` (`user_login`) USING BTREE,
  KEY `user_nickname` (`user_nickname`) USING BTREE,
  KEY `user_type` (`user_type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='用户表';

-- ----------------------------
-- Records of sl_user
-- ----------------------------
BEGIN;
INSERT INTO `sl_user` VALUES (1, 1, 1, NULL, '2021-01-04 17:00:57', NULL, 1, 'admin', '###21128b68776d3919be577abd9e4f85b5', 'admins', '1312119468@qq.com', '', 'http://a.test.com/uploads/20210104/ce24c06d1f3d3f4b9ace0e5bfe6b2c1a.jpg', '', '127.0.0.1', '', NULL, '', 1, 0, '', '', 0, 0, 0, NULL, '', 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL);
INSERT INTO `sl_user` VALUES (3, 1, 0, NULL, '2021-01-04 16:55:48', NULL, 1, '123', '###21128b68776d3919be577abd9e4f85b5', '123', '123@qq.com', '', 'http://a.test.com/uploads/20210104/ce24c06d1f3d3f4b9ace0e5bfe6b2c1a.jpg', '', '127.0.0.1', '', NULL, '', 1, 0, '', '', 0, 0, 0, NULL, '', 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, '2021-01-04 15:33:54');
INSERT INTO `sl_user` VALUES (102, 2, 1, NULL, '2020-11-20 17:44:48', '2020-11-20 18:50:41', 1, '', '', '撕裂的伤痕', '', '', 'http://a.test.com/uploads/20210104/ce24c06d1f3d3f4b9ace0e5bfe6b2c1a.jpg', '', '113.68.201.251', '', NULL, '', 1, 0, '', '', 0, 0, 0, NULL, '', 0, NULL, 0, 0, 0, 0, 0, '广州', '广东', '中国', NULL);
INSERT INTO `sl_user` VALUES (113, 2, 1, NULL, '2020-10-16 16:24:54', '2020-08-19 15:23:31', 1, '', '', '蓝色妖姬', '', '', 'http://a.test.com/uploads/20210104/ce24c06d1f3d3f4b9ace0e5bfe6b2c1a.jpg', '', '81.68.172.243', '', NULL, '', 1, 0, '', '', 0, 0, 0, NULL, '', 0, NULL, 0, 0, 2, 0, 0, '深圳', '广东', '中国', '2020-08-31 16:15:05');
INSERT INTO `sl_user` VALUES (142, 4, 1, NULL, '2019-03-06 14:56:10', '2019-03-06 14:56:10', 1, '', '', '减肥八五折', '', '', 'http://a.test.com/uploads/20210104/ce24c06d1f3d3f4b9ace0e5bfe6b2c1a.jpg', '', '', '', NULL, '', 1, 0, '', '', 0, 0, 0, NULL, '', 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, '2019-03-06 14:56:10');
INSERT INTO `sl_user` VALUES (143, 4, 1, NULL, '2019-03-06 14:56:10', '2019-03-06 14:56:10', 1, '', '', 'sumenyounv', '', '', 'http://a.test.com/uploads/20210104/ce24c06d1f3d3f4b9ace0e5bfe6b2c1a.jpg', '', '', '', NULL, '', 1, 0, '', '', 0, 0, 0, NULL, '', 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, '2019-03-06 14:56:10');
INSERT INTO `sl_user` VALUES (144, 4, 1, NULL, '2019-03-06 14:56:10', '2019-03-06 14:56:10', 1, '', '', '橙子', '', '', 'http://a.test.com/uploads/20210104/ce24c06d1f3d3f4b9ace0e5bfe6b2c1a.jpg', '', '', '', NULL, '', 1, 0, '', '', 0, 0, 0, NULL, '', 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, '2019-03-06 14:56:10');
INSERT INTO `sl_user` VALUES (145, 4, 1, NULL, '2019-03-06 14:56:10', '2019-03-06 14:56:10', 1, '', '', '豆丁', '', '', 'http://a.test.com/uploads/20210104/ce24c06d1f3d3f4b9ace0e5bfe6b2c1a.jpg', '', '', '', NULL, '', 1, 0, '', '', 0, 0, 0, NULL, '', 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, '2019-03-06 14:56:10');
INSERT INTO `sl_user` VALUES (146, 4, 1, NULL, '2019-03-06 14:56:10', '2019-03-06 14:56:10', 1, '', '', '王大锤', '', '', 'http://a.test.com/uploads/20210104/ce24c06d1f3d3f4b9ace0e5bfe6b2c1a.jpg', '', '', '', NULL, '', 1, 0, '', '', 0, 0, 0, NULL, '', 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, '2019-03-06 14:56:10');
INSERT INTO `sl_user` VALUES (147, 4, 1, NULL, '2019-03-06 14:56:10', '2019-03-06 14:56:10', 1, '', '', '韦小侯爷', '', '', 'http://a.test.com/uploads/20210104/ce24c06d1f3d3f4b9ace0e5bfe6b2c1a.jpg', '', '', '', NULL, '', 1, 0, '', '', 0, 0, 0, NULL, '', 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, '2019-03-06 14:56:10');
INSERT INTO `sl_user` VALUES (148, 4, 1, NULL, '2019-03-06 14:56:10', '2019-03-06 14:56:10', 1, '', '', '今天也要开心', '', '', 'http://a.test.com/uploads/20210104/ce24c06d1f3d3f4b9ace0e5bfe6b2c1a.jpg', '', '', '', NULL, '', 1, 0, '', '', 0, 0, 0, NULL, '', 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, '2019-03-06 14:56:10');
INSERT INTO `sl_user` VALUES (149, 4, 1, NULL, '2019-03-06 14:56:10', '2019-03-06 14:56:10', 1, '', '', '哩哩在哪里', '', '', 'http://a.test.com/uploads/20210104/ce24c06d1f3d3f4b9ace0e5bfe6b2c1a.jpg', '', '', '', NULL, '', 1, 0, '', '', 0, 0, 0, NULL, '', 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, '2021-01-04 10:52:10');
INSERT INTO `sl_user` VALUES (150, 4, 1, NULL, '2019-03-06 14:56:10', '2019-03-06 14:56:10', 1, '', '', '杨草', '', '', 'http://a.test.com/uploads/20210104/ce24c06d1f3d3f4b9ace0e5bfe6b2c1a.jpg', '', '', '', NULL, '', 1, 0, '', '', 0, 0, 0, NULL, '', 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, '2019-03-06 14:56:10');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
