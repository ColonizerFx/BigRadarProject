-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bigradar_db
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
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_user_id_foreign` (`user_id`),
  CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
INSERT INTO `contact_messages` VALUES (1,'Harits Danish Mohd Fairuz','haritsdanish09@gmail.com','ICT and ISLAM','Test','2026-06-08 15:31:27','2026-06-08 15:31:27');
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `marketplace_listing_id` bigint(20) unsigned NOT NULL,
  `buyer_id` bigint(20) unsigned NOT NULL,
  `seller_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conversations_marketplace_listing_id_foreign` (`marketplace_listing_id`),
  KEY `conversations_buyer_id_foreign` (`buyer_id`),
  KEY `conversations_seller_id_foreign` (`seller_id`),
  CONSTRAINT `conversations_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `conversations_marketplace_listing_id_foreign` FOREIGN KEY (`marketplace_listing_id`) REFERENCES `marketplace_listings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `conversations_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversations`
--

LOCK TABLES `conversations` WRITE;
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
INSERT INTO `conversations` VALUES (1,1,4,2,'2026-06-08 08:26:31','2026-06-08 08:26:39');
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marketplace_listings`
--

DROP TABLE IF EXISTS `marketplace_listings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marketplace_listings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `condition` varchar(255) NOT NULL DEFAULT 'Used',
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `marketplace_listings_user_id_foreign` (`user_id`),
  CONSTRAINT `marketplace_listings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marketplace_listings`
--

LOCK TABLES `marketplace_listings` WRITE;
/*!40000 ALTER TABLE `marketplace_listings` DISABLE KEYS */;
INSERT INTO `marketplace_listings` VALUES (1,2,'Sapphire Pulse AMD Radeon RX 9060 XT 16GB','Graphics Card','New (Open Box)',1450.00,'Sapphire Pulse AMD Radeon RX 9060 XT 16GB GDDR6. Opened for testing only – never gamed. Full warranty intact. Box included.','Kuala Lumpur','assets/marketplace-images/sapphire_pulse_amd_radeon_rx_9_1780461725_44f40fe4_progressive_thumbnail.jpg','Active','2026-06-08 08:24:07','2026-06-08 08:24:07'),(2,2,'RTX 2080 8GB Maxsun GPU','Graphics Card','Used - Like New',880.00,'Maxsun RTX 2080 8GB GDDR6 graphics card. Working perfectly. Triple fan cooling. COD available in KL/PJ area.','Petaling Jaya','assets/marketplace-images/rtx_2080_8gb_maxsun_gpu_graphi_1780489284_35260801_progressive_thumbnail.jpg','Active','2026-06-08 08:24:07','2026-06-08 08:24:07'),(3,3,'Sapphire Pulse RX 5600 XT 6GB GPU','Graphics Card','Used - Good',420.00,'Sapphire Pulse RX 5600 XT 6GB GDDR6. Used for gaming only, no mining. Tested and working. Original box included.','Selangor','assets/marketplace-images/gpu_1779549959_cbd0fbf1_progressive_thumbnail.jpg','Active','2026-06-08 08:24:07','2026-06-08 08:24:07'),(4,3,'MSI GeForce GTX 1080 Ti Armor 11GB','Graphics Card','Used - Good',750.00,'MSI GeForce GTX 1080 Ti Armor 11GB GDDR5X. Still very capable for 1080p/1440p gaming. Sold as-is.','Kuala Lumpur','assets/marketplace-images/msi_geforce_gtx_1080_ti_armor__1780800357_13362744_progressive_thumbnail.jpg','Active','2026-06-08 08:24:07','2026-06-08 08:24:07'),(5,1,'Intel Core i5-14500T 14th Gen CPU','Processor','Used - Like New',720.00,'Intel Core i5-14500T 14th Gen, LGA1700. Low-power T-series processor. Used briefly for testing. No cooler included.','Kuala Lumpur','assets/marketplace-images/intel_core_i514500t_14th_gen_c_1780757314_97c72d28_progressive_thumbnail.jpg','Active','2026-06-08 08:24:07','2026-06-08 08:24:07'),(6,2,'Intel Celeron G3900 LGA1151 CPU','Processor','Used - Good',65.00,'Intel Celeron G3900 2.8GHz LGA1151. Pulled from working system. Budget CPU for office builds or NAS.','Penang','assets/marketplace-images/celeron_g3900_cpu_1775291202_963bd515_progressive_thumbnail.jpg','Active','2026-06-08 08:24:07','2026-06-08 08:24:07'),(7,3,'Intel Pentium G3250 LGA1150 CPU','Processor','Used - Good',45.00,'Intel Pentium G3250 3.2GHz LGA1150. Dual-core budget processor. Great for very basic office or HTPC use.','Johor','assets/marketplace-images/intel_pentium_g3250_lga1150_cp_1779031977_f4335ad9_progressive_thumbnail.jpg','Active','2026-06-08 08:24:07','2026-06-08 08:24:07'),(8,1,'Intel CPU Cooler LGA1700 Socket (12th Gen Boxed)','Cooling & Fans','New (Open Box)',55.00,'Intel stock CPU cooler for LGA1700 socket (came with i5-12400F). Never used – upgraded to aftermarket. Mounting hardware included.','Kuala Lumpur','assets/marketplace-images/intel_cpu_cooler_lga1700_socke_1780880603_cc520ac2_progressive_thumbnail.jpg','Active','2026-06-08 08:24:07','2026-06-08 08:24:07'),(9,2,'ASUS TUF Gaming Laptop – Like New','Laptop','Used - Like New',3200.00,'ASUS TUF Gaming laptop in excellent condition. Barely used. Full specs available on request. Comes with original charger and box.','Kuala Lumpur','assets/marketplace-images/asus_tuf_gaming_like_new_1780877795_c79aa926_progressive_thumbnail.jpg','Active','2026-06-08 08:24:07','2026-06-08 08:24:07'),(10,3,'Keychron K2 Pro White Edition Mechanical Keyboard','Keyboard','Used - Like New',320.00,'Keychron K2 Pro White Edition. Bluetooth + USB-C. Swappable switches. Lightly used, excellent condition.','Selangor','assets/marketplace-images/keychron_k2_pro_white_edition__1780906063_a0ba3387_progressive_thumbnail.jpg','Active','2026-06-08 08:24:07','2026-06-08 08:24:07'),(11,4,'Steam Test Free Vbucks LOL','Graphics Card','New (Open Box)',9009.00,'Modern Warfare 5 Release','Bangi','marketplace/YQYB101xpyRTkwQcubeK302OGnVnA1fAPYeFvPvS.png','Active','2026-06-08 08:26:23','2026-06-08 15:39:28');
/*!40000 ALTER TABLE `marketplace_listings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` bigint(20) unsigned NOT NULL,
  `sender_id` bigint(20) unsigned NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_conversation_id_foreign` (`conversation_id`),
  KEY `messages_sender_id_foreign` (`sender_id`),
  CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1,4,'yo',0,'2026-06-08 08:26:36','2026-06-08 08:26:36'),(2,1,4,'yo',0,'2026-06-08 08:26:39','2026-06-08 08:26:39');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_06_05_070108_create_products_table',1),(5,'2026_06_05_070109_create_contact_messages_table',1),(6,'2026_06_05_073644_create_retailers_table',1),(7,'2026_06_05_073645_create_marketplace_listings_table',1),(8,'2026_06_05_073645_create_product_retailer_table',1),(9,'2026_06_05_080951_create_orders_table',1),(10,'2026_06_05_080952_create_order_items_table',1),(11,'2026_06_05_080953_create_wishlists_table',1),(12,'2026_06_07_105724_add_mobile_and_names_to_users_table',1),(13,'2026_06_07_105725_create_addresses_table',1),(14,'2026_06_07_105726_create_conversations_table',1),(15,'2026_06_07_105728_create_messages_table',1),(16,'2026_06_07_110035_create_notifications_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('3b1a77e6-369a-40fe-82c8-f8f141f3c26c','App\\Notifications\\NewMessageNotification','App\\Models\\User',2,'{\"conversation_id\":1,\"sender_id\":4,\"sender_name\":\"Harits Danish Mohd Fairuz\",\"message_excerpt\":\"yo\"}',NULL,'2026-06-08 08:26:39','2026-06-08 08:26:39'),('a87c003e-e761-41d3-a0e6-6e7dfa191b49','App\\Notifications\\NewMessageNotification','App\\Models\\User',2,'{\"conversation_id\":1,\"sender_id\":4,\"sender_name\":\"Harits Danish Mohd Fairuz\",\"message_excerpt\":\"yo\"}',NULL,'2026-06-08 08:26:38','2026-06-08 08:26:38');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `retailer_id` bigint(20) unsigned DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  KEY `order_items_retailer_id_foreign` (`retailer_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_retailer_id_foreign` FOREIGN KEY (`retailer_id`) REFERENCES `retailers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,42,2,3299.00,1,'2026-06-08 08:25:52','2026-06-08 08:25:52'),(2,2,43,2,1899.00,1,'2026-06-08 15:38:01','2026-06-08 15:38:01'),(3,3,36,2,869.00,1,'2026-06-08 15:38:42','2026-06-08 15:38:42'),(4,3,29,2,369.00,1,'2026-06-08 15:38:42','2026-06-08 15:38:42'),(5,3,23,2,139.00,1,'2026-06-08 15:38:42','2026-06-08 15:38:42'),(6,3,22,2,869.00,1,'2026-06-08 15:38:42','2026-06-08 15:38:42'),(7,3,1,2,649.00,1,'2026-06-08 15:38:42','2026-06-08 15:38:42'),(8,3,13,1,2499.00,1,'2026-06-08 15:38:42','2026-06-08 15:38:42');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,4,3299.00,'Completed','2026-06-08 08:25:52','2026-06-08 08:25:52'),(2,4,1899.00,'Completed','2026-06-08 15:38:01','2026-06-08 15:38:01'),(3,4,5394.00,'Completed','2026-06-08 15:38:42','2026-06-08 15:38:42'),(4,4,2900.00,'Completed','2026-06-08 15:39:00','2026-06-08 15:39:00');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_retailer`
--

DROP TABLE IF EXISTS `product_retailer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_retailer` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `retailer_id` bigint(20) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `availability_status` varchar(255) NOT NULL DEFAULT 'In Stock',
  `product_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_retailer_product_id_foreign` (`product_id`),
  KEY `product_retailer_retailer_id_foreign` (`retailer_id`),
  CONSTRAINT `product_retailer_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_retailer_retailer_id_foreign` FOREIGN KEY (`retailer_id`) REFERENCES `retailers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_retailer`
--

LOCK TABLES `product_retailer` WRITE;
/*!40000 ALTER TABLE `product_retailer` DISABLE KEYS */;
INSERT INTO `product_retailer` VALUES (1,1,1,669.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(2,1,2,649.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(3,2,1,1399.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(4,2,2,1349.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(5,2,3,1450.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(6,3,1,999.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(7,3,2,979.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(8,4,1,799.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(9,4,2,779.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(10,5,1,399.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(11,5,2,389.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(12,6,1,2199.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(13,6,2,2149.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(14,6,3,2299.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(15,7,1,1299.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(16,7,2,1249.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(17,8,1,399.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(18,8,2,389.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(19,9,1,1699.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(20,9,2,1649.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(21,9,3,1750.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(22,10,1,2199.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(23,10,2,2149.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(24,11,1,3999.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(25,11,2,3850.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(26,12,1,249.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(27,12,2,239.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(28,13,1,2499.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(29,13,3,2599.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(30,14,1,699.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(31,14,2,679.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(32,15,1,849.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(33,15,2,829.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(34,15,3,899.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(35,16,1,1499.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(36,16,2,1449.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(37,16,3,1550.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(38,17,1,799.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(39,17,2,769.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(40,18,1,649.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(41,18,2,629.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(42,19,1,2499.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(43,19,2,2399.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(44,19,3,2599.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(45,20,1,2999.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(46,20,3,3099.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(47,21,1,2199.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(48,21,2,2149.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(49,22,1,899.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(50,22,2,869.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(51,23,1,149.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(52,23,2,139.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(53,24,4,299.00,'In Stock','https://www.switch.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(54,24,5,329.00,'In Stock','https://www.apple.com/my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(55,25,1,1099.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(56,25,2,1049.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(57,26,1,299.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(58,26,2,289.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(59,26,3,319.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(60,27,4,249.00,'In Stock','https://www.switch.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(61,27,5,279.00,'In Stock','https://www.apple.com/my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(62,28,1,249.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(63,28,2,239.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(64,29,3,399.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(65,29,1,379.00,'In Stock','https://tmt.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(66,29,2,369.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:06','2026-06-08 08:24:06'),(67,30,1,1599.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(68,30,2,1549.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(69,30,3,1650.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(70,31,1,169.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(71,31,2,159.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(72,32,1,549.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(73,32,2,529.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(74,33,1,499.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(75,33,2,479.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(76,33,3,519.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(77,34,1,849.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(78,34,2,829.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(79,34,3,879.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(80,35,1,299.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(81,35,2,289.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(82,36,1,899.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(83,36,2,869.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(84,37,1,349.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(85,37,2,329.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(86,38,1,599.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(87,38,2,579.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(88,38,3,629.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(89,39,1,649.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(90,39,2,629.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(91,40,1,799.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(92,40,3,849.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(93,40,2,779.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(94,41,3,7499.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(95,41,2,7299.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(96,42,1,3399.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(97,42,2,3299.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(98,42,3,3499.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(99,43,1,1949.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(100,43,2,1899.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(101,43,3,1999.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(102,44,1,2199.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(103,44,2,2149.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(104,44,3,2299.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(105,45,1,3799.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(106,45,2,3699.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(107,45,3,3999.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(108,46,1,7899.00,'In Stock','https://tmt.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(109,46,2,7799.00,'In Stock','https://www.allithypermarket.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(110,46,3,7999.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(111,47,5,9499.00,'In Stock','https://www.apple.com/my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(112,47,4,9499.00,'In Stock','https://www.switch.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(113,47,3,9699.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(114,48,5,5499.00,'In Stock','https://www.apple.com/my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(115,48,4,5499.00,'In Stock','https://www.switch.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(116,48,3,5699.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(117,49,5,6299.00,'In Stock','https://www.apple.com/my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(118,49,4,6299.00,'In Stock','https://www.switch.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07'),(119,49,3,6499.00,'In Stock','https://www.harveynorman.com.my','2026-06-08 08:24:07','2026-06-08 08:24:07');
/*!40000 ALTER TABLE `product_retailer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'AMD Ryzen 5 5600X','Processor','AMD','Six-core, twelve-thread AMD Ryzen 5 5600X processor with Wraith Stealth cooler included. AM4 socket.','assets/parts-images/6510779_sd.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(2,'AMD Ryzen 7 7700X','Processor','AMD','Eight-core, sixteen-thread AMD Ryzen 7 7700X processor for AM5 platform. Blazing fast gaming performance.','assets/parts-images/6519477cv11d.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(3,'AMD Ryzen 5 7600X','Processor','AMD','Six-core, twelve-thread AMD Ryzen 5 7600X for the AM5 platform. Efficient and fast for gaming builds.','assets/parts-images/6519479cv11d.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(4,'Intel Core i7-9700','Processor','Intel','8-core, 8-thread Intel Core i7 9th Gen desktop processor. LGA1151 socket, 3.0GHz base clock.','assets/parts-images/6347263_sd.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(5,'Intel Core i3-10100','Processor','Intel','4-core, 8-thread Intel Core i3 10th Gen processor. LGA1200 socket. Great value for budget builds.','assets/parts-images/6411497_sd.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(6,'Intel Core i7-14700K','Processor','Intel','20-core (8P+12E), 28-thread unlocked Intel 14th Gen processor. LGA1700 socket. Excellent for gaming and content creation.','assets/parts-images/6560420_sd.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(7,'Intel Core Ultra 5 245','Processor','Intel','Intel Core Ultra 5 Series 2 processor featuring Intel Arc Xe graphics. Next-gen AI performance.','assets/parts-images/99dded4e-b909-4566-9ede-38c14f3dbeca.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(8,'ASUS GeForce GT 1030 2GB','Graphics Card','ASUS','ASUS GeForce GT 1030 2GB GDDR5. Silent 0dB fan technology. Low-profile form factor.','assets/parts-images/1bff2602-9413-45c4-af0f-4ae795f48091.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(9,'ASUS Dual GeForce RTX 4060','Graphics Card','ASUS','ASUS Dual GeForce RTX 4060 8GB GDDR6. Dual Axial-tech fans. Ada Lovelace architecture.','assets/parts-images/643e9310-71fe-45ae-a4bc-2ec91ad6522d.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(10,'PNY GeForce RTX 4060 Ti 8GB','Graphics Card','PNY','PNY GeForce RTX 4060 Ti 8GB GDDR6. Dual-fan cooling. DLSS 3 and Ray Tracing support.','assets/parts-images/9690eca9-a815-4622-a275-9e3bd100f833.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(11,'NVIDIA GeForce RTX 3090 Founders Edition','Graphics Card','NVIDIA','NVIDIA GeForce RTX 3090 24GB GDDR6X Founders Edition. The ultimate gaming and creative GPU.','assets/parts-images/a4713530-fe3f-4f50-aab5-7c050031d24d.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(12,'ASUS GeForce GT 730 2GB (Silent)','Graphics Card','ASUS','ASUS GeForce GT 730 2GB DDR3. Fanless silent design. Perfect for HTPC and light office use.','assets/parts-images/bc49d6c5-1892-4db4-a53c-cffe94a543dd.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(13,'NVIDIA GeForce RTX 2080 Founders Edition','Graphics Card','NVIDIA','NVIDIA GeForce RTX 2080 8GB GDDR6 Founders Edition. Turing architecture with real-time ray tracing.','assets/parts-images/photo_6075886072840786727_y.jpg','2026-06-08 08:24:06','2026-06-08 08:24:06'),(14,'MSI MAG B660 Tomahawk WiFi DDR4','Motherboard','MSI','MSI MAG B660 Tomahawk WiFi ATX motherboard for Intel 12th Gen. AMD B550 socket compatibility, DDR4.','assets/parts-images/6504286_sd.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(15,'MSI PRO B650-P WiFi','Motherboard','MSI','MSI PRO B650-P WiFi ATX motherboard for AMD Ryzen 7000 series. AM5 socket, PCIe 5.0 support.','assets/parts-images/6528250_sd.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(16,'ASUS TUF Gaming Z790-Plus WiFi','Motherboard','ASUS','ASUS TUF Gaming Z790-Plus WiFi ATX motherboard for Intel 12th/13th/14th Gen. LGA1700 socket.','assets/parts-images/6571645_sd.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(17,'Gigabyte B650 Eagle AX','Motherboard','Gigabyte','Gigabyte B650 Eagle AX ATX motherboard for AMD Ryzen 7000 series. AM5 socket, WiFi 6E.','assets/parts-images/6582206_sd.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(18,'MSI PRO B760-P WiFi DDR4','Motherboard','MSI','MSI PRO B760-P WiFi DDR4 ATX motherboard for Intel 12th/13th/14th Gen. LGA1700 socket.','assets/parts-images/0970fb59-28f8-4385-a62d-af4e9a598ab2.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(19,'ASUS ROG Strix X670E-E Gaming WiFi','Motherboard','ASUS','ASUS ROG Strix X670E-E Gaming WiFi ATX motherboard. AM5, PCIe 5.0, DDR5, flagship gaming board.','assets/parts-images/3298c3e2-703b-41b4-8352-1890a744f0b8.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(20,'ASUS ROG Crosshair X670E Hero','Motherboard','ASUS','ASUS ROG Crosshair X670E Hero ATX motherboard. AM5 socket, 18+2 power stages, PCIe 5.0.','assets/parts-images/7410aaa4-e6b9-4462-b14b-1d3f52139e7a.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(21,'ASUS ROG Strix X670E-A Gaming WiFi (White)','Motherboard','ASUS','ASUS ROG Strix X670E-A in stunning white finish. AM5 socket, WiFi 6E, PCIe 5.0 M.2 slots.','assets/parts-images/7fba94b0-6853-48b0-8a2d-3f8cd43ee128.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(22,'ASUS TUF Gaming B650M-Plus WiFi','Motherboard','ASUS','ASUS TUF Gaming B650M-Plus WiFi mATX motherboard. AM5 socket, DDR5, compact gaming form factor.','assets/parts-images/f5960e0a-d7cd-4c0a-bbba-81f95cb3b703.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(23,'Crucial 16GB DDR4 SO-DIMM 3200MHz','Memory','Crucial','Crucial 16GB single stick DDR4 SO-DIMM for laptops and small form factor builds. 3200MHz CL22.','assets/parts-images/33b91cec-0768-46d2-af6e-9331e5fa68fb.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(24,'OWC 8GB DDR3 1066MHz SO-DIMM Kit for Mac','Memory','OWC','OWC 8GB (4x2GB) DDR3 1066MHz 204-pin SO-DIMM kit. Designed specifically for Apple Mac systems.','assets/parts-images/8770e2c2-04b2-4dd2-9fc9-458b3e49b6de.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(25,'T-Create Expert DDR5 64GB (4x16GB) 6400MHz','Memory','TeamGroup','T-Create Expert DDR5 64GB quad-channel kit. 6400MHz speed. Optimized for high-performance workstations.','assets/parts-images/d14e7c55-ef17-43ff-b496-2af7f10fd3d4.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(26,'Crucial Pro 32GB (2x16GB) DDR4 3200MHz','Memory','Crucial','Crucial Pro 32GB DDR4 3200MHz dual-channel kit. High-performance with heatspreader design.','assets/parts-images/ed7f5fc1-1a8d-4a08-8f49-e932bdbdf0a1.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(27,'OWC 8GB DDR3 1066MHz DIMM Kit for Mac Pro','Memory','OWC','OWC 8GB (4x2GB) DDR3 1066MHz 240-pin DIMM kit. Designed for Mac Pro desktop systems.','assets/parts-images/f7e10516-f59c-4bde-850a-341beee17e0b.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(28,'PNY CS900 1TB 2.5\" SATA SSD','Storage','PNY','PNY CS900 1TB 2.5\" SATA III solid state drive. Up to 535 MB/s read speed. Perfect for OS and games.','assets/parts-images/6385542cv11d.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(29,'WD Easystore 2TB External HDD','Storage','Western Digital','WD Easystore 2TB USB 3.0 portable external hard drive. Compact design for on-the-go storage.','assets/parts-images/6406513_sd.webp','2026-06-08 08:24:06','2026-06-08 08:24:06'),(30,'Samsung 990 PRO 4TB PCIe 4.0 NVMe M.2','Storage','Samsung','Samsung 990 PRO 4TB V-NAND NVMe SSD. Up to 7450 MB/s sequential read. PCIe 4.0 x4 interface.','assets/parts-images/6559270_sd.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(31,'Kingston NV3 500GB PCIe 4.0 NVMe M.2','Storage','Kingston','Kingston NV3 500GB M.2 2280 NVMe SSD. PCIe 4.0 with up to 3500 MB/s read speed.','assets/parts-images/3aff2076-8e11-4ceb-933b-f756ed660316.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(32,'WD Black SN770M 2TB PCIe 4.0 NVMe M.2','Storage','Western Digital','WD Black SN770M 2TB compact M.2 2230 NVMe SSD. Ideal for handheld gaming devices and ultrabooks.','assets/parts-images/756ef8f2-5974-4441-a53d-7b5f9e9016cc.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(33,'WD Blue 4TB 3.5\" Desktop HDD','Storage','Western Digital','WD Blue 4TB 3.5\" SATA internal hard drive. 5400 RPM, 256MB cache. Reliable bulk storage.','assets/parts-images/c199a36f-7abf-4b21-8756-94335cafea4d.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(34,'Seagate BarraCuda 8TB 3.5\" Desktop HDD','Storage','Seagate','Seagate BarraCuda 8TB 3.5\" SATA HDD. 5400 RPM, 256MB cache. Ideal for high-capacity NAS and desktops.','assets/parts-images/cebd47fc-5b56-4360-8d75-2058bccbe7cb.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(35,'Crucial P310 1TB PCIe Gen4 NVMe M.2 SSD','Storage','Crucial','Crucial P310 1TB M.2 2280 NVMe SSD. PCIe Gen4 with up to 7100 MB/s read speed.','assets/parts-images/e8979dd4-087e-4417-b342-6367e8e5d44f.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(36,'Thermaltake Toughpower GF A3 1080W','Power Supply','Thermaltake','Thermaltake Toughpower GF A3 1080W fully modular ATX 3.1 PSU. 80 Plus Gold certified.','assets/parts-images/6566259_sd.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(37,'Thermaltake Smart BM3 650W','Power Supply','Thermaltake','Thermaltake Smart BM3 650W semi-modular ATX PSU. 80 Plus Bronze. Quiet 120mm fan.','assets/parts-images/6569210_sd.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(38,'Corsair RM850e 850W Fully Modular','Power Supply','Corsair','Corsair RM850e 850W fully modular ATX 3.0 PSU. 80 Plus Gold, ultra-quiet operation.','assets/parts-images/a020d8ea-033f-45ec-8634-085cb0225c83.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(39,'MSI MAG A850GL PCIE5 850W','Power Supply','MSI','MSI MAG A850GL PCIE5 850W fully modular ATX 3.1 PSU. 80 Plus Gold. Native PCIe 5.1 connector.','assets/parts-images/b5a8d25a-71c6-46fa-8fcc-3ddf1dac1618.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(40,'Corsair RM1000x 1000W Fully Modular','Power Supply','Corsair','Corsair RM1000x 1000W fully modular ATX PSU. 80 Plus Gold, Zero RPM fan mode.','assets/parts-images/b97f494a-4f7e-41e9-964b-69d71c119044.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(41,'Microsoft Surface Laptop 7 15\" (Snapdragon X2 Elite)','Windows Laptop','Microsoft','Microsoft Surface Laptop 7 15-inch with Snapdragon X2 Elite. Copilot+ PC with AI capabilities, up to 22 hours battery life, stunning PixelSense display.','assets/parts-images/25bb78a3-9fbf-4a10-a809-bf0627045eb9.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(42,'HP Victus 15 Gaming Laptop (Intel Core i5)','Windows Laptop','HP','HP Victus 15 gaming laptop powered by Intel Core i5 13th Gen with NVIDIA GeForce RTX discrete graphics. 144Hz FHD display, Xbox Game Pass ready.','assets/parts-images/302c3f32-6eda-42a4-8ceb-132669c257d0.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(43,'HP 14s Laptop (Intel)','Windows Laptop','HP','HP 14s lightweight laptop with Intel processor. 14-inch FHD display, slim and portable design. Ideal for students and everyday productivity.','assets/parts-images/3bd638b3-4542-4115-8e43-34faa18a2382.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(44,'Lenovo IdeaPad Slim 3 15\" (Frost Blue)','Windows Laptop','Lenovo','Lenovo IdeaPad Slim 3 15-inch in Frost Blue. Everyday performance with a full HD display, long battery life, and lightweight build for students.','assets/parts-images/449185b2-c8c5-4dbb-9d85-0e1ac7d7d57a.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(45,'MSI Thin 15 Gaming Laptop (Ryzen 5 + RTX 144Hz)','Windows Laptop','MSI','MSI Thin 15 gaming laptop with AMD Ryzen 5 and NVIDIA GeForce RTX graphics. 144Hz FHD IPS display, teal RGB backlit keyboard.','assets/parts-images/6d5b875f-3b2c-41ef-845f-525f9063c7e0.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(46,'Acer Predator Helios 16 OLED (RTX + AI)','Windows Laptop','Acer','Acer Predator Helios 16 OLED gaming laptop with NVIDIA GeForce RTX and AI-powered performance. Brilliant OLED display, VR-ready, award-winning design.','assets/parts-images/ede7f9e4-1569-4fd4-905a-bdc12289ab4d.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(47,'Apple MacBook Pro 14-inch (M3 Pro) Space Black','Apple Devices','Apple','Apple MacBook Pro 14-inch with M3 Pro chip in Space Black. Stunning Liquid Retina XDR display.','assets/parts-images/653a22d9-0889-442e-9f67-7ee03a92ffe5.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(48,'Apple MacBook Air 13-inch (M2) Starlight','Apple Devices','Apple','Apple MacBook Air 13-inch with M2 chip in Starlight. Fanless design, all-day battery life.','assets/parts-images/6f4c4bef-6af3-40e2-b62e-b1396d2f6f8b.webp','2026-06-08 08:24:07','2026-06-08 08:24:07'),(49,'Apple MacBook Air 15-inch (M2) Midnight','Apple Devices','Apple','Apple MacBook Air 15-inch with M2 chip in Midnight. Large Liquid Retina display with fanless design.','assets/parts-images/776b4db3-e2f4-4412-b45c-99cbef911bd6.webp','2026-06-08 08:24:07','2026-06-08 08:24:07');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retailers`
--

DROP TABLE IF EXISTS `retailers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retailers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retailers`
--

LOCK TABLES `retailers` WRITE;
/*!40000 ALTER TABLE `retailers` DISABLE KEYS */;
INSERT INTO `retailers` VALUES (1,'TMT','https://tmt.my','assets/logos/tmt.svg','Mid Valley Megamall, KL',3.1180000,101.6769000,'2026-06-08 08:24:06','2026-06-08 08:24:06'),(2,'All IT Hypermarket','https://www.allithypermarket.com.my','assets/logos/allit.svg','Plaza Low Yat, KL',3.1457000,101.7106000,'2026-06-08 08:24:06','2026-06-08 08:24:06'),(3,'Harvey Norman','https://www.harveynorman.com.my','assets/logos/harvey.svg','Pavilion Bukit Jalil, KL',3.0580000,101.6891000,'2026-06-08 08:24:06','2026-06-08 08:24:06'),(4,'Switch','https://www.switch.com.my','assets/logos/switch.svg','The Gardens Mall, KL',3.1178000,101.6763000,'2026-06-08 08:24:06','2026-06-08 08:24:06'),(5,'Apple Store','https://www.apple.com/my','assets/logos/apple.svg','Pavilion KL',3.1488000,101.7130000,'2026-06-08 08:24:06','2026-06-08 08:24:06');
/*!40000 ALTER TABLE `retailers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('6jUGe6lOJfr1Pz4nYl8gAsjK6dq7T9dvS5wZ0wRn',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidm1wT09VWGVyU1g5NnpVZGZkbDlkSTA3NGQ5aE5XZFZPUnNQcmROaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Njg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZXZpY2VzP2JyYW5kPSZjYXRlZ29yeT1XaW5kb3dzJTIwTGFwdG9wJnNvcnQ9IjtzOjU6InJvdXRlIjtzOjc6ImRldmljZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=',1780962176);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test User','test@example.com','2026-06-08 08:24:04','$2y$12$bAUi8dnZ1wZfRu34qv4rjeINlhtJEA8kB/4ek78RsNqEfZWW7iR16','vlfAUN6evp','2026-06-08 08:24:05','2026-06-08 08:24:05',NULL,NULL,NULL),(2,'PC Gamer 99','gamer99@example.com','2026-06-08 08:24:05','$2y$12$qg07pofC71mkJOjw9CpTs.yImNXW/TbYxtitPK7agKSstM5g196Xq','67S9TBQOQe','2026-06-08 08:24:05','2026-06-08 08:24:05',NULL,NULL,NULL),(3,'TechSeller KL','techseller@example.com','2026-06-08 08:24:06','$2y$12$4bOCoaKGQazeoQNYxQ4C6.yyFknvwlk5hOOTbgxQkxOR0xlxIrbQG','tuqvxFykLq','2026-06-08 08:24:06','2026-06-08 08:24:06',NULL,NULL,NULL),(4,'Harits Danish Mohd Fairuz','haritsdanish09@gmail.com',NULL,'$2y$12$AWCbs9IeTqqtR2Y9TSul.OvA9fnqg3OFY4WSh3nvnSljSMKda/Azi','CjVgq40p8vlsaXQD94cjpCDl82F1hOIU4HGTRPC59O4BRMmzrYWqa57QY3ah','2026-06-08 08:25:08','2026-06-08 08:25:08',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishlists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  KEY `wishlists_product_id_foreign` (`product_id`),
  CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-09  8:03:02
