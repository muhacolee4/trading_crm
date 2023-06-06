
CREATE TABLE `autologin_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` int(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `bnc_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `deposit_id` bigint unsigned NOT NULL,
  `prepay_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `kycs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `first_name` bigint unsigned NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_media` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frontimg` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `backimg` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



ALTER TABLE mt4_details
    ADD reminded_at datetime DEFAULT NULL AFTER end_date;

  ALTER TABLE settings
    ADD enable_kyc_registration varchar(191) DEFAULT NULL AFTER enable_kyc,
    ADD should_cancel_plan tinyint(1) DEFAULT '1' AFTER return_capital,
    ADD auto_merchant_option varchar(191) DEFAULT 'Coinpayment' AFTER deposit_option,
    ADD deposit_bonus int(20) DEFAULT NULL AFTER signup_bonus,
    ADD welcome_message text DEFAULT NULL AFTER newupdate,
    ADD website_theme varchar(191) DEFAULT 'purpose.css' AFTER newupdate,
    ADD deduction_option varchar(191) DEFAULT 'userRequest' AFTER website_theme,
    ADD modules JSON DEFAULT NULL AFTER newupdate,
    ADD redirect_url varchar(191) DEFAULT NULL AFTER newupdate,
    ADD merchant_key varchar(191) DEFAULT NULL AFTER newupdate,
    ADD credit_card_provider varchar(191) DEFAULT 'Paystack' AFTER website_theme;

  ALTER TABLE settings_conts
    ADD flw_public_key varchar(191) DEFAULT NULL AFTER transfer_charges,
    ADD flw_secret_key varchar(191) DEFAULT NULL AFTER transfer_charges,
    ADD flw_secret_hash varchar(191) DEFAULT NULL AFTER transfer_charges,
    ADD bnc_api_key varchar(191) DEFAULT NULL AFTER transfer_charges,
    ADD bnc_secret_key varchar(191) DEFAULT NULL AFTER transfer_charges,
    ADD purchase_code varchar(191) DEFAULT 'xxxxxx' AFTER min_transfer,
    ADD telegram_bot_api varchar(191) DEFAULT NULL AFTER base_currency;

  ALTER TABLE users
    ADD kyc_id bigint DEFAULT NULL AFTER id;

DELETE FROM wdmethods WHERE name='Paystack';
DELETE FROM wdmethods WHERE name='Stripe';

INSERT INTO `wdmethods` (`name`, `defaultpay`, `status`, `type`, `methodtype`, `network`, `created_at`, `updated_at`) VALUES
('Credit Card', 'yes', 'enabled', 'deposit', 'currency', '-', '2021-04-14 02:45:06', '2021-11-22 00:00:52'),
('USDT', 'yes', 'enabled', 'both', 'crypto', 'TRC20', '2021-04-14 02:45:06', '2021-11-22 00:00:52'),
('BUSD', 'yes', 'enabled', 'deposit', 'crypto', 'ERC20', '2021-04-14 02:45:06', '2021-11-22 00:00:52');
