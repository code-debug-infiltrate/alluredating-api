-- Project updated today `13/10/21`
CREATE DATABASE IF NOT EXISTS `alluredating`;

USE alluredating;

-- Table structure for registered users `users` 
CREATE TABLE IF NOT EXISTS `app_users` ( 
`id` INT(11) AUTO_INCREMENT,
`uniqueid` VARCHAR(50) NOT NULL,
`email` VARCHAR(150) NOT NULL,
`username` VARCHAR(200) NOT NULL,
`password` VARCHAR(150) DEFAULT NULL,
`profile` ENUM('User', 'Moderator', 'Admin') DEFAULT 'User',
`code` varchar(20) NOT NULL,
`status` ENUM('Activated', 'Banned', 'Deactivated', 'New', 'Trash') DEFAULT 'New',
`log_session` varchar(30) DEFAULT NULL,
`login_status` ENUM('Logged_out', 'Logged_in') DEFAULT 'Logged_out',
`notify` ENUM('On', 'Off') DEFAULT 'Off',
`hash` VARCHAR(200) NOT NULL,
`lastlogin` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
`ip` VARCHAR(50) NOT NULL,
`user_agent` VARCHAR(250) NOT NULL,
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;



-- Table structure for confirmed users `profile` 
CREATE TABLE IF NOT EXISTS `app_profile` ( 
`id` INT(11) AUTO_INCREMENT,
`uniqueid` VARCHAR(50) NOT NULL,
`fname` VARCHAR(50) NOT NULL,
`lname` VARCHAR(50) NOT NULL,
`dob` varchar(20) DEFAULT NULL,
`gender` ENUM('Male', 'Female') DEFAULT NULL,
`occupation` varchar(100) DEFAULT NULL,
`category` varchar(200) DEFAULT NULL,
`number` varchar(20) DEFAULT NULL,
`wal_bal` VARCHAR(100) DEFAULT '0',
`address` VARCHAR(200) DEFAULT NULL,
`city` VARCHAR(100) DEFAULT NULL,
`country` VARCHAR(150) DEFAULT NULL,
`zipcode` VARCHAR(50) DEFAULT NULL,
`profileimage` VARCHAR(200) DEFAULT 'favicon.png',
`coverimage` VARCHAR(200) DEFAULT 'outdoor.jpg',
`details` longtext DEFAULT NULL,
`verify_status` ENUM('Unverified', 'Verified') DEFAULT 'Unverified',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;




-- Table structure for app_user_interests `app_user_interests` 
CREATE TABLE IF NOT EXISTS `app_user_interests` ( 
`id` INT(11) AUTO_INCREMENT,
`uniqueid` VARCHAR(50) NOT NULL,
`details`  VARCHAR(100) NOT NULL,
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;



-- Table structure for app_user_album `app_user_album` 
CREATE TABLE IF NOT EXISTS `app_user_album` ( 
`id` INT(11) AUTO_INCREMENT,
`uniqueid` VARCHAR(50) NOT NULL,
`details` VARCHAR(100) NOT NULL,
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;



-- Table structure for app_user_workeducation `app_user_workeducation` 
CREATE TABLE IF NOT EXISTS `app_user_workeducation` ( 
`id` INT(11) AUTO_INCREMENT,
`uniqueid` VARCHAR(50) NOT NULL,
`name` VARCHAR(100) DEFAULT NULL,
`start` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
`end` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
`details` longtext,
`category` ENUM('School', 'Work') DEFAULT 'School',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;



-- Table structure for app_user_interests `app_user_interests` 
CREATE TABLE IF NOT EXISTS `app_user_languages` ( 
`id` INT(11) AUTO_INCREMENT,
`uniqueid` VARCHAR(50) NOT NULL,
`language` VARCHAR(100) NOT NULL,
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;


-- Table structure for app_user_profile_actions `app_user_profile_actions` 
CREATE TABLE IF NOT EXISTS `app_user_profile_actions` ( 
`id` INT(11) AUTO_INCREMENT,
`uniqueid` VARCHAR(50) NOT NULL,
`viewerid` VARCHAR(100) NOT NULL,
`action` ENUM('Like', 'Dislike', 'None') DEFAULT 'None',
`views` INT(10) DEFAULT '0',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;


-- Table structure for app_user_views `app_user_views` 
CREATE TABLE IF NOT EXISTS `app_user_views` ( 
`id` INT(11) AUTO_INCREMENT,
`uniqueid` VARCHAR(50) NOT NULL,
`views` INT(10) DEFAULT '0',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;


-- Table structure for app_user_buddy `app_user_buddy` 
CREATE TABLE IF NOT EXISTS `app_user_buddy` ( 
`id` INT(11) AUTO_INCREMENT,
`uniqueid` VARCHAR(50) NOT NULL,
`buddyid` VARCHAR(50) NOT NULL,
`request` ENUM('Pending', 'Accepted', 'Declined') DEFAULT 'Pending',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;




-- Table structure for app_user_buddy `app_user_buddy_chats` 
CREATE TABLE IF NOT EXISTS `app_user_buddy_chats` ( 
`id` INT(11) AUTO_INCREMENT,
`chatid` VARCHAR(20) NOT NULL,
`uniqueid` VARCHAR(50) NOT NULL,
`buddyid` VARCHAR(50) NOT NULL,
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;





-- Table structure for User Posts Comment Reply `app_post_comment_reply` 
CREATE TABLE IF NOT EXISTS `app_user_buddy_chat_reply` ( 
`id` INT(11) AUTO_INCREMENT,
`chatid` VARCHAR(20) NOT NULL,
`sender` VARCHAR(50) NOT NULL,
`receiver` VARCHAR(50) NOT NULL,
`file` VARCHAR(100) DEFAULT NULL,
`details` longtext NOT NULL,
`status` ENUM('Unread', 'Read', 'Trash') DEFAULT 'Unread',
`updated` DATETIME DEFAULT NULL, 
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;





-- Table structure for app_user_preferences `app_user_preferences` 
CREATE TABLE IF NOT EXISTS `app_user_preferences` ( 
`id` INT(11) AUTO_INCREMENT,
`uniqueid` VARCHAR(50) NOT NULL,
`gender` VARCHAR(20) DEFAULT NULL,
`orientation` VARCHAR(20) DEFAULT NULL,
`ethnicity` VARCHAR(20) DEFAULT NULL,
`color` VARCHAR(20) DEFAULT NULL,
`pets` VARCHAR(20) DEFAULT NULL,
`smoking` VARCHAR(20) DEFAULT NULL,
`eating` VARCHAR(20) DEFAULT NULL,
`drinking` VARCHAR(20) DEFAULT NULL,
`bodytype` VARCHAR(20) DEFAULT NULL,
`height` VARCHAR(20) DEFAULT NULL,
`weight` VARCHAR(20) DEFAULT NULL,
`employment` VARCHAR(70) DEFAULT NULL,
`religion` VARCHAR(70) DEFAULT NULL,
`dress` VARCHAR(20) DEFAULT NULL,
`dates` VARCHAR(20) DEFAULT NULL,
`havekids` VARCHAR(20) DEFAULT NULL,
`wantkids` VARCHAR(20) DEFAULT NULL,
`maritalstatus` VARCHAR(50) DEFAULT NULL,
`seeking` VARCHAR(20) DEFAULT NULL,
`details` longtext,
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;



-- Table structure for app_user_self `app_user_self` 
CREATE TABLE IF NOT EXISTS `app_user_self` ( 
`id` INT(11) AUTO_INCREMENT,
`uniqueid` VARCHAR(50) NOT NULL,
`orientation` VARCHAR(20) DEFAULT NULL,
`ethnicity` VARCHAR(20) DEFAULT NULL,
`color` VARCHAR(20) DEFAULT NULL,
`pets` VARCHAR(20) DEFAULT NULL,
`smoking` VARCHAR(20) DEFAULT NULL,
`eating` VARCHAR(20) DEFAULT NULL,
`drinking` VARCHAR(20) DEFAULT NULL,
`bodytype` VARCHAR(20) DEFAULT NULL,
`height` VARCHAR(20) DEFAULT NULL,
`weight` VARCHAR(20) DEFAULT NULL,
`employment` VARCHAR(70) DEFAULT NULL,
`religion` VARCHAR(70) DEFAULT NULL,
`dress` VARCHAR(20) DEFAULT NULL,
`dates` VARCHAR(20) DEFAULT NULL,
`havekids` VARCHAR(20) DEFAULT NULL,
`wantkids` VARCHAR(20) DEFAULT NULL,
`maritalstatus` VARCHAR(50) DEFAULT NULL,
`seeking` VARCHAR(20) DEFAULT NULL,
`details` longtext,
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;




-- Table structure for User Posts `app_Posts` 
CREATE TABLE IF NOT EXISTS `app_users_posts` ( 
`id` INT(11) AUTO_INCREMENT,
`uniqueid` VARCHAR(50) NOT NULL,
`postid` VARCHAR(20) NOT NULL,
`url` VARCHAR(150) NOT NULL,
`file` VARCHAR(100) DEFAULT NULL,
`file1` VARCHAR(100) DEFAULT NULL,
`file2` VARCHAR(100) DEFAULT NULL,
`file3` VARCHAR(100) DEFAULT NULL,
`file4` VARCHAR(100) DEFAULT NULL,
`details` longtext NOT NULL,
`reports` INT(10) DEFAULT '0',
`type` ENUM('Video', 'Image') DEFAULT 'Image',
`status` ENUM('New', 'Publish', 'Draft', 'Trash') DEFAULT 'New',
`updated` DATETIME DEFAULT NULL, 
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;





-- Table structure for User Post Comments `app_post_comments` 
CREATE TABLE IF NOT EXISTS `app_post_comments` ( 
`id` INT(11) AUTO_INCREMENT,
`postid` VARCHAR(20) NOT NULL,
`commentid` VARCHAR(20) NOT NULL,
`postedby` VARCHAR(20) NOT NULL,
`commentby` VARCHAR(20) NOT NULL,
`title` longtext NOT NULL,
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;



-- Table structure for User Posts Comment Reply `app_post_comment_reply` 
CREATE TABLE IF NOT EXISTS `app_post_comment_reply` ( 
`id` INT(11) AUTO_INCREMENT,
`postid` VARCHAR(20) NOT NULL,
`commentid` VARCHAR(20) NOT NULL,
`sender` VARCHAR(50) NOT NULL,
`receiver` VARCHAR(50) NOT NULL,
`details` longtext NOT NULL,
`status` ENUM('Unread', 'Read', 'Trash') DEFAULT 'Unread',
`updated` DATETIME DEFAULT NULL, 
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;





-- Table structure for User Post Images `app_Post_actions` 
CREATE TABLE IF NOT EXISTS `app_post_actions` ( 
`id` INT(11) AUTO_INCREMENT,
`postid` VARCHAR(20) NOT NULL,
`likes` INT(11) DEFAULT '0',
`dislikes` INT(11) DEFAULT '0',
`views` INT(11) DEFAULT '0',
`comments` INT(11) DEFAULT '0',
`reports` INT(11) DEFAULT '0',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;





-- Table structure for User Post Images `app_Post_images` 
CREATE TABLE IF NOT EXISTS `app_user_post_actions` ( 
`id` INT(11) AUTO_INCREMENT,
`uniqueid` VARCHAR(50) NOT NULL,
`postid` VARCHAR(20) NOT NULL,
`action` VARCHAR(20) DEFAULT NULL,
`views` INT(11) DEFAULT '0',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;





-- Table structure for msg report `msgreport` 
CREATE TABLE IF NOT EXISTS `app_msgreport` ( 
`id` INT(11) AUTO_INCREMENT,
`fname` VARCHAR(50) NOT NULL,
`lname` VARCHAR(50) NOT NULL,
`email` VARCHAR(100) NOT NULL,
`phone` VARCHAR(20) NOT NULL,
`subject` VARCHAR(100) NOT NULL,
`details` longtext NOT NULL,
`status` ENUM('Unread', 'Read', 'Trash') DEFAULT 'Unread',
`ip` VARCHAR(50) NOT NULL,
`user_agent` VARCHAR(250) NOT NULL,
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;





-- Table structure for msg report `subscribe` 
CREATE TABLE IF NOT EXISTS `app_subscribe` ( 
`id` INT(11) AUTO_INCREMENT,
`email` VARCHAR(100) NOT NULL,
`status` ENUM('Active', 'Unactive', 'Trash') DEFAULT 'Active',
`ip` VARCHAR(50) NOT NULL,
`user_agent` VARCHAR(250) NOT NULL,
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;





-- Table structure for activity `activity` 
CREATE TABLE IF NOT EXISTS `app_activity` ( 
`id` INT(11) AUTO_INCREMENT,
`uniqueid` VARCHAR(50) NOT NULL,
`username` VARCHAR(100) DEFAULT NULL,
`category` VARCHAR(20) DEFAULT NULL,
`details` longtext,
`status` ENUM('Unread', 'Hide', 'Read', 'Trash') DEFAULT 'Unread',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;




-- Table structure for app_user_activity `app_user_activity` 
CREATE TABLE IF NOT EXISTS `app_user_activity` ( 
`id` INT(11) AUTO_INCREMENT,
`uniqueid` VARCHAR(50) NOT NULL,
`user_uniqueid` VARCHAR(100) DEFAULT NULL,
`details` longtext,
`status` ENUM('Unread', 'Hide', 'Read', 'Trash') DEFAULT 'Unread',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;




-- Table structure for Visitors `courier_visitors` 
CREATE TABLE IF NOT EXISTS `app_visitors` ( 
`id` INT(11) AUTO_INCREMENT,
`ip` VARCHAR(20) NOT NULL,
`vdate` VARCHAR(20) NOT NULL,
`vtime` VARCHAR(20) DEFAULT NULL,
`count` INT(11) DEFAULT '1',
`details` text DEFAULT NULL,
`status` ENUM('Unread', 'Read', 'Trash') DEFAULT 'Unread',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;





-- Table structure for Company Information `coy_info` 
CREATE TABLE IF NOT EXISTS `app_coy_info` ( 
`id` INT(11) AUTO_INCREMENT,
`coyname` VARCHAR(150) NOT NULL,
`slogan` VARCHAR(500) DEFAULT NULL,
`email` VARCHAR(150) NOT NULL,
`email1` VARCHAR(150) DEFAULT NULL,
`phone` VARCHAR(50) NOT NULL,
`phone1` VARCHAR(50) DEFAULT NULL,
`channel` VARCHAR(250) DEFAULT NULL,
`facebook` VARCHAR(50) NOT NULL,
`instagram` VARCHAR(50) NOT NULL,
`twitter` VARCHAR(50) NOT NULL,
`linkedin` VARCHAR(50) NOT NULL,
`address` text NOT NULL,
`img` VARCHAR(200) DEFAULT 'favicon.png',
`status` ENUM('Draft', 'Publish', 'Trash') DEFAULT 'Draft',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;





-- Table structure for Currency Setting `app_currency` 
CREATE TABLE IF NOT EXISTS `app_currency` ( 
`id` INT NOT NULL AUTO_INCREMENT,
`name` VARCHAR(50)  NOT NULL,
`currency` VARCHAR(50) DEFAULT NULL,
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)) ENGINE = InnoDB DEFAULT CHARSET=latin1   ;




-- Table structure for Currency Exchan `app_currency_exchange` 
CREATE TABLE IF NOT EXISTS `app_currency_exchange` ( 
`id` INT NOT NULL AUTO_INCREMENT,
`rate` VARCHAR(50)  NOT NULL,
`currency` VARCHAR(50) NOT NULL,
`status` ENUM('Publish', 'Deactivated', 'Trash') DEFAULT 'Deactivated',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)) ENGINE = InnoDB DEFAULT CHARSET=latin1   ;



-- Table structure for Bank Details `app_bank_details` 
CREATE TABLE IF NOT EXISTS `app_bank_details` ( 
`id` INT NOT NULL AUTO_INCREMENT,
`swiftcode` VARCHAR(50)  NOT NULL,
`bankname` VARCHAR(100)  NOT NULL,
`acctname` VARCHAR(100)  NOT NULL,
`acctnum` VARCHAR(50) NOT NULL,
`status` ENUM('Publish', 'Deactivated', 'Trash') DEFAULT 'Deactivated',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)) ENGINE = InnoDB DEFAULT CHARSET=latin1   ;


-- Table structure for Subscription Plan `app_subscription` 
CREATE TABLE IF NOT EXISTS `app_subscription` ( 
`id` INT NOT NULL AUTO_INCREMENT,
`status` ENUM('Paid', 'Free') DEFAULT 'Free',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)) ENGINE = InnoDB DEFAULT CHARSET=latin1   ;




-- Table structure for Subscription Plan `app_subscription_plan` 
CREATE TABLE IF NOT EXISTS `app_subscription_plan` ( 
`id` INT NOT NULL AUTO_INCREMENT,
`planid` VARCHAR(50)  NOT NULL,
`type` varchar(100) DEFAULT NULL,
`amount` VARCHAR(10) DEFAULT NULL,
`expiry` varchar(20) DEFAULT NULL,
`details` varchar(500) DEFAULT NULL,
`details1` varchar(500) DEFAULT NULL,
`details2` varchar(500) DEFAULT NULL,
`status` ENUM('Publish', 'Deactivated', 'Trash') DEFAULT 'Publish',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)) ENGINE = InnoDB DEFAULT CHARSET=latin1   ;




-- Table structure for Currency Setting `app_subscription_payment` 
CREATE TABLE IF NOT EXISTS `app_subscription_payment` ( 
`id` INT NOT NULL AUTO_INCREMENT,
`trancid` VARCHAR(50)  NOT NULL,
`uniqueid` VARCHAR(50)  NOT NULL,
`currency` VARCHAR(10) DEFAULT NULL,
`type` varchar(50) DEFAULT NULL,
`amount` VARCHAR(10) DEFAULT NULL,
`expiry` varchar(20) DEFAULT NULL,
`details` varchar(100) DEFAULT NULL,
`status` ENUM('Processing', 'Paid', 'Expired', 'Cancelled', 'Trash') DEFAULT 'Processing',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)) ENGINE = InnoDB DEFAULT CHARSET=latin1   ;




-- Table structure for User Notifications `app_notify` 
CREATE TABLE IF NOT EXISTS `app_notify` ( 
`id` INT(11) AUTO_INCREMENT,
`subject` varchar(100) NOT NULL,
`details` longtext,
`status` ENUM('Active', 'Unactive') DEFAULT 'Active',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;







-- Table structure for Crypto Payment `API` 
CREATE TABLE IF NOT EXISTS `app_thirdPartyApi` ( 
`id` INT(11) AUTO_INCREMENT,
`name` VARCHAR(50) DEFAULT NULL,
`url` VARCHAR(100) DEFAULT NULL,
`code` VARCHAR(100) DEFAULT NULL,
`public` VARCHAR(100) DEFAULT NULL,
`private` VARCHAR(100) DEFAULT NULL,
`wallet` VARCHAR(50) DEFAULT NULL,
`status` ENUM('Active', 'Deactivated') DEFAULT 'Active',
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)
) ENGINE = InnoDB   DEFAULT CHARSET=latin1 ;





-- Table structure for Delete Account Reason `app_delete_account` 
CREATE TABLE IF NOT EXISTS `app_delete_account` ( 
`id` INT NOT NULL AUTO_INCREMENT,
`uniqueid` VARCHAR(50)  NOT NULL,
`details` text DEFAULT NULL,
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
PRIMARY KEY  (`id`)) ENGINE = InnoDB DEFAULT CHARSET=latin1   ;










--
-- Dumping data for table `users`
--

INSERT INTO `app_users` (`id`, `uniqueid`, `email`, `username`, `password`, `profile`, `code`, `status`, `log_session`, `login_status`, `notify`, `hash`, `lastlogin`, `ip`, `user_agent`, `created`) VALUES
(1, 'uid0FTgh','admintester@admin.com', 'adminTester', '$2y$10$hEjHAQrERtIEOicsWzrqPeuYbALGeGdkNzA5n3orsk/PUHUtP.E4.', 'Admin', 'Hwjvh', 'Activated', '', 'Logged_out', 'Off', '63dc7ed1010d3c3b8269faf0ba7491d4', '2023-01-19 09:24:18', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '2022-12-24 05:32:18');



--
-- Dumping data for table `Profile`
--
INSERT INTO `app_profile` (`id`, `uniqueid`, `fname`, `lname`) VALUES (1, 'uid0FTgh', 'Admin', 'Tester'); 


                                        

--
-- Dumping data for table `Company Profile`
--
INSERT INTO `app_coy_info` (`id`, `coyname`, `slogan`, `email`, `email1`, `phone`, `phone1`, `facebook`, `instagram`, `twitter`, `linkedin`, `channel`, `address`, `img`, `status`) VALUES (1, 'Allure-D','Connecting You To Your Soulmate', 'hello@allured.com', '', '+20111111111', '', 'allured', 'allured', 'allured', 'allured', '', 'No 17, Kudeti Avenue, Flambush, Kignson drive. Uk', 'favicon.png', 'Publish'); 




--
-- Dumping data for table `Company Currency`
--
INSERT INTO `app_currency` (`id`, `name`, `currency`) VALUES (1, 'USD','$'); 




