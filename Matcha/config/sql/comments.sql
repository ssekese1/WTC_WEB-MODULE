CREATE TABLE IF NOT EXISTS `login_dets` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` varchar(8) NOT NULL,
  `last_activity` DATETIME
)