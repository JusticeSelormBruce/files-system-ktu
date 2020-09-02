/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : dms

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-07-09 11:28:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `departments`
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES ('1', 'ICT', ' ICT Directorate', '2020-07-09 11:09:41', '2020-07-09 11:09:41');

-- ----------------------------
-- Table structure for `dispatches`
-- ----------------------------
DROP TABLE IF EXISTS `dispatches`;
CREATE TABLE `dispatches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_whom_receive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_letter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_letter` int(11) NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dispatches_office_id_foreign` (`office_id`),
  KEY `dispatches_user_id_foreign` (`user_id`),
  CONSTRAINT `dispatches_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`),
  CONSTRAINT `dispatches_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of dispatches
-- ----------------------------

-- ----------------------------
-- Table structure for `failed_jobs`
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for `incomings`
-- ----------------------------
DROP TABLE IF EXISTS `incomings`;
CREATE TABLE `incomings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_whom_receive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_letter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_letter` int(11) NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incomings_office_id_foreign` (`office_id`),
  KEY `incomings_user_id_foreign` (`user_id`),
  CONSTRAINT `incomings_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`),
  CONSTRAINT `incomings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of incomings
-- ----------------------------

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('4', '2020_02_20_102656_create_routes_table', '1');
INSERT INTO `migrations` VALUES ('5', '2020_02_20_112829_create_departments_table', '1');
INSERT INTO `migrations` VALUES ('6', '2020_02_20_112929_create_offices_table', '1');
INSERT INTO `migrations` VALUES ('7', '2020_02_20_115155_create_dispatches_table', '1');
INSERT INTO `migrations` VALUES ('8', '2020_02_20_115300_create_incomings_table', '1');
INSERT INTO `migrations` VALUES ('9', '2020_02_20_124332_create_m_c_l_s_table', '1');
INSERT INTO `migrations` VALUES ('10', '2020_07_09_110418_create_roles_table', '1');

-- ----------------------------
-- Table structure for `m_c_l_s`
-- ----------------------------
DROP TABLE IF EXISTS `m_c_l_s`;
CREATE TABLE `m_c_l_s` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `m_c_l_s_office_id_foreign` (`office_id`),
  CONSTRAINT `m_c_l_s_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of m_c_l_s
-- ----------------------------

-- ----------------------------
-- Table structure for `offices`
-- ----------------------------
DROP TABLE IF EXISTS `offices`;
CREATE TABLE `offices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departments_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offices_departments_id_foreign` (`departments_id`),
  CONSTRAINT `offices_departments_id_foreign` FOREIGN KEY (`departments_id`) REFERENCES `departments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of offices
-- ----------------------------
INSERT INTO `offices` VALUES ('1', 'Main Office', '1', '2020-07-09 11:09:41', '2020-07-09 11:09:41');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `routes_ids` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_user_id_foreign` (`user_id`),
  CONSTRAINT `roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', '[2,3,4,5,6]', '1', '2020-07-09 11:09:41', '2020-07-09 11:09:41');
INSERT INTO `roles` VALUES ('2', '[6,7,8,10]', '2', '2020-07-09 11:21:59', '2020-07-09 11:21:59');

-- ----------------------------
-- Table structure for `routes`
-- ----------------------------
DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of routes
-- ----------------------------
INSERT INTO `routes` VALUES ('1', 'Roles', '/admin/role-index', '2020-07-09 11:09:41', '2020-07-09 11:09:41');
INSERT INTO `routes` VALUES ('2', 'Departments', '/admin/department-index', '2020-07-09 11:09:41', '2020-07-09 11:09:41');
INSERT INTO `routes` VALUES ('3', 'Privilege', '/admin/assign-privilege-index', '2020-07-09 11:09:41', '2020-07-09 11:09:41');
INSERT INTO `routes` VALUES ('4', 'User Account', '/admin/user-accounts-index', '2020-07-09 11:09:41', '2020-07-09 11:09:41');
INSERT INTO `routes` VALUES ('5', 'Offices', '/admin/offices-index', '2020-07-09 11:09:41', '2020-07-09 11:09:41');
INSERT INTO `routes` VALUES ('6', 'Incoming', '/incoming-index', '2020-07-09 11:09:41', '2020-07-09 11:09:41');
INSERT INTO `routes` VALUES ('7', 'Dispatch', '/dispatch-index', '2020-07-09 11:09:41', '2020-07-09 11:09:41');
INSERT INTO `routes` VALUES ('8', 'Tracking', '/tracking-index', '2020-07-09 11:09:41', '2020-07-09 11:09:41');
INSERT INTO `routes` VALUES ('9', 'Reset Password', '/admin/reset-password', '2020-07-09 11:09:41', '2020-07-09 11:09:41');
INSERT INTO `routes` VALUES ('10', 'Change Password', '/change-password-index', '2020-07-09 11:09:41', '2020-07-09 11:09:41');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_id` bigint(20) unsigned DEFAULT NULL,
  `office_id` bigint(20) unsigned DEFAULT NULL,
  `user_role_id` bigint(20) unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_dept_id_foreign` (`dept_id`),
  KEY `users_office_id_foreign` (`office_id`),
  CONSTRAINT `users_dept_id_foreign` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`id`),
  CONSTRAINT `users_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Administrator', 'admin@gmail.com', null, '$2y$10$yCajGQ7Tm0xRp65F3OJTNuKI4d6inCGZA7LRvTxwsssBrAW6mZMoO', '1', '1', null, null, '2020-07-09 11:09:41', '2020-07-09 11:09:41');
INSERT INTO `users` VALUES ('2', 'Selorm justice Bruce', 'ewave80@gmail.com', null, '$2y$10$wB5CRqV/JGX/1eC2QHzvGu4BNe5mo4W5X1exXTAH02d16HoO/n3J.', null, null, null, null, '2020-07-09 11:14:12', '2020-07-09 11:14:12');
