INSERT INTO `settings` (`id`, `type`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, 'iyzico_sandbox', '1', current_timestamp(), current_timestamp(), NULL);

UPDATE `settings` SET `value` = '2.3' WHERE `type` = 'current_version';

COMMIT;
