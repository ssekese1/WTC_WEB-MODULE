CREATE TABLE IF NOT EXISTS likeprofile (
 `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `userid`  INT(11),
 `postid`  INT(11),
 `created` TIMESTAMP 
)