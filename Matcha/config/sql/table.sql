CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `username` varchar(8) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Interests` varchar(50) NOT NULL,
  `DOB` DATE NOT NULL,
  `Sexual_Preference` varchar(50) NOT NULL,
  `Biography` varchar(500) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `confirm_code` VARCHAR(255) NULL,
  `online_status` INT(1) NOT NULL,
  `created` TIMESTAMP,
  `notification` VARCHAR(3) DEFAULT 'Yes'
);