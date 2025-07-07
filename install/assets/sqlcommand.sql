-- 
-- Table structure for table `admin_preferences`
-- 

CREATE TABLE `admin_preferences` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `user_panel` tinyint(1) NOT NULL DEFAULT '0',
  `sidebar_form` tinyint(1) NOT NULL DEFAULT '0',
  `messages_menu` tinyint(1) NOT NULL DEFAULT '0',
  `notifications_menu` tinyint(1) NOT NULL DEFAULT '0',
  `tasks_menu` tinyint(1) NOT NULL DEFAULT '0',
  `user_menu` tinyint(1) NOT NULL DEFAULT '1',
  `ctrl_sidebar` tinyint(1) NOT NULL DEFAULT '0',
  `transition_page` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `admin_preferences`
-- 

INSERT INTO `admin_preferences` VALUES (1, 0, 0, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `ads`
-- 

CREATE TABLE `ads` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `header_ads` text NOT NULL,
  `footer_ads` text NOT NULL,
  `pref` tinyint(1) NOT NULL COMMENT '0=header,1=footer,2=both,3=none',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `ads`
-- 

INSERT INTO `ads` VALUES (1, '', '', 2);

-- --------------------------------------------------------

-- 
-- Table structure for table `call2action`
-- 

CREATE TABLE `call2action` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `call2action`
-- 

INSERT INTO `call2action` VALUES (1, 'BUY / SELL', 'Do you have Cryptocurrency? Buy or Sell instantly at best price now', '#');

-- --------------------------------------------------------

-- 
-- Table structure for table `cms`
-- 

CREATE TABLE `cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `home_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `seo_url` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  `navigation` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `cms`
-- 

INSERT INTO `cms` VALUES (1, 'Home', 'Realtime Cryptocurrency Price Updates & Coin Market Capitalization', 'Live Cryptocurrency prices from all markets and market Capitalization. Stay up to date with the latest cryptocurrency price movements. Check our coin stats data and see when there is an opportunity to buy or sell coin at best price.', 'home', 'CryptoNet - Cryptocurrency Market Cap, Live Prices, Charts & Ticker', 'Live Cryptocurrency prices from all markets and market Capitalization. Stay up to date with the latest cryptocurrency price movements. Check our coin stats data and see when there is an opportunity to buy or sell coin at best price.', 1, 'Header', '2018-03-28 14:35:31', '2018-05-23 08:08:00');
INSERT INTO `cms` VALUES (2, 'About Us', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<br/>\r\n<h3>What is Lorem Ipsum?</h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<br/>\r\n<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'about-us', 'About Us - CryptoNet', 'About Us', 1, 'Header', '2018-03-08 09:27:31', '2018-03-27 05:03:54');
INSERT INTO `cms` VALUES (4, 'Contact Us', '', 'Please fill up the form below to send your enquiry. One of our executive will get in touch with you with in 2-3 business days', 'contact-us', 'Contact Us - CryptoNet', 'Contact Us', 1, 'Header', '2018-03-08 13:33:35', '2018-03-27 05:04:29');
INSERT INTO `cms` VALUES (5, 'Disclaimer', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<br/>\r\n<h3>What is Lorem Ipsum?</h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<br/>\r\n<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'disclaimer', 'Legal Disclaimer - CryptoNet', 'Legal Disclaimer', 1, 'Footer', '2018-03-09 10:29:36', '2018-03-27 05:29:35');
INSERT INTO `cms` VALUES (6, 'Privacy Policy', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<br/>\r\n<h3>What is Lorem Ipsum?</h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<br/>\r\n<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'privacy-policy', 'Privacy Policy - CryptoNet', 'Privacy Policy', 1, 'Footer', '2018-03-08 13:23:35', '2018-03-27 05:05:14');
INSERT INTO `cms` VALUES (7, 'Terms', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<br/>\r\n<h3>What is Lorem Ipsum?</h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<br/>\r\n<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'terms', 'Terms of Use - CryptoNet', 'Terms of Use', 1, 'Footer', '2018-03-09 10:29:36', '2018-05-25 06:07:39');

-- --------------------------------------------------------

-- 
-- Table structure for table `contact`
-- 

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `contact`
-- 

INSERT INTO `contact` VALUES (1, 'Test Entry', 'test@test.com', '1234567890', 'This is a test entry on contact us page by CryptoNet.', '2018-03-27 05:26:11');

-- --------------------------------------------------------

-- 
-- Table structure for table `donation`
-- 

CREATE TABLE `donation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) NOT NULL,
  `paragraph` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `class` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `updated_on` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `donation`
-- 

INSERT INTO `donation` VALUES (1, 'Make us Little Contribution', 'Are you happy with what we offer? Live prices of 1000+ coins in no time. Please donate a little to help us serving you better.', 'Donate BTC', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 'flip-left', '1.png', 1520081999, 1520081999, 1);
INSERT INTO `donation` VALUES (2, 'Make us Little Contribution', 'Are you happy with what we offer? Live prices of 1000+ coins in no time. Please donate a little to help us serving you better.', 'Donate LTC', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 'flip-right', '2.png', 0, NULL, 1);
INSERT INTO `donation` VALUES (3, 'Make us Little Contribution', 'Are you happy with what we offer? Live prices of 1000+ coins in no time. Please donate a little to help us serving you better.', 'Donate ETH', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 'zoom-in', '31.png', 0, NULL, 1);
INSERT INTO `donation` VALUES (4, 'Make us Little Contribution', 'Are you happy with what we offer? Live prices of 1000+ coins in no time. Please donate a little to help us serving you better.', 'Donate XRP', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 'zoom-in', '4.png', 0, NULL, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `groups`
-- 

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `bgcolor` char(7) NOT NULL DEFAULT '#607D8B',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `groups`
-- 

INSERT INTO `groups` VALUES (1, 'admin', 'Administrator', '#F44336');

-- --------------------------------------------------------

-- 
-- Table structure for table `layout`
-- 

CREATE TABLE `layout` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `bgcolor` char(7) NOT NULL DEFAULT '#607D8B',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `layout`
-- 

INSERT INTO `layout` VALUES (1, 'Header', 'Light Background', '#F44336');

-- --------------------------------------------------------

-- 
-- Table structure for table `login_attempts`
-- 

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `login_attempts`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `public_preferences`
-- 

CREATE TABLE `public_preferences` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `transition_page` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `public_preferences`
-- 

INSERT INTO `public_preferences` VALUES (1, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `settings`
-- 

CREATE TABLE `settings` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) NOT NULL,
  `phone_reception` varchar(50) NOT NULL,
  `phone_office` varchar(50) NOT NULL,
  `email_office` varchar(50) NOT NULL,
  `email_site` varchar(50) NOT NULL,
  `facebook_link` varchar(255) NOT NULL,
  `google_link` varchar(255) NOT NULL,
  `twitter_link` varchar(255) NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  `instragram_link` varchar(255) NOT NULL,
  `buy_sell` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `google_analytic` text NOT NULL,
  `google_verify` text NOT NULL,
  `bing_verify` text NOT NULL,
  `custom_css` text NOT NULL,
  `ticker` tinyint(1) NOT NULL,
  `header_top` tinyint(1) NOT NULL,
  `header_gdpr` tinyint(1) NOT NULL,
  `site_layout` tinyint(1) NOT NULL DEFAULT '1',
  `fevicon` varchar(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `settings`
-- 

INSERT INTO `settings` VALUES (1, '71 Pilgrim Avenue Chevy Chase, FL 32806', '+913 123 4567', '', 'info@xyz.com', '', '#', '#', '#', '', '#', '#', 'cryptonet-logo.png', '', '', '', '', 1, 1, 1, 1, 'cryptonet-favicon.png', 'All Rights Reserved by Company Name');

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (1, '127.0.0.1', 'administrator', '$2y$08$tgvNNGsT94zACJOLeBPNN.HHXLqcoCeu/RitH8eq0Qxpzgi6e94Ki', '', '', '', NULL, NULL, 'tDjU1tI.Nqijq0GUqAQy3e', 1268889823, 1528900506, 1, 'Admin', 'CryptoNet', 'Tech Pellet', '1234567890');

-- --------------------------------------------------------

-- 
-- Table structure for table `users_groups`
-- 

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `users_groups`
-- 

INSERT INTO `users_groups` VALUES (7, 1, 1);

-- 
-- Constraints for dumped tables
-- 

-- 
-- Constraints for table `users_groups`
-- 
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
