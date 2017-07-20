-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2017 at 12:05 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediacontentci`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `article_category` smallint(6) DEFAULT NULL,
  `retries` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Times it can be reattempted per user',
  `duration` int(11) DEFAULT NULL,
  `retryWaitTime` tinyint(4) DEFAULT NULL COMMENT 'wait time between retries.',
  `points` tinyint(4) DEFAULT NULL COMMENT 'points can be earned for the activity.',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `title`, `type`, `article_id`, `article_category`, `retries`, `duration`, `retryWaitTime`, `points`, `status`, `created`, `modified`) VALUES
(1, 'First Polls', 1, NULL, NULL, 1, 7, 1, 10, 1, '2017-07-05 18:30:00', '2017-07-07 09:56:59');

-- --------------------------------------------------------

--
-- Table structure for table `activity_answer`
--

CREATE TABLE `activity_answer` (
  `id` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `answerText` varchar(1000) NOT NULL,
  `isCorrect` tinyint(4) NOT NULL COMMENT '0 false, 1 true, 2 poll question'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activity_image`
--

CREATE TABLE `activity_image` (
  `image` varchar(255) NOT NULL,
  `activityId` int(11) NOT NULL,
  `votes` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activity_question`
--

CREATE TABLE `activity_question` (
  `id` int(11) NOT NULL,
  `activityId` int(11) NOT NULL,
  `questionText` text NOT NULL,
  `questionType` enum('check','radio') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activity_type`
--

CREATE TABLE `activity_type` (
  `id` int(11) NOT NULL,
  `activityType` varchar(100) NOT NULL,
  `activityLabel` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_type`
--

INSERT INTO `activity_type` (`id`, `activityType`, `activityLabel`) VALUES
(1, 'poll', 'Poll'),
(2, 'quiz', 'Article Quiz');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` smallint(6) NOT NULL,
  `article_title` varchar(250) NOT NULL,
  `article_content` longtext NOT NULL,
  `article_img` varchar(200) NOT NULL,
  `meta_title` varchar(150) NOT NULL,
  `meta_keywords` varchar(200) NOT NULL,
  `meta_description` varchar(200) NOT NULL,
  `isFeatures` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Featured articles',
  `banner_img` varchar(250) NOT NULL,
  `banner_display_mode` varchar(20) NOT NULL,
  `reviewed_by` int(11) NOT NULL COMMENT 'publish user id',
  `published_on` int(11) NOT NULL COMMENT 'publish date',
  `status` enum('Active','inActive') NOT NULL DEFAULT 'inActive',
  `create_dt` int(11) NOT NULL,
  `update_dt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `user_id`, `category_id`, `article_title`, `article_content`, `article_img`, `meta_title`, `meta_keywords`, `meta_description`, `isFeatures`, `banner_img`, `banner_display_mode`, `reviewed_by`, `published_on`, `status`, `create_dt`, `update_dt`) VALUES
(1, 1, 2, 'Postpartum health care in..', '<p>Moms are usually not the focus of attention after birth at the hospital. Alison Stuebe, an associate professor of maternal-fetal medicine at UNC Chapel Hill and a lead researcher on...</p>', '1500292369.1719571552.png', 'my first article', 'my first article mediacontent', 'my first article mediacontent', 'Yes', '1500289415.530530747.png', 'No', 0, 1499884200, 'Active', 1499953434, 1500292369),
(2, 2, 3, 'Post title goes here... ', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '1500042453.png', 'pen', 'pen', 'pen', 'Yes', '', '', 0, 1499797800, 'Active', 1499954172, 1500043581),
(3, 1, 4, 'Post Title Goes Here..', '<p>Moms Are Usually Not The Focus Of Attention After Birth At The Hospital. Alison Stuebe, An Associate Professor Of Maternal-fetal Medicine At UNC Chapel Hill And A Lead Researcher On...</p>', '1500044110.png', '', '', '', 'Yes', '', '', 0, 1499797800, 'Active', 1500044110, 1500044187),
(4, 2, 2, 'Post Title Goes Here..', '<p>Moms Are Usually Not The Focus Of Attention After Birth At The Hospital. Alison Stuebe, An Associate Professor Of Maternal-fetal Medicine At UNC Chapel Hill And A Lead Researcher On.</p>', '1500044224.png', '', '', '', 'Yes', '', '', 0, 1499711400, 'Active', 1500044224, 0),
(5, 2, 3, 'Post Title Goes Here... ', '<p>Moms Are Usually Not The Focus Of Attention After Birth At The Hospital. Alison Stuebe, An Associate Professor Of Maternal-fetal Medicine At UNC Chapel Hill And A Lead Researcher On...</p>', '1500044265.png', '', '', '', 'No', '', '', 0, 1499625000, 'Active', 1500044265, 0),
(6, 1, 2, 'dfg', '<p>Moms are usually not the focus of attention after birth at the hospital. Alison Stuebe, an associate professor of maternal-fetal medicine at UNC Chapel Hill and a lead researcher on...</p>', '1500289835.627525605.png', 'dfgdf', 'dfgdf', 'dfgdf', 'No', '1500289835.1110688299.png', 'Yes', 0, 1500289835, 'Active', 1500289835, 0);

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE `article_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `description` longtext COLLATE latin1_general_ci NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('Active','inActive') COLLATE latin1_general_ci NOT NULL DEFAULT 'inActive',
  `create_dt` int(11) NOT NULL,
  `update_dt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`id`, `title`, `description`, `parent_id`, `status`, `create_dt`, `update_dt`) VALUES
(1, 'shopping', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 0, 'Active', 1499343875, 1499953959),
(2, 'medical', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 0, 'Active', 1499412371, 1499953944),
(3, 'social', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 0, 'Active', 1499953981, 0),
(4, 'modlling', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 0, 'Active', 1499954015, 0);

-- --------------------------------------------------------

--
-- Table structure for table `article_comment`
--

CREATE TABLE `article_comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `parent_id` int(11) NOT NULL COMMENT 'comment id of parent',
  `create_dt` int(11) NOT NULL,
  `update_dt` int(11) NOT NULL,
  `status` enum('Active','inActive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article_comment`
--

INSERT INTO `article_comment` (`id`, `user_id`, `article_id`, `comment`, `parent_id`, `create_dt`, `update_dt`, `status`) VALUES
(1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo? ', 0, 1499731200, 0, 'Active'),
(2, 2, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo? ', 0, 1499855411, 0, 'Active'),
(3, 2, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?', 1, 1499558400, 0, 'Active'),
(4, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?', 1, 1499644800, 0, 'Active'),
(5, 2, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?', 2, 1499858697, 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `article_comment_like`
--

CREATE TABLE `article_comment_like` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `create_dt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article_comment_like`
--

INSERT INTO `article_comment_like` (`id`, `comment_id`, `user_id`, `likes`, `create_dt`) VALUES
(93, 5, 1, 1, 1499866043),
(94, 3, 1, 1, 1499868040),
(96, 22, 1, 1, 1500361240),
(97, 25, 1, 1, 1500362678);

-- --------------------------------------------------------

--
-- Table structure for table `article_like`
--

CREATE TABLE `article_like` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `create_dt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article_like`
--

INSERT INTO `article_like` (`id`, `article_id`, `user_id`, `likes`, `create_dt`) VALUES
(3, 4, 12, 1, 0),
(7, 4, 11, 1, 1500285533),
(31, 2, 1, 1, 1500287873),
(40, 3, 1, 1, 1500293573),
(41, 4, 1, 1, 1500293574),
(44, 6, 1, 1, 1500535233);

-- --------------------------------------------------------

--
-- Table structure for table `article_upload`
--

CREATE TABLE `article_upload` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `file_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article_upload`
--

INSERT INTO `article_upload` (`id`, `article_id`, `file_name`, `file_type`) VALUES
(1, 1, '1499671270.png', 'image');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `mobile_number` varchar(29) NOT NULL,
  `create_dt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_carousel_slider`
--

CREATE TABLE `manage_carousel_slider` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `img_name` varchar(100) NOT NULL,
  `position` varchar(50) NOT NULL,
  `create_dt` int(11) NOT NULL,
  `update_dt` int(11) NOT NULL,
  `status` enum('Active','inActive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_carousel_slider`
--

INSERT INTO `manage_carousel_slider` (`id`, `title`, `description`, `img_name`, `position`, `create_dt`, `update_dt`, `status`) VALUES
(1, 'An Open Response To The Working Mom From The SAHM ', 'loren lipson', 'header-slide2.png', 'left_bottom', 1499757538, 1499957801, 'Active'),
(2, 'Are Working Morthers Unhappy?', '', 'header-slide1.png', 'right_top', 1499957687, 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `manage_email_templates`
--

CREATE TABLE `manage_email_templates` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `create_dt` int(11) NOT NULL,
  `update_dt` int(11) NOT NULL,
  `status` enum('Active','inActive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_email_templates`
--

INSERT INTO `manage_email_templates` (`id`, `name`, `slug`, `subject`, `message`, `create_dt`, `update_dt`, `status`) VALUES
(1, 'simple_message', 'simple_message', 'simple message', '<h2>\r\n	Hi {firstname},</h2>\r\n', 0, 0, 'Active'),
(2, 'status_deactive', 'status_deactive', 'Account status deactive', '<h2>\n	Hi {firstname},</h2>\n<p>\n	Your account deactivated.Please contact otriga administrator</p>\n', 0, 0, 'Active'),
(3, 'send_message', 'send_message', 'Message', '<h2>\r\n	Hi {firstname},</h2>\r\n<p>\r\n	{sender_firstname} has sent you a message</p>\r\n<table border="0" width="50%">\r\n	<tbody>\r\n		<tr>\r\n			<td height="94" width="30%">\r\n				<div style="width: 80px; height:80px; display: inline-block; float: left;">\r\n					<a href="{sender_url}" title="{sender_fullname}"><img class="circle-img" src="{sender_profileimage}" style="border-radius: 100% 100% 100% 100%; width: 80px; height:80px;" /></a></div>\r\n			</td>\r\n			<td valign="top" width="70%">\r\n				<h4 style="margin: 10px 0px;">\r\n					<a href="{sender_url}" style="text-decoration:none;color:#000000;" title="{sender_fullname}">{sender_fullname}</a></h4>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	<b>Subject: </b>{subject}</p>\r\n<p>\r\n	<b>Message: </b>{message}</p>\r\n<p>\r\n	<a href="{reply_url}"><button class="red_button" type="button">Reply</button></a> <a href="{replytoall_url}"><button class="red_button" type="button">Reply all</button></a></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Can&#39;t see the button? Use this link: <a href="{message_url}">Click here</a></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 0, 0, 'Active'),
(4, 'NewLetter', 'NewLetter', 'Subscribe For News Letter', '<h1>\r\n	Hi {USERNAME}</h1>\r\n<p>\r\n	Thank you for newsletter subscription with <a href="{SITEURL}">{SITENAME}</a></p>\r\n', 0, 0, 'Active'),
(5, 'signup', 'signup', 'Thank you for registering', '<h1>\r\n	Hi {USERNAME}</h1>\r\n<p>\r\n	Thank you for registering with <a href="{SITEURL}">{SITENAME}</a></p>\r\n<p>\r\n	User Details: Email : {EMAIL}</p>\r\n<p>\r\n	Password : {PASSWORD}</p>\r\n<p>\r\n	<a href="{SITEURL}login/verification?verifier={CODE}"><button class="red_button" type="button">Email verification</button></a></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Copy paste this url</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	{SITEURL}login/verification/?verifier={CODE}</p>\r\n<p>\r\n	Can&#39;t see the button? Use this link: <a href="{SITEURL}login/verification?verifier={CODE}">Click here</a></p>\r\n', 0, 0, 'Active'),
(6, 'email_verification', 'email_verification', 'Thank you for email verification', '<h1>\n	Hi {USERNAME}</h1>\n<p>\n	Thank you for verify email address with <a href="{SITEURL}">{SITENAME}</a></p>\n<p>\n	User Details:</p>\n<p>\n	Email : {EMAIL}</p>\n<p>\n	<a href="{SITEURL}" target="_blank"><button class="red_button" type="button">Login</button></a></p>\n<p>\n	&nbsp;</p>\n<p>\n	Copy paste this url</p>\n<p>\n	{SITEURL}</p>\n<p>\n	Can&#39;t see the button? Use this link: <a href="{SITEURL}" target="_blank">Click here</a></p>\n', 0, 0, 'Active'),
(7, 'forgot_password', 'forgot_password', 'Forgot Password', '<h1>\n	Hi {USERNAME}</h1>\n\n<p>\n	 Email : {EMAIL}</p>\n<p>\n	Password : {PASSWORD}</p>\n<p>\n	<a href="{siteurl}login"><button class="red_button" type="button">Login</button></a></p>\n<p>\n	&nbsp;</p>\n<p>\n	Copy paste this url</p>\n<p>\n	&nbsp;</p>\n<p>\n	{siteurl}login</p>\n<p>\n	Can&#39;t see the button? Use this link: <a href="{siteurl}login">Click here</a></p>\n\n\n\n\n', 0, 0, 'Active'),
(8, 'contact_us', 'contact_us', 'Contact Us', '<h1> Hi {USERNAME}</h1>\n<p> Name : {NAME}</p>\n<p> Email : {EMAIL}</p>\n<p> Subject : {SUBJECT}</p>\n<p> Message : {MESSAGE}</p>\n\n', 0, 0, 'Active'),
(9, 'contact_us_thankyou', 'contact_us_thankyou', 'Contact Us', '<h1>\r\n	Hi {USERNAME}</h1>\r\n<p>\r\n	Thank you for Contact Us.{SITENAME} will contact you soon</p>\r\n', 0, 0, 'Active'),
(14, 'email_verification', 'email_verification', 'Email verification', '<h1>Hi {USERNAME}</h1>\r\n<p>Please click this link to verify your email</p>\r\n<p>	<a href="{SITEURL}login/verification/?verifier={CODE}"><button class="red_button" type="button">Email verification</button></a></p>\r\n<p>&nbsp;</p>\r\n<p>Copy paste this url</p>\r\n<p>&nbsp;</p>\r\n<p>{SITEURL}login/verification/?verifier={CODE}</p>\r\n<p>Can&#39;t see the button? Use this link: <a href="{SITEURL}login/verification/?verifier={CODE}">Click here</a></p>\r\n', 0, 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `manage_menu_order`
--

CREATE TABLE `manage_menu_order` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `create_dt` int(11) NOT NULL,
  `menu_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_menu_order`
--

INSERT INTO `manage_menu_order` (`id`, `category_id`, `page_id`, `create_dt`, `menu_order`) VALUES
(49, 2, 1, 1500379599, 1),
(61, 3, 1, 1500387154, 1),
(62, 3, 3, 1500387154, 2),
(63, 3, 9, 1500387154, 3),
(64, 3, 5, 1500387154, 4),
(65, 3, 6, 1500387154, 5),
(66, 3, 7, 1500387154, 6),
(67, 3, 4, 1500387154, 7),
(68, 3, 10, 1500387154, 8),
(69, 3, 11, 1500387154, 9),
(70, 3, 12, 1500387154, 10),
(71, 3, 13, 1500387154, 11),
(72, 1, 1, 1500387199, 1),
(73, 1, 8, 1500387199, 2),
(74, 1, 14, 1500387199, 3),
(75, 1, 9, 1500387199, 4);

-- --------------------------------------------------------

--
-- Table structure for table `manage_static_pages`
--

CREATE TABLE `manage_static_pages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `page_title` varchar(250) NOT NULL,
  `page_slug` varchar(250) NOT NULL,
  `page_content` longtext NOT NULL,
  `meta_title` varchar(100) NOT NULL,
  `meta_keywords` varchar(250) NOT NULL,
  `meta_description` varchar(250) NOT NULL,
  `static_templates` varchar(200) NOT NULL,
  `page_order` int(11) NOT NULL,
  `create_dt` int(11) NOT NULL,
  `update_dt` int(11) NOT NULL,
  `status` enum('Active','inActive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_static_pages`
--

INSERT INTO `manage_static_pages` (`id`, `user_id`, `page_title`, `page_slug`, `page_content`, `meta_title`, `meta_keywords`, `meta_description`, `static_templates`, `page_order`, `create_dt`, `update_dt`, `status`) VALUES
(1, 1, 'About Us', 'about-us', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\\r\\n<p>&nbsp;</p>\\r\\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\\r\\n<p>&nbsp;<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\\r\\n<p>&nbsp;</p>\\r\\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'About Us', 'About Us Mediacontent', 'About Us Mediacontent Web Site', '', 1, 2147483647, 1500543198, 'Active'),
(2, 1, 'website work', '', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>', 'website work', 'website work mediacontent', 'website work mediacontent', '', 2, 1499690100, 1499842925, 'Active'),
(3, 1, 'Services', 'services', '<p>&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;<br />&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;<br />&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;<br />&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;</p>', 'Services', 'Services', 'Services', '', 1, 1500385154, 0, 'Active'),
(4, 1, 'Terms', 'terms', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\\r\\n<p>&nbsp;</p>\\r\\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\\r\\n<p>&nbsp;</p>\\r\\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\\r\\n<p>&nbsp;</p>\\r\\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Terms', 'Terms', 'Terms', '', 1, 1500385182, 1500385867, 'Active'),
(5, 1, 'copyright', 'copyright', '<p>&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;<br />&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;<br />&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;<br />&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;</p>', 'copyright', 'copyright', 'copyright', '', 1, 1500385241, 0, 'Active'),
(6, 1, 'creators', 'creators', '<p>&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;<br />&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;<br />&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;<br />&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;</p>', 'creators', 'creators', 'creators', '', 1, 1500385266, 0, 'Active'),
(7, 1, 'Advevertise', 'advevertise', '<p>&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;<br />&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;<br />&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;<br />&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;</p>', 'Advevertise', 'Advevertise', 'Advevertise', '', 1, 1500385316, 0, 'Active'),
(8, 1, 'Blog', 'blog', '<div class="row">\r\n<div class="panel-body">\r\n<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">\r\n<div class="row">\r\n<div class="col-sm-12">\r\n<table id="example1" class="table table-striped table-bordered width-100 cellspace-0 dataTable dtr-inline" role="grid" aria-describedby="example1_info">\r\n<tbody>\r\n<tr class="odd" role="row">\r\n<td>\r\n<p>&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;<br />&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;<br />&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;<br />&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<p>&nbsp;</p>', 'Blog', 'Blog', 'Blog', '', 1, 1500385602, 0, 'Active'),
(9, 1, 'Contacts', 'contacts', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Contacts', 'Contacts', 'Contacts', 'contact_us', 1, 1500385821, 0, 'Active'),
(10, 1, 'Privacy', 'privacy', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Privacy', 'Privacy', 'Privacy', '', 1, 1500385925, 0, 'Active'),
(11, 1, 'Policy & Saftey', 'policy-saftey', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Policy & Saftey', 'Policy & Saftey', 'Policy & Saftey', '', 1, 1500385977, 0, 'Active'),
(12, 1, 'Send', 'send', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Send', 'Send', 'Send', '', 1, 1500386010, 0, 'Active'),
(13, 1, 'Feedback', 'feedback', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Feedback', 'Feedback', 'Feedback', '', 1, 1500386054, 0, 'Active'),
(14, 1, 'Gallery', 'gallery', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Gallery', 'Gallery', 'Gallery', '', 1, 1500386170, 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `manage_static_pages_category`
--

CREATE TABLE `manage_static_pages_category` (
  `id` tinyint(4) NOT NULL,
  `cat_title` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `create_dt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_static_pages_category`
--

INSERT INTO `manage_static_pages_category` (`id`, `cat_title`, `status`, `create_dt`) VALUES
(1, 'Top Menu', 'Active', 1500379641),
(2, 'Header Menu', 'Active', 1500379641),
(3, 'Footer Menu', 'Active', 1500379641);

-- --------------------------------------------------------

--
-- Table structure for table `manage_website_setting`
--

CREATE TABLE `manage_website_setting` (
  `id` tinyint(4) NOT NULL,
  `setting_name` varchar(100) NOT NULL,
  `setting_value` text NOT NULL,
  `create_dt` int(11) NOT NULL,
  `status` enum('Active','inActive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_website_setting`
--

INSERT INTO `manage_website_setting` (`id`, `setting_name`, `setting_value`, `create_dt`, `status`) VALUES
(1, 'site_name', 'EM', 2147483647, 'Active'),
(2, 'site_email', 'info@divinewelfare.com', 2147483647, 'Active'),
(3, 'phone_number', '0131 281 53706', 2147483647, 'Active'),
(5, 'site_address', '83 Princes Street, Edinburgh', 2147483647, 'Active'),
(8, 'meta_keywords', 'Lorem Ipsum keywords', 2147483647, 'Active'),
(9, 'meta_description', 'Lorem Ipsum description', 2147483647, 'Active'),
(10, 'meta_title', 'Lorem Ipsum', 2147483647, 'Active'),
(14, 'site_copyright', ' <p> © 2017ElephentMoms.. All Rights Reserved. </p>', 2147483647, 'Active'),
(15, 'site_logo', 'logo.png', 0, 'Active'),
(16, 'linkedIn_url', 'https://in.linkedin.com/', 0, 'Active'),
(17, 'twitter_url', 'https://twitter.com/login', 0, 'Active'),
(18, 'facebook_url', 'https://www.facebook.com/login/', 0, 'Active'),
(19, 'google_url', 'https://www.google.co.in', 0, 'Active'),
(20, 'youtube_url', 'https://www.youtube.com/user/Google', 0, 'Active'),
(21, 'mobile_number', '999 999 8754', 0, 'Active'),
(22, 'careers_email', 'careers@divinewelfare.com', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciver_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `front_url` text NOT NULL,
  `backend_url` text NOT NULL,
  `create_dt` int(11) NOT NULL,
  `read_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `sender_id`, `reciver_id`, `title`, `message`, `front_url`, `backend_url`, `create_dt`, `read_status`) VALUES
(1, 2, 1, 'add new article', 'my first article\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry.', '', 'admin/article/editArticle/MQ', 1499644800, 0),
(2, 1, 1, 'add new article', '2017 innovations\nLorem Ipsum is simply dummy text of the printing and typesetting industry.', '', 'admin/article/editArticle/MQ', 1499847546, 1),
(3, 2, 1, 'Add new user', 'register new user', '', 'admin/user/editUser/Mg', 1499851828, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `description` text NOT NULL,
  `points` varchar(20) NOT NULL,
  `status` enum('Active','inActive') NOT NULL DEFAULT 'Active',
  `create_dt` int(11) NOT NULL,
  `update_dt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` enum('Active','inActive') NOT NULL DEFAULT 'Active',
  `create_dt` int(11) NOT NULL,
  `update_dt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `img_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL COMMENT 'survey category id',
  `article_id` int(11) NOT NULL COMMENT 'article id',
  `description` text NOT NULL,
  `status` enum('Active','inActive') NOT NULL DEFAULT 'Active',
  `create_dt` int(11) NOT NULL,
  `update_dt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id`, `cat_id`, `article_id`, `description`, `status`, `create_dt`, `update_dt`) VALUES
(1, 0, 0, 'Are you a student', 'Active', 1499238848, 0);

-- --------------------------------------------------------

--
-- Table structure for table `survey_category`
--

CREATE TABLE `survey_category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` enum('Active','inActive') NOT NULL DEFAULT 'Active',
  `create_dt` int(11) NOT NULL,
  `update_dt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey_question`
--

CREATE TABLE `survey_question` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `question_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_question`
--

INSERT INTO `survey_question` (`id`, `survey_id`, `question`, `question_type`) VALUES
(1, 1, 'yes', 'checkbox'),
(2, 1, 'No', 'checkbox');

-- --------------------------------------------------------

--
-- Table structure for table `survey_question_answer`
--

CREATE TABLE `survey_question_answer` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `survey_question_id` int(11) NOT NULL,
  `survey_answers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey_user_answer`
--

CREATE TABLE `survey_user_answer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `survey_question_id` int(11) NOT NULL,
  `survey_answers` text NOT NULL,
  `create_dt` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_user_answer`
--

INSERT INTO `survey_user_answer` (`id`, `user_id`, `survey_id`, `survey_question_id`, `survey_answers`, `create_dt`) VALUES
(1, 2, 1, 1, 'no', '1499238848');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role_id` tinyint(11) NOT NULL,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `profile_url` text COLLATE utf8_unicode_ci NOT NULL,
  `picture_url` text COLLATE utf8_unicode_ci NOT NULL,
  `referral_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `activation_code` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','inActive','Delete') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `create_dt` int(11) NOT NULL,
  `update_dt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role_id`, `oauth_provider`, `oauth_uid`, `user_name`, `first_name`, `last_name`, `email`, `password`, `gender`, `locale`, `profile_url`, `picture_url`, `referral_code`, `activation_code`, `status`, `create_dt`, `update_dt`) VALUES
(1, 1, '', '', 'admin', 'media', 'content', 'admin@gmail.com', '123456', 'male', '', '', 'blogger-img.png', 'ASD197', '', 'Active', 1499773578, 0),
(2, 4, '', '', '', 'pramod', 'jain', 'pramod.jain@consagous.com', '12345', '', '', '', '1500042453.png', '', '', 'Active', 1499775014, 1500030509),
(3, 4, '', '', '', 'pramod', '', 'pramod.jn2@gmail.com', '123456', '', '', '', '', '', '157650253', 'Active', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL,
  `activityId` int(11) NOT NULL,
  `activityTime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_bookmarks`
--

CREATE TABLE `user_bookmarks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_follow`
--

CREATE TABLE `user_follow` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_friend`
--

CREATE TABLE `user_friend` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_login_attempts`
--

CREATE TABLE `user_login_attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(40) NOT NULL,
  `login_dt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login_attempts`
--

INSERT INTO `user_login_attempts` (`id`, `user_id`, `ip_address`, `login_dt`) VALUES
(1, 2, '::1', 1500027535),
(2, 2, '::1', 1500028404),
(3, 1, '::1', 1500029759),
(4, 1, '::1', 1500030474),
(5, 1, '::1', 1500040563),
(6, 1, '::1', 1500042211),
(7, 1, '::1', 1500043566),
(8, 1, '::1', 1500043861),
(9, 1, '::1', 1500044143),
(10, 2, '::1', 1500103959),
(11, 1, '::1', 1500104854),
(12, 1, '::1', 1500104959),
(13, 1, '::1', 1500105496),
(14, 2, '::1', 1500106020),
(15, 2, '::1', 1500106770),
(16, 2, '::1', 1500106823),
(17, 2, '::1', 1500106876),
(18, 1, '::1', 1500111252),
(19, 1, '::1', 1500288135),
(20, 1, '::1', 1500288682),
(21, 1, '::1', 1500292352),
(22, 1, '::1', 1500365789),
(23, 1, '::1', 1500380092),
(24, 1, '::1', 1500382752),
(25, 1, '::1', 1500384963),
(26, 1, '::1', 1500446441),
(27, 1, '::1', 1500446587),
(28, 1, '::1', 1500451235),
(29, 1, '::1', 1500451286),
(30, 1, '::1', 1500539763),
(31, 1, '::1', 1500545016);

-- --------------------------------------------------------

--
-- Table structure for table `user_points_badges`
--

CREATE TABLE `user_points_badges` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `points` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `create_dt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_points_earn`
--

CREATE TABLE `user_points_earn` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ref_type` varchar(50) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `create_dt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_referral`
--

CREATE TABLE `user_referral` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `referral_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Seller'),
(4, 'Register User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_answer`
--
ALTER TABLE `activity_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_question`
--
ALTER TABLE `activity_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_type`
--
ALTER TABLE `activity_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_comment`
--
ALTER TABLE `article_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_comment_like`
--
ALTER TABLE `article_comment_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_like`
--
ALTER TABLE `article_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_upload`
--
ALTER TABLE `article_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_carousel_slider`
--
ALTER TABLE `manage_carousel_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_email_templates`
--
ALTER TABLE `manage_email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_menu_order`
--
ALTER TABLE `manage_menu_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_static_pages`
--
ALTER TABLE `manage_static_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_static_pages_category`
--
ALTER TABLE `manage_static_pages_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_website_setting`
--
ALTER TABLE `manage_website_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_category`
--
ALTER TABLE `survey_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_question`
--
ALTER TABLE `survey_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_question_answer`
--
ALTER TABLE `survey_question_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_user_answer`
--
ALTER TABLE `survey_user_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_bookmarks`
--
ALTER TABLE `user_bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_follow`
--
ALTER TABLE `user_follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_friend`
--
ALTER TABLE `user_friend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login_attempts`
--
ALTER TABLE `user_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_points_badges`
--
ALTER TABLE `user_points_badges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_points_earn`
--
ALTER TABLE `user_points_earn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_referral`
--
ALTER TABLE `user_referral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `activity_answer`
--
ALTER TABLE `activity_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `activity_question`
--
ALTER TABLE `activity_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `activity_type`
--
ALTER TABLE `activity_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `article_category`
--
ALTER TABLE `article_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `article_comment`
--
ALTER TABLE `article_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `article_comment_like`
--
ALTER TABLE `article_comment_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `article_like`
--
ALTER TABLE `article_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `article_upload`
--
ALTER TABLE `article_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `manage_carousel_slider`
--
ALTER TABLE `manage_carousel_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `manage_email_templates`
--
ALTER TABLE `manage_email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `manage_menu_order`
--
ALTER TABLE `manage_menu_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `manage_static_pages`
--
ALTER TABLE `manage_static_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `manage_static_pages_category`
--
ALTER TABLE `manage_static_pages_category`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `manage_website_setting`
--
ALTER TABLE `manage_website_setting`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `survey_category`
--
ALTER TABLE `survey_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `survey_question`
--
ALTER TABLE `survey_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `survey_question_answer`
--
ALTER TABLE `survey_question_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `survey_user_answer`
--
ALTER TABLE `survey_user_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_bookmarks`
--
ALTER TABLE `user_bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_follow`
--
ALTER TABLE `user_follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_friend`
--
ALTER TABLE `user_friend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_login_attempts`
--
ALTER TABLE `user_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `user_points_badges`
--
ALTER TABLE `user_points_badges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_points_earn`
--
ALTER TABLE `user_points_earn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_referral`
--
ALTER TABLE `user_referral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
