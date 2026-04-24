-- Full schema for Scalable News Application
-- Compatible with MySQL/MariaDB via phpMyAdmin import

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET FOREIGN_KEY_CHECKS = 0;

CREATE DATABASE IF NOT EXISTS `news`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `news`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(120) NOT NULL,
  `email` VARCHAR(191) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `role` ENUM('super_admin','editor','author','moderator','analyst') NOT NULL DEFAULT 'editor',
  `avatar` VARCHAR(255) DEFAULT NULL,
  `2fa_secret` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_users_email` (`email`),
  KEY `idx_users_role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `categories` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_pa` VARCHAR(191) NOT NULL,
  `name_hi` VARCHAR(191) NOT NULL,
  `name_en` VARCHAR(191) NOT NULL,
  `slug` VARCHAR(191) NOT NULL,
  `parent_id` BIGINT UNSIGNED DEFAULT NULL,
  `color` VARCHAR(20) DEFAULT NULL,
  `icon` VARCHAR(100) DEFAULT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_categories_slug` (`slug`),
  KEY `idx_categories_parent` (`parent_id`),
  KEY `idx_categories_sort_order` (`sort_order`),
  CONSTRAINT `fk_categories_parent` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `media` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `filename` VARCHAR(255) NOT NULL,
  `path` VARCHAR(500) NOT NULL,
  `alt_text` VARCHAR(255) DEFAULT NULL,
  `credit` VARCHAR(191) DEFAULT NULL,
  `uploader_id` BIGINT UNSIGNED DEFAULT NULL,
  `type` ENUM('image','video','audio','document','other') NOT NULL DEFAULT 'image',
  `size` BIGINT UNSIGNED DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_media_uploader` (`uploader_id`),
  KEY `idx_media_type` (`type`),
  CONSTRAINT `fk_media_uploader` FOREIGN KEY (`uploader_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `articles` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(191) NOT NULL,
  `body` LONGTEXT NOT NULL,
  `excerpt` TEXT DEFAULT NULL,
  `author_id` BIGINT UNSIGNED DEFAULT NULL,
  `category_id` BIGINT UNSIGNED DEFAULT NULL,
  `lang` ENUM('pa','hi','en') NOT NULL,
  `status` ENUM('draft','review','published','archived') NOT NULL DEFAULT 'draft',
  `priority` ENUM('normal','top','featured','breaking') NOT NULL DEFAULT 'normal',
  `featured_image` BIGINT UNSIGNED DEFAULT NULL,
  `seo_title` VARCHAR(255) DEFAULT NULL,
  `meta_desc` TEXT DEFAULT NULL,
  `view_count` INT UNSIGNED NOT NULL DEFAULT 0,
  `published_at` DATETIME DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_articles_slug` (`slug`),
  KEY `idx_articles_author` (`author_id`),
  KEY `idx_articles_category` (`category_id`),
  KEY `idx_articles_featured_image` (`featured_image`),
  KEY `idx_articles_lang_status_pub` (`lang`, `status`, `published_at`),
  KEY `idx_articles_priority_pub` (`priority`, `published_at`),
  CONSTRAINT `fk_articles_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_articles_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_articles_featured_image` FOREIGN KEY (`featured_image`) REFERENCES `media` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `article_translations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `original_id` BIGINT UNSIGNED NOT NULL,
  `pa_id` BIGINT UNSIGNED DEFAULT NULL,
  `hi_id` BIGINT UNSIGNED DEFAULT NULL,
  `en_id` BIGINT UNSIGNED DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_article_translations_original` (`original_id`),
  KEY `idx_article_translations_pa` (`pa_id`),
  KEY `idx_article_translations_hi` (`hi_id`),
  KEY `idx_article_translations_en` (`en_id`),
  CONSTRAINT `fk_article_translations_original` FOREIGN KEY (`original_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_article_translations_pa` FOREIGN KEY (`pa_id`) REFERENCES `articles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_article_translations_hi` FOREIGN KEY (`hi_id`) REFERENCES `articles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_article_translations_en` FOREIGN KEY (`en_id`) REFERENCES `articles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `tags` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(191) NOT NULL,
  `slug` VARCHAR(191) NOT NULL,
  `lang` ENUM('pa','hi','en') NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_tags_slug_lang` (`slug`, `lang`),
  KEY `idx_tags_lang` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `article_tags` (
  `article_id` BIGINT UNSIGNED NOT NULL,
  `tag_id` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`article_id`, `tag_id`),
  KEY `idx_article_tags_tag_id` (`tag_id`),
  CONSTRAINT `fk_article_tags_article` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_article_tags_tag` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `comments` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` BIGINT UNSIGNED NOT NULL,
  `user_name` VARCHAR(120) NOT NULL,
  `email` VARCHAR(191) DEFAULT NULL,
  `body` TEXT NOT NULL,
  `status` ENUM('pending','approved','spam','rejected') NOT NULL DEFAULT 'pending',
  `ip` VARCHAR(45) DEFAULT NULL,
  `parent_id` BIGINT UNSIGNED DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_comments_article_status` (`article_id`, `status`),
  KEY `idx_comments_parent` (`parent_id`),
  CONSTRAINT `fk_comments_article` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_comments_parent` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(191) NOT NULL,
  `name` VARCHAR(120) DEFAULT NULL,
  `lang_pref` ENUM('pa','hi','en') NOT NULL DEFAULT 'en',
  `status` ENUM('pending','verified','unsubscribed','bounced') NOT NULL DEFAULT 'verified',
  `subscribed_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_subscribers_email` (`email`),
  KEY `idx_subscribers_status` (`status`),
  KEY `idx_subscribers_lang_pref` (`lang_pref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `breaking_news` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `headline` VARCHAR(500) NOT NULL DEFAULT '',
  `text` TEXT DEFAULT NULL,
  `url` VARCHAR(500) DEFAULT NULL,
  `lang` ENUM('pa','hi','en') NOT NULL DEFAULT 'pa',
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `sort_order` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_breaking_news_active_sort` (`is_active`, `sort_order`),
  KEY `idx_breaking_news_lang` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `redirects` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `old_url` VARCHAR(500) NOT NULL,
  `new_url` VARCHAR(500) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_redirects_old_url` (`old_url`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `settings` (
  `key` VARCHAR(191) NOT NULL,
  `value` LONGTEXT DEFAULT NULL,
  `group` VARCHAR(100) NOT NULL DEFAULT 'general',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key`),
  KEY `idx_settings_group` (`group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `push_subscribers` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `endpoint` VARCHAR(1000) NOT NULL,
  `keys_auth` VARCHAR(255) NOT NULL,
  `keys_p256dh` VARCHAR(255) NOT NULL,
  `lang` ENUM('pa','hi','en') NOT NULL DEFAULT 'en',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_push_subscribers_endpoint` (`endpoint`(191)),
  KEY `idx_push_subscribers_lang` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `ad_zones` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(120) NOT NULL,
  `position` VARCHAR(120) NOT NULL,
  `code` LONGTEXT NOT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_ad_zones_name` (`name`),
  KEY `idx_ad_zones_position` (`position`),
  KEY `idx_ad_zones_is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `page_views` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` BIGINT UNSIGNED NOT NULL,
  `ip` VARCHAR(45) DEFAULT NULL,
  `user_agent` VARCHAR(500) DEFAULT NULL,
  `viewed_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_page_views_article_viewed` (`article_id`, `viewed_at`),
  KEY `idx_page_views_viewed_at` (`viewed_at`),
  CONSTRAINT `fk_page_views_article` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TRIGGER IF EXISTS `bi_breaking_news_sync`;
DROP TRIGGER IF EXISTS `bu_breaking_news_sync`;

DELIMITER $$
CREATE TRIGGER `bi_breaking_news_sync`
BEFORE INSERT ON `breaking_news`
FOR EACH ROW
BEGIN
  SET NEW.is_active = IFNULL(NEW.is_active, IFNULL(NEW.active, 1));
  SET NEW.active = NEW.is_active;
  SET NEW.headline = IF(NEW.headline IS NULL OR NEW.headline = '', IFNULL(NEW.text, ''), NEW.headline);
  SET NEW.text = IFNULL(NEW.text, NEW.headline);
END$$

CREATE TRIGGER `bu_breaking_news_sync`
BEFORE UPDATE ON `breaking_news`
FOR EACH ROW
BEGIN
  SET NEW.is_active = IFNULL(NEW.is_active, IFNULL(NEW.active, OLD.is_active));
  SET NEW.active = NEW.is_active;
  SET NEW.headline = IF(NEW.headline IS NULL OR NEW.headline = '', IFNULL(NEW.text, OLD.headline), NEW.headline);
  SET NEW.text = IFNULL(NEW.text, NEW.headline);
END$$
DELIMITER ;

SET FOREIGN_KEY_CHECKS = 1;
