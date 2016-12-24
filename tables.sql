CREATE TABLE `posts` (
  `post_id` tinyint(4) NOT NULL,
  `post_title` varchar(20) COLLATE latin1_general_cs NOT NULL,
  `post_content` varchar(300) COLLATE latin1_general_cs NOT NULL,
  `post_date` datetime NOT NULL,
  `post_by` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

ALTER TABLE `posts`
  MODIFY `post_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE `users` (
  `user_id` tinyint(4) NOT NULL,
  `username` varchar(29) COLLATE latin1_general_cs NOT NULL,
  `password` varchar(32) COLLATE latin1_general_cs NOT NULL,
  `email` varchar(30) COLLATE latin1_general_cs NOT NULL,
  `activated` tinytext COLLATE latin1_general_cs NOT NULL,
  `registration_date` datetime NOT NULL,
  `last_active` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `users`
  MODIFY `user_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  CREATE TABLE `post_fav` (
    `id` int(3) NOT NULL,
    `fpost_id` int(3) NOT NULL,
    `fuser_id` int(3) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

  ALTER TABLE `post_fav`
    ADD PRIMARY KEY (`id`);

  ALTER TABLE `post_fav`
    MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  CREATE TABLE failed_logins (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(16) NOT NULL,
    ip_address INT(11) UNSIGNED NOT NULL,
    attempted DATETIME NOT NULL,
    INDEX `attempted_idx` (`attempted`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;
-- end of file
