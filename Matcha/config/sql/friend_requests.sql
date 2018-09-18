CREATE TABLE IF NOT EXISTS friend_requests (
 `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `user_from`  VARCHAR(255) NOT NULL,
 `user_to` VARCHAR(255) NOT NULL,
  `status` INT(11) NOT NULL,
 `created` TIMESTAMP 
)