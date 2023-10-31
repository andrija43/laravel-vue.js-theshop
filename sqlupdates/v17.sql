UPDATE `settings` SET `value` = '1.7' WHERE `type` = 'current_version';


--
-- Table structure for table `manual_payment_methods`
--
ALTER TABLE `orders` ADD `manual_payment` INT(1) NOT NULL DEFAULT '0' AFTER `payment_type`, ADD `manual_payment_data` TEXT NULL DEFAULT NULL AFTER `manual_payment`;

CREATE TABLE `manual_payment_methods` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `heading` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_info` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


  
--
-- Table structure for table `wallets`
--
ALTER TABLE `wallets` ADD `approval` INT(1) NOT NULL DEFAULT '0' AFTER `payment_details`, ADD `offline_payment` INT(1) NOT NULL DEFAULT '0' AFTER `approval`, ADD `reciept` VARCHAR(150) NULL DEFAULT NULL AFTER `offline_payment`;


  
--
-- Table structure for table `seller_package_payments`
--   
ALTER TABLE `seller_package_payments` ADD COLUMN IF NOT EXISTS `approval` INT(1) NOT NULL DEFAULT '0' AFTER `payment_details`;
ALTER TABLE `seller_package_payments` ADD COLUMN IF NOT EXISTS `offline_payment` INT(1) NOT NULL DEFAULT '0' COMMENT '1=offline payment\r\n2=online paymnet' AFTER `approval`;
ALTER TABLE `seller_package_payments` ADD COLUMN IF NOT EXISTS `reciept` VARCHAR(150) NULL DEFAULT NULL AFTER `offline_payment`;

ALTER TABLE `seller_package_payments` ADD `transaction_id` VARCHAR(255) NULL AFTER `reciept`;
--
-- Indexes for dumped tables
--

--
-- Indexes for table `manual_payment_methods`
--
ALTER TABLE `manual_payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manual_payment_methods`
--
ALTER TABLE `manual_payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

COMMIT;