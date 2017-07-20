/* 20-7-2017 */
ALTER TABLE `manage_static_pages` ADD `static_templates` VARCHAR(200) NOT NULL AFTER `meta_description`;

/* 19-7-2017 */
ALTER TABLE `manage_static_pages`
  DROP `cat_id`,
  DROP `article_id`;

/* 18-7-2017 */
ALTER TABLE `article_comment` CHANGE `created_dt` `create_dt` INT(11) NOT NULL;
ALTER TABLE `manage_static_pages` ADD `page_slug` VARCHAR(250) NOT NULL AFTER `page_title`;


/* 17-7-2017 */
ALTER TABLE `article` ADD `banner_img` VARCHAR(250) NOT NULL AFTER `isFeatures`, ADD `banner_display_mode` VARCHAR(20) NOT NULL AFTER `banner_img`;


/* 15-7-2017 */

ALTER TABLE `user` ADD `activation_code` VARCHAR(250) NOT NULL AFTER `referral_code`;
