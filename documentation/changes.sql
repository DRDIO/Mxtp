--
-- Table structure for table `service_twitter`
--

CREATE TABLE IF NOT EXISTS `service_twitter` (
  `user_id` int(11) NOT NULL,
  `oauth_token` varchar(64) NOT NULL,
  `oauth_token_secret` varchar(64) NOT NULL,
  `screen_name` varchar(64) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
