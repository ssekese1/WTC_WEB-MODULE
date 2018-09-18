CREATE TABLE IF NOT EXISTS rating_info (
 `post_id` int(11) NOT NULL PRIMARY KEY UNIQUE,
 `user_id` int(11) UNIQUE NOT NULL,
 `rating_action` varchar(255) NOT NULL,
 `created` TIMESTAMP 
)