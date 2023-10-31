INSERT INTO `settings` (`id`, `type`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, 'product_approve_by_admin', '1', current_timestamp(), current_timestamp(), NULL);

ALTER TABLE `products` ADD `approved` TINYINT NOT NULL DEFAULT '1' AFTER `published`;

ALTER TABLE `products` ADD `digital` TINYINT NULL DEFAULT '0' AFTER `earn_point`;
ALTER TABLE `categories` ADD `digital` TINYINT NULL DEFAULT '0' AFTER `featured`;
ALTER TABLE `products` ADD `file_name` VARCHAR(255) NULL AFTER `digital`;

UPDATE `settings` SET `value` = '2.5' WHERE `type` = 'current_version';

COMMIT;
