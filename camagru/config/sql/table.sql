CREATE TABLE `users` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `username` varchar(8) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `confirm_code` VARCHAR(255) NULL,
  `notification` VARCHAR(3) DEFAULT 'Yes'
);