INSERT INTO `settings` (`id`, `type`, `value`, `created_at`, `updated_at`, `deleted_at`) 
VALUES 
(NULL, 'verification_form', '[]', current_timestamp(), current_timestamp(), NULL), 
(NULL, 'validation_time', NULL, current_timestamp(), current_timestamp(), NULL);

ALTER TABLE `users` ADD `referred_by` INT NULL AFTER `id`;

-- Affiliate Options
CREATE TABLE `affiliate_options` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `details` longtext COLLATE utf32_unicode_ci DEFAULT NULL,
  `percentage` double NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

INSERT INTO `affiliate_options` (`id`, `type`, `details`, `percentage`, `status`, `created_at`, `updated_at`) VALUES
(2, 'user_registration_first_purchase', NULL, 10, 1, '2020-03-03 05:08:37', '2022-09-19 11:58:12'),
(3, 'product_sharing', NULL, 0, 1, '2020-03-08 01:55:03', '2022-09-19 12:37:01'),
(4, 'category_wise_affiliate', NULL, 0, 0, '2020-03-08 01:55:03', '2022-09-21 06:33:20');

ALTER TABLE `affiliate_options`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `affiliate_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

-- Affiliate users
CREATE TABLE `affiliate_users` (
  `id` int(11) NOT NULL,
  `paypal_email` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `bank_information` text COLLATE utf32_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `informations` text COLLATE utf32_unicode_ci DEFAULT NULL,
  `balance` double(10,2) NOT NULL DEFAULT 0.00,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

ALTER TABLE `affiliate_users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `affiliate_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Affiliate Payment
CREATE TABLE `affiliate_payments` (
  `id` int(11) NOT NULL,
  `affiliate_user_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_details` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Affiliate Withdraw Requests
CREATE TABLE `affiliate_withdraw_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `affiliate_withdraw_requests`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `affiliate_withdraw_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `affiliate_payments`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `affiliate_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Affiliate Logs
CREATE TABLE `affiliate_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `referred_by_user_id` int(11) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `order_detail_id` bigint(20) DEFAULT NULL,
  `affiliate_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `affiliate_logs`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `affiliate_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Affiliate Stats
CREATE TABLE `affiliate_stats` (
  `id` int(11) NOT NULL,
  `affiliate_user_id` int(11) NOT NULL,
  `no_of_click` int(11) NOT NULL DEFAULT 0,
  `no_of_order_item` int(11) NOT NULL DEFAULT 0,
  `no_of_delivered` int(11) NOT NULL DEFAULT 0,
  `no_of_cancel` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `affiliate_stats`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `affiliate_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  -- ----====================================================================
  ALTER TABLE `users` ADD `referral_code` VARCHAR(255) NULL AFTER `banned`;
  ALTER TABLE `carts` ADD `product_referral_code` VARCHAR(255) NULL AFTER `quantity`;
  ALTER TABLE `order_details` ADD `product_referral_code` VARCHAR(255) NULL AFTER `quantity`;
  ALTER TABLE `products` ADD `main_category` INT(10) NULL AFTER `digital`;
  
  --
-- Table structure for table `affiliate_configs`
--

CREATE TABLE `affiliate_configs` (
  `id` int(11) NOT NULL,
  `type` varchar(1000) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affiliate_configs`
--
ALTER TABLE `affiliate_configs`
  ADD PRIMARY KEY (`id`);
COMMIT;

UPDATE `settings` SET `value` = '2.7' WHERE `type` = 'current_version';

COMMIT;
