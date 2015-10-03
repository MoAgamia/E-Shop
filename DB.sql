--
-- Table structure for table `Shop`
--

  CREATE TABLE IF NOT EXISTS `Shop` (
    `id` int(6) NOT NULL auto_increment,
    `imgage` varchar(32) collate utf8_unicode_ci NOT NULL default '',
    `name` varchar(64) collate utf8_unicode_ci NOT NULL default '',
    `description` text collate utf8_unicode_ci NOT NULL,
    `quantity` int default'0',
    `price` double NOT NULL default '0',
    PRIMARY KEY  (`id`),
    UNIQUE KEY `imgage` (`imgage`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `internet_shop`
--

INSERT INTO `Shop` VALUES(1, 'iPod.png', 'iPod', 'The original and popular iPod.', 5, 200);
INSERT INTO `Shop` VALUES(2, 'iMac.png', 'iMac', 'The iMac computer.', 3,1200);
INSERT INTO `Shop` VALUES(3, 'iPhone.png', 'iPhone', 'This is the new iPhone.', 60, 400);
INSERT INTO `Shop` VALUES(4, 'iPod-Shuffle.png', 'iPod Shuffle', 'The new iPod shuffle.', 3, 49);
INSERT INTO `Shop` VALUES(5, 'iPod-Nano.png', 'iPod Nano', 'The new iPod Nano.', 7, 99);
INSERT INTO `Shop` VALUES(6, 'Apple-TV.png', 'Apple TV', 'The new Apple TV. Buy it now!', 22, 300);

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(50) NOT NULL,
  `userlastname` varchar(25),
  `history` varchar(50000),
  `imgage` varchar(1000) collate utf8_unicode_ci NOT NULL default 'uploads/50x50_default_original_profile_pic.png',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `internet_shop`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'pradeep', 'pradeep@gmail.com', '202cb962ac59075b964b07152d234b70');
