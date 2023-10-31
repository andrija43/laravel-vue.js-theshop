ALTER TABLE `users` ADD `banned` TINYINT NOT NULL DEFAULT '0' AFTER `balance`;
INSERT INTO `settings` (`id`, `type`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, 'min_withdrawal_amount', '0', current_timestamp(), current_timestamp(), NULL);

INSERT INTO `settings` (`id`, `type`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, 'item_name', 'the-shop', current_timestamp(), current_timestamp(), NULL);

UPDATE `settings` SET `value` = '2.2' WHERE `type` = 'current_version';

COMMIT;
