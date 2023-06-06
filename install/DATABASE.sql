-- -------------------------------------------------------------
-- TablePlus 5.0.0(454)
--
-- https://tableplus.com/
--
-- Database: otradeoct2021
-- Generation Time: 2022-11-28 10:20:20.3710 AM
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `activities` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user` int DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=358 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_2fa_expiry` datetime DEFAULT CURRENT_TIMESTAMP,
  `enable_2fa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disbaled',
  `token_2fa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pass_2fa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_style` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dark',
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acnt_type_active` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `agents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_refered` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `total_activated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `earnings` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `autologin_tokens` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `autologin_tokens_token_unique` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `bnc_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `prepay_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_id` bigint unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `contents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cp_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Item_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_paid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_plan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `user_tele_id` int DEFAULT NULL,
  `amount1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_p_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_pv_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_m_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_ipn_secret` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_debug_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `crypto_accounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `btc` float DEFAULT NULL,
  `eth` float DEFAULT NULL,
  `ltc` float DEFAULT NULL,
  `xrp` float DEFAULT NULL,
  `link` float DEFAULT NULL,
  `bnb` float DEFAULT NULL,
  `aave` float DEFAULT NULL,
  `usdt` float DEFAULT NULL,
  `xlm` float DEFAULT NULL,
  `bch` float DEFAULT NULL,
  `ada` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `crypto_records` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `source` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dest` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `quantity` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `deposits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` int DEFAULT NULL,
  `amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_mode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan` int DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proof` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ref_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `ipaddresses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `kycs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_media` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frontimg` text COLLATE utf8mb4_unicode_ci,
  `backimg` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kycs_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `mt4_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `mt4_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mt4_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leverage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `reminded_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `paystacks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paystack_public_key` text COLLATE utf8mb4_unicode_ci,
  `paystack_secret_key` text COLLATE utf8mb4_unicode_ci,
  `paystack_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paystack_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maxr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gift` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expected_return` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `increment_interval` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `increment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `increment_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capt_secret` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capt_sitekey` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_mode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_s_k` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_p_k` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pp_cs` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pp_ci` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade_mode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_translate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weekend_trade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_server` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emailfrom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emailfromname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_host` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_port` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_encrypt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_secret` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_redirect` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_commission` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_commission1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_commission2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_commission3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_commission4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_commission5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signup_bonus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_bonus` int DEFAULT NULL,
  `tawk_to` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `enable_2fa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `enable_kyc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `enable_kyc_registration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_with` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_verification` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `enable_social_login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `withdrawal_option` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'auto',
  `deposit_option` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auto_merchant_option` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Coinpayment',
  `dashboard_option` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_annoc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_service` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `captcha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_capital` tinyint(1) DEFAULT '1',
  `should_cancel_plan` tinyint(1) DEFAULT '1',
  `commission_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission_fee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthlyfee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quarterlyfee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yearlyfee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `newupdate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modules` json DEFAULT NULL,
  `redirect_url` varchar(192) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_theme` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'purpose.css',
  `credit_card_provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Paystack',
  `deduction_option` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'userRequest',
  `welcome_message` text COLLATE utf8mb4_unicode_ci,
  `install_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchant_key` varchar(192) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `settings_conts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `use_crypto_feature` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `fee` float DEFAULT '0',
  `btc` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  `eth` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  `ltc` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  `link` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  `bnb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  `aave` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'enabled',
  `usdt` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  `bch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  `xlm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  `xrp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  `ada` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  `currency_rate` int DEFAULT NULL,
  `minamt` int DEFAULT NULL,
  `use_transfer` tinyint(1) DEFAULT '1',
  `min_transfer` int DEFAULT '0',
  `purchase_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'xxxxxx',
  `transfer_charges` int DEFAULT '0',
  `bnc_secret_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bnc_api_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flw_secret_hash` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flw_secret_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flw_public_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `local_currency` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission_p2p` float DEFAULT NULL,
  `enable_p2p` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_currency` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram_bot_api` varchar(192) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `priority` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `terms_privacies` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `useterms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `testimonies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ref_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `what_is_said` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tp__transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_plan_id` int DEFAULT NULL,
  `user` int DEFAULT NULL,
  `amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plan` int DEFAULT NULL,
  `user` int DEFAULT NULL,
  `amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inv_duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  `activated_at` datetime DEFAULT NULL,
  `last_growth` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profit_earned` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kyc_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dob` date DEFAULT NULL,
  `cstatus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userupdate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `assign_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_style` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'light',
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `swift_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acnt_type_active` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eth_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ltc_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usdt_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_plan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_bal` float DEFAULT NULL,
  `roi` float DEFAULT NULL,
  `bonus` float DEFAULT NULL,
  `ref_bonus` float DEFAULT NULL,
  `signup_bonus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auto_trade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonus_released` int NOT NULL DEFAULT '0',
  `ref_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_verify` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entered_at` datetime DEFAULT NULL,
  `activated_at` datetime DEFAULT NULL,
  `last_growth` datetime DEFAULT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `trade_mode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'on',
  `act_session` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `withdrawotp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sendotpemail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Yes',
  `sendroiemail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Yes',
  `sendpromoemail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Yes',
  `sendinvplanemail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `wdmethods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minimum` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maximum` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charges_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charges_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `bankname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `swift_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `barcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `network` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `methodtype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `defaultpay` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `withdrawals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` int DEFAULT NULL,
  `amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `columns` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_deduct` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_mode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paydetails` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `activities` (`id`, `user`, `ip_address`, `created_at`, `updated_at`, `device`, `browser`, `os`) VALUES
(302, 93, '127.0.0.1', '2022-08-25 17:20:44', '2022-08-25 17:20:44', 'Macintosh', 'Chrome', 'OS X'),
(303, 93, '127.0.0.1', '2022-08-25 17:20:44', '2022-08-25 17:20:44', 'Macintosh', 'Chrome', 'OS X'),
(304, 93, '127.0.0.1', '2022-08-25 18:13:52', '2022-08-25 18:13:52', 'Macintosh', 'Chrome', 'OS X'),
(305, 93, '127.0.0.1', '2022-08-25 18:13:52', '2022-08-25 18:13:52', 'Macintosh', 'Chrome', 'OS X'),
(306, 93, '127.0.0.1', '2022-08-30 18:11:00', '2022-08-30 18:11:00', 'Macintosh', 'Chrome', 'OS X'),
(307, 93, '127.0.0.1', '2022-08-30 18:11:00', '2022-08-30 18:11:00', 'Macintosh', 'Chrome', 'OS X'),
(308, 93, '127.0.0.1', '2022-08-31 18:42:45', '2022-08-31 18:42:45', 'Macintosh', 'Chrome', 'OS X'),
(309, 93, '127.0.0.1', '2022-08-31 18:42:45', '2022-08-31 18:42:45', 'Macintosh', 'Chrome', 'OS X'),
(310, 93, '127.0.0.1', '2022-08-31 21:09:24', '2022-08-31 21:09:24', 'Macintosh', 'Chrome', 'OS X'),
(311, 93, '127.0.0.1', '2022-08-31 21:09:25', '2022-08-31 21:09:25', 'Macintosh', 'Chrome', 'OS X'),
(312, 93, '127.0.0.1', '2022-09-02 04:01:40', '2022-09-02 04:01:40', 'Macintosh', 'Chrome', 'OS X'),
(313, 93, '127.0.0.1', '2022-09-02 04:01:40', '2022-09-02 04:01:40', 'Macintosh', 'Chrome', 'OS X'),
(314, 93, '127.0.0.1', '2022-09-06 17:12:15', '2022-09-06 17:12:15', 'Macintosh', 'Chrome', 'OS X'),
(315, 93, '127.0.0.1', '2022-09-06 17:12:15', '2022-09-06 17:12:15', 'Macintosh', 'Chrome', 'OS X'),
(316, 93, '127.0.0.1', '2022-09-07 17:45:03', '2022-09-07 17:45:03', 'Macintosh', 'Chrome', 'OS X'),
(317, 93, '127.0.0.1', '2022-09-07 17:45:03', '2022-09-07 17:45:03', 'Macintosh', 'Chrome', 'OS X'),
(318, 93, '127.0.0.1', '2022-09-08 00:08:32', '2022-09-08 00:08:32', 'Macintosh', 'Chrome', 'OS X'),
(319, 93, '127.0.0.1', '2022-09-08 00:08:32', '2022-09-08 00:08:32', 'Macintosh', 'Chrome', 'OS X'),
(320, 93, '127.0.0.1', '2022-09-08 03:40:14', '2022-09-08 03:40:14', 'Macintosh', 'Chrome', 'OS X'),
(321, 93, '127.0.0.1', '2022-09-08 03:40:14', '2022-09-08 03:40:14', 'Macintosh', 'Chrome', 'OS X'),
(322, 93, '127.0.0.1', '2022-09-08 15:49:50', '2022-09-08 15:49:50', 'Macintosh', 'Chrome', 'OS X'),
(323, 93, '127.0.0.1', '2022-09-08 15:49:50', '2022-09-08 15:49:50', 'Macintosh', 'Chrome', 'OS X'),
(324, 93, '127.0.0.1', '2022-09-08 19:18:40', '2022-09-08 19:18:40', 'Macintosh', 'Chrome', 'OS X'),
(325, 93, '127.0.0.1', '2022-09-08 19:18:40', '2022-09-08 19:18:40', 'Macintosh', 'Chrome', 'OS X'),
(326, 93, '127.0.0.1', '2022-09-08 22:01:50', '2022-09-08 22:01:50', 'Macintosh', 'Chrome', 'OS X'),
(327, 93, '127.0.0.1', '2022-09-08 22:01:50', '2022-09-08 22:01:50', 'Macintosh', 'Chrome', 'OS X'),
(328, 93, '127.0.0.1', '2022-09-29 19:33:15', '2022-09-29 19:33:15', 'Macintosh', 'Chrome', 'OS X'),
(329, 93, '127.0.0.1', '2022-09-29 19:33:15', '2022-09-29 19:33:15', 'Macintosh', 'Chrome', 'OS X'),
(330, 93, '127.0.0.1', '2022-09-30 23:05:45', '2022-09-30 23:05:45', 'Macintosh', 'Chrome', 'OS X'),
(331, 93, '127.0.0.1', '2022-09-30 23:05:45', '2022-09-30 23:05:45', 'Macintosh', 'Chrome', 'OS X'),
(332, 93, '127.0.0.1', '2022-10-01 04:20:32', '2022-10-01 04:20:32', 'Macintosh', 'Chrome', 'OS X'),
(333, 93, '127.0.0.1', '2022-10-01 04:20:32', '2022-10-01 04:20:32', 'Macintosh', 'Chrome', 'OS X'),
(334, 93, '127.0.0.1', '2022-10-03 15:03:52', '2022-10-03 15:03:52', 'Macintosh', 'Chrome', 'OS X'),
(335, 93, '127.0.0.1', '2022-10-03 15:03:52', '2022-10-03 15:03:52', 'Macintosh', 'Chrome', 'OS X'),
(336, 93, '127.0.0.1', '2022-11-04 16:37:39', '2022-11-04 16:37:39', 'Macintosh', 'Chrome', 'OS X'),
(337, 93, '127.0.0.1', '2022-11-04 16:37:39', '2022-11-04 16:37:39', 'Macintosh', 'Chrome', 'OS X'),
(338, 93, '127.0.0.1', '2022-11-09 18:06:10', '2022-11-09 18:06:10', 'Macintosh', 'Chrome', 'OS X'),
(339, 93, '127.0.0.1', '2022-11-09 18:06:10', '2022-11-09 18:06:10', 'Macintosh', 'Chrome', 'OS X'),
(340, 93, '127.0.0.1', '2022-11-11 01:13:04', '2022-11-11 01:13:04', 'Macintosh', 'Chrome', 'OS X'),
(341, 93, '127.0.0.1', '2022-11-11 01:13:04', '2022-11-11 01:13:04', 'Macintosh', 'Chrome', 'OS X'),
(342, 93, '127.0.0.1', '2022-11-11 01:34:23', '2022-11-11 01:34:23', 'iPhone', 'Safari', 'iOS'),
(343, 93, '127.0.0.1', '2022-11-11 01:34:23', '2022-11-11 01:34:23', 'iPhone', 'Safari', 'iOS'),
(344, 93, '127.0.0.1', '2022-11-15 19:24:03', '2022-11-15 19:24:03', 'Macintosh', 'Chrome', 'OS X'),
(345, 93, '127.0.0.1', '2022-11-15 19:24:03', '2022-11-15 19:24:03', 'Macintosh', 'Chrome', 'OS X'),
(346, 93, '127.0.0.1', '2022-11-16 02:47:56', '2022-11-16 02:47:56', 'Macintosh', 'Chrome', 'OS X'),
(347, 93, '127.0.0.1', '2022-11-16 02:47:56', '2022-11-16 02:47:56', 'Macintosh', 'Chrome', 'OS X'),
(348, 93, '127.0.0.1', '2022-11-16 15:47:55', '2022-11-16 15:47:55', 'Macintosh', 'Chrome', 'OS X'),
(349, 93, '127.0.0.1', '2022-11-16 15:47:55', '2022-11-16 15:47:55', 'Macintosh', 'Chrome', 'OS X'),
(350, 93, '127.0.0.1', '2022-11-24 15:09:48', '2022-11-24 15:09:48', 'Macintosh', 'Chrome', 'OS X'),
(351, 93, '127.0.0.1', '2022-11-24 15:09:48', '2022-11-24 15:09:48', 'Macintosh', 'Chrome', 'OS X'),
(352, 93, '127.0.0.1', '2022-11-25 08:25:42', '2022-11-25 08:25:42', 'Macintosh', 'Chrome', 'OS X'),
(353, 93, '127.0.0.1', '2022-11-25 08:25:42', '2022-11-25 08:25:42', 'Macintosh', 'Chrome', 'OS X'),
(354, 93, '127.0.0.1', '2022-11-26 19:46:04', '2022-11-26 19:46:04', 'Macintosh', 'Chrome', 'OS X'),
(355, 93, '127.0.0.1', '2022-11-26 19:46:04', '2022-11-26 19:46:04', 'Macintosh', 'Chrome', 'OS X'),
(356, 93, '127.0.0.1', '2022-11-28 09:31:06', '2022-11-28 09:31:06', 'Macintosh', 'Chrome', 'OS X'),
(357, 93, '127.0.0.1', '2022-11-28 09:31:06', '2022-11-28 09:31:06', 'Macintosh', 'Chrome', 'OS X');

INSERT INTO `admins` (`id`, `firstName`, `lastName`, `email`, `email_verified_at`, `password`, `token_2fa_expiry`, `enable_2fa`, `token_2fa`, `pass_2fa`, `phone`, `dashboard_style`, `remember_token`, `password_token`, `acnt_type_active`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Test', 'super@happ.com', NULL, '$2y$10$Eg4s33WgOwHBCoyn88.VHuhdjPOGs6Zav7ooX2OMz9mydpc1BBdpe', '2021-12-07 11:40:56', 'disabled', '16632', 'true', '34444443', 'light', NULL, NULL, 'active', 'active', 'Super Admin', '2021-03-10 13:55:53', '2022-10-03 23:17:06'),
(3, 'New', 'Admin', 'admin@happ.com', NULL, '$2y$10$5oYJj.pka6uLST.u7jpRPOeoJ5Cjex5HJpuGxZJRo8dtRXOGOQcYq', '2021-05-05 12:39:11', 'disbaled', NULL, NULL, '2344', 'light', NULL, NULL, 'active', 'active', 'Admin', '2021-04-06 09:23:58', '2022-02-03 13:38:32');

INSERT INTO `agents` (`id`, `agent`, `total_refered`, `total_activated`, `earnings`, `created_at`, `updated_at`) VALUES
(4, '17', '8', '0', '0', '2021-04-14 10:45:06', '2021-11-22 09:00:52');

INSERT INTO `bnc_transactions` (`id`, `user_id`, `prepay_id`, `deposit_id`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 93, '167699391154495488', NULL, 'Deposit', 'Pending', '2022-06-23 12:00:05', '2022-06-23 12:00:05'),
(2, 93, '167703773979492352', NULL, 'Deposit', 'PAID', '2022-06-23 12:34:04', '2022-06-23 14:30:22'),
(3, 93, '167706013804937216', NULL, 'Deposit', 'Pending', '2022-06-23 12:51:28', '2022-06-23 12:51:28'),
(4, 93, '167709121213775872', NULL, 'Deposit', 'PAID', '2022-06-23 13:15:34', '2022-06-23 14:08:48'),
(5, 93, '167717543820550144', NULL, 'Deposit', 'Pending', '2022-06-23 14:20:57', '2022-06-23 14:20:57'),
(6, 93, '167841863929143296', NULL, 'Deposit', 'Pending', '2022-06-24 06:25:50', '2022-06-24 06:25:50'),
(7, 93, '168543279060443136', NULL, 'Deposit', 'Pending', '2022-06-28 01:09:48', '2022-06-28 01:09:48'),
(8, 93, '171959846135930880', NULL, 'Deposit', 'Pending', '2022-07-16 11:07:07', '2022-07-16 11:07:07'),
(9, 93, '194899603708616704', NULL, 'Deposit', 'Pending', '2022-11-16 22:24:20', '2022-11-16 22:24:20'),
(10, 93, '196417178992926720', NULL, 'Deposit', 'Pending', '2022-11-24 14:37:56', '2022-11-24 14:37:56');

INSERT INTO `contents` (`id`, `ref_key`, `title`, `description`, `created_at`, `updated_at`) VALUES
(5, 'SMsJr1', 'What our Customer says!', 'Don\'t take our word for it, here\'s what some of our clients have to say about us', '2020-08-22 11:13:00', '2021-10-27 09:59:35'),
(11, 'anvs8c', 'About Us', 'About us header', '2020-08-22 11:32:29', '2021-10-27 10:21:22'),
(12, 'epJ4LI', 'Who we are', 'online trade \r\n                            is a solution for creating an investment management platform. It is suited for\r\n                            hedge or mutual fund managers and also Forex, stocks, bonds and cryptocurrency traders who\r\n                            are looking at runing pool trading system. Onlinetrader simplifies the investment,\r\n                            monitoring and management process. With a secure and compelling mobile-first design,\r\n                            together with a default front-end design, it takes few minutes to setup your own investment\r\n                            management or pool trading platform.', '2020-08-22 11:33:32', '2021-10-27 10:24:01'),
(13, '5hbB6X', 'Get Started', 'How to get started ?', '2020-08-22 11:33:55', '2021-10-27 10:25:09'),
(14, 'Zrhm3I', 'Create an Account', 'Create an account with us using your preffered email/username', '2020-08-22 11:34:11', '2021-10-27 10:25:29'),
(15, 'yTKhlt', 'Make a Deposit', 'Make A deposit with any of your preffered currency', '2020-08-22 11:34:26', '2021-10-27 10:25:52'),
(16, 'u0Ervr', 'Start Trading/Investing', 'Start trading with Indices commodities e.tc', '2020-08-22 11:34:56', '2021-10-27 10:26:12'),
(23, 'vr6Xw0', 'Our Investment Packages', 'Choose how you want to invest with us', '2020-08-22 11:37:43', '2021-10-27 09:58:51'),
(30, '52GPRA', 'Address', 'No 10 Mission Road, Nigeria', '2020-08-22 11:40:19', '2020-08-22 11:40:19'),
(31, '0EXbji', 'Phone Number', '+234 9xxxxxxxx', '2020-08-22 11:40:36', '2020-09-14 10:13:57'),
(32, 'HLgyaQ', 'Email', 'support@brynamics.xyz', '2020-08-22 11:41:14', '2020-08-22 12:23:55'),
(35, 'Mnag31', 'The Better Way to Trade & Invest', 'Online Trade helps over 2 million customers achieve their financial goals by helping them trade and invest with ease', '2021-10-27 09:42:23', '2022-11-10 18:42:38'),
(36, 'rXJ7JQ', 'Trade Invest stock, and Bond', 'Home page text', '2021-10-27 09:45:17', '2021-10-27 09:45:17'),
(37, 'J23T0Y', 'Security Comes First', 'Security Comes first', '2021-10-27 09:53:15', '2021-10-27 09:54:52'),
(38, '9HOR1z', 'Security', 'Online Trade uses the highest levels of Internet Security, and it is secured by 256 bits SSL security encryption to ensure that your information is completely protected from fraud.', '2021-10-27 09:56:13', '2021-10-27 09:56:13'),
(39, '7DH2G9', 'Two Factor Auth', 'Two-factor authentication (2FA) by default on all Online Trade accounts, to securely protect you from unauthorised access and impersonation.', '2021-10-27 09:56:26', '2021-10-27 09:56:26'),
(40, '5Vg32I', 'Explore Our Services', 'It’s our mission to provide you with a delightful and a successful trading experience!', '2021-10-27 09:56:38', '2021-10-27 09:56:38'),
(41, 'Vg6Gy7', 'Powerful Trading Platforms', 'Online Trade offers multiple platform options to cover the needs of each type of trader and investors .', '2021-10-27 09:56:53', '2021-10-27 09:56:53'),
(42, '1Sx1dl', 'High leverage', 'Chance to magnify your investment and really win big with super-low spreads to further up your profits', '2021-10-27 09:57:06', '2021-10-27 09:57:06'),
(43, 'YYqKx3', 'Fast execution', 'Super-fast trading software, so you never suffer slippage.', '2021-10-27 09:57:20', '2021-10-27 09:57:20'),
(44, 'yGg8xI', 'Ultimate Security', 'With advanced security systems, we keep your account always protected.', '2021-10-27 09:57:35', '2021-10-27 09:57:35'),
(45, 'xEWMho', '24/7 live chat Support', 'Connect with our 24/7 support and Market Analyst on-demand.', '2021-10-27 09:57:48', '2021-10-27 09:57:48'),
(46, '9SOtK1', 'Always on the go? Mobile trading is easier than ever with Online Trade!', 'Get your hands on our customized Trading Platform with the comfort of freely trading on the move, to experience truly liberating trading sessions.', '2021-10-27 09:58:05', '2021-10-27 09:58:05'),
(47, 'wOS1ve', 'Cryptocurrency', 'Trade and invest Top Cryptocurrency', '2021-10-27 09:59:07', '2021-10-27 09:59:07'),
(48, 'wuZlis', 'Hello!, How can we help you?', 'Hello!, How can we help you?', '2021-10-27 10:32:12', '2021-10-27 10:32:12'),
(49, '1TYkw0', 'Find the help you need', 'Launch your campaign and benefit from our expertise on designing and managing conversion centered bootstrap4 html page.', '2021-10-27 10:32:33', '2021-10-27 10:32:33'),
(50, 'rK6Yhn', 'FAQs', 'Due to its widespread use as filler text for layouts, non-readability is of great importance.', '2021-10-27 10:32:49', '2021-10-27 10:32:49'),
(51, 'HBHBLo', 'Guides / Support', 'Due to its widespread use as filler text for layouts, non-readability is of great importance.', '2021-10-27 10:33:03', '2021-10-27 10:33:03'),
(52, 'rCTDQh', 'Support Request', 'Due to its widespread use as filler text for layouts, non-readability is of great importance.', '2021-10-27 10:33:14', '2021-10-27 10:33:14'),
(53, 'kMsswR', 'Get Started', 'Launch your campaign and benefit from our expertise on designing and managing conversion centered bootstrap4 html page.', '2021-10-27 10:33:28', '2021-10-27 10:33:28'),
(54, 'EOUU7R', 'Get in Touch !', 'This is required when, for text is not yet available.', '2021-10-27 10:33:56', '2021-10-27 10:33:56'),
(56, 'ROu4q6', 'Contact Us', 'Contact Us', '2021-10-27 10:47:41', '2021-10-27 10:47:41');

INSERT INTO `cp_transactions` (`id`, `txn_id`, `item_name`, `Item_number`, `amount_paid`, `user_plan`, `user_id`, `user_tele_id`, `amount1`, `amount2`, `currency1`, `currency2`, `status`, `status_text`, `type`, `cp_p_key`, `cp_pv_key`, `cp_m_id`, `cp_ipn_secret`, `cp_debug_email`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', 'sefef', 'Heloosjjsnnij2878u2i', 'tes@dd.gb', '2021-03-11 13:46:45', '2022-07-21 00:22:05');

INSERT INTO `crypto_accounts` (`id`, `user_id`, `btc`, `eth`, `ltc`, `xrp`, `link`, `bnb`, `aave`, `usdt`, `xlm`, `bch`, `ada`, `created_at`, `updated_at`) VALUES
(1, 93, 0.276921, 0.145275, 0.0223845, NULL, NULL, 0.499336, NULL, 182.225, NULL, NULL, 864.996, '2021-10-31 13:25:53', '2022-03-23 11:20:53'),
(2, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-14 09:15:27', '2022-02-14 09:15:27'),
(3, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-14 09:32:58', '2022-02-14 09:32:58'),
(4, 152, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-25 14:47:58', '2022-03-25 14:47:58'),
(5, 153, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-11 09:58:53', '2022-04-11 09:58:53'),
(6, 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-13 09:16:21', '2022-04-13 09:16:21'),
(7, 151, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-29 05:26:45', '2022-04-29 05:26:45'),
(8, 154, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-24 08:00:30', '2022-05-24 08:00:30'),
(9, 156, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-05 10:32:55', '2022-07-05 10:32:55'),
(10, 157, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-07 11:13:02', '2022-07-07 11:13:02'),
(11, 158, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-16 02:22:44', '2022-08-16 02:22:44'),
(12, 159, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-30 05:26:48', '2022-08-30 05:26:48'),
(13, 160, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-30 05:29:04', '2022-08-30 05:29:04'),
(14, 161, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-30 05:31:31', '2022-08-30 05:31:31'),
(15, 162, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-30 05:33:13', '2022-08-30 05:33:13'),
(16, 163, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-30 05:33:57', '2022-08-30 05:33:57'),
(17, 164, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-30 05:34:29', '2022-08-30 05:34:29'),
(18, 165, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-30 05:38:07', '2022-08-30 05:38:07'),
(19, 166, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-30 05:40:53', '2022-08-30 05:40:53'),
(20, 167, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-30 05:43:20', '2022-08-30 05:43:20'),
(21, 168, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-30 05:46:13', '2022-08-30 05:46:13'),
(22, 169, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-30 05:50:37', '2022-08-30 05:50:37');

INSERT INTO `crypto_records` (`id`, `source`, `dest`, `amount`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'BTC', 'USD', 0.00, 107.58, '2022-05-24 06:21:07', '2022-05-24 06:21:07'),
(2, 'USD', 'BNB', 50.00, 0.15, '2022-05-24 07:26:55', '2022-05-24 07:26:55'),
(3, 'BTC', 'USD', 0.21, 6219.48, '2022-05-24 07:31:53', '2022-05-24 07:31:53'),
(4, 'USD', 'ETH', 100.00, 0.05, '2022-05-24 07:36:30', '2022-05-24 07:36:30'),
(5, 'USD', 'BTC', 60.00, 0.00, '2022-06-09 04:09:48', '2022-06-09 04:09:48'),
(6, 'BTC', 'USD', 0.10, 2841.35, '2022-06-12 02:36:40', '2022-06-12 02:36:40'),
(7, 'USD', 'BTC', 300.00, 0.01, '2022-07-16 11:18:29', '2022-07-16 11:18:29');

INSERT INTO `deposits` (`id`, `txn_id`, `user`, `amount`, `payment_mode`, `plan`, `status`, `proof`, `created_at`, `updated_at`) VALUES
(72, NULL, 93, '100', 'BUSD', NULL, 'Processed', 'uploads/xh0imIrsp60JI5MnyPdA4tLCRbaaeOcwzW5X04B6.png', '2022-11-10 00:00:41', '2022-11-10 21:47:09'),
(73, NULL, 93, '100', 'Stripe', 0, 'Processed', 'Credit Card', '2022-11-16 22:20:39', '2022-11-16 22:20:39');

INSERT INTO `images` (`id`, `ref_key`, `title`, `description`, `img_path`, `created_at`, `updated_at`) VALUES
(8, 'DPd1Kn', 'Testimonial 1', 'Testimonial 1', 'SIu0JZ01.jpg1635329714', '2020-08-23 12:24:52', '2021-10-27 10:15:14'),
(9, 'ZqCgDz', 'Testimonial 2', 'Testimonial 2', 'photos/2O5A1PaPNEG6J92eybtWfyawbw8KYvCneD5VCZVM.jpg', '2020-08-23 12:25:07', '2022-02-17 10:01:28'),
(14, 'b9158B', 'Home Image', 'The image at the home page', 'photos/eQZW9KTA66MfDXmmsM7VzwfBuleCSRBpoyjaivei.jpg', '2021-10-27 09:48:42', '2022-02-16 15:32:47'),
(15, 'iAwfKe', 'About image', 'The image in the about page', 'photos/O424fd54I3OWdTvNZNDAFuVCMG1oVUMuCgbwxzeT.png', '2021-10-27 10:22:20', '2022-02-16 15:33:18');

INSERT INTO `kycs` (`id`, `user_id`, `first_name`, `last_name`, `email`, `phone_number`, `dob`, `social_media`, `address`, `city`, `state`, `country`, `document_type`, `frontimg`, `backimg`, `status`, `created_at`, `updated_at`) VALUES
(7, 93, 'Victory', 'Efekpogua', 'victrinhoj@gmail.com', '07069018215', '2022-11-17', 'Milkaydi', 'Ozoro', 'Warri', 'Delta', 'Nigeria', 'National ID', 'uploads/1lOXbRVUTc4j1OPCLw6peqzeJ05zGfS0HBm7FFbI.png', 'uploads/2bdeeKFKzJD02uFxsG8LUDP3Ab5MCv0ZyHcVFHb5.png', 'Verified', '2022-11-10 00:48:34', '2022-11-10 00:50:02');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_03_09_142220_create_sessions_table', 1),
(7, '2021_03_10_082445_create_admins_table', 2),
(8, '2021_03_10_082519_create_agents_table', 2),
(9, '2021_03_10_082715_create_assets_table', 2),
(10, '2021_03_10_082817_create_contents_table', 2),
(11, '2021_03_10_083110_create_cp_transactions_table', 2),
(12, '2021_03_10_083324_create_deposits_table', 2),
(13, '2021_03_10_083400_create_faqs_table', 2),
(14, '2021_03_10_083510_create_images_table', 2),
(15, '2021_03_10_083557_create_mt4_details_table', 2),
(16, '2021_03_10_083627_create_notifications_table', 2),
(17, '2021_03_10_083824_create_plans_table', 2),
(18, '2021_03_10_083850_create_settings_table', 2),
(19, '2021_03_10_083936_create_testimonies_table', 2),
(20, '2021_03_10_084009_create_tp__transactions_table', 2),
(21, '2021_03_10_084031_create_upgrades_table', 2),
(22, '2021_03_10_084120_create_userlogs_table', 2),
(23, '2021_03_10_084140_create_user_plans_table', 2),
(24, '2021_03_10_084235_create_wdmethods_table', 2),
(25, '2021_03_10_084300_create_withdrawals_table', 2),
(26, '2021_04_06_083043_create_tasks_table', 3),
(27, '2021_04_23_110006_create_exchanges_table', 4),
(28, '2021_04_23_114622_create_coin_transactions_table', 5),
(29, '2021_04_27_080945_create_currencies_table', 6),
(30, '2021_04_29_110349_create_c_withdrawals_table', 7),
(31, '2021_10_07_112653_create_ipaddresses_table', 8),
(32, '2021_10_27_114829_create_terms_privacies_table', 9),
(33, '2021_10_31_131124_create_crypto_accounts_table', 10),
(34, '2021_10_31_132849_create_settings_conts_table', 11),
(35, '2022_01_24_123921_create_copy_trade_accounts_table', 12),
(36, '2022_02_03_131113_create_tasks_table', 13),
(37, '2022_03_16_135903_create_adverts_table', 14),
(38, '2022_03_17_114728_create_orders_p2ps_table', 15),
(39, '2022_05_23_215802_create_crypto_records_table', 16),
(40, '2022_06_13_220336_create_kycs_table', 17),
(41, '2022_06_23_030303_create_bnc_transactions_table', 18),
(42, '2022_09_02_074542_create_courses_table', 19),
(43, '2022_09_02_074626_create_course_lessons_table', 20),
(44, '2022_09_02_074608_create_course_categories_table', 21),
(45, '2022_09_06_165000_create_user_courses_table', 22),
(46, '2014_01_28_232217_create_autologin_tokens_table', 23),
(47, '2014_02_07_004118_add_unique_index_to_autologin_tokens_table', 24),
(48, '2014_03_02_162640_add_count_to_autologin_tokens_table', 25),
(53, '2022_09_19_142955_create_master_accounts_table', 26),
(54, '2022_09_29_153351_create_signal_tbs_table', 27),
(55, '2022_09_29_175703_create_signal_subscribers_table', 28);

INSERT INTO `notifications` (`id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(2, 9, 'This is a new mail Victory, kindly apprehiend', '2021-03-12 13:38:30', '2021-03-12 13:38:30');

