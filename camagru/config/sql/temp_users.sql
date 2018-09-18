CREATE TABLE `temp_users` (
`id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
`confirm_code` varchar(255) NOT NULL,
`username` varchar(8) NOT NULL,
`email` varchar(50) NOT NULL,
`password` varchar(255) NOT NULL
)