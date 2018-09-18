CREATE TABLE IF NOT EXISTS `temp_users` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `username` varchar(8) NOT NULL,
  `DOB` DATE NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `confirm_code` VARCHAR(255) NULL
);