INSERT INTO `paystacks` (`id`, `created_at`, `updated_at`, `paystack_public_key`, `paystack_secret_key`, `paystack_url`, `paystack_email`) VALUES
(1, '2021-10-07 11:26:10', '2022-11-26 19:04:02', NULL, NULL, 'https://api.paystack.co', 'test@mail.com');

INSERT INTO `plans` (`id`, `name`, `price`, `min_price`, `max_price`, `minr`, `maxr`, `gift`, `expected_return`, `type`, `increment_interval`, `increment_type`, `increment_amount`, `expiration`, `created_at`, `updated_at`) VALUES
(10, 'Standard', '200', '180', '200', '0.046', '0.046', '0', NULL, 'Main', 'Every 30 Minutes', 'Percentage', '0.0232', '1 Hours', '2022-07-05 10:34:25', '2022-11-10 02:02:09'),
(11, 'Premium', '2000', '1000', '2000', '2', '9', '0', NULL, 'Main', 'Monthly', 'Percentage', '2', '3 Months', '2022-11-25 08:10:14', '2022-11-25 08:10:14');

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5Ldb3iLDiiDKKB9DRxrUgBHuQlu0GKuPCF06qnD8', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYWJSZGJWVmVOR1FuM3NuRVMwOUNPbEZ4bDRzWFdzSDRLWTRXeDFxMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHBzOi8vb25saW5ldHJhZGVyLnRlc3QvYWRtaW4vc2lnbmFsLXNldHRpbmdzIjt9czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1669490637),
('avISeTk89VY9yWNj8QmNEo70532GFE3Citt9T123', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:107.0) Gecko/20100101 Firefox/107.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicjl1bUZENUZmM1FMNHhiOHZZc3JtNGZ5WlhtZUNWR3JNd2t3NHNmVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQvbmV3LXBsYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1669363814),
('bJpU3OBBJaaWzRXi3FOZZWJfPeK3icmcY9UGakno', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkcwYmZpQjIzVzlDZUo2UG5aMWhqSHVrUmRqc3ZVMGdDME9KNWF2eCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vb25saW5ldHJhZGVyLnRlc3QiO319', 1669624334),
('cB3PL9UlmKKXafGyOuSTP3gCnqz4E3CgrfaMDs83', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUTJxVnpXSHRjWGUyUHlNMjJWdmhvZGZCZGF1a1M0YzZFd29LVlRSNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vb25saW5ldHJhZGVyLnRlc3QvYWRtaW5sb2dpbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1669499195),
('RNnP9JindZbXj6QWLIlCtMh3gBByq0u8OSg2OTpq', 93, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', 'YToxMjp7czo2OiJfdG9rZW4iO3M6NDA6IlplRVB5V2x0bldwbHExa3VFVjFaTWdUeEhGSjZ4NVVEcHN6aEdqZjMiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkL3N1YnRyYWRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo4OiJnZXRBbm91YyI7czo0OiJ0cnVlIjtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5MztzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJEdnV2syMGw1bnYuWHgwRUZrVVdyOE9oT0ZDZ1A0LlZJSGdad3FrTjhNY1BOdDNpNnJMV0wuIjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRHZ1drMjBsNW52Llh4MEVGa1VXcjhPaE9GQ2dQNC5WSUhnWndxa044TWNQTnQzaTZyTFdMLiI7czozOiJ1cmwiO2E6MDp7fXM6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTY2OTMwMDU2NTt9czo2OiJhbW91bnQiO3M6MzoiMTAwIjtzOjEyOiJwYXltZW50X21vZGUiO3M6NDoiQlVTRCI7czo2OiJpbnRlbnQiO047fQ==', 1669302085),
('sbfhbacnHxGG5gsQitigMgUX1J7IDIo5vX3Z9G06', 93, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6ImdkdTRJYm5ZZE1hajBZN3RjU0p3MkJEdXNCSzdDQ2xDUXgyZmRnWEIiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo4OiJnZXRBbm91YyI7czo0OiJ0cnVlIjtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5MztzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJEdnV2syMGw1bnYuWHgwRUZrVVdyOE9oT0ZDZ1A0LlZJSGdad3FrTjhNY1BOdDNpNnJMV0wuIjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRHZ1drMjBsNW52Llh4MEVGa1VXcjhPaE9GQ2dQNC5WSUhnWndxa044TWNQTnQzaTZyTFdMLiI7czozOiJ1cmwiO2E6MDp7fXM6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTY2OTM2MTQ2Njt9czoxMzoicGF5bWVudG1ldGhvZCI7czo0OiJCVVNEIjt9', 1669365286);

INSERT INTO `settings` (`id`, `site_name`, `description`, `currency`, `s_currency`, `capt_secret`, `capt_sitekey`, `payment_mode`, `location`, `s_s_k`, `s_p_k`, `pp_cs`, `pp_ci`, `keywords`, `site_title`, `site_address`, `logo`, `favicon`, `trade_mode`, `google_translate`, `weekend_trade`, `contact_email`, `timezone`, `mail_server`, `emailfrom`, `emailfromname`, `smtp_host`, `smtp_port`, `smtp_encrypt`, `smtp_user`, `smtp_password`, `google_secret`, `google_id`, `google_redirect`, `referral_commission`, `referral_commission1`, `referral_commission2`, `referral_commission3`, `referral_commission4`, `referral_commission5`, `signup_bonus`, `deposit_bonus`, `tawk_to`, `enable_2fa`, `enable_kyc`, `enable_kyc_registration`, `enable_with`, `enable_verification`, `enable_social_login`, `withdrawal_option`, `deposit_option`, `auto_merchant_option`, `dashboard_option`, `enable_annoc`, `subscription_service`, `captcha`, `return_capital`, `should_cancel_plan`, `commission_type`, `commission_fee`, `monthlyfee`, `quarterlyfee`, `yearlyfee`, `newupdate`, `modules`, `redirect_url`, `website_theme`, `credit_card_provider`, `deduction_option`, `welcome_message`, `install_type`, `merchant_key`, `created_at`, `updated_at`) VALUES
(1, 'Online Trade', 'We are online', '$', 'USD', NULL, NULL, '123567', NULL, 'sk_test_51JP8qpSBWKZBQRLPWqHkFM8oqFEAqXLAaH3S8byZF73X0UycxijVyfebcyu6OVoZ8eeAelr3js3ADYIGU22Dk2Vo00kGkdE9xP', 'pk_test_51JP8qpSBWKZBQRLPUIfQVYfUGly65fb1LiPUwAUajKy1nVM9Rvly3v3hQLvXnRqrWCrnUNz1qPQHNSxE689tSAoL00B1iOTNfd', 'jijdjkdkdk', 'iidjdjdj', 'online trade, forex, cfd,', 'Welcome to Online Trade', 'https://onlinetrader.test', 'photos/6XnjHMDGr02c8SZKHkaNzl6aA4dEtvfvCjkntkgG.png', 'photos/LgdRs2mNck5LrxS9AaN9aIhtaLKfzoxGSswCqiv0.ico', 'on', 'off', 'off', 'support@onlintrade.com', 'Africa/Lagos', 'smtp', 'onlintrade@happ.com', 'Online Trade', 'smtp.mailtrap.io', '2525', 'tls', NULL, NULL, NULL, NULL, 'http://yoursite.com/auth/google/callback', '40', '30', '20', '10', '5', '1', '0', 0, '', 'no', 'yes', 'yes', 'true', 'true', 'no', 'auto', 'auto', 'Binance', 'dark', 'on', 'on', 'false', 0, 1, NULL, NULL, '30', '40', '80', 'Welcome to Online trader version 5 with a lot of Security Features,', '{\"signal\": false, \"cryptoswap\": false, \"investment\": true, \"membership\": false, \"subscription\": false}', NULL, 'green.css', 'Flutterwave', 'AdminApprove', 'Welcome to Online trader, Please buy a plan', 'Main-Domain', NULL, NULL, '2022-11-26 19:04:02');

INSERT INTO `settings_conts` (`id`, `use_crypto_feature`, `fee`, `btc`, `eth`, `ltc`, `link`, `bnb`, `aave`, `usdt`, `bch`, `xlm`, `xrp`, `ada`, `currency_rate`, `minamt`, `use_transfer`, `min_transfer`, `purchase_code`, `transfer_charges`, `bnc_secret_key`, `bnc_api_key`, `flw_secret_hash`, `flw_secret_key`, `flw_public_key`, `local_currency`, `commission_p2p`, `enable_p2p`, `base_currency`, `telegram_bot_api`, `created_at`, `updated_at`) VALUES
(1, 'false', 2, 'enabled', 'enabled', 'enabled', 'enabled', 'enabled', 'enabled', 'enabled', 'enabled', 'enabled', 'enabled', 'enabled', 500, 5, 1, 50, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'NGN', 0, 'false', NULL, '5797628824:AAFZ7AeMeVRivSL0h5wr1tU3u_MmNip3mb8', '2021-10-31 14:32:30', '2022-11-26 19:04:20');

INSERT INTO `terms_privacies` (`id`, `description`, `useterms`, `created_at`, `updated_at`) VALUES
(1, '<p><strong>Our Commitment to You:</strong></p>\r\n\r\n<p>Thank you for showing interest in our service. In order for us to provide you with our service, we are required to collect and process certain personal data about you and your activity.</p>\r\n\r\n<p>By entrusting us with your personal data, we would like to assure you of our commitment to keep such information private and to operate in accordance with all regulatory laws and all EU data protection laws, including General Data Protection Regulation (GDPR) 679/2016 (EU).</p>\r\n\r\n<p>We have taken measurable steps to protect the confidentiality, security and integrity of this data. We encourage you to review the following information carefully.</p>\r\n\r\n<p><strong>Grounds for data collection:</strong></p>\r\n\r\n<p>Processing of your personal information (meaning, any data which may potentially allow your identification with reasonable means; hereinafter &ldquo;Personal Data&rdquo;) is necessary for the performance of our contractual obligations towards you and providing you with our services, to protect our legitimate interests and for compliance with legal and financial regulatory obligations to which we are subject.</p>\r\n\r\n<p>When you use our services, you consent to the collection, storage, use, disclosure and other uses of your Personal Data as described in this Privacy Policy.</p>\r\n\r\n<p><strong>How do we receive data about you?</strong></p>\r\n\r\n<p>We receive your Personal Data from various sources:</p>\r\n\r\n<ol>\r\n	<li>When you voluntarily provide us with your personal details in order to create an account (for example, your name and email address)</li>\r\n	<li>When you use or access our site and services, in connection with your use of our services (for example, your financial transactions)</li>\r\n	<li>&nbsp;</li>\r\n</ol>\r\n\r\n<p><strong>What type of data we collect?</strong></p>\r\n\r\n<p>In order to open an account, and in order to provide you with our services we will need you to collect the following data:</p>\r\n\r\n<p><strong>Personal Data<br />\r\nWe collect the following Personal Data about you:</strong></p>\r\n\r\n<ul>\r\n	<li><em>Registration data</em>&nbsp;&ndash; your name, email address, phone number, occupation, country of residence, and your age (in order to verify you are over 18 years of age and eligible to participate in our service).</li>\r\n	<li><em>Voluntary data</em>&nbsp;&ndash; when you communicate with us (for example when you send us an email or use a &ldquo;contact us&rdquo; form on our site) we collect the personal data you provided us with.</li>\r\n	<li><em>Financial data</em>&nbsp;&ndash; by its nature, your use of our services includes financial transactions, thus requiring us to obtain your financial details, which includes, but not limited to your payment details (such as bank account details and financial transactions performed through our services).</li>\r\n	<li><em>Technical data</em>&nbsp;&ndash; we collect certain technical data that is automatically recorded when you use our services, such as your IP address, MAC address, device approximate location</li>\r\n	<li>Non Personal Data</li>\r\n</ul>\r\n\r\n<p>We record and collect data from or about your device (for example your computer or your mobile device) when you access our services and visit our site. This includes, but not limited to: your login credentials, UDID, Google advertising ID, IDFA, cookie identifiers, and may include other identifiers such your operating system version, browser type, language preferences, time zone, referring domains and the duration of your visits. This will facilitate our ability to improve our service and personalize your experience with us.<br />\r\nIf we combine Personal Data with non-Personal Data about you, the combined data will be treated as Personal Data for as long as it remains combined.</p>\r\n\r\n<p><strong>Tracking Technologies</strong></p>\r\n\r\n<p>When you visit or access our services we use (and authorize 3rd parties to use) pixels, cookies, events and other technologies (&ldquo;Tracking Technologies&ldquo;). Those allow us to automatically collect data about you, your device and your online behavior, in order to enhance your navigation in our services, improve our site&rsquo;s performance, perform analytics and customize your experience on it. In addition, we may merge data we have with data collected through said tracking technologies with data we may obtain from other sources and, as a result, such data may become Personal Data.<br />\r\nCookie Policy page.</p>\r\n\r\n<p><strong>How do we use the data We collect?</strong></p>\r\n\r\n<ul>\r\n	<li>Provision of service &ndash; we will use your Personal Data you provide us for the provision and improvement of our services to you.</li>\r\n	<li>Marketing purposes &ndash; we will use your Personal Data (such as your email address or phone number). For example, by subscribing to our newsletter you will receive tips and announcements straight to your email account. We may also send you promotional material concerning our services or our partners&rsquo; services (which we believe may interest you), including but not limited to, by building an automated profile based on your Personal Data, for marketing purposes. You may choose not to receive our promotional or marketing emails (all or any part thereof) by clicking on the &ldquo;unsubscribe&rdquo; link in the emails that you receive from us. Please note that even if you unsubscribe from our newsletter, we may continue to send you service-related updates and notifications or reply to your queries and feedback you provide us.</li>\r\n	<li>Opt-out of receiving marketing materials &ndash; If you do not want us to use or share your personal data for marketing purposes, you may opt-out in accordance with this &ldquo;Opt-out&rdquo; section. Please note that even if you opt-out, we may still use and share your personal information with third parties for non-marketing purposes (for example to fulfill your requests, communicate with you and respond to your inquiries, etc.). In such cases, the companies with whom we share your personal data are authorized to use your Personal Data only as necessary to provide these non-marketing services.</li>\r\n	<li>Analytics, surveys and research &ndash; we are always trying to improve our services and think of new and exciting features for our users. From time to time, we may conduct surveys or test features, and analyze the information we have to develop, evaluate and improve these features.</li>\r\n	<li>Protecting our interests &ndash; we use your Personal Data when we believe it&rsquo;s necessary in order to take precautions against liabilities, investigate and defend ourselves against any third-party claims or allegations, investigate and protect ourselves from fraud, protect the security or integrity of our services and protect the rights and property of the company, its users and/or partners.</li>\r\n	<li>Enforcing of policies &ndash; we use your Personal Data in order to enforce our policies, including but limited to our Terms &amp; Conditions.</li>\r\n	<li>Compliance with legal and regulatory requirements &ndash; we also use your Personal Data to investigate violations and prevent money laundering and perform due-diligence checks, and as required by law, regulation or other governmental authority, or to comply with a subpoena or similar legal process.</li>\r\n</ul>\r\n\r\n<p><strong>With whom do we share your Personal Data</strong></p>\r\n\r\n<ul>\r\n	<li>Internal concerned parties &ndash; we share your data with companies in our group, as well as our employees limited to those employees or partners who need to know the information in order to provide you with our services.</li>\r\n	<li>Financial providers and payment processors &ndash; we share your financial data about you for purposes of accepting deposits or performing risk analysis.</li>\r\n	<li>Business partners &ndash; we share your data with business partners, such as storage providers and analytics providers who help us provide you with our service.</li>\r\n	<li>Legal and regulatory entities &ndash; we may disclose any data in case we believe, in good faith, that such disclosure is necessary in order to enforce our Terms &amp; Conditions take precautions against liabilities, investigate and defend ourselves against any third party claims or allegations, protect the security or integrity of the site and our servers and protect the rights and property, our users and/or partners. We may also disclose your personal data where requested any other regulatory authority having control or jurisdiction over us, you or our associates or in the territories we have clients or providers, as a broker.</li>\r\n	<li>Merger and acquisitions &ndash; we may share your data if we enter into a business transaction such as a merger, acquisition, reorganization, bankruptcy, or sale of some or all of our assets. Any party that acquires our assets as part of such a transaction may continue to use your data in accordance with the terms of this Privacy Policy.</li>\r\n</ul>\r\n\r\n<p><strong>Transfer of data outside the EEA</strong></p>\r\n\r\n<p>Please note that some data recipients may be located outside the EEA. In such cases, we will transfer your data only to such countries as approved by the European Commission as providing an adequate level of data protection or enter into legal agreements ensuring an adequate level of data protection.</p>\r\n\r\n<p><strong>How we protect your data</strong></p>\r\n\r\n<p>We have implemented administrative, technical, and physical safeguards to help prevent unauthorized access, use, or disclosure of your personal data. Your data is stored on secure servers and isn&rsquo;t publicly available. We limit access of your data only to those employees or partners that need to know the information in order to enable the carrying out of the agreement between us.</p>\r\n\r\n<p>You need to help us prevent unauthorized access to your account by protecting your password appropriately and limiting access to your account (for example, by signing off after you have finished accessing your account). You will be solely responsible for keeping your password confidential and for all use of your password and your account, including any unauthorized use.</p>\r\n\r\n<p>While we seek to protect your data to ensure that it is kept confidential, we cannot absolutely guarantee its security. You should be aware that there is always some risk involved in transmitting data over the internet. While we strive to protect your Personal Data, we cannot ensure or warrant the security and privacy of your personal Data or other content you transmit using the service, and you do so at your own risk.</p>\r\n\r\n<p><strong>Retention</strong></p>\r\n\r\n<p>We will retain your personal data for as long as necessary to provide our services, and as necessary to comply with our legal obligations, resolve disputes, and enforce our policies. Retention periods will be determined taking into account the type of data that is collected and the purpose for which it is collected, bearing in mind the requirements applicable to the situation and the need to destroy outdated, unused data at the earliest reasonable time. Under applicable regulations, we will keep records containing client personal data, trading information, account opening documents, communications and anything else as required by applicable laws and regulations.</p>\r\n\r\n<p><strong>User Rights</strong></p>\r\n\r\n<ol>\r\n	<li>Receive confirmation as to whether or not personal data concerning you is being processed, and access your stored personal data, together with supplementary data.</li>\r\n	<li>Receive a copy of personal data you directly volunteer to us in a structured, commonly used and machine-readable format.</li>\r\n	<li>Request rectification of your personal data that is in our control.</li>\r\n	<li>Request erasure of your personal data.</li>\r\n	<li>Object to the processing of personal data by us.</li>\r\n	<li>Request to restrict processing of your personal data by us.</li>\r\n</ol>\r\n\r\n<p>However, please note that these rights are not absolute, and may be subject to our own legitimate interests and regulatory requirements.</p>\r\n\r\n<p><strong>How to Contact us?</strong></p>\r\n\r\n<p>If you wish to exercise any of the aforementioned rights, or receive more information, please contact our General Data Protection Officer (&ldquo;GDPO&rdquo;) using the details provided below:</p>\r\n\r\n<p>Email: support@onlintrade.com</p>\r\n\r\n<p>Attn. GDPO Compliance Officer</p>\r\n\r\n<p>If you decide to terminate your account, you may do so by emailing us at support@onlintrade.com. If you terminate your account, please be aware that personal information that you have provided us may still be maintained for legal and regulatory reasons (as described above), but it will no longer be accessible via your account.</p>\r\n\r\n<p><strong>Updates to this Policy</strong></p>\r\n\r\n<p>This Privacy Policy is subject to changes from time to time, at our sole discretion. The most current version will always be posted on our website (as reflected in the &ldquo;Last Updated&rdquo; heading). You are advised to check for updates regularly. In the event of material changes, we will provide you with a notice. By continuing to access or use our services after any revisions become effective, you agree to be bound by the updated Privacy Policy.</p>', 'no', '2020-12-14 10:39:57', '2022-07-05 07:23:49');

INSERT INTO `tp__transactions` (`id`, `plan`, `user_plan_id`, `user`, `amount`, `type`, `created_at`, `updated_at`) VALUES
(112, 'Standard', 18, 93, '0.046', 'ROI', '2022-08-09 06:29:04', '2022-08-09 06:29:04'),
(113, 'Standard', 18, 93, '0.046', 'ROI', '2022-08-09 06:52:59', '2022-08-09 06:52:59'),
(115, 'Standard', NULL, 93, '200', 'Investment capital', '2022-08-09 07:22:42', '2022-08-09 07:22:42'),
(116, 'SignUp Bonus', NULL, 93, '5', 'Bonus', '2022-08-16 02:27:32', '2022-08-16 02:27:32'),
(117, 'Deposit Bonus for $ 100 deposited', NULL, 93, '2', 'Bonus', '2022-08-30 02:13:40', '2022-08-30 02:13:40'),
(118, 'Credit', NULL, 151, '40', 'Ref_bonus', '2022-08-30 02:13:40', '2022-08-30 02:13:40'),
(119, 'Deposit Bonus for $ 100 deposited', NULL, 93, '2', 'Bonus', '2022-08-30 04:14:20', '2022-08-30 04:14:20'),
(120, 'Credit', NULL, 151, '40', 'Ref_bonus', '2022-08-30 04:14:20', '2022-08-30 04:14:20'),
(121, 'Deposit Bonus for $ 100 deposited', NULL, 93, '2', 'Bonus', '2022-08-30 04:43:51', '2022-08-30 04:43:51'),
(122, 'Credit', NULL, 151, '40', 'Ref_bonus', '2022-08-30 04:43:51', '2022-08-30 04:43:51'),
(123, 'Credit', NULL, 158, '200', 'balance', '2022-08-30 06:32:05', '2022-08-30 06:32:05'),
(124, 'Credit reversal', NULL, 158, '100', 'balance', '2022-08-30 06:32:27', '2022-08-30 06:32:27'),
(125, 'Subscribed MT4 Trading', NULL, 93, '30', 'MT4 Trading', '2022-08-31 01:19:19', '2022-08-31 01:19:19'),
(126, 'Subscribed MT4 Trading', NULL, 93, '40', 'MT4 Trading', '2022-08-31 05:01:26', '2022-08-31 05:01:26'),
(127, 'Standard', NULL, 93, '200', 'Plan purchase', '2022-09-02 11:22:41', '2022-09-02 11:22:41'),
(128, 'Standard', NULL, 93, '200', 'Investment capital', '2022-09-02 12:44:49', '2022-09-02 12:44:49'),
(129, 'Standard', NULL, 93, '200', 'Plan purchase', '2022-09-02 14:02:31', '2022-09-02 14:02:31'),
(130, 'Subscribed MT4 Trading', NULL, 93, NULL, 'MT4 Trading', '2022-09-19 21:40:02', '2022-09-19 21:40:02'),
(131, 'Subscribed MT4 Trading', NULL, 93, '30', 'MT4 Trading', '2022-09-20 05:26:40', '2022-09-20 05:26:40'),
(132, 'Subscribed MT4 Trading', NULL, 93, '30', 'MT4 Trading', '2022-09-20 20:14:49', '2022-09-20 20:14:49'),
(133, 'Credit', NULL, 156, '200000', 'Profit', '2022-10-28 01:59:52', '2022-10-28 01:59:52'),
(134, 'Credit reversal', NULL, 156, '200000', 'balance', '2022-10-28 02:00:20', '2022-10-28 02:00:20'),
(135, 'Credit reversal', NULL, 156, '200000', 'Profit', '2022-10-28 02:00:34', '2022-10-28 02:00:34'),
(136, 'Credit', NULL, 156, '200000', 'balance', '2022-10-28 02:01:01', '2022-10-28 02:01:01'),
(137, 'Credit', NULL, 156, '200', 'balance', '2022-10-28 02:01:17', '2022-10-28 02:01:17'),
(138, 'Deposit Bonus for $ 100 deposited', NULL, 93, '2', 'Bonus', '2022-10-28 02:05:21', '2022-10-28 02:05:21'),
(139, 'Credit', NULL, 151, '40', 'Ref_bonus', '2022-10-28 02:05:21', '2022-10-28 02:05:21'),
(140, 'Credit', NULL, 158, '100', 'balance', '2022-10-28 20:26:45', '2022-10-28 20:26:45'),
(141, 'Credit', NULL, 93, '100', 'balance', '2022-11-04 02:43:24', '2022-11-04 02:43:24'),
(142, 'Credit', NULL, 93, '100', 'Profit', '2022-11-04 02:43:56', '2022-11-04 02:43:56'),
(143, 'Credit', NULL, 93, '100', 'Ref_Bonus', '2022-11-04 02:44:45', '2022-11-04 02:44:45'),
(144, 'Credit', NULL, 93, '100', 'Bonus', '2022-11-04 02:45:11', '2022-11-04 02:45:11'),
(145, 'Credit', NULL, 93, '100', 'Profit', '2022-11-04 02:46:01', '2022-11-04 02:46:01'),
(146, 'Credit', NULL, 93, '100', 'Profit', '2022-11-04 02:47:18', '2022-11-04 02:47:18'),
(147, 'Debit', NULL, 93, '100', 'Bonus', '2022-11-04 02:47:38', '2022-11-04 02:47:38'),
(148, 'Debit', NULL, 93, '100', 'Ref_Bonus', '2022-11-04 02:47:58', '2022-11-04 02:47:58'),
(149, 'Debit', NULL, 93, '100', 'Profit', '2022-11-04 02:48:22', '2022-11-04 02:48:22'),
(150, 'Debit', NULL, 93, '100', 'balance', '2022-11-04 02:48:38', '2022-11-04 02:48:38'),
(151, 'Credit', NULL, 93, '100', 'Deposit', '2022-11-04 02:48:52', '2022-11-04 02:48:52'),
(152, 'Debit', NULL, 93, '100', 'Deposit', '2022-11-04 02:49:11', '2022-11-04 02:49:11'),
(153, 'Credit', NULL, 93, '100', 'Ref_Bonus', '2022-11-04 21:26:44', '2022-11-04 21:26:44'),
(154, 'Credit', NULL, 156, '100', 'balance', '2022-11-04 21:36:03', '2022-11-04 21:36:03'),
(155, 'Credit', NULL, 158, '100', 'balance', '2022-11-04 21:36:03', '2022-11-04 21:36:03'),
(156, 'Debit', NULL, 93, '100', 'balance', '2022-11-04 21:36:27', '2022-11-04 21:36:27'),
(157, 'Debit', NULL, 156, '100', 'balance', '2022-11-04 21:36:27', '2022-11-04 21:36:27'),
(158, 'Debit', NULL, 158, '100', 'balance', '2022-11-04 21:36:27', '2022-11-04 21:36:27'),
(159, 'Purchase Course', NULL, 93, '2000', 'Education', '2022-11-04 23:23:24', '2022-11-04 23:23:24'),
(160, 'Standard', NULL, 93, '200', 'Plan purchase', '2022-11-10 00:17:43', '2022-11-10 00:17:43'),
(161, 'Deposit Bonus for $ 100 deposited', NULL, 93, '2', 'Bonus', '2022-11-10 00:53:37', '2022-11-10 00:53:37'),
(162, 'Credit', NULL, 151, '40', 'Ref_bonus', '2022-11-10 00:53:37', '2022-11-10 00:53:37'),
(163, 'Credit', NULL, 93, '100', 'balance', '2022-11-10 02:09:20', '2022-11-10 02:09:20'),
(164, 'Credit', NULL, 156, '100', 'balance', '2022-11-10 02:09:20', '2022-11-10 02:09:20'),
(165, 'Credit', NULL, 158, '100', 'balance', '2022-11-10 02:09:20', '2022-11-10 02:09:20'),
(166, 'Deposit Bonus for $ 100 deposited', NULL, 93, '2', 'Bonus', '2022-11-10 21:28:03', '2022-11-10 21:28:03'),
(167, 'Deposit Bonus for $ 100 deposited', NULL, 93, '2', 'Bonus', '2022-11-10 21:36:46', '2022-11-10 21:36:46'),
(168, 'Credit', NULL, 151, '40', 'Ref_bonus', '2022-11-10 21:36:46', '2022-11-10 21:36:46'),
(169, 'Deposit Bonus for $ 100 deposited', NULL, 93, '2', 'Bonus', '2022-11-10 21:40:38', '2022-11-10 21:40:38'),
(170, 'Credit', NULL, 151, '40', 'Ref_bonus', '2022-11-10 21:40:38', '2022-11-10 21:40:38'),
(171, 'Deposit Bonus for $ 100 deposited', NULL, 93, '2', 'Bonus', '2022-11-10 21:40:49', '2022-11-10 21:40:49'),
(172, 'Credit', NULL, 151, '40', 'Ref_bonus', '2022-11-10 21:40:49', '2022-11-10 21:40:49'),
(173, 'Deposit Bonus for $ 100 deposited', NULL, 93, '2', 'Bonus', '2022-11-10 21:42:13', '2022-11-10 21:42:13'),
(174, 'Credit', NULL, 151, '40', 'Ref_bonus', '2022-11-10 21:42:13', '2022-11-10 21:42:13'),
(175, 'Deposit Bonus for $ 100 deposited', NULL, 93, '2', 'Bonus', '2022-11-10 21:47:09', '2022-11-10 21:47:09'),
(176, 'Credit', NULL, 151, '40', 'Ref_bonus', '2022-11-10 21:47:09', '2022-11-10 21:47:09'),
(177, 'Deposit Bonus for $ 100 deposited', NULL, 93, '2', 'Bonus', '2022-11-16 22:20:39', '2022-11-16 22:20:39'),
(178, 'Credit', NULL, 151, '40', 'Ref_bonus', '2022-11-16 22:20:39', '2022-11-16 22:20:39'),
(179, 'Standard', NULL, 93, '200', 'Investment capital for cancelled plan', '2022-11-25 07:47:05', '2022-11-25 07:47:05');

INSERT INTO `user_plans` (`id`, `plan`, `user`, `amount`, `active`, `inv_duration`, `expire_date`, `activated_at`, `last_growth`, `created_at`, `updated_at`, `profit_earned`) VALUES
(21, 10, 93, '200', 'cancelled', '1 Hours', '2022-11-09 19:17:43', '2022-11-09 18:17:43', '2022-11-09 18:40:43', '2022-11-10 00:17:43', '2022-11-25 07:47:05', NULL);

INSERT INTO `users` (`id`, `kyc_id`, `name`, `email`, `username`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `dob`, `cstatus`, `userupdate`, `assign_to`, `address`, `country`, `phone`, `dashboard_style`, `bank_name`, `account_name`, `account_number`, `swift_code`, `acnt_type_active`, `btc_address`, `eth_address`, `ltc_address`, `usdt_address`, `plan`, `user_plan`, `account_bal`, `roi`, `bonus`, `ref_bonus`, `signup_bonus`, `auto_trade`, `bonus_released`, `ref_by`, `ref_link`, `account_verify`, `entered_at`, `activated_at`, `last_growth`, `status`, `trade_mode`, `act_session`, `remember_token`, `current_team_id`, `profile_photo_path`, `withdrawotp`, `sendotpemail`, `sendroiemail`, `sendpromoemail`, `sendinvplanemail`, `created_at`, `updated_at`) VALUES
(93, 7, 'Tester Test', 'test1234@happ.com', 'testtim1', '2022-03-09 14:24:34', '$2y$10$GgWk20l5nv.Xx0EFkUWr8OhOFCgP4.VIHgZwqkN8McPNt3i6rLWL.', NULL, NULL, NULL, 'Customer', NULL, NULL, 'My adddress', 'Nigeria', '9897009', 'light', 'Firstbank', 'Rolly Baker', '5021137787', '4664', NULL, 'bc1qxsu48d0g3wjlrf2qz03qruggxdsnt9fpxrmhrw', '0x542b5f0F013A20e90D5Ae187E426D48B9852Ed9d', '2hshhsiDSKJSKS882i2', 'bc1qxsu48d0g3wjl0x542b5f0F013A20e9', '10', '21', 682, 560.368, 33, 100, 'received', NULL, 0, '151', 'http://127.0.0.1:8000/ref/testtim1', 'Verified', '2022-11-09 18:17:43', NULL, NULL, 'active', 'on', NULL, 'bSfXZyJRmQ95brkSAuVrz5DM7GKBL4l8F539ahm35Mc0lhuHnpIVvA3sIU8c', NULL, NULL, 'vK3hb', 'No', 'No', 'Yes', 'Yes', '2022-03-09 00:16:22', '2022-11-25 07:47:05'),
(156, NULL, 'Test Account 2', 'test123@happ.com', 'test123', '2022-07-05 10:27:23', '$2y$10$ajsgyZLxF2HS3t6N5Tdl4OGQdVg.9YUoHKdwtT7RevvCTxxLCGiJa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'light', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', '13', 305, 0, 5, NULL, 'received', NULL, 0, NULL, 'https://onlinetrader.test/ref/test123', '', '2022-07-05 02:36:34', NULL, NULL, 'active', 'on', NULL, 'Fo1a5EtgwAR93WuqizmrxHeGRcXR7LEmsyl9Jb73enYU2aSF1oUGkmkKLUq6', NULL, NULL, NULL, 'Yes', 'Yes', 'Yes', 'Yes', '2022-06-28 06:47:09', '2022-11-10 02:09:20'),
(158, NULL, 'Tester', 'mil@test.com', 'Hello', '2022-11-10 02:10:01', '$2y$10$R374tEo6zEfymKd.wV5nBec5Hka9C.acTUqrf4.AppID3X9ZnJGr2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'USA', '4567765', 'light', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 305, NULL, 5, 0, 'received', NULL, 0, NULL, 'https://onlinetrader.test/ref/Hello', NULL, NULL, NULL, NULL, 'active', 'on', NULL, NULL, NULL, NULL, NULL, 'Yes', 'Yes', 'Yes', 'Yes', '2022-08-16 02:22:43', '2022-11-10 02:10:01');

INSERT INTO `wdmethods` (`id`, `name`, `minimum`, `maximum`, `charges_amount`, `charges_type`, `duration`, `img_url`, `bankname`, `account_name`, `account_number`, `swift_code`, `wallet_address`, `barcode`, `network`, `methodtype`, `type`, `status`, `defaultpay`, `created_at`, `updated_at`) VALUES
(1, 'Bitcoin', '10', '10000', '0', 'percentage', 'Instant', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAN4AAADjCAMAAADdXVr2AAAAwFBMVEX+rwD////+/v7t7e3s7Oz+rgD6+vr39/f09PTx8fH+rAD7+/vs7e/s7/P+yWru6d3++e37tyn4w2P1zYH49vH4v1T8sgD8sw/+1Yv+/PX9xFv6uzjs6uL+7sz++Oru6Nj+0n/v4L72yXLx3bX+2ZT+5rbv5tDu4sX5vkb+9N3y2q/+78300Yv25cD+36X+yGD005j+5LHy1qL3yGz+3qD+wlH+vDX+zGjz1Zv6vEv48Nzz2Kj9uSP6uz/+4LT8z3aW1ss+AAAfEUlEQVR4nNVdCVsaPdeehbBkkiou4AgCgoKoVK2CrcX2//+rL8ss2ScD2Pf5cnlpTGbJPUnOlpOTICIp7MQktUOab5BcgxW2aWGHFoassEmyYassVOsTpZ4+tNGihU1aH7NCoT421bOW0MIo4S2RS0NeWr5faHQiN4o9ICjgNTR4DQUea15ZWFXPm08f1SzbZK8v4fGWJEVLhC8VCfDURidyo/4NvJCkBNNEc2GzzGKE/j/DQwhh3ExHy6s/P55PTy4vL9e/Pj8/f63Pz98nNy9/ZvPxkIxoivnr4LEP2WmQ1Ka5iObIiCepTXMdVs8KmzTXork4NNUnRT0vHI5nj9Onz24PwCIBCIr/QK8/WP+9uB0dky5FjYbSkqRsCS9tlaVejaalQYemVpOkFs21E5JL2nJhhxY2WWGb5podaz0pTJKkM55dnHR7DARNQRDQX/RvwP7QH5rYFdvzycvyLMFtuSU0l7DHd5qmUuX9QqN5++ilQVwSRdKZjYzoNSSi1igL6WAI+WAw1SPyiUcvk89eBoyjAhwLywQ8U/7DQQab15+LGKFEaUkcF0S5XZY25EbHSqP5CKaXZvCUaVOO9aZ9rKtEsRMjPFzd3AV5n4EcV/5HyGj/0Js20/sRH+ESfdKmVVg0Omop07acoPFB4RFKeHR90iXYAB99oPwt9h4A+eBk1UFWyv4h9/Yvb0dhCx0OnolqxMVUbtqnslyfXk02oOw2Swoq6mkvbr/djxHK6ENcUq0qUqfSH3pp0KapxVKZNRa2HIUfN4MCWpBPLd5vWe/lHRiURaC8Ich6mhUThNOF+Ca/9qmFNH8IxpDeXgZV3VYzQXj3/YhyixqMQe1ixhj2ZOvtMP3epfPt0AnC/ukco/+p1ILw/Gb7BdhYAjB4vQ5NVKM2vIYFnpHP5PAQGk/7XwUuA/j0QABa4DUs8BoKvIgy/LjNymKaTVghzbLCiBVyQkyzHVbYOjr9UnAZwG/LKKLvjDkjYk0pGt0xNpq3j5YGirioMgbrVMbDxy8HxxIEr3MvUmdkDLuxdYR+fNmc0wH2btLwX0ot+Hrwz8AFdIj2X8J/Bi8cvQbw34HjAO8eFFHND94Oc+/WOS5B8Sv/FwBJ48szIFCf4noqDB6HuP7cq0s58fi1AFc1PjkuAPrdu/Pp49vLy2q1mv3+8fw4eV9vtgGvrHxIAfDuKpQoZ2xodEuhnDX5XvO377hkWlz3283tw4dgYGmhIjtezH5OuWbo90QIL8Jd+J631BKm7462AKEhRHl7/XkdoyZXK4o2abaYcPkyGfTYWFUeYvpigw/8ZUJZGF5tq7uODEjQ/fZ9mXYw0umT0ZJ2dnQ/HQRCL1oxwt5zjL7GlJREb6ASHbmiO70+tiqNgqlJrMd4uLi568HqmQhfCYXx1xi89anmsWtgZu+G28nVWdNPH9Oz88dNUDkR4Wbe9Nf3vLX10abizWRQns9aFUNAtfGJ9UQBwcsJmYcBEMan/FLyHwxWOD6wUBauKigmhN1nooAqFlhtAhvrxQkURrdr6H4VgKfUwH1AqSV8c3YdGZXrF0ZK9oZHjVKrE/cYBfAkRnXgue2cKLxxyikQrK9SwQ6qNL+hwHPVZ8tM86kbIFwPkZedU7VSN0WDMy9sn7263gXB3aqZiDc1S9Oy0bTtqM/s0W08f3fOBrgZl6Zr2UqeFzIrtQdjSNciOgUogNtViGTBVSf8VYzBpFQuzp0fdbvAbm7mZ0oK0zv7ZyRs7i0Kv2Z9D+FZF+pyd4Gvv8AHkFpGn/aPSJjsKLSZmvaF14jx8NExBUHvGu8Lrz0aWPuOiICztt2Stj+8OMbLJzuXAMEM7yeUoSP7yIS90yF2rO/FRGbORWp57iGWJbXVlv4wfLHLuSBYVM09pWWK1EKoihXd4MHZMpQuH5bLxWJxPVelluU1KV4sHx7SyjXQuIGPnoQBqsgw/SXaXWoxosvWDeD0zGqLocMCLbbFguzdcTFBCTwymVkp+b1dGti6OoIRfrbyCNif492llifLYwnB/IHspib6eDzIxH8qJV6I8Caltg8vjd4b6voevrLKu7A7RrvCm1joMoCfc2xYvpR6ry9ot98EeNFl+c1A9wx5wGtEqVWwgAOiAFaYkowaQ9MmZwIwHVZTBRmeMPdkeJVzL6Ma33s2fJcxss+9ZrHqrohG0YtFtwTgR5RI8pS6lE/9D5I+KIxm8ATnkhOpP5fgJe71/2bePnzdtcwUOElU/4Ikf0AgW2UyrwDyN3ywyAuU24R2aTgrDMO89zg8ge/J8Aq5XfVPkJyu6GT+sHFg+B0X7xca5WLr4bGF3VBZyMdtJxQHpxuer1fS8Z15ttAPXk9qCdNLC7otocS+8ITBKcITuFgteNZGge4c1ZNaLizoKMn080qSe6+UWlR4Nvpk8koiBNTcrDui3qqmJPqAwGiFad6ahwFcjxQHArtpqF8yFXjSEurlwVnT3jSx4Ju0jHeZTUnjvhndr6HV8UMdArEIb1/GUHQM6tiG1aqGUGaWNOFgiJxeSdK0OSRbF6eVuf9Ab+QrtYQ3ZnRE/nE7XanwCtJySHiR2dwKnzxMSbQsXKqLWPx+SjMleDaWJcNTey/U4EnM0w2PjjiLFgN/YgO8ju4V8Gm6HfQIv8sXnJSlfL7g1JFX0aTeK+rJTTK8Yv3f7J/A5JFsbauTlaZG/g76c5Q3qpNfqjMG/Gi8GcxUpXBHxtDwZAyCjqpQDTQ2ymfwKaw2JaG5eWj/xvWcjR1Sy85sPSpMFEbKDqUFeIvUYhzZ8BTX9KX2EcrAjvAa4ZWpD0B/VAnvpxHd2sA9/rnMKcAzE3dCwiqEsuOt6bNs50g3yFTPvVJqOejcY5caBxm4ailzT6ac+FS+i7cErOjnUJfqVSeojlSvsXVOGdsq5UT5TdWUUyxFRyb1Ft6dleScUU6J76GxScmDpwpfq8X3VLYu8D2wC9/LSvHMNP3grUtqwaYuJ+K4Mi3+p0JZXqoOtOyBaWiFhxamO/pjZIUXNqmtNrN1ULstnzYkQ+ABofdCZrZFdCOA0HuQwGM37QCv0TRpf/BGgSdoDNhg+APwh2Wpnpl5R0c0HdN0JGWHfeGdT2lePzo+Fntv+0ELh6mvxiCRsqVhJoHusaQxCEpS88r0Oc4dWths0LWmQPC/6isVRWMCVrL5vJx8/zhrNn38C8psyyRfwZuWqO9Rq0/eMYbeBsEyNPhw0ZvaaO7yEJcfU1FB7daDi2XNPURx19B9ZC4xUxbX1gW2ubKNZYsvNb632cZFD6MqZ5H8WgrxboWRF1vnhfja1OJTbJJa4pZh5sFB6oD3+wDwpGshXBdrkj4b3PCJYbz1h6LUkrMstNBdSAI4E4SuXClsVMLbPcFgwk0Cmp1T9ArIC9HYwNzhMy7tnMUCPn43dN4lN/garNDkJr/eq0rKtQB+jlUrteYVUDbaQF0y0ze3UhdUY6l/CEJXHLs+WuHtl/jkwv4KN7Q1Bour+NnA0H0vWDMlmSybcBK6doAZ4YnzTZ97Jnldu5Zbnf12gDUN5I2IWbrUommIhKaN6sM7RALBPfaE12roq+MALJACz9RU0nnO/Xs79J4Ri34tM+z4wSOitd7wKc7h5UKPztKp8uvaceXovT1IS/7uIfKae4SSG7pve4Syucdbjub6Yh58xRZ1NVdnj/oW/1L73DOIGSZ4AXwPyw/r3uCmf2RArS6iKYkQWG3qBXQEO3eAocXTNjB5eu9HWji+F1zN1vlk0Q0M8C6Ud4DprkfwMo4r4BENqDNa3WxEz5q9KKdY3Kc+AT7wwje9+4ikLMBrz6VRRrMALnAlPOZzFqarX4qXdyFHau3WwdquhVNfeKluFoTfQ8GUZDCxwLW6eOOKOvCj78EjMgBeBIdSz7nv5lJ9VQV+ilEHzj613SDwWfGXzPwLTEJaJ0mWG/EV+zIG3oK/kSHqQKK7KrQXhqfO2aWM76GrQNPDgqNaUQfMFsSy3RX6oPFGypgyvhdGuquCsO6jm4jgIy7YOr7QCDx8dXgdGbflX7n6qacntgvfiY9MIL9t+fhFh3dXSi3xp7ZVCd7jukEV+Pw1UU74LUzTdEjTWZrm2eXqYuPcXAMHnvDQSJcog3FuSkLzvjpaQG9YM+pAuWItkWCupfLFZ+rhmO1zoFlGc0tfjtKoXSrwS9+oA0yZExEA+JtuxKK7UFq/oQwPkLFpXop3mnZMhkfeDd+alpuarRvHmIYvzbbxVZqrg2F0TmktYwzvUOu92x3C0SyLT6gOTmmNQVLlmuFVHwSBmcoSAuAZdUA3yYNumgll4VaFB/ppWLECpK8QJanBcMWbKa0QqTvAVlYqCjbYRyijW5U1owsZ2YhJLWwtXfRsJGNzHVYtcBnghfQdedSLIvwFcMOLIrbDpbgpyCOcsF9DT3j4GXKRobwbvmEO7xaqjIhI3B5RB5T6JPwGM9FElE8q4FGTJF3MLyIOlR+Z3Dh3wROWdGSNh9OzvxxeNJG3XFG6uYzEXf3i2hRfWkqSsj4p6gvaohB77vBILyzX/5PclYCUrmyjE87ohfzSjrzglgjvT+JOrNlcwOeQmZLigcr14GfVVDYxhg6ywpO8knTPdSITWuDd4kp1NiN1mqmI9BE1JaFhoEpJTJmvHyuJwbOwdWEBTN8Bhvn40Xk7V/p8ggmFt7rWsAoJW0fXWUwqoeLn7vCkbit7zwmvbTL/sxu/e8Nb6jffUHj4J9T0FKZJ7gFPTB69186XsnbvvSjcaDc/EXgN0ihlcMLN0e5zL+cxWYgr1uiqudce9cq1TvHLwJX33AsFVzP+biqyBlGy1uCdFFEHXKv6Wj2b3kWcroIxAE45uX8BvT8WnLT4EBhn8IRQdOwZcBHxS2NTvBbJVYFxvvLdlPn1xygI0y1QtD14WoybRgVbl/mexdeygu8RpVFdvSlu9OV71JVAf8Y1gccGhtx7v8tpUUtqubBRTqfUQto8s1FOX6mFKEXzvnIzgDMC7wEq8AD/ZjvCq9t7DN7U5gLuK3OS7FCTeInGHlCRLJCGJ9H1dgxgeVEqtKV85dYYeFCFQdnd2fRjP3DqqzGQpDqt0Ntx0HrTem+wW9SAtlXhs+t7LNu6B4E+MIMa+h5THbUhANfNgNsApal3uUuMwNDN90J71AEUD2zigLe2TpO2kgk3RChjWozYe3CyYwDLHYUyvsJqYntbT1sL95rSVvpAj0gt51CROeHboeAJvWeFF4v+FYo5660WvIVuTkqDxq9M2yvhvewYXdVXKJOiDkj8SjaI+No5s6gDc9UgAYJRMBwAtfdutdi4yvq9ZqXm9dioEDF4kSXqQHL2mEtuGjz4HmUvVWPjaq4M7FEfijWQQFoGx1vVbAyv0V6MQeq4nDFwwx+9HyHEb0IYD3/bN8UDcF0vgOVIY3zgOjjuafDm6NBSy+VwPB6PWBqP8+ziftJVzLiSaPjkuUKU0YI41RR2OCPDE6iUc7wPvLKtZuOe0DvcCK9o9kV1b14PXkMP/gDvOTz56cPdoorbey8Ql1CEKMcaLlGlfvNenc03HWruARyePDgBhWeeW95zz9IjxmS79hgVvN8zqrgJ3hgolBMEXgEs7eqsqfccyCzXgvWoEEz9YvViHd6fYKwKRKAX7s3WTbCAnrVdy/6F3YewVlxqwT0QCPDUwXkAeNbeU1YynNdCasnbDV7+hLz3xE97oN7LH5tbJHRC4vgnwzeqC0+R6v5Uzb3aGsNec0/Ft03RnnPPQDnPOkIoAsNSvXiqgVDfTC7U3quAV5nga1OIRVB6LRhdGXTH/4zvAXlSDM0xtjRvXLspycLLKlFrhdQ/JZfmDd64XnxPllrAgaUWlmEJgvwoAygGx3d9BdD7CPeSWojMqWoMe8mcGjz6qz+wpn4gyGYG8vLuCy9OtYUYInMyjSE4nMZgmnvwJB4Oh8wn4ow5RZTuEWfp8WrSdYSzClaeUgsyagxnA80YcdvycxVQC5uazAlyeNjhf9BsHt9knpMGlPDOuTdFKFT1PfK4OdXWA9lKTbT1A5mS8oe6TUm0cGkNqEU9h/1MSbq2DkYB3+v5NbaWQt+rWiEKadBdc+9Ra+UetpaY8frDWcrEbvOHF/HN9iZ41IPIC562q4JayqiBRFliuCzhmXdX1jIlBZXwGPMMdcep/O4ZUndfynw4g2e0c+Jn3UpdrOon+YJTkhRL9SSXKPUdXo81mbPoPXpptv6fJEWYbPGhiXnPdcD8VtmlhddC5nXQlAtDg5U6CjJPa8EQaFtj8FVnBdk59ymrWGPg9CnNgznIq3yAdEL9NQbm2TLF/4kVomzfuu32IN1jhej4f7++l8FbWrg7vNpjfS/dQmk4SKuz/7T3ji3EJQvUVQFvprqm0Z0KAd2/r/beyR5zT/QpA6VPmcfcC8vJF/DPnc1ieIGr5x56hsqtNMJJQAMNKPDAZogql+oNUQc0z4hcW5ejDminIuT+B/G5GoOXP4qPJs3roCkVSp4R/KsMIqNfC7D4tfjzPUXJ8eF7pJ7Jh6bBOVUvjXW+Z/FrKbySxIoDeSV5wsujDui0L7v9ZA+vpP+AT1kWCMcY5cIXnsWnLPMIlI1ln+qsr6kxKK+q0hiyFSPbPnEyOKs1BotHING3TP6c8lp/pddAqe9piVHOlvWmMptMbXzv1Kh6yvcb/DnPeNQBozeu+2tFDsYQFBQzf2bGGCInY0DmAEj09ptKxqDsP6Tvhn8xcxXXfKmDXX2pJzljyDSs3E/Mi63jV6geAppxMXhbydapYpB90Px37kudecJLHbuTJzzzpTZ+fg94+IfVZAiXu3vCh5wjqqzhNqxv50zP/WTOnHkVxksCDy9ssW/pt660c5r3MfCoA8kfHd5r4jhGt208ZrdpkxmV2Limh+KZ7V6qXjtcGfij8A99FwqLmEt3Ph9oDxG+hkLXiRJSFWPA6VsgruRI+h7Ra6oNk7qlJttDRGfAYXaA6etrAlsPy2BCPNhQFoGojTFi/hH2rShgjvbYARbz/Xtq39bdv2dwmykftn64unq4pmlFcldXLEtzD6vfP1/7zqNdwADtuX/PvvvSHXVArhejxwl/rHMquwZC92XwudIQ6Np9yc0c2uCAz023bUOde5nIYqKcJejSISLIjccVn4LGH6hY30PGvbOojDrAdD4Fnrbz2aXOosapbMg5WIIXYeUagy4MFjufudw+1+AFvvvWSS6MF+aQffujA9tj68Gs2WRx7luPOIfcLeoA25YfLV/OlQMTrIPTBMB4bdGKt7BqAaw66sCOMSOoqna7pmEjjA0/QILrNKqC54wZkalqHhE/TOt76Np41IyirTuT6yIeJa12xI+gjPjBRaMkMcZrSZxRB0g2+quJsio8mXJa4WmDk+sKpT9nokUdSHjhWvX3oPFaskvzAJaWaDuVSyj2o2AOkAjVZEKVyxvXGm2nURErKaiKlUTKjvUF3+KXH1t3DGQaqjiD52DrhoVPPVbSLpGuItOZFHXgmQZkmYd/w2p4lZGucqqxQ5yy0GCf0pq5YwLwIgqdASy94pSVuzhMUeae3FEHDMYjrTN2gwqDl2bxJnvUg6YhwjHonhV3lZGNTZIbjRHoYgxIj5qoDc6qBJS/LA8/lxWRjVmhNUZgPsb2ifBIsrY4A3slAPvfQ2Gzwz4RHoXb68bnbKAjHd1elJPxOth/K+L3Hig+J2dpluiqjqgDA3N4VSjpOoEcbEd+PoDlLfTIsP7JTATigocc0VULeIJXwANU7CT0Y1xGfO2qoyzV05vQ/NwVG7d8paUiCITyzefd35vFsIMF/4JOUrgKdHRXBWNsXKLH8vrclFSocvjc0H3OyMZh0x7ZWAi7bYlsDODmo7xpOGxgbD0kyxRAxUBX1MjGsTCt6seljqxxqYsjzjRTkhJ2O7/JK6p4/bjUItUwdd8eUcXzj/sfiSpujjVbxITfDR6wwwN7wPOMCS+bUcyfBK7sc88qtB3yHCJ97lkj+pe8n809RnnLBXzLeQyE2CpL9Y6oBLxePsGNdG3E67PjJkAGjw0BwSmgiC+QlE4JpqgDJk0MgCuhffQBEt+jefNpGucWqcV+1oDjiLPSYC4eUCcc3LznaRoNo9Ry2LNQIje8YnAWtuB/cxaKyeoSBAc9yWZveDVOstGoAg+doX2ZYIdziITeaxReSfscUFf/HCLdFaBpO0XKtP5vdwWQTtMQPRFkylnhn6Dqe7R9ZxtjA/sf8pVM38u0dTZuso4xHeMQsDPAGvnGbv41GVVgH55ThUZZL/A9YGMMoGQM1NSdDYG8JZn9uyzNO8Z+BljeqJwxeJ7gxtEe/gS33dj6uy74M7nW/1hdLXgGx1f3/L0qeP/s/L1clcv4mOv0xMgadSBnWbzedpKNIrXEsf101xJebud0n54YS/4FDJ5pA3+zfa96weT4joyxcQ1RCdpS7yXCTfLgtPsnlA8tog60OxPzdgc4SbRTDegDvvTkUiNj8D0ky3hyqcVzhlo2zeeta1ILY6b2c2e7Nc6dLW46EFt3HIZrO3fWDE8+NVgyTtQ4NVjYImWUOWseUFecGqyumNQ+NTiyRyqG4pnPu8HLdYla8OiZz2b7aX7mswmeZe6R5Dix23PuCYNzX6Esdp3YHRqVQjb3lJb9h89bt6FznrduZOvZVJ6Yxzpl8ISAep7gdgi2HqWvtg2a8DNGsdhoD6klv9Jgls8eGvxweC3Rx+MuLKIawguRrU/KUNTwqR17wMNXGyu6LvXa3w2eTXplLZueOeGhxRayBCC8OxbhjTYwT9ul6AlvgYfwc5CvL6ujiZ3164LX4BqDYe6xA+jsi8tw8OCceyh9uHp4WF1fXy+EucXqHzKfsoe0ij6RluCjJ3vAof4SFY02zj3zBv68EB/dWTZFEny9iyGWog7I6/tU5cKthCTB/yCrp4lUl+v/kn+CGF8gedna0QWLltJowd+UnSKlGHAKvpeZivDIeAJxNkAHs7ZDGi5EXGEE2+sVU1KYmR3sXcfYuTiuc7k7e76TrRcccmQIRlXShtdRMa3UCRybtCbXDjBtAuPho9FtJh8917ihTltfqaV0qtKDFUjveIvCr4GH8MyxX59Jh3ElPLvUUsx6B32hHbhdhSi2cWSV91fVCy1ZnDvAEZq5wHKjVf8CdnpixS4TljmzMlX2InC3areqd5l41RdOCR/vgeOjBnDzYY+K0Cqy0smlOmPINoiEN85zPWBweZVWDIHqPUQiY5hPneACuB4itdG1hbJy2oQ2+TN/HVy/dDCy7PAS1ArXBrdsAoXh6iTQ/MTEBOBJjLRt+fWFspIqhCv35yQAu89HGO0NL4xu1xUOlACeIqRHHfAwJanwSpZFZSnnS8lbwfmMDg7b7kobvKIeYbyc9Kq8Q2GwwnKjHfCybaj6rv5sqb4sHDoJDAcIt5OrlEcl6CSJHFWgeGhiqo8i3Jk/bko+Z3sX/FyGHZMrg9poWurDGIpZ/wYq3RvJFZvp9XFdxoDxcHFz16v6fkyQGCLH0ex+piTTtCGU6mpbjY8O0u7792XKSI2qNRnOQgnDs6P76cB40p3Wdb1not6ZPRR3k1pKeCSTvlcOUPaJyfzZvP68jjn1NsNDiMy1Zrh8mQx6sAJbpgjBwQc2KGCHgkdIzX0FBS1bRDF2v93cPnw0MU18cKIiO17MnqeflcjKBIla7Ih0tatQJnFcdHTiMUPyP8yPCvS7d+fTx7eXlz+r1ez3j+fHyft6Qx3oIdT3T9g/192DO4Clae4xZ8Bs1Z8Cp7mIewgyaZfm8qgDlEWRzK1dA1PhBQHfMAq1BIDhWkeCweMQ5+2LfRpNS33ZuqSKjU58R6gR9Q4Jkq5rodgRdWA/qUUe6/h6YOtAt8NjnQCWwnWwLy2bm2MlHQ5eA6EfrhHq0eQa18LeTRqqXkme8BoeGoNpKhNN2s6FPeeT10UQnMy9ot4ZNYbdVbPW0WnfYqc4XO/B4NtHs1mjUXI2NyU1JK+AiFtlGo0i1khD9i9gLAbh8dQAMDhY7xEJ7+lB6JgoKhiDodGJ0uikplCmTFB6rC6e37h3vu5BLgm41+vQNK2+TmrRNriF6feuKHfUHpyWrwBh/3SOWSjNfeApLC1fnTWoapaoA2GY3l6WW/h2ZgxAuJYa7r8fUZE8KttXFV3VaOc0nkWg7uq3r+rzswI645uBt+hY2Y9Ea5w+5KZvpX3mqAOSf0FeyKzUuzIGtT69mmwABDtTzhJb/9v9GKFqV/EDmpJMY105VjfER9cn3b02mpLP07+8HYUtFIsM3DMu9QGlFh0erUd4uLq5CwoVp0bvcRVxej/iXfJfgGeop478o5cJ1+KUrShmZIDvPqHa7yLGqI6jvxc89zCuEwpKqB/PTi83uUIHFEB5LttWA/rnk5dlGlJC6e0q7jv36qqz5eOqVh6H49nj9PKz2wOilgdK5a/XH6z/XtyOjok2j1w6qud5DEqj6pqSTGzdUc9sKa10tLz68+P59OTy8nL96/Pz89f6/Px9cvNyO5uPh/yb1Pel/ldSi6M+jnNLWFLaWgSzC6amZuf63v8DeAp5rbV8eUh4sQYvVprPhLKyUK1PlHpG9LTF51iBV9SX8GLlqKl8d6gqlCmNTuRGMXj/B407U9Wu6d3rAAAAAElFTkSuQmCC', NULL, NULL, NULL, NULL, 'ksjhhjhdjd', '938893993', 'Erc', 'crypto', 'both', 'enabled', 'yes', '2021-03-11 12:53:32', '2021-10-11 10:16:24'),
(2, 'Ethereum', '10', '2100', '0', 'percentage', 'Instant', 'https://lulo.com', NULL, NULL, NULL, NULL, 'dddddddddddddddddddddddd', '938893993', 'Erc', 'crypto', 'both', 'enabled', 'yes', '2021-03-22 11:36:03', '2021-10-14 10:27:15'),
(3, 'Litecoin', '100', '10000', '0', '0', 'Instant', 'https://lulo.com', NULL, NULL, NULL, NULL, 'hhhhhhhhhhhhhhhhhhhhhhh', 'hhhhhhhhhhh', 'Erc', 'crypto', 'both', 'enabled', 'yes', '2021-03-22 11:36:33', '2021-10-11 10:15:46'),
(10, 'Paypal', '10', '10000', '0', 'percentage', 'Instant Payment', 'https://lulo.com', 'Automatic', 'Automatic', '99388383', NULL, NULL, NULL, NULL, 'currency', 'deposit', 'enabled', 'yes', '2021-10-07 09:56:14', '2021-10-11 09:57:12'),
(12, 'Bank Transfer', '10', '10000', '0', 'percentage', 'Instant Payment', NULL, 'Mining Bank', 'Miller lauren', '99388383', '3222ASD', NULL, NULL, NULL, 'currency', 'both', 'enabled', 'yes', '2021-10-11 12:35:35', '2022-01-07 14:44:10'),
(21, 'USDT', '0', '100', '0', 'percentage', 'Instant Payment', NULL, NULL, NULL, NULL, NULL, 'enter your correct wallet address here', NULL, 'TRC20', 'crypto', 'both', 'enabled', 'yes', '2021-04-14 10:45:06', '2022-06-24 06:29:55'),
(23, 'BUSD', '0', '1000', '0', 'percentage', NULL, NULL, NULL, NULL, NULL, NULL, 'Enter your correct wallet address here', NULL, 'ERC20', 'crypto', 'both', 'enabled', 'yes', '2022-06-28 00:25:41', '2022-06-28 00:25:41'),
(24, 'Credit Card', '0', '0', '0', 'percentage', 'Instant Payment', NULL, '-', '-', '0', NULL, NULL, NULL, NULL, 'currency', 'deposit', 'enabled', 'yes', '2022-07-20 13:02:29', '2022-07-20 13:02:29');

INSERT INTO `withdrawals` (`id`, `txn_id`, `user`, `amount`, `columns`, `to_deduct`, `status`, `payment_mode`, `paydetails`, `created_at`, `updated_at`) VALUES
(25, NULL, 93, '100', NULL, '100', 'Processed', 'Litecoin', NULL, '2022-05-24 07:56:03', '2022-05-24 07:57:09'),
(29, NULL, 93, '97', NULL, '97', 'Processed', 'USDT', NULL, '2022-07-20 02:31:11', '2022-07-20 02:32:12'),
(31, NULL, 93, '100', NULL, '100', 'Processed', 'Litecoin', NULL, '2022-07-20 13:41:54', '2022-07-20 13:55:19'),
(35, NULL, 93, '100', NULL, '100', 'Processed', 'USDT', NULL, '2022-11-10 00:51:22', '2022-11-10 22:14:00');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;