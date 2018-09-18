CREATE TABLE `comments` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `username` varchar(8) NOT NULL,
  `comment` MEDIUMTEXT NOT NULL,
  `image` VARCHAR(255),
  `created` TIMESTAMP 
)