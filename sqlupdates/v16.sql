UPDATE `settings` SET `value` = '1.6' WHERE `type` = 'current_version';

ALTER TABLE `combined_orders` ADD `guest_id` INT(11) NULL AFTER `user_id`;

COMMIT;