-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: nail_saloon
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `wp_actionscheduler_actions`
--

DROP TABLE IF EXISTS `wp_actionscheduler_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_actionscheduler_actions` (
  `action_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hook` varchar(191) NOT NULL,
  `status` varchar(20) NOT NULL,
  `scheduled_date_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  `scheduled_date_local` datetime DEFAULT '0000-00-00 00:00:00',
  `priority` tinyint(3) unsigned NOT NULL DEFAULT 10,
  `args` varchar(191) DEFAULT NULL,
  `schedule` longtext DEFAULT NULL,
  `group_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `attempts` int(11) NOT NULL DEFAULT 0,
  `last_attempt_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  `last_attempt_local` datetime DEFAULT '0000-00-00 00:00:00',
  `claim_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `extended_args` varchar(8000) DEFAULT NULL,
  PRIMARY KEY (`action_id`),
  KEY `hook_status_scheduled_date_gmt` (`hook`(163),`status`,`scheduled_date_gmt`),
  KEY `status_scheduled_date_gmt` (`status`,`scheduled_date_gmt`),
  KEY `scheduled_date_gmt` (`scheduled_date_gmt`),
  KEY `args` (`args`),
  KEY `group_id` (`group_id`),
  KEY `last_attempt_gmt` (`last_attempt_gmt`),
  KEY `claim_id_status_priority_scheduled_date_gmt` (`claim_id`,`status`,`priority`,`scheduled_date_gmt`),
  KEY `status_last_attempt_gmt` (`status`,`last_attempt_gmt`),
  KEY `status_claim_id` (`status`,`claim_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_actionscheduler_actions`
--

LOCK TABLES `wp_actionscheduler_actions` WRITE;
/*!40000 ALTER TABLE `wp_actionscheduler_actions` DISABLE KEYS */;
INSERT INTO `wp_actionscheduler_actions` VALUES (7,'action_scheduler/migration_hook','complete','2026-11-07 11:31:41','2026-11-07 11:31:41',10,'[]','O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1794051101;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1794051101;}',1,1,'2026-11-07 11:31:46','2026-11-07 11:31:46',2,NULL),(8,'action_scheduler_run_recurring_actions_schedule_hook','pending','2026-11-08 03:00:00','2026-11-08 03:00:00',20,'[]','O:32:\"ActionScheduler_IntervalSchedule\":5:{s:22:\"\0*\0scheduled_timestamp\";i:1794106800;s:18:\"\0*\0first_timestamp\";i:1794106800;s:13:\"\0*\0recurrence\";i:86400;s:49:\"\0ActionScheduler_IntervalSchedule\0start_timestamp\";i:1794106800;s:53:\"\0ActionScheduler_IntervalSchedule\0interval_in_seconds\";i:86400;}',2,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,NULL),(9,'wp_mail_smtp_summary_report_email','pending','2026-11-09 14:00:00','2026-11-09 14:00:00',10,'[null]','O:32:\"ActionScheduler_IntervalSchedule\":5:{s:22:\"\0*\0scheduled_timestamp\";i:1794232800;s:18:\"\0*\0first_timestamp\";i:1794232800;s:13:\"\0*\0recurrence\";i:604800;s:49:\"\0ActionScheduler_IntervalSchedule\0start_timestamp\";i:1794232800;s:53:\"\0ActionScheduler_IntervalSchedule\0interval_in_seconds\";i:604800;}',3,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,NULL),(10,'wp_mail_smtp_admin_notifications_update','complete','2026-11-07 11:32:46','2026-11-07 11:32:46',10,'[null]','O:32:\"ActionScheduler_IntervalSchedule\":5:{s:22:\"\0*\0scheduled_timestamp\";i:1794051166;s:18:\"\0*\0first_timestamp\";i:1794051166;s:13:\"\0*\0recurrence\";i:86400;s:49:\"\0ActionScheduler_IntervalSchedule\0start_timestamp\";i:1794051166;s:53:\"\0ActionScheduler_IntervalSchedule\0interval_in_seconds\";i:86400;}',3,1,'2026-11-07 11:34:07','2026-11-07 11:34:07',4,NULL),(11,'wp_mail_smtp_admin_notifications_update','pending','2026-11-08 11:34:07','2026-11-08 11:34:07',10,'[null]','O:32:\"ActionScheduler_IntervalSchedule\":5:{s:22:\"\0*\0scheduled_timestamp\";i:1794137647;s:18:\"\0*\0first_timestamp\";i:1794051166;s:13:\"\0*\0recurrence\";i:86400;s:49:\"\0ActionScheduler_IntervalSchedule\0start_timestamp\";i:1794137647;s:53:\"\0ActionScheduler_IntervalSchedule\0interval_in_seconds\";i:86400;}',3,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,NULL),(12,'action_scheduler/migration_hook','complete','2026-11-07 11:48:44','2026-11-07 11:48:44',10,'[]','O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1794052124;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1794052124;}',1,1,'2026-11-07 11:49:21','2026-11-07 11:49:21',20,NULL);
/*!40000 ALTER TABLE `wp_actionscheduler_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_actionscheduler_claims`
--

DROP TABLE IF EXISTS `wp_actionscheduler_claims`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_actionscheduler_claims` (
  `claim_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date_created_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`claim_id`),
  KEY `date_created_gmt` (`date_created_gmt`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_actionscheduler_claims`
--

LOCK TABLES `wp_actionscheduler_claims` WRITE;
/*!40000 ALTER TABLE `wp_actionscheduler_claims` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_actionscheduler_claims` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_actionscheduler_groups`
--

DROP TABLE IF EXISTS `wp_actionscheduler_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_actionscheduler_groups` (
  `group_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `slug` (`slug`(191))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_actionscheduler_groups`
--

LOCK TABLES `wp_actionscheduler_groups` WRITE;
/*!40000 ALTER TABLE `wp_actionscheduler_groups` DISABLE KEYS */;
INSERT INTO `wp_actionscheduler_groups` VALUES (1,'action-scheduler-migration'),(2,'ActionScheduler'),(3,'wp_mail_smtp');
/*!40000 ALTER TABLE `wp_actionscheduler_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_actionscheduler_logs`
--

DROP TABLE IF EXISTS `wp_actionscheduler_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_actionscheduler_logs` (
  `log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` bigint(20) unsigned NOT NULL,
  `message` text NOT NULL,
  `log_date_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  `log_date_local` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`log_id`),
  KEY `action_id` (`action_id`),
  KEY `log_date_gmt` (`log_date_gmt`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_actionscheduler_logs`
--

LOCK TABLES `wp_actionscheduler_logs` WRITE;
/*!40000 ALTER TABLE `wp_actionscheduler_logs` DISABLE KEYS */;
INSERT INTO `wp_actionscheduler_logs` VALUES (1,7,'action created','2026-11-07 11:30:41','2026-11-07 11:30:41'),(2,8,'action created','2026-11-07 11:30:42','2026-11-07 11:30:42'),(3,7,'action started via WP Cron','2026-11-07 11:31:46','2026-11-07 11:31:46'),(4,7,'action complete via WP Cron','2026-11-07 11:31:46','2026-11-07 11:31:46'),(5,9,'action created','2026-11-07 11:31:46','2026-11-07 11:31:46'),(6,10,'action created','2026-11-07 11:31:46','2026-11-07 11:31:46'),(7,10,'action started via WP Cron','2026-11-07 11:34:06','2026-11-07 11:34:06'),(8,10,'action complete via WP Cron','2026-11-07 11:34:07','2026-11-07 11:34:07'),(9,11,'action created','2026-11-07 11:34:07','2026-11-07 11:34:07'),(10,12,'action created','2026-11-07 11:47:44','2026-11-07 11:47:44'),(11,12,'action started via Async Request','2026-11-07 11:49:21','2026-11-07 11:49:21'),(12,12,'action complete via Async Request','2026-11-07 11:49:21','2026-11-07 11:49:21');
/*!40000 ALTER TABLE `wp_actionscheduler_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_commentmeta`
--

DROP TABLE IF EXISTS `wp_commentmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_commentmeta`
--

LOCK TABLES `wp_commentmeta` WRITE;
/*!40000 ALTER TABLE `wp_commentmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_commentmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_comments`
--

DROP TABLE IF EXISTS `wp_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT 0,
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT 0,
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT 'comment',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT 0,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_comments`
--

LOCK TABLES `wp_comments` WRITE;
/*!40000 ALTER TABLE `wp_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_links`
--

DROP TABLE IF EXISTS `wp_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT 1,
  `link_rating` int(11) NOT NULL DEFAULT 0,
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_links`
--

LOCK TABLES `wp_links` WRITE;
/*!40000 ALTER TABLE `wp_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_options`
--

DROP TABLE IF EXISTS `wp_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`),
  KEY `autoload` (`autoload`)
) ENGINE=InnoDB AUTO_INCREMENT=252 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_options`
--

LOCK TABLES `wp_options` WRITE;
/*!40000 ALTER TABLE `wp_options` DISABLE KEYS */;
INSERT INTO `wp_options` VALUES (1,'cron','a:15:{i:1794052300;a:1:{s:26:\"action_scheduler_run_queue\";a:1:{s:32:\"0d04ed39571b55704c122d726248bbac\";a:3:{s:8:\"schedule\";s:12:\"every_minute\";s:4:\"args\";a:1:{i:0;s:7:\"WP Cron\";}s:8:\"interval\";i:60;}}}i:1794053255;a:1:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1794053256;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1794055006;a:1:{s:27:\"wpseo_indexable_index_batch\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:15:\"fifteen_minutes\";s:4:\"args\";a:0:{}s:8:\"interval\";i:900;}}}i:1794055055;a:1:{s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1794056855;a:1:{s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1794092868;a:1:{s:21:\"wp_update_user_counts\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1794094240;a:1:{s:33:\"updraftplus_clean_temporary_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1794136056;a:3:{s:30:\"wp_site_health_scheduled_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}s:32:\"recovery_mode_clean_expired_keys\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:41:\"wp_privacy_personal_data_cleanup_requests\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1794136067;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1794136072;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1794137439;a:1:{s:31:\"wpseo_permalink_structure_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1794137464;a:2:{s:29:\"wpseo_detect_default_seo_data\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:13:\"wpseo-reindex\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1794655864;a:1:{s:28:\"wpseo_expiring_store_cleanup\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}s:7:\"version\";i:2;}','on'),(2,'siteurl','http://localhost/nail-saloon','on'),(3,'home','http://localhost/nail-saloon','on'),(4,'blogname','Maison Belle Nails &amp; Spa','on'),(5,'blogdescription','Where every detail shines.','on'),(6,'users_can_register','0','on'),(7,'admin_email','muhammadfaraz991@gmail.com','on'),(8,'start_of_week','1','on'),(9,'use_balanceTags','0','on'),(10,'use_smilies','1','on'),(11,'require_name_email','1','on'),(12,'comments_notify','1','on'),(13,'posts_per_rss','10','on'),(14,'rss_use_excerpt','0','on'),(15,'mailserver_url','mail.example.com','on'),(16,'mailserver_login','login@example.com','on'),(17,'mailserver_pass','','on'),(18,'mailserver_port','110','on'),(19,'default_category','1','on'),(20,'default_comment_status','closed','on'),(21,'default_ping_status','open','on'),(22,'default_pingback_flag','1','on'),(23,'posts_per_page','10','on'),(24,'date_format','F j, Y','on'),(25,'time_format','g:i a','on'),(26,'links_updated_date_format','F j, Y g:i a','on'),(27,'comment_moderation','0','on'),(28,'moderation_notify','1','on'),(29,'permalink_structure','/%postname%/','on'),(30,'rewrite_rules','a:92:{s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:17:\"^wp-sitemap\\.xml$\";s:23:\"index.php?sitemap=index\";s:17:\"^wp-sitemap\\.xsl$\";s:36:\"index.php?sitemap-stylesheet=sitemap\";s:23:\"^wp-sitemap-index\\.xsl$\";s:34:\"index.php?sitemap-stylesheet=index\";s:48:\"^wp-sitemap-([a-z]+?)-([a-z\\d_-]+?)-(\\d+?)\\.xml$\";s:75:\"index.php?sitemap=$matches[1]&sitemap-subtype=$matches[2]&paged=$matches[3]\";s:34:\"^wp-sitemap-([a-z]+?)-(\\d+?)\\.xml$\";s:47:\"index.php?sitemap=$matches[1]&paged=$matches[2]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:27:\"comment-page-([0-9]{1,})/?$\";s:39:\"index.php?&page_id=54&cpage=$matches[1]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";s:27:\"[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\"[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\"[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"([^/]+)/embed/?$\";s:37:\"index.php?name=$matches[1]&embed=true\";s:20:\"([^/]+)/trackback/?$\";s:31:\"index.php?name=$matches[1]&tb=1\";s:40:\"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:35:\"([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:28:\"([^/]+)/page/?([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&paged=$matches[2]\";s:35:\"([^/]+)/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&cpage=$matches[2]\";s:24:\"([^/]+)(?:/([0-9]+))?/?$\";s:43:\"index.php?name=$matches[1]&page=$matches[2]\";s:16:\"[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:26:\"[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:46:\"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:22:\"[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";}','on'),(31,'hack_file','0','on'),(32,'blog_charset','UTF-8','on'),(33,'moderation_keys','','off'),(34,'active_plugins','a:5:{i:0;s:36:\"contact-form-7/wp-contact-form-7.php\";i:1;s:39:\"maison-belle-core/maison-belle-core.php\";i:2;s:27:\"updraftplus/updraftplus.php\";i:3;s:24:\"wordpress-seo/wp-seo.php\";i:4;s:29:\"wp-mail-smtp/wp_mail_smtp.php\";}','on'),(35,'category_base','','on'),(36,'ping_sites','https://rpc.pingomatic.com/','on'),(37,'comment_max_links','2','on'),(38,'gmt_offset','0','on'),(39,'default_email_category','1','on'),(40,'recently_edited','','off'),(41,'template','generatepress','on'),(42,'stylesheet','maison-belle-child','on'),(43,'comment_registration','0','on'),(44,'html_type','text/html','on'),(45,'use_trackback','0','on'),(46,'default_role','subscriber','on'),(47,'db_version','61833','on'),(48,'uploads_use_yearmonth_folders','1','on'),(49,'upload_path','','on'),(50,'blog_public','1','on'),(51,'default_link_category','2','on'),(52,'show_on_front','page','on'),(53,'tag_base','','on'),(54,'show_avatars','1','on'),(55,'avatar_rating','G','on'),(56,'upload_url_path','','on'),(57,'thumbnail_size_w','150','on'),(58,'thumbnail_size_h','150','on'),(59,'thumbnail_crop','1','on'),(60,'medium_size_w','300','on'),(61,'medium_size_h','300','on'),(62,'avatar_default','mystery','on'),(63,'large_size_w','1024','on'),(64,'large_size_h','1024','on'),(65,'image_default_link_type','none','on'),(66,'image_default_size','','on'),(67,'image_default_align','','on'),(68,'close_comments_for_old_posts','0','on'),(69,'close_comments_days_old','14','on'),(70,'thread_comments','1','on'),(71,'thread_comments_depth','5','on'),(72,'page_comments','0','on'),(73,'comments_per_page','50','on'),(74,'default_comments_page','newest','on'),(75,'comment_order','asc','on'),(76,'sticky_posts','a:0:{}','on'),(77,'widget_categories','a:0:{}','on'),(78,'widget_text','a:0:{}','on'),(79,'widget_rss','a:0:{}','on'),(80,'uninstall_plugins','a:1:{s:24:\"wordpress-seo/wp-seo.php\";s:14:\"__return_false\";}','off'),(81,'timezone_string','','on'),(82,'page_for_posts','58','on'),(83,'page_on_front','54','on'),(84,'default_post_format','0','on'),(85,'link_manager_enabled','0','on'),(86,'finished_splitting_shared_terms','1','on'),(87,'site_icon','0','on'),(88,'medium_large_size_w','768','on'),(89,'medium_large_size_h','0','on'),(90,'wp_page_for_privacy_policy','3','on'),(91,'show_comments_cookies_opt_in','1','on'),(92,'admin_email_lifespan','1809601655','on'),(93,'disallowed_keys','','off'),(94,'comment_previously_approved','1','on'),(95,'auto_plugin_theme_update_emails','a:0:{}','off'),(96,'auto_update_core_dev','enabled','on'),(97,'auto_update_core_minor','enabled','on'),(98,'auto_update_core_major','enabled','on'),(99,'wp_force_deactivated_plugins','a:0:{}','on'),(100,'wp_attachment_pages_enabled','0','on'),(101,'wp_notes_notify','1','on'),(102,'initial_db_version','61833','on'),(103,'wp_user_roles','a:7:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:62:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;s:20:\"wpseo_manage_options\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:36:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:15:\"wpseo_bulk_edit\";b:1;s:28:\"wpseo_edit_advanced_metadata\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}s:13:\"wpseo_manager\";a:2:{s:4:\"name\";s:11:\"SEO Manager\";s:12:\"capabilities\";a:38:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:15:\"wpseo_bulk_edit\";b:1;s:28:\"wpseo_edit_advanced_metadata\";b:1;s:20:\"wpseo_manage_options\";b:1;s:23:\"view_site_health_checks\";b:1;}}s:12:\"wpseo_editor\";a:2:{s:4:\"name\";s:10:\"SEO Editor\";s:12:\"capabilities\";a:36:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:15:\"wpseo_bulk_edit\";b:1;s:28:\"wpseo_edit_advanced_metadata\";b:1;}}}','on'),(104,'fresh_site','0','off'),(105,'user_count','1','off'),(106,'widget_block','a:6:{i:2;a:1:{s:7:\"content\";s:19:\"<!-- wp:search /-->\";}i:3;a:1:{s:7:\"content\";s:154:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Recent Posts</h2><!-- /wp:heading --><!-- wp:latest-posts /--></div><!-- /wp:group -->\";}i:4;a:1:{s:7:\"content\";s:227:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Recent Comments</h2><!-- /wp:heading --><!-- wp:latest-comments {\"displayAvatar\":false,\"displayDate\":false,\"displayExcerpt\":false} /--></div><!-- /wp:group -->\";}i:5;a:1:{s:7:\"content\";s:146:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Archives</h2><!-- /wp:heading --><!-- wp:archives /--></div><!-- /wp:group -->\";}i:6;a:1:{s:7:\"content\";s:150:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Categories</h2><!-- /wp:heading --><!-- wp:categories /--></div><!-- /wp:group -->\";}s:12:\"_multiwidget\";i:1;}','auto'),(107,'sidebars_widgets','a:12:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:3:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";}s:9:\"sidebar-2\";a:2:{i:0;s:7:\"block-5\";i:1;s:7:\"block-6\";}s:6:\"header\";a:0:{}s:8:\"footer-1\";a:0:{}s:8:\"footer-2\";a:0:{}s:8:\"footer-3\";a:0:{}s:8:\"footer-4\";a:0:{}s:8:\"footer-5\";a:0:{}s:10:\"footer-bar\";a:0:{}s:7:\"top-bar\";a:0:{}s:13:\"array_version\";i:3;}','auto'),(108,'widget_pages','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),(109,'widget_calendar','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),(110,'widget_archives','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),(111,'widget_media_audio','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),(112,'widget_media_image','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),(113,'widget_media_gallery','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),(114,'widget_media_video','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),(115,'widget_meta','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),(116,'widget_search','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),(117,'widget_recent-posts','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),(118,'widget_recent-comments','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),(119,'widget_tag_cloud','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),(120,'widget_nav_menu','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),(121,'widget_custom_html','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),(125,'theme_mods_twentytwentyfive','a:2:{s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1794051035;s:4:\"data\";a:3:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:3:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";}s:9:\"sidebar-2\";a:2:{i:0;s:7:\"block-5\";i:1;s:7:\"block-6\";}}}}','off'),(128,'recovery_keys','a:0:{}','off'),(140,'can_compress_scripts','1','on'),(155,'finished_updating_comment_type','1','auto'),(160,'generate_dynamic_css_output','body{background-color:var(--base-2);color:var(--contrast);}a{color:var(--accent);}a{text-decoration:underline;}.entry-title a, .site-branding a, a.button, .wp-block-button__link, .main-navigation a{text-decoration:none;}a:hover, a:focus, a:active{color:var(--contrast);}.wp-block-group__inner-container{max-width:1200px;margin-left:auto;margin-right:auto;}:root{--contrast:#222222;--contrast-2:#575760;--contrast-3:#b2b2be;--base:#f0f0f0;--base-2:#f7f8f9;--base-3:#ffffff;--accent:#1e73be;}:root .has-contrast-color{color:var(--contrast);}:root .has-contrast-background-color{background-color:var(--contrast);}:root .has-contrast-2-color{color:var(--contrast-2);}:root .has-contrast-2-background-color{background-color:var(--contrast-2);}:root .has-contrast-3-color{color:var(--contrast-3);}:root .has-contrast-3-background-color{background-color:var(--contrast-3);}:root .has-base-color{color:var(--base);}:root .has-base-background-color{background-color:var(--base);}:root .has-base-2-color{color:var(--base-2);}:root .has-base-2-background-color{background-color:var(--base-2);}:root .has-base-3-color{color:var(--base-3);}:root .has-base-3-background-color{background-color:var(--base-3);}:root .has-accent-color{color:var(--accent);}:root .has-accent-background-color{background-color:var(--accent);}.top-bar{background-color:#636363;color:#ffffff;}.top-bar a{color:#ffffff;}.top-bar a:hover{color:#303030;}.site-header{background-color:var(--base-3);}.main-title a,.main-title a:hover{color:var(--contrast);}.site-description{color:var(--contrast-2);}.mobile-menu-control-wrapper .menu-toggle,.mobile-menu-control-wrapper .menu-toggle:hover,.mobile-menu-control-wrapper .menu-toggle:focus,.has-inline-mobile-toggle #site-navigation.toggled{background-color:rgba(0, 0, 0, 0.02);}.main-navigation,.main-navigation ul ul{background-color:var(--base-3);}.main-navigation .main-nav ul li a, .main-navigation .menu-toggle, .main-navigation .menu-bar-items{color:var(--contrast);}.main-navigation .main-nav ul li:not([class*=\"current-menu-\"]):hover > a, .main-navigation .main-nav ul li:not([class*=\"current-menu-\"]):focus > a, .main-navigation .main-nav ul li.sfHover:not([class*=\"current-menu-\"]) > a, .main-navigation .menu-bar-item:hover > a, .main-navigation .menu-bar-item.sfHover > a{color:var(--accent);}button.menu-toggle:hover,button.menu-toggle:focus{color:var(--contrast);}.main-navigation .main-nav ul li[class*=\"current-menu-\"] > a{color:var(--accent);}.navigation-search input[type=\"search\"],.navigation-search input[type=\"search\"]:active, .navigation-search input[type=\"search\"]:focus, .main-navigation .main-nav ul li.search-item.active > a, .main-navigation .menu-bar-items .search-item.active > a{color:var(--accent);}.main-navigation ul ul{background-color:var(--base);}.separate-containers .inside-article, .separate-containers .comments-area, .separate-containers .page-header, .one-container .container, .separate-containers .paging-navigation, .inside-page-header{background-color:var(--base-3);}.entry-title a{color:var(--contrast);}.entry-title a:hover{color:var(--contrast-2);}.entry-meta{color:var(--contrast-2);}.sidebar .widget{background-color:var(--base-3);}.footer-widgets{background-color:var(--base-3);}.site-info{background-color:var(--base-3);}input[type=\"text\"],input[type=\"email\"],input[type=\"url\"],input[type=\"password\"],input[type=\"search\"],input[type=\"tel\"],input[type=\"number\"],textarea,select{color:var(--contrast);background-color:var(--base-2);border-color:var(--base);}input[type=\"text\"]:focus,input[type=\"email\"]:focus,input[type=\"url\"]:focus,input[type=\"password\"]:focus,input[type=\"search\"]:focus,input[type=\"tel\"]:focus,input[type=\"number\"]:focus,textarea:focus,select:focus{color:var(--contrast);background-color:var(--base-2);border-color:var(--contrast-3);}button,html input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"],a.button,a.wp-block-button__link:not(.has-background){color:#ffffff;background-color:#55555e;}button:hover,html input[type=\"button\"]:hover,input[type=\"reset\"]:hover,input[type=\"submit\"]:hover,a.button:hover,button:focus,html input[type=\"button\"]:focus,input[type=\"reset\"]:focus,input[type=\"submit\"]:focus,a.button:focus,a.wp-block-button__link:not(.has-background):active,a.wp-block-button__link:not(.has-background):focus,a.wp-block-button__link:not(.has-background):hover{color:#ffffff;background-color:#3f4047;}a.generate-back-to-top{background-color:rgba( 0,0,0,0.4 );color:#ffffff;}a.generate-back-to-top:hover,a.generate-back-to-top:focus{background-color:rgba( 0,0,0,0.6 );color:#ffffff;}:root{--gp-search-modal-bg-color:var(--base-3);--gp-search-modal-text-color:var(--contrast);--gp-search-modal-overlay-bg-color:rgba(0,0,0,0.2);}@media (max-width:768px){.main-navigation .menu-bar-item:hover > a, .main-navigation .menu-bar-item.sfHover > a{background:none;color:var(--contrast);}}.nav-below-header .main-navigation .inside-navigation.grid-container, .nav-above-header .main-navigation .inside-navigation.grid-container{padding:0px 20px 0px 20px;}.site-main .wp-block-group__inner-container{padding:40px;}.separate-containers .paging-navigation{padding-top:20px;padding-bottom:20px;}.entry-content .alignwide, body:not(.no-sidebar) .entry-content .alignfull{margin-left:-40px;width:calc(100% + 80px);max-width:calc(100% + 80px);}.rtl .menu-item-has-children .dropdown-menu-toggle{padding-left:20px;}.rtl .main-navigation .main-nav ul li.menu-item-has-children > a{padding-right:20px;}@media (max-width:768px){.separate-containers .inside-article, .separate-containers .comments-area, .separate-containers .page-header, .separate-containers .paging-navigation, .one-container .site-content, .inside-page-header{padding:30px;}.site-main .wp-block-group__inner-container{padding:30px;}.inside-top-bar{padding-right:30px;padding-left:30px;}.inside-header{padding-right:30px;padding-left:30px;}.widget-area .widget{padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px;}.footer-widgets-container{padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px;}.inside-site-info{padding-right:30px;padding-left:30px;}.entry-content .alignwide, body:not(.no-sidebar) .entry-content .alignfull{margin-left:-30px;width:calc(100% + 60px);max-width:calc(100% + 60px);}.one-container .site-main .paging-navigation{margin-bottom:20px;}}','auto'),(161,'generate_dynamic_css_cached_version','3.6.1','auto'),(162,'theme_mods_maison-belle-child','a:2:{s:18:\"custom_css_post_id\";i:-1;s:18:\"nav_menu_locations\";a:2:{s:7:\"primary\";i:12;s:6:\"footer\";i:13;}}','on'),(163,'current_theme','Maison Belle Child','auto'),(164,'theme_switched','','auto'),(165,'yoast_migrations_free','a:1:{s:7:\"version\";s:4:\"28.8\";}','auto'),(166,'wpseo','a:124:{s:8:\"tracking\";b:0;s:16:\"toggled_tracking\";b:0;s:22:\"license_server_version\";b:0;s:15:\"ms_defaults_set\";b:0;s:40:\"ignore_search_engines_discouraged_notice\";b:0;s:19:\"indexing_first_time\";b:1;s:16:\"indexing_started\";b:0;s:15:\"indexing_reason\";s:26:\"permalink_settings_changed\";s:29:\"indexables_indexing_completed\";b:0;s:13:\"index_now_key\";s:0:\"\";s:7:\"version\";s:4:\"28.8\";s:16:\"previous_version\";s:0:\"\";s:20:\"disableadvanced_meta\";b:1;s:30:\"enable_headless_rest_endpoints\";b:1;s:17:\"ryte_indexability\";b:0;s:11:\"baiduverify\";s:0:\"\";s:12:\"googleverify\";s:0:\"\";s:8:\"msverify\";s:0:\"\";s:12:\"yandexverify\";s:0:\"\";s:12:\"ahrefsverify\";s:0:\"\";s:9:\"site_type\";s:0:\"\";s:20:\"has_multiple_authors\";s:0:\"\";s:16:\"environment_type\";s:0:\"\";s:23:\"content_analysis_active\";b:1;s:23:\"keyword_analysis_active\";b:1;s:34:\"inclusive_language_analysis_active\";b:0;s:21:\"enable_admin_bar_menu\";b:1;s:26:\"enable_cornerstone_content\";b:1;s:18:\"enable_xml_sitemap\";b:1;s:24:\"enable_text_link_counter\";b:1;s:16:\"enable_index_now\";b:1;s:19:\"enable_ai_generator\";b:1;s:22:\"ai_enabled_pre_default\";b:0;s:22:\"show_onboarding_notice\";b:1;s:18:\"first_activated_on\";i:1794051040;s:13:\"myyoast-oauth\";b:0;s:26:\"semrush_integration_active\";b:1;s:14:\"semrush_tokens\";a:0:{}s:20:\"semrush_country_code\";s:2:\"us\";s:19:\"permalink_structure\";s:12:\"/%postname%/\";s:8:\"home_url\";s:28:\"http://localhost/nail-saloon\";s:18:\"dynamic_permalinks\";b:0;s:17:\"category_base_url\";s:0:\"\";s:12:\"tag_base_url\";s:0:\"\";s:21:\"custom_taxonomy_slugs\";a:0:{}s:29:\"enable_enhanced_slack_sharing\";b:1;s:23:\"enable_metabox_insights\";b:1;s:23:\"enable_link_suggestions\";b:1;s:26:\"algolia_integration_active\";b:0;s:14:\"import_cursors\";a:0:{}s:13:\"workouts_data\";a:1:{s:13:\"configuration\";a:1:{s:13:\"finishedSteps\";a:0:{}}}s:28:\"configuration_finished_steps\";a:0:{}s:36:\"dismiss_configuration_workout_notice\";b:0;s:34:\"dismiss_premium_deactivated_notice\";b:0;s:19:\"importing_completed\";a:0:{}s:26:\"wincher_integration_active\";b:1;s:14:\"wincher_tokens\";a:0:{}s:36:\"wincher_automatically_add_keyphrases\";b:0;s:18:\"wincher_website_id\";s:0:\"\";s:18:\"first_time_install\";b:1;s:34:\"should_redirect_after_install_free\";b:0;s:34:\"activation_redirect_timestamp_free\";i:1794051403;s:18:\"remove_feed_global\";b:0;s:27:\"remove_feed_global_comments\";b:0;s:25:\"remove_feed_post_comments\";b:0;s:19:\"remove_feed_authors\";b:0;s:22:\"remove_feed_categories\";b:0;s:16:\"remove_feed_tags\";b:0;s:29:\"remove_feed_custom_taxonomies\";b:0;s:22:\"remove_feed_post_types\";b:0;s:18:\"remove_feed_search\";b:0;s:21:\"remove_atom_rdf_feeds\";b:0;s:17:\"remove_shortlinks\";b:0;s:21:\"remove_rest_api_links\";b:0;s:20:\"remove_rsd_wlw_links\";b:0;s:19:\"remove_oembed_links\";b:0;s:16:\"remove_generator\";b:0;s:20:\"remove_emoji_scripts\";b:0;s:24:\"remove_powered_by_header\";b:0;s:22:\"remove_pingback_header\";b:0;s:28:\"clean_campaign_tracking_urls\";b:0;s:16:\"clean_permalinks\";b:0;s:32:\"clean_permalinks_extra_variables\";s:0:\"\";s:14:\"search_cleanup\";b:0;s:20:\"search_cleanup_emoji\";b:0;s:23:\"search_cleanup_patterns\";b:0;s:22:\"search_character_limit\";i:50;s:20:\"deny_search_crawling\";b:0;s:21:\"deny_wp_json_crawling\";b:0;s:20:\"deny_adsbot_crawling\";b:0;s:19:\"deny_ccbot_crawling\";b:0;s:29:\"deny_google_extended_crawling\";b:0;s:20:\"deny_gptbot_crawling\";b:0;s:27:\"redirect_search_pretty_urls\";b:0;s:29:\"least_readability_ignore_list\";a:0:{}s:27:\"least_seo_score_ignore_list\";a:0:{}s:23:\"most_linked_ignore_list\";a:0:{}s:24:\"least_linked_ignore_list\";a:0:{}s:28:\"indexables_page_reading_list\";a:5:{i:0;b:0;i:1;b:0;i:2;b:0;i:3;b:0;i:4;b:0;}s:25:\"indexables_overview_state\";s:21:\"dashboard-not-visited\";s:28:\"last_known_public_post_types\";a:2:{i:0;s:4:\"post\";i:1;s:4:\"page\";}s:28:\"last_known_public_taxonomies\";a:3:{i:0;s:8:\"category\";i:1;s:8:\"post_tag\";i:2;s:11:\"post_format\";}s:23:\"last_known_no_unindexed\";a:2:{s:40:\"wpseo_total_unindexed_post_type_archives\";i:1794051403;s:31:\"wpseo_unindexed_post_link_count\";i:1794051403;}s:14:\"new_post_types\";a:0:{}s:14:\"new_taxonomies\";a:0:{}s:34:\"show_new_content_type_notification\";b:0;s:44:\"site_kit_configuration_permanently_dismissed\";b:0;s:18:\"site_kit_connected\";b:0;s:37:\"site_kit_tracking_setup_widget_loaded\";s:2:\"no\";s:41:\"site_kit_tracking_first_interaction_stage\";s:0:\"\";s:40:\"site_kit_tracking_last_interaction_stage\";s:0:\"\";s:52:\"site_kit_tracking_setup_widget_temporarily_dismissed\";s:2:\"no\";s:52:\"site_kit_tracking_setup_widget_permanently_dismissed\";s:2:\"no\";s:31:\"google_site_kit_feature_enabled\";b:0;s:25:\"ai_free_sparks_started_on\";N;s:15:\"enable_llms_txt\";b:0;s:15:\"last_updated_on\";b:0;s:17:\"default_seo_title\";a:0:{}s:21:\"default_seo_meta_desc\";a:0:{}s:18:\"first_activated_by\";i:1;s:34:\"enable_schema_aggregation_endpoint\";b:0;s:38:\"schema_aggregation_endpoint_enabled_on\";N;s:16:\"enable_task_list\";b:1;s:13:\"enable_schema\";b:1;}','auto'),(167,'wpseo_titles','a:129:{s:17:\"forcerewritetitle\";b:0;s:9:\"separator\";s:7:\"sc-pipe\";s:16:\"title-home-wpseo\";s:60:\"Maison Belle Nails & Spa %%sep%% Nail Salon & Spa in Houston\";s:18:\"title-author-wpseo\";s:41:\"%%name%%, Author at %%sitename%% %%page%%\";s:19:\"title-archive-wpseo\";s:38:\"%%date%% %%page%% %%sep%% %%sitename%%\";s:18:\"title-search-wpseo\";s:63:\"You searched for %%searchphrase%% %%page%% %%sep%% %%sitename%%\";s:15:\"title-404-wpseo\";s:35:\"Page not found %%sep%% %%sitename%%\";s:25:\"social-title-author-wpseo\";s:8:\"%%name%%\";s:26:\"social-title-archive-wpseo\";s:8:\"%%date%%\";s:31:\"social-description-author-wpseo\";s:0:\"\";s:32:\"social-description-archive-wpseo\";s:0:\"\";s:29:\"social-image-url-author-wpseo\";s:0:\"\";s:30:\"social-image-url-archive-wpseo\";s:0:\"\";s:28:\"social-image-id-author-wpseo\";i:0;s:29:\"social-image-id-archive-wpseo\";i:0;s:19:\"metadesc-home-wpseo\";s:163:\"Maison Belle Nails & Spa is a boutique nail salon in Houston offering refined manicures, pedicures, waxing and eyelash services in a calm, beautifully clean space.\";s:21:\"metadesc-author-wpseo\";s:0:\"\";s:22:\"metadesc-archive-wpseo\";s:0:\"\";s:9:\"rssbefore\";s:0:\"\";s:8:\"rssafter\";s:53:\"The post %%POSTLINK%% appeared first on %%BLOGLINK%%.\";s:20:\"noindex-author-wpseo\";b:1;s:28:\"noindex-author-noposts-wpseo\";b:1;s:21:\"noindex-archive-wpseo\";b:1;s:14:\"disable-author\";b:1;s:12:\"disable-date\";b:1;s:19:\"disable-post_format\";b:0;s:18:\"disable-attachment\";b:1;s:20:\"breadcrumbs-404crumb\";s:25:\"Error 404: Page not found\";s:29:\"breadcrumbs-display-blog-page\";b:1;s:20:\"breadcrumbs-boldlast\";b:0;s:25:\"breadcrumbs-archiveprefix\";s:12:\"Archives for\";s:18:\"breadcrumbs-enable\";b:1;s:16:\"breadcrumbs-home\";s:4:\"Home\";s:18:\"breadcrumbs-prefix\";s:0:\"\";s:24:\"breadcrumbs-searchprefix\";s:16:\"You searched for\";s:15:\"breadcrumbs-sep\";s:2:\"»\";s:12:\"website_name\";s:24:\"Maison Belle Nails & Spa\";s:11:\"person_name\";s:0:\"\";s:11:\"person_logo\";s:0:\"\";s:22:\"alternate_website_name\";s:0:\"\";s:12:\"company_logo\";s:0:\"\";s:12:\"company_name\";s:24:\"Maison Belle Nails & Spa\";s:22:\"company_alternate_name\";s:0:\"\";s:17:\"company_or_person\";s:7:\"company\";s:25:\"company_or_person_user_id\";b:0;s:17:\"stripcategorybase\";b:0;s:26:\"open_graph_frontpage_title\";s:12:\"%%sitename%%\";s:25:\"open_graph_frontpage_desc\";s:0:\"\";s:26:\"open_graph_frontpage_image\";s:0:\"\";s:24:\"publishing_principles_id\";i:0;s:25:\"ownership_funding_info_id\";i:0;s:29:\"actionable_feedback_policy_id\";i:0;s:21:\"corrections_policy_id\";i:0;s:16:\"ethics_policy_id\";i:0;s:19:\"diversity_policy_id\";i:0;s:28:\"diversity_staffing_report_id\";i:0;s:15:\"org-description\";s:0:\"\";s:9:\"org-email\";s:0:\"\";s:9:\"org-phone\";s:0:\"\";s:14:\"org-legal-name\";s:0:\"\";s:17:\"org-founding-date\";s:0:\"\";s:20:\"org-number-employees\";s:0:\"\";s:10:\"org-vat-id\";s:0:\"\";s:10:\"org-tax-id\";s:0:\"\";s:7:\"org-iso\";s:0:\"\";s:8:\"org-duns\";s:0:\"\";s:11:\"org-leicode\";s:0:\"\";s:9:\"org-naics\";s:0:\"\";s:10:\"title-post\";s:30:\"%%title%% %%sep%% %%sitename%%\";s:13:\"metadesc-post\";s:0:\"\";s:12:\"noindex-post\";b:0;s:23:\"display-metabox-pt-post\";b:1;s:23:\"post_types-post-maintax\";i:0;s:21:\"schema-page-type-post\";s:7:\"WebPage\";s:24:\"schema-article-type-post\";s:7:\"Article\";s:17:\"social-title-post\";s:9:\"%%title%%\";s:23:\"social-description-post\";s:0:\"\";s:21:\"social-image-url-post\";s:0:\"\";s:20:\"social-image-id-post\";i:0;s:10:\"title-page\";s:30:\"%%title%% %%sep%% %%sitename%%\";s:13:\"metadesc-page\";s:0:\"\";s:12:\"noindex-page\";b:0;s:23:\"display-metabox-pt-page\";b:1;s:23:\"post_types-page-maintax\";i:0;s:21:\"schema-page-type-page\";s:7:\"WebPage\";s:24:\"schema-article-type-page\";s:4:\"None\";s:17:\"social-title-page\";s:9:\"%%title%%\";s:23:\"social-description-page\";s:0:\"\";s:21:\"social-image-url-page\";s:0:\"\";s:20:\"social-image-id-page\";i:0;s:16:\"title-attachment\";s:39:\"%%title%% %%page%% %%sep%% %%sitename%%\";s:19:\"metadesc-attachment\";s:0:\"\";s:18:\"noindex-attachment\";b:0;s:29:\"display-metabox-pt-attachment\";b:1;s:29:\"post_types-attachment-maintax\";i:0;s:27:\"schema-page-type-attachment\";s:7:\"WebPage\";s:30:\"schema-article-type-attachment\";s:4:\"None\";s:18:\"title-tax-category\";s:53:\"%%term_title%% Archives %%page%% %%sep%% %%sitename%%\";s:21:\"metadesc-tax-category\";s:0:\"\";s:28:\"display-metabox-tax-category\";b:1;s:20:\"noindex-tax-category\";b:0;s:25:\"social-title-tax-category\";s:23:\"%%term_title%% Archives\";s:31:\"social-description-tax-category\";s:0:\"\";s:29:\"social-image-url-tax-category\";s:0:\"\";s:28:\"social-image-id-tax-category\";i:0;s:26:\"taxonomy-category-ptparent\";i:0;s:18:\"title-tax-post_tag\";s:53:\"%%term_title%% Archives %%page%% %%sep%% %%sitename%%\";s:21:\"metadesc-tax-post_tag\";s:0:\"\";s:28:\"display-metabox-tax-post_tag\";b:1;s:20:\"noindex-tax-post_tag\";b:0;s:25:\"social-title-tax-post_tag\";s:23:\"%%term_title%% Archives\";s:31:\"social-description-tax-post_tag\";s:0:\"\";s:29:\"social-image-url-tax-post_tag\";s:0:\"\";s:28:\"social-image-id-tax-post_tag\";i:0;s:26:\"taxonomy-post_tag-ptparent\";i:0;s:21:\"title-tax-post_format\";s:53:\"%%term_title%% Archives %%page%% %%sep%% %%sitename%%\";s:24:\"metadesc-tax-post_format\";s:0:\"\";s:31:\"display-metabox-tax-post_format\";b:1;s:23:\"noindex-tax-post_format\";b:1;s:28:\"social-title-tax-post_format\";s:23:\"%%term_title%% Archives\";s:34:\"social-description-tax-post_format\";s:0:\"\";s:32:\"social-image-url-tax-post_format\";s:0:\"\";s:31:\"social-image-id-tax-post_format\";i:0;s:29:\"taxonomy-post_format-ptparent\";i:0;s:14:\"person_logo_id\";i:0;s:15:\"company_logo_id\";i:0;s:17:\"company_logo_meta\";b:0;s:16:\"person_logo_meta\";b:0;s:29:\"open_graph_frontpage_image_id\";i:0;}','auto'),(168,'wpseo_social','a:20:{s:13:\"facebook_site\";s:0:\"\";s:13:\"instagram_url\";s:0:\"\";s:12:\"linkedin_url\";s:0:\"\";s:11:\"myspace_url\";s:0:\"\";s:16:\"og_default_image\";s:0:\"\";s:19:\"og_default_image_id\";s:0:\"\";s:18:\"og_frontpage_title\";s:0:\"\";s:17:\"og_frontpage_desc\";s:0:\"\";s:18:\"og_frontpage_image\";s:0:\"\";s:21:\"og_frontpage_image_id\";s:0:\"\";s:9:\"opengraph\";b:1;s:13:\"pinterest_url\";s:0:\"\";s:15:\"pinterestverify\";s:0:\"\";s:7:\"twitter\";b:1;s:12:\"twitter_site\";s:0:\"\";s:17:\"twitter_card_type\";s:19:\"summary_large_image\";s:11:\"youtube_url\";s:0:\"\";s:13:\"wikipedia_url\";s:0:\"\";s:17:\"other_social_urls\";a:0:{}s:12:\"mastodon_url\";s:0:\"\";}','auto'),(169,'wpseo_llmstxt','a:7:{s:23:\"llms_txt_selection_mode\";s:4:\"auto\";s:13:\"about_us_page\";i:0;s:12:\"contact_page\";i:0;s:10:\"terms_page\";i:0;s:19:\"privacy_policy_page\";i:0;s:9:\"shop_page\";i:0;s:20:\"other_included_pages\";a:0:{}}','auto'),(170,'wpseo_tracking_only','a:3:{s:25:\"task_list_first_opened_on\";s:0:\"\";s:22:\"task_first_actioned_on\";s:0:\"\";s:36:\"frontend_inspector_first_actioned_on\";s:0:\"\";}','auto'),(171,'action_scheduler_hybrid_store_demarkation','6','auto'),(172,'schema-ActionScheduler_StoreSchema','8.0.1794051040','auto'),(173,'schema-ActionScheduler_LoggerSchema','3.0.1794051040','auto'),(174,'wp_mail_smtp_initial_version','4.10.3','off'),(175,'wp_mail_smtp_version','4.10.3','off'),(176,'wp_mail_smtp','a:3:{s:4:\"mail\";a:6:{s:10:\"from_email\";s:26:\"muhammadfaraz991@gmail.com\";s:9:\"from_name\";s:11:\"Nail Saloon\";s:6:\"mailer\";s:4:\"mail\";s:11:\"return_path\";b:1;s:16:\"from_email_force\";b:1;s:15:\"from_name_force\";b:0;}s:4:\"smtp\";a:2:{s:7:\"autotls\";b:1;s:4:\"auth\";b:1;}s:7:\"general\";a:1:{s:29:\"summary_report_email_disabled\";b:0;}}','off'),(177,'wp_mail_smtp_activated_time','1794051040','off'),(178,'wp_mail_smtp_activated','a:1:{s:4:\"lite\";i:1794051040;}','auto'),(183,'updraftplus_start_onboarding','1','off'),(191,'updraftplus_version','1.26.14','on'),(192,'action_scheduler_lock_async-request-runner','6aef1040467404.84240974|1794052220','no'),(193,'wpcf7','a:2:{s:7:\"version\";s:5:\"6.1.7\";s:13:\"bulk_validate\";a:4:{s:9:\"timestamp\";i:1794051085;s:7:\"version\";s:5:\"6.1.7\";s:11:\"count_valid\";i:1;s:13:\"count_invalid\";i:0;}}','auto'),(195,'mb_settings','a:72:{s:10:\"salon_name\";s:24:\"Maison Belle Nails & Spa\";s:13:\"wordmark_main\";s:12:\"Maison Belle\";s:12:\"wordmark_sub\";s:11:\"Nails & Spa\";s:4:\"logo\";i:0;s:7:\"tagline\";s:26:\"Where every detail shines.\";s:11:\"description\";s:163:\"Maison Belle Nails & Spa is a boutique nail salon in Houston offering refined manicures, pedicures, waxing and eyelash services in a calm, beautifully clean space.\";s:12:\"announcement\";s:30:\"Walk-ins welcome · Open daily\";s:13:\"marquee_words\";s:86:\"Manicure\nPedicure\nGel Extensions\nWaxing\nLash Extensions\nNail Art\nSpa Rituals\nLash Lift\";s:6:\"street\";s:15:\"123 Main Street\";s:4:\"city\";s:7:\"Houston\";s:6:\"region\";s:2:\"TX\";s:6:\"postal\";s:5:\"77001\";s:7:\"country\";s:2:\"US\";s:5:\"phone\";s:14:\"(555) 123-4567\";s:9:\"phone_tel\";s:12:\"+15551234567\";s:5:\"email\";s:17:\"hello@example.com\";s:12:\"notify_email\";s:0:\"\";s:11:\"booking_url\";s:1:\"#\";s:10:\"book_label\";s:8:\"Book Now\";s:9:\"map_query\";s:34:\"123 Main Street, Houston, TX 77001\";s:3:\"lat\";s:7:\"29.7604\";s:3:\"lng\";s:8:\"-95.3698\";s:11:\"price_range\";s:2:\"$$\";s:8:\"currency\";s:1:\"$\";s:13:\"currency_code\";s:3:\"USD\";s:15:\"contact_form_id\";i:120;s:5:\"hours\";a:2:{i:0;a:5:{s:5:\"label\";s:11:\"Mon – Sat\";s:4:\"time\";s:12:\"10am – 7pm\";s:4:\"days\";a:6:{i:0;s:6:\"Monday\";i:1;s:7:\"Tuesday\";i:2;s:9:\"Wednesday\";i:3;s:8:\"Thursday\";i:4;s:6:\"Friday\";i:5;s:8:\"Saturday\";}s:5:\"opens\";s:5:\"10:00\";s:6:\"closes\";s:5:\"19:00\";}i:1;a:5:{s:5:\"label\";s:6:\"Sunday\";s:4:\"time\";s:12:\"11am – 5pm\";s:4:\"days\";a:1:{i:0;s:6:\"Sunday\";}s:5:\"opens\";s:5:\"11:00\";s:6:\"closes\";s:5:\"17:00\";}}s:16:\"social_instagram\";s:1:\"#\";s:15:\"social_facebook\";s:1:\"#\";s:13:\"social_google\";s:1:\"#\";s:11:\"social_yelp\";s:1:\"#\";s:12:\"hero_eyebrow\";s:27:\"Nail salon & spa · Houston\";s:10:\"hero_line1\";s:11:\"Where every\";s:10:\"hero_line2\";s:16:\"detail *shines.*\";s:9:\"hero_text\";s:110:\"An unhurried, beautifully clean sanctuary for manicures, pedicures, waxing and lashes, where craft meets calm.\";s:13:\"hero_cta_book\";s:19:\"Book an appointment\";s:13:\"hero_cta_view\";s:13:\"View services\";s:15:\"hero_image_main\";i:0;s:17:\"hero_image_accent\";i:0;s:12:\"rating_value\";s:3:\"4.9\";s:12:\"rating_count\";s:4:\"500+\";s:12:\"rating_label\";s:18:\"Placeholder rating\";s:11:\"rating_note\";s:21:\"(placeholder figures)\";s:5:\"strip\";a:3:{i:0;a:3:{s:4:\"icon\";s:4:\"hand\";s:5:\"title\";s:16:\"Walk-ins welcome\";s:4:\"text\";s:63:\"Drop by any day and we will do our best to seat you right away.\";}i:1;a:3:{s:4:\"icon\";s:7:\"sparkle\";s:5:\"title\";s:22:\"Appointments preferred\";s:4:\"text\";s:62:\"Reserve online to guarantee your time, especially on weekends.\";}i:2;a:3:{s:4:\"icon\";s:6:\"flower\";s:5:\"title\";s:10:\"Open daily\";s:4:\"text\";s:55:\"Mon–Sat 10am–7pm · Sun 11am–5pm. Tea on arrival.\";}}s:13:\"about_eyebrow\";s:9:\"Our story\";s:11:\"about_title\";s:26:\"A quieter kind of *luxury*\";s:8:\"about_p1\";s:150:\"Maison Belle Nails & Spa was imagined as a place to slow down. Soft light, thoughtful details and a team who treats every nail as a small work of art.\";s:8:\"about_p2\";s:180:\"We pair meticulous technique with premium products and a spotless, serene space, so you leave not only with beautiful nails, but with the feeling of having been truly looked after.\";s:10:\"about_list\";s:120:\"Hospital-grade sanitation, every guest, every time\nPremium, long-wear and gentle formulas\nTea, quiet music and zero rush\";s:10:\"about_link\";s:16:\"Explore services\";s:16:\"about_image_main\";i:0;s:18:\"about_image_accent\";i:0;s:16:\"services_eyebrow\";s:12:\"Our services\";s:14:\"services_title\";s:37:\"Crafted *care*, from fingertip to toe\";s:14:\"services_intro\";s:90:\"Four signature collections, each delivered with patience, precision and a little ceremony.\";s:11:\"why_eyebrow\";s:16:\"Why Maison Belle\";s:9:\"why_title\";s:37:\"The little things, *done beautifully*\";s:7:\"reasons\";a:4:{i:0;a:3:{s:4:\"icon\";s:7:\"sparkle\";s:5:\"title\";s:18:\"Spotless by design\";s:4:\"text\";s:86:\"Hospital-grade sterilisation and single-use files, buffers and liners for every guest.\";}i:1;a:3:{s:4:\"icon\";s:3:\"gem\";s:5:\"title\";s:16:\"Premium products\";s:4:\"text\";s:76:\"Long-wear, gentle formulas chosen for quality, colour depth and nail health.\";}i:2;a:3:{s:4:\"icon\";s:4:\"hand\";s:5:\"title\";s:15:\"Skilled artists\";s:4:\"text\";s:75:\"A team trained in precision, patient with detail and fluent in every shape.\";}i:3;a:3:{s:4:\"icon\";s:6:\"flower\";s:5:\"title\";s:19:\"An unhurried ritual\";s:4:\"text\";s:71:\"Soft lighting, quiet music and tea on arrival. Your time here is yours.\";}}s:15:\"reviews_eyebrow\";s:10:\"Kind words\";s:13:\"reviews_title\";s:21:\"Loved by our *guests*\";s:15:\"gallery_eyebrow\";s:7:\"Gallery\";s:13:\"gallery_title\";s:23:\"A glimpse of our *work*\";s:13:\"gallery_intro\";s:82:\"Soft nudes, glossy classics and delicate nail art. Placeholder imagery shown here.\";s:13:\"visit_eyebrow\";s:8:\"Visit us\";s:11:\"visit_title\";s:17:\"Come in, *unwind*\";s:11:\"cta_eyebrow\";s:15:\"Book your visit\";s:9:\"cta_title\";s:29:\"Your moment of *calm* awaits.\";s:8:\"cta_text\";s:77:\"Walk in or reserve your time. Either way, we will take beautiful care of you.\";s:12:\"footer_blurb\";s:87:\"A boutique nail salon & spa devoted to quiet luxury, flawless detail and a calmer pace.\";s:17:\"footer_hours_note\";s:55:\"Walk-ins welcome. Appointments recommended on weekends.\";s:13:\"footer_credit\";s:72:\"Demo design preview · All content, prices and reviews are placeholders.\";s:13:\"footer_policy\";s:29:\"Booking & cancellation policy\";}','auto'),(199,'mb_service_cat_children','a:0:{}','auto'),(202,'mb_gallery_cat_children','a:0:{}','auto'),(204,'wp_calendar_block_has_published_posts','1','auto'),(206,'category_children','a:0:{}','auto'),(210,'as_has_wp_comment_logs','no','on'),(211,'generate_db_version','3.6.1','auto'),(213,'wp_mail_smtp_notifications','a:4:{s:6:\"update\";i:1794051247;s:4:\"feed\";a:0:{}s:6:\"events\";a:0:{}s:9:\"dismissed\";a:0:{}}','auto'),(217,'wp_mail_smtp_migration_version','5','on'),(218,'wp_mail_smtp_debug_events_db_version','1','on'),(219,'wp_mail_smtp_recommendations_migration_version','1','on'),(237,'wp_mail_smtp_review_notice','a:2:{s:4:\"time\";i:1794051407;s:9:\"dismissed\";b:0;}','auto'),(238,'secret_key','ZPHWmSnUYmL&)qj.k9]Upb(l<wT,49UN}9PPhR(`&T#bQFFg*8V}z0vnX1R|]F$U','off'),(249,'action_scheduler_migration_status','complete','auto');
/*!40000 ALTER TABLE `wp_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_postmeta`
--

DROP TABLE IF EXISTS `wp_postmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=582 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_postmeta`
--

LOCK TABLES `wp_postmeta` WRITE;
/*!40000 ALTER TABLE `wp_postmeta` DISABLE KEYS */;
INSERT INTO `wp_postmeta` VALUES (2,3,'_wp_page_template','default'),(10,7,'_mb_seed_key','service-classic-manicure'),(11,7,'mb_price','28'),(12,7,'mb_duration','30 min'),(13,7,'mb_description','Shape, cuticle care, hand massage and polish.'),(14,8,'_mb_seed_key','service-gel-manicure'),(15,8,'mb_price','40'),(16,8,'mb_duration','45 min'),(17,8,'mb_description','Chip-resistant colour with a mirror-like gloss.'),(18,9,'_mb_seed_key','service-signature-spa-manicure'),(19,9,'mb_price','52'),(20,9,'mb_duration','60 min'),(21,9,'mb_description','Exfoliating scrub, warm mask and extended massage.'),(22,10,'_mb_seed_key','service-dip-powder-set'),(23,10,'mb_price','55'),(24,10,'mb_duration','60 min'),(25,10,'mb_description','Lightweight, durable colour with natural strength.'),(26,11,'_mb_seed_key','service-gel-extensions'),(27,11,'mb_price','70'),(28,11,'mb_duration','90 min'),(29,11,'mb_description','Sculpted length in your chosen shape and finish.'),(30,12,'_mb_seed_key','service-nail-art-per-nail'),(31,12,'mb_price','5'),(32,12,'mb_duration',''),(33,12,'mb_description','Hand-painted details, chrome, French and more.'),(34,13,'_mb_seed_key','service-classic-pedicure'),(35,13,'mb_price','40'),(36,13,'mb_duration','45 min'),(37,13,'mb_description','Soak, shape, callus care and polish.'),(38,14,'_mb_seed_key','service-gel-pedicure'),(39,14,'mb_price','52'),(40,14,'mb_duration','60 min'),(41,14,'mb_description','Our classic pedicure finished in long-wear gel.'),(42,15,'_mb_seed_key','service-signature-spa-pedicure'),(43,15,'mb_price','68'),(44,15,'mb_duration','75 min'),(45,15,'mb_description','Sugar scrub, mineral mask, hot towels and massage.'),(46,16,'_mb_seed_key','service-luxury-rose-pedicure'),(47,16,'mb_price','82'),(48,16,'mb_duration','90 min'),(49,16,'mb_description','Rose-infused ritual with paraffin treatment.'),(50,17,'_mb_seed_key','service-kids-pedicure'),(51,17,'mb_price','28'),(52,17,'mb_duration','30 min'),(53,17,'mb_description','A gentle treat for guests under 12.'),(54,18,'_mb_seed_key','service-polish-change'),(55,18,'mb_price','15'),(56,18,'mb_duration','15 min'),(57,18,'mb_description','Fresh colour on hands or feet.'),(58,19,'_mb_seed_key','service-eyebrow-shaping'),(59,19,'mb_price','15'),(60,19,'mb_duration','15 min'),(61,19,'mb_description',''),(62,20,'_mb_seed_key','service-upper-lip'),(63,20,'mb_price','8'),(64,20,'mb_duration','10 min'),(65,20,'mb_description',''),(66,21,'_mb_seed_key','service-chin'),(67,21,'mb_price','10'),(68,21,'mb_duration','10 min'),(69,21,'mb_description',''),(70,22,'_mb_seed_key','service-underarms'),(71,22,'mb_price','20'),(72,22,'mb_duration','15 min'),(73,22,'mb_description',''),(74,23,'_mb_seed_key','service-half-leg'),(75,23,'mb_price','35'),(76,23,'mb_duration','30 min'),(77,23,'mb_description',''),(78,24,'_mb_seed_key','service-full-leg'),(79,24,'mb_price','58'),(80,24,'mb_duration','45 min'),(81,24,'mb_description',''),(82,25,'_mb_seed_key','service-classic-full-set'),(83,25,'mb_price','95'),(84,25,'mb_duration','2 hrs'),(85,25,'mb_description','One extension per natural lash for a refined look.'),(86,26,'_mb_seed_key','service-hybrid-full-set'),(87,26,'mb_price','115'),(88,26,'mb_duration','2 hrs'),(89,26,'mb_description','A blend of classic and volume for texture.'),(90,27,'_mb_seed_key','service-volume-full-set'),(91,27,'mb_price','135'),(92,27,'mb_duration','2.5 hrs'),(93,27,'mb_description','Fuller, fluffier fans with soft drama.'),(94,28,'_mb_seed_key','service-classic-fill-2-3-wks'),(95,28,'mb_price','55'),(96,28,'mb_duration','1 hr'),(97,28,'mb_description',''),(98,29,'_mb_seed_key','service-lash-lift-tint'),(99,29,'mb_price','70'),(100,29,'mb_duration','1 hr'),(101,29,'mb_description','Curl and colour for your own lashes.'),(102,30,'_mb_seed_key','service-lash-removal'),(103,30,'mb_price','20'),(104,30,'mb_duration','20 min'),(105,30,'mb_description',''),(106,31,'_mb_seed_key','gallery-1'),(107,31,'mb_aspect','tall'),(108,31,'mb_tone','blush'),(109,31,'mb_icon','bottle'),(110,32,'_mb_seed_key','gallery-2'),(111,32,'mb_aspect','square'),(112,32,'mb_tone','mauve'),(113,32,'mb_icon','foot'),(114,33,'_mb_seed_key','gallery-3'),(115,33,'mb_aspect','portrait'),(116,33,'mb_tone','gold'),(117,33,'mb_icon','lash'),(118,34,'_mb_seed_key','gallery-4'),(119,34,'mb_aspect','square'),(120,34,'mb_tone','gold'),(121,34,'mb_icon','sparkle'),(122,35,'_mb_seed_key','gallery-5'),(123,35,'mb_aspect','portrait'),(124,35,'mb_tone','ivory'),(125,35,'mb_icon','gem'),(126,36,'_mb_seed_key','gallery-6'),(127,36,'mb_aspect','tall'),(128,36,'mb_tone','rose'),(129,36,'mb_icon','foot'),(130,37,'_mb_seed_key','gallery-7'),(131,37,'mb_aspect','square'),(132,37,'mb_tone','blush'),(133,37,'mb_icon','lash'),(134,38,'_mb_seed_key','gallery-8'),(135,38,'mb_aspect','wide'),(136,38,'mb_tone','mauve'),(137,38,'mb_icon','gem'),(138,39,'_mb_seed_key','gallery-9'),(139,39,'mb_aspect','portrait'),(140,39,'mb_tone','blush'),(141,39,'mb_icon','flower'),(142,40,'_mb_seed_key','gallery-10'),(143,40,'mb_aspect','tall'),(144,40,'mb_tone','ivory'),(145,40,'mb_icon','bottle'),(146,41,'_mb_seed_key','gallery-11'),(147,41,'mb_aspect','portrait'),(148,41,'mb_tone','rose'),(149,41,'mb_icon','lash'),(150,42,'_mb_seed_key','gallery-12'),(151,42,'mb_aspect','square'),(152,42,'mb_tone','rose'),(153,42,'mb_icon','sparkle'),(154,43,'_mb_seed_key','review-1'),(155,43,'mb_service','Gel Manicure'),(156,43,'mb_text','Placeholder review: the most serene salon I have visited. The attention to detail was extraordinary and my nails stayed perfect for weeks.'),(157,43,'mb_rating','5'),(158,44,'_mb_seed_key','review-2'),(159,44,'mb_service','Spa Pedicure'),(160,44,'mb_text','Placeholder review: an hour of complete calm. The massage, the warm towels, the polish – every moment felt considered.'),(161,44,'mb_rating','5'),(162,45,'_mb_seed_key','review-3'),(163,45,'mb_service','Lash Set'),(164,45,'mb_text','Placeholder review: my lashes look natural yet defined. I have never felt so looked after in a salon chair.'),(165,45,'mb_rating','5'),(166,46,'_mb_seed_key','review-4'),(167,46,'mb_service','Mani + Pedi'),(168,46,'mb_text','Placeholder review: spotless, welcoming and genuinely skilled. This has become my monthly ritual.'),(169,46,'mb_rating','5'),(170,47,'_mb_seed_key','review-5'),(171,47,'mb_service','Nail Art'),(172,47,'mb_text','Placeholder review: I brought a tiny inspiration photo and left with something even prettier. Truly artists.'),(173,47,'mb_rating','5'),(174,48,'_mb_seed_key','promo-1'),(175,48,'mb_tag','New guests'),(176,48,'mb_highlight','15% off'),(177,48,'mb_text','Treat yourself to your first Maison Belle experience with 15% off any service. Mention this offer when you book.'),(178,48,'mb_fine','Placeholder offer. New clients only. Not combinable with other offers.'),(179,48,'mb_icon','sparkle'),(180,48,'mb_cta_label','Book now'),(181,49,'_mb_seed_key','promo-2'),(182,49,'mb_tag','Best value'),(183,49,'mb_highlight','Save $15'),(184,49,'mb_text','Pair any gel manicure with a spa pedicure and enjoy a complimentary paraffin upgrade for your hands.'),(185,49,'mb_fine','Placeholder offer. Valid Monday to Thursday.'),(186,49,'mb_icon','bottle'),(187,49,'mb_cta_label','Book now'),(188,50,'_mb_seed_key','promo-3'),(189,50,'mb_tag','Share the glow'),(190,50,'mb_highlight','$10 credit'),(191,50,'mb_text','Introduce a friend and you will both receive $10 towards your next visit once their first appointment is complete.'),(192,50,'mb_fine','Placeholder offer. One credit per referral.'),(193,50,'mb_icon','flower'),(194,50,'mb_cta_label','Book now'),(197,51,'_mb_seed_key','post-the-art-of-a-lasting-manicure'),(198,51,'mb_tone','blush'),(199,51,'mb_icon','bottle'),(202,52,'_mb_seed_key','post-why-a-spa-pedicure-is-worth-the-pause'),(203,52,'mb_tone','mauve'),(204,52,'mb_icon','flower'),(207,53,'_mb_seed_key','post-choosing-the-right-lash-style'),(208,53,'mb_tone','gold'),(209,53,'mb_icon','lash'),(210,54,'_mb_seed_key','page-home'),(211,54,'mb_hero_eyebrow',''),(212,54,'mb_hero_title',''),(213,54,'mb_hero_intro',''),(214,55,'_mb_seed_key','page-services'),(215,55,'mb_hero_eyebrow','Services & prices'),(216,55,'mb_hero_title','The *menu*'),(217,55,'mb_hero_intro','Transparent pricing for every treatment. All prices are placeholders and may vary by length, design and artist.'),(218,55,'_wp_page_template','templates/services.php'),(219,55,'_yoast_wpseo_title','Services & Prices %%sep%% %%sitename%%'),(220,55,'_yoast_wpseo_metadesc','Explore our manicure, pedicure, waxing and eyelash menu with transparent prices. Walk-ins welcome.'),(221,56,'_mb_seed_key','page-gallery'),(222,56,'mb_hero_eyebrow','Gallery'),(223,56,'mb_hero_title','Our *work*'),(224,56,'mb_hero_intro','Filter by category and tap an image to view it larger. Placeholder imagery shown, real photos coming soon.'),(225,56,'_wp_page_template','templates/gallery.php'),(226,56,'_yoast_wpseo_title','Gallery %%sep%% %%sitename%%'),(227,56,'_yoast_wpseo_metadesc','A look at our nail art, pedicures and lash sets. Browse by category and tap any image to enlarge.'),(228,57,'_mb_seed_key','page-promotions'),(229,57,'mb_hero_eyebrow','Promotions'),(230,57,'mb_hero_title','Little *indulgences*'),(231,57,'mb_hero_intro','A few thoughtful ways to enjoy a little more for a little less. Offers shown are placeholders.'),(232,57,'_wp_page_template','templates/promotions.php'),(233,57,'_yoast_wpseo_title','Promotions %%sep%% %%sitename%%'),(234,57,'_yoast_wpseo_metadesc','Seasonal offers and thoughtful extras: a first-visit treat, a mani + pedi combo and a refer-a-friend reward.'),(235,58,'_mb_seed_key','page-blog'),(236,58,'mb_hero_eyebrow','The journal'),(237,58,'mb_hero_title','Notes on *beauty* & care'),(238,58,'mb_hero_intro','Advice, rituals and small luxuries from our team. Sample articles for the demo.'),(239,58,'_yoast_wpseo_title','Journal %%sep%% %%sitename%%'),(240,58,'_yoast_wpseo_metadesc','Nail care, spa rituals and beauty notes from the team: practical advice for beautiful hands, feet and lashes.'),(241,59,'_mb_seed_key','page-contact'),(242,59,'mb_hero_eyebrow','Contact'),(243,59,'mb_hero_title','Say *hello*'),(244,59,'mb_hero_intro','Questions, special requests or group bookings? Send a note or simply walk in. We would love to see you.'),(245,59,'_wp_page_template','templates/contact.php'),(246,59,'_yoast_wpseo_title','Contact & Location %%sep%% %%sitename%%'),(247,59,'_yoast_wpseo_metadesc','Visit us, call or send us a message. Find our address, opening hours and map.'),(248,60,'_mb_seed_key','page-policy'),(249,60,'mb_hero_eyebrow','Good to know'),(250,60,'mb_hero_title','Our *policy*'),(251,60,'mb_hero_intro','A few gentle guidelines that help us keep every visit calm and on time. This text is a placeholder.'),(252,60,'_wp_page_template','templates/policy.php'),(253,60,'_yoast_wpseo_title','Booking & Cancellation Policy %%sep%% %%sitename%%'),(254,60,'_yoast_wpseo_metadesc','How booking, cancellations and late arrivals work at our salon. Placeholder policy text.'),(263,62,'_menu_item_type','post_type'),(264,62,'_menu_item_menu_item_parent','0'),(265,62,'_menu_item_object_id','54'),(266,62,'_menu_item_object','page'),(267,62,'_menu_item_target',''),(268,62,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),(269,62,'_menu_item_xfn',''),(270,62,'_menu_item_url',''),(271,63,'_menu_item_type','post_type'),(272,63,'_menu_item_menu_item_parent','0'),(273,63,'_menu_item_object_id','55'),(274,63,'_menu_item_object','page'),(275,63,'_menu_item_target',''),(276,63,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),(277,63,'_menu_item_xfn',''),(278,63,'_menu_item_url',''),(279,64,'_menu_item_type','post_type'),(280,64,'_menu_item_menu_item_parent','0'),(281,64,'_menu_item_object_id','56'),(282,64,'_menu_item_object','page'),(283,64,'_menu_item_target',''),(284,64,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),(285,64,'_menu_item_xfn',''),(286,64,'_menu_item_url',''),(287,65,'_menu_item_type','post_type'),(288,65,'_menu_item_menu_item_parent','0'),(289,65,'_menu_item_object_id','57'),(290,65,'_menu_item_object','page'),(291,65,'_menu_item_target',''),(292,65,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),(293,65,'_menu_item_xfn',''),(294,65,'_menu_item_url',''),(295,66,'_menu_item_type','post_type'),(296,66,'_menu_item_menu_item_parent','0'),(297,66,'_menu_item_object_id','58'),(298,66,'_menu_item_object','page'),(299,66,'_menu_item_target',''),(300,66,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),(301,66,'_menu_item_xfn',''),(302,66,'_menu_item_url',''),(303,67,'_menu_item_type','post_type'),(304,67,'_menu_item_menu_item_parent','0'),(305,67,'_menu_item_object_id','59'),(306,67,'_menu_item_object','page'),(307,67,'_menu_item_target',''),(308,67,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),(309,67,'_menu_item_xfn',''),(310,67,'_menu_item_url',''),(311,68,'_menu_item_type','post_type'),(312,68,'_menu_item_menu_item_parent','0'),(313,68,'_menu_item_object_id','54'),(314,68,'_menu_item_object','page'),(315,68,'_menu_item_target',''),(316,68,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),(317,68,'_menu_item_xfn',''),(318,68,'_menu_item_url',''),(319,69,'_menu_item_type','post_type'),(320,69,'_menu_item_menu_item_parent','0'),(321,69,'_menu_item_object_id','55'),(322,69,'_menu_item_object','page'),(323,69,'_menu_item_target',''),(324,69,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),(325,69,'_menu_item_xfn',''),(326,69,'_menu_item_url',''),(327,70,'_menu_item_type','post_type'),(328,70,'_menu_item_menu_item_parent','0'),(329,70,'_menu_item_object_id','56'),(330,70,'_menu_item_object','page'),(331,70,'_menu_item_target',''),(332,70,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),(333,70,'_menu_item_xfn',''),(334,70,'_menu_item_url',''),(335,71,'_menu_item_type','post_type'),(336,71,'_menu_item_menu_item_parent','0'),(337,71,'_menu_item_object_id','57'),(338,71,'_menu_item_object','page'),(339,71,'_menu_item_target',''),(340,71,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),(341,71,'_menu_item_xfn',''),(342,71,'_menu_item_url',''),(343,72,'_menu_item_type','post_type'),(344,72,'_menu_item_menu_item_parent','0'),(345,72,'_menu_item_object_id','58'),(346,72,'_menu_item_object','page'),(347,72,'_menu_item_target',''),(348,72,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),(349,72,'_menu_item_xfn',''),(350,72,'_menu_item_url',''),(351,73,'_menu_item_type','post_type'),(352,73,'_menu_item_menu_item_parent','0'),(353,73,'_menu_item_object_id','59'),(354,73,'_menu_item_object','page'),(355,73,'_menu_item_target',''),(356,73,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),(357,73,'_menu_item_xfn',''),(358,73,'_menu_item_url',''),(359,74,'_menu_item_type','post_type'),(360,74,'_menu_item_menu_item_parent','0'),(361,74,'_menu_item_object_id','60'),(362,74,'_menu_item_object','page'),(363,74,'_menu_item_target',''),(364,74,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),(365,74,'_menu_item_xfn',''),(366,74,'_menu_item_url',''),(553,54,'_yoast_wpseo_metadesc','Maison Belle Nails & Spa is a boutique nail salon in Houston offering refined manicures, pedicures, waxing and eyelash services in a calm, beautifully clean space.'),(563,54,'_yoast_wpseo_title','%%sitename%% %%sep%% Nail Salon & Spa in Houston'),(564,120,'_form','<div class=\"mb-form__grid\">\n<div class=\"mb-field\">\n<label for=\"cf-name\" class=\"mb-label\">Name</label>\n[text your-name id:cf-name class:mb-input autocomplete:name placeholder \"Your full name\"]\n</div>\n<div class=\"mb-field\">\n<label for=\"cf-email\" class=\"mb-label\">Email</label>\n[email your-email id:cf-email class:mb-input autocomplete:email placeholder \"you@example.com\"]\n</div>\n<div class=\"mb-field\">\n<label for=\"cf-phone\" class=\"mb-label\">Phone <span class=\"mb-label__opt\">(optional)</span></label>\n[tel your-phone id:cf-phone class:mb-input autocomplete:tel placeholder \"(555) 000-0000\"]\n</div>\n<div class=\"mb-field\">\n<label for=\"cf-service\" class=\"mb-label\">Interested in</label>\n[select your-service id:cf-service class:mb-input first_as_placeholder \"Select a service\" \"Manicure\" \"Pedicure\" \"Waxing\" \"Eyelashes\" \"Something else\"]\n</div>\n<div class=\"mb-field mb-field--full\">\n<label for=\"cf-message\" class=\"mb-label\">Message</label>\n[textarea your-message id:cf-message class:mb-input rows:5 placeholder \"How can we help?\"]\n</div>\n</div>\n<div class=\"mb-form__trap\" aria-hidden=\"true\"><label>Leave this field empty<input type=\"text\" name=\"mb_website\" tabindex=\"-1\" autocomplete=\"off\"></label></div>\n<div class=\"mb-form__foot\">\n<p class=\"mb-form__note\">We usually reply within one business day.</p>\n<button type=\"submit\" class=\"btn btn-primary mb-form__submit\">Send message</button>\n</div>'),(565,120,'_mail','a:9:{s:6:\"active\";b:1;s:7:\"subject\";s:43:\"[_site_title]: new message from [your-name]\";s:6:\"sender\";s:35:\"[_site_title] <wordpress@localhost>\";s:9:\"recipient\";s:26:\"muhammadfaraz991@gmail.com\";s:4:\"body\";s:154:\"From: [your-name] <[your-email]>\nPhone: [your-phone]\nInterested in: [your-service]\n\nMessage:\n[your-message]\n\n-- \nSent from the contact form at [_site_url]\";s:18:\"additional_headers\";s:22:\"Reply-To: [your-email]\";s:11:\"attachments\";s:0:\"\";s:8:\"use_html\";b:0;s:13:\"exclude_blank\";b:0;}'),(566,120,'_mail_2','a:9:{s:6:\"active\";b:0;s:7:\"subject\";s:30:\"[_site_title] \"[your-subject]\"\";s:6:\"sender\";s:42:\"[_site_title] <muhammadfaraz991@gmail.com>\";s:4:\"body\";s:220:\"Message Body:\n[your-message]\n\n-- \nThis email is a receipt for your contact form submission on our website ([_site_title] [_site_url]) in which your email address was used. If that was not you, please ignore this message.\";s:9:\"recipient\";s:12:\"[your-email]\";s:18:\"additional_headers\";s:29:\"Reply-To: [_site_admin_email]\";s:11:\"attachments\";s:0:\"\";s:8:\"use_html\";i:0;s:13:\"exclude_blank\";i:0;}'),(567,120,'_messages','a:23:{s:12:\"mail_sent_ok\";s:42:\"Thank you. Your message has been received.\";s:12:\"mail_sent_ng\";s:62:\"Sorry, your message could not be sent. Please call us instead.\";s:16:\"validation_error\";s:50:\"Please check the highlighted fields and try again.\";s:4:\"spam\";s:62:\"Sorry, your message could not be sent. Please call us instead.\";s:12:\"accept_terms\";s:36:\"Please accept the terms to continue.\";s:16:\"invalid_required\";s:23:\"This field is required.\";s:16:\"invalid_too_long\";s:23:\"This entry is too long.\";s:17:\"invalid_too_short\";s:24:\"This entry is too short.\";s:13:\"upload_failed\";s:46:\"There was an unknown error uploading the file.\";s:24:\"upload_file_type_invalid\";s:49:\"You are not allowed to upload files of this type.\";s:21:\"upload_file_too_large\";s:31:\"The uploaded file is too large.\";s:23:\"upload_failed_php_error\";s:38:\"There was an error uploading the file.\";s:12:\"invalid_date\";s:41:\"Please enter a date in YYYY-MM-DD format.\";s:14:\"date_too_early\";s:32:\"This field has a too early date.\";s:13:\"date_too_late\";s:31:\"This field has a too late date.\";s:14:\"invalid_number\";s:22:\"Please enter a number.\";s:16:\"number_too_small\";s:34:\"This field has a too small number.\";s:16:\"number_too_large\";s:34:\"This field has a too large number.\";s:23:\"quiz_answer_not_correct\";s:36:\"The answer to the quiz is incorrect.\";s:17:\"captcha_not_match\";s:31:\"Your entered code is incorrect.\";s:13:\"invalid_email\";s:35:\"Please enter a valid email address.\";s:11:\"invalid_url\";s:19:\"Please enter a URL.\";s:11:\"invalid_tel\";s:34:\"Please enter a valid phone number.\";}'),(568,120,'_additional_settings',''),(569,120,'_locale','en_US'),(570,120,'_hash','c907eab4010522b484215831bc88fd98f45bf6526d4f4cb939dd0fa6ca2aa2a8'),(571,120,'_mb_seed_key','cf7-contact'),(572,54,'_edit_lock','1794051739:1'),(573,51,'_edit_lock','1794051740:1'),(574,51,'_yoast_wpseo_metadesc','Salon-fresh nails for three weeks and beyond: what happens in the chair, and the small habits that make the difference at home.'),(575,52,'_yoast_wpseo_metadesc','More than polish: a spa pedicure is circulation, softness and a rare hour of stillness. Here is what to expect from your first one.'),(576,53,'_yoast_wpseo_metadesc','Classic, hybrid or volume? A calm guide to finding the lash look that suits your eye shape, lifestyle and maintenance appetite.');
/*!40000 ALTER TABLE `wp_postmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_posts`
--

DROP TABLE IF EXISTS `wp_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(255) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT 0,
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`),
  KEY `type_status_author` (`post_type`,`post_status`,`post_author`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_posts`
--

LOCK TABLES `wp_posts` WRITE;
/*!40000 ALTER TABLE `wp_posts` DISABLE KEYS */;
INSERT INTO `wp_posts` VALUES (3,1,'2026-11-07 11:07:35','2026-11-07 11:07:35','<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Who we are</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>Our website address is: http://localhost/nail-saloon.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Comments</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&#8217;s IP address and browser user agent string to help spam detection.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Media</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Cookies</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>If you visit our login page, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select &quot;Remember Me&quot;, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Embedded content from other websites</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Who we share your data with</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you request a password reset, your IP address will be included in the reset email.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">How long we retain your data</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">What rights you have over your data</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Where your data is sent</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>Visitor comments may be checked through an automated spam detection service.</p>\n<!-- /wp:paragraph -->\n','Privacy Policy','','draft','closed','open','','privacy-policy','','','2026-11-07 11:07:35','2026-11-07 11:07:35','',0,'http://localhost/nail-saloon/?page_id=3',0,'page','',0),(4,0,'2026-11-07 11:07:39','2026-11-07 11:07:39','<!-- wp:page-list /-->','Navigation','','publish','closed','closed','','navigation','','','2026-11-07 11:07:39','2026-11-07 11:07:39','',0,'http://localhost/nail-saloon/2026/11/07/navigation/',0,'wp_navigation','',0),(5,1,'2026-11-07 11:07:52','0000-00-00 00:00:00','','Auto Draft','','auto-draft','open','open','','','','','2026-11-07 11:07:52','0000-00-00 00:00:00','',0,'http://localhost/nail-saloon/?p=5',0,'post','',0),(7,1,'2026-11-07 11:31:32','2026-11-07 11:31:32','','Classic Manicure','','publish','closed','closed','','classic-manicure','','','2026-11-07 11:31:32','2026-11-07 11:31:32','',0,'http://localhost/nail-saloon/?mb_service=classic-manicure',1,'mb_service','',0),(8,1,'2026-11-07 11:31:32','2026-11-07 11:31:32','','Gel Manicure','','publish','closed','closed','','gel-manicure','','','2026-11-07 11:31:32','2026-11-07 11:31:32','',0,'http://localhost/nail-saloon/?mb_service=gel-manicure',2,'mb_service','',0),(9,1,'2026-11-07 11:31:32','2026-11-07 11:31:32','','Signature Spa Manicure','','publish','closed','closed','','signature-spa-manicure','','','2026-11-07 11:31:32','2026-11-07 11:31:32','',0,'http://localhost/nail-saloon/?mb_service=signature-spa-manicure',3,'mb_service','',0),(10,1,'2026-11-07 11:31:32','2026-11-07 11:31:32','','Dip Powder Set','','publish','closed','closed','','dip-powder-set','','','2026-11-07 11:31:32','2026-11-07 11:31:32','',0,'http://localhost/nail-saloon/?mb_service=dip-powder-set',4,'mb_service','',0),(11,1,'2026-11-07 11:31:32','2026-11-07 11:31:32','','Gel Extensions','','publish','closed','closed','','gel-extensions','','','2026-11-07 11:31:32','2026-11-07 11:31:32','',0,'http://localhost/nail-saloon/?mb_service=gel-extensions',5,'mb_service','',0),(12,1,'2026-11-07 11:31:32','2026-11-07 11:31:32','','Nail Art (per nail)','','publish','closed','closed','','nail-art-per-nail','','','2026-11-07 11:31:32','2026-11-07 11:31:32','',0,'http://localhost/nail-saloon/?mb_service=nail-art-per-nail',6,'mb_service','',0),(13,1,'2026-11-07 11:31:32','2026-11-07 11:31:32','','Classic Pedicure','','publish','closed','closed','','classic-pedicure','','','2026-11-07 11:31:32','2026-11-07 11:31:32','',0,'http://localhost/nail-saloon/?mb_service=classic-pedicure',1,'mb_service','',0),(14,1,'2026-11-07 11:31:32','2026-11-07 11:31:32','','Gel Pedicure','','publish','closed','closed','','gel-pedicure','','','2026-11-07 11:31:32','2026-11-07 11:31:32','',0,'http://localhost/nail-saloon/?mb_service=gel-pedicure',2,'mb_service','',0),(15,1,'2026-11-07 11:31:32','2026-11-07 11:31:32','','Signature Spa Pedicure','','publish','closed','closed','','signature-spa-pedicure','','','2026-11-07 11:31:32','2026-11-07 11:31:32','',0,'http://localhost/nail-saloon/?mb_service=signature-spa-pedicure',3,'mb_service','',0),(16,1,'2026-11-07 11:31:33','2026-11-07 11:31:33','','Luxury Rose Pedicure','','publish','closed','closed','','luxury-rose-pedicure','','','2026-11-07 11:31:33','2026-11-07 11:31:33','',0,'http://localhost/nail-saloon/?mb_service=luxury-rose-pedicure',4,'mb_service','',0),(17,1,'2026-11-07 11:31:33','2026-11-07 11:31:33','','Kids’ Pedicure','','publish','closed','closed','','kids-pedicure','','','2026-11-07 11:31:33','2026-11-07 11:31:33','',0,'http://localhost/nail-saloon/?mb_service=kids-pedicure',5,'mb_service','',0),(18,1,'2026-11-07 11:31:33','2026-11-07 11:31:33','','Polish Change','','publish','closed','closed','','polish-change','','','2026-11-07 11:31:33','2026-11-07 11:31:33','',0,'http://localhost/nail-saloon/?mb_service=polish-change',6,'mb_service','',0),(19,1,'2026-11-07 11:31:33','2026-11-07 11:31:33','','Eyebrow Shaping','','publish','closed','closed','','eyebrow-shaping','','','2026-11-07 11:31:33','2026-11-07 11:31:33','',0,'http://localhost/nail-saloon/?mb_service=eyebrow-shaping',1,'mb_service','',0),(20,1,'2026-11-07 11:31:33','2026-11-07 11:31:33','','Upper Lip','','publish','closed','closed','','upper-lip','','','2026-11-07 11:31:33','2026-11-07 11:31:33','',0,'http://localhost/nail-saloon/?mb_service=upper-lip',2,'mb_service','',0),(21,1,'2026-11-07 11:31:33','2026-11-07 11:31:33','','Chin','','publish','closed','closed','','chin','','','2026-11-07 11:31:33','2026-11-07 11:31:33','',0,'http://localhost/nail-saloon/?mb_service=chin',3,'mb_service','',0),(22,1,'2026-11-07 11:31:33','2026-11-07 11:31:33','','Underarms','','publish','closed','closed','','underarms','','','2026-11-07 11:31:33','2026-11-07 11:31:33','',0,'http://localhost/nail-saloon/?mb_service=underarms',4,'mb_service','',0),(23,1,'2026-11-07 11:31:33','2026-11-07 11:31:33','','Half Leg','','publish','closed','closed','','half-leg','','','2026-11-07 11:31:33','2026-11-07 11:31:33','',0,'http://localhost/nail-saloon/?mb_service=half-leg',5,'mb_service','',0),(24,1,'2026-11-07 11:31:33','2026-11-07 11:31:33','','Full Leg','','publish','closed','closed','','full-leg','','','2026-11-07 11:31:33','2026-11-07 11:31:33','',0,'http://localhost/nail-saloon/?mb_service=full-leg',6,'mb_service','',0),(25,1,'2026-11-07 11:31:33','2026-11-07 11:31:33','','Classic Full Set','','publish','closed','closed','','classic-full-set','','','2026-11-07 11:31:33','2026-11-07 11:31:33','',0,'http://localhost/nail-saloon/?mb_service=classic-full-set',1,'mb_service','',0),(26,1,'2026-11-07 11:31:33','2026-11-07 11:31:33','','Hybrid Full Set','','publish','closed','closed','','hybrid-full-set','','','2026-11-07 11:31:33','2026-11-07 11:31:33','',0,'http://localhost/nail-saloon/?mb_service=hybrid-full-set',2,'mb_service','',0),(27,1,'2026-11-07 11:31:33','2026-11-07 11:31:33','','Volume Full Set','','publish','closed','closed','','volume-full-set','','','2026-11-07 11:31:33','2026-11-07 11:31:33','',0,'http://localhost/nail-saloon/?mb_service=volume-full-set',3,'mb_service','',0),(28,1,'2026-11-07 11:31:33','2026-11-07 11:31:33','','Classic Fill (2–3 wks)','','publish','closed','closed','','classic-fill-2-3-wks','','','2026-11-07 11:31:33','2026-11-07 11:31:33','',0,'http://localhost/nail-saloon/?mb_service=classic-fill-2-3-wks',4,'mb_service','',0),(29,1,'2026-11-07 11:31:33','2026-11-07 11:31:33','','Lash Lift & Tint','','publish','closed','closed','','lash-lift-tint','','','2026-11-07 11:31:33','2026-11-07 11:31:33','',0,'http://localhost/nail-saloon/?mb_service=lash-lift-tint',5,'mb_service','',0),(30,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Lash Removal','','publish','closed','closed','','lash-removal','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_service=lash-removal',6,'mb_service','',0),(31,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Nude gel manicure with a glossy finish','','publish','closed','closed','','nude-gel-manicure-with-a-glossy-finish','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_gallery=nude-gel-manicure-with-a-glossy-finish',1,'mb_gallery','',0),(32,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Rose-toned spa pedicure','','publish','closed','closed','','rose-toned-spa-pedicure','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_gallery=rose-toned-spa-pedicure',2,'mb_gallery','',0),(33,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Soft hybrid lash set','','publish','closed','closed','','soft-hybrid-lash-set','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_gallery=soft-hybrid-lash-set',3,'mb_gallery','',0),(34,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Chrome champagne nail art','','publish','closed','closed','','chrome-champagne-nail-art','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_gallery=chrome-champagne-nail-art',4,'mb_gallery','',0),(35,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Classic French tip manicure','','publish','closed','closed','','classic-french-tip-manicure','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_gallery=classic-french-tip-manicure',5,'mb_gallery','',0),(36,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Deep rosewood gel pedicure','','publish','closed','closed','','deep-rosewood-gel-pedicure','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_gallery=deep-rosewood-gel-pedicure',6,'mb_gallery','',0),(37,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Natural classic lash extensions','','publish','closed','closed','','natural-classic-lash-extensions','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_gallery=natural-classic-lash-extensions',7,'mb_gallery','',0),(38,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Pearl and blush ombré set','','publish','closed','closed','','pearl-and-blush-ombre-set','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_gallery=pearl-and-blush-ombre-set',8,'mb_gallery','',0),(39,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Pale pink pedicure with minimal florals','','publish','closed','closed','','pale-pink-pedicure-with-minimal-florals','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_gallery=pale-pink-pedicure-with-minimal-florals',9,'mb_gallery','',0),(40,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Almond-shaped sculpted extensions','','publish','closed','closed','','almond-shaped-sculpted-extensions','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_gallery=almond-shaped-sculpted-extensions',10,'mb_gallery','',0),(41,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Volume lash set with a gentle curl','','publish','closed','closed','','volume-lash-set-with-a-gentle-curl','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_gallery=volume-lash-set-with-a-gentle-curl',11,'mb_gallery','',0),(42,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Glossy red gel pedicure','','publish','closed','closed','','glossy-red-gel-pedicure','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_gallery=glossy-red-gel-pedicure',12,'mb_gallery','',0),(43,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Sample Client A.','','publish','closed','closed','','sample-client-a','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_review=sample-client-a',1,'mb_review','',0),(44,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Sample Client B.','','publish','closed','closed','','sample-client-b','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_review=sample-client-b',2,'mb_review','',0),(45,1,'2026-11-07 11:31:34','2026-11-07 11:31:34','','Sample Client C.','','publish','closed','closed','','sample-client-c','','','2026-11-07 11:31:34','2026-11-07 11:31:34','',0,'http://localhost/nail-saloon/?mb_review=sample-client-c',3,'mb_review','',0),(46,1,'2026-11-07 11:31:35','2026-11-07 11:31:35','','Sample Client D.','','publish','closed','closed','','sample-client-d','','','2026-11-07 11:31:35','2026-11-07 11:31:35','',0,'http://localhost/nail-saloon/?mb_review=sample-client-d',4,'mb_review','',0),(47,1,'2026-11-07 11:31:35','2026-11-07 11:31:35','','Sample Client E.','','publish','closed','closed','','sample-client-e','','','2026-11-07 11:31:35','2026-11-07 11:31:35','',0,'http://localhost/nail-saloon/?mb_review=sample-client-e',5,'mb_review','',0),(48,1,'2026-11-07 11:31:35','2026-11-07 11:31:35','','First Visit Offer','','publish','closed','closed','','first-visit-offer','','','2026-11-07 11:31:35','2026-11-07 11:31:35','',0,'http://localhost/nail-saloon/?mb_promo=first-visit-offer',1,'mb_promo','',0),(49,1,'2026-11-07 11:31:35','2026-11-07 11:31:35','','Mani + Pedi Combo','','publish','closed','closed','','mani-pedi-combo','','','2026-11-07 11:31:35','2026-11-07 11:31:35','',0,'http://localhost/nail-saloon/?mb_promo=mani-pedi-combo',2,'mb_promo','',0),(50,1,'2026-11-07 11:31:35','2026-11-07 11:31:35','','Refer a Friend','','publish','closed','closed','','refer-a-friend','','','2026-11-07 11:31:35','2026-11-07 11:31:35','',0,'http://localhost/nail-saloon/?mb_promo=refer-a-friend',3,'mb_promo','',0),(51,1,'2026-09-12 12:00:00','2026-09-12 12:00:00','<!-- wp:paragraph -->\n<p>A manicure that stays flawless is rarely luck. It is preparation, patience and a few quiet habits, and most of them begin long before the polish touches the nail.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">It begins with preparation</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Every lasting finish starts with a clean, dry, gently buffed nail plate. Cuticles are softened and eased back, never cut aggressively, so the colour can sit close to the skin without lifting. Skipping this step is the most common reason polish chips early.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><!-- wp:paragraph -->\n<p>Beautiful nails are built in the first ten minutes, not the last.</p>\n<!-- /wp:paragraph --></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Choose the right finish for your life</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Gel suits busy weeks and travel. Dip powder adds strength to nails that tend to bend. Classic polish is perfect when you love changing colour often. A good technician will help you choose based on your routine rather than a trend.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Small habits at home</h2>\n<!-- /wp:heading -->\n\n<!-- wp:list -->\n<ul class=\"wp-block-list\"><!-- wp:list-item -->\n<li>Apply cuticle oil every evening. It keeps the skin supple and the finish glossy.</li>\n<!-- /wp:list-item --><!-- wp:list-item -->\n<li>Wear gloves for washing up and cleaning products.</li>\n<!-- /wp:list-item --><!-- wp:list-item -->\n<li>Use your fingertips, not your nails, to open cans and packaging.</li>\n<!-- /wp:list-item --><!-- wp:list-item -->\n<li>Book your next visit before the edges begin to grow out.</li>\n<!-- /wp:list-item --></ul>\n<!-- /wp:list -->\n\n<!-- wp:paragraph -->\n<p>Treat your hands with a little daily care and your manicure will reward you with weeks of quiet polish.</p>\n<!-- /wp:paragraph -->','The Art of a Manicure That Lasts','Salon-fresh nails for three weeks and beyond: what happens in the chair, and the small habits that make the difference at home.','publish','closed','open','','the-art-of-a-lasting-manicure','','','2026-09-12 12:00:00','2026-09-12 12:00:00','',0,'http://localhost/nail-saloon/2026/09/12/the-art-of-a-lasting-manicure/',0,'post','',0),(52,1,'2026-08-03 12:00:00','2026-08-03 12:00:00','<!-- wp:paragraph -->\n<p>Our feet carry us through every day, and they rarely get a moment of thanks. A spa pedicure is part grooming, part restoration, and entirely a pause you have earned.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">What happens during your visit</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>You begin with a warm, lightly scented soak that softens skin and eases tension. Nails are shaped, cuticles tended, and rough areas smoothed with care. A sugar scrub and mineral mask follow, then hot towels and an unhurried massage of the feet and calves.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><!-- wp:paragraph -->\n<p>The best part is the quiet. For one hour, nothing else needs you.</p>\n<!-- /wp:paragraph --></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">How often should you book?</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Every four to six weeks keeps feet soft and nails tidy. In sandal season, many guests prefer a shorter interval so polish always looks fresh.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Before you arrive</h2>\n<!-- /wp:heading -->\n\n<!-- wp:list -->\n<ul class=\"wp-block-list\"><!-- wp:list-item -->\n<li>Skip shaving your legs for 24 hours beforehand to avoid irritation.</li>\n<!-- /wp:list-item --><!-- wp:list-item -->\n<li>Wear loose, open footwear so your polish can dry properly.</li>\n<!-- /wp:list-item --><!-- wp:list-item -->\n<li>Let us know about any skin sensitivities or medical concerns.</li>\n<!-- /wp:list-item --></ul>\n<!-- /wp:list -->','Why a Spa Pedicure Is Worth the Pause','More than polish: a spa pedicure is circulation, softness and a rare hour of stillness. Here is what to expect from your first one.','publish','closed','open','','why-a-spa-pedicure-is-worth-the-pause','','','2026-08-03 12:00:00','2026-08-03 12:00:00','',0,'http://localhost/nail-saloon/2026/08/03/why-a-spa-pedicure-is-worth-the-pause/',0,'post','',0),(53,1,'2026-06-21 12:00:00','2026-06-21 12:00:00','<!-- wp:paragraph -->\n<p>Lash extensions should feel like your best natural lashes: lifted, defined and effortless. The right style depends on your eye shape, your own lash health and how much upkeep you enjoy.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Classic: refined and natural</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>One extension is applied to each natural lash. The result is a softly defined, polished look, ideal for first-timers and anyone who prefers a minimal finish.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Hybrid: texture with softness</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>A mix of classic lashes and handmade fans creates a gently fuller, textured effect that still looks natural from every angle.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><!-- wp:paragraph -->\n<p>The most beautiful lashes are the ones that look like they belong to you.</p>\n<!-- /wp:paragraph --></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Volume: fuller and fluffier</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Lightweight fans create density and soft drama, suited to those who like to wake up with their eyes already defined.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:list -->\n<ul class=\"wp-block-list\"><!-- wp:list-item -->\n<li>Avoid oil-based products around the eyes.</li>\n<!-- /wp:list-item --><!-- wp:list-item -->\n<li>Brush your lashes gently each morning with a clean spoolie.</li>\n<!-- /wp:list-item --><!-- wp:list-item -->\n<li>Book fills every two to three weeks to keep the set full.</li>\n<!-- /wp:list-item --></ul>\n<!-- /wp:list -->','Choosing the Right Lash Style for Your Eyes','Classic, hybrid or volume? A calm guide to finding the lash look that suits your eye shape, lifestyle and maintenance appetite.','publish','closed','open','','choosing-the-right-lash-style','','','2026-06-21 12:00:00','2026-06-21 12:00:00','',0,'http://localhost/nail-saloon/2026/06/21/choosing-the-right-lash-style/',0,'post','',0),(54,1,'2026-11-07 11:31:36','2026-11-07 11:31:36','','Home','','publish','closed','closed','','home','','','2026-11-07 11:31:36','2026-11-07 11:31:36','',0,'http://localhost/nail-saloon/home/',0,'page','',0),(55,1,'2026-11-07 11:31:36','2026-11-07 11:31:36','','Services','','publish','closed','closed','','services','','','2026-11-07 11:31:36','2026-11-07 11:31:36','',0,'http://localhost/nail-saloon/services/',0,'page','',0),(56,1,'2026-11-07 11:31:36','2026-11-07 11:31:36','','Gallery','','publish','closed','closed','','gallery','','','2026-11-07 11:31:36','2026-11-07 11:31:36','',0,'http://localhost/nail-saloon/gallery/',0,'page','',0),(57,1,'2026-11-07 11:31:36','2026-11-07 11:31:36','','Promotions','','publish','closed','closed','','promotions','','','2026-11-07 11:31:36','2026-11-07 11:31:36','',0,'http://localhost/nail-saloon/promotions/',0,'page','',0),(58,1,'2026-11-07 11:31:36','2026-11-07 11:31:36','','Blog','','publish','closed','closed','','blog','','','2026-11-07 11:31:36','2026-11-07 11:31:36','',0,'http://localhost/nail-saloon/blog/',0,'page','',0),(59,1,'2026-11-07 11:31:36','2026-11-07 11:31:36','','Contact','','publish','closed','closed','','contact','','','2026-11-07 11:31:36','2026-11-07 11:31:36','',0,'http://localhost/nail-saloon/contact/',0,'page','',0),(60,1,'2026-11-07 11:31:36','2026-11-07 11:31:36','<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Booking</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Appointments can be reserved online or by phone. Walk-ins are always welcome and seated in order of arrival, subject to availability.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>For groups of four or more, please call ahead so we can prepare a comfortable space for everyone.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Cancellation</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>We kindly ask for at least 24 hours’ notice if you need to cancel or reschedule, so that we can offer your time to another guest.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Repeated late cancellations or missed appointments may require a deposit for future bookings.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Late arrival</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>We hold your appointment for 15 minutes. After that, your service may need to be shortened or rescheduled so that we can respect the guests who follow.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>If you are running behind, a quick call helps us do our best to accommodate you.</p>\n<!-- /wp:paragraph -->','Policy','','publish','closed','closed','','policy','','','2026-11-07 11:31:36','2026-11-07 11:31:36','',0,'http://localhost/nail-saloon/policy/',0,'page','',0),(62,1,'2026-11-07 11:31:36','2026-11-07 11:31:36',' ','','','publish','closed','closed','','62','','','2026-11-07 11:31:36','2026-11-07 11:31:36','',0,'http://localhost/nail-saloon/2026/11/07/62/',0,'nav_menu_item','',0),(63,1,'2026-11-07 11:31:36','2026-11-07 11:31:36',' ','','','publish','closed','closed','','63','','','2026-11-07 11:31:36','2026-11-07 11:31:36','',0,'http://localhost/nail-saloon/2026/11/07/63/',2,'nav_menu_item','',0),(64,1,'2026-11-07 11:31:37','2026-11-07 11:31:37',' ','','','publish','closed','closed','','64','','','2026-11-07 11:31:37','2026-11-07 11:31:37','',0,'http://localhost/nail-saloon/2026/11/07/64/',3,'nav_menu_item','',0),(65,1,'2026-11-07 11:31:37','2026-11-07 11:31:37',' ','','','publish','closed','closed','','65','','','2026-11-07 11:31:37','2026-11-07 11:31:37','',0,'http://localhost/nail-saloon/2026/11/07/65/',4,'nav_menu_item','',0),(66,1,'2026-11-07 11:31:37','2026-11-07 11:31:37',' ','','','publish','closed','closed','','66','','','2026-11-07 11:31:37','2026-11-07 11:31:37','',0,'http://localhost/nail-saloon/2026/11/07/66/',5,'nav_menu_item','',0),(67,1,'2026-11-07 11:31:37','2026-11-07 11:31:37',' ','','','publish','closed','closed','','67','','','2026-11-07 11:31:37','2026-11-07 11:31:37','',0,'http://localhost/nail-saloon/2026/11/07/67/',6,'nav_menu_item','',0),(68,1,'2026-11-07 11:31:37','2026-11-07 11:31:37',' ','','','publish','closed','closed','','68','','','2026-11-07 11:31:37','2026-11-07 11:31:37','',0,'http://localhost/nail-saloon/2026/11/07/68/',0,'nav_menu_item','',0),(69,1,'2026-11-07 11:31:37','2026-11-07 11:31:37',' ','','','publish','closed','closed','','69','','','2026-11-07 11:31:37','2026-11-07 11:31:37','',0,'http://localhost/nail-saloon/2026/11/07/69/',2,'nav_menu_item','',0),(70,1,'2026-11-07 11:31:37','2026-11-07 11:31:37',' ','','','publish','closed','closed','','70','','','2026-11-07 11:31:37','2026-11-07 11:31:37','',0,'http://localhost/nail-saloon/2026/11/07/70/',3,'nav_menu_item','',0),(71,1,'2026-11-07 11:31:37','2026-11-07 11:31:37',' ','','','publish','closed','closed','','71','','','2026-11-07 11:31:37','2026-11-07 11:31:37','',0,'http://localhost/nail-saloon/2026/11/07/71/',4,'nav_menu_item','',0),(72,1,'2026-11-07 11:31:38','2026-11-07 11:31:38',' ','','','publish','closed','closed','','72','','','2026-11-07 11:31:38','2026-11-07 11:31:38','',0,'http://localhost/nail-saloon/2026/11/07/72/',5,'nav_menu_item','',0),(73,1,'2026-11-07 11:31:38','2026-11-07 11:31:38',' ','','','publish','closed','closed','','73','','','2026-11-07 11:31:38','2026-11-07 11:31:38','',0,'http://localhost/nail-saloon/2026/11/07/73/',6,'nav_menu_item','',0),(74,1,'2026-11-07 11:31:38','2026-11-07 11:31:38',' ','','','publish','closed','closed','','74','','','2026-11-07 11:31:38','2026-11-07 11:31:38','',0,'http://localhost/nail-saloon/2026/11/07/74/',7,'nav_menu_item','',0),(120,0,'2026-11-07 11:41:16','2026-11-07 11:41:16','<div class=\"mb-form__grid\">\n<div class=\"mb-field\">\n<label for=\"cf-name\" class=\"mb-label\">Name</label>\n[text your-name id:cf-name class:mb-input autocomplete:name placeholder \"Your full name\"]\n</div>\n<div class=\"mb-field\">\n<label for=\"cf-email\" class=\"mb-label\">Email</label>\n[email your-email id:cf-email class:mb-input autocomplete:email placeholder \"you@example.com\"]\n</div>\n<div class=\"mb-field\">\n<label for=\"cf-phone\" class=\"mb-label\">Phone <span class=\"mb-label__opt\">(optional)</span></label>\n[tel your-phone id:cf-phone class:mb-input autocomplete:tel placeholder \"(555) 000-0000\"]\n</div>\n<div class=\"mb-field\">\n<label for=\"cf-service\" class=\"mb-label\">Interested in</label>\n[select your-service id:cf-service class:mb-input first_as_placeholder \"Select a service\" \"Manicure\" \"Pedicure\" \"Waxing\" \"Eyelashes\" \"Something else\"]\n</div>\n<div class=\"mb-field mb-field--full\">\n<label for=\"cf-message\" class=\"mb-label\">Message</label>\n[textarea your-message id:cf-message class:mb-input rows:5 placeholder \"How can we help?\"]\n</div>\n</div>\n<div class=\"mb-form__trap\" aria-hidden=\"true\"><label>Leave this field empty</label></div>\n<div class=\"mb-form__foot\">\n<p class=\"mb-form__note\">We usually reply within one business day.</p>\n<button type=\"submit\" class=\"btn btn-primary mb-form__submit\">Send message</button>\n</div>\n1\n[_site_title]: new message from [your-name]\n[_site_title] \nmuhammadfaraz991@gmail.com\nFrom: [your-name] \nPhone: [your-phone]\nInterested in: [your-service]\n\nMessage:\n[your-message]\n\n-- \nSent from the contact form at [_site_url]\nReply-To: [your-email]\n\n\n\n\n[_site_title] \"[your-subject]\"\n[_site_title] \nMessage Body:\n[your-message]\n\n-- \nThis email is a receipt for your contact form submission on our website ([_site_title] [_site_url]) in which your email address was used. If that was not you, please ignore this message.\n[your-email]\nReply-To: [_site_admin_email]\n\n0\n0\nThank you. Your message has been received.\nSorry, your message could not be sent. Please call us instead.\nPlease check the highlighted fields and try again.\nSorry, your message could not be sent. Please call us instead.\nPlease accept the terms to continue.\nThis field is required.\nThis entry is too long.\nThis entry is too short.\nThere was an unknown error uploading the file.\nYou are not allowed to upload files of this type.\nThe uploaded file is too large.\nThere was an error uploading the file.\nPlease enter a date in YYYY-MM-DD format.\nThis field has a too early date.\nThis field has a too late date.\nPlease enter a number.\nThis field has a too small number.\nThis field has a too large number.\nThe answer to the quiz is incorrect.\nYour entered code is incorrect.\nPlease enter a valid email address.\nPlease enter a URL.\nPlease enter a valid phone number.','Contact form','','publish','closed','closed','','contact-form','','','2026-11-07 11:41:16','2026-11-07 11:41:16','',0,'http://localhost/nail-saloon/?post_type=wpcf7_contact_form&p=120',0,'wpcf7_contact_form','',0),(121,1,'2026-11-07 11:41:34','0000-00-00 00:00:00','','Auto Draft','','auto-draft','closed','closed','','','','','2026-11-07 11:41:34','0000-00-00 00:00:00','',0,'http://localhost/nail-saloon/?post_type=mb_service&p=121',0,'mb_service','',0),(122,1,'2026-11-07 11:41:35','0000-00-00 00:00:00','','Auto Draft','','auto-draft','closed','closed','','','','','2026-11-07 11:41:35','0000-00-00 00:00:00','',0,'http://localhost/nail-saloon/?post_type=mb_gallery&p=122',0,'mb_gallery','',0),(123,1,'2026-11-07 11:41:36','0000-00-00 00:00:00','','Auto Draft','','auto-draft','closed','closed','','','','','2026-11-07 11:41:36','0000-00-00 00:00:00','',0,'http://localhost/nail-saloon/?post_type=mb_review&p=123',0,'mb_review','',0),(124,1,'2026-11-07 11:41:37','0000-00-00 00:00:00','','Auto Draft','','auto-draft','closed','closed','','','','','2026-11-07 11:41:37','0000-00-00 00:00:00','',0,'http://localhost/nail-saloon/?post_type=mb_promo&p=124',0,'mb_promo','',0),(125,1,'2026-11-07 11:41:49','0000-00-00 00:00:00','','Auto Draft','','auto-draft','closed','closed','','','','','2026-11-07 11:41:49','0000-00-00 00:00:00','',0,'http://localhost/nail-saloon/?post_type=mb_service&p=125',0,'mb_service','',0),(126,1,'2026-11-07 11:41:50','0000-00-00 00:00:00','','Auto Draft','','auto-draft','closed','closed','','','','','2026-11-07 11:41:50','0000-00-00 00:00:00','',0,'http://localhost/nail-saloon/?post_type=mb_gallery&p=126',0,'mb_gallery','',0),(127,1,'2026-11-07 11:41:51','0000-00-00 00:00:00','','Auto Draft','','auto-draft','closed','closed','','','','','2026-11-07 11:41:51','0000-00-00 00:00:00','',0,'http://localhost/nail-saloon/?post_type=mb_review&p=127',0,'mb_review','',0),(128,1,'2026-11-07 11:41:52','0000-00-00 00:00:00','','Auto Draft','','auto-draft','closed','closed','','','','','2026-11-07 11:41:52','0000-00-00 00:00:00','',0,'http://localhost/nail-saloon/?post_type=mb_promo&p=128',0,'mb_promo','',0),(129,1,'2026-11-07 11:41:55','2026-11-07 11:41:55','{\"version\": 3, \"isGlobalStylesUserThemeJSON\": true }','Custom Styles','','publish','closed','closed','','wp-global-styles-maison-belle-child','','','2026-11-07 11:41:55','2026-11-07 11:41:55','',0,'http://localhost/nail-saloon/wp-global-styles-maison-belle-child/',0,'wp_global_styles','',0),(130,1,'2026-11-07 11:42:12','0000-00-00 00:00:00','','Auto Draft','','auto-draft','closed','closed','','','','','2026-11-07 11:42:12','0000-00-00 00:00:00','',0,'http://localhost/nail-saloon/?post_type=mb_service&p=130',0,'mb_service','',0),(131,1,'2026-11-07 11:42:13','0000-00-00 00:00:00','','Auto Draft','','auto-draft','closed','closed','','','','','2026-11-07 11:42:13','0000-00-00 00:00:00','',0,'http://localhost/nail-saloon/?post_type=mb_gallery&p=131',0,'mb_gallery','',0),(132,1,'2026-11-07 11:42:14','0000-00-00 00:00:00','','Auto Draft','','auto-draft','closed','closed','','','','','2026-11-07 11:42:14','0000-00-00 00:00:00','',0,'http://localhost/nail-saloon/?post_type=mb_review&p=132',0,'mb_review','',0),(133,1,'2026-11-07 11:42:15','0000-00-00 00:00:00','','Auto Draft','','auto-draft','closed','closed','','','','','2026-11-07 11:42:15','0000-00-00 00:00:00','',0,'http://localhost/nail-saloon/?post_type=mb_promo&p=133',0,'mb_promo','',0);
/*!40000 ALTER TABLE `wp_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_term_relationships`
--

DROP TABLE IF EXISTS `wp_term_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `term_order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_term_relationships`
--

LOCK TABLES `wp_term_relationships` WRITE;
/*!40000 ALTER TABLE `wp_term_relationships` DISABLE KEYS */;
INSERT INTO `wp_term_relationships` VALUES (7,2,0),(8,2,0),(9,2,0),(10,2,0),(11,2,0),(12,2,0),(13,3,0),(14,3,0),(15,3,0),(16,3,0),(17,3,0),(18,3,0),(19,4,0),(20,4,0),(21,4,0),(22,4,0),(23,4,0),(24,4,0),(25,5,0),(26,5,0),(27,5,0),(28,5,0),(29,5,0),(30,5,0),(31,6,0),(32,7,0),(33,8,0),(34,6,0),(35,6,0),(36,7,0),(37,8,0),(38,6,0),(39,7,0),(40,6,0),(41,8,0),(42,7,0),(51,9,0),(52,10,0),(53,11,0),(62,12,0),(63,12,0),(64,12,0),(65,12,0),(66,12,0),(67,12,0),(68,13,0),(69,13,0),(70,13,0),(71,13,0),(72,13,0),(73,13,0),(74,13,0),(129,14,0);
/*!40000 ALTER TABLE `wp_term_relationships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_term_taxonomy`
--

DROP TABLE IF EXISTS `wp_term_taxonomy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT 0,
  `count` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_term_taxonomy`
--

LOCK TABLES `wp_term_taxonomy` WRITE;
/*!40000 ALTER TABLE `wp_term_taxonomy` DISABLE KEYS */;
INSERT INTO `wp_term_taxonomy` VALUES (1,1,'category','',0,0),(2,2,'mb_service_cat','',0,6),(3,3,'mb_service_cat','',0,6),(4,4,'mb_service_cat','',0,6),(5,5,'mb_service_cat','',0,6),(6,6,'mb_gallery_cat','',0,5),(7,7,'mb_gallery_cat','',0,4),(8,8,'mb_gallery_cat','',0,3),(9,9,'category','',0,1),(10,10,'category','',0,1),(11,11,'category','',0,1),(12,12,'nav_menu','',0,6),(13,13,'nav_menu','',0,7),(14,14,'wp_theme','',0,1);
/*!40000 ALTER TABLE `wp_term_taxonomy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_termmeta`
--

DROP TABLE IF EXISTS `wp_termmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_termmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_termmeta`
--

LOCK TABLES `wp_termmeta` WRITE;
/*!40000 ALTER TABLE `wp_termmeta` DISABLE KEYS */;
INSERT INTO `wp_termmeta` VALUES (1,2,'mb_order','1'),(2,2,'mb_short','Sculpted, polished, perfected.'),(3,2,'mb_blurb','From a clean classic polish to a bespoke gel finish, every manicure begins with a gentle cuticle ritual and ends with a flawless, long-wearing shine.'),(4,2,'mb_icon','bottle'),(5,2,'mb_tone','blush'),(6,2,'mb_alt','Soft pink manicure with a glossy finish'),(7,3,'mb_order','2'),(8,3,'mb_short','Slow, restorative, indulgent.'),(9,3,'mb_blurb','Sink into a warm soak and let the stress melt away. Our pedicures pair meticulous care with a deeply relaxing massage.'),(10,3,'mb_icon','foot'),(11,3,'mb_tone','mauve'),(12,3,'mb_alt','Relaxing spa pedicure with warm towels'),(13,4,'mb_order','3'),(14,4,'mb_short','Smooth, quick, comfortable.'),(15,4,'mb_blurb','Gentle, skin-friendly wax applied by trained hands, with a fresh spatula every time and a calm, private setting.'),(16,4,'mb_icon','wax'),(17,4,'mb_tone','ivory'),(18,4,'mb_alt','Calm waxing room with soft linens'),(19,5,'mb_order','4'),(20,5,'mb_short','Soft, defined, effortless.'),(21,5,'mb_blurb','Lightweight lash extensions and lifts designed around your eye shape, for a look that is polished from the moment you wake up.'),(22,5,'mb_icon','lash'),(23,5,'mb_tone','gold'),(24,5,'mb_alt','Close-up of fluttering natural-look lashes');
/*!40000 ALTER TABLE `wp_termmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_terms`
--

DROP TABLE IF EXISTS `wp_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_terms`
--

LOCK TABLES `wp_terms` WRITE;
/*!40000 ALTER TABLE `wp_terms` DISABLE KEYS */;
INSERT INTO `wp_terms` VALUES (1,'Uncategorized','uncategorized',0),(2,'Manicure','manicure',0),(3,'Pedicure','pedicure',0),(4,'Waxing','waxing',0),(5,'Eyelashes','eyelashes',0),(6,'Nails','nails',0),(7,'Pedicure','pedicure',0),(8,'Lashes','lashes',0),(9,'Nail Care','nail-care',0),(10,'Spa Rituals','spa-rituals',0),(11,'Lashes','lashes',0),(12,'Primary menu','primary-menu',0),(13,'Footer menu','footer-menu',0),(14,'maison-belle-child','maison-belle-child',0);
/*!40000 ALTER TABLE `wp_terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_usermeta`
--

DROP TABLE IF EXISTS `wp_usermeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_usermeta`
--

LOCK TABLES `wp_usermeta` WRITE;
/*!40000 ALTER TABLE `wp_usermeta` DISABLE KEYS */;
INSERT INTO `wp_usermeta` VALUES (1,1,'nickname','admin'),(2,1,'first_name',''),(3,1,'last_name',''),(4,1,'description',''),(5,1,'rich_editing','true'),(6,1,'syntax_highlighting','true'),(7,1,'infinite_scrolling','true'),(8,1,'comment_shortcuts','false'),(9,1,'admin_color','modern'),(10,1,'use_ssl','0'),(11,1,'show_admin_bar_front','true'),(12,1,'locale',''),(13,1,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(14,1,'wp_user_level','10'),(15,1,'dismissed_wp_pointers',''),(16,1,'show_welcome_panel','1'),(18,1,'wp_dashboard_quick_press_last_post_id','5'),(20,1,'_yoast_wpseo_introductions','a:0:{}');
/*!40000 ALTER TABLE `wp_usermeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_users`
--

DROP TABLE IF EXISTS `wp_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(255) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT 0,
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_users`
--

LOCK TABLES `wp_users` WRITE;
/*!40000 ALTER TABLE `wp_users` DISABLE KEYS */;
INSERT INTO `wp_users` VALUES (1,'admin','$wp$2y$10$fkPHT2CtURnD.SqDPbMnx.BAS42Yy/Tzyu.A1prdfyeh4bpjdP4di','admin','muhammadfaraz991@gmail.com','http://localhost/nail-saloon','2026-11-07 11:07:35','',0,'admin');
/*!40000 ALTER TABLE `wp_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wpmailsmtp_debug_events`
--

DROP TABLE IF EXISTS `wp_wpmailsmtp_debug_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_wpmailsmtp_debug_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text DEFAULT NULL,
  `initiator` text DEFAULT NULL,
  `event_type` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wpmailsmtp_debug_events`
--

LOCK TABLES `wp_wpmailsmtp_debug_events` WRITE;
/*!40000 ALTER TABLE `wp_wpmailsmtp_debug_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wpmailsmtp_debug_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wpmailsmtp_tasks_meta`
--

DROP TABLE IF EXISTS `wp_wpmailsmtp_tasks_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_wpmailsmtp_tasks_meta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `data` longtext NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wpmailsmtp_tasks_meta`
--

LOCK TABLES `wp_wpmailsmtp_tasks_meta` WRITE;
/*!40000 ALTER TABLE `wp_wpmailsmtp_tasks_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wpmailsmtp_tasks_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_yoast_expiring_store`
--

DROP TABLE IF EXISTS `wp_yoast_expiring_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_yoast_expiring_store` (
  `key_name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `exp` datetime NOT NULL,
  PRIMARY KEY (`key_name`),
  KEY `exp_index` (`exp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_yoast_expiring_store`
--

LOCK TABLES `wp_yoast_expiring_store` WRITE;
/*!40000 ALTER TABLE `wp_yoast_expiring_store` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_yoast_expiring_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_yoast_indexable`
--

DROP TABLE IF EXISTS `wp_yoast_indexable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_yoast_indexable` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `permalink` longtext DEFAULT NULL,
  `permalink_hash` varchar(40) DEFAULT NULL,
  `object_id` bigint(20) DEFAULT NULL,
  `object_type` varchar(32) NOT NULL,
  `object_sub_type` varchar(32) DEFAULT NULL,
  `author_id` bigint(20) DEFAULT NULL,
  `post_parent` bigint(20) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `breadcrumb_title` text DEFAULT NULL,
  `post_status` varchar(20) DEFAULT NULL,
  `is_public` tinyint(1) DEFAULT NULL,
  `is_protected` tinyint(1) DEFAULT 0,
  `has_public_posts` tinyint(1) DEFAULT NULL,
  `number_of_pages` int(11) unsigned DEFAULT NULL,
  `canonical` longtext DEFAULT NULL,
  `primary_focus_keyword` varchar(191) DEFAULT NULL,
  `primary_focus_keyword_score` int(3) DEFAULT NULL,
  `readability_score` int(3) DEFAULT NULL,
  `is_cornerstone` tinyint(1) DEFAULT 0,
  `is_robots_noindex` tinyint(1) DEFAULT 0,
  `is_robots_nofollow` tinyint(1) DEFAULT 0,
  `is_robots_noarchive` tinyint(1) DEFAULT 0,
  `is_robots_noimageindex` tinyint(1) DEFAULT 0,
  `is_robots_nosnippet` tinyint(1) DEFAULT 0,
  `twitter_title` text DEFAULT NULL,
  `twitter_image` longtext DEFAULT NULL,
  `twitter_description` longtext DEFAULT NULL,
  `twitter_image_id` varchar(191) DEFAULT NULL,
  `twitter_image_source` text DEFAULT NULL,
  `open_graph_title` text DEFAULT NULL,
  `open_graph_description` longtext DEFAULT NULL,
  `open_graph_image` longtext DEFAULT NULL,
  `open_graph_image_id` varchar(191) DEFAULT NULL,
  `open_graph_image_source` text DEFAULT NULL,
  `open_graph_image_meta` mediumtext DEFAULT NULL,
  `link_count` int(11) DEFAULT NULL,
  `incoming_link_count` int(11) DEFAULT NULL,
  `prominent_words_version` int(11) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `blog_id` bigint(20) NOT NULL DEFAULT 1,
  `language` varchar(32) DEFAULT NULL,
  `region` varchar(32) DEFAULT NULL,
  `schema_page_type` varchar(64) DEFAULT NULL,
  `schema_article_type` varchar(64) DEFAULT NULL,
  `has_ancestors` tinyint(1) DEFAULT 0,
  `estimated_reading_time_minutes` int(11) DEFAULT NULL,
  `version` int(11) DEFAULT 1,
  `object_last_modified` datetime DEFAULT NULL,
  `object_published_at` datetime DEFAULT NULL,
  `inclusive_language_score` int(3) DEFAULT NULL,
  `seo_title_score` int(3) DEFAULT NULL,
  `meta_description_score` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `object_type_and_sub_type` (`object_type`,`object_sub_type`),
  KEY `object_id_and_type` (`object_id`,`object_type`),
  KEY `permalink_hash_and_object_type` (`permalink_hash`,`object_type`),
  KEY `subpages` (`post_parent`,`object_type`,`post_status`,`object_id`),
  KEY `prominent_words` (`prominent_words_version`,`object_type`,`object_sub_type`,`post_status`),
  KEY `published_sitemap_index` (`object_published_at`,`is_robots_noindex`,`object_type`,`object_sub_type`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_yoast_indexable`
--

LOCK TABLES `wp_yoast_indexable` WRITE;
/*!40000 ALTER TABLE `wp_yoast_indexable` DISABLE KEYS */;
INSERT INTO `wp_yoast_indexable` VALUES (1,'http://localhost/nail-saloon/category/nail-care/','48:130cc5f06667a85296485ede3b769a80',9,'term','category',NULL,NULL,NULL,NULL,'Nail Care',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2026-11-07 11:31:35','2026-11-07 06:47:18',1,NULL,NULL,NULL,NULL,0,NULL,2,'2026-09-12 12:00:00','2026-09-12 12:00:00',NULL,NULL,NULL),(2,'http://localhost/nail-saloon/the-art-of-a-lasting-manicure/','59:f30aa14ceea6b36a95e9cbfd4e432433',51,'post','post',1,0,NULL,'Salon-fresh nails for three weeks and beyond: what happens in the chair, and the small habits that make the difference at home.','The Art of a Manicure That Lasts','publish',NULL,0,NULL,NULL,NULL,NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2026-11-07 11:31:35','2026-11-07 06:47:18',1,NULL,NULL,NULL,NULL,0,NULL,2,'2026-09-12 12:00:00','2026-09-12 12:00:00',0,0,0),(4,'http://localhost/nail-saloon/category/spa-rituals/','50:148e49d54e96fa24131b6f2cfdf8b6de',10,'term','category',NULL,NULL,NULL,NULL,'Spa Rituals',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2026-11-07 11:31:35','2026-11-07 06:47:18',1,NULL,NULL,NULL,NULL,0,NULL,2,'2026-08-03 12:00:00','2026-08-03 12:00:00',NULL,NULL,NULL),(5,'http://localhost/nail-saloon/why-a-spa-pedicure-is-worth-the-pause/','67:6539c10d021728481db17fc092682a8c',52,'post','post',1,0,NULL,'More than polish: a spa pedicure is circulation, softness and a rare hour of stillness. Here is what to expect from your first one.','Why a Spa Pedicure Is Worth the Pause','publish',NULL,0,NULL,NULL,NULL,NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2026-11-07 11:31:35','2026-11-07 06:47:18',1,NULL,NULL,NULL,NULL,0,NULL,2,'2026-08-03 12:00:00','2026-08-03 12:00:00',0,0,0),(6,'http://localhost/nail-saloon/category/lashes/','45:5b9606ad1c2bc3f928a929d5f0697740',11,'term','category',NULL,NULL,NULL,NULL,'Lashes',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2026-11-07 11:31:35','2026-11-07 06:47:18',1,NULL,NULL,NULL,NULL,0,NULL,2,'2026-06-21 12:00:00','2026-06-21 12:00:00',NULL,NULL,NULL),(7,'http://localhost/nail-saloon/choosing-the-right-lash-style/','59:9bf3ba7d56c0bb584e002e99b937b320',53,'post','post',1,0,NULL,'Classic, hybrid or volume? A calm guide to finding the lash look that suits your eye shape, lifestyle and maintenance appetite.','Choosing the Right Lash Style for Your Eyes','publish',NULL,0,NULL,NULL,NULL,NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2026-11-07 11:31:35','2026-11-07 06:47:18',1,NULL,NULL,NULL,NULL,0,NULL,2,'2026-06-21 12:00:00','2026-06-21 12:00:00',0,0,0),(8,'http://localhost/nail-saloon/','29:7c11e67d295afd45de6c01ed02b25e18',54,'post','page',1,0,'%%sitename%% %%sep%% Nail Salon & Spa in Houston','Maison Belle Nails & Spa is a boutique nail salon in Houston offering refined manicures, pedicures, waxing and eyelash services in a calm, beautifully clean space.','Home','publish',NULL,0,NULL,NULL,NULL,NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2026-11-07 11:31:36','2026-11-07 06:41:08',1,NULL,NULL,NULL,NULL,0,NULL,2,'2026-11-07 11:31:36','2026-11-07 11:31:36',0,0,0),(9,'http://localhost/nail-saloon/services/','38:b209263153a706677e26be2adb58a5b8',55,'post','page',1,0,'Services & Prices %%sep%% %%sitename%%','Explore our manicure, pedicure, waxing and eyelash menu with transparent prices. Walk-ins welcome.','Services','publish',NULL,0,NULL,NULL,NULL,NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2026-11-07 11:31:36','2026-11-07 06:31:39',1,NULL,NULL,NULL,NULL,0,NULL,2,'2026-11-07 11:31:36','2026-11-07 11:31:36',0,0,0),(10,'http://localhost/nail-saloon/gallery/','37:634440e440e7d3d25f938891674b0221',56,'post','page',1,0,'Gallery %%sep%% %%sitename%%','A look at our nail art, pedicures and lash sets. Browse by category and tap any image to enlarge.','Gallery','publish',NULL,0,NULL,NULL,NULL,NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2026-11-07 11:31:36','2026-11-07 06:31:39',1,NULL,NULL,NULL,NULL,0,NULL,2,'2026-11-07 11:31:36','2026-11-07 11:31:36',0,0,0),(11,'http://localhost/nail-saloon/promotions/','40:2d36dac8d86db15157a861fbe7434394',57,'post','page',1,0,'Promotions %%sep%% %%sitename%%','Seasonal offers and thoughtful extras: a first-visit treat, a mani + pedi combo and a refer-a-friend reward.','Promotions','publish',NULL,0,NULL,NULL,NULL,NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2026-11-07 11:31:36','2026-11-07 06:31:39',1,NULL,NULL,NULL,NULL,0,NULL,2,'2026-11-07 11:31:36','2026-11-07 11:31:36',0,0,0),(12,'http://localhost/nail-saloon/blog/','34:4cc8c442827c8771f46b78caca04754a',58,'post','page',1,0,'Journal %%sep%% %%sitename%%','Nail care, spa rituals and beauty notes from the team: practical advice for beautiful hands, feet and lashes.','Blog','publish',NULL,0,NULL,NULL,NULL,NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2026-11-07 11:31:36','2026-11-07 06:31:39',1,NULL,NULL,NULL,NULL,0,NULL,2,'2026-11-07 11:31:36','2026-11-07 11:31:36',0,0,0),(13,'http://localhost/nail-saloon/contact/','37:c8cddde5d0fbcd148e5b65a5fb2a3465',59,'post','page',1,0,'Contact & Location %%sep%% %%sitename%%','Visit us, call or send us a message. Find our address, opening hours and map.','Contact','publish',NULL,0,NULL,NULL,NULL,NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2026-11-07 11:31:36','2026-11-07 06:31:39',1,NULL,NULL,NULL,NULL,0,NULL,2,'2026-11-07 11:31:36','2026-11-07 11:31:36',0,0,0),(14,'http://localhost/nail-saloon/policy/','36:ca09ab60cabb053d3cbd11d58d1a2d53',60,'post','page',1,0,'Booking & Cancellation Policy %%sep%% %%sitename%%','How booking, cancellations and late arrivals work at our salon. Placeholder policy text.','Policy','publish',NULL,0,NULL,NULL,NULL,NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2026-11-07 11:31:36','2026-11-07 06:31:39',1,NULL,NULL,NULL,NULL,0,NULL,2,'2026-11-07 11:31:36','2026-11-07 11:31:36',0,0,0),(15,'http://localhost/nail-saloon/','29:7c11e67d295afd45de6c01ed02b25e18',NULL,'home-page',NULL,NULL,NULL,'Maison Belle Nails & Spa %%sep%% Nail Salon & Spa in Houston','Maison Belle Nails & Spa is a boutique nail salon in Houston offering refined manicures, pedicures, waxing and eyelash services in a calm, beautifully clean space.','Home',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,'%%sitename%%','','','0',NULL,NULL,NULL,NULL,NULL,'2026-11-07 11:31:38','2026-11-07 06:47:18',1,NULL,NULL,NULL,NULL,0,NULL,2,'2026-11-07 11:31:38','2026-06-21 12:00:00',NULL,NULL,NULL),(16,NULL,NULL,NULL,'system-page','404',NULL,NULL,'Page not found %%sep%% %%sitename%%',NULL,'Error 404: Page not found',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,0,1,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-11-07 11:31:52','2026-11-07 06:31:52',1,NULL,NULL,NULL,NULL,0,NULL,1,NULL,NULL,NULL,NULL,NULL),(17,NULL,NULL,NULL,'system-page','search-result',NULL,NULL,'You searched for %%searchphrase%% %%page%% %%sep%% %%sitename%%',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,0,1,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-11-07 11:43:19','2026-11-07 06:43:19',1,NULL,NULL,NULL,NULL,0,NULL,1,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `wp_yoast_indexable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_yoast_indexable_hierarchy`
--

DROP TABLE IF EXISTS `wp_yoast_indexable_hierarchy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_yoast_indexable_hierarchy` (
  `indexable_id` int(11) unsigned NOT NULL,
  `ancestor_id` int(11) unsigned NOT NULL,
  `depth` int(11) unsigned DEFAULT NULL,
  `blog_id` bigint(20) NOT NULL DEFAULT 1,
  PRIMARY KEY (`indexable_id`,`ancestor_id`),
  KEY `indexable_id` (`indexable_id`),
  KEY `ancestor_id` (`ancestor_id`),
  KEY `depth` (`depth`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_yoast_indexable_hierarchy`
--

LOCK TABLES `wp_yoast_indexable_hierarchy` WRITE;
/*!40000 ALTER TABLE `wp_yoast_indexable_hierarchy` DISABLE KEYS */;
INSERT INTO `wp_yoast_indexable_hierarchy` VALUES (1,0,0,1),(2,0,0,1),(4,0,0,1),(5,0,0,1),(6,0,0,1),(7,0,0,1),(8,0,0,1),(9,0,0,1),(10,0,0,1),(11,0,0,1),(12,0,0,1),(13,0,0,1),(14,0,0,1),(17,0,0,1);
/*!40000 ALTER TABLE `wp_yoast_indexable_hierarchy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_yoast_migrations`
--

DROP TABLE IF EXISTS `wp_yoast_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_yoast_migrations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wp_yoast_migrations_version` (`version`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_yoast_migrations`
--

LOCK TABLES `wp_yoast_migrations` WRITE;
/*!40000 ALTER TABLE `wp_yoast_migrations` DISABLE KEYS */;
INSERT INTO `wp_yoast_migrations` VALUES (1,'20171228151840'),(2,'20171228151841'),(3,'20190529075038'),(4,'20191011111109'),(5,'20200408101900'),(6,'20200420073606'),(7,'20200428123747'),(8,'20200428194858'),(9,'20200429105310'),(10,'20200430075614'),(11,'20200430150130'),(12,'20200507054848'),(13,'20200513133401'),(14,'20200609154515'),(15,'20200616130143'),(16,'20200617122511'),(17,'20200702141921'),(18,'20200728095334'),(19,'20201202144329'),(20,'20201216124002'),(21,'20201216141134'),(22,'20210817092415'),(23,'20211020091404'),(24,'20230417083836'),(25,'20260105111111'),(26,'20260325155530'),(27,'20260709144332');
/*!40000 ALTER TABLE `wp_yoast_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_yoast_primary_term`
--

DROP TABLE IF EXISTS `wp_yoast_primary_term`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_yoast_primary_term` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) DEFAULT NULL,
  `term_id` bigint(20) DEFAULT NULL,
  `taxonomy` varchar(32) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `blog_id` bigint(20) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `post_taxonomy` (`post_id`,`taxonomy`),
  KEY `post_term` (`post_id`,`term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_yoast_primary_term`
--

LOCK TABLES `wp_yoast_primary_term` WRITE;
/*!40000 ALTER TABLE `wp_yoast_primary_term` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_yoast_primary_term` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_yoast_seo_links`
--

DROP TABLE IF EXISTS `wp_yoast_seo_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_yoast_seo_links` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `post_id` bigint(20) unsigned DEFAULT NULL,
  `target_post_id` bigint(20) unsigned DEFAULT NULL,
  `type` varchar(8) DEFAULT NULL,
  `indexable_id` int(11) unsigned DEFAULT NULL,
  `target_indexable_id` int(11) unsigned DEFAULT NULL,
  `height` int(11) unsigned DEFAULT NULL,
  `width` int(11) unsigned DEFAULT NULL,
  `size` int(11) unsigned DEFAULT NULL,
  `language` varchar(32) DEFAULT NULL,
  `region` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `link_direction` (`post_id`,`type`),
  KEY `indexable_link_direction` (`indexable_id`,`type`),
  KEY `url_index` (`url`),
  KEY `target_indexable_id_index` (`target_indexable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_yoast_seo_links`
--

LOCK TABLES `wp_yoast_seo_links` WRITE;
/*!40000 ALTER TABLE `wp_yoast_seo_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_yoast_seo_links` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-07 16:51:19
