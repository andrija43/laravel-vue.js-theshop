
UPDATE `settings` SET `value` = '[\"Home\",\"All Categories\",\"All Brands\",\"All Blogs\",\"Offers\",\"Men Clothing & Fashion\",\"Computer & Accessories\"]' WHERE `settings`.`type` = "header_menu_labels";

UPDATE `settings` SET `value` = '[\"\\/\",\"\\/all-categories\",\"\\/all-brands\",\"\\/all-blogs\",\"\\/all-offers\",\"\\/category\\/men-clothing-fashion\",\"\\/category\\/computer-accessories\"]' WHERE `settings`.`type` = "header_menu_links";

UPDATE `settings` SET `value` = '[\"\\/page/terms-and-conditions\",\"\\/page/return-policy\",\"\\/page/warranty-policy\",\"\\/page/privacy-policy\"]' WHERE `settings`.`type` = 'footer_menu_links';

UPDATE `settings` SET `value` = '2.4' WHERE `type` = 'current_version';

COMMIT;

