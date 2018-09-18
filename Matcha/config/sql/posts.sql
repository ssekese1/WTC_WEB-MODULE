
CREATE TABLE IF NOT EXISTS posts (
 `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `msg` varchar(255),
  `user_from`  VARCHAR(255) NOT NULL,
 `user_to` VARCHAR(255) NOT NULL,
 `created` TIMESTAMP 
)