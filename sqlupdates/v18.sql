UPDATE `settings` SET `value` = '1.8' WHERE `type` = 'current_version';

-- Blog Categories
CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(), 
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

-- blog category Translations
CREATE TABLE `blog_category_translations` (
  `id` int(11) NOT NULL,
  `blog_category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `blog_category_translations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `blog_category_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Blogs
CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` int(11) DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_img` int(11) DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(), 
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

-- Blog translations
CREATE TABLE `blog_translations` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(), 
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `blog_translations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `blog_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `permissions` (`id`, `name`, `parent`, `guard_name`, `created_at`, `updated_at`) VALUES
(NULL, 'pos_manager', 'pos', 'web', '2022-06-22 05:02:50', '2022-06-22 05:02:50'),
(NULL, 'pos_configuration', 'pos', 'web', '2022-06-22 05:02:50', '2022-06-22 05:02:50'),
(NULL, 'view_all_blogs', 'blog', 'web', '2022-06-22 05:02:50', '2022-06-22 05:02:50'),
(NULL, 'add_blog', 'blog', 'web', '2022-06-22 05:02:50', '2022-06-22 05:02:50'),
(NULL, 'edit_blog', 'blog', 'web', '2022-06-22 05:02:50', '2022-06-22 05:02:50'),
(NULL, 'delete_blog', 'blog', 'web', '2022-06-22 05:02:50', '2022-06-22 05:02:50'),
(NULL, 'publish_blog', 'blog', 'web', '2022-06-22 05:02:50', '2022-06-22 05:02:50'),
(NULL, 'view_blog_categories', 'blog', 'web', '2022-06-22 05:02:50', '2022-06-22 05:02:50'),
(NULL, 'add_blog_category', 'blog', 'web', '2022-06-22 05:02:50', '2022-06-22 05:02:50'),
(NULL, 'edit_blog_category', 'blog', 'web', '2022-06-22 05:02:50', '2022-06-22 05:02:50'),
(NULL, 'delete_blog_category', 'blog', 'web', '2022-06-22 05:02:50', '2022-06-22 05:02:50'),
(NULL, 'sms_settings', 'setting', 'web', '2022-06-22 05:02:50', '2022-06-22 05:02:50'), 
(NULL, 'view_all_manual_payment_methods', 'offline_payment', 'web', '2022-06-22 05:02:50', '2022-06-22 05:02:50'),
(NULL, 'add_manual_payment_method', 'offline_payment', 'web', '2022-06-22 05:03:25', '2022-06-22 05:03:25'),
(NULL, 'edit_manual_payment_method', 'offline_payment', 'web', '2022-06-22 05:03:56', '2022-06-22 05:03:56'),
(NULL, 'delete_manual_payment_method', 'offline_payment', 'web', '2022-06-22 05:04:10', '2022-06-22 05:04:10'),
(NULL, 'view_all_offline_wallet_recharges', 'offline_payment', 'web', '2022-06-22 05:09:09', '2022-06-22 05:09:09'),
(NULL, 'approve_offline_wallet_recharge', 'offline_payment', 'web', '2022-06-22 05:11:29', '2022-06-22 05:11:29'),
(NULL, 'view_all_offline_seller_package_payments', 'offline_payment', 'web', '2022-06-22 05:14:02', '2022-06-22 05:14:02'),
(NULL, 'approve_offline_seller_package_payment', 'offline_payment', 'web', '2022-06-22 05:14:29', '2022-06-22 05:14:29');

COMMIT;