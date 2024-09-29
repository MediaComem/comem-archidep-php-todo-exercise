CREATE DATABASE IF NOT EXISTS todolist;

-- The "WITH mysql_native_password" portion of this query is required for some
-- older versions of MySQL. If you get a "syntax error [...] near BY" message,
-- simply remove that part and use only "IDENTIFIED BY".
CREATE USER IF NOT EXISTS 'todolist'@'localhost' IDENTIFIED WITH mysql_native_password BY 'change-me-now';

GRANT ALL PRIVILEGES ON todolist.* TO 'todolist'@'localhost';

USE todolist;

CREATE TABLE IF NOT EXISTS `todo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(2048) NOT NULL,
  `done` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);
