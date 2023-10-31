ALTER TABLE `products` ADD `earn_point` DOUBLE(8,2) NOT NULL DEFAULT '0.00' AFTER `num_of_sale`;

--
-- Table structure for table `club_points`
--
CREATE TABLE `club_points` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `points` double(18,2) NOT NULL,
  `combined_order_id` int(11) NOT NULL,
  `convert_status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `club_point_details`
--
CREATE TABLE `club_point_details` (
  `id` int(11) NOT NULL,
  `club_point_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `point` double(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `club_points`
--
ALTER TABLE `club_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_point_details`
--
ALTER TABLE `club_point_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `club_points`
--
ALTER TABLE `club_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `club_point_details`
--
ALTER TABLE `club_point_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

UPDATE `settings` SET `value` = '2.0' WHERE `type` = 'current_version';

COMMIT;