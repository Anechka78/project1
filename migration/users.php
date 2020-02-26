<?php
return [
<<<'EOD'
DROP TABLE IF EXISTS `users`;
EOD
,
<<<'EOD'
CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`login` varchar(25) NOT NULL,
`password` varchar(25) NOT NULL,
`email` varchar(25) NOT NULL,
`name` varchar(255) NOT NULL,
`role` enum('user','admin') NOT NULL,
`address` varchar(255) NOT NULL,
`date` varchar(255) NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `login` (`login`),
UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
EOD
,
<<<'EOD'
INSERT INTO `users` (`id`, `login`, `password`, `email`, `name`, `role`, `address`, `date`) VALUES
(1, 'Анна', '12345', '7winxa@bk.ru', '', 'user', '', ''),
(2, 'Ирина', '12345', '7winx@bk.ru', '', 'user', '', ''),
(3, 'test', '$2y$12$jksdhjkfhjkhkzdjbh', 'test@test.ru', '', 'user', '', '');
EOD
,
<<<'EOD'
INSERT INTO `users` (`id`, `login`, `password`, `email`, `name`, `role`, `address`, `date`) VALUES (NULL, '21212121', '454545', '56757@ddd.ru', 'jklkl;kl;', 'user', 'jkljkljkljkl', '');
EOD
,
];