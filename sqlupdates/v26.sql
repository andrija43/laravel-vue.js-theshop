ALTER TABLE `shops` ADD `verification_status` TINYINT NOT NULL DEFAULT '1' AFTER `published`;
ALTER TABLE `shops` ADD `verification_info` LONGTEXT NULL AFTER `verification_status`;

INSERT INTO `settings` (`id`, `type`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, 'product_manage_by_admin', '0', current_timestamp(), current_timestamp(), NULL);
INSERT INTO `settings` (`id`, `type`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, 'order_manage_by_admin', '0', current_timestamp(), current_timestamp(), NULL);

INSERT INTO `settings` (`id`, `type`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, 'verification_form', '[]', current_timestamp(), current_timestamp(), NULL);

UPDATE `settings` SET `value` = '2.6' WHERE `type` = 'current_version';

COMMIT;
